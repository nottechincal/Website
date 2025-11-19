# Quick Fix Guide - FAQ Link & Favicon

## Issue 1: FAQ Link Not Working

**Problem:** FAQ link in footer returns 404
**Cause:** Your live server's `.htaccess` file still has OLD theme paths

### Quick Test:
Open this URL in your browser:
```
https://rapidtechsolutions.au/.htaccess
```

Or check via cPanel:
1. File Manager → /public_html/.htaccess
2. Right-click → Edit
3. Search for: `RewriteRule ^faq`

**What you should see:**
```apache
RewriteRule ^faq/?$ /wp-content/themes/rapidtech-theme/faq.php [L]
```

**If you see this instead (OLD):**
```apache
RewriteRule ^faq/?$ /wp-content/themes/new-themeWORKING6/faq.php [L]
```

### Fix:
1. Download the correct .htaccess:
   - Path: `rapidtech-theme/docs/DEPLOYMENT.htaccess`

2. Upload to your server:
   - Copy ALL content from DEPLOYMENT.htaccess
   - Paste into `/public_html/.htaccess`
   - Save

3. Test: https://rapidtechsolutions.au/faq/ (should work now!)

---

## Issue 2: Favicon Not Showing

**Problem:** No favicon in browser tab
**Cause:** Browser cache + SVG compatibility

### Quick Fix:

**Option 1: Clear Browser Cache (Easiest)**
1. Press: `Ctrl + Shift + Delete` (Windows) or `Cmd + Shift + Delete` (Mac)
2. Select: "Cached images and files"
3. Click: "Clear data"
4. Reload: https://rapidtechsolutions.au/
5. Wait 30 seconds for favicon to appear

**Option 2: Force Refresh**
1. Visit: https://rapidtechsolutions.au/
2. Press: `Ctrl + F5` (Windows) or `Cmd + Shift + R` (Mac)
3. Check browser tab for "RT" icon

**Option 3: Test in Incognito**
1. Open incognito/private window
2. Visit: https://rapidtechsolutions.au/
3. Favicon should appear (confirms it's cached)

### If Still Not Working:

The theme now uses your existing logo as favicon. Test if this file exists:
```
https://rapidtechsolutions.au/wp-content/themes/rapidtech-theme/images/logo.png
```

Should show your logo image.

---

## Verification Checklist

After applying fixes, verify:

- [ ] FAQ link works: https://rapidtechsolutions.au/faq/
- [ ] All location pages work (no 404):
  - https://rapidtechsolutions.au/computer-repairs-cranbourne/
  - https://rapidtechsolutions.au/computer-repairs-frankston/
- [ ] Favicon appears in browser tab (may need cache clear)
- [ ] No old theme path in page source (search: "new-themeWORKING6" = 0 results)

---

## Still Having Issues?

**For FAQ 404:**
Send me a screenshot or copy of your `/public_html/.htaccess` file (first 50 lines)

**For Favicon:**
Check these files exist on your server:
- `/wp-content/themes/rapidtech-theme/images/favicon.svg`
- `/wp-content/themes/rapidtech-theme/images/logo.png`

**Both files should be there after you upload the latest theme!**
