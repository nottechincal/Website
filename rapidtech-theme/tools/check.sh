#!/bin/bash
# Lint and test the theme.
#
#   ./rapidtech-theme/tools/check.sh
#
# Same checks the deploy workflow gates on, so a green run here means the
# deploy will not be blocked.
set -uo pipefail

THEME="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
ROOT="$(dirname "$THEME")"
fail=0

echo "==> PHP syntax"
errors=0
while IFS= read -r -d '' f; do
    if ! php -l "$f" > /dev/null 2>&1; then
        echo "    SYNTAX ERROR: ${f#$ROOT/}"
        php -l "$f" 2>&1 | head -2 | sed 's/^/      /'
        errors=$((errors + 1))
    fi
done < <(find "$THEME" -name '*.php' -print0)
count=$(find "$THEME" -name '*.php' | wc -l)
if [ "$errors" -eq 0 ]; then
    echo "    ok — $count files"
else
    echo "    $errors file(s) failed"
    fail=1
fi

echo "==> Routes"
# Every sitemap URL must map to exactly one rewrite rule. When this breaks the
# page silently falls through to the homepage instead of erroring, which is the
# failure mode that had 74 URLs serving identical content.
if php "$THEME/tools/test-routes.php" > /tmp/rt-routes.log 2>&1; then
    grep -E "routes registered|sitemap URLs matched" /tmp/rt-routes.log | sed 's/^/    /'
    echo "    ok"
else
    sed 's/^/    /' /tmp/rt-routes.log
    fail=1
fi

echo "==> Sitemap is current"
before=$(md5sum "$ROOT/deploy/webroot/sitemap.xml" 2>/dev/null | cut -d' ' -f1)
php "$THEME/tools/build-sitemap.php" > /dev/null 2>&1
after=$(md5sum "$ROOT/deploy/webroot/sitemap.xml" 2>/dev/null | cut -d' ' -f1)
if [ "$before" = "$after" ]; then
    echo "    ok — $(grep -c '<loc>' "$ROOT/deploy/webroot/sitemap.xml") URLs"
else
    echo "    REGENERATED — commit deploy/webroot/sitemap.xml"
    fail=1
fi

echo "==> Generated files match their source"
# inc/locations.php and the suburb templates are generated. If someone edits
# them by hand the next build silently reverts it.
if command -v python3 > /dev/null; then
    gen_before=$(md5sum "$THEME/inc/locations.php" | cut -d' ' -f1)
    python3 "$THEME/tools/build-locations.py" > /dev/null 2>&1
    gen_after=$(md5sum "$THEME/inc/locations.php" | cut -d' ' -f1)
    if [ "$gen_before" = "$gen_after" ]; then
        echo "    ok — inc/locations.php matches tools/build-locations.py"
    else
        echo "    DRIFT — inc/locations.php was edited by hand; edit tools/build-locations.py instead"
        fail=1
    fi
else
    echo "    skipped (no python3)"
fi

echo
if [ "$fail" -eq 0 ]; then
    echo "PASS"
else
    echo "FAIL"
fi
exit $fail
