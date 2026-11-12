<?php
/**
 * Keystone Recomposition v4.0 — Section 3: Live 60fps Bio-Acoustic Sound Lab + 25-Release Discography Cinema Reel
 *
 * Combines the 60fps Hi-DPI Bio-Acoustic Synthesizer (#cyberAudio + #cyberVisualizer + 6 real MP3 masters)
 * with a Possibilities-style filterable Horizontal Cinema Reel across all 25 official releases (246 ISRC tracks).
 *
 * @package KeystoneRecompositionChild
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'keystone_get_all_albums' ) ) {
	$kr_catalog_file = trailingslashit( get_stylesheet_directory() ) . 'inc/sonic-catalog-data.php';
	if ( file_exists( $kr_catalog_file ) ) {
		require_once $kr_catalog_file;
	}
}

$kr_albums    = function_exists( 'keystone_get_all_albums' ) ? keystone_get_all_albums() : array();
$kr_theme_uri = trailingslashit( get_stylesheet_directory_uri() );
$kr_sonic_uid = wp_unique_id( 'kr-discog-' );

$kr_soundlab_tracks = array(
	array(
		'title' => 'Steady Incline',
		'sub'   => '432Hz Architectural Deep House · 122 BPM',
		'dur'   => '24-BIT MASTER',
	),
	array(
		'title' => 'Fluid Dynamics',
		'sub'   => '528Hz Harmonic Flow & Sub-Bass · 122 BPM',
		'dur'   => '24-BIT MASTER',
	),
	array(
		'title' => 'Tier One Flow',
		'sub'   => 'Sovereign Builder Focus Engine · 124 BPM',
		'dur'   => '24-BIT MASTER',
	),
	array(
		'title' => 'The Midday Push',
		'sub'   => 'Organic Cello & Deep Bass · 120 BPM',
		'dur'   => '24-BIT MASTER',
	),
	array(
		'title' => 'Kinetic Peace',
		'sub'   => 'Melodic Downtempo · 115 BPM',
		'dur'   => '24-BIT MASTER',
	),
	array(
		'title' => 'The Long Game',
		'sub'   => 'Late-Night Sea-to-Sky Horizon · 120 BPM',
		'dur'   => '24-BIT MASTER',
	),
);
?>

<section id="sonic-vault" class="kr-v4-section kr-v4-section--obsidian" data-kr-discog-root="<?php echo esc_attr( $kr_sonic_uid ); ?>" aria-label="60fps Bio-Acoustic Sound Lab and 25-Release Discography Cinema Reel">
	<div class="kr-v4-container">
		<div class="kr-v4-section-head">
			<div>
				<span class="kr-v4-kicker kr-v4-kicker--gold"><span class="kr-v4-kicker-dot"></span> BIO-ACOUSTIC SOUND LAB &middot; 25 OFFICIAL RELEASES &middot; 246 ISRC MASTERS</span>
				<h2 class="kr-v4-h2">60fps Harmonic Synthesizer &amp; 25-Release Cinema Vault</h2>
				<p class="kr-v4-lead">Audition real 24-bit studio masters inside the live 60fps Web Audio spectrum analyzer, then glide through all 25 official Keystone Recomposition releases on Spotify, Apple Music, and YouTube.</p>
			</div>
			<div>
				<a href="<?php echo esc_url( home_url( '/sonic-universe/' ) ); ?>" class="kr-btn-cyan">
					Open Full 246-Track Sonic Matrix &rarr;
				</a>
			</div>
		</div>

		<!-- Part A: Live 60fps Hi-DPI Bio-Acoustic Synthesizer -->
		<div class="kr-soundlab-shell" id="sound-lab">
			<audio id="cyberAudio" preload="none" crossorigin="anonymous"></audio>

			<div class="kr-soundlab-stage">
				<div class="kr-soundlab-top-row">
					<span id="soundLabTopFreqBadge" class="kr-v4-kicker" style="font-size:0.68rem;">432HZ + 528HZ HARMONIC ENGINE</span>
					<div class="kr-pill-group" role="group" aria-label="Visualizer Display Mode">
						<button type="button" class="kr-mini-pill graph-mode-btn active" data-graph-mode="spectrum" onclick="if(window.setKeystoneGraphMode)window.setKeystoneGraphMode('spectrum',this);">64-Bar FFT</button>
						<button type="button" class="kr-mini-pill graph-mode-btn" data-graph-mode="lattice" onclick="if(window.setKeystoneGraphMode)window.setKeystoneGraphMode('lattice',this);">Harmonic Lattice</button>
						<button type="button" class="kr-mini-pill graph-mode-btn" data-graph-mode="scope" onclick="if(window.setKeystoneGraphMode)window.setKeystoneGraphMode('scope',this);">Phase Scope</button>
					</div>
				</div>

				<div class="kr-canvas-box" id="cyberVisualizerWrapper">
					<canvas id="cyberVisualizer" width="760" height="220" aria-label="Live 60fps Audio Frequency Visualizer"></canvas>
					<span id="cyberGraphHzBadge" style="position:absolute;bottom:10px;right:12px;font-family:'JetBrains Mono',monospace;font-size:0.68rem;color:#38bdf8;background:rgba(4,7,13,0.82);padding:3px 9px;border-radius:999px;border:1px solid rgba(56,189,248,0.3);">FFT SPECTRUM &middot; 60FPS</span>
				</div>

				<div class="kr-soundlab-controls">
					<div>
						<div id="currentTrackTitle" style="font-family:'Outfit',sans-serif;font-weight:800;font-size:1.02rem;color:#f8fafc;">01 &bull; Steady Incline (432Hz Master)</div>
						<div id="engineStateBadge" style="font-family:'JetBrains Mono',monospace;font-size:0.72rem;color:#38bdf8;margin-top:2px;">STANDBY &middot; CLICK PLAY OR SELECT MASTER TRACK</div>
					</div>
					<div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
						<button type="button" id="cyberPlayBtn" class="kr-btn-gold" style="min-height:42px;padding:9px 20px;">
							<span id="playIcon">&#9654;</span>
							<span id="playLabel">PLAY MASTER</span>
						</button>
						<button type="button" class="kr-btn-cyan" style="min-height:42px;padding:9px 15px;" onclick="if(window.rotateNextKeystoneTrack)window.rotateNextKeystoneTrack();" aria-label="Next Master Track">
							Next &raquo;
						</button>
					</div>
				</div>

				<div class="kr-pill-group" aria-label="Acoustic Tuning Presets">
					<button type="button" class="kr-mini-pill freq-tune-pill active" data-freq-band="432" onclick="if(window.setKeystoneFreqBand)window.setKeystoneFreqBand('432',this);">432Hz Grounded Tuning</button>
					<button type="button" class="kr-mini-pill freq-tune-pill" data-freq-band="528" onclick="if(window.setKeystoneFreqBand)window.setKeystoneFreqBand('528',this);">528Hz Clarity Lock</button>
					<button type="button" class="kr-mini-pill freq-tune-pill" data-freq-band="122" onclick="if(window.setKeystoneFreqBand)window.setKeystoneFreqBand('122',this);">122 BPM Deep House Drive</button>
				</div>
			</div>

			<div class="kr-playlist-col" role="list" aria-label="6 Studio Master Preview Tracks">
				<div style="font-family:'JetBrains Mono',monospace;font-size:0.71rem;font-weight:700;color:#d4af37;letter-spacing:0.07em;text-transform:uppercase;margin-bottom:2px;">
					// DIRECT 24-BIT ENGINE DECK (6 STUDIO MASTERS)
				</div>
				<?php foreach ( $kr_soundlab_tracks as $t_idx => $trk ) : ?>
					<button
						type="button"
						class="kr-playlist-row playlist-track-row<?php echo 0 === $t_idx ? ' active-track' : ''; ?>"
						onclick="if(window.switchTrack)window.switchTrack('<?php echo esc_js( $trk['title'] ); ?>','<?php echo esc_js( $trk['sub'] ); ?>',<?php echo (int) $t_idx; ?>);"
					>
						<span>
							<strong style="display:block;font-family:'Outfit',sans-serif;font-size:0.9rem;color:#f8fafc;">
								<?php echo esc_html( sprintf( '%02d', $t_idx + 1 ) . ' · ' . $trk['title'] ); ?>
							</strong>
							<span style="display:block;font-size:0.75rem;color:#94a3b8;"><?php echo esc_html( $trk['sub'] ); ?></span>
						</span>
						<span style="font-family:'JetBrains Mono',monospace;font-size:0.67rem;color:#38bdf8;white-space:nowrap;"><?php echo esc_html( $trk['dur'] ); ?></span>
					</button>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- Part B: Interactive 25-Release Discography Cinema Reel -->
		<div class="kr-reel-toolbar">
			<div class="kr-filter-bar" role="tablist" aria-label="Filter 25 Official Releases">
				<button type="button" class="kr-filter-pill is-active" data-kr-discog-filter="all">All 25 Releases (<?php echo count( $kr_albums ); ?>)</button>
				<button type="button" class="kr-filter-pill" data-kr-discog-filter="432hz-solfeggio">432Hz &amp; Solfeggio</button>
				<button type="button" class="kr-filter-pill" data-kr-discog-filter="deep-melodic-house">Deep Melodic House</button>
				<button type="button" class="kr-filter-pill" data-kr-discog-filter="architectural-focus">Architectural Focus</button>
				<button type="button" class="kr-filter-pill" data-kr-discog-filter="singles">Singles</button>
			</div>

			<div class="kr-reel-arrows" aria-label="Scroll Discography Cinema Reel">
				<span style="font-family:'JetBrains Mono',monospace;font-size:0.72rem;color:#94a3b8;margin-right:6px;" data-kr-discog-count>Showing <?php echo count( $kr_albums ); ?> releases</span>
				<button type="button" class="kr-reel-arrow" data-kr-discog-prev aria-label="Scroll Releases Left">&#8592;</button>
				<button type="button" class="kr-reel-arrow" data-kr-discog-next aria-label="Scroll Releases Right">&#8594;</button>
			</div>
		</div>

		<div class="kr-cinema-track" data-kr-discog-track>
			<?php
			foreach ( $kr_albums as $a_idx => $album ) :
				$a_title  = isset( $album['title'] ) ? (string) $album['title'] : 'Keystone Release';
				$a_type   = isset( $album['type'] ) ? (string) $album['type'] : 'Album';
				$a_genre  = isset( $album['genre'] ) ? (string) $album['genre'] : 'Electronic';
				$a_bpm    = isset( $album['bpm'] ) ? (int) $album['bpm'] : 122;
				$a_tracks = isset( $album['track_count'] ) ? (int) $album['track_count'] : 10;
				$a_upc    = isset( $album['upc'] ) ? (string) $album['upc'] : '';
				$a_cover  = ! empty( $album['cover_image'] ) ? (string) $album['cover_image'] : ( $kr_theme_uri . 'assets/images/sonic_universe_banner.png' );
				$a_spot   = ! empty( $album['spotify_url'] ) ? (string) $album['spotify_url'] : ( ! empty( $album['smartlink'] ) ? (string) $album['smartlink'] : 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y' );
				$a_apple  = ! empty( $album['apple_url'] ) ? (string) $album['apple_url'] : 'https://music.apple.com/us/artist/keystone-recomposition/1862989452';
				$a_slug   = sanitize_title( $a_title );
				$haystack = strtolower( $a_title . ' ' . $a_genre . ' ' . $a_type );

				$cats = array();
				if ( 'single' === strtolower( $a_type ) || $a_tracks <= 3 ) {
					$cats[] = 'singles';
				}
				if ( false !== strpos( $haystack, '432' ) || false !== strpos( $haystack, '528' ) || false !== strpos( $haystack, 'solfeggio' ) || false !== strpos( $haystack, 'frequency' ) || false !== strpos( $haystack, 'resonance' ) || false !== strpos( $haystack, 'neural' ) || false !== strpos( $haystack, 'gamma' ) ) {
					$cats[] = '432hz-solfeggio';
				}
				if ( false !== strpos( $haystack, 'house' ) || false !== strpos( $haystack, 'melodic' ) || false !== strpos( $haystack, 'club' ) || false !== strpos( $haystack, 'horizon' ) || ( $a_bpm >= 120 && $a_bpm <= 128 ) ) {
					$cats[] = 'deep-melodic-house';
				}
				if ( false !== strpos( $haystack, 'architect' ) || false !== strpos( $haystack, 'focus' ) || false !== strpos( $haystack, 'builder' ) || false !== strpos( $haystack, 'empire' ) || false !== strpos( $haystack, 'ambient' ) || empty( $cats ) ) {
					$cats[] = 'architectural-focus';
				}
				$cats_attr = implode( ' ', array_unique( $cats ) );
				$meta_sub  = sprintf( '%s · %d %s · %d BPM%s', $a_type, $a_tracks, 1 === $a_tracks ? 'Track' : 'Tracks', $a_bpm, $a_upc ? ' · UPC ' . $a_upc : '' );
				?>
				<article class="kr-cinema-card" data-kr-discog-card data-kr-cats="<?php echo esc_attr( $cats_attr ); ?>">
					<div class="kr-card-cover-wrap">
						<img
							src="<?php echo esc_url( $a_cover ); ?>"
							alt="<?php echo esc_attr( $a_title . ' — Official Cover Artwork by Keystone Recomposition' ); ?>"
							loading="lazy"
							decoding="async"
						/>
						<button
							type="button"
							class="kr-zoom-btn"
							data-kr-lightbox-open="<?php echo esc_url( $a_cover ); ?>"
							data-kr-lightbox="1"
							data-kr-src="<?php echo esc_url( $a_cover ); ?>"
							data-kr-lightbox-src="<?php echo esc_url( $a_cover ); ?>"
							data-kr-title="<?php echo esc_attr( $a_title ); ?>"
							data-kr-lightbox-title="<?php echo esc_attr( $a_title ); ?>"
							data-kr-subtitle="<?php echo esc_attr( $meta_sub ); ?>"
							data-kr-lightbox-caption="<?php echo esc_attr( $meta_sub ); ?>"
							aria-label="<?php echo esc_attr( 'Zoom cover artwork for ' . $a_title ); ?>"
						>
							&#128269; Zoom Art
						</button>
					</div>

					<div class="kr-card-tag-row">
						<span><?php echo esc_html( sprintf( 'RELEASE #%02d · %s', $a_idx + 1, strtoupper( $a_type ) ) ); ?></span>
						<span style="color:#38bdf8;"><?php echo esc_html( $a_tracks . ( 1 === $a_tracks ? ' MASTER' : ' MASTERS' ) ); ?></span>
					</div>

					<h3 class="kr-card-title"><?php echo esc_html( $a_title ); ?></h3>
					<p class="kr-card-sub"><?php echo esc_html( $a_genre . ' · ' . $a_bpm . ' BPM' ); ?></p>

					<div class="kr-card-actions">
						<button
							type="button"
							class="kr-dsp-pill kr-dsp-pill--gold"
							onclick="if(window.loadAndPlayAlbum)window.loadAndPlayAlbum('<?php echo esc_js( $a_title ); ?>','<?php echo esc_js( $a_genre ); ?>');"
						>
							&#9654; Cue Lab
						</button>
						<a href="<?php echo esc_url( $a_spot ); ?>" target="_blank" rel="noopener noreferrer" class="kr-dsp-pill" aria-label="<?php echo esc_attr( 'Stream ' . $a_title . ' on Spotify' ); ?>">
							Spotify &nearr;
						</a>
						<a href="<?php echo esc_url( $a_apple ); ?>" target="_blank" rel="noopener noreferrer" class="kr-dsp-pill" aria-label="<?php echo esc_attr( 'Stream ' . $a_title . ' on Apple Music' ); ?>">
							Apple &nearr;
						</a>
						<a href="<?php echo esc_url( home_url( '/sonic-universe/#' . $a_slug ) ); ?>" class="kr-dsp-pill" aria-label="<?php echo esc_attr( 'Inspect ISRC tracks for ' . $a_title ); ?>">
							ISRCs
						</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>

	<script>
	(function() {
		var root = document.querySelector('[data-kr-discog-root="<?php echo esc_js( $kr_sonic_uid ); ?>"]');
		if (!root) return;
		var track = root.querySelector('[data-kr-discog-track]');
		var cards = Array.prototype.slice.call(root.querySelectorAll('[data-kr-discog-card]'));
		var pills = Array.prototype.slice.call(root.querySelectorAll('[data-kr-discog-filter]'));
		var countEl = root.querySelector('[data-kr-discog-count]');
		var prevBtn = root.querySelector('[data-kr-discog-prev]');
		var nextBtn = root.querySelector('[data-kr-discog-next]');

		pills.forEach(function(pill) {
			pill.addEventListener('click', function() {
				var cat = pill.getAttribute('data-kr-discog-filter') || 'all';
				pills.forEach(function(p) { p.classList.toggle('is-active', p === pill); });
				var shown = 0;
				cards.forEach(function(card) {
					var tokens = (' ' + (card.getAttribute('data-kr-cats') || '') + ' ');
					var match = (cat === 'all' || tokens.indexOf(' ' + cat + ' ') !== -1);
					if (match) {
						card.removeAttribute('hidden');
						shown++;
					} else {
						card.setAttribute('hidden', 'hidden');
					}
				});
				if (countEl) {
					countEl.textContent = 'Showing ' + shown + (shown === 1 ? ' release' : ' releases');
				}
				if (track) {
					track.scrollTo({ left: 0, behavior: 'smooth' });
				}
			});
		});

		if (prevBtn && track) {
			prevBtn.addEventListener('click', function() { track.scrollBy({ left: -360, behavior: 'smooth' }); });
		}
		if (nextBtn && track) {
			nextBtn.addEventListener('click', function() { track.scrollBy({ left: 360, behavior: 'smooth' }); });
		}
	})();
	</script>
</section>
