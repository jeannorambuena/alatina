#!/usr/bin/env bash
set -euo pipefail

if [ "${ALATINA_CALENDAR_GUARD:-}" != "telegram-calendar-update" ]; then
  echo "ERROR: este flujo requiere ALATINA_CALENDAR_GUARD=telegram-calendar-update" >&2
  exit 42
fi

PAYLOAD_FILE="${1:-}"
if [ -z "$PAYLOAD_FILE" ] || [ ! -f "$PAYLOAD_FILE" ]; then
  echo "Uso: scripts/wordpress/calendar/update-calendar-event.sh payload.json" >&2
  exit 2
fi

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
source "$SCRIPT_DIR/load-wp-env.sh"
exec python3 "$SCRIPT_DIR/calendar-rest.py" update "$PAYLOAD_FILE"
