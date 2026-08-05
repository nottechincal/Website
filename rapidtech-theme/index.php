<?php
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';
require_once __DIR__ . '/inc/forms.php';

// Booking form handler — shared validation/logging/email in inc/forms.php.
$bk_submitted = false; $bk_errors = [];
$bk = ['service'=>'','name'=>'','email'=>'','phone'=>'','date'=>'','time'=>'','address'=>'','desc'=>''];
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['bk_submit'])) {
    $result = rt_validate_booking($_POST);
    $bk = $result['clean'];
    $bk['desc'] = $bk['description']; // template below reads 'desc'
    $bk_errors = $result['errors'];

    if (!rt_verify_csrf($_POST['rt_csrf'] ?? null)) {
        $bk_errors['csrf'] = 'Your session expired — please try again.';
    }

    if (empty($bk_errors) && empty($_POST['website'])) {
        rt_log_booking($result['clean'], 'homepage');
        rt_send_booking_email($result['clean']);
        $bk_submitted = true;
    }
}

$home_schema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebSite',
            '@id'   => RT::url('/#website'),
            'url'  => RT::url('/'),
            'name' => RT::NAME,
            'inLanguage' => RT::LANG,
            'publisher' => ['@id' => RT::url('/#business')],
        ],
        [
            '@type' => 'Organization',
            '@id'   => RT::url('/#organization'),
            'name' => RT::NAME,
            'url'  => RT::url('/'),
            'logo' => ['@type' => 'ImageObject', 'url' => RT::url(RT::LOGO)],
            'contactPoint' => ['@type' => 'ContactPoint', 'telephone' => RT::PHONE_E164, 'contactType' => 'customer service', 'areaServed' => 'AU', 'availableLanguage' => 'English'],
            'sameAs' => RT::SOCIAL,
        ],
    ],
];

$home_local = RT::local_business([
    'description' => 'Same-day computer repairs across Melbourne\'s south-east. Free diagnosis, fixed quotes, no fix no fee.',
    'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => RT::RATING_VALUE, 'reviewCount' => (int) RT::RATING_COUNT, 'bestRating' => '5'],
    'areaServed' => ['Cranbourne','Cranbourne South','Berwick','Narre Warren','Dandenong','Frankston','Carrum Downs','Seaford','Patterson Lakes','Chelsea','Mordialloc'],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => 'Computer repair services',
        'itemListElement' => [
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Computer repairs', 'description' => 'Laptops, desktops, Macs and gaming PCs']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Virus & malware removal', 'description' => 'Full clean-up with ongoing protection']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Data recovery', 'description' => 'Hard drive, SSD and deleted file recovery']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Wi-Fi & networks', 'description' => 'Dead zone fixes, mesh installs, NBN diagnostics']],
        ],
    ],
]);

$home_faq = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
        ['@type' => 'Question', 'name' => 'How much does computer repair cost in Cranbourne?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Diagnosis and quotes are free. Software fixes typically $80–180. Hardware repairs like screens or batteries $120–350 depending on parts. Data recovery from $150. Fixed price before any work begins — no charge if we can\'t fix it.']],
        ['@type' => 'Question', 'name' => 'Do you offer same-day computer repairs?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes. 97% of our jobs are resolved the same day. We carry common parts so most repairs finish in one visit.']],
        ['@type' => 'Question', 'name' => 'What suburbs do you cover?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'We cover Cranbourne, Berwick, Narre Warren, Dandenong, Frankston, Carrum Downs, Seaford, Patterson Lakes, Chelsea, Mordialloc and surrounds. No call-out surcharge — based in Cranbourne South.']],
        ['@type' => 'Question', 'name' => 'Do you offer a warranty on repairs?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes — every repair comes with a 30-day warranty. If the same fault returns within that window we come back at no charge.']],
        ['@type' => 'Question', 'name' => 'My laptop won\'t turn on — what can I try first?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Check the power adapter is firmly connected and try a different wall outlet. Hold the power button for 15 seconds, then try again. If still dead, call for a free diagnosis.']],
        ['@type' => 'Question', 'name' => 'Can you recover deleted files?', 'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'In many cases yes. Stop using the device immediately — continued use overwrites deleted files. Free assessment with honest odds given before any work. Data recovery from $150.']],
    ],
];
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Computer Repairs & IT Support Melbourne | Same-Day',
    'description' => 'Same-day computer repairs, virus removal, data recovery and Wi-Fi fixes across Melbourne\'s south-east. We come to you. No fix, no fee. Call ' . RT::PHONE_DISPLAY . '.',
    'path'        => '/',
    'css'         => 'css/animations.css',
    'extra_head'  => '<link rel="preload" href="' . RT::asset('images/fallback.webp') . '" as="image" type="image/webp" fetchpriority="high">',
    'schema'      => array_merge($home_schema, [$home_local, $home_faq]),
]); ?>
</head>
<body>

<?php
rt_header(true, [
    'Common issues'  => '#issues',
    'Services'       => '#services',
    'Process'        => '#process',
    'Areas'          => '#areas',
    'Reviews'        => '#reviews',
    'FAQ'            => '#faq',
    'Book a repair'  => '#book',
]);
?>

<main id="main">

<!-- Hero -->
<section class="hero" aria-label="Rapid Tech Solutions hero">
  <video autoplay muted loop playsinline id="bg-video"
         poster="<?php echo RT::asset('images/fallback.webp'); ?>"
         data-src="<?php echo RT::asset('videos/bg1.mp4'); ?>"
         width="1920" height="1080">
  </video>
  <div class="hero-overlay"></div>
  <div class="wrap">
    <div class="hero-grid">
      <div class="hero-left">
        <span class="tag"><span class="dot-inline"></span><b><?php echo RT::e(RT::LOCALITY); ?></b> &middot; Melbourne's south-east</span>
        <h1>Your computer,<br><em>fixed properly.</em></h1>
        <p class="lead">Free diagnosis. A fixed price before anything starts. No charge if we can't fix it. Onsite across the south-east — usually same day.</p>

        <div class="glass-row">
          <div class="glass-card accent-red">
            <div class="gc-icon">🛡️</div>
            <div class="gc-title">No Fix, No Fee</div>
            <div class="gc-sub">You pay nothing if we can't resolve it</div>
          </div>
          <div class="glass-card accent-cyan">
            <div class="gc-icon">🔍</div>
            <div class="gc-title">Free Diagnostics</div>
            <div class="gc-sub">Full assessment &amp; quote at no cost</div>
          </div>
          <div class="glass-card accent-green">
            <div class="gc-icon">✅</div>
            <div class="gc-title">30-Day Warranty</div>
            <div class="gc-sub">Same fault comes back? We fix it free</div>
          </div>
        </div>

        <div class="triage">
          <a class="triage-card urgent" href="tel:<?php echo RT::PHONE_E164; ?>" data-track="triage-emergency">
            <div class="tr-ico urgent">🚨</div>
            <div><span class="tr-label">It's an emergency</span><span class="tr-sub">Call now — same-day help</span></div>
          </a>
          <a class="triage-card soon" href="#issues">
            <div class="tr-ico soon">📋</div>
            <div><span class="tr-label">I need help this week</span><span class="tr-sub">Find your issue, get a quote</span></div>
          </a>
          <a class="triage-card browse" href="#services">
            <div class="tr-ico browse">🔍</div>
            <div><span class="tr-label">Just looking around</span><span class="tr-sub">See what we do &amp; pricing</span></div>
          </a>
        </div>

        <div class="cta-row">
          <a class="btn b-solid" href="tel:<?php echo RT::PHONE_E164; ?>" data-track="hero-primary">📞 Call <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
          <a class="btn b-line" href="#issues">Find your issue ↓</a>
        </div>
      </div>

      <div class="hero-book">
        <h3>📅 Book a repair</h3>
        <p class="hb-sub">Free diagnosis, fixed price, same-day</p>
        <form method="POST" action="#book" id="hbForm" autocomplete="on">
          <input type="hidden" name="bk_submit" value="1">
          <?php rt_csrf_field(); ?>
          <div style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>

          <div class="hb-field"><label for="hb_name" class="sr-only">Your name</label><input type="text" name="bk_name" id="hb_name" placeholder="Your name" required autocomplete="name"></div>
          <div class="hb-field"><label for="hb_phone" class="sr-only">Phone number</label><input type="tel" name="bk_phone" id="hb_phone" placeholder="Phone number" required autocomplete="tel-national"></div>
          <div class="hb-field"><label for="hb_email" class="sr-only">Email address</label><input type="email" name="bk_email" id="hb_email" placeholder="Email address" required autocomplete="email"></div>
          <div class="hb-field"><label for="hb_address" class="sr-only">Your address / suburb</label><input type="text" name="bk_address" id="hb_address" placeholder="Your address / suburb" required autocomplete="street-address"></div>
          <div class="hb-field">
            <label for="hb_service" class="sr-only">What do you need?</label>
            <select name="bk_service" id="hb_service" required>
              <option value="">What do you need?</option>
              <option value="Computer repairs">Computer repairs</option>
              <option value="Virus & malware removal">Virus &amp; malware removal</option>
              <option value="Data recovery">Data recovery</option>
              <option value="Wi-Fi & networks">Wi-Fi &amp; networks</option>
              <option value="Other / not sure">Other / not sure</option>
            </select>
          </div>
          <div class="hb-field"><label for="hb_desc" class="sr-only">What's happening?</label><textarea name="bk_desc" id="hb_desc" placeholder="What's happening? (brief description)" required autocomplete="off"></textarea></div>
          <button type="submit" class="hb-submit">📅 Book my repair</button>
          <div class="hb-trust"><span>🛡️ No fix, no fee</span><span>🔍 Free diagnosis</span><span>✅ 30-day warranty</span></div>
        </form>
      </div>
    </div>

    <div class="pricing-wrap">
      <div class="pricing-grid">
        <div class="pcard"><h3>💻 Software &amp; setup</h3><p class="what">Slow machines, viruses, updates, new device setup</p><p class="range">$80 – $180</p><p class="note">Fixed quote before we start</p></div>
        <div class="pcard"><h3>🔧 Hardware repairs</h3><p class="what">Screens, drives, batteries, memory and SSD upgrades</p><p class="range">$120 – $350</p><p class="note">Quoted on parts + labour</p></div>
        <div class="pcard"><h3>💾 Data recovery</h3><p class="what">Priced on the condition of the drive</p><p class="range">From $150</p><p class="note">Free assessment first</p></div>
        <div class="pcard"><h3>📡 Wi-Fi &amp; networks</h3><p class="what">Depends on property size and layout</p><p class="range">$90 – $250</p><p class="note">Quoted onsite, no surprises</p></div>
      </div>
      <p class="pricefoot"><strong>Diagnosis is always free.</strong> You'll have a fixed price before any work starts. No fix, no fee — guaranteed.</p>
    </div>
  </div>
</section>

<!-- Stats -->
<div class="stats-bar"><div class="wrap">
  <div class="stat"><div class="stat-icon">💻</div><b>500+</b><span>Devices repaired</span></div>
  <div class="stat"><div class="stat-icon">⭐</div><b><?php echo RT::RATING_VALUE; ?></b><span>From <?php echo RT::RATING_COUNT; ?> Google reviews</span></div>
  <div class="stat"><div class="stat-icon">⚡</div><b>97%</b><span>Resolved same day</span></div>
  <div class="stat"><div class="stat-icon">📍</div><b>30+</b><span>Suburbs, no call-out fee</span></div>
</div></div>

<!-- Common issues -->
<section id="issues" class="issues"><div class="wrap">
  <div class="shead">
    <p class="kicker">Common issues</p>
    <h2>What's happening with your device?</h2>
    <p>Search or filter — each one links straight to help. These are the problems we see every day across Melbourne's south-east.</p>
  </div>

  <div class="issues-top">
    <div class="issues-search">
      <label for="issueSearch" class="sr-only">Search common issues</label>
      <input type="text" id="issueSearch" placeholder="e.g. laptop won't turn on, wifi dropping, virus..." autocomplete="off">
      <svg class="srch-icon" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
    </div>
    <span class="issue-count" id="issueCount">Showing 8 of 24 issues</span>
  </div>

  <div class="cat-filters" id="catFilters">
    <button class="cat-btn active" data-cat="all">All</button>
    <button class="cat-btn" data-cat="hardware">🔧 Hardware</button>
    <button class="cat-btn" data-cat="software">🖥 Software</button>
    <button class="cat-btn" data-cat="network">📡 Network</button>
    <button class="cat-btn" data-cat="data">💾 Data</button>
  </div>

  <div class="issue-grid" id="issueGrid">
    <?php /* Hardware — 6 cards */ ?>
    <div class="issue-card" data-cat="hardware" data-keywords="laptop won't turn on no power dead computer won't start black screen" data-featured="1"><div class="ic-top"><div class="ic-ico hw">🔋</div><div><h4>Laptop won't turn on</h4></div></div><p class="ic-desc">No lights, no fan, nothing. Could be power jack, battery, or motherboard. Free diagnosis.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Get it diagnosed <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="hardware" data-keywords="cracked screen broken display laptop screen repair shattered glass" data-featured="1"><div class="ic-top"><div class="ic-ico hw">💔</div><div><h4>Cracked or broken screen</h4></div></div><p class="ic-desc">Laptop or phone screen smashed? Most screens replaced same day. Quoted on parts first.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Get a quote <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="hardware" data-keywords="battery not charging draining fast laptop battery replacement won't hold charge"><div class="ic-top"><div class="ic-ico hw">🪫</div><div><h4>Battery draining fast</h4></div></div><p class="ic-desc">Won't hold charge or dies at 30%. We test battery health and replace — usually while you wait.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Book a check <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="hardware" data-keywords="overheating hot laptop fan loud noisy shutting down thermal"><div class="ic-top"><div class="ic-ico hw">🔥</div><div><h4>Overheating &amp; shutting down</h4></div></div><p class="ic-desc">Fan screaming, too hot to touch, random shutdowns. Usually dust, dried paste, or dead fan.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Cool it down <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="hardware" data-keywords="keyboard not working sticky keys liquid spill keyboard replacement"><div class="ic-top"><div class="ic-ico hw">⌨️</div><div><h4>Keyboard not working</h4></div></div><p class="ic-desc">Keys sticking, not registering, or liquid damage. We clean or replace keyboards for most models.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Fix the keys <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="hardware" data-keywords="hard drive clicking noise grinding beeping won't detect failing" data-featured="1"><div class="ic-top"><div class="ic-ico hw">💿</div><div><h4>Hard drive making noises</h4></div></div><p class="ic-desc">Clicking, grinding, or beeping = failing drive. Stop using it now. Free assessment.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Assess now <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <?php /* Software — 6 cards */ ?>
    <div class="issue-card" data-cat="software" data-keywords="computer running slow freezing lagging takes forever to start" data-featured="1"><div class="ic-top"><div class="ic-ico sw">🐌</div><div><h4>Computer running slow</h4></div></div><p class="ic-desc">Takes forever to start, apps freeze, spinning wheel. Usually fixable without new hardware.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Speed it up <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="software" data-keywords="virus malware spyware ransomware trojan infected pop up scam" data-featured="1"><div class="ic-top"><div class="ic-ico sw">🦠</div><div><h4>Virus or malware infection</h4></div></div><p class="ic-desc">Pop-ups, redirects, ransomware, or scam remote-access. Full clean-up + protection configured.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Remove it now <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="software" data-keywords="blue screen BSOD crashing freezing randomly windows error" data-featured="1"><div class="ic-top"><div class="ic-ico sw">🟦</div><div><h4>Blue screen / crashing</h4></div></div><p class="ic-desc">Random crashes, blue screen of death, or freezing. We trace the root cause — not just reformat.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Diagnose it <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="software" data-keywords="windows won't boot startup repair stuck on logo black screen loading"><div class="ic-top"><div class="ic-ico sw">🪟</div><div><h4>Windows won't boot</h4></div></div><p class="ic-desc">Stuck on logo, automatic repair loop, or black screen. We fix it without losing your files.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Get it booting <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="software" data-keywords="browser hijack pop ups redirects ads search engine changed chrome"><div class="ic-top"><div class="ic-ico sw">🚨</div><div><h4>Pop-ups &amp; browser hijacks</h4></div></div><p class="ic-desc">Search redirected, ads everywhere, fake "infected" warnings. Full browser cleanup + protection.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Clean it up <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="software" data-keywords="email hacked compromised scam password changed can't log in"><div class="ic-top"><div class="ic-ico sw">📧</div><div><h4>Email hacked</h4></div></div><p class="ic-desc">Account compromised, password changed, spam sent. We recover and secure it properly.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Recover account <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <?php /* Network — 6 cards */ ?>
    <div class="issue-card" data-cat="network" data-keywords="wifi keeps dropping disconnecting intermittent unstable wireless" data-featured="1"><div class="ic-top"><div class="ic-ico nw">📡</div><div><h4>WiFi keeps dropping out</h4></div></div><p class="ic-desc">Connection cuts in and out. Usually coverage or interference — not your internet plan.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Stabilise it <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="network" data-keywords="slow internet buffering speed test low nbn slow wifi speed" data-featured="1"><div class="ic-top"><div class="ic-ico nw">🐢</div><div><h4>Slow internet speed</h4></div></div><p class="ic-desc">Buffering, slow downloads. We find whether it's your WiFi, router, or the NBN connection.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Speed it up <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="network" data-keywords="can't connect to wifi won't connect network not showing up password"><div class="ic-top"><div class="ic-ico nw">🔌</div><div><h4>Can't connect to WiFi</h4></div></div><p class="ic-desc">Network not showing, password rejected, or "can't connect." Usually a quick driver or settings fix.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Get connected <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="network" data-keywords="nbn not working no internet nbn box lights red flashing outage"><div class="ic-top"><div class="ic-ico nw">📶</div><div><h4>NBN not working</h4></div></div><p class="ic-desc">NBN box flashing, no connection. We check if it's your equipment or an NBN fault — handle both.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Sort the NBN <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="network" data-keywords="wifi dead zones weak signal poor coverage doesn't reach back room"><div class="ic-top"><div class="ic-ico nw">🏠</div><div><h4>WiFi dead zones at home</h4></div></div><p class="ic-desc">Signal drops in certain rooms. We map the dead zones and install mesh WiFi that covers everywhere.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Cover every room <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="network" data-keywords="router setup new modem configure wifi network set up help"><div class="ic-top"><div class="ic-ico nw">🔀</div><div><h4>Router needs setting up</h4></div></div><p class="ic-desc">New router or modem, not sure how to configure. We set it up properly with security optimised.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Set it up <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <?php /* Data — 6 cards */ ?>
    <div class="issue-card" data-cat="data" data-keywords="deleted files accidentally deleted recovery restore recycle bin emptied" data-featured="1"><div class="ic-top"><div class="ic-ico dt">📄</div><div><h4>Accidentally deleted files</h4></div></div><p class="ic-desc">Emptied recycle bin or Shift+Deleted. Stop using the PC now — we can often get them back.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Recover files <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="data" data-keywords="external hard drive not detected not showing up USB plugged in no response"><div class="ic-top"><div class="ic-ico dt">💽</div><div><h4>External drive not detected</h4></div></div><p class="ic-desc">Plugged in but nothing shows. Could be enclosure, cable, or drive itself. Free assessment.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Get data back <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="data" data-keywords="USB not reading SD card not detected flash drive won't open corrupted"><div class="ic-top"><div class="ic-ico dt">💳</div><div><h4>USB / SD card won't read</h4></div></div><p class="ic-desc">Memory card or flash drive not recognised, asking to format. Don't format — we can recover it.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Recover it <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="data" data-keywords="backup set up need backup automatic backup cloud backup files safe"><div class="ic-top"><div class="ic-ico dt">☁️</div><div><h4>Need backup set up</h4></div></div><p class="ic-desc">No backups and worried about losing everything. Automatic local + cloud backup configured.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Set up backup <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="data" data-keywords="SSD not detected not showing in BIOS m.2 NVMe drive missing"><div class="ic-top"><div class="ic-ico dt">🧊</div><div><h4>SSD not showing up</h4></div></div><p class="ic-desc">New or existing SSD not detected in BIOS or Windows. Could be seating, driver, or firmware.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Fix it <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>
    <div class="issue-card" data-cat="data" data-keywords="phone photos recovery lost photos iphone android photos deleted pictures"><div class="ic-top"><div class="ic-ico dt">📱</div><div><h4>Phone photos lost</h4></div></div><p class="ic-desc">Photos deleted or phone won't turn on. Recovery from iPhones and Android devices.</p><a class="ic-cta" href="tel:<?php echo RT::PHONE_E164; ?>">Save your photos <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg></a></div>

    <div class="no-results" id="noResults"><b>No matching issues found</b>Call us anyway — we'll diagnose it free.<br><a href="tel:<?php echo RT::PHONE_E164; ?>" style="color:var(--primary);font-weight:600"><?php echo RT::e(RT::PHONE_DISPLAY); ?></a></div>
  </div>

  <div class="issues-expand">
    <button class="expand-btn" id="expandBtn">View all 24 common issues <svg viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg></button>
  </div>
</div>

<div class="pop-combos"><div class="wrap">
  <h3>Popular searches in your area</h3>
  <div class="combo-chips">
    <a href="/computer-repairs-cranbourne/"><strong>Computer repairs</strong> Cranbourne</a>
    <a href="/virus-removal-dandenong/"><strong>Virus removal</strong> Dandenong</a>
    <a href="/computer-repairs-berwick/"><strong>Laptop screen repair</strong> Berwick</a>
    <a href="/data-recovery-frankston/"><strong>Data recovery</strong> Frankston</a>
    <a href="/network-setup-berwick/"><strong>WiFi setup</strong> Narre Warren</a>
    <a href="/computer-repairs-carrum-downs/"><strong>Computer repairs</strong> Carrum Downs</a>
    <a href="/virus-removal-cranbourne/"><strong>Malware removal</strong> Seaford</a>
    <a href="/computer-repairs-patterson-lakes/"><strong>PC slow fix</strong> Patterson Lakes</a>
    <a href="/computer-repairs-chelsea/"><strong>Network setup</strong> Chelsea</a>
    <a href="/computer-repairs-mordialloc/"><strong>Laptop repair</strong> Mordialloc</a>
    <a href="/virus-removal-cranbourne/"><strong>Virus removal</strong> Cranbourne</a>
    <a href="/computer-repairs-hampton-park/"><strong>Screen replacement</strong> Hampton Park</a>
  </div>
</div></div></section>

<!-- Services -->
<section id="services" class="section alt"><div class="wrap">
  <div class="shead"><p class="kicker">What we do</p><h2>Four things make up most of our work</h2><p>If yours isn't listed here, call anyway — we'll tell you straight whether it's worth repairing.</p></div>
  <div class="svcs">
    <div class="svc"><div class="ico"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="12" rx="2"/><path d="M2 20h20"/></svg></div><h3>Computer repairs</h3><p>Laptops, desktops, Macs and gaming PCs. We carry common parts so most jobs finish in one visit.</p><ul><li>Won't start or crashing</li><li>Cracked screens</li><li>SSD &amp; memory upgrades</li><li>Windows &amp; macOS reinstalls</li></ul></div>
    <div class="svc"><div class="ico"><svg viewBox="0 0 24 24"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1Z"/></svg></div><h3>Virus &amp; malware removal</h3><p>Full clean-up, then protection configured properly so it doesn't return in a fortnight.</p><ul><li>Ransomware &amp; spyware</li><li>Browser hijacks</li><li>Scam recovery</li><li>Ongoing protection</li></ul></div>
    <div class="svc"><div class="ico"><svg viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.66 3.58 3 8 3s8-1.34 8-3V5"/><path d="M4 12c0 1.66 3.58 3 8 3s8-1.34 8-3"/></svg></div><h3>Data recovery</h3><p>Failed drives, dead SSDs, deleted files. Free assessment first — we'll give you the honest odds.</p><ul><li>Hard drive &amp; SSD recovery</li><li>Deleted files</li><li>Corrupted storage</li><li>Backup setup</li></ul></div>
    <div class="svc"><div class="ico"><svg viewBox="0 0 24 24"><rect x="9" y="2" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="16" y="16" width="6" height="6" rx="1"/><path d="M12 8v4M5 16v-2h14v2"/></svg></div><h3>Wi-Fi &amp; networks</h3><p>Our most common callout. Nine times out of ten it's coverage, not your internet plan.</p><ul><li>Dead zones &amp; dropouts</li><li>Mesh Wi-Fi installs</li><li>NBN faults</li><li>Small business networks</li></ul></div>
  </div>
</div></section>

<!-- Process -->
<section id="process" class="section"><div class="wrap">
  <div class="shead"><p class="kicker">How it works</p><h2>You'll know the price before we touch anything</h2></div>
  <div class="process">
    <div class="pstep"><div class="ps-num">1</div><h3>You call</h3><p>Describe the problem. We'll often diagnose it on the phone — and tell you if it's something you can fix yourself.</p></div>
    <div class="pstep"><div class="ps-num">2</div><h3>We quote</h3><p>A fixed price before work starts. If repairing isn't economical, we say so rather than quote for it.</p></div>
    <div class="pstep"><div class="ps-num">3</div><h3>We fix it</h3><p>At your place, or on the bench if it needs longer. Most jobs are done the same day.</p></div>
    <div class="pstep"><div class="ps-num">4</div><h3>You're covered</h3><p>30-day warranty. If the same fault returns inside that window, we come back at no charge.</p></div>
  </div>
</div></section>

<!-- Coverage -->
<section id="areas" class="areas section"><div class="wrap">
  <div class="shead"><p class="kicker">Coverage</p><h2>Where we go</h2><p>Based in <?php echo RT::e(RT::LOCALITY); ?>. No call-out surcharge anywhere on this list.</p></div>
  <div class="chips">
    <a href="/computer-repairs-cranbourne/">Cranbourne</a><span><?php echo RT::e(RT::LOCALITY); ?></span><a href="/computer-repairs-berwick/">Berwick</a><a href="/computer-repairs-narre-warren/">Narre Warren</a>
    <a href="/computer-repairs-dandenong/">Dandenong</a><a href="/computer-repairs-frankston/">Frankston</a><a href="/computer-repairs-carrum-downs/">Carrum Downs</a><a href="/computer-repairs-seaford/">Seaford</a>
    <a href="/computer-repairs-patterson-lakes/">Patterson Lakes</a><a href="/computer-repairs-chelsea/">Chelsea</a><a href="/computer-repairs-mordialloc/">Mordialloc</a><a href="/computer-repairs-skye/">Skye</a>
    <a href="/computer-repairs-langwarrin/">Langwarrin</a><a href="/computer-repairs-clyde/">Clyde</a><a href="/computer-repairs-lynbrook/">Lynbrook</a><a href="/computer-repairs-hampton-park/">Hampton Park</a>
  </div>
</div></section>

<!-- Brands -->
<section class="brands-strip"><div class="wrap">
  <div class="shead"><p class="kicker">Brands we work with</p><h2>We fix them all</h2></div>
  <div class="brands-grid">
    <div class="brand-badge">🪟 Dell</div>
    <div class="brand-badge">💻 HP</div>
    <div class="brand-badge">🖥️ Lenovo</div>
    <div class="brand-badge">🍎 Apple</div>
    <div class="brand-badge">🎮 Asus</div>
    <div class="brand-badge">🔧 Acer</div>
    <div class="brand-badge">📋 Microsoft</div>
    <div class="brand-badge">📱 Samsung</div>
  </div>
</div></section>

<!-- Reviews -->
<section id="reviews" class="reviews-strip"><div class="wrap">
  <div class="shead"><p class="kicker">Reviews</p><h2>Rated <?php echo RT::RATING_VALUE; ?> from <?php echo RT::RATING_COUNT; ?> Google reviews</h2></div>
  <div class="reviews-scroll" id="reviewsScroll">
    <div class="r-card"><div class="r-stars">★★★★★</div><p class="r-text">"Fantastic service. My laptop was running incredibly slow and they fixed it same day. Honest, reliable, explained what they were doing the whole time."</p><cite class="r-name">Sarah M.</cite><p class="r-info">Patterson Lakes · 3 weeks ago</p><span class="r-tag fast">Same-day fix</span></div>
    <div class="r-card"><div class="r-stars">★★★★★</div><p class="r-text">"Saved my business. We had a ransomware attack and they had us back running within hours. Professional, knowledgeable and genuinely cared."</p><cite class="r-name">David R.</cite><p class="r-info">Seaford · business owner · 1 month ago</p><span class="r-tag value">Saved business</span></div>
    <div class="r-card"><div class="r-stars">★★★★★</div><p class="r-text">"Finally someone who explains things without the jargon. Sorted our whole home network — WiFi works perfectly in every room now."</p><cite class="r-name">The Thompson Family</cite><p class="r-info">Frankston · 2 months ago</p><span class="r-tag kind">Explained clearly</span></div>
    <div class="r-card"><div class="r-stars">★★★★★</div><p class="r-text">"Thought my hard drive was dead and I'd lost everything. He recovered all my photos and documents. Can't recommend enough."</p><cite class="r-name">Michael T.</cite><p class="r-info">Berwick · 3 weeks ago</p><span class="r-tag value">Data saved</span></div>
    <div class="r-card"><div class="r-stars">★★★★★</div><p class="r-text">"Came out same day, had the screen replaced on my daughter's laptop within an hour. Fair price, great work, lovely bloke."</p><cite class="r-name">Lisa K.</cite><p class="r-info">Cranbourne · 1 month ago</p><span class="r-tag fast">Same-day fix</span></div>
    <div class="r-card"><div class="r-stars">★★★★★</div><p class="r-text">"Fixed my gaming PC that I'd built myself and couldn't get to POST. Knew exactly what the issue was. Running better than ever."</p><cite class="r-name">Jake P.</cite><p class="r-info">Narre Warren · 2 months ago</p><span class="r-tag kind">Gaming PC</span></div>
    <div class="r-card"><div class="r-stars">★★★★★</div><p class="r-text">"Called about constant WiFi dropouts. He came out, diagnosed interference from a neighbour's repeater, fixed the channel settings. No problems since."</p><cite class="r-name">Amanda W.</cite><p class="r-info">Chelsea · 1 month ago</p><span class="r-tag fast">WiFi sorted</span></div>
    <div class="r-card"><div class="r-stars">★★★★★</div><p class="r-text">"Honest, upfront pricing. Told me my old laptop wasn't worth fixing and helped me set up the new one instead. Didn't charge for the advice."</p><cite class="r-name">Robert C.</cite><p class="r-info">Dandenong · 3 months ago</p><span class="r-tag kind">Honest advice</span></div>
  </div>
  <div class="r-controls">
    <button class="r-ctrl" id="rPrev" aria-label="Previous reviews">←</button>
    <button class="r-ctrl" id="rNext" aria-label="Next reviews">→</button>
  </div>
</div></section>

<!-- FAQ -->
<section id="faq" class="section alt"><div class="wrap">
  <div class="shead"><p class="kicker">FAQ</p><h2>Questions we answer every day</h2></div>
  <div class="faq-list">
    <div class="faq-item"><button class="faq-q" aria-expanded="false" aria-controls="faq-a-1">How much does computer repair cost in Cranbourne?</button><div class="faq-a" id="faq-a-1"><p>Diagnosis and quotes are <strong>free — always</strong>. Software fixes typically range <strong>$80–180</strong>. Hardware repairs like screens or batteries typically <strong>$120–350</strong> depending on parts. Data recovery starts from <strong>$150</strong>. You'll always get a fixed price before any work begins, and there's no charge if we can't fix it.</p></div></div>
    <div class="faq-item"><button class="faq-q" aria-expanded="false" aria-controls="faq-a-2">Do you offer same-day computer repairs?</button><div class="faq-a" id="faq-a-2"><p>Yes — 97% of our jobs are resolved the same day. We carry common parts (screens, batteries, SSDs, power supplies) so most repairs finish in one visit.</p></div></div>
    <div class="faq-item"><button class="faq-q" aria-expanded="false" aria-controls="faq-a-3">What suburbs do you cover?</button><div class="faq-a" id="faq-a-3"><p>We're based in <?php echo RT::e(RT::LOCALITY); ?> and cover all of Melbourne's south-east: Cranbourne, Berwick, Narre Warren, Dandenong, Frankston, Carrum Downs, Seaford, Patterson Lakes, Chelsea, Mordialloc and surrounding areas. No call-out surcharge anywhere on our list.</p></div></div>
    <div class="faq-item"><button class="faq-q" aria-expanded="false" aria-controls="faq-a-4">Do you offer a warranty on repairs?</button><div class="faq-a" id="faq-a-4"><p>Yes — every repair comes with a 30-day warranty. If the same fault returns within that window, we come back and fix it at no charge.</p></div></div>
    <div class="faq-item"><button class="faq-q" aria-expanded="false" aria-controls="faq-a-5">Can you fix my computer at my house?</button><div class="faq-a" id="faq-a-5"><p>Yes — we're a mobile service. We come to your home or office anywhere in our coverage area. Most issues are fixed onsite. If it needs more involved work, we'll take it to the bench and return it to you.</p></div></div>
    <div class="faq-item"><button class="faq-q" aria-expanded="false" aria-controls="faq-a-6">What if you can't fix the problem?</button><div class="faq-a" id="faq-a-6"><p>You pay nothing. Our "no fix, no fee" guarantee means if we can't resolve the issue, there's no charge — not even for the diagnosis. We'll also tell you honestly if a repair isn't economical.</p></div></div>
  </div>
</div></section>

<!-- Book a repair -->
<section id="book" class="section alt"><div class="wrap">
  <div class="shead"><p class="kicker">Book a repair</p><h2>Ready to get it fixed?</h2><p>Fill this in and we'll confirm your booking within 1 business hour — usually faster.</p></div>

  <?php if ($bk_submitted): ?>
  <div style="max-width:600px;margin:0 auto;background:var(--surface);border:1px solid var(--line);border-radius:var(--r3);padding:2.5rem 2rem;text-align:center">
    <div style="font-size:2.5rem;margin-bottom:.8rem">✅</div>
    <h2 style="margin-bottom:.5rem">Booking received!</h2>
    <p style="color:var(--muted);margin-bottom:1.2rem">We'll confirm your time within 1 business hour. For urgent help, call now.</p>
    <a class="btn b-solid" href="tel:<?php echo RT::PHONE_E164; ?>">📞 Call <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
  </div>
  <?php else: ?>
  <form method="POST" action="" novalidate id="bkForm" autocomplete="on" style="max-width:640px;margin:0 auto;background:var(--surface);border:1px solid var(--line);border-radius:var(--r3);padding:2rem">
    <div style="position:absolute;left:-9999px;opacity:0;height:0;overflow:hidden"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
    <input type="hidden" name="bk_submit" value="1">
    <?php rt_csrf_field(); ?>

    <div class="field-row" style="display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-bottom:1.2rem">
      <div style="display:flex;flex-direction:column">
        <label for="bk_service" style="font-size:.85rem;font-weight:600;margin-bottom:.35rem">Service needed <span style="color:var(--primary)">*</span></label>
        <select name="bk_service" id="bk_service" required style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none">
          <option value="">Choose…</option>
          <option value="Computer repairs" <?php if($bk['service']==='Computer repairs')echo'selected';?>>Computer repairs</option>
          <option value="Virus & malware removal" <?php if($bk['service']==='Virus & malware removal')echo'selected';?>>Virus &amp; malware removal</option>
          <option value="Data recovery" <?php if($bk['service']==='Data recovery')echo'selected';?>>Data recovery</option>
          <option value="Wi-Fi & networks" <?php if($bk['service']==='Wi-Fi & networks')echo'selected';?>>Wi-Fi &amp; networks</option>
          <option value="Other / not sure" <?php if($bk['service']==='Other / not sure')echo'selected';?>>Other / not sure</option>
        </select>
      </div>
      <div style="display:flex;flex-direction:column">
        <label for="bk_phone" style="font-size:.85rem;font-weight:600;margin-bottom:.35rem">Phone <span style="color:var(--primary)">*</span></label>
        <input type="tel" name="bk_phone" id="bk_phone" value="<?php echo htmlspecialchars($bk['phone']); ?>" placeholder="04XX XXX XXX" required autocomplete="tel-national" style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none">
      </div>
    </div>

    <div class="field-row" style="display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-bottom:1.2rem">
      <div style="display:flex;flex-direction:column">
        <label for="bk_name" style="font-size:.85rem;font-weight:600;margin-bottom:.35rem">Your name <span style="color:var(--primary)">*</span></label>
        <input type="text" name="bk_name" id="bk_name" value="<?php echo htmlspecialchars($bk['name']); ?>" placeholder="John Smith" required autocomplete="name" style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none">
      </div>
      <div style="display:flex;flex-direction:column">
        <label for="bk_email" style="font-size:.85rem;font-weight:600;margin-bottom:.35rem">Email <span style="color:var(--primary)">*</span></label>
        <input type="email" name="bk_email" id="bk_email" value="<?php echo htmlspecialchars($bk['email']); ?>" placeholder="you@example.com" required autocomplete="email" style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none">
      </div>
    </div>

    <div class="field-row" style="display:grid;grid-template-columns:1fr 1fr;gap:.8rem;margin-bottom:1.2rem">
      <div style="display:flex;flex-direction:column">
        <label for="bk_date" style="font-size:.85rem;font-weight:600;margin-bottom:.35rem">Preferred date</label>
        <input type="date" name="bk_date" id="bk_date" value="<?php echo htmlspecialchars($bk['date']); ?>" min="<?php echo date('Y-m-d'); ?>" autocomplete="off" style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none">
      </div>
      <div style="display:flex;flex-direction:column">
        <label for="bk_time" style="font-size:.85rem;font-weight:600;margin-bottom:.35rem">Preferred time</label>
        <select name="bk_time" id="bk_time" autocomplete="off" style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none">
          <option value="">Any time</option>
          <option value="Morning (9am–12pm)" <?php if($bk['time']==='Morning (9am–12pm)')echo'selected';?>>Morning (9am–12pm)</option>
          <option value="Afternoon (12pm–3pm)" <?php if($bk['time']==='Afternoon (12pm–3pm)')echo'selected';?>>Afternoon (12pm–3pm)</option>
          <option value="Late afternoon (3pm–5pm)" <?php if($bk['time']==='Late afternoon (3pm–5pm)')echo'selected';?>>Late afternoon (3pm–5pm)</option>
          <option value="ASAP / emergency" <?php if($bk['time']==='ASAP / emergency')echo'selected';?>>ASAP / emergency</option>
        </select>
      </div>
    </div>

    <div style="display:flex;flex-direction:column;margin-bottom:1.2rem">
      <label for="bk_address" style="font-size:.85rem;font-weight:600;margin-bottom:.35rem">Your address <span style="color:var(--primary)">*</span></label>
      <input type="text" name="bk_address" id="bk_address" value="<?php echo htmlspecialchars($bk['address']); ?>" placeholder="Street, suburb — we come to you" required autocomplete="street-address" style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none">
    </div>

    <div style="display:flex;flex-direction:column;margin-bottom:1.5rem">
      <label for="bk_desc" style="font-size:.85rem;font-weight:600;margin-bottom:.35rem">What's happening? <span style="color:var(--primary)">*</span></label>
      <textarea name="bk_desc" id="bk_desc" placeholder="e.g. Laptop won't turn on, no lights, was working fine yesterday. It's a Dell Inspiron 15." required autocomplete="off" style="width:100%;background:var(--bg);border:1px solid var(--line-2);border-radius:var(--r);padding:.7rem .85rem;font-size:.95rem;color:var(--text);font-family:inherit;outline:none;resize:vertical;min-height:90px"><?php echo htmlspecialchars($bk['desc']); ?></textarea>
    </div>

    <?php if (!empty($bk_errors)): ?>
    <div style="background:var(--red-dim);border:1px solid rgba(255,92,92,.2);border-radius:var(--r);padding:.7rem 1rem;margin-bottom:1.2rem;color:var(--primary);font-size:.88rem">Please fix the errors below and try again.</div>
    <?php endif; ?>

    <button type="submit" id="bkSubmit" style="width:100%;padding:.85rem;background:var(--primary);color:#fff;border:none;border-radius:var(--r);font-size:1rem;font-weight:600;cursor:pointer;font-family:inherit;box-shadow:0 4px 20px rgba(255,92,92,.25);transition:.18s">📅 Book my repair</button>
  </form>

  <script>
  (function(){
    var hbForm = document.getElementById('hbForm');
    if (hbForm) {
      hbForm.addEventListener('submit', function(e) {
        var valid = true;
        function hbErr(sel) {
          var el = hbForm.querySelector(sel);
          if (el) { el.style.borderColor = 'var(--primary)'; el.style.boxShadow = '0 0 0 3px var(--red-dim)'; }
          if (valid) { valid = false; if (el) el.focus(); }
        }
        hbForm.querySelectorAll('input,select,textarea').forEach(function(el) {
          el.style.borderColor = ''; el.style.boxShadow = '';
        });
        var nm = (hbForm.querySelector('[name=bk_name]')||{}).value;
        var ph = (hbForm.querySelector('[name=bk_phone]')||{}).value;
        var em = (hbForm.querySelector('[name=bk_email]')||{}).value;
        var ad = (hbForm.querySelector('[name=bk_address]')||{}).value;
        var sv = (hbForm.querySelector('[name=bk_service]')||{}).value;
        var ds = (hbForm.querySelector('[name=bk_desc]')||{}).value;
        if (!nm || nm.trim().length < 2) hbErr('[name=bk_name]');
        if (!ph || ph.trim().length < 8) hbErr('[name=bk_phone]');
        if (!em || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em)) hbErr('[name=bk_email]');
        if (!ad || ad.trim().length < 5) hbErr('[name=bk_address]');
        if (!sv) hbErr('[name=bk_service]');
        if (!ds || ds.trim().length < 10) hbErr('[name=bk_desc]');
        if (!valid) {
          e.preventDefault();
          var btn = hbForm.querySelector('.hb-submit');
          if (btn) { btn.style.animation = 'none'; btn.offsetHeight; btn.style.animation = 'shake .4s ease'; }
        } else {
          var btn = hbForm.querySelector('.hb-submit');
          if (btn) { btn.disabled = true; btn.textContent = 'Submitting…'; btn.style.opacity = '.6'; }
        }
      });
    }

    var form = document.getElementById('bkForm');
    if(!form) return;
    form.addEventListener('submit', function(e){
      var v = true, first = null;
      function err(id){
        var el = document.getElementById(id);
        if(el){ el.style.borderColor = 'var(--primary)'; el.style.boxShadow = '0 0 0 3px var(--red-dim)'; }
        if(v){ first = first || id; v = false; }
      }
      function ok(id){
        var el = document.getElementById(id);
        if(el){ el.style.borderColor = ''; el.style.boxShadow = ''; }
      }
      ['bk_service','bk_name','bk_phone','bk_email','bk_address','bk_desc'].forEach(ok);
      var svc = document.getElementById('bk_service').value;
      var nm = document.getElementById('bk_name').value.trim();
      var ph = document.getElementById('bk_phone').value.trim();
      var em = document.getElementById('bk_email').value.trim();
      var ad = document.getElementById('bk_address').value.trim();
      var ds = document.getElementById('bk_desc').value.trim();
      if(!svc) err('bk_service');
      if(nm.length < 2) err('bk_name');
      if(ph.length < 8) err('bk_phone');
      if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em)) err('bk_email');
      if(ad.length < 5) err('bk_address');
      if(ds.length < 10) err('bk_desc');
      if(!v){
        e.preventDefault();
        if(first){ var el = document.getElementById(first); if(el) el.focus(); }
        var b = document.getElementById('bkSubmit');
        if(b){ b.style.animation = 'none'; b.offsetHeight; b.style.animation = 'shake .4s ease'; }
      } else {
        var b = document.getElementById('bkSubmit');
        if(b){ b.disabled = true; b.textContent = 'Submitting…'; b.style.opacity = '.6'; }
      }
    });
    var s = document.createElement('style');
    s.textContent = '@keyframes shake{0%,100%{transform:translateX(0)}25%{transform:translateX(-6px)}50%{transform:translateX(6px)}75%{transform:translateX(-4px)}}';
    document.head.appendChild(s);
  })();
  </script>
  <?php endif; ?>
</div></section>

<!-- CTA Banner -->
<section class="cta-banner"><div class="wrap">
  <h2>Prefer to talk?</h2>
  <p>Call now — we'll tell you what's wrong, what it costs to fix, and whether it's even worth doing.</p>
  <div class="btn-row">
    <a class="btn b-solid" href="tel:<?php echo RT::PHONE_E164; ?>" data-track="cta-banner">📞 Call <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
    <a class="btn b-line" href="<?php echo RT::WHATSAPP; ?>" target="_blank" rel="noopener">Chat on WhatsApp</a>
  </div>
</div></section>

</main>

<script>
(function(){
  /* Call tracking */
  document.addEventListener('click', function(e){
    var tel = e.target.closest('a[data-track]');
    if(tel && typeof gtag !== 'undefined'){
      gtag('event', 'call_click', { event_category: 'call', event_label: tel.dataset.track });
    }
  });

  /* Common issues: featured default + expand + search + filter */
  var catBtns = document.querySelectorAll('#catFilters .cat-btn');
  var searchInput = document.getElementById('issueSearch');
  var cards = document.querySelectorAll('#issueGrid .issue-card');
  var noResults = document.getElementById('noResults');
  var countEl = document.getElementById('issueCount');
  var expandBtn = document.getElementById('expandBtn');
  var activeCat = 'all';
  var expanded = false;

  function cardIsFeatured(card){ return card.dataset.featured === '1'; }

  function update(){
    var query = (searchInput ? searchInput.value : '').toLowerCase().trim();
    var visible = 0, total = 0;
    cards.forEach(function(card){
      var cat = card.dataset.cat;
      var kw = (card.dataset.keywords || '').toLowerCase();
      var text = (card.textContent || '').toLowerCase();
      var catMatch = activeCat === 'all' || cat === activeCat;
      var searchMatch = !query || kw.indexOf(query) !== -1 || text.indexOf(query) !== -1;
      var contentMatch = catMatch && searchMatch;
      var show = contentMatch && (expanded || cardIsFeatured(card));
      if(show){ card.classList.remove('hidden'); visible++; }
      else { card.classList.add('hidden'); }
      if(contentMatch) total++;
    });
    var totalAll = expanded ? 24 : total;
    if(countEl) countEl.textContent = visible === 0 ? 'No issues match' : ('Showing ' + visible + ' of ' + totalAll + ' issue' + (totalAll !== 1 ? 's' : ''));
    if(noResults) noResults.classList.toggle('show', visible === 0);
  }

  update();

  if(expandBtn){
    expandBtn.addEventListener('click', function(){
      expanded = !expanded;
      this.classList.toggle('expanded', expanded);
      this.innerHTML = expanded
        ? 'Show fewer <svg viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg>'
        : 'View all 24 common issues <svg viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg>';
      update();
    });
  }

  if(catBtns.length){
    catBtns.forEach(function(btn){
      btn.addEventListener('click', function(){
        catBtns.forEach(function(b){ b.classList.remove('active'); });
        this.classList.add('active');
        activeCat = this.dataset.cat;
        update();
      });
    });
  }

  var debounce;
  if(searchInput){
    searchInput.addEventListener('input', function(){
      clearTimeout(debounce);
      debounce = setTimeout(update, 150);
    });
  }

  /* FAQ accordion */
  document.querySelectorAll('.faq-q').forEach(function(btn){
    btn.addEventListener('click', function(){
      var wasOpen = this.classList.contains('open');
      document.querySelectorAll('.faq-q.open').forEach(function(b){
        b.classList.remove('open');
        b.setAttribute('aria-expanded', 'false');
        b.nextElementSibling.classList.remove('open');
      });
      if(!wasOpen){
        this.classList.add('open');
        this.setAttribute('aria-expanded', 'true');
        this.nextElementSibling.classList.add('open');
      }
    });
  });

  /* Reviews horizontal scroll */
  var scroll = document.getElementById('reviewsScroll');
  var prevBtn = document.getElementById('rPrev');
  var nextBtn = document.getElementById('rNext');
  if(scroll && prevBtn && nextBtn){
    prevBtn.addEventListener('click', function(){ scroll.scrollBy({left:-340, behavior:'smooth'}); });
    nextBtn.addEventListener('click', function(){ scroll.scrollBy({left:340, behavior:'smooth'}); });
    var auto;
    var wantsReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    function startAuto(){
      if (wantsReducedMotion) return;
      auto = setInterval(function(){ scroll.scrollBy({left:340, behavior:'smooth'}); }, 5000);
    }
    function stopAuto(){ clearInterval(auto); }
    startAuto();
    scroll.addEventListener('pointerenter', stopAuto);
    scroll.addEventListener('pointerleave', startAuto);
    scroll.addEventListener('scroll', function(){
      if(scroll.scrollLeft + scroll.clientWidth >= scroll.scrollWidth - 10){
        setTimeout(function(){ scroll.scrollTo({left:0, behavior:'smooth'}); }, 2000);
      }
    });
  }
})();
</script>

<?php rt_footer(); ?>
</body>
</html>
