# alatina (WordPress) - snapshot local

Este repositorio contiene el estado del proyecto WordPress en local:

- wp-content/ (temas, plugins, uploads)
- db/ (export SQL de la base de datos)

## Entorno local

- WAMP
- URL: http://localhost/alatina/
- Admin: http://localhost/alatina/wp-admin/
- Base de datos: wp_alatina

## Restauración (resumen)

1. Copiar wp-content/ al WordPress destino.
2. Importar db/wp_alatina_2026-01-19.sql en MySQL.
3. Revisar siteurl/home en la tabla wp_options si cambia la URL.
