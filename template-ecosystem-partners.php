<?php
declare(strict_types=1);

/**
 * Template Name: Ecosystem Partners
 * Template Post Type: page
 * Description: Sovereign v4.0 Verified AI, FastMCP, Official Music Distribution & Sister-Empire Ecosystem Partners Hub (/ecosystem-partners/)
 * Version: 4.0.0
 *
 * Preserves 100% of live WordPress post_content partner backlink cards injected by
 * WP1_blog_publisher and safe_backlink_autoconnector.py while keeping /ecosystem-partners/
 * strictly air-gapped from Keystone Possibilities' civil/engineering roster.
 *
 * @package KeystoneRecompositionChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Resolve live WP page post_content so dynamic partner backlink cards are 100% preserved.
$raw_partner_html = '';
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		ob_start();
		the_content();
		$raw_partner_html .= (string) ob_get_clean();
	}
} else {
	$eco_page = get_page_by_path( 'ecosystem-partners', OBJECT, 'page' );
	if ( $eco_page instanceof WP_Post && '' !== trim( (string) $eco_page->post_content ) ) {
		$raw_partner_html = (string) apply_filters( 'the_content', (string) $eco_page->post_content );
	}
}

// Demote any legacy inner <h1> inside stored post_content to <h2> so the page maintains a single canonical H1,
// while preserving 100% of anchor backlinks, rel attributes, data-partner-domain hooks, and container comments.
if ( '' !== $raw_partner_html ) {
	$raw_partner_html = (string) preg_replace(
		array( '/<h1(\b[^>]*)>/i', '/<\/h1>/i' ),
		array( '<h2$1>', '</h2>' ),
		$raw_partner_html
	);
}

$has_live_partner_cards = ( false !== strpos( $raw_partner_html, 'kp-partner-card' ) || false !== strpos( $raw_partner_html, 'data-partner-domain=' ) );
$fallback_cards_html    = function_exists( 'keystone_recomp_build_ecosystem_partner_cards_markup' )
	? keystone_recomp_build_ecosystem_partner_cards_markup()
	: '';
?>

<style id="kr-v4-ecosystem-partners-css">
.keystone-ecosystem-partners-page {
	background: radial-gradient(circle at 18% 8%, rgba(56, 189, 248, 0.08) 0%, transparent 45%),
	            radial-gradient(circle at 84% 14%, rgba(212, 175, 55, 0.09) 0%, transparent 48%),
	            #04070d;
	color: #f8fafc;
	overflow-x: clip;
	padding: clamp(2.25rem, 4vw, 3.75rem) 0 clamp(3.5rem, 6vw, 5rem);
}
.kr-eco-shell {
	width: min(100%, 1220px);
	margin: 0 auto;
	padding: 0 clamp(1rem, 3vw, 1.75rem);
	box-sizing: border-box;
}
.kr-eco-split-hero {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(min(100%, 340px), 1fr));
	gap: clamp(1.5rem, 3vw, 2.5rem);
	align-items: stretch;
	background: linear-gradient(145deg, rgba(4, 7, 13, 0.96) 0%, rgba(0, 0, 0, 0.94) 100%);
	border: 1px solid rgba(212, 175, 55, 0.34);
	border-radius: 20px;
	padding: clamp(1.5rem, 3.5vw, 2.75rem);
	box-shadow: 0 22px 54px rgba(0, 0, 0, 0.68), inset 0 1px 0 rgba(56, 189, 248, 0.16);
	margin-bottom: clamp(2rem, 4vw, 3rem);
}
.kr-eco-hero-copy {
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	gap: 1.15rem;
}
.kr-eco-kicker-pill {
	display: inline-flex;
	align-items: center;
	gap: 0.55rem;
	align-self: flex-start;
	padding: 0.42rem 0.95rem;
	border-radius: 9999px;
	background: #000000;
	border: 1px solid rgba(56, 189, 248, 0.48);
	font-family: 'JetBrains Mono', monospace;
	font-size: 0.72rem;
	font-weight: 700;
	letter-spacing: 0.1em;
	text-transform: uppercase;
	color: #38bdf8;
}
.kr-eco-hero-title {
	margin: 0;
	font-family: 'Outfit', 'Inter', sans-serif;
	font-size: clamp(1.95rem, 3.8vw, 3rem);
	font-weight: 800;
	line-height: 1.14;
	letter-spacing: -0.02em;
	color: #ffffff;
}
.kr-eco-hero-lead {
	margin: 0;
	font-size: clamp(0.98rem, 1.35vw, 1.08rem);
	line-height: 1.7;
	color: #cbd5e1;
}
.kr-eco-cta-row {
	display: flex;
	flex-wrap: wrap;
	gap: 0.85rem;
	padding-top: 0.35rem;
}
.kr-eco-pill-btn {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	gap: 0.5rem;
	min-height: 46px;
	padding: 0.7rem 1.4rem;
	border-radius: 9999px;
	font-family: 'Outfit', 'Inter', sans-serif;
	font-size: 0.82rem;
	font-weight: 800;
	letter-spacing: 0.06em;
	text-transform: uppercase;
	text-decoration: none !important;
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.kr-eco-pill-btn:hover {
	transform: translateY(-2px);
}
.kr-eco-pill-gold {
	background: linear-gradient(135deg, #d4af37 0%, #f6d365 100%);
	color: #04070d !important;
	border: 1px solid #f6d365;
	box-shadow: 0 10px 26px rgba(212, 175, 55, 0.28);
}
.kr-eco-pill-cyan {
	background: #000000;
	color: #38bdf8 !important;
	border: 1px solid rgba(56, 189, 248, 0.55);
	box-shadow: 0 10px 26px rgba(0, 206, 209, 0.16);
}
.kr-eco-telemetry-panel {
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	gap: 1rem;
	background: #000000;
	border: 1px solid rgba(56, 189, 248, 0.32);
	border-radius: 18px;
	padding: clamp(1.25rem, 2.5vw, 1.75rem);
}
.kr-eco-stat-grid {
	display: grid;
	grid-template-columns: repeat(2, minmax(0, 1fr));
	gap: 0.85rem;
}
.kr-eco-stat-tile {
	background: rgba(4, 7, 13, 0.92);
	border: 1px solid rgba(212, 175, 55, 0.26);
	border-radius: 14px;
	padding: 0.9rem 1rem;
}
.kr-eco-stat-val {
	display: block;
	font-family: 'Outfit', sans-serif;
	font-size: 1.32rem;
	font-weight: 800;
	color: #f6d365;
	line-height: 1.2;
}
.kr-eco-stat-val.is-cyan {
	color: #38bdf8;
}
.kr-eco-stat-lbl {
	display: block;
	margin-top: 0.25rem;
	font-family: 'JetBrains Mono', monospace;
	font-size: 0.68rem;
	letter-spacing: 0.06em;
	text-transform: uppercase;
	color: #94a3b8;
}
.kr-eco-section-head {
	margin-bottom: 1.5rem;
}
.kr-eco-section-head h2 {
	margin: 0.45rem 0 0.55rem;
	font-family: 'Outfit', 'Inter', sans-serif;
	font-size: clamp(1.45rem, 2.6vw, 2.05rem);
	font-weight: 800;
	color: #ffffff;
}
.kr-eco-section-head p {
	margin: 0;
	color: #cbd5e1;
	font-size: 0.96rem;
	line-height: 1.65;
	max-width: 820px;
}
.kr-eco-live-content-shell {
	margin-bottom: clamp(2.25rem, 4vw, 3.25rem);
}
.kr-eco-live-content-shell .kp-partner-card {
	max-width: 100%;
	box-sizing: border-box;
	word-break: break-word;
}
.kr-eco-sister-bridge {
	background: linear-gradient(135deg, #000000 0%, #04070d 100%);
	border: 1px solid rgba(212, 175, 55, 0.48);
	border-radius: 20px;
	padding: clamp(1.5rem, 3vw, 2.35rem);
	margin-bottom: clamp(2.25rem, 4vw, 3.25rem);
	box-shadow: 0 18px 46px rgba(0, 0, 0, 0.62);
}
.kr-eco-sister-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(min(100%, 300px), 1fr));
	gap: 1.5rem;
	align-items: center;
}
.kr-eco-inquiry-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(min(100%, 290px), 1fr));
	gap: 1.25rem;
	margin-bottom: 1.5rem;
}
.kr-eco-inquiry-card {
	background: rgba(0, 0, 0, 0.88);
	border: 1px solid rgba(56, 189, 248, 0.28);
	border-radius: 18px;
	padding: 1.5rem;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	gap: 0.9rem;
}
.kr-eco-inquiry-card.is-gold {
	border-color: rgba(212, 175, 55, 0.36);
}
.kr-eco-inquiry-card h3 {
	margin: 0;
	font-family: 'Outfit', sans-serif;
	font-size: 1.18rem;
	font-weight: 800;
	color: #ffffff;
}
.kr-eco-inquiry-card p {
	margin: 0;
	font-size: 0.92rem;
	line-height: 1.65;
	color: #cbd5e1;
}
@media (max-width: 640px) {
	.kr-eco-stat-grid {
		grid-template-columns: 1fr;
	}
	.kr-eco-pill-btn {
		width: 100%;
	}
}
</style>

<div id="primary" class="content-area primary keystone-ecosystem-partners-page">
	<main id="main" class="site-main">
		<div class="kr-eco-shell">

			<!-- 1. SOVEREIGN v4.0 SPLIT-HERO -->
			<header class="kr-eco-split-hero" aria-label="Verified Ecosystem Partners Split Hero">
				<div class="kr-eco-hero-copy">
					<div>
						<div class="kr-eco-kicker-pill">
							<span>// VERIFIED ECOSYSTEM REGISTRY &bull; AI, FASTMCP &amp; SONIC SYNDICATION</span>
						</div>
						<h1 class="kr-eco-hero-title" style="margin-top: 0.95rem;">
							Verified <span class="cyan-gold-gradient-text">Ecosystem Partners</span> &amp; Protocol Registry
						</h1>
					</div>

					<p class="kr-eco-hero-lead">
						Curated by founder and principal systems architect <strong>Wayne Stevenson</strong>, this Sovereign v4.0 directory indexes the open Model Context Protocol (FastMCP) standards, frontier inference platforms, canonical MusicBrainz &amp; DSP distribution authorities, and verified digital partner publications connected to <strong>Keystone Recomposition</strong>.
					</p>

					<div class="kr-eco-cta-row">
						<a href="#verified-partner-directory" class="kr-eco-pill-btn kr-eco-pill-gold">
							<span>Inspect Verified Registry &darr;</span>
						</a>
						<a href="<?php echo esc_url( home_url( '/contact/?interest=sync-partner#inquiry-form' ) ); ?>" class="kr-eco-pill-btn kr-eco-pill-cyan">
							<span>Sync, Creator &amp; Press Inquiry &rarr;</span>
						</a>
					</div>
				</div>

				<aside class="kr-eco-telemetry-panel" aria-label="Ecosystem Provenance Telemetry">
					<div style="display:flex; justify-content:space-between; align-items:center; gap:0.75rem; flex-wrap:wrap;">
						<span style="font-family:'JetBrains Mono',monospace; font-size:0.72rem; font-weight:700; letter-spacing:0.1em; color:#d4af37; text-transform:uppercase;">SOVEREIGN ENTITY MESH</span>
						<span style="font-family:'JetBrains Mono',monospace; font-size:0.68rem; color:#00ced1; text-transform:uppercase;">DOMAIN AIR-GAP ACTIVE</span>
					</div>

					<div class="kr-eco-stat-grid">
						<div class="kr-eco-stat-tile">
							<span class="kr-eco-stat-val is-cyan">FastMCP</span>
							<span class="kr-eco-stat-lbl">Open Tool &amp; Agent Spec</span>
						</div>
						<div class="kr-eco-stat-tile">
							<span class="kr-eco-stat-val">25 Releases</span>
							<span class="kr-eco-stat-lbl">246 ISRC Master Tracks</span>
						</div>
						<div class="kr-eco-stat-tile">
							<span class="kr-eco-stat-val">MusicBrainz</span>
							<span class="kr-eco-stat-lbl">Verified Label &amp; Artist MBID</span>
						</div>
						<div class="kr-eco-stat-tile">
							<span class="kr-eco-stat-val is-cyan">#52603</span>
							<span class="kr-eco-stat-lbl">Sister BC Builder Licence</span>
						</div>
					</div>

					<div style="border-top:1px solid rgba(255,255,255,0.09); padding-top:0.85rem; font-size:0.84rem; line-height:1.55; color:#94a3b8;">
						Looking for physical BC custom estate &amp; civil construction? Visit our sister operating company:
						<a href="https://keystonepossibilities.ca/" target="_blank" rel="noopener" style="color:#f6d365; font-weight:700; text-decoration:none; border-bottom:1px solid rgba(246,211,101,0.45);">Keystone Possibilities Ltd. (keystonepossibilities.ca) &#8599;</a>
					</div>
				</aside>
			</header>

			<!-- 2. LIVE WORDPRESS PARTNER CARDS & VERIFIED ECOSYSTEM DIRECTORY -->
			<section id="verified-partner-directory" class="kr-eco-live-content-shell" aria-label="Verified Digital, AI, and Music Ecosystem Partners">
				<div class="kr-eco-section-head">
					<span class="kr-eco-kicker-pill" style="border-color:rgba(212,175,55,0.45); color:#f6d365;">
						<span>01 // VERIFIED PROTOCOL, EDITORIAL &amp; DSP ROSTER</span>
					</span>
					<h2>Accredited AI, FastMCP &amp; Sonic Distribution Nodes</h2>
					<p>
						Every external authority indexed below powers or syndicates verified technical infrastructure, open metadata, or digital editorial collaboration across the Keystone Recomposition ecosystem.
					</p>
				</div>

				<?php if ( '' !== trim( $raw_partner_html ) ) : ?>
					<div class="kr-eco-wp-post-content">
						<?php echo $raw_partner_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Rendered through WordPress the_content filter to preserve verified partner backlink cards. ?>
					</div>
				<?php endif; ?>

				<?php if ( ! $has_live_partner_cards && '' !== $fallback_cards_html ) : ?>
					<div class="kr-eco-fallback-partner-cards">
						<!-- KEYSTONE_PARTNER_CARDS_CONTAINER_START -->
						<?php echo $fallback_cards_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped inside keystone_recomp_build_ecosystem_partner_cards_markup(). ?>
						<!-- KEYSTONE_PARTNER_CARDS_CONTAINER_END -->
					</div>
				<?php endif; ?>
			</section>

			<!-- 3. CLICKABLE SISTER-EMPIRE BRIDGE CARD (KEYSTONE POSSIBILITIES LTD.) -->
			<section id="sister-empire-bridge" class="kr-eco-sister-bridge" aria-label="Sister Empire Physical Construction Bridge">
				<div class="kr-eco-sister-grid">
					<div>
						<span class="kr-eco-kicker-pill" style="border-color:rgba(212,175,55,0.5); color:#d4af37; margin-bottom:0.85rem;">
							<span>02 // SISTER SOVEREIGN OPERATING CORPORATION</span>
						</span>
						<h2 style="margin:0 0 0.65rem; font-family:'Outfit',sans-serif; font-size:clamp(1.35rem,2.4vw,1.85rem); font-weight:800; color:#ffffff;">
							Keystone Possibilities Ltd. &mdash; <span style="color:#f6d365;">BC Housing Builder #52603 &amp; ES54 Civil</span>
						</h2>
						<p style="margin:0; font-size:0.95rem; line-height:1.68; color:#cbd5e1;">
							While <strong>Keystone Recomposition</strong> governs digital multi-agent software, Tauri v2 desktop workstations, and our 25-release Sonic Universe, physical residential custom estates, Bill 44 multiplexes, and BC Hydro ES54 civil utility infrastructure across Squamish, Whistler, West Vancouver, and Vancouver Island are executed exclusively by <strong>Keystone Possibilities Ltd.</strong>
						</p>
					</div>

					<div style="display:flex; flex-direction:column; gap:0.8rem;">
						<a href="https://keystonepossibilities.ca/" target="_blank" rel="noopener" class="kr-eco-pill-btn kr-eco-pill-gold">
							<span>Visit KeystonePossibilities.ca &#8599;</span>
						</a>
						<a href="https://keystonepossibilities.ca/feasibility-plan/" target="_blank" rel="noopener" class="kr-eco-pill-btn kr-eco-pill-cyan">
							<span>48-Hr BC Lot Feasibility Desk &#8599;</span>
						</a>
					</div>
				</div>
			</section>

			<!-- 4. SYNC LICENSING, CREATOR SYNDICATION & TECHNICAL PRESS INQUIRY DESK -->
			<section id="partner-inquiry" aria-label="Sync, Creator, and Press Partnership Inquiry">
				<div class="kr-eco-section-head">
					<span class="kr-eco-kicker-pill">
						<span>03 // PARTNER, SYNC &amp; PRESS GATEWAY</span>
					</span>
					<h2>Initiate a Sync, Creator, or Technical Editorial Partnership</h2>
					<p>
						We collaborate selectively with software publications, MCP tool authors, film &amp; commercial sync supervisors, and verified digital engineering platforms.
					</p>
				</div>

				<div class="kr-eco-inquiry-grid">
					<article class="kr-eco-inquiry-card is-gold">
						<div>
							<span style="font-family:'JetBrains Mono',monospace; font-size:0.7rem; font-weight:700; color:#f6d365; letter-spacing:0.08em; text-transform:uppercase;">432HZ MASTER CLEARANCE</span>
							<h3 style="margin-top:0.45rem;">Commercial Music Sync Licensing</h3>
							<p style="margin-top:0.55rem;">
								100% direct one-stop master and publishing ownership across 25 official releases and 246 ISRC-registered tracks for film, luxury architectural reels, and brand media.
							</p>
						</div>
						<a href="<?php echo esc_url( home_url( '/contact/?interest=sync-partner#inquiry-form' ) ); ?>" class="kr-eco-pill-btn kr-eco-pill-gold">
							<span>Request Sync Clearance &rarr;</span>
						</a>
					</article>

					<article class="kr-eco-inquiry-card">
						<div>
							<span style="font-family:'JetBrains Mono',monospace; font-size:0.7rem; font-weight:700; color:#38bdf8; letter-spacing:0.08em; text-transform:uppercase;">OPEN PROTOCOL ECOSYSTEM</span>
							<h3 style="margin-top:0.45rem;">FastMCP &amp; AI Creator Collaboration</h3>
							<p style="margin-top:0.55rem;">
								Co-authored benchmarks, typed MCP server integrations, and architectural exchanges with developer tooling teams and sovereign AI workstation builders.
							</p>
						</div>
						<a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="kr-eco-pill-btn kr-eco-pill-cyan">
							<span>Explore AI Protocols Vault &rarr;</span>
						</a>
					</article>

					<article class="kr-eco-inquiry-card is-gold">
						<div>
							<span style="font-family:'JetBrains Mono',monospace; font-size:0.7rem; font-weight:700; color:#f6d365; letter-spacing:0.08em; text-transform:uppercase;">DIRECT PRINCIPAL DESK</span>
							<h3 style="margin-top:0.45rem;">Press, Podcasts &amp; Editorial Attribution</h3>
							<p style="margin-top:0.55rem;">
								Direct executive routing to <strong>Wayne Stevenson</strong> for technical interviews, podcast features, and verified reciprocal ecosystem citations.
							</p>
						</div>
						<a href="mailto:keystonerecomposition@gmail.com?subject=Ecosystem%20Partner%20%2F%20Sync%20%2F%20Press%20Inquiry%20%E2%80%94%20Keystone%20Recomposition" class="kr-eco-pill-btn kr-eco-pill-cyan">
							<span>Email Principal Desk &#8599;</span>
						</a>
					</article>
				</div>
			</section>

		</div>
	</main>
</div>

<?php
get_footer();
