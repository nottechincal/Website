<?php
// Define base path - works with or without WordPress
if (function_exists('get_template_directory_uri')) {
    $base_path = get_template_directory_uri();
} else {
    $script_dir = dirname($_SERVER['SCRIPT_NAME']);
    $base_path = ($script_dir === '/' || $script_dir === '\\') ? '' : $script_dir;
}
$current_year = date('Y');
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en-AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found | Rapid Tech Solutions</title>
    <meta name="robots" content="noindex, follow">
    <link rel="icon" type="image/svg+xml" href="<?php echo $base_path; ?>/images/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $base_path; ?>/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/styles.css" rel="stylesheet">
    <style>
        .error-page {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }
        .error-content {
            max-width: 600px;
        }
        .error-code {
            font-size: 8rem;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
            margin-bottom: 1rem;
        }
        .error-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--text);
        }
        .error-message {
            color: var(--muted);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .helpful-links {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .helpful-links h3 {
            color: var(--text);
            margin-bottom: 1rem;
        }
        .helpful-links ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }
        .helpful-links a {
            color: var(--accent);
            text-decoration: none;
            padding: 0.5rem 1rem;
            background: rgba(41, 213, 255, 0.1);
            border-radius: 8px;
            transition: background 0.3s;
        }
        .helpful-links a:hover {
            background: rgba(41, 213, 255, 0.2);
        }
    </style>
</head>
<body>
    <header class="site-header" role="banner">
        <div class="container header-inner">
            <a class="brand" href="/">
                <span class="brand-mark lightning-animated" aria-hidden="true"></span>
                Rapid Tech Solutions
            </a>
            <nav class="primary-nav">
                <a href="/#services">Services</a>
                <a href="/#contact" class="btn btn-outline">Contact</a>
            </nav>
        </div>
    </header>

    <main class="error-page">
        <div class="error-content">
            <div class="error-code">404</div>
            <h1 class="error-title">Page Not Found</h1>
            <p class="error-message">
                Oops! The page you're looking for seems to have gone missing. Don't worry—it happens to the best of us. The page may have been moved, deleted, or you might have typed the address incorrectly.
            </p>
            <div class="error-actions">
                <a href="/" class="btn btn-primary">
                    <i class="fas fa-home"></i> Go to Homepage
                </a>
                <a href="/#contact" class="btn btn-outline">
                    <i class="fas fa-phone"></i> Contact Us
                </a>
            </div>

            <div class="helpful-links">
                <h3>Helpful Links</h3>
                <ul>
                    <li><a href="/#services">Our Services</a></li>
                    <li><a href="/service-computer-repairs/">Computer Repairs</a></li>
                    <li><a href="/service-data-recovery/">Data Recovery</a></li>
                    <li><a href="/blog/">Blog Articles</a></li>
                    <li><a href="/about/">About Us</a></li>
                    <li><a href="/#faq">FAQ</a></li>
                </ul>
            </div>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p class="footer-note">© <?php echo $current_year; ?> Rapid Tech Solutions. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
