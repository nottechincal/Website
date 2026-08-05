<?php
/*
Template Name: Book
*/
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/seo.php';
require_once __DIR__ . '/inc/icons.php';
require_once __DIR__ . '/inc/forms.php';

// ── Handle form submission ──────────────────────────────────────────────
$submitted = false;
$errors = [];
$form_data = ['service' => '', 'name' => '', 'email' => '', 'phone' => '',
              'date' => '', 'time' => '', 'address' => '', 'description' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Honeypot — bots that fill every field get silently redirected, not
    // told which check caught them.
    if (!empty($_POST['website'])) {
        header('Location: /thank-you/'); exit;
    }

    $result = rt_validate_booking($_POST);
    $form_data = $result['clean'];
    $errors = $result['errors'];

    if (!rt_verify_csrf($_POST['rt_csrf'] ?? null)) {
        $errors['csrf'] = 'Your session expired — please try again.';
    }

    if (empty($errors)) {
        rt_log_booking($form_data, 'book');
        rt_send_booking_email($form_data);
        $submitted = true;
    }
}
?><!DOCTYPE html>
<html lang="<?php echo RT::LANG; ?>">
<head>
<?php rt_head([
    'title'       => 'Book a Repair — ' . RT::NAME,
    'description' => 'Book a same-day computer repair in Melbourne\'s south-east. Free diagnosis, fixed price, no fix no fee.',
    'path'        => '/book/',
    'noindex'     => true,
    'inline_css'  => <<<'CSS'
.book-page { min-height: 100vh; display: flex; flex-direction: column; }
.book-main { flex: 1; padding: 3rem 0 5rem; }
.book-grid { display: grid; grid-template-columns: 1fr 1.3fr; gap: 2.5rem; align-items: start; }
@media(max-width: 800px) { .book-grid { grid-template-columns: 1fr; } }

.book-info { color: var(--muted); }
.book-info h2 { font-size: 1.6rem; margin-bottom: .8rem; }
.book-info p { margin-bottom: 1.5rem; }
.book-info .trust-points { list-style: none; display: flex; flex-direction: column; gap: .8rem; margin-bottom: 2rem; }
.book-info .trust-points li { display: flex; align-items: center; gap: .7rem; font-size: .95rem; color: var(--muted); }
.book-info .trust-points li svg { width: 18px; height: 18px; stroke: var(--accent); fill: none; stroke-width: 2.5; flex: none; }

.book-form-card {
    background: var(--surface); border: 1px solid var(--line); border-radius: var(--r3);
    padding: 2rem;
}
.book-form-card h1 { font-size: 1.5rem; margin-bottom: .3rem; }
.book-form-card .subtitle { color: var(--dim); font-size: .9rem; margin-bottom: 1.5rem; }

.field { margin-bottom: 1.2rem; }
.field label { display: block; font-size: .85rem; font-weight: 600; margin-bottom: .35rem; color: var(--text); }
.field label .req { color: var(--primary); }
.field input, .field select, .field textarea {
    width: 100%; background: var(--bg); border: 1px solid var(--line-2);
    border-radius: var(--r); padding: .7rem .85rem; font-size: .95rem;
    color: var(--text); font-family: inherit; transition: .18s; outline: none;
}
.field input:focus, .field select:focus, .field textarea:focus {
    border-color: var(--accent); box-shadow: 0 0 0 3px var(--cyan-dim);
}
.field textarea { resize: vertical; min-height: 100px; }
.field .err { font-size: .8rem; color: var(--primary); margin-top: .3rem; display: none; }
.field.has-error input, .field.has-error select, .field.has-error textarea { border-color: var(--primary); box-shadow: 0 0 0 3px var(--red-dim); }
.field.has-error .err { display: block; }

.field-row { display: grid; grid-template-columns: 1fr 1fr; gap: .8rem; }
@media(max-width: 500px) { .field-row { grid-template-columns: 1fr; } }

.honey { position: absolute; left: -9999px; opacity: 0; height: 0; overflow: hidden; }

.submit-row { margin-top: 1.8rem; }
.submit-row button {
    width: 100%; padding: .9rem; background: var(--primary); color: #fff;
    border: none; border-radius: var(--r); font-size: 1rem; font-weight: 600;
    cursor: pointer; transition: .18s; font-family: inherit;
    box-shadow: 0 4px 20px rgba(255,92,92,.25);
}
.submit-row button:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 8px 30px rgba(255,92,92,.35); }
.submit-row button:disabled { opacity: .5; cursor: not-allowed; transform: none; }

.form-error-banner {
    background: var(--red-dim); border: 1px solid rgba(255,92,92,.25);
    border-radius: var(--r); padding: .8rem 1rem; margin-bottom: 1.3rem;
    color: var(--primary); font-size: .88rem; display: none;
}
.form-error-banner.show { display: block; }

.success-card {
    background: var(--surface); border: 1px solid var(--line); border-radius: var(--r3);
    padding: 3rem 2rem; text-align: center;
}
.success-card .check { width: 64px; height: 64px; border-radius: 50%; background: rgba(34,197,94,.12); display: grid; place-items: center; margin: 0 auto 1.2rem; font-size: 2rem; }
.success-card h2 { font-size: 1.5rem; margin-bottom: .6rem; }
.success-card p { color: var(--muted); margin-bottom: 1.5rem; }
.success-card .summary { background: var(--bg); border-radius: var(--r2); padding: 1.2rem 1.5rem; text-align: left; margin-bottom: 1.5rem; font-size: .9rem; color: var(--muted); line-height: 1.7; }
.success-card .summary strong { color: var(--text); }
CSS,
]); ?>
</head>
<body class="book-page">

<!-- Header (minimal — this is a standalone booking flow, not full site nav) -->
<header class="site-header" role="banner">
  <div class="wrap">
    <a class="brand" href="/">
      <img src="<?php echo RT::asset('images/logo.png'); ?>" alt="<?php echo RT::e(RT::NAME); ?>" width="64" height="64">
      <?php echo RT::e(RT::NAME); ?>
    </a>
    <a class="hbtn" href="/">← Back to site</a>
  </div>
</header>

<main class="book-main"><div class="wrap">
<?php if ($submitted): ?>
    <!-- ── SUCCESS ──────────────────────────────────────────────────── -->
    <div class="success-card" style="max-width:640px;margin:0 auto">
        <div class="check">✅</div>
        <h2>Booking received!</h2>
        <p>We'll confirm your time within 1 business hour. For urgent help, call now.</p>
        <div class="summary">
            <strong>Service:</strong> <?php echo htmlspecialchars($form_data['service']); ?><br>
            <?php if ($form_data['date']): ?><strong>Date:</strong> <?php echo htmlspecialchars($form_data['date']); ?><br><?php endif; ?>
            <?php if ($form_data['time']): ?><strong>Time:</strong> <?php echo htmlspecialchars($form_data['time']); ?><br><?php endif; ?>
            <strong>Address:</strong> <?php echo htmlspecialchars($form_data['address']); ?>
        </div>
        <a class="btn b-solid" href="tel:<?php echo RT::PHONE_E164; ?>" style="margin-right:.5rem">📞 Call <?php echo RT::e(RT::PHONE_DISPLAY); ?></a>
        <a class="btn b-line" href="/">Back to home</a>
    </div>
<?php else: ?>
    <!-- ── FORM ─────────────────────────────────────────────────────── -->
    <div class="book-grid">
        <div class="book-info">
            <h2>Book a repair</h2>
            <p>Fill in the form and we'll confirm your booking within 1 business hour. Same-day service available across Melbourne's south-east.</p>
            <ul class="trust-points">
                <li><svg viewBox="0 0 24 24"><path d="m20 6-11 11-5-5"/></svg> Free diagnosis — always</li>
                <li><svg viewBox="0 0 24 24"><path d="m20 6-11 11-5-5"/></svg> Fixed price before we start</li>
                <li><svg viewBox="0 0 24 24"><path d="m20 6-11 11-5-5"/></svg> No fix, no fee guarantee</li>
                <li><svg viewBox="0 0 24 24"><path d="m20 6-11 11-5-5"/></svg> 30-day warranty on all repairs</li>
                <li><svg viewBox="0 0 24 24"><path d="m20 6-11 11-5-5"/></svg> 97% resolved same day</li>
            </ul>
            <p style="font-size:.9rem;color:var(--dim)">Prefer to talk?<br><a href="tel:<?php echo RT::PHONE_E164; ?>" style="color:var(--accent);font-weight:600">Call <?php echo RT::e(RT::PHONE_DISPLAY); ?></a></p>
        </div>

        <div class="book-form-card" id="bookingForm">
            <h1>Your details</h1>
            <p class="subtitle">All fields required unless marked optional</p>

            <div class="form-error-banner" id="formBanner"></div>

            <form method="POST" action="" novalidate id="bookForm">
                <!-- Honeypot -->
                <div class="honey"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
                <?php rt_csrf_field(); ?>

                <div class="field" id="f-service">
                    <label for="service">What do you need? <span class="req">*</span></label>
                    <select name="service" id="service">
                        <option value="">Choose a service…</option>
                        <option value="Computer repairs" <?php echo $form_data['service'] === 'Computer repairs' ? 'selected' : ''; ?>>Computer repairs</option>
                        <option value="Virus & malware removal" <?php echo $form_data['service'] === 'Virus & malware removal' ? 'selected' : ''; ?>>Virus &amp; malware removal</option>
                        <option value="Data recovery" <?php echo $form_data['service'] === 'Data recovery' ? 'selected' : ''; ?>>Data recovery</option>
                        <option value="Wi-Fi & networks" <?php echo $form_data['service'] === 'Wi-Fi & networks' ? 'selected' : ''; ?>>Wi-Fi &amp; networks</option>
                        <option value="Other / not sure" <?php echo $form_data['service'] === 'Other / not sure' ? 'selected' : ''; ?>>Other / not sure</option>
                    </select>
                    <span class="err"><?php echo $errors['service'] ?? ''; ?></span>
                </div>

                <div class="field-row">
                    <div class="field" id="f-name">
                        <label for="name">Your name <span class="req">*</span></label>
                        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($form_data['name']); ?>" placeholder="John Smith">
                        <span class="err"><?php echo $errors['name'] ?? ''; ?></span>
                    </div>
                    <div class="field" id="f-phone">
                        <label for="phone">Phone <span class="req">*</span></label>
                        <input type="tel" name="phone" id="phone" value="<?php echo htmlspecialchars($form_data['phone']); ?>" placeholder="04XX XXX XXX">
                        <span class="err"><?php echo $errors['phone'] ?? ''; ?></span>
                    </div>
                </div>

                <div class="field" id="f-email">
                    <label for="email">Email <span class="req">*</span></label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($form_data['email']); ?>" placeholder="you@example.com">
                    <span class="err"><?php echo $errors['email'] ?? ''; ?></span>
                </div>

                <div class="field-row">
                    <div class="field" id="f-date">
                        <label for="date">Preferred date</label>
                        <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($form_data['date']); ?>" min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="field" id="f-time">
                        <label for="time">Preferred time</label>
                        <select name="time" id="time">
                            <option value="">Any time</option>
                            <option value="Morning (9am–12pm)" <?php echo $form_data['time'] === 'Morning (9am–12pm)' ? 'selected' : ''; ?>>Morning (9am–12pm)</option>
                            <option value="Afternoon (12pm–3pm)" <?php echo $form_data['time'] === 'Afternoon (12pm–3pm)' ? 'selected' : ''; ?>>Afternoon (12pm–3pm)</option>
                            <option value="Late afternoon (3pm–5pm)" <?php echo $form_data['time'] === 'Late afternoon (3pm–5pm)' ? 'selected' : ''; ?>>Late afternoon (3pm–5pm)</option>
                            <option value="ASAP / emergency" <?php echo $form_data['time'] === 'ASAP / emergency' ? 'selected' : ''; ?>>ASAP / emergency</option>
                        </select>
                    </div>
                </div>

                <div class="field" id="f-address">
                    <label for="address">Your address <span class="req">*</span></label>
                    <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($form_data['address']); ?>" placeholder="Street, suburb — we come to you">
                    <span class="err"><?php echo $errors['address'] ?? ''; ?></span>
                </div>

                <div class="field" id="f-description">
                    <label for="description">What's happening? <span class="req">*</span></label>
                    <textarea name="description" id="description" placeholder="e.g. Laptop won't turn on, no lights, was working fine yesterday. It's a Dell Inspiron 15."><?php echo htmlspecialchars($form_data['description']); ?></textarea>
                    <span class="err"><?php echo $errors['description'] ?? ''; ?></span>
                </div>

                <div class="submit-row">
                    <button type="submit" id="submitBtn">📅 Book my repair</button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
</div></main>

<!-- Footer (minimal — matches header) -->
<footer class="site-footer"><div class="wrap">
  <div class="fb" style="border-top:0;padding-top:0"><span>&copy; <?php echo date('Y'); ?> <?php echo RT::e(RT::NAME); ?>.</span><span><a href="/privacy-policy/">Privacy</a> &middot; <a href="/terms-of-service/">Terms</a></span></div>
</div></footer>

<script src="<?php echo RT::asset('js/main.js'); ?>?v=<?php echo filemtime(RT::path('js/main.js')); ?>" defer></script>
<script>
(function(){
    var form = document.getElementById('bookForm');
    if (!form) return;

    function showErr(fieldId, msg) {
        var el = document.getElementById(fieldId);
        if (el) { el.classList.add('has-error'); el.querySelector('.err').textContent = msg; }
    }
    function clearErr(fieldId) {
        var el = document.getElementById(fieldId);
        if (el) { el.classList.remove('has-error'); el.querySelector('.err').textContent = ''; }
    }

    form.addEventListener('submit', function(e) {
        var valid = true;
        var firstErr = null;
        var banner = document.getElementById('formBanner');

        ['f-service','f-name','f-phone','f-email','f-address','f-description'].forEach(clearErr);
        if (banner) { banner.classList.remove('show'); banner.textContent = ''; }

        var service = document.getElementById('service').value;
        var name = document.getElementById('name').value.trim();
        var phone = document.getElementById('phone').value.trim();
        var email = document.getElementById('email').value.trim();
        var address = document.getElementById('address').value.trim();
        var description = document.getElementById('description').value.trim();

        if (!service) { showErr('f-service', 'Please choose a service.'); if (!firstErr) firstErr = 'f-service'; valid = false; }
        if (name.length < 2) { showErr('f-name', 'Please enter your name.'); if (!firstErr) firstErr = 'f-name'; valid = false; }
        if (phone.length < 8) { showErr('f-phone', 'Valid phone number required.'); if (!firstErr) firstErr = 'f-phone'; valid = false; }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showErr('f-email', 'Valid email required.'); if (!firstErr) firstErr = 'f-email'; valid = false; }
        if (address.length < 5) { showErr('f-address', 'Please enter your address.'); if (!firstErr) firstErr = 'f-address'; valid = false; }
        if (description.length < 10) { showErr('f-description', 'Tell us a bit more (at least 10 characters).'); if (!firstErr) firstErr = 'f-description'; valid = false; }

        if (!valid) {
            e.preventDefault();
            if (banner) { banner.textContent = 'Please fix the errors below before submitting.'; banner.classList.add('show'); }
            if (firstErr) { var el = document.getElementById(firstErr); if (el) el.scrollIntoView({behavior:'smooth',block:'center'}); }
            return;
        }

        var btn = document.getElementById('submitBtn');
        if (btn) { btn.disabled = true; btn.textContent = 'Submitting…'; }
    });

    var dateInput = document.getElementById('date');
    if (dateInput) {
        var today = new Date();
        var yyyy = today.getFullYear();
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var dd = String(today.getDate()).padStart(2, '0');
        dateInput.min = yyyy + '-' + mm + '-' + dd;
    }

    <?php if (!empty($errors)): ?>
    var banner = document.getElementById('formBanner');
    if (banner) { banner.textContent = 'Please fix the errors below.'; banner.classList.add('show'); }
    <?php endif; ?>
})();
</script>
</body>
</html>
