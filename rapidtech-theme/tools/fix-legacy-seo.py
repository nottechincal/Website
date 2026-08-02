#!/usr/bin/env python3
"""Sitewide SEO pass over the legacy (non-generated) page templates."""
import re
import pathlib
import subprocess

ORIGIN = 'https://www.rapidtechsolutions.au'

# title (<=60, keyword first) and description (120-160 chars).
# Several descriptions were wrong rather than merely long: the data-recovery
# and network-setup pages both described virus removal.
META = {
 'about': (
   'About Rapid Tech Solutions | Local IT Support Melbourne',
   'Meet the team behind Rapid Tech Solutions. Local, honest computer repairs and IT support based in Cranbourne South, serving Melbourne\'s south-east.'),
 'blog': (
   'Computer Tips & IT Guides | Rapid Tech Solutions',
   'Free computer tips, security guides and IT how-tos for Melbourne households and small businesses. Practical advice from working technicians.'),
 'blog-cloud-services': (
   'Cloud Services for Small Business: The Benefits',
   'How cloud services cut costs, improve security and make remote work practical for small businesses. A plain-English guide from Melbourne IT technicians.'),
 'blog-computer-maintenance': (
   'Computer Maintenance Tips to Avoid Costly Repairs',
   'Simple monthly maintenance that keeps a computer fast and prevents expensive repairs later. Written for Melbourne families and small businesses.'),
 'blog-hardware-upgrades': (
   'Why Regular Hardware Upgrades Matter',
   'When to upgrade rather than replace, which parts give the biggest speed gain, and how an SSD or memory upgrade can add years to an ageing computer.'),
 'blog-home-network': (
   'How to Optimise Your Home Network and Wi-Fi',
   'Practical steps to improve home Wi-Fi speed and coverage: router placement, channel selection, mesh systems and security settings that actually matter.'),
 'blog-password-security': (
   'Password Security: Protect Your Online Accounts',
   'How to build strong passwords, use a password manager properly, and turn on two-factor authentication. Straightforward security advice for families.'),
 'blog-scam-protection': (
   'How to Spot and Avoid Tech Support Scams',
   'Recognise fake tech support calls, phishing emails and remote-access scams targeting Australians, and know exactly what to do if you have been caught.'),
 'data-recovery-frankston': (
   'Data Recovery Frankston | Same-Day Service',
   'Professional data recovery in Frankston 3199. Failed hard drives, dead SSDs, deleted files and corrupted storage. Free assessment, no recovery no fee.'),
 'data-recovery-patterson-lakes': (
   'Data Recovery Patterson Lakes | Same-Day Service',
   'Professional data recovery in Patterson Lakes 3197. Failed drives, dead SSDs, deleted files and corrupted storage recovered. Free assessment, no fix no fee.'),
 'emergency-computer-repair-melbourne': (
   'Emergency Computer Repair Melbourne | Same-Day',
   'Urgent computer repairs across Melbourne\'s south-east. Same-day onsite callouts for crashed systems, dead machines and business outages. Call 0423 680 596.'),
 'faq': (
   'Computer Repair FAQ | Rapid Tech Solutions',
   'Straight answers on pricing, callout times, service areas, warranties and data security for computer repairs across Melbourne\'s south-east.'),
 'index': (
   'Computer Repairs & IT Support Melbourne | Same-Day',
   'Same-day computer repairs, virus removal, data recovery and Wi-Fi fixes across Melbourne\'s south-east. We come to you. No fix, no fee. Call 0423 680 596.'),
 'network-setup-berwick': (
   'Network & Wi-Fi Setup Berwick | Same-Day Service',
   'Wi-Fi and network setup in Berwick 3806. Fix dead zones, install mesh systems, sort out NBN connections and business networks. Same-day onsite service.'),
 'privacy-policy': (
   'Privacy Policy | Rapid Tech Solutions',
   'How Rapid Tech Solutions collects, uses, stores and protects your personal information, and how to request access to or deletion of your data.'),
 'service-areas': (
   'Service Areas | Computer Repairs Melbourne South-East',
   'Every suburb we cover for computer repairs and IT support, from Cranbourne and Berwick through to Frankston, Chelsea and Mordialloc. Same-day callouts.'),
 'service-computer-repairs': (
   'Computer Repairs Melbourne | No Fix, No Fee',
   'Laptop, desktop and Mac repairs across Melbourne\'s south-east. Free diagnostics, same-day service and a 30-day warranty. No fix, no fee. Call 0423 680 596.'),
 'service-data-recovery': (
   'Data Recovery Melbourne | Lost Files Retrieved',
   'Recover deleted files, failed hard drives, dead SSDs and corrupted storage. Free assessment before any work, and no charge if the data cannot be recovered.'),
 'service-network-wifi': (
   'Network & Wi-Fi Solutions Melbourne | Fix Slow Wi-Fi',
   'Fix slow or patchy Wi-Fi, extend coverage with mesh systems, sort NBN faults and set up business networks across Melbourne\'s south-east. Same-day service.'),
 'service-virus-removal': (
   'Virus & Malware Removal Melbourne | Same-Day',
   'Complete virus, spyware and ransomware removal with protection set up afterwards so it does not come back. Same-day service across Melbourne\'s south-east.'),
 'terms-of-service': (
   'Terms of Service | Rapid Tech Solutions',
   'The terms covering Rapid Tech Solutions IT support and computer repair services, including quotes, warranties, liability and payment conditions.'),
 'virus-removal-cranbourne': (
   'Virus Removal Cranbourne | Same-Day Cleanup',
   'Complete virus, spyware and ransomware removal in Cranbourne 3977. Same-day service, full system clean-up and protection set up afterwards. No fix, no fee.'),
 'virus-removal-dandenong': (
   'Virus Removal Dandenong | Same-Day Cleanup',
   'Complete virus, spyware and ransomware removal in Dandenong 3175. Same-day service, full system clean-up and protection set up afterwards. No fix, no fee.'),
}

# Canonical path per page, and pages that must not be indexed.
NOINDEX = {'404', 'thank-you', 'contactthanks', 'paymentpage'}
NOINDEX_META = {
 '404': ('Page Not Found | Rapid Tech Solutions',
         'That page could not be found. Browse our computer repair services or call 0423 680 596 for help.'),
 'thank-you': ('Thank You | Rapid Tech Solutions',
         'Thanks for getting in touch. We will respond within one business hour during opening hours.'),
 'contactthanks': ('Thank You | Rapid Tech Solutions',
         'Thanks for getting in touch. We will respond within one business hour during opening hours.'),
 'paymentpage': ('Payments Currently Unavailable | Rapid Tech Solutions',
         'Online payments are temporarily unavailable. Please call 0423 680 596 to arrange payment.'),
}

TEMPLATE_NAMES = {
 'about': 'About', 'blog': 'Blog Index', 'faq': 'FAQ',
 'service-areas': 'Service Areas', 'privacy-policy': 'Privacy Policy',
 'terms-of-service': 'Terms of Service', 'thank-you': 'Thank You',
 '404': '404 Not Found', 'index': 'Home',
}

# Suburb slugs consolidated away — internal links must not point at a 301.
redirects = {}
out = subprocess.run(
    ['php', '-r', 'require "inc/locations.php"; foreach(rt_location_redirects() as $k=>$v) echo "$k\t$v\n";'],
    capture_output=True, text=True, cwd='.').stdout
for line in out.splitlines():
    if '\t' in line:
        k, v = line.split('\t', 1)
        redirects[k] = v

report = []

for path in sorted(pathlib.Path('.').glob('*.php')):
    slug = path.stem
    if slug in redirects or slug.startswith('computer-repairs-'):
        continue

    s = original = path.read_text(encoding='utf-8', errors='replace')
    changes = []

    # --- title + description -------------------------------------------
    meta = META.get(slug) or NOINDEX_META.get(slug)
    if meta and '<?php' not in (re.search(r'<title[^>]*>(.*?)</title>', s, re.S).group(1) if re.search(r'<title', s) else ''):
        title, desc = meta
        if re.search(r'<title[^>]*>.*?</title>', s, re.S):
            s = re.sub(r'<title[^>]*>.*?</title>', f'<title>{title}</title>', s, count=1, flags=re.S)
            changes.append('title')
        if re.search(r'<meta\s+name=["\']description["\'][^>]*>', s, re.I):
            s = re.sub(r'<meta\s+name=["\']description["\'][^>]*>',
                       f'<meta name="description" content="{desc}">', s, count=1, flags=re.I)
            changes.append('description')
        elif '</title>' in s:
            s = s.replace('</title>', f'</title>\n    <meta name="description" content="{desc}">', 1)
            changes.append('description+')

    # --- keywords meta: ignored by Google since 2009, reads as spam ------
    n = len(re.findall(r'<meta\s+name=["\']keywords["\'][^>]*>\s*', s, re.I))
    if n:
        s = re.sub(r'\s*<meta\s+name=["\']keywords["\'][^>]*>', '', s, flags=re.I)
        changes.append('-keywords')

    # --- canonical: must match the trailing-slash URL actually served ----
    def canon_fix(m):
        url = m.group(1)
        p = url.replace(ORIGIN, '').split('#')[0] or '/'
        if p != '/' and not re.search(r'\.[a-z0-9]{2,4}$', p):
            p = p.rstrip('/') + '/'
        return f'<link rel="canonical" href="{ORIGIN}{p}">'

    if re.search(r'<link\s+rel=["\']canonical["\']\s+href=["\']([^"\']+)["\']\s*/?>', s, re.I):
        new = re.sub(r'<link\s+rel=["\']canonical["\']\s+href=["\']([^"\']+)["\']\s*/?>',
                     canon_fix, s, count=1, flags=re.I)
        if new != s:
            s = new
            changes.append('canonical')
    elif slug not in ('footer', 'functions', 'book', 'bookingengine', 'contactengine') and '</title>' in s:
        p = '/' if slug == 'index' else f'/{slug}/'
        s = s.replace('</title>', f'</title>\n    <link rel="canonical" href="{ORIGIN}{p}">', 1)
        changes.append('canonical+')

    # --- robots ---------------------------------------------------------
    if slug in NOINDEX:
        if re.search(r'<meta\s+name=["\']robots["\'][^>]*>', s, re.I):
            s = re.sub(r'<meta\s+name=["\']robots["\'][^>]*>',
                       '<meta name="robots" content="noindex, follow">', s, count=1, flags=re.I)
        elif '</title>' in s:
            s = s.replace('</title>', '</title>\n    <meta name="robots" content="noindex, follow">', 1)
        changes.append('noindex')
    elif re.search(r'<meta\s+name=["\']robots["\']\s+content=["\']index,\s*follow["\']', s, re.I):
        s = re.sub(r'<meta\s+name=["\']robots["\']\s+content=["\']index,\s*follow["\']\s*/?>',
                   '<meta name="robots" content="index, follow, max-image-preview:large, '
                   'max-snippet:-1, max-video-preview:-1">', s, count=1, flags=re.I)
        changes.append('robots+')

    # --- og:image: the wp-content path does not exist ---------------------
    if '/wp-content/themes/rapidtech-theme/images/og-image' in s:
        s = s.replace('/wp-content/themes/rapidtech-theme/images/og-image', '/images/og-image')
        changes.append('og:image')

    # --- internal links pointing at consolidated pages --------------------
    hops = 0
    for old, new in redirects.items():
        for pat in (f'"/{old}"', f'"/{old}/"', f'"/{old}.php"',
                    f'"{ORIGIN}/{old}"', f'"{ORIGIN}/{old}/"'):
            if pat in s:
                hops += s.count(pat)
                s = s.replace(pat, f'"{new}"')
    if hops:
        changes.append(f'-{hops} stale links')

    # --- Template Name so the page is assignable in WordPress ------------
    if 'Template Name:' not in s and slug in TEMPLATE_NAMES:
        if s.lstrip().startswith('<?php'):
            s = re.sub(r'^(\s*<\?php)', r'\1\n/*\nTemplate Name: ' + TEMPLATE_NAMES[slug] + '\n*/', s, count=1)
        else:
            s = f'<?php\n/*\nTemplate Name: {TEMPLATE_NAMES[slug]}\n*/\n?>\n' + s
        changes.append('Template Name')

    if s != original:
        path.write_text(s, encoding='utf-8')
        report.append((str(path), changes))

print(f"{len(report)} files updated\n")
for f, c in report:
    print(f"  {f:<42} {', '.join(c)}")
