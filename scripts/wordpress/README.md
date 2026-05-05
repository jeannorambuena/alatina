# Flujo Telegram a WordPress para alatina.cl

Este módulo permite crear borradores de noticias en WordPress desde mensajes enviados por Telegram a OpenClaw.

## Estado actual

Funciona:

- Telegram envía texto estructurado.
- OpenClaw interpreta la noticia.
- OpenClaw pide confirmación.
- WordPress crea un borrador.
- Se asigna categoría real si existe.
- No se publica directamente.

Última prueba validada:

- Borrador ID: 204
- Estado: draft
- Categoría: Comunicados
- Categoría WordPress: ID 14

## Regla principal

Telegram solo debe crear borradores.

No debe publicar directamente.

## Regla editorial

En alatina.cl, una noticia normalmente debe llevar fotografía.

Estado actual:

- El flujo procesa texto y categoría.
- La fotografía todavía no está implementada.

Objetivo siguiente:

- Recibir una foto desde Telegram.
- Subirla a WordPress Media.
- Asignarla como imagen destacada del borrador.

Si una noticia no trae fotografía, OpenClaw debe advertirlo antes de crear el borrador.

## Formato actual

NUEVA NOTICIA BORRADOR:
Título: Título de la noticia
Categoría: Comunicados
Extracto: Resumen breve.

Texto:
Contenido principal de la noticia.

FIN

## Confirmaciones permitidas

- crear borrador
- editar titulo: ...
- editar categoria: ...
- editar extracto: ...
- editar texto: ...
- descartar

No ofrecer publicar desde Telegram.

## Scripts

- create-draft.sh
- parse-telegram-news.py
- create-draft-from-telegram-message.sh
- create-draft-from-stdin.sh

## Credenciales

Las credenciales están fuera de Git en:

~/.openclaw/secrets/alatina-wp.env

No imprimir, copiar ni subir ese archivo.

## Próximas fases

1. Fotografía desde Telegram como imagen destacada.
2. Eventos de calendario desde Telegram.
3. Transparencia CGP: ingresos, egresos, boletas y saldos.
4. Galería de fotos.
5. Apoyo para redes sociales.


## Flujo con fotografía validado

Ya existe un flujo funcional para crear borradores con imagen destacada usando una imagen local en Nitro.

Flujo validado:

1. Imagen local en Nitro.
2. Subida a WordPress Media.
3. Obtención del Media ID.
4. Creación de borrador WordPress.
5. Asignación de categoría real.
6. Asignación de imagen destacada.

Última prueba validada:

- Media ID: 209
- Post ID: 210
- Estado: draft
- Categoría: Comunicados
- Categoría WordPress: ID 14
- Imagen destacada: Media ID 209

Script integrador:

scripts/wordpress/create-draft-with-media.sh

Uso manual:

scripts/wordpress/create-draft-with-media.sh \
  /ruta/imagen.jpg \
  "Título de la noticia" \
  "Contenido principal de la noticia." \
  "Extracto breve." \
  "Comunicados"

## Posición editorial de la fotografía

La fotografía principal debe usarse como imagen destacada.

Esto permite que el tema la muestre:

- Arriba del contenido de la noticia.
- En tarjetas o listados de noticias.
- En portada o secciones destacadas si el tema lo usa.

No se recomienda insertar la imagen principal manualmente dentro del texto, salvo que sea una segunda imagen o una galería.

## Pendiente para Telegram con fotografía

Todavía falta conectar la foto enviada directamente por Telegram.

La parte WordPress ya está lista.

Pendiente técnico:

1. Detectar imagen enviada por Telegram.
2. Descargar imagen desde Telegram hacia Nitro.
3. Pasar la ruta local al script integrador.
4. Crear borrador con imagen destacada.
5. Mantener confirmación previa antes de crear.


## Telegram con fotografía real validado

Ya se validó que una fotografía enviada desde Telegram puede usarse para crear un borrador en WordPress con imagen destacada.

Flujo validado:

1. Jean envía una fotografía al bot de Telegram.
2. OpenClaw recibe e interpreta la imagen.
3. OpenClaw guarda la imagen localmente en Nitro.
4. La imagen queda disponible en `~/.openclaw/media/inbound/`.
5. El script integrador sube la imagen a WordPress Media.
6. WordPress entrega un Media ID.
7. El script crea un borrador.
8. El borrador queda con categoría real.
9. El borrador queda con imagen destacada.

Última prueba validada:

- Archivo local:
  `/home/srv-openclaw/.openclaw/media/inbound/file_24---4e581d8d-12a7-4400-a6b5-8b3fcfb9ea6e.jpg`
- Media ID: 211
- Post ID: 212
- Estado: draft
- Categoría: Comunicados
- Categoría WordPress: ID 14
- Imagen destacada: Media ID 211
- Tipo MIME: image/jpeg

Comando validado:

scripts/wordpress/create-draft-with-media.sh \
  /home/srv-openclaw/.openclaw/media/inbound/file_24---4e581d8d-12a7-4400-a6b5-8b3fcfb9ea6e.jpg \
  "Prueba noticia usando foto recibida por Telegram" \
  "Contenido de prueba." \
  "Extracto de prueba." \
  "Comunicados"

## Regla de seguridad para fotografías escolares

Antes de usar fotos reales en noticias escolares, revisar:

- Que la imagen sea apropiada para publicación institucional.
- Que exista autorización para publicar imágenes de estudiantes, apoderados o funcionarios cuando corresponda.
- Que no exponga información sensible, documentos privados, direcciones, teléfonos, RUT u otros datos personales.
- Que la noticia quede siempre como borrador para revisión antes de publicación.

El flujo desde Telegram debe seguir creando solo borradores, no publicaciones directas.


## Flujo oficial Telegram con foto y confirmación validado

Ya se validó el flujo completo desde Telegram usando foto y texto estructurado en el mismo mensaje.

Flujo validado:

1. Jean envía una foto por Telegram con el formato `NUEVA NOTICIA BORRADOR:`.
2. OpenClaw interpreta título, categoría, extracto y texto.
3. OpenClaw detecta imagen adjunta.
4. OpenClaw ofrece opciones seguras:
   - crear borrador con imagen
   - crear borrador sin imagen
   - cambiar foto
   - editar titulo
   - editar categoria
   - editar extracto
   - editar texto
   - descartar
5. Jean confirma `crear borrador con imagen`.
6. OpenClaw sube la imagen a WordPress Media.
7. OpenClaw crea un post en estado `draft`.
8. WordPress asigna categoría real `Comunicados`.
9. WordPress asigna la imagen como `featured_media`.
10. No se publica directamente.

Última prueba final validada:

- Post ID: 214
- Estado: draft
- Título: Prueba definitiva opciones foto
- Categoría: Comunicados
- Categoría WordPress: ID 14
- Media ID: 213
- Tipo MIME: image/jpeg
- Imagen destacada: Media ID 213
- URL imagen: https://alatina.cl/wp-content/uploads/2026/05/file_28-83d006e5-9cba-4737-9711-5b75e36a5a59.jpg

Regla final:

- Si hay foto, no usar la opción simple `crear borrador`.
- Si hay foto, ofrecer `crear borrador con imagen` y `crear borrador sin imagen`.
- Si no hay foto, se permite `crear borrador`.
- Nunca ofrecer `publicar` desde Telegram.
