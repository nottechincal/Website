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
    <title>FAQ - Frequently Asked Questions | Rapid Tech Solutions Melbourne</title>
    <meta name="description" content="Answers to common questions about computer repair, IT support, pricing, service areas, and data security. Get expert answers from Melbourne's trusted tech team.">
    <link rel="canonical" href="https://www.rapidtechsolutions.au/faq/">
    <meta property="og:title" content="FAQ - Computer Repair Questions Answered">
    <meta property="og:description" content="Get answers to your computer repair questions from Melbourne's trusted IT experts.">
    <meta property="og:url" content="https://www.rapidtechsolutions.au/faq/">
    <meta property="og:image" content="https://www.rapidtechsolutions.au/images/og-image.jpg">
    <link rel="icon" type="image/png" href="<?php echo $base_path; ?>/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/styles.css" rel="stylesheet">
    <link href="<?php echo $base_path; ?>/css/blog.css" rel="stylesheet">
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BDN34WT3J6"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-BDN34WT3J6');
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "How much does computer repair cost?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We offer free diagnostics to assess your issue first. Repair costs vary depending on the problem, but we always provide a clear quote before starting work. Common repairs range from $50-$200 for software issues to $150-$400 for hardware repairs. No hidden fees."
                }
            },
            {
                "@type": "Question",
                "name": "Do you offer same-day service?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Yes! We offer same-day service for most repairs across Melbourne's south-east. Many repairs are completed within 1-2 hours. For complex issues requiring parts, we typically complete repairs within 24-48 hours."
                }
            },
            {
                "@type": "Question",
                "name": "What areas do you service?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "We service 35+ suburbs across Melbourne's south-east including Cranbourne, Dandenong, Patterson Lakes, Frankston, Berwick, Narre Warren, and surrounding areas. Remote support is available Australia-wide."
                }
            }
        ]
    }
    </script>
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="/"><span class="brand-mark lightning-animated"></span>Rapid Tech Solutions</a>
            <nav class="primary-nav">
                <a href="/#services">Services</a>
                <a href="tel:+61423680596" class="btn btn-outline"><i class="fas fa-phone"></i> 0423 680 596</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="article-header">
            <div class="container">
                <p class="eyebrow">Help Center</p>
                <h1>Frequently Asked Questions</h1>
                <p class="article-excerpt">Find answers to common questions about our computer repair and IT support services in Melbourne.</p>
            </div>
        </div>

        <article class="article-content">
            <section>
                <h2>💰 Pricing & Payments</h2>
                <div class="faq-grid" style="grid-template-columns: 1fr;">
                    <details open>
                        <summary>How much does computer repair cost?</summary>
                        <p>We offer <strong>free diagnostics</strong> to assess your issue first. Repair costs vary depending on the problem, but we always provide a clear quote before starting work. Typical pricing:</p>
                        <ul>
                            <li><strong>Software fixes:</strong> $50-$200 (virus removal, slow computer, software issues)</li>
                            <li><strong>Hardware repairs:</strong> $150-$400 (screen replacement, hard drive upgrade, component repair)</li>
                            <li><strong>Data recovery:</strong> $100-$500 (depending on complexity)</li>
                            <li><strong>Network setup:</strong> $150-$350 (home WiFi, mesh systems)</li>
                        </ul>
                        <p><strong>No hidden fees.</strong> The quote we give is the price you pay.</p>
                    </details>

                    <details>
                        <summary>Do you charge a callout fee?</summary>
                        <p>No callout fee for most Melbourne south-east suburbs when you proceed with the repair. If you decline the repair after our free diagnostic, a $50 service fee applies to cover travel costs.</p>
                    </details>

                    <details>
                        <summary>What payment methods do you accept?</summary>
                        <p>We accept cash, bank transfer, credit/debit cards (Visa, Mastercard), and EFTPOS. Payment is due upon completion of the repair.</p>
                    </details>

                    <details>
                        <summary>Do you offer payment plans?</summary>
                        <p>For larger repairs (over $300), we can arrange payment plans for approved customers. Contact us to discuss options.</p>
                    </details>
                </div>
            </section>

            <section>
                <h2>⏱️ Service & Response Times</h2>
                <div class="faq-grid" style="grid-template-columns: 1fr;">
                    <details>
                        <summary>How quickly can you come to my home/office?</summary>
                        <p>We typically offer <strong>same-day service</strong> in Melbourne's south-east. Book in the morning, and we can often attend the same afternoon. For urgent issues, we prioritize emergency callouts.</p>
                    </details>

                    <details>
                        <summary>How long do repairs take?</summary>
                        <p>Repair time depends on the issue:</p>
                        <ul>
                            <li><strong>Software issues:</strong> 1-2 hours (virus removal, slow computer, software problems)</li>
                            <li><strong>Simple hardware:</strong> 1-3 hours (RAM upgrades, basic component replacement)</li>
                            <li><strong>Screen replacement:</strong> 24-48 hours (if parts in stock)</li>
                            <li><strong>Complex repairs:</strong> 2-5 days (motherboard issues, water damage, data recovery)</li>
                        </ul>
                        <p>We always give you a timeframe upfront.</p>
                    </details>

                    <details>
                        <summary>Do you offer after-hours and weekend service?</summary>
                        <p>Yes! We offer <strong>after-hours and weekend service</strong> for emergencies. Additional fees may apply for out-of-hours callouts. Call us to arrange: <strong>0423 680 596</strong></p>
                    </details>
                </div>
            </section>

            <section>
                <h2>🏘️ Service Areas & Locations</h2>
                <div class="faq-grid" style="grid-template-columns: 1fr;">
                    <details>
                        <summary>What suburbs do you service?</summary>
                        <p>We service <strong>35+ Melbourne suburbs</strong> including:</p>
                        <ul style="columns: 2;">
                            <li>Cranbourne & Cranbourne South</li>
                            <li>Dandenong</li>
                            <li>Patterson Lakes</li>
                            <li>Frankston</li>
                            <li>Berwick</li>
                            <li>Narre Warren</li>
                            <li>Chelsea Heights</li>
                            <li>Seaford</li>
                            <li>Carrum</li>
                            <li>Keysborough</li>
                            <li>Noble Park</li>
                            <li>Springvale</li>
                        </ul>
                        <p><a href="/service-areas/">View complete list of service areas</a></p>
                    </details>

                    <details>
                        <summary>Do you come to my home or do I bring my computer in?</summary>
                        <p>We offer <strong>both options</strong>:</p>
                        <ul>
                            <li><strong>On-site service:</strong> We come to your home or office (most popular)</li>
                            <li><strong>Drop-off service:</strong> Bring your computer to us in Cranbourne South</li>
                            <li><strong>Remote support:</strong> For software issues, we can connect remotely</li>
                        </ul>
                        <p>For complex repairs requiring extended work, we may take the computer to our workshop and return it once fixed.</p>
                    </details>

                    <details>
                        <summary>Do you offer remote support?</summary>
                        <p>Yes! For software issues, we offer <strong>remote support</strong> where we connect to your computer via secure remote access. This is faster and more convenient for issues like slow performance, software problems, or configuration help.</p>
                    </details>
                </div>
            </section>

            <section>
                <h2>🔧 Services & Capabilities</h2>
                <div class="faq-grid" style="grid-template-columns: 1fr;">
                    <details>
                        <summary>Do you repair Mac computers as well as Windows PCs?</summary>
                        <p>Yes! We service both <strong>Mac and Windows computers</strong>. Our technicians are experienced with Apple MacBooks, iMacs, Mac Minis, as well as all Windows laptop and desktop brands (Dell, HP, Lenovo, ASUS, Acer, etc.).</p>
                    </details>

                    <details>
                        <summary>Can you remove viruses from my computer?</summary>
                        <p>Absolutely. We specialize in <strong>virus and malware removal</strong>. We'll clean your system thoroughly, remove all threats, install protection to prevent future infections, and show you how to stay safe online.</p>
                    </details>

                    <details>
                        <summary>Can you recover my deleted files?</summary>
                        <p>In many cases, yes. We offer <strong>data recovery services</strong> for:</p>
                        <ul>
                            <li>Accidentally deleted files</li>
                            <li>Failed or damaged hard drives</li>
                            <li>Corrupted USB drives and SD cards</li>
                            <li>Ransomware-encrypted files</li>
                        </ul>
                        <p>We operate on a "no data, no fee" basis - if we can't recover your files, you don't pay for the attempt.</p>
                    </details>

                    <details>
                        <summary>Do you build custom computers?</summary>
                        <p>Yes! We build custom gaming PCs, workstations, and office computers tailored to your needs and budget. We source quality components and provide warranty on all builds.</p>
                    </details>

                    <details>
                        <summary>Can you help set up a home network?</summary>
                        <p>Yes. We install and configure home and office networks including WiFi routers, mesh WiFi systems, network printers, and smart home devices. We eliminate WiFi dead zones and optimize for speed and coverage.</p>
                    </details>
                </div>
            </section>

            <section>
                <h2>🔒 Data Security & Privacy</h2>
                <div class="faq-grid" style="grid-template-columns: 1fr;">
                    <details>
                        <summary>Will I lose my files during repairs?</summary>
                        <p>We take <strong>data protection seriously</strong>. Before any repair, we discuss backup options with you. In most cases, your files remain safe. For high-risk repairs, we'll back up your data first.</p>
                    </details>

                    <details>
                        <summary>Is my personal data safe with you?</summary>
                        <p>Yes. We adhere to strict <strong>privacy and data protection policies</strong>. We never access your personal files unless required for the repair, and we delete any temporary backups after completing work. All data is handled confidentially.</p>
                    </details>

                    <details>
                        <summary>Do you keep my passwords or personal information?</summary>
                        <p>No. We never record or store your passwords or personal information. If we need access to your system for repairs, we ask you to provide temporary access or watch while we work.</p>
                    </details>
                </div>
            </section>

            <section>
                <h2>✅ Guarantees & Warranties</h2>
                <div class="faq-grid" style="grid-template-columns: 1fr;">
                    <details>
                        <summary>What if you can't fix my computer?</summary>
                        <p>We operate on a <strong>"no fix, no fee" basis</strong> for many services. If we can't solve your problem, you won't be charged for the repair attempt. We'll always be honest about the likelihood of success before starting.</p>
                    </details>

                    <details>
                        <summary>Do you offer a warranty on repairs?</summary>
                        <p>Yes. We provide a <strong>30-day warranty</strong> on all labour and repairs. If the same issue recurs within 30 days, we'll fix it at no extra charge. Parts come with manufacturer warranty (typically 1-3 years).</p>
                    </details>

                    <details>
                        <summary>What if a part you installed fails?</summary>
                        <p>All parts we install come with <strong>manufacturer warranty</strong>. If a part fails within the warranty period, we'll replace it free of charge (parts only - warranty covers faulty parts, not accidental damage).</p>
                    </details>
                </div>
            </section>

            <section>
                <h2>👥 Customer Support</h2>
                <div class="faq-grid" style="grid-template-columns: 1fr;">
                    <details>
                        <summary>Can you help seniors/elderly who aren't tech-savvy?</summary>
                        <p>Absolutely! We're <strong>patient and explain everything in plain English</strong>. Many of our customers are seniors who appreciate our friendly, no-rush approach. We can also provide basic computer training if needed.</p>
                    </details>

                    <details>
                        <summary>Do you offer ongoing IT support for businesses?</summary>
                        <p>Yes. We offer <strong>managed IT support</strong> for small to medium businesses including:</p>
                        <ul>
                            <li>Regular maintenance and monitoring</li>
                            <li>Priority response times</li>
                            <li>Network management</li>
                            <li>Security and backup solutions</li>
                            <li>Microsoft 365 administration</li>
                        </ul>
                        <p><a href="/#contact">Contact us for a business IT consultation</a></p>
                    </details>

                    <details>
                        <summary>How do I book a service?</summary>
                        <p>Three easy ways:</p>
                        <ul>
                            <li><strong>Call:</strong> 0423 680 596 (fastest)</li>
                            <li><strong>Book online:</strong> <a href="/book/">Use our booking form</a></li>
                            <li><strong>Contact form:</strong> <a href="/#contact">Send us a message</a></li>
                        </ul>
                    </details>
                </div>
            </section>

            <section class="cta-section">
                <h2>Still Have Questions?</h2>
                <p>Can't find what you're looking for? We're here to help. Give us a call or send us a message.</p>
                <div class="cta-buttons">
                    <a href="tel:+61423680596" class="btn"><i class="fas fa-phone"></i> Call: 0423 680 596</a>
                    <a href="/#contact" class="btn btn-outline"><i class="fas fa-envelope"></i> Contact Us</a>
                </div>
            </section>
        </article>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p class="footer-note">© <?php echo $year; ?> Rapid Tech Solutions. All rights reserved.</p>
        </div>
    </footer>

    <style>
    details {
        background: rgba(255,255,255,0.03);
        padding: 1.25rem;
        margin-bottom: 1rem;
        border-radius: 8px;
        border: 1px solid rgba(255,255,255,0.07);
        cursor: pointer;
    }

    details[open] {
        border-color: rgba(41, 213, 255, 0.3);
    }

    summary {
        font-weight: 600;
        font-size: 1.1rem;
        color: #fff;
        cursor: pointer;
        user-select: none;
        list-style: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    summary::-webkit-details-marker {
        display: none;
    }

    summary::after {
        content: '+';
        font-size: 1.5rem;
        color: #29d5ff;
        transition: transform 0.3s;
    }

    details[open] summary::after {
        content: '−';
        transform: rotate(180deg);
    }

    details p, details ul {
        margin-top: 1rem;
        color: var(--muted);
    }

    details a {
        color: #29d5ff;
        text-decoration: none;
    }

    details a:hover {
        text-decoration: underline;
    }
    </style>
</body>
</html>
