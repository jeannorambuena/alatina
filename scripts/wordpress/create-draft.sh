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
CATEGORY="${4:-}"
FEATURED_MEDIA_ID="${5:-}"

if [[ -z "$TITLE" || -z "$CONTENT" ]]; then
  echo "Uso:"
  echo "  scripts/wordpress/create-draft.sh \"Título\" \"Contenido\" \"Extracto opcional\" \"Categoría opcional\" \"ID imagen destacada opcional\""
  exit 2
fi

if [[ -n "$FEATURED_MEDIA_ID" && ! "$FEATURED_MEDIA_ID" =~ ^[0-9]+$ ]]; then
  echo "ERROR: FEATURED_MEDIA_ID debe ser numérico. Valor recibido: $FEATURED_MEDIA_ID" >&2
  exit 2
fi

TMP_PAYLOAD="$(mktemp)"
TMP_RESPONSE="$(mktemp)"
TMP_CATEGORIES="$(mktemp)"

cleanup() {
  rm -f "$TMP_PAYLOAD" "$TMP_RESPONSE" "$TMP_CATEGORIES"
}
trap cleanup EXIT

CATEGORY_ID=""

if [[ -n "${CATEGORY// }" ]]; then
  ENCODED_CATEGORY="$(python3 - "$CATEGORY" <<'PY'
import sys
from urllib.parse import quote
print(quote(sys.argv[1]))
PY
)"

  curl -sS \
    -u "$ALATINA_WP_USER:$ALATINA_WP_APP_PASSWORD" \
    "$ALATINA_WP_URL/wp-json/wp/v2/categories?search=$ENCODED_CATEGORY&per_page=100" \
    -o "$TMP_CATEGORIES"

  CATEGORY_ID="$(python3 - "$TMP_CATEGORIES" "$CATEGORY" <<'PY'
import json
import re
import sys
import unicodedata

def norm(value):
    value = unicodedata.normalize("NFKD", value)
    value = value.encode("ascii", "ignore").decode("ascii")
    value = value.lower()
    value = re.sub(r"[^a-z0-9]+", "-", value)
    return value.strip("-")

with open(sys.argv[1], "r", encoding="utf-8") as f:
    categories = json.load(f)

target = sys.argv[2].strip()
target_norm = norm(target)

for cat in categories:
    name = cat.get("name", "")
    slug = cat.get("slug", "")
    if norm(name) == target_norm or slug == target_norm:
        print(cat.get("id", ""))
        break
PY
)"

  if [[ -n "$CATEGORY_ID" ]]; then
    echo "Categoría asignada: $CATEGORY (ID: $CATEGORY_ID)"
  else
    echo "Aviso: no se encontró la categoría '$CATEGORY'. El borrador quedará sin categoría específica."
  fi
fi

python3 - "$TITLE" "$CONTENT" "$EXCERPT" "$CATEGORY_ID" "$FEATURED_MEDIA_ID" > "$TMP_PAYLOAD" <<'PY'
import json
import sys
import html

title = sys.argv[1]
content = sys.argv[2]
excerpt = sys.argv[3] if len(sys.argv) > 3 else ""
category_id = sys.argv[4] if len(sys.argv) > 4 else ""
featured_media_id = sys.argv[5] if len(sys.argv) > 5 else ""

paragraphs = [p.strip() for p in content.splitlines() if p.strip()]
html_content = "\n".join(f"<p>{html.escape(p)}</p>" for p in paragraphs)

payload = {
    "title": title,
    "content": html_content,
    "excerpt": excerpt or content[:160],
    "status": "draft"
}

if category_id:
    payload["categories"] = [int(category_id)]

if featured_media_id:
    payload["featured_media"] = int(featured_media_id)

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

categories = data.get("categories", [])
featured_media = data.get("featured_media", 0)

print(f"ID: {data.get('id')}")
print(f"Estado: {data.get('status')}")
print(f"Título: {data.get('title', {}).get('rendered')}")
print(f"Categorías: {categories}")
print(f"Imagen destacada: {featured_media}")
print(f"Link: {data.get('link')}")
PY
