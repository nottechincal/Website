<?php
/**
 * Inline SVG icons.
 *
 * The site previously pulled the whole Font Awesome stylesheet from a CDN on
 * 62 pages — roughly 100KB plus a third-party connection — to render about
 * fifteen glyphs, and loaded it via the media="print" onload swap, which makes
 * every icon pop in after first paint. These are the same shapes, inline, with
 * no network cost and no layout shift.
 *
 * Paths are from Lucide (ISC licence), normalised to a 24x24 viewBox.
 */

/**
 * @param string $name  Icon key from the map below.
 * @param string $class Extra CSS classes.
 */
function rt_icon(string $name, string $class = ''): string
{
    static $icons = [
        'phone'    => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/>',
        'bolt'     => '<path d="M13 2 3 14h9l-1 8 10-12h-9l1-8Z"/>',
        'shield'   => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1Z"/>',
        'home'     => '<path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/>',
        'clock'    => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'pin'      => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
        'star'     => '<path d="m12 3 2.85 5.77 6.37.93-4.61 4.49 1.09 6.34L12 17.53l-5.7 3-1.09-6.34L.6 9.7l6.37-.93Z"/>',
        'check'    => '<path d="m20 6-11 11-5-5"/>',
        'laptop'   => '<rect x="3" y="4" width="18" height="12" rx="2"/><path d="M2 20h20"/>',
        'network'  => '<rect x="9" y="2" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="16" y="16" width="6" height="6" rx="1"/><path d="M12 8v4M5 16v-2h14v2"/>',
        'database' => '<ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.66 3.58 3 8 3s8-1.34 8-3V5"/><path d="M4 12c0 1.66 3.58 3 8 3s8-1.34 8-3"/>',
        'truck'    => '<path d="M10 17h4V5H2v12h3"/><path d="M14 9h4l3 3v5h-3"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/>',
        'user'     => '<circle cx="12" cy="8" r="4"/><path d="M4 21v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6v1"/>',
        'dollar'   => '<path d="M12 2v20"/><path d="M17 6.5C17 4.6 14.8 3.5 12 3.5S7 4.6 7 6.5 9.2 9.5 12 9.5s5 1.1 5 3-2.2 3-5 3-5-1.1-5-3"/>',
        'award'    => '<circle cx="12" cy="9" r="6"/><path d="m8.5 14-1.5 7 5-3 5 3-1.5-7"/>',
        'menu'     => '<path d="M4 6h16M4 12h16M4 18h16"/>',
        'mail'     => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6 10-6"/>',
    ];

    if (!isset($icons[$name])) {
        return '';
    }

    $cls = trim('icon icon-' . $name . ' ' . $class);

    return '<svg class="' . htmlspecialchars($cls, ENT_QUOTES) . '" viewBox="0 0 24 24" '
         . 'fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" '
         . 'stroke-linejoin="round" aria-hidden="true" focusable="false">'
         . $icons[$name] . '</svg>';
}
