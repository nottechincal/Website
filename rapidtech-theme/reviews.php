<?php
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Customer Reviews | ' . RT::NAME,
    'description' => 'See what our customers say about Rapid Tech Solutions. Rated 5.0 from 47 Google reviews. Computer repairs, virus removal, data recovery in Melbourne\'s south-east.',
    'path'        => '/reviews/',
    'schema'      => [
        RT::local_business([
            'aggregateRating' => [
                '@type'       => 'AggregateRating',
                'ratingValue' => RT::RATING_VALUE,
                'reviewCount' => (int) RT::RATING_COUNT,
                'bestRating'  => '5',
            ],
        ]),
    ],
]); ?>
</head>
<body>
<?php rt_header(); ?>
<?php rt_breadcrumbs(['Reviews' => '/reviews/']); ?>

<main id="main">
    <section class="section">
        <div class="container" style="max-width:960px;margin:0 auto;">
            <div class="shead">
                <p class="kicker">Reviews</p>
                <h1>What our customers say</h1>
                <p>Rated <strong><?php echo RT::RATING_VALUE; ?></strong> from <?php echo RT::RATING_COUNT; ?> Google reviews. Here are some of the highlights.</p>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:1.2rem;margin-top:2rem">
                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                    <div style="color:#f5c518;font-size:1.1rem;margin-bottom:.5rem">★★★★★</div>
                    <p style="margin-bottom:.75rem;font-style:italic">"Fantastic service. My laptop was running incredibly slow and they fixed it same day. Honest, reliable, explained what they were doing the whole time."</p>
                    <p style="font-weight:600">Sarah M.</p>
                    <p style="color:var(--muted);font-size:.85rem">Patterson Lakes · 3 weeks ago</p>
                    <span style="display:inline-block;background:var(--cyan-dim);color:var(--accent);padding:.15rem .6rem;border-radius:100px;font-size:.75rem;font-weight:600">Same-day fix</span>
                </div>
                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                    <div style="color:#f5c518;font-size:1.1rem;margin-bottom:.5rem">★★★★★</div>
                    <p style="margin-bottom:.75rem;font-style:italic">"Saved my business. We had a ransomware attack and they had us back running within hours. Professional, knowledgeable and genuinely cared."</p>
                    <p style="font-weight:600">David R.</p>
                    <p style="color:var(--muted);font-size:.85rem">Seaford · business owner · 1 month ago</p>
                    <span style="display:inline-block;background:var(--cyan-dim);color:var(--accent);padding:.15rem .6rem;border-radius:100px;font-size:.75rem;font-weight:600">Saved business</span>
                </div>
                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                    <div style="color:#f5c518;font-size:1.1rem;margin-bottom:.5rem">★★★★★</div>
                    <p style="margin-bottom:.75rem;font-style:italic">"Finally someone who explains things without the jargon. Sorted our whole home network — WiFi works perfectly in every room now."</p>
                    <p style="font-weight:600">The Thompson Family</p>
                    <p style="color:var(--muted);font-size:.85rem">Frankston · 2 months ago</p>
                    <span style="display:inline-block;background:var(--cyan-dim);color:var(--accent);padding:.15rem .6rem;border-radius:100px;font-size:.75rem;font-weight:600">Explained clearly</span>
                </div>
                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                    <div style="color:#f5c518;font-size:1.1rem;margin-bottom:.5rem">★★★★★</div>
                    <p style="margin-bottom:.75rem;font-style:italic">"Thought my hard drive was dead and I'd lost everything. He recovered all my photos and documents. Can't recommend enough."</p>
                    <p style="font-weight:600">Michael T.</p>
                    <p style="color:var(--muted);font-size:.85rem">Berwick · 3 weeks ago</p>
                    <span style="display:inline-block;background:var(--cyan-dim);color:var(--accent);padding:.15rem .6rem;border-radius:100px;font-size:.75rem;font-weight:600">Data saved</span>
                </div>
                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                    <div style="color:#f5c518;font-size:1.1rem;margin-bottom:.5rem">★★★★★</div>
                    <p style="margin-bottom:.75rem;font-style:italic">"Came out same day, had the screen replaced on my daughter's laptop within an hour. Fair price, great work, lovely bloke."</p>
                    <p style="font-weight:600">Lisa K.</p>
                    <p style="color:var(--muted);font-size:.85rem">Cranbourne · 1 month ago</p>
                    <span style="display:inline-block;background:var(--cyan-dim);color:var(--accent);padding:.15rem .6rem;border-radius:100px;font-size:.75rem;font-weight:600">Same-day fix</span>
                </div>
                <div style="background:var(--surface);border:1px solid var(--line);border-radius:var(--r2);padding:1.5rem">
                    <div style="color:#f5c518;font-size:1.1rem;margin-bottom:.5rem">★★★★★</div>
                    <p style="margin-bottom:.75rem;font-style:italic">"Honest, upfront pricing. Told me my old laptop wasn't worth fixing and helped me set up the new one instead. Didn't charge for the advice."</p>
                    <p style="font-weight:600">Robert C.</p>
                    <p style="color:var(--muted);font-size:.85rem">Dandenong · 3 months ago</p>
                    <span style="display:inline-block;background:var(--cyan-dim);color:var(--accent);padding:.15rem .6rem;border-radius:100px;font-size:.75rem;font-weight:600">Honest advice</span>
                </div>
            </div>

            <div style="text-align:center;margin-top:2.5rem;padding:2rem;background:var(--surface);border:1px solid var(--line);border-radius:var(--r3)">
                <p style="font-size:1.2rem;margin-bottom:.5rem"><strong>Had a great experience?</strong></p>
                <p style="color:var(--muted);margin-bottom:1rem">Your review helps other locals find honest, reliable computer repair.</p>
                <a href="<?php echo RT::GOOGLE_REVIEW_URL; ?>" rel="noopener nofollow" target="_blank" style="display:inline-block;padding:.85rem 2rem;background:var(--accent);color:#051018;border-radius:var(--r);font-weight:600;font-size:1rem">Leave a Google Review</a>
            </div>
        </div>
    </section>
</main>

<?php rt_footer(); ?>
</body>
</html>
