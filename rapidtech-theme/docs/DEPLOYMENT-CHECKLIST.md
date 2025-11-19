# Deployment Checklist for rapidtech-theme v3.0.0

## ⚠️ CRITICAL - Theme Name Changed!

The theme folder name has changed from `new-themeWORKING6` to `rapidtech-theme`. You MUST follow this checklist exactly to avoid 404 errors.

---

## 🚀 Step-by-Step Deployment

### Step 1: Backup Current Site
```bash
# Before making ANY changes, backup your current site:
1. Download current theme folder from cPanel File Manager
2. Export WordPress database from phpMyAdmin
3. Download current .htaccess file
```

**Verification:** Confirm you have 3 backup files saved locally

---

### Step 2: Upload New Theme

#### Via cPanel File Manager:

1. **Navigate to theme directory:**
   ```
   /public_html/wp-content/themes/
   ```

2. **Upload the theme:**
   - Upload `rapidtech-theme.zip` (create zip from repository first)
   - OR upload the `rapidtech-theme` folder directly
   - Make sure the final path is: `/public_html/wp-content/themes/rapidtech-theme/`

3. **Verify upload:**
   - Check that `/public_html/wp-content/themes/rapidtech-theme/index.php` exists
   - Check that `/public_html/wp-content/themes/rapidtech-theme/style.css` exists
   - Total files should be: ~250 files

**Verification:** ✅ Theme files in `/wp-content/themes/rapidtech-theme/`

---

### Step 3: Update .htaccess File

**CRITICAL:** This step fixes the 404 errors and wrong theme paths!

1. **Backup current .htaccess:**
   ```bash
   # Download /public_html/.htaccess to your computer first
   ```

2. **Update .htaccess:**
   - Open `/public_html/.htaccess` in cPanel File Manager "Edit" mode
   - Copy ENTIRE content from `/wp-content/themes/rapidtech-theme/docs/DEPLOYMENT.htaccess`
   - Paste into `/public_html/.htaccess`
   - **Save the file**

3. **Verify the update:**
   - Open `/public_html/.htaccess` again
   - Search for "rapidtech-theme" - should find 75 instances
   - Search for "new-themeWORKING6" - should find 0 instances

**Verification:** ✅ .htaccess contains `rapidtech-theme` references (not old theme name)

---

### Step 4: Activate Theme in WordPress

1. **Login to WordPress Admin:**
   ```
   https://rapidtechsolutions.au/wp-admin/
   ```

2. **Navigate to Appearance → Themes**

3. **Locate "RapidTech Professional"**
   - Theme Name: RapidTech Professional
   - Version: 3.0.0
   - Description: Enterprise-grade WordPress theme...

4. **Click "Activate"**

5. **If theme doesn't appear:**
   - Theme folder might be in wrong location
   - Verify: `/public_html/wp-content/themes/rapidtech-theme/style.css` exists
   - Check that style.css has proper header comment

**Verification:** ✅ Theme shows as "Active" in WordPress admin

---

### Step 5: Test Critical URLs

Test EVERY ONE of these URLs to ensure they work:

#### Homepage & Main Pages:
- [ ] https://rapidtechsolutions.au/
- [ ] https://rapidtechsolutions.au/blog/
- [ ] https://rapidtechsolutions.au/faq/
- [ ] https://rapidtechsolutions.au/book/
- [ ] https://rapidtechsolutions.au/about/

#### Service Pages:
- [ ] https://rapidtechsolutions.au/service-computer-repairs/
- [ ] https://rapidtechsolutions.au/service-data-recovery/
- [ ] https://rapidtechsolutions.au/service-virus-removal/
- [ ] https://rapidtechsolutions.au/service-network-wifi/

#### Location Pages (sample):
- [ ] https://rapidtechsolutions.au/computer-repairs-cranbourne/
- [ ] https://rapidtechsolutions.au/computer-repairs-frankston/
- [ ] https://rapidtechsolutions.au/computer-repairs-berwick/

#### Postcode Pages (sample):
- [ ] https://rapidtechsolutions.au/postcode-3152/
- [ ] https://rapidtechsolutions.au/postcode-3977/
- [ ] https://rapidtechsolutions.au/postcode-3199/

#### Blog Posts:
- [ ] https://rapidtechsolutions.au/blog-scam-protection/
- [ ] https://rapidtechsolutions.au/blog-password-security/

#### Sitemap:
- [ ] https://rapidtechsolutions.au/sitemap.xml
  - Should show **74 URLs** (not 57)

**Verification:** ✅ All URLs return 200 OK (not 404)

---

### Step 6: Check Footer Links

**The Problem:** Footer FAQ link was returning 404

1. **Navigate to any page on your site**
2. **Scroll to bottom footer**
3. **Click "FAQ" link** - should go to `/faq/` (not 404)
4. **Check all footer links work:**
   - [ ] Privacy Policy
   - [ ] Terms of Service
   - [ ] FAQ

**Verification:** ✅ All footer links work correctly

---

### Step 7: Verify No Old Theme Path References

**The Problem:** Links showing `new-themeWORKING6` path

1. **Visit any location page** (e.g., computer-repairs-cranbourne)
2. **Right-click → View Page Source**
3. **Search for "new-themeWORKING6"** - should find **0 results**
4. **Search for "rapidtech-theme"** - should find results in meta tags

**Verification:** ✅ No references to old theme name in page source

---

### Step 8: Test Favicon

1. **Visit homepage**
2. **Check browser tab** - should see "RT" logo icon
3. **Check on mobile** - should see Apple touch icon

If favicon doesn't show:
- Clear browser cache (Ctrl+Shift+Delete)
- Check `/wp-content/themes/rapidtech-theme/images/favicon.svg` exists

**Verification:** ✅ Favicon appears in browser tab

---

### Step 9: Performance Check

1. **Run PageSpeed Insights:**
   ```
   https://pagespeed.web.dev/
   ```

2. **Test your homepage:**
   - Desktop score should be: **85%+** (target: 91%)
   - Mobile score should be: **60%+** (target: 66%)

3. **If scores are lower:**
   - Check if GZIP compression enabled (in .htaccess)
   - Check if browser caching enabled (in .htaccess)
   - Verify images loading correctly

**Verification:** ✅ PageSpeed scores meet targets

---

### Step 10: SEO Verification

1. **Check Google Search Console:**
   ```
   https://search.google.com/search-console
   ```

2. **Submit updated sitemap:**
   - Go to Sitemaps section
   - Submit: `https://rapidtechsolutions.au/sitemap.xml`
   - Wait for Google to process (may take 24-48 hours)

3. **Verify sitemap contains 74 URLs:**
   ```
   https://rapidtechsolutions.au/sitemap.xml
   ```

4. **Check robots.txt:**
   ```
   https://rapidtechsolutions.au/robots.txt
   ```

**Verification:** ✅ Sitemap submitted to Google Search Console

---

## 🐛 Troubleshooting

### Problem: FAQ link returns 404

**Cause:** .htaccess not updated OR theme not in correct directory

**Fix:**
1. Verify .htaccess contains:
   ```apache
   RewriteRule ^faq/?$ /wp-content/themes/rapidtech-theme/faq.php [L]
   ```
2. Verify file exists: `/public_html/wp-content/themes/rapidtech-theme/faq.php`
3. Clear browser cache

---

### Problem: Links showing `/wp-content/themes/new-themeWORKING6/`

**Cause:** .htaccess still has old theme name OR old theme activated

**Fix:**
1. Open `/public_html/.htaccess` in cPanel
2. Search and replace ALL instances of `new-themeWORKING6` with `rapidtech-theme`
3. Save file
4. Test URLs again

---

### Problem: Sitemap showing 57 URLs instead of 74

**Cause:** Old sitemap.xml cached OR not uploaded

**Fix:**
1. Delete old sitemap: `/public_html/wp-content/themes/*/sitemap.xml`
2. Upload new sitemap: `/public_html/wp-content/themes/rapidtech-theme/sitemap.xml`
3. Clear browser cache (Ctrl+Shift+R)
4. Force refresh: Add `?v=2` to URL: `https://rapidtechsolutions.au/sitemap.xml?v=2`

---

### Problem: Theme doesn't appear in WordPress

**Cause:** Wrong folder structure OR missing style.css

**Fix:**
1. Verify exact path: `/public_html/wp-content/themes/rapidtech-theme/style.css`
2. NOT: `/wp-content/themes/rapidtech-theme/rapidtech-theme/style.css`
3. Check style.css has this header:
   ```css
   /*
   Theme Name: RapidTech Professional
   Version: 3.0.0
   */
   ```

---

### Problem: Pages load but styles are broken

**Cause:** CSS files missing OR path issues

**Fix:**
1. Check `/public_html/wp-content/themes/rapidtech-theme/css/` folder exists
2. Check `/public_html/wp-content/themes/rapidtech-theme/css/styles.css` exists
3. View page source, check CSS links are correct
4. Clear browser cache

---

### Problem: Favicon not showing

**Cause:** Browser cache OR file missing

**Fix:**
1. Check file exists: `/public_html/wp-content/themes/rapidtech-theme/images/favicon.svg`
2. Clear browser cache completely
3. Try incognito/private browsing mode
4. Wait 5-10 minutes for browser to update

---

## 📞 Need Help?

If you encounter issues not covered here:

1. **Check file paths:**
   - Theme MUST be in: `/public_html/wp-content/themes/rapidtech-theme/`
   - NOT in: `/public_html/wp-content/themes/new-themeWORKING6/`

2. **Check .htaccess:**
   - All 75 rewrite rules point to `rapidtech-theme`
   - No references to old theme name

3. **Browser cache:**
   - Clear ALL browser data
   - Test in incognito mode
   - Try different browser

4. **Server cache:**
   - If using caching plugin, clear cache
   - Disable caching temporarily for testing

---

## ✅ Deployment Complete Checklist

Before considering deployment done, verify:

- [ ] Theme uploaded to `/wp-content/themes/rapidtech-theme/`
- [ ] .htaccess updated with new theme path (75 instances)
- [ ] Theme activated in WordPress admin
- [ ] All 74 URLs tested and working
- [ ] Footer FAQ link works
- [ ] No old theme path references in source code
- [ ] Favicon appears in browser
- [ ] PageSpeed scores meet targets (Desktop 85%+, Mobile 60%+)
- [ ] Sitemap shows 74 URLs
- [ ] Sitemap submitted to Google Search Console

---

**Version:** 3.0.0
**Last Updated:** 2025-11-19
**Theme:** RapidTech Professional
