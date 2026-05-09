# Flujo Telegram a WordPress para alatina.cl

Este módulo permite crear borradores de noticias en WordPress desde mensajes enviados por Telegram a OpenClaw.

## Estado actual

Funciona y está validado:

- Telegram envía texto estructurado.
- OpenClaw interpreta la noticia.
- OpenClaw pide confirmación.
- WordPress crea un borrador.
- Se asigna categoría real si existe.
- El flujo sin imagen está validado.
- El flujo con imagen desde Telegram está validado.
- No se publica directamente.

Última prueba validada del flujo sin imagen:

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
- El flujo con fotografía está validado.
- Si una noticia no trae fotografía, OpenClaw debe advertirlo antes de crear el borrador.
- Todo debe quedar en estado borrador (`draft`).
- Nunca se publica desde Telegram.

## Formato actual

NUEVA NOTICIA BORRADOR:
Título: Título de la noticia
Categoría: Comunicados
Extracto: Resumen breve.

Texto:
Contenido principal de la noticia.

FIN

## Confirmaciones finales oficiales

- crear borrador sin imagen
- crear borrador con imagen
- descartar

## Confirmaciones prohibidas

- crear borrador
- confirmar borrador
- generar borrador

## Confirmaciones oficiales por contexto

Sin imagen:
- crear borrador sin imagen
- editar titulo: ...
- editar categoria: ...
- editar extracto: ...
- editar texto: ...
- descartar

Con imagen:
- crear borrador con imagen
- crear borrador sin imagen
- cambiar foto
- editar titulo: ...
- editar categoria: ...
- editar extracto: ...
- editar texto: ...
- descartar

Si Jean responde una de las frases prohibidas, OpenClaw debe responder:

"Confirmación incompleta. Debes elegir explícitamente:
- crear borrador sin imagen
- crear borrador con imagen
- descartar"

No ofrecer publicar desde Telegram.
Nunca publicar desde Telegram.

## Scripts

- create-draft.sh
- parse-telegram-news.py
- create-draft-from-telegram-message.sh
- create-draft-from-stdin.sh
- create-draft-with-media.sh
- telegram-create-draft-no-media.sh
- telegram-create-draft-with-media.sh

## Wrappers oficiales para Telegram

- scripts/wordpress/telegram-create-draft-no-media.sh
- scripts/wordpress/telegram-create-draft-with-media.sh

Regla:
OpenClaw no debe llamar directamente `create-draft.sh`, `create-draft-from-stdin.sh`, `create-draft-from-telegram-message.sh`, `upload-media.sh` ni `create-draft-with-media.sh` desde una confirmación de Telegram. Debe usar los wrappers.

## Guardas de ejecución

Para endurecer el flujo, los scripts de entrada exigen `ALATINA_WP_DRAFT_GUARD` explícito.

Valores permitidos:
- `telegram-sin-imagen`
- `telegram-con-imagen`
- `manual-ok`

Flujo sin imagen:

```bash
cat mensaje.txt | scripts/wordpress/telegram-create-draft-no-media.sh
```

Flujo con imagen:

```bash
scripts/wordpress/telegram-create-draft-with-media.sh \
  /ruta/imagen.jpg \
  "Título" \
  "Contenido" \
  "Extracto" \
  "Comunicados"
```

## Credenciales

Las credenciales están fuera de Git en:

~/.openclaw/secrets/alatina-wp.env

No imprimir, copiar ni subir ese archivo.

## Convención de pruebas

Usar este prefijo recomendado para pruebas controladas del flujo:

`[PRUEBA OPENCLAW]`

Ejemplos:

- `[PRUEBA OPENCLAW] Noticia sin imagen desde Telegram`
- `[PRUEBA OPENCLAW] Noticia con imagen desde Telegram`

## Próximas fases

1. Consolidar el baseline documental del flujo Telegram a WordPress.
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

```bash
ALATINA_WP_DRAFT_GUARD=telegram-con-imagen scripts/wordpress/create-draft-with-media.sh \
  /ruta/imagen.jpg \
  "Título de la noticia" \
  "Contenido principal de la noticia." \
  "Extracto breve." \
  "Comunicados"
```

## Posición editorial de la fotografía

La fotografía principal debe usarse como imagen destacada.

Esto permite que el tema la muestre:

- Arriba del contenido de la noticia.
- En tarjetas o listados de noticias.
- En portada o secciones destacadas si el tema lo usa.

No se recomienda insertar la imagen principal manualmente dentro del texto, salvo que sea una segunda imagen o una galería.

## Nota sobre Telegram con fotografía

La conexión de fotografía enviada desde Telegram ya fue validada de extremo a extremo.

La parte WordPress y la integración con imagen destacada ya están listas para este baseline.

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

```bash
ALATINA_WP_DRAFT_GUARD=telegram-con-imagen scripts/wordpress/create-draft-with-media.sh \
  /home/srv-openclaw/.openclaw/media/inbound/file_24---4e581d8d-12a7-4400-a6b5-8b3fcfb9ea6e.jpg \
  "Prueba noticia usando foto recibida por Telegram" \
  "Contenido de prueba." \
  "Extracto de prueba." \
  "Comunicados"
```

## Regla de seguridad para fotografías escolares

Antes de usar fotos reales en noticias escolares, revisar:

- Que la imagen sea apropiada para publicación institucional.
- Que exista autorización para publicar imágenes de estudiantes, apoderados o funcionarios cuando corresponda.
- Que no exponga información sensible, documentos privados, direcciones, teléfonos, RUT u otros datos personales.
- Que la noticia quede siempre como borrador para revisión antes de publicación.

El flujo desde Telegram debe seguir creando solo borradores, no publicaciones directas.
