<?php
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
        'sameAs' => array(
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
            '@id' => 'https://www.keystonepossibilities.com/wayne-stevenson/#person'
        )
    );

    $json_schema = wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

    echo "<!-- Keystone Digital JSON-LD Schema -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo $json_schema . "\n";
    echo "</script>\n";
    echo "<!-- End Keystone Digital JSON-LD Schema -->\n";

    // === Person Schema (Wayne Stevenson - Knowledge Panel Anchor) ===
    $person_schema = array(
        '@context' => 'https://schema.org',
        '@graph' => array(
            array(
                '@type' => 'Person',
                '@id' => 'https://www.keystonepossibilities.com/wayne-stevenson/#person',
                'name' => 'Wayne Stevenson',
                'alternateName' => array( 'Keystone Recomposition', 'Keystone Protocols' ),
                'url' => 'https://keystonerecomposition.com/about/',
                'image' => array(
                    '@type' => 'ImageObject',
                    'url' => $logo_url
                ),
                'jobTitle' => 'Founder & Managing Director',
                'description' => 'Founder of Keystone Recomposition. Documents the intersection of GLP-1 metabolic health, peptide science, body recomposition, and longevity for men over 40. Also produces deep house music protocols.',
                'knowsAbout' => array(
                    array(
                        '@type' => 'Thing',
                        'name' => 'Custom Luxury Home Construction',
                        'sameAs' => 'https://en.wikipedia.org/wiki/General_contractor'
                    ),
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
                            '@id' => 'https://www.keystonepossibilities.com/#organization',
                            'name' => 'Keystone Possibilities Ltd.'
                        ),
                        'roleName' => 'Managing Director & Chief Builder',
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
                ),
                'hasCredential' => array(
                    '@id' => 'https://www.keystonepossibilities.com/wayne-stevenson/#license-52603'
                )
            ),
            array(
                '@type' => 'EducationalOccupationalCredential',
                '@id' => 'https://www.keystonepossibilities.com/wayne-stevenson/#license-52603',
                'name' => 'BC Residential Builder License #52603',
                'credentialCategory' => 'Professional Provincial License',
                'credentialNumber' => '52603',
                'recognizedBy' => array(
                    '@type' => 'GovernmentOrganization',
                    'name' => 'BC Housing Licensing and Consumer Services',
                    'url' => 'https://www.bchousing.org/'
                ),
                'validIn' => array(
                    '@type' => 'AdministrativeArea',
                    'name' => 'British Columbia',
                    'sameAs' => 'https://en.wikipedia.org/wiki/British_Columbia'
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

    $post_id = $post->ID;

    // Try to get video URL or ID from post meta
    $video_url = get_post_meta( $post_id, 'video_url', true );
    $youtube_id = get_post_meta( $post_id, 'keystone_youtube_id', true );
    
    if ( empty( $video_url ) && ! empty( $youtube_id ) ) {
        $video_url = 'https://www.youtube.com/watch?v=' . $youtube_id;
    }

    // Fallback: search for [keystone_video id="..."] or plain youtube URL in content
    if ( empty( $video_url ) ) {
        $content = $post->post_content;
        if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $content, $matches ) ) {
            $youtube_id = $matches[1];
            $video_url = 'https://www.youtube.com/watch?v=' . $youtube_id;
        } elseif ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^\"&?/ ]{11})~i', $content, $matches ) ) {
            $youtube_id = $matches[1];
            $video_url = 'https://www.youtube.com/watch?v=' . $youtube_id;
        }
    }

    if ( empty( $youtube_id ) && ! empty( $video_url ) ) {
        if ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^\"&?/ ]{11})~i', $video_url, $matches ) ) {
            $youtube_id = $matches[1];
        }
    }

    // If no video was detected at all, do not output schema
    if ( empty( $youtube_id ) ) {
        return;
    }

    // Determine high-resolution maxresdefault thumbnail
    $video_thumbnail = "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
    
    // Get custom video details or fall back gracefully
    $video_name = get_post_meta( $post_id, 'video_title', true );
    if ( empty( $video_name ) ) {
        $video_name = get_the_title( $post_id ) . ' Video';
    }

    $video_description = get_post_meta( $post_id, 'video_description', true );
    if ( empty( $video_description ) ) {
        $excerpt_source = get_the_excerpt( $post_id );
        if ( empty( $excerpt_source ) ) {
            $excerpt_source = $post->post_content;
        }
        $clean_excerpt = wp_strip_all_tags( strip_shortcodes( $excerpt_source ) );
        $video_description = wp_html_excerpt( $clean_excerpt, 150, '...' );
    }
    if ( empty( $video_description ) ) {
        $video_description = esc_attr( get_the_title( $post_id ) ) . ' - High-performance health and longevity protocol details.';
    }

    $video_duration = get_post_meta( $post_id, 'video_duration', true );
    if ( empty( $video_duration ) ) {
        $video_duration = get_post_meta( $post_id, 'keystone_video_duration', true );
    }
    $duration_iso = 'PT5M0S'; // Default fallback 5 minutes
    if ( ! empty( $video_duration ) ) {
        // Parse time to ISO 8601
        $video_duration = trim( $video_duration );
        if ( stripos( $video_duration, 'PT' ) === 0 ) {
            $duration_iso = $video_duration;
        } else {
            $hours = 0; $minutes = 0; $seconds = 0;
            if ( is_numeric( $video_duration ) ) {
                $total_seconds = intval( $video_duration );
                $hours = floor( $total_seconds / 3600 );
                $minutes = floor( ( $total_seconds / 60 ) % 60 );
                $seconds = $total_seconds % 60;
            } elseif ( preg_match( '~^(?:(\d+):)?(\d+):(\d+)$~', $video_duration, $matches ) ) {
                if ( count( $matches ) === 4 && $matches[1] !== '' ) {
                    $hours = intval( $matches[1] );
                    $minutes = intval( $matches[2] );
                    $seconds = intval( $matches[3] );
                } else {
                    $minutes = intval( $matches[2] );
                    $seconds = intval( $matches[3] );
                }
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
        $converted_time = strtotime( $video_upload_date );
        $video_upload_date = ( $converted_time !== false ) ? date( 'c', $converted_time ) : get_the_date( 'c', $post_id );
    }

    $video_schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'VideoObject',
        'name' => esc_attr( $video_name ),
        'description' => esc_attr( $video_description ),
        'thumbnailUrl' => esc_url( $video_thumbnail ),
        'uploadDate' => esc_attr( $video_upload_date ),
        'embedUrl' => "https://www.youtube.com/embed/{$youtube_id}",
        'contentUrl' => "https://www.youtube.com/watch?v={$youtube_id}",
        'duration' => esc_attr( $duration_iso ),
        'publisher' => array(
            '@type' => 'Organization',
            'name' => 'Keystone Protocols',
            'logo' => array(
                '@type' => 'ImageObject',
                'url' => 'https://keystonerecomposition.com/wp-content/uploads/logo.png'
            )
        )
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
add_filter( 'rank_math/json_ld', 'keystone_recomposition_integrate_video_schema', 99, 2 );
function keystone_recomposition_integrate_video_schema( $data, $jsonld ) {
    global $post;
    if ( ! $post ) {
        return $data;
    }
    $is_watch_page = ( 'page' === $post->post_type && 0 === strpos( $post->post_name, 'watch-' ) );
    if ( ! is_singular( 'post' ) && ! $is_watch_page ) {
        return $data;
    }
    $post_id = $post->ID;

    // Try to get video ID
    $youtube_id = get_post_meta( $post_id, 'keystone_youtube_id', true );
    if ( empty( $youtube_id ) ) {
        $video_url = get_post_meta( $post_id, 'video_url', true );
        if ( ! empty( $video_url ) && preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^\"&?/ ]{11})~i', $video_url, $matches ) ) {
            $youtube_id = $matches[1];
        }
    }
    if ( empty( $youtube_id ) ) {
        $content = $post->post_content;
        if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $content, $matches ) ) {
            $youtube_id = $matches[1];
        } elseif ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^\"&?/ ]{11})~i', $content, $matches ) ) {
            $youtube_id = $matches[1];
        }
    }

    if ( empty( $youtube_id ) ) {
        return $data;
    }

    // Check if VideoObject already exists in Rank Math output
    foreach ( $data as $val ) {
        if ( isset( $val['@type'] ) && $val['@type'] === 'VideoObject' ) {
            return $data; // Already present, don't duplicate
        }
    }

    // Determine metadata
    $video_name = get_post_meta( $post_id, 'video_title', true );
    if ( empty( $video_name ) ) {
        $video_name = get_the_title( $post_id ) . ' Video';
    }

    $video_description = get_post_meta( $post_id, 'video_description', true );
    if ( empty( $video_description ) ) {
        $excerpt_source = get_the_excerpt( $post_id );
        if ( empty( $excerpt_source ) ) {
            $excerpt_source = $post->post_content;
        }
        $clean_excerpt = wp_strip_all_tags( strip_shortcodes( $excerpt_source ) );
        $video_description = wp_html_excerpt( $clean_excerpt, 150, '...' );
    }
    if ( empty( $video_description ) ) {
        $video_description = esc_attr( get_the_title( $post_id ) ) . ' - High-performance health and longevity protocol details.';
    }

    $video_duration = get_post_meta( $post_id, 'video_duration', true );
    if ( empty( $video_duration ) ) {
        $video_duration = get_post_meta( $post_id, 'keystone_video_duration', true );
    }
    $duration_iso = 'PT5M0S'; // Default fallback
    if ( ! empty( $video_duration ) ) {
        $video_duration = trim( $video_duration );
        if ( stripos( $video_duration, 'PT' ) === 0 ) {
            $duration_iso = $video_duration;
        } else {
            $hours = 0; $minutes = 0; $seconds = 0;
            if ( is_numeric( $video_duration ) ) {
                $total_seconds = intval( $video_duration );
                $hours = floor( $total_seconds / 3600 );
                $minutes = floor( ( $total_seconds / 60 ) % 60 );
                $seconds = $total_seconds % 60;
            } elseif ( preg_match( '~^(?:(\d+):)?(\d+):(\d+)$~', $video_duration, $matches ) ) {
                if ( count( $matches ) === 4 && $matches[1] !== '' ) {
                    $hours = intval( $matches[1] );
                    $minutes = intval( $matches[2] );
                    $seconds = intval( $matches[3] );
                } else {
                    $minutes = intval( $matches[2] );
                    $seconds = intval( $matches[3] );
                }
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
        $converted_time = strtotime( $video_upload_date );
        $video_upload_date = ( $converted_time !== false ) ? date( 'c', $converted_time ) : get_the_date( 'c', $post_id );
    }

    $video_thumbnail = "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";

    $data['richSnippetVideo'] = array(
        '@type' => 'VideoObject',
        'name' => esc_attr( $video_name ),
        'description' => esc_attr( $video_description ),
        'thumbnailUrl' => esc_url( $video_thumbnail ),
        'uploadDate' => esc_attr( $video_upload_date ),
        'embedUrl' => "https://www.youtube.com/embed/{$youtube_id}",
        'contentUrl' => "https://www.youtube.com/watch?v={$youtube_id}",
        'duration' => esc_attr( $duration_iso ),
        'publisher' => array(
            '@type' => 'Organization',
            '@id' => 'https://keystonerecomposition.com/#person'
        )
    );

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
    $youtube_id = get_post_meta( $post_id, 'keystone_youtube_id', true );
    
    // Fallback: search for [keystone_video id="..."] or youtube embed in content
    if ( empty( $youtube_id ) ) {
        $post = get_post( $post_id );
        if ( $post ) {
            if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $post->post_content, $matches ) ) {
                $youtube_id = $matches[1];
            } elseif ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^"&?/ ]{11})~i', $post->post_content, $matches ) ) {
                $youtube_id = $matches[1];
            }
        }
    }
    
    if ( ! empty( $youtube_id ) ) {
        $video['thumbnail_loc'] = "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
        $video['title']         = get_the_title( $post_id );
        
        $excerpt = get_the_excerpt( $post_id );
        if ( empty( $excerpt ) ) {
            $post = get_post( $post_id );
            if ( $post ) {
                $excerpt = wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), 40, '...' );
            }
        }
        $video['description']   = $excerpt;
        $video['player_loc']    = "https://www.youtube-nocookie.com/embed/{$youtube_id}";
        $video['uploader']      = "Wayne Stevenson";
        $video['uploader_info'] = "https://keystonerecomposition.com/";
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
        if ( in_array( strtolower( $key ), array( 'video', 'videoobject' ) ) ) {
            unset( $data[$key] );
        }
        if ( is_array( $val ) && isset( $val['@type'] ) ) {
            $types = (array) $val['@type'];
            foreach ( $types as $t ) {
                if ( strtolower( $t ) === 'videoobject' ) {
                    unset( $data[$key] );
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
                    if ( strtolower( $t ) === 'videoobject' ) {
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
                if ( strtolower( $t ) === 'videoobject' ) {
                    unset( $data[ $key ] );
                    break;
                }
            }
        }
    }
    return $data;
}, 9999, 2 );

// Output buffer safety net: strip broken VideoObject schemas from Rank Math
// Uses a robust approach that handles nested JSON and escaped slashes
add_action( 'wp_head', function() {
    ob_start( function( $output ) {
        // Strategy: find all JSON-LD script tags, decode, check for broken VideoObject, remove
        $output = preg_replace_callback(
            '~(<script\s+type=["\']application/ld\+json["\'][^>]*>)(.*?)(</script>)~is',
            function( $matches ) {
                $json = json_decode( $matches[2], true );
                if ( ! is_array( $json ) ) {
                    return $matches[0]; // Can't parse, leave alone
                }
                // Check if this is a VideoObject
                if ( isset( $json['@type'] ) && $json['@type'] === 'VideoObject' ) {
                    // Kill it if embedUrl contains 'maxresdefau' (broken Rank Math detection)
                    if ( isset( $json['embedUrl'] ) && strpos( $json['embedUrl'], 'maxresdefau' ) !== false ) {
                        return '<!-- Keystone: Removed broken VideoObject with maxresdefau fake ID -->';
                    }
                    // Kill it if it has no publisher field (our custom schema always has publisher)
                    if ( ! isset( $json['publisher'] ) ) {
                        return '<!-- Keystone: Removed duplicate VideoObject without publisher -->';
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
    $youtube_id = get_post_meta( $post->ID, 'keystone_youtube_id', true );

    // Fallback: extract from shortcode in content
    if ( empty( $youtube_id ) ) {
        if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $post->post_content, $m ) ) {
            $youtube_id = $m[1];
        }
    }

    if ( empty( $youtube_id ) ) {
        return;
    }

    // Check if Rank Math already output og:video (don't duplicate)
    // We hook at priority 5 which runs before Rank Math (priority 30+)
    // but Rank Math uses its own filter system, so we use a simple flag approach
    $embed_url = 'https://www.youtube.com/embed/' . esc_attr( $youtube_id );

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
 * 11. General SEO Fixes: output noindex for tag, date, author archives and query parameters
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
 * 12. Patch Structural Site Leaks (404/Redirect Errors)
 */
function keystone_recomposition_child_404_redirect() {
    $request_uri = $_SERVER['REQUEST_URI'];
    
    // Normalize request URI
    $path = strtok( $request_uri, '?' ); // Strip query parameters
    $path = '/' . trim( $path, '/' ) . '/'; // Standardize slashes
    $path = str_replace( '//', '/', $path );

    $redirects = array(
        '/2026/01/23/mounjaro-kwikpen-the-official-click-to-mg-math-bible/' => '/2026/01/13/stop-chasing-skinny-week-14-recomposition-the-269-click-kwikpen-secret/',
        '/2026/05/07/wolverine-stack-bpc-157-tb500-builder-blueprint/' => '/2026/05/07/wolverine-stack-bpc-157-tb-500-builder-blueprint/',
        '/keystone_recomposition_/' => '/',
        '/logo/' => '/',
        '/keystone-recomposition-ltd/' => '/',
        '/keystone_recomposition_ltd_invert-removebg-preview/' => '/',
        '/logout/' => '/',
        '/the-journey/' => '/',
    );

    // Exact matches
    if ( isset( $redirects[ $path ] ) ) {
        wp_redirect( home_url( $redirects[ $path ] ), 301 );
        exit;
    }
    
    // Wildcard matches
    if ( strpos( $path, '/wp-content/themes/keystone-recomposition-child' ) !== false ||
         preg_match( '~^/wp-.*\.php$~i', $path ) ||
         ( strpos( $path, '/wp-admin' ) === false && preg_match( '~\.php$~i', $path ) ) ) {
        wp_redirect( home_url(), 301 );
        exit;
    }

    if ( is_404() ) {
        wp_redirect( home_url(), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'keystone_recomposition_child_404_redirect' );

/**
 * 13. Shortcode to render our fast, PageSpeed-optimized lazy YouTube/Spotify media facade
 */
