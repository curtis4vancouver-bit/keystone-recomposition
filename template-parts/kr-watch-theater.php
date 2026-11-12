<?php
/**
 * Keystone Recomposition v4.0 — Section 2: 4K Dual-Channel Watch Briefing & Music Video Theater
 *
 * Interactive multi-tab 4K theater switching between @KeystoneAIProtocols autonomous
 * engineering briefings and @KeyStoneRecomposition official 4K music videos.
 *
 * @package KeystoneRecompositionChild
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$kr_theme_uri = trailingslashit( get_stylesheet_directory_uri() );
$kr_keyhole   = $kr_theme_uri . 'assets/images/keystone_real_logo_badge_bold.png';

$kr_watch_videos = array(
	array(
		'id'          => 'u1gUjk9xcB4',
		'tab_label'   => '01 · 3-Tier AI Builder Suite',
		'channel'     => '@KeystoneAIProtocols',
		'channel_url' => 'https://www.youtube.com/@KeystoneAIProtocols',
		'badge_tr'    => '4K UHD · AI PROTOCOLS',
		'title'       => 'Keystone AI Builder Suite: 3-Tier Sovereign Architecture (Brain, Website & Tauri .EXE)',
		'subtitle'    => 'Executive walkthrough of deterministic multi-agent orchestration, dark-luxury web systems, and native desktop control.',
		'duration'    => '02:59 · 4K MASTER',
		'poster'      => 'https://i.ytimg.com/vi/u1gUjk9xcB4/maxresdefault.jpg',
		'fallback'    => 'https://i.ytimg.com/vi/u1gUjk9xcB4/hqdefault.jpg',
		'cta_label'   => 'Explore 3-Tier Protocol Vault',
		'cta_url'     => home_url( '/ai-protocols/' ),
		'chapters'    => array(
			array( 'sec' => 0,   'time' => '00:00', 'label' => 'Tier 1: Sovereign Brain & Video Suite' ),
			array( 'sec' => 40,  'time' => '00:40', 'label' => 'Tier 2: 28-Agent FastMCP Web Engine' ),
			array( 'sec' => 80,  'time' => '01:20', 'label' => 'Tier 3: Native Rust + Tauri Workstation' ),
			array( 'sec' => 120, 'time' => '02:00', 'label' => 'Zero-SaaS Ownership & Field Reliability' ),
		),
	),
	array(
		'id'          => 'BuGR4MsghGs',
		'tab_label'   => '02 · Port 9222 Multi-Agent CDP',
		'channel'     => '@KeystoneAIProtocols',
		'channel_url' => 'https://www.youtube.com/@KeystoneAIProtocols',
		'badge_tr'    => '4K UHD · CDP TELEMETRY',
		'title'       => 'Chrome DevTools Protocol Port 9222: Zero-Wrapper Browser Control & Multi-Agent Execution',
		'subtitle'    => 'How direct JSON-RPC browser attachment replaces brittle wrapper scripts for real-time publishing and verification.',
		'duration'    => '04:12 · 4K BRIEFING',
		'poster'      => 'https://i.ytimg.com/vi/BuGR4MsghGs/maxresdefault.jpg',
		'fallback'    => 'https://i.ytimg.com/vi/BuGR4MsghGs/hqdefault.jpg',
		'cta_label'   => 'Read Technical Intel Hub',
		'cta_url'     => home_url( '/intel/' ),
		'chapters'    => array(
			array( 'sec' => 0,   'time' => '00:00', 'label' => 'Why Browser Wrappers Break at Scale' ),
			array( 'sec' => 55,  'time' => '00:55', 'label' => 'Direct Port 9222 Session Attachment' ),
			array( 'sec' => 130, 'time' => '02:10', 'label' => 'Parallel Subagent Verification Gates' ),
			array( 'sec' => 195, 'time' => '03:15', 'label' => 'Instant Search Console Indexing Loop' ),
		),
	),
	array(
		'id'          => 'nyQwl-7-vH0',
		'tab_label'   => '03 · "Diesel in the Rain" 4K Film',
		'channel'     => '@KeyStoneRecomposition',
		'channel_url' => 'https://www.youtube.com/@KeyStoneRecomposition',
		'badge_tr'    => '4K UHD · OFFICIAL MUSIC VIDEO',
		'title'       => 'Diesel in the Rain — Official 4K Cinema Music Video (Whiskey on a Wednesday LP)',
		'subtitle'    => 'Coastal BC highway cinematography paired with 24-bit acoustic grit and sovereign visual production.',
		'duration'    => '03:44 · 24-BIT MASTER',
		'poster'      => 'https://i.ytimg.com/vi/nyQwl-7-vH0/maxresdefault.jpg',
		'fallback'    => 'https://i.ytimg.com/vi/nyQwl-7-vH0/hqdefault.jpg',
		'cta_label'   => 'Open Full 25-Release Vault',
		'cta_url'     => home_url( '/sonic-universe/#whiskey-on-a-wednesday' ),
		'chapters'    => array(
			array( 'sec' => 0,   'time' => '00:00', 'label' => 'Sea-to-Sky Rain Intro & Guitar Motif' ),
			array( 'sec' => 52,  'time' => '00:52', 'label' => 'First Chorus & Highway Night Run' ),
			array( 'sec' => 118, 'time' => '01:58', 'label' => 'Baritone Bridge & Analog Percussion' ),
			array( 'sec' => 170, 'time' => '02:50', 'label' => 'Final Hook & 4K Master Outro' ),
		),
	),
	array(
		'id'          => '7Cbp8Vhy970',
		'tab_label'   => '04 · "Don\'t Say You\'re Fine" 4K',
		'channel'     => '@KeyStoneRecomposition',
		'channel_url' => 'https://www.youtube.com/@KeyStoneRecomposition',
		'badge_tr'    => '4K UHD · SOUL REVIVAL',
		'title'       => 'Don\'t Say You\'re Fine — Official 4K Soul Revival Video Premiere',
		'subtitle'    => 'Warm analog brass, velvet gospel-soul harmonics, and precision 2-track cinema mastering from Squamish, BC.',
		'duration'    => '03:36 · 24-BIT MASTER',
		'poster'      => 'https://i.ytimg.com/vi/7Cbp8Vhy970/maxresdefault.jpg',
		'fallback'    => 'https://i.ytimg.com/vi/7Cbp8Vhy970/hqdefault.jpg',
		'cta_label'   => 'Stream Soul Revival Single',
		'cta_url'     => home_url( '/sonic-universe/#dont-say-youre-fine' ),
		'chapters'    => array(
			array( 'sec' => 0,   'time' => '00:00', 'label' => 'Warm Rhodes & Brass Overture' ),
			array( 'sec' => 48,  'time' => '00:48', 'label' => 'Lead Vocal & Soul Pocket Groove' ),
			array( 'sec' => 104, 'time' => '01:44', 'label' => 'Choir Swell & Dynamic Breakdown' ),
			array( 'sec' => 160, 'time' => '02:40', 'label' => 'Full Horn Finale & Vinyl Resolve' ),
		),
	),
);

$kr_watch_uid   = wp_unique_id( 'kr-watch-' );
$kr_watch_first = $kr_watch_videos[0];
?>

<section id="watch-theater" class="kr-v4-section kr-v4-section--black" data-kr-watch-root="<?php echo esc_attr( $kr_watch_uid ); ?>" aria-label="4K Dual-Channel Watch Briefing and Music Video Theater">
	<div class="kr-v4-container">
		<div class="kr-v4-section-head">
			<div>
				<span class="kr-v4-kicker"><span class="kr-v4-kicker-dot"></span> DUAL-CHANNEL 4K CINEMA THEATER · @KEYSTONEAIPROTOCOLS &amp; @KEYSTONERECOMPOSITION</span>
				<h2 class="kr-v4-h2">Watch Autonomous AI Briefings &amp; Official 4K Music Films</h2>
				<p class="kr-v4-lead">Switch seamlessly between sovereign multi-agent engineering teardowns and 24-bit 4K visual music premieres—hosted privacy-first via YouTube-Nocookie with instant chapter seeking.</p>
			</div>

			<div class="kr-watch-switchers" role="tablist" aria-label="Select 4K Briefing or Music Film">
				<?php foreach ( $kr_watch_videos as $idx => $vid ) : ?>
					<button
						type="button"
						role="tab"
						class="kr-watch-tab<?php echo 0 === $idx ? ' is-active' : ''; ?>"
						aria-selected="<?php echo 0 === $idx ? 'true' : 'false'; ?>"
						data-kr-watch-select="<?php echo esc_attr( (string) $idx ); ?>"
					>
						<?php echo esc_html( $vid['tab_label'] ); ?>
					</button>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="kr-watch-frame-card">
			<div class="kr-watch-stage" data-kr-watch-stage>
				<button
					type="button"
					class="kr-watch-poster"
					data-kr-watch-play
					aria-label="<?php echo esc_attr( 'Play 4K video: ' . $kr_watch_first['title'] ); ?>"
				>
					<img
						class="kr-watch-poster-img"
						data-kr-watch-img
						src="<?php echo esc_url( $kr_watch_first['poster'] ); ?>"
						onerror="this.onerror=null;this.src='<?php echo esc_url( $kr_watch_first['fallback'] ); ?>';"
						alt="<?php echo esc_attr( $kr_watch_first['title'] ); ?>"
						loading="lazy"
						decoding="async"
					/>
					<span class="kr-watch-badge-tl">
						<img src="<?php echo esc_url( $kr_keyhole ); ?>" alt="" aria-hidden="true" width="22" height="22" />
						<span data-kr-watch-channel><?php echo esc_html( $kr_watch_first['channel'] ); ?></span>
					</span>
					<span class="kr-watch-badge-tr" data-kr-watch-tr><?php echo esc_html( $kr_watch_first['badge_tr'] ); ?></span>

					<span class="kr-watch-play-center" aria-hidden="true">
						<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor" style="margin-left:3px;">
							<path d="M8 5v14l11-7z"></path>
						</svg>
					</span>

					<span class="kr-watch-caption-bl">
						<span>
							<span class="kr-watch-caption-title" style="display:block;" data-kr-watch-title><?php echo esc_html( $kr_watch_first['title'] ); ?></span>
							<span class="kr-watch-caption-sub" style="display:block;" data-kr-watch-sub><?php echo esc_html( $kr_watch_first['subtitle'] ); ?></span>
						</span>
						<span class="kr-watch-dur-pill" data-kr-watch-dur><?php echo esc_html( $kr_watch_first['duration'] ); ?></span>
					</span>
				</button>
			</div>

			<div class="kr-watch-footer-bar">
				<div class="kr-watch-chapters" data-kr-watch-chapters aria-label="Clickable Key Moments">
					<?php foreach ( $kr_watch_first['chapters'] as $ch ) : ?>
						<button type="button" class="kr-watch-chapter-btn" data-kr-seek="<?php echo esc_attr( (string) $ch['sec'] ); ?>">
							<span class="kr-watch-chapter-time">&#9654; <?php echo esc_html( $ch['time'] ); ?></span>
							<span class="kr-watch-chapter-label"><?php echo esc_html( $ch['label'] ); ?></span>
						</button>
					<?php endforeach; ?>
				</div>

				<div class="kr-watch-meta-row">
					<span>Privacy-enhanced <code>youtube-nocookie.com</code> 4K theater &middot; Click any timestamp above to launch directly at that chapter.</span>
					<div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center;">
						<a href="<?php echo esc_url( $kr_watch_first['channel_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="kr-btn-cyan" data-kr-watch-chanlink style="min-height:38px;padding:7px 15px;font-size:0.77rem;">
							Subscribe on YouTube &nearr;
						</a>
						<a href="<?php echo esc_url( $kr_watch_first['cta_url'] ); ?>" class="kr-btn-gold" data-kr-watch-cta style="min-height:38px;padding:7px 16px;font-size:0.77rem;">
							<span data-kr-watch-ctalabel><?php echo esc_html( $kr_watch_first['cta_label'] ); ?></span> &rarr;
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
	(function() {
		var root = document.querySelector('[data-kr-watch-root="<?php echo esc_js( $kr_watch_uid ); ?>"]');
		if (!root) return;

		var videos = <?php echo wp_json_encode( $kr_watch_videos ); ?>;
		var activeIdx = 0;
		var stage = root.querySelector('[data-kr-watch-stage]');
		var posterTemplate = stage ? stage.innerHTML : '';
		var tabs = Array.prototype.slice.call(root.querySelectorAll('[data-kr-watch-select]'));
		var chaptersBox = root.querySelector('[data-kr-watch-chapters]');
		var chanLink = root.querySelector('[data-kr-watch-chanlink]');
		var ctaLink = root.querySelector('[data-kr-watch-cta]');
		var ctaLabel = root.querySelector('[data-kr-watch-ctalabel]');

		function playAt(startSec) {
			var v = videos[activeIdx];
			if (!v || !stage) return;
			var sec = parseInt(startSec || 0, 10) || 0;
			var src = 'https://www.youtube-nocookie.com/embed/' + encodeURIComponent(v.id)
				+ '?autoplay=1&rel=0&modestbranding=1&playsinline=1'
				+ (sec > 0 ? '&start=' + sec : '');
			stage.innerHTML = '<iframe src="' + src + '" title="' + String(v.title).replace(/"/g, '&quot;')
				+ '" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
		}

		function bindPosterTrigger() {
			var btn = stage ? stage.querySelector('[data-kr-watch-play]') : null;
			if (btn) {
				btn.addEventListener('click', function() { playAt(0); });
			}
		}

		function renderChapters(v) {
			if (!chaptersBox) return;
			chaptersBox.innerHTML = '';
			(v.chapters || []).forEach(function(ch) {
				var b = document.createElement('button');
				b.type = 'button';
				b.className = 'kr-watch-chapter-btn';
				b.setAttribute('data-kr-seek', String(ch.sec));
				var t = document.createElement('span');
				t.className = 'kr-watch-chapter-time';
				t.textContent = '\u25B6 ' + ch.time;
				var l = document.createElement('span');
				l.className = 'kr-watch-chapter-label';
				l.textContent = ch.label;
				b.appendChild(t);
				b.appendChild(l);
				b.addEventListener('click', function() { playAt(ch.sec); });
				chaptersBox.appendChild(b);
			});
		}

		function selectVideo(idx) {
			if (!videos[idx] || !stage) return;
			activeIdx = idx;
			var v = videos[idx];

			tabs.forEach(function(t, i) {
				var on = i === idx;
				t.classList.toggle('is-active', on);
				t.setAttribute('aria-selected', on ? 'true' : 'false');
			});

			stage.innerHTML = posterTemplate;
			var img = stage.querySelector('[data-kr-watch-img]');
			if (img) {
				img.onerror = function() { img.onerror = null; img.src = v.fallback; };
				img.src = v.poster;
				img.alt = v.title;
			}
			var chanEl = stage.querySelector('[data-kr-watch-channel]');
			var trEl = stage.querySelector('[data-kr-watch-tr]');
			var titleEl = stage.querySelector('[data-kr-watch-title]');
			var subEl = stage.querySelector('[data-kr-watch-sub]');
			var durEl = stage.querySelector('[data-kr-watch-dur]');
			var playBtn = stage.querySelector('[data-kr-watch-play]');

			if (chanEl) chanEl.textContent = v.channel;
			if (trEl) trEl.textContent = v.badge_tr;
			if (titleEl) titleEl.textContent = v.title;
			if (subEl) subEl.textContent = v.subtitle;
			if (durEl) durEl.textContent = v.duration;
			if (playBtn) playBtn.setAttribute('aria-label', 'Play 4K video: ' + v.title);

			if (chanLink) chanLink.href = v.channel_url;
			if (ctaLink) ctaLink.href = v.cta_url;
			if (ctaLabel) ctaLabel.textContent = v.cta_label;

			bindPosterTrigger();
			renderChapters(v);
		}

		bindPosterTrigger();
		Array.prototype.forEach.call(root.querySelectorAll('[data-kr-seek]'), function(btn) {
			btn.addEventListener('click', function() {
				playAt(btn.getAttribute('data-kr-seek'));
			});
		});
		tabs.forEach(function(tab, idx) {
			tab.addEventListener('click', function() { selectVideo(idx); });
		});
	})();
	</script>
</section>
