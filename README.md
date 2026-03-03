# alatina (WordPress)

Repositorio listo para levantar el sitio **alatina** en local con Docker, usando el contenido actual de `wp-content/`.

## Qué incluye

- `wp-content/`: plugins, temas y traducciones del sitio.
- `docker-compose.yml`: stack local con WordPress + MySQL.
- `scripts/import-db.sh`: script para importar un dump SQL existente.

## Requisitos

- Docker + Docker Compose v2.

## Inicio rápido

1. Copia variables de entorno:

   ```bash
   cp .env.example .env
   ```

2. Levanta los servicios:

   ```bash
   docker compose up -d
   ```

3. Abre el sitio en:

   - Frontend: `http://localhost:8080`
   - Admin: `http://localhost:8080/wp-admin`

> Si no importas base de datos, WordPress mostrará el instalador inicial.

## Importar base de datos existente

Si tienes tu respaldo SQL (por ejemplo `db/wp_alatina_2026-01-19.sql`):

```bash
scripts/import-db.sh db/wp_alatina_2026-01-19.sql
```

Luego reinicia WordPress para limpiar caché:

```bash
docker compose restart wordpress
```

## Comandos útiles

- Ver logs:

  ```bash
  docker compose logs -f wordpress
  ```

- Parar entorno:

  ```bash
  docker compose down
  ```

- Parar y eliminar base local:

  ```bash
  docker compose down -v
  ```

## Notas

- El volumen `db_data` guarda la base de datos local entre reinicios.
- `wp-content/` está montado directamente, así que cualquier cambio queda versionable en este repo.
- Si migras desde otra URL, ajusta `siteurl` y `home` en `wp_options`.
