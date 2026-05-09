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

Crear borradores de noticias para alatina.cl desde mensajes estructurados tipo Telegram.

## Regla principal

Nunca publicar directo. Solo crear borradores después de confirmación explícita.

OpenClaw nunca debe aceptar como confirmación final:
- crear borrador
- confirmar borrador
- generar borrador

Si Jean responde cualquiera de esas frases, responder exactamente:

"Confirmación incompleta. Debes elegir explícitamente:
- crear borrador sin imagen
- crear borrador con imagen
- descartar"

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
   - si hay imagen adjunta o no
3. Pedir confirmación.
4. Solo ejecutar si Jean confirma explícitamente una opción válida según el contexto.
5. Si la respuesta final es `crear borrador`, `confirmar borrador` o `generar borrador`, no ejecutar nada y responder con el texto exacto de confirmación incompleta.
6. Ejecutar solo wrappers oficiales de Telegram.
7. Informar ID, estado y título del borrador.

## Flujo sin imagen

Opciones permitidas:
- crear borrador sin imagen
- editar titulo: ...
- editar categoria: ...
- editar extracto: ...
- editar texto: ...
- descartar

Reglas:
- Solo el comando exacto `crear borrador sin imagen` permite crear borrador.
- Debe ejecutar: `scripts/wordpress/telegram-create-draft-no-media.sh`
- No debe usar `create-draft.sh` directamente.
- No debe usar `create-draft-from-stdin.sh` directamente.
- No debe subir media.
- Siempre status `draft`.
- No ofrecer `crear borrador` simple.
- No ofrecer `confirmar borrador`.
- No ofrecer `generar borrador`.
- Nunca ofrecer `publicar`.

Ejecución exacta:

```bash
cd /home/srv-openclaw/.openclaw/workspace/repos/alatina
cat <<'MSG' | scripts/wordpress/telegram-create-draft-no-media.sh
NUEVA NOTICIA BORRADOR:
Título: Ejemplo
Categoría: Comunicados
Extracto: Ejemplo.

Texto:
Contenido de prueba.

FIN
MSG
```

## Flujo con imagen

Opciones permitidas:
- crear borrador con imagen
- crear borrador sin imagen
- cambiar foto
- editar titulo: ...
- editar categoria: ...
- editar extracto: ...
- editar texto: ...
- descartar

Reglas:
- Solo el comando exacto `crear borrador con imagen` permite subir media y crear borrador con imagen destacada.
- Debe ejecutar: `scripts/wordpress/telegram-create-draft-with-media.sh /ruta/imagen "Título" "Contenido" "Extracto" "Categoría"`
- No debe usar `upload-media.sh` directamente desde la conversación.
- No debe usar `create-draft-with-media.sh` directamente desde la conversación.
- Siempre status `draft`.
- `crear borrador` simple es inválido.
- `confirmar borrador` es inválido.
- `generar borrador` es inválido.
- Nunca ofrecer `publicar`.

Ejecución exacta con imagen:

```bash
cd /home/srv-openclaw/.openclaw/workspace/repos/alatina
scripts/wordpress/telegram-create-draft-with-media.sh \
  /ruta/local/imagen.jpg \
  "Título de la noticia" \
  "Contenido principal de la noticia." \
  "Extracto breve." \
  "Comunicados"
```

## Si hay imagen y Jean elige crear borrador sin imagen

Reglas:
- Ejecutar solo: `scripts/wordpress/telegram-create-draft-no-media.sh`
- No subir media.
- No usar `featured_media`.
- Siempre status `draft`.

## Seguridad

- No mostrar credenciales.
- No leer ni imprimir `~/.openclaw/secrets/alatina-wp.env`.
- No usar status publish.
- No modificar PHP, CSS, JS ni plantillas desde Telegram.
- No hacer commit, push ni deploy sin confirmación explícita.
- Si falta título o texto, pedir corrección.
- Si la noticia no trae fotografía, advertirlo antes de crear el borrador.
- Si hay imagen adjunta, no subir media ni llamar `create-draft-with-media.sh` hasta recibir exactamente `crear borrador con imagen`.
- Si Jean elige `crear borrador sin imagen`, crear el borrador por la ruta sin imagen y no subir la fotografía a WordPress Media.
- Si la foto incluye estudiantes, apoderados, funcionarios o personas reconocibles, advertir que debe existir autorización antes de publicar.
- Si la imagen contiene datos sensibles, documentos, RUT, teléfonos, direcciones u otra información privada, advertirlo y no recomendar publicación sin revisión.

## Wrappers oficiales de Telegram

Usar solo:
- `scripts/wordpress/telegram-create-draft-no-media.sh`
- `scripts/wordpress/telegram-create-draft-with-media.sh`

OpenClaw no debe llamar directamente desde una confirmación de Telegram a:
- `create-draft.sh`
- `create-draft-from-stdin.sh`
- `create-draft-from-telegram-message.sh`
- `upload-media.sh`
- `create-draft-with-media.sh`

## Flujo validado con fotografía

Ya existe una prueba técnica validada para crear borradores de noticia usando una fotografía recibida desde Telegram.

Flujo validado:

1. Jean envía una fotografía al bot de Telegram.
2. OpenClaw recibe e interpreta la imagen.
3. OpenClaw guarda la imagen localmente en `~/.openclaw/media/inbound/`.
4. El script local sube la imagen a WordPress Media.
5. WordPress entrega un Media ID.
6. El script crea un borrador de noticia.
7. El borrador queda con categoría real.
8. El borrador queda con imagen destacada.
9. Nunca se publica directamente.

Script integrador validado:

`/home/srv-openclaw/.openclaw/workspace/repos/alatina/scripts/wordpress/create-draft-with-media.sh`

Última prueba validada:

- Archivo local: `/home/srv-openclaw/.openclaw/media/inbound/file_24---4e581d8d-12a7-4400-a6b5-8b3fcfb9ea6e.jpg`
- Media ID: 211
- Post ID: 212
- Estado: draft
- Categoría: Comunicados
- Imagen destacada: Media ID 211
