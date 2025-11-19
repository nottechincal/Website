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
    <title>Terms of Service | Rapid Tech Solutions</title>
    <meta name="description" content="Terms of Service for Rapid Tech Solutions IT support services in Melbourne.">
    <link rel="canonical" href="https://www.rapidtechsolutions.au/terms-of-service/">
    <link rel="icon" type="image/png" href="<?php echo $base_path; ?>/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/styles.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/blog.css" rel="stylesheet">
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

    <main>
        <div class="article-header">
            <div class="container">
                <h1>Terms of Service</h1>
                <p class="article-excerpt">Please read these terms carefully before using our services.</p>
                <div class="article-info">
                    <span><i class="fas fa-calendar"></i> Last Updated: <?php echo date('F j, Y'); ?></span>
                </div>
            </div>
        </div>

        <article class="article-content">
            <section>
                <h2>1. Acceptance of Terms</h2>
                <p>By using the services provided by Rapid Tech Solutions ("we", "our", "us"), you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our services.</p>
                <p>These terms apply to all IT support, repair, and consulting services provided by Rapid Tech Solutions in the Melbourne metropolitan area.</p>
            </section>

            <section>
                <h2>2. Our Services</h2>
                <p>Rapid Tech Solutions provides:</p>
                <ul>
                    <li>Computer and laptop repairs</li>
                    <li>Data recovery services</li>
                    <li>Virus and malware removal</li>
                    <li>Network and WiFi setup</li>
                    <li>IT consulting and support</li>
                    <li>Hardware upgrades and installations</li>
                    <li>Software installation and configuration</li>
                </ul>
            </section>

            <section>
                <h2>3. Service Process</h2>

                <h3>3.1 Free Diagnostics</h3>
                <p>We offer free initial diagnostics to assess your IT issues. This includes:</p>
                <ul>
                    <li>Identifying the problem</li>
                    <li>Providing a clear explanation in plain language</li>
                    <li>Giving you a quote for repairs before any work begins</li>
                </ul>

                <h3>3.2 Approval Required</h3>
                <p>We will NOT proceed with any paid work without your explicit approval. You will receive:</p>
                <ul>
                    <li>A detailed quote outlining the work to be done</li>
                    <li>Expected timeframe for completion</li>
                    <li>Total cost including any parts</li>
                </ul>
                <div class="pro-tip">
                    <h4>Our Promise:</h4>
                    <p>No surprises. No hidden fees. You always know the cost before we start.</p>
                </div>

                <h3>3.3 Right to Decline</h3>
                <p>You have the right to decline our services at any point. If you decline after free diagnostics, there is no charge.</p>
            </section>

            <section>
                <h2>4. Payment Terms</h2>
                <ul>
                    <li><strong>Payment Due:</strong> Upon completion of services unless otherwise agreed</li>
                    <li><strong>Accepted Methods:</strong> Cash, credit/debit card, bank transfer, PayPal</li>
                    <li><strong>Parts:</strong> Some parts may require upfront payment</li>
                    <li><strong>Large Jobs:</strong> May require a deposit (typically 50%)</li>
                </ul>
                <p>Prices quoted are in Australian Dollars (AUD) and include GST where applicable.</p>
            </section>

            <section>
                <h2>5. Warranty and Guarantees</h2>

                <h3>5.1 Labour Warranty</h3>
                <p>All repair work comes with a 30-day labour warranty covering:</p>
                <ul>
                    <li>The specific issue we repaired</li>
                    <li>Workmanship defects</li>
                    <li>Related problems caused by our work</li>
                </ul>

                <h3>5.2 Parts Warranty</h3>
                <p>Hardware parts come with manufacturer warranties (typically 12-36 months). We will provide warranty information for any parts installed.</p>

                <h3>5.3 What's NOT Covered</h3>
                <ul>
                    <li>New problems unrelated to our original repair</li>
                    <li>Damage from viruses, power surges, or physical damage after service</li>
                    <li>Issues caused by software installed after our service</li>
                    <li>Normal wear and tear</li>
                </ul>
            </section>

            <section>
                <h2>6. Data and Privacy</h2>

                <h3>6.1 Your Data</h3>
                <p>We respect your privacy. Our technicians:</p>
                <ul>
                    <li>Will NOT access personal files unless required for the specific service</li>
                    <li>Will NOT share your data with anyone</li>
                    <li>Will NOT store copies of your files after service completion</li>
                    <li>Will secure-delete any temporary data we access</li>
                </ul>

                <h3>6.2 Data Recovery Disclaimer</h3>
                <p>For data recovery services:</p>
                <ul>
                    <li>We cannot guarantee 100% data recovery</li>
                    <li>Success depends on the extent of damage</li>
                    <li>We operate on a "No Data, No Fee" basis for standard recovery</li>
                    <li>You retain full ownership of all recovered data</li>
                </ul>
                <div class="warning-box">
                    <h4>Important:</h4>
                    <p>Always maintain backups of important data. We are not liable for data loss due to circumstances beyond our control.</p>
                </div>
            </section>

            <section>
                <h2>7. Customer Responsibilities</h2>
                <p>You agree to:</p>
                <ul>
                    <li><strong>Backup Your Data:</strong> We recommend backing up before service (we can help with this)</li>
                    <li><strong>Provide Access:</strong> Give us necessary passwords/access to perform the service</li>
                    <li><strong>Honest Information:</strong> Provide accurate information about the issue</li>
                    <li><strong>Legal Software:</strong> Ensure all software on your device is legally licensed</li>
                    <li><strong>Timely Collection:</strong> Collect your device within 7 days of notification</li>
                </ul>
            </section>

            <section>
                <h2>8. Limitation of Liability</h2>
                <p>While we take every precaution:</p>
                <ul>
                    <li>We are not liable for pre-existing hardware failures that occur during service</li>
                    <li>Our liability is limited to the cost of services provided</li>
                    <li>We are not responsible for loss of business, revenue, or data beyond our control</li>
                    <li>We are not liable for third-party software issues or compatibility problems</li>
                </ul>
                <p>Australian Consumer Law guarantees apply where relevant.</p>
            </section>

            <section>
                <h2>9. Cancellation Policy</h2>
                <ul>
                    <li><strong>Before Work Starts:</strong> Cancel at any time with no charge</li>
                    <li><strong>During Service:</strong> You pay for work completed to that point</li>
                    <li><strong>Appointments:</strong> Please provide 24 hours notice if cancelling</li>
                </ul>
            </section>

            <section>
                <h2>10. Intellectual Property</h2>
                <p>All content on our website (text, images, logos) is owned by Rapid Tech Solutions and protected by copyright. You may not reproduce our content without permission.</p>
            </section>

            <section>
                <h2>11. Prohibited Uses</h2>
                <p>You may not use our services for:</p>
                <ul>
                    <li>Illegal activities</li>
                    <li>Circumventing software licensing</li>
                    <li>Installing pirated software</li>
                    <li>Any activity that violates Australian law</li>
                </ul>
                <p>We reserve the right to refuse service for any illegal or unethical purpose.</p>
            </section>

            <section>
                <h2>12. Dispute Resolution</h2>
                <p>If you have a concern:</p>
                <ol>
                    <li><strong>Contact Us First:</strong> Call or email us to discuss the issue</li>
                    <li><strong>Written Complaint:</strong> If unresolved, submit a written complaint</li>
                    <li><strong>Mediation:</strong> We may suggest third-party mediation</li>
                    <li><strong>Consumer Affairs:</strong> Contact Consumer Affairs Victoria if needed</li>
                </ol>
                <p>These terms are governed by the laws of Victoria, Australia.</p>
            </section>

            <section>
                <h2>13. Changes to Terms</h2>
                <p>We may update these terms periodically. Continued use of our services after changes constitutes acceptance of new terms. We recommend reviewing these terms regularly.</p>
            </section>

            <section>
                <h2>14. Contact Information</h2>
                <p>For questions about these terms:</p>
                <ul>
                    <li><strong>Phone:</strong> 0423 680 596</li>
                    <li><strong>Email:</strong> info@rapidtechsolutions.au</li>
                    <li><strong>Address:</strong> Patterson Lakes, VIC 3197</li>
                </ul>
            </section>

            <section>
                <h2>15. Severability</h2>
                <p>If any provision of these terms is found to be unenforceable, the remaining provisions will continue in effect.</p>
            </section>
        </article>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div style="display: flex; justify-content: center; gap: 2rem; margin-bottom: 1rem; flex-wrap: wrap;">
                <a href="/privacy-policy/" style="color: var(--muted);">Privacy Policy</a>
                <a href="/terms-of-service/" style="color: var(--muted);">Terms of Service</a>
                <a href="/about/" style="color: var(--muted);">About Us</a>
            </div>
            <p class="footer-note">© <?php echo $current_year; ?> Rapid Tech Solutions. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
