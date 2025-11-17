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
    <title>Privacy Policy | Rapid Tech Solutions</title>
    <meta name="description" content="Privacy Policy for Rapid Tech Solutions. Learn how we collect, use, and protect your personal information.">
    <link rel="canonical" href="https://www.rapidtechsolutions.au/privacy-policy/">
    <link rel="icon" type="image/png" href="<?php echo $base_path; ?>/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/styles.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/blog.css" rel="stylesheet">
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
        <div class="article-header">
            <div class="container">
                <h1>Privacy Policy</h1>
                <p class="article-excerpt">Your privacy is important to us. This policy explains how we handle your information.</p>
                <div class="article-info">
                    <span><i class="fas fa-calendar"></i> Last Updated: <?php echo date('F j, Y'); ?></span>
                </div>
            </div>
        </div>

        <article class="article-content">
            <section>
                <h2>1. Introduction</h2>
                <p>Rapid Tech Solutions ("we", "our", "us") is committed to protecting your privacy and personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our services or visit our website.</p>
                <p>We comply with the Australian Privacy Principles (APPs) contained in the Privacy Act 1988 (Cth) and applicable Victorian privacy laws.</p>
            </section>

            <section>
                <h2>2. Information We Collect</h2>

                <h3>2.1 Personal Information</h3>
                <p>We may collect the following personal information:</p>
                <ul>
                    <li><strong>Contact Details:</strong> Name, email address, phone number, physical address</li>
                    <li><strong>Service Information:</strong> Details about your IT issues, computer specifications, service history</li>
                    <li><strong>Payment Information:</strong> Billing address, payment method details (processed securely through third-party providers)</li>
                    <li><strong>Communication Records:</strong> Emails, phone call records, chat transcripts</li>
                </ul>

                <h3>2.2 Technical Information</h3>
                <p>When you visit our website, we automatically collect:</p>
                <ul>
                    <li>IP address and browser type</li>
                    <li>Device information and operating system</li>
                    <li>Pages visited and time spent on our site</li>
                    <li>Referring website or source</li>
                </ul>

                <h3>2.3 Information We Don't Collect</h3>
                <p>We do NOT access, store, or review:</p>
                <ul>
                    <li>Personal files on your computer (unless specifically requested for data recovery)</li>
                    <li>Passwords (except temporarily for service purposes, immediately deleted after)</li>
                    <li>Financial information stored on your device</li>
                    <li>Private communications or browsing history</li>
                </ul>
            </section>

            <section>
                <h2>3. How We Use Your Information</h2>
                <p>We use your personal information to:</p>
                <ul>
                    <li>Provide IT support and repair services</li>
                    <li>Contact you about your service requests</li>
                    <li>Send invoices and process payments</li>
                    <li>Provide warranty support and follow-up</li>
                    <li>Send service reminders (with your consent)</li>
                    <li>Improve our services based on feedback</li>
                    <li>Comply with legal obligations</li>
                </ul>
                <div class="pro-tip">
                    <h4>Your Control:</h4>
                    <p>You can opt out of marketing communications at any time by contacting us or clicking "unsubscribe" in any email.</p>
                </div>
            </section>

            <section>
                <h2>4. Information Sharing and Disclosure</h2>
                <p>We do NOT sell, rent, or trade your personal information. We may share information with:</p>
                <ul>
                    <li><strong>Service Providers:</strong> Payment processors, email services, cloud storage (all bound by confidentiality agreements)</li>
                    <li><strong>Legal Requirements:</strong> When required by law, court order, or to protect our rights</li>
                    <li><strong>Business Transfers:</strong> In the event of a merger or acquisition (you would be notified)</li>
                </ul>

                <h3>Third-Party Services We Use</h3>
                <ul>
                    <li><strong>Tawk.to:</strong> Live chat support (see their privacy policy)</li>
                    <li><strong>Google Analytics:</strong> Website analytics (anonymised data)</li>
                    <li><strong>Payment Processors:</strong> Secure payment handling</li>
                </ul>
            </section>

            <section>
                <h2>5. Data Security</h2>
                <p>We protect your information through:</p>
                <ul>
                    <li>SSL encryption on our website</li>
                    <li>Secure, password-protected systems</li>
                    <li>Limited access to personal information (need-to-know basis)</li>
                    <li>Regular security updates and monitoring</li>
                    <li>Secure disposal of old records</li>
                </ul>
                <div class="warning-box">
                    <h4>Important:</h4>
                    <p>While we implement strong security measures, no internet transmission is 100% secure. We cannot guarantee absolute security of data transmitted online.</p>
                </div>
            </section>

            <section>
                <h2>6. Cookies and Tracking</h2>
                <p>Our website uses cookies to:</p>
                <ul>
                    <li>Remember your preferences</li>
                    <li>Analyse website traffic</li>
                    <li>Enable live chat functionality</li>
                    <li>Improve user experience</li>
                </ul>
                <p>You can control cookies through your browser settings. Disabling cookies may affect some website features.</p>
            </section>

            <section>
                <h2>7. Your Rights</h2>
                <p>Under Australian privacy law, you have the right to:</p>
                <ul>
                    <li><strong>Access:</strong> Request a copy of your personal information we hold</li>
                    <li><strong>Correction:</strong> Ask us to correct inaccurate information</li>
                    <li><strong>Deletion:</strong> Request deletion of your information (subject to legal requirements)</li>
                    <li><strong>Opt-out:</strong> Unsubscribe from marketing communications</li>
                    <li><strong>Complain:</strong> Lodge a complaint if you believe we've breached your privacy</li>
                </ul>
                <p>To exercise these rights, contact us using the details below.</p>
            </section>

            <section>
                <h2>8. Data Retention</h2>
                <p>We retain your information for:</p>
                <ul>
                    <li><strong>Service Records:</strong> 7 years (Australian tax law requirement)</li>
                    <li><strong>Marketing Contacts:</strong> Until you unsubscribe</li>
                    <li><strong>Website Analytics:</strong> 26 months</li>
                    <li><strong>Chat Transcripts:</strong> 12 months</li>
                </ul>
                <p>After these periods, data is securely deleted or anonymised.</p>
            </section>

            <section>
                <h2>9. Children's Privacy</h2>
                <p>Our services are not directed to children under 18. We do not knowingly collect information from minors. If we discover we have collected information from a child, we will delete it immediately.</p>
            </section>

            <section>
                <h2>10. Changes to This Policy</h2>
                <p>We may update this Privacy Policy periodically. We will notify you of significant changes by:</p>
                <ul>
                    <li>Posting the updated policy on this page</li>
                    <li>Updating the "Last Updated" date</li>
                    <li>Emailing you if the changes are material</li>
                </ul>
            </section>

            <section>
                <h2>11. Contact Us</h2>
                <p>For privacy questions, concerns, or to exercise your rights, contact us:</p>
                <ul>
                    <li><strong>Phone:</strong> 0423 680 596</li>
                    <li><strong>Email:</strong> privacy@rapidtechsolutions.au</li>
                    <li><strong>Address:</strong> Patterson Lakes, VIC 3197</li>
                </ul>
                <p>We will respond to your inquiry within 30 days.</p>
            </section>

            <section>
                <h2>12. Complaints</h2>
                <p>If you believe we have breached your privacy, please contact us first. If you're not satisfied with our response, you can lodge a complaint with:</p>
                <p><strong>Office of the Australian Information Commissioner (OAIC)</strong><br>
                Website: www.oaic.gov.au<br>
                Phone: 1300 363 992</p>
            </section>
        </article>
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
