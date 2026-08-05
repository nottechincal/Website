<?php
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title' => 'How to Spot and Avoid Tech Support Scams',
    'description' => 'Recognise fake tech support calls, phishing emails and remote-access scams targeting Australians, and know exactly what to do if you have been caught.',
    'path' => '/blog-scam-protection/',
    'og_type' => 'article',
    'css' => 'css/blog.css',
    'article_published' => '2025-11-17',
    'article_modified' => '2025-11-17',
    'article_author' => RT::NAME,
    'article_section' => 'Online Safety',
    'schema' => [
        [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => 'How to Spot and Avoid Tech Support Scams',
            'description' => 'Learn to identify fake tech support calls, phishing emails, and online scams targeting Melbourne residents. Protect your family and finances.',
            'image' => RT::url(RT::OG_IMAGE),
            'author' => [
                '@type' => 'Organization',
                'name' => RT::NAME,
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => RT::NAME,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => RT::url(RT::LOGO),
                ],
            ],
            'datePublished' => '2025-11-17',
            'dateModified' => '2025-11-17',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => RT::url('/blog-scam-protection/'),
            ],
            'provider' => RT::local_business(),
        ],
    ],
]); ?>
</head>
<body>
<?php rt_header(); ?>

<?php rt_breadcrumbs(['Blog' => '/blog/', 'Scam Protection' => '/blog-scam-protection/']); ?>

    <main id="main">
        <div class="article-header">
            <div class="container">
                <div class="article-meta">
                    <span class="category">Online Safety</span>
                    <span class="reading-time"><?php echo rt_icon('clock'); ?> 6 min read</span>
                </div>
                <h1>How to Spot and Avoid Tech Support Scams</h1>
                <p class="article-excerpt">Protect yourself and your family from the most common scams targeting Australians right now.</p>
                <div class="article-info">
                    <span><?php echo rt_icon('calendar'); ?> <?php echo date('F j, Y'); ?></span>
                    <span><?php echo rt_icon('user'); ?> Rapid Tech Solutions</span>
                </div>
            </div>
        </div>

        <article class="article-content">
            <div class="warning-box">
                <h4>Important:</h4>
                <p>Australians lost over $3.1 billion to scams in 2022, with tech support scams being one of the fastest-growing categories. Patterson Lakes and surrounding suburbs have seen a significant increase in these attacks.</p>
            </div>

            <section>
                <h2>Common Scams Targeting Our Community</h2>
                <p>As your local IT support team, we've helped many Patterson Lakes residents recover from scams. Here are the most common ones we see:</p>

                <h3>1. The "Microsoft" Phone Call</h3>
                <p>You receive a call claiming to be from Microsoft, Telstra, or the NBN. They say your computer has a virus or your internet will be disconnected. <strong>This is always a scam.</strong></p>
                <ul>
                    <li>Microsoft will never call you unsolicited</li>
                    <li>They'll ask you to install remote access software</li>
                    <li>They'll demand payment via gift cards or cryptocurrency</li>
                    <li>They may threaten legal action to scare you</li>
                </ul>

                <h3>2. Fake Virus Pop-ups</h3>
                <p>While browsing, a scary full-screen message appears saying your computer is infected. It provides a phone number to call for "support."</p>
                <div class="pro-tip">
                    <h4>What to Do:</h4>
                    <p>Don't call the number. Press Alt+F4 to close the browser, or restart your computer. Real virus warnings come from your installed antivirus software, not websites.</p>
                </div>

                <div class="service-cta">
                    <h4><?php echo rt_icon('shield'); ?> Need Professional Virus Removal?</h4>
                    <p>If you suspect your computer has been compromised by a scam, our experts can help. We remove malware, secure your system, and set up protection.</p>
                    <a href="/service-virus-removal/" class="btn">Learn About Virus Removal Services</a>
                </div>

                <h3>3. Phishing Emails</h3>
                <p>Emails pretending to be from Australia Post, your bank, or the ATO asking you to click a link and enter your details.</p>
                <ul>
                    <li>Check the sender's actual email address (hover over it)</li>
                    <li>Look for spelling errors and generic greetings</li>
                    <li>Banks never ask for passwords via email</li>
                    <li>When in doubt, call the company directly using their official number</li>
                </ul>

                <h3>4. Facebook Marketplace Scams</h3>
                <p>Buying or selling items online? Watch for:</p>
                <ul>
                    <li>Buyers offering more than your asking price</li>
                    <li>Requests to pay via PayID to "verify" your account</li>
                    <li>Sellers asking for payment before you see the item</li>
                    <li>Too-good-to-be-true deals on electronics</li>
                </ul>
            </section>

            <section>
                <h2>Red Flags to Watch For</h2>
                <ul>
                    <li><strong>Urgency:</strong> "Act now or lose access"</li>
                    <li><strong>Fear:</strong> "Your computer is infected with dangerous viruses"</li>
                    <li><strong>Authority:</strong> Claims to be from government or major companies</li>
                    <li><strong>Unusual payment methods:</strong> Gift cards, Bitcoin, wire transfers</li>
                    <li><strong>Remote access requests:</strong> Asking to install TeamViewer, AnyDesk, etc.</li>
                    <li><strong>Poor English:</strong> Grammar mistakes in official-looking messages</li>
                </ul>
            </section>

            <section>
                <h2>What To Do If You've Been Scammed</h2>
                <p>If you've fallen victim to a scam, act quickly:</p>
                <ol>
                    <li><strong>Contact your bank immediately</strong> to freeze accounts and stop transactions</li>
                    <li><strong>Change all passwords</strong> from a different, secure device</li>
                    <li><strong>Report to Scamwatch</strong> at scamwatch.gov.au</li>
                    <li><strong>If they had remote access</strong>, bring your computer to us for a security check</li>
                    <li><strong>Alert family members</strong> who may be targeted next</li>
                </ol>
            </section>

            <section>
                <h2>Protecting Elderly Family Members</h2>
                <p>Scammers often target seniors. Here's how to help:</p>
                <ul>
                    <li>Set up call blocking on their phone</li>
                    <li>Install ad blockers to prevent fake pop-ups</li>
                    <li>Create a family code word for legitimate contact</li>
                    <li>Encourage them to check with you before making any payments</li>
                    <li>Consider our security setup service for their devices</li>
                </ul>
                <div class="stat-box">
                    <p><strong>Fact:</strong> Australians over 65 reported losses of $120.7 million to scams in 2022. Prevention is key.</p>
                </div>
            </section>

            <section class="cta-section">
                <h2>Think You've Been Targeted?</h2>
                <p>We offer free security checks for Patterson Lakes residents concerned about scams. Our services include:</p>
                <ul>
                    <li>Computer security assessment</li>
                    <li>Removal of remote access software</li>
                    <li>Password security review</li>
                    <li>Family safety training</li>
                </ul>
                <div class="cta-buttons">
                    <a href="/book/" class="btn"><?php echo rt_icon('shield'); ?> Get a Free Security Check</a>
                    <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn btn-outline"><?php echo rt_icon('phone'); ?> Call Us: <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                </div>
            </section>

            <div class="related-articles">
                <h3>Related Articles</h3>
                <div class="related-grid">
                    <div class="related-card">
                        <h4>Protect Against Malware</h4>
                        <p>Essential security practices to keep your devices safe from viruses and malicious software.</p>
                        <a href="/blog-malware-protection/">Read Article →</a>
                    </div>
                    <div class="related-card">
                        <h4>Creating Strong Passwords</h4>
                        <p>Learn how to create and manage secure passwords for all your accounts.</p>
                        <a href="/blog-password-security/">Read Article →</a>
                    </div>
                    <div class="related-card">
                        <h4>Monthly Computer Maintenance</h4>
                        <p>Simple steps to keep your computer running smoothly and securely.</p>
                        <a href="/blog-computer-maintenance/">Read Article →</a>
                    </div>
                </div>
            </div>
        </article>
    </main>

<?php rt_footer(); ?>
</body>
</html>
