#!/usr/bin/env bash
set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

export ALATINA_WP_DRAFT_GUARD="telegram-con-imagen"

exec "$SCRIPT_DIR/create-draft-with-media.sh" "$@"
