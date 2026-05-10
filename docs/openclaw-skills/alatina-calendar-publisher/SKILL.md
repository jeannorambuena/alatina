# Snapshot documental

Skill documental del flujo de calendario desde Telegram para Alatina.

- Skill activa real:
  `~/.openclaw/workspace/skills/alatina-calendar-publisher/SKILL.md`
- No interceptar noticias.

---

---
name: alatina-calendar-publisher
description: Crear, modificar y eliminar actividades del calendario escolar de alatina.cl desde mensajes tipo Telegram. Úsala solo cuando el mensaje comience con NUEVA ACTIVIDAD CALENDARIO:, MODIFICAR ACTIVIDAD CALENDARIO: o ELIMINAR ACTIVIDAD CALENDARIO:. No interceptar NUEVA NOTICIA BORRADOR:.
---

# Alatina Calendar Publisher

## Regla superior de calendario escolar

Para mensajes que comiencen con `NUEVA ACTIVIDAD CALENDARIO:` el horario NO es obligatorio.

Campos obligatorios:
- `Título`
- `Fecha`
- `Descripción`

Campos opcionales:
- `Inicio`
- `Fin`
- `Hora inicio`
- `Hora término`
- `Texto corto`
- `Categoría`
- `Lugar`

Si falta `Inicio`/`Fin` o `Hora inicio`/`Hora término`, interpretar como actividad de todo el día.

Queda prohibido responder:
- "Este formato sigue incompleto" por falta de horario
- "Faltan Hora inicio y Hora término"
- "08:00 a 18:00"
- "09:00 a 13:00"

Respuesta correcta ante actividad sin horario:
"Entendí una actividad de calendario de todo el día. No crearé nada hasta tu confirmación."

No pedir horario.

## Gatillos válidos
- `NUEVA ACTIVIDAD CALENDARIO:`
- `MODIFICAR ACTIVIDAD CALENDARIO:`
- `ELIMINAR ACTIVIDAD CALENDARIO:`

## Confirmaciones válidas
- `crear actividad calendario`
- `aplicar cambio calendario`
- `eliminar actividad calendario`
- `descartar`

## Confirmaciones inválidas
- `crear evento`
- `publicar`
- `borrar`
- `eliminar`
- `confirmar`
- `crear actividad`

## Reglas clave
- `Título`, `Fecha` y `Descripción` son obligatorios.
- `Inicio`, `Fin`, `Hora inicio` y `Hora término` son opcionales.
- Si falta horario, crear como actividad de todo el día.
- Si viene `Inicio: Todo el día`, marcar actividad de todo el día.
- No pedir horarios inventados.
- No bloquear por falta de horario.
- Si falta `Texto corto`, generarlo desde el título con máximo 28 caracteres.
- Si falta `Categoría`, usar `Actividades`.
- Si viene `Lugar`, integrarlo en el contenido visible del modal.
- No borrar permanente: mover a papelera o estado seguro.

## Formato mínimo crear

```text
NUEVA ACTIVIDAD CALENDARIO:
Título: ...
Fecha: YYYY-MM-DD o DD/MM/YYYY
Texto corto: ...
Categoría: Actividades
Lugar: ...
Descripción:
...

FIN
```

Las actividades del calendario escolar no requieren horario.
Si no se indica horario, la actividad se crea como todo el día.
No pedir horarios inventados.
No sugerir `08:00 a 18:00`.
No bloquear por falta de horario.

Si necesita horario específico, puede agregar:

```text
Inicio: HH:MM
Fin: HH:MM
```

## Wrappers oficiales
- `scripts/wordpress/calendar/telegram-calendar-create.sh`
- `scripts/wordpress/calendar/telegram-calendar-update.sh`
- `scripts/wordpress/calendar/telegram-calendar-delete.sh`
