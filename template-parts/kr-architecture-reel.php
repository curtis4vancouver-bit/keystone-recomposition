<?php
/**
 * Keystone Recomposition v4.0 — Section 4: Sovereign AI Architecture & 3-Tier Protocol Vault Reel
 *
 * Mirrors Keystone Possibilities' credential-vault.php museum reel: filterable horizontal cards
 * showcasing the 3 live AI Protocol Tiers ($49.50, $199, $800) and Core Sovereign Systems.
 * Strictly obeys Museum-Model IP Air-Gap (zero internal daemon filenames or prompt leaks)
 * and Sovereign Brand Safety standards.
 *
 * @package KeystoneRecompositionChild
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$kr_theme_uri = trailingslashit( get_stylesheet_directory_uri() );
$kr_arch_uid  = wp_unique_id( 'kr-arch-' );

$kr_arch_items = array(
	array(
		'cat'        => 'protocol-tiers',
		'cat_label'  => 'TIER 01 · $49.50 USD',
		'badge'      => 'INSTANT BLUEPRINT',
		'title'      => 'AI Video & Sovereign Brain Blueprint Pack',
		'summary'    => 'Complete multi-folder memory architecture, 6-part master script engineering framework, and automated 4K video production workflow.',
		'spec'       => 'Zero SaaS Lock-In · Lifetime Local Ownership',
		'image'      => $kr_theme_uri . 'assets/images/ai_protocols_banner.png',
		'cta_label'  => 'Inspect Tier 1 ($49.50)',
		'cta_url'    => home_url( '/ai-protocols/#kr-tier-1' ),
		'external'   => false,
	),
	array(
		'cat'        => 'protocol-tiers',
		'cat_label'  => 'TIER 02 · $199 USD',
		'badge'      => 'MOST DEPLOYED',
		'title'      => '28-Agent FastMCP & Dark-Luxury Web Suite',
		'summary'    => 'Parallel multi-agent specialist orchestration, adversarial source verification gates, Rank Math 100/100 schema architecture, and luxury UI tokens.',
		'spec'       => '28 Specialized Agents · Full Web + SEO Engine',
		'image'      => $kr_theme_uri . 'assets/images/wayne_ai_protocols_boardroom.jpg',
		'cta_label'  => 'Inspect Tier 2 ($199)',
		'cta_url'    => home_url( '/ai-protocols/#kr-tier-2' ),
		'external'   => false,
	),
	array(
		'cat'        => 'protocol-tiers',
		'cat_label'  => 'TIER 03 · $800 USD',
		'badge'      => 'FLAGSHIP WORKSTATION',
		'title'      => 'Sovereign Rust + Tauri Desktop Installer (.EXE)',
		'summary'    => 'Native compiled Windows command center uniting 1-click subagent dispatch, live telemetry dashboards, and autonomous multi-channel publishing.',
		'spec'       => 'Compiled Native Binary · White-Glove Calibration',
		'image'      => $kr_theme_uri . 'assets/images/trading_terminal_luxury.jpg',
		'cta_label'  => 'Inspect Tier 3 ($800)',
		'cta_url'    => home_url( '/ai-protocols/#kr-tier-3' ),
		'external'   => false,
	),
	array(
		'cat'        => 'swarm-core',
		'cat_label'  => 'VOICE & HUD CORE',
		'badge'      => 'SUB-SECOND AUDIO',
		'title'      => 'Dual-Daemon Real-Time Voice & Listening HUD',
		'summary'    => 'Hardware-accelerated local speech-to-text paired with low-latency neural voice synthesis and optical S/PDIF keep-alive routing.',
		'spec'       => 'Push-to-Talk F9 Control · Zero Cloud Audio Lag',
		'image'      => $kr_theme_uri . 'assets/images/wayne_avatar_9x16_studio.jpg',
		'cta_label'  => 'Explore Voice Architecture',
		'cta_url'    => home_url( '/ai-protocols/' ),
		'external'   => false,
	),
	array(
		'cat'        => 'swarm-core',
		'cat_label'  => 'BROWSER TELEMETRY',
		'badge'      => 'PORT 9222 CDP',
		'title'      => 'Zero-Wrapper Chrome Port 9222 Automation',
		'summary'    => 'Direct JSON-RPC attachment to authenticated browser tabs for live DOM screenshot audits, Gutenberg publishing, and instant Search Console indexing.',
		'spec'       => 'Zero Headless Bot Flags · Live Screenshot Gates',
		'image'      => $kr_theme_uri . 'assets/images/ai_protocols_banner.png',
		'cta_label'  => 'Read CDP Briefings',
		'cta_url'    => home_url( '/intel/' ),
		'external'   => false,
	),
	array(
		'cat'        => 'swarm-core',
		'cat_label'  => 'MEMORY GRAPH',
		'badge'      => 'HYBRID VECTOR BRAIN',
		'title'      => 'Bi-Temporal Vector Brain & Learning Ledger',
		'summary'    => 'Combines dense CUDA embeddings with lexical precision and cross-session post-mortem ledgers so every autonomous sprint compounds institutional memory.',
		'spec'       => '3+ Primary Source Gate · Zero Context Drift',
		'image'      => $kr_theme_uri . 'assets/images/sonic_universe_banner.png',
		'cta_label'  => 'Inspect Intel Briefings',
		'cta_url'    => home_url( '/intel/' ),
		'external'   => false,
	),
	array(
		'cat'        => 'media-field',
		'cat_label'  => '4K CINEMA PIPELINE',
		'badge'      => '2-TRACK MASTERING',
		'title'      => '3-Force Holographic Video & DaVinci Pipeline',
		'summary'    => 'Deterministic batch orchestration, virtual-scroll canvas verification, and automated 2-track timeline assembly with -22.0 dB music bed ducking.',
		'spec'       => '4K UHD Render Gate · Whisper Transcript QA',
		'image'      => $kr_theme_uri . 'assets/images/whistler_luxury_estate.jpg',
		'cta_label'  => 'View Production Suite',
		'cta_url'    => home_url( '/ai-protocols/' ),
		'external'   => false,
	),
	array(
		'cat'        => 'media-field',
		'cat_label'  => 'PHYSICAL ENGINEERING',
		'badge'      => 'BC BUILDER #52603',
		'title'      => 'Licensed BC Builder #52603 Field Discipline',
		'summary'    => 'Every digital system is grounded in real-world critical-path execution through sister firm Keystone Possibilities Ltd. across Sea-to-Sky & Lower Mainland.',
		'spec'       => 'BC Hydro List ES54 · Open-Book CCDC 5B',
		'image'      => $kr_theme_uri . 'assets/images/bc_luxury_multiplex.jpg',
		'cta_label'  => 'Visit Keystone Possibilities',
		'cta_url'    => 'https://keystonepossibilities.ca/',
		'external'   => true,
	),
);
?>

<section id="architecture-vault" class="kr-v4-section kr-v4-section--black" data-kr-arch-root="<?php echo esc_attr( $kr_arch_uid ); ?>" aria-label="Sovereign AI Architecture and 3-Tier Protocol Vault">
	<div class="kr-v4-container">
		<div class="kr-v4-section-head">
			<div>
				<span class="kr-v4-kicker"><span class="kr-v4-kicker-dot"></span> SOVEREIGN PROTOCOL MUSEUM &middot; ZERO-SAAS WORKSTATION ENGINEERING</span>
				<h2 class="kr-v4-h2">3-Tier AI Protocol Vault &amp; Core Sovereign Systems</h2>
				<p class="kr-v4-lead">Built for founders, builders, and technical creators who refuse brittle SaaS wrappers—own the architecture from a $49.50 blueprint to a compiled native Rust + Tauri workstation.</p>
			</div>
			<div>
				<a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="kr-btn-gold">
					Compare All 3 Protocol Tiers &rarr;
				</a>
			</div>
		</div>

		<div class="kr-reel-toolbar">
			<div class="kr-filter-bar" role="tablist" aria-label="Filter Sovereign AI Architecture">
				<button type="button" class="kr-filter-pill is-active" data-kr-arch-filter="all">All Systems (<?php echo count( $kr_arch_items ); ?>)</button>
				<button type="button" class="kr-filter-pill" data-kr-arch-filter="protocol-tiers">3-Tier Protocol Vault (3)</button>
				<button type="button" class="kr-filter-pill" data-kr-arch-filter="swarm-core">Swarm &amp; Voice Core (3)</button>
				<button type="button" class="kr-filter-pill" data-kr-arch-filter="media-field">Media &amp; Field Discipline (2)</button>
			</div>

			<div class="kr-reel-arrows" aria-label="Scroll Architecture Vault Reel">
				<button type="button" class="kr-reel-arrow" data-kr-arch-prev aria-label="Scroll Architecture Left">&#8592;</button>
				<button type="button" class="kr-reel-arrow" data-kr-arch-next aria-label="Scroll Architecture Right">&#8594;</button>
			</div>
		</div>

		<div class="kr-cinema-track kr-cinema-track--wide" data-kr-arch-track>
			<?php foreach ( $kr_arch_items as $item ) : ?>
				<article class="kr-cinema-card" data-kr-arch-card data-kr-arch-cat="<?php echo esc_attr( $item['cat'] ); ?>">
					<div class="kr-card-cover-wrap kr-card-cover-wrap--wide">
						<img
							src="<?php echo esc_url( $item['image'] ); ?>"
							alt="<?php echo esc_attr( $item['title'] . ' — ' . $item['cat_label'] ); ?>"
							loading="lazy"
							decoding="async"
						/>
						<button
							type="button"
							class="kr-zoom-btn"
							data-kr-lightbox-open="<?php echo esc_url( $item['image'] ); ?>"
							data-kr-lightbox="1"
							data-kr-src="<?php echo esc_url( $item['image'] ); ?>"
							data-kr-lightbox-src="<?php echo esc_url( $item['image'] ); ?>"
							data-kr-title="<?php echo esc_attr( $item['title'] ); ?>"
							data-kr-lightbox-title="<?php echo esc_attr( $item['title'] ); ?>"
							data-kr-subtitle="<?php echo esc_attr( $item['cat_label'] . ' · ' . $item['spec'] ); ?>"
							data-kr-lightbox-caption="<?php echo esc_attr( $item['cat_label'] . ' · ' . $item['spec'] ); ?>"
							aria-label="<?php echo esc_attr( 'Inspect diagram for ' . $item['title'] ); ?>"
						>
							&#128269; Inspect
						</button>
					</div>

					<div class="kr-card-tag-row">
						<span><?php echo esc_html( $item['cat_label'] ); ?></span>
						<span style="color:#38bdf8;"><?php echo esc_html( $item['badge'] ); ?></span>
					</div>

					<h3 class="kr-card-title"><?php echo esc_html( $item['title'] ); ?></h3>
					<p class="kr-card-sub"><?php echo esc_html( $item['summary'] ); ?></p>
					<div style="font-family:'JetBrains Mono',monospace;font-size:0.7rem;color:#94a3b8;padding-top:2px;">
						<?php echo esc_html( $item['spec'] ); ?>
					</div>

					<div class="kr-card-actions">
						<a
							href="<?php echo esc_url( $item['cta_url'] ); ?>"
							<?php echo ! empty( $item['external'] ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
							class="kr-dsp-pill <?php echo 'protocol-tiers' === $item['cat'] ? 'kr-dsp-pill--gold' : ''; ?>"
						>
							<?php echo esc_html( $item['cta_label'] ); ?> &rarr;
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- Lightweight Self-Sufficient Lightbox Fallback (yields automatically if global #krLightboxModal handles click) -->
	<div class="kr-local-lightbox" data-kr-fallback-lightbox role="dialog" aria-modal="true" aria-hidden="true" aria-label="High-Resolution Asset Preview">
		<div class="kr-local-lightbox-dialog">
			<div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
				<div>
					<div style="font-family:'Outfit',sans-serif;font-size:1.08rem;font-weight:800;color:#f8fafc;" data-kr-fb-title>Keystone Verified Asset</div>
					<div style="font-family:'JetBrains Mono',monospace;font-size:0.73rem;color:#38bdf8;" data-kr-fb-sub></div>
				</div>
				<button type="button" class="kr-btn-cyan" style="min-height:36px;padding:6px 14px;" data-kr-fb-close>Close &times;</button>
			</div>
			<img src="" alt="" data-kr-fb-img loading="lazy" decoding="async" />
		</div>
	</div>

	<script>
	(function() {
		var root = document.querySelector('[data-kr-arch-root="<?php echo esc_js( $kr_arch_uid ); ?>"]');
		if (!root) return;
		var track = root.querySelector('[data-kr-arch-track]');
		var cards = Array.prototype.slice.call(root.querySelectorAll('[data-kr-arch-card]'));
		var pills = Array.prototype.slice.call(root.querySelectorAll('[data-kr-arch-filter]'));
		var prevBtn = root.querySelector('[data-kr-arch-prev]');
		var nextBtn = root.querySelector('[data-kr-arch-next]');

		pills.forEach(function(pill) {
			pill.addEventListener('click', function() {
				var cat = pill.getAttribute('data-kr-arch-filter') || 'all';
				pills.forEach(function(p) { p.classList.toggle('is-active', p === pill); });
				cards.forEach(function(card) {
					var match = (cat === 'all' || card.getAttribute('data-kr-arch-cat') === cat);
					if (match) card.removeAttribute('hidden');
					else card.setAttribute('hidden', 'hidden');
				});
				if (track) track.scrollTo({ left: 0, behavior: 'smooth' });
			});
		});

		if (prevBtn && track) {
			prevBtn.addEventListener('click', function() { track.scrollBy({ left: -380, behavior: 'smooth' }); });
		}
		if (nextBtn && track) {
			nextBtn.addEventListener('click', function() { track.scrollBy({ left: 380, behavior: 'smooth' }); });
		}

		// Delegated fallback for [data-kr-lightbox-open] if #krLightboxModal is not active yet
		var fbModal = root.querySelector('[data-kr-fallback-lightbox]');
		var fbImg = root.querySelector('[data-kr-fb-img]');
		var fbTitle = root.querySelector('[data-kr-fb-title]');
		var fbSub = root.querySelector('[data-kr-fb-sub]');
		var fbClose = root.querySelector('[data-kr-fb-close]');

		function closeFb() {
			if (!fbModal) return;
			fbModal.classList.remove('is-open');
			fbModal.setAttribute('aria-hidden', 'true');
		}
		if (fbClose) fbClose.addEventListener('click', closeFb);
		if (fbModal) {
			fbModal.addEventListener('click', function(e) { if (e.target === fbModal) closeFb(); });
		}

		document.addEventListener('click', function(e) {
			var trigger = e.target.closest('[data-kr-lightbox-open]');
			if (!trigger) return;
			setTimeout(function() {
				var globalModal = document.getElementById('krLightboxModal');
				if (globalModal && (globalModal.classList.contains('is-open') || globalModal.getAttribute('aria-hidden') === 'false')) {
					return;
				}
				if (!fbModal || !fbImg) return;
				var src = trigger.getAttribute('data-kr-lightbox-open') || trigger.getAttribute('data-kr-src') || '';
				if (!src) return;
				fbImg.src = src;
				fbImg.alt = trigger.getAttribute('data-kr-title') || 'Keystone Recomposition Artwork';
				if (fbTitle) fbTitle.textContent = trigger.getAttribute('data-kr-title') || 'Keystone Recomposition';
				if (fbSub) fbSub.textContent = trigger.getAttribute('data-kr-subtitle') || '';
				fbModal.classList.add('is-open');
				fbModal.setAttribute('aria-hidden', 'false');
			}, 25);
		});
	})();
	</script>
</section>
