<?php
/*
Template Name: FAQ
*/
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';

$faq_schema = [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [],
];

$faqs = [
    ['How much does computer repair cost?',
     'We offer free diagnostics to assess your issue first. Repair costs vary depending on the problem, but we always provide a clear quote before starting work. Typical pricing: Software fixes: $50-$200 (virus removal, slow computer, software issues) Hardware repairs: $150-$400 (screen replacement, hard drive upgrade, component repair) Data recovery: $100-$500 (depending on complexity) Network setup: $150-$350 (home WiFi, mesh systems) No hidden fees. The quote we give is the price you pay.'],
    ['Do you charge a callout fee?',
     'No callout fee for most Melbourne south-east suburbs when you proceed with the repair. If you decline the repair after our free diagnostic, a $50 service fee applies to cover travel costs.'],
    ['What payment methods do you accept?',
     'We accept cash, bank transfer, credit/debit cards (Visa, Mastercard), and EFTPOS. Payment is due upon completion of the repair.'],
    ['Do you offer payment plans?',
     'For larger repairs (over $300), we can arrange payment plans for approved customers. Contact us to discuss options.'],
    ['How quickly can you come to my home/office?',
     'We typically offer same-day service in Melbourne\'s south-east. Book in the morning, and we can often attend the same afternoon. For urgent issues, we prioritise emergency callouts.'],
    ['How long do repairs take?',
     'Repair time depends on the issue: Software issues: 1-2 hours (virus removal, slow computer, software problems) Simple hardware: 1-3 hours (RAM upgrades, basic component replacement) Screen replacement: 24-48 hours (if parts in stock) Complex repairs: 2-5 days (motherboard issues, water damage, data recovery) We always give you a timeframe upfront.'],
    ['Do you offer after-hours and weekend service?',
     'Yes! We offer after-hours and weekend service for emergencies. Additional fees may apply for out-of-hours callouts. Call us to arrange: ' . RT::PHONE_DISPLAY],
    ['What suburbs do you service?',
     'We service 35+ Melbourne suburbs including: Cranbourne & Cranbourne South Dandenong Patterson Lakes Frankston Berwick Narre Warren Chelsea Heights Seaford Carrum Keysborough Noble Park Springvale View complete list of service areas'],
    ['Do you come to my home or do I bring my computer in?',
     'We offer both options : On-site service: We come to your home or office (most popular) Drop-off service: Bring your computer to us in ' . RT::LOCALITY . ' Remote support: For software issues, we can connect remotely For complex repairs requiring extended work, we may take the computer to our workshop and return it once fixed.'],
    ['Do you offer remote support?',
     'Yes! For software issues, we offer remote support where we connect to your computer via secure remote access. This is faster and more convenient for issues like slow performance, software problems, or configuration help.'],
    ['Do you repair Mac computers as well as Windows PCs?',
     'Yes! We service both Mac and Windows computers. Our technicians are experienced with Apple MacBooks, iMacs, Mac Minis, as well as all Windows laptop and desktop brands (Dell, HP, Lenovo, ASUS, Acer, etc.).'],
    ['Can you remove viruses from my computer?',
     'Absolutely. We specialise in virus and malware removal. We\'ll clean your system thoroughly, remove all threats, install protection to prevent future infections, and show you how to stay safe online.'],
    ['Can you recover my deleted files?',
     'In many cases, yes. We offer data recovery services for: Accidentally deleted files Failed or damaged hard drives Corrupted USB drives and SD cards Ransomware-encrypted files We operate on a "no data, no fee" basis - if we can\'t recover your files, you don\'t pay for the attempt.'],
    ['Do you build custom computers?',
     'Yes! We build custom gaming PCs, workstations, and office computers tailored to your needs and budget. We source quality components and provide warranty on all builds.'],
    ['Can you help set up a home network?',
     'Yes. We install and configure home and office networks including WiFi routers, mesh WiFi systems, network printers, and smart home devices. We eliminate WiFi dead zones and optimise for speed and coverage.'],
    ['Will I lose my files during repairs?',
     'We take data protection seriously. Before any repair, we discuss backup options with you. In most cases, your files remain safe. For high-risk repairs, we\'ll back up your data first.'],
    ['Is my personal data safe with you?',
     'Yes. We adhere to strict privacy and data protection policies. We never access your personal files unless required for the repair, and we delete any temporary backups after completing work. All data is handled confidentially.'],
    ['Do you keep my passwords or personal information?',
     'No. We never record or store your passwords or personal information. If we need access to your system for repairs, we ask you to provide temporary access or watch while we work.'],
    ['What if you can\'t fix my computer?',
     'We operate on a "no fix, no fee" basis for many services. If we can\'t solve your problem, you won\'t be charged for the repair attempt. We\'ll always be honest about the likelihood of success before starting.'],
    ['Do you offer a warranty on repairs?',
     'Yes. We provide a 30-day warranty on all labour and repairs. If the same issue recurs within 30 days, we\'ll fix it at no extra charge. Parts come with manufacturer warranty (typically 1-3 years).'],
    ['What if a part you installed fails?',
     'All parts we install come with manufacturer warranty. If a part fails within the warranty period, we\'ll replace it free of charge (parts only - warranty covers faulty parts, not accidental damage).'],
    ['Can you help seniors/elderly who aren\'t tech-savvy?',
     'Absolutely! We\'re patient and explain everything in plain English. Many of our customers are seniors who appreciate our friendly, no-rush approach. We can also provide basic computer training if needed.'],
    ['Do you offer ongoing IT support for businesses?',
     'Yes. We offer managed IT support for small to medium businesses including: Regular maintenance and monitoring Priority response times Network management Security and backup solutions Microsoft 365 administration Contact us for a business IT consultation'],
    ['How do I book a service?',
     'Three easy ways: Call: ' . RT::PHONE_DISPLAY . ' (fastest) Book online: Use our booking form Contact form: Send us a message'],
];

foreach ($faqs as $faq) {
    $faq_schema['mainEntity'][] = [
        '@type'          => 'Question',
        'name'           => $faq[0],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq[1]],
    ];
}

$faq_inline_css = <<<'CSS'
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
CSS;
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Computer Repair FAQ | ' . RT::NAME,
    'description' => 'Straight answers on pricing, callout times, service areas, warranties and data security for computer repairs across Melbourne\'s south-east.',
    'path'        => '/faq/',
    'css'         => 'css/blog.css',
    'inline_css'  => $faq_inline_css,
    'schema'      => [$faq_schema],
]); ?>
</head>
<body>
<?php rt_header(); ?>

    <main id="main">
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
                        <p>We typically offer <strong>same-day service</strong> in Melbourne's south-east. Book in the morning, and we can often attend the same afternoon. For urgent issues, we prioritise emergency callouts.</p>
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
                        <p>Yes! We offer <strong>after-hours and weekend service</strong> for emergencies. Additional fees may apply for out-of-hours callouts. Call us to arrange: <strong><?php echo RT::e(RT::PHONE_DISPLAY); ?></strong></p>
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
                            <li><strong>Drop-off service:</strong> Bring your computer to us in <?php echo RT::e(RT::LOCALITY); ?></li>
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
                        <summary>Can you remove viruses from your computer?</summary>
                        <p>Absolutely. We specialise in <strong>virus and malware removal</strong>. We'll clean your system thoroughly, remove all threats, install protection to prevent future infections, and show you how to stay safe online.</p>
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
                        <p>Yes. We install and configure home and office networks including WiFi routers, mesh WiFi systems, network printers, and smart home devices. We eliminate WiFi dead zones and optimise for speed and coverage.</p>
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
                        <p><a href="/book/">Contact us for a business IT consultation</a></p>
                    </details>

                    <details>
                        <summary>How do I book a service?</summary>
                        <p>Three easy ways:</p>
                        <ul>
                            <li><strong>Call:</strong> <?php echo RT::e(RT::PHONE_DISPLAY); ?> (fastest)</li>
                            <li><strong>Book online:</strong> <a href="/book/">Use our booking form</a></li>
                            <li><strong>Contact form:</strong> <a href="/book/">Send us a message</a></li>
                        </ul>
                    </details>
                </div>
            </section>

            <section class="cta-section">
                <h2>Still Have Questions?</h2>
                <p>Can't find what you're looking for? We're here to help. Give us a call or send us a message.</p>
                <div class="cta-buttons">
                    <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn"><?php echo rt_icon('phone'); ?> Call: <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                    <a href="/book/" class="btn btn-outline"><?php echo rt_icon('mail'); ?> Contact Us</a>
                </div>
            </section>
        </article>
    </main>

<?php rt_footer(); ?>
</body>
</html>
