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
