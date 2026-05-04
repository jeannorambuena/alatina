#!/usr/bin/env python3
import json
import sys
from pathlib import Path

def fail(msg):
    print(json.dumps({"ok": False, "error": msg}, ensure_ascii=False, indent=2))
    sys.exit(1)

if len(sys.argv) != 2:
    fail("Uso: scripts/wordpress/parse-telegram-news.py archivo.txt")

path = Path(sys.argv[1])
if not path.exists():
    fail(f"No existe el archivo: {path}")

text = path.read_text(encoding="utf-8").strip()

if not text.startswith("NUEVA NOTICIA BORRADOR:"):
    fail("El mensaje no comienza con NUEVA NOTICIA BORRADOR:")

if "Texto:" not in text:
    fail("Falta la sección Texto:")

header_part, body_part = text.split("Texto:", 1)

body = body_part.replace("FIN", "").strip()

title = ""
category = ""
excerpt = ""

for line in header_part.splitlines():
    line = line.strip()
    if line.lower().startswith("título:") or line.lower().startswith("titulo:"):
        title = line.split(":", 1)[1].strip()
    elif line.lower().startswith("categoría:") or line.lower().startswith("categoria:"):
        category = line.split(":", 1)[1].strip()
    elif line.lower().startswith("extracto:"):
        excerpt = line.split(":", 1)[1].strip()

if not title:
    fail("Falta Título")
if not body:
    fail("Falta contenido en Texto")

result = {
    "ok": True,
    "title": title,
    "category": category or "Sin categoría",
    "excerpt": excerpt or body[:160],
    "content": body
}

print(json.dumps(result, ensure_ascii=False, indent=2))
