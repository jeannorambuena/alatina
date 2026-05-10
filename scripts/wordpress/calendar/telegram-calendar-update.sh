#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
TMP_INPUT="$(mktemp)"
TMP_JSON="$(mktemp)"
cleanup() {
  rm -f "$TMP_INPUT" "$TMP_JSON"
}
trap cleanup EXIT

cat > "$TMP_INPUT"
if [ ! -s "$TMP_INPUT" ]; then
  echo "ERROR: no se recibió entrada para modificar actividad." >&2
  exit 2
fi

python3 "$SCRIPT_DIR/parse-telegram-calendar.py" "$TMP_INPUT" > "$TMP_JSON"
export ALATINA_CALENDAR_GUARD="telegram-calendar-update"
exec "$SCRIPT_DIR/update-calendar-event.sh" "$TMP_JSON"
