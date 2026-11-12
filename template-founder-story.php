<?php
/**
 * Template Name: Founder Story
 * Template Post Type: page
 *
 * The Founder Story — Wayne Stevenson (BC Housing Licensed Builder #52603,
 * Recording Artist & Principal AI Systems Architect).
 *
 * @package Keystone_Recomposition_Child
 * @version 4.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$child_assets = get_stylesheet_directory_uri() . '/assets/images';
?>

<style id="kr-v4-founder-hub-css">
.keystone-founder-page {
	background: radial-gradient(circle at 16% 6%, rgba(212, 175, 55, 0.08) 0%, transparent 42%),
	            radial-gradient(circle at 84% 12%, rgba(56, 189, 248, 0.08) 0%, transparent 46%),
	            #04070d;
	overflow-x: clip;
}
.keystone-founder-page .founder-container {
	max-width: 1240px;
	width: 100%;
	box-sizing: border-box;
	padding-left: clamp(1rem, 3vw, 1.75rem);
	padding-right: clamp(1rem, 3vw, 1.75rem);
}
.kr-v4-founder-split-hero {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(min(100%, 340px), 1fr));
	gap: clamp(1.5rem, 3vw, 2.4rem);
	align-items: stretch;
	text-align: left !important;
	background: linear-gradient(145deg, rgba(4, 7, 13, 0.96) 0%, rgba(0, 0, 0, 0.95) 100%);
	border: 1px solid rgba(212, 175, 55, 0.36);
	border-radius: 20px;
	padding: clamp(1.5rem, 3.2vw, 2.5rem);
	margin-bottom: 2.5rem;
	box-shadow: 0 22px 54px rgba(0, 0, 0, 0.68), inset 0 1px 0 rgba(56, 189, 248, 0.16);
}
.kr-v4-founder-hero-copy {
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	gap: 1.05rem;
}
.kr-v4-founder-hero-copy .founder-main-name,
.kr-v4-founder-hero-copy .founder-lead-subtitle {
	text-align: left !important;
	margin-left: 0 !important;
	margin-right: 0 !important;
}
.kr-v4-founder-hero-links {
	display: flex;
	flex-wrap: wrap;
	gap: 0.7rem;
}
.kr-v4-founder-pill-link {
	display: inline-flex;
	align-items: center;
	gap: 0.45rem;
	min-height: 42px;
	padding: 0.55rem 1.15rem;
	border-radius: 9999px;
	background: #000000;
	border: 1px solid rgba(212, 175, 55, 0.48);
	color: #f6d365 !important;
	font-family: 'Outfit', sans-serif;
	font-size: 0.78rem;
	font-weight: 800;
	letter-spacing: 0.06em;
	text-transform: uppercase;
	text-decoration: none !important;
}
.kr-v4-founder-pill-link.is-cyan {
	border-color: rgba(56, 189, 248, 0.52);
	color: #38bdf8 !important;
}
.kr-v4-founder-split-hero .founder-telemetry-4grid {
	display: grid !important;
	grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
	gap: 0.9rem !important;
	margin-top: 0 !important;
}
.founder-top-profile-grid,
.founder-domains-2x2-grid,
.founder-portal-scope-grid,
.founder-portal-bottom-split {
	max-width: 100%;
	box-sizing: border-box;
}
@media (max-width: 640px) {
	.kr-v4-founder-split-hero .founder-telemetry-4grid {
		grid-template-columns: 1fr !important;
	}
	.kr-v4-founder-pill-link {
		width: 100%;
		justify-content: center;
	}
}
</style>

<main id="primary" class="site-main keystone-founder-page">

	<div class="founder-ambient-glow-gold"></div>
	<div class="founder-ambient-glow-cyan"></div>

	<div class="container founder-container">

		<!-- =====================================================================
		     1. SOVEREIGN v4.0 SPLIT-HERO HEADER & 4-CARD BENCHMARK TELEMETRY
		     ===================================================================== -->
		<section class="founder-hero-header kr-v4-founder-split-hero">
			<div class="kr-v4-founder-hero-copy">
				<div>
					<div class="founder-hero-kicker">FOUNDER &amp; SYSTEMS ARCHITECT // SQUAMISH &amp; WHISTLER, BC &bull; LICENSED BUILDER #52603</div>
					<h1 class="founder-main-name">
						Wayne Stevenson <span class="cyan-gold-gradient-text">// Builder &amp; Systems Architect</span>
					</h1>
				</div>
				<p class="founder-lead-subtitle">
					Physical recomposition, custom architectural estates, 432Hz sonic production, and multi-agent AI software are governed by the exact same laws of structural engineering: inspect the foundation, eliminate dead weight, and compound verified daily execution.
				</p>
				<div class="kr-v4-founder-hero-links">
					<a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="kr-v4-founder-pill-link is-cyan">⚡ AI Protocols Vault &rarr;</a>
					<a href="<?php echo esc_url( home_url( '/sonic-universe/' ) ); ?>" class="kr-v4-founder-pill-link">🎵 25-Release Sonic Universe &rarr;</a>
					<a href="https://keystonepossibilities.ca/" target="_blank" rel="noopener" class="kr-v4-founder-pill-link">🏛️ Keystone Possibilities #52603 &#8599;</a>
				</div>
			</div>

			<div class="founder-telemetry-4grid">
				<div class="luxury-metric-card founder-metric-card founder-metric-gold">
					<span class="metric-label">BC HOUSING DEVELOPER &amp; GC</span>
					<span class="metric-value-gold">#52603</span>
					<span class="metric-caption">305 Verified CPD Points &bull; WBI #230088 &bull; BC Hydro ES54</span>
				</div>
				<div class="luxury-metric-card founder-metric-card founder-metric-blue">
					<span class="metric-label">PHYSICAL RECOMPOSITION</span>
					<span class="metric-value-cyan">-48 LBS</span>
					<span class="metric-caption">205-lb Lean Athletic Set-Point &bull; Zero Crash Dieting</span>
				</div>
				<div class="luxury-metric-card founder-metric-card founder-metric-gold">
					<span class="metric-label">SONIC ARCHITECTURE</span>
					<span class="metric-value-gold">25 RELEASES</span>
					<span class="metric-caption">246 Master Tracks &bull; Certified Musixmatch Graduate</span>
				</div>
				<div class="luxury-metric-card founder-metric-card founder-metric-blue">
					<span class="metric-label">AI SOFTWARE SYSTEMS</span>
					<span class="metric-value-cyan">3 TIERS</span>
					<span class="metric-caption">AI Brain, Multi-Agent Swarms &amp; Tauri Desktop Apps</span>
				</div>
			</div>
		</section>

		<!-- =====================================================================
		     2. BALANCED 2-COLUMN EXECUTIVE PROFILE & FIDUCIARY CREDENTIALS SPLIT
		     ===================================================================== -->
		<section class="founder-top-profile-section" aria-label="Executive Founder Dossier &amp; Fiduciary Credentials">
			<div class="founder-top-profile-grid">

				<!-- Left Card: Portrait, 2x2 Benchmark Grid & AI Protocols CTA -->
				<article class="founder-portrait-card founder-card-gold">
					<div class="founder-card-top-bar">
						<span class="founder-card-pill ks-p3-pill-gold"><span class="ks-wave-text">PRINCIPAL DOSSIER</span></span>
						<span class="founder-card-cat founder-cat-gold">SEA-TO-SKY CORRIDOR, BC</span>
					</div>

					<div class="founder-portrait-frame">
						<img src="<?php echo esc_url( $child_assets . '/wayne_possibilities_coastal_estate.jpg' ); ?>"
						     alt="Wayne Stevenson — Founder of Keystone Recomposition &amp; Keystone Possibilities Ltd (BC Housing Licensed Builder #52603)"
						     class="founder-portrait-img"
						     width="800" height="450"
						     loading="eager" fetchpriority="high" />
						<div class="founder-portrait-caption-bar">
							<span class="portrait-status-dot"></span>
							<span>WAYNE STEVENSON &bull; FOUNDER &amp; PRINCIPAL ARCHITECT</span>
						</div>
					</div>

					<div class="founder-quick-2x2-grid">
						<div class="founder-quick-stat-box">
							<span class="quick-stat-val gold-text">-48 LBS</span>
							<span class="quick-stat-lbl">VERIFIED RECOMPOSITION</span>
						</div>
						<div class="founder-quick-stat-box">
							<span class="quick-stat-val cyan-text">205 LBS</span>
							<span class="quick-stat-lbl">LEAN ATHLETIC SET-POINT</span>
						</div>
						<div class="founder-quick-stat-box">
							<span class="quick-stat-val cyan-text">25 RELEASES</span>
							<span class="quick-stat-lbl">246 STUDIO MASTERS</span>
						</div>
						<div class="founder-quick-stat-box">
							<span class="quick-stat-val gold-text">#52603</span>
							<span class="quick-stat-lbl">BC HOUSING BUILDER LICENCE</span>
						</div>
					</div>

					<div class="founder-card-footer">
						<a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="founder-action-btn ks-p3-btn-blue">
							<span class="ks-wave-text">⚡ Explore AI Protocols &amp; Pricing Vault &rarr;</span>
						</a>
					</div>
				</article>

				<!-- Right Card: The Sovereign Builder Philosophy & BC Housing #52603 Crest Box -->
				<article class="founder-philosophy-fiduciary-card founder-card-blue">
					<div class="founder-card-top-bar">
						<span class="founder-card-pill ks-p3-pill-blue"><span class="ks-wave-text">PHILOSOPHY &amp; FIDUCIARY CREDENTIALS</span></span>
						<span class="founder-card-cat founder-cat-blue">VERIFIED OPERATING RECORD</span>
					</div>

					<div class="founder-philosophy-body">
						<h2 class="founder-section-h2">The Sovereign Builder Philosophy</h2>

						<blockquote class="founder-quote-callout">
							&ldquo;When you build custom estates in Whistler or high-voltage civil infrastructure for BC Hydro, guesswork is a liability. Every load path, concrete pour, and electrical panel is engineered, inspected, and verified. I apply that exact same builder standard to human recomposition, 432Hz sound design, and autonomous AI software.&rdquo;
						</blockquote>

						<p class="founder-narrative-para">
							Based in the Sea-to-Sky Corridor of British Columbia, <strong>Wayne Stevenson</strong> is the founder and principal of <strong>Keystone Possibilities Ltd. (BC Corp #BC1408830 &bull; BC Housing Licensed Developer &amp; General Contractor #52603)</strong> and the founder of <strong>Keystone Recomposition Ltd. (BC Corp #BC1573685)</strong>. Over two decades of directing custom mountain and coastal estates, residential multiplexes, and civil infrastructure taught a singular truth: complex systems only fail when their underlying architecture is left uninspected.
						</p>

						<p class="founder-narrative-para">
							Applying structural engineering discipline to his own biology, Wayne executed a documented <strong>48-pound physical recomposition</strong>—establishing a permanent <strong>205-lb lean athletic set-point</strong> powered by whole-food nutrition, heavy compound strength training, and cold-water recovery—while earning his <strong>Certified Musixmatch Graduate</strong> diploma (<em>Class of February 2026</em>), producing a <strong>25-release (246-track) 432Hz music catalog</strong>, and engineering our <strong>3-tier AI Protocols &amp; Tauri Desktop software suite</strong>.
						</p>

						<!-- Verified BC Housing #52603 Crest & Fiduciary Box -->
						<div class="founder-fiduciary-crest-box">
							<div class="fiduciary-crest-media">
								<img src="<?php echo esc_url( $child_assets . '/keystone_possibilities_crest.png' ); ?>"
								     alt="Keystone Possibilities Ltd — BC Housing Licensed Developer &amp; General Contractor #52603 Crest"
								     class="fiduciary-crest-img"
								     width="88" height="88"
								     loading="lazy" />
							</div>
							<div class="fiduciary-crest-copy">
								<span class="fiduciary-crest-kicker">GOVERNMENT-VERIFIED FIDUCIARY CREDENTIAL &bull; 305 VERIFIED CPD POINTS</span>
								<h3 class="fiduciary-crest-title">Keystone Possibilities Ltd. &bull; Licensed Developer &amp; General Contractor #52603</h3>
								<p class="fiduciary-crest-desc">
									Active licensed residential developer &amp; general contractor in 100% active-term CPD compliance (<strong>305 Verified CPD Points</strong> &bull; 20.00/20.00 active term) with <strong>WBI Home Warranty #230088</strong>, <strong>BC Hydro Civil Contractor List ES54</strong>, and <strong>BC Corp #BC1408830</strong>.
								</p>
							</div>
						</div>
					</div>

					<div class="founder-card-footer">
						<a href="https://www.bchousing.org/licensing-consumer-disclosure/licencee-search" target="_blank" rel="noopener noreferrer" class="founder-action-btn ks-p3-btn-gold">
							<span class="ks-wave-text">🏛️ Verify Licence #52603 on BC Housing Portal &#8599;</span>
						</a>
					</div>
				</article>

			</div>
		</section>

		<!-- =====================================================================
		     2B. VERIFIED MUSIC & ENGINEERING CREDENTIALS SHOWCASE (DIPLOMA + #52603)
		     ===================================================================== -->
		<section id="founder-verified-credentials" class="kr-verified-creds-section" aria-label="Verified Music and Engineering Credentials">
			<div class="kr-verified-creds-header">
				<div class="kr-verified-creds-kicker">VERIFIED CREDENTIALS VAULT // DIPLOMA, CORPORATE &amp; STATUTORY REGISTRATIONS</div>
				<h2 class="kr-verified-creds-title">
					Verified <span class="cyan-gold-gradient-text">Music &amp; Engineering</span> Credentials
				</h2>
				<p class="kr-verified-creds-sub">
					Primary-source documentation across both operating corporations: <strong>Keystone Recomposition Ltd. (BC Corp #BC1573685)</strong> for original 24-bit studio mastering, Musixmatch metadata curation, and sovereign AI software, alongside <strong>Keystone Possibilities Ltd. (BC Corp #BC1408830)</strong> for licensed residential development and civil contracting.
				</p>
			</div>

			<div class="kr-verified-creds-grid">
				<!-- Left Card: Certified Musixmatch Graduate Diploma & Music Authority -->
				<article class="kr-cred-card">
					<div>
						<div class="kr-cred-card-top">
							<span class="kr-cred-badge-pill">MUSIXMATCH ACADEMY &bull; CLASS OF FEBRUARY 2026</span>
							<span class="kr-cred-status-tag">&#10003; DEAN-SIGNED DIPLOMA</span>
						</div>
						<h3 class="kr-cred-h3">Certified Musixmatch Graduate</h3>
						<p class="kr-cred-desc">
							Conferred upon Curtis (Wayne) Stevenson (<em>Musixmatch Academy &bull; Class of February 2026</em>) and signed by <strong>Vanessa Hurst, Dean of Musixmatch Academy</strong>—paired with verified artist, label, and corporate registrations across global DSPs.
						</p>
					</div>

					<button type="button"
					        class="kr-diploma-preview-btn"
					        data-kr-lightbox="1"
					        data-kr-lightbox-open="<?php echo esc_url( $child_assets . '/musixmatch-academy-graduate-2026.jpg' ); ?>"
					        data-kr-src="<?php echo esc_url( $child_assets . '/musixmatch-academy-graduate-2026.jpg' ); ?>"
					        data-kr-title="Certified Musixmatch Graduate — Musixmatch Academy (Class of February 2026)"
					        data-kr-subtitle="Conferred upon Curtis (Wayne) Stevenson • Signed by Vanessa Hurst, Dean of Musixmatch Academy • Musixmatch Pro #72648585"
					        data-kr-alt="Certified Musixmatch Graduate Diploma — Musixmatch Academy Class of February 2026"
					        aria-label="Click to zoom Certified Musixmatch Graduate Diploma">
						<img src="<?php echo esc_url( $child_assets . '/musixmatch-academy-graduate-2026.jpg' ); ?>"
						     alt="Certified Musixmatch Graduate Diploma — Musixmatch Academy Class of February 2026, signed by Dean Vanessa Hurst"
						     class="kr-diploma-preview-img"
						     width="1600"
						     height="1107"
						     loading="lazy"
						     decoding="async" />
						<span class="kr-diploma-zoom-bar">
							<span>🎓 MUSIXMATCH ACADEMY &bull; CLASS OF FEB 2026</span>
							<span class="kr-diploma-zoom-cta">&#128269; Click to Zoom Full Diploma &nearr;</span>
						</span>
					</button>

					<div class="kr-cred-meta-list">
						<div class="kr-cred-meta-box kr-cred-meta-box--gold">
							<span class="kr-cred-meta-lbl">Musixmatch Pro Roster</span>
							<span class="kr-cred-meta-val"><a href="https://pro.musixmatch.com/roster/artist/72648585" target="_blank" rel="noopener noreferrer">#72648585 &nearr;</a></span>
						</div>
						<div class="kr-cred-meta-box">
							<span class="kr-cred-meta-lbl">Spotify Verified OAC</span>
							<span class="kr-cred-meta-val"><a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer">52v3Qe6Jo0hg764driOl5Y &nearr;</a></span>
						</div>
						<div class="kr-cred-meta-box">
							<span class="kr-cred-meta-lbl">MusicBrainz Artist MBID</span>
							<span class="kr-cred-meta-val"><a href="https://musicbrainz.org/artist/1a30328b-20b2-48bd-8e56-2884d3b040c0" target="_blank" rel="noopener noreferrer">1a30328b-20b2-48bd-8e56-2884d3b040c0 &nearr;</a></span>
						</div>
						<div class="kr-cred-meta-box kr-cred-meta-box--gold">
							<span class="kr-cred-meta-lbl">Corporate Entity</span>
							<span class="kr-cred-meta-val">Keystone Recomposition Ltd. &bull; BC Corp #BC1573685</span>
						</div>
					</div>

					<div class="kr-cred-actions-row">
						<a href="https://pro.musixmatch.com/roster/artist/72648585" target="_blank" rel="noopener noreferrer" class="kr-cred-pill-cta">
							Verify Musixmatch Pro #72648585 &nearr;
						</a>
						<a href="<?php echo esc_url( home_url( '/sonic-universe/' ) ); ?>" class="kr-cred-pill-cta kr-cred-pill-cta--cyan">
							Open 25-Release Sonic Universe &rarr;
						</a>
					</div>
				</article>

				<!-- Right Card: Sister Principal Infrastructure Credentials (Keystone Possibilities Ltd.) -->
				<article class="kr-cred-card kr-cred-card--cyan">
					<div>
						<div class="kr-cred-card-top">
							<span class="kr-cred-badge-pill kr-cred-badge-pill--cyan">SISTER PRINCIPAL INFRASTRUCTURE &bull; #52603</span>
							<span class="kr-cred-status-tag">100% ACTIVE-TERM COMPLIANT</span>
						</div>
						<h3 class="kr-cred-h3">BC Housing Licensed Developer &amp; General Contractor #52603</h3>
						<p class="kr-cred-desc">
							Statutory construction and civil engineering credentials held by Wayne Stevenson through sister corporation <strong>Keystone Possibilities Ltd. (BC Corp #BC1408830)</strong> across the Sea-to-Sky Corridor and Greater Vancouver.
						</p>
					</div>

					<div class="kr-cred-spec-stack">
						<div class="kr-cred-spec-row">
							<span class="kr-cred-spec-dot"></span>
							<div class="kr-cred-spec-copy">
								<strong>BC Housing Licensed Developer &amp; General Contractor #52603</strong>
								Official <em>Developer and General Contractor</em> classification in continuous good standing with BC Housing Licensing &amp; Consumer Services (#47248 &rarr; #52603).
							</div>
						</div>
						<div class="kr-cred-spec-row kr-cred-spec-row--cyan">
							<span class="kr-cred-spec-dot"></span>
							<div class="kr-cred-spec-copy">
								<strong>305 Verified CPD Points (100% Active-Term Compliant)</strong>
								20.00 / 20.00 active-term points achieved across all 7 of 7 BC Housing core competency categories (building code, thermal/moisture envelope, construction law, financial management, and project supervision).
							</div>
						</div>
						<div class="kr-cred-spec-row">
							<span class="kr-cred-spec-dot"></span>
							<div class="kr-cred-spec-copy">
								<strong>WBI Home Warranty #230088</strong>
								Statutory 2-5-10 Year Home Warranty Insurance registration backing custom luxury residences and Bill 44 SSMUH multiplexes.
							</div>
						</div>
						<div class="kr-cred-spec-row kr-cred-spec-row--cyan">
							<span class="kr-cred-spec-dot"></span>
							<div class="kr-cred-spec-copy">
								<strong>BC Hydro Civil Contractor List ES54 &amp; BC Corp #BC1408830</strong>
								Registered underground civil utility and high-voltage trenching/substation contractor under <strong>Keystone Possibilities Ltd. (BC Corp #BC1408830)</strong>.
							</div>
						</div>
					</div>

					<div class="kr-cred-actions-row">
						<a href="https://keystonepossibilities.ca/" target="_blank" rel="noopener" class="kr-cred-pill-cta">
							Visit KeystonePossibilities.ca &nearr;
						</a>
						<a href="https://www.bchousing.org/licensing-consumer-disclosure/licencee-search" target="_blank" rel="noopener noreferrer" class="kr-cred-pill-cta kr-cred-pill-cta--cyan">
							BC Housing Public Registry &nearr;
						</a>
					</div>
				</article>
			</div>
		</section>

		<!-- =====================================================================
		     3. THE FOUR FOUNDER MASTERY DOMAINS (2x2 EQUAL-HEIGHT PARALLEL GRID)
		     ===================================================================== -->
		<section class="founder-domains-section" aria-label="The Four Founder Operating Domains">
			<div class="founder-section-header text-center">
				<div class="founder-section-kicker">FOUR PILLARS OF EXECUTION // STRUCTURAL, DIGITAL, SONIC &amp; BIOLOGICAL MASTERY</div>
				<h2 class="founder-domains-main-title">
					The Four Founder <span class="cyan-gold-gradient-text">Operating Domains</span>
				</h2>
				<p class="founder-domains-subtitle">
					Every division under the Keystone banner is built and operated directly by Wayne Stevenson—uniting licensed physical construction, multi-agent software engineering, 432Hz studio production, and disciplined human performance.
				</p>
			</div>

			<div class="founder-domains-2x2-grid">

				<!-- DOMAIN 01: LICENSED BUILDER #52603 & HEAVY CIVIL (GOLD) -->
				<article class="founder-domain-card founder-card-gold">
					<div class="founder-card-top-bar">
						<span class="founder-card-pill ks-p3-pill-gold"><span class="ks-wave-text">01 &bull; LICENSED BUILDER #52603</span></span>
						<span class="founder-card-cat founder-cat-gold">ESTATES, MULTIPLEXES &amp; CIVIL</span>
					</div>

					<div class="founder-domain-dual-media">
						<div class="founder-media-half">
							<img src="<?php echo esc_url( $child_assets . '/whistler_luxury_estate.jpg' ); ?>"
							     alt="Whistler &amp; Squamish Custom Architectural Mountain Estate Construction"
							     class="founder-domain-img"
							     width="480" height="270"
							     loading="lazy" />
						</div>
						<div class="founder-media-half">
							<img src="<?php echo esc_url( $child_assets . '/west_vancouver_concrete.jpg' ); ?>"
							     alt="West Vancouver Architectural Concrete &amp; High-Voltage Civil Infrastructure"
							     class="founder-domain-img"
							     width="480" height="270"
							     loading="lazy" />
						</div>
					</div>

					<h3 class="founder-domain-title">Custom Estates, Bill 44 Multiplexes &amp; Heavy Civil Contracting</h3>
					<p class="founder-domain-summary">
						Over two decades directing custom luxury mountain and coastal estates, multi-unit residential developments, and high-voltage civil infrastructure across Whistler, Squamish, West Vancouver, and Greater Vancouver.
					</p>

					<div class="founder-domain-spec-list">
						<div class="founder-domain-spec-item">
							<span class="spec-icon">🏛️</span>
							<div>
								<strong>BC Housing Licensed Builder #52603</strong>
								<span>Principal of Keystone Possibilities Ltd, delivering architectural custom homes, structural renovations, and multi-unit residential infill.</span>
							</div>
						</div>
						<div class="founder-domain-spec-item">
							<span class="spec-icon">⚡</span>
							<div>
								<strong>High-Voltage Civil &amp; Substation Infrastructure</strong>
								<span>Proven field execution across complex civil concrete formwork, hydro trenching, and seismic-grade structural engineering.</span>
							</div>
						</div>
						<div class="founder-domain-spec-item">
							<span class="spec-icon">📐</span>
							<div>
								<strong>Bill 44 Multiplex &amp; Envelope Engineering</strong>
								<span>Turnkey municipal feasibility, pro-forma modeling, and high-performance building envelope construction across British Columbia.</span>
							</div>
						</div>
					</div>

					<div class="founder-card-footer">
						<a href="https://keystonepossibilities.ca" target="_blank" rel="noopener noreferrer" class="founder-action-btn ks-p3-btn-gold">
							<span class="ks-wave-text">🏗️ Explore Keystone Possibilities Portfolio &#8599;</span>
						</a>
					</div>
				</article>

				<!-- DOMAIN 02: AI PROTOCOLS, MULTI-AGENT SWARMS & TAURI DESKTOP APPS (BLUE) -->
				<article class="founder-domain-card founder-card-blue">
					<div class="founder-card-top-bar">
						<span class="founder-card-pill ks-p3-pill-blue"><span class="ks-wave-text">02 &bull; AI PROTOCOLS &amp; DESKTOP APPS</span></span>
						<span class="founder-card-cat founder-cat-blue">3-TIER SOFTWARE ECOSYSTEM</span>
					</div>

					<div class="founder-domain-single-media">
						<img src="<?php echo esc_url( $child_assets . '/wayne_ai_protocols_boardroom.jpg' ); ?>"
						     alt="Wayne Stevenson in the Keystone AI Protocols Boardroom — AI Brain, Multi-Agent Swarms &amp; Custom Tauri Desktop Command Center"
						     class="founder-domain-img"
						     width="800" height="450"
						     loading="lazy" />
					</div>

					<h3 class="founder-domain-title">AI Brain, Multi-Agent Swarms &amp; Tauri Desktop Command Center</h3>
					<p class="founder-domain-summary">
						Applying construction-grade critical-path scheduling to software engineering—deploying local-first AI memory vaults, parallel multi-agent swarms, and custom native desktop command centers.
					</p>

					<div class="founder-domain-spec-list">
						<div class="founder-domain-spec-item">
							<span class="spec-icon">🧠</span>
							<div>
								<strong>Tier 1 ($49.50) &mdash; AI Brain &amp; Google Flow Blueprint</strong>
								<span>Persistent local vector memory vault, cinematic video production orchestration, and 3 days of guided setup support.</span>
							</div>
						</div>
						<div class="founder-domain-spec-item">
							<span class="spec-icon">🐝</span>
							<div>
								<strong>Tier 2 ($199) &mdash; Multi-Agent Swarms &amp; Website Builder</strong>
								<span>Parallel multi-agent research, automated verification gates, and luxury full-stack web deployment with 6 days of setup support.</span>
							</div>
						</div>
						<div class="founder-domain-spec-item">
							<span class="spec-icon">🖥️</span>
							<div>
								<strong>Tier 3 ($800) &mdash; Custom Tauri Desktop Command Center</strong>
								<span>Full flagship native desktop application with voice HUD, omnichannel &amp; financial automation, and 6 days of priority onboarding.</span>
							</div>
						</div>
					</div>

					<div class="founder-card-footer">
						<a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="founder-action-btn ks-p3-btn-blue">
							<span class="ks-wave-text">⚡ Explore AI Protocols &amp; Pricing Vault &rarr;</span>
						</a>
					</div>
				</article>

				<!-- DOMAIN 03: 432HZ SONIC ARCHITECTURE & 25 OFFICIAL RELEASES (BLUE) -->
				<article class="founder-domain-card founder-card-blue">
					<div class="founder-card-top-bar">
						<span class="founder-card-pill ks-p3-pill-blue"><span class="ks-wave-text">03 &bull; 432HZ SONIC ARCHITECTURE</span></span>
						<span class="founder-card-cat founder-cat-blue">25 RELEASES &bull; 246 MASTERS</span>
					</div>

					<div class="founder-domain-single-media">
						<img src="<?php echo esc_url( $child_assets . '/sonic_universe_banner.png' ); ?>"
						     alt="Keystone Recomposition Sonic Universe — 25 Official Releases &amp; 246 Studio Masters"
						     class="founder-domain-img"
						     width="800" height="450"
						     loading="lazy" />
					</div>

					<h3 class="founder-domain-title">The Sonic Universe: 25 Official Releases &amp; 246 Studio Masters</h3>
					<p class="founder-domain-summary">
						Executive producer and recording artist behind a 25-release catalog (23 studio albums and 2 singles &mdash; 246 master tracks) engineered for deep cognitive focus, physical training, and architectural flow.
					</p>

					<div class="founder-domain-spec-list">
						<div class="founder-domain-spec-item">
							<span class="spec-icon">🎵</span>
							<div>
								<strong>25 Official Releases &amp; 246 Master Tracks</strong>
								<span>Spanning 432Hz acoustic resonance, progressive deep house, outlaw acoustic storytelling, soul, and high-output training instrumentals.</span>
							</div>
						</div>
						<div class="founder-domain-spec-item">
							<span class="spec-icon">🎛️</span>
							<div>
								<strong>96kHz / 24-Bit Phase-Coherent Mastering</strong>
								<span>Precision sub-bass weight, natural harmonic warmth, and zero ear-fatiguing high-frequency harshness during extended work blocks.</span>
							</div>
						</div>
						<div class="founder-domain-spec-item">
							<span class="spec-icon">💿</span>
							<div>
								<strong>100% Direct Principal Master Ownership</strong>
								<span>Full independent catalog ownership available for global DSP streaming, commercial brand sync, and executive media licensing.</span>
							</div>
						</div>
					</div>

					<div class="founder-card-footer">
						<a href="<?php echo esc_url( home_url( '/sonic-universe/' ) ); ?>" class="founder-action-btn ks-p3-btn-blue">
							<span class="ks-wave-text">🎵 Stream the 25-Release Sonic Universe &rarr;</span>
						</a>
					</div>
				</article>

				<!-- DOMAIN 04: PHYSICAL RECOMPOSITION & QUANTITATIVE TREASURY (GOLD) -->
				<article class="founder-domain-card founder-card-gold">
					<div class="founder-card-top-bar">
						<span class="founder-card-pill ks-p3-pill-gold"><span class="ks-wave-text">04 &bull; RECOMPOSITION &amp; CAPITAL</span></span>
						<span class="founder-card-cat founder-cat-gold">-48 LBS &amp; QUANTITATIVE TREASURY</span>
					</div>

					<div class="founder-domain-single-media">
						<img src="<?php echo esc_url( $child_assets . '/wayne_cliff_recomposition.jpg' ); ?>"
						     alt="Wayne Stevenson overlooking the Sea-to-Sky granite cliff precipice in Squamish, BC — -48 lb Physical Recomposition &amp; Quantitative Treasury Discipline"
						     class="founder-domain-img founder-cliff-img"
						     width="800" height="450"
						     loading="lazy" />
					</div>

					<h3 class="founder-domain-title">The -48 lb Recomposition &amp; Quantitative Treasury Discipline</h3>
					<p class="founder-domain-summary">
						Documenting the exact daily biomarker, whole-food nutrition, cold-water immersion, and quantitative capital allocation systems that sustain a 205-lb lean set-point and resilient principal treasury.
					</p>

					<div class="founder-domain-spec-list">
						<div class="founder-domain-spec-item">
							<span class="spec-icon">🥩</span>
							<div>
								<strong>-48 lb Recomposition &amp; 205-lb Lean Set-Point</strong>
								<span>205g daily single-ingredient whole-food protein, progressive heavy compound lifting, and zero crash dieting or synthetic shortcuts.</span>
							</div>
						</div>
						<div class="founder-domain-spec-item">
							<span class="spec-icon">❄️</span>
							<div>
								<strong>Sub-50&deg;F Glacier Cold Plunges &amp; HRV Recovery</strong>
								<span>Morning Sea-to-Sky cold-water immersion, 16:8 metabolic fasting windows, and 90-minute deep-sleep thermal optimization.</span>
							</div>
						</div>
						<div class="founder-domain-spec-item">
							<span class="spec-icon">📊</span>
							<div>
								<strong>Asymmetric Quantitative Treasury Governance</strong>
								<span>Strict EV &ge; +15% mathematical entry gates, quarter-Kelly sizing, and a permanent 40% cash fortress reserve.</span>
							</div>
						</div>
					</div>

					<div class="founder-card-footer">
						<a href="<?php echo esc_url( home_url( '/lifestyle/' ) ); ?>" class="founder-action-btn ks-p3-btn-gold">
							<span class="ks-wave-text">📈 Inspect Lifestyle &amp; Capital Frameworks &rarr;</span>
						</a>
					</div>
				</article>

			</div>
		</section>

		<!-- =====================================================================
		     4. REVAMPED PRIVATE EXECUTIVE ENGAGEMENT PORTAL
		     ===================================================================== -->
		<section id="founder-executive-gateway" class="founder-cta-section">
			<div class="founder-cta-card founder-executive-portal">

				<div class="founder-portal-top-header text-center">
					<div class="founder-section-kicker">PRIVATE EXECUTIVE ENGAGEMENT // DIRECT PRINCIPAL DISPATCH</div>
					<h2 class="cta-title">
						Partner With <span class="cyan-gold-gradient-text">Wayne Stevenson</span>
					</h2>
					<p class="cta-desc">
						Whether commissioning a custom luxury estate or Bill 44 multiplex in British Columbia, deploying our <strong>AI Brain, Multi-Agent Swarms &amp; Custom Tauri Desktop Command Center</strong>, or licensing 432Hz studio masters, all executive inquiries are reviewed directly by our principal desk.
					</p>
				</div>

				<!-- 3 Equal-Height Scope Cards -->
				<div class="founder-portal-scope-grid">
					<div class="founder-scope-item">
						<span class="founder-scope-pill ks-p3-pill-gold"><span class="ks-wave-text">01 // LICENSED BUILDER #52603</span></span>
						<h4>Custom Estates &amp; Bill 44 Multiplexes</h4>
						<p>Architectural custom homes, multi-unit residential infill, and civil contracting across the Sea-to-Sky Corridor and Greater Vancouver.</p>
					</div>
					<div class="founder-scope-item">
						<span class="founder-scope-pill ks-p3-pill-blue"><span class="ks-wave-text">02 // AI PROTOCOLS &amp; TAURI STUDIO</span></span>
						<h4>AI Brain &amp; Custom Desktop Command Centers</h4>
						<p>Turnkey deployment of our $49.50 Blueprint, $199 Multi-Agent Swarms, and $800 Custom Tauri Desktop Command Center with setup support.</p>
					</div>
					<div class="founder-scope-item">
						<span class="founder-scope-pill ks-p3-pill-gold"><span class="ks-wave-text">03 // MUSIC SYNC &amp; CO-INVESTMENT</span></span>
						<h4>432Hz Catalog Sync &amp; Strategic Ventures</h4>
						<p>Direct commercial sync licensing across 246 studio masters and private real-asset or technology co-investment inquiries.</p>
					</div>
				</div>

				<!-- 2-Column Symmetrical Bottom Split: Direct Email Vault + Dual Action Buttons -->
				<div class="founder-portal-bottom-split">
					<div class="direct-email-gateway-box founder-email-vault-box">
						<div class="founder-vault-badge-row">
							<span class="founder-vault-tag ks-p3-pill-blue"><span class="ks-wave-text">DIRECT PRINCIPAL EMAIL VAULT</span></span>
							<span class="founder-vault-nda-badge">🔒 NDA &amp; PRIORITY REVIEW</span>
						</div>
						<a href="mailto:keystonerecomposition@gmail.com?subject=Executive%20Inquiry%20%E2%80%94%20Wayne%20Stevenson%20%28Keystone%20Recomposition%20%2F%20Keystone%20Possibilities%20%2352603%29" class="gateway-email-address founder-email-link">
							keystonerecomposition@gmail.com
						</a>
						<p class="gateway-email-notice founder-email-copy">
							Include your project scope, municipal lot or software architecture requirements, and target timeline for priority 24-hour principal review.
						</p>
					</div>

					<div class="founder-portal-actions-col">
						<div class="founder-actions-card-head">
							<span class="founder-actions-kicker">DIRECT DISPATCH CHANNELS</span>
							<h4>Initiate Principal Consultation</h4>
							<p>Select your preferred channel below to open an encrypted consultation ticket or dispatch a direct executive email:</p>
						</div>
						<div class="cta-button-group founder-portal-btn-stack">
							<a href="<?php echo esc_url( home_url( '/contact/?interest=founder-consultation' ) ); ?>" class="founder-gateway-action-btn ks-p3-btn-gold">
								<span class="ks-wave-text">📅 Schedule Consultation via Contact Page &rarr;</span>
							</a>
							<a href="mailto:keystonerecomposition@gmail.com?subject=Executive%20Inquiry%20%E2%80%94%20Wayne%20Stevenson%20%28Keystone%20Recomposition%20%2F%20Keystone%20Possibilities%20%2352603%29" class="founder-gateway-action-btn ks-p3-btn-blue">
								<span class="ks-wave-text">✉️ Email Wayne Stevenson Directly &rarr;</span>
							</a>
						</div>
					</div>
				</div>

				<div class="cta-fiduciary-note founder-portal-fiduciary-footer">
					🏛️ <strong>Principal Fiduciary Standard:</strong> Keystone Recomposition Ltd. (BC Corp #BC1573685) &bull; Keystone Possibilities Ltd. (BC Corp #BC1408830 &bull; BC Housing Licensed Developer &amp; General Contractor #52603 &bull; 305 Verified CPD Points &bull; WBI #230088) &bull; Direct Founder Review Within 24 Hours
				</div>

			</div>
		</section>

	</div>
</main>

<?php
get_footer();
