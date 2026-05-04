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

TITLE="${1:-}"
CONTENT="${2:-}"
EXCERPT="${3:-}"

if [[ -z "$TITLE" || -z "$CONTENT" ]]; then
  echo "Uso:"
  echo "  tools/wordpress/create-draft.sh \"Título\" \"Contenido\" \"Extracto opcional\""
  exit 2
fi

TMP_PAYLOAD="$(mktemp)"
TMP_RESPONSE="$(mktemp)"

cleanup() {
  rm -f "$TMP_PAYLOAD" "$TMP_RESPONSE"
}
trap cleanup EXIT

python3 - "$TITLE" "$CONTENT" "$EXCERPT" > "$TMP_PAYLOAD" <<'PY'
import json
import sys
import html

title = sys.argv[1]
content = sys.argv[2]
excerpt = sys.argv[3] if len(sys.argv) > 3 else ""

paragraphs = [p.strip() for p in content.splitlines() if p.strip()]
html_content = "\n".join(f"<p>{html.escape(p)}</p>" for p in paragraphs)

payload = {
    "title": title,
    "content": html_content,
    "excerpt": excerpt or content[:160],
    "status": "draft"
}

print(json.dumps(payload, ensure_ascii=False))
PY

HTTP_CODE="$(
  curl -sS \
    -u "$ALATINA_WP_USER:$ALATINA_WP_APP_PASSWORD" \
    -H "Content-Type: application/json" \
    -X POST "$ALATINA_WP_URL/wp-json/wp/v2/posts" \
    --data @"$TMP_PAYLOAD" \
    -o "$TMP_RESPONSE" \
    -w "%{http_code}"
)"

echo "HTTP: $HTTP_CODE"

if [[ "$HTTP_CODE" != "201" ]]; then
  echo "ERROR: WordPress no creó el borrador."
  python3 -m json.tool "$TMP_RESPONSE" 2>/dev/null || cat "$TMP_RESPONSE"
  exit 1
fi

python3 - "$TMP_RESPONSE" <<'PY'
import json
import sys

with open(sys.argv[1], "r", encoding="utf-8") as f:
    data = json.load(f)

print(f"ID: {data.get('id')}")
print(f"Estado: {data.get('status')}")
print(f"Título: {data.get('title', {}).get('rendered')}")
print(f"Link: {data.get('link')}")
PY
