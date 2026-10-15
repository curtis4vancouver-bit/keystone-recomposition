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
                                <img decoding="async" src="<?php echo esc_url( $theme_uri . '/assets/images/wayne_avatar.jpg' ); ?>" alt="Wayne Stevenson" style="width: 48px; height: 48px; border-radius: 50%; border: 2px solid #fbbf24; object-fit: cover; flex-shrink: 0; box-shadow: 0 0 12px rgba(245, 158, 11, 0.3);" />
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
                <div class="catalog-section-heading text-center" style="margin-bottom: 28px;">
                    <span class="section-tag-cyan">// CANONICAL DISCOGRAPHY &amp; BIO-ACOUSTIC TELEMETRY</span>
                    <h2 class="section-title-luxury" style="color: #f8fafc; font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 800; margin-top: 6px;">
                        Master Catalog &amp; 432Hz Harmonic Music Graph
                    </h2>
                    <p style="color: #94a3b8; font-size: 0.92rem; max-width: 720px; margin: 8px auto 0;">
                        Inspect real-time 432Hz frequency harmonic telemetry across all devices, or click any of the 22 official releases below to launch the interactive tracklist and canonical ISRC vault.
                    </p>
                </div>

                <!-- SONIC UNIVERSE INTERACTIVE MULTI-DEVICE MUSIC GRAPH -->
                <div class="sonic-universe-graph-card" id="sonicUniverseGraphCard">
                    <div class="music-graph-toolbar" role="toolbar" aria-label="Sonic Universe Harmonic Graph Controls">
                        <div class="graph-mode-pills">
                            <button type="button" class="graph-mode-btn su-mode-btn active" data-su-mode="spectrum">SPECTRUM + WAVE</button>
                            <button type="button" class="graph-mode-btn su-mode-btn" data-su-mode="lattice">HARMONIC LATTICE</button>
                            <button type="button" class="graph-mode-btn su-mode-btn" data-su-mode="scope">OSCILLOSCOPE</button>
                        </div>
                        <div class="graph-preset-pills">
                            <button type="button" class="su-preset-chip active" data-bpm="115" data-profile="Sovereign Reverb • 432Hz Downtempo (115 BPM)" data-vault-idx="0">115 BPM • SOVEREIGN REVERB</button>
                            <button type="button" class="su-preset-chip" data-bpm="120" data-profile="Apollo Protocol • Progressive Melodic (120 BPM)" data-vault-idx="1">120 BPM • APOLLO PROTOCOL</button>
                            <button type="button" class="su-preset-chip" data-bpm="122" data-profile="Blue Collar Symphony • Deep House (122 BPM)" data-vault-idx="2">122 BPM • BLUE COLLAR SYMPHONY</button>
                            <button type="button" class="su-preset-chip" data-bpm="124" data-profile="The Long Game • Progressive Flow (124 BPM)" data-vault-idx="5">124 BPM • THE LONG GAME</button>
                        </div>
                    </div>
                    <div class="sonic-graph-canvas-wrap">
                        <canvas id="sonicUniverseVisualizer" width="960" height="220" title="Click or tap to trigger 432Hz Master Audio Stream"></canvas>
                        <div class="visualizer-hud-overlay">
                            <div class="track-info">
                                <span class="track-label">ACTIVE ACOUSTIC PROFILE:</span>
                                <span id="suActiveProfileLabel" class="track-name">Sovereign Reverb • 432Hz Downtempo (115 BPM)</span>
                            </div>
                            <div class="engine-state">
                                <button type="button" id="suGraphPlayTrigger" class="su-graph-play-pill">▶ STREAM 96KHZ MASTER</button>
                            </div>
                        </div>
                    </div>
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
                                     loading="<?php echo ( $card_index <= 6 ) ? 'eager' : 'lazy'; ?>" 
                                     decoding="async"
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
            const cardTitle = card.getAttribute('data-title') || 'Sovereign Reverb';
            const cardBpm = parseInt(card.getAttribute('data-bpm') || '115', 10) || 115;
            const cardGenre = card.getAttribute('data-genre') || '432Hz Master';
            if (window.setSonicUniverseProfile) {
                window.setSonicUniverseProfile(cardBpm, `${cardTitle} • ${cardGenre} (${cardBpm} BPM)`);
            }
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

    // =========================================================================
    // 60FPS HI-DPI MULTI-DEVICE SONIC UNIVERSE HARMONIC MUSIC GRAPH
    // =========================================================================
    const suCanvas = document.getElementById('sonicUniverseVisualizer');
    const suCtx = suCanvas ? suCanvas.getContext('2d') : null;
    const suProfileLabel = document.getElementById('suActiveProfileLabel');
    const suPlayTrigger = document.getElementById('suGraphPlayTrigger');
    let suMode = 'spectrum';
    let suBpm = 115;
    let suW = 960;
    let suH = 220;
    let suImpulse = 0;

    function syncSuCanvasSize() {
        if (!suCanvas || !suCtx) return;
        const rect = suCanvas.getBoundingClientRect();
        const w = Math.max(260, Math.floor(rect.width || 960));
        const h = Math.max(175, Math.floor(rect.height || 220));
        const dpr = Math.min(window.devicePixelRatio || 1, 2);
        if (suCanvas.width !== Math.floor(w * dpr) || suCanvas.height !== Math.floor(h * dpr)) {
            suCanvas.width = Math.floor(w * dpr);
            suCanvas.height = Math.floor(h * dpr);
        }
        suCtx.setTransform(dpr, 0, 0, dpr, 0, 0);
        suW = w;
        suH = h;
    }

    if (suCanvas && suCtx) {
        syncSuCanvasSize();
        window.addEventListener('resize', syncSuCanvasSize, { passive: true });
        if (typeof ResizeObserver !== 'undefined') {
            const suRo = new ResizeObserver(() => syncSuCanvasSize());
            suRo.observe(suCanvas);
        }

        window.setSonicUniverseProfile = function(bpm, label) {
            suBpm = bpm || 115;
            suImpulse = 1.15;
            if (suProfileLabel && label) suProfileLabel.textContent = label;
        };

        document.querySelectorAll('.su-mode-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                suMode = btn.getAttribute('data-su-mode') || 'spectrum';
                suImpulse = 1.0;
                document.querySelectorAll('.su-mode-btn').forEach(b => b.classList.toggle('active', b === btn));
            });
        });

        document.querySelectorAll('.su-preset-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                const bpm = parseInt(chip.getAttribute('data-bpm') || '115', 10);
                const prof = chip.getAttribute('data-profile') || '';
                const vIdx = parseInt(chip.getAttribute('data-vault-idx') || '0', 10);
                document.querySelectorAll('.su-preset-chip').forEach(c => c.classList.toggle('active', c === chip));
                window.setSonicUniverseProfile(bpm, prof);
                const vaultBtns = document.querySelectorAll('.kr-vault-chip');
                if (vaultBtns[vIdx]) vaultBtns[vIdx].click();
            });
        });

        function toggleVaultPlayback() {
            suImpulse = 1.25;
            const vaultPlayBtn = document.getElementById('krVaultPlayBtn');
            if (vaultPlayBtn) vaultPlayBtn.click();
        }

        suCanvas.style.cursor = 'pointer';
        suCanvas.addEventListener('click', toggleVaultPlayback);
        if (suPlayTrigger) suPlayTrigger.addEventListener('click', toggleVaultPlayback);

        const suBars = 52;
        const suPeaks = new Float32Array(suBars);
        const suFreqs = ['40Hz', '110Hz', '250Hz', '432Hz', '1.5kHz', '6kHz', '18kHz'];
        const suNodes = Array.from({ length: 30 }, (_, i) => ({
            nx: (i + 0.5) / 30,
            ny: 0.20 + (Math.sin(i * 1.61) * 0.5 + 0.5) * 0.56,
            vx: (i % 2 === 0 ? 1 : -1) * (0.0004 + (i % 5) * 0.0001),
            vy: (i % 3 === 0 ? 1 : -1) * (0.00035 + (i % 4) * 0.00009),
            r: 1.8 + (i % 3) * 0.7
        }));

        function renderSuGraph() {
            const W = suW;
            const H = suH;
            suCtx.clearRect(0, 0, W, H);
            const t = performance.now() * 0.001 * (suBpm / 115);
            if (suImpulse > 0.01) suImpulse *= 0.94;
            else suImpulse = 0;

            const vaultAudio = document.getElementById('kr-vault-audio');
            const isVaultPlaying = !!(vaultAudio && !vaultAudio.paused);
            if (suPlayTrigger) {
                suPlayTrigger.textContent = isVaultPlaying ? '⏸ STREAMING 96KHZ MASTER' : '▶ STREAM 96KHZ MASTER';
                suPlayTrigger.classList.toggle('active', isVaultPlaying);
            }

            // Grid
            suCtx.save();
            suCtx.strokeStyle = 'rgba(56, 189, 248, 0.08)';
            suCtx.lineWidth = 1;
            for (let r = 1; r < 4; r++) {
                const gy = Math.floor((H / 4) * r) + 0.5;
                suCtx.beginPath();
                suCtx.moveTo(0, gy);
                suCtx.lineTo(W, gy);
                suCtx.stroke();
            }
            suCtx.font = '600 9px "JetBrains Mono", monospace';
            suCtx.fillStyle = 'rgba(148, 163, 184, 0.55)';
            for (let c = 0; c < suFreqs.length; c++) {
                const gx = Math.floor((W / suFreqs.length) * c + (W / (suFreqs.length * 2)));
                suCtx.beginPath();
                suCtx.moveTo(gx, 14);
                suCtx.lineTo(gx, H - 30);
                suCtx.stroke();
                if (W > 360) suCtx.fillText(suFreqs[c], Math.max(6, gx - 14), 24);
            }
            suCtx.restore();

            const bins = new Float32Array(suBars);
            const mult = isVaultPlaying ? 1.18 : 0.90;
            for (let i = 0; i < suBars; i++) {
                const norm = i / (suBars - 1);
                const subBass = Math.exp(-Math.pow((norm - 0.16) / 0.15, 2)) * 0.54;
                const celloMid = Math.exp(-Math.pow((norm - 0.46) / 0.21, 2)) * 0.48;
                const airHigh = Math.exp(-Math.pow((norm - 0.79) / 0.17, 2)) * 0.35;
                const osc = Math.sin(t * 2.9 + i * 0.29) * 0.17 + Math.cos(t * 4.4 - i * 0.19) * 0.12;
                const v = Math.max(0.16, Math.min(0.92, (0.27 + subBass + celloMid + airHigh + osc) * mult + suImpulse * 0.22));
                bins[i] = v;
                suPeaks[i] = v > suPeaks[i] ? v : Math.max(v, suPeaks[i] - 0.0042);
            }

            const bottomY = H - 30;
            const maxSpan = Math.max(72, bottomY - 34);

            if (suMode === 'spectrum') {
                const bwFull = W / suBars;
                for (let i = 0; i < suBars; i++) {
                    const bh = bins[i] * maxSpan;
                    const x = i * bwFull;
                    const y = bottomY - bh;
                    const bw = Math.max(2, bwFull - (W < 500 ? 2 : 3.5));
                    const g = suCtx.createLinearGradient(0, y, 0, bottomY);
                    g.addColorStop(0, '#f6d365');
                    g.addColorStop(0.30, '#d4af37');
                    g.addColorStop(0.70, '#38bdf8');
                    g.addColorStop(1, 'rgba(56, 189, 248, 0.10)');
                    suCtx.fillStyle = g;
                    suCtx.fillRect(x + 1, y, bw, bh);

                    const py = bottomY - suPeaks[i] * maxSpan - 4;
                    suCtx.fillStyle = (i % 3 === 0) ? '#f6d365' : '#38bdf8';
                    suCtx.fillRect(x + 1, Math.max(18, py), bw, 2.2);
                }

                suCtx.save();
                suCtx.beginPath();
                for (let x = 0; x <= W; x += 6) {
                    const idx = Math.min(suBars - 1, Math.floor((x / W) * suBars));
                    const y = (H * 0.45) + Math.sin(x * 0.022 + t * 3.5) * 14 + Math.cos(x * 0.012 - t * 2.1) * ((bins[idx] - 0.35) * 30);
                    if (x === 0) suCtx.moveTo(x, y);
                    else suCtx.lineTo(x, y);
                }
                suCtx.strokeStyle = 'rgba(246, 211, 101, 0.88)';
                suCtx.lineWidth = 2.1;
                suCtx.shadowBlur = 10;
                suCtx.shadowColor = '#d4af37';
                suCtx.stroke();
                suCtx.restore();
            } else if (suMode === 'scope') {
                const midY = H * 0.48;
                for (let ch = 0; ch < 2; ch++) {
                    suCtx.save();
                    suCtx.beginPath();
                    for (let x = 0; x <= W; x += 4) {
                        const norm = x / W;
                        const idx = Math.min(suBars - 1, Math.floor(norm * suBars));
                        const env = Math.sin(norm * Math.PI) * (0.45 + bins[idx] * 0.78);
                        const ph = ch === 0 ? t * 4.1 : -t * 3.3 + 1.2;
                        const y = midY + (Math.sin(norm * 20 + ph) * 28 + Math.cos(norm * 39 - ph * 1.3) * 15) * env;
                        if (x === 0) suCtx.moveTo(x, y);
                        else suCtx.lineTo(x, y);
                    }
                    suCtx.strokeStyle = ch === 0 ? '#38bdf8' : '#d4af37';
                    suCtx.lineWidth = ch === 0 ? 2.6 : 2.0;
                    suCtx.shadowBlur = 12;
                    suCtx.shadowColor = ch === 0 ? '#38bdf8' : '#d4af37';
                    suCtx.stroke();
                    suCtx.restore();
                }
            } else {
                const cx = W * 0.5;
                const cy = H * 0.46;
                const maxR = Math.min(W, H) * 0.35;
                suCtx.save();
                for (let r = 1; r <= 3; r++) {
                    suCtx.beginPath();
                    suCtx.arc(cx, cy, (maxR / 3) * r + Math.sin(t * 2 + r) * 3, 0, Math.PI * 2);
                    suCtx.strokeStyle = r === 2 ? 'rgba(212, 175, 55, 0.34)' : 'rgba(56, 189, 248, 0.25)';
                    suCtx.lineWidth = 1.2;
                    suCtx.stroke();
                }
                for (let i = 0; i < suBars; i++) {
                    const ang = (i / suBars) * Math.PI * 2 + t * 0.32;
                    const r0 = maxR * 0.32;
                    const r1 = r0 + bins[i] * maxR * 0.85;
                    suCtx.beginPath();
                    suCtx.moveTo(cx + Math.cos(ang) * r0, cy + Math.sin(ang) * r0);
                    suCtx.lineTo(cx + Math.cos(ang) * r1, cy + Math.sin(ang) * r1);
                    suCtx.strokeStyle = (i % 2 === 0) ? '#38bdf8' : '#d4af37';
                    suCtx.lineWidth = 2;
                    suCtx.stroke();
                }
                suCtx.restore();
            }

            // Constellation Nodes
            suCtx.save();
            for (let i = 0; i < suNodes.length; i++) {
                const n = suNodes[i];
                n.nx += n.vx * (isVaultPlaying ? 1.4 : 0.95);
                n.ny += n.vy * (isVaultPlaying ? 1.4 : 0.95);
                if (n.nx < 0.03 || n.nx > 0.97) n.vx *= -1;
                if (n.ny < 0.14 || n.ny > 0.82) n.vy *= -1;
                const px = n.nx * W;
                const py = n.ny * H;
                for (let j = i + 1; j < suNodes.length; j++) {
                    const m = suNodes[j];
                    const ox = m.nx * W;
                    const oy = m.ny * H;
                    const dist = Math.hypot(ox - px, oy - py);
                    const lim = W < 500 ? 70 : 96;
                    if (dist < lim) {
                        const a = (1 - dist / lim) * 0.28;
                        suCtx.strokeStyle = (i % 3 === 0) ? `rgba(212,175,55,${a.toFixed(3)})` : `rgba(56,189,248,${a.toFixed(3)})`;
                        suCtx.beginPath();
                        suCtx.moveTo(px, py);
                        suCtx.lineTo(ox, oy);
                        suCtx.stroke();
                    }
                }
                suCtx.beginPath();
                suCtx.arc(px, py, n.r + bins[i % suBars] * 1.4, 0, Math.PI * 2);
                suCtx.fillStyle = (i % 4 === 0) ? '#f6d365' : '#38bdf8';
                suCtx.fill();
            }
            suCtx.restore();

            requestAnimationFrame(renderSuGraph);
        }
        renderSuGraph();
    }
});
</script>

<?php
get_footer();
