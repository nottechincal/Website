<?php
/*
Template Name: Orderline
Description: Promotional landing page for Orderline — procurement & invoicing for hospitality.
*/
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';

$orderline_inline_css = <<<'CSS'
.ol-hero {
    position: relative;
    padding: 5rem 0 4rem;
    background:
        radial-gradient(120% 140% at 85% 0%, rgba(72, 199, 142, 0.18) 0%, transparent 55%),
        radial-gradient(100% 120% at 0% 100%, rgba(72, 199, 142, 0.10) 0%, transparent 55%),
        var(--bg);
    border-bottom: 1px solid rgba(143, 155, 179, 0.15);
    text-align: center;
}
.ol-hero .ol-badge {
    display: inline-block;
    background: rgba(72, 199, 142, 0.12);
    color: #48c78e;
    padding: .35rem 1rem;
    border-radius: 100px;
    font-size: .82rem;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    margin-bottom: 1.25rem;
}
.ol-hero h1 {
    font-size: clamp(2.2rem, 4.5vw, 3.4rem);
    line-height: 1.12;
    color: var(--text);
    max-width: 18ch;
    margin: 0 auto 1.1rem;
}
.ol-hero .lead {
    color: var(--muted);
    font-size: 1.15rem;
    max-width: 58ch;
    margin: 0 auto 2rem;
    line-height: 1.6;
}
.ol-hero .ol-cta-row {
    display: flex; flex-wrap: wrap; gap: .85rem; justify-content: center;
}
.ol-hero .btn-primary {
    background: #48c78e; color: #051018; padding: .85rem 2rem; border-radius: 100px;
    font-weight: 600; font-size: 1rem; transition: .2s;
}
.ol-hero .btn-primary:hover { background: #3bb57a; transform: translateY(-2px); box-shadow: 0 8px 30px rgba(72,199,142,.3); }
.ol-hero .btn-outline {
    border: 1px solid rgba(143,155,179,.35); color: var(--text); padding: .85rem 2rem;
    border-radius: 100px; font-weight: 500; transition: .2s;
}
.ol-hero .btn-outline:hover { border-color: #48c78e; color: #48c78e; }

.ol-section { padding: 4rem 0; }
.ol-section h2 {
    font-size: clamp(1.6rem, 2.8vw, 2.2rem); color: var(--text);
    text-align: center; margin-bottom: .75rem;
}
.ol-section .section-lead { text-align: center; color: var(--muted); max-width: 52ch; margin: 0 auto 2.5rem; font-size: 1.05rem; }

.ol-features { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem; }
.ol-card {
    background: var(--surface); border: 1px solid rgba(143,155,179,.15);
    border-radius: var(--radius); padding: 1.75rem; transition: .2s;
}
.ol-card:hover { border-color: rgba(72,199,142,.4); transform: translateY(-3px); }
.ol-card .ol-icon {
    display: inline-flex; align-items: center; justify-content: center;
    width: 48px; height: 48px; border-radius: 12px; margin-bottom: 1rem;
    background: rgba(72,199,142,.12); color: #48c78e;
}
.ol-card .ol-icon svg { width: 24px; height: 24px; stroke-width: 1.8; }
.ol-card h3 { font-size: 1.1rem; color: var(--text); margin-bottom: .5rem; }
.ol-card p { color: var(--muted); font-size: .95rem; line-height: 1.6; margin: 0; }

.ol-stats { display: flex; flex-wrap: wrap; justify-content: center; gap: 3rem; margin-top: 2rem; }
.ol-stat { text-align: center; }
.ol-stat b { display: block; font-size: 2.5rem; color: #48c78e; font-weight: 700; }
.ol-stat span { color: var(--muted); font-size: .92rem; }

.ol-how { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; }
.ol-step { text-align: center; padding: 1.5rem; }
.ol-step .step-num {
    display: inline-flex; align-items: center; justify-content: center;
    width: 44px; height: 44px; border-radius: 50%; background: rgba(72,199,142,.15);
    color: #48c78e; font-weight: 700; font-size: 1.2rem; margin-bottom: .85rem;
}
.ol-step h3 { font-size: 1.05rem; color: var(--text); margin-bottom: .4rem; }
.ol-step p { color: var(--muted); font-size: .93rem; margin: 0; }

.ol-cta-banner {
    background: linear-gradient(135deg, rgba(72,199,142,.08) 0%, rgba(72,199,142,.03) 100%);
    border: 1px solid rgba(72,199,142,.25); border-radius: var(--radius);
    padding: 3rem; text-align: center; max-width: 700px; margin: 0 auto;
}
.ol-cta-banner h2 { font-size: 1.7rem; color: var(--text); margin-bottom: .6rem; }
.ol-cta-banner p { color: var(--muted); margin-bottom: 1.5rem; }

.ol-aus { display: inline-flex; align-items: center; gap: .5rem; color: var(--muted); font-size: .85rem; margin-top: 2rem; }

@media (max-width: 640px) {
    .ol-hero { padding: 3rem 0 2.5rem; }
    .ol-stats { gap: 1.5rem; }
    .ol-stat b { font-size: 2rem; }
    .ol-cta-banner { padding: 2rem 1.5rem; }
}
CSS;

rt_head([
    'title'       => 'Orderline — Smart Procurement for Hospitality | ' . RT::NAME,
    'description' => 'Orderline is an Australian-made procurement and invoicing platform for restaurants, cafes, and bars. Automate purchasing, track budgets, and eliminate paperwork.',
    'path'        => '/orderline/',
    'og_type'     => 'website',
    'inline_css'  => $orderline_inline_css,
]);
rt_header();
rt_breadcrumbs(['Orderline' => '/orderline/']);
?>

<main id="main">
    <!-- Hero -->
    <section class="ol-hero">
        <div class="container">
            <span class="ol-badge">🇦🇺 Australian Made</span>
            <h1> Procurement that runs as smoothly as your kitchen</h1>
            <p class="lead">Orderline eliminates the paperwork between your venue and your suppliers. Order, approve, track budgets, and manage invoices — all in one place, built for Australian hospitality.</p>
            <div class="ol-cta-row">
                <a href="/contact/" class="btn-primary">Book a free demo</a>
                <a href="#features" class="btn-outline">See what it does</a>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="ol-section" style="padding-bottom:2rem">
        <div class="container">
            <div class="ol-stats">
                <div class="ol-stat"><b>80%</b><span>less paperwork</span></div>
                <div class="ol-stat"><b>100%</b><span>Australian support</span></div>
                <div class="ol-stat"><b>24/7</b><span>cloud access</span></div>
                <div class="ol-stat"><b>30+</b><span>venues using it</span></div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="ol-section" id="features">
        <div class="container">
            <h2>Everything your venue needs</h2>
            <p class="section-lead">Orderline replaces spreadsheets, emails, and paper order forms with one clean system your whole team will actually use.</p>
            <div class="ol-features">
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
                    <h3>One-click ordering</h3>
                    <p>Reorder from your favourites list in seconds. Draft orders keep casual and agency chefs aligned with your purchasing policies.</p>
                </div>
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h2v-4h-2"/></svg></div>
                    <h3>Live budget tracking</h3>
                    <p>Set monthly budgets per venue and get automatic alerts at 80% — before the overspend, not after.</p>
                </div>
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                    <h3>Digital invoice approval</h3>
                    <p>Approve supplier invoices online. Every invoice is digitised and stored in the cloud — find anything in seconds.</p>
                </div>
            </div>
            <div class="ol-features" style="margin-top:1.5rem">
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></div>
                    <h3>Finance &amp; stocktake reports</h3>
                    <p>See exactly where your budget is going. Spend by supplier, by category, or by venue — plus online stocktaking built in.</p>
                </div>
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div>
                    <h3>Catalogue management</h3>
                    <p>Keep supplier details and pricing current across every venue. Update once, apply everywhere — no more out-of-date price lists.</p>
                </div>
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
                    <h3>Australian-based security</h3>
                    <p>Your data stays in Australia. Our support team is in Melbourne — call us and you'll speak to a real person who understands hospitality.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="ol-section" style="background:rgba(255,255,255,.01)">
        <div class="container">
            <h2>Get started in days, not months</h2>
            <p class="section-lead">We set you up, train your team, and you're running — with ongoing support whenever you need it.</p>
            <div class="ol-how">
                <div class="ol-step">
                    <div class="step-num">1</div>
                    <h3>We learn your setup</h3>
                    <p>Tell us about your venues, suppliers, and current workflow. We map it into Orderline.</p>
                </div>
                <div class="ol-step">
                    <div class="step-num">2</div>
                    <h3>Quick onboarding</h3>
                    <p>Your team gets a 45-minute walkthrough. The interface is designed to be picked up in a single shift.</p>
                </div>
                <div class="ol-step">
                    <div class="step-num">3</div>
                    <h3>Go live</h3>
                    <p>Start ordering, approving, and tracking. We stay available for questions while your team finds its rhythm.</p>
                </div>
                <div class="ol-step">
                    <div class="step-num">4</div>
                    <h3>Ongoing optimisation</h3>
                    <p>As you grow, we help tune catalogues, budgets, and user permissions to match how your business is actually running.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Who it's for -->
    <section class="ol-section">
        <div class="container">
            <h2>Built for Australian hospitality</h2>
            <p class="section-lead">Orderline is purpose-built for venues that order from multiple suppliers every week and are tired of chasing paper.</p>
            <div class="ol-features">
                <div class="ol-card">
                    <h3>🍽️ Restaurants</h3>
                    <p>Manage food, beverage, and consumable ordering across service periods. Favourites lists mean your chefs spend less time on admin.</p>
                </div>
                <div class="ol-card">
                    <h3>☕ Cafés</h3>
                    <p>Track coffee, milk, and pastry orders with budget alerts that keep your COGS in check before month-end.</p>
                </div>
                <div class="ol-card">
                    <h3>🍺 Bars &amp; pubs</h3>
                    <p>Handle keg and bottle orders, glassware, and cleaning supplies from a single dashboard that your venue manager can use from their phone.</p>
                </div>
                <div class="ol-card">
                    <h3>🏢 Multi-venue groups</h3>
                    <p>Update pricing and preferred items across every location at once. Compare spend per venue and spot outliers before they become problems.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="ol-section">
        <div class="container">
            <div class="ol-cta-banner">
                <h2>See Orderline in action</h2>
                <p>We'll walk you through the platform, show you how it works for a venue like yours, and answer every question — no hard sell, no obligation.</p>
                <a href="/contact/" style="display:inline-block;background:#48c78e;color:#051018;padding:.85rem 2.2rem;border-radius:100px;font-weight:600;font-size:1.05rem">Book a free demo</a>
                <p class="ol-aus">🇦🇺 Built in Melbourne for Australian hospitality</p>
            </div>
        </div>
    </section>
</main>

<?php
rt_footer();
