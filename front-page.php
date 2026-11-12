<?php
/**
 * Keystone Recomposition — Sovereign v4.0 Flagship Homepage
 *
 * 8-Section Quiet-Luxury & Sovereign Tech Architecture mirroring Keystone Possibilities v3.0
 * in Keystone Recomposition's native Obsidian, Cyan (#38bdf8 / #00ced1), and Sovereign Gold (#d4af37 / #f6d365) palette.
 *
 * @package KeystoneRecompositionChild
 * @version 4.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$kr_theme_uri    = trailingslashit( get_stylesheet_directory_uri() );
$kr_wayne_avatar = $kr_theme_uri . 'assets/images/wayne_avatar.jpg';

$kr_domain_pillars = array(
	array(
		'badge' => 'PILLAR 01 · AI PROTOCOLS',
		'title' => '3-Tier Sovereign AI Vault',
		'desc'  => 'Deploy the $49.50 AI Brain & Flow Blueprint, $199 6-Agent Role Suite + Multi-Agent Web Architecture, or $800 Runnable Rust + Tauri v2 Desktop Command Center Source + 1-Command .EXE Compiler.',
		'cta'   => 'Open Protocol Vault',
		'url'   => home_url( '/ai-protocols/' ),
		'gold'  => true,
	),
	array(
		'badge' => 'PILLAR 02 · SONIC UNIVERSE',
		'title' => '25 Releases · 246 ISRC Masters',
		'desc'  => '24-bit studio catalog tuned across 432Hz, 528Hz, deep melodic house, and architectural focus instrumentals.',
		'cta'   => 'Enter Sonic Universe',
		'url'   => home_url( '/sonic-universe/' ),
		'gold'  => false,
	),
	array(
		'badge' => 'PILLAR 03 · TECHNICAL INTEL',
		'title' => '4K Engineering Briefings',
		'desc'  => 'Primary-source teardowns on Chrome Port 9222 automation, hybrid vector memory, and multi-agent verification.',
		'cta'   => 'Read Intel Hub',
		'url'   => home_url( '/intel/' ),
		'gold'  => false,
	),
	array(
		'badge' => 'PILLAR 04 · QUANT SYSTEMS',
		'title' => 'Capital & Microstructure Lab',
		'desc'  => 'Deterministic spread/fee gating, asymmetric maker execution math, and strict capital-fortress risk governance.',
		'cta'   => 'Inspect Quant Hub',
		'url'   => home_url( '/investments/' ),
		'gold'  => false,
	),
	array(
		'badge' => 'PILLAR 05 · BUILDER PERFORMANCE',
		'title' => 'Sovereign Builder Lifestyle',
		'desc'  => 'Evidence-backed physical training, clean nutrition, acoustic recovery, and daily operational discipline for high-output builders.',
		'cta'   => 'Explore Lifestyle Hub',
		'url'   => home_url( '/lifestyle/' ),
		'gold'  => false,
	),
	array(
		'badge' => 'PILLAR 06 · PARTNER NETWORK',
		'title' => 'Ecosystem & Sync Partners',
		'desc'  => 'Direct one-stop sync licensing, verified engineering alliances, and cross-empire collaboration channels.',
		'cta'   => 'View Ecosystem Desk',
		'url'   => home_url( '/ecosystem-partners/' ),
		'gold'  => true,
	),
);

$staged_drops = array(
	array(
		'tag'   => 'AI ARCHITECTURE · 4K BRIEFING',
		'title' => 'Chrome DevTools Protocol Port 9222: Zero-Wrapper Multi-Agent Browser Execution',
		'desc'  => 'Why direct JSON-RPC session attachment outperforms brittle cloud browser wrappers for live DOM verification and publishing.',
		'img'   => 'https://i.ytimg.com/vi/BuGR4MsghGs/hqdefault.jpg',
		'url'   => home_url( '/intel/' ),
		'date'  => 'VERIFIED BRIEFING',
	),
	array(
		'tag'   => '4K OFFICIAL FILM · SONIC VAULT',
		'title' => 'Diesel in the Rain — 4K Cinema Production & 24-Bit Acoustic Mastering',
		'desc'  => 'Inside our Sea-to-Sky visual pipeline, 2-track DaVinci timeline assembly, and 100% one-stop sync-ready mastering.',
		'img'   => 'https://i.ytimg.com/vi/nyQwl-7-vH0/hqdefault.jpg',
		'url'   => home_url( '/sonic-universe/#whiskey-on-a-wednesday' ),
		'date'  => 'OFFICIAL PREMIERE',
	),
	array(
		'tag'   => 'WORKSTATION ENGINEERING · TAURI',
		'title' => '3-Tier Sovereign AI Suite: From 4-Folder Brain to Runnable Rust + Tauri v2 Desktop .EXE',
		'desc'  => 'How our 6-Agent Role Suite + Multi-Agent Architecture, local voice telemetry, and 1-command Windows .EXE compiler unite inside one desktop command center.',
		'img'   => 'https://i.ytimg.com/vi/u1gUjk9xcB4/hqdefault.jpg',
		'url'   => home_url( '/ai-protocols/' ),
		'date'  => 'SYSTEMS TEARDOWN',
	),
);
?>

<div id="primary" class="content-area primary keystone-cyber-home kr-v4-main">
	<main id="main" class="site-main">

		<!-- SECTION 1: Split Founder Hero + Interactive Sovereign Quick-Selector + Wayne Portrait Card -->
		<section id="hero" class="kr-fp-hero" aria-label="Keystone Recomposition Sovereign v4.0 Hero">
			<div class="kr-v4-container">
				<div class="kr-fp-hero-grid">
					<div>
						<span class="kr-v4-kicker">
							<span class="kr-v4-kicker-dot"></span>
							// 2026 SOVEREIGN AI SUITE &middot; 25 MASTER RELEASES &middot; SQUAMISH &amp; WHISTLER, BC
						</span>

						<h1 class="kr-fp-h1">Where Autonomous Machine Intelligence Meets Real-World Building &amp; Sound</h1>

						<blockquote class="kr-fp-quote" style="opacity: 1; transform: none;">
							&ldquo;Whether we are supervising critical-path civil infrastructure in coastal British Columbia, mastering 24-bit 432Hz studio records, or orchestrating multi-agent AI workstations—every system we ship is built for permanent ownership, zero SaaS bloat, and measurable execution.&rdquo;
							<cite>Wayne Stevenson &mdash; AI Systems Architect, Producer &amp; Licensed Builder #52603</cite>
						</blockquote>

						<div class="kr-fp-quick-card" aria-label="Interactive Sovereign Route and Protocol Quick-Intake">
							<label for="krHeroObjectiveSelect" class="kr-fp-quick-label">
								// SELECT YOUR OBJECTIVE OR PROTOCOL TIER
							</label>
							<div class="kr-fp-quick-form">
								<select id="krHeroObjectiveSelect" class="kr-fp-select">
									<option value="tier-1">Tier 1: $49.50 AI Brain &amp; Google Flow Blueprint</option>
									<option value="tier-2" selected>Tier 2: $199 6-Agent Role Suite + Website Architecture</option>
									<option value="tier-3">Tier 3: $800 Runnable Rust + Tauri v2 Source (.EXE)</option>
									<option value="sync-licensing">24-Bit WAV One-Stop Sync Licensing</option>
									<option value="enterprise-consult">Enterprise AI &amp; Custom Build Consultation</option>
								</select>
								<button type="button" id="krHeroObjectiveBtn" class="kr-btn-gold">
									Launch Route &rarr;
								</button>
							</div>

							<div class="kr-fp-chips" aria-label="Direct Scenario Shortcuts">
								<a href="<?php echo esc_url( home_url( '/ai-protocols/#kr-tier-1' ) ); ?>" class="kr-fp-chip">$49.50 Blueprint</a>
								<a href="<?php echo esc_url( home_url( '/ai-protocols/#kr-tier-2' ) ); ?>" class="kr-fp-chip">$199 6-Agent + Web Suite</a>
								<a href="<?php echo esc_url( home_url( '/ai-protocols/#kr-tier-3' ) ); ?>" class="kr-fp-chip">$800 Tauri v2 .EXE Source</a>
								<a href="#sonic-vault" class="kr-fp-chip">60fps Sound Lab (25 Releases)</a>
								<button type="button" class="kr-fp-chip" data-kr-preset-consult="24-Bit WAV One-Stop Sync Licensing">One-Stop Sync Desk</button>
							</div>
						</div>
					</div>

					<div>
						<div class="kr-fp-portrait-card" style="opacity: 1; transform: none;">
							<img
								src="<?php echo esc_url( $kr_wayne_avatar ); ?>"
								alt="Wayne Stevenson — Founder of Keystone Recomposition &amp; Licensed BC Builder #52603"
								width="720"
								height="846"
								loading="eager"
								fetchpriority="high"
								decoding="async"
								style="opacity: 1;"
							/>
							<div class="kr-fp-floating-badge">
								<p class="kr-fp-badge-title">Wayne Stevenson &middot; Sovereign Triad Verification</p>
								<div class="kr-fp-triad-pills">
									<span class="kr-fp-triad-pill">25 Releases / 246 Tracks</span>
									<span class="kr-fp-triad-pill">6-Agent Multi-Agent Suite</span>
									<span class="kr-fp-triad-pill kr-fp-triad-pill--gold">BC Builder #52603</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- SECTION 2: 4K Dual-Channel Watch Briefing & Music Video Theater -->
		<?php get_template_part( 'template-parts/kr-watch-theater' ); ?>

		<!-- SECTION 3: Live 60fps Bio-Acoustic Sound Lab + Interactive 25-Release Discography Cinema Reel -->
		<?php get_template_part( 'template-parts/kr-discography-reel' ); ?>

		<!-- SECTION 4: Sovereign AI Architecture & 3-Tier Protocol Vault Reel -->
		<?php get_template_part( 'template-parts/kr-architecture-reel' ); ?>

		<!-- SECTION 5: 6-Pillar Sovereign Domain Matrix Grid + Sister-Empire Bridge -->
		<section id="domain-matrix" class="kr-v4-section kr-v4-section--obsidian" aria-label="6-Pillar Sovereign Domain Matrix">
			<div class="kr-v4-container">
				<div class="kr-v4-section-head">
					<div>
						<span class="kr-v4-kicker"><span class="kr-v4-kicker-dot"></span> SIX-PILLAR COMMAND ARCHITECTURE</span>
						<h2 class="kr-v4-h2">Navigate the Full Keystone Sovereign Ecosystem</h2>
						<p class="kr-v4-lead">Every hub is engineered with primary-source verification, clean dark-luxury readability, and direct execution paths.</p>
					</div>
				</div>

				<div class="kr-matrix-grid">
					<?php foreach ( $kr_domain_pillars as $pillar ) : ?>
						<a href="<?php echo esc_url( $pillar['url'] ); ?>" class="kr-matrix-card">
							<span class="kr-v4-kicker <?php echo ! empty( $pillar['gold'] ) ? 'kr-v4-kicker--gold' : ''; ?>" style="align-self:flex-start;font-size:0.67rem;">
								<?php echo esc_html( $pillar['badge'] ); ?>
							</span>
							<h3 class="kr-card-title" style="font-size:1.16rem;margin-top:4px;"><?php echo esc_html( $pillar['title'] ); ?></h3>
							<p class="kr-card-sub" style="flex:1;"><?php echo esc_html( $pillar['desc'] ); ?></p>
							<span style="font-family:'JetBrains Mono',monospace;font-size:0.74rem;font-weight:700;color:<?php echo ! empty( $pillar['gold'] ) ? '#f6d365' : '#38bdf8'; ?>;">
								<?php echo esc_html( $pillar['cta'] ); ?> &rarr;
							</span>
						</a>
					<?php endforeach; ?>
				</div>

				<div class="kr-sister-banner">
					<div>
						<span class="kr-v4-kicker kr-v4-kicker--gold" style="margin-bottom:8px;">SISTER PHYSICAL ENGINEERING DIVISION &middot; BC HOUSING DEVELOPER &amp; GENERAL CONTRACTOR #52603 &middot; 305 CPD POINTS</span>
						<h3 class="kr-card-title" style="font-size:1.22rem;">Keystone Possibilities Ltd. (BC Corp #BC1408830) &mdash; Custom Residences, Bill 44 Multiplexes &amp; BC Hydro ES54 Civil</h3>
						<p class="kr-card-sub" style="margin-top:4px;max-width:780px;">Explore our sister construction division (BC Housing Licensed Developer &amp; General Contractor #52603 &middot; 305 Verified CPD Points &middot; WBI Home Warranty #230088) delivering architectural homes and underground civil infrastructure across Squamish, Whistler, West Vancouver, and the Lower Mainland.</p>
					</div>
					<a href="https://keystonepossibilities.ca/" target="_blank" rel="noopener noreferrer" class="kr-btn-gold">
						Visit KeystonePossibilities.ca &nearr;
					</a>
				</div>
			</div>
		</section>

		<!-- SECTION 6: One-Stop Sync Licensing, Press & Ecosystem Partner Desk Card -->
		<section id="sync-partner-desk" class="kr-v4-section kr-v4-section--black" aria-label="One-Stop Sync Licensing and Ecosystem Partner Desk">
			<div class="kr-v4-container">
				<div class="kr-sync-card">
					<div>
						<span class="kr-v4-kicker kr-v4-kicker--gold"><span class="kr-v4-kicker-dot"></span> 100% ONE-STOP MASTER + PUBLISHING &middot; CREATOR &amp; SUPERVISOR DESK</span>
						<h2 class="kr-v4-h2">24-Bit WAV Sync Clearance &amp; Strategic Partner Desk</h2>
						<p class="kr-v4-lead">Direct clearance with zero third-party label splits or publishing bottlenecks across all 25 official releases and 246 ISRC-registered studio tracks.</p>

						<ul class="kr-sync-checklist">
							<li><strong style="color:#38bdf8;">&#10003;</strong> <span><strong>100% One-Stop Control:</strong> Instant Master + Publishing sign-off for film, television, trailers, games, and luxury brand campaigns.</span></li>
							<li><strong style="color:#d4af37;">&#10003;</strong> <span><strong>24-Bit / 96kHz Delivery:</strong> Full WAV masters, instrumental beds, and loopable 432Hz/122 BPM stems ready for broadcast assembly.</span></li>
							<li><strong style="color:#38bdf8;">&#10003;</strong> <span><strong>AI Creator &amp; Partner Alliances:</strong> Co-engineered workflows, technical cross-features, and verified partner listings.</span></li>
						</ul>

						<div style="display:flex;flex-wrap:wrap;gap:12px;">
							<button type="button" class="kr-btn-gold" data-kr-preset-consult="24-Bit WAV One-Stop Sync Licensing">
								Request One-Stop Sync Stems &rarr;
							</button>
							<a href="<?php echo esc_url( home_url( '/ecosystem-partners/' ) ); ?>" class="kr-btn-cyan">
								Open Ecosystem Partner Desk &rarr;
							</a>
						</div>
					</div>

					<div class="kr-sync-console">
						<div style="font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:700;color:#38bdf8;letter-spacing:0.06em;">
							// FAST-TRACK CLEARANCE &amp; PARTNER ROUTER
						</div>
						<p class="kr-card-sub">Select your brief type below to pre-load the executive desk with your exact clearance or engineering scope:</p>
						<label for="krSyncScopeSelect" style="font-family:'JetBrains Mono',monospace;font-size:0.69rem;color:#cbd5e1;">SELECT BRIEF CLASSIFICATION</label>
						<select id="krSyncScopeSelect" class="kr-fp-select">
							<option value="24-Bit WAV One-Stop Sync Licensing — Film / TV / Trailer">Sync Brief: Film, TV, or Documentary Placement</option>
							<option value="24-Bit WAV One-Stop Sync Licensing — Commercial / Game">Sync Brief: Brand Campaign or Interactive Game</option>
							<option value="AI Creator &amp; Sovereign Workstation Collaboration">AI Creator: Multi-Agent Workflow Collaboration</option>
							<option value="Ecosystem Partner &amp; Press Feature">Ecosystem Partner / Technical Press Inquiry</option>
						</select>
						<button type="button" id="krSyncRouteBtn" class="kr-btn-cyan" style="width:100%;">
							Pre-Fill Consultation Desk Below &darr;
						</button>
						<div style="font-family:'JetBrains Mono',monospace;font-size:0.7rem;color:#94a3b8;padding-top:4px;">
							Direct Desk: <a href="mailto:keystonerecomposition@gmail.com" style="color:#f6d365;text-decoration:none;">keystonerecomposition@gmail.com</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- SECTION 7: Latest Technical Intel & 4K Briefings Row -->
		<section id="latest-intel" class="kr-v4-section kr-v4-section--obsidian" aria-label="Latest Technical Intel and 4K Briefings">
			<div class="kr-v4-container">
				<div class="kr-v4-section-head">
					<div>
						<span class="kr-v4-kicker"><span class="kr-v4-kicker-dot"></span> LIVE DISPATCHES &amp; ARCHITECTURAL TEARDOWNS</span>
						<h2 class="kr-v4-h2">Latest Technical Intel &amp; 4K Briefings</h2>
						<p class="kr-v4-lead">Recent engineering dispatches, autonomous workflow benchmarks, and studio release notes.</p>
					</div>
					<div>
						<a href="<?php echo esc_url( home_url( '/intel/' ) ); ?>" class="kr-btn-cyan">View All Intel Briefings &rarr;</a>
					</div>
				</div>

				<div class="kr-intel-grid">
					<?php
					$kr_intel_q = new WP_Query(
						array(
							'post_type'           => 'post',
							'post_status'         => 'publish',
							'posts_per_page'      => 3,
							'ignore_sticky_posts' => true,
							'no_found_rows'       => true,
						)
					);

					if ( $kr_intel_q->have_posts() ) :
						$i_idx = 0;
						while ( $kr_intel_q->have_posts() ) :
							$kr_intel_q->the_post();
							$thumb = get_the_post_thumbnail_url( get_the_ID(), 'large' );
							if ( empty( $thumb ) ) {
								$thumb = $staged_drops[ $i_idx % count( $staged_drops ) ]['img'];
							}
							$cats     = get_the_category();
							$cat_name = ! empty( $cats ) ? strtoupper( $cats[0]->name ) : 'TECHNICAL INTEL';
							$i_idx++;
							?>
							<a href="<?php the_permalink(); ?>" class="kr-intel-card">
								<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="kr-intel-thumb" loading="lazy" decoding="async" />
								<div class="kr-intel-body">
									<div class="kr-card-tag-row">
										<span><?php echo esc_html( $cat_name ); ?></span>
										<span style="color:#38bdf8;"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
									</div>
									<h3 class="kr-card-title"><?php the_title(); ?></h3>
									<p class="kr-card-sub" style="flex:1;"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), 21, '...' ) ); ?></p>
									<span style="font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:700;color:#38bdf8;">Read Full Briefing &rarr;</span>
								</div>
							</a>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						foreach ( $staged_drops as $drop ) :
							?>
							<a href="<?php echo esc_url( $drop['url'] ); ?>" class="kr-intel-card">
								<img src="<?php echo esc_url( $drop['img'] ); ?>" alt="<?php echo esc_attr( $drop['title'] ); ?>" class="kr-intel-thumb" loading="lazy" decoding="async" />
								<div class="kr-intel-body">
									<div class="kr-card-tag-row">
										<span><?php echo esc_html( $drop['tag'] ); ?></span>
										<span style="color:#38bdf8;"><?php echo esc_html( $drop['date'] ); ?></span>
									</div>
									<h3 class="kr-card-title"><?php echo esc_html( $drop['title'] ); ?></h3>
									<p class="kr-card-sub" style="flex:1;"><?php echo esc_html( $drop['desc'] ); ?></p>
									<span style="font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:700;color:#38bdf8;">Explore Briefing &rarr;</span>
								</div>
							</a>
							<?php
						endforeach;
					endif;
					?>
				</div>
			</div>
		</section>

		<!-- SECTION 8: Visible Executive FAQ Accordion + Direct Consultation Desk -->
		<section id="consultation-desk" class="kr-v4-section kr-v4-section--black" aria-label="Executive FAQ and Direct Consultation Desk">
			<div class="kr-v4-container">
				<div class="kr-faq-consult-grid">
					<?php get_template_part( 'template-parts/kr-faq-accordion' ); ?>

					<div class="kr-consult-card">
						<span class="kr-v4-kicker kr-v4-kicker--gold"><span class="kr-v4-kicker-dot"></span> DIRECT EXECUTIVE CONSULTATION &amp; LICENSING DESK</span>
						<h2 class="kr-v4-h2" style="font-size:clamp(1.45rem,2.5vw,2rem);margin-bottom:8px;">Start a Protocol Deployment or Sync Brief</h2>
						<p class="kr-card-sub" style="margin-bottom:18px;">Routed directly to Wayne Stevenson&rsquo;s desk in Squamish, BC (<a href="mailto:keystonerecomposition@gmail.com" style="color:#38bdf8;text-decoration:none;">keystonerecomposition@gmail.com</a>).</p>

						<form class="luxury-inquiry-form kr-consult-form" data-keystone-lead-form="consultation" action="<?php echo esc_url( rest_url( 'keystone/v1/lead-consultation' ) ); ?>" method="post" novalidate>
							<div class="kr-form-grid-2">
								<div class="kr-field">
									<label for="krConsultName">Your Name *</label>
									<input type="text" id="krConsultName" name="contact_name" required placeholder="Alex Mercer" autocomplete="name" />
								</div>
								<div class="kr-field">
									<label for="krConsultEmail">Direct Email *</label>
									<input type="email" id="krConsultEmail" name="contact_email" required placeholder="alex@company.com" autocomplete="email" />
								</div>
							</div>

							<div class="kr-form-grid-2">
								<div class="kr-field">
									<label for="krConsultCategory">Objective / Tier</label>
									<select id="krConsultCategory" name="contact_category">
										<option value="Tier 3: $800 Runnable Rust + Tauri v2 Desktop Source (.EXE)">Tier 3: $800 Runnable Rust + Tauri v2 Desktop Source (.EXE)</option>
										<option value="Tier 2: $199 6-Agent Role Suite + Multi-Agent Web Architecture">Tier 2: $199 6-Agent Role Suite + Multi-Agent Web Architecture</option>
										<option value="Tier 1: $49.50 AI Brain &amp; Google Flow Blueprint">Tier 1: $49.50 AI Brain &amp; Google Flow Blueprint</option>
										<option value="24-Bit WAV One-Stop Sync Licensing">24-Bit WAV One-Stop Sync Licensing</option>
										<option value="Enterprise AI &amp; Custom Build Consultation">Enterprise AI &amp; Custom Build Consultation</option>
									</select>
								</div>
								<div class="kr-field">
									<label for="krConsultBudget">Estimated Scope</label>
									<select id="krConsultBudget" name="contact_budget">
										<option value="$49.50 – $199 Protocol Pack">$49.50 &ndash; $199 Protocol Pack</option>
										<option value="$800 Sovereign Workstation" selected>$800 Sovereign Workstation</option>
										<option value="$1,500 – $5,000 Custom AI / Sync License">$1,500 &ndash; $5,000 Custom AI / Sync License</option>
										<option value="$5,000+ Enterprise Architecture">$5,000+ Enterprise Architecture</option>
									</select>
								</div>
							</div>

							<div class="kr-field">
								<label for="krConsultMessage">Project, Workstation, or Sync Brief *</label>
								<textarea id="krConsultMessage" name="contact_message" rows="4" required placeholder="Share your target workflow, operating environment, or sync licensing timeline..."></textarea>
							</div>

							<label style="display:flex;align-items:flex-start;gap:9px;font-size:0.79rem;color:#94a3b8;margin-bottom:14px;cursor:pointer;">
								<input type="checkbox" name="consent_agreed" value="1" checked style="margin-top:3px;" />
								<span>I agree to receive a direct response regarding my protocol deployment, sync clearance, or engineering inquiry.</span>
							</label>

							<button type="submit" class="kr-btn-gold" style="width:100%;">
								Transmit Brief to Sovereign Desk &rarr;
							</button>
							<div class="lead-form-feedback" aria-live="polite" style="display:none;margin-top:12px;"></div>
						</form>
					</div>
				</div>
			</div>
		</section>

	</main>
</div>

<script>
(function() {
	'use strict';

	var themeAudioBase = <?php echo wp_json_encode( $kr_theme_uri . 'assets/audio/' ); ?>;
	var protocolTierUrls = {
		'tier-1': <?php echo wp_json_encode( home_url( '/ai-protocols/#kr-tier-1' ) ); ?>,
		'tier-2': <?php echo wp_json_encode( home_url( '/ai-protocols/#kr-tier-2' ) ); ?>,
		'tier-3': <?php echo wp_json_encode( home_url( '/ai-protocols/#kr-tier-3' ) ); ?>
	};

	var masterTracks = [
		{ title: 'Steady Incline', sub: '432Hz Architectural Deep House · 122 BPM', file: 'track1_steady_incline.mp3' },
		{ title: 'Fluid Dynamics', sub: '528Hz Harmonic Flow & Sub-Bass · 122 BPM', file: 'track2_fluid_dynamics.mp3' },
		{ title: 'Tier One Flow', sub: 'Sovereign Builder Focus Engine · 124 BPM', file: 'track3_tier_one_flow.mp3' },
		{ title: 'The Midday Push', sub: 'Organic Cello & Deep Bass · 120 BPM', file: 'track4_the_midday_push.mp3' },
		{ title: 'Kinetic Peace', sub: 'Melodic Downtempo · 115 BPM', file: 'track5_kinetic_peace.mp3' },
		{ title: 'The Long Game', sub: 'Late-Night Sea-to-Sky Horizon · 120 BPM', file: 'track6_the_long_game.mp3' }
	];

	var currentTrackIdx = 0;
	var graphMode = 'spectrum';
	var audioCtx = null;
	var analyser = null;
	var dataArray = null;
	var sourceConnected = false;

	var audioEl = document.getElementById('cyberAudio');
	var canvas = document.getElementById('cyberVisualizer');
	var playBtn = document.getElementById('cyberPlayBtn');
	var playIcon = document.getElementById('playIcon');
	var playLabel = document.getElementById('playLabel');
	var titleEl = document.getElementById('currentTrackTitle');
	var stateEl = document.getElementById('engineStateBadge');
	var hzBadge = document.getElementById('cyberGraphHzBadge');
	var topFreqBadge = document.getElementById('soundLabTopFreqBadge');

	function ensureAudioGraph() {
		if (!audioEl || sourceConnected) return;
		var AudioContextCtor = window.AudioContext || window.webkitAudioContext;
		if (!AudioContextCtor) return;
		try {
			audioCtx = new AudioContextCtor();
			analyser = audioCtx.createAnalyser();
			analyser.fftSize = 128;
			var src = audioCtx.createMediaElementSource(audioEl);
			src.connect(analyser);
			analyser.connect(audioCtx.destination);
			dataArray = new Uint8Array(analyser.frequencyBinCount);
			sourceConnected = true;
		} catch (_e) {}
	}

	function syncPlayUI(playing) {
		if (playIcon) playIcon.innerHTML = playing ? '&#10074;&#10074;' : '&#9654;';
		if (playLabel) playLabel.textContent = playing ? 'PAUSE MASTER' : 'PLAY MASTER';
		if (stateEl) {
			stateEl.textContent = playing
				? ('LIVE 60FPS STREAM · ' + masterTracks[currentTrackIdx].sub.toUpperCase())
				: 'PAUSED · READY FOR PLAYBACK';
		}
		var rows = document.querySelectorAll('.playlist-track-row');
		Array.prototype.forEach.call(rows, function(r, idx) {
			r.classList.toggle('active-track', idx === currentTrackIdx);
		});
	}

	window.switchTrack = function(title, sub, index) {
		if (!audioEl) return;
		var idx = (typeof index === 'number' && masterTracks[index]) ? index : 0;
		currentTrackIdx = idx;
		var trk = masterTracks[idx];
		audioEl.src = themeAudioBase + trk.file;
		if (titleEl) {
			titleEl.textContent = ('0' + (idx + 1)).slice(-2) + ' \u2022 ' + (title || trk.title);
		}
		ensureAudioGraph();
		if (audioCtx && audioCtx.state === 'suspended') {
			audioCtx.resume().catch(function() {});
		}
		audioEl.play().then(function() {
			syncPlayUI(true);
		}).catch(function() {
			syncPlayUI(false);
		});
	};

	window.loadAndPlayAlbum = function(albumTitle, genreLabel) {
		var hash = 0;
		var str = String(albumTitle || '');
		for (var i = 0; i < str.length; i++) {
			hash = (hash + str.charCodeAt(i)) % masterTracks.length;
		}
		window.switchTrack(albumTitle, genreLabel || '24-Bit Album Audition', hash);
		var lab = document.getElementById('sound-lab');
		if (lab) lab.scrollIntoView({ behavior: 'smooth', block: 'center' });
	};

	window.rotateNextKeystoneTrack = function() {
		var next = (currentTrackIdx + 1) % masterTracks.length;
		window.switchTrack(masterTracks[next].title, masterTracks[next].sub, next);
	};

	window.setKeystoneGraphMode = function(mode, btn) {
		graphMode = mode || 'spectrum';
		Array.prototype.forEach.call(document.querySelectorAll('.graph-mode-btn'), function(b) {
			b.classList.toggle('active', b === btn);
		});
		if (hzBadge) {
			hzBadge.textContent = graphMode === 'lattice'
				? 'HARMONIC LATTICE · 60FPS'
				: (graphMode === 'scope' ? 'PHASE OSCILLOSCOPE · 60FPS' : 'FFT SPECTRUM · 60FPS');
		}
	};

	window.setKeystoneFreqBand = function(band, btn) {
		Array.prototype.forEach.call(document.querySelectorAll('.freq-tune-pill'), function(b) {
			b.classList.toggle('active', b === btn);
		});
		if (topFreqBadge) {
			topFreqBadge.textContent = band === '528'
				? '528HZ CLARITY HARMONIC LOCK'
				: (band === '122' ? '122 BPM ARCHITECTURAL HOUSE LOCK' : '432HZ + 528HZ HARMONIC ENGINE');
		}
	};

	window.selectKeystoneAiCore = function(coreKey) {
		if (protocolTierUrls[coreKey]) {
			window.location.href = protocolTierUrls[coreKey];
		}
	};

	if (playBtn && audioEl) {
		playBtn.addEventListener('click', function() {
			if (!audioEl.src) {
				window.switchTrack(masterTracks[0].title, masterTracks[0].sub, 0);
				return;
			}
			ensureAudioGraph();
			if (audioCtx && audioCtx.state === 'suspended') {
				audioCtx.resume().catch(function() {});
			}
			if (audioEl.paused) {
				audioEl.play().then(function() { syncPlayUI(true); }).catch(function() {});
			} else {
				audioEl.pause();
				syncPlayUI(false);
			}
		});
		audioEl.addEventListener('ended', function() {
			window.rotateNextKeystoneTrack();
		});
	}

	// 60fps Hi-DPI Visualizer Loop (Cyan #38bdf8 + Gold #d4af37)
	if (canvas && canvas.getContext) {
		var ctx = canvas.getContext('2d');
		var tick = 0;
		function renderVisualizer() {
			tick += 0.035;
			var dpr = Math.min(window.devicePixelRatio || 1, 2);
			var w = canvas.clientWidth || 720;
			var h = canvas.clientHeight || 220;
			if (canvas.width !== Math.round(w * dpr) || canvas.height !== Math.round(h * dpr)) {
				canvas.width = Math.round(w * dpr);
				canvas.height = Math.round(h * dpr);
			}
			ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
			ctx.clearRect(0, 0, w, h);

			var bars = 48;
			var activeAudio = audioEl && !audioEl.paused && analyser && dataArray;
			if (activeAudio) {
				analyser.getByteFrequencyData(dataArray);
			}

			if (graphMode === 'scope') {
				ctx.beginPath();
				ctx.lineWidth = 2.2;
				ctx.strokeStyle = '#38bdf8';
				for (var s = 0; s < bars; s++) {
					var normS = activeAudio ? (dataArray[s] / 255) : (0.22 + 0.14 * Math.sin(tick * 2 + s * 0.28));
					var xS = (s / (bars - 1)) * w;
					var yS = h * 0.5 + (normS - 0.35) * h * 0.65 * Math.cos(s * 0.22 + tick);
					if (s === 0) ctx.moveTo(xS, yS);
					else ctx.lineTo(xS, yS);
				}
				ctx.stroke();
			} else {
				var gap = 4;
				var barW = Math.max(3, (w - gap * bars) / bars);
				for (var i = 0; i < bars; i++) {
					var val = activeAudio
						? (dataArray[i] / 255)
						: (0.14 + 0.11 * Math.sin(tick + i * 0.24) + 0.06 * Math.cos(tick * 1.7 - i * 0.15));
					var barH = Math.max(8, val * (h - 28));
					var x = i * (barW + gap) + 4;
					var y = h - barH - 8;
					var grad = ctx.createLinearGradient(0, y, 0, h);
					if (graphMode === 'lattice' && i % 3 === 0) {
						grad.addColorStop(0, '#f6d365');
						grad.addColorStop(1, 'rgba(212, 175, 55, 0.18)');
					} else {
						grad.addColorStop(0, '#38bdf8');
						grad.addColorStop(0.65, '#00ced1');
						grad.addColorStop(1, 'rgba(56, 189, 248, 0.12)');
					}
					ctx.fillStyle = grad;
					ctx.fillRect(x, y, barW, barH);
				}
			}
			window.requestAnimationFrame(renderVisualizer);
		}
		window.requestAnimationFrame(renderVisualizer);
	}

	// Hero Quick-Intake & Sync Desk Smooth Routing
	function routeToConsultWithCategory(catLabel, msgPrefix) {
		var desk = document.getElementById('consultation-desk');
		var catSel = document.getElementById('krConsultCategory');
		var msgBox = document.getElementById('krConsultMessage');
		if (catSel && catLabel) {
			for (var i = 0; i < catSel.options.length; i++) {
				if (catSel.options[i].value.indexOf(catLabel.slice(0, 14)) !== -1) {
					catSel.selectedIndex = i;
					break;
				}
			}
		}
		if (msgBox && msgPrefix && !msgBox.value) {
			msgBox.value = 'Inquiry regarding: ' + msgPrefix + ' — ';
		}
		if (desk) {
			desk.scrollIntoView({ behavior: 'smooth', block: 'start' });
		}
	}

	var heroBtn = document.getElementById('krHeroObjectiveBtn');
	var heroSel = document.getElementById('krHeroObjectiveSelect');
	if (heroBtn && heroSel) {
		heroBtn.addEventListener('click', function() {
			var v = heroSel.value;
			if (protocolTierUrls[v]) {
				window.location.href = protocolTierUrls[v];
			} else if (v === 'sync-licensing') {
				routeToConsultWithCategory('24-Bit WAV One-Stop Sync Licensing', '24-Bit WAV One-Stop Sync Licensing');
			} else {
				routeToConsultWithCategory('Enterprise AI & Custom Build Consultation', 'Enterprise AI & Custom Build Consultation');
			}
		});
	}

	Array.prototype.forEach.call(document.querySelectorAll('[data-kr-preset-consult]'), function(btn) {
		btn.addEventListener('click', function() {
			var preset = btn.getAttribute('data-kr-preset-consult') || '';
			routeToConsultWithCategory(preset, preset);
		});
	});

	var syncBtn = document.getElementById('krSyncRouteBtn');
	var syncSel = document.getElementById('krSyncScopeSelect');
	if (syncBtn && syncSel) {
		syncBtn.addEventListener('click', function() {
			routeToConsultWithCategory('24-Bit WAV One-Stop Sync Licensing', syncSel.value);
		});
	}
})();
</script>

<?php
get_footer();
