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
