<?php
/*
Template Name: Blog Index
*/
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';

$blog_inline_css = <<<'CSS'
.blog-hero {
    background: linear-gradient(135deg, #0f1016 0%, #1a1a2e 100%);
    padding: 4rem 0;
    text-align: center;
}
.blog-hero h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}
.blog-hero p {
    color: var(--muted);
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto;
}
.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    padding: 3rem 0;
}
.blog-card {
    background: rgba(255, 255, 255, 0.03);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    overflow: hidden;
    transition: all 0.3s ease;
}
.blog-card:hover {
    transform: translateY(-5px);
    border-color: var(--accent);
    box-shadow: 0 10px 30px rgba(41, 213, 255, 0.1);
}
.blog-card-content {
    padding: 1.5rem;
}
.blog-card-category {
    display: inline-block;
    background: rgba(41, 213, 255, 0.1);
    color: var(--accent);
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 1rem;
}
.blog-card h3 {
    font-size: 1.3rem;
    margin-bottom: 0.75rem;
    color: var(--text);
}
.blog-card p {
    color: var(--muted);
    line-height: 1.6;
    margin-bottom: 1rem;
}
.blog-card-meta {
    display: flex;
    gap: 1rem;
    color: var(--muted);
    font-size: 0.85rem;
    margin-bottom: 1rem;
}
.blog-card .btn {
    width: 100%;
    text-align: center;
}
.featured-article {
    background: linear-gradient(135deg, rgba(255, 92, 92, 0.1), rgba(255, 149, 0, 0.1));
    border-color: rgba(255, 92, 92, 0.3);
}
.featured-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: #ff5c5c;
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}
.search-box {
    max-width: 500px;
    margin: 2rem auto;
    position: relative;
}
.search-box input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border-radius: 50px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background: rgba(255, 255, 255, 0.05);
    color: white;
    font-size: 1rem;
}
.search-box .search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
}
CSS;
?>
<!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Computer Tips & IT Guides | ' . RT::NAME,
    'description' => 'Free computer tips, security guides and IT how-tos for Melbourne households and small businesses. Practical advice from working technicians.',
    'path'        => '/blog/',
    'css'         => 'css/blog.css',
    'inline_css'  => $blog_inline_css,
    'schema'      => [[
        '@type'       => 'Blog',
        'name'        => RT::NAME . ' IT Help Blog',
        'description' => 'Free computer tips, IT guides, and tech help for Melbourne residents',
        'url'         => RT::url('/blog/'),
        'publisher'   => [
            '@type' => 'Organization',
            'name'  => RT::NAME,
            'logo'  => RT::url(RT::LOGO),
        ],
    ]],
]); ?>
</head>
<body>
<?php rt_header(); ?>

    <main id="main">
        <section class="blog-hero">
            <div class="container">
                <h1>Free IT Help & Computer Tips</h1>
                <p>Learn how to protect yourself online, maintain your computer, and solve common tech problems. Written in plain English for Melbourne residents.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
<?php
$blog_posts = [
    ['slug' => 'blog-scam-protection',       'category' => 'Online Safety',      'title' => 'How to Spot and Avoid Tech Support Scams',               'excerpt' => 'Australians lost over $3.1 billion to scams in 2022. Learn to identify fake tech support calls, phishing emails, and protect your family from common scams targeting our community.', 'read' => '6 min read', 'date' => '2025-11-17', 'featured' => true],
    ['slug' => 'blog-password-security',      'category' => 'Online Safety',      'title' => 'Password Security Made Simple',                          'excerpt' => 'Stop using "password123"! Learn how to create strong passwords, use password managers, and set up two-factor authentication to protect your accounts.', 'read' => '5 min read', 'date' => '2026-08-02', 'featured' => false],
    ['slug' => 'blog-computer-maintenance',   'category' => 'Computer Care',      'title' => 'Simple Computer Maintenance Tips',                       'excerpt' => '15 minutes a month can save you hundreds in repair bills. Here\'s your easy checklist for keeping your computer running fast and avoiding costly repairs.', 'read' => '7 min read', 'date' => '2026-08-02', 'featured' => false],
    ['slug' => 'blog-malware-protection',     'category' => 'Security',           'title' => 'Malware Protection Playbook',                            'excerpt' => 'Protect your devices from viruses, ransomware, and malware. Learn isolation steps, prevention strategies, and what to do if you get infected.', 'read' => '8 min read', 'date' => '2024-11-01', 'featured' => false],
    ['slug' => 'blog-home-network',           'category' => 'Networking',         'title' => 'Home Network Tune-Up Checklist',                         'excerpt' => 'Eliminate WiFi dead zones, boost your speeds, and secure every device in your home. Perfect for families with remote workers and students.', 'read' => '6 min read', 'date' => '2026-08-02', 'featured' => false],
    ['slug' => 'blog-hardware-upgrades',      'category' => 'Hardware',           'title' => 'When to Upgrade Your Hardware',                          'excerpt' => 'Is your computer slow because of old hardware? Learn the signs that indicate it\'s time for an upgrade vs. when a simple cleanup will do.', 'read' => '5 min read', 'date' => '2026-08-02', 'featured' => false],
    ['slug' => 'blog-cloud-services',         'category' => 'Backup & Recovery',  'title' => 'Cloud vs Local Backups',                                 'excerpt' => 'Don\'t lose your precious photos and documents. Learn about hybrid backup strategies that protect your data from hardware failure and disasters.', 'read' => '6 min read', 'date' => '2026-08-02', 'featured' => false],
];
?>
                <div class="blog-grid">
                    <?php foreach ($blog_posts as $p): ?>
                    <article class="blog-card<?php if ($p['featured']) echo ' featured-article'; ?>" style="<?php if ($p['featured']) echo 'position: relative;'; ?>">
                        <?php if ($p['featured']): ?>
                        <span class="featured-badge"><?php echo rt_icon('star'); ?> Featured</span>
                        <?php endif; ?>
                        <div class="blog-card-content">
                            <span class="blog-card-category"><?php echo RT::e($p['category']); ?></span>
                            <h3><?php echo RT::e($p['title']); ?></h3>
                            <p><?php echo RT::e($p['excerpt']); ?></p>
                            <div class="blog-card-meta">
                                <span><?php echo rt_icon('clock'); ?> <?php echo RT::e($p['read']); ?></span>
                                <span><?php echo rt_icon('calendar'); ?> <time datetime="<?php echo RT::e($p['date']); ?>"><?php echo RT::e(date('M Y', strtotime($p['date']))); ?></time></span>
                            </div>
                            <a href="/<?php echo RT::e($p['slug']); ?>/" class="btn<?php if (!$p['featured']) echo ' btn-outline'; ?>">Read Article</a>
                        </div>
                    </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section style="background: linear-gradient(120deg, #181a27, #07070b); padding: 3rem 0;">
            <div class="container" style="text-align: center;">
                <h2 style="margin-bottom: 1rem;">Need Hands-On Help?</h2>
                <p style="color: var(--muted); margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Our articles are here to help, but sometimes you need a professional. We offer free diagnostics and honest advice—no pressure, no jargon.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="tel:<?php echo RT::PHONE_E164; ?>" class="btn"><?php echo rt_icon('phone'); ?> Call: <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
                    <a href="/book/" class="btn btn-outline"><?php echo rt_icon('mail'); ?> Send a Message</a>
                </div>
            </div>
        </section>
    </main>

<?php rt_footer(); ?>
</body>
</html>
