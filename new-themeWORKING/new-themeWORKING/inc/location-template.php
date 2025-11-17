<?php
/**
 * Location Page Template Helper
 * Provides consistent structure for suburb/postcode pages
 */

if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/../');
}

function render_location_page($config) {
    $suburb = $config['suburb_name'];
    $postcode = $config['postcode'];
    $nearby = $config['nearby_suburbs'];
    $distance = $config['distance_from_base'];
    $landmarks = $config['landmarks'];
    $lat = $config['geo_lat'];
    $long = $config['geo_long'];
    $population = $config['population'];
    $issues = $config['common_issues'];
    $description = $config['suburb_description'];
    $unique_content = $config['unique_content'];
    ?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support &amp; Computer Repairs <?php echo $suburb; ?> <?php echo $postcode; ?> | Same-Day Service | Rapid Tech Solutions</title>
    <meta name="description" content="Expert IT support and computer repairs in <?php echo $suburb; ?> <?php echo $postcode; ?>. Same-day onsite service for homes and businesses. Cybersecurity, data recovery, network solutions. Call 0423 680 596.">
    <meta name="keywords" content="IT support <?php echo $suburb; ?>, computer repairs <?php echo $postcode; ?>, <?php echo $suburb; ?> IT services, computer help <?php echo $suburb; ?>, tech support <?php echo $postcode; ?>, cybersecurity <?php echo $suburb; ?>, data recovery <?php echo $postcode; ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Rapid Tech Solutions">
    <meta name="geo.region" content="AU-VIC">
    <meta name="geo.placename" content="<?php echo $suburb; ?>">
    <meta name="geo.position" content="<?php echo $lat; ?>;<?php echo $long; ?>">
    <meta name="ICBM" content="<?php echo $lat; ?>, <?php echo $long; ?>">
    <link rel="canonical" href="https://www.rapidtechsolutions.au/postcode-<?php echo $postcode; ?>/">
    <meta property="og:title" content="IT Support &amp; Computer Repairs in <?php echo $suburb; ?> <?php echo $postcode; ?>">
    <meta property="og:description" content="Professional IT services for <?php echo $suburb; ?> residents and businesses. Same-day onsite support, cybersecurity, and computer repairs.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.rapidtechsolutions.au/postcode-<?php echo $postcode; ?>/">
    <meta property="og:image" content="https://www.rapidtechsolutions.au/wp-content/themes/new-themeWORKING/images/og-image.jpg">
    <meta property="og:site_name" content="Rapid Tech Solutions">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="IT Support <?php echo $suburb; ?> <?php echo $postcode; ?> | Rapid Tech Solutions">
    <meta name="twitter:description" content="Same-day IT support and computer repairs in <?php echo $suburb; ?>. Expert technicians serving Melbourne.">
    <link rel="icon" type="image/png" href="./images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="./css/styles.css" rel="stylesheet">
    <link href="./css/location-pages.css" rel="stylesheet">

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Rapid Tech Solutions - <?php echo $suburb; ?>",
        "description": "Professional IT support, computer repairs, and cybersecurity services in <?php echo $suburb; ?> <?php echo $postcode; ?>",
        "telephone": "+61423680596",
        "url": "https://www.rapidtechsolutions.au/postcode-<?php echo $postcode; ?>/",
        "image": "https://www.rapidtechsolutions.au/wp-content/themes/new-themeWORKING/images/og-image.jpg",
        "priceRange": "$$",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "<?php echo $suburb; ?>",
            "addressRegion": "VIC",
            "postalCode": "<?php echo $postcode; ?>",
            "addressCountry": "AU"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": <?php echo $lat; ?>,
            "longitude": <?php echo $long; ?>
        },
        "areaServed": {
            "@type": "GeoCircle",
            "geoMidpoint": {
                "@type": "GeoCoordinates",
                "latitude": <?php echo $lat; ?>,
                "longitude": <?php echo $long; ?>
            },
            "geoRadius": "10000"
        },
        "serviceArea": ["<?php echo $suburb; ?>", "<?php echo implode('", "', $nearby); ?>"],
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            "opens": "09:00",
            "closes": "17:00"
        },
        "sameAs": [
            "https://www.facebook.com/rapidtechsolutions",
            "https://www.linkedin.com/company/rapidtechsolutions"
        ]
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "https://www.rapidtechsolutions.au/"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Service Areas",
                "item": "https://www.rapidtechsolutions.au/service-area/"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "<?php echo $suburb; ?> <?php echo $postcode; ?>",
                "item": "https://www.rapidtechsolutions.au/postcode-<?php echo $postcode; ?>/"
            }
        ]
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "serviceType": "IT Support and Computer Repair",
        "provider": {
            "@type": "LocalBusiness",
            "name": "Rapid Tech Solutions"
        },
        "areaServed": {
            "@type": "City",
            "name": "<?php echo $suburb; ?>"
        },
        "description": "Comprehensive IT support including computer repairs, cybersecurity, data recovery, and network solutions for <?php echo $suburb; ?> <?php echo $postcode; ?>"
    }
    </script>
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>

    <header class="site-header" role="banner">
        <div class="container header-inner">
            <a class="brand" href="https://www.rapidtechsolutions.au/">
                <span class="brand-mark" aria-hidden="true">⚡</span>
                Rapid Tech Solutions
            </a>
            <button class="menu-toggle" aria-expanded="false" aria-controls="primary-nav">
                <span class="sr-only">Toggle navigation</span>
                <i class="fas fa-bars"></i>
            </button>
            <nav id="primary-nav" class="primary-nav" aria-label="Main navigation">
                <a href="https://www.rapidtechsolutions.au/#services">Services</a>
                <a href="https://www.rapidtechsolutions.au/#solutions">Solutions</a>
                <a href="https://www.rapidtechsolutions.au/service-area/">Service Areas</a>
                <a href="https://www.rapidtechsolutions.au/#testimonials">Reviews</a>
                <a href="https://www.rapidtechsolutions.au/#contact" class="btn btn-outline">Book Support</a>
            </nav>
        </div>
    </header>

    <nav class="breadcrumb" aria-label="Breadcrumb">
        <div class="container">
            <ol itemscope itemtype="https://schema.org/BreadcrumbList">
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="https://www.rapidtechsolutions.au/">
                        <span itemprop="name">Home</span>
                    </a>
                    <meta itemprop="position" content="1">
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="https://www.rapidtechsolutions.au/service-area/">
                        <span itemprop="name">Service Areas</span>
                    </a>
                    <meta itemprop="position" content="2">
                </li>
                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?php echo $suburb; ?> <?php echo $postcode; ?></span>
                    <meta itemprop="position" content="3">
                </li>
            </ol>
        </div>
    </nav>

    <main id="main">
        <section class="location-hero">
            <div class="container">
                <div class="location-hero-content">
                    <p class="eyebrow">IT Services in <?php echo $suburb; ?></p>
                    <h1>Expert Computer Repairs &amp; IT Support in <?php echo $suburb; ?> <?php echo $postcode; ?></h1>
                    <p class="lead"><?php echo $description; ?></p>
                    <div class="hero-cta">
                        <a class="btn" href="tel:+61423680596">
                            <i class="fas fa-phone"></i> Call 0423 680 596
                        </a>
                        <a class="btn btn-outline" href="https://www.rapidtechsolutions.au/#contact">
                            Book Online
                        </a>
                    </div>
                    <ul class="hero-badges">
                        <li><i class="fas fa-clock"></i> Same-day service available</li>
                        <li><i class="fas fa-map-marker-alt"></i> <?php echo $distance; ?> min from our base</li>
                        <li><i class="fas fa-star"></i> 4.9★ customer rating</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="location-services section">
            <div class="container">
                <h2>IT Services We Provide in <?php echo $suburb; ?></h2>
                <p>With a population of <?php echo $population; ?> residents, <?php echo $suburb; ?> has diverse technology needs. Our technicians provide tailored solutions for both residential and commercial clients in the area.</p>

                <div class="services-grid">
                    <article class="service-card">
                        <i class="fas fa-laptop-medical" aria-hidden="true"></i>
                        <h3>Computer Repairs <?php echo $suburb; ?></h3>
                        <p>Fast diagnostics and repairs for laptops, desktops, and gaming PCs. We service all major brands and can often complete repairs same-day at your <?php echo $suburb; ?> location.</p>
                        <ul>
                            <li>Hardware diagnostics and replacement</li>
                            <li>Virus and malware removal</li>
                            <li>Operating system reinstallation</li>
                            <li>SSD upgrades for faster performance</li>
                        </ul>
                    </article>

                    <article class="service-card">
                        <i class="fas fa-shield-halved" aria-hidden="true"></i>
                        <h3>Cybersecurity Services</h3>
                        <p>Protect your <?php echo $suburb; ?> home or business from cyber threats with enterprise-grade security solutions.</p>
                        <ul>
                            <li>Antivirus and endpoint protection</li>
                            <li>Firewall configuration</li>
                            <li>Security audits and assessments</li>
                            <li>Staff security awareness training</li>
                        </ul>
                    </article>

                    <article class="service-card">
                        <i class="fas fa-network-wired" aria-hidden="true"></i>
                        <h3>Network Solutions</h3>
                        <p>Reliable Wi-Fi and network infrastructure for <?php echo $suburb; ?> properties. We solve <?php echo implode(', ', $issues); ?>.</p>
                        <ul>
                            <li>NBN troubleshooting and optimization</li>
                            <li>Mesh Wi-Fi system installation</li>
                            <li>Business network design</li>
                            <li>4G/5G failover solutions</li>
                        </ul>
                    </article>

                    <article class="service-card">
                        <i class="fas fa-database" aria-hidden="true"></i>
                        <h3>Data Recovery &amp; Backup</h3>
                        <p>Lost important files? Our data recovery experts retrieve data from failed drives and set up automated backup systems.</p>
                        <ul>
                            <li>Hard drive and SSD recovery</li>
                            <li>Cloud backup solutions</li>
                            <li>Disaster recovery planning</li>
                            <li>RAID array recovery</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        <section class="location-unique section alt">
            <div class="container">
                <?php echo $unique_content; ?>
            </div>
        </section>

        <section class="location-why section">
            <div class="container">
                <h2>Why <?php echo $suburb; ?> Residents Choose Rapid Tech Solutions</h2>
                <div class="why-grid">
                    <div class="why-item">
                        <i class="fas fa-truck-fast"></i>
                        <h3>Fast Response Times</h3>
                        <p>Located just <?php echo $distance; ?> minutes from <?php echo $suburb; ?>, we can reach your home or business quickly. Most callouts are completed same-day.</p>
                    </div>
                    <div class="why-item">
                        <i class="fas fa-user-tie"></i>
                        <h3>Local Knowledge</h3>
                        <p>We understand <?php echo $suburb; ?>'s unique mix of residential and business properties. From homes near <?php echo $landmarks[0]; ?> to local businesses, we've serviced them all.</p>
                    </div>
                    <div class="why-item">
                        <i class="fas fa-dollar-sign"></i>
                        <h3>Transparent Pricing</h3>
                        <p>No hidden fees or surprise charges. We provide upfront quotes before starting any work.</p>
                    </div>
                    <div class="why-item">
                        <i class="fas fa-award"></i>
                        <h3>Certified Experts</h3>
                        <p>Our technicians hold certifications in Microsoft, CompTIA, and cybersecurity.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="location-areas section alt">
            <div class="container">
                <h2>Areas We Service Near <?php echo $suburb; ?></h2>
                <p>In addition to <?php echo $suburb; ?> <?php echo $postcode; ?>, we provide IT support to surrounding suburbs:</p>
                <ul class="nearby-suburbs">
                    <?php foreach($nearby as $area): ?>
                    <li><i class="fas fa-check"></i> <?php echo $area; ?></li>
                    <?php endforeach; ?>
                </ul>
                <p>Whether you're near <?php echo implode(', ', array_slice($landmarks, 0, 3)); ?>, or anywhere else in the <?php echo $postcode; ?> postcode area, we've got you covered.</p>
            </div>
        </section>

        <section class="location-cta section">
            <div class="container cta-panel-inner">
                <div>
                    <h2>Need IT Help in <?php echo $suburb; ?> Today?</h2>
                    <p>Don't let technology problems slow you down. Our <?php echo $suburb; ?> IT support team is ready to help with computer repairs, network issues, data recovery, and more.</p>
                </div>
                <div class="cta-buttons">
                    <a class="btn" href="tel:+61423680596">
                        <i class="fas fa-phone"></i> 0423 680 596
                    </a>
                    <a class="btn btn-outline" href="https://www.rapidtechsolutions.au/#contact">
                        Request a Quote
                    </a>
                </div>
            </div>
        </section>

        <section class="location-faq section alt">
            <div class="container">
                <h2>Frequently Asked Questions - <?php echo $suburb; ?> IT Support</h2>
                <div class="faq-grid">
                    <details>
                        <summary>How quickly can you get to <?php echo $suburb; ?>?</summary>
                        <p>We can typically reach <?php echo $suburb; ?> within <?php echo $distance; ?> minutes during business hours. For urgent issues, we prioritize same-day service and can often be there within 1-2 hours.</p>
                    </details>
                    <details>
                        <summary>Do you offer after-hours IT support in <?php echo $suburb; ?>?</summary>
                        <p>Yes, we provide emergency after-hours and weekend support for critical IT issues. Whether your business server crashes or you experience a security breach, we're available when you need us.</p>
                    </details>
                    <details>
                        <summary>What are your rates for <?php echo $suburb; ?> callouts?</summary>
                        <p>We offer competitive hourly rates with no hidden fees. Remote support starts from $80/hour, and onsite visits are $120/hour with a minimum 1-hour charge. We provide free quotes for larger projects.</p>
                    </details>
                    <details>
                        <summary>Can you help with NBN issues in <?php echo $suburb; ?>?</summary>
                        <p>Absolutely! We diagnose NBN connectivity problems, optimize router placement, and configure your network for maximum speed and reliability in <?php echo $suburb; ?>.</p>
                    </details>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer" role="contentinfo">
        <div class="container footer-grid">
            <div>
                <a class="brand" href="https://www.rapidtechsolutions.au/">Rapid Tech Solutions</a>
                <p>Professional IT support and computer repairs serving <?php echo $suburb; ?> <?php echo $postcode; ?> and surrounding Melbourne suburbs.</p>
                <div class="social">
                    <a href="https://www.facebook.com/rapidtechsolutions" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.linkedin.com/company/rapidtechsolutions" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div>
                <h3>Our Services</h3>
                <ul>
                    <li><a href="https://www.rapidtechsolutions.au/#services">Computer Repairs</a></li>
                    <li><a href="https://www.rapidtechsolutions.au/#services">Cybersecurity</a></li>
                    <li><a href="https://www.rapidtechsolutions.au/#services">Data Recovery</a></li>
                    <li><a href="https://www.rapidtechsolutions.au/#services">Network Solutions</a></li>
                    <li><a href="https://www.rapidtechsolutions.au/#services">Cloud Services</a></li>
                </ul>
            </div>
            <div>
                <h3>Contact Us</h3>
                <ul>
                    <li><a href="tel:+61423680596">0423 680 596</a></li>
                    <li><a href="mailto:support@rapidtechsolutions.au">support@rapidtechsolutions.au</a></li>
                    <li>Patterson Lakes, VIC 3197</li>
                    <li>ABN 64 654 861 096</li>
                </ul>
            </div>
        </div>
        <p class="footer-note">© <?php echo date('Y'); ?> Rapid Tech Solutions. IT Support <?php echo $suburb; ?> <?php echo $postcode; ?>. All rights reserved.</p>
    </footer>

    <script>
        const toggle = document.querySelector('.menu-toggle');
        const nav = document.getElementById('primary-nav');
        if (toggle) {
            toggle.addEventListener('click', () => {
                const expanded = toggle.getAttribute('aria-expanded') === 'true';
                toggle.setAttribute('aria-expanded', (!expanded).toString());
                nav.classList.toggle('is-open');
            });
        }
    </script>
</body>
</html>
<?php
}
?>
