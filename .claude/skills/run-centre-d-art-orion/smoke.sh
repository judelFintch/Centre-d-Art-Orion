#!/usr/bin/env bash
# Smoke script for Centre d'Art Orion — Laravel + Vite dev stack
# Run from repo root: bash .claude/skills/run-centre-d-art-orion/smoke.sh
set -e

BASE_URL="${BASE_URL:-http://localhost:8000}"
PASS=0
FAIL=0

check() {
  local label="$1"
  local url="$2"
  local expected="${3:-200}"
  local code
  code=$(curl -s -o /dev/null -w "%{http_code}" "$url")
  if [ "$code" = "$expected" ]; then
    echo "  OK  $label ($code)"
    PASS=$((PASS + 1))
  else
    echo "  FAIL $label — expected $expected, got $code"
    FAIL=$((FAIL + 1))
  fi
}

# ── 1. Ensure PHP artisan serve is running ──────────────────────────────────
if ! curl -sf "$BASE_URL/" > /dev/null 2>&1; then
  echo "Starting PHP artisan serve on port 8000..."
  php artisan serve --port=8000 &> /tmp/laravel.log &
  ARTISAN_PID=$!
  echo "$ARTISAN_PID" > /tmp/laravel.pid
  for i in {1..20}; do
    curl -sf "$BASE_URL/" > /dev/null 2>&1 && break
    sleep 0.5
  done
  echo "Laravel server started (PID $ARTISAN_PID). Logs: /tmp/laravel.log"
else
  echo "Laravel server already running at $BASE_URL"
fi

# ── 2. Ensure Vite dev server is running ───────────────────────────────────
if ! curl -sf "http://localhost:5173/@vite/client" > /dev/null 2>&1; then
  echo "Starting Vite dev server..."
  npm run dev &> /tmp/vite.log &
  VITE_PID=$!
  echo "$VITE_PID" > /tmp/vite.pid
  for i in {1..30}; do
    curl -sf "http://localhost:5173/@vite/client" > /dev/null 2>&1 && break
    sleep 0.5
  done
  echo "Vite server started (PID $VITE_PID). Logs: /tmp/vite.log"
else
  echo "Vite dev server already running at http://localhost:5173"
fi

echo ""
echo "── Route smoke tests ─────────────────────────────────────────────────"

check "Home page"         "$BASE_URL/"
check "À propos"          "$BASE_URL/a-propos"
check "Services"          "$BASE_URL/services"
check "Formations index"  "$BASE_URL/formations"
check "Galerie"           "$BASE_URL/galerie"
check "Événements"        "$BASE_URL/evenements"
check "Équipe"            "$BASE_URL/equipe"
check "Contact"           "$BASE_URL/contact"
check "Admin login"       "$BASE_URL/admin/login"
check "Admin redirect"    "$BASE_URL/admin" "302"

echo ""

# ── 3. Content sanity check ────────────────────────────────────────────────
TITLE=$(curl -s "$BASE_URL/" | grep -o '<title>[^<]*</title>' | head -1)
echo "Homepage title: $TITLE"
if echo "$TITLE" | grep -q "Orion"; then
  echo "  OK  Title contains 'Orion'"
  PASS=$((PASS + 1))
else
  echo "  FAIL Title missing 'Orion'"
  FAIL=$((FAIL + 1))
fi

# ── 4. Optional chromium-cli visual verification ───────────────────────────
if command -v chromium-cli &>/dev/null; then
  echo ""
  echo "── Visual screenshot (chromium-cli) ──────────────────────────────────"
  mkdir -p /tmp/orion-shots
  chromium-cli --session orion --screenshots-dir /tmp/orion-shots <<'EOF'
nav http://localhost:8000
wait-for text=Orion
screenshot
nav http://localhost:8000/formations
wait-for css=main
screenshot
nav http://localhost:8000/contact
wait-for css=form
screenshot
console --errors
EOF
  echo "Screenshots → /tmp/orion-shots/"
fi

# ── Summary ────────────────────────────────────────────────────────────────
echo ""
echo "Results: $PASS passed, $FAIL failed"
[ "$FAIL" -eq 0 ] || exit 1
