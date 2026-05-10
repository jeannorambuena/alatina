#!/usr/bin/env bash
set -euo pipefail

WP_ENV_FILE="${ALATINA_WP_ENV_FILE:-$HOME/.openclaw/secrets/alatina-wp.env}"

if [ ! -f "$WP_ENV_FILE" ]; then
 echo "ERROR: no existe archivo de credenciales WordPress esperado." >&2
 exit 43
fi

set -a
# shellcheck disable=SC1090
source "$WP_ENV_FILE"
set +a

missing=0

for var in ALATINA_WP_URL ALATINA_WP_USER ALATINA_WP_APP_PASSWORD; do
 if [ -z "${!var:-}" ]; then
  echo "ERROR: falta variable requerida: $var" >&2
  missing=1
 fi
done

if [ "$missing" -ne 0 ]; then
 echo "ERROR: configuración WordPress incompleta para Calendar Publisher." >&2
 exit 43
fi

export ALATINA_WP_URL
export ALATINA_WP_USER
export ALATINA_WP_APP_PASSWORD
