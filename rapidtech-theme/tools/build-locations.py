#!/usr/bin/env python3
"""Generate inc/locations.php.

Consolidates 35 near-duplicate `computer-repairs-*` pages and 14 `postcode-*`
pages into 10 substantial suburb pages. Absorbed suburbs become real sections
on their primary page, so long-tail coverage is kept while the doorway-page
pattern goes away.

Local prose for the five primaries that had a postcode page is reused verbatim
from that page (it was the genuinely suburb-specific writing on the site).
"""
import json
import pathlib
import re

# Source prose harvested from the original postcode-*.php templates before they
# were consolidated. Committed to the repo so this build is reproducible — it
# previously read from a scratch path that only existed in one session.
_DATA = pathlib.Path(__file__).parent / 'data' / 'postcode-source.json'

harvest = {c['postcode']: c for c in json.loads(_DATA.read_text(encoding='utf-8'))}


def prose(postcode):
    """Reuse the hand-written local content from a postcode page."""
    return harvest[postcode]['unique_content'].strip()


NEIGHBOURS = {'cranbourne': ['narre-warren', 'berwick', 'dandenong', 'carrum-downs'], 'berwick': ['narre-warren', 'cranbourne', 'dandenong'], 'narre-warren': ['berwick', 'cranbourne', 'dandenong'], 'dandenong': ['narre-warren', 'cranbourne', 'mordialloc', 'chelsea'], 'frankston': ['seaford', 'carrum-downs', 'patterson-lakes'], 'carrum-downs': ['seaford', 'frankston', 'patterson-lakes', 'cranbourne'], 'seaford': ['carrum-downs', 'frankston', 'patterson-lakes', 'chelsea'], 'patterson-lakes': ['chelsea', 'seaford', 'carrum-downs', 'mordialloc'], 'chelsea': ['patterson-lakes', 'mordialloc', 'seaford'], 'mordialloc': ['chelsea', 'patterson-lakes', 'dandenong']}

# slug -> page data. `absorbs` drives both the 301 map and the on-page sections.
PRIMARIES = {
    'cranbourne': dict(
        suburb='Cranbourne', postcode='3977', lat='-38.0996', lng='145.2834',
        population='21,000', distance='5',
        landmarks=['Cranbourne Park Shopping Centre', 'Royal Botanic Gardens Cranbourne',
                   'Casey Fields', 'Cranbourne Racecourse', 'Cranbourne Station'],
        covers=['Clyde', 'Clyde North', 'Botanic Ridge', 'Junction Village',
                'Devon Meadows', 'Lynbrook', 'Lyndhurst', 'Sandhurst'],
        issues=['home office setups', 'small business networks',
                'new-estate NBN connections', 'gaming PC builds'],
        blurb=('Same-day computer repairs and IT support across Cranbourne 3977 and the '
               'surrounding growth corridor. We are based here, so callouts are fast.'),
        absorbs=['cranbourne-east', 'cranbourne-north', 'cranbourne-west', 'botanic-ridge',
                 'junction-village', 'devon-meadows', 'sandhurst', 'clyde', 'clyde-north',
                 'lynbrook', 'lyndhurst'],
        body='''
<h2>Your Local Computer Repair Team in Cranbourne</h2>
<p>Rapid Tech Solutions is based in Cranbourne South, which makes Cranbourne and the
surrounding 3977 postcode our home ground. Most callouts here are reached within
fifteen minutes, and the majority of jobs are completed the same day. We work with
households, home offices and small businesses right across the area &mdash; from the
established streets near Cranbourne Park Shopping Centre to the newer estates pushing
south toward Botanic Ridge.</p>

<h3>Computer Repairs for Cranbourne&rsquo;s Growth Corridor</h3>
<p>Cranbourne has grown quickly, and a lot of that growth is new housing. New estates
bring a specific set of technology problems: NBN connections that were provisioned before
anyone moved in, Wi-Fi that cannot cover a double-storey house on a narrow block, and
home offices set up in a hurry. We handle all of it &mdash; connection troubleshooting,
mesh Wi-Fi that actually reaches the back bedroom, and workstation setups that hold up to
a full working week.</p>

<h3>Clyde, Clyde North and Botanic Ridge</h3>
<p>The estates through Clyde, Clyde North and Botanic Ridge are some of the fastest-growing
in Victoria, and they are all within our standard callout range. If you have just moved in
and your internet has never worked properly, or the builder&rsquo;s data cabling was never
finished off, that is a job we do regularly.</p>

<h3>Junction Village, Devon Meadows and Sandhurst</h3>
<p>These smaller pockets around Cranbourne are easy to overlook, and larger repair chains
often will not travel to them. We do. Whether it is a slow family desktop in Junction
Village, a rural-block Wi-Fi problem in Devon Meadows, or a home office in Sandhurst, the
callout rate is the same as anywhere else in 3977.</p>

<h3>Lynbrook and Lyndhurst</h3>
<p>Lynbrook and Lyndhurst sit between Cranbourne and Dandenong, and we cover both as part
of our regular run. Common jobs here are laptop screen replacements, virus and malware
clean-ups, and upgrading older machines to SSDs to get a few more years out of them.</p>
'''),

    'berwick': dict(
        suburb='Berwick', postcode='3806', lat='-38.0333', lng='145.3453',
        population='50,000', distance='12',
        landmarks=['Berwick Village', 'Eden Rise Village', 'Federation University Berwick',
                   'Casey Hospital', 'Wilson Botanic Park'],
        covers=['Beaconsfield', 'Officer', 'Narre Warren', 'Harkaway', 'Clyde North'],
        issues=['professional home offices', 'medical practice IT',
                'student laptop repairs', 'small business servers'],
        blurb=('Computer repairs and IT support throughout Berwick 3806. Same-day onsite '
               'service for homes, home offices and local businesses.'),
        absorbs=[],
        body='''
<h2>Computer Repairs and IT Support in Berwick</h2>
<p>Berwick is one of the larger centres in Melbourne&rsquo;s south-east, and the mix of
work here reflects that. Alongside ordinary household repairs we do a lot of home-office
and small-business work &mdash; the sort of setups where a day of downtime actually costs
something. We carry common replacement parts, so laptop screens, drives and memory can
usually be sorted in a single visit.</p>

<h3>Home Offices and Professional Services</h3>
<p>Berwick has a high proportion of residents working from home or running a practice from
a consulting suite. That means reliable backups, secure remote access and a network that
does not drop out mid-call. We set up and maintain all three, and we will document what we
have done so you are not dependent on us to understand your own system.</p>

<h3>Students and Family Machines</h3>
<p>With Federation University&rsquo;s Berwick campus and a large number of schools in the
area, student laptops are a steady part of our work. Cracked screens, failed batteries,
liquid damage and machines that have simply slowed to a crawl are all routine. Where a
repair is not economic we will tell you that rather than quote for it.</p>

<h3>Wilson Botanic Park to Eden Rise</h3>
<p>Berwick&rsquo;s older streets around the Village and Wilson Botanic Park often have
solid brick construction that Wi-Fi struggles with, while the newer estates out toward
Eden Rise have the opposite problem &mdash; large floor plans on small blocks. Both need a
different approach to coverage, and a single router in the study rarely solves either.</p>
'''),

    'narre-warren': dict(
        suburb='Narre Warren', postcode='3805', lat='-38.0264', lng='145.3050',
        population='28,000', distance='14',
        landmarks=['Westfield Fountain Gate', 'Bunjil Place', 'Casey Central',
                   'Narre Warren Station', 'Sweeney Reserve'],
        covers=['Narre Warren South', 'Hampton Park', 'Fountain Gate', 'Berwick', 'Hallam'],
        issues=['retail point-of-sale systems', 'family computer repairs',
                'small business networks', 'Wi-Fi blackspots'],
        blurb=('Fast computer repairs across Narre Warren 3805, Narre Warren South and '
               'Hampton Park. Onsite and workshop service available.'),
        absorbs=['narre-warren-south', 'hampton-park'],
        body='''
<h2>Computer Repairs in Narre Warren</h2>
<p>Narre Warren is a busy commercial centre as much as a residential one, and Westfield
Fountain Gate anchors a large amount of local retail and small business. We work on both
sides of that &mdash; family desktops and laptops during the day, and business systems
outside trading hours where downtime matters.</p>

<h3>Narre Warren South</h3>
<p>Narre Warren South is largely newer housing on generous blocks, and the single most
common call we get from the area is Wi-Fi that will not reach the far end of the house.
A mesh system properly placed usually fixes it permanently; adding a cheap extender
usually does not, and we will say so.</p>

<h3>Hampton Park</h3>
<p>Hampton Park sits between Narre Warren and Dandenong and is well within our regular
run. Typical work here is virus and malware removal, slow-machine diagnostics, and getting
older computers running usefully again with an SSD and a memory upgrade rather than
replacing them outright.</p>

<h3>Business Support Around Fountain Gate</h3>
<p>Retail and hospitality around Fountain Gate and Casey Central depend on point-of-sale
systems, card terminals and a network that stays up through the busiest part of the day.
We handle network design, failover connections and the kind of preventative maintenance
that stops a trading day being lost.</p>
'''),

    'dandenong': dict(
        suburb='Dandenong', postcode='3175', lat='-37.9877', lng='145.2145',
        population='30,000', distance='15',
        landmarks=['Dandenong Market', 'Dandenong Plaza', 'Drum Theatre',
                   'Dandenong Station', 'Greater Dandenong Council Offices'],
        covers=['Noble Park', 'Keysborough', 'Springvale', 'Dandenong North', 'Bangholme'],
        issues=['manufacturing and warehouse IT', 'retail systems',
                'multilingual support', 'small business networks'],
        blurb=('Computer repairs and business IT support in Dandenong 3175, Noble Park, '
               'Keysborough and Springvale. Same-day onsite service.'),
        absorbs=['noble-park', 'keysborough', 'springvale'],
        body=prose('3175') + '''
<h3>Noble Park</h3>
<p>Noble Park is a short run from Dandenong and we cover it on the same callout schedule.
The housing stock is a mix of established homes and newer townhouses, and the most common
jobs are network setups, virus removal and recovering data from drives that have started
to fail.</p>

<h3>Keysborough</h3>
<p>Keysborough combines large residential estates with a substantial industrial and
warehousing area along the Eastlink corridor. That means two very different kinds of work:
home Wi-Fi and family machines on one side, and business networks, shared storage and
backup systems on the other. We do both.</p>

<h3>Springvale</h3>
<p>Springvale has a dense retail strip and a large number of small owner-operated
businesses. Point-of-sale reliability, secure card processing and simple, dependable
backups matter more here than anything elaborate, and that is what we set up.</p>
'''),

    'frankston': dict(
        suburb='Frankston', postcode='3199', lat='-38.1431', lng='145.1228',
        population='36,000', distance='12',
        landmarks=['Frankston Pier', 'Bayside Shopping Centre', 'Frankston Hospital',
                   'Frankston Arts Centre', 'Frankston Waterfront'],
        covers=['Frankston South', 'Frankston North', 'Langwarrin', 'Karingal', 'Pearcedale'],
        issues=['healthcare practice IT', 'retail systems',
                'professional services', 'home offices'],
        blurb=('Computer repairs and IT support across Frankston 3199, Frankston North, '
               'Langwarrin and Pearcedale. Same-day onsite service available.'),
        absorbs=['langwarrin', 'pearcedale'],
        body=prose('3199') + '''
<h3>Frankston North</h3>
<p>Frankston North is covered on the same terms as the rest of Frankston, with no
additional callout charge. Most work here is straightforward repair and clean-up
&mdash; slow machines, malware, failing drives and getting older hardware running well
enough to be worth keeping.</p>

<h3>Langwarrin</h3>
<p>Langwarrin&rsquo;s larger blocks and single-storey homes spread out further than a
standard router will cover, and it is one of the more common places we install mesh Wi-Fi.
We also do a steady amount of home-office work here for people commuting into Frankston or
working remotely.</p>

<h3>Pearcedale</h3>
<p>Pearcedale is semi-rural and often falls outside the range other technicians will
travel. It does not fall outside ours. Rural-block internet, satellite and fixed-wireless
troubleshooting, and long-run cabling between house and shed are all regular jobs.</p>
'''),

    'carrum-downs': dict(
        suburb='Carrum Downs', postcode='3201', lat='-38.0908', lng='145.1707',
        population='23,000', distance='10',
        landmarks=['Carrum Downs Shopping Centre', 'Ballam Park', 'Carrum Downs Industrial Estate',
                   'Peninsula Link', 'Banyan Fields'],
        covers=['Skye', 'Seaford', 'Frankston North', 'Langwarrin', 'Sandhurst'],
        issues=['warehouse and light industrial IT', 'home offices',
                'small business networks', 'point-of-sale systems'],
        blurb=('Computer repairs and business IT support in Carrum Downs 3201 and Skye. '
               'Onsite service for homes and the local industrial estate.'),
        absorbs=['skye'],
        body=prose('3201') + '''
<h3>Skye</h3>
<p>Skye sits directly alongside Carrum Downs and is covered on the same callout run. It is
mostly newer residential estates, and the recurring issues are the ones that come with new
builds &mdash; NBN connections that were never properly commissioned, patchy Wi-Fi across
a two-storey floor plan, and home offices that need to work reliably from day one.</p>
'''),

    'seaford': dict(
        suburb='Seaford', postcode='3198', lat='-38.1044', lng='145.1290',
        population='17,000', distance='9',
        landmarks=['Seaford Beach', 'Seaford Wetlands', 'Seaford Station',
                   'Nepean Highway shops', 'Belvedere Reserve'],
        covers=['Carrum', 'Frankston North', 'Carrum Downs', 'Bonbeach', 'Patterson Lakes'],
        issues=['coastal corrosion on hardware', 'home offices',
                'small business networks', 'Wi-Fi coverage'],
        blurb=('Computer repairs and IT support in Seaford 3198. Same-day onsite service '
               'for homes and businesses along the bayside strip.'),
        absorbs=[],
        body=prose('3198')),

    'patterson-lakes': dict(
        suburb='Patterson Lakes', postcode='3197', lat='-38.0714', lng='145.1310',
        population='8,000', distance='8',
        landmarks=['Patterson Lakes Marina', 'Patterson River', 'Thompson Road shops',
                   'Carrum Station', 'Launching Way'],
        covers=['Carrum', 'Bonbeach', 'Chelsea', 'Seaford', 'Bangholme'],
        issues=['waterfront property Wi-Fi', 'home offices',
                'marine business IT', 'network coverage across large blocks'],
        blurb=('Computer repairs and IT support in Patterson Lakes 3197, Carrum and '
               'Bonbeach. Onsite service across the waterway estates.'),
        absorbs=['carrum', 'bonbeach'],
        body='''
<h2>Computer Repairs in Patterson Lakes</h2>
<p>Patterson Lakes is built around its waterways, and that geography creates network
problems you do not see elsewhere. Homes are often long and narrow, frequently
double-storey, and many have a separate studio, boatshed or garage across the property that
still needs to be on the network. A single router in the living room does not cover it.</p>

<h3>Waterfront and Marina Properties</h3>
<p>Properties along the canals and around the marina regularly need coverage extended out
to a jetty, deck or detached workspace. We install mesh systems and, where the run is too
long for wireless, we cable it properly. Salt air is also hard on hardware &mdash;
connectors corrode and fans clog faster here than a few kilometres inland &mdash; so
preventative cleaning is worth more in this area than most.</p>

<h3>Carrum</h3>
<p>Carrum sits just across the river and is covered on the same callout run. Work here is a
mix of family machines, holiday-home setups and small businesses along the Nepean Highway
strip. Station-precinct redevelopment has brought a wave of newer apartments, which come
with their own set of connection and coverage questions.</p>

<h3>Bonbeach</h3>
<p>Bonbeach is a narrow strip between the railway line and the beach, largely established
housing with a growing number of townhouses. Typical jobs are Wi-Fi coverage, virus and
malware clean-ups, data recovery from failing drives, and getting older desktops usefully
fast again rather than replacing them.</p>
'''),

    'chelsea': dict(
        suburb='Chelsea', postcode='3196', lat='-38.0522', lng='145.1178',
        population='7,500', distance='12',
        landmarks=['Chelsea Beach', 'Chelsea Station', 'Station Street shops',
                   'Bicentennial Park', 'Chelsea RSL'],
        covers=['Chelsea Heights', 'Edithvale', 'Aspendale', 'Bonbeach', 'Carrum'],
        issues=['coastal humidity and hardware', 'home offices',
                'retail point-of-sale', 'Wi-Fi coverage in older homes'],
        blurb=('Computer repairs and IT support in Chelsea 3196, Chelsea Heights, '
               'Edithvale and Aspendale. Same-day onsite service for homes and businesses.'),
        absorbs=['chelsea-heights', 'edithvale', 'aspendale'],
        body='''
<h2>Computer Repairs Along the Chelsea Bayside Strip</h2>
<p>Chelsea and its neighbours are among the older parts of the bayside strip, and the
housing stock shows it &mdash; solid double-brick homes, a lot of renovations, and
increasingly townhouses squeezed onto subdivided blocks. All three make Wi-Fi harder than
the floor area suggests, and it is the single most common reason we get called out here.</p>

<h3>Chelsea Heights</h3>
<p>Chelsea Heights sits back from the water on larger blocks, with a mix of established
family homes and newer builds. Alongside the usual repair work we do a steady amount of
home-office setup here &mdash; proper backups, secure remote access and a network that
holds up to a full day of video calls.</p>

<h3>Edithvale</h3>
<p>Edithvale is a narrow strip between the beach and the wetlands, mostly established
housing. Salt air is a genuine factor: it corrodes connectors and shortens the life of
cooling fans, so machines here benefit from cleaning and inspection more often than
inland. We also handle the usual run of virus removal, drive failures and slow-machine
diagnostics.</p>

<h3>Aspendale</h3>
<p>Aspendale combines beachfront homes with the retail strip along Station Street. We work
with both &mdash; residential repairs and Wi-Fi on one side, and point-of-sale, card
terminals and small business networks on the other.</p>
'''),

    'mordialloc': dict(
        suburb='Mordialloc', postcode='3195', lat='-38.0053', lng='145.0876',
        population='8,000', distance='16',
        landmarks=['Mordialloc Pier', 'Main Street Mordialloc', 'Mordialloc Creek',
                   'Braeside Park', 'Mordialloc Station'],
        covers=['Mentone', 'Aspendale', 'Braeside', 'Cheltenham', 'Beaumaris'],
        issues=['hospitality and retail systems', 'home offices',
                'professional practices', 'Wi-Fi in period homes'],
        blurb=('Computer repairs and IT support in Mordialloc 3195, Mentone, Cheltenham '
               'and Beaumaris. Onsite service for homes and Main Street businesses.'),
        absorbs=['mentone'],
        body=prose('3195') + '''
<h3>Mentone</h3>
<p>Mentone has a large stock of period homes, and solid brick walls are consistently the
reason Wi-Fi underperforms there. Extending coverage properly usually means a mesh system
with a wired backhaul rather than another repeater. We also see a steady stream of laptop
repairs and data recovery from the area&rsquo;s schools and home offices.</p>

<h3>Cheltenham and Beaumaris</h3>
<p>Cheltenham&rsquo;s retail and commercial precinct and Beaumaris&rsquo;s largely
residential streets are both within our regular run. Business work around Cheltenham tends
toward point-of-sale and small office networks; Beaumaris is mostly residential repairs,
Wi-Fi coverage across large blocks, and backup setups for people working from home.</p>
'''),
}

# Absorbed suburbs and postcode pages that 301 elsewhere.
REDIRECTS = {}
for slug, d in PRIMARIES.items():
    for a in d['absorbs']:
        REDIRECTS['computer-repairs-' + a] = '/computer-repairs-' + slug + '/'

REDIRECTS.update({
    'postcode-3173': '/computer-repairs-dandenong/',
    'postcode-3174': '/computer-repairs-dandenong/',
    'postcode-3175': '/computer-repairs-dandenong/',
    'postcode-3192': '/computer-repairs-mordialloc/',
    'postcode-3193': '/computer-repairs-mordialloc/',
    'postcode-3194': '/computer-repairs-mordialloc/',
    'postcode-3195': '/computer-repairs-mordialloc/',
    'postcode-3196': '/computer-repairs-patterson-lakes/',
    'postcode-3198': '/computer-repairs-seaford/',
    'postcode-3199': '/computer-repairs-frankston/',
    'postcode-3200': '/computer-repairs-frankston/',
    'postcode-3201': '/computer-repairs-carrum-downs/',
    # Wantirna and Rowville are ~30km east with no neighbouring primary page.
    'postcode-3152': '/service-areas/',
    'postcode-3178': '/service-areas/',
    'service-area': '/service-areas/',
    'page-privacy': '/privacy-policy/',
})


def php_str(s):
    return "'" + s.replace('\\', '\\\\').replace("'", "\\'") + "'"


def php_list(items, indent):
    pad = ' ' * indent
    return '[\n' + ''.join(f'{pad}    {php_str(i)},\n' for i in items) + pad + ']'


out = ["""<?php
/**
 * Suburb page data.
 *
 * Replaces 35 `computer-repairs-*` templates that were 83% identical to each
 * other (97% at worst) and 14 `postcode-*` pages that duplicated ten of them
 * outright. Google classifies that pattern as doorway pages.
 *
 * Ten primaries remain. Every absorbed suburb is covered as a real section on
 * its primary page and 301s there, so long-tail coverage survives without the
 * thin-content penalty.
 *
 * Generated by tools/build-locations.py — edit the source data there.
 */

/** Primary suburb pages, keyed by URL slug (/computer-repairs-{slug}). */
function rt_locations(): array
{
    return ["""]

for slug, d in PRIMARIES.items():
    out.append(f"        {php_str(slug)} => [")
    out.append(f"            'suburb'      => {php_str(d['suburb'])},")
    out.append(f"            'postcode'    => {php_str(d['postcode'])},")
    out.append(f"            'lat'         => {php_str(d['lat'])},")
    out.append(f"            'lng'         => {php_str(d['lng'])},")
    out.append(f"            'population'  => {php_str(d['population'])},")
    out.append(f"            'distance'    => {php_str(d['distance'])},")
    out.append(f"            'blurb'       => {php_str(' '.join(d['blurb'].split()))},")
    out.append(f"            'landmarks'   => {php_list(d['landmarks'], 12)},")
    out.append(f"            'covers'      => {php_list(d['covers'], 12)},")
    out.append(f"            'neighbours'  => {php_list(NEIGHBOURS[slug], 12)},")
    out.append(f"            'issues'      => {php_list(d['issues'], 12)},")
    out.append(f"            'absorbs'     => {php_list(d['absorbs'], 12)},")
    body = re.sub(r'\n{3,}', '\n\n', d['body'].strip())
    out.append("            'body'        => <<<'HTML'\n" + body + "\nHTML,")
    out.append("        ],")

out.append("""    ];
}

/**
 * 301 map: retired suburb/postcode slug => canonical destination path.
 * Mirrored in the web-root .htaccess so the redirect happens before PHP runs.
 */
function rt_location_redirects(): array
{
    return [""")

for src, dest in sorted(REDIRECTS.items()):
    out.append(f"        {php_str(src)} => {php_str(dest)},")

out.append("""    ];
}

/**
 * Canonical path for a suburb name, following consolidation.
 * Used for internal links so nothing points at a redirected URL.
 */
function rt_location_path(string $suburb): ?string
{
    static $index = null;

    if ($index === null) {
        $index = [];
        foreach (rt_locations() as $slug => $loc) {
            $index[strtolower($loc['suburb'])] = '/computer-repairs-' . $slug . '/';
            foreach ($loc['absorbs'] as $a) {
                $index[str_replace('-', ' ', $a)] = '/computer-repairs-' . $slug . '/';
            }
        }
    }

    return $index[strtolower(trim($suburb))] ?? null;
}""")

out_path = pathlib.Path(__file__).parents[1] / 'inc' / 'locations.php'
# Explicit encoding: without it, Python's default text-mode write falls back
# to the OS codepage. On Windows that is not UTF-8, so the em dashes and
# curly quotes in the suburb prose above were silently corrupted into mojibake
# every time this ran outside Linux/macOS.
out_path.write_text('\n'.join(out) + '\n', encoding='utf-8')

print(f"inc/locations.php written: {len(PRIMARIES)} primaries, {len(REDIRECTS)} redirects")
covered = sum(len(d['absorbs']) for d in PRIMARIES.values())
print(f"suburb pages: 35 -> {len(PRIMARIES)} ({covered} absorbed as on-page sections)")
print(f"postcode pages: 14 -> 0 (all 301'd)")
