# Google Search Console & Analytics Setup Guide

Complete guide for setting up Google Search Console and Analytics for rapidtechsolutions.au

---

## 🎯 Part 1: Google Search Console Setup

Google Search Console helps you monitor how Google sees your website and improves your SEO rankings.

### Step 1: Access Google Search Console

1. **Go to:** https://search.google.com/search-console
2. **Sign in** with your Google account (use your business Gmail)
3. Click **"Add Property"**

### Step 2: Add Your Website

**Choose Property Type:**
- Select **"URL prefix"**
- Enter: `https://rapidtechsolutions.au`
- Click **Continue**

### Step 3: Verify Ownership

**Method 1: HTML File Upload (Easiest)**
1. Download the verification HTML file Google gives you
2. Upload to: `/public_html/` (root directory, NOT theme folder)
3. Click **Verify**

**Method 2: HTML Tag (Alternative)**
1. Copy the meta tag Google provides
2. Add to `<head>` section of all pages
3. Click **Verify**

**Note:** Your theme already has a Google verification file at:
- Check if: `googleb3b26a1af649c954.html` exists in theme root
- If yes, copy it to `/public_html/googleb3b26a1af649c954.html`

---

## 📊 Part 2: Submit Your Sitemap

**CRITICAL:** This tells Google about all 74 pages on your site!

### Step 1: After Verification

1. In Search Console, click **Sitemaps** (left sidebar)
2. Click **"Add a new sitemap"**

### Step 2: Submit Sitemap URL

**Enter this EXACT URL:**
```
https://rapidtechsolutions.au/sitemap.xml
```

Click **Submit**

### Step 3: Verify Sitemap

**What you should see:**
- Status: **Success** ✅
- Discovered URLs: **74** (not 57, not any other number)
- Type: XML sitemap

**If it shows fewer than 74:**
- Your sitemap.xml file wasn't uploaded correctly
- Clear browser cache and check: https://rapidtechsolutions.au/sitemap.xml
- Should list all 74 pages

---

## 📈 Part 3: Google Analytics 4 (GA4) Setup

Your website already has GA4 tracking code installed: **G-BDN34WT3J6**

### Step 1: Verify Analytics is Working

1. **Go to:** https://analytics.google.com
2. **Sign in** with your Google account
3. Look for property: **Rapid Tech Solutions** or **G-BDN34WT3J6**

### Step 2: Test Real-Time Tracking

1. In GA4, go to **Reports** → **Realtime**
2. Open your website in a new tab: https://rapidtechsolutions.au
3. Navigate around (click Blog, FAQ, location pages)
4. **You should see yourself** in the Realtime report!

**If you don't see any data:**
- Analytics might not be set up yet (need to create property)
- Or tracking code not firing (check browser console for errors)

### Step 3: Create GA4 Property (If Not Set Up)

**If you don't have a GA4 property yet:**

1. Go to: https://analytics.google.com
2. Click **Admin** (bottom left gear icon)
3. Click **Create Property**
4. Enter details:
   - Property name: `Rapid Tech Solutions`
   - Timezone: `Australia/Melbourne`
   - Currency: `Australian Dollar (AUD)`
5. Click **Next**
6. Choose business details (select your industry)
7. Click **Create**

**Get your Measurement ID:**
- Should be: `G-BDN34WT3J6` (already in your theme)
- If different, you'll need to update the theme

---

## 🔗 Part 4: Link Search Console to Analytics

This gives you better insights!

### Steps:

1. In **Google Search Console**, click **Settings** (bottom left)
2. Scroll to **Associations**
3. Click **Associate** under Google Analytics
4. Select your GA4 property (G-BDN34WT3J6)
5. Click **Associate**

**Benefits:**
- See search queries in Analytics
- Better understanding of user behavior
- Combined reporting

---

## 🎯 Part 5: Request Indexing (Speed Up SEO)

Don't wait for Google to find your pages - tell them now!

### For Priority Pages (Do These First):

1. In Search Console, click **URL Inspection** (top)
2. Enter URL (without https://):
   - `rapidtechsolutions.au/`
   - `rapidtechsolutions.au/computer-repairs-cranbourne/`
   - `rapidtechsolutions.au/computer-repairs-frankston/`
   - `rapidtechsolutions.au/service-computer-repairs/`
   - `rapidtechsolutions.au/blog/`
   - `rapidtechsolutions.au/faq/`

3. Click **Request Indexing** for each
4. Wait for confirmation

**Priority Order:**
1. Homepage (/)
2. Top 5 suburb pages (your main service areas)
3. Main service pages
4. Blog index
5. FAQ page

**Note:** You can only request ~10-20 URLs per day. Google will discover the rest from your sitemap.

---

## 📊 Part 6: Set Up Important Reports

### In Google Analytics:

**1. Set Up Goals/Conversions:**
- Go to: **Admin** → **Events**
- Mark important events as conversions:
  - Phone clicks
  - Contact form submissions
  - Email clicks

**2. Create Custom Reports:**
- **Most Visited Service Areas:** See which suburbs get most traffic
- **Blog Performance:** Track which articles drive traffic
- **Conversion Paths:** See how users find you before converting

### In Search Console:

**Monitor These Reports Weekly:**

1. **Performance Report**
   - Shows: Clicks, impressions, CTR, position
   - Filter by: Page, Query, Country
   - **Action:** Find pages ranking 8-20, optimize them to rank 1-5

2. **Coverage Report**
   - Shows: Which pages are indexed
   - **Action:** Fix any errors (404s, redirects, etc.)

3. **Mobile Usability**
   - Shows: Mobile-specific issues
   - **Action:** Fix any reported issues

4. **Core Web Vitals**
   - Shows: Page speed metrics
   - **Action:** Monitor LCP, FID, CLS scores

---

## 🚀 Part 7: Optimization Tips

### Week 1-2: Foundation

- [ ] Submit sitemap to Search Console
- [ ] Verify all 74 pages are discovered
- [ ] Request indexing for top 10 priority pages
- [ ] Verify Analytics tracking is working
- [ ] Set up conversion tracking (phone clicks, form submissions)

### Week 3-4: Monitoring

- [ ] Check Search Console daily for errors
- [ ] Monitor which keywords you're ranking for
- [ ] Check Analytics weekly for traffic patterns
- [ ] Identify top-performing pages
- [ ] Find pages with high bounce rate (improve content)

### Monthly: Optimization

- [ ] Review Search Performance report
- [ ] Identify keywords ranking 8-20 (opportunity to improve)
- [ ] Add more content to low-performing pages
- [ ] Create new blog posts based on search queries
- [ ] Check for broken links or 404 errors

---

## 🎯 Part 8: Local SEO Boost (Critical for You!)

### Set Up Google Business Profile

**Why:** You're a local business - this is ESSENTIAL!

1. **Go to:** https://business.google.com
2. **Create/Claim your business listing**
3. **Enter details:**
   - Business name: Rapid Tech Solutions
   - Category: Computer Repair Service
   - Location: Cranbourne South, VIC 3977
   - Phone: 0423 680 596
   - Website: https://rapidtechsolutions.au
   - Hours: Mon-Fri 9am-5pm

4. **Verify your business** (Google will mail a postcard with code)

5. **Add to your website:**
   - Link to Google Business Profile from footer
   - Add "Review Us" links

### Link Search Console to Google Business Profile

1. In Search Console → **Settings** → **Associations**
2. Link to your Google Business Profile
3. Get local search insights!

---

## 📈 Part 9: Track These Key Metrics

### Search Console (Weekly):

- **Total Clicks:** How many people visit from Google
- **Average Position:** Where you rank (aim for position 1-5)
- **Click-Through Rate (CTR):** Should be 3-10% for most keywords
- **Impressions:** How often you appear in search

**Your Goals:**
- Month 1: Get indexed (all 74 pages)
- Month 2: Rank for "computer repair [suburb]"
- Month 3: Appear in top 5 for main keywords
- Month 6: Rank #1 for local service keywords

### Analytics (Weekly):

- **Users:** How many unique visitors
- **Sessions:** How many visits total
- **Bounce Rate:** Should be <60% (lower is better)
- **Average Session Duration:** Should be 2+ minutes
- **Pages per Session:** Should be 2+ pages

**Your Goals:**
- Month 1: 50-100 organic visitors
- Month 3: 200-500 organic visitors
- Month 6: 500-1000 organic visitors
- Month 12: 1000-2000 organic visitors

---

## 🔍 Part 10: Troubleshooting

### Problem: Sitemap shows 0 pages

**Solution:**
1. Check: https://rapidtechsolutions.au/sitemap.xml directly
2. Should see XML with 74 `<url>` entries
3. If not, re-upload sitemap.xml to theme folder
4. Wait 24 hours, resubmit to Search Console

### Problem: Pages not indexed after 2 weeks

**Solution:**
1. Check Coverage report for errors
2. Ensure robots.txt isn't blocking Google
3. Check: https://rapidtechsolutions.au/robots.txt
4. Should allow Googlebot
5. Request indexing manually for those pages

### Problem: Analytics showing 0 users

**Solution:**
1. Open browser console (F12)
2. Visit your site
3. Look for errors with "gtag" or "analytics"
4. Check if tracking code is firing
5. Use Google Tag Assistant Chrome extension to verify

### Problem: Search Console verification failed

**Solution:**
1. Ensure HTML file is in `/public_html/` (root, not theme folder)
2. OR use DNS verification (add TXT record to domain)
3. OR add meta tag to all pages' `<head>` section

---

## ✅ Initial Setup Checklist

Complete these in order:

### Day 1: Setup
- [ ] Add property to Google Search Console
- [ ] Verify ownership (HTML file or meta tag)
- [ ] Submit sitemap (https://rapidtechsolutions.au/sitemap.xml)
- [ ] Verify sitemap shows 74 pages
- [ ] Check Analytics is tracking (G-BDN34WT3J6)

### Day 2-3: Configuration
- [ ] Link Search Console to Analytics
- [ ] Request indexing for homepage
- [ ] Request indexing for top 5 suburb pages
- [ ] Request indexing for main service pages
- [ ] Set up Google Business Profile

### Week 1: Monitoring
- [ ] Check Search Console Coverage report (all pages indexed?)
- [ ] Check Analytics Realtime (tracking working?)
- [ ] Review first search queries appearing
- [ ] Check for any errors in Search Console
- [ ] Monitor Core Web Vitals

### Week 2: Optimization
- [ ] Identify top-performing pages
- [ ] Find keywords ranking 8-20 (opportunity!)
- [ ] Add more content to low-performing pages
- [ ] Create 1-2 new blog posts
- [ ] Check mobile usability report

---

## 📞 Quick Reference Links

**Google Search Console:**
https://search.google.com/search-console

**Google Analytics:**
https://analytics.google.com

**Your Sitemap:**
https://rapidtechsolutions.au/sitemap.xml

**Google Business Profile:**
https://business.google.com

**Google Tag Assistant (Chrome Extension):**
https://chrome.google.com/webstore - search "Tag Assistant"

---

## 🎯 Expected Timeline

**Week 1:**
- Sitemap submitted ✅
- Verification complete ✅
- 5-10 pages indexed

**Week 2-4:**
- 30-50 pages indexed
- First search impressions appear
- 10-50 organic visitors

**Month 2:**
- All 74 pages indexed
- 50-100 organic visitors
- Ranking for some long-tail keywords

**Month 3:**
- 100-300 organic visitors
- Ranking in top 10 for local keywords
- Starting to appear in Maps

**Month 6:**
- 300-800 organic visitors
- Top 5 rankings for main keywords
- Regular leads from organic search

---

## 💡 Pro Tips

1. **Update sitemap monthly** if you add new pages
2. **Check Search Console weekly** - fix errors immediately
3. **Monitor Analytics daily** for first month to understand patterns
4. **Respond to Google Business reviews** - boosts local SEO
5. **Create 1-2 blog posts monthly** - keeps content fresh
6. **Target long-tail keywords** first (easier to rank)
7. **Focus on local keywords** - you're a local business!

---

## 🚨 Common Mistakes to Avoid

❌ **Don't** use same content on multiple pages (duplicate content)
❌ **Don't** stuff keywords unnaturally (Google penalizes this)
❌ **Don't** ignore Search Console errors (fix them ASAP)
❌ **Don't** change URLs without redirects (breaks SEO)
❌ **Don't** block Google in robots.txt (check it's allowing crawl)

✅ **Do** update content regularly
✅ **Do** fix errors within 48 hours
✅ **Do** create unique content for each page
✅ **Do** monitor analytics weekly
✅ **Do** request reviews from happy customers

---

**Last Updated:** 2025-11-19
**Your Tracking ID:** G-BDN34WT3J6
**Total Pages:** 74
**Sitemap URL:** https://rapidtechsolutions.au/sitemap.xml
