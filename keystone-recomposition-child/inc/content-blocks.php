<?php
function keystone_lazy_video_shortcode( $atts ) {
    $args = shortcode_atts( array(
        'id'   => '',
        'type' => 'youtube',
        'placeholder_img' => '',
    ), $atts );

    if ( empty( $args['id'] ) ) {
        return '<p style="color: #FC8181; font-family: monospace;">[Error] Media Asset ID is missing.</p>';
    }

    $media_id   = esc_attr( $args['id'] );
    $media_type = esc_attr( strtolower( $args['type'] ) );
    
    $bg_img = '';
    if ( ! empty( $args['placeholder_img'] ) ) {
        $bg_img = esc_url( $args['placeholder_img'] );
    } elseif ( $media_type === 'youtube' ) {
        $bg_img = 'https://img.youtube.com/vi/' . $media_id . '/maxresdefault.jpg';
    } else {
        $bg_img = 'https://keystonerecomposition.com/wp-content/uploads/video-placeholder.jpg';
    }

    wp_enqueue_script( 'keystone-lazy-player', get_stylesheet_directory_uri() . '/js/lazy-player.js', array(), '1.0.0', true );

    ob_start();
    ?>
    <div class="luxury-video-facade" 
         data-video-id="<?php echo $media_id; ?>" 
         data-video-type="<?php echo $media_type; ?>" 
         role="region" 
         aria-label="Video Player Placeholder">
        
        <div class="facade-background" style="background-image: url('<?php echo $bg_img; ?>');"></div>
        <div class="facade-overlay"></div>
        
        <button class="play-button" aria-label="Play Embedded Video">
            <svg class="play-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 5V19L19 12L8 5Z" fill="currentColor"/>
            </svg>
        </button>
        <noscript>
            <iframe src="https://www.youtube.com/embed/<?php echo $media_id; ?>?rel=0" width="100%" height="100%" style="position: absolute; top: 0; left: 0;" frameborder="0" allowfullscreen></iframe>
        </noscript>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'keystone_video', 'keystone_lazy_video_shortcode' );

/**
 * 13.5 Deduplicate Video Facades (Google Search Fix)
 * Prevents Google from detecting multiple VideoObject signals on the same page.
 * Root cause: the Watch page healer copies parent post content that contains both
 * a [keystone_video] shortcode AND raw facade HTML pasted in the editor.
 * This filter keeps only the FIRST luxury-video-facade block per YouTube video ID.
 * Safe: only affects rendering, does NOT modify stored post content.
 * Stamped: 2026-07-23
 */
function keystone_deduplicate_video_facades( $content ) {
    if ( ! is_singular() ) {
        return $content;
    }

    // Quick bail: if 0-1 facade blocks exist, no dedup needed
    if ( substr_count( $content, 'luxury-video-facade' ) <= 1 ) {
        return $content;
    }

    // Position-based approach: find all facade opening tags, extract video IDs,
    // then remove everything from duplicate opening tags through the next </noscript> + closing </div>
    $seen_ids = array();
    $offset = 0;
    $marker = 'luxury-video-facade';

    while ( ( $pos = strpos( $content, $marker, $offset ) ) !== false ) {
        // Find the opening <div that contains this marker
        $div_start = strrpos( $content, '<div', $pos - strlen( $content ) );
        if ( $div_start === false ) {
            $offset = $pos + strlen( $marker );
            continue;
        }

        // Extract video ID from data-video-id attribute
        $chunk = substr( $content, $pos, 300 );
        if ( ! preg_match( '/data-video-id=["\']([^"\']+)/', $chunk, $id_match ) ) {
            $offset = $pos + strlen( $marker );
            continue;
        }
        $video_id = $id_match[1];

        // Find the end of this facade block: search for </noscript> after current position
        $noscript_end = strpos( $content, '</noscript>', $pos );
        if ( $noscript_end === false ) {
            $offset = $pos + strlen( $marker );
            continue;
        }
        $noscript_end += strlen( '</noscript>' );

        // Find the next </div> after </noscript>
        $div_end = strpos( $content, '</div>', $noscript_end );
        if ( $div_end === false ) {
            $offset = $pos + strlen( $marker );
            continue;
        }
        $div_end += strlen( '</div>' );

        if ( isset( $seen_ids[ $video_id ] ) ) {
            // Remove this duplicate block
            $content = substr( $content, 0, $div_start )
                     . '<!-- keystone-dedup: removed duplicate facade for ' . $video_id . ' -->'
                     . substr( $content, $div_end );
            // Don't advance offset since content shifted
        } else {
            $seen_ids[ $video_id ] = true;
            $offset = $div_end;
        }
    }

    return $content;
}
add_filter( 'the_content', 'keystone_deduplicate_video_facades', 15 );

/**
 * Helper: Strip duplicate facade HTML blocks from a raw content string.
 * Used by the Watch page healer to prevent duplicates when copying parent post content.
 */
function keystone_strip_duplicate_facades( $content ) {
    if ( substr_count( $content, 'luxury-video-facade' ) <= 1 ) {
        return $content;
    }
    $seen_ids = array();
    $offset = 0;
    $marker = 'luxury-video-facade';

    while ( ( $pos = strpos( $content, $marker, $offset ) ) !== false ) {
        $div_start = strrpos( $content, '<div', $pos - strlen( $content ) );
        if ( $div_start === false ) { $offset = $pos + strlen( $marker ); continue; }

        $chunk = substr( $content, $pos, 300 );
        if ( ! preg_match( '/data-video-id=["\']([^"\']+)/', $chunk, $id_match ) ) {
            $offset = $pos + strlen( $marker ); continue;
        }
        $video_id = $id_match[1];

        $noscript_end = strpos( $content, '</noscript>', $pos );
        if ( $noscript_end === false ) { $offset = $pos + strlen( $marker ); continue; }
        $noscript_end += strlen( '</noscript>' );

        $div_end = strpos( $content, '</div>', $noscript_end );
        if ( $div_end === false ) { $offset = $pos + strlen( $marker ); continue; }
        $div_end += strlen( '</div>' );

        if ( isset( $seen_ids[ $video_id ] ) ) {
            $content = substr( $content, 0, $div_start ) . substr( $content, $div_end );
        } else {
            $seen_ids[ $video_id ] = true;
            $offset = $div_end;
        }
    }
    return $content;
}

/**
 * 14. Inject Premium Grid Alignment Custom CSS directly in wp_head
 */
function keystone_recomposition_child_inject_custom_css() {
    ?>
    <style id="keystone-protocols-premium-grid">
    .ast-blog-layout-4-grid .ast-row,
    .ast-blog-layout-4-grid .infinite-wrap {
      display: grid !important;
      grid-template-columns: repeat(2, 1fr) !important;
      column-gap: 45px !important;
      row-gap: 55px !important;
    }
    @media (max-width: 768px) {
      .ast-blog-layout-4-grid .ast-row,
      .ast-blog-layout-4-grid .infinite-wrap {
        grid-template-columns: 1fr !important;
        row-gap: 45px !important;
      }
    }
    .ast-blog-layout-4-grid .ast-row article,
    .ast-blog-layout-4-grid .infinite-wrap article {
      width: 100% !important;
      min-width: 0 !important;
      float: none !important;
      margin: 0px !important;
      display: flex !important;
      flex-direction: column !important;
      height: 100% !important;
      background: #080808 !important;
      border: 1px solid rgba(196, 162, 101, 0.1) !important;
      padding: 0px !important;
      transition: border-color 0.3s ease, box-shadow 0.3s ease !important;
    }
    .ast-blog-layout-4-grid .ast-row article:hover,
    .ast-blog-layout-4-grid .infinite-wrap article:hover {
      border-color: rgba(196, 162, 101, 0.3) !important;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
    }
    .ast-blog-layout-4-grid .ast-row article .ast-article-inner,
    .ast-blog-layout-4-grid .infinite-wrap article .ast-article-inner {
      flex: 1 1 0% !important;
      display: flex !important;
      flex-direction: column !important;
      height: 100% !important;
      padding: 0px !important;
      margin: 0px !important;
    }
    .ast-blog-layout-4-grid .ast-row article .post-thumb,
    .ast-blog-layout-4-grid .infinite-wrap article .post-thumb {
      overflow: hidden !important;
      margin: 0px !important;
      padding: 0px !important;
      border-bottom: 2px solid rgba(196, 162, 101, 0.15) !important;
    }
    .ast-blog-layout-4-grid .ast-row article .post-thumb img,
    .ast-blog-layout-4-grid .infinite-wrap article .post-thumb img {
      height: 320px !important;
      width: 100% !important;
      object-fit: cover !important;
      border-radius: 0px !important;
      transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }
    .ast-blog-layout-4-grid .ast-row article:hover .post-thumb img,
    .ast-blog-layout-4-grid .infinite-wrap article:hover .post-thumb img {
      transform: scale(1.04) !important;
    }
    .ast-blog-layout-4-grid .ast-row article .post-content,
    .ast-blog-layout-4-grid .infinite-wrap article .post-content {
      flex: 1 1 0% !important;
      display: flex !important;
      flex-direction: column !important;
      justify-content: flex-start !important;
      padding: 30px 25px 25px 25px !important;
      background: #080808 !important;
    }
    .ast-blog-layout-4-grid h2.entry-title {
      font-size: 20px !important;
      line-height: 1.35 !important;
      letter-spacing: 1.5px !important;
      text-transform: uppercase !important;
      margin: 10px 0 15px 0 !important;
      font-family: 'Outfit', sans-serif !important;
      font-weight: 700 !important;
    }
    .ast-blog-layout-4-grid h2.entry-title a {
      color: #c4a265 !important;
      text-decoration: none !important;
      font-size: 20px !important;
      line-height: 1.35 !important;
      letter-spacing: 1.5px !important;
      transition: color 0.3s ease !important;
    }
    .ast-blog-layout-4-grid h2.entry-title a:hover {
      color: #ffffff !important;
    }
    .ast-blog-layout-4-grid .entry-meta, 
    .ast-blog-layout-4-grid .entry-meta a {
      color: #737373 !important;
      font-size: 11px !important;
      text-transform: uppercase !important;
      letter-spacing: 1px !important;
      text-decoration: none !important;
    }
    .ast-blog-layout-4-grid .entry-meta a:hover {
      color: #c4a265 !important;
    }
    .ast-blog-layout-4-grid .ast-blog-single-element {
      margin-bottom: 12px !important;
    }
    .ast-blog-layout-4-grid .entry-content,
    .ast-blog-layout-4-grid .entry-content p {
      color: #a3a3a3 !important;
      font-size: 13px !important;
      line-height: 1.7 !important;
      font-weight: 300 !important;
      letter-spacing: 0.5px !important;
      margin-bottom: 20px !important;
    }
    
    /* Single Post Header Refinements (Quiet Luxury) */
    .single-post .entry-header {
      text-align: center !important;
      margin-top: 15px !important;
      margin-bottom: 35px !important;
      max-width: 850px !important;
      margin-left: auto !important;
      margin-right: auto !important;
      padding: 0 10px !important;
    }
    .single-post h1.entry-title {
      font-family: 'Outfit', sans-serif !important;
      font-size: clamp(24px, 3.8vw, 36px) !important;
      font-weight: 700 !important;
      text-transform: uppercase !important;
      letter-spacing: 0.025em !important;
      color: #ffffff !important;
      line-height: 1.25 !important;
      margin-bottom: 15px !important;
    }
    .single-post .entry-meta,
    .single-post .entry-meta a {
      font-family: 'Outfit', sans-serif !important;
      font-size: 11px !important;
      text-transform: uppercase !important;
      letter-spacing: 0.15em !important;
      color: #c4a265 !important;
      text-decoration: none !important;
    }
    .single-post .entry-meta .posted-on {
      color: #a3a3a3 !important;
    }
    .single-post .entry-meta .author-name {
      color: #00ced1 !important;
      font-weight: 600 !important;
    }
    </style>
    <?php
}
add_action( 'wp_head', 'keystone_recomposition_child_inject_custom_css', 150 );

/**
 * 14.5 E-E-A-T Author Credentials Block
 */
function keystone_recomposition_child_eeat_author_block( $content ) {
    if ( is_singular( 'post' ) && is_main_query() ) {
        $author_block = '
        <div class="keystone-eeat-author-block" style="background-color: #0a0a0a; border-left: 4px solid #c4a265; padding: 25px; margin-top: 50px; margin-bottom: 30px; border-radius: 4px;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <img src="https://keystonerecomposition.com/wp-content/uploads/logo.png" alt="Wayne Stevenson" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                <div>
                    <h3 style="color: #ffffff; font-family: \'Outfit\', sans-serif; font-size: 1.2rem; margin: 0 0 5px 0;">Wayne Stevenson</h3>
                    <p style="color: #c4a265; font-family: \'Outfit\', sans-serif; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 10px 0;">Certified BC Builder & Metabolic Researcher</p>
                    <p style="color: #a3a3a3; font-family: \'Inter\', sans-serif; font-size: 0.85rem; line-height: 1.6; margin: 0;">This content is meticulously researched and documented for the preservation of male health and longevity. Operating under strict E-E-A-T principles for high-quality health information.</p>
                </div>
            </div>
        </div>';
        $content .= $author_block;
    }
    return $content;
}
add_filter( 'the_content', 'keystone_recomposition_child_eeat_author_block', 98 );

/**
 * 15. Automatically Append YouTube Subscribe Buttons to All Pages and Posts
 */
function keystone_recomposition_child_append_subscribe_buttons( $content ) {
    if ( is_singular() && is_main_query() ) {
        if ( strpos( $content, 'sub_confirmation=1' ) === false ) {
            $subscribe_html = '
            <div class="keystone-global-subscribe-buttons" style="display:flex; flex-wrap:wrap; gap:15px; margin-top:40px; margin-bottom: 40px; justify-content: center; align-items: center;">
                <a href="https://www.youtube.com/@keystonerecomposition?sub_confirmation=1" target="_blank" rel="noopener" style="background-color:#cc0000; color:#fff; padding: 12px 24px; border-radius: 4px; text-decoration: none; font-weight: 700; font-family: Outfit, sans-serif; text-transform: uppercase; letter-spacing: 0.05em; transition: opacity 0.3s ease;">&#9654; Subscribe: Keystone Recomposition</a>
                <a href="https://www.youtube.com/@keystoneprotocols?sub_confirmation=1" target="_blank" rel="noopener" style="background-color:#cc0000; color:#fff; padding: 12px 24px; border-radius: 4px; text-decoration: none; font-weight: 700; font-family: Outfit, sans-serif; text-transform: uppercase; letter-spacing: 0.05em; transition: opacity 0.3s ease;">&#9654; Subscribe: Keystone Protocols</a>
            </div>';
            $content .= $subscribe_html;
        }
    }
    return $content;
}
add_filter( 'the_content', 'keystone_recomposition_child_append_subscribe_buttons', 99 );

/**
 * 16. Fallback Post Thumbnail to YouTube Video Thumbnail
 */
add_filter( 'get_post_metadata', 'keystone_fallback_thumbnail_id', 10, 4 );
function keystone_fallback_thumbnail_id( $value, $object_id, $meta_key, $single ) {
    if ( '_thumbnail_id' === $meta_key ) {
        remove_filter( 'get_post_metadata', 'keystone_fallback_thumbnail_id', 10 );
        $real_id = get_post_meta( $object_id, '_thumbnail_id', true );
        add_filter( 'get_post_metadata', 'keystone_fallback_thumbnail_id', 10, 4 );
        
        if ( ! empty( $real_id ) ) {
            return $value;
        }
        
        $youtube_id = get_post_meta( $object_id, 'keystone_youtube_id', true );
        if ( empty( $youtube_id ) ) {
            $post_obj = get_post( $object_id );
            if ( $post_obj && ! empty( $post_obj->post_content ) ) {
                if ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=|embed/)|youtu\.be/|youtube\.com/shorts/)([^"&?/ ]{11})~i', $post_obj->post_content, $matches ) ) {
                    $youtube_id = $matches[1];
                }
            }
        }
        
        if ( ! empty( $youtube_id ) ) {
            global $keystone_fake_thumbnails;
            if ( ! isset( $keystone_fake_thumbnails ) ) {
                $keystone_fake_thumbnails = array();
            }
            $fake_id = - (int) $object_id;
            $keystone_fake_thumbnails[ $fake_id ] = $youtube_id;
            return $fake_id;
        }
    }
    return $value;
}

add_filter( 'wp_get_attachment_image_src', 'keystone_fake_thumbnail_src', 10, 4 );
function keystone_fake_thumbnail_src( $image, $attachment_id, $size, $icon ) {
    global $keystone_fake_thumbnails;
    if ( $attachment_id < 0 && isset( $keystone_fake_thumbnails[ $attachment_id ] ) ) {
        $youtube_id = $keystone_fake_thumbnails[ $attachment_id ];
        $url = "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
        return array( $url, 1280, 720, false );
    }
    return $image;
}

add_filter( 'wp_get_attachment_image', 'keystone_fake_thumbnail_image', 10, 5 );
function keystone_fake_thumbnail_image( $html, $attachment_id, $size, $icon, $attr ) {
    global $keystone_fake_thumbnails;
    if ( $attachment_id < 0 && isset( $keystone_fake_thumbnails[ $attachment_id ] ) ) {
        $youtube_id = $keystone_fake_thumbnails[ $attachment_id ];
        $url = "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
        $alt = isset($attr['alt']) ? $attr['alt'] : '';
        $class = isset($attr['class']) ? $attr['class'] : 'attachment-post-thumbnail size-post-thumbnail wp-post-image';
        return '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '" class="' . esc_attr( $class ) . '" decoding="async" loading="lazy" style="width:100%; height:100%; object-fit:cover;" />';
    }
    return $html;
}

/**
 * 17. Custom Video Sitemap Generator (Bypasses Rank Math)
 * Generates a Google-compliant video sitemap XML at /keystone-video-sitemap.xml
 * Bypasses Rank Math's broken default modules while perfectly integrating into the Rank Math Sitemap Index.
 */

// ------------------------------------------------------------------
// BULLETPROOF SITEMAP ROUTING
// ------------------------------------------------------------------
// Register the custom rewrite rule for clean URL (Legacy fallback)
add_action( 'init', 'keystone_video_sitemap_rewrite' );
function keystone_video_sitemap_rewrite() {
    add_rewrite_rule( '^keystone-video-sitemap\.xml$', 'index.php?keystone_video_sitemap=1', 'top' );
}

// Register the query variable so WordPress recognizes it
add_filter( 'query_vars', 'keystone_video_sitemap_query_vars' );
function keystone_video_sitemap_query_vars( $vars ) {
    $vars[] = 'keystone_video_sitemap';
    return $vars;
}

// Serve the video sitemap XML via early interception
add_action( 'template_redirect', 'keystone_serve_video_sitemap', 1 ); // priority 1 to intercept before anything else
function keystone_serve_video_sitemap() {
    $uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
    $is_sitemap = false;
    
    // 1. Bulletproof check: Does the URL strictly contain the filename?
    if ( strpos( $uri, 'keystone-video-sitemap.xml' ) !== false ) {
        $is_sitemap = true;
    } 
    // 2. Legacy fallback query vars
    elseif ( get_query_var( 'keystone_video_sitemap' ) || isset( $_GET['keystone_video_sitemap'] ) ) {
        $is_sitemap = true;
    }
    
    if ( ! $is_sitemap ) {
        return;
    }

    status_header( 200 );
    header( 'Content-Type: application/xml; charset=UTF-8' );
    header( 'X-Robots-Tag: noindex, follow' );

    $posts = get_posts( array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<?xml-stylesheet type="text/xsl" href="//keystonerecomposition.com/main-sitemap.xsl"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
    echo '        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">' . "\n";

    $video_count = 0;
    foreach ( $posts as $p ) {
        $post_id = $p->ID;
        
        // Skip specific page/posts if needed
        $youtube_id = get_post_meta( $post_id, 'keystone_youtube_id', true );
        if ( empty( $youtube_id ) ) {
            if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $p->post_content, $matches ) ) {
                $youtube_id = $matches[1];
            } elseif ( preg_match( '~(?:youtube\.com/(?:embed/|v/|watch\?v=|shorts/)|youtu\.be/)([^\"&?/ ]{11})~i', $p->post_content, $matches ) ) {
                $youtube_id = $matches[1];
            }
        }
        if ( empty( $youtube_id ) ) { 
            continue; 
        }

        // Try to locate a corresponding watch page (slug: watch-{post_slug})
        global $wpdb;
        $watch_page_id = 0;
        $watch_slug = 'watch-' . $p->post_name;
        
        $watch_page = get_page_by_path( $watch_slug, OBJECT, 'page' );
        if ( $watch_page && 'publish' === $watch_page->post_status ) {
            $watch_page_id = $watch_page->ID;
        } else {
            // Direct SQL fallback for truncated slugs or numerical suffixes
            $truncated_slug = substr( $watch_slug, 0, 200 );
            $watch_page_id = (int) $wpdb->get_var( $wpdb->prepare(
                "SELECT ID FROM $wpdb->posts 
                 WHERE post_type = 'page' 
                 AND post_status = 'publish' 
                 AND (post_name = %s OR post_name = %s OR post_name LIKE %s)
                 ORDER BY LENGTH(post_name) ASC
                 LIMIT 1",
                $watch_slug,
                $truncated_slug,
                $wpdb->esc_like( substr( $watch_slug, 0, 190 ) ) . '%'
            ) );
        }

        if ( $watch_page_id > 0 ) {
            $permalink = get_permalink( $watch_page_id );
        } else {
            $permalink = get_permalink( $post_id );
        }
        
        // Symmetrical metadata extraction
        $title = get_post_meta( $post_id, 'video_title', true );
        if ( empty( $title ) ) { 
            $title = get_the_title( $post_id ); 
        }
        $title = mb_substr( wp_strip_all_tags( $title ), 0, 100 );

        $description = get_post_meta( $post_id, 'video_description', true );
        if ( empty( $description ) ) {
            $excerpt = get_the_excerpt( $post_id );
            if ( empty( $excerpt ) ) {
                $excerpt = wp_trim_words( wp_strip_all_tags( strip_shortcodes( $p->post_content ) ), 40, '...' );
            }
            $description = $excerpt;
        }
        $description = mb_substr( wp_strip_all_tags( $description ), 0, 2048 );
        if ( empty( $description ) ) {
            $description = $title . ' - High-performance health and longevity protocol details.';
        }

        $thumbnail_url = "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
        $player_url    = "https://www.youtube.com/embed/{$youtube_id}";
        $content_url   = "https://www.youtube.com/watch?v={$youtube_id}";
        $upload_date   = get_the_date( 'c', $post_id );

        echo "  <url>\n";
        echo "    <loc>" . esc_url( $permalink ) . "</loc>\n";
        echo "    <video:video>\n";
        echo "      <video:thumbnail_loc>" . esc_url( $thumbnail_url ) . "</video:thumbnail_loc>\n";
        echo "      <video:title><![CDATA[" . $title . "]]></video:title>\n";
        echo "      <video:description><![CDATA[" . $description . "]]></video:description>\n";
        echo "      <video:content_loc>" . esc_url( $content_url ) . "</video:content_loc>\n";
        echo "      <video:player_loc>" . esc_url( $player_url ) . "</video:player_loc>\n";
        echo "      <video:publication_date>" . esc_attr( $upload_date ) . "</video:publication_date>\n";
        echo "      <video:family_friendly>yes</video:family_friendly>\n";
        echo "      <video:uploader info=\"https://keystonerecomposition.com/\">Wayne Stevenson</video:uploader>\n";
        echo "      <video:live>no</video:live>\n";
        echo "    </video:video>\n";
        echo "  </url>\n";
        $video_count++;
    }

    echo "</urlset>\n";
    echo "<!-- Keystone Sovereign Video Sitemap - " . $video_count . " videos found -->\n";
    exit;
}

// Register the video sitemap in Rank Math's main sitemap index dynamically
add_filter( 'rank_math/sitemap/index', 'keystone_add_video_sitemap_to_index' );

/**
 * Programmatic watch page content healer & missing watch page creator
 * Stamped: 2026-07-18
 */
add_action( 'init', 'keystone_recomposition_heal_watch_pages_trigger' );
function keystone_recomposition_heal_watch_pages_trigger() {
    if ( isset( $_GET['run_keystone_migration'] ) && $_GET['run_keystone_migration'] === 'sovereign_execute_watch_heal' ) {
        global $wpdb;
        
        $posts = $wpdb->get_results(
            "SELECT ID, post_title, post_name, post_content FROM $wpdb->posts 
             WHERE post_type = 'post' AND post_status = 'publish'"
        );
        
        $healed = 0;
        $created = 0;
        $reports = array();
        
        foreach ( $posts as $p ) {
            $youtube_id = get_post_meta( $p->ID, 'keystone_youtube_id', true );
            if ( empty( $youtube_id ) ) {
                $video_url = get_post_meta( $p->ID, 'video_url', true );
                if ( ! empty( $video_url ) ) {
                    if ( preg_match( '~(?:youtube\.com/(?:embed/|v/|watch\?v=|shorts/)|youtu\.be/)([^\"&?/ ]{11})~i', $video_url, $matches ) ) {
                        $youtube_id = $matches[1];
                    }
                }
            }
            if ( empty( $youtube_id ) ) {
                // 1. Try parsing shortcode [keystone_video id='...']
                if ( preg_match( '~\[keystone_video\s+id=[\'\"]([^\'\"]{11})[\'\"]\]~i', $p->post_content, $matches ) ) {
                    $youtube_id = $matches[1];
                }
            }
            if ( empty( $youtube_id ) ) {
                // 2. Try parsing standard YouTube URL embeds from content
                if ( preg_match( '~(?:youtube\.com/(?:embed/|v/|watch\?v=|shorts/)|youtu\.be/)([^\"&?/ ]{11})~i', $p->post_content, $matches ) ) {
                    $youtube_id = $matches[1];
                }
            }
            if ( empty( $youtube_id ) ) {
                continue;
            }
            
            $watch_page_id = $wpdb->get_var( $wpdb->prepare(
                "SELECT ID FROM $wpdb->posts 
                 WHERE post_type = 'page' AND post_status = 'publish' 
                 AND ( post_name = %s OR %s LIKE CONCAT(post_name, '%%') ) LIMIT 1",
                'watch-' . $p->post_name,
                'watch-' . $p->post_name
            ) );
            
            if ( ! $watch_page_id ) {
                $watch_title = 'Watch: ' . $p->post_title;
                $watch_slug = 'watch-' . $p->post_name;
                
                $new_page_id = wp_insert_post( array(
                    'post_title'    => $watch_title,
                    'post_name'     => $watch_slug,
                    'post_content'  => keystone_strip_duplicate_facades( $p->post_content ),
                    'post_status'   => 'publish',
                    'post_type'     => 'page',
                ) );
                
                if ( $new_page_id && ! is_wp_error( $new_page_id ) ) {
                    update_post_meta( $new_page_id, '_wp_page_template', 'default' );
                    update_post_meta( $new_page_id, 'video_url', 'https://www.youtube.com/watch?v=' . $youtube_id );
                    update_post_meta( $new_page_id, 'keystone_youtube_id', $youtube_id );
                    $created++;
                    $reports[] = "Created watch page for post: " . $p->post_name . " (ID: $new_page_id)";
                }
            } else {
                $watch_page = get_post( $watch_page_id );
                if ( $watch_page ) {
                    // Force default page template to prevent hardcoded wolverine layout overwrite
                    update_post_meta( $watch_page_id, '_wp_page_template', 'default' );
                    
                    $watch_len = strlen( trim( $watch_page->post_content ) );
                    $parent_len = strlen( trim( $p->post_content ) );
                    
                    if ( $watch_len < 1000 && $parent_len > $watch_len ) {
                        wp_update_post( array(
                            'ID'           => $watch_page_id,
                            'post_content' => keystone_strip_duplicate_facades( $p->post_content )
                        ) );
                        update_post_meta( $watch_page_id, 'video_url', 'https://www.youtube.com/watch?v=' . $youtube_id );
                        update_post_meta( $watch_page_id, 'keystone_youtube_id', $youtube_id );
                        $healed++;
                        $reports[] = "Healed thin watch page content for slug: " . $watch_page->post_name . " (ID: $watch_page_id)";
                    }
                }
            }
        }
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode( array(
            'status' => 'success',
            'created_count' => $created,
            'healed_count' => $healed,
            'log' => $reports
        ), JSON_PRETTY_PRINT );
        exit;
    }
}
