<?php
/*
Template Name: Service Areas
*/
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';

$area_inline_css = <<<'CSS'
.area-hero {
    background: linear-gradient(135deg, #0f1016 0%, #1a1a2e 100%);
    padding: 4rem 0;
    text-align: center;
}
.area-hero h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}
.suburb-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    padding: 3rem 0;
}
.suburb-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
}
.suburb-card:hover {
    transform: translateY(-5px);
    border-color: var(--accent);
    box-shadow: 0 10px 30px rgba(41, 213, 255, 0.1);
}
.suburb-card h3 {
    color: var(--text);
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}
.suburb-card .postcode {
    color: var(--accent);
    font-size: 0.9rem;
    margin-bottom: 0.75rem;
}
.suburb-card p {
    color: var(--muted);
    font-size: 0.9rem;
    margin-bottom: 1rem;
}
.suburb-card .btn {
    width: 100%;
    text-align: center;
    font-size: 0.9rem;
}
.region-section {
    margin-bottom: 3rem;
}
.region-section h2 {
    color: var(--text);
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid rgba(41, 213, 255, 0.3);
}
.stats-banner {
    background: rgba(41, 213, 255, 0.1);
    padding: 2rem;
    border-radius: 12px;
    text-align: center;
    margin: 2rem 0;
}
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 2rem;
    margin-top: 1.5rem;
}
.stat-item h3 {
    font-size: 2rem;
    color: var(--accent);
    margin-bottom: 0.5rem;
}
.stat-item p {
    color: var(--muted);
    font-size: 0.9rem;
}
CSS;
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Service Areas | Computer Repairs Melbourne South-East',
    'description' => 'Every suburb we cover for computer repairs and IT support, from Cranbourne and Berwick through to Frankston, Chelsea and Mordialloc. Same-day callouts.',
    'path'        => '/service-areas/',
    'css'         => 'css/blog.css',
    'inline_css'  => $area_inline_css,
    'schema'      => [[
        '@type'       => 'Service',
        'serviceType' => 'Computer Repair',
        'provider'    => RT::local_business(),
        'areaServed'  => [
            ['@type' => 'City', 'name' => 'Cranbourne South'],
            ['@type' => 'City', 'name' => 'Cranbourne'],
            ['@type' => 'City', 'name' => 'Berwick'],
            ['@type' => 'City', 'name' => 'Narre Warren'],
            ['@type' => 'City', 'name' => 'Frankston'],
            ['@type' => 'City', 'name' => 'Patterson Lakes'],
        ],
        'description' => 'Professional computer repair and IT support services across Melbourne\'s south-east suburbs',
    ]],
]); ?>
</head>
<body>
<?php rt_header(); ?>
<?php rt_breadcrumbs(['Service Areas' => '/service-areas/']); ?>

    <main id="main">
        <div class="area-hero">
            <div class="container">
                <h1><?php echo rt_icon('pin'); ?> Our Service Areas</h1>
                <p style="color: var(--muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Professional computer repairs and IT support across Melbourne's south-east. Same-day service, free diagnostics, no fix no fee guarantee.</p>
            </div>
        </div>

        <div class="container">
            <div class="stats-banner">
                <h2 style="margin-top: 0; color: var(--text);">Trusted Across Melbourne's South-East</h2>
                <div class="stats-grid">
                    <div class="stat-item"><h3>25+</h3><p>Suburbs Serviced</p></div>
                    <div class="stat-item"><h3><?php echo RT::RATING_VALUE; ?></h3><p>Star Rating</p></div>
                    <div class="stat-item"><h3>Same-Day</h3><p>Service Available</p></div>
                    <div class="stat-item"><h3>No Fix</h3><p>No Fee Guarantee</p></div>
                </div>
            </div>

            <div class="region-section">
                <h2><?php echo rt_icon('home'); ?> Cranbourne & Surrounds (Primary Service Area)</h2>
                <div class="suburb-grid">
                    <div class="suburb-card"><h3>Cranbourne</h3><div class="postcode">Postcode: 3977</div><p>Fast computer repairs in Cranbourne. Same-day service for laptops, desktops, virus removal, and data recovery.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Cranbourne North</h3><div class="postcode">Postcode: 3977</div><p>Expert IT support for Cranbourne North families and businesses. Free diagnostics included.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Cranbourne East</h3><div class="postcode">Postcode: 3977</div><p>Computer repairs and network setup for the growing Cranbourne East community.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Cranbourne West</h3><div class="postcode">Postcode: 3977</div><p>Local computer technician serving Cranbourne West homes and businesses.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Clyde</h3><div class="postcode">Postcode: 3978</div><p>Reliable computer repairs for Clyde residents. 30-day warranty on all repairs.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Clyde North</h3><div class="postcode">Postcode: 3978</div><p>Growing suburb, growing IT needs. We're your local tech experts in Clyde North.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Junction Village</h3><div class="postcode">Postcode: 3977</div><p>Computer repairs and WiFi solutions for Junction Village homes.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Botanic Ridge</h3><div class="postcode">Postcode: 3977</div><p>Premium IT support for Botanic Ridge's modern community.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Devon Meadows</h3><div class="postcode">Postcode: 3977</div><p>Rural-friendly computer repairs serving Devon Meadows properties.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                </div>
            </div>

            <div class="region-section">
                <h2>🏢 Casey & Greater Dandenong</h2>
                <div class="suburb-grid">
                    <div class="suburb-card"><h3>Dandenong</h3><div class="postcode">Postcode: 3175</div><p>Computer repairs and business IT support across Dandenong, Noble Park, Keysborough and Springvale.</p><a href="/computer-repairs-dandenong/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Berwick</h3><div class="postcode">Postcode: 3806</div><p>Professional computer repairs in Berwick. Business and home IT support.</p><a href="/computer-repairs-berwick/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Narre Warren</h3><div class="postcode">Postcode: 3805</div><p>Fast, reliable computer repairs for Narre Warren families.</p><a href="/computer-repairs-narre-warren/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Narre Warren South</h3><div class="postcode">Postcode: 3805</div><p>Expert IT support for Narre Warren South residents and businesses.</p><a href="/computer-repairs-narre-warren/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Hampton Park</h3><div class="postcode">Postcode: 3976</div><p>Affordable computer repairs and virus removal in Hampton Park.</p><a href="/computer-repairs-narre-warren/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Lynbrook</h3><div class="postcode">Postcode: 3975</div><p>Quick computer repairs for Lynbrook homes. Same-day service available.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Lyndhurst</h3><div class="postcode">Postcode: 3975</div><p>Trusted computer technician for Lyndhurst families and businesses.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                </div>
            </div>

            <div class="region-section">
                <h2>🏖️ Patterson Lakes & Bayside</h2>
                <div class="suburb-grid">
                    <div class="suburb-card"><h3>Patterson Lakes</h3><div class="postcode">Postcode: 3197</div><p>Computer repairs for Patterson Lakes homes. WiFi and network specialists.</p><a href="/computer-repairs-patterson-lakes/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Chelsea Heights</h3><div class="postcode">Postcode: 3196</div><p>Local computer technician serving Chelsea Heights community.</p><a href="/computer-repairs-chelsea/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Carrum</h3><div class="postcode">Postcode: 3197</div><p>Beachside computer repairs for Carrum residents. Fast and reliable service.</p><a href="/computer-repairs-patterson-lakes/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Chelsea</h3><div class="postcode">Postcode: 3196</div><p>Computer repairs across Chelsea, Chelsea Heights, Edithvale and Aspendale.</p><a href="/computer-repairs-chelsea/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Mordialloc</h3><div class="postcode">Postcode: 3195</div><p>Computer repairs and IT support across Mordialloc, Mentone, Cheltenham and Beaumaris.</p><a href="/computer-repairs-mordialloc/" class="btn btn-outline">View Details</a></div>
                </div>
            </div>

            <div class="region-section">
                <h2>🏙️ Frankston & Mornington Peninsula</h2>
                <div class="suburb-grid">
                    <div class="suburb-card"><h3>Frankston</h3><div class="postcode">Postcode: 3199</div><p>Business IT support and home computer repairs in Frankston.</p><a href="/computer-repairs-frankston/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Seaford</h3><div class="postcode">Postcode: 3198</div><p>Gaming PC repairs and family computer support in Seaford.</p><a href="/computer-repairs-seaford/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Carrum Downs</h3><div class="postcode">Postcode: 3201</div><p>Professional computer repairs serving Carrum Downs businesses.</p><a href="/computer-repairs-carrum-downs/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Langwarrin</h3><div class="postcode">Postcode: 3910</div><p>Reliable IT support for Langwarrin homes and small businesses.</p><a href="/computer-repairs-frankston/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Skye</h3><div class="postcode">Postcode: 3977</div><p>Computer repairs and data recovery for Skye residents.</p><a href="/computer-repairs-carrum-downs/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Sandhurst</h3><div class="postcode">Postcode: 3977</div><p>Premium IT support for Sandhurst's modern estate homes.</p><a href="/computer-repairs-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Pearcedale</h3><div class="postcode">Postcode: 3912</div><p>Rural computer repairs serving Pearcedale and surrounds.</p><a href="/computer-repairs-frankston/" class="btn btn-outline">View Details</a></div>
                </div>
            </div>

            <div class="region-section">
                <h2><?php echo rt_icon('wrench'); ?> Specialist Services by Location</h2>
                <p>Some services have their own dedicated page for a specific area:</p>
                <div class="suburb-grid">
                    <div class="suburb-card"><h3>Data Recovery Frankston</h3><div class="postcode">Postcode: 3199</div><p>Failed drives, dead SSDs and deleted files recovered. Free assessment.</p><a href="/data-recovery-frankston/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Data Recovery Patterson Lakes</h3><div class="postcode">Postcode: 3197</div><p>Drive and storage recovery for Patterson Lakes homes and businesses.</p><a href="/data-recovery-patterson-lakes/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Virus Removal Cranbourne</h3><div class="postcode">Postcode: 3977</div><p>Complete malware and ransomware clean-up, with protection set up afterwards.</p><a href="/virus-removal-cranbourne/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Virus Removal Dandenong</h3><div class="postcode">Postcode: 3175</div><p>Same-day virus, spyware and ransomware removal in Dandenong.</p><a href="/virus-removal-dandenong/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Network Setup Berwick</h3><div class="postcode">Postcode: 3806</div><p>Wi-Fi dead zones, mesh installs, NBN faults and business networks.</p><a href="/network-setup-berwick/" class="btn btn-outline">View Details</a></div>
                    <div class="suburb-card"><h3>Emergency Repairs Melbourne</h3><div class="postcode">South-East</div><p>Urgent same-day callouts for crashed systems and business outages.</p><a href="/emergency-computer-repair-melbourne/" class="btn btn-outline">View Details</a></div>
                </div>
            </div>

            <section class="cta-section" style="margin-top: 3rem;">
                <h2>Don't See Your Suburb?</h2>
                <p>We service all of Melbourne's south-east! If your suburb isn't listed, give us a call and we'll let you know if we can help. Most areas within 20km of <?php echo RT::e(RT::LOCALITY); ?> are covered.</p>
                <div class="cta-buttons">
                    <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn"><?php echo rt_icon('phone'); ?> Call: <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                    <a href="/book/" class="btn btn-outline"><?php echo rt_icon('mail'); ?> Contact Us</a>
                </div>
            </section>
        </div>
    </main>

<?php rt_footer(); ?>
</body>
</html>
