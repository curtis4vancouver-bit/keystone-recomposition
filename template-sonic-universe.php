<?php
/**
 * Template Name: Keystone Sonic Universe
 * Description: Master 22-Release Discography, TooLost Metadata, ISRC Directory, 12-Per-Page Pagination & Spotify Stream Hub
 * Version: 4.0.0 (High-End Dark Quiet Luxury Edition)
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

$albums       = keystone_get_all_albums();
$stats        = keystone_get_catalog_stats();
$total_albums = $stats['total_releases'];
$studio_count = $stats['studio_albums'];
$total_tracks = $stats['total_tracks'];
?>

<div id="primary" class="content-area primary keystone-sonic-universe-page">
    <main id="main" class="site-main">

        <!-- 1. HERO HEADER SECTION -->
        <section class="sonic-hero-section">
            <div class="ast-container">
                <header class="sonic-header text-center">
                    
                    <!-- HIGH-END LABEL PEDIGREE BADGE -->
                    <div class="gold-badge-pill" style="margin-bottom: 20px;">
                        OFFICIAL ARTIST CHANNEL &bull; TOOLOST DIGITAL DISTRIBUTION
                    </div>
                    
                    <h1 class="sonic-hero-title">The Sonic Universe:<br><span class="cyan-gold-gradient-text">22 Official Releases</span></h1>
                    
                    <p class="page-subtitle">
                        Original electronic compositions, melodic progressive house, and bio-frequency soundscapes produced by Wayne Stevenson. Fully cataloged with <?php echo esc_html( (string) $total_tracks ); ?> registered ISRCs across <?php echo esc_html( (string) $studio_count ); ?> studio albums and 2 singles on Spotify, Apple Music, and YouTube Music.
                    </p>

                    <!-- HIGH-END STREAMING & SUBSCRIBE ACTION BAR -->
                    <div class="header-dsp-links">
                        <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="dsp-pill spotify" title="Follow on Spotify">
                            <span class="dsp-icon">▶</span> Follow on Spotify OAC
                        </a>
                        <a href="https://music.apple.com/search?term=Keystone%20Recomposition" target="_blank" rel="noopener noreferrer" class="dsp-pill apple" title="Stream on Apple Music">
                            <span class="dsp-icon">🍎</span> Apple Music
                        </a>
                        <a href="https://music.youtube.com/search?q=Keystone+Recomposition" target="_blank" rel="noopener noreferrer" class="dsp-pill youtube-music" title="Stream on YouTube Music">
                            <span class="dsp-icon">🎵</span> YouTube Music
                        </a>
                        <a href="https://www.youtube.com/@KeyStoneRecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" class="dsp-pill youtube-subscribe" title="1-Click Subscribe to Keystone Recomposition">
                            <span class="dsp-icon">▶</span> Subscribe (@KeyStoneRecomposition)
                        </a>
                    </div>

                    <!-- STUDIO AUDIO BANNER FRAME (WAYNE'S BELOVED SYNTHESIZER PHOTO) -->
                    <div class="hero-banner-frame" style="margin-top: 40px;">
                        <img src="<?php echo esc_url( $theme_uri . '/assets/images/sonic_universe_banner.png' ); ?>" 
                             alt="Keystone Recomposition 22-Release Sonic Universe Studio Banner" 
                             class="hero-banner-image" 
                             fetchpriority="high" />
                        <div class="banner-glass-reflection"></div>
                    </div>
                </header>
            </div>
        </section>

        <!-- 1B. OFFICIAL 4K MUSIC VIDEO & VISUAL ARCHITECTURE SECTION -->
        <section class="sonic-featured-video-section" style="margin-top: 50px; margin-bottom: 20px;">
            <div class="ast-container">
                <div style="background: rgba(10, 15, 25, 0.85); border: 1px solid rgba(245, 158, 11, 0.35); border-radius: 24px; padding: 32px; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);">
                    <div style="display: flex; gap: 36px; align-items: stretch; width: 100%; flex-wrap: wrap;">
                        
                        <!-- Left Column (55%): Master 16:9 4K Video + Streaming Audio Deck -->
                        <div style="flex: 1 1 55%; min-width: 320px; display: flex; flex-direction: column;">
                            
                            <!-- 16:9 Master Video Frame (The Zen Builder) -->
                            <div style="position: relative; width: 100%; aspect-ratio: 16 / 9; border-radius: 16px; overflow: hidden; background: #000; border: 1px solid rgba(245, 158, 11, 0.3); box-shadow: 0 8px 30px rgba(245, 158, 11, 0.15);">
                                <iframe src="https://www.youtube.com/embed/1I1eLu9v_hM" 
                                        title="Wayne Stevenson - The Zen Builder (Official 4K Music Video)" 
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen></iframe>
                            </div>

                            <!-- Audio Streaming Deck & Quick Links -->
                            <div style="margin-top: 16px; background: rgba(8, 12, 20, 0.85); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 14px; padding: 14px 18px; display: flex; align-items: center; gap: 16px;">
                                
                                <!-- Track Thumbnail Box -->
                                <div style="position: relative; width: 120px; height: 68px; min-width: 120px; border-radius: 8px; overflow: hidden; background: #000; border: 1.5px solid rgba(245, 158, 11, 0.4); flex-shrink: 0;">
                                    <img src="https://img.youtube.com/vi/1I1eLu9v_hM/maxresdefault.jpg" alt="The Zen Builder" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://img.youtube.com/vi/1I1eLu9v_hM/hqdefault.jpg'" />
                                </div>

                                <!-- Track Details & Audio Meta -->
                                <div style="flex: 1; min-width: 0;">
                                    <div style="display: inline-block; background: rgba(245, 158, 11, 0.12); border: 1px solid rgba(245, 158, 11, 0.35); color: #fbbf24; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.06em; margin-bottom: 6px;">
                                        🎵 24-BIT / 48kHz LOSSLESS MASTER
                                    </div>
                                    <h4 style="margin: 0 0 4px 0; color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.96rem; font-weight: 800; line-height: 1.3;">
                                        Architectural Focus &bull; Track 1
                                    </h4>
                                    <p style="margin: 0 0 10px 0; color: #94a3b8; font-size: 0.78rem; line-height: 1.45;">
                                        432Hz Cellular Healing &bull; Too Lost Digital Distribution
                                    </p>
                                    <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                        <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #d4af37 0%, #f3e5ab 50%, #aa8010 100%); color: #04070d !important; -webkit-text-fill-color: #04070d !important; font-size: 0.78rem; font-weight: 800; padding: 8px 14px; border-radius: 9999px; text-decoration: none !important; box-shadow: 0 4px 12px rgba(212, 175, 55, 0.35);">
                                            <span>🎧</span> Stream on Spotify
                                        </a>
                                        <a href="https://www.youtube.com/@KeyStoneRecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background: rgba(56, 189, 248, 0.12); border: 1px solid rgba(56, 189, 248, 0.45); color: #38bdf8 !important; -webkit-text-fill-color: #38bdf8 !important; font-size: 0.78rem; font-weight: 700; padding: 8px 14px; border-radius: 9999px; text-decoration: none !important;">
                                            <span>🔔</span> Subscribe Channel
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right Column (45%): Sonic Architecture Write-up -->
                        <div style="flex: 1 1 40%; min-width: 280px; display: flex; flex-direction: column; justify-content: center; box-sizing: border-box;">
                            
                            <!-- Metadata Pill Row -->
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 0.85rem; flex-wrap: wrap;">
                                <span style="background: rgba(245, 158, 11, 0.12); border: 1px solid rgba(245, 158, 11, 0.4); color: #fbbf24; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em;">
                                    OFFICIAL 4K MUSIC VIDEO // PREMIERE
                                </span>
                                <span style="color: #94a3b8; font-size: 0.80rem; font-weight: 600;">October 2026</span>
                                <span style="color: #f6d365; font-size: 0.78rem; font-weight: 700;">4:10 DURATION</span>
                            </div>

                            <!-- Main Title -->
                            <h2 style="font-family: 'Outfit', sans-serif; font-size: clamp(1.4rem, 2.2vw, 1.95rem); font-weight: 900; line-height: 1.25; color: #ffffff; margin: 0 0 1rem 0; letter-spacing: -0.01em;">
                                The Zen Builder: 432Hz Sound Healing, Deep Focus &amp; Cellular Recovery Architecture
                            </h2>

                            <!-- Excerpt Write-up -->
                            <p style="font-size: clamp(0.90rem, 1.05vw, 1.0rem); color: #cbd5e1; line-height: 1.7; margin: 0 0 1.5rem 0;">
                                The flagship 432Hz restorative music release from <em>Architectural Focus</em>. Produced in Squamish, BC by Wayne Stevenson &mdash; combining deep analog basslines, 432Hz cellular recovery frequencies, and a structured narrative arc rendered in 4K resolution using Google Flow and DaVinci Resolve Studio.
                            </p>

                            <!-- Wayne Stevenson Author Signature & Credentials -->
                            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
                                <img decoding="async" src="https://keystonerecomposition.com/wp-content/uploads/2026/09/wayne_avatar.jpg" alt="Wayne Stevenson" style="width: 48px; height: 48px; border-radius: 50%; border: 2px solid #fbbf24; object-fit: cover; flex-shrink: 0; box-shadow: 0 0 12px rgba(245, 158, 11, 0.3);" />
                                <div>
                                    <div style="color: #ffffff; font-weight: 800; font-size: 0.92rem; line-height: 1.2;">Wayne Stevenson</div>
                                    <div style="color: #fbbf24; font-size: 0.78rem; font-weight: 600;">Music Producer &bull; Sovereign AI Architect &bull; Squamish, BC</div>
                                </div>
                            </div>

                            <!-- Action Buttons Box -->
                            <div style="display: flex; flex-direction: column; gap: 10px; max-width: 360px; width: 100%;">
                                <a href="https://keystonerecomposition.com/2026/10/08/zen-healing-frequency-432hz/" style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 42px; min-height: 42px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #04070d !important; -webkit-text-fill-color: #04070d !important; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 800; letter-spacing: 0.05em; padding: 0 20px; border-radius: 50px; text-decoration: none !important; box-shadow: 0 6px 20px rgba(245, 158, 11, 0.35); box-sizing: border-box; transition: all 0.25s ease;">
                                    <span>READ SONIC ESSAY &amp; CREDITS &rarr;</span>
                                </a>
                                <a href="https://youtu.be/1I1eLu9v_hM" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 42px; min-height: 42px; background: rgba(15, 23, 42, 0.90); border: 1.5px solid rgba(245, 158, 11, 0.45); color: #ffffff !important; -webkit-text-fill-color: #ffffff !important; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.04em; padding: 0 20px; border-radius: 50px; text-decoration: none !important; box-sizing: border-box; transition: all 0.25s ease;">
                                    <span>WATCH IN 4K ON YOUTUBE &rarr;</span>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- 2. DISCOGRAPHY CATALOG SECTION (EXACTLY 12 PER PAGE) -->
        <section class="sonic-catalog-section" id="sonicCatalogSection" style="margin-top: 50px;">
            <div class="ast-container">

                <!-- SECTION HEADER -->
                <div class="catalog-section-heading text-center" style="margin-bottom: 35px;">
                    <span class="section-tag-cyan">// CANONICAL DISCOGRAPHY</span>
                    <h2 class="section-title-luxury" style="color: #f8fafc; font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 800; margin-top: 6px;">
                        Master Catalog &amp; Streaming Vault
                    </h2>
                    <p style="color: #94a3b8; font-size: 0.90rem; max-width: 680px; margin: 8px auto 0;">
                        Click any release to open the interactive tracklist, stream directly via Spotify, and inspect canonical ISRC codes.
                    </p>
                </div>

                <!-- DISCOGRAPHY GRID (22 ALBUMS, 12 PER PAGE) -->
                <div class="discography-grid-18" id="sonicAlbumGrid">
                    <?php 
                    $card_index = 0;
                    foreach ( $albums as $album ) : 
                        $card_index++;
                        $page_num = ( $card_index <= 12 ) ? 1 : 2;
                        $display_style = ( $page_num === 1 ) ? 'display: flex;' : 'display: none;';
                        $album_id = isset( $album['id'] ) ? (string) $album['id'] : (string) $card_index;
                        $tracks_json = esc_attr( wp_json_encode( $album['tracks'] ?? array() ) );
                    ?>
                        <article class="album-card-18" 
                                 data-page="<?php echo esc_attr( (string) $page_num ); ?>" 
                                 data-album-id="<?php echo esc_attr( $album_id ); ?>"
                                 data-title="<?php echo esc_attr( $album['title'] ); ?>"
                                 data-upc="<?php echo esc_attr( $album['upc'] ); ?>"
                                 data-release-date="<?php echo esc_attr( $album['release_date'] ); ?>"
                                 data-genre="<?php echo esc_attr( $album['genre'] ); ?>"
                                 data-bpm="<?php echo esc_attr( (string) $album['bpm'] ); ?>"
                                 data-track-count="<?php echo esc_attr( (string) $album['track_count'] ); ?>"
                                 data-cover="<?php echo esc_url( $album['cover_image'] ); ?>"
                                 data-spotify="<?php echo esc_url( $album['spotify_url'] ); ?>"
                                 data-youtube="<?php echo esc_url( $album['youtube_url'] ); ?>"
                                 data-tracks="<?php echo $tracks_json; ?>"
                                 style="<?php echo esc_attr( $display_style ); ?> cursor: pointer;">
                            
                            <!-- 1:1 SQUARE ALBUM ARTWORK CONTAINER -->
                            <div class="album-card-art">
                                <img src="<?php echo esc_url( $album['cover_image'] ); ?>" 
                                     alt="<?php echo esc_attr( $album['title'] ); ?> 1:1 Album Artwork" 
                                     loading="lazy" 
                                     class="album-cover-img" />
                                <div class="album-art-badges">
                                    <span class="badge-year"><?php echo esc_html( substr( $album['release_date'], 0, 4 ) ); ?></span>
                                    <span class="badge-tracks"><?php echo esc_html( (string) $album['track_count'] ); ?> <?php echo ( (int) $album['track_count'] === 1 ) ? 'Track' : 'Tracks'; ?></span>
                                </div>
                                <div class="album-card-play-overlay">
                                    <span class="play-overlay-pill">▶ STREAM RELEASE</span>
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

                                <!-- DSP Quick Trigger -->
                                <div class="album-actions-bar">
                                    <button type="button" class="btn-open-album-modal" style="width: 100%;">
                                        ▶ Stream &amp; View Tracks (<?php echo esc_html( (string) $album['track_count'] ); ?>)
                                    </button>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- 3. QUIET LUXURY PAGINATION DOCK (EXACTLY 12 PER PAGE) -->
                <nav class="sonic-pagination-dock text-center" aria-label="Discography Pagination" style="margin-top: 45px; display: flex; justify-content: center; align-items: center; gap: 10px;">
                    <button type="button" class="sonic-page-nav-btn prev-btn" id="sonicPrevBtn" disabled aria-label="Previous Page">
                        &lsaquo; Previous
                    </button>
                    <div class="sonic-page-numbers" id="sonicPageNumbers" style="display: inline-flex; gap: 8px;">
                        <button type="button" class="sonic-page-num-btn active" data-page="1" aria-label="Page 1" aria-current="page">1</button>
                        <button type="button" class="sonic-page-num-btn" data-page="2" aria-label="Page 2">2</button>
                    </div>
                    <button type="button" class="sonic-page-nav-btn next-btn" id="sonicNextBtn" aria-label="Next Page">
                        Next &rsaquo;
                    </button>
                </nav>

                <div class="pagination-status-indicator text-center" style="margin-top: 12px; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #64748b;">
                    Showing <span id="paginationRangeText" style="color: #38bdf8;">1–12</span> of <?php echo esc_html( (string) $total_albums ); ?> Releases
                </div>

            </div>
        </section>

        <!-- 4. INTERACTIVE GLASSMORPHIC ALBUM PLAYER MODAL -->
        <div id="sonicAlbumModal" class="sonic-modal-backdrop" aria-hidden="true" style="display: none;">
            <div class="sonic-modal-container">
                <button type="button" class="sonic-modal-close" id="sonicModalCloseBtn" aria-label="Close Album Player">✕</button>

                <div class="sonic-modal-grid">
                    
                    <!-- LEFT DECK: ALBUM ARTWORK & METADATA -->
                    <div class="modal-left-deck">
                        <div class="modal-art-wrap">
                            <img id="modalAlbumCover" src="" alt="Album Artwork" class="modal-cover-img" />
                            <div class="modal-art-glow"></div>
                        </div>
                        <h3 id="modalAlbumTitle" class="modal-album-title">Album Title</h3>
                        <span id="modalAlbumGenre" class="modal-album-genre">Genre</span>
                        
                        <div class="modal-meta-grid">
                            <div class="modal-meta-item">
                                <span class="meta-label">BPM:</span>
                                <span id="modalAlbumBpm" class="meta-val">120</span>
                            </div>
                            <div class="modal-meta-item">
                                <span class="meta-label">RELEASE YEAR:</span>
                                <span id="modalAlbumYear" class="meta-val">2026</span>
                            </div>
                            <div class="modal-meta-item full-width">
                                <span class="meta-label">UPC BARCODE:</span>
                                <code id="modalAlbumUpc" class="modal-upc-val">000000000000</code>
                            </div>
                        </div>

                        <!-- DIRECT DSP OUTBOUND LINKS -->
                        <div class="modal-dsp-buttons">
                            <a id="modalSpotifyLink" href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="modal-btn spotify">
                                Open on Spotify OAC ↗
                            </a>
                            <a href="https://www.youtube.com/@KeyStoneRecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" class="modal-btn youtube">
                                Subscribe on YouTube ↗
                            </a>
                        </div>
                    </div>

                    <!-- RIGHT DECK: SPOTIFY WEB STREAM PLAYER & TRACKLIST -->
                    <div class="modal-right-deck">
                        <div class="modal-stream-header">
                            <span class="stream-live-tag">● WEB STREAMING HUB</span>
                            <span class="stream-note">Zero Upload • Direct DSP Playback</span>
                        </div>

                        <!-- EMBEDDED SPOTIFY WEB PLAYER (INSTANT IN-BROWSER STREAMING) -->
                        <div class="modal-spotify-embed-wrap" style="margin-bottom: 20px;">
                            <iframe id="modalSpotifyIframe" 
                                    src="https://open.spotify.com/embed/artist/52v3Qe6Jo0hg764driOl5Y?utm_source=generator&theme=0" 
                                    width="100%" 
                                    height="152" 
                                    frameBorder="0" 
                                    allowfullscreen="" 
                                    allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                                    loading="lazy" 
                                    style="border-radius: 12px;">
                            </iframe>
                        </div>

                        <!-- TRACKLIST ACCORDION & CANONICAL ISRCs -->
                        <div class="modal-tracklist-section">
                            <div class="tracklist-header-row">
                                <span class="th-title">Tracklist &amp; Registered ISRCs (<span id="modalTrackCount">10</span>)</span>
                                <span class="th-action">1-Click Copy</span>
                            </div>
                            <div class="modal-tracklist-scroll" id="modalTracklistScroll">
                                <ul class="modal-tracklist-ul" id="modalTracklistUl">
                                    <!-- Dynamic Track Items -->
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </main>
</div>

<!-- CLIENT-SIDE PAGINATION & MODAL SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Pagination State
    let currentPage = 1;
    const totalPages = 2;
    const cards = document.querySelectorAll('#sonicAlbumGrid .album-card-18');
    const prevBtn = document.getElementById('sonicPrevBtn');
    const nextBtn = document.getElementById('sonicNextBtn');
    const pageNumBtns = document.querySelectorAll('.sonic-page-num-btn');
    const rangeText = document.getElementById('paginationRangeText');
    const catalogSection = document.getElementById('sonicCatalogSection');

    function setPage(pageNum) {
        if (pageNum < 1 || pageNum > totalPages) return;
        currentPage = pageNum;

        // Show/Hide Cards
        cards.forEach(card => {
            const cardPage = parseInt(card.getAttribute('data-page'), 10);
            if (cardPage === currentPage) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });

        // Update Buttons
        pageNumBtns.forEach(btn => {
            const btnPage = parseInt(btn.getAttribute('data-page'), 10);
            if (btnPage === currentPage) {
                btn.classList.add('active');
                btn.setAttribute('aria-current', 'page');
            } else {
                btn.classList.remove('active');
                btn.removeAttribute('aria-current');
            }
        });

        // Nav Bounds
        prevBtn.disabled = (currentPage === 1);
        nextBtn.disabled = (currentPage === totalPages);

        // Range text
        if (currentPage === 1) {
            rangeText.textContent = '1–12';
        } else {
            rangeText.textContent = '13–<?php echo esc_js( (string) $total_albums ); ?>';
        }
    }

    pageNumBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const p = parseInt(btn.getAttribute('data-page'), 10);
            setPage(p);
            catalogSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            setPage(currentPage - 1);
            catalogSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
            setPage(currentPage + 1);
            catalogSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });

    // 2. Interactive Album Modal
    const modal = document.getElementById('sonicAlbumModal');
    const modalCloseBtn = document.getElementById('sonicModalCloseBtn');
    const modalCover = document.getElementById('modalAlbumCover');
    const modalTitle = document.getElementById('modalAlbumTitle');
    const modalGenre = document.getElementById('modalAlbumGenre');
    const modalBpm = document.getElementById('modalAlbumBpm');
    const modalYear = document.getElementById('modalAlbumYear');
    const modalUpc = document.getElementById('modalAlbumUpc');
    const modalTrackCount = document.getElementById('modalTrackCount');
    const modalSpotifyLink = document.getElementById('modalSpotifyLink');
    const modalSpotifyIframe = document.getElementById('modalSpotifyIframe');
    const modalTracklistUl = document.getElementById('modalTracklistUl');

    function openModalForCard(card) {
        const title = card.getAttribute('data-title');
        const upc = card.getAttribute('data-upc');
        const relDate = card.getAttribute('data-release-date');
        const genre = card.getAttribute('data-genre');
        const bpm = card.getAttribute('data-bpm');
        const count = card.getAttribute('data-track-count');
        const cover = card.getAttribute('data-cover');
        const spotify = card.getAttribute('data-spotify');
        let tracks = [];

        try {
            tracks = JSON.parse(card.getAttribute('data-tracks') || '[]');
        } catch (e) {
            tracks = [];
        }

        modalCover.src = cover;
        modalTitle.textContent = title;
        modalGenre.textContent = genre;
        modalBpm.textContent = bpm;
        modalYear.textContent = (relDate && relDate.length >= 4) ? relDate.substring(0, 4) : '2026';
        modalUpc.textContent = upc;
        modalTrackCount.textContent = count;
        modalSpotifyLink.href = spotify || 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y';

        // Render Tracklist
        modalTracklistUl.innerHTML = '';
        if (tracks.length > 0) {
            tracks.forEach(trk => {
                const li = document.createElement('li');
                li.className = 'modal-track-row';
                
                const pos = String(trk.pos || 1).padStart(2, '0');
                const isrc = trk.isrc || '';

                li.innerHTML = `
                    <div class="track-info-left">
                        <span class="track-index">${pos}</span>
                        <span class="track-name">${trk.title || 'Track'}</span>
                    </div>
                    <div class="track-info-right">
                        <code class="track-code">${isrc}</code>
                        <button type="button" class="btn-copy-isrc-modal" data-isrc="${isrc}" title="Copy ISRC">📋</button>
                    </div>
                `;
                modalTracklistUl.appendChild(li);
            });

            // Wire Copy Buttons
            modalTracklistUl.querySelectorAll('.btn-copy-isrc-modal').forEach(cBtn => {
                cBtn.addEventListener('click', (ev) => {
                    ev.stopPropagation();
                    const code = cBtn.getAttribute('data-isrc');
                    if (navigator.clipboard && code) {
                        navigator.clipboard.writeText(code).then(() => {
                            cBtn.textContent = '✔';
                            cBtn.style.color = '#38bdf8';
                            setTimeout(() => {
                                cBtn.textContent = '📋';
                                cBtn.style.color = '';
                            }, 1800);
                        });
                    }
                });
            });
        } else {
            modalTracklistUl.innerHTML = '<li class="modal-track-row" style="color: #64748b;">Canonical tracks synchronized via TooLost & Spotify OAC.</li>';
        }

        // Show Modal & Prevent Body Scroll
        modal.style.display = 'flex';
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    // Attach card click handlers
    cards.forEach(card => {
        card.addEventListener('click', (e) => {
            // If user clicked inside a direct link, allow default
            if (e.target.tagName.toLowerCase() === 'a') return;
            openModalForCard(card);
        });
    });

    modalCloseBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.style.display === 'flex') {
            closeModal();
        }
    });
});
</script>

<?php
get_footer();
