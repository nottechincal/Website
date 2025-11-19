<?php
// Define base path - works with or without WordPress
if (function_exists('get_template_directory_uri')) {
    $base_path = get_template_directory_uri();
} else {
    // Get the directory of this script relative to document root
    $script_dir = dirname($_SERVER['SCRIPT_NAME']);
    $base_path = ($script_dir === '/' || $script_dir === '\\') ? '' : $script_dir;
}
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rapid Tech Solutions delivers fast computer repairs, proactive cybersecurity, data recovery, and managed IT support across Cranbourne South, Patterson Lakes, and Melbourne's south-east.">
    <meta name="keywords" content="IT services Cranbourne South, computer repair Melbourne, data recovery 3977, managed IT support Victoria, cybersecurity expert Australia, computer repairs Cranbourne, computer repairs Patterson Lakes, IT support Frankston">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Rapid Tech Solutions">
    <meta name="geo.region" content="AU-VIC">
    <meta name="geo.placename" content="Cranbourne South">
    <meta name="geo.position" content="-38.1333;145.2667">
    <meta name="ICBM" content="-38.1333, 145.2667">
    <meta property="og:title" content="Rapid Tech Solutions | Modern IT Services in Melbourne">
    <meta property="og:description" content="Human-first IT support, cloud expertise, and cybersecurity for homes and growing businesses in Cranbourne South, Patterson Lakes, and Melbourne's south-east.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.rapidtechsolutions.au">
    <meta property="og:image" content="https://www.rapidtechsolutions.au/images/og-image.jpg">
    <meta property="og:site_name" content="Rapid Tech Solutions">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Rapid Tech Solutions">
    <meta name="twitter:description" content="On-demand IT services, repairs, and cybersecurity protection across Melbourne.">
    <meta name="twitter:image" content="https://www.rapidtechsolutions.au/images/og-image.jpg">
    <link rel="canonical" href="https://www.rapidtechsolutions.au/">
    <link rel="icon" type="image/svg+xml" href="<?php echo $base_path; ?>/images/favicon.svg">
    <link rel="alternate icon" type="image/png" href="<?php echo $base_path; ?>/images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://www.google.com">
    <link rel="preload" href="<?php echo $base_path; ?>/images/fallback.webp" as="image" type="image/webp" fetchpriority="high">
    <!-- Critical CSS loaded synchronously -->
    <link href="<?php echo $base_path; ?>/css/styles.css" rel="stylesheet">
    <!-- Non-critical CSS deferred -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" media="print" onload="this.media='all'" referrerpolicy="no-referrer">
    <link href="<?php echo $base_path; ?>/css/animations.css" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        <link href="<?php echo $base_path; ?>/css/animations.css" rel="stylesheet">
    </noscript>
    <title>Rapid Tech Solutions | Expert IT Support & Computer Repairs Melbourne | Cranbourne South</title>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Rapid Tech Solutions",
        "description": "Computer repair, cybersecurity, data recovery, and managed IT support in Cranbourne South.",
        "telephone": "+61423680596",
        "url": "https://www.rapidtechsolutions.au",
        "logo": "https://www.rapidtechsolutions.au/images/logo.png",
        "image": "https://www.rapidtechsolutions.au/images/og-image.jpg",
        "priceRange": "$$",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Cranbourne South",
            "addressLocality": "Melbourne",
            "addressRegion": "VIC",
            "postalCode": "3977",
            "addressCountry": "AU"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": -38.1333,
            "longitude": 145.2667
        },
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
            "opens": "09:00",
            "closes": "17:00"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "5.0",
            "reviewCount": "47",
            "bestRating": "5",
            "worstRating": "1"
        },
        "sameAs": [
            "https://www.facebook.com/RapidTechAUS/",
            "https://www.instagram.com/rapidtechsolutions.au/"
        ],
        "areaServed": ["Cranbourne South","Cranbourne","Berwick","Narre Warren","Clyde","Patterson Lakes","Frankston","Chelsea Heights","Carrum","Seaford","Melbourne","Mornington Peninsula"],
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "IT Services",
            "itemListElement": [
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Computer Repairs",
                        "description": "Fast diagnostics, component upgrades, and repairs for laptops, desktops, and gaming PCs"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Cybersecurity Services",
                        "description": "Endpoint protection, phishing defense, and zero-trust security policies"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Data Recovery",
                        "description": "SSD and HDD recovery, server restores, and encrypted backup solutions"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Network Solutions",
                        "description": "Business-grade WiFi, mesh networks, and 4G/5G failover connectivity"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Cloud & Microsoft 365",
                        "description": "Migrations, license optimization, and SharePoint automation"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Service",
                        "name": "Virtual CIO Advisory",
                        "description": "IT roadmaps, budgeting, and technology strategy consulting"
                    }
                }
            ]
        }
    }
    </script>
    <!-- Google tag (gtag.js) - Deferred for performance -->
    <script defer src="https://www.googletagmanager.com/gtag/js?id=G-BDN34WT3J6"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-BDN34WT3J6');
    </script>
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>
    <header class="site-header" role="banner">
        <div class="container header-inner">
            <a class="brand" href="/">
                <span class="brand-mark lightning-animated" aria-hidden="true"></span>
                Rapid Tech Solutions
            </a>
            <button class="menu-toggle" aria-expanded="false" aria-controls="primary-nav">
                <span class="sr-only">Toggle navigation</span>
                <i class="fas fa-bars"></i>
            </button>
            <nav id="primary-nav" class="primary-nav" aria-label="Main navigation">
                <a href="#services">Services</a>
                <a href="#solutions">Solutions</a>
                <a href="#process">Process</a>
                <a href="/blog/">Blog</a>
                <a href="/faq/">FAQ</a>
                <a href="#contact" class="btn btn-outline">Get in Touch</a>
            </nav>
        </div>
    </header>

    <!-- Emergency Services Banner - Sticky on Scroll -->
    <div id="emergency-banner" style="background: linear-gradient(90deg, #ff5c5c 0%, #e24646 100%); color: white; padding: 0.75rem 0; text-align: center; font-weight: 500; position: relative; z-index: 999; transition: all 0.3s ease;">
        <div class="container" style="display: flex; align-items: center; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            <span><i class="fas fa-bolt"></i> Same-Day Emergency Service Available</span>
            <a href="tel:+61423680596" style="background: white; color: #ff5c5c; padding: 0.4rem 1rem; border-radius: 20px; font-weight: 600; text-decoration: none; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">Call Now: 0423 680 596</a>
        </div>
    </div>

    <a href="http://wa.me/61423680596" target="_blank" class="whatsapp-icon" aria-label="Chat with Rapid Tech Solutions on WhatsApp">
        <i class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>
    <a href="#contact" class="sticky-cta" aria-label="Contact Rapid Tech Solutions">Get Rapid Support</a>

    <main id="main">
        <section class="hero" aria-label="Rapid Tech Solutions hero">
            <video autoplay muted loop playsinline id="bg-video" poster="<?php echo $base_path; ?>/images/fallback.webp" fetchpriority="high">
                <!-- Video sources loaded only on desktop for performance -->
            </video>
            <div class="hero-overlay"></div>
            <div class="container hero-grid">
                <div class="hero-copy">
                    <p class="eyebrow">Melbourne & Patterson Lakes</p>
                    <h1>Computer Problems? We Fix Them Fast.</h1>
                    <p class="lead">Your local IT experts. We repair computers, remove viruses, fix slow internet, and recover lost files. Same-day service for homes and businesses across Melbourne.</p>
                    <div class="hero-cta">
                        <a class="btn" href="#contact">Get Help Today</a>
                        <a class="btn btn-outline" href="tel:+61423680596">Call 0423 680 596</a>
                    </div>
                    <ul class="hero-badges" aria-label="Key service highlights">
                        <li><i class="fas fa-bolt"></i> Same-day service</li>
                        <li><i class="fas fa-shield"></i> Virus & malware removal</li>
                        <li><i class="fas fa-home"></i> We come to you</li>
                    </ul>
                </div>
                <div class="hero-card" role="complementary" aria-label="Service summary card">
                    <h2>Common Problems We Fix</h2>
                    <p>Don't put up with frustrating computer issues. We solve them quickly and affordably.</p>
                    <ul>
                        <li>Slow or freezing computers</li>
                        <li>Virus and popup removal</li>
                        <li>WiFi and internet problems</li>
                        <li>Lost or deleted files</li>
                        <li>Printer not working</li>
                    </ul>
                    <a class="btn btn-full" href="#services">See All Services</a>
                </div>
            </div>
            <div class="container stats" aria-label="Impact statistics">
                <article data-animate="fade-up">
                    <span>500+</span>
                    <p>Devices secured & repaired</p>
                </article>
                <article data-animate="fade-up" data-delay="0">
                    <span>97%</span>
                    <p>Same-day resolution rate</p>
                </article>
                <article data-animate="fade-up" data-delay="100">
                    <span>4.9★</span>
                    <p>Average customer rating</p>
                </article>
                <article data-animate="fade-up" data-delay="200">
                    <span>30+</span>
                    <p>Suburbs serviced daily</p>
                </article>
            </div>
        </section>

        <section class="trust" aria-label="Trust badges">
            <div class="container trust-grid">
                <p>Trusted by hundreds of Melbourne families and businesses since 2020.</p>
                <div class="trust-logos">
                    <span>Windows PC</span>
                    <span>Apple Mac</span>
                    <span>All Laptops</span>
                    <span>Home WiFi</span>
                    <span>Printers</span>
                </div>
            </div>
        </section>

        <section id="services" class="section" aria-label="Our IT services">
            <div class="container section-header" data-animate="fade-up">
                <p class="eyebrow">Our Services</p>
                <h2>What We Fix and Support</h2>
                <p>Transparent service. No confusing technical talk. We explain everything in plain English.</p>
            </div>
            <div class="container cards-grid">
                <article class="card" data-animate="fade-up">
                    <i class="fas fa-laptop-medical" aria-hidden="true"></i>
                    <h3>Computer Repairs</h3>
                    <p>We fix laptops, desktops, and all-in-one computers. Fast turnaround, fair prices.</p>
                    <ul style="list-style:none; padding:0; margin-top:0.5rem; font-size:0.9rem; color:var(--muted);">
                        <li>✓ Slow computer speedup</li>
                        <li>✓ Won't turn on / Blue screen</li>
                        <li>✓ Broken screens & keyboards</li>
                        <li>✓ Battery replacement</li>
                    </ul>
                </article>
                <article class="card" data-animate="fade-up" data-delay="100">
                    <i class="fas fa-virus-slash" aria-hidden="true"></i>
                    <h3>Virus & Malware Removal</h3>
                    <p>We clean out viruses, remove popups, and protect you from scams and hackers.</p>
                    <ul style="list-style:none; padding:0; margin-top:0.5rem; font-size:0.9rem; color:var(--muted);">
                        <li>✓ Virus cleanup</li>
                        <li>✓ Annoying popups removed</li>
                        <li>✓ Scam software deleted</li>
                        <li>✓ Protection installed</li>
                    </ul>
                </article>
                <article class="card" data-animate="fade-up" data-delay="200">
                    <i class="fas fa-hard-drive" aria-hidden="true"></i>
                    <h3>Data Recovery</h3>
                    <p>Lost important photos, documents, or files? We can often get them back.</p>
                    <ul style="list-style:none; padding:0; margin-top:0.5rem; font-size:0.9rem; color:var(--muted);">
                        <li>✓ Deleted file recovery</li>
                        <li>✓ Failed hard drive rescue</li>
                        <li>✓ USB and memory card</li>
                        <li>✓ Automatic backup setup</li>
                    </ul>
                </article>
                <article class="card" data-animate="fade-up" data-delay="300">
                    <i class="fas fa-wifi" aria-hidden="true"></i>
                    <h3>Internet & WiFi</h3>
                    <p>Slow internet? Dead spots? We fix your WiFi so it works everywhere in your home.</p>
                    <ul style="list-style:none; padding:0; margin-top:0.5rem; font-size:0.9rem; color:var(--muted);">
                        <li>✓ Slow internet fixed</li>
                        <li>✓ WiFi dead zones solved</li>
                        <li>✓ New router setup</li>
                        <li>✓ NBN problems sorted</li>
                    </ul>
                </article>
                <article class="card" data-animate="fade-up" data-delay="400">
                    <i class="fas fa-print" aria-hidden="true"></i>
                    <h3>Printers & Devices</h3>
                    <p>Printer not working? Struggling to connect devices? We make it all work together.</p>
                    <ul style="list-style:none; padding:0; margin-top:0.5rem; font-size:0.9rem; color:var(--muted);">
                        <li>✓ Printer setup & fixes</li>
                        <li>✓ Email configuration</li>
                        <li>✓ Smart TV setup</li>
                        <li>✓ Phone & tablet help</li>
                    </ul>
                </article>
                <article class="card" data-animate="fade-up" data-delay="500">
                    <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                    <h3>Training & Help</h3>
                    <p>Confused by technology? We teach you how to use your devices with patience and care.</p>
                    <ul style="list-style:none; padding:0; margin-top:0.5rem; font-size:0.9rem; color:var(--muted);">
                        <li>✓ Computer basics</li>
                        <li>✓ Email & internet safety</li>
                        <li>✓ Video calling setup</li>
                        <li>✓ Online banking help</li>
                    </ul>
                </article>
            </div>
        </section>

        <section id="solutions" class="section alt" aria-label="Solution packages">
            <div class="container split">
                <div>
                    <p class="eyebrow">How We Help</p>
                    <h2>Choose What Works for You</h2>
                    <p>No lock-in contracts. No hidden fees. Just honest, reliable computer help when you need it.</p>
                    <ul class="checklist">
                        <li>We come to your home or office</li>
                        <li>Remote help over the phone available</li>
                        <li>Emergency after-hours support</li>
                        <li>Senior-friendly service with patience</li>
                    </ul>
                </div>
                <div class="solution-cards">
                    <article>
                        <h3>One-Time Fix</h3>
                        <p>Got a problem right now? We'll come out and fix it. Free diagnostics included.</p>
                        <ul>
                            <li>Free initial assessment</li>
                            <li>Quote before any work begins</li>
                            <li>Same-day service available</li>
                        </ul>
                    </article>
                    <article>
                        <h3>Regular Support</h3>
                        <p>Want someone to call whenever you need help? Priority service with consistent support.</p>
                        <ul>
                            <li>Dedicated phone support</li>
                            <li>Regular system check-ups</li>
                            <li>Priority response times</li>
                        </ul>
                    </article>
                    <article>
                        <h3>Business IT</h3>
                        <p>Running a business? We keep your computers and network running smoothly so you can focus on work.</p>
                        <ul>
                            <li>All staff supported</li>
                            <li>Proactive monitoring</li>
                            <li>Tailored solutions</li>
                        </ul>
                    </article>
                </div>
            </div>
        </section>

        <section id="process" class="section" aria-label="Our process">
            <div class="container section-header" data-animate="fade-up">
                <p class="eyebrow">Process</p>
                <h2>Clarity from first call to final handover.</h2>
            </div>
            <div class="container timeline">
                <article data-animate="fade-up" data-delay="300">
                    <span>1</span>
                    <h3>Discovery</h3>
                    <p>We listen, assess urgency, and capture business context in a lightweight digital brief.</p>
                </article>
                <article data-animate="fade-up" data-delay="400">
                    <span>2</span>
                    <h3>Stabilise</h3>
                    <p>Immediate remediation, isolation, or recovery to get you productive again.</p>
                </article>
                <article data-animate="fade-up" data-delay="500">
                    <span>3</span>
                    <h3>Optimise</h3>
                    <p>Implement best-practice tools, automation, and monitoring for resilience.</p>
                </article>
                <article data-animate="fade-up" data-delay="600">
                    <span>4</span>
                    <h3>Partner</h3>
                    <p>Quarterly reviews and continuous improvement keep tech aligned with your goals.</p>
                </article>
            </div>
        </section>

        <!-- Case Studies Section -->
        <section id="case-studies" class="section alt" aria-label="Success stories">
            <div class="container section-header" data-animate="fade-up">
                <p class="eyebrow">Real Results</p>
                <h2>Recent Success Stories</h2>
                <p>From quick fixes to complete IT transformations—we solve problems of all sizes for Melbourne homes and businesses.</p>
            </div>
            <div class="container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <article class="card" data-animate="fade-up" style="border-left: 4px solid #00ffcc;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <i class="fas fa-desktop" style="color: #00ffcc; font-size: 1.2rem;"></i>
                        <span style="color: var(--muted); font-size: 0.85rem;">Berwick Household</span>
                    </div>
                    <h3 style="color: var(--text); margin-bottom: 0.5rem;">Slow Computer Transformed</h3>
                    <p style="color: var(--muted); font-size: 0.95rem; margin-bottom: 1rem;"><strong>Problem:</strong> Family computer taking 10+ minutes to start, constantly freezing during use.</p>
                    <p style="color: var(--muted); font-size: 0.95rem; margin-bottom: 1rem;"><strong>Solution:</strong> Upgraded from old hard drive to SSD, removed 47 startup programs, cleaned dust from fans.</p>
                    <p style="color: var(--accent); font-weight: 600;"><i class="fas fa-check-circle"></i> Now boots in 15 seconds</p>
                </article>
                <article class="card" data-animate="fade-up" data-delay="100" style="border-left: 4px solid #29d5ff;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <i class="fas fa-wifi" style="color: #29d5ff; font-size: 1.2rem;"></i>
                        <span style="color: var(--muted); font-size: 0.85rem;">Patterson Lakes Family</span>
                    </div>
                    <h3 style="color: var(--text); margin-bottom: 0.5rem;">WiFi Dead Zones Eliminated</h3>
                    <p style="color: var(--muted); font-size: 0.95rem; margin-bottom: 1rem;"><strong>Problem:</strong> Large 2-storey home with no signal in bedrooms and garage. Kids couldn't attend online school.</p>
                    <p style="color: var(--muted); font-size: 0.95rem; margin-bottom: 1rem;"><strong>Solution:</strong> Installed mesh WiFi system with 3 access points, configured QoS for video calls, secured network.</p>
                    <p style="color: var(--accent); font-weight: 600;"><i class="fas fa-check-circle"></i> Full coverage • 100+ Mbps everywhere</p>
                </article>
                <article class="card" data-animate="fade-up" data-delay="200" style="border-left: 4px solid #ff9500;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <i class="fas fa-shield-alt" style="color: #ff9500; font-size: 1.2rem;"></i>
                        <span style="color: var(--muted); font-size: 0.85rem;">Cranbourne Business</span>
                    </div>
                    <h3 style="color: var(--text); margin-bottom: 0.5rem;">Ransomware Crisis Resolved</h3>
                    <p style="color: var(--muted); font-size: 0.95rem; margin-bottom: 1rem;"><strong>Problem:</strong> Small accounting firm hit by ransomware. All client files encrypted, business at standstill.</p>
                    <p style="color: var(--muted); font-size: 0.95rem; margin-bottom: 1rem;"><strong>Solution:</strong> Isolated infected systems, restored from backups, implemented endpoint protection, staff security training.</p>
                    <p style="color: var(--accent); font-weight: 600;"><i class="fas fa-check-circle"></i> Zero data loss • Back online in 6 hours</p>
                </article>
                <article class="card" data-animate="fade-up" data-delay="300" style="border-left: 4px solid #ff5c5c;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <i class="fas fa-hospital" style="color: #ff5c5c; font-size: 1.2rem;"></i>
                        <span style="color: var(--muted); font-size: 0.85rem;">Frankston Medical Clinic</span>
                    </div>
                    <h3 style="color: var(--text); margin-bottom: 0.5rem;">Complete IT Modernisation</h3>
                    <p style="color: var(--muted); font-size: 0.95rem; margin-bottom: 1rem;"><strong>Problem:</strong> Medical practice with outdated systems, no backups, compliance concerns, frequent crashes.</p>
                    <p style="color: var(--muted); font-size: 0.95rem; margin-bottom: 1rem;"><strong>Solution:</strong> Migrated to cloud infrastructure, implemented automated backups, security audit, new workstations, ongoing monitoring.</p>
                    <p style="color: var(--accent); font-weight: 600;"><i class="fas fa-check-circle"></i> 99.9% uptime • Fully compliant</p>
                </article>
            </div>
        </section>

        <section id="blog" class="section" aria-label="Latest insights">
            <div class="container section-header" data-animate="fade-up">
                <p class="eyebrow">Helpful Tips</p>
                <h2>Free Guides to Protect Your Computer</h2>
            </div>
            <div class="container cards-grid blog-grid">
                <article class="card">
                    <h3>How to Spot Tech Support Scams</h3>
                    <p>Protect yourself from fake calls and phishing emails targeting Australians.</p>
                    <a href="/blog-scam-protection/" class="text-link">Read article <i class="fas fa-arrow-right"></i></a>
                </article>
                <article class="card">
                    <h3>Password Security Made Simple</h3>
                    <p>Easy steps to create strong passwords and keep your accounts safe.</p>
                    <a href="/blog-password-security/" class="text-link">Read article <i class="fas fa-arrow-right"></i></a>
                </article>
                <article class="card">
                    <h3>Monthly Computer Maintenance</h3>
                    <p>15 minutes a month to avoid costly repairs and keep your PC running fast.</p>
                    <a href="/blog-computer-maintenance/" class="text-link">Read article <i class="fas fa-arrow-right"></i></a>
                </article>
            </div>
            <div class="container" style="text-align: center; margin-top: 1.5rem;">
                <p style="color: var(--muted); margin-bottom: 1rem;">More helpful guides:</p>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
                    <a href="/blog-home-network/" class="text-link">WiFi Optimisation</a>
                    <a href="/blog-malware-protection/" class="text-link">Malware Protection</a>
                    <a href="/blog-hardware-upgrades/" class="text-link">Hardware Upgrades</a>
                    <a href="/blog-cloud-services/" class="text-link">Cloud Services</a>
                </div>
            </div>
        </section>

        <!-- Google Reviews Section -->
        <section id="reviews" class="section" aria-label="Customer reviews">
            <div class="container section-header" data-animate="fade-up">
                <p class="eyebrow">Testimonials</p>
                <h2>What Our Customers Say</h2>
                <p>Rated 5 stars by Melbourne families and businesses.</p>
            </div>
            <div class="container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                <article style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07);">
                    <div style="color: #fbbf24; margin-bottom: 0.75rem;">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p style="color: var(--muted); font-style: italic; margin-bottom: 1rem;">"Fantastic service! My laptop was running incredibly slow and they fixed it same day. Very patient in explaining what was wrong. Highly recommend!"</p>
                    <p style="color: var(--text); font-weight: 600;">— Sarah M., Patterson Lakes</p>
                </article>
                <article style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07);">
                    <div style="color: #fbbf24; margin-bottom: 0.75rem;">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p style="color: var(--muted); font-style: italic; margin-bottom: 1rem;">"Saved my business! We had a ransomware attack and they had us back up and running within hours. Professional, knowledgeable, and affordable."</p>
                    <p style="color: var(--text); font-weight: 600;">— David K., Seaford Business Owner</p>
                </article>
                <article style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07);">
                    <div style="color: #fbbf24; margin-bottom: 0.75rem;">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p style="color: var(--muted); font-style: italic; margin-bottom: 1rem;">"Finally someone who explains things without the jargon! Set up our whole home network and now we have WiFi everywhere. Great value for money."</p>
                    <p style="color: var(--text); font-weight: 600;">— The Thompson Family, Frankston</p>
                </article>
            </div>
            <div class="container" style="text-align: center; margin-top: 2rem;">
                <a href="https://share.google/UxsUlLJwuV3D99r6y" target="_blank" class="btn btn-outline" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fab fa-google"></i> See All Reviews on Google
                </a>
            </div>
        </section>

        <section id="faq" class="section alt" aria-label="Frequently asked questions">
            <div class="container section-header" data-animate="fade-up">
                <p class="eyebrow">Questions</p>
                <h2>Common Questions Answered</h2>
            </div>
            <div class="container faq-grid">
                <details>
                    <summary>How much does it cost?</summary>
                    <p>We offer free diagnostics to assess your issue first. Once we understand the problem, we'll provide a clear quote for your approval before any work begins. No surprises, no hidden fees—you'll know exactly what to expect upfront.</p>
                </details>
                <details>
                    <summary>How quickly can you come?</summary>
                    <p>Usually the same day you call. We service Patterson Lakes and all surrounding suburbs. Emergency visits available for urgent problems.</p>
                </details>
                <details>
                    <summary>Do you work on weekends?</summary>
                    <p>Yes, we offer weekend and after-hours service for emergencies. Just call us and we'll help you out.</p>
                </details>
                <details>
                    <summary>Can you help older people who aren't good with computers?</summary>
                    <p>Absolutely! We're patient and explain everything in plain English. Many of our customers are seniors who appreciate our friendly, no-rush approach.</p>
                </details>
                <details>
                    <summary>Do you come to my home or do I bring the computer to you?</summary>
                    <p>We offer both options. We can come to your home or office anywhere in Patterson Lakes, Frankston, and surrounding suburbs. For complex repairs that take longer, we may take the computer to our workshop and return it once fixed.</p>
                </details>
                <details>
                    <summary>What if you can't fix the problem?</summary>
                    <p>We operate on a "no fix, no fee" basis for many services. If we can't solve your problem, you won't be charged for the repair attempt. We'll always be upfront about the likelihood of success before starting.</p>
                </details>
                <details>
                    <summary>Will I lose my files during repairs?</summary>
                    <p>We take data protection seriously. Before any repair, we discuss backup options with you. In most cases, your files remain safe. For high-risk repairs, we'll back up your data first.</p>
                </details>
                <details>
                    <summary>Do you repair Macs as well as Windows PCs?</summary>
                    <p>Yes, we service both Mac and Windows computers, as well as laptops from all major brands including Dell, HP, Lenovo, ASUS, Acer, and Apple MacBooks.</p>
                </details>
                <details>
                    <summary>Can you remove viruses from my computer?</summary>
                    <p>Absolutely. We specialise in virus and malware removal. We'll clean your system thoroughly, remove all threats, and install protection to prevent future infections.</p>
                </details>
                <details>
                    <summary>How long do repairs typically take?</summary>
                    <p>Simple fixes like virus removal or software issues often take 1-2 hours. Hardware repairs may take 24-48 hours if parts need to be ordered. We'll give you a timeframe upfront.</p>
                </details>
                <details>
                    <summary>Do you provide ongoing support after the repair?</summary>
                    <p>Yes, we offer follow-up support. If the same issue recurs within 30 days, we'll fix it at no extra charge. We also offer monthly support plans for businesses and individuals who want regular assistance.</p>
                </details>
                <details>
                    <summary>Can you help set up a new computer?</summary>
                    <p>Yes! We offer complete setup services including data transfer from your old computer, software installation, email configuration, printer setup, and personalizing settings to your preferences.</p>
                </details>
            </div>
        </section>

        <section class="cta-panel" aria-label="Primary call to action">
            <div class="container cta-panel-inner">
                <div>
                    <p class="eyebrow">Need help now?</p>
                    <h2>Book a same-day technician and get back to business.</h2>
                    <p>Describe the issue, attach screenshots, and we’ll confirm your booking within 30 minutes.</p>
                </div>
                <a class="btn" href="#contact">Send a Support Ticket</a>
            </div>
        </section>

        <section id="contact" class="section" aria-label="Contact Rapid Tech Solutions">
            <div class="container contact-grid">
                <div>
                    <p class="eyebrow">Contact</p>
                    <h2>Let’s solve your tech challenge.</h2>
                    <p>Call <a href="tel:+61423680596">0423 680 596</a> or use the form to brief us. We respond within one business hour.</p>
                    <ul class="contact-list">
                        <li><i class="fas fa-location-dot"></i> Patterson Lakes, VIC 3197</li>
                        <li><i class="fas fa-phone"></i> <a href="tel:+61423680596">+61 423 680 596</a></li>
                        <li><i class="fas fa-envelope"></i> <a href="mailto:support@rapidtechsolutions.au">support@rapidtechsolutions.au</a></li>
                        <li><i class="fas fa-clock"></i> Mon–Fri 9am – 5pm, emergency callouts 24/7</li>
                    </ul>
                </div>
                <form class="contact-form" action="<?php echo $base_path; ?>/contactengine.php" method="POST">
                    <label for="name">Name*</label>
                    <input type="text" id="name" name="Name" required>

                    <label for="email">Email*</label>
                    <input type="email" id="email" name="Email" required>

                    <label for="phone">Phone*</label>
                    <input type="tel" id="phone" name="Tel" required>

                    <label for="service">Service needed</label>
                    <select id="service" name="Service">
                        <option value="Repairs">Repairs / Troubleshooting</option>
                        <option value="Cybersecurity">Cybersecurity</option>
                        <option value="Network">Network & Wi-Fi</option>
                        <option value="Cloud">Cloud & Microsoft 365</option>
                        <option value="Projects">Projects / Advisory</option>
                    </select>

                    <label for="message">Message*</label>
                    <textarea id="message" name="Message" rows="5" required></textarea>

                    <button type="submit" class="btn btn-full">Submit request</button>
                </form>
            </div>
        </section>

        <section id="service-area" class="section alt" aria-label="Service area">
            <div class="container service-area-grid">
                <div>
                    <p class="eyebrow">Coverage</p>
                    <h2>Local to Patterson Lakes. Mobile across Melbourne.</h2>
                    <p>We service Bayside, Frankston, Mornington Peninsula, and the South East corridor. Remote support is available Australia-wide.</p>
                    <ul class="service-list">
                        <li>Patterson Lakes, Carrum, Seaford</li>
                        <li>Frankston, Langwarrin, Skye</li>
                        <li>Chelsea Heights, Aspendale, Edithvale</li>
                        <li>Mordialloc, Parkdale, Mentone</li>
                        <li>Mornington Peninsula suburbs</li>
                    </ul>
                </div>
                <figure>
                    <iframe title="Service area map showing Patterson Lakes and surrounding Melbourne suburbs" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31516.347265566255!2d145.123!3d-38.0692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad61ab1a0f5e9df%3A0x5045675218ce6e0!2sPatterson%20Lakes%20VIC%203197!5e0!3m2!1sen!2sau!4v1710000000000" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <figcaption>Onsite visits within 30 minutes of Patterson Lakes plus remote national coverage.</figcaption>
                </figure>
            </div>
        </section>
    </main>

    <footer class="site-footer" role="contentinfo">
        <div class="container footer-grid">
            <div>
                <a class="brand" href="/">Rapid Tech Solutions</a>
                <p>Strategic IT support, cybersecurity, and cloud enablement for Melbourne businesses and households.</p>
                <div class="social">
                    <a href="https://www.facebook.com/RapidTechAUS/" aria-label="Facebook" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/rapidtechsolutions.au/" aria-label="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div>
                <h3>Quick links</h3>
                <ul>
                    <li><a href="#services">Services</a></li>
                    <li><a href="/blog/">Blog & Tips</a></li>
                    <li><a href="/faq/">FAQ</a></li>
                    <li><a href="/about/">About Us</a></li>
                    <li><a href="/service-areas/">All Service Areas</a></li>
                </ul>
            </div>
            <div>
                <h3>Popular Suburbs</h3>
                <ul>
                    <li><a href="/computer-repairs-cranbourne/">Cranbourne</a></li>
                    <li><a href="/computer-repairs-berwick/">Berwick</a></li>
                    <li><a href="/computer-repairs-narre-warren/">Narre Warren</a></li>
                    <li><a href="/computer-repairs-frankston/">Frankston</a></li>
                    <li><a href="/computer-repairs-patterson-lakes/">Patterson Lakes</a></li>
                </ul>
            </div>
            <div>
                <h3>Contact</h3>
                <ul>
                    <li><a href="tel:+61423680596">+61 423 680 596</a></li>
                    <li><a href="mailto:support@rapidtechsolutions.au">support@rapidtechsolutions.au</a></li>
                    <li>ABN 64 654 861 096</li>
                </ul>
            </div>
        </div>
        <div style="text-align: center; padding: 1rem 0; border-top: 1px solid rgba(255,255,255,0.1); margin-top: 1rem;">
            <a href="/privacy-policy/" style="color: var(--muted); margin: 0 1rem;">Privacy Policy</a>
            <a href="/terms-of-service/" style="color: var(--muted); margin: 0 1rem;">Terms of Service</a>
        </div>
        <p class="footer-note">© <?php echo date('Y'); ?> Rapid Tech Solutions. All rights reserved.</p>
    </footer>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Do you offer after-hours or weekend callouts?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes. After-hours and weekend services are available for critical incidents across Bayside and Mornington Peninsula."
                }
            },
            {
                "@type": "Question",
                "name": "How fast can you get onsite in Cranbourne South?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We aim for same-day onsite visits locally and offer remote triage in under an hour. Same-day service available across Cranbourne, Patterson Lakes, and surrounding suburbs."
                }
            },
            {
                "@type": "Question",
                "name": "Can you work with our existing IT provider?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We frequently collaborate with internal teams or other MSPs to cover overflow tickets, projects, or security uplift."
                }
            },
            {
                "@type": "Question",
                "name": "What industries do you specialise in?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Healthcare, construction, hospitality, professional services, retail, and home offices."
                }
            }
        ]
    }
    </script>

    <script>
        // Mobile navigation toggle
        const toggle = document.querySelector('.menu-toggle');
        const nav = document.getElementById('primary-nav');
        if (toggle) {
            toggle.addEventListener('click', () => {
                const expanded = toggle.getAttribute('aria-expanded') === 'true';
                toggle.setAttribute('aria-expanded', (!expanded).toString());
                nav.classList.toggle('is-open');
            });
        }

        // Scroll Animation Observer
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('[data-animate]');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            elements.forEach(el => observer.observe(el));
        };

        // Initialize animations on load
        document.addEventListener('DOMContentLoaded', animateOnScroll);

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>

    <!-- Sticky Emergency Banner Script (Desktop Only) -->
    <script>
    (function() {
        const banner = document.getElementById('emergency-banner');
        const header = document.querySelector('.site-header');

        // Only make banner sticky on desktop (>768px)
        if (window.innerWidth > 768) {
            let bannerOffset = banner.offsetTop;
            let bannerHeight = banner.offsetHeight;

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > bannerOffset + 50) {
                    banner.style.position = 'fixed';
                    banner.style.top = '0';
                    banner.style.left = '0';
                    banner.style.right = '0';
                    banner.style.boxShadow = '0 2px 10px rgba(255, 92, 92, 0.3)';
                    document.body.style.paddingTop = bannerHeight + 'px';
                } else {
                    banner.style.position = 'relative';
                    banner.style.boxShadow = 'none';
                    document.body.style.paddingTop = '0';
                }
            });
        }
    })();
    </script>

    <!--Start of Tawk.to Script-->
    <!-- Exit Intent Popup -->
    <div id="exit-popup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 10000; align-items: center; justify-content: center;">
        <div style="background: linear-gradient(135deg, #0f1016 0%, #1a1a2e 100%); padding: 40px; border-radius: 16px; max-width: 500px; margin: 20px; position: relative; border: 2px solid #00ffcc; box-shadow: 0 10px 40px rgba(0,255,204,0.3);">
            <button id="close-popup" style="position: absolute; top: 15px; right: 15px; background: none; border: none; color: #fff; font-size: 24px; cursor: pointer; padding: 5px 10px;">&times;</button>
            <div style="text-align: center;">
                <div style="font-size: 48px; margin-bottom: 20px;">🚀</div>
                <h3 style="color: #00ffcc; margin-bottom: 15px; font-size: 24px;">Wait! Don't Let Computer Problems Slow You Down</h3>
                <p style="color: #e9edf3; margin-bottom: 25px; line-height: 1.6;">Get a <strong style="color: #00ffcc;">FREE diagnostic assessment</strong> when you call in the next 10 minutes!</p>
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <a href="tel:+61423680596" style="background: linear-gradient(135deg, #00ffcc 0%, #29d5ff 100%); color: #05060a; padding: 15px 30px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 18px; display: inline-block; transition: transform 0.3s;">
                        <i class="fas fa-phone-alt"></i> Call Now: 0423 680 596
                    </a>
                    <p style="color: #8f9bb3; font-size: 14px; margin: 0;">Same-day service available • No fix, no fee guarantee</p>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Exit Intent Popup
    let exitIntentShown = false;
    const exitPopup = document.getElementById('exit-popup');
    const closePopup = document.getElementById('close-popup');
    
    document.addEventListener('mouseout', (e) => {
        if (!exitIntentShown && e.clientY < 50 && window.innerWidth > 768) {
            exitIntentShown = true;
            exitPopup.style.display = 'flex';
            localStorage.setItem('exitPopupShown', Date.now());
        }
    });
    
    // Check if popup was shown in last 24 hours
    const lastShown = localStorage.getItem('exitPopupShown');
    if (lastShown && (Date.now() - lastShown) < 86400000) {
        exitIntentShown = true;
    }
    
    closePopup.addEventListener('click', () => {
        exitPopup.style.display = 'none';
    });
    
    exitPopup.addEventListener('click', (e) => {
        if (e.target === exitPopup) {
            exitPopup.style.display = 'none';
        }
    });
    
    // Performance: Lazy load images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => imageObserver.observe(img));
    }
    
    // Performance: Only load video on desktop (saves 3MB on mobile)
    const bgVideo = document.getElementById('bg-video');
    const isDesktop = window.innerWidth >= 1024;

    if (bgVideo) {
        if (isDesktop && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            // Load video sources only on desktop
            const webmSource = document.createElement('source');
            webmSource.src = '<?php echo $base_path; ?>/videos/bg1.webm';
            webmSource.type = 'video/webm';
            bgVideo.appendChild(webmSource);

            const mp4Source = document.createElement('source');
            mp4Source.src = '<?php echo $base_path; ?>/videos/bg1.mp4';
            mp4Source.type = 'video/mp4';
            bgVideo.appendChild(mp4Source);

            bgVideo.load();
        } else {
            // On mobile or reduced motion: pause and use poster only
            bgVideo.pause();
            bgVideo.removeAttribute('autoplay');
        }
    }
    </script>
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/691a9832dde8a31959180788/1ja7u51sh';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
</body>
</html>
