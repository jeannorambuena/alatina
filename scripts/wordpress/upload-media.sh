#!/usr/bin/env bash
set -euo pipefail

SECRET_FILE="${ALATINA_WP_SECRET_FILE:-$HOME/.openclaw/secrets/alatina-wp.env}"

if [[ ! -f "$SECRET_FILE" ]]; then
  echo "ERROR: No existe el archivo de credenciales: $SECRET_FILE" >&2
  exit 1
fi

source "$SECRET_FILE"

: "${ALATINA_WP_URL:?Falta ALATINA_WP_URL}"
: "${ALATINA_WP_USER:?Falta ALATINA_WP_USER}"
: "${ALATINA_WP_APP_PASSWORD:?Falta ALATINA_WP_APP_PASSWORD}"

IMAGE_FILE="${1:-}"
TITLE="${2:-}"
ALT_TEXT="${3:-}"

if [[ -z "$IMAGE_FILE" ]]; then
  echo "Uso:"
  echo "  scripts/wordpress/upload-media.sh ruta/imagen.jpg \"Título opcional\" \"Texto alternativo opcional\""
  exit 2
fi

if [[ ! -f "$IMAGE_FILE" ]]; then
  echo "ERROR: No existe la imagen: $IMAGE_FILE" >&2
  exit 1
fi

if ! command -v file >/dev/null 2>&1; then
  echo "ERROR: falta el comando 'file' para detectar el tipo MIME." >&2
  exit 1
fi

MIME_TYPE="$(file --mime-type -b "$IMAGE_FILE")"
BASENAME="$(basename "$IMAGE_FILE")"

case "$MIME_TYPE" in
  image/jpeg|image/png|image/webp|image/gif)
    ;;
  *)
    echo "ERROR: tipo de archivo no permitido: $MIME_TYPE" >&2
    echo "Permitidos: image/jpeg, image/png, image/webp, image/gif" >&2
    exit 1
    ;;
esac

TMP_RESPONSE="$(mktemp)"

cleanup() {
  rm -f "$TMP_RESPONSE"
}
trap cleanup EXIT

HTTP_CODE="$(
  curl -sS \
    -u "$ALATINA_WP_USER:$ALATINA_WP_APP_PASSWORD" \
    -H "Content-Disposition: attachment; filename=\"$BASENAME\"" \
    -H "Content-Type: $MIME_TYPE" \
    --data-binary @"$IMAGE_FILE" \
    -X POST "$ALATINA_WP_URL/wp-json/wp/v2/media" \
    -o "$TMP_RESPONSE" \
    -w "%{http_code}"
)"

echo "HTTP: $HTTP_CODE"

if [[ "$HTTP_CODE" != "201" ]]; then
  echo "ERROR: WordPress no subió la imagen."
  python3 -m json.tool "$TMP_RESPONSE" 2>/dev/null || cat "$TMP_RESPONSE"
  exit 1
fi

MEDIA_ID="$(python3 - "$TMP_RESPONSE" <<'PY'
import json, sys
data = json.load(open(sys.argv[1], encoding="utf-8"))
print(data.get("id", ""))
PY
)"

if [[ -n "$TITLE" || -n "$ALT_TEXT" ]]; then
  TMP_META="$(mktemp)"
  TMP_META_RESPONSE="$(mktemp)"

  python3 - "$TITLE" "$ALT_TEXT" > "$TMP_META" <<'PY'
import json, sys
title = sys.argv[1]
alt = sys.argv[2]
payload = {}
if title:
    payload["title"] = title
if alt:
    payload["alt_text"] = alt
print(json.dumps(payload, ensure_ascii=False))
PY

  curl -sS \
    -u "$ALATINA_WP_USER:$ALATINA_WP_APP_PASSWORD" \
    -H "Content-Type: application/json" \
    -X POST "$ALATINA_WP_URL/wp-json/wp/v2/media/$MEDIA_ID" \
    --data @"$TMP_META" \
    -o "$TMP_META_RESPONSE" \
    -w "Meta HTTP: %{http_code}\n"

  rm -f "$TMP_META" "$TMP_META_RESPONSE"
fi

python3 - "$TMP_RESPONSE" <<'PY'
import json
import sys

with open(sys.argv[1], "r", encoding="utf-8") as f:
    data = json.load(f)

print(f"ID: {data.get('id')}")
print(f"Estado: {data.get('status')}")
print(f"Tipo MIME: {data.get('mime_type')}")
print(f"Título: {data.get('title', {}).get('rendered')}")
print(f"URL: {data.get('source_url')}")
PY
