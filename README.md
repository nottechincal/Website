# Rapid Tech Solutions — website

WordPress theme and web-root files for [rapidtechsolutions.au](https://rapidtechsolutions.au).

```
.
├── rapidtech-theme/          # the WordPress theme
│   ├── inc/                  # shared config, SEO helpers, page templates
│   ├── tools/                # build scripts (not deployed)
│   ├── css/ js/ fonts/       # assets
│   └── *.php                 # page templates
├── deploy/webroot/           # files that must sit at the DOCUMENT ROOT
│   ├── .htaccess             # canonical redirects, security, caching
│   ├── robots.txt
│   ├── sitemap.xml           # generated — see below
│   └── googleb3b26a1af649c954.html
└── .github/workflows/        # FTPS deploy on push to main
```

## Two deploy targets, and why it matters

The theme goes to `/wp-content/themes/rapidtech-theme/`. Everything in
`deploy/webroot/` goes to the **document root**.

This split is not cosmetic. `robots.txt`, `sitemap.xml` and the Google
verification file are only ever read from the document root — a `robots.txt`
inside the theme folder is never fetched by any crawler. Likewise a `.htaccess`
in the theme directory only governs requests for URLs inside that directory, so
canonical redirects and security headers placed there never reach the site.

## Local development

```bash
cp .env.example .env
docker compose up -d          # WordPress on :8080, phpMyAdmin on :8081
```

Activate **RapidTech Professional** under Appearance → Themes.

To preview templates without WordPress:

```bash
cd rapidtech-theme && php -S 127.0.0.1:8000
```

`RT::asset()` and `RT::path()` resolve correctly either way, so pages render in
both contexts.

## Generated files — do not edit by hand

| File | Generator |
| --- | --- |
| `rapidtech-theme/inc/locations.php` | `tools/build-locations.py` |
| `rapidtech-theme/computer-repairs-*.php` | `tools/build-pages.php` |
| `deploy/webroot/sitemap.xml` | `tools/build-sitemap.php` |

```bash
cd rapidtech-theme
python3 tools/build-locations.py   # suburb data + 301 map
php tools/build-pages.php          # suburb pages + redirect stubs
php tools/build-sitemap.php        # sitemap.xml
```

To add or change a suburb, edit `PRIMARIES` in `tools/build-locations.py` and
re-run all three. Never edit `inc/locations.php` or a `computer-repairs-*.php`
file directly — the next build overwrites it.

## Business details live in one place

`inc/config.php` holds the phone number, address, opening hours, review counts,
social profiles and analytics IDs. Templates read from `RT::`; none of these
values should be typed into a template again. Before this existed the phone
number appeared in 150 places and the structured data carried three different
sets of opening hours.

Changing the address or hours means changing them here **and** in the Google
Business Profile — Google treats mismatched name/address/phone as an
unreliability signal.

## Deployment

Pushing to `main` runs `.github/workflows/deploy.yml`: it syntax-checks every
PHP file, then uploads the theme and the web-root files over FTPS.

Required repository secrets:

| Secret | Value |
| --- | --- |
| `FTP_SERVER` | host name or IP |
| `FTP_USERNAME` | FTP account |
| `FTP_PASSWORD` | FTP password |

Optional repository variables: `FTP_PROTOCOL` (default `ftps`), `THEME_DIR`,
`WEBROOT_DIR`.

Run the workflow manually with **dry run** ticked to preview the file list
before the first real deploy.

### Deploying by hand

If you upload manually, apply `.htaccess` **last**. A rewrite rule that does not
match your host's configuration can make every page unreachable, and you want
the rest of the files already in place when you find out.

## After deploying

1. Check `https://rapidtechsolutions.au/robots.txt` and `/sitemap.xml`
   return 200 from the **root**, not the theme folder.
2. Confirm `http://`, `https://`, apex and `www` all land on one URL.
3. Re-submit the sitemap in Search Console and use URL Inspection on the
   homepage plus two or three suburb pages.
4. Watch the Pages report for the retired suburb URLs moving to
   "Page with redirect" — that is the consolidation being picked up, and is
   expected.
