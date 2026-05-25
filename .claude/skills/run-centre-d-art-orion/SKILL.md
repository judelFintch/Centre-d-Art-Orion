---
name: run-centre-d-art-orion
description: Build, run, start, test, screenshot, and drive the Centre d'Art Orion Laravel web app. Use when asked to start the app, run the dev server, verify a page renders, take a screenshot, or smoke-test routes.
---

Laravel 13 + Vite 8 site vitrine for Centre d'Art Orion. Driven via `.claude/skills/run-centre-d-art-orion/smoke.sh` (curl-based route checks + optional `chromium-cli` screenshots). Two background processes: `php artisan serve` (port 8000) and `npm run dev` (Vite, port 5173).

All paths below are relative to the repo root.

## Prerequisites

PHP 8.4, Node 22, Composer — already present on this machine. No additional system packages needed.

## Setup

One-time after clone:

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
php artisan migrate --seed
php artisan storage:link
```

The repo already has a database.sqlite and a populated `.env` — skip these on a machine where the project is already set up.

## Build

For production assets (not needed for dev):

```bash
npm run build
```

For development, Vite serves assets live from port 5173 (no explicit build step needed).

## Run (agent path)

The smoke script starts any server that isn't running, then hits every public route and checks HTTP status codes. It also validates page content and, if `chromium-cli` is available, takes screenshots.

```bash
bash .claude/skills/run-centre-d-art-orion/smoke.sh
```

Exit code `0` = all 11 checks passed. Non-zero = at least one route failed.

Logs land at `/tmp/laravel.log` and `/tmp/vite.log` (only written if the script had to start the servers).

If `chromium-cli` is available, screenshots are saved to `/tmp/orion-shots/` — one per page visited (home, formations, contact).

To stop servers the script started:

```bash
kill $(cat /tmp/laravel.pid) 2>/dev/null; kill $(cat /tmp/vite.pid) 2>/dev/null
```

### Drive individual routes with curl

```bash
# Check a route manually
curl -s -o /dev/null -w "%{http_code}" http://localhost:8000/formations

# Read a page's title
curl -s http://localhost:8000/ | grep -o '<title>[^<]*</title>'
```

### Visual interaction with chromium-cli (when available)

```bash
chromium-cli --session orion <<'EOF'
nav http://localhost:8000
wait-for text=Orion
screenshot
click a:has-text("Formations")
wait-for css=main
screenshot
console --errors
EOF
```

Screenshots → `chromium_cli/sessions/orion/screenshots/`.

## Run (human path)

```bash
php artisan serve &
npm run dev
# Open http://localhost:8000 in a browser. Ctrl-C to stop Vite; kill the background artisan process separately.
```

Or use the compound dev command (starts artisan + Vite + queue + log tail simultaneously):

```bash
npm run start
```

## Test

```bash
php artisan test
```

## Gotchas

- **Vite serves CSS/JS from port 5173.** If the Vite server is not running, pages load but have no styles. The smoke script starts Vite if it isn't already up.
- **Admin routes require auth.** `/admin` redirects to 302 (expected). `/admin/login` returns 200. The smoke script tests both behaviours.
- **SQLite database** is at `database/database.sqlite`. If you run `php artisan migrate:fresh --seed`, it resets all seeded data (formations, événements, équipe, galerie).
- **`npm run start`** uses `concurrently` to run artisan + queue + pail + Vite together. It never exits on its own — use it for human dev sessions, not agent scripts.

## Troubleshooting

- **Port 8000 already in use**: another artisan server is running — `pkill -f "artisan serve"` then retry.
- **Port 5173 already in use**: another Vite instance — `pkill -f "vite"` then retry.
- **`SQLSTATE[HY000]: unable to open database`**: `database/database.sqlite` is missing — run `php artisan migrate --seed` to create it.
- **CSS missing on all pages**: Vite dev server is not running — start it with `npm run dev &`.
