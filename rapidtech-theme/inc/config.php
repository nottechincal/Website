<?php
/**
 * Rapid Tech Solutions — single source of truth for business data.
 *
 * Everything that appears in more than one template lives here: NAP, hours,
 * social profiles, analytics IDs, brand copy. Before this file existed the
 * phone number was hard-coded in 150 places and the opening hours disagreed
 * with themselves across three different values in structured data.
 *
 * Nothing here should be edited in a template. If a template needs a business
 * fact, it reads it from RT::...
 */

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__DIR__) . '/');
}

final class RT
{
    /* ---------------------------------------------------------------- site */

    /** Canonical origin. No trailing slash. Must match the .htaccess redirect. */
    const ORIGIN = 'https://rapidtechsolutions.au';

    const NAME       = 'Rapid Tech Solutions';
    const LEGAL_NAME = 'Rapid Tech Solutions';
    const ABN        = '64 654 861 096';
    const LOCALE     = 'en_AU';
    const LANG       = 'en-AU';

    /* ----------------------------------------------------------------- NAP */
    /*
     * One address, one set of hours. These are the values Google will treat as
     * authoritative, so they must match the Google Business Profile exactly.
     */

    const PHONE_E164    = '+61423680596';
    const PHONE_DISPLAY = '0423 680 596';
    const EMAIL         = 'support@rapidtechsolutions.au';
    const EMAIL_PRIVACY = 'privacy@rapidtechsolutions.au';
    const EMAIL_NOREPLY = 'noreply@rapidtechsolutions.au';

    const STREET    = 'Cranbourne South';
    const LOCALITY  = 'Cranbourne South';
    const REGION    = 'VIC';
    const POSTCODE  = '3977';
    const COUNTRY   = 'AU';
    const LATITUDE  = -38.1333;
    const LONGITUDE = 145.2667;

    const PRICE_RANGE = '$$';

    /** Opening hours. One definition — templates must not restate these. */
    const OPEN_DAYS  = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
    const OPEN_TIME  = '09:00';
    const CLOSE_TIME = '17:00';
    const HOURS_TEXT = 'Mon–Fri, 9am–5pm AEST';

    /* ------------------------------------------------------------- reviews */
    /*
     * Only valid while these match the reviews actually visible on the site.
     * Google requires aggregateRating to reflect ratings users can see, and it
     * belongs on the homepage only — not repeated on every suburb page.
     */
    const RATING_VALUE = '5.0';
    const RATING_COUNT = 47;

    /* -------------------------------------------------------------- social */

    const SOCIAL = [
        'https://www.facebook.com/RapidTechAUS/',
        'https://www.instagram.com/rapidtechsolutions.au/',
    ];

    const WHATSAPP = 'https://wa.me/61423680596';

    /** Google Business Profile review link. Displayed in footer and reviews page. */
    const GOOGLE_REVIEW_URL = 'https://search.google.com/local/writereview?placeid=/g/11lmbq18wb';

    /* ------------------------------------------------------------ tracking */

    const GA_MEASUREMENT_ID = 'G-BDN34WT3J6';
    // Removed — tawk.to retired in favour of WhatsApp widget

    /* --------------------------------------------------------------- media */

    const OG_IMAGE   = '/wp-content/themes/rapidtech-theme/images/og-image.jpg';
    const OG_W       = 1200;
    const OG_H       = 630;
    const LOGO       = '/wp-content/themes/rapidtech-theme/images/logo.png';

    /* ------------------------------------------------------------ pricing */

    /** Single source of truth for pricing. Every page and schema block
     *  reads from here so Google never sees conflicting answers. */
    const PRICING = [
        'software' => ['name' => 'Software & Setup',     'range' => '$80 – $180', 'what' => 'Slow machines, viruses, updates, new device setup'],
        'hardware' => ['name' => 'Hardware Repairs',     'range' => '$120 – $350', 'what' => 'Screens, drives, batteries, memory and SSD upgrades'],
        'data'     => ['name' => 'Data Recovery',        'range' => 'From $150',  'what' => 'Priced on the condition of the drive'],
        'network'  => ['name' => 'Wi-Fi & Networks',     'range' => '$90 – $250',  'what' => 'Depends on property size and layout'],
    ];

    const RATE_REMOTE = '$80 per hour';
    const RATE_ONSITE = '$120 per hour with a one-hour minimum';

    /** Pricing FAQ text generated from constants — used in schema and visible FAQ. */
    public static function pricing_faq_text(): string
    {
        $parts = [];
        foreach (self::PRICING as $s) {
            $parts[] = "{$s['name']}: {$s['range']} ({$s['what']})";
        }
        return 'Diagnosis and quotes are free. ' . implode('. ', $parts)
             . '. Fixed price before any work begins — no charge if we can\'t fix it.';
    }

    /* ------------------------------------------------------------ services */

    const SERVICES = [
        'computer-repairs' => [
            'name' => 'Computer Repairs',
            'desc' => 'Fast diagnostics, component upgrades, and repairs for laptops, desktops, and gaming PCs.',
        ],
        'virus-removal' => [
            'name' => 'Virus & Malware Removal',
            'desc' => 'Endpoint protection, phishing defence, and complete malware clean-up.',
        ],
        'data-recovery' => [
            'name' => 'Data Recovery',
            'desc' => 'SSD and HDD recovery, server restores, and encrypted backup solutions.',
        ],
        'network-wifi' => [
            'name' => 'Network & Wi-Fi Solutions',
            'desc' => 'Business-grade Wi-Fi, mesh networks, and 4G/5G failover connectivity.',
        ],
    ];

    /* ------------------------------------------------------------- helpers */

    /**
     * Trailing-slash convention for page URLs.
     *
     * WordPress's default permalink structure serves pages with a trailing
     * slash and 301s the slashless form to it. The canonical tag, the sitemap
     * and every internal link therefore have to agree with that, or Google
     * sees the canonical pointing at a URL that redirects — which is what
     * produced the "Duplicate without user-selected canonical" reports.
     *
     * Set to false only if the permalink structure is changed to match.
     */
    const TRAILING_SLASH = true;

    /** Normalise a root-relative path to the site's URL convention. */
    public static function path_url(string $path = '/'): string
    {
        $path = '/' . ltrim($path, '/');

        // Files and anchors are left exactly as given.
        if ($path === '/' || str_contains($path, '#') || str_contains($path, '?')
            || preg_match('#\.[a-z0-9]{2,4}$#i', $path)) {
            return $path;
        }

        return self::TRAILING_SLASH ? rtrim($path, '/') . '/' : rtrim($path, '/');
    }

    /**
     * Absolute URL for a root-relative path.
     * Always use this for canonical, og:url and anything inside JSON-LD —
     * relative URLs in those positions are silently wrong.
     */
    public static function url(string $path = '/'): string
    {
        return self::ORIGIN . self::path_url($path);
    }

    /**
     * Base URL for theme assets.
     *
     * Under WordPress the theme lives at /wp-content/themes/rapidtech-theme;
     * served directly it lives at the document root. Both must work, and
     * neither may produce a path-relative URL — "./css/styles.css" breaks the
     * moment a page is served at a URL ending in a slash.
     */
    public static function asset(string $path = ''): string
    {
        static $base = null;

        if ($base === null) {
            if (function_exists('get_template_directory_uri')) {
                $base = rtrim(get_template_directory_uri(), '/');
            } else {
                $dir  = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
                $base = ($dir === '/' || $dir === '.') ? '' : rtrim($dir, '/');
            }
        }

        return $base . '/' . ltrim($path, '/');
    }

    /** Filesystem path inside the theme (for require/include). */
    public static function path(string $path = ''): string
    {
        $base = function_exists('get_template_directory')
            ? get_template_directory()
            : rtrim(dirname(__DIR__), '/');

        return $base . '/' . ltrim($path, '/');
    }

    /** Escape for HTML text/attribute output. */
    public static function e(?string $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * The one canonical LocalBusiness node.
     *
     * Suburb pages must NOT redeclare address/geo — the business has one
     * physical location. Suburbs belong in areaServed, which is what
     * area_served() below is for.
     */
    public static function local_business(array $overrides = []): array
    {
        $node = [
            '@type'       => 'LocalBusiness',
            '@id'         => self::url('/#business'),
            'name'        => self::NAME,
            'telephone'   => self::PHONE_E164,
            'email'       => self::EMAIL,
            'url'         => self::ORIGIN,
            'logo'        => self::url(self::LOGO),
            'image'       => self::url(self::OG_IMAGE),
            'priceRange'  => self::PRICE_RANGE,
            'address'     => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => self::STREET,
                'addressLocality' => self::LOCALITY,
                'addressRegion'   => self::REGION,
                'postalCode'      => self::POSTCODE,
                'addressCountry'  => self::COUNTRY,
            ],
            'geo' => [
                '@type'     => 'GeoCoordinates',
                'latitude'  => self::LATITUDE,
                'longitude' => self::LONGITUDE,
            ],
            'openingHoursSpecification' => [[
                '@type'     => 'OpeningHoursSpecification',
                'dayOfWeek' => self::OPEN_DAYS,
                'opens'     => self::OPEN_TIME,
                'closes'    => self::CLOSE_TIME,
            ]],
            'sameAs' => self::SOCIAL,
        ];

        return array_merge($node, $overrides);
    }

    /** areaServed node for a suburb — the correct way to express coverage. */
    public static function area_served(string $suburb, ?string $postcode = null): array
    {
        $node = ['@type' => 'City', 'name' => $suburb];

        if ($postcode !== null) {
            $node['address'] = [
                '@type'           => 'PostalAddress',
                'addressLocality' => $suburb,
                'postalCode'      => $postcode,
                'addressRegion'   => self::REGION,
                'addressCountry'  => self::COUNTRY,
            ];
        }

        return $node;
    }

    /** Emit a JSON-LD script block. */
    public static function json_ld(array $data): void
    {
        echo '<script type="application/ld+json">',
             json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
             '</script>';
    }
}
