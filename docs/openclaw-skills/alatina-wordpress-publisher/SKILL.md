# Snapshot documental

Este archivo es un snapshot documental del flujo aprobado para Alatina.

- No es la skill activa.
- La skill activa real vive en:
  `~/.openclaw/workspace/skills/alatina-wordpress-publisher/SKILL.md`
- Esta copia debe actualizarse cuando cambie el flujo aprobado.

---

---
name: alatina-wordpress-publisher
description: Crear borradores seguros en alatina.cl desde mensajes tipo Telegram.
metadata: {"clawdbot":{"emoji":"📰","requires":{"bins":["bash","python3","curl"]}}}
---

# Alatina WordPress Publisher

Skill para ayudar a Jean a crear borradores de noticias en alatina.cl desde mensajes estructurados.

## Regla principal

Nunca publicar directo. Solo crear borradores después de confirmación explícita.

## Formato esperado

NUEVA NOTICIA BORRADOR:
Título: Título de la noticia
Categoría: Comunicados
Extracto: Resumen breve.

Texto:
Contenido principal de la noticia.

FIN

## Flujo obligatorio

Cuando Jean envíe un mensaje que comience con `NUEVA NOTICIA BORRADOR:`:

1. Leer e interpretar el mensaje.
2. Mostrar lo entendido:
   - título
   - categoría sugerida
   - extracto
   - resumen
3. Pedir confirmación.
4. Solo ejecutar si Jean confirma con:
   - crear borrador
   - confirmar borrador
   - generar borrador
5. Ejecutar el script local.
6. Informar ID, estado y título del borrador.

## Script principal

Ruta:

/home/srv-openclaw/.openclaw/workspace/repos/alatina/scripts/wordpress/create-draft-from-stdin.sh

Uso:

cd /home/srv-openclaw/.openclaw/workspace/repos/alatina

cat <<'MSG' | scripts/wordpress/create-draft-from-stdin.sh
NUEVA NOTICIA BORRADOR:
Título: Ejemplo
Categoría: Comunicados
Extracto: Ejemplo.

Texto:
Contenido de prueba.

FIN
MSG

## Seguridad

- No mostrar credenciales.
- No leer ni imprimir ~/.openclaw/secrets/alatina-wp.env.
- No usar status publish.
- No modificar PHP, CSS, JS ni plantillas desde Telegram.
- No hacer commit, push ni deploy sin confirmación explícita.
- Si falta título o texto, pedir corrección.
- Si hay imagen adjunta, avisar que las fotos serán una fase posterior.

## Regla adicional de confirmación

En Telegram, nunca ofrecer la opción "publicar" para este flujo.

Opciones permitidas:
- crear borrador
- editar titulo
- editar categoria
- editar extracto
- editar texto
- descartar

Si Jean pide "publicar", responder que este flujo solo crea borradores y que la publicación final debe hacerse desde WordPress o mediante un flujo futuro separado con revisión adicional.

## Flujo validado con fotografía

Ya existe una prueba técnica validada para crear borradores de noticia usando una fotografía recibida desde Telegram.

Flujo validado:

1. Jean envía una fotografía al bot de Telegram.
2. OpenClaw recibe e interpreta la imagen.
3. OpenClaw guarda la imagen localmente en:
   ~/.openclaw/media/inbound/
4. El script local sube la imagen a WordPress Media.
5. WordPress entrega un Media ID.
6. El script crea un borrador de noticia.
7. El borrador queda con categoría real.
8. El borrador queda con imagen destacada.
9. Nunca se publica directamente.

Script integrador validado:

/home/srv-openclaw/.openclaw/workspace/repos/alatina/scripts/wordpress/create-draft-with-media.sh

Uso técnico:

cd /home/srv-openclaw/.openclaw/workspace/repos/alatina

scripts/wordpress/create-draft-with-media.sh \
  /ruta/local/imagen.jpg \
  "Título de la noticia" \
  "Contenido principal de la noticia." \
  "Extracto breve." \
  "Comunicados"

Última prueba validada:

- Archivo local:
  /home/srv-openclaw/.openclaw/media/inbound/file_24---4e581d8d-12a7-4400-a6b5-8b3fcfb9ea6e.jpg
- Media ID: 211
- Post ID: 212
- Estado: draft
- Categoría: Comunicados
- Imagen destacada: Media ID 211

## Regla para noticias con fotografía

Cuando Jean envíe una foto con una noticia:

1. Interpretar la foto y el texto.
2. Mostrar lo entendido:
   - título
   - categoría
   - extracto
   - resumen del texto
   - si hay foto recibida
   - descripción breve de la foto
3. Recordar que la foto principal se usará como imagen destacada.
4. Pedir confirmación antes de crear cualquier borrador.
5. Solo ejecutar si Jean confirma explícitamente una opción clara:
   - crear borrador con imagen
   - crear borrador sin imagen
   - crear borrador, solo cuando no haya foto recibida
6. Crear siempre en estado draft.
7. Nunca ofrecer publicar.
8. Si la foto incluye estudiantes, apoderados, funcionarios o personas reconocibles, advertir que debe existir autorización antes de publicar.
9. Si la imagen contiene datos sensibles, documentos, RUT, teléfonos, direcciones u otra información privada, advertirlo y no recomendar publicación sin revisión.

## Opciones permitidas para noticia con fotografía

Cuando haya foto recibida, ofrecer:

- crear borrador con imagen
- crear borrador sin imagen
- editar titulo: ...
- editar categoria: ...
- editar extracto: ...
- editar texto: ...
- cambiar foto
- descartar

Si Jean responde solo "crear borrador", no asumir. Preguntar:

"¿Quieres crear el borrador con imagen o sin imagen?"

Cuando no haya foto recibida, se puede usar:

- crear borrador

No ofrecer "publicar" desde Telegram.


## Regla prioritaria final para opciones de noticias con foto

Esta regla tiene prioridad sobre cualquier regla anterior.

Si el mensaje de Telegram incluye una fotografía o imagen adjunta, OpenClaw NO debe ofrecer la opción simple:

- crear borrador

En noticias con foto, las únicas opciones permitidas son:

- crear borrador con imagen
- crear borrador sin imagen
- editar titulo: ...
- editar categoria: ...
- editar extracto: ...
- editar texto: ...
- cambiar foto
- descartar

Si hay fotografía recibida y Jean escribe solamente "crear borrador", responder:

"Recibí una fotografía. ¿Quieres crear el borrador con imagen o sin imagen?"

No asumir la decisión.

Si no hay fotografía recibida, entonces sí se permite la opción simple:

- crear borrador

Nunca ofrecer "publicar".
Nunca publicar directamente desde Telegram.

## Regla estricta de respuesta cuando hay imagen

Cuando OpenClaw responda a una noticia que incluye imagen adjunta, la sección "Opciones siguientes" debe incluir exactamente estas opciones:

- crear borrador con imagen
- crear borrador sin imagen
- editar titulo: ...
- editar categoria: ...
- editar extracto: ...
- editar texto: ...
- cambiar foto
- descartar

No omitir "crear borrador sin imagen".
No omitir "cambiar foto".
No incluir la opción simple "crear borrador" cuando haya imagen adjunta.
No incluir "publicar".
