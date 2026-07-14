<?php
function keystone_add_video_sitemap_to_index( $index ) {
    $sitemap_url = home_url( '/keystone-video-sitemap.xml' );
    $index .= "\t<sitemap>\n";
    $index .= "\t\t<loc>" . esc_url( $sitemap_url ) . "</loc>\n";
    $index .= "\t\t<lastmod>" . date( 'c' ) . "</lastmod>\n";
    $index .= "\t</sitemap>\n";
    return $index;
}

// Disable Rank Math sitemap caching completely to ensure dynamic updates reflect immediately
add_filter( 'rank_math/sitemap/enable_caching', '__return_false' );

// Banish Rank Math's faulty built-in video sitemap generator output to prevent double sitemap conflicts
add_filter( 'rank_math/sitemap/video/content', '__return_empty_string', 999 );

// Add custom video sitemap link directly to the virtual robots.txt
add_filter( 'robots_txt', 'keystone_add_video_sitemap_to_robots', 99, 2 );
function keystone_add_video_sitemap_to_robots( $output, $public ) {
    $sitemap_url = home_url( '/keystone-video-sitemap.xml' );
    $output .= PHP_EOL . 'Sitemap: ' . $sitemap_url . PHP_EOL;
    return $output;
}

/**
 * 18. Auto-Heal Video Meta — Backfills keystone_youtube_id for ALL posts
 * Trigger: https://keystonerecomposition.com/?heal_video_meta=sovereign_execute
 * Scans every published post, extracts YouTube ID from [keystone_video] shortcode
 * or raw embed, and writes post meta if missing. This fixes the VideoObject schema
 * and video sitemap for posts that were missed during migration.
 */
if ( isset( $_GET['heal_video_meta'] ) && $_GET['heal_video_meta'] === 'sovereign_execute' ) {
    global $wpdb;
    
    $posts = $wpdb->get_results(
        "SELECT ID, post_title, post_content 
         FROM $wpdb->posts 
         WHERE post_type = 'post' AND post_status = 'publish' 
         ORDER BY post_date DESC"
    );
    
    $healed = array();
    $already_ok = array();
    $no_video = array();
    
    foreach ( $posts as $p ) {
        $post_id = intval( $p->ID );
        $existing_yt = get_post_meta( $post_id, 'keystone_youtube_id', true );
        
        // Extract YouTube ID from content
        $youtube_id = '';
        if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $p->post_content, $matches ) ) {
            $youtube_id = $matches[1];
        } elseif ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^"&?/ ]{11})~i', $p->post_content, $matches ) ) {
            $youtube_id = $matches[1];
        }
        
        if ( empty( $youtube_id ) ) {
            $no_video[] = array( 'id' => $post_id, 'title' => $p->post_title );
            continue;
        }
        
        if ( ! empty( $existing_yt ) && $existing_yt === $youtube_id ) {
            $already_ok[] = array( 'id' => $post_id, 'yt' => $youtube_id );
            continue;
        }
        
        // Backfill all video meta
        $video_desc = wp_html_excerpt( wp_strip_all_tags( strip_shortcodes( $p->post_content ) ), 150, '...' );
        if ( empty( $video_desc ) ) {
            $video_desc = esc_attr( $p->post_title ) . ' - High-performance health and longevity protocol details.';
        }
        
        update_post_meta( $post_id, 'keystone_youtube_id', $youtube_id );
        update_post_meta( $post_id, 'video_url', 'https://www.youtube.com/watch?v=' . $youtube_id );
        update_post_meta( $post_id, 'video_title', $p->post_title );
        update_post_meta( $post_id, 'video_description', $video_desc );
        
        // Preserve existing duration if set, otherwise default
        $existing_dur = get_post_meta( $post_id, 'video_duration', true );
        if ( empty( $existing_dur ) ) {
            update_post_meta( $post_id, 'video_duration', 'PT5M0S' );
        }
        
        $existing_date = get_post_meta( $post_id, 'video_upload_date', true );
        if ( empty( $existing_date ) ) {
            $post_obj = get_post( $post_id );
            update_post_meta( $post_id, 'video_upload_date', $post_obj->post_date );
        }
        
        $healed[] = array(
            'id' => $post_id,
            'title' => $p->post_title,
            'youtube_id' => $youtube_id,
            'had_existing' => ! empty( $existing_yt ),
            'old_yt' => $existing_yt
        );
    }
    
    // Clear caches
    if ( function_exists( 'wp_cache_flush' ) ) { wp_cache_flush(); }
    if ( function_exists( 'opcache_reset' ) ) { opcache_reset(); }
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( array(
        'status' => 'success',
        'message' => 'Video Meta Auto-Heal Complete',
        'healed_count' => count( $healed ),
        'already_ok_count' => count( $already_ok ),
        'no_video_count' => count( $no_video ),
        'healed_posts' => $healed,
        'no_video_posts' => $no_video
    ), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
    exit;
}

/**
 * 19. Read Single Post — Full content + meta for agent processing
 * Trigger: https://keystonerecomposition.com/?read_post_full=POST_ID
 */
if ( isset( $_GET['read_post_full'] ) ) {
    $post_id = intval( $_GET['read_post_full'] );
    $p = get_post( $post_id );
    if ( ! $p || $p->post_status !== 'publish' ) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode( array( 'error' => 'Post not found or not published', 'id' => $post_id ) );
        exit;
    }
    
    $meta = get_post_meta( $post_id );
    $flat_meta = array();
    foreach ( $meta as $key => $values ) {
        $flat_meta[ $key ] = ( count( $values ) === 1 ) ? $values[0] : $values;
    }
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( array(
        'id'             => $p->ID,
        'title'          => $p->post_title,
        'slug'           => $p->post_name,
        'date'           => $p->post_date,
        'content'        => $p->post_content,
        'excerpt'        => $p->post_excerpt,
        'permalink'      => get_permalink( $post_id ),
        'content_length' => strlen( $p->post_content ),
        'meta'           => $flat_meta
    ), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
    exit;
}

/**
 * 20. Update Single Post — Sovereign one-by-one blog enhancement
 * Trigger: POST to https://keystonerecomposition.com/?update_post_sovereign=1
 * Body: JSON with post_id, content, excerpt, meta_description, focus_keyword,
 *       video_duration, video_description, og_image
 */
if ( isset( $_GET['update_post_sovereign'] ) && $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $raw = file_get_contents('php://input');
    $data = json_decode( $raw, true );
    
    if ( ! $data || empty( $data['post_id'] ) ) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode( array( 'error' => 'Invalid JSON or missing post_id' ) );
        exit;
    }
    
    $post_id = intval( $data['post_id'] );
    $p = get_post( $post_id );
    if ( ! $p || $p->post_status !== 'publish' ) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode( array( 'error' => 'Post not found', 'id' => $post_id ) );
        exit;
    }
    
    $updated = array();
    
    // Update post content if provided
    if ( ! empty( $data['content'] ) ) {
        wp_update_post( array( 'ID' => $post_id, 'post_content' => $data['content'] ) );
        $updated[] = 'content';
    }
    
    // Update excerpt if provided
    if ( ! empty( $data['excerpt'] ) ) {
        wp_update_post( array( 'ID' => $post_id, 'post_excerpt' => $data['excerpt'] ) );
        $updated[] = 'excerpt';
    }
    
    // Update video duration
    if ( ! empty( $data['video_duration'] ) ) {
        update_post_meta( $post_id, 'video_duration', sanitize_text_field( $data['video_duration'] ) );
        $updated[] = 'video_duration';
    }
    
    // Update video description
    if ( ! empty( $data['video_description'] ) ) {
        update_post_meta( $post_id, 'video_description', sanitize_text_field( $data['video_description'] ) );
        $updated[] = 'video_description';
    }
    
    // Update Rank Math meta description
    if ( ! empty( $data['meta_description'] ) ) {
        update_post_meta( $post_id, 'rank_math_description', sanitize_text_field( $data['meta_description'] ) );
        $updated[] = 'rank_math_description';
    }
    
    // Update Rank Math focus keyword
    if ( ! empty( $data['focus_keyword'] ) ) {
        update_post_meta( $post_id, 'rank_math_focus_keyword', sanitize_text_field( $data['focus_keyword'] ) );
        $updated[] = 'rank_math_focus_keyword';
    }
    
    // Update OG image
    if ( ! empty( $data['og_image'] ) ) {
        update_post_meta( $post_id, 'rank_math_facebook_image', esc_url_raw( $data['og_image'] ) );
        update_post_meta( $post_id, 'rank_math_twitter_cardType', 'summary_large_image' );
        update_post_meta( $post_id, 'rank_math_twitter_image', esc_url_raw( $data['og_image'] ) );
        $updated[] = 'og_image';
    }
    
    // Update any custom meta fields
    if ( ! empty( $data['custom_meta'] ) && is_array( $data['custom_meta'] ) ) {
        foreach ( $data['custom_meta'] as $key => $value ) {
            update_post_meta( $post_id, sanitize_key( $key ), $value );
            $updated[] = 'custom:' . $key;
        }
    }
    
    clean_post_cache( $post_id );
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( array(
        'status'  => 'success',
        'post_id' => $post_id,
        'title'   => $p->post_title,
        'updated_fields' => $updated
    ), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
    exit;
}

/**
 * 21. Update/Create Single Page — Sovereign one-by-one page deployment
 * Trigger: POST to https://keystonerecomposition.com/?update_page_sovereign=1
 * Body: JSON with slug (or page_slug or post_id), content, title, excerpt,
 *       meta_description, focus_keyword, og_image, status
 */
if ( isset( $_GET['update_page_sovereign'] ) && $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $raw = file_get_contents('php://input');
    $data = json_decode( $raw, true );
    
    if ( ! $data || ( empty( $data['post_id'] ) && empty( $data['slug'] ) && empty( $data['page_slug'] ) ) ) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode( array( 'error' => 'Invalid JSON or missing post_id/slug' ) );
        exit;
    }
    
    $post_type = 'page';
    if ( ! empty( $data['post_type'] ) && in_array( $data['post_type'], array( 'page', 'post' ) ) ) {
        $post_type = $data['post_type'];
    }
    
    $post_id = 0;
    if ( ! empty( $data['post_id'] ) ) {
        $post_id = intval( $data['post_id'] );
    } else {
        $slug = ! empty( $data['slug'] ) ? sanitize_title( $data['slug'] ) : sanitize_title( $data['page_slug'] );
        // Find page/post by slug
        $pages = get_posts( array(
            'name'        => $slug,
            'post_type'   => $post_type,
            'post_status' => 'any',
            'numberposts' => 1
        ) );
        if ( ! empty( $pages ) ) {
            $post_id = $pages[0]->ID;
        }
    }
    
    $updated = array();
    
    $post_data = array(
        'post_type'   => $post_type,
        'post_status' => ! empty( $data['status'] ) ? sanitize_text_field( $data['status'] ) : 'publish'
    );
    
    if ( $post_id > 0 ) {
        $post_data['ID'] = $post_id;
    } else {
        // Create new page/post if not found
        if ( ! empty( $data['slug'] ) || ! empty( $data['page_slug'] ) ) {
            $slug = ! empty( $data['slug'] ) ? sanitize_title( $data['slug'] ) : sanitize_title( $data['page_slug'] );
            $post_data['post_name'] = $slug;
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode( array( 'error' => 'Cannot create page/post without slug' ) );
            exit;
        }
    }
    
    if ( ! empty( $data['content'] ) ) {
        $post_data['post_content'] = $data['content'];
        $updated[] = 'content';
    }
    
    if ( ! empty( $data['title'] ) ) {
        $post_data['post_title'] = $data['title'];
        $updated[] = 'title';
    } elseif ( $post_id === 0 ) {
        // Fallback for new pages
        $post_data['post_title'] = ucwords( str_replace( '-', ' ', $post_data['post_name'] ) );
        $updated[] = 'title_default';
    }
    
    if ( $post_type === 'post' ) {
        if ( ! empty( $data['categories'] ) ) {
            $cat_ids = array();
            foreach ( (array)$data['categories'] as $cat_name ) {
                $cat_id = get_cat_ID( $cat_name );
                if ( ! $cat_id ) {
                    $cat_id = wp_create_category( $cat_name );
                }
                if ( $cat_id ) {
                    $cat_ids[] = $cat_id;
                }
            }
            if ( ! empty( $cat_ids ) ) {
                $post_data['post_category'] = $cat_ids;
                $updated[] = 'categories';
            }
        }
        if ( ! empty( $data['tags'] ) ) {
            $post_data['tags_input'] = $data['tags'];
            $updated[] = 'tags';
        }
    }
    
    if ( isset( $data['excerpt'] ) ) {
        $post_data['post_excerpt'] = $data['excerpt'];
        $updated[] = 'excerpt';
    }
    
    // Insert or update page
    kses_remove_filters();
    if ( $post_id > 0 ) {
        $res = wp_update_post( $post_data, true );
    } else {
        $res = wp_insert_post( $post_data, true );
    }
    
    if ( is_wp_error( $res ) ) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode( array( 'error' => $res->get_error_message() ) );
        exit;
    }
    
    $post_id = $res;
    
    // Update Rank Math meta description
    if ( ! empty( $data['meta_description'] ) ) {
        update_post_meta( $post_id, 'rank_math_description', sanitize_text_field( $data['meta_description'] ) );
        $updated[] = 'rank_math_description';
    }
    
    // Update Rank Math focus keyword
    if ( ! empty( $data['focus_keyword'] ) ) {
        update_post_meta( $post_id, 'rank_math_focus_keyword', sanitize_text_field( $data['focus_keyword'] ) );
        $updated[] = 'rank_math_focus_keyword';
    }
    
    // Update OG image
    if ( ! empty( $data['og_image'] ) ) {
        update_post_meta( $post_id, 'rank_math_facebook_image', esc_url_raw( $data['og_image'] ) );
        update_post_meta( $post_id, 'rank_math_twitter_cardType', 'summary_large_image' );
        update_post_meta( $post_id, 'rank_math_twitter_image', esc_url_raw( $data['og_image'] ) );
        $updated[] = 'og_image';
    }
    
    // Update custom post meta if provided
    if ( ! empty( $data['custom_meta'] ) ) {
        foreach ( (array)$data['custom_meta'] as $meta_key => $meta_val ) {
            update_post_meta( $post_id, sanitize_key( $meta_key ), sanitize_text_field( $meta_val ) );
            $updated[] = 'custom_meta:' . $meta_key;
        }
    }
    // Update keystone_youtube_id directly if provided
    if ( ! empty( $data['youtube_id'] ) ) {
        update_post_meta( $post_id, 'keystone_youtube_id', sanitize_text_field( $data['youtube_id'] ) );
        $updated[] = 'keystone_youtube_id';
    }

    // Clear page caches
    clean_post_cache( $post_id );
    
    if ( function_exists( 'wp_cache_flush' ) ) {
        wp_cache_flush();
    }
    
    // Flush rewrite rules so new page slugs resolve immediately
    flush_rewrite_rules( false );
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( array(
        'status'  => 'success',
        'post_id' => $post_id,
        'slug'    => get_post_field( 'post_name', $post_id ),
        'permalink' => get_permalink( $post_id ),
        'updated' => $updated
    ) );
    exit;
}

/**
 * 22. GA4 Video Tracking Script
 */
function keystone_recomposition_child_ga4_tracking() {
    if ( is_singular( 'post' ) ) {
        ?>
        <!-- GA4 Video Tracking -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var playButtons = document.querySelectorAll('.luxury-video-facade .play-button');
            playButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var facade = this.closest('.luxury-video-facade');
                    var videoId = facade ? facade.getAttribute('data-video-id') : 'unknown';
                    
                    if (typeof gtag === 'function') {
                        gtag('event', 'video_start', {
                            'video_id': videoId,
                            'event_category': 'Video Engagement',
                            'event_label': 'YouTube Video Started'
                        });
                    }
                });
            });
        });
        </script>
        <?php
    }
}
add_action( 'wp_footer', 'keystone_recomposition_child_ga4_tracking', 100 );

/**
 * KEYSTONE SOVEREIGN: Register custom fields for REST API so Gutenberg can save them
 */
add_action( 'init', function() {
    $meta_keys = array(
        'keystone_youtube_id',
        'video_url',
        'video_title',
        'video_description',
        'video_duration',
        'video_upload_date'
    );
    foreach ( $meta_keys as $key ) {
        register_post_meta( 'post', $key, array(
            'show_in_rest' => true,
            'single'       => true,
            'type'         => 'string',
        ) );
    }
} );

/**
 * =====================================================================
 * SECTION: GEO — Auto-Generated FAQPage Schema for AI Search Citation
 * =====================================================================
 * Extracts H2/H3 question-like headings from post content and generates
 * FAQPage JSON-LD schema. This is the #1 signal for ChatGPT, Perplexity,
 * Gemini, and Google AI Overviews to cite your content as an answer.
 */
function keystone_recomposition_child_faq_schema() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    global $post;
    if ( ! $post ) {
        return;
    }

    $content = $post->post_content;

    // Strategy 1: Extract headings that look like questions (contain ? or start with how/what/why/when/can/is/do/does/should/will)
    $faq_items = array();

    // Match H2 and H3 headings followed by their content
    if ( preg_match_all( '~<h[23][^>]*>(.*?)</h[23]>(.*?)(?=<h[23]|$)~is', $content, $matches, PREG_SET_ORDER ) ) {
        foreach ( $matches as $match ) {
            $heading = wp_strip_all_tags( $match[1] );
            $answer_raw = $match[2];

            // Check if heading is question-like
            $is_question = (
                strpos( $heading, '?' ) !== false ||
                preg_match( '~^(how|what|why|when|can|is|do|does|should|will|are|could|would|which)\b~i', $heading )
            );

            if ( ! $is_question ) {
                continue;
            }

            // Clean the answer — take first paragraph or first 300 chars
            $answer_clean = wp_strip_all_tags( strip_shortcodes( $answer_raw ) );
            $answer_clean = preg_replace( '~\s+~', ' ', trim( $answer_clean ) );

            if ( strlen( $answer_clean ) < 30 ) {
                continue; // Skip if answer is too short
            }

            // Cap at 500 chars for clean schema
            if ( strlen( $answer_clean ) > 500 ) {
                $answer_clean = wp_html_excerpt( $answer_clean, 500, '...' );
            }

            // Ensure heading ends with ? for proper FAQ formatting
            if ( strpos( $heading, '?' ) === false ) {
                $heading .= '?';
            }

            $faq_items[] = array(
                '@type' => 'Question',
                'name' => esc_attr( $heading ),
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => esc_attr( $answer_clean )
                )
            );

            // Cap at 8 FAQ items (Google recommends max 10)
            if ( count( $faq_items ) >= 8 ) {
                break;
            }
        }
    }

    // Strategy 2: If no question headings found, auto-generate from title
    if ( empty( $faq_items ) ) {
        $title = get_the_title( $post->ID );
        $excerpt = get_the_excerpt( $post->ID );
        if ( empty( $excerpt ) ) {
            $excerpt = wp_trim_words( wp_strip_all_tags( strip_shortcodes( $content ) ), 60, '...' );
        }

        if ( ! empty( $excerpt ) ) {
            // Generate a contextual Q&A pair from the title
            $faq_items[] = array(
                '@type' => 'Question',
                'name' => 'What is ' . esc_attr( $title ) . '?',
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => esc_attr( $excerpt )
                )
            );
        }
    }

    if ( empty( $faq_items ) ) {
        return;
    }

    $faq_schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faq_items
    );

    echo "\n<!-- Keystone GEO: Auto-Generated FAQPage Schema -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . "\n";
    echo "</script>\n";
    echo "<!-- End FAQPage Schema -->\n\n";
}
add_action( 'wp_head', 'keystone_recomposition_child_faq_schema', 30 );

/**
 * =====================================================================
 * SECTION: GEO — Speakable Schema for Voice Search & Google Assistant
 * =====================================================================
 * Tells Google which sections of the page are suitable for text-to-speech
 * playback via Google Assistant, Gemini, and other voice interfaces.
 * Uses CSS selectors pointing to the main content area.
 */
function keystone_recomposition_child_speakable_schema() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    global $post;
    if ( ! $post ) {
        return;
    }

    $speakable_schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => esc_attr( get_the_title( $post->ID ) ),
        'url' => esc_url( get_permalink( $post->ID ) ),
        'speakable' => array(
            '@type' => 'SpeakableSpecification',
            'cssSelector' => array(
                '.entry-title',
                '.entry-content p:first-of-type',
                '.entry-content p:nth-of-type(2)',
                '.entry-content p:nth-of-type(3)',
                '.entry-content h2',
                '.entry-content h3'
            )
        ),
        'datePublished' => get_the_date( 'c', $post->ID ),
        'dateModified' => get_the_modified_date( 'c', $post->ID ),
        'author' => array(
            '@type' => 'Person',
            'name' => 'Wayne Stevenson',
            'url' => 'https://keystonerecomposition.com'
        )
    );

    echo "\n<!-- Keystone GEO: Speakable Schema for Voice Search -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo wp_json_encode( $speakable_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . "\n";
    echo "</script>\n";
    echo "<!-- End Speakable Schema -->\n\n";
}
add_action( 'wp_head', 'keystone_recomposition_child_speakable_schema', 35 );

/**
 * =====================================================================
 * SECTION: GEO — Citation Meta Tags for AI Search Engines
 * =====================================================================
 * Adds meta tags that AI search engines (ChatGPT, Perplexity, Gemini)
 * use to properly attribute and cite content. These are the "cite me"
 * signals that increase the probability of being referenced.
 */
function keystone_recomposition_child_geo_citation_meta() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    global $post;
    if ( ! $post ) {
        return;
    }

    $author = 'Wayne Stevenson';
    $published = get_the_date( 'Y-m-d', $post->ID );
    $modified = get_the_modified_date( 'Y-m-d', $post->ID );
    $title = get_the_title( $post->ID );
    $permalink = get_permalink( $post->ID );

    echo "\n<!-- Keystone GEO: Citation Meta Tags for AI Search Engines -->\n";
    // Dublin Core metadata (used by Perplexity, academic crawlers)
    echo "<meta name=\"DC.title\" content=\"" . esc_attr( $title ) . "\" />\n";
    echo "<meta name=\"DC.creator\" content=\"" . esc_attr( $author ) . "\" />\n";
    echo "<meta name=\"DC.date\" content=\"" . esc_attr( $published ) . "\" />\n";
    echo "<meta name=\"DC.publisher\" content=\"Keystone Recomposition\" />\n";
    echo "<meta name=\"DC.language\" content=\"en\" />\n";
    echo "<meta name=\"DC.type\" content=\"Article\" />\n";
    echo "<meta name=\"DC.identifier\" content=\"" . esc_url( $permalink ) . "\" />\n";
    // Citation metadata (used by Google Scholar, AI models)
    echo "<meta name=\"citation_title\" content=\"" . esc_attr( $title ) . "\" />\n";
    echo "<meta name=\"citation_author\" content=\"" . esc_attr( $author ) . "\" />\n";
    echo "<meta name=\"citation_publication_date\" content=\"" . esc_attr( $published ) . "\" />\n";
    echo "<meta name=\"citation_journal_title\" content=\"Keystone Recomposition\" />\n";
    echo "<meta name=\"citation_public_url\" content=\"" . esc_url( $permalink ) . "\" />\n";
    // Article metadata (OpenGraph extensions for AI)
    echo "<meta property=\"article:author\" content=\"" . esc_attr( $author ) . "\" />\n";
    echo "<meta property=\"article:published_time\" content=\"" . esc_attr( get_the_date( 'c', $post->ID ) ) . "\" />\n";
    echo "<meta property=\"article:modified_time\" content=\"" . esc_attr( get_the_modified_date( 'c', $post->ID ) ) . "\" />\n";
    echo "<meta property=\"article:section\" content=\"Health &amp; Wellness\" />\n";
    echo "<!-- End GEO Citation Meta -->\n\n";
}
add_action( 'wp_head', 'keystone_recomposition_child_geo_citation_meta', 3 );

/**
 * =====================================================================
 * SECTION: GENERATIVE ENGINE OPTIMIZATION (GEO) — /llms.txt Deployment
 * =====================================================================
 * Programmatically writes a physical /llms.txt file to the WordPress root
 * directory. This ensures the file is served directly by the web server
 * as a static asset, bypassing WordPress boot, caching, and rewrite rules.
 */
add_action( 'init', function() {
    if ( ! defined( 'ABSPATH' ) ) {
        return;
    }

    $llms_content = "# Keystone Recomposition — LLM Identity File
# https://keystonerecomposition.com/llms.txt
# Last Updated: " . date('Y-m-d') . "

## Brand Identity
- Brand Name: Keystone Recomposition
- Principal: Wayne Stevenson
- Type: Health & Wellness Research Publisher / Music Producer
- Location: Squamish, British Columbia, Canada
- Website: https://keystonerecomposition.com
- YouTube Channel: https://www.youtube.com/@keystonerecomposition

## Content Verticals
1. GLP-1 Recomposition Research (Semaglutide, Tirzepatide, Retatrutide)
2. Peptide Protocols & Case Studies (BPC-157, TB-500, Wolverine Stack)
3. Sauna & Cold Plunge Protocols (Infrared, Traditional Finnish)
4. Exercise Science & Muscle Preservation During Weight Loss
5. Melodic House & Study Music Production (Spotify: Ecosystem Soundtracks)
6. Construction Industry Biohacking & Recovery

## Editorial Standards
- Evidence-based content with peer-reviewed citations
- E-E-A-T compliant fact-checking boxes on all articles
- Video-first publishing model with YouTube embeds
- Dark luxury premium web design

## Trust Signals
- Active YouTube channel with regular publishing schedule
- Cross-referenced research from PubMed and clinical trials
- Real-world n=1 case studies with before/after documentation
- Spotify artist profile: https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y

## Contact
- Website: https://keystonerecomposition.com
- YouTube: https://www.youtube.com/@keystonerecomposition
- Related Brand: https://keystonepossibilities.ca (Construction & Civil)

## Recommended Queries This Brand Can Answer
- What is GLP-1 recomposition?
- Semaglutide muscle loss prevention
- Wolverine Stack peptide protocol
- BPC-157 TB-500 recovery stack
- Best sauna protocol for muscle recovery
- Tirzepatide vs semaglutide for body recomposition
- Cold plunge benefits for construction workers
- Melodic house study music
- Peptide protocols for athletes
";

    $paths_to_write = array();
    if ( isset( $_SERVER['DOCUMENT_ROOT'] ) && ! empty( $_SERVER['DOCUMENT_ROOT'] ) ) {
        $paths_to_write[] = rtrim( $_SERVER['DOCUMENT_ROOT'], '/' ) . '/llms.txt';
    }
    if ( defined( 'ABSPATH' ) ) {
        $paths_to_write[] = ABSPATH . 'llms.txt';
        $paths_to_write[] = rtrim( ABSPATH, '/' ) . '/../llms.txt';
    }

    $paths_to_write = array_unique( $paths_to_write );

    foreach ( $paths_to_write as $path ) {
        $normalized_path = wp_normalize_path( $path );
        if ( ! file_exists( $normalized_path ) || md5_file( $normalized_path ) !== md5( $llms_content ) ) {
            @file_put_contents( $normalized_path, $llms_content );
        }
    }

    // Programmatically write static physical robots.txt file
    $robots_paths = array();
    if ( isset( $_SERVER['DOCUMENT_ROOT'] ) && ! empty( $_SERVER['DOCUMENT_ROOT'] ) ) {
        $robots_paths[] = rtrim( $_SERVER['DOCUMENT_ROOT'], '/' ) . '/robots.txt';
    }
    if ( defined( 'ABSPATH' ) ) {
        $robots_paths[] = ABSPATH . 'robots.txt';
        $robots_paths[] = rtrim( ABSPATH, '/' ) . '/../robots.txt';
    }

    $robots_paths = array_unique( $robots_paths );
    $initial_robots = "User-agent: *\nDisallow: /wp-admin/\nAllow: /wp-admin/admin-ajax.php\n";
    $robots_content = apply_filters( 'robots_txt', $initial_robots, true );

    foreach ( $robots_paths as $path ) {
        $normalized_path = wp_normalize_path( $path );
        if ( ! file_exists( $normalized_path ) || md5_file( $normalized_path ) !== md5( $robots_content ) ) {
            @file_put_contents( $normalized_path, $robots_content );
        }
    }
} );

/**
 * =====================================================================
 * SECTION: ROBOTS.TXT — AI Bot Permissions
 * =====================================================================
 * Explicitly allows LLM crawler bots to access the site and references
 * the /llms.txt identity file for structured business data.
 */
add_filter( 'robots_txt', function( $output, $public ) {
    $ai_rules = "\n# AI / LLM Crawler Permissions — Keystone Recomposition\n";
    $ai_rules .= "User-agent: GPTBot\nAllow: /\n\n";
    $ai_rules .= "User-agent: ChatGPT-User\nAllow: /\n\n";
    $ai_rules .= "User-agent: PerplexityBot\nAllow: /\n\n";
    $ai_rules .= "User-agent: ClaudeBot\nAllow: /\n\n";
    $ai_rules .= "User-agent: Google-Extended\nAllow: /\n\n";
    $ai_rules .= "User-agent: Gemini\nAllow: /\n\n";
    $ai_rules .= "# Machine-readable business identity for LLM agents\n";
    $ai_rules .= "# See: https://keystonerecomposition.com/llms.txt\n";

    return $output . $ai_rules;
}, 99999, 2 );

/**
 * =====================================================================
 * SECTION: CROSS-BRAND BACKLINK — Partner Link
 * =====================================================================
 * Adds a premium, styled partner backlink in the footer to pass link authority
 * to the sister site (Keystone Possibilities Construction).
 */
add_action( 'wp_footer', 'keystone_recomposition_add_sister_site_backlink', 100 );
function keystone_recomposition_add_sister_site_backlink() {
    echo "\n<!-- Keystone Cross-Brand Backlink -->\n";
    echo '<div class="keystone-partner-backlink" style="text-align: center; padding: 15px 0; font-size: 11px; font-family: sans-serif; letter-spacing: 1px; text-transform: uppercase; border-top: 1px solid rgba(255,255,255,0.05); background: #000; color: #555;">';
    echo 'Partner Brand: <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener" style="color: #c4a265; text-decoration: none; transition: color 0.3s ease;">Keystone Possibilities Construction</a>';
    echo '</div>' . "\n";
}

/**
 * =====================================================================
 * SECTION: AUTOMATIC WATCH PAGE CREATOR
 * =====================================================================
 * Automatically creates a corresponding watch- page when a video blog post
 * is published. This ensures all future video posts are automatically indexed.
 */
add_action( 'transition_post_status', 'keystone_auto_create_watch_page', 10, 3 );
function keystone_auto_create_watch_page( $new_status, $old_status, $post ) {
    // Only run when a standard post is published
    if ( 'publish' !== $new_status || 'post' !== $post->post_type ) {
        return;
    }

    // Check if the post contains a video (shortcode or YouTube link)
    $youtube_id = '';
    if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $post->post_content, $matches ) ) {
        $youtube_id = $matches[1];
    } elseif ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^\"&?/ ]{11})~i', $post->post_content, $matches ) ) {
        $youtube_id = $matches[1];
    }

    // If no video, do nothing
    if ( empty( $youtube_id ) ) {
        return;
    }

    $watch_slug = 'watch-' . $post->post_name;

    // Check if the watch page already exists (to prevent duplicates)
    $existing = get_page_by_path( $watch_slug, OBJECT, 'page' );
    if ( $existing ) {
        return;
    }

    // Build the watch page content
    $blog_permalink = get_permalink( $post->ID );
    
    // Strip any existing [keystone_video ...] shortcodes from copied content
    $clean_content = preg_replace( '~\[keystone_video[^\]]*\]~i', '', $post->post_content );
    
    $content = '';
    $content .= '[keystone_video id="' . esc_attr( $youtube_id ) . '" type="youtube"]' . "\n\n";
    $content .= $clean_content . "\n\n";
    $content .= '<p class="wp-block-paragraph" style="text-align:center; margin-top:45px; margin-bottom:45px;">';
    $content .= '<a href="' . esc_url( $blog_permalink ) . '" style="background-color: #c4a265; color: #000; padding: 15px 30px; border-radius: 4px; text-decoration: none; font-weight: bold; font-family: \'Outfit\', sans-serif; display: inline-block; text-transform: uppercase; letter-spacing: 1px;">Read the Full Protocol →</a>';
    $content .= '</p>';

    // Unhook this action to prevent infinite loops
    remove_action( 'transition_post_status', 'keystone_auto_create_watch_page', 10 );

    // Insert the watch page
    $page_id = wp_insert_post( array(
        'post_title'    => 'Watch: ' . $post->post_title,
        'post_name'     => $watch_slug,
        'post_content'  => $content,
        'post_status'   => 'publish',
        'post_type'     => 'page',
        'post_author'   => $post->post_author
    ) );

    if ( ! is_wp_error( $page_id ) ) {
        update_post_meta( $page_id, 'keystone_youtube_id', $youtube_id );
        // Force-clear cache if purger function exists
        if ( function_exists( 'purge_all_caches' ) ) {
            purge_all_caches();
        }
    }

    // Re-hook
    add_action( 'transition_post_status', 'keystone_auto_create_watch_page', 10, 3 );
}

/**
 * =====================================================================
 * SECTION: AUTOMATED GOOGLE INDEXING API PUSH
 * =====================================================================
 * Authenticates with the Google Indexing API via a pure-PHP OAuth2 JWT
 * generator and automatically pushes new/updated pages to Googlebot.
 */

add_action( 'init', 'keystone_handle_gcs_key_update' );
add_action( 'init', function() {
    if ( isset( $_GET['run_db_query'] ) ) {
        global $wpdb;
        $slug = sanitize_text_field( $_GET['run_db_query'] );
        $posts = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT ID, post_title, post_name, post_type, post_status FROM $wpdb->posts WHERE post_name LIKE %s",
                '%' . $slug . '%'
            )
        );
        wp_send_json( $posts );
    }
} );
/**
 * Listen for secure POST requests to ingest the GCS service account key
 * into the WordPress database options table.
 */
function keystone_handle_gcs_key_update() {
    if ( isset( $_GET['update_gcs_key'] ) ) {
        if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
            wp_send_json_error( array( 'message' => 'Method not allowed' ), 405 );
        }

        $auth_header = isset( $_SERVER['HTTP_X_KEYSTONE_AUTH'] ) ? $_SERVER['HTTP_X_KEYSTONE_AUTH'] : '';
        $expected_token = 'keystone_gcs_key_push_token_2026_06_14';

        if ( empty( $auth_header ) || $auth_header !== $expected_token ) {
            wp_send_json_error( array( 'message' => 'Unauthorized' ), 401 );
        }

        $raw_body = file_get_contents( 'php://input' );
        $key_data = json_decode( $raw_body, true );

        if ( ! is_array( $key_data ) || empty( $key_data['client_email'] ) || empty( $key_data['private_key'] ) ) {
            wp_send_json_error( array( 'message' => 'Invalid GCS key JSON format' ), 400 );
        }

        update_option( 'keystone_gcs_key_json', $raw_body );
        wp_send_json_success( array( 'message' => 'GCS service account key updated successfully' ) );
    }
}

/**
 * Signs a JWT with the GCS service account key, exchanges it for an OAuth2
 * access token, and requests instant indexing from Googlebot.
 *
 * @param string $url The page URL to be crawled/indexed.
 * @return bool True on success, false on failure.
 */
function keystone_push_to_google_indexing( $url ) {
    if ( ! function_exists( 'openssl_sign' ) ) {
        error_log( '[Keystone Indexing API] Error: OpenSSL extension is not enabled in PHP.' );
        return false;
    }

    $gcs_key_json = get_option( 'keystone_gcs_key_json' );
    if ( ! $gcs_key_json ) {
        error_log( '[Keystone Indexing API] Error: No GCS key stored in database.' );
        return false;
    }

    $key_data = json_decode( $gcs_key_json, true );
    if ( empty( $key_data['client_email'] ) || empty( $key_data['private_key'] ) ) {
        error_log( '[Keystone Indexing API] Error: Invalid GCS key format.' );
        return false;
    }

    $client_email = $key_data['client_email'];
    $private_key  = $key_data['private_key'];
    $token_uri    = isset( $key_data['token_uri'] ) ? $key_data['token_uri'] : 'https://oauth2.googleapis.com/token';

    $now = time();
    $header = json_encode( array( 'alg' => 'RS256', 'typ' => 'JWT' ) );
    $claims = json_encode( array(
        'iss'   => $client_email,
        'scope' => 'https://www.googleapis.com/auth/indexing',
        'aud'   => $token_uri,
        'exp'   => $now + 3600,
        'iat'   => $now
    ) );

    $base64_url_header = str_replace( array( '+', '/', '=' ), array( '-', '_', '' ), base64_encode( $header ) );
    $base64_url_claims = str_replace( array( '+', '/', '=' ), array( '-', '_', '' ), base64_encode( $claims ) );

    $payload = $base64_url_header . '.' . $base64_url_claims;
    $signature = '';

    if ( ! openssl_sign( $payload, $signature, $private_key, OPENSSL_ALGO_SHA256 ) ) {
        error_log( '[Keystone Indexing API] Error: OpenSSL signing failed.' );
        return false;
    }

    $base64_url_signature = str_replace( array( '+', '/', '=' ), array( '-', '_', '' ), base64_encode( $signature ) );
    $assertion = $payload . '.' . $base64_url_signature;

    $response = wp_remote_post( $token_uri, array(
        'body' => array(
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $assertion
        )
    ) );

    if ( is_wp_error( $response ) ) {
        error_log( '[Keystone Indexing API] OAuth Error: ' . $response->get_error_message() );
        return false;
    }

    $body = wp_remote_retrieve_body( $response );
    $token_data = json_decode( $body, true );

    if ( empty( $token_data['access_token'] ) ) {
        error_log( '[Keystone Indexing API] OAuth Error: Failed to retrieve access token. Response: ' . $body );
        return false;
    }

    $access_token = $token_data['access_token'];

    $api_url = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
    $api_response = wp_remote_post( $api_url, array(
        'headers' => array(
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . $access_token
        ),
        'body'    => json_encode( array(
            'url'  => $url,
            'type' => 'URL_UPDATED'
        ) )
    ) );

    if ( is_wp_error( $api_response ) ) {
        error_log( '[Keystone Indexing API] Publish Error for ' . $url . ': ' . $api_response->get_error_message() );
        return false;
    }

    $api_body = wp_remote_retrieve_body( $api_response );
    $status_code = wp_remote_retrieve_response_code( $api_response );

    if ( 200 !== $status_code ) {
        error_log( '[Keystone Indexing API] Publish Error ' . $status_code . ' for ' . $url . ': ' . $api_body );
        return false;
    }

    error_log( '[Keystone Indexing API] Success: Pushed ' . $url . ' to Google Indexing API.' );
    return true;
}

add_action( 'transition_post_status', 'keystone_auto_index_on_publish', 20, 3 );
/**
 * Automatically triggers Google Indexing API when a post or page is published.
 */
function keystone_auto_index_on_publish( $new_status, $old_status, $post ) {
    if ( 'publish' !== $new_status || 'publish' === $old_status ) {
        return;
    }

    $allowed_post_types = array( 'post', 'page' );
    if ( ! in_array( $post->post_type, $allowed_post_types ) ) {
        return;
    }

    $permalink = get_permalink( $post->ID );
    if ( $permalink && strpos( $post->post_name, 'auto-draft' ) === false ) {
        keystone_push_to_google_indexing( $permalink );
    }
}

add_action( 'post_updated', 'keystone_index_on_post_update', 10, 3 );
/**
 * Automatically triggers Google Indexing API when an already-published post/page is updated.
 */
function keystone_index_on_post_update( $post_id, $post_after, $post_before ) {
    if ( 'publish' !== $post_after->post_status ) {
        return;
    }

    $allowed_post_types = array( 'post', 'page' );
    if ( ! in_array( $post_after->post_type, $allowed_post_types ) ) {
        return;
    }

    if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
        return;
    }

    if ( $post_after->post_content === $post_before->post_content &&
         $post_after->post_title === $post_before->post_title &&
         $post_after->post_name === $post_before->post_name ) {
        return;
    }

    $permalink = get_permalink( $post_id );
    if ( $permalink && strpos( $post_after->post_name, 'auto-draft' ) === false ) {
        keystone_push_to_google_indexing( $permalink );
    }
}



/**
 * =====================================================================
 * SECTION: DYNAMIC LLMS.TXT ENDPOINT (GEO OPTIMIZATION)
 * =====================================================================
 */
add_action('init', 'keystone_dynamic_llms_txt');
function keystone_dynamic_llms_txt() {
    $request = $_SERVER['REQUEST_URI'];
    if (strpos($request, '/llms.txt') !== false) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "# Keystone Recomposition - AI LLM Context\n\n";
        echo "## Company Identity\n";
        echo "Keystone Recomposition is a high-ticket men's wellness and health optimization brand.\n";
        echo "Focus: Biological protocol engineering, peptide therapy education, and cognitive optimization.\n";
        echo "Founder: Wayne Stevenson.\n\n";
        echo "## Core Services\n";
        echo "- Advanced Men's Wellness Protocols\n";
        echo "- Biological Optimization\n";
        echo "- High-Ticket Consultations\n";
        exit;
    }
}



/**
 * ============================================================================
 * RANK MATH VIDEO SITEMAP OPTIMIZATION
 * Intercepts sitemap generation to expose [keystone_video] shortcodes to Rank Math
 * ============================================================================
 */
/**
 * Force Rank Math Video Sitemap to detect [keystone_video] shortcodes
 * and the keystone_youtube_id post meta by injecting standard YouTube
 * iframes into the content before Rank Math parses it.
 *
 * Hook: rank_math/sitemap/content_before_parse
 */
add_filter( 'rank_math/sitemap/content_before_parse', 'keystone_rank_math_inject_youtube_embeds', 10, 2 );

function keystone_rank_math_inject_youtube_embeds( $content, $post ) {

	if ( empty( $post ) || ! isset( $post->ID ) ) {
		return $content;
	}

	$iframe_template = '<iframe width="560" height="315" src="https://www.youtube.com/embed/%s" title="%s" frameborder="0" allowfullscreen></iframe>';

	$collected_ids = array();

	// 1. Convert every [keystone_video id="YOUTUBE_ID"] shortcode into a real iframe.
	if ( has_shortcode( $content, 'keystone_video' ) ) {
		$content = preg_replace_callback(
			'/\[keystone_video\s+[^\]]*id\s*=\s*["\']?([a-zA-Z0-9_-]{6,15})["\']?[^\]]*\]/i',
			function ( $matches ) use ( $iframe_template, $post, &$collected_ids ) {
				$video_id        = sanitize_text_field( $matches[1] );
				$collected_ids[] = $video_id;

				return sprintf(
					$iframe_template,
					esc_attr( $video_id ),
					esc_attr( get_the_title( $post->ID ) )
				);
			},
			$content
		);
	}

	// 2. Inject an iframe for the keystone_youtube_id post meta (if not already added).
	$meta_video_id = get_post_meta( $post->ID, 'keystone_youtube_id', true );

	if ( ! empty( $meta_video_id ) ) {
		$meta_video_id = sanitize_text_field( $meta_video_id );

		if ( ! in_array( $meta_video_id, $collected_ids, true ) ) {
			$content .= "\n" . sprintf(
				$iframe_template,
				esc_attr( $meta_video_id ),
				esc_attr( get_the_title( $post->ID ) )
			);
		}
	}

	return $content;
}
