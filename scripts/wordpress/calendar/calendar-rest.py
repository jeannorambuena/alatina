#!/usr/bin/env python3
import base64
import json
import os
import re
import sys
from pathlib import Path
from urllib.error import HTTPError
from urllib.parse import urlencode
from urllib.request import Request, urlopen

SECRET_FILE = os.environ.get('ALATINA_WP_SECRET_FILE', str(Path.home() / '.openclaw/secrets/alatina-wp.env'))
POST_ENDPOINT = '/wp-json/wp/v2/alatina_event'
TERM_ENDPOINT = '/wp-json/wp/v2/alatina_event_category'
VALID_GUARDS = {
    'create': 'telegram-calendar-create',
    'update': 'telegram-calendar-update',
    'delete': 'telegram-calendar-delete',
}


def fail(message: str, code: int = 1):
    print(message, file=sys.stderr)
    raise SystemExit(code)


def load_env(path: str) -> dict:
    env = {}
    for raw in Path(path).read_text(encoding='utf-8').splitlines():
        line = raw.strip()
        if not line or line.startswith('#') or '=' not in line:
            continue
        key, value = line.split('=', 1)
        env[key.strip()] = value.strip().strip('"').strip("'")
    return env


def request_json(method: str, url: str, auth_header: str, payload=None):
    data = None
    headers = {'Authorization': auth_header}
    if payload is not None:
        data = json.dumps(payload, ensure_ascii=False).encode('utf-8')
        headers['Content-Type'] = 'application/json'
    req = Request(url, data=data, headers=headers, method=method)
    try:
        with urlopen(req) as resp:
            body = resp.read().decode('utf-8')
            return json.loads(body) if body else {}
    except HTTPError as exc:
        body = exc.read().decode('utf-8', errors='ignore')
        if exc.code == 404 and ('alatina_event' in url or 'alatina_event_category' in url):
            fail('ERROR: el calendario no expone REST todavía. Falta habilitar show_in_rest en el plugin.', 42)
        fail(f'ERROR REST {exc.code}: {body[:500]}', 1)


def normalize(value: str) -> str:
    value = value.lower().strip()
    table = str.maketrans('áéíóúäëïöüñ', 'aeiouaeioun')
    value = value.translate(table)
    value = re.sub(r'[^a-z0-9]+', '-', value)
    return value.strip('-')


def resolve_term_id(base_url: str, auth_header: str, category: str) -> int:
    url = base_url + TERM_ENDPOINT + '?' + urlencode({'per_page': 100, 'search': category})
    terms = request_json('GET', url, auth_header)
    target = normalize(category)
    for term in terms:
        if normalize(term.get('name', '')) == target or term.get('slug') == target:
            return int(term['id'])
    fail(f'ERROR: no se encontró la categoría de calendario: {category}')


def build_payload(data: dict, term_id: int) -> dict:
    return {
        'title': data['title'],
        'content': data['description'],
        'status': 'publish',
        'meta': {
            '_asc_event_date': data['date'],
            '_asc_all_day': '1' if data.get('all_day') else '',
            '_asc_start_time': data['start_time'],
            '_asc_end_time': data['end_time'],
            '_alatina_event_short_label': data['short_label'],
        },
        'alatina_event_category': [term_id],
    }


def read_payload(path: str) -> dict:
    blob = json.loads(Path(path).read_text(encoding='utf-8'))
    if not blob.get('ok'):
        fail(blob.get('error', 'Payload inválido'))
    return blob['data']


def ensure_guard(action: str):
    expected = VALID_GUARDS[action]
    current = os.environ.get('ALATINA_CALENDAR_GUARD', '')
    if current != expected:
        fail(f'ERROR: guard inválida. Se requiere ALATINA_CALENDAR_GUARD={expected}', 42)


def summarize_event(prefix: str, event: dict):
    meta = event.get('meta', {})
    print(f'{prefix}: OK')
    print(f"ID: {event.get('id')}")
    print(f"Estado: {event.get('status')}")
    print(f"Título: {event.get('title', {}).get('rendered', '')}")
    print(f"Categorías: {event.get('alatina_event_category', [])}")
    print(f"Fecha: {meta.get('_asc_event_date', '')}")
    print(f"Todo el día: {'sí' if meta.get('_asc_all_day') == '1' else 'no'}")
    print(f"Inicio: {meta.get('_asc_start_time', '')}")
    print(f"Fin: {meta.get('_asc_end_time', '')}")
    print(f"Texto corto: {meta.get('_alatina_event_short_label', '')}")


def verify_persisted_meta(event: dict, data: dict):
    meta = event.get('meta') or {}
    expected = {
        '_asc_event_date': data['date'],
        '_asc_all_day': '1' if data.get('all_day') else '',
        '_asc_start_time': data['start_time'],
        '_asc_end_time': data['end_time'],
        '_alatina_event_short_label': data['short_label'],
    }
    missing_meta_block = not isinstance(meta, dict) or len(meta) == 0
    mismatches = []
    for key, expected_value in expected.items():
        current_value = meta.get(key, '') if isinstance(meta, dict) else ''
        if current_value != expected_value:
            mismatches.append((key, expected_value, current_value))

    if missing_meta_block or mismatches:
        lines = ['ERROR: WordPress creó/actualizó el evento pero no persistió meta calendario.']
        if missing_meta_block:
            lines.append('Meta ausente en la respuesta REST del evento.')
        for key, expected_value, current_value in mismatches:
            lines.append(f'- {key}: esperado={expected_value!r} actual={current_value!r}')
        fail('\n'.join(lines), 44)


def main():
    if len(sys.argv) != 3 or sys.argv[1] not in {'create', 'update', 'delete'}:
        fail('Uso: calendar-rest.py [create|update|delete] payload.json')
    action = sys.argv[1]
    ensure_guard(action)
    base_url = os.environ.get('ALATINA_WP_URL', '').rstrip('/')
    user = os.environ.get('ALATINA_WP_USER', '')
    password = os.environ.get('ALATINA_WP_APP_PASSWORD', '')

    if not base_url or not user or not password:
        env = load_env(SECRET_FILE) if Path(SECRET_FILE).is_file() else {}
        base_url = base_url or env.get('ALATINA_WP_URL', '').rstrip('/')
        user = user or env.get('ALATINA_WP_USER', '')
        password = password or env.get('ALATINA_WP_APP_PASSWORD', '')

    if not base_url or not user or not password:
        fail('ERROR: configuración WordPress incompleta para Calendar Publisher.', 43)
    auth_header = 'Basic ' + base64.b64encode(f'{user}:{password}'.encode()).decode()
    data = read_payload(sys.argv[2])

    if action == 'delete':
        event = request_json('GET', f"{base_url}{POST_ENDPOINT}/{data['id']}", auth_header)
        trashed = request_json('DELETE', f"{base_url}{POST_ENDPOINT}/{data['id']}?force=false", auth_header)
        print('DELETE: OK')
        print(f"ID: {event.get('id')}")
        print(f"Estado previo: {event.get('status')}")
        print(f"Resultado: {trashed.get('status')}")
        print(f"Motivo: {data.get('reason', '')}")
        return

    term_id = resolve_term_id(base_url, auth_header, data['category'])
    payload = build_payload(data, term_id)

    if action == 'create':
        created = request_json('POST', f'{base_url}{POST_ENDPOINT}', auth_header, payload)
        reloaded = request_json('GET', f"{base_url}{POST_ENDPOINT}/{created['id']}?context=edit", auth_header)
        verify_persisted_meta(reloaded, data)
        summarize_event('CREATE', reloaded)
    else:
        existing = request_json('GET', f"{base_url}{POST_ENDPOINT}/{data['id']}?context=edit", auth_header)
        updated = request_json('POST', f"{base_url}{POST_ENDPOINT}/{data['id']}", auth_header, payload)
        reloaded = request_json('GET', f"{base_url}{POST_ENDPOINT}/{updated['id']}?context=edit", auth_header)
        verify_persisted_meta(reloaded, data)
        print('ANTES:')
        print(f"Título: {existing.get('title', {}).get('rendered', '')}")
        print(f"Estado: {existing.get('status')}")
        print(f"Fecha: {existing.get('meta', {}).get('_asc_event_date', '')}")
        print(f"Todo el día: {'sí' if existing.get('meta', {}).get('_asc_all_day') == '1' else 'no'}")
        print(f"Inicio: {existing.get('meta', {}).get('_asc_start_time', '')}")
        print(f"Fin: {existing.get('meta', {}).get('_asc_end_time', '')}")
        print(f"Texto corto: {existing.get('meta', {}).get('_alatina_event_short_label', '')}")
        print('DESPUÉS:')
        summarize_event('UPDATE', reloaded)


if __name__ == '__main__':
    main()
