<?php
/*
Template Name: Orderline
Description: Promotional landing page for Orderline — AI phone ordering for takeaway shops.
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
.ol-hero .ol-badge-live {
    display: inline-block;
    background: #48c78e;
    color: #051018;
    padding: .2rem .7rem;
    border-radius: 100px;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .04em;
    text-transform: uppercase;
    margin-left: .5rem;
    vertical-align: middle;
    animation: ol-pulse 2s ease-in-out infinite;
}
@keyframes ol-pulse { 0%,100%{opacity:1} 50%{opacity:.7} }
.ol-hero h1 {
    font-size: clamp(2.2rem, 4.5vw, 3.4rem);
    line-height: 1.12;
    color: var(--text);
    max-width: 20ch;
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
    font-weight: 600; font-size: 1rem; transition: .2s; text-decoration: none;
}
.ol-hero .btn-primary:hover { background: #3bb57a; transform: translateY(-2px); box-shadow: 0 8px 30px rgba(72,199,142,.3); }
.ol-hero .btn-outline {
    border: 1px solid rgba(143,155,179,.35); color: var(--text); padding: .85rem 2rem;
    border-radius: 100px; font-weight: 500; transition: .2s; text-decoration: none;
}
.ol-hero .btn-outline:hover { border-color: #48c78e; color: #48c78e; }

.ol-section { padding: 4rem 0; }
.ol-section h2 {
    font-size: clamp(1.6rem, 2.8vw, 2.2rem); color: var(--text);
    text-align: center; margin-bottom: .75rem;
}
.ol-section .section-lead { text-align: center; color: var(--muted); max-width: 52ch; margin: 0 auto 2.5rem; font-size: 1.05rem; }

.ol-features { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; }
.ol-card {
    background: var(--surface); border: 1px solid rgba(143,155,179,.15);
    border-radius: var(--radius); padding: 1.75rem; transition: .2s;
}
.ol-card:hover { border-color: rgba(72,199,142,.4); transform: translateY(-3px); }
.ol-card .ol-icon {
    display: inline-flex; align-items: center; justify-content: center;
    width: 44px; height: 44px; border-radius: 10px; margin-bottom: .9rem;
    background: rgba(72,199,142,.12); color: #48c78e;
}
.ol-card .ol-icon svg { width: 22px; height: 22px; stroke-width: 1.8; }
.ol-card h3 { font-size: 1.08rem; color: var(--text); margin-bottom: .45rem; }
.ol-card p { color: var(--muted); font-size: .93rem; line-height: 1.55; margin: 0; }

.ol-highlight {
    background: linear-gradient(135deg, rgba(72,199,142,.06), rgba(72,199,142,.02));
    border: 1px solid rgba(72,199,142,.2); border-radius: var(--radius); padding: 2rem 2.5rem;
    display: flex; flex-wrap: wrap; align-items: center; gap: 2rem; margin-top: 2rem;
}
.ol-highlight blockquote {
    flex: 1; font-style: italic; color: var(--text); font-size: 1.05rem; margin: 0;
    border-left: 3px solid #48c78e; padding-left: 1.25rem;
}
.ol-highlight blockquote cite { display: block; font-style: normal; color: var(--muted); font-size: .88rem; margin-top: .5rem; }
.ol-highlight .ol-stat-sm { text-align: center; min-width: 100px; }
.ol-highlight .ol-stat-sm b { display: block; font-size: 2rem; color: #48c78e; }
.ol-highlight .ol-stat-sm span { color: var(--muted); font-size: .82rem; }

.ol-problems { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; }
.ol-problem {
    background: rgba(255,92,92,.04); border: 1px solid rgba(255,92,92,.15);
    border-radius: var(--radius); padding: 1.5rem; text-align: center;
}
.ol-problem .ol-icon { color: var(--primary); background: rgba(255,92,92,.1); }
.ol-problem h3 { font-size: 1rem; color: var(--text); margin-bottom: .35rem; }
.ol-problem p { color: var(--muted); font-size: .9rem; margin: 0; }

.ol-trust { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; }
.ol-trust li { display: flex; align-items: flex-start; gap: .65rem; color: var(--muted); font-size: .93rem; }
.ol-trust li svg { width: 18px; height: 18px; stroke: #48c78e; flex: none; margin-top: .15rem; }

.ol-how { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; }
.ol-step { text-align: center; padding: 1.25rem; }
.ol-step .step-num {
    display: inline-flex; align-items: center; justify-content: center;
    width: 40px; height: 40px; border-radius: 50%; background: rgba(72,199,142,.15);
    color: #48c78e; font-weight: 700; font-size: 1.1rem; margin-bottom: .7rem;
}
.ol-step h4 { font-size: .98rem; color: var(--text); margin-bottom: .3rem; }
.ol-step p { color: var(--muted); font-size: .9rem; margin: 0; }

.ol-cta-banner {
    background: linear-gradient(135deg, rgba(72,199,142,.08) 0%, rgba(72,199,142,.03) 100%);
    border: 1px solid rgba(72,199,142,.25); border-radius: var(--radius);
    padding: 3rem; text-align: center; max-width: 700px; margin: 0 auto;
}
.ol-cta-banner h2 { font-size: 1.7rem; color: var(--text); margin-bottom: .6rem; }
.ol-cta-banner p { color: var(--muted); margin-bottom: 1.5rem; }
.ol-cta-banner .btn {
    display: inline-block; background: #48c78e; color: #051018;
    padding: .85rem 2.2rem; border-radius: 100px; font-weight: 600; font-size: 1.05rem;
    text-decoration: none; transition: .2s;
}
.ol-cta-banner .btn:hover { background: #3bb57a; box-shadow: 0 8px 30px rgba(72,199,142,.3); }

.ol-aus { display: inline-flex; align-items: center; gap: .5rem; color: var(--dim); font-size: .85rem; margin-top: 1.5rem; }

@media (max-width: 768px) {
    .ol-highlight { flex-direction: column; text-align: center; }
    .ol-highlight blockquote { border-left: none; padding-left: 0; }
}
@media (max-width: 640px) {
    .ol-hero { padding: 3rem 0 2.5rem; }
    .ol-cta-banner { padding: 2rem 1.5rem; }
}
CSS;

rt_head([
    'title'       => 'Orderline — AI Phone Ordering for Takeaway Shops | ' . RT::NAME,
    'description' => 'Orderline answers your shop\'s phone so your team can cook. AI-powered voice ordering built for Australian takeaway shops — kebabs, pizza, fish & chips. Live in Melbourne.',
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
            <span class="ol-badge">🇦🇺 Melbourne · Live in production<span class="ol-badge-live">● Live</span></span>
            <h1>Your shop phone, answered. Every time.</h1>
            <p class="lead">Orderline is an AI voice assistant that answers your takeaway shop's phone, takes orders like a real counter worker, and sends the docket straight to your kitchen — so your team can stop juggling the phone during a dinner rush.</p>
            <div class="ol-cta-row">
                <a href="/contact/" class="btn-primary">Book a demo</a>
                <a href="#how-it-works" class="btn-outline">How it works</a>
            </div>
        </div>
    </section>

    <!-- The Problem -->
    <section class="ol-section" style="padding-bottom:2rem">
        <div class="container">
            <h2>Your busiest hour is also when the phone rings most</h2>
            <p class="section-lead">Every missed call is a lost order. Every answered call pulls a cook off the line. Orderline fixes both.</p>
            <div class="ol-problems">
                <div class="ol-problem">
                    <div class="ol-icon" style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:10px;margin-bottom:.9rem;background:rgba(255,92,92,.1);color:var(--primary)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" style="width:22px;height:22px;stroke-width:1.8"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg></div>
                    <h3>Missed calls = lost revenue</h3>
                    <p>Friday night, 7pm. Four calls in five minutes. Your best cook is answering the phone instead of grilling.</p>
                </div>
                <div class="ol-problem">
                    <div class="ol-icon" style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:10px;margin-bottom:.9rem;background:rgba(255,92,92,.1);color:var(--primary)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" style="width:22px;height:22px;stroke-width:1.8"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div>
                    <h3>Wrong orders, remakes, waste</h3>
                    <p>Rushed phone orders get things wrong. Wrong sauce on a kebab = remake. Remakes cost you money and slow the line.</p>
                </div>
                <div class="ol-problem">
                    <div class="ol-icon" style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:10px;margin-bottom:.9rem;background:rgba(255,92,92,.1);color:var(--primary)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" style="width:22px;height:22px;stroke-width:1.8"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div>
                    <h3>Staff burnout, high turnover</h3>
                    <p>Your team didn't sign up to be call centre operators. They signed up to cook. Let them.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="ol-section" id="how-it-works" style="background:rgba(255,255,255,.01)">
        <div class="container">
            <h2>How it works</h2>
            <p class="section-lead">Your phone number doesn't change. Your menu doesn't change. Your customers just get a better experience.</p>
            <div class="ol-how">
                <div class="ol-step">
                    <div class="step-num">1</div>
                    <h4>Customer calls your shop</h4>
                    <p>Same number, same shop. They don't know it's AI — it answers warm and quick, like a real counter worker.</p>
                </div>
                <div class="ol-step">
                    <div class="step-num">2</div>
                    <h4>Order taken conversationally</h4>
                    <p>"Righto, one large mixed kebab. Chicken or lamb?" Every option, sauce, and size confirmed against your real menu.</p>
                </div>
                <div class="ol-step">
                    <div class="step-num">3</div>
                    <h4>Docket hits your kitchen</h4>
                    <p>Instant WhatsApp or SMS to your kitchen tablet — every item, every option, pickup time, customer name. No handwriting.</p>
                </div>
                <div class="ol-step">
                    <div class="step-num">4</div>
                    <h4>Customer gets a receipt</h4>
                    <p>Order number, total, pickup time — texted to their phone. They can call back within 2 minutes to change anything.</p>
                </div>
            </div>
            <div class="ol-highlight">
                <blockquote>
                    "The AI answers our phone, takes the order exactly how we would, and sends the docket to the kitchen. We don't touch the phone during peak hours anymore."
                    <cite>— Kebabalab, St Kilda (live pilot)</cite>
                </blockquote>
                <div class="ol-stat-sm"><b>2</b><span>shops live</span></div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="ol-section" id="features">
        <div class="container">
            <h2>Not a chatbot. A counter worker.</h2>
            <p class="section-lead">Orderline is built for real takeaway shops — kebabs, pizza, fish and chips. It handles the messy reality of phone orders.</p>
            <div class="ol-features">
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
                    <h3>Answers in Australian English</h3>
                    <p>Warm, quick, with a bit of personality. "No worries", "Righto", "the lot" means all salads. Never sounds like a robot.</p>
                </div>
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
                    <h3>Never guesses your prices</h3>
                    <p>Every price comes from your real menu data. The AI can't "remember" a wrong price — it reads it from your config every time.</p>
                </div>
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                    <h3>Knows your menu cold</h3>
                    <p>Size → protein → salads → sauces → combo upsell. It follows your shop's real build order for every item. Handles "crocodile" → Coke and "loaf margin" → lahmacun.</p>
                </div>
            </div>
            <div class="ol-features" style="margin-top:1.25rem">
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></div>
                    <h3>Handles real phone chaos</h3>
                    <p>"Oh and a can of Coke" after confirming — no problem. Order isn't final until the call ends. Mid-order changes, off-menu requests, family orders — all handled.</p>
                </div>
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg></div>
                    <h3>Dockets straight to your kitchen</h3>
                    <p>WhatsApp docket with every item, every option, pickup time, customer name. SMS fallback if WhatsApp doesn't deliver. Square POS sync for your register.</p>
                </div>
                <div class="ol-card">
                    <div class="ol-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><line x1="12" y1="20" x2="12" y2="10"/><line x1="18" y1="20" x2="18" y2="4"/><line x1="6" y1="20" x2="6" y2="16"/></svg></div>
                    <h3>Call analytics built in</h3>
                    <p>How many calls → orders? Average order value? Peak times? Full transcripts and recordings. Know exactly what your AI is doing on every call.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kitchen display -->
    <section class="ol-section" style="background:rgba(255,255,255,.01)">
        <div class="container">
            <h2>Kitchen Display included</h2>
            <p class="section-lead">A tablet-optimised kanban board for your kitchen. New orders appear with a chime — tap to move through New → Preparing → Ready → Collected.</p>
            <div class="ol-features" style="max-width:800px;margin:0 auto">
                <div class="ol-card">
                    <h3>📋 Live order board</h3>
                    <p>Every order card shows pickup time, customer name, every item with options, and special notes. Big touch targets, dark theme, works offline.</p>
                </div>
                <div class="ol-card">
                    <h3>📊 Today at a glance</h3>
                    <p>Order count, today's takings. Chime on new orders. Customer's number is tappable to call back. Polls every 4 seconds.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust -->
    <section class="ol-section">
        <div class="container">
            <h2>Built for production, not a demo</h2>
            <p class="section-lead">Orderline is live right now taking real orders. Here's what's under the hood.</p>
            <ul class="ol-trust">
                <li><?php echo rt_icon('check-circle'); ?> Powered by Claude AI — the same model that powers enterprise assistants</li>
                <li><?php echo rt_icon('check-circle'); ?> Your menu, prices, and persona live in a single JSON config file per shop</li>
                <li><?php echo rt_icon('check-circle'); ?> Orders aren't final until the call ends — customers can change anything up to hang-up</li>
                <li><?php echo rt_icon('check-circle'); ?> 2-minute callback window to modify or cancel after the call</li>
                <li><?php echo rt_icon('check-circle'); ?> Overnight trading hours handled (kebab shops peak at midnight)</li>
                <li><?php echo rt_icon('check-circle'); ?> Per-call cost tracking — you know exactly what each call costs</li>
                <li><?php echo rt_icon('check-circle'); ?> Transcriptions deleted after 30 days, calls after 365 — privacy built in</li>
                <li><?php echo rt_icon('check-circle'); ?> Halal-aware, allergen-aware, and dietary-requirement-aware</li>
                <li><?php echo rt_icon('check-circle'); ?> "My usual" — recognises repeat customers and re-orders their last order</li>
                <li><?php echo rt_icon('check-circle'); ?> SMS alerting if anything goes wrong — you'll know before the customer does</li>
            </ul>
        </div>
    </section>

    <!-- Who it's for -->
    <section class="ol-section" style="background:rgba(255,255,255,.01)">
        <div class="container">
            <h2>Built for your kind of shop</h2>
            <p class="section-lead">If your shop lives on phone orders — especially at night — Orderline is for you.</p>
            <div class="ol-features" style="max-width:900px;margin:0 auto">
                <div class="ol-card">
                    <h3>🥙 Kebab &amp; HSP shops</h3>
                    <p>The product was built with a real kebab shop. Halal-aware, handles HSP snack pack builds (meat → cheese-or-salad → sauces → combo → drink), knows lahmacun is pronounced "lahmajoon".</p>
                </div>
                <div class="ol-card">
                    <h3>🍕 Pizzerias</h3>
                    <p>Handles half-and-half toppings, crust options, garlic bread add-ons, and family meal deals. Second pilot is a pizza shop — the prompt is already tuned for it.</p>
                </div>
                <div class="ol-card">
                    <h3>🍔 Burger joints &amp; fish &amp; chips</h3>
                    <p>Burger builds (protein → cheese → extras → sauce → side → drink), fish packs, family deals. Any shop with a menu of customisable items.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="ol-section">
        <div class="container">
            <div class="ol-cta-banner">
                <h2>Your shop. Your menu. Your phone number.</h2>
                <p>We'll set you up with a pilot — your real menu, your real phone line, your real customers. You decide if it's right for your shop. No commitment, no lock-in.</p>
                <a href="/contact/" class="btn">Book a demo</a>
                <p class="ol-aus">🇦🇺 Built in Melbourne · Powered by Claude AI · Live in production</p>
            </div>
        </div>
    </section>
</main>

<?php
rt_footer();
