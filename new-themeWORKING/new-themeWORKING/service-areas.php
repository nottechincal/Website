<?php
if (function_exists('get_template_directory_uri')) {
    $base_path = get_template_directory_uri();
} else {
    $script_dir = dirname($_SERVER['SCRIPT_NAME']);
    $base_path = ($script_dir === '/' || $script_dir === '\\') ? '' : $script_dir;
}
$year = date('Y');
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Areas | Computer Repairs Melbourne South-East | Rapid Tech Solutions</title>
    <meta name="description" content="Computer repairs and IT support across Melbourne's south-east. Serving Cranbourne, Berwick, Narre Warren, Frankston, Patterson Lakes, and 20+ suburbs. Same-day service available.">
    <meta name="keywords" content="computer repairs Melbourne south-east, IT support Cranbourne, computer repairs Frankston, laptop repair Narre Warren, computer technician Patterson Lakes">
    <link rel="canonical" href="https://www.rapidtechsolutions.au/service-areas/">
    <link rel="icon" type="image/png" href="<?php echo $base_path; ?>/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/styles.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/blog.css" rel="stylesheet">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "serviceType": "Computer Repair",
        "provider": {
            "@type": "LocalBusiness",
            "name": "Rapid Tech Solutions",
            "telephone": "+61423680596"
        },
        "areaServed": [
            {"@type": "City", "name": "Cranbourne South"},
            {"@type": "City", "name": "Cranbourne"},
            {"@type": "City", "name": "Berwick"},
            {"@type": "City", "name": "Narre Warren"},
            {"@type": "City", "name": "Frankston"},
            {"@type": "City", "name": "Patterson Lakes"}
        ],
        "description": "Professional computer repair and IT support services across Melbourne's south-east suburbs"
    }
    </script>
    <style>
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
    </style>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BDN34WT3J6"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-BDN34WT3J6');
    </script>
</head>
<body>
    <header class="site-header" role="banner">
        <div class="container header-inner">
            <a class="brand" href="/"><span class="brand-mark lightning-animated"></span>Rapid Tech Solutions</a>
            <nav class="primary-nav">
                <a href="<?php echo $base_path; ?>/index.php#services">Services</a>
                <a href="tel:+61423680596" class="btn btn-outline"><i class="fas fa-phone"></i> 0423 680 596</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="area-hero">
            <div class="container">
                <h1><i class="fas fa-map-marker-alt" style="color: var(--accent);"></i> Our Service Areas</h1>
                <p style="color: var(--muted); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Professional computer repairs and IT support across Melbourne's south-east. Same-day service, free diagnostics, no fix no fee guarantee.</p>
            </div>
        </div>

        <div class="container">
            <div class="stats-banner">
                <h2 style="margin-top: 0; color: var(--text);">Trusted Across Melbourne's South-East</h2>
                <div class="stats-grid">
                    <div class="stat-item">
                        <h3>25+</h3>
                        <p>Suburbs Serviced</p>
                    </div>
                    <div class="stat-item">
                        <h3>5.0</h3>
                        <p>Star Rating</p>
                    </div>
                    <div class="stat-item">
                        <h3>Same-Day</h3>
                        <p>Service Available</p>
                    </div>
                    <div class="stat-item">
                        <h3>No Fix</h3>
                        <p>No Fee Guarantee</p>
                    </div>
                </div>
            </div>

            <div class="region-section">
                <h2><i class="fas fa-home" style="color: var(--accent);"></i> Cranbourne & Surrounds (Primary Service Area)</h2>
                <div class="suburb-grid">
                    <div class="suburb-card">
                        <h3>Cranbourne</h3>
                        <div class="postcode">Postcode: 3977</div>
                        <p>Fast computer repairs in Cranbourne. Same-day service for laptops, desktops, virus removal, and data recovery.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-cranbourne.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Cranbourne North</h3>
                        <div class="postcode">Postcode: 3977</div>
                        <p>Expert IT support for Cranbourne North families and businesses. Free diagnostics included.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-cranbourne-north.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Cranbourne East</h3>
                        <div class="postcode">Postcode: 3977</div>
                        <p>Computer repairs and network setup for the growing Cranbourne East community.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-cranbourne-east.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Cranbourne West</h3>
                        <div class="postcode">Postcode: 3977</div>
                        <p>Local computer technician serving Cranbourne West homes and businesses.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-cranbourne-west.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Clyde</h3>
                        <div class="postcode">Postcode: 3978</div>
                        <p>Reliable computer repairs for Clyde residents. 30-day warranty on all repairs.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-clyde.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Clyde North</h3>
                        <div class="postcode">Postcode: 3978</div>
                        <p>Growing suburb, growing IT needs. We're your local tech experts in Clyde North.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-clyde-north.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Junction Village</h3>
                        <div class="postcode">Postcode: 3977</div>
                        <p>Computer repairs and WiFi solutions for Junction Village homes.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-junction-village.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Botanic Ridge</h3>
                        <div class="postcode">Postcode: 3977</div>
                        <p>Premium IT support for Botanic Ridge's modern community.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-botanic-ridge.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Devon Meadows</h3>
                        <div class="postcode">Postcode: 3977</div>
                        <p>Rural-friendly computer repairs serving Devon Meadows properties.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-devon-meadows.php" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>

            <div class="region-section">
                <h2><i class="fas fa-building" style="color: #ff9500;"></i> Casey & Greater Dandenong</h2>
                <div class="suburb-grid">
                    <div class="suburb-card">
                        <h3>Berwick</h3>
                        <div class="postcode">Postcode: 3806</div>
                        <p>Professional computer repairs in Berwick. Business and home IT support.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-berwick.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Narre Warren</h3>
                        <div class="postcode">Postcode: 3805</div>
                        <p>Fast, reliable computer repairs for Narre Warren families.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-narre-warren.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Narre Warren South</h3>
                        <div class="postcode">Postcode: 3805</div>
                        <p>Expert IT support for Narre Warren South residents and businesses.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-narre-warren-south.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Hampton Park</h3>
                        <div class="postcode">Postcode: 3976</div>
                        <p>Affordable computer repairs and virus removal in Hampton Park.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-hampton-park.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Lynbrook</h3>
                        <div class="postcode">Postcode: 3975</div>
                        <p>Quick computer repairs for Lynbrook homes. Same-day service available.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-lynbrook.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Lyndhurst</h3>
                        <div class="postcode">Postcode: 3975</div>
                        <p>Trusted computer technician for Lyndhurst families and businesses.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-lyndhurst.php" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>

            <div class="region-section">
                <h2><i class="fas fa-umbrella-beach" style="color: #00ffcc;"></i> Patterson Lakes & Bayside</h2>
                <div class="suburb-grid">
                    <div class="suburb-card">
                        <h3>Patterson Lakes</h3>
                        <div class="postcode">Postcode: 3197</div>
                        <p>Computer repairs for Patterson Lakes homes. WiFi and network specialists.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-patterson-lakes.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Chelsea Heights</h3>
                        <div class="postcode">Postcode: 3196</div>
                        <p>Local computer technician serving Chelsea Heights community.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-chelsea-heights.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Carrum</h3>
                        <div class="postcode">Postcode: 3197</div>
                        <p>Beachside computer repairs for Carrum residents. Fast and reliable service.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-carrum.php" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>

            <div class="region-section">
                <h2><i class="fas fa-city" style="color: #ff5c5c;"></i> Frankston & Mornington Peninsula</h2>
                <div class="suburb-grid">
                    <div class="suburb-card">
                        <h3>Frankston</h3>
                        <div class="postcode">Postcode: 3199</div>
                        <p>Business IT support and home computer repairs in Frankston.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-frankston.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Seaford</h3>
                        <div class="postcode">Postcode: 3198</div>
                        <p>Gaming PC repairs and family computer support in Seaford.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-seaford.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Carrum Downs</h3>
                        <div class="postcode">Postcode: 3201</div>
                        <p>Professional computer repairs serving Carrum Downs businesses.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-carrum-downs.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Langwarrin</h3>
                        <div class="postcode">Postcode: 3910</div>
                        <p>Reliable IT support for Langwarrin homes and small businesses.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-langwarrin.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Skye</h3>
                        <div class="postcode">Postcode: 3977</div>
                        <p>Computer repairs and data recovery for Skye residents.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-skye.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Sandhurst</h3>
                        <div class="postcode">Postcode: 3977</div>
                        <p>Premium IT support for Sandhurst's modern estate homes.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-sandhurst.php" class="btn btn-outline">View Details</a>
                    </div>
                    <div class="suburb-card">
                        <h3>Pearcedale</h3>
                        <div class="postcode">Postcode: 3912</div>
                        <p>Rural computer repairs serving Pearcedale and surrounds.</p>
                        <a href="<?php echo $base_path; ?>/computer-repairs-pearcedale.php" class="btn btn-outline">View Details</a>
                    </div>
                </div>
            </div>

            <section class="cta-section" style="margin-top: 3rem;">
                <h2>Don't See Your Suburb?</h2>
                <p>We service all of Melbourne's south-east! If your suburb isn't listed, give us a call and we'll let you know if we can help. Most areas within 20km of Cranbourne South are covered.</p>
                <div class="cta-buttons">
                    <a href="tel:+61423680596" class="btn"><i class="fas fa-phone"></i> Call: 0423 680 596</a>
                    <a href="<?php echo $base_path; ?>/index.php#contact" class="btn btn-outline"><i class="fas fa-envelope"></i> Contact Us</a>
                </div>
            </section>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div style="text-align: center; padding: 1rem 0; border-top: 1px solid rgba(255,255,255,0.1);">
                <a href="<?php echo $base_path; ?>/privacy-policy.php" style="color: var(--muted); margin: 0 1rem;">Privacy Policy</a>
                <a href="<?php echo $base_path; ?>/terms-of-service.php" style="color: var(--muted); margin: 0 1rem;">Terms of Service</a>
            </div>
            <p class="footer-note">© <?php echo $year; ?> Rapid Tech Solutions. Computer Repairs Melbourne South-East. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
