<?php
/**
 * The blog archive template for INTEL & VIDEOS (/intel-videos/, /intel/, or /blog/)
 * Keystone Recomposition Child Theme
 * Version: 4.6.0 (PHP 8.2+ Strict Types)
 *
 * Engineered to Wayne's exact standard:
 * - Sleek, centered top header with pure-black cyan telemetry pill
 * - Server-side + client-side auto-loading of newest published AI Protocols & Sonic Universe Long-Form (16:9 Top) + Short-Form (9:16 Bottom) videos
 * - Supports youtube.com, youtube-nocookie.com, and youtu.be while stripping bottom cross-promo links so Long-Form is always Top and Short-Form is always Bottom
 * - Level, parallel Dual-Media Featured Hero cards (Left: 16:9 + 9:16 Short Deck; Right: Metadata, H2, Excerpt, Author, Full-Width Pure-Black Wave Buttons)
 * - 2x3 grid of 6 equal-height luxury cards per view with 100% clean unobstructed 16:9 thumbnails (zero top-left INTEL DROP badges, zero LIVE INTEL text, reading time pill moved cleanly to bottom footer)
 * - High-end Obsidian & Gold/Cyan Segmented Command Dock pagination at top-right and bottom-center
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Helper: Strip cross-promotional "Related Briefings" / "New 2026 Keystone Engineering Briefing" boxes from post HTML
 * before extracting video IDs so we only extract videos belonging to THIS specific post.
 *
 * @param string $html Raw post HTML.
 * @return string
 */
function keystone_strip_cross_promo_blocks( string $html ): string {
    // Cut off at "Related Keystone Engineering Briefings" or "New 2026 Keystone Engineering Briefing"
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
 * Helper: Extract non-retired YouTube video IDs (Long-Form 16:9 Top + Companion 9:16 Short Bottom) from post HTML.
 * Supports youtube.com, youtube-nocookie.com, and youtu.be.
 *
 * @param string $raw_html Post content HTML.
 * @return array{long: string|null, short: string|null, isrc: string|null}
 */
function keystone_extract_post_youtube_ids( string $raw_html ): array {
    $html        = keystone_strip_cross_promo_blocks( $raw_html );
    $retired_ids = array( '3rYyZ0c8_1o', 'XUiFyItyyzo' );
    $all_ids     = array();
    $short_id    = null;
    $isrc        = null;

    if ( preg_match( '/ISRC:\s*(?:<[^>]+>)*([A-Z0-9]{12})/i', $html, $im ) ) {
        $isrc = strtoupper( trim( $im[1] ) );
    }

    // 1. Explicit /shorts/{ID} link is always the 9:16 Short
    if ( preg_match( '/youtube(?:-nocookie)?\.com\/shorts\/([a-zA-Z0-9_-]{11})/i', $html, $sm ) ) {
        if ( ! empty( $sm[1] ) && ! in_array( $sm[1], $retired_ids, true ) ) {
            $short_id = $sm[1];
        }
    }

    // 2. If #field-companion-short section exists, any embed inside/after it is the 9:16 Short
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

    // 3. Collect all YouTube IDs in document order (matching both youtube.com and youtube-nocookie.com)
    if ( preg_match_all( '/(?:youtube(?:-nocookie)?\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i', $html, $matches ) ) {
        foreach ( $matches[1] as $vid ) {
            if ( ! empty( $vid ) && ! in_array( $vid, $retired_ids, true ) && ! in_array( $vid, $all_ids, true ) ) {
                $all_ids[] = $vid;
            }
        }
    }

    // 4. First video ID that is NOT the Short ID is the 16:9 Long-Form video
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
        'isrc'  => $isrc,
    );
}

/**
 * Helper: Clean post excerpt text for executive cards.
 *
 * @param string $raw_excerpt Raw excerpt or content.
 * @param int    $max_chars   Maximum character length.
 * @return string
 */
function keystone_clean_intel_excerpt( string $raw_excerpt, int $max_chars = 235 ): string {
    $text = wp_strip_all_tags( html_entity_decode( $raw_excerpt, ENT_QUOTES | ENT_HTML5, 'UTF-8' ) );
    $text = (string) preg_replace( '/\[.*?\]/', '', $text );
    $text = (string) preg_replace( '/Related Keystone Engineering Briefings[\s\S]*/i', '', $text );
    $text = (string) preg_replace( '/New 2026 Keystone Engineering Briefing[\s\S]*/i', '', $text );
    $text = (string) preg_replace( '/^\/\/\s*2026[^\n\r.]*[\n\r.]*\s*/i', '', $text );
    $text = (string) preg_replace( '/^\/\/\s*[A-Z0-9 _•&\/:-]{6,85}\s*/i', '', $text );
    $text = (string) preg_replace( '/\s*\((?:ISRC|UPC)[^)]*\)/i', '', $text );
    $text = (string) preg_replace( '/\b(?:ISRC|UPC)\s*:?\s*[A-Z0-9-]{8,16}\b/i', '', $text );
    $text = trim( (string) preg_replace( '/\s+/', ' ', $text ) );
    if ( strlen( $text ) > $max_chars ) {
        $text = rtrim( substr( $text, 0, $max_chars ) ) . '...';
    }
    return $text;
}

/**
 * Helper: Check whether a WP_Post belongs to Sonic Universe / Music (Cat 1442).
 *
 * @param WP_Post $p WordPress Post object.
 * @return bool
 */
function keystone_is_music_intel_post( WP_Post $p ): bool {
    $cats  = wp_get_post_categories( $p->ID );
    $slug  = strtolower( (string) $p->post_name );
    $title = strtolower( (string) $p->post_title );
    if ( in_array( 1442, $cats, true ) && ! in_array( 1538, $cats, true ) ) {
        return true;
    }
    if (
        str_contains( $slug, 'iron-grace' ) ||
        str_contains( $slug, 'sovereign-reverb' ) ||
        str_contains( $slug, 'heavy-civil-focus' ) ||
        str_contains( $slug, 'peak-intensity' ) ||
        str_contains( $title, 'somatic deep house' ) ||
        str_contains( $title, 'official 4k music video' )
    ) {
        return true;
    }
    return false;
}

// Fetch latest published posts server-side so first paint already auto-loads the newest videos & articles.
$published_posts = get_posts(
    array(
        'numberposts' => 16,
        'post_status' => 'publish',
        'orderby'     => 'date',
        'order'       => 'DESC',
    )
);

// Defaults for Featured Hero 1 (AI Systems & Architecture - Blue)
$feat_ai_title       = 'Google Antigravity vs Grok and OpenAI: The Ultimate 200,000-GPU Multi-Agent Breakdown';
$feat_ai_excerpt     = 'Inside Wayne Stevenson\'s multi-agent workstation architecture, Google Flow visual pipelines, and live browser automation built in Squamish and Vancouver, BC to replace fragile cloud wrappers with deterministic local execution.';
$feat_ai_link        = home_url( '/ai-protocols/' );
$feat_ai_date        = 'October 2026';
$feat_ai_read        = '12 MIN READ';
$feat_ai_long_id     = 'nl1yJq45fTs';
$feat_ai_short_id    = '8oPAZPsTOiw';
$feat_ai_short_title = 'Google Antigravity vs Grok and OpenAI — 9:16 Field Short';
$feat_ai_short_desc  = 'Rapid 40-second vertical field briefing & companion architectural breakdown for this episode.';

// Defaults for Featured Hero 2 (Sonic Universe / Music - Gold)
$feat_sound_title       = 'Heavy Civil Focus Keystone Recomposition: Official 4K Somatic Deep House Release (2026)';
$feat_sound_excerpt     = 'Engineered in Squamish, BC by Wayne Stevenson — uniting 122 BPM warm analog sub-bass foundations with expressive solo cello phrasing and a continuous 4K visual film assembled in DaVinci Resolve Studio.';
$feat_sound_link        = home_url( '/2026/10/23/heavy-civil-focus-keystone-recomposition/' );
$feat_sound_date        = 'October 2026';
$feat_sound_long_id     = 'nKx8DiB_heM';
$feat_sound_short_id    = '9Aa98IGWKpU';
$feat_sound_kicker      = '🎵 24-BIT / 48kHz LOSSLESS STUDIO MASTER • VERIFIED OAC';
$feat_sound_short_title = 'Heavy Civil Focus — 9:16 Somatic Short';
$feat_sound_short_desc  = '122 BPM Somatic Deep House & Solo Cello Vertical Drop • Too Lost Digital Distribution';

$matched_ai_post      = null;
$matched_sound_post   = null;
$fallback_ai_short    = '8oPAZPsTOiw';
$fallback_sound_short = '9Aa98IGWKpU';

foreach ( $published_posts as $p_candidate ) {
    if ( ! ( $p_candidate instanceof WP_Post ) ) {
        continue;
    }
    $ids = keystone_extract_post_youtube_ids( (string) $p_candidate->post_content );
    if ( ! keystone_is_music_intel_post( $p_candidate ) ) {
        if ( ! empty( $ids['short'] ) && '8oPAZPsTOiw' === $fallback_ai_short ) {
            $fallback_ai_short = $ids['short'];
        }
        if ( null === $matched_ai_post && ! empty( $ids['long'] ) ) {
            $matched_ai_post = $p_candidate;
        }
    } else {
        if ( ! empty( $ids['short'] ) && '9Aa98IGWKpU' === $fallback_sound_short ) {
            $fallback_sound_short = $ids['short'];
        }
        if ( null === $matched_sound_post && ! empty( $ids['long'] ) ) {
            $matched_sound_post = $p_candidate;
        }
    }
}

if ( $matched_ai_post instanceof WP_Post ) {
    $feat_ai_title = html_entity_decode( wp_strip_all_tags( get_the_title( $matched_ai_post ) ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
    $raw_ex        = ! empty( $matched_ai_post->post_excerpt ) ? (string) $matched_ai_post->post_excerpt : (string) $matched_ai_post->post_content;
    $clean_ex      = keystone_clean_intel_excerpt( $raw_ex, 240 );
    if ( strlen( $clean_ex ) > 25 ) {
        $feat_ai_excerpt = $clean_ex;
    }
    $feat_ai_link = (string) get_permalink( $matched_ai_post );
    $feat_ai_date = (string) get_the_date( 'F Y', $matched_ai_post );
    $word_count   = str_word_count( wp_strip_all_tags( (string) $matched_ai_post->post_content ) );
    $read_mins    = max( 8, min( 18, (int) ceil( $word_count / 180 ) ) );
    $feat_ai_read = $read_mins . ' MIN READ';

    $ai_ids = keystone_extract_post_youtube_ids( (string) $matched_ai_post->post_content );
    if ( ! empty( $ai_ids['long'] ) ) {
        $feat_ai_long_id = $ai_ids['long'];
    }
    if ( ! empty( $ai_ids['short'] ) ) {
        $feat_ai_short_id = $ai_ids['short'];
    } else {
        $feat_ai_short_id = $fallback_ai_short;
    }

    $short_parts         = explode( ':', $feat_ai_title );
    $short_prefix        = trim( $short_parts[0] );
    $feat_ai_short_title = $short_prefix . ' — 9:16 Field Short';
    $feat_ai_short_desc  = 'Rapid 40-second vertical field briefing & companion architectural breakdown for ' . $short_prefix . '.';
}

if ( $matched_sound_post instanceof WP_Post ) {
    $feat_sound_title = html_entity_decode( wp_strip_all_tags( get_the_title( $matched_sound_post ) ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
    $raw_s_ex         = ! empty( $matched_sound_post->post_excerpt ) ? (string) $matched_sound_post->post_excerpt : (string) $matched_sound_post->post_content;
    $clean_s_ex       = keystone_clean_intel_excerpt( $raw_s_ex, 240 );
    if ( strlen( $clean_s_ex ) > 25 ) {
        $feat_sound_excerpt = $clean_s_ex;
    }
    $feat_sound_link = (string) get_permalink( $matched_sound_post );
    $feat_sound_date = (string) get_the_date( 'F Y', $matched_sound_post );

    $s_ids = keystone_extract_post_youtube_ids( (string) $matched_sound_post->post_content );
    if ( ! empty( $s_ids['long'] ) ) {
        $feat_sound_long_id = $s_ids['long'];
    }
    if ( ! empty( $s_ids['short'] ) ) {
        $feat_sound_short_id = $s_ids['short'];
    } else {
        $feat_sound_short_id = $fallback_sound_short;
    }
    $feat_sound_kicker = '🎵 24-BIT / 48kHz LOSSLESS STUDIO MASTER • VERIFIED OAC';

    $sound_parts            = explode( ':', $feat_sound_title );
    $sound_prefix           = trim( str_ireplace( 'Keystone Recomposition', '', $sound_parts[0] ) );
    $feat_sound_short_title = $sound_prefix . ' — 9:16 Somatic Short';
    $feat_sound_short_desc  = '24-Bit Somatic Deep House & Solo Cello Vertical Drop • Too Lost Digital Distribution';
}

get_header(); ?>

<div id="primary" class="content-area primary keystone-intel-archive">
    <main id="main" class="site-main">
        <div class="ast-container">
            
            <!-- 1. Sleek, Centered Top Header Area -->
            <header class="intel-archive-header text-center" style="margin-bottom: 2.5rem; text-align: center;">
                <div class="intel-telemetry-pill ks-p3-pill-blue">
                    <span class="telemetry-pulse"></span>
                    <span class="telemetry-text ks-wave-text">// 2026 TECHNICAL INTEL &bull; AI SYSTEMS &amp; SONIC ARCHITECTURE</span>
                </div>
                <h1 class="page-title">
                    Technical Intel &amp; <span class="cyan-gold-gradient-text">Video Briefings</span>
                </h1>
                <p class="archive-subtitle">
                    Autonomous multi-agent architectures, Google Flow visual engineering, high-cadence desktop studio builds, and 24-bit somatic frequency releases by Wayne Stevenson.
                </p>
            </header>

            <!-- 2A. Dual-Media Featured Hero Section 1: AI Protocols & Architecture (Blue Theme) -->
            <section id="recomp-featured-intel-container" class="recomp-featured-hero-wrap recomp-hero-blue">
                <div class="recomp-featured-layout">
                    
                    <!-- Left Column (55%): Master 16:9 Long-Form Video (Top) + 9:16 Companion Short Deck (Bottom) -->
                    <div class="recomp-featured-left-col">
                        
                        <!-- 16:9 Master Long-Form Video Frame (Top) -->
                        <div class="recomp-featured-video-frame recomp-frame-blue">
                            <iframe id="recomp-featured-long-video" 
                                    src="<?php echo esc_url( 'https://www.youtube.com/embed/' . $feat_ai_long_id . '?rel=0' ); ?>" 
                                    title="<?php echo esc_attr( $feat_ai_title ); ?>" 
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen></iframe>
                        </div>

                        <!-- 9:16 Field Companion Short Deck (Bottom) -->
                        <div class="recomp-featured-short-deck recomp-short-deck-blue">
                            
                            <!-- 9:16 Vertical Player Frame -->
                            <div class="recomp-featured-short-player-box recomp-short-box-blue">
                                <iframe id="recomp-featured-short-video" 
                                        src="<?php echo esc_url( 'https://www.youtube.com/embed/' . $feat_ai_short_id . '?rel=0' ); ?>" 
                                        title="<?php echo esc_attr( $feat_ai_short_title ); ?>" 
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen></iframe>
                            </div>

                            <!-- Short Details & CTA -->
                            <div class="recomp-featured-short-details">
                                <div class="ks-p3-pill-blue recomp-short-kicker-pill">
                                    <span class="ks-wave-text">⚡ 9:16 FIELD INTEL SHORT</span>
                                </div>
                                <h4 id="recomp-featured-short-title" class="recomp-featured-short-title">
                                    <?php echo esc_html( $feat_ai_short_title ); ?>
                                </h4>
                                <p id="recomp-featured-short-desc" class="recomp-featured-short-desc">
                                    <?php echo esc_html( $feat_ai_short_desc ); ?>
                                </p>
                                <div class="recomp-featured-short-actions">
                                    <a id="recomp-featured-short-link" href="<?php echo esc_url( 'https://youtube.com/shorts/' . $feat_ai_short_id ); ?>" target="_blank" rel="noopener noreferrer" class="ks-p3-btn-gold recomp-short-action-btn">
                                        <span class="ks-wave-text">▶ Watch Short on YouTube</span>
                                    </a>
                                    <a href="https://www.youtube.com/@KeystoneAIProtocols?sub_confirmation=1" target="_blank" rel="noopener noreferrer" class="ks-p3-btn-blue recomp-short-action-btn">
                                        <span class="ks-wave-text">🔔 Subscribe Channel</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column (45%): SEO & GEO Technical Intel Write-up -->
                    <div class="recomp-featured-content-wrap">
                        
                        <div class="recomp-featured-top-body">
                            <!-- Metadata Pill Row -->
                            <div class="recomp-featured-meta-row">
                                <span id="recomp-featured-cat" class="recomp-cat-badge ks-p3-pill-blue">
                                    <span class="ks-wave-text">AI PROTOCOLS // LATEST VIDEO DROP</span>
                                </span>
                                <span id="recomp-featured-date" class="recomp-meta-date"><?php echo esc_html( $feat_ai_date ); ?></span>
                                <span id="recomp-featured-readtime" class="ks-p3-pill-gold recomp-meta-read-pill">
                                    <span class="ks-wave-text"><?php echo esc_html( $feat_ai_read ); ?></span>
                                </span>
                            </div>

                            <!-- Main Title -->
                            <h2 id="recomp-featured-title" class="recomp-featured-h2">
                                <?php echo esc_html( $feat_ai_title ); ?>
                            </h2>

                            <!-- SEO & GEO Excerpt Write-up -->
                            <p id="recomp-featured-excerpt" class="recomp-featured-excerpt">
                                <?php echo esc_html( $feat_ai_excerpt ); ?>
                            </p>
                        </div>

                        <div class="recomp-featured-bottom-footer">
                            <!-- Wayne Stevenson Author Signature & Credentials -->
                            <div class="recomp-author-row">
                                <img decoding="async" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/wayne_avatar.jpg' ); ?>" alt="Wayne Stevenson" class="recomp-author-avatar recomp-avatar-blue" />
                                <div>
                                    <div class="recomp-author-name">Wayne Stevenson</div>
                                    <div class="recomp-author-role recomp-role-blue">Sovereign AI Architect &bull; Music Producer &bull; Squamish, BC</div>
                                </div>
                            </div>

                            <!-- Action Buttons Box (Full Width Parallel Stack) -->
                            <div class="recomp-featured-buttons-box">
                                <a id="recomp-featured-link" href="<?php echo esc_url( $feat_ai_link ); ?>" class="ks-p3-btn-blue recomp-hero-cta-btn">
                                    <span class="ks-wave-text">READ TECHNICAL INTEL &rarr;</span>
                                </a>
                                <a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="ks-p3-btn-gold recomp-hero-cta-btn">
                                    <span class="ks-wave-text">EXPLORE AI PROTOCOLS &rarr;</span>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </section>

            <!-- 2B. Dual-Media Featured Hero Section 2: Sonic Universe / Sound Lab (Gold Theme) -->
            <section id="recomp-featured-sound-container" class="recomp-featured-hero-wrap recomp-hero-gold">
                <div class="recomp-featured-layout">
                    
                    <!-- Left Column (55%): Master 16:9 4K Long-Form Video (Top) + Companion 9:16 Short Deck (Bottom) -->
                    <div class="recomp-featured-left-col">
                        
                        <!-- 16:9 Master Long-Form Video Frame (Top) -->
                        <div class="recomp-featured-video-frame recomp-frame-gold">
                            <iframe id="recomp-featured-sound-video" 
                                    src="<?php echo esc_url( 'https://www.youtube.com/embed/' . $feat_sound_long_id . '?rel=0' ); ?>" 
                                    title="<?php echo esc_attr( $feat_sound_title ); ?>" 
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen></iframe>
                        </div>

                        <!-- 9:16 Companion Short & Audio Streaming Deck (Bottom) -->
                        <div class="recomp-featured-short-deck recomp-short-deck-gold">
                            
                            <!-- 9:16 Vertical Short Player Box -->
                            <div class="recomp-featured-short-player-box recomp-short-box-gold">
                                <iframe id="recomp-featured-sound-short-video" 
                                        src="<?php echo esc_url( 'https://www.youtube.com/embed/' . $feat_sound_short_id . '?rel=0' ); ?>" 
                                        title="<?php echo esc_attr( $feat_sound_short_title ); ?>" 
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen></iframe>
                            </div>

                            <!-- Track Details & Audio Meta -->
                            <div class="recomp-featured-short-details">
                                <div id="recomp-featured-sound-kicker" class="ks-p3-pill-gold recomp-short-kicker-pill">
                                    <span class="ks-wave-text"><?php echo esc_html( $feat_sound_kicker ); ?></span>
                                </div>
                                <h4 id="recomp-featured-sound-sub" class="recomp-featured-short-title">
                                    <?php echo esc_html( $feat_sound_short_title ); ?>
                                </h4>
                                <p id="recomp-featured-sound-short-desc" class="recomp-featured-short-desc">
                                    <?php echo esc_html( $feat_sound_short_desc ); ?>
                                </p>
                                <div class="recomp-featured-short-actions">
                                    <a id="recomp-featured-sound-short-link" href="<?php echo esc_url( 'https://youtube.com/shorts/' . $feat_sound_short_id ); ?>" target="_blank" rel="noopener noreferrer" class="ks-p3-btn-gold recomp-short-action-btn">
                                        <span class="ks-wave-text">▶ Watch 9:16 Short</span>
                                    </a>
                                    <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="ks-p3-btn-gold recomp-short-action-btn">
                                        <span class="ks-wave-text">🎧 Stream on Spotify</span>
                                    </a>
                                    <a href="https://www.youtube.com/@KeyStoneRecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" class="ks-p3-btn-blue recomp-short-action-btn">
                                        <span class="ks-wave-text">🔔 Subscribe</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column (45%): Sonic Architecture Write-up -->
                    <div class="recomp-featured-content-wrap">
                        
                        <div class="recomp-featured-top-body">
                            <!-- Metadata Pill Row -->
                            <div class="recomp-featured-meta-row">
                                <span id="recomp-featured-sound-cat" class="recomp-cat-badge ks-p3-pill-gold">
                                    <span class="ks-wave-text">SOMATIC DEEP HOUSE // SONIC UNIVERSE</span>
                                </span>
                                <span id="recomp-featured-sound-date" class="recomp-meta-date"><?php echo esc_html( $feat_sound_date ); ?></span>
                                <span id="recomp-featured-sound-duration" class="ks-p3-pill-blue recomp-meta-read-pill">
                                    <span class="ks-wave-text">4K STUDIO MASTER</span>
                                </span>
                            </div>

                            <!-- Main Title -->
                            <h2 id="recomp-featured-sound-title" class="recomp-featured-h2">
                                <?php echo esc_html( $feat_sound_title ); ?>
                            </h2>

                            <!-- Excerpt Write-up -->
                            <p id="recomp-featured-sound-excerpt" class="recomp-featured-excerpt">
                                <?php echo esc_html( $feat_sound_excerpt ); ?>
                            </p>
                        </div>

                        <div class="recomp-featured-bottom-footer">
                            <!-- Wayne Stevenson Author Signature & Credentials -->
                            <div class="recomp-author-row">
                                <img decoding="async" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/wayne_avatar.jpg' ); ?>" alt="Wayne Stevenson" class="recomp-author-avatar recomp-avatar-gold" />
                                <div>
                                    <div class="recomp-author-name">Wayne Stevenson</div>
                                    <div class="recomp-author-role recomp-role-gold">Music Producer &bull; Sovereign AI Architect &bull; Squamish, BC</div>
                                </div>
                            </div>

                            <!-- Action Buttons Box (Full Width Parallel Stack) -->
                            <div class="recomp-featured-buttons-box">
                                <a id="recomp-featured-sound-link" href="<?php echo esc_url( $feat_sound_link ); ?>" class="ks-p3-btn-gold recomp-hero-cta-btn">
                                    <span class="ks-wave-text">READ SONIC ESSAY &amp; CREDITS &rarr;</span>
                                </a>
                                <a id="recomp-featured-sound-yt-btn" href="<?php echo esc_url( 'https://youtu.be/' . $feat_sound_long_id ); ?>" target="_blank" rel="noopener noreferrer" class="ks-p3-btn-blue recomp-hero-cta-btn">
                                    <span class="ks-wave-text">WATCH IN 4K ON YOUTUBE &rarr;</span>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </section>

            <!-- 3. Chronological 2x3 Grid of Blog Posts (6 Equal Cards Per View with High-End Segmented Command Docks) -->
            <section class="recomp-blog-grid-section-wrap">

                <!-- Header & Top Segmented Pagination Command Dock -->
                <div class="recomp-grid-header-row">
                    <div class="recomp-grid-header-titles">
                        <div class="recomp-grid-kicker">
                            ✦ MASTER ARCHIVES &bull; 6 BRIEFINGS PER VIEW
                        </div>
                        <h3 class="recomp-grid-heading">
                            Chronological Technical Intel Stream
                        </h3>
                    </div>

                    <!-- High-End Top Segmented Command Dock -->
                    <div class="recomp-grid-controls-top">
                        <span id="recomp-grid-page-indicator" class="ks-p3-pill-blue recomp-page-telemetry-pill">
                            <span class="ks-wave-text">PAGE 01 OF 02 &bull; BRIEFINGS 01–06</span>
                        </span>
                        <div class="recomp-command-dock recomp-dock-top" role="navigation" aria-label="Archive Pagination Top">
                            <button type="button" id="recomp-prev-btn" onclick="window.recompChangePage(-1)" aria-label="Previous Page" class="recomp-dock-btn recomp-dock-nav ks-p3-btn-blue">
                                <span class="ks-wave-text">&#10094; PREV</span>
                            </button>
                            <button type="button" id="recomp-page-1-btn" onclick="window.recompGoToPage(1)" class="recomp-dock-btn recomp-dock-page is-active ks-p3-btn-gold">
                                <span class="ks-wave-text">● PAGE 01</span>
                            </button>
                            <button type="button" id="recomp-page-2-btn" onclick="window.recompGoToPage(2)" class="recomp-dock-btn recomp-dock-page ks-p3-btn-blue">
                                <span class="ks-wave-text">○ PAGE 02</span>
                            </button>
                            <button type="button" id="recomp-next-btn" onclick="window.recompChangePage(1)" aria-label="Next Page" class="recomp-dock-btn recomp-dock-nav ks-p3-btn-blue">
                                <span class="ks-wave-text">NEXT &#10095;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 2x3 Grid Container (Cards 1 to 6 on Page 1, Cards 7 to 12 on Page 2) -->
                <div id="recomp-intel-grid">

                    <?php
                    $theme_assets_uri = get_stylesheet_directory_uri() . '/assets/images';
                    // 12 Museum-Grade Technical Intel & Sonic Research Briefings (Zero Internal Daemon Leaks)
                    $drops = array(
                        1 => array(
                            'page' => 1, 'slot' => '01', 'cat' => 'AI &amp; ARCHITECTURE', 'date' => 'OCT 2026', 'read' => '12 MIN READ',
                            'title' => 'Autonomous Multi-Agent Swarms: The 28-Agent FastMCP Architecture',
                            'excerpt' => 'Deep-dive architectural breakdown of Wayne Stevenson\'s local 28-agent FastMCP swarms, typed tool contracts, and automated Chrome DevTools execution.',
                            'image' => $theme_assets_uri . '/ai_protocols_banner.png',
                            'link' => '/2026/09/28/autonomous-multi-agent-swarms-fastmcp-architecture/',
                        ),
                        2 => array(
                            'page' => 1, 'slot' => '02', 'cat' => 'CHROME CDP AUTOMATION', 'date' => 'OCT 2026', 'read' => '10 MIN READ',
                            'title' => 'Zero-Cloud Chrome CDP Automation: Eliminating Headless Browser Bot Detection',
                            'excerpt' => 'How to eliminate flaky Selenium and Puppeteer cloud proxies by latching sovereign AI agents directly into an active desktop Chrome browser on Port 9222.',
                            'image' => $theme_assets_uri . '/trading_terminal_luxury.jpg',
                            'link' => '/2026/09/28/chrome-devtools-protocol-cdp-port-9222-automation/',
                        ),
                        3 => array(
                            'page' => 1, 'slot' => '03', 'cat' => 'SONIC ARCHITECTURE', 'date' => 'OCT 2026', 'read' => '15 MIN READ',
                            'title' => 'Sovereign Reverb: Functional Frequency Architecture &amp; High-Cadence Focus',
                            'excerpt' => 'Engineering electronic audio frequencies to sustain deep flow state during intensive building sprints. Complete 22-release studio master telemetry.',
                            'image' => $theme_assets_uri . '/albums/sovereign_reverb.jpg',
                            'link' => '/2026/09/28/sovereign-reverb-functional-frequency-architecture/',
                        ),
                        4 => array(
                            'page' => 1, 'slot' => '04', 'cat' => 'FASTMCP PROTOCOLS', 'date' => 'OCT 2026', 'read' => '11 MIN READ',
                            'title' => 'FastMCP Typed Tool Contracts: Bridging Local Agents with Desktop Workstations',
                            'excerpt' => 'Implementing strictly typed JSON-RPC schemas, non-blocking asynchronous dispatch, and verified tool telemetry across desktop AI workflows.',
                            'image' => $theme_assets_uri . '/ai_protocols_banner.png',
                            'link' => '/ai-protocols/',
                        ),
                        5 => array(
                            'page' => 1, 'slot' => '05', 'cat' => 'QUANTITATIVE INTELLIGENCE', 'date' => 'OCT 2026', 'read' => '13 MIN READ',
                            'title' => 'Deterministic NOAA HRRR Weather Modeling: Autonomous Prediction Swarms',
                            'excerpt' => 'High-resolution rapid refresh physics engines analyzing wind shear and temperature anomalies for convex prediction market positioning.',
                            'image' => $theme_assets_uri . '/trading_terminal_luxury.jpg',
                            'link' => '/investments/',
                        ),
                        6 => array(
                            'page' => 1, 'slot' => '06', 'cat' => 'STUDIO AUDIO TELEMETRY', 'date' => 'OCT 2026', 'read' => '9 MIN READ',
                            'title' => 'Low-Latency Desktop Voice &amp; Acoustic Telemetry for Creator Workstations',
                            'excerpt' => 'Eliminating cloud audio roundtrips with sub-50ms local neural speech synthesis and studio monitor routing directly on dedicated desktop silicon.',
                            'image' => $theme_assets_uri . '/sonic_universe_banner.png',
                            'link' => '/sonic-universe/',
                        ),
                        7 => array(
                            'page' => 2, 'slot' => '07', 'cat' => 'FINANCIAL ARCHITECTURE', 'date' => 'OCT 2026', 'read' => '14 MIN READ',
                            'title' => 'The 40% Cash Fortress CAD Protocol: Algorithmic Treasury Compounding',
                            'excerpt' => 'Protecting core liquidity with an inviolable 40% cash reserve floor while compounding surplus float through disciplined momentum locks.',
                            'image' => $theme_assets_uri . '/trading_terminal_luxury.jpg',
                            'link' => '/investments/',
                        ),
                        8 => array(
                            'page' => 2, 'slot' => '08', 'cat' => 'GENERATIVE VIDEO', 'date' => 'OCT 2026', 'read' => '12 MIN READ',
                            'title' => 'Google Flow Visual Engineering: Automated Reverse Grid Canvas Workflows',
                            'excerpt' => 'Browser automation protocols for multi-batch prompt generation, virtual scroll canvas management, and consistent visual continuity.',
                            'image' => $theme_assets_uri . '/ai_protocols_banner.png',
                            'link' => '/ai-protocols/',
                        ),
                        9 => array(
                            'page' => 2, 'slot' => '09', 'cat' => 'STUDIO POST-PRODUCTION', 'date' => 'OCT 2026', 'read' => '10 MIN READ',
                            'title' => 'High-Cadence 4K Timeline Assembly &amp; Dynamic -18dB Somatic Audio Ducking',
                            'excerpt' => 'Structuring dual-track 4K video timelines, optical flow pacing, and balanced -18dB background frequency ducking for long-form technical briefings.',
                            'image' => $theme_assets_uri . '/sonic_universe_banner.png',
                            'link' => '/sonic-universe/',
                        ),
                        10 => array(
                            'page' => 2, 'slot' => '10', 'cat' => 'PHYSICAL RECOMPOSITION', 'date' => 'OCT 2026', 'read' => '16 MIN READ',
                            'title' => 'Squamish High-Performance Living: N=1 Physical Recomposition Case Study',
                            'excerpt' => 'Documented 48-pound fat loss, heavy compound strength training, sub-50°F cold water immersion, and metabolic discipline in the Sea-to-Sky corridor.',
                            'image' => $theme_assets_uri . '/whistler_luxury_estate.jpg',
                            'link' => '/lifestyle/',
                        ),
                        11 => array(
                            'page' => 2, 'slot' => '11', 'cat' => 'SOVEREIGN ASSETS', 'date' => 'OCT 2026', 'read' => '13 MIN READ',
                            'title' => 'Sovereign Fideicomiso Real Estate Assets: Multi-Jurisdictional Wealth Defense',
                            'excerpt' => 'Navigating Mexican bank trusts (Fideicomiso) and EU property acquisitions to establish resilient international real estate footholds.',
                            'image' => $theme_assets_uri . '/trading_terminal_luxury.jpg',
                            'link' => '/founder/',
                        ),
                        12 => array(
                            'page' => 2, 'slot' => '12', 'cat' => 'DESKTOP STUDIO APPS', 'date' => 'OCT 2026', 'read' => '15 MIN READ',
                            'title' => 'Building the Custom Tauri Desktop Command Center &amp; Multi-Agent Workspace',
                            'excerpt' => 'How to compile a native Rust and WebView2 desktop command center unifying multi-agent workflows, browser automation, and 6-day guided onboarding.',
                            'image' => $theme_assets_uri . '/wayne_avatar.jpg',
                            'link' => home_url( '/ai-protocols/' ),
                        ),
                    );

                    // Overlay actual published WordPress posts into the 12 slots server-side so thumbnails, titles, excerpts, and reading times are live immediately.
                    foreach ( $published_posts as $idx => $post_obj ) {
                        $slot_num = $idx + 1;
                        if ( $slot_num > 12 || ! ( $post_obj instanceof WP_Post ) ) {
                            break;
                        }
                        $thumb_url = get_the_post_thumbnail_url( $post_obj->ID, 'medium_large' );
                        if ( ! $thumb_url || str_contains( (string) $thumb_url, 'anabolic-window' ) ) {
                            $thumb_url = $drops[ $slot_num ]['image'];
                        }
                        $p_title   = html_entity_decode( wp_strip_all_tags( get_the_title( $post_obj ) ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
                        $p_raw_ex  = ! empty( $post_obj->post_excerpt ) ? (string) $post_obj->post_excerpt : (string) $post_obj->post_content;
                        $p_excerpt = keystone_clean_intel_excerpt( $p_raw_ex, 135 );
                        $p_words   = str_word_count( wp_strip_all_tags( (string) $post_obj->post_content ) );
                        $p_mins    = max( 8, min( 18, (int) ceil( $p_words / 180 ) ) );
                        $p_cat     = keystone_is_music_intel_post( $post_obj ) ? 'SONIC UNIVERSE' : 'AI &amp; ARCHITECTURE';

                        $drops[ $slot_num ]['title']   = $p_title ?: $drops[ $slot_num ]['title'];
                        $drops[ $slot_num ]['excerpt'] = ( strlen( $p_excerpt ) > 20 ) ? $p_excerpt : $drops[ $slot_num ]['excerpt'];
                        $drops[ $slot_num ]['image']   = (string) $thumb_url;
                        $drops[ $slot_num ]['link']    = (string) get_permalink( $post_obj );
                        $drops[ $slot_num ]['date']    = strtoupper( (string) get_the_date( 'M Y', $post_obj ) );
                        $drops[ $slot_num ]['read']    = $p_mins . ' MIN READ';
                        $drops[ $slot_num ]['cat']     = $p_cat;
                    }

                    for ( $i = 1; $i <= 12; $i++ ) :
                        $d               = $drops[ $i ];
                        $page_class      = ( 1 === $d['page'] ) ? 'recomp-grid-page-1' : 'recomp-grid-page-2';
                        $initial_display = ( 1 === $d['page'] ) ? 'display: flex;' : 'display: none;';
                    ?>
                        <article class="recomp-grid-card <?php echo esc_attr( $page_class ); ?>" 
                                 data-slot="<?php echo esc_attr( $d['slot'] ); ?>" 
                                 style="<?php echo esc_attr( $initial_display ); ?>" 
                                 onclick="window.location.href='<?php echo esc_url( $d['link'] ); ?>';">
                            <div class="recomp-card-top-body">
                                <!-- 16:9 Clean Unobstructed Thumbnail (Zero Overlay Badges) -->
                                <div class="recomp-card-thumb-frame">
                                    <img decoding="async" src="<?php echo esc_url( $d['image'] ); ?>" alt="<?php echo esc_attr( $d['title'] ); ?>" class="recomp-card-thumb-img" loading="lazy" />
                                </div>

                                <!-- Category & Date Meta Row -->
                                <div class="recomp-card-meta-row">
                                    <span class="recomp-category-badge ks-p3-pill-blue">
                                        <span class="ks-wave-text"><?php echo wp_kses_post( $d['cat'] ); ?></span>
                                    </span>
                                    <span class="recomp-card-date-label">
                                        <?php echo esc_html( $d['date'] ); ?>
                                    </span>
                                </div>

                                <!-- Title -->
                                <h4 class="recomp-card-title">
                                    <?php echo esc_html( $d['title'] ); ?>
                                </h4>

                                <!-- Excerpt -->
                                <p class="recomp-card-excerpt">
                                    <?php echo esc_html( $d['excerpt'] ); ?>
                                </p>
                            </div>

                            <!-- Leveled Bottom Footer: Action Button on Left + Reading Time Pill on Right -->
                            <div class="recomp-card-footer">
                                <span class="recomp-card-read-btn ks-p3-btn-blue">
                                    <span class="ks-wave-text">Read Technical Intel &rarr;</span>
                                </span>
                                <span class="recomp-card-readtime-pill ks-p3-pill-gold">
                                    <span class="ks-wave-text"><?php echo esc_html( $d['read'] ); ?></span>
                                </span>
                            </div>
                        </article>
                    <?php endfor; ?>

                </div>

                <!-- High-End Bottom Centered Segmented Command Dock (Equal Parallel Buttons Above Footer Line) -->
                <div class="recomp-pagination-bottom">
                    <div class="recomp-command-dock recomp-dock-bottom" role="navigation" aria-label="Archive Pagination Bottom">
                        <button type="button" id="recomp-bottom-prev-btn" onclick="window.recompChangePage(-1)" class="recomp-dock-btn recomp-dock-bottom-btn ks-p3-btn-blue">
                            <span class="ks-wave-text">&#10094; PREVIOUS PAGE</span>
                        </button>
                        <button type="button" id="recomp-bottom-page-1" onclick="window.recompGoToPage(1)" class="recomp-dock-btn recomp-dock-bottom-btn is-active ks-p3-btn-gold">
                            <span class="ks-wave-text">● PAGE 01</span>
                        </button>
                        <button type="button" id="recomp-bottom-page-2" onclick="window.recompGoToPage(2)" class="recomp-dock-btn recomp-dock-bottom-btn ks-p3-btn-blue">
                            <span class="ks-wave-text">○ PAGE 02</span>
                        </button>
                        <button type="button" id="recomp-bottom-next-btn" onclick="window.recompChangePage(1)" class="recomp-dock-btn recomp-dock-bottom-btn ks-p3-btn-blue">
                            <span class="ks-wave-text">NEXT PAGE &#10095;</span>
                        </button>
                    </div>
                </div>

            </section>

        </div>
    </main>
</div>

<!-- Dynamic REST API Ingestion, Pagination & Responsive Engine -->
<script>
window.recompCurrentPage = 1;

window.recompSetDockButtonState = function(btn, isActive, labelText) {
    if (!btn) return;
    var waveSpan = btn.querySelector('.ks-wave-text');
    if (waveSpan) {
        waveSpan.textContent = labelText;
    } else {
        btn.innerHTML = '<span class="ks-wave-text">' + labelText + '</span>';
    }
    if (isActive) {
        btn.classList.add('is-active', 'ks-p3-btn-gold');
        btn.classList.remove('ks-p3-btn-blue');
    } else {
        btn.classList.remove('is-active', 'ks-p3-btn-gold');
        btn.classList.add('ks-p3-btn-blue');
    }
};

window.recompGoToPage = function(p) {
    window.recompCurrentPage = p;
    var p1Cards = document.querySelectorAll('.recomp-grid-page-1');
    var p2Cards = document.querySelectorAll('.recomp-grid-page-2');
    var ind = document.getElementById('recomp-grid-page-indicator');
    var b1 = document.getElementById('recomp-page-1-btn');
    var b2 = document.getElementById('recomp-page-2-btn');
    var bb1 = document.getElementById('recomp-bottom-page-1');
    var bb2 = document.getElementById('recomp-bottom-page-2');

    if (p === 1) {
        p1Cards.forEach(function(c) { c.style.display = 'flex'; });
        p2Cards.forEach(function(c) { c.style.display = 'none'; });
        if (ind) {
            var indSpan = ind.querySelector('.ks-wave-text') || ind;
            indSpan.textContent = 'PAGE 01 OF 02 • BRIEFINGS 01–06';
        }
        window.recompSetDockButtonState(b1, true, '● PAGE 01');
        window.recompSetDockButtonState(b2, false, '○ PAGE 02');
        window.recompSetDockButtonState(bb1, true, '● PAGE 01');
        window.recompSetDockButtonState(bb2, false, '○ PAGE 02');
    } else {
        p1Cards.forEach(function(c) { c.style.display = 'none'; });
        p2Cards.forEach(function(c) { c.style.display = 'flex'; });
        if (ind) {
            var indSpan2 = ind.querySelector('.ks-wave-text') || ind;
            indSpan2.textContent = 'PAGE 02 OF 02 • BRIEFINGS 07–12';
        }
        window.recompSetDockButtonState(b1, false, '○ PAGE 01');
        window.recompSetDockButtonState(b2, true, '● PAGE 02');
        window.recompSetDockButtonState(bb1, false, '○ PAGE 01');
        window.recompSetDockButtonState(bb2, true, '● PAGE 02');
    }
};

window.recompChangePage = function(delta) {
    var nextP = window.recompCurrentPage + delta;
    if (nextP < 1) nextP = 1;
    if (nextP > 2) nextP = 2;
    window.recompGoToPage(nextP);
};

function recompDecodeHtml(raw) {
    var el = document.createElement('div');
    el.innerHTML = raw;
    return (el.textContent || el.innerText || '').trim();
}

function recompStripCrossPromo(rawHtml) {
    var html = rawHtml || '';
    var markers = ['Related Keystone Engineering Briefings', 'New 2026 Keystone Engineering Briefing'];
    for (var i = 0; i < markers.length; i++) {
        var idx = html.indexOf(markers[i]);
        if (idx !== -1) {
            html = html.substring(0, Math.max(0, idx - 120));
        }
    }
    return html;
}

function recompExtractYoutubeIds(rawHtml, retiredIds) {
    var html = recompStripCrossPromo(rawHtml);
    var allIds = [];
    var shortId = null;
    var isrc = null;

    var isrcMatch = html.match(/ISRC:\s*(?:<[^>]+>)*([A-Z0-9]{12})/i);
    if (isrcMatch && isrcMatch[1]) {
        isrc = isrcMatch[1].toUpperCase();
    }

    // 1. Explicit /shorts/{ID} link is always the 9:16 Short
    var explicitShort = html.match(/youtube(?:-nocookie)?\.com\/shorts\/([a-zA-Z0-9_-]{11})/i);
    if (explicitShort && explicitShort[1] && retiredIds.indexOf(explicitShort[1]) === -1) {
        shortId = explicitShort[1];
    }

    // 2. If #field-companion-short section exists, any embed inside/after it is the 9:16 Short
    if (!shortId) {
        var secIdx = html.toLowerCase().indexOf('field-companion-short');
        if (secIdx !== -1) {
            var secHtml = html.substring(secIdx);
            var secMatch = secHtml.match(/(?:youtube(?:-nocookie)?\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i);
            if (secMatch && secMatch[1] && retiredIds.indexOf(secMatch[1]) === -1) {
                shortId = secMatch[1];
            }
        }
    }

    // 3. Collect all YouTube IDs in document order (supporting both youtube.com and youtube-nocookie.com)
    var ytRegex = /(?:youtube(?:-nocookie)?\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/gi;
    var match;
    while ((match = ytRegex.exec(html)) !== null) {
        if (match[1] && retiredIds.indexOf(match[1]) === -1 && allIds.indexOf(match[1]) === -1) {
            allIds.push(match[1]);
        }
    }

    // 4. First video ID that is NOT shortId is the 16:9 Long-Form video
    var longId = null;
    for (var i = 0; i < allIds.length; i++) {
        if (allIds[i] !== shortId) {
            longId = allIds[i];
            break;
        }
    }
    if (!longId && allIds.length > 0) longId = allIds[0];
    if (!shortId && allIds.length > 1) {
        for (var j = 0; j < allIds.length; j++) {
            if (allIds[j] !== longId) {
                shortId = allIds[j];
                break;
            }
        }
    }
    return { longId: longId, shortId: shortId, isrc: isrc };
}

async function loadPublishedIntel() {
    try {
        var u = new URL('/wp-json/wp/v2/posts', window.location.origin);
        u.searchParams.set('per_page', '16');
        u.searchParams.set('_embed', '1');
        u.searchParams.set('orderby', 'date');
        u.searchParams.set('order', 'desc');
        u.searchParams.set('status', 'publish');

        var response = await fetch(u.toString());
        if (!response.ok) return;
        var posts = await response.json();
        if (!Array.isArray(posts) || posts.length === 0) return;

        var retiredIds = ['3rYyZ0c8_1o', 'XUiFyItyyzo'];

        var isMusicPost = function(p) {
            var cats = Array.isArray(p.categories) ? p.categories : [];
            var slug = (p.slug || '').toLowerCase();
            var title = ((p.title && p.title.rendered) || '').toLowerCase();
            if (cats.indexOf(1442) !== -1 && cats.indexOf(1538) === -1) return true;
            if (slug.indexOf('iron-grace') !== -1 || slug.indexOf('sovereign-reverb') !== -1 || slug.indexOf('heavy-civil-focus') !== -1 || slug.indexOf('peak-intensity') !== -1 || title.indexOf('somatic deep house') !== -1 || title.indexOf('official 4k music video') !== -1) return true;
            return false;
        };
        var isAiProtocolsPost = function(p) {
            return !isMusicPost(p);
        };

        var latestAiShortFallback = '8oPAZPsTOiw';
        var latestSoundShortFallback = '9Aa98IGWKpU';
        for (var k = 0; k < posts.length; k++) {
            if (posts[k].content && posts[k].content.rendered) {
                var probeIds = recompExtractYoutubeIds(posts[k].content.rendered, retiredIds);
                if (isAiProtocolsPost(posts[k]) && probeIds.shortId && latestAiShortFallback === '8oPAZPsTOiw') {
                    latestAiShortFallback = probeIds.shortId;
                }
                if (isMusicPost(posts[k]) && probeIds.shortId && latestSoundShortFallback === '9Aa98IGWKpU') {
                    latestSoundShortFallback = probeIds.shortId;
                }
            }
        }

        // 1A. Ingest Featured AI Post into Top Blue Hero Section (Long-Form 16:9 Top, Short-Form 9:16 Bottom)
        var featuredPost = posts.find(function(p) {
            if (!isAiProtocolsPost(p)) return false;
            var m = recompExtractYoutubeIds((p.content && p.content.rendered) || '', retiredIds);
            return Boolean(m.longId);
        }) || posts.find(isAiProtocolsPost) || posts[0];

        var featTitle = document.getElementById('recomp-featured-title');
        var featExcerpt = document.getElementById('recomp-featured-excerpt');
        var featLink = document.getElementById('recomp-featured-link');
        var featDate = document.getElementById('recomp-featured-date');
        var featShortTitle = document.getElementById('recomp-featured-short-title');
        var featShortDesc = document.getElementById('recomp-featured-short-desc');

        var decodedAiTitle = '';
        if (featuredPost.title && featuredPost.title.rendered) {
            decodedAiTitle = recompDecodeHtml(featuredPost.title.rendered);
            if (featTitle) featTitle.textContent = decodedAiTitle;
        }
        if (featExcerpt && featuredPost.excerpt && featuredPost.excerpt.rendered) {
            var cleanExcerpt = recompDecodeHtml(featuredPost.excerpt.rendered)
                .replace(/\[.*?\]/g, '')
                .replace(/Related Keystone Engineering Briefings[\s\S]*/i, '')
                .replace(/New 2026 Keystone Engineering Briefing[\s\S]*/i, '')
                .replace(/^\/\/\s*2026[^\n\r.]*[\n\r.]*\s*/i, '')
                .replace(/^\/\/\s*[A-Z0-9 _•&\/:-]{6,85}\s*/i, '')
                .replace(/\s*\((?:ISRC|UPC)[^)]*\)/gi, '')
                .replace(/\b(?:ISRC|UPC)\s*:?\s*[A-Z0-9-]{8,16}\b/gi, '')
                .trim();
            if (cleanExcerpt.length > 20) {
                featExcerpt.innerText = cleanExcerpt.substring(0, 240) + (cleanExcerpt.length > 240 ? '...' : '');
            }
        }
        if (featLink && featuredPost.link) {
            featLink.href = featuredPost.link;
        }
        if (featDate && featuredPost.date) {
            featDate.innerText = new Date(featuredPost.date).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
        }

        var contentHtml = (featuredPost.content && featuredPost.content.rendered) ? featuredPost.content.rendered : '';
        var aiMedia = recompExtractYoutubeIds(contentHtml, retiredIds);
        var longIframe = document.getElementById('recomp-featured-long-video');
        var shortIframe = document.getElementById('recomp-featured-short-video');
        var shortLink = document.getElementById('recomp-featured-short-link');

        if (aiMedia.longId && longIframe) {
            var targetLongSrc = 'https://www.youtube.com/embed/' + aiMedia.longId + '?rel=0';
            if (longIframe.getAttribute('src') !== targetLongSrc) {
                longIframe.src = targetLongSrc;
            }
        }
        var activeAiShortId = aiMedia.shortId || latestAiShortFallback;
        if (activeAiShortId) {
            var targetShortSrc = 'https://www.youtube.com/embed/' + activeAiShortId + '?rel=0';
            if (shortIframe && shortIframe.getAttribute('src') !== targetShortSrc) {
                shortIframe.src = targetShortSrc;
            }
            if (shortLink) shortLink.href = 'https://youtube.com/shorts/' + activeAiShortId;
        }
        if (decodedAiTitle) {
            var shortPrefix = decodedAiTitle.split(':')[0].trim();
            if (featShortTitle) featShortTitle.textContent = shortPrefix + ' — 9:16 Field Short';
            if (featShortDesc) featShortDesc.textContent = 'Rapid 40-second vertical field briefing & companion architectural breakdown for ' + shortPrefix + '.';
        }

        // 1B. Ingest Featured Sonic Universe / Music Post into Bottom Gold Hero Section (Long-Form 16:9 Top, Short-Form 9:16 Bottom)
        var featuredSoundPost = posts.find(function(p) {
            if (featuredPost && p.id === featuredPost.id) return false;
            if (!isMusicPost(p)) return false;
            var m = recompExtractYoutubeIds((p.content && p.content.rendered) || '', retiredIds);
            return Boolean(m.longId);
        }) || posts.find(function(p) {
            return (!featuredPost || p.id !== featuredPost.id) && isMusicPost(p);
        });

        if (featuredSoundPost) {
            var soundTitle = document.getElementById('recomp-featured-sound-title');
            var soundExcerpt = document.getElementById('recomp-featured-sound-excerpt');
            var soundLink = document.getElementById('recomp-featured-sound-link');
            var soundDate = document.getElementById('recomp-featured-sound-date');
            var soundVideo = document.getElementById('recomp-featured-sound-video');
            var soundShortVideo = document.getElementById('recomp-featured-sound-short-video');
            var soundShortLink = document.getElementById('recomp-featured-sound-short-link');
            var soundYtBtn = document.getElementById('recomp-featured-sound-yt-btn');
            var soundSub = document.getElementById('recomp-featured-sound-sub');
            var soundShortDesc = document.getElementById('recomp-featured-sound-short-desc');
            var soundKicker = document.getElementById('recomp-featured-sound-kicker');

            var decodedSoundTitle = '';
            if (featuredSoundPost.title && featuredSoundPost.title.rendered) {
                decodedSoundTitle = recompDecodeHtml(featuredSoundPost.title.rendered);
                if (soundTitle) soundTitle.textContent = decodedSoundTitle;
            }
            if (soundExcerpt && featuredSoundPost.excerpt && featuredSoundPost.excerpt.rendered) {
                var cleanSoundExcerpt = recompDecodeHtml(featuredSoundPost.excerpt.rendered)
                    .replace(/\[.*?\]/g, '')
                    .replace(/Related Keystone Engineering Briefings[\s\S]*/i, '')
                    .replace(/New 2026 Keystone Engineering Briefing[\s\S]*/i, '')
                    .replace(/^\/\/\s*2026[^\n\r.]*[\n\r.]*\s*/i, '')
                    .replace(/^\/\/\s*[A-Z0-9 _•&\/:-]{6,85}\s*/i, '')
                    .replace(/\s*\((?:ISRC|UPC)[^)]*\)/gi, '')
                    .replace(/\b(?:ISRC|UPC)\s*:?\s*[A-Z0-9-]{8,16}\b/gi, '')
                    .trim();
                if (cleanSoundExcerpt.length > 20) {
                    soundExcerpt.innerText = cleanSoundExcerpt.substring(0, 240) + (cleanSoundExcerpt.length > 240 ? '...' : '');
                }
            }
            if (soundLink && featuredSoundPost.link) {
                soundLink.href = featuredSoundPost.link;
            }
            if (soundDate && featuredSoundPost.date) {
                soundDate.innerText = new Date(featuredSoundPost.date).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
            }

            var soundHtml = (featuredSoundPost.content && featuredSoundPost.content.rendered) ? featuredSoundPost.content.rendered : '';
            var soundMedia = recompExtractYoutubeIds(soundHtml, retiredIds);
            if (soundMedia.longId) {
                var targetSoundLong = 'https://www.youtube.com/embed/' + soundMedia.longId + '?rel=0';
                if (soundVideo && soundVideo.getAttribute('src') !== targetSoundLong) {
                    soundVideo.src = targetSoundLong;
                }
                if (soundYtBtn) soundYtBtn.href = 'https://youtu.be/' + soundMedia.longId;
            }
            var activeSoundShortId = soundMedia.shortId || latestSoundShortFallback;
            if (activeSoundShortId) {
                var targetSoundShort = 'https://www.youtube.com/embed/' + activeSoundShortId + '?rel=0';
                if (soundShortVideo && soundShortVideo.getAttribute('src') !== targetSoundShort) {
                    soundShortVideo.src = targetSoundShort;
                }
                if (soundShortLink) soundShortLink.href = 'https://youtube.com/shorts/' + activeSoundShortId;
            }
            if (soundKicker) {
                var kickerSpan = soundKicker.querySelector('.ks-wave-text') || soundKicker;
                kickerSpan.textContent = '🎵 24-BIT / 48kHz LOSSLESS STUDIO MASTER • VERIFIED OAC';
            }
            if (decodedSoundTitle) {
                var sPrefix = decodedSoundTitle.split(':')[0].replace(/Keystone Recomposition/i, '').trim();
                if (soundSub) soundSub.textContent = sPrefix + ' — 9:16 Somatic Short';
                if (soundShortDesc) soundShortDesc.textContent = '24-Bit Somatic Deep House & Solo Cello Vertical Drop • Too Lost Digital Distribution';
            }
        }

        // 2. Populate Grid Cards with actual published posts (Clean Thumbnails + Reading Time at Bottom)
        var cards = document.querySelectorAll('.recomp-grid-card');
        posts.forEach(function(post, idx) {
            if (idx < cards.length) {
                var card = cards[idx];
                var postMedia = (post._embedded && post._embedded['wp:featuredmedia']) ? post._embedded['wp:featuredmedia'][0] : null;
                var postThumb = null;
                if (postMedia) {
                    if (postMedia.media_details && postMedia.media_details.sizes && postMedia.media_details.sizes.medium_large) {
                        postThumb = postMedia.media_details.sizes.medium_large.source_url;
                    } else {
                        postThumb = postMedia.source_url;
                    }
                }

                var postTitle = (post.title && post.title.rendered) ? recompDecodeHtml(post.title.rendered) : '';
                var postExcerpt = '';
                if (post.excerpt && post.excerpt.rendered) {
                    var cEx = recompDecodeHtml(post.excerpt.rendered)
                        .replace(/\[.*?\]/g, '')
                        .replace(/Related Keystone Engineering Briefings[\s\S]*/i, '')
                        .replace(/New 2026 Keystone Engineering Briefing[\s\S]*/i, '')
                        .replace(/^\/\/\s*2026[^\n\r.]*[\n\r.]*\s*/i, '')
                        .replace(/^\/\/\s*[A-Z0-9 _•&\/:-]{6,85}\s*/i, '')
                        .replace(/\s*\((?:ISRC|UPC)[^)]*\)/gi, '')
                        .replace(/\b(?:ISRC|UPC)\s*:?\s*[A-Z0-9-]{8,16}\b/gi, '')
                        .trim();
                    postExcerpt = cEx.substring(0, 130) + '...';
                }

                if (postThumb && postThumb.indexOf('anabolic-window') === -1) {
                    var imgEl = card.querySelector('img');
                    if (imgEl) imgEl.src = postThumb;
                }
                if (postTitle) {
                    var titleEl = card.querySelector('.recomp-card-title');
                    if (titleEl) titleEl.textContent = postTitle;
                }
                if (postExcerpt) {
                    var excerptEl = card.querySelector('.recomp-card-excerpt');
                    if (excerptEl) excerptEl.textContent = postExcerpt;
                }
                if (post.date) {
                    var dateEl = card.querySelector('.recomp-card-date-label');
                    if (dateEl) {
                        dateEl.textContent = new Date(post.date).toLocaleDateString('en-US', { month: 'short', year: 'numeric' }).toUpperCase();
                    }
                }
                if (post.content && post.content.rendered) {
                    var textWords = recompDecodeHtml(post.content.rendered).split(/\s+/).length;
                    var mins = Math.max(8, Math.min(18, Math.ceil(textWords / 180)));
                    var readPill = card.querySelector('.recomp-card-readtime-pill .ks-wave-text') || card.querySelector('.recomp-card-readtime-pill');
                    if (readPill) readPill.textContent = mins + ' MIN READ';
                }
                card.style.cursor = 'pointer';
                card.onclick = function() {
                    window.location.href = post.link;
                };
            }
        });
    } catch (e) {
        console.warn('[Keystone Recomposition Intel] Ingestion check:', e);
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadPublishedIntel);
} else {
    loadPublishedIntel();
}
</script>

<?php get_footer(); ?>
