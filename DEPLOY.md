# DEPLOY.md

## Flujo oficial del proyecto Alatina

### Origen de trabajo
- Nitro / OpenClaw = desarrollo y cambios técnicos
- GitHub = respaldo e historial del código
- Hostinger = producción

## Regla general
Todo cambio técnico debe seguir este orden:

1. Cambiar en Nitro/OpenClaw
2. Probar localmente
3. Hacer commit en la rama oficial
4. Hacer push a GitHub
5. Crear respaldo o referencia previa si aplica
6. Publicar en Hostinger
7. Verificar en producción
8. Crear tag de producción si el cambio quedó correcto

## Qué cambios van por WordPress admin
Estos cambios se pueden hacer directamente en WordPress:
- textos
- páginas
- entradas/noticias
- imágenes
- PDFs
- menús
- contenido institucional editable

## Qué cambios NO deben hacerse directo en Hostinger
Estos cambios deben hacerse en Nitro/OpenClaw:
- CSS
- JS
- templates PHP
- functions.php
- header/footer
- plugins propios
- cambios responsive
- ajustes técnicos del tema

## Rama oficial
- openclaw/alatina-v1

## Convención de tags
- prod-AAAA-MM-DD-NN

## Proceso resumido por cambio técnico
1. Definir el cambio
2. Aplicarlo en Nitro/OpenClaw
3. Validarlo localmente
4. Commit en español
5. Push a GitHub
6. Publicación controlada en Hostinger
7. Revisión manual de producción
8. Tag de producción

## Regla de seguridad
No usar Hostinger como editor de código principal, salvo emergencia real.

## Estado base publicado
- Tag inicial de referencia: prod-2026-04-24-01
