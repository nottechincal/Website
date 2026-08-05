<?php
/*
Template Name: About
*/
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'About Rapid Tech Solutions | Local IT Support Melbourne',
    'description' => 'Meet the team behind Rapid Tech Solutions. Local, honest computer repairs and IT support based in Cranbourne South, serving Melbourne\'s south-east.',
    'path'        => '/about/',
    'css'         => 'css/blog.css',
    'schema'      => [[
        '@type' => 'AboutPage',
        'mainEntity' => RT::local_business([
            'description'  => 'Local IT support and computer repair services in Cranbourne South and Melbourne\'s south-east',
            'foundingDate' => '2020',
            'areaServed'   => 'Melbourne, Victoria, Australia',
        ]),
    ]],
]); ?>
</head>
<body>
<?php rt_header(); ?>

    <main id="main">
        <div class="article-header">
            <div class="container">
                <h1>About Rapid Tech Solutions</h1>
                <p class="article-excerpt">Your trusted local IT support team in <?php echo RT::e(RT::LOCALITY); ?> and Melbourne.</p>
            </div>
        </div>

        <article class="article-content">
            <section>
                <h2>Who We Are</h2>
                <p>Rapid Tech Solutions is a local IT support company serving <?php echo RT::e(RT::LOCALITY); ?>, Frankston, and the greater Melbourne area. We're not a big corporation with call centres and long wait times—we're your neighbours who happen to be really good with computers.</p>
                <p>We understand that technology problems are frustrating, and we believe everyone deserves access to honest, affordable IT support. That's why we started Rapid Tech Solutions: to provide the kind of service we'd want for our own families.</p>
            </section>

            <section>
                <h2>Our Mission</h2>
                <div class="stat-box">
                    <p><strong>Simple:</strong> Help Melbourne families and small businesses solve their tech problems quickly, honestly, and affordably—without the jargon.</p>
                </div>
            </section>

            <section>
                <h2>What Makes Us Different</h2>

                <h3>We Speak Human, Not Tech</h3>
                <p>We explain problems in plain English. No confusing acronyms, no technical jargon. You'll understand exactly what's wrong and what we're doing to fix it.</p>

                <h3>Honest Pricing</h3>
                <p>Free diagnostics. Upfront quotes. No hidden fees. We believe in transparency because that's how we'd want to be treated. If a repair costs more than the device is worth, we'll tell you.</p>

                <h3>Local and Responsive</h3>
                <p>Based in <?php echo RT::e(RT::LOCALITY); ?>, we're never far away. Same-day service is often available, and we actually answer our phone. Try us: <?php echo RT::e(RT::PHONE_DISPLAY); ?>.</p>

                <h3>We Care About You, Not Just Your Computer</h3>
                <p>We take time to understand your needs. A grandmother who just wants to video call her grandkids gets different advice than a small business owner needing network security. One size doesn't fit all.</p>

                <h3>We Educate, Not Just Fix</h3>
                <p>We'll show you how to avoid future problems. Our blog is full of free tips, and we're always happy to answer questions. Knowledge is the best prevention.</p>
            </section>

            <section>
                <h2>Our Values</h2>
                <ul>
                    <li><strong>Honesty:</strong> We'll always tell you the truth, even if it's not what you want to hear</li>
                    <li><strong>Respect:</strong> Your time and money matter. We work efficiently and charge fairly</li>
                    <li><strong>Quality:</strong> We do the job right the first time, with a warranty to back it up</li>
                    <li><strong>Community:</strong> We're part of <?php echo RT::e(RT::LOCALITY); ?> and we support our local community</li>
                    <li><strong>Continuous Learning:</strong> Technology evolves fast, and so do we</li>
                </ul>
            </section>

            <section>
                <h2>Areas We Serve</h2>
                <p>We provide on-site and remote IT support across:</p>
                <ul>
                    <li><?php echo RT::e(RT::LOCALITY); ?> <?php echo RT::POSTCODE; ?> - Our home base</li>
                    <li>Carrum, Bonbeach, Chelsea</li>
                    <li>Frankston and Seaford</li>
                    <li>Mentone, Mordialloc, Parkdale</li>
                    <li>Dandenong and surrounding suburbs</li>
                    <li>All of Melbourne's south-east</li>
                </ul>
                <p>Not sure if we cover your area? Just ask—we're often able to help!</p>
            </section>

            <section>
                <h2>Our Services</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin: 1.5rem 0;">
                    <div style="background: rgba(41, 213, 255, 0.1); padding: 1rem; border-radius: 8px;">
                        <h4 style="color: #29d5ff; margin-top: 0;"><?php echo rt_icon('laptop'); ?> Computer Repairs</h4>
                        <p style="margin: 0; font-size: 0.95rem;">Laptops, desktops, all brands. From simple fixes to complex repairs.</p>
                    </div>
                    <div style="background: rgba(0, 255, 204, 0.1); padding: 1rem; border-radius: 8px;">
                        <h4 style="color: #00ffcc; margin-top: 0;"><?php echo rt_icon('database'); ?> Data Recovery</h4>
                        <p style="margin: 0; font-size: 0.95rem;">Lost photos, documents, or files? We can often recover them.</p>
                    </div>
                    <div style="background: rgba(255, 149, 0, 0.1); padding: 1rem; border-radius: 8px;">
                        <h4 style="color: #ff9500; margin-top: 0;"><?php echo rt_icon('shield'); ?> Security Services</h4>
                        <p style="margin: 0; font-size: 0.95rem;">Virus removal, malware protection, security setup.</p>
                    </div>
                    <div style="background: rgba(255, 92, 92, 0.1); padding: 1rem; border-radius: 8px;">
                        <h4 style="color: #ff5c5c; margin-top: 0;"><?php echo rt_icon('wifi'); ?> Network Setup</h4>
                        <p style="margin: 0; font-size: 0.95rem;">WiFi problems solved. Home and small business networking.</p>
                    </div>
                </div>
            </section>

            <section>
                <h2>Why Customers Choose Us</h2>
                <div class="pro-tip">
                    <p>"They don't try to sell you things you don't need. They fixed my laptop quickly and explained everything. Finally, an IT company I can trust!" <br>— Sarah M., Patterson Lakes</p>
                </div>
                <ul>
                    <li>5-star Google reviews</li>
                    <li>Same-day service available</li>
                    <li>Free diagnostics on all repairs</li>
                    <li>30-day labour warranty</li>
                    <li>Local, not outsourced</li>
                    <li>Fair, transparent pricing</li>
                </ul>
            </section>

            <section class="cta-section">
                <h2>Ready to Experience the Difference?</h2>
                <p>Whether you have a virus, a slow computer, or just need some tech advice, we're here to help. Contact us today for friendly, professional IT support.</p>
                <div class="cta-buttons">
                    <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn"><?php echo rt_icon('phone'); ?> Call: <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                    <a href="/book/" class="btn btn-outline"><?php echo rt_icon('mail'); ?> Send a Message</a>
                </div>
            </section>
        </article>
    </main>

<?php rt_footer(); ?>
</body>
</html>
