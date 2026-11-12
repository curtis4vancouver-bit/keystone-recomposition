<?php
/**
 * Template Name: Keystone AI Protocols
 * Description: Dedicated 3-Tier Monetization ($49.50 AI Brain & Flow, $199 Website & Multi-Agent, $800 Custom Tauri Desktop App Build), Self-Service Course Portal & Guided Setup Assistant
 *
 * @package Keystone Recomposition Child
 * @since 3.8.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$theme_uri    = get_stylesheet_directory_uri();
$kr_visa_live = function_exists( 'keystone_is_stripe_ready' )
	? (bool) keystone_is_stripe_ready()
	: ( defined( 'KEYSTONE_VISA_AND_VIDEOS_LIVE' ) && KEYSTONE_VISA_AND_VIDEOS_LIVE );

$kr_video_fallbacks = array(
	'overview'          => 'u1gUjk9xcB4',
	'tier1_walkthrough' => '-ZYdbPXenCU',
	'tier2_walkthrough' => 'LxbjlX_nh2Q',
	'tier3_walkthrough' => '_bSpYdvm6tc',
);

$kr_t1_vid = function_exists( 'keystone_get_tier_walkthrough_video_id' )
	? trim( (string) keystone_get_tier_walkthrough_video_id( '1' ) )
	: $kr_video_fallbacks['tier1_walkthrough'];
if ( '' === $kr_t1_vid ) {
	$kr_t1_vid = $kr_video_fallbacks['tier1_walkthrough'];
}

$kr_t2_vid = function_exists( 'keystone_get_tier_walkthrough_video_id' )
	? trim( (string) keystone_get_tier_walkthrough_video_id( '2' ) )
	: $kr_video_fallbacks['tier2_walkthrough'];
if ( '' === $kr_t2_vid ) {
	$kr_t2_vid = $kr_video_fallbacks['tier2_walkthrough'];
}

$kr_t3_vid = function_exists( 'keystone_get_tier_walkthrough_video_id' )
	? trim( (string) keystone_get_tier_walkthrough_video_id( '3' ) )
	: $kr_video_fallbacks['tier3_walkthrough'];
if ( '' === $kr_t3_vid ) {
	$kr_t3_vid = $kr_video_fallbacks['tier3_walkthrough'];
}
?>

<!-- JSON-LD Structured Data Schema: 3 Tier Offers in USD for US, CA, GB, AU Builders -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Product",
      "@id": "https://keystonerecomposition.com/ai-protocols/#tier1",
      "name": "Keystone AI Protocols — Tier 01: AI Brain & Google Flow Starter",
      "description": "One-time setup access to 4-folder AI Brain architecture in Google Antigravity, ~20-word Google Flow video prompts, 4 illustrated %PDF-1.7 setup manuals + combined master book, and 7-day guided setup support.",
      "brand": {
        "@type": "Brand",
        "name": "Keystone AI Protocols"
      },
      "offers": {
        "@type": "Offer",
        "price": "49.50",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock",
        "eligibleRegion": ["US", "CA", "GB", "AU"],
        "url": "https://keystonerecomposition.com/ai-protocols/#kr-tier-1",
        "seller": {
          "@type": "Organization",
          "name": "Keystone Possibilities Ltd."
        }
      }
    },
    {
      "@type": "Product",
      "@id": "https://keystonerecomposition.com/ai-protocols/#tier2",
      "name": "Keystone AI Protocols — Tier 02: 6-Agent Role Suite + Multi-Agent Website Architecture",
      "description": "Includes Tier 01 plus the 6-Agent Role Suite + Multi-Agent Architecture, dark-luxury WordPress website engineering, YouTube Brand Channel upload defaults, 3-source research gate, PDFs 01-09, and 7-day guided setup support.",
      "brand": {
        "@type": "Brand",
        "name": "Keystone AI Protocols"
      },
      "offers": {
        "@type": "Offer",
        "price": "199.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock",
        "eligibleRegion": ["US", "CA", "GB", "AU"],
        "url": "https://keystonerecomposition.com/ai-protocols/#kr-tier-2",
        "seller": {
          "@type": "Organization",
          "name": "Keystone Possibilities Ltd."
        }
      }
    },
    {
      "@type": "Product",
      "@id": "https://keystonerecomposition.com/ai-protocols/#tier3",
      "name": "Keystone AI Protocols — Tier 03: Complete Runnable Rust + Tauri v2 Desktop Command Center Source (.EXE)",
      "description": "Complete sovereign tech stack: Tiers 01 & 02 plus the Complete Runnable Rust + Tauri v2 Desktop Command Center Source Project, 1-Command Windows .EXE Compiler, all 12 illustrated %PDF-1.7 manuals, and 14-Day Guided Build Support with architectural review.",
      "brand": {
        "@type": "Brand",
        "name": "Keystone AI Protocols"
      },
      "offers": {
        "@type": "Offer",
        "price": "800.00",
        "priceCurrency": "USD",
        "availability": "https://schema.org/InStock",
        "eligibleRegion": ["US", "CA", "GB", "AU"],
        "url": "https://keystonerecomposition.com/ai-protocols/#kr-tier-3",
        "seller": {
          "@type": "Organization",
          "name": "Keystone Possibilities Ltd."
        }
      }
    }
  ]
}
</script>


<style>
.kr-code-pill {
	display: inline-block;
	background: rgba(56, 189, 248, 0.14);
	border: 1px solid rgba(56, 189, 248, 0.45);
	color: #38bdf8;
	font-family: 'JetBrains Mono', monospace;
	font-size: 0.76em;
	font-weight: 700;
	padding: 1px 7px;
	border-radius: 6px;
	letter-spacing: 0.02em;
}
.kr-code-pill-gold {
	display: inline-block;
	background: rgba(212, 175, 55, 0.15);
	border: 1px solid rgba(212, 175, 55, 0.5);
	color: #f6d365;
	font-family: 'JetBrains Mono', monospace;
	font-size: 0.76em;
	font-weight: 700;
	padding: 1px 7px;
	border-radius: 6px;
}
.kr-portal-tab-btn {
	background: rgba(11, 17, 30, 0.92);
	border: 1px solid rgba(56, 189, 248, 0.32);
	color: #cbd5e1;
	font-family: 'Outfit', sans-serif;
	font-size: 0.78rem;
	font-weight: 800;
	padding: 10px 16px;
	border-radius: 9999px;
	cursor: pointer;
	transition: all 0.2s ease;
	white-space: nowrap;
}
.kr-portal-tab-btn:hover {
	border-color: #38bdf8;
	color: #ffffff;
}
.kr-portal-tab-btn.active {
	background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%);
	border-color: #d4af37;
	color: #04070d !important;
	box-shadow: 0 6px 18px rgba(212, 175, 55, 0.35);
}
.kr-portal-tab-pane {
	display: none;
}
.kr-portal-tab-pane.active {
	display: block;
}
.kr-copy-prompt-box {
	background: #04070d;
	border: 1.5px solid rgba(56, 189, 248, 0.45);
	border-radius: 14px;
	padding: 14px 16px;
	margin: 12px 0;
	position: relative;
}
.kr-copy-prompt-box.gold-border {
	border-color: rgba(212, 175, 55, 0.55);
}
.kr-copy-btn {
	background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%);
	color: #04070d !important;
	border: none;
	border-radius: 9999px;
	padding: 6px 14px;
	font-family: 'Outfit', sans-serif;
	font-size: 0.72rem;
	font-weight: 900;
	cursor: pointer;
	letter-spacing: 0.04em;
}
.kr-brain-diagram-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
	gap: 12px;
	margin: 14px 0;
}
.kr-brain-node {
	background: linear-gradient(145deg, #070c18 0%, #04070d 100%);
	border: 1.5px solid #d4af37;
	border-radius: 14px;
	padding: 14px;
	position: relative;
}
.kr-brain-node.cyan-node {
	border-color: #38bdf8;
}
.kr-copy-prompt-box pre,
#krSpecPdfModal pre,
#kr-self-service-portal pre {
	background: #02050a !important;
	color: #f8fafc !important;
	border: 1px solid rgba(56, 189, 248, 0.35) !important;
	border-radius: 10px !important;
	padding: 12px 14px !important;
	margin: 0 !important;
	font-family: 'JetBrains Mono', monospace !important;
	font-size: 0.78rem !important;
	line-height: 1.55 !important;
	white-space: pre-wrap !important;
}
#krSpecPdfModal code {
	background: rgba(56, 189, 248, 0.14) !important;
	color: #38bdf8 !important;
	padding: 1px 5px !important;
	border-radius: 4px !important;
}
.kr-video-first-strip {
	background: linear-gradient(145deg, #070e1c 0%, #04070d 100%);
	border: 1.5px solid #d4af37;
	border-radius: 18px;
	padding: 20px;
	margin-bottom: 20px;
	box-shadow: 0 14px 36px rgba(0, 0, 0, 0.72);
}
.kr-video-first-strip.cyan-accent {
	border-color: #38bdf8;
}
.kr-video-first-grid {
	display: grid;
	grid-template-columns: 1.15fr 1fr;
	gap: 18px;
	align-items: stretch;
	margin-top: 12px;
}
@media (max-width: 920px) {
	.kr-video-first-grid {
		grid-template-columns: 1fr;
	}
}
.kr-chapter-btn {
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 10px;
	width: 100%;
	text-align: left;
	background: rgba(4, 7, 13, 0.92);
	border: 1px solid rgba(56, 189, 248, 0.35);
	border-radius: 12px;
	padding: 9px 12px;
	color: #f8fafc;
	font-family: 'Outfit', sans-serif;
	font-size: 0.78rem;
	font-weight: 700;
	cursor: pointer;
	transition: all 0.18s ease;
}
.kr-chapter-btn:hover {
	border-color: #d4af37;
	background: rgba(212, 175, 55, 0.12);
	color: #ffffff;
}
.kr-chapter-time {
	background: rgba(212, 175, 55, 0.18);
	border: 1px solid #d4af37;
	color: #f6d365;
	font-family: 'JetBrains Mono', monospace;
	font-size: 0.70rem;
	font-weight: 900;
	padding: 2px 8px;
	border-radius: 9999px;
	white-space: nowrap;
	flex-shrink: 0;
}
.keystone-cyber-protocols .site-main {
	padding-bottom: 96px !important;
}
.kr-hero-chapter-strip {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	gap: 6px;
	padding: 10px 12px;
	background: #04070d;
	border-top: 1px solid rgba(212, 175, 55, 0.32);
	max-width: 100%;
	box-sizing: border-box;
}
.kr-hero-chapter-pill {
	display: inline-flex;
	align-items: center;
	gap: 6px;
	background: rgba(4, 7, 13, 0.96);
	border: 1px solid rgba(56, 189, 248, 0.42);
	border-radius: 9999px;
	padding: 5px 11px;
	color: #f8fafc;
	font-family: 'Outfit', sans-serif;
	font-size: 0.72rem;
	font-weight: 800;
	line-height: 1.2;
	cursor: pointer;
	transition: all 0.18s ease;
	box-sizing: border-box;
}
.kr-hero-chapter-pill:hover,
.kr-hero-chapter-pill.is-active {
	border-color: #d4af37;
	background: rgba(212, 175, 55, 0.16);
	color: #ffffff;
	box-shadow: 0 4px 14px rgba(212, 175, 55, 0.22);
}
.kr-hero-chapter-pill .kr-hero-pill-ts {
	color: #38bdf8;
	font-family: 'JetBrains Mono', monospace;
	font-size: 0.68rem;
	font-weight: 900;
}
.kr-hero-chapter-pill:hover .kr-hero-pill-ts,
.kr-hero-chapter-pill.is-active .kr-hero-pill-ts {
	color: #d4af37;
}
</style>

<div id="primary" class="content-area primary keystone-cyber-protocols">
	<main id="main" class="site-main">

		<!-- 1. LANDING HERO SECTION WITH TOP-RIGHT EXPRESS CHECKOUT & VAULT UID PORTAL -->
		<section class="cyber-hero-section protocols-hero">
			<div class="ast-container">
				<div class="protocols-hero-split">

					<!-- Left Column: High-Conviction Value Positioning -->
					<div class="protocols-hero-left">
						<div class="cyber-telemetry-pill">
							<span class="telemetry-pulse"></span>
							<span class="telemetry-text">// 2026 AI BUILDER SUITE • ONE-TIME SETUP • BRAIN, WEBSITE &amp; TAURI DESKTOP APP</span>
						</div>
						<div class="kr-trust-badge-strip" style="display: inline-flex; align-items: center; gap: 8px; background: rgba(56, 189, 248, 0.12); border: 1px solid #38bdf8; border-radius: 9999px; padding: 5px 14px; margin-bottom: 12px; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800; color: #38bdf8;">
							<span>🇺🇸 ALL PRICES IN USD</span>
							<span style="color: rgba(255,255,255,0.4);">&bull;</span>
							<span style="color: #f6d365;">INSTANT VISA / MASTERCARD DIGITAL CHECKOUT</span>
							<span style="color: rgba(255,255,255,0.4);">&bull;</span>
							<span style="color: #cbd5e1;">US &amp; GLOBAL BUILDER ACCESS</span>
						</div>

						<div class="cyber-founder-chip">
							<img src="<?php echo esc_url( $theme_uri . '/assets/images/wayne_avatar.jpg' ); ?>"
								 alt="Wayne Stevenson — Founder &amp; Architect"
								 class="founder-chip-avatar"
								 data-recalc-dims="0" loading="eager" fetchpriority="high" decoding="async"
								 style="width: 48px; height: 48px; min-width: 48px; min-height: 48px; border-radius: 50%; border: 2px solid #d4af37; object-fit: cover; flex-shrink: 0; display: block;" />
							<div class="founder-chip-meta">
								<span class="chip-name">Wayne Stevenson</span>
								<span class="chip-role">Licensed BC Builder #52603 • AI Systems Architect</span>
							</div>
							<span class="chip-verified-badge">✔ VERIFIED</span>
						</div>

						<h1 class="cyber-hero-title">
							Set Up Your AI Brain, Custom Website &amp; Tauri Desktop App<br/>
							<span class="cyan-gradient-text">Simple One-Time Setup • Recorded Walkthroughs &amp; Guided Setup Support</span>
						</h1>

						<p class="cyber-hero-subtitle">
							A clean, 3-step builder progression where each tier builds directly on the last: start by organizing your <strong>AI Brain &amp; basic Google Flow video workflow</strong> (Tier 01), expand into your <strong>custom dark-luxury website &amp; multi-agent workflows</strong> (Tier 02), and build your own standalone <strong>Tauri Desktop App command center</strong> (Tier 03). Every tier is a <strong>single One-Time Payment</strong> with recorded walkthroughs, step-by-step PDF guides, and a dedicated <strong>Guided Setup Support Window</strong> to get you up and running.
						</p>

						<?php
						$hero_intro_vid = trim( (string) get_option( 'keystone_hero_intro_video_id', 'u1gUjk9xcB4' ) );
						if ( '' === $hero_intro_vid ) {
							$hero_intro_vid = ( defined( 'KEYSTONE_TIER1_PUBLIC_VIDEO_ID' ) && '' !== trim( (string) KEYSTONE_TIER1_PUBLIC_VIDEO_ID ) )
								? trim( (string) KEYSTONE_TIER1_PUBLIC_VIDEO_ID )
								: 'u1gUjk9xcB4';
						}
						$kr_hero_intro_vid = $hero_intro_vid;
						$kr_hero_page_url  = function_exists( 'home_url' ) ? home_url( '/ai-protocols/' ) : 'https://keystonerecomposition.com/ai-protocols/';
						$kr_hero_video_ld  = array(
							'@context'     => 'https://schema.org',
							'@type'        => 'VideoObject',
							'@id'          => $kr_hero_page_url . '#hero-intro-video',
							'name'         => 'Keystone AI Builder Suite — 3-Tier Architecture Overview (Brain, Website & Tauri .EXE)',
							'description'  => 'Founder walkthrough by Wayne Stevenson (Licensed BC Builder #52603) covering the 3-Tier Keystone AI Builder Suite: Sovereign Vault, Tier 01 Brain & Google Flow ($49.50 USD), Tier 02 Dark-Luxury Website & Multi-Agent Workflows ($199 USD), and Tier 03 Custom Tauri Desktop App .EXE ($800 USD).',
							'thumbnailUrl' => array(
								'https://i.ytimg.com/vi/' . $hero_intro_vid . '/maxresdefault.jpg',
								'https://i.ytimg.com/vi/' . $hero_intro_vid . '/hqdefault.jpg',
							),
							'uploadDate'   => '2026-11-01T08:00:00-07:00',
							'duration'     => 'PT2M59S',
							'contentUrl'   => 'https://www.youtube.com/watch?v=' . $hero_intro_vid,
							'embedUrl'     => 'https://www.youtube-nocookie.com/embed/' . $hero_intro_vid,
							'publisher'    => array(
								'@type' => 'Organization',
								'name'  => 'Keystone Recomposition',
								'url'   => function_exists( 'home_url' ) ? home_url( '/' ) : 'https://keystonerecomposition.com/',
							),
							'hasPart'      => array(
								array(
									'@type'       => 'Clip',
									'name'        => 'Suite & Vault Overview',
									'startOffset' => 0,
									'endOffset'   => 40,
									'url'         => 'https://www.youtube.com/watch?v=' . $hero_intro_vid . '&t=0s',
								),
								array(
									'@type'       => 'Clip',
									'name'        => 'Tier 01 — AI Brain & Google Flow ($49.50 USD)',
									'startOffset' => 40,
									'endOffset'   => 80,
									'url'         => 'https://www.youtube.com/watch?v=' . $hero_intro_vid . '&t=40s',
								),
								array(
									'@type'       => 'Clip',
									'name'        => 'Tier 02 — Dark-Luxury Website & Multi-Agent Suite ($199 USD)',
									'startOffset' => 80,
									'endOffset'   => 120,
									'url'         => 'https://www.youtube.com/watch?v=' . $hero_intro_vid . '&t=80s',
								),
								array(
									'@type'       => 'Clip',
									'name'        => 'Tier 03 — Standalone Tauri Desktop App .EXE ($800 USD)',
									'startOffset' => 120,
									'endOffset'   => 179,
									'url'         => 'https://www.youtube.com/watch?v=' . $hero_intro_vid . '&t=120s',
								),
							),
						);
						?>
						<!-- Featured Top-Left Hero Intro & Architecture Overview Video -->
						<div id="krHeroIntroVideoCard" style="background: #04070d; border: 1.5px solid #d4af37; border-radius: 18px; overflow: hidden; margin: 14px 0 16px 0; box-shadow: 0 14px 36px rgba(0, 0, 0, 0.78); max-width: 100%; box-sizing: border-box;">
							<div style="padding: 8px 14px; background: rgba(8, 14, 26, 0.96); border-bottom: 1px solid rgba(212, 175, 55, 0.35); display: flex; align-items: center; justify-content: space-between; gap: 8px; flex-wrap: wrap;">
								<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; letter-spacing: 0.04em;">🎬 START HERE • 3-TIER AI BUILDER SUITE OVERVIEW</span>
								<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 800;">@KeyStoneRecomposition &bull; AI Protocols Suite</span>
							</div>
							<div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; background: #02050a;">
								<iframe id="krHeroIntroIframe"
										src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $hero_intro_vid ); ?>?rel=0&amp;modestbranding=1"
										title="Keystone AI Builder Suite — 3-Tier Architecture Overview"
										style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
										allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
										allowfullscreen loading="eager"></iframe>
							</div>
							<div class="kr-hero-chapter-strip" role="navigation" aria-label="Founder Overview Video Chapters">
								<button type="button" class="kr-hero-chapter-pill is-active" data-start="0" onclick="krSeekHeroIntroVideo('<?php echo esc_js( $hero_intro_vid ); ?>', 0, this)">
									<span class="kr-hero-pill-ts">0:00</span>
									<span>Suite &amp; Vault</span>
								</button>
								<button type="button" class="kr-hero-chapter-pill" data-start="40" onclick="krSeekHeroIntroVideo('<?php echo esc_js( $hero_intro_vid ); ?>', 40, this)">
									<span class="kr-hero-pill-ts">0:40</span>
									<span>Tier 01 ($49.50)</span>
								</button>
								<button type="button" class="kr-hero-chapter-pill" data-start="80" onclick="krSeekHeroIntroVideo('<?php echo esc_js( $hero_intro_vid ); ?>', 80, this)">
									<span class="kr-hero-pill-ts">1:20</span>
									<span>Tier 02 ($199)</span>
								</button>
								<button type="button" class="kr-hero-chapter-pill" data-start="120" onclick="krSeekHeroIntroVideo('<?php echo esc_js( $hero_intro_vid ); ?>', 120, this)">
									<span class="kr-hero-pill-ts">2:00</span>
									<span>Tier 03 ($800 .EXE)</span>
								</button>
							</div>
							<?php if ( '' !== $hero_intro_vid ) : ?>
							<script type="application/ld+json"><?php echo wp_json_encode( $kr_hero_video_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
							<?php endif; ?>
							<script>
							window.krSeekHeroIntroVideo = function(videoId, startSec, btnEl) {
								var iframe = document.getElementById('krHeroIntroIframe');
								if (!iframe || !videoId) return;
								var sec = Math.max(0, parseInt(startSec, 10) || 0);
								iframe.src = 'https://www.youtube-nocookie.com/embed/' + encodeURIComponent(videoId) + '?start=' + sec + '&autoplay=1&rel=0&modestbranding=1';
								if (btnEl && btnEl.parentNode) {
									var pills = btnEl.parentNode.querySelectorAll('.kr-hero-chapter-pill');
									for (var i = 0; i < pills.length; i++) {
										pills[i].classList.remove('is-active');
									}
									btnEl.classList.add('is-active');
								}
							};
							</script>
						</div>

						<!-- Clean 3-Tier Synergy Summary Strip -->
						<div class="hero-tier-summary-grid" style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px; margin: auto 0 0 0; width: 100%; align-items: stretch;">
							<div class="hero-tier-summary-box hero-tier-blue" style="background: #04070d; border: 1.5px solid rgba(56, 189, 248, 0.65); border-radius: 14px; padding: 14px; display: flex; flex-direction: column; justify-content: flex-start; gap: 6px;">
								<div class="summary-tier-tag" style="color: #ffffff; font-family: 'JetBrains Mono', monospace; font-size: 0.64rem; font-weight: 800; letter-spacing: 0.03em; white-space: nowrap;">TIER 01 • $49.50 USD</div>
								<div class="summary-tier-heading" style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.84rem; font-weight: 800; white-space: nowrap;">🧠 Brain &amp; Flow</div>
								<div style="color: #cbd5e1; font-size: 0.74rem; line-height: 1.42;">4-folder AI Brain setup + ~20-word Google Flow video prompts, 4 PDF manuals &amp; 7-day setup support.</div>
							</div>
							<div class="hero-tier-summary-box hero-tier-gold" style="background: #04070d; border: 1.5px solid rgba(212, 175, 55, 0.72); border-radius: 14px; padding: 14px; display: flex; flex-direction: column; justify-content: flex-start; gap: 6px;">
								<div class="summary-tier-tag" style="color: #ffffff; font-family: 'JetBrains Mono', monospace; font-size: 0.64rem; font-weight: 800; letter-spacing: 0.03em; white-space: nowrap;">TIER 02 • $199 USD</div>
								<div class="summary-tier-heading" style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.84rem; font-weight: 800; white-space: nowrap;">🌐 6-Agent + Web</div>
								<div style="color: #cbd5e1; font-size: 0.74rem; line-height: 1.42;">Includes Tier 01 + 6-Agent Role Suite + Multi-Agent Architecture, dark-luxury website &amp; Brand Channel.</div>
							</div>
							<div class="hero-tier-summary-box hero-tier-blue" style="background: #04070d; border: 1.5px solid rgba(56, 189, 248, 0.65); border-radius: 14px; padding: 14px; display: flex; flex-direction: column; justify-content: flex-start; gap: 6px;">
								<div class="summary-tier-tag" style="color: #ffffff; font-family: 'JetBrains Mono', monospace; font-size: 0.64rem; font-weight: 800; letter-spacing: 0.03em; white-space: nowrap;">TIER 03 • $800 USD</div>
								<div class="summary-tier-heading" style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.84rem; font-weight: 800; white-space: nowrap;">🖥️ Tauri v2 Source</div>
								<div style="color: #cbd5e1; font-size: 0.74rem; line-height: 1.42;">Includes Tiers 01 &amp; 02 + Runnable Rust + Tauri v2 Source + 1-Command Windows .EXE Compiler + 14-day support.</div>
							</div>
						</div>
					</div>

					<!-- Right Column: Top-Right Express Checkout & Direct One-Time Setup Access -->
					<div class="protocols-hero-right" style="align-self: start; position: sticky; top: 96px;">
						<div class="express-checkout-card" style="height: auto !important; justify-content: flex-start !important; gap: 16px;">
							<div class="checkout-card-header">
								<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; flex-wrap: wrap; margin-bottom: 8px;">
									<span class="checkout-badge-live">💎 ONE-TIME PAYMENT • GUIDED SETUP • ZERO MONTHLY FEES</span>
									<span id="vaultUidStatusBadge" style="background: #04070d; border: 1.5px solid #38bdf8; color: #ffffff; font-family: 'JetBrains Mono', monospace; font-size: 0.64rem; font-weight: 800; padding: 4px 10px; border-radius: 9999px;">
										💳 VISA / MASTERCARD READY
									</span>
								</div>
								<h3 class="checkout-portal-title">Instant Visa Checkout &amp; 60-Second Vault Delivery</h3>
								<p class="checkout-portal-sub">Choose your tier below to go straight to <strong>256-Bit Stripe USD Checkout</strong> and unlock your <strong>Self-Service Buyer Vault</strong>, unlisted 4K walkthrough videos, starter <code class="kr-code-pill-gold">.ZIP</code> packs, and illustrated <code class="kr-code-pill">%PDF-1.7</code> manuals.</p>
							</div>

							<div class="checkout-tier-selector">
								<label class="checkout-label">Select One-Time Setup Tier:</label>
								<div class="tier-select-grid">
									<button type="button" class="tier-select-btn active" data-tier="1" data-price="49.50" data-name="Tier 01 — $49.50 USD One-Time: AI Brain & Google Flow Starter" data-url="/contact/?inquiry=tier1_blueprint#inquiry-form">
										<span class="btn-tier-num">TIER 01 • ONE-TIME</span>
										<span class="btn-tier-name">Brain &amp; Flow</span>
										<span class="btn-tier-price">$49.50</span>
									</button>
									<button type="button" class="tier-select-btn" data-tier="2" data-price="199" data-name="Tier 02 — $199 USD One-Time: 6-Agent Role Suite + Website Architecture" data-url="/contact/?inquiry=tier2_swarm#inquiry-form">
										<span class="btn-tier-num">TIER 02 • ONE-TIME</span>
										<span class="btn-tier-name">6-Agent &amp; Web</span>
										<span class="btn-tier-price">$199</span>
									</button>
									<button type="button" class="tier-select-btn" data-tier="3" data-price="800" data-name="Tier 03 — $800 USD One-Time: Runnable Rust + Tauri v2 Desktop Source (.EXE)" data-url="/contact/?inquiry=tier3_workstation#inquiry-form">
										<span class="btn-tier-num">TIER 03 • ONE-TIME</span>
										<span class="btn-tier-name">Tauri v2 .EXE</span>
										<span class="btn-tier-price">$800</span>
									</button>
								</div>
							</div>

							<!-- Direct Buyer Details Form (1-Click Stripe Checkout — Optional Pre-Fill) -->
							<form id="heroDirectCheckoutForm" data-keystone-form-ignore="true" style="display: flex; flex-direction: column; gap: 10px; margin-top: 12px;">
								<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
									<div>
										<label for="heroBuyerName" class="checkout-label" style="margin-bottom: 4px; display: block;">Your Name (Optional)</label>
										<input type="text" id="heroBuyerName" placeholder="Optional — or enter on Stripe" autocomplete="name" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.42); border-radius: 10px; color: #f8fafc; font-size: 0.82rem; padding: 9px 11px; box-sizing: border-box;" />
									</div>
									<div>
										<label for="heroBuyerEmail" class="checkout-label" style="margin-bottom: 4px; display: block;">Email for Receipt (Optional)</label>
										<input type="email" id="heroBuyerEmail" placeholder="Optional — or enter on Stripe" autocomplete="email" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.42); border-radius: 10px; color: #f8fafc; font-size: 0.82rem; padding: 9px 11px; box-sizing: border-box;" />
									</div>
								</div>
								<div>
									<label for="heroBuyerNotes" class="checkout-label" style="margin-bottom: 4px; display: block;">Website Domain, Channel or App Goal (Optional)</label>
									<input type="text" id="heroBuyerNotes" placeholder="e.g. mercerbuilds.com or custom AI desktop workflow..." style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.32); border-radius: 10px; color: #f8fafc; font-size: 0.82rem; padding: 9px 11px; box-sizing: border-box;" />
								</div>

								<!-- Promo Code Entry -->
								<div class="promo-code-box" style="margin-top: 2px;">
									<label for="promoInput" class="checkout-label">Have a Promo Code?</label>
									<div class="promo-input-row">
										<input type="text" id="promoInput" placeholder="Enter code (e.g. BUILDER10 for 10% off)" class="promo-input" />
										<button type="button" id="applyPromoBtn" class="btn-promo-apply">APPLY</button>
									</div>
									<div id="promoFeedback" class="promo-feedback-msg" style="display:none;"></div>
								</div>

								<!-- Primary Direct Visa / Mastercard Checkout Button -->
								<div class="checkout-cta-wrap" style="margin-top: 4px;">
									<button type="submit" id="portalExpressBuyBtn" class="btn-cyan-express-buy btn-gold-portal" style="width: 100%; cursor: pointer; background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; -webkit-text-fill-color: #04070d !important; font-weight: 900; border-radius: 9999px; border: none; box-shadow: 0 8px 24px rgba(212, 175, 55, 0.38);">
										💳 PAY WITH VISA / MASTERCARD &amp; UNLOCK VAULT ($49.50 USD) →
									</button>
									<div id="heroCheckoutFeedback" style="display: none; margin-top: 8px; padding: 10px 12px; border-radius: 12px; background: rgba(4, 7, 13, 0.96); border: 1px solid #38bdf8; font-size: 0.78rem; color: #f8fafc; line-height: 1.45;"></div>
									<div class="kr-upgrade-credit-pill" id="heroUpgradeCreditCallout">
										🛡️ <strong style="color: #f6d365;">100% Upgrade Credit Protected:</strong> Start at <strong>$49.50</strong> today and credit every dollar toward <strong>Tier 02 ($199 &rarr; pay $149.50)</strong> or <strong>Tier 03 ($800 &rarr; pay $750.50)</strong> anytime with your <code class="kr-code-pill">KR-UID</code>.
									</div>
									<div class="checkout-payment-methods" style="margin-top: 8px;">
										<span>💳 256-Bit Stripe USD Checkout</span> • <span>🎬 Unlisted Video + %PDF-1.7 + .ZIP</span> • <span>🤖 Guided Setup Window</span>
									</div>
									<div class="checkout-fiduciary-note">
										🏛️ Direct Release by <strong>Keystone Possibilities Ltd.</strong> • Instant Vault Unlock &amp; Email Receipt
									</div>
								</div>
							</form>

							<!-- Collapsed Returning Buyer KR-UID Toggle (Auto-expands on ?session_id=, ?uid=, #kr-self-service-portal, or saved localStorage UID) -->
							<div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid rgba(56, 189, 248, 0.22);">
								<button type="button" id="krReturningBuyerToggleBtn" class="kr-returning-uid-toggle" aria-expanded="false" aria-controls="krReturningBuyerDrawer">
									<span>🔑 Existing Buyer? Enter KR-UID to Open Vault</span>
									<span id="krReturningBuyerChevron" aria-hidden="true">+</span>
								</button>
								<div id="krReturningBuyerDrawer" style="display: none; margin-top: 10px;">
									<label for="existingVaultUidInput" style="display: block; font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; font-weight: 800; color: #38bdf8; margin-bottom: 6px; letter-spacing: 0.03em;">
										ENTER YOUR PERSONAL BUYER KR-UID:
									</label>
									<div style="display: flex; gap: 8px;">
										<input type="text" id="existingVaultUidInput" value="" placeholder="KR-UID-..." style="flex: 1; background: #04070d; border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 9999px; color: #f8fafc; font-family: 'JetBrains Mono', monospace; font-size: 0.76rem; padding: 7px 14px;" />
										<button type="button" id="verifyVaultUidBtn" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 800; cursor: pointer; white-space: nowrap;">
											OPEN VAULT &rarr;
										</button>
									</div>
									<div id="vaultUidVerifyFeedback" style="display: none; margin-top: 8px; padding: 10px 12px; border-radius: 12px; background: #04070d; border: 1px solid #d4af37; font-size: 0.76rem;"></div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>

		<!-- 1B. DEDICATED BUYER LEAD PAGE / SELF-SERVICE VAULT (HIDDEN ON PUBLIC SALES PAGE UNTIL PAYMENT / UID VERIFICATION) -->
		<section id="kr-self-service-portal" style="display: none; padding: 36px 0 48px 0; background: linear-gradient(180deg, #04070d 0%, #070d19 100%); border-top: 1px solid rgba(212, 175, 55, 0.35); border-bottom: 1px solid rgba(56, 189, 248, 0.28);">
			<div class="ast-container">
				<div style="background: rgba(8, 13, 24, 0.96); border: 1.5px solid #d4af37; border-radius: 22px; padding: 28px 26px; box-shadow: 0 20px 55px rgba(0, 0, 0, 0.85);">

					<!-- Portal Header Strip -->
					<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 18px; padding-bottom: 16px; border-bottom: 1px solid rgba(212, 175, 55, 0.28);">
						<div>
							<div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(212, 175, 55, 0.14); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 4px 12px; border-radius: 9999px; margin-bottom: 8px;">
								💎 VERIFIED BUYER VAULT UNLOCKED • UNLISTED WALKTHROUGHS, STARTER .ZIPS &amp; 12 %PDF-1.7 MANUALS READY
							</div>
							<h2 style="font-family: 'Outfit', sans-serif; font-size: 1.65rem; font-weight: 900; color: #ffffff; margin: 0;">
								Your Unlocked AI Brain, ~20-Word Google Flow Video &amp; Website Implementation Vault
							</h2>
							<p style="color: #cbd5e1; font-size: 0.88rem; margin: 6px 0 0 0; line-height: 1.55;">
								Everything is unlocked below and a copy has been sent to your email: watch your <strong>Step-by-Step Walkthrough Videos</strong>, follow the <strong>Visual Brain Setup Diagram</strong>, copy-paste the exact prompts into your Antigravity workspace and <strong>Google Flow</strong>, download your <strong>Illustrated Server PDF Manuals (<code class="kr-code-pill">%PDF-1.7</code>) &amp; Combined Master Quickstart Books</strong>, or use the <strong>Guided Setup Assistant</strong> during your active setup window.
							</p>
						</div>
						<div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
							<button type="button" id="backToSalesPageBtn" style="background: rgba(11, 17, 30, 0.92); border: 1px solid rgba(212, 175, 55, 0.55); color: #f6d365; border-radius: 9999px; padding: 10px 16px; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 800; cursor: pointer;">
								← Back to Product Overview
							</button>
							<button type="button" id="portalMasterBookQuickBtn" onclick="krDownloadMasterBook(window.krVerifiedBuyerTier || 1)" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 10px 16px; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 800; cursor: pointer;">
								📘 DOWNLOAD COMBINED MASTER BOOK (%PDF-1.7)
							</button>
							<a href="?vault_download=tier1_blueprint_pack" id="portalQuickZipBtn" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 10px 18px; font-family: 'Outfit', sans-serif; font-size: 0.78rem; font-weight: 900; text-decoration: none;">
								📦 DOWNLOAD COPY-PASTE PROMPT PACK (.ZIP)
							</a>
						</div>
					</div>

					<!-- Dynamic 100% Dollar-for-Dollar Upgrade Credit Banner inside Verified Buyer Vault -->
					<div id="krVaultUpgradeCreditBanner" style="display: none; margin-bottom: 20px; padding: 14px 18px; border-radius: 16px; background: linear-gradient(145deg, rgba(212, 175, 55, 0.13) 0%, rgba(4, 7, 13, 0.96) 100%); border: 1.5px solid rgba(212, 175, 55, 0.55); align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;"></div>

					<!-- 6-Tab Navigation Bar -->
					<div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 22px;" role="tablist">
						<button type="button" class="kr-portal-tab-btn active" data-portal-tab="tab1">
							🧠 Tab 1: $30 Antigravity Brain Diagram &amp; Custom Setup Form
						</button>
						<button type="button" class="kr-portal-tab-btn" data-portal-tab="tab2">
							🎬 Tab 2: ~20-Word Google Flow Video Prompts &amp; Export
						</button>
						<button type="button" class="kr-portal-tab-btn" data-portal-tab="tab3">
							🌐 Tab 3: Copy-Paste Website &amp; YouTube Brand Channel
						</button>
						<button type="button" class="kr-portal-tab-btn" data-portal-tab="tab4">
							🐝 Tab 4: Multi-Agent Role Prompts &amp; B2B Outreach (Tier 02)
						</button>
						<button type="button" class="kr-portal-tab-btn" data-portal-tab="tab5">
							🖥️ Tab 5: Custom Tauri Desktop App Build &amp; Command Center (Tier 03)
						</button>
						<button type="button" class="kr-portal-tab-btn" data-portal-tab="tab6">
							🤖 Tab 6: Guided Setup Assistant &amp; Printable PDF Guides
						</button>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 1: $30 ANTIGRAVITY BRAIN SETUP DIAGRAM + COPY-PASTE PROMPT + FORM     -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab1" class="kr-portal-tab-pane active">

						<!-- STEP 1: VIDEO-FIRST WALKTHROUGH & TIMESTAMP CHAPTER STRIP (MODULE V01 — 4M 00S) -->
						<div class="kr-video-first-strip">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
								<div>
									<div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(212, 175, 55, 0.16); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; padding: 4px 12px; border-radius: 9999px; margin-bottom: 6px;">
										🎬 STEP 1: WATCH VIDEO WALKTHROUGH FIRST &bull; TIER 01 UNLISTED WALKTHROUGH (4M 30S RUNTIME)
									</div>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.28rem; font-weight: 900; margin: 0;">
										Module V01 Walkthrough: Building Your 4-Folder AI Brain on the $30/mo Antigravity Plan
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krDownloadStarterAgentsMd()" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 8px 16px; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 900; cursor: pointer; box-shadow: 0 6px 18px rgba(212, 175, 55, 0.35);">
										⬇ Download AGENTS.md Starter File
									</button>
									<button type="button" onclick="krOpenSpecModal('PDF-01')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 8px 14px; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 800; cursor: pointer;">
										📄 Open Companion PDF-01
									</button>
								</div>
							</div>

							<div class="kr-video-first-grid">
								<!-- Left Column: Embedded 16:9 YouTube Player (youtube-nocookie.com) -->
								<div style="background: #02050a; border: 1.5px solid rgba(56, 189, 248, 0.45); border-radius: 14px; overflow: hidden; display: flex; flex-direction: column;">
									<div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; background: #04070d;">
										<iframe id="krVideoPlayerV01"
												src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $kr_t1_vid ); ?>?rel=0"
												title="Module V01 — $30 Antigravity Brain Setup & 4-Folder Architecture Walkthrough (4m 00s)"
												style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
												allowfullscreen loading="lazy"></iframe>
									</div>
									<div style="padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; background: rgba(8, 14, 26, 0.96); border-top: 1px solid rgba(56, 189, 248, 0.25);">
										<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">▶ TIER 01 UNLISTED WALKTHROUGH // 4M 30S STEP-BY-STEP VIDEO</span>
										<span style="color: #cbd5e1; font-size: 0.74rem;">Click any chapter on the right to jump to that timestamp &rarr;</span>
									</div>
								</div>

								<!-- Right Column: Clickable Video Chapter Breakdown & Runtime Checklist + 1-Click .MD Starter File Download -->
								<div style="background: rgba(8, 13, 24, 0.95); border: 1px solid rgba(212, 175, 55, 0.42); border-radius: 14px; padding: 14px 16px; display: flex; flex-direction: column; justify-content: space-between; gap: 10px;">
									<div>
										<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 8px;">
											<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 900;">⏱️ VIDEO CHAPTER BREAKDOWN &amp; RUNTIME CHECKLIST</span>
											<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800;">TOTAL: 4M 00S</span>
										</div>
										<div style="display: flex; flex-direction: column; gap: 7px;">
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV01', '<?php echo esc_js( $kr_t1_vid ); ?>', 0)">
												<span><strong>Ch 01:</strong> $30/mo Antigravity Plan &amp; Opening <code class="kr-code-pill">My_AI_Brain</code></span>
												<span class="kr-chapter-time">▶ 00:00</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV01', '<?php echo esc_js( $kr_t1_vid ); ?>', 65)">
												<span><strong>Ch 02:</strong> Pasting Prompt #1 to Build All 4 Brain Folders</span>
												<span class="kr-chapter-time">▶ 01:05</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV01', '<?php echo esc_js( $kr_t1_vid ); ?>', 135)">
												<span><strong>Ch 03:</strong> Dropping <code class="kr-code-pill">AGENTS.md</code> Inside <code class="kr-code-pill">01_Brain_Rules/</code></span>
												<span class="kr-chapter-time">▶ 02:15</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV01', '<?php echo esc_js( $kr_t1_vid ); ?>', 195)">
												<span><strong>Ch 04:</strong> Verifying 2M-Token Persistent Brand Memory</span>
												<span class="kr-chapter-time">▶ 03:15</span>
											</button>
										</div>
									</div>

									<!-- Tool A: 1-Click Starter AGENTS.md Download Box -->
									<div style="background: rgba(4, 7, 13, 0.95); border: 1px solid #d4af37; border-radius: 12px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
										<div>
											<div style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 900;">TOOL A // READY-TO-DROP STARTER FILE</div>
											<div style="color: #e2e8f0; font-size: 0.76rem; font-weight: 700;">Pre-configured for <code class="kr-code-pill">01_Brain_Rules/AGENTS.md</code></div>
										</div>
										<button type="button" class="kr-copy-btn" onclick="krDownloadStarterAgentsMd()">
											⬇ Download AGENTS.md Starter File
										</button>
									</div>
								</div>
							</div>
						</div>

						<!-- STEP 2: VISUAL BRAIN SETUP DIAGRAM (PDF-01) + COPY-PASTE PROMPT #1 -->
						<div style="background: #04070d; border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 18px; padding: 20px; margin-bottom: 20px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 10px;">
								<div>
									<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">STEP 2 &bull; MODULE V01 &bull; SPEC SHEET PDF-01 // VISUAL BRAIN ARCHITECTURE</span>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 900; margin: 4px 0 0 0;">
										Visual Brain Setup Diagram: How Your $30/mo Antigravity Brain Works
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krDownloadStarterAgentsMd()" style="background: rgba(212, 175, 55, 0.16); border: 1px solid #d4af37; color: #f6d365; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
										⬇ Download AGENTS.md Starter File
									</button>
									<button type="button" onclick="krOpenSpecModal('PDF-01')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
										👁️ View PDF-01 On Screen
									</button>
									<button type="button" onclick="krDownloadRealPdf('PDF-01')" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 900; cursor: pointer;">
										⬇ Download PDF-01 (%PDF-1.7)
									</button>
								</div>
							</div>

							<!-- HIGH-CONTRAST 4-STEP VISUAL BRAIN SETUP FLOWCHART DIAGRAM -->
							<div class="kr-brain-diagram-grid">
								<div class="kr-brain-node">
									<div style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900;">STEP 1 // $30/MO ANTIGRAVITY</div>
									<div style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.92rem; font-weight: 800; margin: 4px 0;">Get $30 Antigravity Plan &amp; Open Folder</div>
									<div style="color: #cbd5e1; font-size: 0.76rem; line-height: 1.45;">Install Google Antigravity, subscribe to the <code class="kr-code-pill-gold">$30/mo</code> plan, and open a new empty folder on your computer named <code class="kr-code-pill">My_AI_Brain</code>.</div>
								</div>
								<div class="kr-brain-node cyan-node">
									<div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900;">STEP 2 // PASTE PROMPT #1</div>
									<div style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.92rem; font-weight: 800; margin: 4px 0;">Creates Your 4 AI Brain Folders</div>
									<div style="color: #cbd5e1; font-size: 0.76rem; line-height: 1.45;">
										Antigravity automatically builds:<br/>
										• <code class="kr-code-pill">01_Brain_Rules/AGENTS.md</code><br/>
										• <code class="kr-code-pill">02_Video_Prompts/</code><br/>
										• <code class="kr-code-pill">03_Website_Builder/</code><br/>
										• <code class="kr-code-pill">04_YouTube_Channel/</code>
									</div>
								</div>
								<div class="kr-brain-node">
									<div style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900;">STEP 3 // ~20-WORD FLOW CLIPS</div>
									<div style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.92rem; font-weight: 800; margin: 4px 0;">Generate ~20-Word Prompts &amp; Export MP4s</div>
									<div style="color: #cbd5e1; font-size: 0.76rem; line-height: 1.45;">Antigravity writes 18–24 word scene prompts. Paste them into <strong>Google Flow</strong> with your reference photos and click <strong>Export MP4</strong>.</div>
								</div>
								<div class="kr-brain-node cyan-node">
									<div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900;">STEP 4 // WEBSITE &amp; YOUTUBE</div>
									<div style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.92rem; font-weight: 800; margin: 4px 0;">Paste Website &amp; YouTube Prompts</div>
									<div style="color: #cbd5e1; font-size: 0.76rem; line-height: 1.45;">Paste the Website Builder Prompt &amp; YouTube Brand Channel Prompt to launch your homepage, SEO articles, and 480-char tags.</div>
								</div>
							</div>

							<!-- READY-TO-COPY BRAIN SETUP PROMPT #1 -->
							<div class="kr-copy-prompt-box gold-border">
								<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
									<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">📋 COPY-PASTE PROMPT #1: BUILD YOUR 4-FOLDER AI BRAIN IN ANTIGRAVITY ($30 PLAN)</span>
									<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('krPromptBrainMaster', this)">📋 COPY BRAIN SETUP PROMPT</button>
								</div>
								<pre id="krPromptBrainMaster" style="margin: 0; white-space: pre-wrap; word-break: break-word; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc; line-height: 1.55;">You are my lead AI Systems Architect inside Google Antigravity. Initialize my 4-folder AI Brain workspace right now:
1. Create folder 01_Brain_Rules/ and write AGENTS.md storing my brand name, target audience, core offer, and website domain so you remember my rules in every chat.
2. Create folder 02_Video_Prompts/ with a master prompt generator that writes 10-second Google Flow video scene prompts strictly between 18 and 24 words (~20 words per clip).
3. Create folder 03_Website_Builder/ with dark-luxury design tokens (#04070d Obsidian background, #d4af37 Sovereign Gold pill buttons, #38bdf8 Baby Blue accents) for my homepage and SEO articles.
4. Create folder 04_YouTube_Channel/ with my YouTube Brand Channel Upload Defaults template, chapter timestamps, and a calibrated 480-character SEO tag stack.</pre>
							</div>
						</div>

						<!-- STEP 3: INTERACTIVE BRAIN, YOUTUBE CHANNEL & WEBSITE SETUP INTAKE FORM -->
						<div style="background: linear-gradient(145deg, #0b1324 0%, #050911 100%); border: 1.5px solid #38bdf8; border-radius: 18px; padding: 22px;">
							<div style="display: inline-block; background: rgba(56, 189, 248, 0.14); border: 1px solid #38bdf8; color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 3px 10px; border-radius: 9999px; margin-bottom: 8px;">
								⚡ STEP 3: INTERACTIVE CUSTOM PROMPT GENERATOR + EMAIL SYNC
							</div>
							<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.22rem; font-weight: 900; margin: 0 0 6px 0;">
								Generate Your Custom Antigravity Brain, ~20-Word Google Flow &amp; Website Prompts
							</h3>
							<p style="color: #cbd5e1; font-size: 0.84rem; margin: 0 0 16px 0; line-height: 1.5;">
								Enter your YouTube channel name, niche, and website domain below. The portal will immediately generate your tailored <strong>Brain Setup Prompt</strong>, <strong>3 custom ~20-word Google Flow video prompts</strong>, <strong>Website Builder prompt</strong>, and <strong>480-character YouTube tag stack</strong> on screen—and email a copy to your inbox!
							</p>

							<form id="krChannelWebsiteSetupForm" data-keystone-form-ignore="true" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px;">
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #f6d365; margin-bottom: 4px;">YOUR NAME *</label>
									<input type="text" id="setupBuyerName" required placeholder="Alex Mercer" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #f6d365; margin-bottom: 4px;">YOUR EMAIL (TO RECEIVE COPY) *</label>
									<input type="email" id="setupBuyerEmail" required placeholder="alex@mercerbuilds.com" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #38bdf8; margin-bottom: 4px;">YOUTUBE CHANNEL NAME *</label>
									<input type="text" id="setupChannelName" required placeholder="e.g. Apex Builder AI" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #38bdf8; margin-bottom: 4px;">CHANNEL NICHE / TOPIC *</label>
									<input type="text" id="setupChannelNiche" required placeholder="e.g. Custom Homes & AI Systems" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #f6d365; margin-bottom: 4px;">WEBSITE DOMAIN *</label>
									<input type="text" id="setupWebsiteDomain" required placeholder="e.g. apexbuilder.com" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #cbd5e1; margin-bottom: 4px;">YOUTUBE BRAND ACCOUNT STATUS</label>
									<select id="setupBrandStatus" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;">
										<option value="Need to create Brand Account">Need to set up YouTube Brand Account</option>
										<option value="Brand Account active">YouTube Brand Account already active</option>
										<option value="Launching both Website + Channel">Launching both Website + YouTube Channel</option>
									</select>
								</div>
								<div style="grid-column: 1 / -1;">
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #cbd5e1; margin-bottom: 4px;">WHAT DO YOU WANT TO BUILD FIRST? (OPTIONAL)</label>
									<input type="text" id="setupRoadblock" placeholder="e.g. Set up my 4 Brain folders, generate my first three 20-word Google Flow clips, and build my homepage..." style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div style="grid-column: 1 / -1;">
									<button type="submit" id="setupFormSubmitBtn" style="width: 100%; background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; font-family: 'Outfit', sans-serif; font-size: 0.90rem; font-weight: 900; padding: 12px 20px; border-radius: 9999px; border: none; cursor: pointer; box-shadow: 0 8px 24px rgba(212, 175, 55, 0.35);">
										⚡ GENERATE MY CUSTOM BRAIN, ~20-WORD GOOGLE FLOW &amp; WEBSITE PROMPTS →
									</button>
								</div>
							</form>

							<!-- Custom Setup Output Container (Includes Tool C: 1-Click Download All 4 Custom Setup Prompts .TXT) -->
							<div id="krCustomSetupResultBox" style="display: none; margin-top: 18px; padding-top: 16px; border-top: 1px solid rgba(212, 175, 55, 0.4);">
								<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 14px; background: rgba(4, 7, 13, 0.92); border: 1.5px solid #d4af37; border-radius: 14px; padding: 12px 16px;">
									<div>
										<div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900;">TOOL C // 1-CLICK PERSONALIZED CHEAT SHEET DOWNLOAD</div>
										<div id="krCustomSetupStatusMsg" style="color: #f6d365; font-weight: 800; font-size: 0.86rem; margin-top: 2px;"></div>
									</div>
									<div style="display: flex; gap: 8px; flex-wrap: wrap;">
										<button type="button" class="kr-copy-btn" onclick="krDownloadCustomSetupTxt()" style="padding: 9px 16px; font-size: 0.78rem; box-shadow: 0 6px 18px rgba(212, 175, 55, 0.35);">
											⬇ Download All 4 Custom Setup Prompts (.TXT)
										</button>
										<button type="button" onclick="krDownloadStarterAgentsMd()" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 8px 14px; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 800; cursor: pointer;">
											⬇ Download Custom AGENTS.md
										</button>
									</div>
								</div>

								<div class="kr-copy-prompt-box gold-border">
									<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
										<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">🧠 1. YOUR CUSTOM ANTIGRAVITY BRAIN SETUP PROMPT ($30 PLAN)</span>
										<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('outCustomBrainPrompt', this)">📋 COPY PROMPT</button>
									</div>
									<pre id="outCustomBrainPrompt" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc;"></pre>
								</div>

								<div class="kr-copy-prompt-box">
									<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
										<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">🎬 2. YOUR 3 CUSTOM ~20-WORD GOOGLE FLOW VIDEO SCENE PROMPTS</span>
										<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('outCustomFlowPrompts', this)">📋 COPY ALL 3 FLOW PROMPTS</button>
									</div>
									<pre id="outCustomFlowPrompts" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc;"></pre>
								</div>

								<div class="kr-copy-prompt-box gold-border">
									<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
										<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">🌐 3. YOUR CUSTOM ANTIGRAVITY WEBSITE BUILDER PROMPT</span>
										<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('outCustomWebsitePrompt', this)">📋 COPY WEBSITE PROMPT</button>
									</div>
									<pre id="outCustomWebsitePrompt" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc;"></pre>
								</div>

								<div class="kr-copy-prompt-box">
									<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
										<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">📺 4. YOUR YOUTUBE UPLOAD DEFAULTS &amp; 480-CHARACTER TAG STACK</span>
										<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('outCustomYoutubeTags', this)">📋 COPY TAGS &amp; DEFAULTS</button>
									</div>
									<pre id="outCustomYoutubeTags" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc;"></pre>
								</div>
							</div>
						</div>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 2: ~20-WORD GOOGLE FLOW VIDEO PROMPTS & MP4 EXPORT (PDF-02)           -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab2" class="kr-portal-tab-pane">

						<!-- STEP 1: VIDEO-FIRST WALKTHROUGH & TIMESTAMP CHAPTER STRIP (MODULE V02 — 5M 00S) -->
						<div class="kr-video-first-strip cyan-accent">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
								<div>
									<div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; padding: 4px 12px; border-radius: 9999px; margin-bottom: 6px;">
										🎬 STEP 1: WATCH VIDEO WALKTHROUGH FIRST &bull; MODULE V02 (5M 00S RUNTIME)
									</div>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.28rem; font-weight: 900; margin: 0;">
										Module V02 Walkthrough: Writing ~20-Word (18–24 Word) Google Flow Prompts &amp; Exporting 1080p MP4s
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krDownloadStarterFlowMd()" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 8px 16px; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 900; cursor: pointer;">
										⬇ Download 02_Video_Prompts.md Starter
									</button>
									<button type="button" onclick="krOpenSpecModal('PDF-02')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 8px 14px; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 800; cursor: pointer;">
										📄 Open Companion PDF-02
									</button>
								</div>
							</div>

							<div class="kr-video-first-grid">
								<!-- Left Column: Embedded 16:9 YouTube Player (youtube-nocookie.com) -->
								<div style="background: #02050a; border: 1.5px solid rgba(56, 189, 248, 0.45); border-radius: 14px; overflow: hidden; display: flex; flex-direction: column;">
									<div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; background: #04070d;">
										<iframe id="krVideoPlayerV02"
												src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $kr_t1_vid ); ?>?start=135&amp;rel=0"
												title="Module V02 — ~20-Word Google Flow Video Prompt Formula & 1080p MP4 Export Walkthrough (5m 00s)"
												style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
												allowfullscreen loading="lazy"></iframe>
									</div>
									<div style="padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; background: rgba(8, 14, 26, 0.96); border-top: 1px solid rgba(56, 189, 248, 0.25);">
										<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">▶ MODULE V02 // 5M 00S STEP-BY-STEP VIDEO</span>
										<span style="color: #cbd5e1; font-size: 0.74rem;">Click any chapter on the right to jump to that timestamp &rarr;</span>
									</div>
								</div>

								<!-- Right Column: Clickable Video Chapter Breakdown & Runtime Checklist + 1-Click .MD Starter File Download -->
								<div style="background: rgba(8, 13, 24, 0.95); border: 1px solid rgba(56, 189, 248, 0.42); border-radius: 14px; padding: 14px 16px; display: flex; flex-direction: column; justify-content: space-between; gap: 10px;">
									<div>
										<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 8px;">
											<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 900;">⏱️ VIDEO CHAPTER BREAKDOWN &amp; RUNTIME CHECKLIST</span>
											<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800;">TOTAL: 5M 00S</span>
										</div>
										<div style="display: flex; flex-direction: column; gap: 7px;">
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV02', '<?php echo esc_js( $kr_t1_vid ); ?>', 0)">
												<span><strong>Ch 01:</strong> Uploading 3 Reference Chips (Character, Outfit, Studio)</span>
												<span class="kr-chapter-time">▶ 00:00</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV02', '<?php echo esc_js( $kr_t1_vid ); ?>', 80)">
												<span><strong>Ch 02:</strong> Why 18–24 Words (~20 Words) Prevents Audio Cutoffs</span>
												<span class="kr-chapter-time">▶ 01:20</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV02', '<?php echo esc_js( $kr_t1_vid ); ?>', 165)">
												<span><strong>Ch 03:</strong> Generating 6 Sequential 10s Clips in Antigravity</span>
												<span class="kr-chapter-time">▶ 02:45</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV02', '<?php echo esc_js( $kr_t1_vid ); ?>', 240)">
												<span><strong>Ch 04:</strong> Exporting 1080p MP4s &amp; Numbering Clips Cleanly</span>
												<span class="kr-chapter-time">▶ 04:00</span>
											</button>
										</div>
									</div>

									<div style="background: rgba(4, 7, 13, 0.95); border: 1px solid #38bdf8; border-radius: 12px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
										<div>
											<div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 900;">STARTER TEMPLATE // 02_VIDEO_PROMPTS</div>
											<div style="color: #e2e8f0; font-size: 0.76rem; font-weight: 700;">Ready-to-drop <code class="kr-code-pill">02_Video_Prompts.md</code> template</div>
										</div>
										<button type="button" class="kr-copy-btn" onclick="krDownloadStarterFlowMd()">
											⬇ Download .MD Starter File
										</button>
									</div>
								</div>
							</div>
						</div>

						<!-- STEP 2: PDF-02 SPEC SHEET & COPY-PASTE PROMPT #2 -->
						<div style="background: #04070d; border: 1px solid rgba(56, 189, 248, 0.45); border-radius: 18px; padding: 20px; margin-bottom: 20px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
								<div>
									<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">STEP 2 &bull; MODULE V02 &bull; SPEC SHEET PDF-02 // ~20-WORD GOOGLE FLOW VIDEO FORMULA</span>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 900; margin: 4px 0 0 0;">
										How to Generate ~20-Word Prompts in Antigravity, Paste into Google Flow &amp; Export MP4s
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krOpenSpecModal('PDF-02')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
										👁️ View PDF-02 On Screen
									</button>
									<button type="button" onclick="krDownloadRealPdf('PDF-02')" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 900; cursor: pointer;">
										⬇ Download PDF-02 (%PDF-1.7)
									</button>
								</div>
							</div>

							<p style="color: #cbd5e1; font-size: 0.86rem; line-height: 1.6; margin: 0 0 14px 0;">
								When creating 10-second AI video clips in <strong>Google Flow</strong>, overloaded paragraphs confuse the video model. The sweet spot is <strong>~20 words (18 to 24 words) per 10-second scene prompt</strong> paired with <strong>3 Reference Images</strong> (1 Headshot photo, 1 Outfit photo, 1 Studio Room photo).
							</p>

							<div class="kr-copy-prompt-box">
								<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
									<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">📋 COPY-PASTE PROMPT #2: ~20-WORD GOOGLE FLOW SCENE GENERATOR (PASTE IN ANTIGRAVITY)</span>
									<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('krPromptFlowGenerator', this)">📋 COPY ~20-WORD GENERATOR PROMPT</button>
								</div>
								<pre id="krPromptFlowGenerator" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc; line-height: 1.55;">Write 6 sequential 10-second Google Flow video scene prompts for my episode topic.
Rules for every scene prompt:
1. Keep the visual prompt strictly between 18 and 24 words (~20 words total).
2. Describe the presenter speaking naturally to camera with grounded two-handed gestures in a warm acoustic oak studio on a 35mm cinema lens.
3. Include a separate 22-to-26 word spoken voiceover line for each 10-second clip so pacing never rushes.
4. After generating the 6 prompts, remind me to attach my 3 reference images (Character, Outfit, Studio Background) in Google Flow and click Export MP4 (1080p).</pre>
							</div>
						</div>

						<!-- STEP 3 (TOOL B): INTERACTIVE ~20-WORD (18-24 WORD) GOOGLE FLOW PACING CHECKER -->
						<div style="background: linear-gradient(145deg, #0b1324 0%, #050911 100%); border: 1.5px solid #d4af37; border-radius: 18px; padding: 20px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 10px;">
								<div>
									<div style="display: inline-block; background: rgba(212, 175, 55, 0.16); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; padding: 3px 10px; border-radius: 9999px; margin-bottom: 6px;">
										🎯 TOOL B // INTERACTIVE ~20-WORD (18–24 WORD) GOOGLE FLOW PACING CHECKER
									</div>
									<h4 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.15rem; font-weight: 900; margin: 0;">
										Test Your 10-Second Google Flow Prompt or Spoken Line Before Generating
									</h4>
								</div>
								<div id="krFlowWordCountBadge" style="background: rgba(212, 175, 55, 0.18); border: 1.5px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; font-weight: 900; padding: 6px 14px; border-radius: 9999px;">
									21 words — Perfect 18–24 Word Google Flow Sweet Spot
								</div>
							</div>
							<p style="color: #cbd5e1; font-size: 0.82rem; margin: 0 0 10px 0; line-height: 1.5;">
								Paste or type any 10-second scene prompt or spoken voiceover line below. Keep it inside the <strong>18–24 word sweet spot (~20 words)</strong> so your audio and lip-sync never rush or cut off at the end of a 10-second Google Flow clip.
							</p>
							<textarea id="krFlowWordCountInput" rows="3" style="width: 100%; background: #04070d; border: 1.5px solid rgba(56, 189, 248, 0.45); border-radius: 12px; color: #f8fafc; font-family: 'JetBrains Mono', monospace; font-size: 0.82rem; padding: 12px 14px; box-sizing: border-box; line-height: 1.5;" placeholder="Paste or type your 10-second Google Flow prompt or spoken line here...">Founder speaking warmly to camera with grounded two-handed builder gestures inside a dark acoustic oak studio on a 35mm cinema lens.</textarea>
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; margin-top: 10px;">
								<span id="krFlowWordCountHint" style="color: #38bdf8; font-size: 0.76rem; font-weight: 700;">
									✔ Ready for Google Flow Box 2: Attach your 3 Reference Chips (Character, Outfit, Studio) + Paste Prompt.
								</span>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krLoadSampleFlowPrompt()" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 6px 12px; font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 800; cursor: pointer;">
										🔄 Load 21-Word Sample
									</button>
									<button type="button" class="kr-copy-btn" onclick="krCopyFlowCheckedPrompt(this)">
										📋 Copy Verified ~20-Word Prompt
									</button>
								</div>
							</div>
						</div>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 3: COPY-PASTE WEBSITE BUILDER & YOUTUBE BRAND CHANNEL (PDF-03..05)    -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab3" class="kr-portal-tab-pane">

						<!-- STEP 1: VIDEO-FIRST WALKTHROUGH & TIMESTAMP CHAPTER STRIP (MODULE V03 — 4M 30S) -->
						<div class="kr-video-first-strip">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
								<div>
									<div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(212, 175, 55, 0.16); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; padding: 4px 12px; border-radius: 9999px; margin-bottom: 6px;">
										🎬 STEP 1: WATCH VIDEO WALKTHROUGH FIRST &bull; MODULE V03 (4M 30S RUNTIME)
									</div>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.28rem; font-weight: 900; margin: 0;">
										Module V03 Walkthrough: Launching Your YouTube Brand Channel &amp; #04070d Dark-Luxury Website
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krDownloadStarterWebsiteMd()" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 8px 16px; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 900; cursor: pointer;">
										⬇ Download Website &amp; YouTube .MD Starter
									</button>
									<button type="button" onclick="krOpenSpecModal('PDF-04')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 8px 14px; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 800; cursor: pointer;">
										📄 Open Companion PDF-04
									</button>
								</div>
							</div>

							<div class="kr-video-first-grid">
								<!-- Left Column: Embedded 16:9 YouTube Player (youtube-nocookie.com) -->
								<div style="background: #02050a; border: 1.5px solid rgba(56, 189, 248, 0.45); border-radius: 14px; overflow: hidden; display: flex; flex-direction: column;">
									<div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; background: #04070d;">
										<iframe id="krVideoPlayerV03"
												src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $kr_t2_vid ); ?>?rel=0"
												title="Module V03 — Copy-Paste Website Builder & YouTube Brand Channel Walkthrough (4m 30s)"
												style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
												allowfullscreen loading="lazy"></iframe>
									</div>
									<div style="padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; background: rgba(8, 14, 26, 0.96); border-top: 1px solid rgba(56, 189, 248, 0.25);">
										<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">▶ TIER 02 UNLISTED WALKTHROUGH // 5M 30S STEP-BY-STEP VIDEO</span>
										<span style="color: #cbd5e1; font-size: 0.74rem;">Click any chapter on the right to jump to that timestamp &rarr;</span>
									</div>
								</div>

								<!-- Right Column: Clickable Video Chapter Breakdown & Runtime Checklist + 1-Click .MD Starter File Download -->
								<div style="background: rgba(8, 13, 24, 0.95); border: 1px solid rgba(212, 175, 55, 0.42); border-radius: 14px; padding: 14px 16px; display: flex; flex-direction: column; justify-content: space-between; gap: 10px;">
									<div>
										<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 8px;">
											<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 900;">⏱️ VIDEO CHAPTER BREAKDOWN &amp; RUNTIME CHECKLIST</span>
											<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800;">TOTAL: 4M 30S</span>
										</div>
										<div style="display: flex; flex-direction: column; gap: 7px;">
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV03', '<?php echo esc_js( $kr_t2_vid ); ?>', 0)">
												<span><strong>Ch 01:</strong> Creating Your Dedicated YouTube Brand Account</span>
												<span class="kr-chapter-time">▶ 00:00</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV03', '<?php echo esc_js( $kr_t2_vid ); ?>', 70)">
												<span><strong>Ch 02:</strong> Upload Defaults &amp; 480-Character SEO Tag Stack (<code class="kr-code-pill">PDF-03</code>)</span>
												<span class="kr-chapter-time">▶ 01:10</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV03', '<?php echo esc_js( $kr_t2_vid ); ?>', 145)">
												<span><strong>Ch 03:</strong> Pasting Dark-Luxury <code class="kr-code-pill">#04070d</code> Website Prompt (<code class="kr-code-pill">PDF-04</code>)</span>
												<span class="kr-chapter-time">▶ 02:25</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV03', '<?php echo esc_js( $kr_t2_vid ); ?>', 215)">
												<span><strong>Ch 04:</strong> JSON-LD Schema &amp; Search Console Indexing (<code class="kr-code-pill">PDF-05</code>)</span>
												<span class="kr-chapter-time">▶ 03:35</span>
											</button>
										</div>
									</div>

									<div style="background: rgba(4, 7, 13, 0.95); border: 1px solid #d4af37; border-radius: 12px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
										<div>
											<div style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 900;">STARTER TEMPLATE // 03_WEBSITE_AND_YOUTUBE</div>
											<div style="color: #e2e8f0; font-size: 0.76rem; font-weight: 700;">Ready-to-drop <code class="kr-code-pill">03_Website_Builder.md</code> file</div>
										</div>
										<button type="button" class="kr-copy-btn" onclick="krDownloadStarterWebsiteMd()">
											⬇ Download .MD Starter File
										</button>
									</div>
								</div>
							</div>
						</div>

						<!-- STEP 2: PDF-03, PDF-04 & PDF-05 COPY-PASTE PROMPTS -->
						<div style="background: #04070d; border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 18px; padding: 20px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
								<div>
									<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">STEP 2 &bull; MODULE V03 &bull; SPEC SHEETS PDF-03, PDF-04 &amp; PDF-05 // YOUTUBE CHANNEL &amp; WEBSITE BUILDER</span>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 900; margin: 4px 0 0 0;">
										Copy-Paste Prompts for Your YouTube Brand Channel &amp; Dark-Luxury Website
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krOpenSpecModal('PDF-03')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 7px 12px; font-size: 0.72rem; font-weight: 800; cursor: pointer;">👁️ PDF-03 (YouTube)</button>
									<button type="button" onclick="krOpenSpecModal('PDF-04')" style="background: rgba(212, 175, 55, 0.16); border: 1px solid #d4af37; color: #f6d365; border-radius: 9999px; padding: 7px 12px; font-size: 0.72rem; font-weight: 800; cursor: pointer;">👁️ PDF-04 (Website)</button>
									<button type="button" onclick="krOpenSpecModal('PDF-05')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 7px 12px; font-size: 0.72rem; font-weight: 800; cursor: pointer;">👁️ PDF-05 (SEO &amp; GSC)</button>
								</div>
							</div>

							<div class="kr-copy-prompt-box gold-border">
								<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
									<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">📋 COPY-PASTE PROMPT #3: YOUTUBE BRAND CHANNEL, UPLOAD DEFAULTS &amp; 480-CHAR TAGS (PDF-03)</span>
									<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('krPromptYoutubeSetup', this)">📋 COPY YOUTUBE PROMPT</button>
								</div>
								<pre id="krPromptYoutubeSetup" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc; line-height: 1.55;">Create my complete YouTube Brand Channel setup package in 04_YouTube_Channel/:
1. Channel Bio & Positioning Statement tailored to my brand and website link.
2. YouTube Studio Upload Defaults description template with chapter timestamps (00:00 Intro, 01:15 Architecture, 03:30 Step-by-Step Build, 06:00 Next Steps) and primary website CTA link.
3. A calibrated 480-character comma-separated SEO tag stack (under YouTube's 500-character limit) combining high-intent search terms for my niche.</pre>
							</div>

							<div class="kr-copy-prompt-box">
								<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
									<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">📋 COPY-PASTE PROMPT #4: DARK-LUXURY WEBSITE &amp; SEO ARTICLE BUILDER (PDF-04 &amp; PDF-05)</span>
									<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('krPromptWebsiteBuilder', this)">📋 COPY WEBSITE PROMPT</button>
								</div>
								<pre id="krPromptWebsiteBuilder" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc; line-height: 1.55;">Build a responsive dark-luxury homepage hero and WordPress/HTML article template inside 03_Website_Builder/:
1. Color Tokens: Obsidian (#04070d) background, Sovereign Gold (#d4af37) 9999px pill CTA buttons, Baby Blue (#38bdf8) accents, and 18px glassmorphic cards.
2. Hero Layout: Left column with authority headline, 3-step value strip, and YouTube video embed; Right column with an instant Email Lead & Offer Reservation card.
3. SEO & Schema: Include Person, VideoObject, and FAQPage JSON-LD schema so every article scores 100/100 in Rank Math and indexes cleanly in Google Search Console.</pre>
							</div>
						</div>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 4: 6-AGENT ROLE SUITE & B2B OUTREACH (PDF-06 TO PDF-09)               -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab4" class="kr-portal-tab-pane">
						<div style="background: #04070d; border: 1px solid rgba(56, 189, 248, 0.45); border-radius: 18px; padding: 20px;">
							<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">MODULES V04–V05 &bull; SPEC SHEETS PDF-06 TO PDF-09 // TIER 02 6-AGENT ROLE SUITE + MULTI-AGENT ARCHITECTURE</span>
							<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 900; margin: 4px 0 10px 0;">
								6-Agent Role Suite + Multi-Agent Architecture, 3-Source Fact Verification &amp; B2B Outreach Templates
							</h3>
							<p style="color: #cbd5e1; font-size: 0.86rem; line-height: 1.6; margin: 0 0 14px 0;">
								Instead of overloading one chat window until it forgets your instructions, Tier 02 unlocks the <strong>6-Agent Role Suite + Multi-Agent Architecture</strong> (Research Scout, Source Challenger, Video Scriptwriter, Dark-Luxury Web Engineer, B2B Outreach Specialist, and Boss QA Auditor) plus our <strong>Locked Crest HTML Email Template</strong>.
							</p>
							<div style="display: flex; gap: 8px; flex-wrap: wrap;">
								<div style="width: 100%; margin-bottom: 14px; position: relative; padding-bottom: 56.25%; height: 0; background: #02050a; border-radius: 14px; overflow: hidden; border: 1.5px solid rgba(56, 189, 248, 0.45);"><iframe id="krVideoPlayerV04" src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $kr_t2_vid ); ?>?start=145&amp;rel=0" title="Tier 02 Unlisted Buyer Walkthrough — 6-Agent Role Suite, 3-Source Research Gate &amp; B2B Outreach (5m 28s)" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
								<button type="button" onclick="krDownloadMasterBook(2)" class="kr-copy-btn">📘 Download All 5 Tier 02 Guides Combined (%PDF-1.7)</button>
								<button type="button" onclick="krOpenSpecModal('PDF-06')" class="kr-copy-btn">👁️ PDF-06: 6-Agent Role Suite</button>
								<button type="button" onclick="krOpenSpecModal('PDF-07')" class="kr-copy-btn">👁️ PDF-07: 3-Source Research Gate</button>
								<button type="button" onclick="krOpenSpecModal('PDF-08')" class="kr-copy-btn">👁️ PDF-08: B2B Outreach &amp; DNS Gate</button>
								<button type="button" onclick="krOpenSpecModal('PDF-09')" class="kr-copy-btn">👁️ PDF-09: Branded HTML Email Shell</button>
							</div>
						</div>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 5: COMPLETE RUNNABLE RUST + TAURI v2 SOURCE & .EXE COMPILER           -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab5" class="kr-portal-tab-pane">
						<div style="background: #04070d; border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 18px; padding: 20px;">
							<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">MODULE V06 &bull; SPEC SHEETS PDF-10 TO PDF-12 // TIER 03 RUNNABLE RUST + TAURI v2 DESKTOP SOURCE (.EXE)</span>
							<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 900; margin: 4px 0 10px 0;">
								Complete Runnable Rust + Tauri v2 Desktop Command Center Source Project + 1-Command Windows .EXE Compiler
							</h3>
							<p style="color: #cbd5e1; font-size: 0.86rem; line-height: 1.6; margin: 0 0 14px 0;">
								Unpack the complete runnable <code class="kr-code-pill">src-tauri/</code> Rust + Tauri v2 desktop command center project inside your AI Brain workspace, customize your dark-luxury dashboard tabs and action buttons, and run the 1-command Windows <code class="kr-code-pill-gold">.exe</code> compiler with 14-Day Guided Build Support.
							</p>
							<div style="display: flex; gap: 8px; flex-wrap: wrap;">
								<div style="width: 100%; margin-bottom: 14px; position: relative; padding-bottom: 56.25%; height: 0; background: #02050a; border-radius: 14px; overflow: hidden; border: 1.5px solid rgba(212, 175, 55, 0.45);"><iframe id="krVideoPlayerV05" src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $kr_t3_vid ); ?>?rel=0" title="Tier 03 Unlisted Buyer Walkthrough — Complete Runnable Rust + Tauri v2 Desktop Command Center Source &amp; .EXE Compiler (5m 54s)" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>
								<a href="?vault_download=tier3_workstation_pack" id="portalTab5ZipBtn" onclick="return krHandleVaultAnchorClick(event, 'tier3_workstation_pack', 3)" class="kr-copy-btn" style="text-decoration: none;">📦 Download Runnable Tauri v2 Source (.ZIP)</a>
								<button type="button" onclick="krDownloadMasterBook(3)" class="kr-copy-btn">📘 Download All 3 Tier 03 Guides Combined (%PDF-1.7)</button>
								<button type="button" onclick="krOpenSpecModal('PDF-10')" class="kr-copy-btn">👁️ PDF-10: Tauri v2 Source Setup</button>
								<button type="button" onclick="krOpenSpecModal('PDF-11')" class="kr-copy-btn">👁️ PDF-11: Custom Tabs &amp; Buttons UI</button>
								<button type="button" onclick="krOpenSpecModal('PDF-12')" class="kr-copy-btn">👁️ PDF-12: 1-Command .EXE Compiler</button>
							</div>
						</div>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 6: GUIDED SETUP ASSISTANT + COMBINED MASTER BOOKS + ALL 12 PDFs       -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab6" class="kr-portal-tab-pane">
						<div id="krAiTutorPanel" style="background: linear-gradient(145deg, #0b1324 0%, #050911 100%); border: 1.5px solid #38bdf8; border-radius: 18px; padding: 22px; margin-bottom: 20px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; margin-bottom: 10px;">
								<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">🤖 GUIDED SETUP ASSISTANT // ACTIVE SETUP WINDOW + FOLLOW-UP Q&amp;A</span>
								<span style="color: #f6d365; font-size: 0.74rem; font-weight: 700;">Includes Setup Window Follow-Up Questions</span>
							</div>
							<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.22rem; font-weight: 900; margin: 0 0 8px 0;">
								Ask Your Guided Setup Assistant About Your AI Brain, Google Flow, Website, or Tauri Desktop App
							</h3>

							<!-- Quick Question Pills -->
							<div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px;">
								<button type="button" class="kr-tutor-quick-btn" data-q="How do I set up my $30 Antigravity Brain?" style="background: rgba(212, 175, 55, 0.15); border: 1px solid #d4af37; color: #f6d365; border-radius: 9999px; padding: 6px 12px; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
									🧠 How do I set up my $30 Antigravity Brain?
								</button>
								<button type="button" class="kr-tutor-quick-btn" data-q="How do I write ~20-word Google Flow prompts & export?" style="background: rgba(56, 189, 248, 0.15); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 6px 12px; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
									🎬 How do I write ~20-word Google Flow prompts &amp; export?
								</button>
								<button type="button" class="kr-tutor-quick-btn" data-q="Give me the copy-paste Website prompt" style="background: rgba(212, 175, 55, 0.15); border: 1px solid #d4af37; color: #f6d365; border-radius: 9999px; padding: 6px 12px; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
									🌐 Give me the copy-paste Website prompt
								</button>
								<button type="button" class="kr-tutor-quick-btn" data-q="How do I set up my YouTube Brand Channel?" style="background: rgba(56, 189, 248, 0.15); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 6px 12px; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
									📺 How do I set up my YouTube Brand Channel?
								</button>
							</div>

							<div style="display: flex; gap: 8px; flex-wrap: wrap;">
								<input type="text" id="krTutorQuestionInput" placeholder="Ask any step-by-step question (e.g. How do I export my 10-second clips from Google Flow?)..." style="flex: 1; min-width: 240px; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.45); border-radius: 9999px; color: #f8fafc; padding: 10px 16px; font-size: 0.84rem;" />
								<input type="email" id="krTutorEmailInput" placeholder="Optional: Email to receive lesson copy" style="width: 240px; background: #04070d; border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 9999px; color: #f8fafc; padding: 10px 14px; font-size: 0.80rem;" />
								<button type="button" id="krAskTutorBtn" style="background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%); color: #04070d; border: none; border-radius: 9999px; padding: 10px 20px; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 900; cursor: pointer;">
									🤖 ASK AI TUTOR
								</button>
								<button type="button" id="krEmailTutorLessonBtn" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 10px 16px; font-family: 'Outfit', sans-serif; font-size: 0.78rem; font-weight: 900; cursor: pointer;">
									✉️ EMAIL ME THIS LESSON
								</button>
							</div>

							<div id="krTutorAnswerBox" style="display: none; margin-top: 14px; background: #04070d; border: 1px solid #d4af37; border-radius: 14px; padding: 16px;"></div>
						</div>

						<!-- Combined Master Quickstart Books (%PDF-1.7) -->
						<div style="background: #04070d; border: 1.5px solid rgba(56, 189, 248, 0.42); border-radius: 18px; padding: 18px 20px; margin-bottom: 16px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
								<div>
									<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.69rem; font-weight: 800;">📘 COMBINED MASTER QUICKSTART BOOKS // ILLUSTRATED SERVER %PDF-1.7 EDITION</span>
									<h4 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.06rem; font-weight: 900; margin: 3px 0 0 0;">
										Download All Guides for Each Tier in One Printable Master Book
									</h4>
								</div>
							</div>
							<div id="krMasterPdfBooksRow" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 10px;">
								<a href="?vault_download=tier1_pdf_master" data-master-slug="tier1_pdf_master" onclick="return krHandleMasterBookClick(event, 1)" style="display: flex; flex-direction: column; gap: 4px; background: #081020; border: 1px solid rgba(56, 189, 248, 0.42); border-radius: 14px; padding: 12px 14px; text-decoration: none; color: #f8fafc;">
									<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 800;">TIER 01 MASTER BOOK • %PDF-1.7</span>
									<strong style="font-family: 'Outfit', sans-serif; font-size: 0.86rem; color: #ffffff;">All 4 Tier 01 Guides Combined</strong>
									<span style="color: #cbd5e1; font-size: 0.74rem;">Brain Setup + ~20-Word Flow + YouTube + Website Starter</span>
								</a>
								<a href="?vault_download=tier2_pdf_master" data-master-slug="tier2_pdf_master" onclick="return krHandleMasterBookClick(event, 2)" style="display: flex; flex-direction: column; gap: 4px; background: #081020; border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 14px; padding: 12px 14px; text-decoration: none; color: #f8fafc;">
									<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 800;">TIER 02 MASTER BOOK • %PDF-1.7</span>
									<strong style="font-family: 'Outfit', sans-serif; font-size: 0.86rem; color: #ffffff;">All 5 Tier 02 Guides Combined</strong>
									<span style="color: #cbd5e1; font-size: 0.74rem;">SEO Schema + 6-Agent Suite + 3-Source Gate + B2B &amp; Email</span>
								</a>
								<a href="?vault_download=tier3_pdf_master" data-master-slug="tier3_pdf_master" onclick="return krHandleMasterBookClick(event, 3)" style="display: flex; flex-direction: column; gap: 4px; background: #081020; border: 1px solid rgba(56, 189, 248, 0.42); border-radius: 14px; padding: 12px 14px; text-decoration: none; color: #f8fafc;">
									<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 800;">TIER 03 MASTER BOOK • %PDF-1.7</span>
									<strong style="font-family: 'Outfit', sans-serif; font-size: 0.86rem; color: #ffffff;">All 3 Tier 03 Guides Combined</strong>
									<span style="color: #cbd5e1; font-size: 0.74rem;">Tauri v2 Source + Custom Dashboard Tabs + .EXE Compiler</span>
								</a>
							</div>
						</div>

						<!-- All 12 Breakdown Spec PDFs Grid -->
						<div style="background: #04070d; border: 1px solid rgba(212, 175, 55, 0.35); border-radius: 18px; padding: 20px;">
							<h4 style="color: #f6d365; font-family: 'Outfit', sans-serif; font-size: 1.05rem; font-weight: 900; margin: 0 0 12px 0;">
								📄 Complete 12-PDF Breakdown Library (View Copy-Paste Prompts On Screen or Download Real Illustrated Server <code class="kr-code-pill">%PDF-1.7</code>)
							</h4>
							<div id="krPdfLibraryGrid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 10px;"></div>
						</div>
					</div>

				</div>
			</div>
		</section>

		<div id="krPublicSalesSections">
		<!-- 1C. COLD PAID-AD TAKEAWAY STRIP: WHAT HAPPENS IN 60 SECONDS AFTER VISA CHECKOUT + PREREQUISITES -->
		<section id="krSixtySecondTakeawayStrip" style="padding: 28px 0 8px 0; background: #04070d; border-top: 1px solid rgba(56, 189, 248, 0.20);">
			<div class="ast-container">
				<div style="margin-bottom: 16px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
					<div>
						<span class="kr-v4-kicker"><span class="kr-v4-kicker-dot"></span> WHAT HAPPENS IN 60 SECONDS AFTER VISA CHECKOUT &middot; PREREQUISITES</span>
						<h2 class="kr-v4-h2" style="font-size: clamp(1.3rem, 2.2vw, 1.75rem); margin-bottom: 4px;">Zero Subscriptions, Instant Delivery &amp; 100% Upgrade Credit Protected</h2>
					</div>
					<span style="font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800; color: #f6d365; background: rgba(212, 175, 55, 0.12); border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 9999px; padding: 6px 14px;">
						🛡️ $49.50 Credits 100% Toward $199 or $800 Anytime
					</span>
				</div>
				<div class="kr-takeaway-strip-grid">
					<div class="kr-takeaway-card kr-takeaway-card--gold">
						<span style="font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; color: #f6d365;">01 // 0–60 SECONDS AFTER VISA</span>
						<strong style="font-family: 'Outfit', sans-serif; font-size: 1rem; color: #ffffff;">Instant On-Screen &amp; Email Delivery</strong>
						<span style="color: #cbd5e1; font-size: 0.82rem; line-height: 1.52;">Stripe redirects right back here, unlocks your personal <code class="kr-code-pill">KR-UID</code> Buyer Vault, streams your unlisted 4K walkthroughs, and emails your <code class="kr-code-pill-gold">.ZIP</code> + <code class="kr-code-pill">%PDF-1.7</code> manuals.</span>
					</div>
					<div class="kr-takeaway-card">
						<span style="font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; color: #38bdf8;">02 // ZERO KEYSTONE MONTHLY FEES</span>
						<strong style="font-family: 'Outfit', sans-serif; font-size: 1rem; color: #ffffff;">One-Time USD Payment + Full Credit</strong>
						<span style="color: #cbd5e1; font-size: 0.82rem; line-height: 1.52;">Pay once ($49.50, $199, or $800 USD)—never a monthly SaaS fee to Keystone. Start at Tier 01 and credit 100% ($49.50) toward Tier 02 ($149.50 net) or Tier 03 ($750.50 net) anytime.</span>
					</div>
					<div class="kr-takeaway-card kr-takeaway-card--gold">
						<span style="font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; color: #f6d365;">03 // PREREQUISITES &amp; OS SUPPORT</span>
						<strong style="font-family: 'Outfit', sans-serif; font-size: 1rem; color: #ffffff;">No Coding Needed &bull; Mac &amp; Windows</strong>
						<span style="color: #cbd5e1; font-size: 0.82rem; line-height: 1.52;">Tiers 01 &amp; 02 run on macOS, Windows, or Linux inside your own Google Antigravity + Google Flow workspace. Compiling the Tier 03 standalone <code class="kr-code-pill-gold">.EXE</code> uses Windows 10/11 + free Rust/Node tools.</span>
					</div>
					<div class="kr-takeaway-card">
						<span style="font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; color: #38bdf8;">04 // GUIDED SETUP SUPPORT</span>
						<strong style="font-family: 'Outfit', sans-serif; font-size: 1rem; color: #ffffff;">7-to-14 Day Guided Build Window</strong>
						<span style="color: #cbd5e1; font-size: 0.82rem; line-height: 1.52;">Includes interactive AI Setup Assistant access plus direct follow-up support: 7-day window on Tiers 01–02, and 14-Day Guided Build Support + architectural review on Tier 03.</span>
					</div>
				</div>
			</div>
		</section>

		<!-- 2. THE 3 DEDICATED PRODUCT SHOWCASE BLOCKS -->
		<section class="protocols-showcase-section">
			<div class="ast-container protocols-portal-grid-container">

				<!-- PRODUCT 1: $49.50 AI BRAIN & BASIC GOOGLE FLOW STARTER -->
				<div id="tier-blueprint" class="protocol-product-block">
					<span id="kr-tier-1" aria-hidden="true"></span>
					<div class="product-grid">

						<div class="product-media-col">
							<div class="video-preview-card">
								<div class="video-thumb-wrap" style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 14px 14px 0 0; background: #04070d;">
									<iframe src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $hero_intro_vid ); ?>?start=40&amp;rel=0&amp;modestbranding=1"
											title="Wayne's Recorded Walkthrough: AI Brain Setup & Basic Google Flow Video Example"
											style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
											allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
											allowfullscreen loading="lazy"></iframe>
								</div>
								<div class="video-card-meta">
									<div style="font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 800; color: #38bdf8; margin-bottom: 4px;">@KeyStoneRecomposition &bull; AI Protocols Suite</div>
									<span class="video-title">Wayne's Recorded Walkthrough: Setting Up Your AI Brain &amp; Basic Google Flow Example</span>
									<span class="video-desc">Watch a clean, step-by-step walkthrough of how we organize an AI Brain inside Google Antigravity and run a basic example in Google Flow to create and export 10-second MP4 video clips.</span>
									<span style="display: inline-block; margin-top: 8px; padding: 5px 12px; border-radius: 9999px; background: rgba(56, 189, 248, 0.12); border: 1px solid rgba(212, 175, 55, 0.45); color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">🔓 Full 4:26 Unlisted Tier 01 Setup Walkthrough unlocks inside the Buyer Vault</span>
								</div>
							</div>
							<div class="t1-media-highlights-grid">
								<div class="t1-highlight-pill t1-pill-blue">
									<span class="t1-hl-tag">01 • AI BRAIN WORKSPACE</span>
									<strong>Clean Folder &amp; Memory Setup</strong>
									<span>Organize your project folders and core rules so your AI remembers your instructions every session.</span>
								</div>
								<div class="t1-highlight-pill t1-pill-gold">
									<span class="t1-hl-tag">02 • GOOGLE FLOW BASICS</span>
									<strong>10-Second Video Walkthrough</strong>
									<span>See how to pair short scene prompts with reference images to export clean MP4 video clips.</span>
								</div>
								<div class="t1-highlight-pill t1-pill-gold">
									<span class="t1-hl-tag">03 • ILLUSTRATED %PDF-1.7 BOOKS</span>
									<strong>4 Manuals + Master Book</strong>
									<span>Illustrated PDF setup manuals, combined quickstart book, and starter .ZIP sent straight to you.</span>
								</div>
								<div class="t1-highlight-pill t1-pill-blue">
									<span class="t1-hl-tag">04 • GUIDED SETUP WINDOW</span>
									<strong>7-Day Setup + 3 Follow-Ups</strong>
									<span>Includes 7-day guided setup support and up to 3 follow-up setup questions to get you running.</span>
								</div>
							</div>
						</div>

						<div class="product-info-col">
							<div class="product-badge-row">
								<span class="badge-tier-cyan">TIER 01 // FOUNDATION: AI BRAIN &amp; GOOGLE FLOW</span>
								<span class="badge-discount-gold">ONE-TIME PAYMENT • 100% UPGRADE CREDIT</span>
							</div>
							<h2 class="product-title">AI Brain Setup &amp; Basic Google Flow Video Walkthrough</h2>
							<div class="product-price-row">
								<span class="price-symbol">$</span>
								<span class="price-val">49.50</span>
								<span class="price-currency">USD • ONE-TIME PAYMENT</span>
								<span class="price-original"><del>$99.00</del></span>
							</div>
							<p class="product-lead-copy">
								Every build starts with a clean foundation. In Tier 01, we organize your <strong>4-Folder AI Brain</strong> inside Google Antigravity so it remembers your projects, and walk you through a <strong>practical Google Flow video workflow</strong> (~20-word scene prompts + 3 reference chips) so you can generate and export clean 10-second MP4 clips.
							</p>

							<div class="product-deliverables-box">
								<h4>📋 The Basics We Cover Together in Tier 01:</h4>
								<ul>
									<li><strong>🧠 Step 1 — Setting Up Your 4-Folder AI Brain:</strong> Organize a persistent AI Brain workspace (<code class="kr-code-pill">AGENTS.md</code>) in Google Antigravity so your AI remembers your voice, rules, and project files.</li>
									<li><strong>🎬 Step 2 — ~20-Word Google Flow Video Walkthrough:</strong> Pair 18–24 word scene prompts with 3 reference images and export 1080p 10-second MP4 video clips cleanly.</li>
									<li><strong>📄 Step 3 — 4 Illustrated %PDF-1.7 Guides + Combined Master Book:</strong> Full printable manuals (<code class="kr-code-pill">PDF-01..04</code> + combined Tier 01 Master Book) and starter <code class="kr-code-pill-gold">.ZIP</code> pack unlocked immediately.</li>
									<li><strong>🤖 Step 4 — 7-Day Guided Setup Support (Up to 3 Follow-Ups):</strong> Automated Setup Assistant + up to 3 follow-up questions, with 100% of your $49.50 credited if you upgrade later.</li>
								</ul>
							</div>

							<div class="product-checkout-box">
								<button type="button" class="btn-cyan-buy js-open-automated-order" data-tier="1" data-price="49.50" data-name="Tier 01 — $49.50 USD One-Time: AI Brain & Google Flow Starter" style="cursor: pointer; width: 100%;">
									⚡ GET TIER 01 ONE-TIME ACCESS &amp; START SETUP ($49.50 USD) →
								</button>
								<div class="checkout-trust-line">
									💎 One-Time Payment • 100% Credit Toward Tier 02 ($149.50 net) or Tier 03 ($750.50 net) Anytime
								</div>
							</div>
						</div>

					</div>
				</div>

				<!-- 2-COLUMN SIDE-BY-SIDE PORTAL GRID FOR TIER 02 ($199) & TIER 03 ($800) -->
				<div class="portal-two-col-grid">
				<!-- PRODUCT 2: $199 6-AGENT ROLE SUITE + MULTI-AGENT WEBSITE ARCHITECTURE -->
				<div id="tier-swarm" class="protocol-product-block portal-half-card">
					<span id="kr-tier-2" aria-hidden="true"></span>
					<div class="product-grid">

						<div class="product-media-col">
							<div class="video-preview-card">
								<div class="video-thumb-wrap" style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 14px 14px 0 0; background: #04070d;">
									<iframe src="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $hero_intro_vid ); ?>?start=80&amp;rel=0&amp;modestbranding=1"
											title="Tier 02: 6-Agent Role Suite + Multi-Agent Website Architecture"
											style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
											allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
											allowfullscreen loading="lazy"></iframe>
								</div>
								<div class="video-card-meta">
									<div style="font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 800; color: #38bdf8; margin-bottom: 4px;">@KeyStoneRecomposition &bull; AI Protocols Suite</div>
									<span class="video-title">6-Agent Role Suite + Custom Website &amp; Brand Channel</span>
									<span class="video-desc">Connect your Tier 01 AI Brain to launch a dark-luxury website, configure your YouTube Brand Channel, and orchestrate our 6-Agent Role Suite + Multi-Agent Architecture.</span>
									<span style="display: inline-block; margin-top: 8px; padding: 5px 12px; border-radius: 9999px; background: rgba(56, 189, 248, 0.12); border: 1px solid rgba(212, 175, 55, 0.45); color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">🔓 Full 5:28 Unlisted Tier 02 Multi-Agent Walkthrough unlocks inside the Buyer Vault</span>
								</div>
							</div>
						</div>

						<div class="product-info-col">
							<div class="product-badge-row">
								<span class="badge-tier-cyan">TIER 02 // EXPANSION: 6-AGENT SUITE &amp; WEBSITE</span>
								<span class="badge-discount-gold">ONE-TIME PAYMENT • INCLUDES TIER 01</span>
							</div>
							<h2 class="product-title">6-Agent Role Suite + Multi-Agent Website &amp; Brand Channel</h2>
							<div class="product-price-row">
								<span class="price-symbol">$</span>
								<span class="price-val">199</span>
								<span class="price-currency">USD • ONE-TIME PAYMENT</span>
							</div>
							<p class="product-lead-copy">
								Builds directly on Tier 01. Deploy our <strong>6-Agent Role Suite + Multi-Agent Architecture</strong> alongside your <strong>custom dark-luxury website templates</strong>, Rank Math 100/100 JSON-LD SEO schema, 3-source fact verification gate, and <strong>YouTube Brand Channel</strong> defaults.
							</p>

							<div class="product-deliverables-box">
								<h4>📋 What We Cover in Tier 02 (Includes Everything in Tier 01):</h4>
								<ul>
									<li><strong>🤝 Step 1 — 6-Agent Role Suite + Multi-Agent Architecture:</strong> Dedicated specialist roles (Research Scout, Source Challenger, Scriptwriter, Web Engineer, B2B Outreach, and Boss QA) that keep context clean.</li>
									<li><strong>🌐 Step 2 — Custom Dark-Luxury Website &amp; Rank Math SEO:</strong> Build high-converting Obsidian/Gold/Cyan pages, JSON-LD schema, and Google Search Console indexing workflows.</li>
									<li><strong>📺 Step 3 — YouTube Brand Channel &amp; B2B Outreach Shell:</strong> 480-char SEO tag stacks, Upload Defaults, MX verification workflow, and Locked Crest HTML email shell (<code class="kr-code-pill">PDF-05..09</code> + Master Book).</li>
									<li><strong>🤖 Step 4 — 7-Day Guided Setup Support (Up to 5 Follow-Ups):</strong> Includes Tier 01 + 7-day setup support (or upgrade from Tier 01 for just <strong>$149.50 USD</strong>).</li>
								</ul>
							</div>

							<div class="product-checkout-box">
								<button type="button" class="btn-cyan-buy js-open-automated-order" data-tier="2" data-price="199" data-name="Tier 02 — $199 USD One-Time: 6-Agent Role Suite + Website Architecture" style="cursor: pointer; width: 100%;">
									🚀 GET TIER 02 6-AGENT &amp; WEBSITE ACCESS ($199 USD) →
								</button>
								<div class="checkout-trust-line">
									💎 Includes Tier 01 • Tier 01 Buyers Pay Only $149.50 • Credits $199 Toward Tier 03 ($601 net)
								</div>
							</div>
						</div>

					</div>
				</div>

				<!-- PRODUCT 3: $800 COMPLETE RUNNABLE RUST + TAURI v2 DESKTOP SOURCE (.EXE) -->
				<div id="tier-workstation" class="protocol-product-block featured-product portal-half-card">
					<span id="kr-tier-3" aria-hidden="true"></span>
					<div class="product-grid">

						<div class="product-media-col">
							<div class="video-preview-card">
								<div id="krTier3PreviewFacade" data-yt-preview-id="<?php echo esc_attr( $kr_t3_vid ); ?>" class="video-thumb-wrap" style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 14px 14px 0 0; background: #04070d;">
									<button type="button" onclick="krActivateTierVideoFacade('krTier3PreviewFacade', '<?php echo esc_js( $kr_t3_vid ); ?>')" aria-label="Play 4K Tier 03 Rust + Tauri v2 Desktop Command Center Walkthrough Preview" style="position: absolute; inset: 0; width: 100%; height: 100%; padding: 0; border: 0; background: #04070d; cursor: pointer; display: flex; align-items: center; justify-content: center; overflow: hidden;">
										<img src="https://i.ytimg.com/vi/<?php echo esc_attr( $kr_t3_vid ); ?>/hqdefault.jpg" alt="Tier 03 Preview — Runnable Rust + Tauri v2 Desktop Command Center (.EXE)" loading="lazy" decoding="async" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.82;" />
										<span style="position: relative; z-index: 2; display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #f6d365 0%, #d4af37 55%, #b8860b 100%); color: #04070d; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 900; padding: 11px 20px; border-radius: 9999px; box-shadow: 0 10px 28px rgba(0, 0, 0, 0.82);">
											▶ PREVIEW TIER 03 TAURI v2 .EXE WALKTHROUGH (5:54)
										</span>
									</button>
								</div>
								<div class="video-card-meta">
									<div style="font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 800; color: #f6d365; margin-bottom: 4px;">@KeyStoneRecomposition &bull; AI Protocols Suite</div>
									<span class="video-title">Complete Runnable Rust + Tauri v2 Desktop Command Center (.EXE)</span>
									<span class="video-desc">Click above to preview Wayne's 5:54 walkthrough of the runnable Rust + Tauri v2 desktop source project, custom dark-luxury tabs, and 1-command Windows .EXE compiler.</span>
									<span style="display: inline-block; margin-top: 8px; padding: 5px 12px; border-radius: 9999px; background: rgba(212, 175, 55, 0.14); border: 1px solid rgba(212, 175, 55, 0.55); color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">🔓 Unlocks All 3 Tiers + Runnable src-tauri Source ZIP + All 12 %PDF-1.7 Manuals</span>
								</div>
							</div>
						</div>

						<div class="product-info-col">
							<div class="product-badge-row">
								<span class="badge-tier-cyan">TIER 03 // CAPSTONE: RUNNABLE RUST + TAURI v2 SOURCE</span>
								<span class="badge-capacity-alert">ONE-TIME PAYMENT • INCLUDES TIERS 01 &amp; 02</span>
							</div>
							<h2 class="product-title">Complete Runnable Rust + Tauri v2 Desktop Source &amp; 1-Command .EXE Compiler</h2>
							<div class="product-price-row">
								<span class="price-symbol">$</span>
								<span class="price-val">800</span>
								<span class="price-currency">USD • ONE-TIME PAYMENT</span>
							</div>
							<p class="product-lead-copy">
								The complete sovereign desktop stack. Includes everything in Tiers 01 and 02 plus the <strong>Complete Runnable Rust + Tauri v2 Desktop Command Center Source Project</strong> (<code class="kr-code-pill">Cargo.toml</code>, <code class="kr-code-pill">src-tauri/</code>, dark-luxury UI tabs) and our <strong>1-Command Windows <code class="kr-code-pill-gold">.EXE</code> Compiler</strong> with <strong>14-Day Guided Build Support</strong>.
							</p>

							<div class="product-deliverables-box">
								<h4>🖥️ What We Cover in Tier 03 (Includes Tiers 01 &amp; 02):</h4>
								<ul>
									<li><strong>🖥️ Step 1 — Complete Runnable Rust + Tauri v2 Source Project:</strong> Ready-to-build <code class="kr-code-pill">src-tauri/</code> Rust backend + dark-luxury command center frontend inside your AI Brain workspace.</li>
									<li><strong>🎛️ Step 2 — Custom Dashboard Tabs &amp; One-Click Action Buttons:</strong> Wire custom navigation tabs, status telemetry, and 1-click workflow buttons to your AI Brain and Website.</li>
									<li><strong>⚙️ Step 3 — 1-Command Windows .EXE Compiler + All 12 PDFs:</strong> Run the included PowerShell release compiler to build your standalone Windows <code class="kr-code-pill-gold">.exe</code> binary (<code class="kr-code-pill">PDF-10..12</code> + Master Books).</li>
									<li><strong>🤖 Step 4 — 14-Day Guided Build Support (Up to 8 Follow-Ups):</strong> Direct setup &amp; architectural review window (Tier 01 buyers upgrade for <strong>$750.50</strong>; Tier 02 buyers upgrade for <strong>$601.00</strong>).</li>
								</ul>
							</div>

							<div class="product-checkout-box">
								<button type="button" class="btn-gold-buy js-open-automated-order" data-tier="3" data-price="800" data-name="Tier 03 — $800 USD One-Time: Runnable Rust + Tauri v2 Desktop Source (.EXE)" style="cursor: pointer; width: 100%;">
									🖥️ GET TIER 03 TAURI v2 SOURCE &amp; .EXE ACCESS ($800 USD) →
								</button>
								<div class="checkout-trust-line">
									🏛️ Unlocks All 3 Tiers • 14-Day Guided Build Support • Upgrade Credit Eligible ($750.50 / $601 net)
								</div>
							</div>
						</div>

					</div>
				</div>
				</div><!-- /.portal-two-col-grid -->

			</div>
		</section>

		<!-- 3. COMPETITIVE ARCHITECTURE CALLOUT -->
		<section class="protocols-benchmark-section">
			<div class="ast-container">
				<div class="competitive-matrix-card">
					<div class="matrix-header">
						<span class="matrix-tag">THE 3-TIER SYNERGY BENCHMARK</span>
						<h3 class="matrix-title">How Your AI Brain, 6-Agent Website Suite &amp; Tauri v2 Desktop App Fit Together</h3>
						<p class="matrix-desc">
							"When you pour concrete or frame high-load timber structures, every phase builds on a level foundation. In our 3-tier AI system, your Brain powers your Website, and your Tauri Desktop App controls it all." — Wayne Stevenson
						</p>
					</div>
					<div class="matrix-grid">
						<div class="matrix-col matrix-col-blue">
							<h4>🧠 1. AI Brain &amp; Flow ($49.50)</h4>
							<p>Organize your 4-folder AI Brain in Google Antigravity and generate clean ~20-word 10-second MP4 video clips in Google Flow.</p>
						</div>
						<div class="matrix-col matrix-col-gold">
							<h4>🌐 2. 6-Agent + Website ($199)</h4>
							<p>Deploy the 6-Agent Role Suite + Multi-Agent Architecture, launch a dark-luxury website, and configure your YouTube Brand Channel.</p>
						</div>
						<div class="matrix-col matrix-col-blue">
							<h4>🖥️ 3. Tauri v2 Source ($800)</h4>
							<p>Unpack the Complete Runnable Rust + Tauri v2 Desktop Command Center Source Project and compile your standalone Windows .EXE binary.</p>
						</div>
						<div class="matrix-col matrix-col-gold">
							<h4>🛡️ 100% Upgrade Credit</h4>
							<p>Every dollar paid toward Tier 01 ($49.50) or Tier 02 ($199) credits 100% toward higher tiers anytime, backed by 7-to-14 day Guided Support.</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- 3B. VISIBLE 7-QUESTION EXECUTIVE BUYER FAQ ACCORDION (SYNCED 1:1 WITH /ai-protocols/#faq JSON-LD) -->
		<?php
		$kr_ai_buyer_faqs = function_exists( 'keystone_get_ai_protocols_buyer_faqs' )
			? keystone_get_ai_protocols_buyer_faqs()
			: array(
				array(
					'q' => 'What happens in the first 60 seconds after I pay with Visa or Mastercard?',
					'a' => 'Within seconds of completing 256-bit Stripe USD checkout, you are redirected back to /ai-protocols/ where your personal Buyer KR-UID unlocks the Self-Service Buyer Vault on screen—giving you immediate access to your unlisted 4K recorded walkthrough videos, downloadable .ZIP starter packs, illustrated %PDF-1.7 setup books, and an automated backup receipt emailed straight to your inbox.',
				),
				array(
					'q' => 'Do I need prior coding or terminal experience to set up Tier 01 or Tier 02?',
					'a' => 'No prior coding is required. Every module uses copy-paste starter prompts, ready-to-drop Markdown rule files (AGENTS.md), timestamped 4K walkthrough chapters, and illustrated %PDF-1.7 manuals designed so Google Antigravity writes and organizes your folders, prompts, and website layouts step by step.',
				),
				array(
					'q' => 'How does the 100% dollar-for-dollar Tier Upgrade Credit work if I start at $49.50?',
					'a' => 'Every dollar you spend on an earlier tier is credited 100% toward higher tiers at any time using your Buyer KR-UID. Starting at Tier 01 ($49.50 USD) means upgrading later to Tier 02 ($199 USD) costs only $149.50 USD, or upgrading to Tier 03 ($800 USD) costs only $750.50 USD (and upgrading from Tier 02 to Tier 03 costs $601.00 USD).',
				),
				array(
					'q' => 'Are there any recurring monthly fees or subscriptions charged by Keystone?',
					'a' => 'Zero recurring fees to Keystone. Each tier ($49.50, $199, or $800 USD) is a single one-time purchase with permanent ownership of your downloaded .ZIP starter files and %PDF-1.7 books. You simply run the workflows inside your own Google Antigravity and Google Flow workspace.',
				),
				array(
					'q' => 'Does the AI Builder Suite work on both Mac and Windows, and what are the Tier 03 .EXE prerequisites?',
					'a' => 'Yes—Tier 01 (4-Folder AI Brain & Google Flow ~20-word video workflow) and Tier 02 (Dark-Luxury Website, SEO Schema & 6-Agent Role Suite) work identically on macOS, Windows, and Linux. Compiling the standalone Windows .EXE binary in Tier 03 uses Windows 10/11 (64-bit) with the free Microsoft WebView2, Node.js LTS, and Rust (rustup) toolchain guided step by step.',
				),
				array(
					'q' => 'What exactly is inside Tier 03 ($800 USD) — is it a locked binary or runnable Rust + Tauri v2 source code?',
					'a' => 'Tier 03 gives you the Complete Runnable Rust + Tauri v2 Desktop Command Center Source Project (Cargo.toml, src-tauri/src/main.rs, tauri.conf.json, dark-luxury UI dashboard, and 1-command Windows .EXE compiler script), plus everything in Tiers 01 and 02, all 12 illustrated %PDF-1.7 manuals, and 14-Day Guided Build Support so you own and customize your own desktop executable.',
				),
				array(
					'q' => 'Can I apply a promo code at Visa checkout, and what is included in the Guided Setup Support window?',
					'a' => 'Yes—enter a valid promo code (such as BUILDER10) on the Express Checkout card or order modal before clicking Pay with Visa / Mastercard and the discounted USD total is passed directly to Stripe. Tier 01 includes a 7-day Guided Setup Window (up to 3 follow-up questions), Tier 02 includes 7 days (up to 5 follow-ups), and Tier 03 includes 14 days of Guided Build Support (up to 8 follow-ups plus architectural review).',
				),
			);
		?>
		<section id="ai-protocols-faq" style="padding: 28px 0 40px 0; background: #04070d; border-top: 1px solid rgba(56, 189, 248, 0.18);" aria-label="AI Protocols Buyer Frequently Asked Questions">
			<div class="ast-container">
				<div class="kr-faq-wrap" style="max-width: 980px; margin: 0 auto;">
					<span class="kr-v4-kicker kr-v4-kicker--gold"><span class="kr-v4-kicker-dot"></span> EXECUTIVE BUYER FAQ &middot; DELIVERY, PREREQUISITES &amp; UPGRADE CREDIT</span>
					<h2 class="kr-v4-h2">Direct Answers Before You Unlock Your Vault</h2>
					<p class="kr-v4-lead" style="margin-bottom: 22px;">Clear specifications on 60-second Visa delivery, Mac &amp; Windows compatibility, 100% dollar-for-dollar tier upgrade credit, and runnable Tauri v2 source ownership.</p>

					<div class="kr-faq-list">
						<?php foreach ( $kr_ai_buyer_faqs as $b_idx => $bfaq ) : ?>
							<details class="kr-faq-item" <?php echo 0 === $b_idx ? 'open' : ''; ?>>
								<summary>
									<span><?php echo esc_html( $bfaq['q'] ); ?></span>
									<span class="kr-faq-plus" aria-hidden="true">+</span>
								</summary>
								<div class="kr-faq-answer">
									<?php echo esc_html( $bfaq['a'] ); ?>
								</div>
							</details>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
		</div>
	</main>
</div>

<!-- 4. ON-SCREEN BREAKDOWN SPEC PDF VIEWER MODAL (WITH 1-CLICK COPY PROMPTS & %PDF-1.7 SERVER DOWNLOAD) -->
<div id="krSpecPdfModal" style="display: none; position: fixed; inset: 0; z-index: 10060; background: rgba(4, 7, 13, 0.94); align-items: center; justify-content: center; padding: 20px; overflow-y: auto;">
	<div style="background: linear-gradient(145deg, #0b111e 0%, #050911 100%); border: 1.5px solid #d4af37; border-radius: 22px; max-width: 780px; width: 100%; padding: 26px; box-shadow: 0 24px 64px rgba(0,0,0,0.95); position: relative; color: #f8fafc; max-height: 90vh; overflow-y: auto;">
		<button type="button" onclick="document.getElementById('krSpecPdfModal').style.display='none'" style="position: absolute; top: 16px; right: 16px; width: 34px !important; height: 34px !important; min-width: 34px !important; padding: 0 !important; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; background: #04070d; border: 1px solid #d4af37; color: #f6d365; font-weight: 900; cursor: pointer;">✕</button>
		<div id="krSpecPdfModalBadge" style="display: inline-block; background: rgba(212, 175, 55, 0.15); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 4px 12px; border-radius: 9999px; margin-bottom: 8px;"></div>
		<h3 id="krSpecPdfModalTitle" style="font-family: 'Outfit', sans-serif; font-size: 1.35rem; font-weight: 900; color: #ffffff; margin: 0 0 12px 0;"></h3>
		<div id="krSpecPdfModalBody" style="font-size: 0.85rem; color: #cbd5e1; line-height: 1.6;"></div>
		<div style="margin-top: 18px; padding-top: 14px; border-top: 1px solid rgba(212, 175, 55, 0.3); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
			<button type="button" id="krSpecPdfDownloadBtn" class="kr-copy-btn" style="padding: 10px 20px; font-size: 0.80rem;">
				⬇ DOWNLOAD ILLUSTRATED SERVER PDF (%PDF-1.7)
			</button>
			<button type="button" onclick="document.getElementById('krSpecPdfModal').style.display='none'" style="background: rgba(56, 189, 248, 0.15); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 9px 18px; font-size: 0.78rem; font-weight: 800; cursor: pointer;">
				Close Spec Viewer
			</button>
		</div>
	</div>
</div>

<!-- 5. INTERACTIVE VISA / MASTERCARD CHECKOUT & UPGRADE CREDIT MODAL -->
<div id="automatedOrderModal" style="display: none; position: fixed; inset: 0; z-index: 10050; background: rgba(4, 7, 13, 0.92); align-items: center; justify-content: center; padding: 20px; overflow-y: auto;">
	<div style="background: linear-gradient(145deg, #0b111e 0%, #060a12 100%); border: 1.5px solid #38bdf8; border-radius: 22px; max-width: 660px; width: 100%; padding: 28px 26px; box-shadow: 0 24px 60px rgba(0, 0, 0, 0.95), 0 0 35px rgba(56, 189, 248, 0.25); position: relative; color: #f8fafc;">
		<button type="button" id="closeAutomatedOrderModal" aria-label="Close modal" style="position: absolute; top: 16px; right: 16px; width: 34px; height: 34px; border-radius: 50%; background: rgba(15, 23, 42, 0.9); border: 1px solid rgba(56, 189, 248, 0.4); color: #38bdf8; font-size: 1rem; font-weight: 800; cursor: pointer;">✕</button>

		<div style="display: inline-block; background: rgba(212, 175, 55, 0.15); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 4px 12px; border-radius: 9999px; letter-spacing: 0.06em; margin-bottom: 10px;">
			💳 INSTANT VISA / MASTERCARD USD CHECKOUT • IMMEDIATE VAULT DELIVERY
		</div>

		<h3 id="modalTierHeadline" style="font-family: 'Outfit', sans-serif; font-size: 1.45rem; font-weight: 900; color: #ffffff; margin: 0 0 8px 0;">
			Complete Your Order — Tier 01 ($49.50 USD: AI Brain &amp; Google Flow Starter)
		</h3>
		<p style="font-size: 0.85rem; color: #cbd5e1; line-height: 1.55; margin: 0 0 14px 0;">
			Proceed directly to <strong>256-Bit Stripe USD Visa / Mastercard Checkout</strong> (pre-fill below or enter your email right on Stripe) to immediately unlock your <strong>Verified Buyer UID (<code class="kr-code-pill">KR-UID-...</code>), Unlisted 4K Walkthrough Video, Illustrated Server <code class="kr-code-pill">%PDF-1.7</code> Books, Clean-Room <code class="kr-code-pill-gold">.ZIP</code> Starter Pack &amp; Guided Setup Window</strong>.
		</p>

		<div id="modalUpgradeCreditBanner" style="display: none; margin-bottom: 12px; padding: 10px 14px; border-radius: 12px; background: rgba(212, 175, 55, 0.14); border: 1px solid #d4af37; color: #f8fafc; font-size: 0.78rem; line-height: 1.45;"></div>

		<form id="automatedProtocolOrderForm" data-keystone-form-ignore="true" style="display: flex; flex-direction: column; gap: 12px;">
			<input type="hidden" id="orderTierInput" name="tier" value="1" />
			<div>
				<label style="display: block; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 700; color: #f6d365; margin-bottom: 5px;">SELECTED PROTOCOL TIER</label>
				<select id="modalTierSelect" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; font-family: 'Outfit', sans-serif; font-size: 0.86rem; font-weight: 700; padding: 10px 12px;">
					<option value="1">Tier 01 — $49.50 USD One-Time: AI Brain Setup &amp; Basic Google Flow Walkthrough</option>
					<option value="2">Tier 02 — $199.00 USD One-Time: 6-Agent Role Suite + Multi-Agent Website Architecture</option>
					<option value="3">Tier 03 — $800.00 USD One-Time: Complete Runnable Rust + Tauri v2 Desktop Source (.EXE)</option>
				</select>
			</div>
			<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
				<div>
					<label style="display: block; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 700; color: #cbd5e1; margin-bottom: 5px;">YOUR NAME (OPTIONAL)</label>
					<input type="text" id="orderBuyerName" placeholder="Optional — or enter on Stripe" autocomplete="name" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 10px; color: #f8fafc; font-size: 0.84rem; padding: 10px 12px; box-sizing: border-box;" />
				</div>
				<div>
					<label style="display: block; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 700; color: #cbd5e1; margin-bottom: 5px;">EMAIL FOR RECEIPT (OPTIONAL)</label>
					<input type="email" id="orderBuyerEmail" placeholder="Optional — or enter on Stripe" autocomplete="email" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 10px; color: #f8fafc; font-size: 0.84rem; padding: 10px 12px; box-sizing: border-box;" />
				</div>
			</div>
			<div style="display: grid; grid-template-columns: 1fr auto; gap: 8px; align-items: end;">
				<div>
					<label for="modalPromoInput" style="display: block; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 700; color: #cbd5e1; margin-bottom: 5px;">PROMO CODE (OPTIONAL)</label>
					<input type="text" id="modalPromoInput" placeholder="e.g. BUILDER10" style="width: 100%; background: #04070d; border: 1px solid rgba(212, 175, 55, 0.42); border-radius: 10px; color: #f8fafc; font-family: 'JetBrains Mono', monospace; font-size: 0.82rem; padding: 10px 12px; box-sizing: border-box;" />
				</div>
				<button type="button" id="modalApplyPromoBtn" style="background: rgba(212, 175, 55, 0.18); border: 1px solid #d4af37; color: #f6d365; border-radius: 10px; padding: 10px 16px; font-family: 'Outfit', sans-serif; font-size: 0.78rem; font-weight: 800; cursor: pointer;">APPLY</button>
			</div>
			<div id="modalPromoFeedback" style="display: none; font-size: 0.76rem; font-weight: 700;"></div>
			<div>
				<label style="display: block; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 700; color: #cbd5e1; margin-bottom: 5px;">YOUTUBE CHANNEL OR WEBSITE GOALS (OPTIONAL)</label>
				<input type="text" id="orderBuyerNotes" placeholder="Tell us your channel niche or website domain..." style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 10px; color: #f8fafc; font-size: 0.84rem; padding: 10px 12px; box-sizing: border-box;" />
			</div>
			<div style="display: flex; flex-direction: column; gap: 8px; margin-top: 6px;">
				<button type="button" id="submitStripeCardBtn" style="background: linear-gradient(135deg, #d4af37 0%, #f3e5ab 50%, #aa8010 100%); color: #04070d !important; font-family: 'Outfit', sans-serif; font-size: 0.94rem; font-weight: 900; letter-spacing: 0.04em; padding: 14px 22px; border-radius: 9999px; border: none; cursor: pointer; box-shadow: 0 8px 24px rgba(212, 175, 55, 0.4); display: flex; align-items: center; justify-content: center; gap: 8px;">
					<span>💳</span> <span id="stripeCardBtnText">PAY WITH VISA / MASTERCARD &amp; UNLOCK VAULT ($49.50 USD) →</span>
				</button>
				<?php if ( ! $kr_visa_live ) : ?>
				<button type="submit" id="submitAutomatedOrderBtn" style="background: rgba(11, 17, 30, 0.9); border: 1px solid rgba(56, 189, 248, 0.5); color: #38bdf8; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 800; letter-spacing: 0.04em; padding: 11px 18px; border-radius: 9999px; cursor: pointer;">
					🔒 DEV FALLBACK: RESERVE LAUNCH RATE →
				</button>
				<?php endif; ?>
				<div id="modalCheckoutFeedback" style="display: none; margin-top: 4px; padding: 10px 12px; border-radius: 12px; background: rgba(4, 7, 13, 0.96); border: 1px solid #38bdf8; font-size: 0.78rem; color: #f8fafc; line-height: 1.45;"></div>
			</div>
			<div style="display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 0.72rem; color: #94a3b8; font-family: 'JetBrains Mono', monospace; margin-top: 4px; flex-wrap: wrap;">
				<span>🛡️ 256-Bit Encrypted Stripe Checkout</span> &bull; <span>🇺🇸 USD Funds</span> &bull; <span>💎 100% Upgrade Credit Protected</span>
			</div>
		</form>

		<!-- Instant Reservation / Fulfillment Result Screen -->
		<div id="orderFulfillmentSuccessBox" style="display: none; margin-top: 18px; padding: 18px; border-radius: 16px; background: rgba(4, 7, 13, 0.96); border: 1.5px solid #d4af37;">
			<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; margin-bottom: 10px;">
				<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">✔ LAUNCH RATE LOCKED IN &amp; PORTAL UNLOCKED</span>
				<span id="fulfilledUidReadout" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.74rem; font-weight: 900; padding: 3px 10px; border-radius: 9999px;"></span>
			</div>
			<p id="fulfilledMessageText" style="font-size: 0.85rem; color: #f8fafc; margin: 0; line-height: 1.55; font-weight: 600;"></p>
			<div id="fulfilledLiveDownloadsWrap" style="display: none; margin-top: 12px;">
				<div style="margin-bottom: 12px;">
					<div style="font-family: 'Outfit', sans-serif; font-size: 0.80rem; font-weight: 800; color: #38bdf8; margin-bottom: 6px;">🎬 STEP 1: WATCH WAYNE'S RECORDED STEP-BY-STEP WALKTHROUGH</div>
					<a id="fulfilledVideoBtn" href="https://www.youtube.com/watch?v=<?php echo esc_attr( $kr_t1_vid ); ?>" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #d4af37 0%, #f3e5ab 50%, #aa8010 100%); color: #04070d !important; -webkit-text-fill-color: #04070d !important; font-family: 'Outfit', sans-serif; font-size: 0.80rem; font-weight: 900; padding: 9px 18px; border-radius: 9999px; text-decoration: none !important;">
						▶ WATCH RECORDED AI VIDEO &amp; BRAIN WALKTHROUGH
					</a>
				</div>
				<div>
					<div style="font-family: 'Outfit', sans-serif; font-size: 0.80rem; font-weight: 800; color: #f6d365; margin-bottom: 6px;">📦 STEP 2: INSTANT UID-UNLOCKED COPY-PASTE PROMPT PACKS</div>
					<ul id="fulfilledDownloadsList" style="margin: 0; padding-left: 18px; color: #cbd5e1; font-size: 0.80rem; line-height: 1.65;"></ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 6. SELF-SERVICE PORTAL, REAL SERVER %PDF-1.7 DOWNLOAD ENGINE, UPGRADE CREDIT & GUIDED SETUP ASSISTANT SCRIPT -->
<script>
window.KR_VISA_LIVE = <?php echo $kr_visa_live ? 'true' : 'false'; ?>;

window.krActivateTierVideoFacade = function(containerId, videoId) {
	const wrap = document.getElementById(containerId);
	if (!wrap || !videoId) return;
	wrap.innerHTML = '<iframe src="https://www.youtube-nocookie.com/embed/' + encodeURIComponent(videoId) + '?autoplay=1&rel=0&modestbranding=1" title="Tier 03 Walkthrough Preview" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
};

const KR_PDF_SERVER_SLUGS = {
	'PDF-01': 'tier1_pdf_01',
	'PDF-02': 'tier1_pdf_02',
	'PDF-03': 'tier1_pdf_03',
	'PDF-04': 'tier1_pdf_04',
	'PDF-05': 'tier2_pdf_05',
	'PDF-06': 'tier2_pdf_06',
	'PDF-07': 'tier2_pdf_07',
	'PDF-08': 'tier2_pdf_08',
	'PDF-09': 'tier2_pdf_09',
	'PDF-10': 'tier3_pdf_10',
	'PDF-11': 'tier3_pdf_11',
	'PDF-12': 'tier3_pdf_12',
	'MASTER-T1': 'tier1_pdf_master',
	'MASTER-T2': 'tier2_pdf_master',
	'MASTER-T3': 'tier3_pdf_master'
};

const KR_SPEC_PDF_CATALOG = {
	'PDF-01': {
		id: 'PDF-01',
		serverSlug: 'tier1_pdf_01',
		tier: 'Tier 01 ($49.50)',
		filename: 'KR_T1_01_Antigravity_Brain_Architecture_Guide.pdf',
		title: 'PDF-01: $30 Antigravity Plan & Visual 4-Folder AI Brain Setup Diagram',
		steps: [
			'Step 1: Subscribe to the $30/mo Google Antigravity plan and open a new local folder named My_AI_Brain.',
			'Step 2: Paste the Copy-Paste Brain Setup Prompt below into Antigravity.',
			'Step 3: Antigravity automatically creates 01_Brain_Rules, 02_Video_Prompts, 03_Website_Builder, and 04_YouTube_Channel.',
			'Step 4: Open 01_Brain_Rules/AGENTS.md to verify your brand name, niche, and website URL are locked in.'
		],
		copyPromptLabel: 'COPY-PASTE ANTIGRAVITY BRAIN SETUP PROMPT #1',
		copyPrompt: 'You are my lead AI Systems Architect inside Google Antigravity. Create 4 folders in my workspace: 01_Brain_Rules, 02_Video_Prompts, 03_Website_Builder, and 04_YouTube_Channel. Inside 01_Brain_Rules/AGENTS.md, write my brand voice rules, target audience, and website URL so you remember them in every chat.'
	},
	'PDF-02': {
		id: 'PDF-02',
		serverSlug: 'tier1_pdf_02',
		tier: 'Tier 01 ($49.50)',
		filename: 'KR_T1_02_Google_Flow_20_Word_Video_Manual.pdf',
		title: 'PDF-02: Generating ~20-Word (18-24 Word) Google Flow Video Prompts & Exporting MP4s',
		steps: [
			'Step 1: Open Google Flow and upload 3 reference images (1 Headshot photo, 1 Outfit photo, 1 Studio Room photo).',
			'Step 2: Paste the ~20-Word Scene Prompt Generator below into Antigravity to write 6 concise 18-to-24 word video prompts.',
			'Step 3: Paste each ~20-word scene prompt into Google Flow to generate 10-second video clips with clean lip-sync.',
			'Step 4: Click Export / Download MP4 (1080p) on each finished clip and save to your project folder.'
		],
		copyPromptLabel: 'COPY-PASTE ~20-WORD GOOGLE FLOW PROMPT GENERATOR',
		copyPrompt: 'Write 6 sequential 10-second Google Flow video scene prompts for my topic. Keep each visual prompt strictly between 18 and 24 words (~20 words) describing the presenter speaking warmly to camera with natural two-handed gestures in a modern acoustic oak studio on a 35mm cinema lens.'
	},
	'PDF-03': {
		id: 'PDF-03',
		serverSlug: 'tier1_pdf_03',
		tier: 'Tier 01 ($49.50)',
		filename: 'KR_T1_03_YouTube_Brand_Channel_480Tag_Guide.pdf',
		title: 'PDF-03: YouTube Brand Channel Setup, Upload Defaults & 480-Character Tag Stack',
		steps: [
			'Step 1: Visit youtube.com/channel_switcher and create a dedicated Brand Account for your business channel.',
			'Step 2: Open YouTube Studio -> Settings -> Upload Defaults and paste your permanent website link and chapter structure.',
			'Step 3: Paste the Copy-Paste YouTube Channel Prompt below into Antigravity to generate your 480-character SEO tag stack.',
			'Step 4: Link your 30-50 second vertical Companion Short to your main episode using the Related Video field.'
		],
		copyPromptLabel: 'COPY-PASTE YOUTUBE BRAND CHANNEL & 480-CHAR TAG PROMPT',
		copyPrompt: 'Write my YouTube Brand Channel description, Upload Defaults template with chapter timestamps, and a calibrated 480-character comma-separated SEO tag stack for my channel name, niche, and website domain.'
	},
	'PDF-04': {
		id: 'PDF-04',
		serverSlug: 'tier1_pdf_04',
		tier: 'Tier 01 ($49.50)',
		filename: 'KR_T1_04_Dark_Luxury_Website_Starter_Guide.pdf',
		title: 'PDF-04: Copy-Paste Antigravity Website Builder Prompts (#04070d Dark-Luxury UI)',
		steps: [
			'Step 1: Open your 03_Website_Builder folder inside Google Antigravity.',
			'Step 2: Paste the Master Website Builder Prompt below to generate your responsive homepage hero and article layout.',
			'Step 3: Uses Obsidian (#04070d), Sovereign Gold (#d4af37) 9999px pill buttons, and Baby Blue (#38bdf8) 18px glass cards.',
			'Step 4: Embed your latest YouTube walkthrough video in the left hero column and your lead capture form on the right.'
		],
		copyPromptLabel: 'COPY-PASTE WEBSITE BUILDER PROMPT',
		copyPrompt: 'Build a high-converting dark-luxury homepage hero and article layout (#04070d Obsidian background, #d4af37 Gold 9999px pill CTA buttons, #38bdf8 Baby Blue accents, 18px glassmorphic cards) featuring an embedded YouTube video player and an instant Email Lead Capture form.'
	},
	'PDF-05': {
		id: 'PDF-05',
		serverSlug: 'tier2_pdf_05',
		tier: 'Tier 02 ($199)',
		filename: 'KR_T2_05_RankMath_100_SEO_Schema_GSC_Guide.pdf',
		title: 'PDF-05: Turning Video Scripts into SEO Articles, JSON-LD Schema & Google Search Console',
		steps: [
			'Step 1: Paste your video script into Antigravity using the Video-to-Article Prompt below.',
			'Step 2: Antigravity outputs a structured long-form article with comparison tables, key takeaways, and FAQ blocks.',
			'Step 3: Attach Person, VideoObject, and FAQPage JSON-LD schema for 100/100 Rank Math SEO scoring.',
			'Step 4: Paste your published URL into Google Search Console URL Inspection and click Request Indexing.'
		],
		copyPromptLabel: 'COPY-PASTE VIDEO-TO-SEO ARTICLE PROMPT',
		copyPrompt: 'Convert my video script into a comprehensive, SEO-optimized article for my website. Include an executive summary box, a comparison table, 5 FAQ questions with FAQPage JSON-LD schema, and a clear call-to-action button.'
	},
	'PDF-06': {
		id: 'PDF-06',
		serverSlug: 'tier2_pdf_06',
		tier: 'Tier 02 ($199)',
		filename: 'KR_T2_06_Multi_Agent_Role_Templates_Manual.pdf',
		title: 'PDF-06: 6-Agent Role Suite + Multi-Agent Architecture Templates',
		steps: [
			'Step 1: Create dedicated role files inside 01_Brain_Rules/roles/ for all 6 specialist roles.',
			'Step 2: Pair the Research Scout and Source Challenger before invoking the Scriptwriter and Website Engineer.',
			'Step 3: Run the Boss QA Auditor pass before publishing any video script, outreach batch, or landing page.'
		],
		copyPromptLabel: 'COPY-PASTE 6-AGENT ROLE SUITE INITIALIZER PROMPT',
		copyPrompt: 'Create 6 specialized subagent role prompt files in 01_Brain_Rules/roles/: 01_Research_Scout.md, 02_Source_Challenger.md, 03_Video_Scriptwriter.md, 04_Website_Engineer.md, 05_B2B_Outreach_Specialist.md, and 06_Boss_QA_Auditor.md with strict input/output checklists.'
	},
	'PDF-07': {
		id: 'PDF-07',
		serverSlug: 'tier2_pdf_07',
		tier: 'Tier 02 ($199)',
		filename: 'KR_T2_07_Three_Source_Verification_Protocol.pdf',
		title: 'PDF-07: The 3-Source Fact Verification Protocol (Zero Hallucinations)',
		steps: [
			'Step 1: Require every statistic, code snippet, or industry regulation to be confirmed across 3 independent sources.',
			'Step 2: Save verified citations in a research notes file before drafting your script or blog post.'
		],
		copyPromptLabel: 'COPY-PASTE 3-SOURCE VERIFICATION PROMPT',
		copyPrompt: 'Research my topic and verify every claim, statistic, and technical requirement across at least 3 independent authoritative sources before drafting my script. List the 3 sources clearly at the top of the document.'
	},
	'PDF-08': {
		id: 'PDF-08',
		serverSlug: 'tier2_pdf_08',
		tier: 'Tier 02 ($199)',
		filename: 'KR_T2_08_B2B_MX_Outreach_Pipeline_Manual.pdf',
		title: 'PDF-08: B2B Client Outreach & Domain MX Email Verification Workflow',
		steps: [
			'Step 1: Build a clean prospect list with company name, decision-maker role, and website domain.',
			'Step 2: Verify the recipient domain has valid MX mail records before sending outreach.',
			'Step 3: Send personalized value-first outreach offering a concrete teardown or feasibility guide.'
		],
		copyPromptLabel: 'COPY-PASTE B2B VALUE OUTREACH PROMPT',
		copyPrompt: 'Write a concise, high-authority B2B outreach email to a prospective partner in my niche. Lead with a specific observation about their current project, offer a helpful resource link on my website, and keep the email under 140 words.'
	},
	'PDF-09': {
		id: 'PDF-09',
		serverSlug: 'tier2_pdf_09',
		tier: 'Tier 02 ($199)',
		filename: 'KR_T2_09_Locked_Crest_HTML_Email_Guide.pdf',
		title: 'PDF-09: Locked Top-and-Bottom Logo HTML Email Shell (#04070d & #d4af37)',
		steps: [
			'Step 1: Wrap every automated welcome email and client reply in a consistent Obsidian & Gold HTML table.',
			'Step 2: Lock your brand logo centered in the top header and left-aligned in the bottom executive signature.'
		],
		copyPromptLabel: 'COPY-PASTE HTML EMAIL SHELL PROMPT',
		copyPrompt: 'Generate a dark-luxury HTML email template (#04070d background, #d4af37 gold border, #38bdf8 links) with my brand logo centered in the top header, a clean middle content card with a gold pill CTA button, and an executive signature block at the bottom.'
	},
	'PDF-10': {
		id: 'PDF-10',
		serverSlug: 'tier3_pdf_10',
		tier: 'Tier 03 ($800)',
		filename: 'KR_T3_10_Tauri_v2_Rust_Architecture_Setup.pdf',
		title: 'PDF-10: Runnable Rust + Tauri v2 Desktop Command Center Source Setup',
		steps: [
			'Step 1: Install Rust and Node.js prerequisites and unpack the runnable src-tauri/ desktop source folder inside your AI Brain workspace.',
			'Step 2: Configure tauri.conf.json with your custom window title, dark-luxury dimensions, and desktop app icon.'
		],
		copyPromptLabel: 'COPY-PASTE TAURI v2 SOURCE INITIALIZATION PROMPT',
		copyPrompt: 'Initialize and verify my runnable Rust + Tauri v2 desktop command center source project inside my AI Brain workspace with a dark-luxury #04070d theme, custom window header, and modular tab navigation.'
	},
	'PDF-11': {
		id: 'PDF-11',
		serverSlug: 'tier3_pdf_11',
		tier: 'Tier 03 ($800)',
		filename: 'KR_T3_11_Dark_Luxury_Dashboard_Tabs_UI_Guide.pdf',
		title: 'PDF-11: Building Custom Dashboard Tabs & One-Click Action Buttons',
		steps: [
			'Step 1: Create dedicated dashboard tabs for your AI Brain workspace, Website links, and daily workflow checklists.',
			'Step 2: Wire one-click action buttons in your Tauri v2 UI to launch your key project folders, prompts, and browser tools.'
		],
		copyPromptLabel: 'COPY-PASTE TAURI DASHBOARD UI PROMPT',
		copyPrompt: 'Build a 3-tab dark-luxury command center UI in my Tauri desktop app featuring pure-black #04070d cards, gold #d4af37 and blue #38bdf8 borders, and one-click action buttons.'
	},
	'PDF-12': {
		id: 'PDF-12',
		serverSlug: 'tier3_pdf_12',
		tier: 'Tier 03 ($800)',
		filename: 'KR_T3_12_Windows_EXE_Release_Compiler_Manual.pdf',
		title: 'PDF-12: Running the 1-Command Windows .EXE Release Compiler',
		steps: [
			'Step 1: Run the included 1-command Windows .EXE compiler script inside Google Antigravity to verify zero Rust or frontend warnings.',
			'Step 2: Launch your compiled standalone Windows .exe binary and pin your custom desktop command center to your taskbar.'
		],
		copyPromptLabel: 'COPY-PASTE TAURI .EXE RELEASE BUILD PROMPT',
		copyPrompt: 'Verify all frontend and Rust dependencies in my runnable Tauri v2 source project and execute the 1-command production release build to output my standalone Windows .exe application.'
	}
};

function krCopyPromptText(elementId, btnEl) {
	const el = document.getElementById(elementId);
	if (!el) return;
	const text = el.innerText || el.textContent || '';
	if (navigator.clipboard && navigator.clipboard.writeText) {
		navigator.clipboard.writeText(text).then(function() {
			if (btnEl) {
				const orig = btnEl.textContent;
				btnEl.textContent = '✔ COPIED TO CLIPBOARD!';
				setTimeout(function() { btnEl.textContent = orig; }, 2200);
			}
		});
	} else {
		const ta = document.createElement('textarea');
		ta.value = text;
		document.body.appendChild(ta);
		ta.select();
		document.execCommand('copy');
		document.body.removeChild(ta);
		if (btnEl) {
			const orig = btnEl.textContent;
			btnEl.textContent = '✔ COPIED!';
			setTimeout(function() { btnEl.textContent = orig; }, 2200);
		}
	}
}

window.krVerifiedBuyerTier = 0;

function krGetRequiredTierForPdf(pdfId) {
	const num = parseInt(String(pdfId || '').replace(/[^0-9]/g, ''), 10) || 1;
	if (num >= 10) return 3;
	if (num >= 5) return 2;
	return 1;
}

window.krPromptTierUpgrade = function(requiredTier) {
	const t = parseInt(requiredTier, 10) || 2;
	if (typeof window.krOpenOrderModalForTier === 'function') {
		window.krOpenOrderModalForTier(t);
	}
};

function krOpenSpecModal(pdfId) {
	const spec = KR_SPEC_PDF_CATALOG[pdfId] || KR_SPEC_PDF_CATALOG['PDF-01'];
	const reqTier = krGetRequiredTierForPdf(spec.id);
	const userTier = parseInt(window.krVerifiedBuyerTier || 1, 10);
	if (userTier < reqTier) {
		window.krPromptTierUpgrade(reqTier);
		return;
	}
	const modal = document.getElementById('krSpecPdfModal');
	const badge = document.getElementById('krSpecPdfModalBadge');
	const title = document.getElementById('krSpecPdfModalTitle');
	const body = document.getElementById('krSpecPdfModalBody');
	const dlBtn = document.getElementById('krSpecPdfDownloadBtn');
	if (!modal || !spec) return;

	badge.textContent = spec.id + ' // ' + spec.tier + ' • ' + spec.filename;
	title.textContent = spec.title;

	let diagramHtml = '';
	if (spec.id === 'PDF-01') {
		diagramHtml = `
			<div style="background:#04070d;border:1.5px solid #d4af37;border-radius:14px;padding:14px;margin-bottom:14px;">
				<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:8px;">
					<span style="color:#f6d365;font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:900;">🗺️ VISUAL 4-FOLDER AI BRAIN SETUP FLOWCHART (PDF-01)</span>
					<button type="button" class="kr-copy-btn" onclick="krDownloadStarterAgentsMd()">⬇ Download AGENTS.md Starter File</button>
				</div>
				<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:8px;font-size:0.76rem;">
					<div style="background:#081020;border:1px solid #d4af37;border-radius:10px;padding:10px;"><strong style="color:#f6d365;">1. $30 Antigravity Plan</strong><br/>Open local folder <code>My_AI_Brain</code></div>
					<div style="background:#081020;border:1px solid #38bdf8;border-radius:10px;padding:10px;"><strong style="color:#38bdf8;">2. Paste Setup Prompt</strong><br/>Creates <code>01_Brain_Rules</code> .. <code>04_YouTube_Channel</code></div>
					<div style="background:#081020;border:1px solid #d4af37;border-radius:10px;padding:10px;"><strong style="color:#f6d365;">3. ~20-Word Flow Clips</strong><br/>Paste into Google Flow &amp; Export MP4</div>
					<div style="background:#081020;border:1px solid #38bdf8;border-radius:10px;padding:10px;"><strong style="color:#38bdf8;">4. Website &amp; Channel</strong><br/>Paste Website &amp; YouTube Prompts</div>
				</div>
			</div>`;
	}

	const stepsList = spec.steps.map(s => `<li style="margin-bottom:6px;">${s}</li>`).join('');
	body.innerHTML = `
		${diagramHtml}
		<h4 style="color:#38bdf8;font-size:0.92rem;margin:0 0 8px 0;">Step-by-Step Implementation Checklist:</h4>
		<ol style="margin:0 0 14px 0;padding-left:20px;color:#e2e8f0;">${stepsList}</ol>
		<div class="kr-copy-prompt-box gold-border">
			<div style="display:flex;justify-content:space-between;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:6px;">
				<span style="color:#f6d365;font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:900;">📋 ${spec.copyPromptLabel}</span>
				<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('krModalSpecPromptPre', this)">📋 COPY PROMPT</button>
			</div>
			<pre id="krModalSpecPromptPre" style="margin:0;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;font-size:0.78rem;color:#f8fafc;">${spec.copyPrompt}</pre>
		</div>`;

	if (dlBtn) {
		dlBtn.onclick = function() { krDownloadRealPdf(spec.id); };
	}
	modal.style.display = 'flex';
}

function krSeekModuleVideo(iframeId, videoId, startSec) {
	const iframe = document.getElementById(iframeId);
	if (!iframe) return;
	const sec = Math.max(0, parseInt(startSec, 10) || 0);
	iframe.src = 'https://www.youtube-nocookie.com/embed/' + encodeURIComponent(videoId) + '?start=' + sec + '&autoplay=1&rel=0';
}

function krTriggerTextFileDownload(filename, content, mimeType) {
	const blob = new Blob([content], { type: mimeType || 'text/markdown;charset=utf-8' });
	const url = URL.createObjectURL(blob);
	const a = document.createElement('a');
	a.href = url;
	a.download = filename;
	document.body.appendChild(a);
	a.click();
	document.body.removeChild(a);
	setTimeout(() => URL.revokeObjectURL(url), 3000);
}

// TOOL A: 1-Click Download AGENTS.md Starter File (for 01_Brain_Rules/AGENTS.md)
function krDownloadStarterAgentsMd() {
	const chName = (document.getElementById('setupChannelName') && document.getElementById('setupChannelName').value.trim()) || 'My Brand AI Channel';
	const chNiche = (document.getElementById('setupChannelNiche') && document.getElementById('setupChannelNiche').value.trim()) || 'AI Systems, Digital Products & Modern Authority';
	const domain = (document.getElementById('setupWebsiteDomain') && document.getElementById('setupWebsiteDomain').value.trim()) || 'mybranddomain.com';
	const buyerName = (document.getElementById('setupBuyerName') && document.getElementById('setupBuyerName').value.trim()) || 'Founder & Lead Architect';

	const mdContent = [
		'# AGENTS.md — Master AI Brain Rules (Drop Inside 01_Brain_Rules/AGENTS.md)',
		'',
		'## 1. Brand Identity & Core Offer',
		'- **Founder / Presenter**: ' + buyerName,
		'- **YouTube Brand Channel**: ' + chName,
		'- **Core Niche & Audience**: ' + chNiche,
		'- **Primary Website Domain**: https://' + domain.replace(/^https?:\/\//, ''),
		'',
		'## 2. 4-Folder Workspace Architecture ($30/mo Google Antigravity Plan)',
		'1. `01_Brain_Rules/AGENTS.md` — Permanent brand rules, voice, and offer positioning loaded in every chat.',
		'2. `02_Video_Prompts/` — ~20-word (strictly 18 to 24 words) 10-second Google Flow video scene prompts.',
		'3. `03_Website_Builder/` — Clean, high-converting homepage, landing page, and SEO article templates.',
		'4. `04_YouTube_Channel/` — YouTube Brand Channel Upload Defaults, chapter timestamps, and SEO tag stacks.',
		'',
		'## 3. ~20-Word Google Flow Video Prompt Rule (PDF-02)',
		'- Every 10-second Google Flow scene prompt MUST use **~20 spoken words (18 to 24 words)** so speech never cuts off at the end of a clip.',
		'- Keep your presenter and setting description consistent from scene to scene.',
		'- Export finished clips as 1080p MP4s from Google Flow.',
		'',
		'## 4. Website & YouTube Publishing Rule (PDF-03 to PDF-05)',
		'- Build clean, mobile-friendly landing pages and articles matching your brand colors and fonts.',
		'- Include clear headings, comparison tables, FAQ blocks, and submit new URLs to Google Search Console.'
	].join('\n');

	krTriggerTextFileDownload('AGENTS.md', mdContent, 'text/markdown;charset=utf-8');
}

function krDownloadStarterFlowMd() {
	const mdContent = [
		'# 02_Video_Prompts.md — ~20-Word Google Flow Scene Generator Template',
		'',
		'## Copy-Paste Antigravity Prompt:',
		'Write 6 sequential 10-second Google Flow video scene prompts for my episode topic.',
		'1. Keep each visual prompt strictly between 18 and 24 words (~20 words total).',
		'2. Describe the presenter speaking naturally to camera with grounded two-handed gestures in a warm acoustic oak studio on a 35mm cinema lens.',
		'3. Include a separate 22-to-26 word spoken voiceover line for each 10-second clip.',
		'4. Attach 3 reference images (Character, Outfit, Studio Background) in Google Flow and click Export MP4 (1080p).'
	].join('\n');
	krTriggerTextFileDownload('02_Video_Prompts.md', mdContent, 'text/markdown;charset=utf-8');
}

function krDownloadStarterWebsiteMd() {
	const mdContent = [
		'# 03_Website_And_YouTube_Starter.md — Dark-Luxury Website & YouTube Brand Channel Prompts',
		'',
		'## 1. YouTube Brand Channel & 480-Character Tag Stack Prompt (PDF-03)',
		'Create my complete YouTube Brand Channel setup package in 04_YouTube_Channel/ with Channel Bio, Upload Defaults with chapter timestamps, and a calibrated 480-character SEO tag stack.',
		'',
		'## 2. Dark-Luxury Website & SEO Article Prompt (PDF-04 & PDF-05)',
		'Build a responsive dark-luxury homepage hero and article template inside 03_Website_Builder/ using Obsidian (#04070d), Sovereign Gold (#d4af37) 9999px pill buttons, Baby Blue (#38bdf8) accents, and Person + VideoObject + FAQPage JSON-LD schema.'
	].join('\n');
	krTriggerTextFileDownload('03_Website_And_YouTube_Starter.md', mdContent, 'text/markdown;charset=utf-8');
}

// TOOL B: Interactive ~20-Word (18-24 Word) Google Flow Pacing Checker
function krCountWords(str) {
	const cleaned = String(str || '').trim();
	if (!cleaned) return 0;
	return cleaned.split(/\s+/).filter(Boolean).length;
}

function krUpdateFlowWordCounter() {
	const input = document.getElementById('krFlowWordCountInput');
	const badge = document.getElementById('krFlowWordCountBadge');
	const hint = document.getElementById('krFlowWordCountHint');
	if (!input || !badge) return;
	const count = krCountWords(input.value);

	if (count >= 18 && count <= 24) {
		badge.textContent = count + ' words — Perfect 18–24 Word Google Flow Sweet Spot';
		badge.style.background = 'rgba(212, 175, 55, 0.18)';
		badge.style.borderColor = '#d4af37';
		badge.style.color = '#f6d365';
		if (hint) {
			hint.style.color = '#38bdf8';
			hint.textContent = '✔ Sweet Spot Locked (' + count + ' words): Optimal 10-second pacing so your audio & lip-sync never cut off in Google Flow.';
		}
	} else if (count < 18) {
		const needed = 18 - count;
		badge.textContent = count + ' words — Under 18 Words (Add ' + needed + '+ words for 18–24 Sweet Spot)';
		badge.style.background = 'rgba(56, 189, 248, 0.16)';
		badge.style.borderColor = '#38bdf8';
		badge.style.color = '#38bdf8';
		if (hint) {
			hint.style.color = '#f6d365';
			hint.textContent = '⚠️ Add ' + needed + ' to ' + (24 - count) + ' more words (camera lens, lighting, or gesture) so Google Flow has full 10-second scene context.';
		}
	} else {
		const extra = count - 24;
		badge.textContent = count + ' words — Over 24 Words! (Trim ' + extra + ' words to prevent audio cutoff)';
		badge.style.background = 'rgba(248, 113, 113, 0.16)';
		badge.style.borderColor = '#f87171';
		badge.style.color = '#f87171';
		if (hint) {
			hint.style.color = '#f87171';
			hint.textContent = '⚠️ Over 24 words (' + count + ' words): Trim ' + extra + ' words so Google Flow does not rush or cut off your 10-second clip!';
		}
	}
}

function krLoadSampleFlowPrompt() {
	const input = document.getElementById('krFlowWordCountInput');
	if (!input) return;
	input.value = 'Founder speaking warmly to camera with grounded two-handed builder gestures inside a dark acoustic oak studio on a 35mm cinema lens.';
	krUpdateFlowWordCounter();
}

function krCopyFlowCheckedPrompt(btnEl) {
	const input = document.getElementById('krFlowWordCountInput');
	if (!input) return;
	const text = input.value || '';
	if (navigator.clipboard && navigator.clipboard.writeText) {
		navigator.clipboard.writeText(text).then(function() {
			if (btnEl) {
				const orig = btnEl.textContent;
				btnEl.textContent = '✔ COPIED VERIFIED PROMPT!';
				setTimeout(function() { btnEl.textContent = orig; }, 2200);
			}
		});
	}
}

// TOOL C: 1-Click Download All 4 Custom Setup Prompts (.TXT)
function krDownloadCustomSetupTxt() {
	const chName = (document.getElementById('setupChannelName') && document.getElementById('setupChannelName').value.trim()) || 'My Brand AI Channel';
	const chNiche = (document.getElementById('setupChannelNiche') && document.getElementById('setupChannelNiche').value.trim()) || 'AI Systems & Modern Builder Authority';
	const domain = (document.getElementById('setupWebsiteDomain') && document.getElementById('setupWebsiteDomain').value.trim()) || 'mybranddomain.com';

	const p1 = (document.getElementById('outCustomBrainPrompt') && document.getElementById('outCustomBrainPrompt').textContent.trim()) ||
		(document.getElementById('krPromptBrainMaster') && document.getElementById('krPromptBrainMaster').textContent.trim()) || '';
	const p2 = (document.getElementById('outCustomFlowPrompts') && document.getElementById('outCustomFlowPrompts').textContent.trim()) ||
		(document.getElementById('krPromptFlowGenerator') && document.getElementById('krPromptFlowGenerator').textContent.trim()) || '';
	const p3 = (document.getElementById('outCustomWebsitePrompt') && document.getElementById('outCustomWebsitePrompt').textContent.trim()) ||
		(document.getElementById('krPromptWebsiteBuilder') && document.getElementById('krPromptWebsiteBuilder').textContent.trim()) || '';
	const p4 = (document.getElementById('outCustomYoutubeTags') && document.getElementById('outCustomYoutubeTags').textContent.trim()) ||
		(document.getElementById('krPromptYoutubeSetup') && document.getElementById('krPromptYoutubeSetup').textContent.trim()) || '';

	const txtContent = [
		'======================================================================',
		'KEYSTONE AI PROTOCOLS // YOUR 4 CUSTOM COPY-PASTE SETUP PROMPTS (.TXT)',
		'Channel: ' + chName + ' | Niche: ' + chNiche + ' | Website: ' + domain,
		'Portal: https://keystonerecomposition.com/ai-protocols/',
		'======================================================================',
		'',
		'----------------------------------------------------------------------',
		'1. YOUR CUSTOM ANTIGRAVITY BRAIN SETUP PROMPT ($30/MO PLAN)',
		'----------------------------------------------------------------------',
		p1,
		'',
		'----------------------------------------------------------------------',
		'2. YOUR 3 CUSTOM ~20-WORD (18-24 WORD) GOOGLE FLOW VIDEO PROMPTS',
		'----------------------------------------------------------------------',
		p2,
		'',
		'----------------------------------------------------------------------',
		'3. YOUR CUSTOM ANTIGRAVITY DARK-LUXURY WEBSITE BUILDER PROMPT',
		'----------------------------------------------------------------------',
		p3,
		'',
		'----------------------------------------------------------------------',
		'4. YOUR YOUTUBE BRAND CHANNEL UPLOAD DEFAULTS & 480-CHAR TAG STACK',
		'----------------------------------------------------------------------',
		p4,
		''
	].join('\n');

	const safeSlug = chName.toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_|_$/g, '') || 'keystone_student';
	krTriggerTextFileDownload('Keystone_4_Custom_Setup_Prompts_' + safeSlug + '.txt', txtContent, 'text/plain;charset=utf-8');
}

function krGetActiveBuyerUid() {
	const inputEl = document.getElementById('existingVaultUidInput');
	const fromInput = inputEl ? inputEl.value.trim() : '';
	return String(window.krVerifiedBuyerUid || fromInput || '').trim();
}

function krBuildVaultDownloadUrl(packSlug) {
	const slug = String(packSlug || 'tier1_pdf_01').trim();
	const activeUid = krGetActiveBuyerUid();
	return '?vault_download=' + encodeURIComponent(slug) + (activeUid ? '&uid=' + encodeURIComponent(activeUid) : '');
}

function krComputeUpgradeNetPrice(fromTier, toTier) {
	const tierPrices = { 1: 49.50, 2: 199.00, 3: 800.00 };
	const baseTarget = tierPrices[toTier] || 199.00;
	const credit = (fromTier >= 1 && fromTier < toTier) ? (tierPrices[fromTier] || 0) : 0;
	const net = Math.max(0, Math.round((baseTarget - credit) * 100) / 100);
	return { base: baseTarget, credit: credit, net: net };
}

function krFormatUsd(val) {
	const rounded = Math.round(Number(val || 0) * 100) / 100;
	return rounded % 1 === 0 ? rounded.toFixed(2) : rounded.toFixed(2);
}

window.krStartCreditUpgradeCheckout = function(targetTier) {
	const t = parseInt(targetTier, 10) || 2;
	const activeUid = krGetActiveBuyerUid();
	if (!activeUid) {
		if (typeof window.krOpenOrderModalForTier === 'function') {
			window.krOpenOrderModalForTier(t);
		}
		return;
	}
	const pCode = (document.getElementById('modalPromoInput')?.value || document.getElementById('promoInput')?.value || '').trim().toUpperCase();
	const bName = (document.getElementById('setupBuyerName')?.value || document.getElementById('heroBuyerName')?.value || document.getElementById('orderBuyerName')?.value || '').trim();
	const bEmail = (document.getElementById('setupBuyerEmail')?.value || document.getElementById('heroBuyerEmail')?.value || document.getElementById('orderBuyerEmail')?.value || '').trim();

	fetch('/wp-json/keystone/v1/create-checkout-session', {
		method: 'POST',
		headers: { 'Content-Type': 'application/json' },
		body: JSON.stringify({
			tier: String(t),
			upgrade_from_uid: activeUid,
			buyer_name: bName,
			buyer_email: bEmail,
			promo_code: pCode
		})
	})
	.then(r => r.json())
	.then(data => {
		if (data && data.success && data.checkout_url) {
			window.location.href = data.checkout_url;
		} else if (typeof window.krOpenOrderModalForTier === 'function') {
			window.krOpenOrderModalForTier(t);
		}
	})
	.catch(() => {
		if (typeof window.krOpenOrderModalForTier === 'function') {
			window.krOpenOrderModalForTier(t);
		}
	});
};

window.krPromptTierUpgrade = function(requiredTier) {
	const t = parseInt(requiredTier, 10) || 2;
	const activeUid = krGetActiveBuyerUid();
	const uTier = parseInt(window.krVerifiedBuyerTier || 0, 10);
	if (activeUid && uTier >= 1 && uTier < t) {
		window.krStartCreditUpgradeCheckout(t);
		return;
	}
	if (typeof window.krOpenOrderModalForTier === 'function') {
		window.krOpenOrderModalForTier(t);
	}
};

function krDownloadRealPdf(pdfId) {
	const spec = KR_SPEC_PDF_CATALOG[pdfId] || KR_SPEC_PDF_CATALOG['PDF-01'];
	const reqTier = krGetRequiredTierForPdf(spec.id);
	const userTier = parseInt(window.krVerifiedBuyerTier || 1, 10);
	if (userTier < reqTier) {
		window.krPromptTierUpgrade(reqTier);
		return;
	}
	const serverSlug = spec.serverSlug || KR_PDF_SERVER_SLUGS[spec.id] || 'tier1_pdf_01';
	window.location.href = krBuildVaultDownloadUrl(serverSlug);
}

window.krDownloadMasterBook = function(tierNum) {
	const reqTier = Math.max(1, Math.min(3, parseInt(tierNum, 10) || 1));
	const userTier = parseInt(window.krVerifiedBuyerTier || 1, 10);
	if (userTier < reqTier) {
		window.krPromptTierUpgrade(reqTier);
		return;
	}
	const slugMap = { 1: 'tier1_pdf_master', 2: 'tier2_pdf_master', 3: 'tier3_pdf_master' };
	window.location.href = krBuildVaultDownloadUrl(slugMap[reqTier] || 'tier1_pdf_master');
};

window.krHandleMasterBookClick = function(ev, tierNum) {
	if (ev && ev.preventDefault) ev.preventDefault();
	window.krDownloadMasterBook(tierNum);
	return false;
};

window.krHandleVaultAnchorClick = function(ev, packSlug, reqTier) {
	if (ev && ev.preventDefault) ev.preventDefault();
	const userTier = parseInt(window.krVerifiedBuyerTier || 1, 10);
	if (userTier < (parseInt(reqTier, 10) || 1)) {
		window.krPromptTierUpgrade(reqTier);
		return false;
	}
	window.location.href = krBuildVaultDownloadUrl(packSlug);
	return false;
};

document.addEventListener('DOMContentLoaded', function() {
	function renderVaultUpgradeBanner(buyerTier) {
		const banner = document.getElementById('krVaultUpgradeCreditBanner');
		if (!banner) return;
		const uTier = parseInt(buyerTier || 0, 10);
		if (!window.krVerifiedBuyerUid || uTier <= 0 || uTier >= 3) {
			banner.style.display = 'none';
			return;
		}
		banner.style.display = 'flex';
		if (uTier === 1) {
			banner.innerHTML = `
				<div>
					<div style="color:#f6d365;font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:900;">🛡️ 100% UPGRADE CREDIT ACTIVE ON YOUR KR-UID ($49.50 USD CREDITED)</div>
					<div style="color:#cbd5e1;font-size:0.82rem;margin-top:2px;">Your $49.50 Tier 01 purchase applies dollar-for-dollar toward Tier 02 or Tier 03 at Stripe checkout:</div>
				</div>
				<div style="display:flex;gap:8px;flex-wrap:wrap;">
					<button type="button" onclick="window.krStartCreditUpgradeCheckout(2)" class="kr-copy-btn" style="padding:9px 16px;font-size:0.76rem;">🔓 Upgrade to Tier 02 &rarr; Pay Only $149.50 USD</button>
					<button type="button" onclick="window.krStartCreditUpgradeCheckout(3)" style="background:rgba(56,189,248,0.16);border:1px solid #38bdf8;color:#38bdf8;border-radius:9999px;padding:9px 16px;font-family:'Outfit',sans-serif;font-size:0.76rem;font-weight:800;cursor:pointer;">🖥️ Upgrade to Tier 03 &rarr; Pay Only $750.50 USD</button>
				</div>`;
		} else if (uTier === 2) {
			banner.innerHTML = `
				<div>
					<div style="color:#f6d365;font-family:'JetBrains Mono',monospace;font-size:0.68rem;font-weight:900;">🛡️ 100% UPGRADE CREDIT ACTIVE ON YOUR KR-UID ($199.00 USD CREDITED)</div>
					<div style="color:#cbd5e1;font-size:0.82rem;margin-top:2px;">Your $199.00 Tier 02 purchase applies dollar-for-dollar toward the Complete Runnable Rust + Tauri v2 Desktop Source:</div>
				</div>
				<div>
					<button type="button" onclick="window.krStartCreditUpgradeCheckout(3)" class="kr-copy-btn" style="padding:9px 18px;font-size:0.78rem;">🖥️ Upgrade to Tier 03 Tauri v2 Source &rarr; Pay Only $601.00 USD</button>
				</div>`;
		}
	}

	function renderPdfLibraryGrid(buyerTier) {
		const pdfGrid = document.getElementById('krPdfLibraryGrid');
		if (!pdfGrid) return;
		const uTier = parseInt(buyerTier || 1, 10);
		pdfGrid.innerHTML = Object.keys(KR_SPEC_PDF_CATALOG).map(key => {
			const item = KR_SPEC_PDF_CATALOG[key];
			const reqTier = krGetRequiredTierForPdf(item.id);
			const isLocked = uTier < reqTier;
			const upg = krComputeUpgradeNetPrice(uTier, reqTier);
			const priceLabel = (window.krVerifiedBuyerUid && upg.credit > 0)
				? ('Pay $' + krFormatUsd(upg.net) + ' w/ Credit')
				: (reqTier === 3 ? '$800 USD' : '$199 USD');
			const actionHtml = isLocked
				? `<button type="button" onclick="window.krPromptTierUpgrade(${reqTier})" style="width:100%;background:rgba(212,175,55,0.14);border:1px solid #d4af37;color:#f6d365;border-radius:9999px;padding:6px 10px;font-size:0.70rem;font-weight:800;cursor:pointer;">🔒 Locked — Upgrade to Tier 0${reqTier} (${priceLabel}) &rarr;</button>`
				: `<div style="display:flex;gap:6px;flex-wrap:wrap;">
						<button type="button" onclick="krOpenSpecModal('${item.id}')" style="background:rgba(56,189,248,0.16);border:1px solid #38bdf8;color:#38bdf8;border-radius:9999px;padding:5px 10px;font-size:0.70rem;font-weight:800;cursor:pointer;">👁️ View &amp; Copy Prompts</button>
						<a href="${krBuildVaultDownloadUrl(item.serverSlug)}" onclick="krDownloadRealPdf('${item.id}'); return false;" style="background:rgba(212,175,55,0.18);border:1px solid #d4af37;color:#f6d365;border-radius:9999px;padding:5px 10px;font-size:0.70rem;font-weight:800;cursor:pointer;text-decoration:none;">⬇ %PDF-1.7</a>
					</div>`;
			return `
				<div data-pdf-card="${item.id}" data-required-tier="${reqTier}" data-locked="${isLocked ? '1' : '0'}" style="background:#081020;border:1px solid ${isLocked ? 'rgba(212,175,55,0.28)' : 'rgba(56,189,248,0.32)'};border-radius:12px;padding:12px;display:flex;flex-direction:column;justify-content:space-between;gap:8px;opacity:${isLocked ? '0.78' : '1'};">
					<div>
						<div style="color:${isLocked ? '#94a3b8' : '#f6d365'};font-family:'JetBrains Mono',monospace;font-size:0.66rem;font-weight:800;">${isLocked ? '🔒 ' : '✔ '}${item.id} • ${item.tier}</div>
						<div style="color:#ffffff;font-family:'Outfit',sans-serif;font-size:0.84rem;font-weight:800;margin-top:3px;">${item.title}</div>
					</div>
					${actionHtml}
				</div>`;
		}).join('');
	}

	function krEnforceTierPortalLocks(buyerTier) {
		const uTier = Math.max(1, Math.min(3, parseInt(buyerTier || 1, 10) || 1));
		window.krVerifiedBuyerTier = uTier;
		renderPdfLibraryGrid(uTier);
		renderVaultUpgradeBanner(uTier);

		const upgT2 = krComputeUpgradeNetPrice(uTier, 2);
		const upgT3 = krComputeUpgradeNetPrice(uTier, 3);
		const t2CtaPrice = (window.krVerifiedBuyerUid && upgT2.credit > 0) ? (`$${krFormatUsd(upgT2.net)} USD WITH $${krFormatUsd(upgT2.credit)} CREDIT`) : '$199 USD';
		const t3CtaPrice = (window.krVerifiedBuyerUid && upgT3.credit > 0) ? (`$${krFormatUsd(upgT3.net)} USD WITH $${krFormatUsd(upgT3.credit)} CREDIT`) : '$800 USD';

		const paneConfigs = [
			{ tabId: 'tab3', reqTier: 2, price: '$199 USD', ctaLabel: t2CtaPrice, title: 'Tier 02 — Custom Dark-Luxury Website & YouTube Brand Channel', desc: 'Your Tier 01 ($49.50 USD) pass applies 100% dollar-for-dollar toward Tier 02 ($199 USD — pay only $149.50 USD) to unlock the Custom Dark-Luxury Website Builder, YouTube Brand Channel module, and PDF-05 to PDF-09.' },
			{ tabId: 'tab4', reqTier: 2, price: '$199 USD', ctaLabel: t2CtaPrice, title: 'Tier 02 — 6-Agent Role Suite + Multi-Agent Architecture & B2B Outreach', desc: 'Your Tier 01 ($49.50 USD) pass applies 100% dollar-for-dollar toward Tier 02 ($199 USD — pay only $149.50 USD) to unlock the 5:28 Unlisted Multi-Agent Walkthrough Video, 6-Agent Role Suite, B2B MX Outreach Gate, and PDF-05 to PDF-09.' },
			{ tabId: 'tab5', reqTier: 3, price: '$800 USD', ctaLabel: t3CtaPrice, title: 'Tier 03 — Complete Runnable Rust + Tauri v2 Desktop Source (.EXE)', desc: 'Upgrade with 100% dollar-for-dollar credit from your current tier to unlock the 5:54 Unlisted Tauri v2 Walkthrough, the Complete Runnable Rust + Tauri v2 Desktop Command Center Source (.ZIP), 1-Command Windows .EXE Compiler, all 12 %PDF-1.7 manuals, and 14-Day Guided Build Support.' }
		];

		paneConfigs.forEach(cfg => {
			const pane = document.getElementById('kr-portal-pane-' + cfg.tabId);
			const btn = document.querySelector(`.kr-portal-tab-btn[data-portal-tab="${cfg.tabId}"]`);
			if (!pane) return;
			if (!pane.dataset.unlockedHtml) {
				pane.dataset.unlockedHtml = pane.innerHTML;
			}
			if (btn && !btn.dataset.unlockedLabel) {
				btn.dataset.unlockedLabel = btn.innerHTML;
			}
			if (uTier < cfg.reqTier) {
				pane.setAttribute('data-tier-locked', '1');
				pane.innerHTML = `
					<div style="background:linear-gradient(145deg,#09101f 0%,#04070d 100%);border:1.5px solid #d4af37;border-radius:18px;padding:32px 26px;text-align:center;max-width:680px;margin:12px auto;">
						<div style="display:inline-block;background:rgba(212,175,55,0.16);border:1px solid #d4af37;color:#f6d365;font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:900;padding:5px 14px;border-radius:9999px;margin-bottom:12px;">
							🔒 LOCKED MODULE • 100% UPGRADE CREDIT ELIGIBLE
						</div>
						<h3 style="color:#ffffff;font-family:'Outfit',sans-serif;font-size:1.38rem;font-weight:900;margin:0 0 10px 0;">
							${cfg.title}
						</h3>
						<p style="color:#cbd5e1;font-size:0.88rem;line-height:1.6;margin:0 0 20px 0;">
							${cfg.desc}
						</p>
						<button type="button" onclick="window.krPromptTierUpgrade(${cfg.reqTier})" style="background:linear-gradient(135deg,#f3e5ab 0%,#d4af37 50%,#aa8010 100%);color:#04070d !important;border:none;border-radius:9999px;padding:12px 26px;font-family:'Outfit',sans-serif;font-size:0.86rem;font-weight:900;cursor:pointer;box-shadow:0 8px 24px rgba(212,175,55,0.38);">
							🔓 UPGRADE TO TIER 0${cfg.reqTier} (${cfg.ctaLabel}) &rarr;
						</button>
					</div>`;
				if (btn) {
					btn.innerHTML = btn.dataset.unlockedLabel + ` <span style="margin-left:4px;color:#f6d365;font-size:0.68rem;">🔒 Tier 0${cfg.reqTier}</span>`;
				}
			} else {
				pane.setAttribute('data-tier-locked', '0');
				pane.innerHTML = pane.dataset.unlockedHtml;
				if (btn && btn.dataset.unlockedLabel) {
					btn.innerHTML = btn.dataset.unlockedLabel;
				}
			}
		});
	}
	window.krEnforceTierPortalLocks = krEnforceTierPortalLocks;
	krEnforceTierPortalLocks(1);

	// 6-Tab Switcher
	const tabBtns = document.querySelectorAll('.kr-portal-tab-btn');
	const tabPanes = document.querySelectorAll('.kr-portal-tab-pane');
	tabBtns.forEach(btn => {
		btn.addEventListener('click', function() {
			const target = this.getAttribute('data-portal-tab');
			tabBtns.forEach(b => b.classList.remove('active'));
			tabPanes.forEach(p => p.classList.remove('active'));
			this.classList.add('active');
			const pane = document.getElementById('kr-portal-pane-' + target);
			if (pane) pane.classList.add('active');
		});
	});

	// Tool B: Live ~20-Word (18-24 Word) Google Flow Pacing Checker
	const flowWordInput = document.getElementById('krFlowWordCountInput');
	if (flowWordInput) {
		flowWordInput.addEventListener('input', krUpdateFlowWordCounter);
		krUpdateFlowWordCounter();
	}

	// Interactive Brain, YouTube Channel & Website Setup Form Handler
	const setupForm = document.getElementById('krChannelWebsiteSetupForm');
	if (setupForm) {
		setupForm.addEventListener('submit', function(e) {
			e.preventDefault();
			const submitBtn = document.getElementById('setupFormSubmitBtn');
			if (submitBtn) {
				submitBtn.disabled = true;
				submitBtn.textContent = '⏳ GENERATING YOUR CUSTOM BRAIN, FLOW & WEBSITE PROMPTS...';
			}
			const currentUid = (document.getElementById('existingVaultUidInput') && document.getElementById('existingVaultUidInput').value.trim()) || 'KR-DEMO-SELF-SERVICE';
			const payload = {
				uid: currentUid,
				buyer_name: document.getElementById('setupBuyerName').value.trim(),
				buyer_email: document.getElementById('setupBuyerEmail').value.trim(),
				youtube_channel_name: document.getElementById('setupChannelName').value.trim(),
				channel_niche: document.getElementById('setupChannelNiche').value.trim(),
				website_domain: document.getElementById('setupWebsiteDomain').value.trim(),
				brand_account_status: document.getElementById('setupBrandStatus').value,
				current_roadblock: document.getElementById('setupRoadblock').value.trim()
			};

			fetch('/wp-json/keystone/v1/protocol-setup-form', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify(payload)
			})
			.then(r => r.json())
			.then(data => {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.textContent = '✔ CUSTOM PROMPTS GENERATED BELOW (& EMAILED TO YOU)';
				}
				if (data && data.success) {
					const resBox = document.getElementById('krCustomSetupResultBox');
					const statusMsg = document.getElementById('krCustomSetupStatusMsg');
					if (resBox) resBox.style.display = 'block';
					if (statusMsg) statusMsg.textContent = data.message;
					document.getElementById('outCustomBrainPrompt').textContent = data.custom_brain_setup_prompt || '';
					document.getElementById('outCustomFlowPrompts').textContent = Array.isArray(data.custom_flow_20word_prompts) ? data.custom_flow_20word_prompts.join('\n\n') : '';
					document.getElementById('outCustomWebsitePrompt').textContent = data.custom_website_prompt || '';
					document.getElementById('outCustomYoutubeTags').textContent = data.custom_youtube_tags_and_defaults || '';
				}
			})
			.catch(() => {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.textContent = '⚡ GENERATE MY CUSTOM BRAIN, ~20-WORD GOOGLE FLOW & WEBSITE PROMPTS →';
				}
			});
		});
	}

	// Guided Setup Assistant Handler
	const tutorInput = document.getElementById('krTutorQuestionInput');
	const tutorEmailInput = document.getElementById('krTutorEmailInput');
	const askTutorBtn = document.getElementById('krAskTutorBtn');
	const emailTutorBtn = document.getElementById('krEmailTutorLessonBtn');
	const tutorAnswerBox = document.getElementById('krTutorAnswerBox');

	function runAiTutorQuery(questionText, sendEmail) {
		if (!questionText) return;
		if (tutorAnswerBox) {
			tutorAnswerBox.style.display = 'block';
			tutorAnswerBox.innerHTML = '<div style="color:#38bdf8;font-weight:700;">🤖 Guided Setup Assistant is preparing your step-by-step setup answer...</div>';
		}
		const currentUid = (document.getElementById('existingVaultUidInput') && document.getElementById('existingVaultUidInput').value.trim()) || 'KR-DEMO-SELF-SERVICE';
		fetch('/wp-json/keystone/v1/protocol-tutor', {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify({
				uid: currentUid,
				question: questionText,
				buyer_email: tutorEmailInput ? tutorEmailInput.value.trim() : '',
				send_email_copy: Boolean(sendEmail)
			})
		})
		.then(r => r.json())
		.then(data => {
			if (data && data.success && tutorAnswerBox) {
				const emailNotice = data.email_sent ? `<div style="margin-top:8px;color:#f6d365;font-size:0.78rem;font-weight:800;">✔ A copy of this lesson was also emailed to your inbox!</div>` : '';
				tutorAnswerBox.innerHTML = `
					${data.answer_html}
					<div style="margin-top:10px;padding-top:10px;border-top:1px solid rgba(56,189,248,0.25);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
						<span style="font-size:0.76rem;color:#38bdf8;font-weight:800;">📄 Recommended Spec Sheet: ${data.recommended_pdf_id} (${data.recommended_pdf_title})</span>
						<div style="display:flex;gap:6px;">
							<button type="button" class="kr-copy-btn" onclick="krOpenSpecModal('${data.recommended_pdf_id}')">👁️ Open ${data.recommended_pdf_id}</button>
							<button type="button" class="kr-copy-btn" onclick="krDownloadRealPdf('${data.recommended_pdf_id}')">⬇ Download PDF</button>
						</div>
					</div>
					${emailNotice}`;
			}
		})
		.catch(() => {});
	}

	document.querySelectorAll('.kr-tutor-quick-btn').forEach(btn => {
		btn.addEventListener('click', function() {
			const q = this.getAttribute('data-q');
			if (tutorInput) tutorInput.value = q;
			runAiTutorQuery(q, false);
		});
	});

	if (askTutorBtn && tutorInput) {
		askTutorBtn.addEventListener('click', function() {
			runAiTutorQuery(tutorInput.value.trim() || 'How do I set up my $30 Antigravity Brain?', false);
		});
	}
	if (emailTutorBtn && tutorInput) {
		emailTutorBtn.addEventListener('click', function() {
			runAiTutorQuery(tutorInput.value.trim() || 'How do I set up my $30 Antigravity Brain?', true);
		});
	}

	// Checkout, Promo Code, 100% Upgrade Credit & Returning-Buyer Toggle Logic
	const tierBtns = document.querySelectorAll('.tier-select-btn');
	const expressBuyBtn = document.getElementById('portalExpressBuyBtn');
	const stripeCardBtn = document.getElementById('submitStripeCardBtn');
	const stripeCardBtnText = document.getElementById('stripeCardBtnText');

	const promoInput = document.getElementById('promoInput');
	const applyPromoBtn = document.getElementById('applyPromoBtn');
	const promoFeedback = document.getElementById('promoFeedback');
	const modalPromoInput = document.getElementById('modalPromoInput');
	const modalApplyPromoBtn = document.getElementById('modalApplyPromoBtn');
	const modalPromoFeedback = document.getElementById('modalPromoFeedback');

	const modal = document.getElementById('automatedOrderModal');
	const closeModalBtn = document.getElementById('closeAutomatedOrderModal');
	const modalTierSelect = document.getElementById('modalTierSelect');
	const modalTierHeadline = document.getElementById('modalTierHeadline');
	const modalUpgradeCreditBanner = document.getElementById('modalUpgradeCreditBanner');
	const modalCheckoutFeedback = document.getElementById('modalCheckoutFeedback');
	const orderTierInput = document.getElementById('orderTierInput');
	const orderForm = document.getElementById('automatedProtocolOrderForm');
	const successBox = document.getElementById('orderFulfillmentSuccessBox');
	const fulfilledUidReadout = document.getElementById('fulfilledUidReadout');
	const fulfilledMessageText = document.getElementById('fulfilledMessageText');
	const fulfilledLiveDownloadsWrap = document.getElementById('fulfilledLiveDownloadsWrap');
	const fulfilledVideoBtn = document.getElementById('fulfilledVideoBtn');
	const fulfilledDownloadsList = document.getElementById('fulfilledDownloadsList');

	const vaultUidStatusBadge = document.getElementById('vaultUidStatusBadge');
	const returningToggleBtn = document.getElementById('krReturningBuyerToggleBtn');
	const returningDrawer = document.getElementById('krReturningBuyerDrawer');
	const returningChevron = document.getElementById('krReturningBuyerChevron');
	const existingVaultUidInput = document.getElementById('existingVaultUidInput');
	const verifyVaultUidBtn = document.getElementById('verifyVaultUidBtn');
	const vaultUidVerifyFeedback = document.getElementById('vaultUidVerifyFeedback');

	let activeTier = 1;
	let activePrice = 49.50;
	let discountPct = 0;

	const tierBasePrices = { 1: 49.50, 2: 199.00, 3: 800.00 };

	const promoCodes = {
		'BUILDER10': 10,
		'WAYNE10': 10,
		'KEYSTONE20': 20
	};

	const tierNames = {
		1: 'Tier 01 — $49.50 USD One-Time: AI Brain & Google Flow Starter',
		2: 'Tier 02 — $199 USD One-Time: 6-Agent Role Suite + Website Architecture',
		3: 'Tier 03 — $800 USD One-Time: Runnable Rust + Tauri v2 Desktop Source (.EXE)'
	};

	function setReturningDrawerOpen(openState) {
		if (!returningDrawer || !returningToggleBtn) return;
		returningDrawer.style.display = openState ? 'block' : 'none';
		returningToggleBtn.setAttribute('aria-expanded', openState ? 'true' : 'false');
		if (returningChevron) {
			returningChevron.textContent = openState ? '−' : '+';
		}
	}

	if (returningToggleBtn) {
		returningToggleBtn.addEventListener('click', function() {
			const isOpen = returningDrawer && returningDrawer.style.display !== 'none';
			setReturningDrawerOpen(!isOpen);
		});
	}

	function formatPrice(val) {
		const rounded = Math.round(val * 100) / 100;
		return rounded % 1 === 0 ? rounded.toFixed(0) : rounded.toFixed(2);
	}

	function computeFinalUsdPrice(baseUsd, pctOff) {
		if (!pctOff || pctOff <= 0) return baseUsd;
		const baseCents = Math.round(baseUsd * 100);
		const discCents = Math.round((baseCents * pctOff) / 100);
		return Math.max(0, (baseCents - discCents) / 100);
	}

	function getEffectiveCheckoutPricing(targetTierNum) {
		const t = parseInt(targetTierNum, 10) || activeTier || 1;
		const baseUsd = tierBasePrices[t] || 49.50;
		const activeUid = krGetActiveBuyerUid();
		const uTier = parseInt(window.krVerifiedBuyerTier || 0, 10);
		if (window.krVerifiedBuyerUid && activeUid && uTier >= 1 && uTier < t) {
			const upg = krComputeUpgradeNetPrice(uTier, t);
			return {
				isUpgrade: true,
				upgradeUid: activeUid,
				creditUsd: upg.credit,
				finalUsd: computeFinalUsdPrice(upg.net, discountPct)
			};
		}
		return {
			isUpgrade: false,
			upgradeUid: '',
			creditUsd: 0,
			finalUsd: computeFinalUsdPrice(baseUsd, discountPct)
		};
	}

	function updateStripeButtonText() {
		const modalTarget = modalTierSelect ? (parseInt(modalTierSelect.value, 10) || activeTier) : activeTier;
		const pricing = getEffectiveCheckoutPricing(modalTarget);
		if (stripeCardBtnText) {
			stripeCardBtnText.textContent = pricing.isUpgrade
				? `PAY WITH VISA / MASTERCARD — UPGRADE W/ $${formatPrice(pricing.creditUsd)} CREDIT ($${formatPrice(pricing.finalUsd)} USD) →`
				: `PAY WITH VISA / MASTERCARD & UNLOCK VAULT ($${formatPrice(pricing.finalUsd)} USD) →`;
		}
		if (modalUpgradeCreditBanner) {
			if (pricing.isUpgrade) {
				modalUpgradeCreditBanner.style.display = 'block';
				modalUpgradeCreditBanner.innerHTML = `🛡️ <strong style="color:#f6d365;">100% Upgrade Credit Applied (${pricing.upgradeUid}):</strong> Crediting <strong>$${formatPrice(pricing.creditUsd)} USD</strong> from your existing tier — your net upgrade total is <strong>$${formatPrice(pricing.finalUsd)} USD</strong>.`;
			} else {
				modalUpgradeCreditBanner.style.display = 'none';
			}
		}
	}

	function updateCTA() {
		updateStripeButtonText();
		if (!expressBuyBtn) return;
		const pricing = getEffectiveCheckoutPricing(activeTier);
		const labelText = activeTier === 3
			? `💳 PAY WITH VISA / MASTERCARD — TIER 03 TAURI v2 .EXE ($${formatPrice(pricing.finalUsd)} USD) →`
			: (activeTier === 2
				? `💳 PAY WITH VISA / MASTERCARD — TIER 02 6-AGENT & WEB ($${formatPrice(pricing.finalUsd)} USD) →`
				: `💳 PAY WITH VISA / MASTERCARD & UNLOCK VAULT ($${formatPrice(pricing.finalUsd)} USD) →`);
		expressBuyBtn.innerHTML = `<span class="ks-wave-text">${labelText}</span>`;
	}

	function applySharedPromoCode(rawCode) {
		const code = String(rawCode || '').trim().toUpperCase();
		if (promoInput && promoInput.value.trim().toUpperCase() !== code) promoInput.value = code;
		if (modalPromoInput && modalPromoInput.value.trim().toUpperCase() !== code) modalPromoInput.value = code;

		if (promoCodes[code]) {
			discountPct = promoCodes[code];
			const pricing = getEffectiveCheckoutPricing(activeTier);
			const msg = `✔ Promo code ${code} applied: ${discountPct}% OFF ($${formatPrice(pricing.finalUsd)} USD)!`;
			[promoFeedback, modalPromoFeedback].forEach(el => {
				if (!el) return;
				el.style.display = 'block';
				el.style.color = '#38bdf8';
				el.textContent = msg;
			});
		} else if (code === '') {
			discountPct = 0;
			[promoFeedback, modalPromoFeedback].forEach(el => { if (el) el.style.display = 'none'; });
		} else {
			discountPct = 0;
			const errMsg = '✖ Invalid promo code (try BUILDER10).';
			[promoFeedback, modalPromoFeedback].forEach(el => {
				if (!el) return;
				el.style.display = 'block';
				el.style.color = '#f87171';
				el.textContent = errMsg;
			});
		}
		updateCTA();
	}

	function openOrderModal(tierNum) {
		activeTier = parseInt(tierNum, 10) || 1;
		activePrice = tierBasePrices[activeTier] || 49.50;
		if (modalTierSelect) modalTierSelect.value = String(activeTier);
		if (orderTierInput) orderTierInput.value = String(activeTier);
		if (modalTierHeadline) modalTierHeadline.textContent = 'Complete Your Order — ' + (tierNames[activeTier] || tierNames[1]);
		if (modalCheckoutFeedback) modalCheckoutFeedback.style.display = 'none';
		updateCTA();
		if (modal) modal.style.display = 'flex';
	}
	window.krOpenOrderModalForTier = openOrderModal;

	tierBtns.forEach(btn => {
		btn.addEventListener('click', function() {
			tierBtns.forEach(b => b.classList.remove('active'));
			this.classList.add('active');
			activeTier = parseInt(this.getAttribute('data-tier'), 10);
			activePrice = parseFloat(this.getAttribute('data-price'));
			updateCTA();
		});
	});

	function isValidOptionalEmail(emailStr) {
		if (!emailStr) return true;
		return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailStr);
	}

	const heroDirectForm = document.getElementById('heroDirectCheckoutForm');
	const heroFeedback = document.getElementById('heroCheckoutFeedback');
	if (heroDirectForm) {
		heroDirectForm.addEventListener('submit', function(e) {
			e.preventDefault();
			const bName = (document.getElementById('heroBuyerName')?.value || '').trim();
			const bEmail = (document.getElementById('heroBuyerEmail')?.value || '').trim();
			const bNotes = (document.getElementById('heroBuyerNotes')?.value || '').trim();
			const pCode = promoInput ? promoInput.value.trim().toUpperCase() : '';
			if (!isValidOptionalEmail(bEmail)) {
				if (heroFeedback) {
					heroFeedback.style.display = 'block';
					heroFeedback.style.borderColor = '#f87171';
					heroFeedback.innerHTML = '<span style="color:#f87171;font-weight:800;">Please enter a valid email address or leave it blank to enter directly on Stripe Checkout.</span>';
				}
				return;
			}
			const pricing = getEffectiveCheckoutPricing(activeTier);
			if (expressBuyBtn) {
				expressBuyBtn.disabled = true;
				expressBuyBtn.style.opacity = '0.75';
				expressBuyBtn.textContent = '⏳ CONNECTING TO SECURE STRIPE USD CHECKOUT...';
			}
			if (heroFeedback) {
				heroFeedback.style.display = 'block';
				heroFeedback.style.borderColor = '#38bdf8';
				heroFeedback.innerHTML = '<span style="color:#38bdf8;font-weight:700;">Initializing 256-bit encrypted Stripe Visa / Mastercard session...</span>';
			}
			const reqBody = {
				tier: String(activeTier),
				buyer_name: bName,
				buyer_email: bEmail,
				notes: bNotes,
				promo_code: pCode
			};
			if (pricing.isUpgrade && pricing.upgradeUid) {
				reqBody.upgrade_from_uid = pricing.upgradeUid;
			}
			fetch('/wp-json/keystone/v1/create-checkout-session', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify(reqBody)
			})
			.then(r => r.json())
			.then(data => {
				if (data && data.success && data.checkout_url) {
					if (expressBuyBtn) expressBuyBtn.textContent = '✔ REDIRECTING TO STRIPE CHECKOUT...';
					window.location.href = data.checkout_url;
				} else {
					if (expressBuyBtn) {
						expressBuyBtn.disabled = false;
						expressBuyBtn.style.opacity = '1';
						updateCTA();
					}
					if (heroFeedback) {
						heroFeedback.style.display = 'block';
						heroFeedback.style.borderColor = '#f87171';
						heroFeedback.innerHTML = '<span style="color:#f87171;font-weight:800;">' + ((data && data.message) ? data.message : 'Unable to start Stripe Checkout right now. Please try again in a moment or email keystonerecomposition@gmail.com.') + '</span>';
					}
				}
			})
			.catch(() => {
				if (expressBuyBtn) {
					expressBuyBtn.disabled = false;
					expressBuyBtn.style.opacity = '1';
					updateCTA();
				}
				if (heroFeedback) {
					heroFeedback.style.display = 'block';
					heroFeedback.style.borderColor = '#f87171';
					heroFeedback.innerHTML = '<span style="color:#f87171;font-weight:800;">Network error connecting to Stripe Checkout. Please check your connection and click Pay with Visa / Mastercard again.</span>';
				}
			});
		});
	}

	document.querySelectorAll('.js-open-automated-order').forEach(btn => {
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			const t = parseInt(this.getAttribute('data-tier'), 10) || 1;
			openOrderModal(t);
		});
	});

	if (modalTierSelect) {
		modalTierSelect.addEventListener('change', function() {
			const t = parseInt(this.value, 10) || 1;
			activeTier = t;
			activePrice = tierBasePrices[t] || 49.50;
			if (orderTierInput) orderTierInput.value = String(t);
			if (modalTierHeadline) modalTierHeadline.textContent = 'Complete Your Order — ' + (tierNames[t] || tierNames[1]);
			updateCTA();
		});
	}

	if (closeModalBtn && modal) {
		closeModalBtn.addEventListener('click', function() {
			modal.style.display = 'none';
		});
		modal.addEventListener('click', function(e) {
			if (e.target === modal) modal.style.display = 'none';
		});
	}

	if (applyPromoBtn && promoInput) {
		applyPromoBtn.addEventListener('click', function() {
			applySharedPromoCode(promoInput.value);
		});
	}

	if (modalApplyPromoBtn && modalPromoInput) {
		modalApplyPromoBtn.addEventListener('click', function() {
			applySharedPromoCode(modalPromoInput.value);
		});
	}

	function openBuyerLeadVaultView() {
		const portalSec = document.getElementById('kr-self-service-portal');
		const publicSecs = document.getElementById('krPublicSalesSections');
		if (portalSec) {
			portalSec.style.display = 'block';
			if (publicSecs) publicSecs.style.display = 'none';
			portalSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
		}
	}

	const backToSalesBtn = document.getElementById('backToSalesPageBtn');
	if (backToSalesBtn) {
		backToSalesBtn.addEventListener('click', function() {
			const portalSec = document.getElementById('kr-self-service-portal');
			const publicSecs = document.getElementById('krPublicSalesSections');
			if (publicSecs) publicSecs.style.display = 'block';
			if (portalSec) portalSec.style.display = 'none';
			const firstTier = document.getElementById('tier-blueprint');
			if (firstTier) firstTier.scrollIntoView({ behavior: 'smooth', block: 'start' });
		});
	}

	function applyVerifiedVaultState(data) {
		if (!data || !data.valid) return;
		window.krVerifiedBuyerUid = data.uid;
		let resolvedTier = parseInt(data.tier, 10);
		if (!resolvedTier || isNaN(resolvedTier)) {
			const tName = String(data.tier_name || '');
			if (/Tier\s*0?3|800/i.test(tName)) resolvedTier = 3;
			else if (/Tier\s*0?2|199/i.test(tName)) resolvedTier = 2;
			else resolvedTier = 1;
		}
		setReturningDrawerOpen(true);
		try { localStorage.setItem('kr_user_vault_uid', data.uid); } catch (e) {}
		if (vaultUidStatusBadge) {
			vaultUidStatusBadge.textContent = '✔ TIER 0' + resolvedTier + ' UID UNLOCKED: ' + data.uid;
			vaultUidStatusBadge.style.borderColor = '#d4af37';
			vaultUidStatusBadge.style.color = '#f6d365';
		}
		if (existingVaultUidInput) {
			existingVaultUidInput.value = data.uid;
		}
		const zipBtn = document.getElementById('portalQuickZipBtn');
		if (zipBtn) {
			const packSlug = resolvedTier >= 3 ? 'tier3_workstation_pack' : (resolvedTier === 2 ? 'tier2_swarm_pack' : 'tier1_blueprint_pack');
			zipBtn.href = '?vault_download=' + packSlug + '&uid=' + encodeURIComponent(data.uid);
		}
		const tab5ZipBtn = document.getElementById('portalTab5ZipBtn');
		if (tab5ZipBtn) {
			tab5ZipBtn.href = '?vault_download=tier3_workstation_pack&uid=' + encodeURIComponent(data.uid);
		}
		document.querySelectorAll('[data-master-slug]').forEach(linkEl => {
			const mSlug = linkEl.getAttribute('data-master-slug');
			if (mSlug) linkEl.href = '?vault_download=' + encodeURIComponent(mSlug) + '&uid=' + encodeURIComponent(data.uid);
		});
		krEnforceTierPortalLocks(resolvedTier);
		updateCTA();
		openBuyerLeadVaultView();
	}

	function verifyUidWithServer(uidToVerify, showFeedbackBox) {
		if (!uidToVerify) return;
		setReturningDrawerOpen(true);
		fetch('/wp-json/keystone/v1/verify-vault-uid?uid=' + encodeURIComponent(uidToVerify))
			.then(r => r.json())
			.then(data => {
				if (data && data.valid) {
					applyVerifiedVaultState(data);
					if (showFeedbackBox && vaultUidVerifyFeedback) {
						vaultUidVerifyFeedback.style.display = 'block';
						vaultUidVerifyFeedback.style.borderColor = '#d4af37';
						let dlLinks = (data.unlocked_downloads || []).map(d => `<div style="margin-top:4px;"><a href="${d.url}" target="_blank" style="color:#38bdf8;font-weight:700;text-decoration:none;">${d.label}</a></div>`).join('');
						vaultUidVerifyFeedback.innerHTML = `<div style="color:#f6d365;font-weight:800;margin-bottom:4px;">✔ UID VERIFIED (${data.uid}) — ${data.tier_name || 'Buyer Vault Unlocked'}</div><div style="color:#cbd5e1;margin-bottom:6px;">${data.message || ''}</div><div><a href="${data.walkthrough_video_url}" target="_blank" style="color:#ffffff;font-weight:800;text-decoration:underline;">▶ Watch Wayne's Recorded Walkthrough Video</a></div>${dlLinks}`;
					}
				} else if (showFeedbackBox && vaultUidVerifyFeedback) {
					vaultUidVerifyFeedback.style.display = 'block';
					vaultUidVerifyFeedback.style.borderColor = '#f87171';
					vaultUidVerifyFeedback.innerHTML = `<span style="color:#f87171;font-weight:700;">✖ ${data && data.message ? data.message : 'Invalid Buyer KR-UID.'}</span>`;
				}
			})
			.catch(() => {});
	}

	// Auto-expand Returning Buyer Drawer & Detect Stripe Checkout Return (?session_id=cs_..., ?uid=..., #kr-self-service-portal, or saved localStorage UID)
	let initialUid = '';
	let hasSessionReturn = false;
	try {
		const urlParams = new URLSearchParams(window.location.search);
		const stripeSessionId = urlParams.get('session_id');
		initialUid = urlParams.get('uid') || '';
		if (window.location.hash === '#kr-self-service-portal') {
			setReturningDrawerOpen(true);
		}
		if (stripeSessionId && stripeSessionId.indexOf('cs_') === 0) {
			hasSessionReturn = true;
			setReturningDrawerOpen(true);
			const returnNotice = document.createElement('div');
			returnNotice.id = 'stripeReturnNotice';
			returnNotice.style.cssText = 'position:fixed;top:20px;left:50%;transform:translateX(-50%);z-index:99999;background:#04070d;border:2px solid #d4af37;border-radius:12px;padding:14px 24px;box-shadow:0 12px 36px rgba(0,0,0,0.85);color:#f8fafc;font-family:\'Outfit\',sans-serif;font-weight:800;display:flex;align-items:center;gap:12px;';
			returnNotice.innerHTML = '<span style="color:#38bdf8;font-size:1.2rem;">⏳</span> <span>Verifying your Stripe Visa/Mastercard payment...</span>';
			document.body.appendChild(returnNotice);

			fetch('/wp-json/keystone/v1/verify-checkout-session?session_id=' + encodeURIComponent(stripeSessionId))
				.then(r => r.json())
				.then(data => {
					if (data && data.verified) {
						returnNotice.innerHTML = '<span style="color:#f6d365;font-size:1.2rem;">✔</span> <span>Payment Verified ($' + (data.formatted_price || '') + ' USD)! Unlocking your Buyer Vault...</span>';
						returnNotice.style.borderColor = '#38bdf8';
						applyVerifiedVaultState({
							valid: true,
							uid: data.uid,
							tier: data.tier,
							tier_name: data.tier_name,
							walkthrough_video_url: data.walkthrough_video_url,
							unlocked_downloads: data.unlocked_downloads
						});
						setTimeout(() => {
							if (returnNotice.parentNode) returnNotice.parentNode.removeChild(returnNotice);
						}, 6000);
					} else {
						returnNotice.innerHTML = '<span style="color:#ef4444;font-size:1.2rem;">✖</span> <span>' + (data && data.message ? data.message : 'Stripe payment verification pending.') + '</span>';
						setTimeout(() => {
							if (returnNotice.parentNode) returnNotice.parentNode.removeChild(returnNotice);
						}, 6000);
					}
				})
				.catch(() => {
					returnNotice.innerHTML = '<span style="color:#ef4444;font-size:1.2rem;">✖</span> <span>Network error verifying Stripe session.</span>';
					setTimeout(() => {
						if (returnNotice.parentNode) returnNotice.parentNode.removeChild(returnNotice);
					}, 4000);
				});
		}
	} catch (e) {}

	if (initialUid) {
		verifyUidWithServer(initialUid, true);
	} else if (!hasSessionReturn) {
		try {
			const savedUid = (localStorage.getItem('kr_user_vault_uid') || localStorage.getItem('kr_vault_uid') || '').trim();
			if (savedUid) {
				if (existingVaultUidInput) existingVaultUidInput.value = savedUid;
				setReturningDrawerOpen(true);
				if (window.location.hash === '#kr-self-service-portal') {
					verifyUidWithServer(savedUid, false);
				}
			}
		} catch (e) {}
	}

	if (verifyVaultUidBtn && existingVaultUidInput) {
		verifyVaultUidBtn.addEventListener('click', function() {
			const val = existingVaultUidInput.value.trim();
			if (val) verifyUidWithServer(val, true);
		});
	}

	function runModalStripeCheckout() {
		if (!stripeCardBtn) return;
		const buyerNameInput = document.getElementById('orderBuyerName');
		const buyerEmailInput = document.getElementById('orderBuyerEmail');
		const buyerNotesInput = document.getElementById('orderBuyerNotes');
		const buyerName = buyerNameInput ? buyerNameInput.value.trim() : '';
		const buyerEmail = buyerEmailInput ? buyerEmailInput.value.trim() : '';
		const buyerNotes = buyerNotesInput ? buyerNotesInput.value.trim() : '';
		const promoCode = (modalPromoInput?.value || promoInput?.value || '').trim().toUpperCase();

		if (!isValidOptionalEmail(buyerEmail)) {
			if (modalCheckoutFeedback) {
				modalCheckoutFeedback.style.display = 'block';
				modalCheckoutFeedback.style.borderColor = '#f87171';
				modalCheckoutFeedback.innerHTML = '<span style="color:#f87171;font-weight:800;">Please enter a valid email address or leave it blank to enter directly on Stripe Checkout.</span>';
			}
			if (buyerEmailInput) buyerEmailInput.focus();
			return;
		}

		const targetT = modalTierSelect ? (parseInt(modalTierSelect.value, 10) || activeTier) : activeTier;
		const pricing = getEffectiveCheckoutPricing(targetT);

		stripeCardBtn.disabled = true;
		stripeCardBtn.style.opacity = '0.7';
		if (stripeCardBtnText) stripeCardBtnText.textContent = 'CONNECTING TO STRIPE HOSTED CHECKOUT...';
		if (modalCheckoutFeedback) {
			modalCheckoutFeedback.style.display = 'block';
			modalCheckoutFeedback.style.borderColor = '#38bdf8';
			modalCheckoutFeedback.innerHTML = '<span style="color:#38bdf8;font-weight:700;">Initializing 256-bit encrypted Stripe Visa / Mastercard session...</span>';
		}

		const payload = {
			tier: String(targetT),
			buyer_name: buyerName,
			buyer_email: buyerEmail,
			notes: buyerNotes,
			promo_code: promoCode
		};
		if (pricing.isUpgrade && pricing.upgradeUid) {
			payload.upgrade_from_uid = pricing.upgradeUid;
		}

		fetch('/wp-json/keystone/v1/create-checkout-session', {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify(payload)
		})
		.then(r => r.json())
		.then(data => {
			if (data && data.success && data.checkout_url) {
				if (stripeCardBtnText) stripeCardBtnText.textContent = 'REDIRECTING TO STRIPE...';
				window.location.href = data.checkout_url;
			} else {
				stripeCardBtn.disabled = false;
				stripeCardBtn.style.opacity = '1';
				updateStripeButtonText();
				if (modalCheckoutFeedback) {
					modalCheckoutFeedback.style.display = 'block';
					modalCheckoutFeedback.style.borderColor = '#f87171';
					modalCheckoutFeedback.innerHTML = '<span style="color:#f87171;font-weight:800;">' + ((data && data.message) ? data.message : 'Unable to start Stripe Checkout right now. Please try again or email keystonerecomposition@gmail.com.') + '</span>';
				}
			}
		})
		.catch(() => {
			stripeCardBtn.disabled = false;
			stripeCardBtn.style.opacity = '1';
			updateStripeButtonText();
			if (modalCheckoutFeedback) {
				modalCheckoutFeedback.style.display = 'block';
				modalCheckoutFeedback.style.borderColor = '#f87171';
				modalCheckoutFeedback.innerHTML = '<span style="color:#f87171;font-weight:800;">Network error connecting to Stripe Checkout. Please check your connection and try again.</span>';
			}
		});
	}

	if (stripeCardBtn) {
		stripeCardBtn.addEventListener('click', function(e) {
			e.preventDefault();
			runModalStripeCheckout();
		});
	}

	if (orderForm) {
		orderForm.addEventListener('submit', function(e) {
			e.preventDefault();
			if (window.KR_VISA_LIVE) {
				runModalStripeCheckout();
				return;
			}
			const submitBtn = document.getElementById('submitAutomatedOrderBtn');
			if (submitBtn) {
				submitBtn.disabled = true;
				submitBtn.textContent = '⏳ LOCKING IN DEV RESERVATION...';
			}
			const payload = {
				tier: modalTierSelect ? modalTierSelect.value : String(activeTier),
				buyer_name: document.getElementById('orderBuyerName').value.trim(),
				buyer_email: document.getElementById('orderBuyerEmail').value.trim(),
				notes: document.getElementById('orderBuyerNotes').value.trim(),
				promo_code: (modalPromoInput?.value || promoInput?.value || '').trim().toUpperCase()
			};
			fetch('/wp-json/keystone/v1/protocol-order', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify(payload)
			})
			.then(r => r.json())
			.then(data => {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.textContent = '✔ DEV RESERVATION SAVED';
				}
				if (data && data.success) {
					applyVerifiedVaultState({ valid: true, uid: data.user_uid, tier: data.tier || (modalTierSelect ? modalTierSelect.value : String(activeTier)), tier_name: data.tier_name, walkthrough_video_url: data.walkthrough_video_url, unlocked_downloads: data.unlocked_downloads });
					if (successBox) successBox.style.display = 'block';
					if (fulfilledUidReadout) fulfilledUidReadout.textContent = 'UID: ' + data.user_uid;
					if (fulfilledMessageText) fulfilledMessageText.textContent = data.message;
					if (data.unlocked_downloads && data.unlocked_downloads.length > 0 && fulfilledLiveDownloadsWrap) {
						fulfilledLiveDownloadsWrap.style.display = 'block';
						if (fulfilledVideoBtn) fulfilledVideoBtn.href = data.walkthrough_video_url;
						if (fulfilledDownloadsList) {
							fulfilledDownloadsList.innerHTML = data.unlocked_downloads.map(d => `<li><a href="${d.url}" target="_blank" style="color:#38bdf8;font-weight:700;text-decoration:none;">${d.label}</a></li>`).join('');
						}
					}
				}
			})
			.catch(() => {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.textContent = '🔒 DEV FALLBACK: RESERVE LAUNCH RATE →';
				}
			});
		});
	}
});
</script>

<?php
get_footer();
