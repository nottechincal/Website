<?php
/**
 * Suburb page renderer.
 *
 * Previously this emitted a LocalBusiness node per suburb, each declaring a
 * different PostalAddress — effectively claiming a physical office in every
 * suburb the site targeted. The business has one address; suburbs belong in
 * areaServed, which is what this now does.
 *
 * It also loaded its stylesheets as "./css/styles.css", which resolves against
 * the request path — so at the page's own canonical URL (/computer-repairs-x/)
 * it fetched /computer-repairs-x/css/styles.css and the page rendered unstyled.
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/seo.php';
require_once __DIR__ . '/icons.php';
require_once __DIR__ . '/locations.php';

/**
 * Render a full suburb page.
 *
 * @param string $slug Key into rt_locations().
 */
function render_location_page(string $slug): void
{
    $all = rt_locations();

    if (!isset($all[$slug])) {
        http_response_code(404);
        require RT::path('404.php');
        return;
    }

    $loc      = $all[$slug];
    $suburb   = $loc['suburb'];
    $postcode = $loc['postcode'];
    $path     = '/computer-repairs-' . $slug;

    $faqs = rt_location_faqs($loc);

    $title = sprintf('Computer Repairs %s %s | Same-Day', $suburb, $postcode);
    $desc  = $loc['blurb'];

    /* One business, many areas served — the correct shape for a mobile service. */
    $business = RT::local_business([
        '@id'         => RT::url($path . '#business'),
        'name'        => RT::NAME,
        'description' => $desc,
        'areaServed'  => array_merge(
            [RT::area_served($suburb, $postcode)],
            array_map(fn($n) => RT::area_served($n), $loc['covers'])
        ),
    ]);

    $service = [
        '@context'    => 'https://schema.org',
        '@type'       => 'Service',
        'serviceType' => 'Computer repair and IT support',
        'name'        => sprintf('Computer Repairs in %s %s', $suburb, $postcode),
        'description' => $desc,
        'provider'    => ['@id' => RT::url('/#business')],
        'areaServed'  => RT::area_served($suburb, $postcode),
        'url'         => RT::url($path),
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name'  => 'IT Services',
            'itemListElement' => array_map(fn($s) => [
                '@type'       => 'Offer',
                'itemOffered' => [
                    '@type'       => 'Service',
                    'name'        => $s['name'],
                    'description' => $s['desc'],
                ],
            ], array_values(RT::SERVICES)),
        ],
    ];

    /* The FAQ block is already on the page; marking it up makes it eligible
       for FAQ rich results at no extra content cost. */
    $faq_schema = [
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => array_map(fn($f) => [
            '@type'          => 'Question',
            'name'           => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ], $faqs),
    ];

    ?><!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => $title,
    'description' => $desc,
    'path'        => $path,
    'css'         => 'css/location-pages.css',
    'schema'      => [$business, $service, $faq_schema],
]); ?>
<meta name="geo.region" content="AU-VIC">
<meta name="geo.placename" content="<?php echo RT::e($suburb); ?>">
<meta name="geo.position" content="<?php echo RT::e($loc['lat'] . ';' . $loc['lng']); ?>">
<meta name="ICBM" content="<?php echo RT::e($loc['lat'] . ', ' . $loc['lng']); ?>">
</head>
<body>
<?php rt_header(); ?>

<div class="container">
<?php rt_breadcrumbs([
    'Service Areas' => '/service-areas',
    $suburb . ' ' . $postcode => $path,
]); ?>
</div>

<main id="main">
    <section class="location-hero">
        <div class="container">
            <p class="eyebrow">Computer Repairs in <?php echo RT::e($suburb); ?></p>
            <h1>Computer Repairs &amp; IT Support in <?php echo RT::e($suburb); ?> <?php echo RT::e($postcode); ?></h1>
            <p class="lead"><?php echo RT::e($loc['blurb']); ?></p>
            <div class="hero-cta">
                <a class="btn" href="tel:<?php echo RT::PHONE_E164; ?>">
                    <?php echo rt_icon('phone'); ?> Call <?php echo RT::e(RT::PHONE_DISPLAY); ?>
                </a>
                <a class="btn btn-outline" href="/#contact">Request a Quote</a>
            </div>
            <ul class="hero-badges">
                <li><?php echo rt_icon('clock'); ?> Same-day service available</li>
                <li><?php echo rt_icon('pin'); ?> About <?php echo RT::e($loc['distance']); ?> minutes from our base</li>
                <li><?php echo rt_icon('shield'); ?> No fix, no fee</li>
            </ul>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2>IT Services We Provide in <?php echo RT::e($suburb); ?></h2>
            <p>We cover <?php echo RT::e($suburb); ?> and the surrounding <?php echo RT::e($postcode); ?>
               area for both homes and businesses, with most jobs completed the same day.
               Common local work includes <?php echo RT::e(rt_sentence_list($loc['issues'])); ?>.</p>

            <div class="services-grid">
                <?php foreach (RT::SERVICES as $s_slug => $s) : ?>
                <article class="service-card">
                    <?php echo rt_icon(rt_service_icon($s_slug)); ?>
                    <h3><a href="/service-<?php echo RT::e($s_slug); ?>/"><?php echo RT::e($s['name']); ?></a></h3>
                    <p><?php echo RT::e($s['desc']); ?></p>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section alt location-body">
        <div class="container">
            <?php echo $loc['body']; ?>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2>Why <?php echo RT::e($suburb); ?> Residents Choose Rapid Tech Solutions</h2>
            <div class="why-grid">
                <div class="why-item">
                    <?php echo rt_icon('truck'); ?>
                    <h3>Fast Response</h3>
                    <p>We are roughly <?php echo RT::e($loc['distance']); ?> minutes from
                       <?php echo RT::e($suburb); ?>, and most callouts are completed the same day.</p>
                </div>
                <div class="why-item">
                    <?php echo rt_icon('user'); ?>
                    <h3>Local Knowledge</h3>
                    <p>We work around <?php echo RT::e(rt_sentence_list(array_slice($loc['landmarks'], 0, 3))); ?>
                       regularly, and know the area's housing and business mix.</p>
                </div>
                <div class="why-item">
                    <?php echo rt_icon('dollar'); ?>
                    <h3>Transparent Pricing</h3>
                    <p>Upfront quotes before any work starts. No hidden fees, and no charge
                       if we cannot fix the problem.</p>
                </div>
                <div class="why-item">
                    <?php echo rt_icon('award'); ?>
                    <h3>Certified Technicians</h3>
                    <p>Our technicians hold Microsoft, CompTIA and cybersecurity
                       certifications, and every repair carries a 30-day warranty.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section alt">
        <div class="container">
            <h2>Areas We Service Near <?php echo RT::e($suburb); ?></h2>
            <p>This page covers <?php echo RT::e($suburb); ?> <?php echo RT::e($postcode); ?>
               and the surrounding localities, all on the same callout terms:</p>
            <ul class="nearby-suburbs">
                <?php foreach ($loc['covers'] as $near) : ?>
                <li><?php echo rt_icon('check'); ?> <?php echo RT::e($near); ?></li>
                <?php endforeach; ?>
            </ul>

            <?php if (!empty($loc['neighbours'])) : ?>
            <h3>Other areas we cover</h3>
            <ul class="neighbour-links">
                <?php foreach ($loc['neighbours'] as $n_slug) :
                    $n = $all[$n_slug] ?? null;
                    if (!$n) { continue; } ?>
                <li>
                    <a href="/computer-repairs-<?php echo RT::e($n_slug); ?>/">
                        Computer repairs <?php echo RT::e($n['suburb']); ?> <?php echo RT::e($n['postcode']); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <p><a href="/service-areas/">See every suburb we cover &rarr;</a></p>
        </div>
    </section>

    <section class="section location-faq">
        <div class="container">
            <h2>Computer Repairs in <?php echo RT::e($suburb); ?> — Common Questions</h2>
            <div class="faq-grid">
                <?php foreach ($faqs as $f) : ?>
                <details>
                    <summary><?php echo RT::e($f['q']); ?></summary>
                    <p><?php echo RT::e($f['a']); ?></p>
                </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section alt">
        <div class="container cta-panel-inner">
            <div>
                <h2>Need IT Help in <?php echo RT::e($suburb); ?> Today?</h2>
                <p>Call us and we will tell you straight away whether it is something we can
                   fix, what it is likely to cost, and how soon we can get to you.</p>
            </div>
            <div class="cta-buttons">
                <a class="btn" href="tel:<?php echo RT::PHONE_E164; ?>">
                    <?php echo rt_icon('phone'); ?> <?php echo RT::e(RT::PHONE_DISPLAY); ?>
                </a>
                <a class="btn btn-outline" href="/#contact">Request a Quote</a>
            </div>
        </div>
    </section>
</main>

<?php rt_footer(); ?>
</body>
</html>
<?php
}

/** Map a service slug to its icon key. */
function rt_service_icon(string $slug): string
{
    return [
        'computer-repairs' => 'laptop',
        'virus-removal'    => 'shield',
        'data-recovery'    => 'database',
        'network-wifi'     => 'network',
    ][$slug] ?? 'bolt';
}

/** "a, b and c" */
function rt_sentence_list(array $items): string
{
    if (count($items) < 2) {
        return (string) reset($items);
    }

    $last = array_pop($items);

    return implode(', ', $items) . ' and ' . $last;
}

/** Suburb-specific FAQ content, used for both the page and its FAQPage schema. */
function rt_location_faqs(array $loc): array
{
    $suburb = $loc['suburb'];

    return [
        [
            'q' => sprintf('How quickly can you get to %s?', $suburb),
            'a' => sprintf(
                'We are about %s minutes from %s, so we can usually be there the same day. '
                . 'For urgent problems we prioritise callouts and can often attend within one to two hours '
                . 'during business hours (%s).',
                $loc['distance'], $suburb, RT::HOURS_TEXT
            ),
        ],
        [
            'q' => 'Do you come to me, or do I bring the computer in?',
            'a' => sprintf(
                'Either. We do onsite visits throughout %s for anything that is easier to fix in place — '
                . 'network problems, printers, desktop setups. For repairs that need parts or bench time we can '
                . 'collect the machine and return it once it is done.',
                $suburb
            ),
        ],
        [
            'q' => sprintf('What does a callout to %s cost?', $suburb),
            'a' => 'Remote support starts at $80 per hour and onsite visits are $120 per hour with a '
                 . 'one-hour minimum. We quote before starting, there are no call-out surcharges within our '
                 . 'service area, and if we cannot fix it you do not pay.',
        ],
        [
            'q' => sprintf('Can you help with NBN and Wi-Fi problems in %s?', $suburb),
            'a' => sprintf(
                'Yes. We diagnose NBN connection faults, reposition or replace routers, and install mesh Wi-Fi '
                . 'where a single router cannot cover the property. Wi-Fi coverage is one of the most common '
                . 'jobs we do in %s.',
                $suburb
            ),
        ],
        [
            'q' => 'Do you offer after-hours or weekend support?',
            'a' => 'Yes, for urgent business problems such as a server outage or a suspected security breach. '
                 . 'Standard hours are ' . RT::HOURS_TEXT . '; after-hours attendance is arranged by phone.',
        ],
    ];
}
