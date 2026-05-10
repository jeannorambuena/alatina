#!/usr/bin/env python3
import json
import re
import sys
from datetime import datetime
from pathlib import Path

CREATE_HEADER = 'NUEVA ACTIVIDAD CALENDARIO:'
UPDATE_HEADER = 'MODIFICAR ACTIVIDAD CALENDARIO:'
DELETE_HEADER = 'ELIMINAR ACTIVIDAD CALENDARIO:'
VALID_CATEGORIES = {'Actividades', 'Reuniones', 'Evaluaciones', 'Vacaciones', 'Informativos', 'Efemérides'}


def error(message: str):
    print(json.dumps({'ok': False, 'error': message}, ensure_ascii=False))
    raise SystemExit(1)


def load_text(path: str) -> str:
    return Path(path).read_text(encoding='utf-8').strip()


def canonical_key(key: str) -> str:
    normalized = key.strip().lower()
    aliases = {
        'hora inicio': 'Inicio',
        'hora término': 'Fin',
        'hora termino': 'Fin',
    }
    return aliases.get(normalized, key.strip())


def parse_blocks(text: str):
    lines = text.splitlines()
    if not lines:
        error('Mensaje vacío')
    header = lines[0].strip()
    if header not in {CREATE_HEADER, UPDATE_HEADER, DELETE_HEADER}:
        error('Formato no reconocido para calendario')
    op = {
        CREATE_HEADER: 'create',
        UPDATE_HEADER: 'update',
        DELETE_HEADER: 'delete',
    }[header]
    fields = {}
    description_lines = []
    in_description = False
    for raw in lines[1:]:
        line = raw.rstrip()
        if line.strip() == 'FIN':
            break
        if in_description:
            description_lines.append(line)
            continue
        if line.startswith('Descripción:'):
            in_description = True
            tail = line[len('Descripción:'):].lstrip()
            if tail:
                description_lines.append(tail)
            continue
        if ':' not in line:
            continue
        key, value = line.split(':', 1)
        fields[canonical_key(key)] = value.strip()
    if in_description:
        fields['Descripción'] = '\n'.join(description_lines).strip()
    return op, fields


def normalize_short_label(value: str) -> str:
    value = re.sub(r'<[^>]+>', '', value)
    value = value.replace('\r', ' ').replace('\n', ' ').replace('\t', ' ')
    value = re.sub(r'[\U0001F000-\U0001FAFF\u2600-\u27BF]', '', value)
    value = re.sub(r'\s+', ' ', value).strip()
    if len(value) > 28:
        value = value[:25].rstrip() + '...'
    return value


def normalize_date(value: str) -> str:
    raw = (value or '').strip()
    if re.fullmatch(r'\d{4}-\d{2}-\d{2}', raw):
        try:
            return datetime.strptime(raw, '%Y-%m-%d').strftime('%Y-%m-%d')
        except ValueError:
            error('Fecha inválida. Use YYYY-MM-DD o DD/MM/YYYY')
    if re.fullmatch(r'\d{2}/\d{2}/\d{4}', raw):
        try:
            return datetime.strptime(raw, '%d/%m/%Y').strftime('%Y-%m-%d')
        except ValueError:
            error('Fecha inválida. Use YYYY-MM-DD, DD/MM/YYYY o DD-MM-YYYY')
    if re.fullmatch(r'\d{2}-\d{2}-\d{4}', raw):
        try:
            return datetime.strptime(raw, '%d-%m-%Y').strftime('%Y-%m-%d')
        except ValueError:
            error('Fecha inválida. Use YYYY-MM-DD, DD/MM/YYYY o DD-MM-YYYY')
    error('Fecha inválida. Use YYYY-MM-DD, DD/MM/YYYY o DD-MM-YYYY')


def validate_time(value: str, label: str):
    if not re.fullmatch(r'\d{2}:\d{2}', value or ''):
        error(f'{label} inválida. Use HH:MM')


def build_description(description: str, place: str) -> str:
    description = description.strip()
    place = place.strip()
    if not place:
        return description
    place_line = f'Lugar: {place}'
    if place_line.lower() in description.lower():
        return description
    if description:
        return f'{place_line}\n\n{description}'
    return place_line


def derive_time_fields(fields: dict) -> tuple[bool, str, str]:
    start = (fields.get('Inicio') or '').strip()
    end = (fields.get('Fin') or '').strip()

    if start.lower() == 'todo el día' or start.lower() == 'todo el dia':
        return True, '', ''

    if not start and not end:
        return True, '', ''

    if bool(start) != bool(end):
        error('Si usas horario específico, debes enviar Inicio y Fin')

    validate_time(start, 'Inicio')
    validate_time(end, 'Fin')
    return False, start, end


def build_upsert_payload(fields: dict, operation: str) -> dict:
    if operation == 'update':
        if not fields.get('ID') or not str(fields['ID']).isdigit():
            error('ID inválido para modificación')

    title = (fields.get('Título') or '').strip()
    if not title:
        error('Falta campo obligatorio: Título')

    description = (fields.get('Descripción') or '').strip()
    if not description:
        error('Falta campo obligatorio: Descripción')

    date_value = normalize_date(fields.get('Fecha', ''))
    all_day, start_time, end_time = derive_time_fields(fields)

    short_source = (fields.get('Texto corto') or '').strip() or title
    short_label = normalize_short_label(short_source)
    if not short_label:
        error('Texto corto vacío o inválido')

    category = (fields.get('Categoría') or 'Actividades').strip() or 'Actividades'
    if category not in VALID_CATEGORIES:
        error('Categoría no permitida')

    description_final = build_description(description, (fields.get('Lugar') or '').strip())

    payload = {
        'operation': operation,
        'date': date_value,
        'start_time': start_time,
        'end_time': end_time,
        'short_label': short_label,
        'title': title,
        'category': category,
        'description': description_final,
        'all_day': all_day,
    }
    if operation == 'update':
        payload['id'] = int(fields['ID'])
    return payload


def main():
    if len(sys.argv) != 2:
        error('Uso: parse-telegram-calendar.py archivo.txt')
    text = load_text(sys.argv[1])
    op, fields = parse_blocks(text)
    if op == 'create':
        payload = build_upsert_payload(fields, 'create')
    elif op == 'update':
        payload = build_upsert_payload(fields, 'update')
    else:
        if not fields.get('ID') or not str(fields['ID']).isdigit():
            error('ID inválido para eliminación')
        payload = {
            'operation': 'delete',
            'id': int(fields['ID']),
            'reason': fields.get('Motivo', '').strip(),
        }
    print(json.dumps({'ok': True, 'data': payload}, ensure_ascii=False))


if __name__ == '__main__':
    main()
