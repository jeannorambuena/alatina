# Calendar Publisher Telegram V1

Flujo separado para crear, modificar y eliminar actividades del calendario escolar desde Telegram.

## Formato crear mínimo

```text
NUEVA ACTIVIDAD CALENDARIO:
Título: ...
Fecha: YYYY-MM-DD
Texto corto: ...
Categoría: Actividades
Lugar: ...
Descripción:
...

FIN
```

Si necesitas horario específico, puedes agregar:

```text
Inicio: HH:MM
Fin: HH:MM
```

## Reglas de horario
- Si el mensaje trae `Inicio` y `Fin`, usar horario.
- También aceptar `Hora inicio` y `Hora término` como alias de `Inicio` y `Fin`.
- Si trae `Inicio: Todo el día`, marcar actividad de todo el día.
- Si no trae `Inicio` ni `Fin`, asumir automáticamente actividad de todo el día.
- No inventar horarios.
- No bloquear creación por falta de horario.

## Campos obligatorios reales
- `Título`
- `Fecha`
- `Descripción`

## Campos opcionales
- `Inicio`
- `Fin`
- `Texto corto`
- `Categoría`
- `Lugar`

## Defaults
- Si falta `Texto corto`, generarlo desde `Título` con máximo 28 caracteres.
- Si falta `Categoría`, usar `Actividades`.
- Si falta horario, crear como actividad de todo el día.
- Si viene `Lugar`, integrarlo en la descripción/modal si no existe meta específica.

## Formato modificar

```text
MODIFICAR ACTIVIDAD CALENDARIO:
ID: 123
Título: ...
Fecha: YYYY-MM-DD o DD/MM/YYYY
Texto corto: ...
Categoría: Actividades
Lugar: ...
Descripción:
...

FIN
```

Para horario específico en modificación:

```text
Inicio: HH:MM
Fin: HH:MM
```

También se acepta:

```text
Inicio: Todo el día
```

## Formato eliminar

```text
ELIMINAR ACTIVIDAD CALENDARIO:
ID: 123
Motivo: prueba o actividad cancelada

FIN
```

## Confirmaciones válidas
- crear actividad calendario
- aplicar cambio calendario
- eliminar actividad calendario
- descartar

## Comandos inválidos
- crear evento
- publicar
- borrar
- eliminar
- confirmar
- crear actividad

Si aparece un comando ambiguo, responder:

```text
Confirmación incompleta. Debes elegir explícitamente:
- crear actividad calendario
- aplicar cambio calendario
- eliminar actividad calendario
- descartar
```

## Texto corto
- máximo 28 caracteres
- sin emojis
- sin saltos de línea
- sin HTML
- si excede, truncar con `...`
- fallback: usar título truncado si no viene `Texto corto`

Meta prevista para el plugin:
- `_alatina_event_short_label`

## Modal
- mantener título completo
- mantener descripción completa
- incluir `Lugar` dentro de la descripción si fue enviado

## No borrar permanente
- eliminación debe ir a papelera o estado seguro
- no usar borrado definitivo

## Scripts
- `parse-telegram-calendar.py`
- `calendar-rest.py`
- `create-calendar-event.sh`
- `update-calendar-event.sh`
- `delete-calendar-event.sh`
- `telegram-calendar-create.sh`
- `telegram-calendar-update.sh`
- `telegram-calendar-delete.sh`

## Guardas requeridas
- `ALATINA_CALENDAR_GUARD=telegram-calendar-create`
- `ALATINA_CALENDAR_GUARD=telegram-calendar-update`
- `ALATINA_CALENDAR_GUARD=telegram-calendar-delete`

Ningún script debe ejecutar sin su guard correspondiente.

## Limitación actual
Los scripts usan WordPress REST para `alatina_event`. Si el plugin no expone REST (`show_in_rest`), devolverán error claro y no crearán ni modificarán nada.
