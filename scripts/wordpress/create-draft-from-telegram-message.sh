#!/usr/bin/env bash
set -euo pipefail

INPUT_FILE="${1:-}"

if [[ -z "$INPUT_FILE" ]]; then
  echo "Uso:"
  echo "  scripts/wordpress/create-draft-from-telegram-message.sh archivo-mensaje.txt"
  exit 2
fi

if [[ ! -f "$INPUT_FILE" ]]; then
  echo "ERROR: No existe el archivo: $INPUT_FILE" >&2
  exit 1
fi

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PARSER="$SCRIPT_DIR/parse-telegram-news.py"
CREATE_DRAFT="$SCRIPT_DIR/create-draft.sh"

TMP_PARSED="$(mktemp)"

cleanup() {
  rm -f "$TMP_PARSED"
}
trap cleanup EXIT

"$PARSER" "$INPUT_FILE" > "$TMP_PARSED"

python3 - "$TMP_PARSED" <<'PY'
import json
import sys

with open(sys.argv[1], "r", encoding="utf-8") as f:
    data = json.load(f)

if not data.get("ok"):
    print("ERROR:", data.get("error", "Mensaje inválido"))
    sys.exit(1)

print("Mensaje interpretado correctamente:")
print(f"Título: {data.get('title')}")
print(f"Categoría sugerida: {data.get('category')}")
print(f"Extracto: {data.get('excerpt')}")
PY

TITLE="$(python3 - "$TMP_PARSED" <<'PY'
import json, sys
data = json.load(open(sys.argv[1], encoding="utf-8"))
print(data["title"])
PY
)"

EXCERPT="$(python3 - "$TMP_PARSED" <<'PY'
import json, sys
data = json.load(open(sys.argv[1], encoding="utf-8"))
print(data["excerpt"])
PY
)"

CONTENT="$(python3 - "$TMP_PARSED" <<'PY'
import json, sys
data = json.load(open(sys.argv[1], encoding="utf-8"))
category = data.get("category") or "Sin categoría"
content = data.get("content") or ""
print(f"Categoría sugerida: {category}\n\n{content}")
PY
)"

echo ""
echo "Creando borrador en WordPress..."
"$CREATE_DRAFT" "$TITLE" "$CONTENT" "$EXCERPT"
