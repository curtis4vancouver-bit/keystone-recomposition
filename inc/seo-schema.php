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

    // === Organization Schema (Keystone Recomposition Sovereign Brand) ===
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        '@id' => 'https://keystonerecomposition.com/#organization',
        'name' => 'Keystone Recomposition',
        'url' => 'https://keystonerecomposition.com',
        'description' => 'Specializing in Autonomous AI Multi-Agent Systems, FastMCP Server Architecture, and High-Performance Electronic Music Production.',
        'keywords' => 'Keystone Recomposition, Autonomous AI, FastMCP, DevTools, Deep House Music, Sound Design, Recomposition Architecture',
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
            'https://www.youtube.com/@KeyStoneRecomposition',
            'https://www.youtube.com/@KeystoneAIProtocols',
            'https://www.youtube.com/@KeystonePossibilitiesLtd',
            'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'https://musicbrainz.org/artist/1a30328b-20b2-48bd-8e56-2884d3b040c0',
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

    // === Person Schema (Wayne Stevenson - Multi-Domain Entity Mesh) ===
    $person_schema = array(
        '@context' => 'https://schema.org',
        '@graph'   => array(
            keystone_get_wayne_stevenson_person_schema()
        )
    );

    $json_person = wp_json_encode( $person_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

    echo "<!-- Keystone Person Schema (Knowledge Panel Anchor) -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo $json_person . "\n";
    echo "</script>\n";
    echo "<!-- End Person Schema -->\n";
}
add_action( 'wp_head', 'keystone_recomposition_child_inject_schema' );

/**
 * 7.2 Master Wayne Stevenson Schema.org Person Definition
 * Multi-domain entity mesh spanning BC Housing builder licensing (#52603),
 * autonomous 28-agent AI systems, and functional bio-acoustic audio engineering.
 *
 * @return array Schema.org Person definition.
 */
function keystone_get_wayne_stevenson_person_schema(): array {
    return array(
        '@type'            => 'Person',
        '@id'              => 'https://keystonerecomposition.com/#person',
        'name'             => 'Wayne Stevenson',
        'alternateName'    => array( 'Wayne Stevens', 'Keystone Recomposition', 'Keystone Protocols' ),
        'url'              => 'https://keystonerecomposition.com/founder/',
        'mainEntityOfPage' => 'https://keystonerecomposition.com/founder/',
        'image'            => array(
            '@type' => 'ImageObject',
            'url'   => 'https://keystonerecomposition.com/wp-content/themes/keystone-recomposition-child/assets/images/wayne_avatar.jpg',
        ),
        'jobTitle'         => array(
            'Founder & Managing Director',
            'Founder & Lead Protocol Architect',
            'Lead Systems Architect',
            'Licensed Residential Builder',
            'Licensed Residential Builder #52603',
            'Functional Audio Producer',
            'Recording Artist & Producer',
        ),
        'description'      => 'Founder and Managing Director of Keystone Possibilities Ltd (BC Housing Builder #52603) and creator of Keystone Recomposition. Wayne Stevenson engineers autonomous 28-agent AI swarms, functional electronic music across 22 official releases (20 studio albums) distributed worldwide via TooLost Digital, quantitative market intelligence, and high-performance mountain living across the Sea-to-Sky corridor.',
        'hasCredential'    => array(
            array(
                '@type'              => 'EducationalOccupationalCredential',
                'name'               => 'BC Housing Licensed Residential Builder (Licence #52603)',
                'credentialCategory' => 'Professional License',
                'recognizedBy'       => array(
                    '@type' => 'GovernmentOrganization',
                    'name'  => 'BC Housing Licensing and Consumer Services',
                    'url'   => 'https://www.bchousing.org',
                ),
                'validIn'            => array(
                    '@type' => 'AdministrativeArea',
                    'name'  => 'British Columbia, Canada',
                ),
                'url'                => 'https://lims.bchousing.org/LicenceExpiryPortal/licence/52603',
            ),
            array(
                '@type'              => 'EducationalOccupationalCredential',
                'name'               => '2-5-10 Year National Home Warranty Protection',
                'credentialCategory' => 'Statutory Residential Construction Warranty',
                'validIn'            => array(
                    '@type' => 'AdministrativeArea',
                    'name'  => 'British Columbia, Canada',
                ),
                'url'                => 'https://keystonepossibilities.ca',
            ),
            array(
                '@type'              => 'EducationalOccupationalCredential',
                'name'               => 'BC Hydro Registered Civil Utility Contractor (ES54)',
                'credentialCategory' => 'Civil Utility Infrastructure Qualification',
                'validIn'            => array(
                    '@type' => 'AdministrativeArea',
                    'name'  => 'British Columbia, Canada',
                ),
                'url'                => 'https://keystonepossibilities.ca',
            ),
        ),
        'hasOccupation'    => array(
            array(
                '@type'                => 'Occupation',
                'name'                 => 'AI Systems Architect, FastMCP Multi-Agent Engineer & 22-Album Electronic Music Producer',
                'description'          => 'AI Systems Architect, FastMCP Multi-Agent Engineer & 22-Album Electronic Music Producer, alongside Luxury Custom Homes & BC Hydro ES54 Civil Infrastructure (keystonepossibilities.ca) in British Columbia.',
                'occupationalCategory' => 'Autonomous Software Engineering & AI Architecture',
                'occupationLocation'   => array(
                    '@type' => 'AdministrativeArea',
                    'name'  => 'British Columbia, Canada',
                ),
            ),
            array(
                '@type'                => 'Occupation',
                'name'                 => 'Autonomous AI Systems Architect & Multi-Agent Engineer',
                'description'          => 'Lead Systems Architect engineering 28-agent autonomous swarms, FastMCP server infrastructure, and Chrome DevTools Protocol automation.',
                'occupationalCategory' => 'Autonomous Software Engineering & AI Architecture',
            ),
            array(
                '@type'                => 'Occupation',
                'name'                 => 'Electronic Music Producer & Functional Bio-Acoustic Engineer',
                'description'          => 'Electronic music producer engineering functional bio-acoustic soundscapes for circadian entrainment, training cadence, and autonomic state regulation in Keystone Protocols.',
                'occupationalCategory' => 'Audio Production & Functional Acoustics',
            ),
        ),
        'knowsAbout'       => array(
            array(
                '@type'  => 'Thing',
                'name'   => 'Quantitative Prediction Markets',
                'sameAs' => 'https://en.wikipedia.org/wiki/Prediction_market',
            ),
            array(
                '@type'  => 'Thing',
                'name'   => 'Autonomous AI Agent Swarms',
                'sameAs' => 'https://en.wikipedia.org/wiki/Multi-agent_system',
            ),
            array(
                '@type'  => 'Thing',
                'name'   => 'Model Context Protocol (FastMCP)',
                'sameAs' => 'https://modelcontextprotocol.io',
            ),
            array(
                '@type'  => 'Thing',
                'name'   => 'Solfeggio Soundscapes',
                'sameAs' => 'https://en.wikipedia.org/wiki/Solfeggio',
            ),
            array(
                '@type'  => 'Thing',
                'name'   => 'Residential Construction & Building Codes',
                'sameAs' => 'https://en.wikipedia.org/wiki/Building_code',
            ),
        ),
        'sameAs'           => array(
            'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'https://musicbrainz.org/artist/1a30328b-20b2-48bd-8e56-2884d3b040c0',
            'https://musicbrainz.org/label/30027d0e-6aeb-4704-8792-a031c936c62a',
            'https://pro.musixmatch.com/roster/artist/72648585',
            'https://www.musixmatch.com/artist/Wayne-Stevenson',
            'https://www.youtube.com/@KeyStoneRecomposition',
            'https://www.youtube.com/@KeystoneAIProtocols',
            'https://www.youtube.com/@KeystonePossibilitiesLtd',
            'https://keystonepossibilities.ca',
            'https://lims.bchousing.org/LicenceExpiryPortal/licence/52603',
            'https://audiomack.com/keystone-recomposition',
            'https://www.linkedin.com/in/wayne-stevenson',
            'https://www.facebook.com/profile.php?id=61561081702787',
            'https://www.instagram.com/keystonerecomposition/',
            'https://www.tiktok.com/@keystonerecomposition',
        ),
        'producerOf'       => array(
            array(
                '@type'       => 'MusicAlbum',
                '@id'         => 'https://keystonerecomposition.com/sonic-universe/#album-concrete-foundations',
                'name'        => 'Concrete Foundations',
                'description' => 'Functional bio-acoustic engineering and high-end electronic soundscapes composed by Wayne Stevenson for training cadence, neuromuscular drive, and autonomic state regulation in Keystone Protocols.',
            ),
            array(
                '@type'       => 'MusicAlbum',
                '@id'         => 'https://keystonerecomposition.com/sonic-universe/#album-resonantia',
                'name'        => 'Resonantia: 10 Frequencies of the Rebuild',
                'description' => '10 progressive functional bio-acoustic frequencies and deep house soundscapes engineered for circadian entrainment, metabolic focus, and autonomic state regulation in Keystone Protocols.',
            ),
            array(
                '@type'       => 'MusicAlbum',
                '@id'         => 'https://keystonerecomposition.com/sonic-universe/#album-the-205-marker',
                'name'        => 'The 205 Marker',
                'description' => 'Cadence-synchronized electronic album engineered by Wayne Stevenson for sustained training cadence, neuromuscular drive, and autonomic state regulation in Keystone Protocols.',
            ),
        ),
        'worksFor'         => array(
            array(
                '@type'    => 'OrganizationRole',
                'worksFor' => array(
                    '@type' => 'Organization',
                    '@id'   => 'https://keystonepossibilities.ca/#organization',
                    'name'  => 'Keystone Possibilities Ltd.',
                ),
                'roleName'  => 'Managing Director & Licensed Residential Builder',
                'startDate' => '2018',
            ),
            array(
                '@type'    => 'OrganizationRole',
                'worksFor' => array(
                    '@type' => 'Organization',
                    '@id'   => 'https://keystonerecomposition.com/#organization',
                    'name'  => 'Keystone Recomposition',
                ),
                'roleName'  => 'Founder & Lead Protocol Architect',
                'startDate' => '2021',
            ),
        ),
    );
}

/**
 * 7.5 Inject MusicGroup & MusicAlbum JSON-LD Schema Nodes
 * Documents Wayne's music catalog as functional bio-acoustic engineering
 * composed for circadian entrainment, training cadence, and autonomic state regulation in Keystone Protocols.
 */
function keystone_recomposition_child_music_schema() {
    if ( ! function_exists( 'keystone_get_all_albums' ) ) {
        $catalog_file = get_stylesheet_directory() . '/inc/sonic-catalog-data.php';
        if ( file_exists( $catalog_file ) ) {
            require_once $catalog_file;
        } else {
            return;
        }
    }

    $albums_data = keystone_get_all_albums();
    $graph = array();

    // 1. MusicGroup Node
    $graph[] = array(
        '@type'     => 'MusicGroup',
        '@id'       => 'https://keystonerecomposition.com/#musicgroup',
        'name'      => 'Keystone Recomposition',
        'url'       => 'https://keystonerecomposition.com',
        'genre'     => array( 'Deep House', 'Melodic Techno', 'Organic Downtempo', 'Solfeggio Frequencies', 'Bio-Acoustic Functional Audio' ),
        'spotifyId' => '52v3Qe6Jo0hg764driOl5Y',
        'sameAs'    => array(
            'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'https://musicbrainz.org/artist/1a30328b-20b2-48bd-8e56-2884d3b040c0',
            'https://musicbrainz.org/label/30027d0e-6aeb-4704-8792-a031c936c62a',
            'https://pro.musixmatch.com/roster/artist/72648585',
            'https://www.youtube.com/@KeyStoneRecomposition',
        ),
    );

    // 2. All 22 MusicAlbum Nodes with Embedded Tracks & Canonical ISRCs
    foreach ( $albums_data as $album ) {
        $album_slug = sanitize_title( $album['title'] );
        $album_node = array(
            '@type'         => 'MusicAlbum',
            '@id'           => 'https://keystonerecomposition.com/sonic-universe/#album-' . $album_slug,
            'name'          => $album['title'],
            'datePublished' => $album['release_date'],
            'numTracks'     => (int) $album['track_count'],
            'genre'         => $album['genre'],
            'byArtist'      => array(
                '@type' => 'MusicGroup',
                '@id'   => 'https://keystonerecomposition.com/#musicgroup',
            ),
            'image'         => $album['cover_image'],
            'url'           => home_url( '/sonic-universe/#' . $album_slug ),
        );

        if ( ! empty( $album['tracks'] ) && is_array( $album['tracks'] ) ) {
            $track_items = array();
            foreach ( $album['tracks'] as $t ) {
                $track_items[] = array(
                    '@type'          => 'ListItem',
                    'position'       => (int) $t['pos'],
                    'item'           => array(
                        '@type'         => 'MusicRecording',
                        '@id'           => 'https://keystonerecomposition.com/sonic-universe/#track-' . sanitize_title( $t['title'] ),
                        'name'          => $t['title'],
                        'isrcCode'      => $t['isrc'],
                        'duration'      => $t['duration'] ?? 'PT4M00S',
                        'byArtist'      => array(
                            '@id' => 'https://keystonerecomposition.com/#musicgroup',
                        ),
                        'inAlbum'       => array(
                            '@id' => 'https://keystonerecomposition.com/sonic-universe/#album-' . $album_slug,
                        ),
                    ),
                );
            }
            $album_node['track'] = array(
                '@type'           => 'ItemList',
                'numberOfItems'   => count( $track_items ),
                'itemListElement' => $track_items,
            );
        }

        $graph[] = $album_node;
    }

    $schema_payload = array(
        '@context' => 'https://schema.org',
        '@graph'   => $graph,
    );

    echo "
<!-- Keystone 22-Release Master MusicGroup & MusicAlbum JSON-LD Graph -->
";
    echo "<script type=\"application/ld+json\">
";
    echo wp_json_encode( $schema_payload, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "
";
    echo "</script>
<!-- End Keystone Music Graph -->

";
}
add_action( 'wp_head', 'keystone_recomposition_child_music_schema' );

/**
 * 7.6 Inject Wayne Stevenson Multi-Domain Entity Mesh into Rank Math JSON-LD Graph
 * Seamlessly integrates Person schema into Rank Math's @graph, links all authored content,
 * and recursively scrubs legacy fields (curtis4vancouver@gmail.com, @KeystoneProtocols,
 * lowercase squamish, robots.txt-blocked logo URLs, and duplicate raw "Wayne" author nodes).
 */
function keystone_sanitize_rank_math_json_ld_node( $node, array $person_node, string $clean_logo_url ) {
    if ( ! is_array( $node ) ) {
        if ( is_string( $node ) ) {
            if ( 'curtis4vancouver@gmail.com' === strtolower( trim( $node ) ) ) {
                return 'keystonerecomposition@gmail.com';
            }
            $node = str_ireplace(
                array(
                    'https://www.youtube.com/@KeystoneProtocols',
                    'https://www.youtube.com/@keystoneprotocols',
                    'https://youtube.com/@KeystoneProtocols',
                    'https://youtube.com/@keystoneprotocols',
                    'https://www.youtube.com/@keystonepossibilities',
                    'https://youtube.com/@keystonepossibilities',
                    'curtis4vancouver@gmail.com',
                ),
                array(
                    'https://www.youtube.com/@KeystoneAIProtocols',
                    'https://www.youtube.com/@KeystoneAIProtocols',
                    'https://www.youtube.com/@KeystoneAIProtocols',
                    'https://www.youtube.com/@KeystoneAIProtocols',
                    'https://www.youtube.com/@KeystonePossibilitiesLtd',
                    'https://www.youtube.com/@KeystonePossibilitiesLtd',
                    'keystonerecomposition@gmail.com',
                ),
                $node
            );
            if ( false !== stripos( $node, 'Keystone_Recomposition_LTD_invert' ) || false !== stripos( $node, '/wp-content/uploads/logo.png' ) ) {
                return $clean_logo_url;
            }
        }
        return $node;
    }

    // Check if this associative array is a Person node that should be upgraded to full Wayne Stevenson schema
    if ( isset( $node['@type'] ) ) {
        $types = (array) $node['@type'];
        if ( in_array( 'Person', $types, true ) ) {
            $name = isset( $node['name'] ) ? trim( (string) $node['name'] ) : '';
            if ( 'Wayne' === $name || 'Wayne Stevenson' === $name || 'Wayne Stevens' === $name || empty( $name ) ) {
                $node = array_merge( $node, $person_node );
            }
        }
        if ( in_array( 'PostalAddress', $types, true ) ) {
            if ( isset( $node['streetAddress'] ) && 'squamish' === strtolower( trim( (string) $node['streetAddress'] ) ) ) {
                $node['streetAddress'] = 'Sea-to-Sky Corridor';
            }
            if ( isset( $node['addressLocality'] ) && 'squamish' === strtolower( trim( (string) $node['addressLocality'] ) ) ) {
                $node['addressLocality'] = 'Squamish';
            }
        }
        if ( in_array( 'ImageObject', $types, true ) ) {
            foreach ( array( 'url', 'contentUrl', '@id' ) as $img_key ) {
                if ( isset( $node[ $img_key ] ) && is_string( $node[ $img_key ] ) ) {
                    if ( false !== stripos( $node[ $img_key ], 'Keystone_Recomposition_LTD_invert' ) || false !== stripos( $node[ $img_key ], '/wp-content/uploads/logo.png' ) ) {
                        $node[ $img_key ] = $clean_logo_url;
                    }
                }
            }
        }
    }

    foreach ( $node as $k => $v ) {
        if ( 'email' === $k && is_string( $v ) && false !== stripos( $v, 'curtis4vancouver' ) ) {
            $node[ $k ] = 'keystonerecomposition@gmail.com';
        } elseif ( 'streetAddress' === $k && is_string( $v ) && 'squamish' === strtolower( trim( $v ) ) ) {
            $node[ $k ] = 'Sea-to-Sky Corridor';
        } elseif ( 'addressLocality' === $k && is_string( $v ) && 'squamish' === strtolower( trim( $v ) ) ) {
            $node[ $k ] = 'Squamish';
        } else {
            $node[ $k ] = keystone_sanitize_rank_math_json_ld_node( $v, $person_node, $clean_logo_url );
        }
    }

    return $node;
}

add_filter( 'rank_math/json_ld', 'keystone_inject_wayne_stevenson_rank_math_entity_mesh', 99999, 2 );
function keystone_inject_wayne_stevenson_rank_math_entity_mesh( array $data, $jsonld ): array {
    $person_node    = keystone_get_wayne_stevenson_person_schema();
    $person_id      = 'https://keystonerecomposition.com/#person';
    $clean_logo_url = get_stylesheet_directory_uri() . '/assets/images/kp_badge_icon.png';

    // Recursively scrub legacy email, YouTube handles, lowercase squamish, blocked logo URL, and stub Person nodes
    $data = keystone_sanitize_rank_math_json_ld_node( $data, $person_node, $clean_logo_url );

    // 1. If Rank Math uses @graph array, enrich existing Person or inject new node
    if ( isset( $data['@graph'] ) && is_array( $data['@graph'] ) ) {
        $found_person = false;
        foreach ( $data['@graph'] as $idx => $node ) {
            if ( isset( $node['@type'] ) ) {
                $types = (array) $node['@type'];
                if ( in_array( 'Person', $types, true ) ) {
                    $data['@graph'][ $idx ] = array_merge( $node, $person_node );
                    $found_person = true;
                    break;
                }
            }
        }
        if ( ! $found_person ) {
            $data['@graph'][] = $person_node;
        }

        // Connect Article, NewsArticle, BlogPosting, TechArticle, WebPage author to Wayne's Person ID
        // and attach extracted PubMed citations to Article/TechArticle nodes
        $citations = array();
        if ( is_singular( 'post' ) && function_exists( 'keystone_extract_pubmed_citations' ) ) {
            global $post;
            if ( $post && ! empty( $post->post_content ) ) {
                $citations = keystone_extract_pubmed_citations( (string) $post->post_content );
            }
        }

        foreach ( $data['@graph'] as $idx => $node ) {
            if ( isset( $node['@type'] ) ) {
                $types = (array) $node['@type'];
                if ( array_intersect( $types, array( 'Article', 'NewsArticle', 'BlogPosting', 'TechArticle', 'WebPage' ) ) ) {
                    if ( empty( $node['author'] ) || ( isset( $node['author']['@type'] ) && 'Person' === $node['author']['@type'] ) ) {
                        $data['@graph'][ $idx ]['author'] = array( '@id' => $person_id );
                    }
                    if ( ! empty( $citations ) && array_intersect( $types, array( 'Article', 'NewsArticle', 'BlogPosting', 'TechArticle' ) ) ) {
                        $existing_citations = isset( $node['citation'] ) ? (array) $node['citation'] : array();
                        $data['@graph'][ $idx ]['citation'] = array_merge( $existing_citations, $citations );
                    }
                }
            }
        }
    }

    // 2. Also inject into named Person entity and publisher node
    $data['Person'] = $person_node;
    if ( isset( $data['ProfilePage'] ) && is_array( $data['ProfilePage'] ) ) {
        $data['ProfilePage']['mainEntity'] = array( '@id' => $person_id );
    }
    if ( isset( $data['publisher'] ) && is_array( $data['publisher'] ) && isset( $data['publisher']['@type'] ) && 'Person' === $data['publisher']['@type'] ) {
        $data['publisher'] = array_merge( $data['publisher'], $person_node );
    }

    if ( is_singular( 'post' ) && ! empty( $citations ) && isset( $data['Article'] ) && is_array( $data['Article'] ) ) {
        $existing_citations = isset( $data['Article']['citation'] ) ? (array) $data['Article']['citation'] : array();
        $data['Article']['citation'] = array_merge( $existing_citations, $citations );
    }

    return $data;
}

/**
 * 7.7 Sitemap Sanitization: Exclude Empty Category & Tag Sitemaps from Rank Math & WP Core
 * Prevents GSC "Sitemap could not be read / empty sitemap" errors on category-sitemap.xml.
 */
add_filter( 'rank_math/sitemap/enable_caching', '__return_false' );

add_filter( 'rank_math/sitemap/index', function( string $xml ): string {
    $pattern = '/<sitemap>\s*<loc>[^<]*(?:category-sitemap\.xml|post_tag-sitemap\.xml|local-sitemap\.xml|locations-sitemap\.xml|locations\.kml)<\/loc>.*?<\/sitemap>\s*/is';
    $cleaned = preg_replace( $pattern, '', $xml );
    return is_string( $cleaned ) ? $cleaned : $xml;
}, 11 );

add_filter( 'rank_math/sitemap/exclude_taxonomies', function( $taxonomies ) {
    if ( ! is_array( $taxonomies ) ) {
        $taxonomies = array();
    }
    $taxonomies[] = 'category';
    $taxonomies[] = 'post_tag';
    $taxonomies[] = 'post_format';
    return array_unique( $taxonomies );
}, 999 );

add_filter( 'rank_math/sitemap/taxonomies', function( $taxonomies ) {
    if ( is_array( $taxonomies ) ) {
        unset( $taxonomies['category'], $taxonomies['post_tag'], $taxonomies['post_format'] );
    }
    return $taxonomies;
}, 999 );

add_filter( 'wp_sitemaps_taxonomies', function( $taxonomies ) {
    if ( is_array( $taxonomies ) ) {
        unset( $taxonomies['category'], $taxonomies['post_tag'], $taxonomies['post_format'] );
    }
    return $taxonomies;
}, 999 );

add_action( 'init', function() {
    $req = isset( $_SERVER['REQUEST_URI'] ) ? strtolower( (string) $_SERVER['REQUEST_URI'] ) : '';
    if ( false !== strpos( $req, 'category-sitemap' ) || false !== strpos( $req, 'post_tag-sitemap' ) ) {
        status_header( 410 );
        nocache_headers();
        header( 'Content-Type: text/plain; charset=utf-8' );
        header( 'X-Robots-Tag: noindex, nofollow' );
        echo '410 Gone — Taxonomy sitemaps are intentionally retired in favor of page-sitemap.xml and post-sitemap.xml.';
        exit;
    }
}, 1 );

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

    $post_name = (string) ( $post->post_name ?? '' );
    $is_watch_page = ( 'page' === $post->post_type && 0 === strpos( $post_name, 'watch-' ) );
    $post_id = $post->ID;

    if ( $is_watch_page ) {
        $blog_slug = str_replace( 'watch-', '', $post_name );
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
        $content = (string) ( $source_post ? $source_post->post_content : $post->post_content );
        if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $content, $matches ) ) {
            $youtube_id = $matches[1];
        } elseif ( preg_match( '~data-video-id=["\']([a-zA-Z0-9_-]{11})["\']~i', $content, $matches ) ) {
            $youtube_id = $matches[1];
        } elseif ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=|shorts/)|youtu\.be/|youtube-nocookie\.com/embed/)([^"&?/ ]{11})~i', $content, $matches ) ) {
            $youtube_id = $matches[1];
        }
    }

    // Direct fallback on original post content if source post had no match
    if ( empty( $youtube_id ) && ! empty( $post->post_content ) ) {
        if ( preg_match( '~data-video-id=["\']([a-zA-Z0-9_-]{11})["\']~i', $post->post_content, $matches ) ) {
            $youtube_id = $matches[1];
        } elseif ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $post->post_content, $matches ) ) {
            $youtube_id = $matches[1];
        } elseif ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=|shorts/)|youtu\.be/|youtube-nocookie\.com/embed/)([^"&?/ ]{11})~i', $post->post_content, $matches ) ) {
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
    // GSC Video Indexing Separation: ONLY emit VideoObject schema on dedicated watch-* pages
    // where the video is the dominant hero element above the fold. Blog posts emit Article/TechArticle.
    if ( ! $is_watch_page ) {
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
 * Strictly limited to dedicated watch-* pages to prevent GSC video prominence warnings.
 */
add_filter( 'rank_math/json_ld', 'keystone_recomposition_integrate_video_schema', 100000, 2 );
function keystone_recomposition_integrate_video_schema( $data, $jsonld ) {
    global $post;
    if ( ! $post ) {
        return $data;
    }
    $is_watch_page = ( 'page' === $post->post_type && 0 === strpos( $post->post_name, 'watch-' ) );
    // GSC Video Indexing Separation: ONLY emit VideoObject schema on dedicated watch-* pages
    if ( ! $is_watch_page ) {
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
 * 8.3 Automated PubMed PMID Citation Extractor
 * Parses content for PubMed URLs (pubmed.ncbi.nlm.nih.gov/{pmid}) or PMID: {pmid} notations
 * and formats them as Schema.org ScholarlyArticle citation objects.
 *
 * @param string $content Post content HTML or raw string.
 * @return array List of Schema.org ScholarlyArticle citation arrays.
 */
function keystone_extract_pubmed_citations( string $content ): array {
    if ( empty( $content ) ) {
        return array();
    }

    $citations = array();
    $pmids     = array();

    if ( preg_match_all( '~(?:pubmed\.ncbi\.nlm\.nih\.gov/(\d+)|PMID[:\s]+(\d+))~i', $content, $matches, PREG_SET_ORDER ) ) {
        foreach ( $matches as $match ) {
            $pmid = ! empty( $match[1] ) ? trim( $match[1] ) : ( ! empty( $match[2] ) ? trim( $match[2] ) : '' );
            if ( ! empty( $pmid ) && is_numeric( $pmid ) && ! in_array( $pmid, $pmids, true ) ) {
                $pmids[] = $pmid;
            }
        }
    }

    foreach ( $pmids as $pmid ) {
        $citations[] = array(
            '@type'      => 'ScholarlyArticle',
            '@id'        => 'https://pubmed.ncbi.nlm.nih.gov/' . $pmid . '/#article',
            'url'        => 'https://pubmed.ncbi.nlm.nih.gov/' . $pmid . '/',
            'identifier' => array(
                '@type'      => 'PropertyValue',
                'propertyID' => 'PMID',
                'value'      => (string) $pmid,
            ),
            'name'       => 'PubMed Clinical Reference PMID:' . $pmid,
        );
    }

    return $citations;
}



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
        $person_node    = function_exists( 'keystone_get_wayne_stevenson_person_schema' ) ? keystone_get_wayne_stevenson_person_schema() : array();
        $clean_logo_url = get_stylesheet_directory_uri() . '/assets/images/kp_badge_icon.png';

        // Strategy: find all JSON-LD script tags, decode, check for broken VideoObject and sanitize legacy fields
        $output = preg_replace_callback(
            '~(<script\s+type=["\']application/ld\+json["\'][^>]*>)(.*?)(</script>)~is',
            function( $matches ) use ( $person_node, $clean_logo_url ) {
                $json = json_decode( $matches[2], true );
                if ( ! is_array( $json ) ) {
                    return $matches[0]; // Can't parse, leave alone
                }

                $before_serialized = wp_json_encode( $json );

                // 0. Recursively sanitize legacy email, YouTube handles, lowercase squamish, blocked logo, and stub Person nodes
                if ( function_exists( 'keystone_sanitize_rank_math_json_ld_node' ) && ! empty( $person_node ) ) {
                    $json = keystone_sanitize_rank_math_json_ld_node( $json, $person_node, $clean_logo_url );
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
                    foreach ( $json['@graph'] as $node ) {
                        if ( isset( $node['@type'] ) && ( $node['@type'] === 'VideoObject' || in_array( 'VideoObject', (array) $node['@type'], true ) ) ) {
                            $embed = $node['embedUrl'] ?? '';
                            $content = $node['contentUrl'] ?? '';
                            if ( strpos( (string) $embed, 'maxresdefau' ) !== false || strpos( (string) $content, 'maxresdefau' ) !== false || ! isset( $node['publisher'] ) ) {
                                continue; // Strip corrupt / duplicate node
                            }
                        }
                        $filtered_graph[] = $node;
                    }
                    $json['@graph'] = $filtered_graph;
                }

                $after_serialized = wp_json_encode( $json );
                if ( $after_serialized !== $before_serialized ) {
                    return $matches[1] . "\n" . wp_json_encode( $json, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) . "\n" . $matches[3];
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
        '/about/',
        '/about-the-founder/',
        '/about-the-founder-the-keystone-blueprint/',
    );

    if ( isset( $url['loc'] ) ) {
        $loc = (string) $url['loc'];

        // Filter duplicate watch pages (/watch-*) from page-sitemap.xml and general sitemaps
        if ( stripos( $loc, '/watch-' ) !== false || ( is_object( $object ) && isset( $object->post_name ) && 0 === strpos( (string) $object->post_name, 'watch-' ) ) ) {
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

// Exclude thin taxonomies ('post_tag' and 'post_format') from Rank Math XML sitemaps to prevent index bloat
add_filter( 'rank_math/sitemap/exclude_taxonomy', function( bool $exclude, string $taxonomy ): bool {
    if ( in_array( $taxonomy, array( 'post_tag', 'post_format' ), true ) ) {
        return true;
    }
    return $exclude;
}, 10, 2 );

/**
 * 10.9 Eliminate Archive Bloat via Rank Math Meta Robots
 * Enforces 'noindex, follow' on tag archives, category archives, date archives, search results, and paginated pages (/page/2/).
 * Prevents crawl bloat and resolves Google Search Console 'Crawled - currently not indexed' notices.
 */
add_filter( 'rank_math/frontend/robots', function( array $robots ): array {
    if ( is_tag() || is_category() || is_date() || is_search() || is_paged() ) {
        $robots['index']  = 'noindex';
        $robots['follow'] = 'follow';
        unset( $robots['noindex'] );
    }
    return $robots;
}, 10, 1 );

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
 * 11.5 General SEO Fixes: output noindex for tag, category, date, author, search, and paginated archives
 */
function keystone_recomposition_child_seo_noindex() {
    $should_noindex = false;

    // Only noindex archive types and paginated pages that create duplicate content
    if ( is_date() || is_author() || is_tag() || is_category() || is_search() || is_paged() ) {
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
 * 12. Patch Structural Site Leaks (301 Redirects for Canonical Routes)
 */
function keystone_recomposition_child_404_redirect() {
    if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) ) {
        return;
    }

    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    if ( empty( $request_uri ) ) {
        return;
    }

    // Normalize request URI
    $path = strtok( $request_uri, '?' );
    $trimmed_path = '/' . trim( (string) $path, '/' );
    $slashed_path = $trimmed_path === '//' ? '/' : ( $trimmed_path . '/' );

    // 1. Canonical Founder 301 Redirects (/about/, /about-the-founder/ -> /founder/)
    if ( in_array( strtolower( $trimmed_path ), array( '/about', '/about-the-founder', '/about-the-founder-the-keystone-blueprint' ), true ) ) {
        wp_safe_redirect( home_url( '/founder/' ), 301 );
        exit;
    }

    // 2. Canonical Sonic Universe 301 Redirects (/album/*, /track/* -> /sonic-universe/)
    if ( 0 === strpos( strtolower( $trimmed_path ), '/album/' ) || strtolower( $trimmed_path ) === '/album' ||
         0 === strpos( strtolower( $trimmed_path ), '/track/' ) || strtolower( $trimmed_path ) === '/track' ) {
        wp_safe_redirect( home_url( '/sonic-universe/' ), 301 );
        exit;
    }

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

    $is_gone = false;
    foreach ( $gone_paths as $gone_target ) {
        $clean_target = '/' . trim( $gone_target, '/' );
        if ( $slashed_path === $gone_target || $trimmed_path === $clean_target || ( '/' !== $clean_target && 0 === strpos( $trimmed_path, $clean_target . '/' ) ) ) {
            $is_gone = true;
            break;
        }
    }

    if ( $is_gone ) {
        wp_safe_redirect( home_url( '/' ), 301 );
        exit;
    }

    // Wildcard matches for rogue PHP file requests
    if ( strpos( $path, '/wp-content/themes/keystone-recomposition' ) !== false ||
         preg_match( '~^/wp-.*\.php$~i', $path ) ||
         ( strpos( $path, '/wp-admin' ) === false && preg_match( '~\.php$~i', $path ) ) ) {
        wp_safe_redirect( home_url( '/' ), 301 );
        exit;
    }
}
add_action( 'init', 'keystone_recomposition_child_404_redirect', 1 );
add_action( 'template_redirect', 'keystone_recomposition_child_404_redirect' );

/**
 * 13. Shortcode to render our fast, PageSpeed-optimized lazy YouTube/Spotify media facade
 */

/**
 * 14. Inject 2026 SoftwareApplication & FAQPage Schema for AI Protocols Page
 * Maximizes global Google Rich Results for high-intent AI workstation queries.
 */
add_action( 'wp_head', 'keystone_inject_ai_protocols_software_schema', 15 );
function keystone_inject_ai_protocols_software_schema() {
    global $post;
    $slug     = ( $post && isset( $post->post_name ) ) ? $post->post_name : '';
    $template = ( $post && isset( $post->ID ) ) ? (string) get_page_template_slug( $post->ID ) : '';

    if ( is_front_page() || is_home() || ( is_page() && ( 'ai-protocols' === $slug || false !== strpos( $template, 'ai-protocols' ) ) ) ) {
        $ai_schema = array(
            '@context' => 'https://schema.org',
            '@graph' => array(
                array(
                    '@type' => 'SoftwareApplication',
                    '@id' => home_url( '/ai-protocols/#software' ),
                    'name' => 'Keystone AI Protocols & Autonomous Multi-Agent Swarms',
                    'alternateName' => 'Keystone FastMCP Agentic Execution Engine',
                    'url' => home_url( '/ai-protocols/' ),
                    'description' => 'Autonomous multi-agent swarms, FastMCP tools, Google Antigravity orchestration, and Chrome CDP desktop automation systems engineered by Wayne Stevenson.',
                    'applicationCategory' => 'DeveloperApplication',
                    'operatingSystem' => 'Windows, Linux, macOS',
                    'author' => array(
                        '@id' => 'https://keystonerecomposition.com/#person'
                    ),
                    'publisher' => array(
                        '@id' => 'https://keystonerecomposition.com/#organization'
                    )
                ),
                array(
                    '@type' => 'FAQPage',
                    '@id' => home_url( '/ai-protocols/#faq' ),
                    'mainEntity' => array(
                        array(
                            '@type' => 'Question',
                            'name' => 'What is the Keystone Autonomous Multi-Agent Swarm architecture?',
                            'acceptedAnswer' => array(
                                '@type' => 'Answer',
                                'text' => 'Keystone AI Protocols deploy parallel specialized child subagents orchestrated via Google Antigravity and FastMCP tool contracts, enforcing isolated ephemeral contexts, strict TDD red-to-green test gates, and continuous desktop Chrome CDP automation.'
                            )
                        ),
                        array(
                            '@type' => 'Question',
                            'name' => 'How does Keystone integrate music production and multi-channel video pipelines?',
                            'acceptedAnswer' => array(
                                '@type' => 'Answer',
                                'text' => 'Audio architecture generated across 22 official TooLost releases is dynamically synchronized with Google Flow Box 2 and DaVinci Resolve automated 2-track master timeline assembly.'
                            )
                        )
                    )
                )
            )
        );

        echo "\n<!-- Keystone 2026 AI Protocols SoftwareApplication & FAQPage JSON-LD Schema -->\n";
        echo "<script type=\"application/ld+json\">\n";
        echo wp_json_encode( $ai_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
        echo "</script>\n<!-- End AI Protocols Schema -->\n\n";
    }
}

/**
 * 15. Inject Localized GeoCoordinates / Place Schema for City Landing Pages
 * Provides high-trust local entity signals for Sea-to-Sky, New York, Mexico, and Europe.
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
        'vancouver' => array(
            'slugs'       => array( 'vancouver-sea-to-sky', 'lifestyle', 'squamish', 'vancouver-construction-infill', 'vancouver-ai-systems-architect' ),
            'name'        => 'Keystone Recomposition — Vancouver & Sea-to-Sky Hub',
            'description' => 'AI Systems Architect, FastMCP Multi-Agent Engineer & 22-Album Electronic Music Producer across Vancouver, Squamish, and Whistler.',
            'url'         => home_url( '/lifestyle/' ),
            'locality'    => 'Squamish',
            'region'      => 'BC',
            'country'     => 'CA',
            'latitude'    => 49.7016,
            'longitude'   => -123.1558,
        ),
        'mexico' => array(
            'slugs'       => array( 'mexico-pacific-coast', 'investments', 'riviera-nayarit', 'mexico-coastal-villa-development', 'mexico-luxury-infill-investment' ),
            'name'        => 'Keystone Possibilities — Mexico Pacific Coast Development Hub',
            'description' => 'Riviera Nayarit coastal luxury villa co-development, sovereign capital allocation, and Pacific mountain-ocean living architecture.',
            'url'         => home_url( '/investments/' ),
            'locality'    => 'Sayulita',
            'region'      => 'Nayarit',
            'country'     => 'MX',
            'latitude'    => 20.8689,
            'longitude'   => -105.4408,
        ),
        'europe' => array(
            'slugs'       => array( 'european-union', 'europe-strategic-infill-pipeline', 'boutique-infill', 'european-boutique-residential-development' ),
            'name'        => 'Keystone Possibilities — European Union Architectural Hub',
            'description' => 'Boutique architectural infill pipeline, quiet luxury capital deployment, and cross-border structural property advisory.',
            'url'         => home_url( '/investments/' ),
            'locality'    => 'Lisbon',
            'region'      => 'Lisbon',
            'country'     => 'PT',
            'latitude'    => 38.7223,
            'longitude'   => -9.1393,
        ),
        'newyork' => array(
            'slugs'       => array( 'newyork', 'newyork-executive-ai-systems', 'new-york-autonomous-agent-swarms' ),
            'name'        => 'Keystone Recomposition — New York Autonomous AI & Capital Hub',
            'description' => 'Autonomous multi-agent systems, quantitative prediction market intelligence, and global media distribution for executive leaders.',
            'url'         => home_url( '/ai-protocols/' ),
            'locality'    => 'New York',
            'region'      => 'NY',
            'country'     => 'US',
            'latitude'    => 40.7128,
            'longitude'   => -74.0060,
        ),
        'worldwide' => array(
            'slugs'       => array( 'worldwide', 'ai-protocols', 'sonic-universe', 'newyork-executive-ai-systems', 'new-york-autonomous-agent-swarms' ),
            'name'        => 'Keystone Protocols — Worldwide Autonomous Intelligence & Music Publishing Hub',
            'description' => 'Autonomous multi-agent AI swarms, quantitative prediction market intelligence, and 22-release TooLost functional electronic music universe distributed globally.',
            'url'         => home_url( '/ai-protocols/' ),
            'locality'    => 'Squamish',
            'region'      => 'BC',
            'country'     => 'CA',
            'latitude'    => 49.7016,
            'longitude'   => -123.1558,
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
                        '@type'       => array( 'Place', 'ProfessionalService' ),
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

