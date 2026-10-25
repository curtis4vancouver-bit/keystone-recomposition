<?php
/**
 * Template Name: Keystone Sonic Universe
 * Description: Master 22-Release Discography, Auto-Loaded 4K Music Video + 9:16 Short, 432Hz Harmonic Graph & Spotify Stream Hub
 * Version: 4.6.0 (PHP 8.2+ Strict Types — Clean Cover Art, Protected Catalog Metadata & Segmented Command Dock)
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

/**
 * Helper: Strip cross-promotional briefing blocks before extracting YouTube IDs.
 *
 * @param string $html Raw post HTML.
 * @return string
 */
function keystone_su_strip_cross_promo( string $html ): string {
    $markers = array(
        'Related Keystone Engineering Briefings',
        'New 2026 Keystone Engineering Briefing',
    );
    foreach ( $markers as $marker ) {
        $pos = stripos( $html, $marker );
        if ( false !== $pos ) {
            $html = substr( $html, 0, max( 0, $pos - 120 ) );
        }
    }
    return $html;
}

/**
 * Helper: Extract Long-Form (16:9 Top) and Short-Form (9:16 Bottom) YouTube IDs from a Music post.
 *
 * @param string $raw_html Post content HTML.
 * @return array{long: string|null, short: string|null}
 */
function keystone_su_extract_youtube_ids( string $raw_html ): array {
    $html        = keystone_su_strip_cross_promo( $raw_html );
    $retired_ids = array( '3rYyZ0c8_1o', 'XUiFyItyyzo' );
    $all_ids     = array();
    $short_id    = null;

    if ( preg_match( '/youtube(?:-nocookie)?\.com\/shorts\/([a-zA-Z0-9_-]{11})/i', $html, $sm ) ) {
        if ( ! empty( $sm[1] ) && ! in_array( $sm[1], $retired_ids, true ) ) {
            $short_id = $sm[1];
        }
    }

    if ( null === $short_id ) {
        $short_sec_pos = stripos( $html, 'field-companion-short' );
        if ( false !== $short_sec_pos ) {
            $short_sec_html = substr( $html, $short_sec_pos );
            if ( preg_match( '/(?:youtube(?:-nocookie)?\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i', $short_sec_html, $ssm ) ) {
                if ( ! empty( $ssm[1] ) && ! in_array( $ssm[1], $retired_ids, true ) ) {
                    $short_id = $ssm[1];
                }
            }
        }
    }

    if ( preg_match_all( '/(?:youtube(?:-nocookie)?\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i', $html, $matches ) ) {
        foreach ( $matches[1] as $vid ) {
            if ( ! empty( $vid ) && ! in_array( $vid, $retired_ids, true ) && ! in_array( $vid, $all_ids, true ) ) {
                $all_ids[] = $vid;
            }
        }
    }

    $long_id = null;
    foreach ( $all_ids as $candidate ) {
        if ( $candidate !== $short_id ) {
            $long_id = $candidate;
            break;
        }
    }
    if ( null === $long_id && ! empty( $all_ids ) ) {
        $long_id = $all_ids[0];
    }
    if ( null === $short_id && count( $all_ids ) > 1 ) {
        foreach ( $all_ids as $candidate ) {
            if ( $candidate !== $long_id ) {
                $short_id = $candidate;
                break;
            }
        }
    }

    return array(
        'long'  => $long_id,
        'short' => $short_id,
    );
}

/**
 * Helper: Clean excerpt without internal codes or UPC/ISRC strings.
 *
 * @param string $raw_excerpt Raw excerpt or content.
 * @param int    $max_chars   Max length.
 * @return string
 */
function keystone_su_clean_excerpt( string $raw_excerpt, int $max_chars = 240 ): string {
    $text = wp_strip_all_tags( html_entity_decode( $raw_excerpt, ENT_QUOTES | ENT_HTML5, 'UTF-8' ) );
    $text = (string) preg_replace( '/\[.*?\]/', '', $text );
    $text = (string) preg_replace( '/\s*\(?ISRC:?\s*[A-Z0-9]{8,15}\)?/i', '', $text );
    $text = (string) preg_replace( '/\s*\(?UPC:?\s*[0-9]{8,15}\)?/i', '', $text );
    $text = (string) preg_replace( '/Related Keystone Engineering Briefings[\s\S]*/i', '', $text );
    $text = (string) preg_replace( '/New 2026 Keystone Engineering Briefing[\s\S]*/i', '', $text );
    $text = (string) preg_replace( '/^\/\/\s*2026[^\n\r.]*[\n\r.]*\s*/i', '', $text );
    $text = (string) preg_replace( '/^\/\/\s*[A-Z0-9 _•&\/:-]{6,85}\s*/i', '', $text );
    $text = trim( (string) preg_replace( '/\s+/', ' ', $text ) );
    if ( strlen( $text ) > $max_chars ) {
        $text = rtrim( substr( $text, 0, $max_chars ) ) . '...';
    }
    return $text;
}

// Server-side auto-discovery of the newest published Music release (Cat 1442 or music post)
$su_recent_posts = get_posts(
    array(
        'numberposts' => 16,
        'post_status' => 'publish',
        'orderby'     => 'date',
        'order'       => 'DESC',
    )
);

$su_feat_title       = 'Heavy Civil Focus Keystone Recomposition: Official 4K Somatic Deep House Release (2026)';
$su_feat_excerpt     = 'Engineered in Squamish, BC by Wayne Stevenson — uniting 122 BPM warm analog sub-bass foundations with expressive solo cello phrasing and a continuous 4K visual film assembled in DaVinci Resolve Studio.';
$su_feat_link        = home_url( '/2026/10/23/heavy-civil-focus-keystone-recomposition/' );
$su_feat_date        = 'October 2026';
$su_feat_long_id     = 'nKx8DiB_heM';
$su_feat_short_id    = '9Aa98IGWKpU';
$su_feat_short_title = 'Heavy Civil Focus — 9:16 Somatic Short';
$su_feat_short_desc  = '24-Bit / 48kHz Lossless Somatic Deep House & Solo Cello Vertical Drop • Too Lost Digital Distribution';

$su_matched_post   = null;
$su_fallback_short = '9Aa98IGWKpU';

foreach ( $su_recent_posts as $su_p ) {
    if ( ! ( $su_p instanceof WP_Post ) ) {
        continue;
    }
    $cats  = wp_get_post_categories( $su_p->ID );
    $slug  = strtolower( (string) $su_p->post_name );
    $title = strtolower( (string) $su_p->post_title );
    $is_music = ( in_array( 1442, $cats, true ) && ! in_array( 1538, $cats, true ) )
        || str_contains( $slug, 'iron-grace' )
        || str_contains( $slug, 'sovereign-reverb' )
        || str_contains( $slug, 'heavy-civil-focus' )
        || str_contains( $slug, 'peak-intensity' )
        || str_contains( $title, 'somatic deep house' )
        || str_contains( $title, 'official 4k music video' );

    if ( $is_music ) {
        $ids = keystone_su_extract_youtube_ids( (string) $su_p->post_content );
        if ( ! empty( $ids['short'] ) && '9Aa98IGWKpU' === $su_fallback_short ) {
            $su_fallback_short = $ids['short'];
        }
        if ( null === $su_matched_post && ! empty( $ids['long'] ) ) {
            $su_matched_post = $su_p;
        }
    }
}

if ( $su_matched_post instanceof WP_Post ) {
    $su_feat_title = html_entity_decode( wp_strip_all_tags( get_the_title( $su_matched_post ) ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
    $raw_ex        = ! empty( $su_matched_post->post_excerpt ) ? (string) $su_matched_post->post_excerpt : (string) $su_matched_post->post_content;
    $clean_ex      = keystone_su_clean_excerpt( $raw_ex, 240 );
    if ( strlen( $clean_ex ) > 45 && ! str_ends_with( $clean_ex, 'engin' ) && preg_match( '/[.!?…]$/u', $clean_ex ) ) {
        $su_feat_excerpt = $clean_ex;
    }
    $su_feat_link = (string) get_permalink( $su_matched_post );
    $su_feat_date = (string) get_the_date( 'F Y', $su_matched_post );

    $su_ids = keystone_su_extract_youtube_ids( (string) $su_matched_post->post_content );
    if ( ! empty( $su_ids['long'] ) ) {
        $su_feat_long_id = $su_ids['long'];
    }
    if ( ! empty( $su_ids['short'] ) ) {
        $su_feat_short_id = $su_ids['short'];
    } else {
        $su_feat_short_id = $su_fallback_short;
    }

    $su_parts            = explode( ':', $su_feat_title );
    $su_prefix           = trim( str_ireplace( 'Keystone Recomposition', '', $su_parts[0] ) );
    $su_feat_short_title = $su_prefix . ' — 9:16 Somatic Short';
}
?>

<div id="primary" class="content-area primary keystone-sonic-universe-page">
    <main id="main" class="site-main">

        <!-- 1. HERO HEADER SECTION -->
        <section class="sonic-hero-section">
            <div class="ast-container">
                <header class="sonic-header text-center">
                    
                    <!-- HIGH-END LABEL PEDIGREE BADGE -->
                    <div class="gold-badge-pill ks-p3-pill-gold" style="margin-bottom: 18px; padding: 6px 18px; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.08em;">
                        <span class="ks-wave-text">// OFFICIAL ARTIST CHANNEL &bull; TOO LOST DIGITAL DISTRIBUTION</span>
                    </div>
                    
                    <h1 class="sonic-hero-title">The Sonic Universe:<br><span class="cyan-gold-gradient-text">22 Official Releases</span></h1>
                    
                    <p class="page-subtitle">
                        Original electronic compositions, melodic progressive house, and somatic frequency soundscapes produced in Squamish, BC by Wayne Stevenson. Stream <?php echo esc_html( (string) $total_tracks ); ?> studio master tracks across <?php echo esc_html( (string) $studio_count ); ?> studio albums and 2 singles on Spotify, Apple Music, and YouTube.
                    </p>

                    <!-- HIGH-END STREAMING & SUBSCRIBE ACTION BAR (4 Equal Parallel Pure-Black Wave Buttons) -->
                    <div class="header-dsp-links su-dsp-action-grid">
                        <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="dsp-pill ks-p3-btn-gold su-dsp-btn" title="Follow on Spotify">
                            <span class="ks-wave-text">🎧 Follow on Spotify OAC</span>
                        </a>
                        <a href="https://music.apple.com/search?term=Keystone%20Recomposition" target="_blank" rel="noopener noreferrer" class="dsp-pill ks-p3-btn-blue su-dsp-btn" title="Stream on Apple Music">
                            <span class="ks-wave-text">🍎 Apple Music</span>
                        </a>
                        <a href="https://music.youtube.com/search?q=Keystone+Recomposition" target="_blank" rel="noopener noreferrer" class="dsp-pill ks-p3-btn-blue su-dsp-btn" title="Stream on YouTube Music">
                            <span class="ks-wave-text">🎵 YouTube Music</span>
                        </a>
                        <a href="https://www.youtube.com/@KeyStoneRecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" class="dsp-pill ks-p3-btn-gold su-dsp-btn" title="1-Click Subscribe to @KeyStoneRecomposition on YouTube">
                            <span class="ks-wave-text">🔔 Subscribe on YouTube</span>
                        </a>
                    </div>

                    <!-- STUDIO AUDIO BANNER FRAME (WAYNE'S SYNTHESIZER PHOTO) -->
                    <div class="hero-banner-frame" style="margin-top: 36px;">
                        <img src="<?php echo esc_url( $theme_uri . '/assets/images/sonic_universe_banner.png' ); ?>" 
                             alt="Keystone Recomposition 22-Release Sonic Universe Studio Banner" 
                             class="hero-banner-image" 
                             fetchpriority="high" />
                        <div class="banner-glass-reflection"></div>
                    </div>
                </header>
            </div>
        </section>

        <!-- 1B. OFFICIAL 4K MUSIC VIDEO & 9:16 SHORT FEATURED SECTION (AUTO-LOADS LATEST RELEASE) -->
        <section class="sonic-featured-video-section" style="margin-top: 42px; margin-bottom: 24px;">
            <div class="ast-container">
                <div id="su-featured-sound-container" class="recomp-featured-hero-wrap recomp-hero-gold" style="margin-bottom: 0;">
                    <div class="recomp-featured-layout">
                        
                        <!-- Left Column (55%): Master 16:9 4K Long-Form Video (Top) + Companion 9:16 Short Deck (Bottom) -->
                        <div class="recomp-featured-left-col">
                            
                            <!-- 16:9 Master Long-Form Video Frame (Top) -->
                            <div class="recomp-featured-video-frame recomp-frame-gold">
                                <iframe id="su-featured-long-video" 
                                        src="<?php echo esc_url( 'https://www.youtube.com/embed/' . $su_feat_long_id . '?rel=0' ); ?>" 
                                        title="<?php echo esc_attr( $su_feat_title ); ?>" 
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen></iframe>
                            </div>

                            <!-- 9:16 Companion Short & Audio Streaming Deck (Bottom) -->
                            <div class="recomp-featured-short-deck recomp-short-deck-gold">
                                
                                <!-- 9:16 Vertical Short Player Box -->
                                <div class="recomp-featured-short-player-box recomp-short-box-gold">
                                    <iframe id="su-featured-short-video" 
                                            src="<?php echo esc_url( 'https://www.youtube.com/embed/' . $su_feat_short_id . '?rel=0' ); ?>" 
                                            title="<?php echo esc_attr( $su_feat_short_title ); ?>" 
                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                            allowfullscreen></iframe>
                                </div>

                                <!-- Track Details & Audio Meta -->
                                <div class="recomp-featured-short-details">
                                    <div id="su-featured-short-kicker" class="ks-p3-pill-gold recomp-short-kicker-pill">
                                        <span class="ks-wave-text">🎵 24-BIT / 48kHz MASTER &bull; VERIFIED OAC</span>
                                    </div>
                                    <h4 id="su-featured-short-title" class="recomp-featured-short-title">
                                        <?php echo esc_html( $su_feat_short_title ); ?>
                                    </h4>
                                    <p id="su-featured-short-desc" class="recomp-featured-short-desc">
                                        <?php echo esc_html( $su_feat_short_desc ); ?>
                                    </p>
                                    <div class="recomp-featured-short-actions">
                                        <a id="su-featured-short-link" href="<?php echo esc_url( 'https://youtube.com/shorts/' . $su_feat_short_id ); ?>" target="_blank" rel="noopener noreferrer" class="ks-p3-btn-gold recomp-short-action-btn">
                                            <span class="ks-wave-text">▶ 9:16 Short</span>
                                        </a>
                                        <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="ks-p3-btn-gold recomp-short-action-btn">
                                            <span class="ks-wave-text">🎧 Spotify OAC</span>
                                        </a>
                                        <a href="https://www.youtube.com/@KeyStoneRecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" class="ks-p3-btn-blue recomp-short-action-btn">
                                            <span class="ks-wave-text">🔔 Subscribe</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right Column (45%): Sonic Architecture Write-up (Leveled in Parallel with Left Column) -->
                        <div class="recomp-featured-content-wrap">
                            
                            <div class="recomp-featured-top-body">
                                <!-- Metadata Pill Row -->
                                <div class="recomp-featured-meta-row">
                                    <span class="recomp-cat-badge ks-p3-pill-gold">
                                        <span class="ks-wave-text">OFFICIAL 4K MUSIC VIDEO // LATEST PREMIERE</span>
                                    </span>
                                    <span id="su-featured-date" class="recomp-meta-date"><?php echo esc_html( $su_feat_date ); ?></span>
                                    <span class="ks-p3-pill-blue recomp-meta-read-pill">
                                        <span class="ks-wave-text">4K STUDIO MASTER</span>
                                    </span>
                                </div>

                                <!-- Main Title -->
                                <h2 id="su-featured-title" class="recomp-featured-h2">
                                    <?php echo esc_html( $su_feat_title ); ?>
                                </h2>

                                <!-- Excerpt Write-up -->
                                <p id="su-featured-excerpt" class="recomp-featured-excerpt">
                                    <?php echo esc_html( $su_feat_excerpt ); ?>
                                </p>
                            </div>

                            <div class="recomp-featured-bottom-footer">
                                <!-- Wayne Stevenson Author Signature & Credentials -->
                                <div class="recomp-author-row">
                                    <img loading="eager" fetchpriority="high" decoding="async" src="<?php echo esc_url( $theme_uri . '/assets/images/wayne_avatar.jpg' ); ?>" alt="Wayne Stevenson" class="recomp-author-avatar recomp-avatar-gold" />
                                    <div>
                                        <div class="recomp-author-name">Wayne Stevenson</div>
                                        <div class="recomp-author-role recomp-role-gold">Music Producer &bull; Sovereign AI Architect &bull; Squamish, BC</div>
                                    </div>
                                </div>

                                <!-- Action Buttons Box (Full Width Parallel Stack) -->
                                <div class="recomp-featured-buttons-box">
                                    <a id="su-featured-link" href="<?php echo esc_url( $su_feat_link ); ?>" class="ks-p3-btn-gold recomp-hero-cta-btn">
                                        <span class="ks-wave-text">READ SONIC ESSAY &amp; CREDITS &rarr;</span>
                                    </a>
                                    <a id="su-featured-yt-btn" href="<?php echo esc_url( 'https://youtu.be/' . $su_feat_long_id ); ?>" target="_blank" rel="noopener noreferrer" class="ks-p3-btn-blue recomp-hero-cta-btn">
                                        <span class="ks-wave-text">WATCH IN 4K ON YOUTUBE &rarr;</span>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- 2. DISCOGRAPHY CATALOG SECTION (EXACTLY 12 PER PAGE) -->
        <section class="sonic-catalog-section" id="sonicCatalogSection" style="margin-top: 44px;">
            <div class="ast-container">

                <!-- SECTION HEADER -->
                <div class="catalog-section-heading text-center" style="margin-bottom: 28px;">
                    <span class="section-tag-cyan ks-p3-pill-blue" style="padding: 5px 14px; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.08em; margin-bottom: 10px;">
                        <span class="ks-wave-text">// CANONICAL DISCOGRAPHY &amp; BIO-ACOUSTIC TELEMETRY</span>
                    </span>
                    <h2 class="section-title-luxury" style="color: #f8fafc; font-family: 'Outfit', sans-serif; font-size: 1.85rem; font-weight: 900; margin-top: 8px;">
                        Master Catalog &amp; 432Hz Harmonic Music Graph
                    </h2>
                    <p style="color: #cbd5e1; font-size: 0.94rem; max-width: 740px; margin: 8px auto 0; line-height: 1.65;">
                        Inspect real-time 432Hz frequency harmonic telemetry across all devices, or select any of the 22 official releases below to launch the interactive Spotify web player and full album tracklist.
                    </p>
                </div>

                <!-- SONIC UNIVERSE INTERACTIVE MULTI-DEVICE MUSIC GRAPH -->
                <div class="sonic-universe-graph-card" id="sonicUniverseGraphCard">
                    <div class="music-graph-toolbar" role="toolbar" aria-label="Sonic Universe Harmonic Graph Controls">
                        <div class="graph-mode-pills">
                            <button type="button" class="graph-mode-btn su-mode-btn active ks-p3-btn-gold" data-su-mode="spectrum"><span class="ks-wave-text">SPECTRUM + WAVE</span></button>
                            <button type="button" class="graph-mode-btn su-mode-btn ks-p3-btn-blue" data-su-mode="lattice"><span class="ks-wave-text">HARMONIC LATTICE</span></button>
                            <button type="button" class="graph-mode-btn su-mode-btn ks-p3-btn-blue" data-su-mode="scope"><span class="ks-wave-text">OSCILLOSCOPE</span></button>
                        </div>
                        <div class="graph-preset-pills">
                            <button type="button" class="su-preset-chip active ks-p3-btn-gold" data-bpm="115" data-profile="Sovereign Reverb • 432Hz Downtempo (115 BPM)" data-vault-idx="0"><span class="ks-wave-text">115 BPM • SOVEREIGN REVERB</span></button>
                            <button type="button" class="su-preset-chip ks-p3-btn-blue" data-bpm="120" data-profile="Apollo Protocol • Progressive Melodic (120 BPM)" data-vault-idx="1"><span class="ks-wave-text">120 BPM • APOLLO PROTOCOL</span></button>
                            <button type="button" class="su-preset-chip ks-p3-btn-blue" data-bpm="122" data-profile="Blue Collar Symphony • Deep House (122 BPM)" data-vault-idx="2"><span class="ks-wave-text">122 BPM • BLUE COLLAR SYMPHONY</span></button>
                            <button type="button" class="su-preset-chip ks-p3-btn-blue" data-bpm="124" data-profile="The Long Game • Progressive Flow (124 BPM)" data-vault-idx="5"><span class="ks-wave-text">124 BPM • THE LONG GAME</span></button>
                        </div>
                    </div>
                    <div class="sonic-graph-canvas-wrap">
                        <canvas id="sonicUniverseVisualizer" width="960" height="220" title="Click or tap to trigger 432Hz Master Audio Stream"></canvas>
                        <div class="visualizer-hud-overlay">
                            <div class="track-info">
                                <span class="track-label" style="color: #94a3b8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">ACTIVE ACOUSTIC PROFILE:</span>
                                <span id="suActiveProfileLabel" class="track-name" style="color: #ffffff; font-family: 'Outfit', sans-serif; font-weight: 800;">Sovereign Reverb • 432Hz Downtempo (115 BPM)</span>
                            </div>
                            <div class="engine-state">
                                <button type="button" id="suGraphPlayTrigger" class="su-graph-play-pill ks-p3-btn-gold"><span class="ks-wave-text">▶ STREAM 96KHZ MASTER</span></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOP ARCHIVE HEADER & SEGMENTED COMMAND DOCK PAGINATION -->
                <div class="recomp-grid-header-row su-catalog-header-row" style="margin-top: 36px;">
                    <div class="recomp-grid-header-titles">
                        <div class="recomp-grid-kicker">
                            ✦ OFFICIAL DISCOGRAPHY &bull; 12 RELEASES PER VIEW
                        </div>
                        <h3 class="recomp-grid-heading">
                            22-Release Studio Master Catalog
                        </h3>
                    </div>

                    <div class="recomp-grid-controls-top">
                        <span id="su-grid-page-indicator" class="ks-p3-pill-blue recomp-page-telemetry-pill">
                            <span class="ks-wave-text">PAGE 01 OF 02 &bull; RELEASES 01–12 OF <?php echo esc_html( (string) $total_albums ); ?></span>
                        </span>
                        <div class="recomp-command-dock recomp-dock-top" role="navigation" aria-label="Discography Pagination Top">
                            <button type="button" id="suTopPrevBtn" class="recomp-dock-btn recomp-dock-nav ks-p3-btn-blue" aria-label="Previous Page">
                                <span class="ks-wave-text">&#10094; PREV</span>
                            </button>
                            <button type="button" id="suTopPage1Btn" data-page="1" class="recomp-dock-btn recomp-dock-page sonic-page-num-btn is-active ks-p3-btn-gold">
                                <span class="ks-wave-text">● PAGE 01</span>
                            </button>
                            <button type="button" id="suTopPage2Btn" data-page="2" class="recomp-dock-btn recomp-dock-page sonic-page-num-btn ks-p3-btn-blue">
                                <span class="ks-wave-text">○ PAGE 02</span>
                            </button>
                            <button type="button" id="suTopNextBtn" class="recomp-dock-btn recomp-dock-nav ks-p3-btn-blue" aria-label="Next Page">
                                <span class="ks-wave-text">NEXT &#10095;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- DISCOGRAPHY GRID (22 ALBUMS, 12 PER PAGE — 100% CLEAN COVER ART & ZERO EXPOSED UPCs) -->
                <div class="discography-grid-18" id="sonicAlbumGrid">
                    <?php 
                    $card_index = 0;
                    foreach ( $albums as $album ) : 
                        $card_index++;
                        $page_num      = ( $card_index <= 12 ) ? 1 : 2;
                        $display_style = ( 1 === $page_num ) ? 'display: flex;' : 'display: none;';
                        $album_id      = isset( $album['id'] ) ? (string) $album['id'] : (string) $card_index;
                        $album_slug    = sanitize_title( $album['title'] ?? 'album-' . $card_index );
                        $release_year  = substr( (string) ( $album['release_date'] ?? '2026' ), 0, 4 );
                        $track_count   = (int) ( $album['track_count'] ?? 10 );
                        $track_label   = $track_count . ' ' . ( 1 === $track_count ? 'TRACK' : 'TRACKS' );

                        // Strip raw ISRC strings before encoding tracks for frontend DOM so nobody can scrape/copy them
                        $safe_tracks = array();
                        if ( ! empty( $album['tracks'] ) && is_array( $album['tracks'] ) ) {
                            foreach ( $album['tracks'] as $t_item ) {
                                $safe_tracks[] = array(
                                    'pos'   => $t_item['pos'] ?? 1,
                                    'title' => $t_item['title'] ?? 'Track',
                                );
                            }
                        }
                        $tracks_json = esc_attr( (string) wp_json_encode( $safe_tracks ) );
                    ?>
                        <article id="<?php echo esc_attr( $album_slug ); ?>"
                                 class="album-card-18 su-clean-album-card" 
                                 data-page="<?php echo esc_attr( (string) $page_num ); ?>" 
                                 data-album-id="<?php echo esc_attr( $album_id ); ?>"
                                 data-title="<?php echo esc_attr( $album['title'] ); ?>"
                                 data-release-date="<?php echo esc_attr( $album['release_date'] ); ?>"
                                 data-genre="<?php echo esc_attr( $album['genre'] ); ?>"
                                 data-bpm="<?php echo esc_attr( (string) $album['bpm'] ); ?>"
                                 data-track-count="<?php echo esc_attr( (string) $track_count ); ?>"
                                 data-cover="<?php echo esc_url( $album['cover_image'] ); ?>"
                                 data-spotify="<?php echo esc_url( $album['spotify_url'] ); ?>"
                                 data-youtube="<?php echo esc_url( $album['youtube_url'] ); ?>"
                                 data-tracks="<?php echo $tracks_json; ?>"
                                 style="<?php echo esc_attr( $display_style ); ?> cursor: pointer;">
                            
                            <!-- 1:1 SQUARE ALBUM ARTWORK CONTAINER (100% CLEAN UNOBSTRUCTED COVER PHOTO — ZERO TOP BADGES OR OVERLAYS) -->
                            <div class="album-card-art su-clean-art-frame">
                                <img src="<?php echo esc_url( $album['cover_image'] ); ?>" 
                                     alt="<?php echo esc_attr( $album['title'] ); ?> 1:1 Album Artwork" 
                                     loading="<?php echo ( $card_index <= 12 ) ? 'eager' : 'lazy'; ?>" 
                                     fetchpriority="<?php echo ( $card_index <= 6 ) ? 'high' : 'auto'; ?>"
                                     decoding="async"
                                     class="album-cover-img" />
                            </div>

                            <div class="album-card-details su-clean-card-body">
                                <div class="su-card-top-info">
                                    <div class="su-genre-year-row">
                                        <span class="album-genre-tag ks-p3-pill-blue su-genre-pill">
                                            <span class="ks-wave-text"><?php echo esc_html( $album['genre'] ); ?></span>
                                        </span>
                                        <span class="su-release-year-label"><?php echo esc_html( $release_year ); ?></span>
                                    </div>
                                    <h3 class="album-title su-clean-album-title"><?php echo esc_html( $album['title'] ); ?></h3>
                                </div>

                                <div class="su-card-bottom-footer">
                                    <!-- Metadata Row: BPM & Track Count (Zero Exposed UPC Barcode) -->
                                    <div class="album-metadata-row su-clean-meta-row">
                                        <span class="ks-p3-pill-blue su-meta-chip">
                                            <span class="ks-wave-text"><?php echo esc_html( (string) $album['bpm'] ); ?> BPM</span>
                                        </span>
                                        <span class="ks-p3-pill-gold su-meta-chip">
                                            <span class="ks-wave-text"><?php echo esc_html( $track_label ); ?> &bull; 24-BIT</span>
                                        </span>
                                    </div>

                                    <!-- Full-Width Pure-Black Wave Button -->
                                    <div class="album-actions-bar">
                                        <button type="button" class="btn-open-album-modal ks-p3-btn-blue su-stream-card-btn">
                                            <span class="ks-wave-text">▶ Stream &amp; View Tracks (<?php echo esc_html( (string) $track_count ); ?>)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- 3. HIGH-END BOTTOM CENTERED SEGMENTED COMMAND DOCK PAGINATION -->
                <div class="recomp-pagination-bottom su-pagination-bottom-wrap">
                    <div class="recomp-command-dock recomp-dock-bottom" role="navigation" aria-label="Discography Pagination Bottom">
                        <button type="button" class="recomp-dock-btn recomp-dock-bottom-btn ks-p3-btn-blue" id="sonicPrevBtn" aria-label="Previous Page">
                            <span class="ks-wave-text">&#10094; PREVIOUS PAGE</span>
                        </button>
                        <button type="button" class="recomp-dock-btn recomp-dock-bottom-btn sonic-page-num-btn is-active ks-p3-btn-gold" id="suBottomPage1Btn" data-page="1" aria-label="Page 1" aria-current="page">
                            <span class="ks-wave-text">● PAGE 01</span>
                        </button>
                        <button type="button" class="recomp-dock-btn recomp-dock-bottom-btn sonic-page-num-btn ks-p3-btn-blue" id="suBottomPage2Btn" data-page="2" aria-label="Page 2">
                            <span class="ks-wave-text">○ PAGE 02</span>
                        </button>
                        <button type="button" class="recomp-dock-btn recomp-dock-bottom-btn ks-p3-btn-blue" id="sonicNextBtn" aria-label="Next Page">
                            <span class="ks-wave-text">NEXT PAGE &#10095;</span>
                        </button>
                    </div>
                </div>

            </div>
        </section>

        <!-- 4. INTERACTIVE GLASSMORPHIC ALBUM PLAYER MODAL (PROTECTED METADATA — ZERO EXPOSED UPC/ISRC) -->
        <div id="sonicAlbumModal" class="sonic-modal-backdrop" aria-hidden="true" style="display: none;">
            <div class="sonic-modal-container">
                <button type="button" class="sonic-modal-close ks-p3-btn-blue" id="sonicModalCloseBtn" aria-label="Close Album Player"><span class="ks-wave-text">✕</span></button>

                <div class="sonic-modal-grid">
                    
                    <!-- LEFT DECK: ALBUM ARTWORK & METADATA -->
                    <div class="modal-left-deck">
                        <div class="modal-art-wrap">
                            <img id="modalAlbumCover" src="<?php echo esc_url( $theme_uri . '/assets/images/albums/sovereign_reverb.jpg' ); ?>" alt="Album Artwork" class="modal-cover-img" />
                            <div class="modal-art-glow"></div>
                        </div>
                        <h3 id="modalAlbumTitle" class="modal-album-title">Album Title</h3>
                        <span id="modalAlbumGenre" class="modal-album-genre">Genre</span>
                        
                        <div class="modal-meta-grid">
                            <div class="modal-meta-item">
                                <span class="meta-label">TEMPO:</span>
                                <span id="modalAlbumBpm" class="meta-val">120 BPM</span>
                            </div>
                            <div class="modal-meta-item">
                                <span class="meta-label">RELEASE YEAR:</span>
                                <span id="modalAlbumYear" class="meta-val">2026</span>
                            </div>
                            <div class="modal-meta-item full-width">
                                <span class="meta-label">DISTRIBUTION RIGHTS:</span>
                                <span class="modal-upc-val" style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.76rem; font-weight: 800;">VERIFIED TOO LOST OAC &bull; ALL RIGHTS RESERVED</span>
                            </div>
                        </div>

                        <!-- DIRECT DSP OUTBOUND LINKS -->
                        <div class="modal-dsp-buttons">
                            <a id="modalSpotifyLink" href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="modal-btn spotify ks-p3-btn-gold" style="width: 100%; min-height: 44px; text-decoration: none;">
                                <span class="ks-wave-text">Open on Spotify OAC ↗</span>
                            </a>
                            <a href="https://www.youtube.com/@KeyStoneRecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" class="modal-btn youtube ks-p3-btn-blue" style="width: 100%; min-height: 44px; text-decoration: none;">
                                <span class="ks-wave-text">Subscribe on YouTube ↗</span>
                            </a>
                        </div>
                    </div>

                    <!-- RIGHT DECK: SPOTIFY WEB STREAM PLAYER & TRACKLIST -->
                    <div class="modal-right-deck">
                        <div class="modal-stream-header">
                            <span class="stream-live-tag ks-p3-pill-gold" style="padding: 4px 12px; font-size: 0.70rem;"><span class="ks-wave-text">● WEB STREAMING HUB</span></span>
                            <span class="stream-note">24-Bit Studio Master • Direct DSP Playback</span>
                        </div>

                        <!-- EMBEDDED SPOTIFY WEB PLAYER -->
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

                        <!-- TRACKLIST ACCORDION -->
                        <div class="modal-tracklist-section">
                            <div class="tracklist-header-row">
                                <span class="th-title">Official Studio Tracklist (<span id="modalTrackCount">10</span> Tracks)</span>
                                <span class="th-action">24-Bit / 48kHz Master</span>
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

<!-- CLIENT-SIDE AUTO-LOADER, PAGINATION, MODAL & 60FPS MUSIC GRAPH SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 0. Client-Side Auto-Loader for Latest Published Music Video (16:9 Long Top + 9:16 Short Bottom)
    function suDecodeHtml(raw) {
        const el = document.createElement('div');
        el.innerHTML = raw;
        return (el.textContent || el.innerText || '').trim();
    }
    function suStripCrossPromo(rawHtml) {
        let html = rawHtml || '';
        const markers = ['Related Keystone Engineering Briefings', 'New 2026 Keystone Engineering Briefing'];
        for (let i = 0; i < markers.length; i++) {
            const idx = html.indexOf(markers[i]);
            if (idx !== -1) html = html.substring(0, Math.max(0, idx - 120));
        }
        return html;
    }
    function suExtractYoutubeIds(rawHtml) {
        const html = suStripCrossPromo(rawHtml);
        const retiredIds = ['3rYyZ0c8_1o', 'XUiFyItyyzo'];
        const allIds = [];
        let shortId = null;

        const explicitShort = html.match(/youtube(?:-nocookie)?\.com\/shorts\/([a-zA-Z0-9_-]{11})/i);
        if (explicitShort && explicitShort[1] && retiredIds.indexOf(explicitShort[1]) === -1) {
            shortId = explicitShort[1];
        }
        if (!shortId) {
            const secIdx = html.toLowerCase().indexOf('field-companion-short');
            if (secIdx !== -1) {
                const secHtml = html.substring(secIdx);
                const secMatch = secHtml.match(/(?:youtube(?:-nocookie)?\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i);
                if (secMatch && secMatch[1] && retiredIds.indexOf(secMatch[1]) === -1) {
                    shortId = secMatch[1];
                }
            }
        }
        const ytRegex = /(?:youtube(?:-nocookie)?\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/gi;
        let match;
        while ((match = ytRegex.exec(html)) !== null) {
            if (match[1] && retiredIds.indexOf(match[1]) === -1 && allIds.indexOf(match[1]) === -1) {
                allIds.push(match[1]);
            }
        }
        let longId = null;
        for (let i = 0; i < allIds.length; i++) {
            if (allIds[i] !== shortId) {
                longId = allIds[i];
                break;
            }
        }
        if (!longId && allIds.length > 0) longId = allIds[0];
        if (!shortId && allIds.length > 1) {
            for (let j = 0; j < allIds.length; j++) {
                if (allIds[j] !== longId) {
                    shortId = allIds[j];
                    break;
                }
            }
        }
        return { longId, shortId };
    }

    async function loadLatestSonicUniverseVideo() {
        try {
            const u = new URL('/wp-json/wp/v2/posts', window.location.origin);
            u.searchParams.set('per_page', '16');
            u.searchParams.set('orderby', 'date');
            u.searchParams.set('order', 'desc');
            u.searchParams.set('status', 'publish');
            const resp = await fetch(u.toString());
            if (!resp.ok) return;
            const posts = await resp.json();
            if (!Array.isArray(posts) || posts.length === 0) return;

            const isMusicPost = (p) => {
                const cats = Array.isArray(p.categories) ? p.categories : [];
                const slug = (p.slug || '').toLowerCase();
                const title = ((p.title && p.title.rendered) || '').toLowerCase();
                if (cats.indexOf(1442) !== -1 && cats.indexOf(1538) === -1) return true;
                if (slug.indexOf('iron-grace') !== -1 || slug.indexOf('sovereign-reverb') !== -1 || slug.indexOf('heavy-civil-focus') !== -1 || slug.indexOf('peak-intensity') !== -1 || title.indexOf('somatic deep house') !== -1 || title.indexOf('official 4k music video') !== -1) return true;
                return false;
            };

            let fallbackShort = '9Aa98IGWKpU';
            for (let k = 0; k < posts.length; k++) {
                if (isMusicPost(posts[k]) && posts[k].content && posts[k].content.rendered) {
                    const pr = suExtractYoutubeIds(posts[k].content.rendered);
                    if (pr.shortId) {
                        fallbackShort = pr.shortId;
                        break;
                    }
                }
            }

            const featuredMusic = posts.find(p => {
                if (!isMusicPost(p)) return false;
                const m = suExtractYoutubeIds((p.content && p.content.rendered) || '');
                return Boolean(m.longId);
            });
            if (!featuredMusic) return;

            const titleEl = document.getElementById('su-featured-title');
            const excerptEl = document.getElementById('su-featured-excerpt');
            const linkEl = document.getElementById('su-featured-link');
            const dateEl = document.getElementById('su-featured-date');
            const longVideoEl = document.getElementById('su-featured-long-video');
            const shortVideoEl = document.getElementById('su-featured-short-video');
            const shortLinkEl = document.getElementById('su-featured-short-link');
            const ytBtnEl = document.getElementById('su-featured-yt-btn');
            const shortTitleEl = document.getElementById('su-featured-short-title');

            let decodedTitle = '';
            if (featuredMusic.title && featuredMusic.title.rendered) {
                decodedTitle = suDecodeHtml(featuredMusic.title.rendered);
                if (titleEl) titleEl.textContent = decodedTitle;
            }
            if (excerptEl && featuredMusic.excerpt && featuredMusic.excerpt.rendered) {
                const cleanEx = suDecodeHtml(featuredMusic.excerpt.rendered)
                    .replace(/\[.*?\]/g, '')
                    .replace(/\s*\(?ISRC:?\s*[A-Z0-9]{8,15}\)?/gi, '')
                    .replace(/\s*\(?UPC:?\s*[0-9]{8,15}\)?/gi, '')
                    .replace(/Related Keystone Engineering Briefings[\s\S]*/i, '')
                    .replace(/New 2026 Keystone Engineering Briefing[\s\S]*/i, '')
                    .replace(/^\/\/\s*2026[^\n\r.]*[\n\r.]*\s*/i, '')
                    .replace(/^\/\/\s*[A-Z0-9 _•&\/:-]{6,85}\s*/i, '')
                    .trim();
                if (cleanEx.length > 45 && !/engin$/i.test(cleanEx) && /[.!?…]$/u.test(cleanEx)) {
                    excerptEl.textContent = cleanEx.substring(0, 240) + (cleanEx.length > 240 ? '...' : '');
                }
            }
            if (linkEl && featuredMusic.link) linkEl.href = featuredMusic.link;
            if (dateEl && featuredMusic.date) {
                dateEl.textContent = new Date(featuredMusic.date).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
            }

            const media = suExtractYoutubeIds((featuredMusic.content && featuredMusic.content.rendered) || '');
            if (media.longId) {
                const targetLong = 'https://www.youtube.com/embed/' + media.longId + '?rel=0';
                if (longVideoEl && longVideoEl.getAttribute('src') !== targetLong) {
                    longVideoEl.src = targetLong;
                }
                if (ytBtnEl) ytBtnEl.href = 'https://youtu.be/' + media.longId;
            }
            const activeShort = media.shortId || fallbackShort;
            if (activeShort) {
                const targetShort = 'https://www.youtube.com/embed/' + activeShort + '?rel=0';
                if (shortVideoEl && shortVideoEl.getAttribute('src') !== targetShort) {
                    shortVideoEl.src = targetShort;
                }
                if (shortLinkEl) shortLinkEl.href = 'https://youtube.com/shorts/' + activeShort;
            }
            if (decodedTitle && shortTitleEl) {
                const prefix = decodedTitle.split(':')[0].replace(/Keystone Recomposition/i, '').trim();
                shortTitleEl.textContent = prefix + ' — 9:16 Somatic Short';
            }
        } catch (err) {
            console.warn('[Keystone Sonic Universe] Video sync check:', err);
        }
    }
    loadLatestSonicUniverseVideo();

    // 1. Segmented Command Dock Pagination (Top & Bottom Synced)
    let currentPage = 1;
    const totalPages = 2;
    const totalAlbumsCount = <?php echo (int) $total_albums; ?>;
    const cards = document.querySelectorAll('#sonicAlbumGrid .album-card-18');
    const prevBtn = document.getElementById('sonicPrevBtn');
    const nextBtn = document.getElementById('sonicNextBtn');
    const topPrevBtn = document.getElementById('suTopPrevBtn');
    const topNextBtn = document.getElementById('suTopNextBtn');
    const topP1 = document.getElementById('suTopPage1Btn');
    const topP2 = document.getElementById('suTopPage2Btn');
    const botP1 = document.getElementById('suBottomPage1Btn');
    const botP2 = document.getElementById('suBottomPage2Btn');
    const pageIndicator = document.getElementById('su-grid-page-indicator');
    const catalogSection = document.getElementById('sonicCatalogSection');

    function setSuDockBtnState(btn, isActive, labelText) {
        if (!btn) return;
        const sp = btn.querySelector('.ks-wave-text');
        if (sp) sp.textContent = labelText;
        else btn.innerHTML = '<span class="ks-wave-text">' + labelText + '</span>';
        if (isActive) {
            btn.classList.add('is-active', 'ks-p3-btn-gold');
            btn.classList.remove('ks-p3-btn-blue');
            btn.setAttribute('aria-current', 'page');
        } else {
            btn.classList.remove('is-active', 'ks-p3-btn-gold');
            btn.classList.add('ks-p3-btn-blue');
            btn.removeAttribute('aria-current');
        }
    }

    function setPage(pageNum) {
        if (pageNum < 1 || pageNum > totalPages) return;
        currentPage = pageNum;

        cards.forEach(card => {
            const cardPage = parseInt(card.getAttribute('data-page'), 10);
            card.style.display = (cardPage === currentPage) ? 'flex' : 'none';
        });

        if (currentPage === 1) {
            setSuDockBtnState(topP1, true, '● PAGE 01');
            setSuDockBtnState(topP2, false, '○ PAGE 02');
            setSuDockBtnState(botP1, true, '● PAGE 01');
            setSuDockBtnState(botP2, false, '○ PAGE 02');
            if (pageIndicator) {
                const indSp = pageIndicator.querySelector('.ks-wave-text') || pageIndicator;
                indSp.textContent = 'PAGE 01 OF 02 • RELEASES 01–12 OF ' + totalAlbumsCount;
            }
        } else {
            setSuDockBtnState(topP1, false, '○ PAGE 01');
            setSuDockBtnState(topP2, true, '● PAGE 02');
            setSuDockBtnState(botP1, false, '○ PAGE 01');
            setSuDockBtnState(botP2, true, '● PAGE 02');
            if (pageIndicator) {
                const indSp2 = pageIndicator.querySelector('.ks-wave-text') || pageIndicator;
                indSp2.textContent = 'PAGE 02 OF 02 • RELEASES 13–' + totalAlbumsCount + ' OF ' + totalAlbumsCount;
            }
        }
    }

    [topP1, topP2, botP1, botP2].forEach(btn => {
        if (!btn) return;
        btn.addEventListener('click', () => {
            const p = parseInt(btn.getAttribute('data-page'), 10);
            setPage(p);
            catalogSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    [prevBtn, topPrevBtn].forEach(btn => {
        if (!btn) return;
        btn.addEventListener('click', () => {
            if (currentPage > 1) {
                setPage(currentPage - 1);
                catalogSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    [nextBtn, topNextBtn].forEach(btn => {
        if (!btn) return;
        btn.addEventListener('click', () => {
            if (currentPage < totalPages) {
                setPage(currentPage + 1);
                catalogSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // 2. Interactive Album Modal (Protected Metadata — Zero Exposed UPC/ISRC)
    const modal = document.getElementById('sonicAlbumModal');
    const modalCloseBtn = document.getElementById('sonicModalCloseBtn');
    const modalCover = document.getElementById('modalAlbumCover');
    const modalTitle = document.getElementById('modalAlbumTitle');
    const modalGenre = document.getElementById('modalAlbumGenre');
    const modalBpm = document.getElementById('modalAlbumBpm');
    const modalYear = document.getElementById('modalAlbumYear');
    const modalTrackCount = document.getElementById('modalTrackCount');
    const modalSpotifyLink = document.getElementById('modalSpotifyLink');
    const modalTracklistUl = document.getElementById('modalTracklistUl');

    function openModalForCard(card) {
        const title = card.getAttribute('data-title');
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
        modalBpm.textContent = bpm + ' BPM';
        modalYear.textContent = (relDate && relDate.length >= 4) ? relDate.substring(0, 4) : '2026';
        modalTrackCount.textContent = count;
        modalSpotifyLink.href = spotify || 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y';

        modalTracklistUl.innerHTML = '';
        if (tracks.length > 0) {
            tracks.forEach(trk => {
                const li = document.createElement('li');
                li.className = 'modal-track-row';
                const pos = String(trk.pos || 1).padStart(2, '0');
                li.innerHTML = `
                    <div class="track-info-left">
                        <span class="track-index">${pos}</span>
                        <span class="track-name">${trk.title || 'Track'}</span>
                    </div>
                    <div class="track-info-right">
                        <span class="track-code" style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 700;">24-BIT MASTER</span>
                    </div>
                `;
                modalTracklistUl.appendChild(li);
            });
        } else {
            modalTracklistUl.innerHTML = '<li class="modal-track-row" style="color: #64748b;">Canonical studio master tracks available on Spotify OAC.</li>';
        }

        modal.style.display = 'flex';
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    cards.forEach(card => {
        card.addEventListener('click', (e) => {
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
        if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.style.display === 'flex') closeModal();
    });

    if (window.location.hash && window.location.hash.length > 1) {
        const hashSlug = window.location.hash.substring(1);
        const targetCard = document.getElementById(hashSlug);
        if (targetCard && targetCard.classList.contains('album-card-18')) {
            const targetPage = parseInt(targetCard.getAttribute('data-page') || '1', 10);
            if (targetPage !== currentPage) setPage(targetPage);
            setTimeout(() => {
                targetCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                openModalForCard(targetCard);
            }, 250);
        }
    }

    // 3. 60FPS HI-DPI MULTI-DEVICE SONIC UNIVERSE HARMONIC MUSIC GRAPH
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
                document.querySelectorAll('.su-mode-btn').forEach(b => {
                    const active = (b === btn);
                    b.classList.toggle('active', active);
                    b.classList.toggle('ks-p3-btn-gold', active);
                    b.classList.toggle('ks-p3-btn-blue', !active);
                });
            });
        });

        document.querySelectorAll('.su-preset-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                const bpm = parseInt(chip.getAttribute('data-bpm') || '115', 10);
                const prof = chip.getAttribute('data-profile') || '';
                const vIdx = parseInt(chip.getAttribute('data-vault-idx') || '0', 10);
                document.querySelectorAll('.su-preset-chip').forEach(c => {
                    const active = (c === chip);
                    c.classList.toggle('active', active);
                    c.classList.toggle('ks-p3-btn-gold', active);
                    c.classList.toggle('ks-p3-btn-blue', !active);
                });
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
                const sp = suPlayTrigger.querySelector('.ks-wave-text') || suPlayTrigger;
                sp.textContent = isVaultPlaying ? '⏸ STREAMING 96KHZ MASTER' : '▶ STREAM 96KHZ MASTER';
                suPlayTrigger.classList.toggle('active', isVaultPlaying);
            }

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
