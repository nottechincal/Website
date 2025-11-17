<?php
// Define base path - works with or without WordPress
if (function_exists('get_template_directory_uri')) {
    $base_path = get_template_directory_uri();
} else {
    $script_dir = dirname($_SERVER['SCRIPT_NAME']);
    $base_path = ($script_dir === '/' || $script_dir === '\\') ? '' : $script_dir;
}
$current_year = date('Y');
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Help Blog | Free Computer Tips & Guides | Rapid Tech Solutions</title>
    <meta name="description" content="Free IT guides, computer tips, and tech help for Melbourne residents. Learn about scam protection, password security, computer maintenance, and more.">
    <link rel="canonical" href="https://www.rapidtechsolutions.au/blog/">
    <link rel="icon" type="image/png" href="<?php echo $base_path; ?>/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/styles.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/blog.css" rel="stylesheet">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Blog",
        "name": "Rapid Tech Solutions IT Help Blog",
        "description": "Free computer tips, IT guides, and tech help for Melbourne residents",
        "url": "https://www.rapidtechsolutions.au/blog/",
        "publisher": {
            "@type": "Organization",
            "name": "Rapid Tech Solutions",
            "logo": "https://www.rapidtechsolutions.au/images/logo.png"
        }
    }
    </script>
    <style>
        .blog-hero {
            background: linear-gradient(135deg, #0f1016 0%, #1a1a2e 100%);
            padding: 4rem 0;
            text-align: center;
        }
        .blog-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .blog-hero p {
            color: var(--muted);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            padding: 3rem 0;
        }
        .blog-card {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent);
            box-shadow: 0 10px 30px rgba(41, 213, 255, 0.1);
        }
        .blog-card-content {
            padding: 1.5rem;
        }
        .blog-card-category {
            display: inline-block;
            background: rgba(41, 213, 255, 0.1);
            color: var(--accent);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .blog-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.75rem;
            color: var(--text);
        }
        .blog-card p {
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        .blog-card-meta {
            display: flex;
            gap: 1rem;
            color: var(--muted);
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
        .blog-card .btn {
            width: 100%;
            text-align: center;
        }
        .featured-article {
            background: linear-gradient(135deg, rgba(255, 92, 92, 0.1), rgba(255, 149, 0, 0.1));
            border-color: rgba(255, 92, 92, 0.3);
        }
        .featured-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #ff5c5c;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .search-box {
            max-width: 500px;
            margin: 2rem auto;
            position: relative;
        }
        .search-box input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 1rem;
        }
        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
        }
    </style>
</head>
<body>
    <header class="site-header" role="banner">
        <div class="container header-inner">
            <a class="brand" href="<?php echo $base_path; ?>/index.php">
                <span class="brand-mark lightning-animated" aria-hidden="true"></span>
                Rapid Tech Solutions
            </a>
            <nav class="primary-nav">
                <a href="<?php echo $base_path; ?>/index.php#services">Services</a>
                <a href="<?php echo $base_path; ?>/index.php#contact" class="btn btn-outline">Contact</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="blog-hero">
            <div class="container">
                <h1>Free IT Help & Computer Tips</h1>
                <p>Learn how to protect yourself online, maintain your computer, and solve common tech problems. Written in plain English for Melbourne residents.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="blog-grid">
                    <!-- Featured Article -->
                    <article class="blog-card featured-article" style="position: relative;">
                        <span class="featured-badge"><i class="fas fa-star"></i> Featured</span>
                        <div class="blog-card-content">
                            <span class="blog-card-category">Online Safety</span>
                            <h3>How to Spot and Avoid Tech Support Scams</h3>
                            <p>Australians lost over $3.1 billion to scams in 2022. Learn to identify fake tech support calls, phishing emails, and protect your family from common scams targeting our community.</p>
                            <div class="blog-card-meta">
                                <span><i class="fas fa-clock"></i> 6 min read</span>
                                <span><i class="fas fa-calendar"></i> Nov 2025</span>
                            </div>
                            <a href="<?php echo $base_path; ?>/blog-scam-protection.php" class="btn">Read Article</a>
                        </div>
                    </article>

                    <!-- Password Security -->
                    <article class="blog-card">
                        <div class="blog-card-content">
                            <span class="blog-card-category">Online Safety</span>
                            <h3>Password Security Made Simple</h3>
                            <p>Stop using "password123"! Learn how to create strong passwords, use password managers, and set up two-factor authentication to protect your accounts.</p>
                            <div class="blog-card-meta">
                                <span><i class="fas fa-clock"></i> 5 min read</span>
                                <span><i class="fas fa-calendar"></i> Nov 2025</span>
                            </div>
                            <a href="<?php echo $base_path; ?>/blog-password-security.php" class="btn btn-outline">Read Article</a>
                        </div>
                    </article>

                    <!-- Computer Maintenance -->
                    <article class="blog-card">
                        <div class="blog-card-content">
                            <span class="blog-card-category">Computer Care</span>
                            <h3>Simple Computer Maintenance Tips</h3>
                            <p>15 minutes a month can save you hundreds in repair bills. Here's your easy checklist for keeping your computer running fast and avoiding costly repairs.</p>
                            <div class="blog-card-meta">
                                <span><i class="fas fa-clock"></i> 7 min read</span>
                                <span><i class="fas fa-calendar"></i> Nov 2025</span>
                            </div>
                            <a href="<?php echo $base_path; ?>/blog-computer-maintenance.php" class="btn btn-outline">Read Article</a>
                        </div>
                    </article>

                    <!-- Malware Protection -->
                    <article class="blog-card">
                        <div class="blog-card-content">
                            <span class="blog-card-category">Security</span>
                            <h3>Malware Protection Playbook</h3>
                            <p>Protect your devices from viruses, ransomware, and malware. Learn isolation steps, prevention strategies, and what to do if you get infected.</p>
                            <div class="blog-card-meta">
                                <span><i class="fas fa-clock"></i> 8 min read</span>
                            </div>
                            <a href="<?php echo $base_path; ?>/blog-malware-protection.php" class="btn btn-outline">Read Article</a>
                        </div>
                    </article>

                    <!-- Home Network -->
                    <article class="blog-card">
                        <div class="blog-card-content">
                            <span class="blog-card-category">Networking</span>
                            <h3>Home Network Tune-Up Checklist</h3>
                            <p>Eliminate WiFi dead zones, boost your speeds, and secure every device in your home. Perfect for families with remote workers and students.</p>
                            <div class="blog-card-meta">
                                <span><i class="fas fa-clock"></i> 6 min read</span>
                            </div>
                            <a href="<?php echo $base_path; ?>/blog-home-network.php" class="btn btn-outline">Read Article</a>
                        </div>
                    </article>

                    <!-- Hardware Upgrades -->
                    <article class="blog-card">
                        <div class="blog-card-content">
                            <span class="blog-card-category">Hardware</span>
                            <h3>When to Upgrade Your Hardware</h3>
                            <p>Is your computer slow because of old hardware? Learn the signs that indicate it's time for an upgrade vs. when a simple cleanup will do.</p>
                            <div class="blog-card-meta">
                                <span><i class="fas fa-clock"></i> 5 min read</span>
                            </div>
                            <a href="<?php echo $base_path; ?>/blog-hardware-upgrades.php" class="btn btn-outline">Read Article</a>
                        </div>
                    </article>

                    <!-- Cloud Services -->
                    <article class="blog-card">
                        <div class="blog-card-content">
                            <span class="blog-card-category">Backup & Recovery</span>
                            <h3>Cloud vs Local Backups</h3>
                            <p>Don't lose your precious photos and documents. Learn about hybrid backup strategies that protect your data from hardware failure and disasters.</p>
                            <div class="blog-card-meta">
                                <span><i class="fas fa-clock"></i> 6 min read</span>
                            </div>
                            <a href="<?php echo $base_path; ?>/blog-cloud-services.php" class="btn btn-outline">Read Article</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section style="background: linear-gradient(120deg, #181a27, #07070b); padding: 3rem 0;">
            <div class="container" style="text-align: center;">
                <h2 style="margin-bottom: 1rem;">Need Hands-On Help?</h2>
                <p style="color: var(--muted); margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Our articles are here to help, but sometimes you need a professional. We offer free diagnostics and honest advice—no pressure, no jargon.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="tel:+61423680596" class="btn"><i class="fas fa-phone"></i> Call: 0423 680 596</a>
                    <a href="<?php echo $base_path; ?>/index.php#contact" class="btn btn-outline"><i class="fas fa-envelope"></i> Send a Message</a>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div style="display: flex; justify-content: center; gap: 2rem; margin-bottom: 1rem; flex-wrap: wrap;">
                <a href="<?php echo $base_path; ?>/privacy-policy.php" style="color: var(--muted);">Privacy Policy</a>
                <a href="<?php echo $base_path; ?>/terms-of-service.php" style="color: var(--muted);">Terms of Service</a>
                <a href="<?php echo $base_path; ?>/about.php" style="color: var(--muted);">About Us</a>
            </div>
            <p class="footer-note">© <?php echo $current_year; ?> Rapid Tech Solutions. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
