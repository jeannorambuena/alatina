# Snapshot documental

Skill documental del menú inicial de Claw para Telegram.

- Skill activa real:
  `~/.openclaw/workspace/skills/openclaw-telegram-menu/SKILL.md`

---

---
name: openclaw-telegram-menu
description: Menú inicial de Claw para Telegram. Úsalo solo si el mensaje es exactamente Claw, claw, CLAW, hola claw, menú, menu. No interceptar formatos operativos.
---

# Menú Claw

## Regla prioritaria

Si el mensaje del usuario es exactamente uno de estos gatillos:
- `Claw`
- `claw`
- `CLAW`
- `menu`
- `menú`
- `hola claw`

Responder inmediatamente con el menú router.
No conversar de forma general.
No ejecutar acciones.
No crear posts.
No crear eventos.
No llamar scripts.

## Gatillos
- `Claw`
- `claw`
- `CLAW`
- `hola claw`
- `menú`
- `menu`

## Respuesta exacta esperada

Hola Jean, ¿qué necesitas hacer?

1. Crear noticia para la web
2. Agendar algo personal
3. Crear actividad en calendario escolar
4. Ver formatos disponibles
5. Cancelar

Responde con el número o el nombre de la opción.

## Opción calendario escolar

Formato mínimo:

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

Nota adicional:
- Si la actividad tiene horario específico, puedes agregar `Inicio: HH:MM` y `Fin: HH:MM`.
- Si no indicas horario, se creará como actividad de todo el día.

## Reglas
- No ejecutar acciones.
- No crear posts.
- No crear eventos.
- No subir imágenes.
- No borrar nada.
- Solo orientar y entregar formatos.

## Cancelar
Respuesta exacta:

Operación cancelada. No hice cambios.
