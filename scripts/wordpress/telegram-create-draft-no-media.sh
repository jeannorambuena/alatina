#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

export ALATINA_WP_DRAFT_GUARD="telegram-sin-imagen"

exec "$SCRIPT_DIR/create-draft-from-stdin.sh"
