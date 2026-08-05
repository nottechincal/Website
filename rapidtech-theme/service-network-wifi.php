<?php
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Network & Wi-Fi Solutions Melbourne | Fix Slow Wi-Fi',
    'description' => 'Fix slow or patchy Wi-Fi, extend coverage with mesh systems, sort NBN faults and set up business networks across Melbourne\'s south-east. Same-day service.',
    'path'        => '/service-network-wifi/',
    'css'         => 'css/animations.css',
    'schema'      => [[
        '@type'        => 'Service',
        'serviceType'  => 'Network and WiFi Services',
        'provider'     => RT::local_business(),
        'areaServed'   => ['Patterson Lakes', 'Melbourne', 'Frankston', 'Mornington Peninsula'],
        'description'  => 'Professional network setup, WiFi optimization, coverage extension, and internet troubleshooting services for homes and small businesses.',
        'offers'       => ['@type' => 'Offer', 'description' => 'WiFi optimization and network setup with satisfaction guarantee'],
    ]],
]); ?>
</head>
<body>
<?php rt_header(); ?>
<?php rt_breadcrumbs(['Network & WiFi' => '/service-network-wifi/']); ?>

    <main id="main">
        <section class="service-hero" style="background: linear-gradient(135deg, var(--bg) 0%, #0f1016 100%); padding: 4rem 0;">
            <div class="container">
                <h1 style="font-size: clamp(2.5rem, 5vw, 3.5rem); margin-bottom: 1rem;">Network & WiFi Solutions in Melbourne's South-East</h1>
                <p class="lead" style="font-size: 1.3rem; color: var(--muted); max-width: 700px;">Slow WiFi? Dead zones? Connection dropping? We optimise your network for maximum speed and coverage throughout your home or office. Fast, reliable internet everywhere you need it.</p>
                <div style="margin-top: 2rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn"><?php echo rt_icon('phone'); ?> Call <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                    <a href="/book/" class="btn btn-outline">Request WiFi Assessment</a>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container" style="max-width: 900px;">
                <h2>Professional Network and WiFi Services</h2>
                <p>In today's connected world, reliable internet isn't a luxury – it's essential. Whether you're working from home, streaming movies, gaming online, or managing smart home devices, your WiFi network needs to perform flawlessly. At <?php echo RT::e(RT::NAME); ?>, we specialise in diagnosing and solving network problems, ensuring you get the fast, stable internet connection you're paying for.</p>
                <p>Modern households have more connected devices than ever before. When your network isn't properly configured, this leads to buffering videos, dropped Zoom calls, and general frustration. Our network optimization services address these issues at their root cause with professional solutions that deliver real results.</p>

                <h3 style="margin-top: 2rem; color: var(--accent);">Our Network & WiFi Services</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin: 1.5rem 0;">
                    <div style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07);">
                        <h4 style="color: var(--primary); margin-bottom: 0.5rem;"><?php echo rt_icon('wifi'); ?> WiFi Optimization</h4>
                        <ul style="color: var(--muted); padding-left: 1.2rem;"><li>Speed improvement</li><li>Channel optimization</li><li>Router placement advice</li><li>Interference elimination</li><li>Band steering setup</li></ul>
                    </div>
                    <div style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07);">
                        <h4 style="color: var(--primary); margin-bottom: 0.5rem;">📡 Coverage Extension</h4>
                        <ul style="color: var(--muted); padding-left: 1.2rem;"><li>Mesh network setup</li><li>WiFi extender installation</li><li>Access point deployment</li><li>Dead zone elimination</li><li>Outdoor WiFi solutions</li></ul>
                    </div>
                    <div style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07);">
                        <h4 style="color: var(--primary); margin-bottom: 0.5rem;"><?php echo rt_icon('network'); ?> Network Setup</h4>
                        <ul style="color: var(--muted); padding-left: 1.2rem;"><li>Home network design</li><li>Small business networks</li><li>Wired ethernet installation</li><li>Network security</li><li>Device configuration</li></ul>
                    </div>
                </div>

                <h3 style="margin-top: 3rem;">Common WiFi Problems We Solve Every Day</h3>
                <div style="margin: 1.5rem 0;"><h4 style="color: var(--text);">Slow Internet Speeds</h4><p>Are you paying for a fast NBN plan but getting frustratingly slow speeds? Causes include outdated routers, congested WiFi channels, poor router placement, or too many devices. We conduct comprehensive speed tests and implement solutions that often double or triple your actual speeds.</p></div>
                <div style="margin: 1.5rem 0;"><h4 style="color: var(--text);">WiFi Dead Zones</h4><p>Great WiFi in the living room but no signal in the bedroom? Dead zones are common in Australian homes with brick walls or metal frames. We map your property's WiFi coverage and design a solution — mesh system, access points, or router repositioning — for seamless coverage everywhere.</p></div>
                <div style="margin: 1.5rem 0;"><h4 style="color: var(--text);">Frequent Disconnections</h4><p>Internet dropping out during video calls or while streaming is incredibly frustrating. Causes range from router overheating to outdated firmware or interference. We diagnose the exact cause and implement lasting fixes.</p></div>
                <div style="margin: 1.5rem 0;"><h4 style="color: var(--text);">Too Many Devices, Not Enough Bandwidth</h4><p>With 15-20 connected devices in the average Australian home, older routers simply can't keep up. We configure QoS settings to intelligently manage traffic, giving priority to applications that need it most.</p></div>
                <div style="margin: 1.5rem 0;"><h4 style="color: var(--text);">Security Concerns</h4><p>Weak passwords or default router settings leave your network vulnerable. We audit your network security, implement strong encryption, set up secure guest networks, and configure parental controls for families.</p></div>

                <h3 style="margin-top: 3rem; color: var(--accent);">Our Network Optimization Process</h3>
                <div style="margin: 1.5rem 0;">
                    <?php foreach ([
                        ['Comprehensive Network Assessment', 'We survey your entire property with professional WiFi analysis tools, creating a heat map and testing actual speeds throughout your space.'],
                        ['Customized Solution Design', 'Based on our assessment, we design a tailored solution — whether optimising existing equipment, recommending upgrades, or designing a mesh network.'],
                        ['Professional Implementation', 'We install and configure your network with meticulous attention to detail: optimal placement, channel selection, security, QoS, and device prioritization.'],
                        ['Testing and Handover', 'We verify speeds everywhere, ensure all devices connect properly, and provide documentation of your network settings plus ongoing support.'],
                    ] as $i => $step) : ?>
                    <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem;">
                        <span style="background: var(--primary); color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: bold;"><?php echo $i + 1; ?></span>
                        <div><h4 style="margin: 0 0 0.5rem 0;"><?php echo $step[0]; ?></h4><p style="margin: 0;"><?php echo $step[1]; ?></p></div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <h3 style="margin-top: 3rem;">Why Choose <?php echo RT::e(RT::NAME); ?>?</h3>
                <ul style="color: var(--muted); line-height: 1.8;">
                    <li><strong style="color: var(--text);">Local Expert</strong> – We know Patterson Lakes homes and their specific challenges</li>
                    <li><strong style="color: var(--text);">Honest Advice</strong> – We won't upsell equipment you don't need</li>
                    <li><strong style="color: var(--text);">Professional Tools</strong> – Enterprise-grade WiFi analysis equipment, not consumer apps</li>
                    <li><strong style="color: var(--text);">Proven Results</strong> – We measure and document the improvements in your network</li>
                    <li><strong style="color: var(--text);">Brand Neutral</strong> – We recommend the best solution for you, not what gives us margin</li>
                    <li><strong style="color: var(--text);">Ongoing Support</strong> – We're here if you need us after the job is done</li>
                </ul>

                <h3 style="margin-top: 3rem;">Quick WiFi Tips While You Wait</h3>
                <div style="background: rgba(0,200,150,0.1); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(0,200,150,0.2); margin: 1rem 0;">
                    <h4 style="color: var(--accent); margin-bottom: 1rem;">💡 Immediate Improvements</h4>
                    <ul style="color: var(--muted); margin: 0; padding-left: 1.2rem;">
                        <li>Restart your router – unplug for 30 seconds, then reconnect</li>
                        <li>Move your router to a central location, elevated off the floor</li>
                        <li>Keep the router away from microwaves, baby monitors, and cordless phones</li>
                        <li>Use 5GHz band for speed when close to router, 2.4GHz for range</li>
                        <li>Update your router's firmware through the admin panel</li>
                        <li>Disconnect unused devices that might be using bandwidth</li>
                    </ul>
                </div>

                <h3 style="margin-top: 3rem;">Service Areas</h3>
                <p>We provide network and WiFi services throughout:</p>
                <ul style="color: var(--muted); columns: 2; column-gap: 2rem;">
                    <li>Patterson Lakes</li><li>Carrum</li><li>Seaford</li>
                    <li>Frankston</li><li>Chelsea Heights</li><li>Aspendale</li>
                    <li>Mordialloc</li><li>Mentone</li><li>Dandenong</li>
                    <li>Mornington Peninsula</li>
                </ul>

                <div style="background: var(--primary); padding: 2rem; border-radius: var(--radius); margin-top: 3rem; text-align: center;">
                    <h3 style="color: white; margin-bottom: 1rem;">Frustrated With Your WiFi?</h3>
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 1.5rem;">Get fast, reliable internet throughout your home. Professional assessment available.</p>
                    <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn" style="background: white; color: var(--primary);"><?php echo rt_icon('phone'); ?> <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                </div>
            </div>
        </section>

        <section class="section alt">
            <div class="container">
                <h2 style="text-align: center; margin-bottom: 2rem;">Related Services</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                    <a href="/service-computer-repairs/" style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07); text-decoration: none; transition: transform 0.3s ease;">
                        <h4 style="color: var(--accent);"><?php echo rt_icon('laptop'); ?> Computer Repairs</h4>
                        <p style="color: var(--muted);">Fast repairs for laptops, desktops, and Macs</p>
                    </a>
                    <a href="/service-data-recovery/" style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07); text-decoration: none; transition: transform 0.3s ease;">
                        <h4 style="color: var(--accent);"><?php echo rt_icon('hdd'); ?> Data Recovery</h4>
                        <p style="color: var(--muted);">Recover lost or deleted files from damaged drives</p>
                    </a>
                    <a href="/service-virus-removal/" style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: var(--radius); border: 1px solid rgba(255,255,255,0.07); text-decoration: none; transition: transform 0.3s ease;">
                        <h4 style="color: var(--accent);"><?php echo rt_icon('shield'); ?> Virus Removal</h4>
                        <p style="color: var(--muted);">Remove malware and protect your computer</p>
                    </a>
                </div>
            </div>
        </section>
    </main>

<?php rt_footer(); ?>
</body>
</html>
