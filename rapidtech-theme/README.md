# RapidTech Professional WordPress Theme

**Version:** 3.0.0
**Author:** Rapid Tech Solutions
**Website:** https://www.rapidtechsolutions.au

Enterprise-grade WordPress theme for computer repair and IT services businesses. Fully optimised for local SEO, mobile performance, and conversion.

---

## Features

### Core Functionality
- ✅ **74+ SEO-Optimised Pages**
  - Homepage with conversion-optimised design
  - 7 blog articles with structured data
  - 35 location/suburb pages
  - 14 postcode-targeted pages
  - 6 service pages
  - 6 service+location combo pages
  - FAQ, booking, and support pages

- ✅ **Performance Optimised**
  - Google PageSpeed Score: Desktop 91%, Mobile 66%+
  - Deferred CSS loading saves 2,780ms render-blocking time
  - Conditional video loading (saves 3MB on mobile)
  - Image optimisation with WebP support
  - Browser caching configuration

- ✅ **SEO & Analytics**
  - Complete structured data (LocalBusiness, Article, FAQPage, BreadcrumbList)
  - Google Analytics 4 integration (G-BDN34WT3J6)
  - XML sitemap with 74 URLs
  - Australian English throughout
  - Mobile-first responsive design

- ✅ **Business Features**
  - Online booking system integration
  - PayPal payment integration
  - Contact forms with email notifications
  - Service area management
  - Emergency computer repair banner

---

## Installation

### Requirements
- WordPress 5.8 or higher
- PHP 7.4 or higher
- Apache with mod_rewrite enabled
- HTTPS (SSL certificate)

### Steps

1. **Upload Theme**
   ```bash
   # Upload the entire rapidtech-theme folder to:
   /public_html/wp-content/themes/rapidtech-theme/
   ```

2. **Configure .htaccess**
   ```bash
   # Copy the deployment htaccess file:
   cp /public_html/wp-content/themes/rapidtech-theme/docs/DEPLOYMENT.htaccess /public_html/.htaccess
   ```

   This configures:
   - HTTPS redirect
   - Clean URLs for all 74 pages
   - Security headers
   - Compression and caching

3. **Activate Theme**
   - Log in to WordPress admin
   - Go to Appearance → Themes
   - Activate "RapidTech Professional"

4. **Verify Installation**
   Test these URLs work:
   - https://rapidtechsolutions.au/
   - https://rapidtechsolutions.au/blog/
   - https://rapidtechsolutions.au/faq/
   - https://rapidtechsolutions.au/postcode-3152/
   - https://rapidtechsolutions.au/computer-repairs-cranbourne/
   - https://rapidtechsolutions.au/sitemap.xml (should show 74 URLs)

---

## Directory Structure

```
rapidtech-theme/
├── assets/          # Empty (images, fonts, videos in root directories)
├── css/             # Stylesheets (Bootstrap, animations, custom)
├── docs/            # Documentation files
│   ├── DEPLOYMENT.htaccess       # Production .htaccess template
│   ├── gbp-posts.md              # Google Business Profile post templates
│   └── review-request-templates.md
├── fonts/           # Web fonts (Font Awesome, Icon-7-Stroke, Glyphicons)
├── images/          # Theme images and graphics
├── inc/             # PHP templates (location-template.php)
├── js/              # JavaScript files (jQuery, Bootstrap, WOW.js, etc.)
├── vendor/          # PayPal SDK and dependencies
├── videos/          # Background videos (bg1.mp4, bg1.webm)
├── *.php            # Page templates (85 total)
├── index.php        # Homepage template
├── style.css        # Theme metadata and base styles
├── functions.php    # Theme functions
├── sitemap.xml      # SEO sitemap (74 URLs)
├── robots.txt       # Search engine directives
└── README.md        # This file
```

---

## Page Types

### Blog Articles (7)
- Blog index: `/blog/`
- Scam Protection Guide
- Password Security Best Practices
- Computer Maintenance Tips
- Malware Protection
- Hardware Upgrades Guide
- Home Network Setup
- Cloud Services Guide

### Location Pages (35 suburbs)
Including: Cranbourne, Berwick, Frankston, Dandenong, Narre Warren, Patterson Lakes, and 29 more

### Postcode Pages (14)
3152, 3173, 3174, 3175, 3178, 3192, 3193, 3194, 3195, 3196, 3198, 3199, 3200, 3201

### Service Pages (6)
- Computer Repairs
- Data Recovery
- Virus Removal
- Network & WiFi Setup
- Service Areas
- Service Area (single)

### Service+Location Combos (6)
- Virus Removal Dandenong
- Virus Removal Cranbourne
- Data Recovery Frankston
- Data Recovery Patterson Lakes
- Network Setup Berwick
- Emergency Computer Repair Melbourne

### Support Pages
- FAQ
- Online Booking
- About
- Privacy Policy
- Terms of Service
- Thank You

---

## Customisation

### Update Contact Information
Edit these files:
- `index.php` - Phone number, address, opening hours
- `footer.php` - Footer contact details
- `functions.php` - Business information

### Update Google Analytics
In `index.php`, `blog.php`, and other templates, update:
```html
<script async src="https://www.googletagmanager.com/gtag/js?id=YOUR-GA4-ID"></script>
```

### Add New Location Pages
1. Copy `inc/location-template.php`
2. Customise suburb/location details
3. Add rewrite rule to `.htaccess`:
   ```apache
   RewriteRule ^computer-repairs-your-suburb/?$ /wp-content/themes/rapidtech-theme/computer-repairs-your-suburb.php [L]
   ```
4. Add to `sitemap.xml`

---

## Performance Optimisation

### Current Scores (Google PageSpeed)
- **Desktop:** 91%
- **Mobile:** 66%+

### Optimisation Features
1. **Deferred CSS Loading**
   - Non-critical CSS loads after page render
   - Saves 2,780ms render-blocking time

2. **Conditional Video Loading**
   - Videos only load on desktop (≥1024px width)
   - Saves 3MB on mobile devices
   - Honours `prefers-reduced-motion`

3. **Image Optimisation**
   - Hero image with `fetchpriority="high"`
   - WebP format support
   - Lazy loading for offscreen images

4. **Browser Caching**
   - Images: 1 year
   - CSS/JS: 1 month
   - Configured via .htaccess

### Further Improvements
- Convert remaining JPG images to WebP
- Implement service worker for offline functionality
- Add critical CSS inline
- Consider CDN for static assets

---

## SEO Features

### Structured Data
All pages include appropriate schema.org markup:
- **LocalBusiness** - Homepage
- **Article** - Blog posts
- **FAQPage** - FAQ page
- **BreadcrumbList** - All pages

### Meta Tags
- Open Graph for social sharing
- Twitter Cards
- Viewport optimisation
- Charset UTF-8

### Sitemap
XML sitemap at `/sitemap.xml` includes:
- 74 URLs
- Last modified dates
- Change frequency
- Priority ratings

Submit to:
- Google Search Console: https://search.google.com/search-console
- Bing Webmaster Tools: https://www.bing.com/webmasters

---

## Security

### Headers (.htaccess)
```apache
X-Frame-Options: SAMEORIGIN          # Prevents clickjacking
X-Content-Type-Options: nosniff      # Prevents MIME sniffing
X-XSS-Protection: 1; mode=block      # XSS protection
Referrer-Policy: strict-origin-when-cross-origin
Content-Security-Policy: upgrade-insecure-requests
```

### HTTPS
- Force HTTPS redirect
- Upgrade insecure requests via CSP
- Non-www to www (or vice versa) redirect

---

## Troubleshooting

### 404 Errors on Pages
**Problem:** Pages return 404 errors
**Solution:** Ensure `.htaccess` is properly configured (see docs/DEPLOYMENT.htaccess)

### Sitemap Shows Wrong Number of URLs
**Problem:** Sitemap shows 57 instead of 74 URLs
**Solution:**
1. Clear browser cache (Ctrl+Shift+R)
2. Clear server cache if using caching plugin
3. Force reupload `sitemap.xml`

### Theme Not Showing in WordPress
**Problem:** Theme not appearing in Appearance → Themes
**Solution:** Ensure `style.css` exists in theme root with proper header comment

### Performance Issues
**Problem:** Slow page load times
**Solution:**
1. Enable GZIP compression (included in .htaccess)
2. Enable browser caching (included in .htaccess)
3. Optimise images to WebP format
4. Use a CDN for static assets

---

## Support & Documentation

### Additional Documentation
- `/docs/gbp-posts.md` - Google Business Profile post templates
- `/docs/review-request-templates.md` - Customer review request emails
- `/docs/DEPLOYMENT.htaccess` - Production .htaccess configuration

### Contact
- **Website:** https://www.rapidtechsolutions.au
- **Email:** Via contact form on website

---

## Changelog

### Version 3.0.0 (2025-11-19)
- ✨ Renamed theme to professional structure (`rapidtech-theme`)
- ✨ Updated theme metadata with comprehensive details
- 🗑️ Removed redundant files (composer.phar, images.zip, old htaccess backups)
- 📁 Organised documentation into `/docs/` directory
- 📝 Created comprehensive README.md
- 🔄 Updated all .htaccess references to new theme name (75 instances)
- ✅ Improved version control and project structure

### Version 2.0 (2025-11-18)
- 🚀 Major performance optimisations (PageSpeed improvements)
- 📱 Improved mobile UX (removed floating CTA, non-sticky emergency banner)
- 🇦🇺 Converted all text to Australian English spelling
- 🖼️ Converted hero image from JPG to WebP (saved 230KB)
- 🎯 Added 14 postcode location pages
- ❓ Added comprehensive FAQ page
- 🔧 Fixed sitemap XML errors
- ♿ Improved accessibility features

### Version 1.0 (Initial Release)
- 🎉 Initial theme development
- 📄 74 SEO-optimised pages
- 📊 Google Analytics integration
- 🏢 LocalBusiness structured data
- 💼 Service+Location combo pages
- 📅 Online booking system

---

## License

This theme is licensed under the GNU General Public License v2 or later.

**License URI:** http://www.gnu.org/licenses/gpl-2.0.html

---

## Credits

- **Bootstrap:** v3.3.6
- **jQuery:** v3.x
- **Font Awesome:** v4.5
- **WOW.js:** Scroll animations
- **Owl Carousel:** v2.x
- **PayPal Checkout SDK:** Payment integration

---

*Built with ❤️ for Rapid Tech Solutions*
