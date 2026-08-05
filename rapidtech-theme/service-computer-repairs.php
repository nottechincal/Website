<?php
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Computer Repairs Melbourne | No Fix, No Fee',
    'description' => 'Laptop, desktop and Mac repairs across Melbourne\'s south-east. Free diagnostics, same-day service and a 30-day warranty. No fix, no fee. Call ' . RT::PHONE_DISPLAY . '.',
    'path'        => '/service-computer-repairs/',
    'css'         => 'css/animations.css',
    'schema'      => [[
        '@type'        => 'Service',
        'serviceType'  => 'Computer Repair',
        'provider'     => RT::local_business(),
        'areaServed'   => ['Patterson Lakes', 'Melbourne', 'Frankston', 'Mornington Peninsula'],
        'description'  => 'Professional computer repair services including laptop repairs, desktop fixes, Mac repairs, hardware upgrades, and software troubleshooting.',
        'offers'       => ['@type' => 'Offer', 'description' => 'Free diagnostics with upfront quote before repairs'],
    ]],
]); ?>
</head>
<body>
<?php rt_header(); ?>
<?php rt_breadcrumbs(['Computer Repairs' => '/service-computer-repairs/']); ?>

    <main id="main">
        <section class="service-hero" style="background: linear-gradient(135deg, var(--bg) 0%, #0f1016 100%); padding: 4rem 0;">
            <div class="container">
                <h1 style="font-size: clamp(2.5rem, 5vw, 3.5rem); margin-bottom: 1rem;">Computer Repairs in Melbourne's South-East</h1>
                <p class="lead" style="font-size: 1.3rem; color: var(--muted); max-width: 700px;">Fast, reliable repairs for laptops, desktops, and all-in-one computers. Free diagnostics. Upfront quotes. Same-day service available.</p>
                <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn"><?php echo rt_icon('phone'); ?> Call <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                    <a href="/book/" class="btn btn-outline">Request Free Quote</a>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container" style="max-width: 900px;">
                <h2>Professional Computer Repair Services</h2>
                <p>When your computer stops working properly, you need a technician you can trust. At <?php echo RT::e(RT::NAME); ?>, we provide expert computer repair services throughout Patterson Lakes, Frankston, and the wider Melbourne area. Our experienced technicians diagnose and fix all types of computer problems quickly and affordably.</p>

                <h3 style="margin-top: 2rem; color: var(--accent);">What We Repair</h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin: 1.5rem 0;">
                    <div style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07);">
                        <h4 style="color: var(--primary); margin-bottom: 0.5rem;"><?php echo rt_icon('laptop'); ?> Laptops</h4>
                        <ul style="color: var(--muted); padding-left: 1.2rem;">
                            <li>Broken screens and hinges</li>
                            <li>Keyboard replacement</li>
                            <li>Battery issues</li>
                            <li>Overheating problems</li>
                            <li>Charging port repairs</li>
                        </ul>
                    </div>
                    <div style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07);">
                        <h4 style="color: var(--primary); margin-bottom: 0.5rem;">🖥️ Desktops</h4>
                        <ul style="color: var(--muted); padding-left: 1.2rem;">
                            <li>Won't turn on</li>
                            <li>Blue screen errors</li>
                            <li>Slow performance</li>
                            <li>Hardware upgrades</li>
                            <li>Power supply issues</li>
                        </ul>
                    </div>
                    <div style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07);">
                        <h4 style="color: var(--primary); margin-bottom: 0.5rem;">🍎 Mac Computers</h4>
                        <ul style="color: var(--muted); padding-left: 1.2rem;">
                            <li>macOS issues</li>
                            <li>Startup problems</li>
                            <li>Software conflicts</li>
                            <li>Data migration</li>
                            <li>Performance optimization</li>
                        </ul>
                    </div>
                </div>

                <h3 style="margin-top: 3rem;">Common Problems We Fix Every Day</h3>

                <div style="margin: 1.5rem 0;">
                    <h4 style="color: var(--text);">Slow Computer Performance</h4>
                    <p>Is your computer taking forever to start up or load programs? This is one of the most common issues we see. Causes include too many startup programs, malware infections, failing hard drives, or insufficient RAM. We'll diagnose the exact cause and recommend the most cost-effective solution.</p>
                </div>

                <div style="margin: 1.5rem 0;">
                    <h4 style="color: var(--text);">Blue Screen of Death (BSOD)</h4>
                    <p>The dreaded blue screen indicates a serious problem with your Windows computer. This could be caused by driver conflicts, hardware failures, or corrupted system files. Our technicians have the tools and expertise to identify and resolve these critical errors.</p>
                </div>

                <div style="margin: 1.5rem 0;">
                    <h4 style="color: var(--text);">Computer Won't Turn On</h4>
                    <p>When you press the power button and nothing happens, it's frustrating. The issue could be as simple as a faulty power cable or as serious as a dead motherboard. We test each component systematically to find the fault and get you back up and running.</p>
                </div>

                <div style="margin: 1.5rem 0;">
                    <h4 style="color: var(--text);">Overheating and Shutdowns</h4>
                    <p>Computers that run hot or shut down randomly often have dust buildup blocking airflow, failing fans, or dried-out thermal paste. Left untreated, overheating can permanently damage expensive components. We clean and service cooling systems to prevent costly failures.</p>
                </div>

                <h3 style="margin-top: 3rem; color: var(--accent);">Our Repair Process</h3>

                <div style="margin: 1.5rem 0;">
                    <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem;">
                        <span style="background: var(--primary); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: bold;">1</span>
                        <div>
                            <h4 style="margin: 0 0 0.5rem 0;">Free Diagnostic Assessment</h4>
                            <p style="margin: 0;">We examine your computer at no cost to identify all issues. This includes hardware testing, software analysis, and performance benchmarking.</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem;">
                        <span style="background: var(--primary); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: bold;">2</span>
                        <div>
                            <h4 style="margin: 0 0 0.5rem 0;">Clear Quote Provided</h4>
                            <p style="margin: 0;">Before any work begins, you'll receive a detailed quote explaining what needs to be done and exactly how much it will cost. No hidden fees or surprises.</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem;">
                        <span style="background: var(--primary); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: bold;">3</span>
                        <div>
                            <h4 style="margin: 0 0 0.5rem 0;">Professional Repair</h4>
                            <p style="margin: 0;">Once you approve the quote, we complete the repairs using quality parts. Most repairs are finished the same day or next business day.</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <span style="background: var(--primary); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: bold;">4</span>
                        <div>
                            <h4 style="margin: 0 0 0.5rem 0;">Testing & Handover</h4>
                            <p style="margin: 0;">We thoroughly test everything before returning your computer. You'll also receive advice on preventing future problems.</p>
                        </div>
                    </div>
                </div>

                <h3 style="margin-top: 3rem;">Why Choose <?php echo RT::e(RT::NAME); ?>?</h3>

                <ul style="color: var(--muted); line-height: 1.8;">
                    <li><strong style="color: var(--text);">Free Diagnostics</strong> – We assess your computer at no cost</li>
                    <li><strong style="color: var(--text);">No Fix, No Fee</strong> – If we can't repair it, you don't pay</li>
                    <li><strong style="color: var(--text);">Same-Day Service</strong> – Many repairs completed within hours</li>
                    <li><strong style="color: var(--text);">Local Technician</strong> – Based in <?php echo RT::e(RT::LOCALITY); ?>, we know the area</li>
                    <li><strong style="color: var(--text);">Clear Communication</strong> – We explain problems in plain English</li>
                    <li><strong style="color: var(--text);">Quality Parts</strong> – We use reliable components with warranty</li>
                    <li><strong style="color: var(--text);">Data Protection</strong> – Your files are safe during repairs</li>
                </ul>

                <h3 style="margin-top: 3rem;">Service Areas</h3>
                <p>We provide computer repair services throughout:</p>
                <ul style="color: var(--muted); columns: 2; column-gap: 2rem;">
                    <li>Patterson Lakes</li><li>Carrum</li><li>Seaford</li>
                    <li>Frankston</li><li>Chelsea Heights</li><li>Aspendale</li>
                    <li>Mordialloc</li><li>Mentone</li><li>Dandenong</li>
                    <li>Mornington Peninsula</li>
                </ul>

                <div style="background: var(--primary); padding: 2rem; border-radius: var(--radius); margin-top: 3rem; text-align: center;">
                    <h3 style="color: white; margin-bottom: 1rem;">Need Your Computer Fixed?</h3>
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 1.5rem;">Call now for free diagnostics and same-day service</p>
                    <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn" style="background: white; color: var(--primary);"><?php echo rt_icon('phone'); ?> <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                </div>
            </div>
        </section>

        <!-- Related Services -->
        <section class="section alt">
            <div class="container">
                <h2 style="text-align: center; margin-bottom: 2rem;">Related Services</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                    <a href="/service-data-recovery/" style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07); text-decoration: none; transition: transform 0.3s ease;">
                        <h4 style="color: var(--accent);"><?php echo rt_icon('hdd'); ?> Data Recovery</h4>
                        <p style="color: var(--muted);">Recover lost or deleted files from damaged drives</p>
                    </a>
                    <a href="/service-virus-removal/" style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07); text-decoration: none; transition: transform 0.3s ease;">
                        <h4 style="color: var(--accent);"><?php echo rt_icon('shield'); ?> Virus Removal</h4>
                        <p style="color: var(--muted);">Remove malware and protect your computer</p>
                    </a>
                    <a href="/service-network-wifi/" style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07); text-decoration: none; transition: transform 0.3s ease;">
                        <h4 style="color: var(--accent);"><?php echo rt_icon('wifi'); ?> Network & WiFi</h4>
                        <p style="color: var(--muted);">Fix internet problems and boost WiFi coverage</p>
                    </a>
                </div>
            </div>
        </section>
    </main>

<?php rt_footer(); ?>
</body>
</html>
