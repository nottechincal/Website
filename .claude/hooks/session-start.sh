#!/bin/bash
# SessionStart hook — Rapid Tech Solutions website.
#
# Installs the tooling this repo's build and verification scripts need, so
# `rapidtech-theme/tools/check.sh` works the moment a session starts.
#
# The repo has no package manifest: it is plain PHP plus build scripts. PHP,
# Python and Node are already in the image, so this only adds the libraries
# those scripts import.
set -uo pipefail

# Local machines already have their own setup; only provision the web sandbox.
if [ "${CLAUDE_CODE_REMOTE:-}" != "true" ]; then
    exit 0
fi

cd "${CLAUDE_PROJECT_DIR:-$(dirname "$(dirname "$(dirname "$(readlink -f "$0")")")")}" || exit 0

echo "==> Verifying core tooling"
missing=0
for cmd in php python3; do
    if command -v "$cmd" > /dev/null 2>&1; then
        echo "    $cmd $($cmd --version 2>&1 | head -1 | grep -oE '[0-9]+\.[0-9]+(\.[0-9]+)?' | head -1)"
    else
        echo "    MISSING: $cmd — lint and tests will not run"
        missing=1
    fi
done

# php -l and tools/*.php are the lint and test path. Without PHP there is
# nothing to provision, so fail loudly rather than pretend the setup worked.
if [ "$missing" -ne 0 ]; then
    exit 1
fi

# --- Python: image and font generation -------------------------------------
# Pillow builds images/og-image.jpg and the WebP hero poster; fontTools reads
# the self-hosted Space Grotesk woff2. Neither is in the base image.
echo "==> Python packages"
if python3 -c "import PIL, fontTools" 2>/dev/null; then
    echo "    already present"
else
    if pip install --quiet --disable-pip-version-check pillow fonttools brotli 2>&1 | tail -3; then
        echo "    installed pillow, fonttools, brotli"
    else
        echo "    WARNING: install failed — image regeneration will not work"
    fi
fi

# --- Node: browser verification --------------------------------------------
# Playwright drives the pre-installed Chromium for contrast, layout-shift and
# render checks. This is how the location-page contrast failure and the
# opacity:0 content-visibility bug were caught, so it is worth having ready.
# Installed globally: the repo has no package.json and does not want one for a
# dev-only tool.
echo "==> Playwright"
# Look in the global module dir, otherwise the check always misses and
# reinstalls on every session start.
NPM_GLOBAL="$(npm root -g 2>/dev/null || echo '')"
if NODE_PATH="$NPM_GLOBAL" node -e "require.resolve('playwright')" 2>/dev/null; then
    echo "    already present"
elif command -v npm > /dev/null 2>&1; then
    if npm install -g --no-audit --no-fund playwright > /dev/null 2>&1; then
        echo "    installed"
    else
        echo "    WARNING: install failed — browser checks unavailable (lint and tests unaffected)"
    fi
else
    echo "    skipped (no npm)"
fi

# Resolve globally-installed modules from scripts run anywhere in the repo, and
# point Playwright at the bundled browser so it never tries to download one.
if [ -n "${CLAUDE_ENV_FILE:-}" ]; then
    {
        echo "export NODE_PATH=\"$(npm root -g 2>/dev/null)\""
        echo 'export PLAYWRIGHT_BROWSERS_PATH="/opt/pw-browsers"'
        echo 'export PLAYWRIGHT_SKIP_BROWSER_DOWNLOAD=1'
    } >> "$CLAUDE_ENV_FILE"
fi

echo "==> Ready — run ./rapidtech-theme/tools/check.sh to lint and test"
