#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
CONNECTOR="$SCRIPT_DIR/create-draft-from-telegram-message.sh"

TMP_INPUT="$(mktemp)"

cleanup() {
  rm -f "$TMP_INPUT"
}
trap cleanup EXIT

cat > "$TMP_INPUT"

if [[ ! -s "$TMP_INPUT" ]]; then
  echo "ERROR: No se recibió texto por entrada estándar." >&2
  exit 2
fi

"$CONNECTOR" "$TMP_INPUT"
