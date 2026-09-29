<?php
/**
 * Template Name: Keystone Sonic Universe
 * Description: Master 18-Album Discography, TooLost Metadata, ISRC Directory & DSP Streaming Hub
 * Version: 3.2.0 (High-End Dark Quiet Luxury Edition)
 * Stamped: September 2026
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$theme_uri = get_stylesheet_directory_uri();

if ( ! function_exists( 'keystone_get_all_albums' ) ) {
    require_once __DIR__ . '/inc/sonic-catalog-data.php';
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
                
                <!-- PRODUCER VERIFICATION CHIP -->
                <div class="hero-founder-chip" style="margin-bottom: 24px;">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/wayne_avatar.jpg' ); ?>" 
                         alt="Wayne Stevenson — Functional Audio Producer" 
                         class="founder-chip-avatar" />
                    <div class="founder-chip-meta">
                        <span class="chip-name">Wayne Stevenson</span>
                        <span class="chip-role">Electronic Music Producer • Spotify Official Artist Channel</span>
                    </div>
                    <span class="chip-verified-badge">✔ TOOLOST ARTIST</span>
                </div>

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

                <!-- STUDIO AUDIO BANNER FRAME -->
                <div class="hero-banner-frame" style="margin-top: 40px;">
                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/sonic_universe_banner.png' ); ?>" 
                         alt="Keystone Recomposition 18-Album Sonic Universe Studio Banner" 
                         class="hero-banner-image" />
                    <div class="banner-glass-reflection"></div>
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

                        <div class="album-card-details">
                            <span class="album-genre-tag"><?php echo esc_html( $album['genre'] ); ?></span>
                            <h3 class="album-title"><?php echo esc_html( $album['title'] ); ?></h3>
                            
                            <div class="album-metadata-row">
                                <div class="meta-item">
                                    <span class="meta-label">BPM:</span>
                                    <span class="meta-val"><?php echo esc_html( (string) $album['bpm'] ); ?></span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">UPC:</span>
                                    <span class="meta-val"><code><?php echo esc_html( $album['upc'] ); ?></code></span>
                                </div>
                            </div>

                            <!-- Expandable Tracklist Accordion -->
                            <details class="album-tracks-accordion">
                                <summary class="accordion-toggle">
                                    <span>Tracklist &amp; Canonical ISRCs (<?php echo esc_html( (string) $album['track_count'] ); ?>)</span>
                                    <span class="toggle-icon">▾</span>
                                </summary>
                                <div class="tracklist-scroll-body">
                                    <ul class="tracklist-ul">
                                        <?php foreach ( $album['tracks'] as $trk ) : ?>
                                            <li class="track-item">
                                                <div class="track-left">
                                                    <span class="track-pos"><?php echo esc_html( sprintf( '%02d', $trk['pos'] ) ); ?></span>
                                                    <span class="track-title"><?php echo esc_html( $trk['title'] ); ?></span>
                                                </div>
                                                <div class="track-right">
                                                    <code class="track-isrc"><?php echo esc_html( $trk['isrc'] ); ?></code>
                                                    <button type="button" class="btn-copy-isrc" data-isrc="<?php echo esc_attr( $trk['isrc'] ); ?>" title="Copy ISRC">
                                                        📋 Copy
                                                    </button>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </details>

                            <!-- DSP Action Bar -->
                            <div class="album-actions-bar">
                                <a href="<?php echo esc_url( $album['spotify_url'] ); ?>" target="_blank" rel="noopener" class="album-btn spotify">
                                    Spotify
                                </a>
                                <a href="<?php echo esc_url( $album['youtube_url'] ); ?>" target="_blank" rel="noopener" class="album-btn youtube">
                                    YouTube
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Genre filter buttons
    const buttons = document.querySelectorAll('.sonic-filter-bar .filter-btn');
    const cards = document.querySelectorAll('.discography-grid-18 .album-card-18');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const targetFilter = btn.getAttribute('data-filter');

            cards.forEach(card => {
                if (targetFilter === 'all' || card.getAttribute('data-category') === targetFilter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // 2. 1-Click ISRC Copy Buttons
    const copyButtons = document.querySelectorAll('.btn-copy-isrc');
    copyButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isrc = btn.getAttribute('data-isrc');
            if (navigator.clipboard && isrc) {
                navigator.clipboard.writeText(isrc).then(() => {
                    const originalText = btn.innerHTML;
                    btn.innerHTML = '✔ Copied!';
                    btn.style.color = '#00f0ff';
                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.style.color = '';
                    }, 2000);
                });
            }
        });
    });
});
</script>

<?php
get_footer();
