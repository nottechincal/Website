<?php
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Pricing | Computer Repair Costs | ' . RT::NAME,
    'description' => 'Transparent computer repair pricing. Software fixes $80–180, hardware repairs $120–350, data recovery from $150, Wi-Fi & networks $90–250. Free diagnosis, fixed quotes, no fix no fee.',
    'path'        => '/pricing/',
]); ?>
</head>
<body>
<?php rt_header(); ?>
<?php rt_breadcrumbs(['Pricing' => '/pricing/']); ?>

<main id="main">
    <section class="section">
        <div class="container" style="max-width:960px;margin:0 auto;">
            <div class="shead">
                <p class="kicker">Transparent pricing</p>
                <h1>What does computer repair cost?</h1>
                <p>Every job gets a free diagnosis and a fixed quote before any work begins. No surprises, no hidden fees, no fix no fee.</p>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:1.5rem;margin-top:2rem">
                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r3);padding:1.5rem">
                    <div style="font-size:2rem;margin-bottom:.75rem">💻</div>
                    <h2 style="margin-bottom:.5rem">Software &amp; Setup</h2>
                    <p style="font-size:1.4rem;font-weight:700;color:var(--accent);margin-bottom:.75rem">$80 – $180</p>
                    <p style="color:var(--muted);margin-bottom:1rem">Slow machines, virus removal, operating system reinstalls, email setup, data migration, and new device configuration.</p>
                    <ul style="list-style:none;font-size:.9rem;color:var(--muted)">
                        <li style="margin-bottom:.35rem">✅ Virus &amp; malware removal</li>
                        <li style="margin-bottom:.35rem">✅ Windows &amp; macOS reinstall</li>
                        <li style="margin-bottom:.35rem">✅ Speed &amp; performance tune-up</li>
                        <li style="margin-bottom:.35rem">✅ Email &amp; printer setup</li>
                        <li style="margin-bottom:.35rem">✅ New computer setup &amp; data transfer</li>
                    </ul>
                    <a href="/service-virus-removal/" style="display:inline-block;margin-top:1rem;color:var(--accent);font-weight:600">Learn more →</a>
                </div>

                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r3);padding:1.5rem">
                    <div style="font-size:2rem;margin-bottom:.75rem">🔧</div>
                    <h2 style="margin-bottom:.5rem">Hardware Repairs</h2>
                    <p style="font-size:1.4rem;font-weight:700;color:var(--accent);margin-bottom:.75rem">$120 – $350</p>
                    <p style="color:var(--muted);margin-bottom:1rem">Laptop screens, batteries, keyboards, SSDs, RAM upgrades, power jacks, and fan replacements. Parts included in the quote.</p>
                    <ul style="list-style:none;font-size:.9rem;color:var(--muted)">
                        <li style="margin-bottom:.35rem">✅ Screen replacement (most models)</li>
                        <li style="margin-bottom:.35rem">✅ Battery replacement</li>
                        <li style="margin-bottom:.35rem">✅ SSD &amp; RAM upgrades</li>
                        <li style="margin-bottom:.35rem">✅ Keyboard &amp; trackpad repair</li>
                        <li style="margin-bottom:.35rem">✅ Fan &amp; thermal cleaning</li>
                    </ul>
                    <a href="/service-computer-repairs/" style="display:inline-block;margin-top:1rem;color:var(--accent);font-weight:600">Learn more →</a>
                </div>

                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r3);padding:1.5rem">
                    <div style="font-size:2rem;margin-bottom:.75rem">💾</div>
                    <h2 style="margin-bottom:.5rem">Data Recovery</h2>
                    <p style="font-size:1.4rem;font-weight:700;color:var(--accent);margin-bottom:.75rem">From $150</p>
                    <p style="color:var(--muted);margin-bottom:1rem">Hard drive and SSD recovery, deleted file restoration, corrupted drive repair. Free assessment first — we give honest odds before any work.</p>
                    <ul style="list-style:none;font-size:.9rem;color:var(--muted)">
                        <li style="margin-bottom:.35rem">✅ Deleted file recovery</li>
                        <li style="margin-bottom:.35rem">✅ Failed hard drive recovery</li>
                        <li style="margin-bottom:.35rem">✅ SSD &amp; NVMe recovery</li>
                        <li style="margin-bottom:.35rem">✅ USB &amp; SD card recovery</li>
                        <li style="margin-bottom:.35rem">✅ Phone photo recovery</li>
                    </ul>
                    <p style="font-size:.82rem;color:var(--dim);margin-top:.5rem">Complex physical recoveries quoted after free assessment. No recovery, no fee.</p>
                    <a href="/service-data-recovery/" style="display:inline-block;margin-top:.5rem;color:var(--accent);font-weight:600">Learn more →</a>
                </div>

                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r3);padding:1.5rem">
                    <div style="font-size:2rem;margin-bottom:.75rem">📡</div>
                    <h2 style="margin-bottom:.5rem">Wi-Fi &amp; Networks</h2>
                    <p style="font-size:1.4rem;font-weight:700;color:var(--accent);margin-bottom:.75rem">$90 – $250</p>
                    <p style="color:var(--muted);margin-bottom:1rem">Dead zone fixes, mesh Wi-Fi installation, router setup, NBN fault diagnosis, and small business network configuration.</p>
                    <ul style="list-style:none;font-size:.9rem;color:var(--muted)">
                        <li style="margin-bottom:.35rem">✅ Wi-Fi dead zone diagnosis</li>
                        <li style="margin-bottom:.35rem">✅ Mesh system installation</li>
                        <li style="margin-bottom:.35rem">✅ Router &amp; modem setup</li>
                        <li style="margin-bottom:.35rem">✅ NBN fault troubleshooting</li>
                        <li style="margin-bottom:.35rem">✅ Small business networks</li>
                    </ul>
                    <a href="/service-network-wifi/" style="display:inline-block;margin-top:1rem;color:var(--accent);font-weight:600">Learn more →</a>
                </div>
            </div>

            <div style="text-align:center;margin-top:2.5rem;padding:2rem;background:var(--surface);border:1px solid var(--line);border-radius:var(--r3)">
                <p style="font-size:1.1rem;margin-bottom:.5rem"><strong>Diagnosis is always free.</strong> You'll have a fixed price before any work starts.</p>
                <p style="color:var(--muted)">No fix, no fee — guaranteed. If we can't resolve it, you pay nothing.</p>
                <div style="margin-top:1.2rem">
                    <a href="/book/" style="display:inline-block;padding:.85rem 2rem;background:var(--primary);color:#fff;border-radius:var(--r);font-weight:600;font-size:1rem">Book a repair</a>
                    <a href="tel:<?php echo RT::PHONE_E164; ?>" style="display:inline-block;margin-left:.75rem;padding:.85rem 2rem;border:1px solid var(--line-2);color:var(--text);border-radius:var(--r);font-weight:600;font-size:1rem">Call <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php rt_footer(); ?>
</body>
</html>
