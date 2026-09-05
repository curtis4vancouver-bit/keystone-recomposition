<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

add_filter( 'astra_the_title_before', 'keystone_recomposition_child_title_before', 10, 1 );
function keystone_recomposition_child_title_before( $before ) {
    if ( is_singular() ) {
        return preg_replace('~^<h[1-6]~i', '<h1', $before);
    }
    return $before;
}

add_filter( 'astra_the_title_after', 'keystone_recomposition_child_title_after', 10, 1 );
function keystone_recomposition_child_title_after( $after ) {
    if ( is_singular() ) {
        return preg_replace('~</h[1-6]>~i', '</h1>', $after);
    }
    return $after;
}

/**
 * 6. Filter the archive post title wrapper to ensure it's strictly an H2, preventing multiple H1s.
 */
add_filter( 'astra_the_post_title_before', 'keystone_recomposition_child_post_title_before', 10, 1 );
function keystone_recomposition_child_post_title_before( $before ) {
    if ( ! is_singular() ) {
        return preg_replace('~^<h[1-6]~i', '<h2', $before);
    }
    return $before;
}

add_filter( 'astra_the_post_title_after', 'keystone_recomposition_child_post_title_after', 10, 1 );
function keystone_recomposition_child_post_title_after( $after ) {
    if ( ! is_singular() ) {
        return preg_replace('~</h[1-6]>~i', '</h2>', $after);
    }
    return $after;
}

/**
 * 7. Inject Premium Organization & Person JSON-LD Schema (Knowledge Panel Anchor)
 */
function keystone_recomposition_child_inject_schema() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
    if ( ! $logo_url ) {
        $logo_url = 'https://keystonerecomposition.com/wp-content/uploads/logo.png';
    }

    // === Organization Schema (Keystone Recomposition Wellness Brand) ===
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => array( 'Organization', 'HealthAndBeautyBusiness' ),
        '@id' => 'https://keystonerecomposition.com/#organization',
        'name' => 'Keystone Recomposition',
        'url' => 'https://keystonerecomposition.com',
        'description' => 'Specializing in high-performance metabolic health, biohacking, and deep house music protocols.',
        'keywords' => 'Keystone Recomposition, GLP-1, health, beauty, wellness, weight loss, fitness, deep house music',
        'logo' => $logo_url,
        'areaServed' => array(
            array(
                '@type' => 'Country',
                'name' => 'United States'
            ),
            array(
                '@type' => 'Country',
                'name' => 'United Kingdom'
            ),
            array(
                '@type' => 'Country',
                'name' => 'Canada'
            ),
            array(
                '@type' => 'Country',
                'name' => 'Switzerland'
            ),
            array(
                '@type' => 'Country',
                'name' => 'Mexico'
            ),
            array(
                '@type' => 'City',
                'name' => 'New York',
                'sameAs' => 'https://en.wikipedia.org/wiki/New_York_City'
            ),
            array(
                '@type' => 'City',
                'name' => 'Los Angeles',
                'sameAs' => 'https://en.wikipedia.org/wiki/Los_Angeles'
            ),
            array(
                '@type' => 'City',
                'name' => 'London',
                'sameAs' => 'https://en.wikipedia.org/wiki/London'
            )
        ),
        'currenciesAccepted' => 'USD, GBP, CAD, EUR',
        'availableLanguage' => array( 'en-US', 'en-GB', 'en-CA' ),
        'parentOrganization' => array(
            '@type' => 'Organization',
            '@id' => 'https://keystonepossibilities.ca/#parent-organization',
            'name' => 'Keystone Empire',
            'alternateName' => 'Keystone Group',
            'url' => 'https://keystonepossibilities.ca',
            'description' => 'Master parent organization network governing Keystone Possibilities Ltd. and Keystone Recomposition.',
            'subOrganization' => array(
                array(
                    '@type' => 'Organization',
                    '@id' => 'https://keystonepossibilities.ca/#organization',
                    'name' => 'Keystone Possibilities Ltd.',
                    'url' => 'https://keystonepossibilities.ca'
                ),
                array(
                    '@type' => 'Organization',
                    '@id' => 'https://keystonerecomposition.com/#organization',
                    'name' => 'Keystone Recomposition',
                    'url' => 'https://keystonerecomposition.com'
                )
            ),
            'sameAs' => array(
                'https://keystonepossibilities.ca',
                'https://keystonerecomposition.com'
            )
        ),
        'sameAs' => array(
            'https://keystonepossibilities.ca',
            'https://www.youtube.com/@KeystoneRecomposition',
            'https://www.youtube.com/@KeystoneProtocols',
            'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'https://musicbrainz.org/label/30027d0e-6aeb-4704-8792-a031c936c62a',
            'https://audiomack.com/keystone-recomposition',
            'https://toolost.com',
            'https://www.tiktok.com/@keystonerecomposition'
        ),
        'identifier' => array(
            '@type' => 'PropertyValue',
            'propertyID' => 'Too Lost Catalog Reference ID',
            'value' => 'TOOLOST3000939655'
        ),
        'founder' => array(
            '@id' => 'https://keystonerecomposition.com/#person'
        )
    );

    $json_schema = wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

    echo "<!-- Keystone Digital JSON-LD Schema -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo $json_schema . "\n";
    echo "</script>\n";
    echo "<!-- End Keystone Digital JSON-LD Schema -->\n";

    // === Parent Organization Schema (Keystone Empire / Keystone Group) ===
    $parent_org_schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        '@id' => 'https://keystonepossibilities.ca/#parent-organization',
        'name' => 'Keystone Empire',
        'alternateName' => 'Keystone Group',
        'url' => 'https://keystonepossibilities.ca',
        'description' => 'Master parent organization network governing Keystone Possibilities Ltd. and Keystone Recomposition.',
        'subOrganization' => array(
            array(
                '@type' => 'Organization',
                '@id' => 'https://keystonepossibilities.ca/#organization',
                'name' => 'Keystone Possibilities Ltd.',
                'url' => 'https://keystonepossibilities.ca'
            ),
            array(
                '@type' => 'Organization',
                '@id' => 'https://keystonerecomposition.com/#organization',
                'name' => 'Keystone Recomposition',
                'url' => 'https://keystonerecomposition.com'
            )
        ),
        'sameAs' => array(
            'https://keystonepossibilities.ca',
            'https://keystonerecomposition.com'
        )
    );

    $json_parent_org = wp_json_encode( $parent_org_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

    echo "<!-- Keystone Empire Network ParentOrganization Schema -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo $json_parent_org . "\n";
    echo "</script>\n";
    echo "<!-- End Keystone Empire Network Schema -->\n";

    // === Person Schema (Wayne Stevenson - Knowledge Panel Anchor) ===
    $person_schema = array(
        '@context' => 'https://schema.org',
        '@graph' => array(
            array(
                '@type' => 'Person',
                '@id' => 'https://keystonerecomposition.com/#person',
                'name' => 'Wayne Stevenson',
                'alternateName' => array( 'Wayne Stevens', 'Keystone Recomposition', 'Keystone Protocols' ),
                'url' => 'https://keystonerecomposition.com/about-the-founder-the-keystone-blueprint/',
                'image' => array(
                    '@type' => 'ImageObject',
                    'url' => 'https://i0.wp.com/keystonerecomposition.com/wp-content/uploads/2026/05/Man_reaching_for_pepper_grinder11_202605021316.jpeg'
                ),
                'jobTitle' => 'Founder & Managing Director',
                'description' => 'Founder of Keystone Recomposition. Documents the intersection of GLP-1 metabolic health, peptide science, body recomposition, and longevity for men over 40. Also produces deep house music protocols.',
                'knowsAbout' => array(
                    array(
                        '@type' => 'Thing',
                        'name' => 'Metabolic Health Optimization',
                        'sameAs' => 'https://en.wikipedia.org/wiki/Metabolism'
                    ),
                    array(
                        '@type' => 'Thing',
                        'name' => 'Peptide Therapeutics',
                        'sameAs' => 'https://en.wikipedia.org/wiki/Peptide'
                    ),
                    array(
                        '@type' => 'Thing',
                        'name' => 'Solfeggio Soundscapes',
                        'sameAs' => 'https://en.wikipedia.org/wiki/Solfeggio'
                    )
                ),
                'sameAs' => array(
                    'https://www.linkedin.com/in/wayne-stevenson',
                    'https://open.spotify.com/artist/4zV1iPj3R9g16B3WwM7Y5m',
                    'https://www.youtube.com/channel/UCMn1f9DTF_iybKmv5WlTm9Q',
                    'https://keystonepossibilities.ca',
                    'https://www.youtube.com/@KeystoneRecomposition',
                    'https://www.youtube.com/@KeystoneProtocols',
                    'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
                    'https://musicbrainz.org/label/30027d0e-6aeb-4704-8792-a031c936c62a',
                    'https://audiomack.com/keystone-recomposition',
                    'https://www.facebook.com/profile.php?id=61554185128555',
                    'https://www.instagram.com/p/DO9FsCKj5Cb/',
                    'https://www.tiktok.com/@keystonerecomposition'
                ),
                'worksFor' => array(
                    array(
                        '@type' => 'OrganizationRole',
                        'worksFor' => array(
                            '@type' => 'Organization',
                            '@id' => 'https://keystonepossibilities.ca/#organization',
                            'name' => 'Keystone Possibilities Ltd.'
                        ),
                        'roleName' => 'Managing Director',
                        'startDate' => '2018'
                    ),
                    array(
                        '@type' => 'OrganizationRole',
                        'worksFor' => array(
                            '@type' => 'Organization',
                            '@id' => 'https://keystonerecomposition.com/#organization',
                            'name' => 'Keystone Recomposition'
                        ),
                        'roleName' => 'Founder & Metabolic Health Researcher',
                        'startDate' => '2021'
                    )
                )
            )
        )
    );

    $json_person = wp_json_encode( $person_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

    echo "<!-- Keystone Person Schema (Knowledge Panel) -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo $json_person . "\n";
    echo "</script>\n";
    echo "<!-- End Person Schema -->\n";
}
add_action( 'wp_head', 'keystone_recomposition_child_inject_schema' );

/**
 * 7.5 Inject MusicGroup & MusicAlbum JSON-LD Schema Nodes
 */
function keystone_recomposition_child_music_schema() {
    $music_schema = array(
        '@context' => 'https://schema.org',
        '@graph' => array(
            array(
                '@type' => 'MusicGroup',
                '@id' => 'https://keystonerecomposition.com/#musicgroup',
                'name' => 'Keystone Recomposition',
                'url' => 'https://keystonerecomposition.com',
                'genre' => array( 'Deep House', 'Solfeggio Frequencies', 'Ambient Fitness' ),
                'spotifyId' => '52v3Qe6Jo0hg764driOl5Y',
                'sameAs' => array(
                    'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
                    'https://musicbrainz.org/artist/52v3Qe6Jo0hg764driOl5Y',
                    'https://audiomack.com/keystone-recomposition'
                )
            ),
            array(
                '@type' => 'MusicAlbum',
                '@id' => 'https://keystonerecomposition.com/#album-concrete-foundations',
                'name' => 'Concrete Foundations',
                'description' => 'High-End Fitness Music and Raw Power Strength Electronic Soundscapes by Wayne Stevenson',
                'byArtist' => array(
                    '@type' => 'MusicGroup',
                    '@id' => 'https://keystonerecomposition.com/#musicgroup',
                    'name' => 'Keystone Recomposition',
                    'spotifyId' => '52v3Qe6Jo0hg764driOl5Y'
                ),
                'genre' => array( 'Electronic', 'Deep House', 'Fitness Focus' ),
                'musicbrainzId' => '30027d0e-6aeb-4704-8792-a031c936c62a'
            ),
            array(
                '@type' => 'MusicAlbum',
                '@id' => 'https://keystonerecomposition.com/#album-resonantia',
                'name' => 'Resonantia: 10 Frequencies of the Rebuild',
                'description' => '10 Progressive Biohacking & Deep House Frequencies mapping metabolic discipline',
                'byArtist' => array(
                    '@type' => 'MusicGroup',
                    '@id' => 'https://keystonerecomposition.com/#musicgroup',
                    'name' => 'Keystone Recomposition',
                    'spotifyId' => '52v3Qe6Jo0hg764driOl5Y'
                ),
                'genre' => array( 'Deep House', 'Solfeggio Frequencies', 'Ambient Fitness' )
            ),
            array(
                '@type' => 'MusicRecording',
                '@id' => 'https://keystonerecomposition.com/#track-205-marker',
                'name' => 'The 205 Marker',
                'byArtist' => array(
                    '@type' => 'MusicGroup',
                    '@id' => 'https://keystonerecomposition.com/#musicgroup'
                ),
                'inAlbum' => array(
                    '@id' => 'https://keystonerecomposition.com/#album-concrete-foundations'
                )
            )
        )
    );

    $json_music = wp_json_encode( $music_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

    echo "<!-- Keystone MusicGroup & MusicAlbum JSON-LD Schema -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo $json_music . "\n";
    echo "</script>\n";
    echo "<!-- End Keystone Music Schema -->\n";
}
add_action( 'wp_head', 'keystone_recomposition_child_music_schema' );

/**
 * 7.8 Keystone Centralized Post Video Metadata Helper
 * Safely extracts authentic 11-char YouTube ID and complete Schema.org video metadata.
 * Explicitly validates ID against /^[a-zA-Z0-9_-]{11}$/ to eliminate maxresdefau corruption.
 *
 * @param int|WP_Post $post_or_id Post object or ID.
 * @return array|null Metadata array or null if no valid video found.
 */
function keystone_get_post_video_metadata( $post_or_id = null ) {
    $post = get_post( $post_or_id );
    if ( ! $post ) {
        return null;
    }

    $is_watch_page = ( 'page' === $post->post_type && 0 === strpos( $post->post_name, 'watch-' ) );
    $post_id = $post->ID;

    if ( $is_watch_page ) {
        $blog_slug = str_replace( 'watch-', '', $post->post_name );
        $blog_posts = get_posts( array(
            'name'        => $blog_slug,
            'post_type'   => 'post',
            'post_status' => 'publish',
            'numberposts' => 1,
        ) );
        if ( ! empty( $blog_posts ) ) {
            $post_id = $blog_posts[0]->ID;
        } else {
            global $wpdb;
            $like_slug = '%' . $wpdb->esc_like( $blog_slug ) . '%';
            $fuzzy_post = $wpdb->get_row( $wpdb->prepare(
                "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish' AND post_name LIKE %s LIMIT 1",
                $like_slug
            ) );
            if ( $fuzzy_post ) {
                $post_id = (int) $fuzzy_post->ID;
            } else {
                $fuzzy_post2 = $wpdb->get_row( $wpdb->prepare(
                    "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish' AND %s LIKE CONCAT('%%', post_name, '%%') LIMIT 1",
                    $blog_slug
                ) );
                if ( $fuzzy_post2 ) {
                    $post_id = (int) $fuzzy_post2->ID;
                }
            }
        }
    }

    // Extract YouTube ID
    $youtube_id = get_post_meta( $post_id, 'keystone_youtube_id', true );
    $video_url = get_post_meta( $post_id, 'video_url', true );

    if ( empty( $youtube_id ) && ! empty( $video_url ) ) {
        if ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=|shorts/)|youtu\.be/|youtube-nocookie\.com/embed/)([^"&?/ ]{11})~i', (string) $video_url, $matches ) ) {
            $youtube_id = $matches[1];
        }
    }

    if ( empty( $youtube_id ) ) {
        $source_post = ( $post_id !== $post->ID ) ? get_post( $post_id ) : $post;
        $content = $source_post ? $source_post->post_content : $post->post_content;
        if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $content, $matches ) ) {
            $youtube_id = $matches[1];
        } elseif ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=|shorts/)|youtu\.be/|youtube-nocookie\.com/embed/)([^"&?/ ]{11})~i', $content, $matches ) ) {
            $youtube_id = $matches[1];
        }
    }

    // Strict validation: Must be authentic 11-char ID and MUST NOT be 'maxresdefau'
    if ( empty( $youtube_id ) || ! preg_match( '/^[a-zA-Z0-9_-]{11}$/', (string) $youtube_id ) || 'maxresdefau' === $youtube_id ) {
        return null;
    }

    // Determine metadata
    $video_name = get_post_meta( $post_id, 'video_title', true );
    if ( empty( $video_name ) ) {
        $video_name = get_the_title( $post_id );
    }

    $video_description = get_post_meta( $post_id, 'video_description', true );
    if ( empty( $video_description ) ) {
        $excerpt_source = get_the_excerpt( $post_id );
        if ( empty( $excerpt_source ) ) {
            $source_p = get_post( $post_id );
            $excerpt_source = $source_p ? $source_p->post_content : '';
        }
        $clean_excerpt = wp_strip_all_tags( strip_shortcodes( (string) $excerpt_source ) );
        $video_description = wp_html_excerpt( $clean_excerpt, 150, '...' );
    }
    if ( empty( $video_description ) ) {
        $video_description = esc_attr( get_the_title( $post_id ) ) . ' - High-performance metabolic health and protocol blueprint.';
    }

    $video_duration = get_post_meta( $post_id, 'video_duration', true );
    if ( empty( $video_duration ) ) {
        $video_duration = get_post_meta( $post_id, 'keystone_video_duration', true );
    }

    $duration_iso = 'PT5M0S';
    $duration_seconds = 300;

    if ( ! empty( $video_duration ) ) {
        $video_duration = trim( (string) $video_duration );
        if ( stripos( $video_duration, 'PT' ) === 0 ) {
            $duration_iso = $video_duration;
            $sec = 0;
            if ( preg_match( '/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/i', $video_duration, $dm ) ) {
                $h = ! empty( $dm[1] ) ? (int) $dm[1] : 0;
                $m = ! empty( $dm[2] ) ? (int) $dm[2] : 0;
                $s = ! empty( $dm[3] ) ? (int) $dm[3] : 0;
                $sec = ( $h * 3600 ) + ( $m * 60 ) + $s;
            }
            $duration_seconds = $sec > 0 ? $sec : 300;
        } else {
            $hours = 0; $minutes = 0; $seconds = 0;
            if ( is_numeric( $video_duration ) ) {
                $total_seconds = intval( $video_duration );
                $hours = (int) floor( $total_seconds / 3600 );
                $minutes = (int) floor( ( $total_seconds / 60 ) % 60 );
                $seconds = $total_seconds % 60;
                $duration_seconds = $total_seconds;
            } elseif ( preg_match( '~^(?:(\d+):)?(\d+):(\d+)$~', $video_duration, $matches ) ) {
                if ( count( $matches ) === 4 && $matches[1] !== '' ) {
                    $hours = intval( $matches[1] );
                    $minutes = intval( $matches[2] );
                    $seconds = intval( $matches[3] );
                } else {
                    $minutes = intval( $matches[2] );
                    $seconds = intval( $matches[3] );
                }
                $duration_seconds = ( $hours * 3600 ) + ( $minutes * 60 ) + $seconds;
            }
            $duration_iso = 'PT';
            if ( $hours > 0 ) $duration_iso .= $hours . 'H';
            if ( $minutes > 0 ) $duration_iso .= $minutes . 'M';
            if ( $seconds > 0 || ( $hours === 0 && $minutes === 0 ) ) $duration_iso .= $seconds . 'S';
        }
    }

    $video_upload_date = get_post_meta( $post_id, 'video_upload_date', true );
    if ( empty( $video_upload_date ) ) {
        $video_upload_date = get_the_date( 'c', $post_id );
    } else {
        $converted_time = strtotime( (string) $video_upload_date );
        $video_upload_date = ( $converted_time !== false ) ? date( 'c', $converted_time ) : get_the_date( 'c', $post_id );
    }

    $thumbnail_url = "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
    $embed_url     = "https://www.youtube.com/embed/{$youtube_id}";
    $content_url   = "https://www.youtube.com/watch?v={$youtube_id}";

    $publisher = array(
        '@type' => 'Organization',
        '@id'   => 'https://keystonerecomposition.com/#organization',
        'name'  => 'Keystone Recomposition',
        'url'   => 'https://keystonerecomposition.com',
        'logo'  => array(
            '@type' => 'ImageObject',
            'url'   => 'https://keystonerecomposition.com/wp-content/uploads/logo.png',
        ),
    );

    return array(
        'post_id'          => $post_id,
        'youtube_id'       => $youtube_id,
        'title'            => $video_name,
        'description'      => $video_description,
        'duration_iso'     => $duration_iso,
        'duration_seconds' => $duration_seconds,
        'upload_date'      => $video_upload_date,
        'thumbnail_url'    => $thumbnail_url,
        'embed_url'        => $embed_url,
        'content_url'      => $content_url,
        'publisher'        => $publisher,
    );
}

/**
 * 8. Dynamic, Robust, GSC-Compliant Standalone VideoObject Schema (Stored XSS Secure)
 * Extracts the primary article video and outputs exactly ONE premium schema object.
 */
function keystone_recomposition_child_youtube_schema() {
    global $post;
    if ( ! $post ) {
        return;
    }
    $is_watch_page = ( 'page' === $post->post_type && 0 === strpos( $post->post_name, 'watch-' ) );
    if ( ! is_singular( 'post' ) && ! $is_watch_page ) {
        return;
    }

    // If Rank Math is active, we hook directly into its JSON-LD filter instead of printing a standalone tag
    if ( class_exists( 'RankMath' ) ) {
        return;
    }

    $meta = keystone_get_post_video_metadata( $post );
    if ( ! $meta ) {
        return;
    }

    $video_schema = array(
        '@context'      => 'https://schema.org',
        '@type'         => 'VideoObject',
        '@id'           => get_permalink( $post->ID ) . '#video',
        'name'          => esc_attr( $meta['title'] ),
        'description'   => esc_attr( $meta['description'] ),
        'thumbnailUrl'  => esc_url( $meta['thumbnail_url'] ),
        'uploadDate'    => esc_attr( $meta['upload_date'] ),
        'embedUrl'      => esc_url( $meta['embed_url'] ),
        'contentUrl'    => esc_url( $meta['content_url'] ),
        'duration'      => esc_attr( $meta['duration_iso'] ),
        'publisher'     => $meta['publisher'],
    );

    $json_video_schema = wp_json_encode( $video_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT );

    echo "\n<!-- Keystone Digital VideoObject Schema for YouTube -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo $json_video_schema . "\n";
    echo "</script>\n";
    echo "<!-- End VideoObject Schema -->\n\n";
}
add_action( 'wp_head', 'keystone_recomposition_child_youtube_schema', 20 );

/**
 * 8.2 Integrate Dynamic VideoObject Schema directly into Rank Math JSON-LD Graph
 */
add_filter( 'rank_math/json_ld', 'keystone_recomposition_integrate_video_schema', 100000, 2 );
function keystone_recomposition_integrate_video_schema( $data, $jsonld ) {
    global $post;
    if ( ! $post ) {
        return $data;
    }
    $is_watch_page = ( 'page' === $post->post_type && 0 === strpos( $post->post_name, 'watch-' ) );
    if ( ! is_singular( 'post' ) && ! $is_watch_page ) {
        return $data;
    }

    $meta = keystone_get_post_video_metadata( $post );
    if ( ! $meta ) {
        return $data;
    }

    // Check if VideoObject already exists in Rank Math output
    foreach ( $data as $val ) {
        if ( isset( $val['@type'] ) && $val['@type'] === 'VideoObject' ) {
            return $data; // Already present, don't duplicate
        }
    }

    $video_id = get_permalink( $post->ID ) . '#video';

    $data['VideoObject'] = array(
        '@type'        => 'VideoObject',
        '@id'          => $video_id,
        'name'         => esc_attr( $meta['title'] ),
        'description'  => esc_attr( $meta['description'] ),
        'thumbnailUrl' => esc_url( $meta['thumbnail_url'] ),
        'uploadDate'   => esc_attr( $meta['upload_date'] ),
        'embedUrl'     => esc_url( $meta['embed_url'] ),
        'contentUrl'   => esc_url( $meta['content_url'] ),
        'duration'     => esc_attr( $meta['duration_iso'] ),
        'publisher'    => $meta['publisher'],
    );

    // Link VideoObject to WebPage and Article to prevent Rank Math from stripping it as an orphan node
    if ( isset( $data['WebPage'] ) ) {
        $data['WebPage']['video'] = array( '@id' => $video_id );
    }
    if ( isset( $data['richSnippet'] ) ) {
        $data['richSnippet']['video'] = array( '@id' => $video_id );
    }

    return $data;
}

/**
 * 8.5 Dynamic MedicalWebPage Schema
 */
function keystone_recomposition_child_medical_schema() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }
    
    global $post;
    
    $medical_schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'MedicalWebPage',
        'name' => esc_attr( get_the_title( $post->ID ) ),
        'url' => esc_url( get_permalink( $post->ID ) ),
        'lastReviewed' => esc_attr( get_the_modified_date( 'Y-m-d', $post->ID ) ),
        'reviewedBy' => array(
            '@type' => 'Person',
            'name' => 'Wayne Stevenson',
            'jobTitle' => 'Metabolic Researcher'
        ),
        'specialty' => 'https://schema.org/Endocrine',
        'audience' => array(
            '@type' => 'MedicalAudience',
            'audienceType' => 'Health Enthusiasts and Patients'
        )
    );
    
    echo "\n<!-- Keystone MedicalWebPage Schema -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo wp_json_encode( $medical_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . "\n";
    echo "</script>\n";
    echo "<!-- End MedicalWebPage Schema -->\n\n";
}
add_action( 'wp_head', 'keystone_recomposition_child_medical_schema', 25 );

/**
 * 9. Hook custom media metadata into Rank Math PRO's Video Sitemap Generator
 */
add_filter( 'rank_math/sitemap/video/post', function( $video, $post_id ) {
    if ( ! is_array( $video ) ) {
        return $video;
    }
    $meta = keystone_get_post_video_metadata( (int) $post_id );
    if ( $meta ) {
        $video['thumbnail_loc'] = $meta['thumbnail_url'];
        $video['title']         = mb_substr( $meta['title'], 0, 100 );
        $video['description']   = mb_substr( $meta['description'], 0, 2048 );
        $video['content_loc']   = $meta['content_url'];
        $video['player_loc']    = $meta['embed_url'];
        $video['duration']      = $meta['duration_seconds'];
        $video['uploader']      = 'Wayne Stevenson';
        $video['uploader_info'] = 'https://keystonerecomposition.com/';
    }
    return $video;
}, 10, 2 );

/**
 * 10. Deduplicate Rank Math JSON-LD Schema Graph & Auto-detected Videos
 */
add_filter( 'rank_math/json_ld', function( $data, $jsonld ) {
    if ( ! is_array( $data ) ) {
        return $data;
    }
    foreach ( $data as $key => $val ) {
        if ( in_array( strtolower( (string) $key ), array( 'video', 'videoobject' ), true ) ) {
            unset( $data[ $key ] );
        }
        if ( is_array( $val ) && isset( $val['@type'] ) ) {
            $types = (array) $val['@type'];
            foreach ( $types as $t ) {
                if ( strtolower( (string) $t ) === 'videoobject' ) {
                    unset( $data[ $key ] );
                    break;
                }
            }
        }
    }
    if ( isset( $data['@graph'] ) && is_array( $data['@graph'] ) ) {
        $other_nodes = array();
        foreach ( $data['@graph'] as $node ) {
            if ( isset( $node['@type'] ) ) {
                $types = (array) $node['@type'];
                $has_video = false;
                foreach ( $types as $t ) {
                    if ( strtolower( (string) $t ) === 'videoobject' ) {
                        $has_video = true;
                        break;
                    }
                }
                if ( ! $has_video ) {
                    $other_nodes[] = $node;
                }
            } else {
                $other_nodes[] = $node;
            }
        }
        $data['@graph'] = $other_nodes;
    }
    return $data;
}, 999, 2 );

/**
 * 10.1 KILL Rank Math PRO's Auto-Detected Video Schema Entirely
 * Rank Math PRO scans rendered page content and auto-detects YouTube embeds.
 * It incorrectly parses our luxury-video-facade thumbnail URL
 * (img.youtube.com/vi/{id}/maxresdefault.jpg) and extracts "maxresdefau"
 * (11 chars from the path) as a fake YouTube video ID, creating a broken
 * duplicate VideoObject schema. Since we output our own clean VideoObject
 * via keystone_recomposition_child_youtube_schema(), we disable Rank Math's
 * video schema completely.
 */

// Disable Rank Math's auto-detected video schema from its schema module
add_filter( 'rank_math/snippet/rich_snippet_video', '__return_false' );
add_filter( 'rank_math/schema/video', '__return_empty_array' );

// Strip any VideoObject that Rank Math outputs as a separate JSON-LD block
// This catches schemas that bypass the @graph dedup filter above
add_filter( 'rank_math/json_ld', function( $data, $jsonld ) {
    if ( ! is_array( $data ) ) {
        return $data;
    }
    // Remove any top-level keys that contain a VideoObject schema
    foreach ( $data as $key => $val ) {
        if ( ! is_array( $val ) ) continue;
        if ( isset( $val['@type'] ) ) {
            $types = (array) $val['@type'];
            foreach ( $types as $t ) {
                if ( strtolower( (string) $t ) === 'videoobject' ) {
                    unset( $data[ $key ] );
                    break;
                }
            }
        }
    }
    return $data;
}, 9999, 2 );

// Output buffer safety net: strip broken VideoObject schemas from Rank Math & DOM
// Uses a robust approach that handles both top-level VideoObjects and @graph nested VideoObjects
add_action( 'wp_head', function() {
    ob_start( function( $output ) {
        // Strategy: find all JSON-LD script tags, decode, check for broken VideoObject, clean or remove
        $output = preg_replace_callback(
            '~(<script\s+type=["\']application/ld\+json["\'][^>]*>)(.*?)(</script>)~is',
            function( $matches ) {
                $json = json_decode( $matches[2], true );
                if ( ! is_array( $json ) ) {
                    return $matches[0]; // Can't parse, leave alone
                }

                // 1. Single Top-Level VideoObject check
                if ( isset( $json['@type'] ) && ( $json['@type'] === 'VideoObject' || in_array( 'VideoObject', (array) $json['@type'], true ) ) ) {
                    // Kill it if embedUrl or contentUrl contains 'maxresdefau' (broken Rank Math detection)
                    $embed = $json['embedUrl'] ?? '';
                    $content = $json['contentUrl'] ?? '';
                    if ( strpos( (string) $embed, 'maxresdefau' ) !== false || strpos( (string) $content, 'maxresdefau' ) !== false ) {
                        return '<!-- Keystone: Removed corrupt VideoObject with invalid fake ID -->';
                    }
                    // Kill it if it has no publisher field (our custom schema always has publisher)
                    if ( ! isset( $json['publisher'] ) ) {
                        return '<!-- Keystone: Removed duplicate VideoObject without publisher -->';
                    }
                }

                // 2. Nested @graph VideoObject check
                if ( isset( $json['@graph'] ) && is_array( $json['@graph'] ) ) {
                    $filtered_graph = array();
                    $graph_modified = false;
                    foreach ( $json['@graph'] as $node ) {
                        if ( isset( $node['@type'] ) && ( $node['@type'] === 'VideoObject' || in_array( 'VideoObject', (array) $node['@type'], true ) ) ) {
                            $embed = $node['embedUrl'] ?? '';
                            $content = $node['contentUrl'] ?? '';
                            if ( strpos( (string) $embed, 'maxresdefau' ) !== false || strpos( (string) $content, 'maxresdefau' ) !== false || ! isset( $node['publisher'] ) ) {
                                $graph_modified = true;
                                continue; // Strip corrupt / duplicate node
                            }
                        }
                        $filtered_graph[] = $node;
                    }
                    if ( $graph_modified ) {
                        $json['@graph'] = $filtered_graph;
                        return $matches[1] . "\n" . wp_json_encode( $json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) . "\n" . $matches[3];
                    }
                }

                return $matches[0];
            },
            $output
        );
        return $output;
    });
}, 0 );
add_action( 'wp_footer', function() {
    if ( ob_get_level() > 0 ) {
        ob_end_flush();
    }
}, 9999 );

/**
 * 10.5 Inject og:video Meta Tags for Google Video Indexing
 * Rank Math PRO can't detect [keystone_video] shortcodes, so it only generates
 * og:video tags for natively embedded videos. This function ensures ALL posts
 * with a YouTube video get the og:video signals Google needs for video indexing.
 */
function keystone_recomposition_inject_og_video() {
    global $post;
    if ( ! $post ) {
        return;
    }
    $is_watch_page = ( 'page' === $post->post_type && 0 === strpos( $post->post_name, 'watch-' ) );
    if ( ! is_singular( 'post' ) && ! $is_watch_page ) {
        return;
    }

    $meta = keystone_get_post_video_metadata( $post );
    if ( ! $meta ) {
        return;
    }

    $embed_url = esc_url( $meta['embed_url'] );

    echo '<!-- Keystone og:video Meta Tags -->' . "\n";
    echo '<meta property="og:video" content="' . $embed_url . '" />' . "\n";
    echo '<meta property="og:video:secure_url" content="' . $embed_url . '" />' . "\n";
    echo '<meta property="og:video:type" content="text/html" />' . "\n";
    echo '<meta property="og:video:width" content="1280" />' . "\n";
    echo '<meta property="og:video:height" content="720" />' . "\n";
    echo '<meta property="ya:ovs:allow_embed" content="true" />' . "\n";
    echo '<!-- End Keystone og:video -->' . "\n";
}
add_action( 'wp_head', 'keystone_recomposition_inject_og_video', 5 );

/**
 * 10.8 Rank Math XML Sitemap Sanitizer (Eliminates GSC 301s, 404s, Thin Archives, Transients)
 */
add_filter( 'rank_math/sitemap/entry', 'keystone_recomposition_sanitize_rank_math_sitemap', 10, 3 );
function keystone_recomposition_sanitize_rank_math_sitemap( $url, $type, $object ) {
    if ( empty( $url ) || ! is_array( $url ) ) {
        return $url;
    }

    $excluded_patterns = array(
        'sample-page',
        'test',
        'demo',
        'wp-admin',
        'squamish-general-contractor',
        'west-vancouver-custom-homes',
        'whistler-luxury-home-builder',
        'bc-hydro-registered-civil-contractor',
        'north-vancouver-home-builder',
        'west-vancouver-luxury-builder',
        'pemberton-luxury-builder',
        '52603',
        '.html',
        '/tag/',
        '/author/',
        '/date/',
        '__trashed',
        '/trash/',
        'check_rm_options',
        'run_instant_indexing',
        'purge_all_caches',
        'heal_video_meta',
        'run_keystone_migration',
        'keystone_video_sitemap',
    );

    $known_301_sources = array(
        '/2026/01/23/mounjaro-kwikpen-the-official-click-to-mg-math-bible/',
        '/2026/05/07/wolverine-stack-bpc-157-tb500-protocol-blueprint/',
        '/mounjaro-muscle-loss.html',
        '/wolverine-stack.html',
    );

    if ( isset( $url['loc'] ) ) {
        $loc = (string) $url['loc'];

        // Filter duplicate watch pages (/watch-*) from page-sitemap.xml and general sitemaps
        if ( 'page' === $type && ( stripos( $loc, '/watch-' ) !== false || ( is_object( $object ) && isset( $object->post_name ) && 0 === strpos( (string) $object->post_name, 'watch-' ) ) ) ) {
            return false;
        }
        if ( stripos( $loc, '/watch-' ) !== false ) {
            return false;
        }

        foreach ( $excluded_patterns as $pat ) {
            if ( stripos( $loc, $pat ) !== false ) {
                return false;
            }
        }
        foreach ( $known_301_sources as $redirect_src ) {
            if ( stripos( $loc, trim( $redirect_src, '/' ) ) !== false ) {
                return false;
            }
        }
        // Filter pure date archives (e.g. https://domain.com/2026/ or /2026/05/)
        if ( preg_match( '~^https?://[^/]+/\d{4}/(?:\d{2}/)?$~i', $loc ) ) {
            return false;
        }
    }

    if ( is_object( $object ) && isset( $object->ID ) ) {
        $post_id = (int) $object->ID;
        $post_status = get_post_status( $post_id );

        // 1. Discard non-published posts
        if ( 'publish' !== $post_status ) {
            return false;
        }

        // 2. Discard posts with explicit noindex robots meta
        $robots = get_post_meta( $post_id, 'rank_math_robots', true );
        if ( is_array( $robots ) && in_array( 'noindex', $robots, true ) ) {
            return false;
        }
        if ( is_string( $robots ) && stripos( $robots, 'noindex' ) !== false ) {
            return false;
        }

        // 3. Discard posts that are 301 redirects
        $is_redirect = get_post_meta( $post_id, 'rank_math_redirection_id', true );
        if ( ! empty( $is_redirect ) ) {
            return false;
        }
        $redirect_to = get_post_meta( $post_id, 'rank_math_redirection_url', true );
        if ( ! empty( $redirect_to ) ) {
            return false;
        }
    }

    return $url;
}
add_filter( 'rank_math/sitemap/enable_caching', '__return_false' );

// Exclude tag taxonomy sitemaps to prevent index bloat
add_filter( 'rank_math/sitemap/exclude_taxonomy', function( $exclude, $taxonomy ) {
    if ( 'post_tag' === $taxonomy ) {
        return true;
    }
    return $exclude;
}, 10, 2 );

/**
 * 11. Dynamic Robots.txt Sanitizer
 * Resolves 8 "Blocked by robots.txt" issues in GSC by allowing critical theme/upload assets,
 * explicitly unblocking AI search crawlers (GPTBot, ClaudeBot, PerplexityBot, Google-Extended),
 * and referencing the primary sitemap index.
 */
add_filter( 'robots_txt', 'keystone_recomposition_sanitize_robots_txt', 10, 2 );
function keystone_recomposition_sanitize_robots_txt( $output, $public ) {
    $sitemap_url = home_url( '/sitemap_index.xml' );
    $video_sitemap_url = home_url( '/keystone-video-sitemap.xml' );

    $robots = "User-agent: *\n";
    $robots .= "Disallow: /wp-admin/\n";
    $robots .= "Allow: /wp-admin/admin-ajax.php\n";
    $robots .= "Allow: /wp-content/uploads/\n";
    $robots .= "Allow: /wp-content/themes/\n";
    $robots .= "Allow: /wp-includes/\n";
    $robots .= "Disallow: /wp-content/plugins/\n";
    $robots .= "Disallow: /readme.html\n";
    $robots .= "Disallow: /license.txt\n";
    $robots .= "Disallow: /search/\n";
    $robots .= "Disallow: /?s=\n";
    $robots .= "Disallow: /*.html$\n";
    $robots .= "\n";

    // AI Search Crawlers Explicit Directives
    $robots .= "User-agent: GPTBot\n";
    $robots .= "Allow: /\n\n";

    $robots .= "User-agent: ClaudeBot\n";
    $robots .= "Allow: /\n\n";

    $robots .= "User-agent: PerplexityBot\n";
    $robots .= "Allow: /\n\n";

    $robots .= "User-agent: Google-Extended\n";
    $robots .= "Allow: /\n\n";

    $robots .= "User-agent: CCBot\n";
    $robots .= "Allow: /\n\n";

    $robots .= "Sitemap: " . esc_url( $sitemap_url ) . "\n";
    $robots .= "Sitemap: " . esc_url( $video_sitemap_url ) . "\n";

    return $robots;
}

/**
 * 11.5 General SEO Fixes: output noindex for tag, date, author archives and query parameters
 */
function keystone_recomposition_child_seo_noindex() {
    $should_noindex = false;

    // Only noindex archive types that create duplicate content
    if ( is_date() || is_author() || is_tag() || is_search() ) {
        $should_noindex = true;
    }

    // Only noindex pages with truly junk query params — NOT internal WP or tracking params
    if ( ! empty( $_GET ) && ! is_singular() ) {
        $allowed_params = array(
            'page', 'paged', 'p', 'page_id', 'cat', 'tag',
            'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content',
            'gclid', 'fbclid', 'ref', 'mc_cid', 'mc_eid',
            // Internal Keystone endpoints
            'get_post_inventory', 'purge_all_caches', 'run_instant_indexing',
            'run_keystone_migration', 'heal_video_meta', 'check_rm_options',
            'keystone_video_sitemap',
            // Rank Math / WP internals
            'replytocom', 'preview', 'preview_id', 'preview_nonce'
        );
        foreach ( $_GET as $key => $value ) {
            if ( ! in_array( $key, $allowed_params ) ) {
                $should_noindex = true;
                break;
            }
        }
    }

    if ( $should_noindex ) {
        echo "<meta name=\"robots\" content=\"noindex, follow\">\n";
    }
}
add_action( 'wp_head', 'keystone_recomposition_child_seo_noindex', 1 );

/**
 * 12. Patch Structural Site Leaks (404/Redirect Errors & 410 Gone Interceptor)
 */
function keystone_recomposition_child_404_redirect() {
    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    if ( empty( $request_uri ) ) {
        return;
    }

    // Normalize request URI
    $path = strtok( $request_uri, '?' ); // Strip query parameters
    $path = '/' . trim( (string) $path, '/' ) . '/'; // Standardize slashes
    $path = str_replace( '//', '/', $path );

    $redirects_301 = array(
        '/2026/01/23/mounjaro-kwikpen-the-official-click-to-mg-math-bible/' => '/2026/01/13/stop-chasing-skinny-week-14-recomposition-the-269-click-kwikpen-secret/',
        '/2026/05/07/wolverine-stack-bpc-157-tb500-protocol-blueprint/'     => '/2026/05/07/wolverine-stack-bpc-157-tb-500-protocol-blueprint/',
        '/mounjaro-muscle-loss.html/'                                       => '/2026/01/13/stop-chasing-skinny-week-14-recomposition-the-269-click-kwikpen-secret/',
        '/wolverine-stack.html/'                                            => '/2026/05/07/wolverine-stack-bpc-157-tb-500-protocol-blueprint/',
    );

    $gone_paths = array(
        '/keystone_recomposition_/',
        '/logo/',
        '/keystone-recomposition-ltd/',
        '/keystone_recomposition_ltd_invert-removebg-preview/',
        '/logout/',
        '/the-journey/',
        '/sample-page/',
        '/test/',
        '/demo/',
        '/52603/',
        '/squamish-general-contractor/',
        '/west-vancouver-custom-homes/',
        '/whistler-luxury-home-builder/',
        '/bc-hydro-registered-civil-contractor/',
        '/north-vancouver-home-builder/',
        '/west-vancouver-luxury-builder/',
        '/pemberton-luxury-builder/',
    );

    // Exact 301 redirects
    if ( isset( $redirects_301[ $path ] ) ) {
        wp_redirect( home_url( $redirects_301[ $path ] ), 301 );
        exit;
    }

    // Exact and prefix 410 Gone statuses
    $is_gone = false;
    foreach ( $gone_paths as $gone_target ) {
        if ( $path === $gone_target || ( '/' !== $gone_target && 0 === strpos( $path, $gone_target ) ) ) {
            $is_gone = true;
            break;
        }
    }

    if ( $is_gone ) {
        status_header( 410 );
        nocache_headers();
        if ( function_exists( 'get_query_template' ) && file_exists( (string) get_query_template( '404' ) ) ) {
            include( get_query_template( '404' ) );
        } else {
            echo '410 Gone - This resource is permanently removed.';
        }
        exit;
    }

    // Wildcard matches for rogue PHP file requests
    if ( strpos( $path, '/wp-content/themes/keystone-recomposition-child' ) !== false ||
         preg_match( '~^/wp-.*\.php$~i', $path ) ||
         ( strpos( $path, '/wp-admin' ) === false && preg_match( '~\.php$~i', $path ) ) ) {
        wp_redirect( home_url(), 301 );
        exit;
    }

}
add_action( 'template_redirect', 'keystone_recomposition_child_404_redirect' );

/**
 * 13. Shortcode to render our fast, PageSpeed-optimized lazy YouTube/Spotify media facade
 */

/**
 * 14. Inject 2026 WebApplication & FAQPage Schema for Calculator Pages
 * Maximizes global Google Rich Results in US, UK, CA, and AU for high-intent queries.
 */
add_action( 'wp_head', 'keystone_inject_calculator_web_app_schema', 15 );
function keystone_inject_calculator_web_app_schema() {
    if ( ! is_page() ) {
        return;
    }

    global $post;
    $slug = isset( $post->post_name ) ? $post->post_name : '';
    $template = get_page_template_slug( $post->ID );

    if ( 'calculators' === $slug || false !== strpos( $template, 'calculators' ) || false !== strpos( $template, 'glp1' ) || false !== strpos( $template, 'peptide' ) ) {
        $calc_schema = array(
            '@context' => 'https://schema.org',
            '@graph' => array(
                array(
                    '@type' => 'WebApplication',
                    '@id' => home_url( '/calculators/#webapp' ),
                    'name' => 'Keystone Master Protocol Calculators Hub',
                    'alternateName' => 'GLP-1 KwikPen & Peptide Reconstitution Calculator',
                    'url' => home_url( '/calculators/' ),
                    'description' => 'Precision GLP-1 KwikPen click-to-mg dose math, 5-day pharmacokinetic half-life modeling, and FDA Category 1 peptide reconstitution calculator with visual U-100 syringe rendering.',
                    'applicationCategory' => 'HealthApplication',
                    'operatingSystem' => 'All',
                    'browserRequirements' => 'Requires JavaScript. Requires HTML5.',
                    'offers' => array(
                        '@type' => 'Offer',
                        'price' => '0',
                        'priceCurrency' => 'USD',
                        'availability' => 'https://schema.org/InStock'
                    ),
                    'author' => array(
                        '@id' => 'https://keystonerecomposition.com/#person'
                    ),
                    'publisher' => array(
                        '@id' => 'https://keystonerecomposition.com/#organization'
                    )
                ),
                array(
                    '@type' => 'FAQPage',
                    '@id' => home_url( '/calculators/#faq' ),
                    'mainEntity' => array(
                        array(
                            '@type' => 'Question',
                            'name' => 'How do I calculate peptide reconstitution dosage with bacteriostatic water?',
                            'acceptedAnswer' => array(
                                '@type' => 'Answer',
                                'text' => 'Peptide reconstitution concentration is calculated using the formula: Concentration (mcg/unit) = (Vial Mass in mg × 1,000) ÷ (BAC Water Volume in mL × 100). For example, adding 2 mL of bacteriostatic water to a 10 mg vial yields 50 mcg per 1 unit tick on a standard U-100 insulin syringe.'
                            )
                        ),
                        array(
                            '@type' => 'Question',
                            'name' => 'How many clicks on a Mounjaro or Ozempic KwikPen equal a micro-dose?',
                            'acceptedAnswer' => array(
                                '@type' => 'Answer',
                                'text' => 'A full standard dose on a multi-dose KwikPen dial corresponds to 60 clicks. Each single click delivers 1/60th of the labeled dose volume (0.01 mL). For a 5.0 mg pen, 30 clicks equals 2.5 mg, and 12 clicks equals 1.0 mg.'
                            )
                        ),
                        array(
                            '@type' => 'Question',
                            'name' => 'Why use a 5-day GLP-1 dosing interval instead of a 7-day schedule?',
                            'acceptedAnswer' => array(
                                '@type' => 'Answer',
                                'text' => 'Tirzepatide has an approximate pharmacokinetic elimination half-life of 5.0 days (120 hours). A 5-day micro-dosing schedule reduces plasma trough concentration drops on days 6 and 7, helping prevent breakthrough hunger spikes and minimizing peak-associated GI side effects.'
                            )
                        )
                    )
                )
            )
        );

        echo "\n<!-- Keystone 2026 WebApplication & FAQPage JSON-LD Schema -->\n";
        echo "<script type=\"application/ld+json\">\n";
        echo wp_json_encode( $calc_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
        echo "</script>\n<!-- End Calculator Schema -->\n\n";
    }
}

/**
 * 15. Inject Localized GeoCoordinates / Place Schema for City Landing Pages
 * Provides high-trust local entity signals for New York, Los Angeles, and London.
 */
add_action( 'wp_head', 'keystone_inject_city_landing_pages_geo_schema', 16 );
function keystone_inject_city_landing_pages_geo_schema() {
    if ( ! is_page() && ! is_singular() ) {
        return;
    }

    global $post;
    $slug = isset( $post->post_name ) ? $post->post_name : '';
    $uri  = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';

    $city_configs = array(
        'newyork' => array(
            'slugs'       => array( 'newyork-longevity-coaching', 'new-york-quiet-luxury-longevity-coaching-peptide-protocols' ),
            'name'        => 'Keystone Recomposition — New York Executive Longevity Hub',
            'description' => 'Elite GLP-1 micro-dosing, cellular longevity, and biohacking protocols tailored for Manhattan executives and Wall Street leaders.',
            'url'         => home_url( '/newyork-longevity-coaching/' ),
            'locality'    => 'New York',
            'region'      => 'NY',
            'country'     => 'US',
            'latitude'    => 40.7128,
            'longitude'   => -74.0060,
        ),
        'losangeles' => array(
            'slugs'       => array( 'la-longevity-coaching', 'los-angeles-quiet-luxury-longevity-coaching-peptide-protocols' ),
            'name'        => 'Keystone Recomposition — Los Angeles Executive Longevity Hub',
            'description' => 'Body recomposition science, hormone optimization, and discrete concierge coaching for California entertainment and tech founders.',
            'url'         => home_url( '/la-longevity-coaching/' ),
            'locality'    => 'Los Angeles',
            'region'      => 'CA',
            'country'     => 'US',
            'latitude'    => 34.0522,
            'longitude'   => -118.2437,
        ),
        'london' => array(
            'slugs'       => array( 'london-longevity-coaching', 'london-quiet-luxury-longevity-coaching-peptide-protocols' ),
            'name'        => 'Keystone Recomposition — London Mayfair & Chelsea Longevity Hub',
            'description' => 'Precision metabolic architectures, peptide science, and private health infrastructure consulting for London\'s executive circle.',
            'url'         => home_url( '/london-longevity-coaching/' ),
            'locality'    => 'London',
            'region'      => 'Greater London',
            'country'     => 'GB',
            'latitude'    => 51.5074,
            'longitude'   => -0.1278,
        ),
    );

    foreach ( $city_configs as $city_key => $config ) {
        $matched = false;
        foreach ( $config['slugs'] as $s ) {
            if ( $slug === $s || false !== strpos( $uri, '/' . $s ) ) {
                $matched = true;
                break;
            }
        }

        if ( $matched ) {
            $place_schema = array(
                '@context' => 'https://schema.org',
                '@graph'   => array(
                    array(
                        '@type'       => array( 'Place', 'HealthAndBeautyBusiness' ),
                        '@id'         => $config['url'] . '#place',
                        'name'        => $config['name'],
                        'description' => $config['description'],
                        'url'         => $config['url'],
                        'address'     => array(
                            '@type'           => 'PostalAddress',
                            'addressLocality' => $config['locality'],
                            'addressRegion'   => $config['region'],
                            'addressCountry'  => $config['country'],
                        ),
                        'geo'         => array(
                            '@type'     => 'GeoCoordinates',
                            'latitude'  => $config['latitude'],
                            'longitude' => $config['longitude'],
                        ),
                        'parentOrganization' => array(
                            '@id' => 'https://keystonerecomposition.com/#organization',
                        ),
                        'founder' => array(
                            '@id' => 'https://keystonerecomposition.com/#person',
                        ),
                    ),
                ),
            );

            echo "\n<!-- Keystone Localized City Hub Geo JSON-LD Schema -->\n";
            echo "<script type=\"application/ld+json\">\n";
            echo wp_json_encode( $place_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
            echo "</script>\n<!-- End Localized City Hub Schema -->\n\n";
            break;
        }
    }
}

