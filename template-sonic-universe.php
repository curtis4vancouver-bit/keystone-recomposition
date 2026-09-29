<?php
/**
 * Template Name: Keystone Sonic Universe
 * Description: Master 18-Album Discography, TooLost UPC Registry, and Canonical ISRCs
 * Version: 3.0.0
 * Stamped: September 2026
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// Load master catalog data
if ( ! function_exists( 'keystone_get_all_albums' ) ) {
    require_once get_stylesheet_directory() . '/inc/sonic-catalog-data.php';
}

$albums = keystone_get_all_albums();
$total_albums = count( $albums );
$total_tracks = keystone_get_total_tracks_count();
?>

<div id="primary" class="content-area primary keystone-sonic-universe-page">
    <main id="main" class="site-main">
        <div class="ast-container">

            <!-- PAGE HEADER -->
            <header class="sonic-header text-center">
                <span class="gold-badge-pill">OFFICIAL ARTIST CHANNEL • TOOLOST DIGITAL</span>
                <h1 class="page-title">
                    The Sonic Universe: <span class="gold-gradient-text"><?php echo esc_html( (string) $total_albums ); ?> Studio Albums</span>
                </h1>
                <p class="page-subtitle">
                    Original electronic compositions, melodic progressive house, and bio-frequency soundscapes produced by Wayne Stevenson. Fully cataloged with <?php echo esc_html( (string) $total_tracks ); ?> registered ISRCs across Spotify, Apple Music, and YouTube Music.
                </p>

                <div class="header-dsp-links">
                    <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener" class="dsp-pill spotify">
                        <span class="dsp-icon">▶</span> Follow on Spotify OAC
                    </a>
                    <a href="https://www.youtube.com/@KeyStoneRecomposition" target="_blank" rel="noopener" class="dsp-pill youtube">
                        <span class="dsp-icon">▶</span> YouTube Music Channel
                    </a>
                    <a href="https://musicbrainz.org/artist/1a30328b-20b2-48bd-8e56-2884d3b040c0" target="_blank" rel="noopener" class="dsp-pill musicbrainz">
                        <span class="dsp-icon">⚡</span> MusicBrainz Verified
                    </a>
                </div>
            </header>

            <!-- GENRE & BPM FILTER BAR -->
            <div class="sonic-filter-bar">
                <button type="button" class="filter-btn active" data-filter="all">All Releases (<?php echo esc_html( (string) $total_albums ); ?>)</button>
                <button type="button" class="filter-btn" data-filter="downtempo">Organic Downtempo (115 BPM)</button>
                <button type="button" class="filter-btn" data-filter="deep-house">Progressive Deep House (124 BPM)</button>
                <button type="button" class="filter-btn" data-filter="industrial">Industrial Tech House (122 BPM)</button>
                <button type="button" class="filter-btn" data-filter="solfeggio">Solfeggio Frequencies</button>
            </div>

            <!-- DISCOGRAPHY GRID -->
            <div class="discography-grid-18">
                <?php foreach ( $albums as $album ) : 
                    $genre_lower = strtolower( $album['genre'] );
                    $category_tag = 'deep-house';
                    if ( str_contains( $genre_lower, 'downtempo' ) || str_contains( $genre_lower, 'chill' ) ) {
                        $category_tag = 'downtempo';
                    } elseif ( str_contains( $genre_lower, 'industrial' ) || str_contains( $genre_lower, 'tech' ) ) {
                        $category_tag = 'industrial';
                    } elseif ( str_contains( $genre_lower, 'solfeggio' ) || str_contains( $genre_lower, 'cellular' ) ) {
                        $category_tag = 'solfeggio';
                    }
                ?>
                    <article class="album-card-18" data-category="<?php echo esc_attr( $category_tag ); ?>">
                        <div class="album-card-art">
                            <img src="<?php echo esc_url( $album['cover_image'] ); ?>" alt="<?php echo esc_attr( $album['title'] ); ?> Album Artwork" loading="lazy" />
                            <div class="album-art-badges">
                                <span class="badge-year"><?php echo esc_html( substr( $album['release_date'], 0, 4 ) ); ?></span>
                                <span class="badge-tracks"><?php echo esc_html( (string) $album['track_count'] ); ?> Tracks</span>
                            </div>
                        </div>

                        <div class="album-card-body">
                            <div class="album-meta-top">
                                <span class="album-genre-tag"><?php echo esc_html( $album['genre'] ); ?></span>
                                <span class="album-bpm-tag"><?php echo esc_html( (string) $album['bpm'] ); ?> BPM</span>
                            </div>

                            <h3 class="album-title"><?php echo esc_html( $album['title'] ); ?></h3>
                            
                            <div class="album-registry-meta">
                                <span class="registry-upc">UPC: <code><?php echo esc_html( $album['upc'] ); ?></code></span>
                                <span class="registry-id">TooLost ID: #<?php echo esc_html( (string) $album['id'] ); ?></span>
                            </div>

                            <div class="album-streaming-actions">
                                <a href="<?php echo esc_url( $album['spotify_url'] ); ?>" target="_blank" rel="noopener" class="stream-btn spotify">
                                    Spotify ▶
                                </a>
                                <a href="<?php echo esc_url( $album['youtube_url'] ); ?>" target="_blank" rel="noopener" class="stream-btn youtube">
                                    YouTube ▶
                                </a>
                            </div>

                            <!-- Expandable Tracklist Accordion -->
                            <details class="album-tracklist-accordion">
                                <summary class="tracklist-toggle-btn">
                                    View Tracklist &amp; Canonical ISRCs (<?php echo esc_html( (string) $album['track_count'] ); ?>) ▾
                                </summary>
                                <ul class="tracklist-items">
                                    <?php foreach ( $album['tracks'] as $track ) : ?>
                                        <li class="track-row">
                                            <span class="track-index"><?php echo esc_html( sprintf( '%02d', $track['pos'] ) ); ?></span>
                                            <span class="track-title-text"><?php echo esc_html( $track['title'] ); ?></span>
                                            <div class="track-isrc-wrap">
                                                <code class="isrc-code"><?php echo esc_html( $track['isrc'] ); ?></code>
                                                <button type="button" class="copy-isrc-btn" data-isrc="<?php echo esc_attr( $track['isrc'] ); ?>" title="Copy ISRC">
                                                    Copy
                                                </button>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </details>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. ISRC 1-Click Copy
    document.querySelectorAll('.copy-isrc-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var isrc = this.getAttribute('data-isrc');
            if (!isrc) return;
            navigator.clipboard.writeText(isrc).then(() => {
                var origText = btn.textContent;
                btn.textContent = '✓ Copied!';
                btn.style.color = '#00f0ff';
                setTimeout(function () {
                    btn.textContent = origText;
                    btn.style.color = '';
                }, 2000);
            }).catch(function (err) {
                console.warn('Clipboard write failed:', err);
            });
        });
    });

    // 2. Genre / BPM Filtering
    var filterBtns = document.querySelectorAll('.filter-btn');
    var albumCards = document.querySelectorAll('.album-card-18');

    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            var filter = this.getAttribute('data-filter');

            albumCards.forEach(function (card) {
                if (filter === 'all') {
                    card.style.display = 'flex';
                } else {
                    var cat = card.getAttribute('data-category');
                    card.style.display = (cat === filter) ? 'flex' : 'none';
                }
            });
        });
    });
});
</script>

<?php
get_footer();
