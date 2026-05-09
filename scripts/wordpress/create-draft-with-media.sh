#!/usr/bin/env bash
set -euo pipefail

if [ "${ALATINA_WP_DRAFT_GUARD:-}" != "telegram-con-imagen" ]; then
  echo "ERROR: este flujo requiere ALATINA_WP_DRAFT_GUARD=telegram-con-imagen" >&2
  exit 42
fi

IMAGE_FILE="${1:-}"
TITLE="${2:-}"
CONTENT="${3:-}"
EXCERPT="${4:-}"
CATEGORY="${5:-Comunicados}"

if [[ -z "$IMAGE_FILE" || -z "$TITLE" || -z "$CONTENT" ]]; then
  echo "Uso:"
  echo "  scripts/wordpress/create-draft-with-media.sh imagen.jpg \"Título\" \"Contenido\" \"Extracto opcional\" \"Categoría opcional\""
  exit 2
fi

if [[ ! -f "$IMAGE_FILE" ]]; then
  echo "ERROR: No existe la imagen: $IMAGE_FILE" >&2
  exit 1
fi

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
UPLOAD_MEDIA="$SCRIPT_DIR/upload-media.sh"
CREATE_DRAFT="$SCRIPT_DIR/create-draft.sh"

if [[ ! -x "$UPLOAD_MEDIA" ]]; then
  echo "ERROR: No existe o no es ejecutable: $UPLOAD_MEDIA" >&2
  exit 1
fi

if [[ ! -x "$CREATE_DRAFT" ]]; then
  echo "ERROR: No existe o no es ejecutable: $CREATE_DRAFT" >&2
  exit 1
fi

TMP_UPLOAD_OUTPUT="$(mktemp)"

cleanup() {
  rm -f "$TMP_UPLOAD_OUTPUT"
}
trap cleanup EXIT

echo "Subiendo imagen a WordPress Media..."

"$UPLOAD_MEDIA" \
  "$IMAGE_FILE" \
  "$TITLE" \
  "$TITLE" | tee "$TMP_UPLOAD_OUTPUT"

MEDIA_ID="$(awk '/^ID:/ {print $2; exit}' "$TMP_UPLOAD_OUTPUT")"

if [[ -z "$MEDIA_ID" || ! "$MEDIA_ID" =~ ^[0-9]+$ ]]; then
  echo "ERROR: No se pudo obtener un ID de imagen válido desde la subida." >&2
  exit 1
fi

echo ""
echo "Imagen subida correctamente."
echo "Media ID: $MEDIA_ID"

echo ""
echo "Creando borrador con imagen destacada..."

"$CREATE_DRAFT" \
  "$TITLE" \
  "$CONTENT" \
  "$EXCERPT" \
  "$CATEGORY" \
  "$MEDIA_ID"
