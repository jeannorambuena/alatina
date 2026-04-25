#!/usr/bin/env bash
set -euo pipefail

DB_DUMP_PATH="${1:-db/wp_alatina.sql}"

if [[ ! -f "$DB_DUMP_PATH" ]]; then
  echo "No se encontró el dump en '$DB_DUMP_PATH'."
  echo "Uso: scripts/import-db.sh <ruta/al/archivo.sql>"
  exit 1
fi

if [[ ! -f .env ]]; then
  echo "Falta el archivo .env. Cópialo desde .env.example y ajusta credenciales."
  exit 1
fi

# shellcheck disable=SC1091
source .env

echo "Importando $DB_DUMP_PATH en la base de datos ${WORDPRESS_DB_NAME}..."
docker compose exec -T db sh -c \
  "mysql -u\"$WORDPRESS_DB_USER\" -p\"$WORDPRESS_DB_PASSWORD\" \"$WORDPRESS_DB_NAME\"" \
  < "$DB_DUMP_PATH"

echo "Importación finalizada."
