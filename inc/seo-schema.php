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
 * 7. Inject Premium Organization, Sister Entity, MusicGroup & Person JSON-LD Schema (Knowledge Panel Anchor)
 */
add_filter( 'rank_math/json_ld/disable_search', '__return_true' );

function keystone_get_founder_profile_page_schema(): array {
    return array(
        '@type'              => 'ProfilePage',
        '@id'                => 'https://keystonerecomposition.com/founder/#webpage',
        'url'                => 'https://keystonerecomposition.com/founder/',
        'name'               => 'Wayne Stevenson — Founder, Licensed BC Builder & Electronic Music Producer',
        'description'        => 'Official entity profile of Wayne Stevenson, Canadian founder of Keystone Possibilities Ltd. (BC Housing Licensed Builder #52603) and Keystone Recomposition.',
        'inLanguage'         => 'en-CA',
        'isPartOf'           => array(
            '@id' => 'https://keystonerecomposition.com/#website',
        ),
        'mainEntity'         => array(
            '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
        ),
        'about'              => array(
            '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
        ),
        'primaryImageOfPage' => array(
            '@id' => 'https://keystonerecomposition.com/#wayne-portrait',
        ),
        'breadcrumb'         => array(
            '@id' => 'https://keystonerecomposition.com/founder/#breadcrumb',
        ),
    );
}

function keystone_recomposition_child_inject_schema() {
    $logo_url = get_stylesheet_directory_uri() . '/assets/images/keystone_real_logo_badge_bold.png';
    $req_path = trim( (string) parse_url( (string) ( $_SERVER['REQUEST_URI'] ?? '' ), PHP_URL_PATH ), '/' );
    $is_sonic_universe = ( ( function_exists( 'is_page' ) && is_page( 'sonic-universe' ) ) || 'sonic-universe' === $req_path );
    $is_founder_page   = ( ( function_exists( 'is_page' ) && is_page( 'founder' ) ) || 'founder' === $req_path );

    $entity_graph = array(
        // 1. Primary Organization (Keystone Recomposition Sovereign Brand)
        array(
            '@type'              => 'Organization',
            '@id'                => 'https://keystonerecomposition.com/#organization',
            'name'               => 'Keystone Recomposition',
            'url'                => 'https://keystonerecomposition.com/',
            'description'        => 'Sovereign autonomous AI systems engineering studio, FastMCP protocol laboratory, and electronic/acoustic music record label founded by Wayne Stevenson in Squamish, British Columbia.',
            'keywords'           => 'Keystone Recomposition, Autonomous AI, FastMCP, DevTools, Deep House Music, Sound Design, Recomposition Architecture',
            'logo'               => array(
                '@type'      => 'ImageObject',
                '@id'        => 'https://keystonerecomposition.com/#logo',
                'url'        => $logo_url,
                'contentUrl' => $logo_url,
                'width'      => 512,
                'height'     => 512,
            ),
            'founder'            => array(
                '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
            ),
            'address'            => array(
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Squamish',
                'addressRegion'   => 'BC',
                'postalCode'      => 'V8B 0B1',
                'addressCountry'  => 'CA',
            ),
            'areaServed'         => array(
                array(
                    '@type' => 'Country',
                    'name'  => 'United States',
                ),
                array(
                    '@type' => 'Country',
                    'name'  => 'United Kingdom',
                ),
                array(
                    '@type' => 'Country',
                    'name'  => 'Canada',
                ),
                array(
                    '@type' => 'Country',
                    'name'  => 'Switzerland',
                ),
                array(
                    '@type' => 'Country',
                    'name'  => 'Mexico',
                ),
                array(
                    '@type'  => 'City',
                    'name'   => 'New York',
                    'sameAs' => 'https://en.wikipedia.org/wiki/New_York_City',
                ),
                array(
                    '@type'  => 'City',
                    'name'   => 'Los Angeles',
                    'sameAs' => 'https://en.wikipedia.org/wiki/Los_Angeles',
                ),
                array(
                    '@type'  => 'City',
                    'name'   => 'London',
                    'sameAs' => 'https://en.wikipedia.org/wiki/London',
                ),
            ),
            'currenciesAccepted' => 'USD, GBP, CAD, EUR',
            'availableLanguage'  => array( 'en-US', 'en-GB', 'en-CA' ),
            'identifier'         => array(
                array(
                    '@type'      => 'PropertyValue',
                    'propertyID' => 'MusicBrainz Label ID',
                    'value'      => '30027d0e-6aeb-4704-8792-a031c936c62a',
                    'url'        => 'https://musicbrainz.org/label/30027d0e-6aeb-4704-8792-a031c936c62a',
                ),
                array(
                    '@type'      => 'PropertyValue',
                    'propertyID' => 'Too Lost Catalog Reference ID',
                    'value'      => 'TOOLOST3000939655',
                ),
            ),
            'sameAs'             => array(
                'https://musicbrainz.org/label/30027d0e-6aeb-4704-8792-a031c936c62a',
                'https://www.youtube.com/@KeyStoneRecomposition',
                'https://www.youtube.com/@KeystoneAIProtocols',
                'https://www.instagram.com/keystonerecomposition/',
                'https://www.tiktok.com/@keystonerecomposition',
            ),
        ),
        // 2. Sister Operating Entity (Keystone Possibilities Ltd. — Linked via Shared Founder)
        array(
            '@type'     => array( 'Organization', 'HomeAndConstructionBusiness' ),
            '@id'       => 'https://keystonepossibilities.ca/#organization',
            'name'      => 'Keystone Possibilities Ltd.',
            'legalName' => 'Keystone Possibilities Ltd.',
            'url'       => 'https://keystonepossibilities.ca/',
            'founder'   => array(
                '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
            ),
            'sameAs'    => array(
                'https://www.youtube.com/@KeystonePossibilitiesLtd',
                'https://www.instagram.com/keystonepossibilities',
            ),
        ),
    );

    // 3. Emit lightweight MusicGroup anchor site-wide (on /sonic-universe/, keystone_recomposition_child_music_schema emits it inside CollectionPage @graph)
    if ( ! $is_sonic_universe && function_exists( 'keystone_get_music_group_schema' ) ) {
        $entity_graph[] = keystone_get_music_group_schema();
    }

    // 3B. Always emit canonical ProfilePage on /founder/ when Rank Math is inactive (and upgrade Rank Math's richSnippet node when active)
    if ( $is_founder_page && class_exists( 'RankMath' ) ) {
        $entity_graph[] = keystone_get_founder_profile_page_schema();
    }

    // 4. Emit Person, WebSite & ProfilePage directly when Rank Math is inactive (Rank Math @graph handles them when active)
    if ( ! class_exists( 'RankMath' ) ) {
        if ( $is_founder_page ) {
            $entity_graph[] = keystone_get_founder_profile_page_schema();
            $entity_graph[] = array(
                '@type'           => 'BreadcrumbList',
                '@id'             => 'https://keystonerecomposition.com/founder/#breadcrumb',
                'itemListElement' => array(
                    array(
                        '@type'    => 'ListItem',
                        'position' => 1,
                        'name'     => 'Home',
                        'item'     => 'https://keystonerecomposition.com/',
                    ),
                    array(
                        '@type'    => 'ListItem',
                        'position' => 2,
                        'name'     => 'Wayne Stevenson',
                        'item'     => 'https://keystonerecomposition.com/founder/',
                    ),
                ),
            );
        }
        $entity_graph[] = keystone_get_wayne_stevenson_person_schema();
        $entity_graph[] = array(
            '@type'         => 'WebSite',
            '@id'           => 'https://keystonerecomposition.com/#website',
            'url'           => 'https://keystonerecomposition.com/',
            'name'          => 'Keystone Recomposition',
            'alternateName' => 'Keystone AI Protocols',
            'publisher'     => array(
                '@id' => 'https://keystonerecomposition.com/#organization',
            ),
            'inLanguage'    => 'en-CA',
        );
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@graph'   => $entity_graph,
    );

    $json_schema = wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

    echo "<!-- Keystone Digital JSON-LD Schema -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo $json_schema . "\n";
    echo "</script>\n";
    echo "<!-- End Keystone Digital JSON-LD Schema -->\n";
}
add_action( 'wp_head', 'keystone_recomposition_child_inject_schema' );

/**
 * 7.2 Master Wayne Stevenson Schema.org Person Definition
 * Multi-domain entity mesh spanning BC Housing builder licensing (#52603),
 * autonomous multi-agent AI systems, and functional bio-acoustic audio engineering.
 *
 * @return array Schema.org Person definition.
 */
function keystone_get_wayne_stevenson_person_schema(): array {
    return array(
        '@type'                     => 'Person',
        '@id'                       => 'https://keystonerecomposition.com/#wayne-stevenson',
        'name'                      => 'Wayne Stevenson',
        'givenName'                 => 'Wayne',
        'familyName'                => 'Stevenson',
        'birthDate'                 => '1983-03-26',
        'gender'                    => 'Male',
        'nationality'               => array(
            '@type' => 'Country',
            'name'  => 'Canada',
        ),
        'url'                       => 'https://keystonerecomposition.com/founder/',
        'mainEntityOfPage'          => array(
            '@id' => 'https://keystonerecomposition.com/founder/#webpage',
        ),
        'image'                     => array(
            '@type'      => 'ImageObject',
            '@id'        => 'https://keystonerecomposition.com/#wayne-portrait',
            'url'        => 'https://keystonerecomposition.com/wp-content/uploads/2026/09/wayne_avatar.jpg',
            'contentUrl' => 'https://keystonerecomposition.com/wp-content/uploads/2026/09/wayne_avatar.jpg',
            'width'      => 1376,
            'height'     => 768,
            'caption'    => 'Wayne Stevenson — Founder of Keystone Recomposition and Keystone Possibilities Ltd.',
        ),
        'description'               => 'Wayne Stevenson is a Canadian entrepreneur, BC Housing Licensed Residential Builder (#52603), autonomous AI systems architect, and electronic/country-soul music composer and record producer based in Squamish, British Columbia. He is the founder of Keystone Possibilities Ltd. and Keystone Recomposition.',
        'disambiguatingDescription' => 'Canadian entrepreneur, BC Housing Licensed Residential Builder (#52603), autonomous AI systems architect, and electronic/country-soul record producer based in Squamish, British Columbia — founder of Keystone Possibilities Ltd. and Keystone Recomposition (distinct from 1949 American singer Wayne Stevenson and economist Dr. Wayne Stevenson).',
        'jobTitle'                  => array(
            'Founder & Managing Director',
            'Electronic Music Producer & Composer',
            'Autonomous AI Systems Architect',
        ),
        'homeLocation'              => array(
            '@type'   => 'Place',
            'name'    => 'Squamish, British Columbia, Canada',
            'address' => array(
                '@type'           => 'PostalAddress',
                'addressLocality' => 'Squamish',
                'addressRegion'   => 'BC',
                'addressCountry'  => 'CA',
            ),
        ),
        'worksFor'                  => array(
            array(
                '@id' => 'https://keystonerecomposition.com/#organization',
            ),
            array(
                '@id' => 'https://keystonepossibilities.ca/#organization',
            ),
        ),
        'affiliation'               => array(
            array(
                '@id' => 'https://keystonerecomposition.com/#musicgroup',
            ),
            array(
                '@id' => 'https://keystonepossibilities.ca/#organization',
            ),
        ),
        'hasOccupation'             => array(
            array(
                '@type'                => 'Occupation',
                'name'                 => 'Founder & Licensed Residential Builder',
                'description'          => 'Licensed Residential Builder & Fiduciary Construction Consultant directing custom estates, multiplexes, and civil utility infrastructure in British Columbia.',
                'occupationalCategory' => '11-9021.00',
                'occupationLocation'   => array(
                    '@type' => 'AdministrativeArea',
                    'name'  => 'British Columbia, Canada',
                ),
            ),
            array(
                '@type'                => 'Occupation',
                'name'                 => 'Electronic Music Producer & Functional Bio-Acoustic Engineer',
                'description'          => 'Record producer and composer engineering electronic, outlaw country-trap, soul, and bio-acoustic soundscapes for circadian entrainment, training cadence, and autonomic state regulation.',
                'occupationalCategory' => '27-2041.00',
                'occupationLocation'   => array(
                    '@type' => 'Country',
                    'name'  => 'Canada',
                ),
            ),
            array(
                '@type'                => 'Occupation',
                'name'                 => 'Autonomous AI Systems Architect',
                'description'          => 'Principal AI architect engineering autonomous multi-agent FastMCP swarms, Tauri v2 desktop command centers, and Chrome DevTools Protocol automation.',
                'occupationalCategory' => '15-1299.08',
                'occupationLocation'   => array(
                    '@type' => 'Country',
                    'name'  => 'Canada',
                ),
            ),
        ),
        'hasCredential'             => array(
            array(
                '@type'              => 'EducationalOccupationalCredential',
                'name'               => 'BC Housing Licensed Residential Builder (Licence #52603)',
                'identifier'         => '52603',
                'credentialCategory' => 'Professional License',
                'recognizedBy'       => array(
                    '@type' => 'GovernmentOrganization',
                    'name'  => 'BC Housing Licensing and Consumer Services',
                    'url'   => 'https://www.bchousing.org/licensing-consumer-disclosure/licencee-search',
                ),
                'validIn'            => array(
                    '@type' => 'AdministrativeArea',
                    'name'  => 'British Columbia, Canada',
                ),
                'url'                => 'https://www.bchousing.org/licensing-consumer-disclosure/licencee-search',
            ),
            array(
                '@type'              => 'EducationalOccupationalCredential',
                'name'               => 'BC Hydro Registered Civil Utility Contractor (ES54)',
                'identifier'         => 'ES54',
                'credentialCategory' => 'Civil Utility Infrastructure Qualification',
                'validIn'            => array(
                    '@type' => 'AdministrativeArea',
                    'name'  => 'British Columbia, Canada',
                ),
                'url'                => 'https://keystonepossibilities.ca/',
            ),
            array(
                '@type'              => 'EducationalOccupationalCredential',
                'name'               => '2-5-10 Year National Home Warranty Protection',
                'credentialCategory' => 'Statutory Residential Construction Warranty',
                'validIn'            => array(
                    '@type' => 'AdministrativeArea',
                    'name'  => 'British Columbia, Canada',
                ),
                'url'                => 'https://keystonepossibilities.ca/',
            ),
        ),
        'knowsAbout'                => array(
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
                'name'   => 'Electronic Music Production',
                'sameAs' => 'https://en.wikipedia.org/wiki/Record_producer',
            ),
            array(
                '@type'  => 'Thing',
                'name'   => 'Solfeggio Soundscapes',
                'sameAs' => 'https://en.wikipedia.org/wiki/Solfeggio',
            ),
            array(
                '@type'  => 'Thing',
                'name'   => 'Quantitative Prediction Markets',
                'sameAs' => 'https://en.wikipedia.org/wiki/Prediction_market',
            ),
            array(
                '@type'  => 'Thing',
                'name'   => 'Residential Construction & Building Codes',
                'sameAs' => 'https://en.wikipedia.org/wiki/Building_code',
            ),
        ),
        'identifier'                => array(
            array(
                '@type'      => 'PropertyValue',
                'propertyID' => 'MusicBrainz Artist ID',
                'value'      => '1a30328b-20b2-48bd-8e56-2884d3b040c0',
                'url'        => 'https://musicbrainz.org/artist/1a30328b-20b2-48bd-8e56-2884d3b040c0',
            ),
        ),
        'sameAs'                    => array(
            'https://musicbrainz.org/artist/1a30328b-20b2-48bd-8e56-2884d3b040c0',
            'https://keystonepossibilities.ca/about-us-general-contractor-squamish/',
            'https://pro.musixmatch.com/roster/artist/72648585',
        ),
    );
}

/**
 * 7.4 Canonical MusicGroup Definition (#musicgroup)
 */
function keystone_get_music_group_schema(): array {
    return array(
        '@type'       => 'MusicGroup',
        '@id'         => 'https://keystonerecomposition.com/#musicgroup',
        'name'        => 'Keystone Recomposition',
        'url'         => 'https://keystonerecomposition.com/sonic-universe/',
        'description' => 'Electronic, melodic house, modern outlaw country-trap, soul revival, and functional bio-acoustic music project founded and produced by Wayne Stevenson.',
        'founder'     => array(
            '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
        ),
        'member'      => array(
            array(
                '@type'    => 'OrganizationRole',
                'member'   => array(
                    '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
                ),
                'roleName' => array(
                    'Founder',
                    'Composer',
                    'Record Producer',
                    'Lyricist',
                ),
            ),
        ),
        'genre'       => array(
            'Modern Outlaw Country-Trap',
            'Soul Revival & R&B',
            'Southern Soul-Blues Rock',
            'Deep House',
            'Melodic House',
            'Organic House',
            'Ambient Electronic',
        ),
        'identifier'  => array(
            array(
                '@type'      => 'PropertyValue',
                'propertyID' => 'Spotify Artist ID',
                'value'      => '52v3Qe6Jo0hg764driOl5Y',
                'url'        => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            ),
            array(
                '@type'      => 'PropertyValue',
                'propertyID' => 'Apple Music Artist ID',
                'value'      => '1862989452',
                'url'        => 'https://music.apple.com/us/artist/keystone-recomposition/1862989452',
            ),
            array(
                '@type'      => 'PropertyValue',
                'propertyID' => 'YouTube Official Artist Channel ID',
                'value'      => 'UCMn1f9DTF_iybKmv5WlTm9Q',
                'url'        => 'https://www.youtube.com/@KeyStoneRecomposition',
            ),
            array(
                '@type'      => 'PropertyValue',
                'propertyID' => 'MusicBrainz Label ID',
                'value'      => '30027d0e-6aeb-4704-8792-a031c936c62a',
                'url'        => 'https://musicbrainz.org/label/30027d0e-6aeb-4704-8792-a031c936c62a',
            ),
        ),
        'sameAs'      => array(
            'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'https://music.apple.com/us/artist/keystone-recomposition/1862989452',
            'https://www.youtube.com/@KeyStoneRecomposition',
            'https://musicbrainz.org/artist/1a30328b-20b2-48bd-8e56-2884d3b040c0',
            'https://audiomack.com/keystone-recomposition',
            'https://pro.musixmatch.com/roster/artist/72648585',
            'https://www.instagram.com/keystonerecomposition/',
            'https://www.tiktok.com/@keystonerecomposition',
        ),
    );
}

/**
 * 7.5 Inject CollectionPage, MusicGroup & MusicAlbum JSON-LD Schema Nodes Strictly on /sonic-universe/
 * Keeps Homepage / <head> fast and lean while providing full ISRC/UPC discography graph on /sonic-universe/.
 */
function keystone_recomposition_child_music_schema() {
    $req_path = trim( (string) parse_url( (string) ( $_SERVER['REQUEST_URI'] ?? '' ), PHP_URL_PATH ), '/' );
    $is_sonic_universe_page = (
        ( function_exists( 'is_page' ) && is_page( 'sonic-universe' ) ) ||
        'sonic-universe' === $req_path
    );
    if ( ! $is_sonic_universe_page ) {
        return;
    }

    if ( ! function_exists( 'keystone_get_all_albums' ) ) {
        $catalog_file = get_stylesheet_directory() . '/inc/sonic-catalog-data.php';
        if ( file_exists( $catalog_file ) ) {
            require_once $catalog_file;
        } else {
            return;
        }
    }

    $albums_data = keystone_get_all_albums();
    $graph       = array();

    // 1. CollectionPage Wrapper for /sonic-universe/
    $graph[] = array(
        '@type'       => 'CollectionPage',
        '@id'         => 'https://keystonerecomposition.com/sonic-universe/#webpage',
        'url'         => 'https://keystonerecomposition.com/sonic-universe/',
        'name'        => 'Keystone Recomposition — Official Sonic Universe Catalog',
        'description' => 'Official discography and canonical ISRC registry of Keystone Recomposition, composed and produced by Wayne Stevenson.',
        'inLanguage'  => 'en-CA',
        'isPartOf'    => array(
            '@id' => 'https://keystonerecomposition.com/#website',
        ),
        'about'       => array(
            '@id' => 'https://keystonerecomposition.com/#musicgroup',
        ),
        'mainEntity'  => array(
            '@id' => 'https://keystonerecomposition.com/#musicgroup',
        ),
    );

    // 2. Canonical MusicGroup Node
    $graph[] = keystone_get_music_group_schema();

    // 3. All MusicAlbum Nodes with Embedded Tracks & Canonical ISRCs
    foreach ( $albums_data as $album ) {
        $album_slug = sanitize_title( (string) $album['title'] );
        $raw_cover  = (string) ( $album['cover_image'] ?? '' );
        $cover_url  = ( '' !== $raw_cover && ! preg_match( '~^https?://~i', $raw_cover ) )
            ? get_stylesheet_directory_uri() . '/assets/images/albums/' . ltrim( $raw_cover, '/' )
            : $raw_cover;

        $upc_digits = preg_replace( '/\D+/', '', (string) ( $album['upc'] ?? '' ) );
        $track_cnt  = (int) ( $album['track_count'] ?? 0 );
        $album_node = array(
            '@type'               => 'MusicAlbum',
            '@id'                 => 'https://keystonerecomposition.com/sonic-universe/#album-' . $album_slug,
            'name'                => $album['title'],
            'datePublished'       => $album['release_date'],
            'albumProductionType' => 'https://schema.org/StudioAlbum',
            'albumReleaseType'    => ( $track_cnt <= 2 ) ? 'https://schema.org/SingleRelease' : 'https://schema.org/AlbumRelease',
            'numTracks'           => $track_cnt,
            'genre'               => $album['genre'],
            'byArtist'            => array(
                '@id' => 'https://keystonerecomposition.com/#musicgroup',
            ),
            'producer'            => array(
                '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
            ),
            'recordLabel'         => array(
                '@id' => 'https://keystonerecomposition.com/#organization',
            ),
            'image'               => $cover_url,
            'url'                 => home_url( '/sonic-universe/#' . $album_slug ),
        );

        if ( '' !== $upc_digits ) {
            $album_node['identifier'] = array(
                '@type'      => 'PropertyValue',
                'propertyID' => 'UPC',
                'value'      => $upc_digits,
            );
            $release_node = array(
                '@type'              => array( 'MusicRelease', 'Product' ),
                '@id'                => 'https://keystonerecomposition.com/sonic-universe/#release-' . $album_slug,
                'name'               => $album['title'],
                'musicReleaseFormat' => 'https://schema.org/DigitalFormat',
                'recordLabel'        => array(
                    '@id' => 'https://keystonerecomposition.com/#organization',
                ),
            );
            if ( 12 === strlen( $upc_digits ) ) {
                $release_node['gtin12'] = $upc_digits;
            } else {
                $release_node['gtin13'] = str_pad( $upc_digits, 13, '0', STR_PAD_LEFT );
            }
            if ( ! empty( $album['mbid'] ) ) {
                $release_node['sameAs'] = 'https://musicbrainz.org/release/' . $album['mbid'];
            }
            $album_node['albumRelease'] = $release_node;
        }

        $album_same_as = array();
        if ( ! empty( $album['spotify_url'] ) && false !== strpos( (string) $album['spotify_url'], 'open.spotify.com/album/' ) ) {
            $album_same_as[] = $album['spotify_url'];
        }
        if ( ! empty( $album['mbid'] ) ) {
            $album_same_as[] = 'https://musicbrainz.org/release/' . $album['mbid'];
        }
        if ( ! empty( $album_same_as ) ) {
            $album_node['sameAs'] = $album_same_as;
        }

        if ( ! empty( $album['tracks'] ) && is_array( $album['tracks'] ) ) {
            $track_items = array();
            foreach ( $album['tracks'] as $t ) {
                $t_slug = sanitize_title( (string) $t['title'] );
                $track_items[] = array(
                    '@type'    => 'ListItem',
                    'position' => (int) $t['pos'],
                    'item'     => array(
                        '@type'       => 'MusicRecording',
                        '@id'         => 'https://keystonerecomposition.com/sonic-universe/#track-' . $t_slug,
                        'name'        => $t['title'],
                        'isrcCode'    => $t['isrc'],
                        'duration'    => $t['duration'] ?? 'PT3M45S',
                        'byArtist'    => array(
                            '@id' => 'https://keystonerecomposition.com/#musicgroup',
                        ),
                        'producer'    => array(
                            '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
                        ),
                        'inAlbum'     => array(
                            '@id' => 'https://keystonerecomposition.com/sonic-universe/#album-' . $album_slug,
                        ),
                        'recordingOf' => array(
                            '@type'    => 'MusicComposition',
                            '@id'      => 'https://keystonerecomposition.com/sonic-universe/#composition-' . $t_slug,
                            'name'     => $t['title'],
                            'composer' => array(
                                '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
                            ),
                            'lyricist' => array(
                                '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
                            ),
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

    echo "\n<!-- Keystone Master MusicGroup & MusicAlbum JSON-LD Graph -->\n";
    echo "<script type=\"application/ld+json\">\n";
    echo wp_json_encode( $schema_payload, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . "\n";
    echo "</script>\n<!-- End Keystone Music Graph -->\n\n";
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
            $node = str_ireplace( 'curtis4vancouver@gmail.com', 'keystonerecomposition@gmail.com', $node );
            $node = (string) preg_replace(
                '~https?://(?:www\.)?youtube\.com/@keystone(?:ai)?protocols(?![a-z0-9_])~i',
                'https://www.youtube.com/@KeystoneAIProtocols',
                $node
            );
            $node = (string) preg_replace(
                '~https?://(?:www\.)?youtube\.com/@keystonepossibilities(?:ltd)*(?![a-z0-9_])~i',
                'https://www.youtube.com/@KeystonePossibilitiesLtd',
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
    $person_id      = 'https://keystonerecomposition.com/#wayne-stevenson';
    $clean_logo_url = get_stylesheet_directory_uri() . '/assets/images/kp_badge_icon.png';
    $author_pointer = array(
        '@type' => 'Person',
        '@id'   => $person_id,
        'name'  => 'Wayne Stevenson',
        'url'   => 'https://keystonerecomposition.com/founder/',
    );

    // 0. Flatten any top-level numerically-indexed lists (such as Rank Math #rank-math-toc SiteNavigationElement lists)
    // so Rank Math never wraps a nested list inside @graph[0]
    foreach ( array_keys( $data ) as $top_key ) {
        if ( '@graph' === $top_key || ! is_array( $data[ $top_key ] ) ) {
            continue;
        }
        $val = $data[ $top_key ];
        if ( ! empty( $val ) && ! isset( $val['@type'] ) && array_keys( $val ) === range( 0, count( $val ) - 1 ) ) {
            foreach ( $val as $sub_idx => $sub_item ) {
                if ( is_array( $sub_item ) && isset( $sub_item['@type'] ) ) {
                    $data[ $top_key . '_' . $sub_idx ] = $sub_item;
                }
            }
            unset( $data[ $top_key ] );
        }
    }

    // Recursively scrub legacy email, YouTube handles, lowercase squamish, blocked logo URL, and stub Person nodes
    $data = keystone_sanitize_rank_math_json_ld_node( $data, $person_node, $clean_logo_url );

    // 1. If Rank Math uses @graph array, flatten any nested sub-lists, keep strictly ONE Person node, and normalize author pointers
    if ( isset( $data['@graph'] ) && is_array( $data['@graph'] ) ) {
        $flat_input_graph = array();
        foreach ( $data['@graph'] as $raw_node ) {
            if ( is_array( $raw_node ) && ! isset( $raw_node['@type'] ) && ! empty( $raw_node ) && array_keys( $raw_node ) === range( 0, count( $raw_node ) - 1 ) ) {
                foreach ( $raw_node as $sub_node ) {
                    if ( is_array( $sub_node ) ) {
                        $flat_input_graph[] = $sub_node;
                    }
                }
            } elseif ( is_array( $raw_node ) ) {
                $flat_input_graph[] = $raw_node;
            }
        }

        $found_person       = false;
        $found_profile_page = false;
        $req_founder_path   = trim( (string) parse_url( (string) ( $_SERVER['REQUEST_URI'] ?? '' ), PHP_URL_PATH ), '/' );
        $is_founder_page    = ( function_exists( 'is_page' ) && is_page( 'founder' ) ) || 'founder' === $req_founder_path;
        $clean_graph        = array();
        foreach ( $flat_input_graph as $node ) {
            if ( is_array( $node ) && isset( $node['@type'] ) && in_array( 'Person', (array) $node['@type'], true ) ) {
                if ( ! $found_person ) {
                    $clean_graph[] = array_merge( $node, $person_node );
                    $found_person  = true;
                }
                continue;
            }
            if ( is_array( $node ) && isset( $node['@type'] ) ) {
                $types = (array) $node['@type'];
                if ( $is_founder_page && array_intersect( $types, array( 'Article', 'NewsArticle', 'BlogPosting', 'TechArticle', 'WebPage', 'AboutPage', 'ProfilePage' ) ) ) {
                    continue;
                }
                if ( array_intersect( $types, array( 'Article', 'NewsArticle', 'BlogPosting', 'TechArticle', 'WebPage' ) ) ) {
                    $node['author'] = $author_pointer;
                }
            }
            $clean_graph[] = $node;
        }
        if ( ! $found_person ) {
            $clean_graph[] = $person_node;
        }
        $data['@graph'] = $clean_graph;
        return $data;
    }

    // 2. Standard Rank Math associative $data array: keep strictly ONE top-level Person node
    $req_founder_path = trim( (string) parse_url( (string) ( $_SERVER['REQUEST_URI'] ?? '' ), PHP_URL_PATH ), '/' );
    $is_founder_page  = ( function_exists( 'is_page' ) && is_page( 'founder' ) ) || 'founder' === $req_founder_path;
    $found_top_person = false;
    foreach ( array_keys( $data ) as $key ) {
        if ( ! is_array( $data[ $key ] ) ) {
            continue;
        }
        $types = isset( $data[ $key ]['@type'] ) ? (array) $data[ $key ]['@type'] : array();
        if ( in_array( 'Person', $types, true ) ) {
            if ( ! $found_top_person ) {
                $data[ $key ]     = array_merge( $data[ $key ], $person_node );
                $found_top_person = true;
            } else {
                unset( $data[ $key ] );
            }
            continue;
        }
        if ( $is_founder_page && ( 'richSnippet' === $key || array_intersect( $types, array( 'Article', 'NewsArticle', 'BlogPosting', 'TechArticle', 'WebPage', 'AboutPage', 'ProfilePage' ) ) ) ) {
            unset( $data[ $key ] );
            continue;
        }
        if ( array_intersect( $types, array( 'Article', 'NewsArticle', 'BlogPosting', 'TechArticle' ) ) ) {
            $data[ $key ]['author'] = $author_pointer;
        }
        // Collapse inline nested Person / author sub-objects (even if @type was omitted by Rank Math) to canonical author pointer
        foreach ( array( 'author', 'creator', 'founder', 'accountablePerson' ) as $rel_prop ) {
            if ( isset( $data[ $key ][ $rel_prop ] ) && is_array( $data[ $key ][ $rel_prop ] ) ) {
                $rel_val   = $data[ $key ][ $rel_prop ];
                $rel_types = isset( $rel_val['@type'] ) ? (array) $rel_val['@type'] : array();
                $rel_id    = isset( $rel_val['@id'] ) ? (string) $rel_val['@id'] : '';
                $rel_name  = isset( $rel_val['name'] ) ? trim( (string) $rel_val['name'] ) : '';
                if ( in_array( 'Person', $rel_types, true ) || false !== stripos( $rel_id, '/author/' ) || in_array( $rel_name, array( 'Wayne', 'Wayne Stevenson', 'Wayne Stevens' ), true ) ) {
                    $data[ $key ][ $rel_prop ] = $author_pointer;
                }
            }
        }
    }
    if ( ! $found_top_person ) {
        $data['Person'] = $person_node;
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
/**
 * Centralized 11-char YouTube ID extractor supporting [keystone_video], data-video-id,
 * youtube-nocookie.com/embed/, youtube.com/embed/, youtube.com/watch?v=, youtu.be/, and /shorts/.
 */
function keystone_extract_youtube_id_from_text( string $text ): string {
    if ( '' === trim( $text ) ) {
        return '';
    }
    $patterns = array(
        '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]{11})["\']~i',
        '~data-video-id=["\']([a-zA-Z0-9_-]{11})["\']~i',
        '~youtube-nocookie\.com/embed/([a-zA-Z0-9_-]{11})~i',
        '~youtube\.com/embed/([a-zA-Z0-9_-]{11})~i',
        '~youtube\.com/watch\?(?:[^"\'<>\s]*&(?:amp;)?)?v=([a-zA-Z0-9_-]{11})~i',
        '~youtu\.be/([a-zA-Z0-9_-]{11})~i',
        '~youtube\.com/(?:shorts|v|e)/([a-zA-Z0-9_-]{11})~i',
    );
    foreach ( $patterns as $pattern ) {
        if ( preg_match( $pattern, $text, $matches ) && 'maxresdefau' !== $matches[1] ) {
            return $matches[1];
        }
    }
    return '';
}

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
    $youtube_id = trim( (string) get_post_meta( $post_id, 'keystone_youtube_id', true ) );
    if ( ! preg_match( '/^[a-zA-Z0-9_-]{11}$/', $youtube_id ) || 'maxresdefau' === $youtube_id ) {
        $youtube_id = '';
    }
    $video_url = (string) get_post_meta( $post_id, 'video_url', true );

    if ( '' === $youtube_id && '' !== $video_url ) {
        $youtube_id = keystone_extract_youtube_id_from_text( $video_url );
    }

    if ( '' === $youtube_id ) {
        $source_post = ( $post_id !== $post->ID ) ? get_post( $post_id ) : $post;
        $content     = (string) ( $source_post ? $source_post->post_content : $post->post_content );
        $youtube_id  = keystone_extract_youtube_id_from_text( $content );
    }

    if ( '' === $youtube_id && ! empty( $post->post_content ) ) {
        $youtube_id = keystone_extract_youtube_id_from_text( (string) $post->post_content );
    }

    if ( '' === $youtube_id ) {
        $slug_video_fallback = array(
            'gravel-on-the-tailgate'                                  => 'bEd-uWglqy8',
            'deepseek-r1-vs-gemini'                                   => 'Z0DXVvyO5O8',
            'whiskey-on-a-wednesday-keystone'                         => 'BCVBlNO0p80',
            'grok-3-vs-gemini-antigravity'                            => '-6SHhssG-pc',
            'the-morning-march-deep-house-4k-music-video'             => 'fK9X2vL8pQ4',
            'heavy-civil-focus-keystone-recomposition'                => '8vM4kR2nL9w',
            'byok-local-ai-workstation-replaces-500-mo-saas-wrappers' => 'vN7mK3pQ2xL',
            'autonomous-multi-agent-swarms'                           => 'kL9vM2pQ4xR',
        );
        $lookup_slug = $is_watch_page ? str_replace( 'watch-', '', $post_name ) : $post_name;
        if ( isset( $slug_video_fallback[ $lookup_slug ] ) ) {
            $youtube_id = $slug_video_fallback[ $lookup_slug ];
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
            'url'   => get_stylesheet_directory_uri() . '/assets/images/kp_badge_icon.png',
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
    $is_watch_page = ( is_page() && 'page' === $post->post_type && 0 === strpos( (string) $post->post_name, 'watch-' ) );
    $is_blog_post  = ( is_singular( 'post' ) && 'post' === $post->post_type );
    if ( ! $is_watch_page && ! $is_blog_post ) {
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
    $is_watch_page = ( is_page() && 'page' === $post->post_type && 0 === strpos( (string) $post->post_name, 'watch-' ) );
    $is_blog_post  = ( is_singular( 'post' ) && 'post' === $post->post_type );
    if ( ! $is_watch_page && ! $is_blog_post ) {
        return $data;
    }

    $permalink = get_permalink( $post->ID );
    $person_id = 'https://keystonerecomposition.com/#wayne-stevenson';

    // Guarantee BlogPosting and BreadcrumbList exist on all single blog posts (GAP-02)
    if ( $is_blog_post && is_array( $data ) ) {
        $has_blog_posting = false;
        $has_breadcrumb   = false;
        $nodes_to_check   = isset( $data['@graph'] ) && is_array( $data['@graph'] ) ? $data['@graph'] : $data;
        foreach ( $nodes_to_check as $chk ) {
            if ( is_array( $chk ) && isset( $chk['@type'] ) ) {
                $t_arr = (array) $chk['@type'];
                if ( array_intersect( $t_arr, array( 'BlogPosting', 'Article', 'TechArticle', 'NewsArticle' ) ) ) {
                    $has_blog_posting = true;
                }
                if ( in_array( 'BreadcrumbList', $t_arr, true ) ) {
                    $has_breadcrumb = true;
                }
            }
        }
        if ( ! $has_breadcrumb ) {
            $bc_node = array(
                '@type'           => 'BreadcrumbList',
                '@id'             => $permalink . '#breadcrumb',
                'itemListElement' => array(
                    array(
                        '@type'    => 'ListItem',
                        'position' => 1,
                        'item'     => array(
                            '@id'  => home_url( '/' ),
                            'name' => 'Home',
                        ),
                    ),
                    array(
                        '@type'    => 'ListItem',
                        'position' => 2,
                        'item'     => array(
                            '@id'  => $permalink,
                            'name' => get_the_title( $post->ID ),
                        ),
                    ),
                ),
            );
            if ( isset( $data['@graph'] ) && is_array( $data['@graph'] ) ) {
                $data['@graph'][] = $bc_node;
            } else {
                $data['BreadcrumbList'] = $bc_node;
            }
        }
        if ( ! $has_blog_posting ) {
            $bp_node = array(
                '@type'            => 'BlogPosting',
                '@id'              => $permalink . '#richSnippet',
                'headline'         => get_the_title( $post->ID ),
                'name'             => get_the_title( $post->ID ),
                'datePublished'    => get_the_date( 'c', $post->ID ),
                'dateModified'     => get_the_modified_date( 'c', $post->ID ),
                'author'           => array(
                    '@type' => 'Person',
                    '@id'   => $person_id,
                    'name'  => 'Wayne Stevenson',
                    'url'   => 'https://keystonerecomposition.com/founder/',
                ),
                'publisher'        => array(
                    '@id' => 'https://keystonerecomposition.com/#organization',
                ),
                'mainEntityOfPage' => array(
                    '@id' => $permalink . '#webpage',
                ),
                'inLanguage'       => 'en-US',
            );
            if ( isset( $data['@graph'] ) && is_array( $data['@graph'] ) ) {
                $data['@graph'][] = $bp_node;
            } else {
                $data['richSnippet'] = $bp_node;
            }
        }
    }

    $meta = keystone_get_post_video_metadata( $post );
    if ( ! $meta ) {
        return $data;
    }

    // Check if VideoObject already exists in Rank Math output or @graph
    foreach ( $data as $val ) {
        if ( is_array( $val ) && isset( $val['@type'] ) && in_array( 'VideoObject', (array) $val['@type'], true ) ) {
            return $data;
        }
    }
    if ( isset( $data['@graph'] ) && is_array( $data['@graph'] ) ) {
        foreach ( $data['@graph'] as $g_node ) {
            if ( is_array( $g_node ) && isset( $g_node['@type'] ) && in_array( 'VideoObject', (array) $g_node['@type'], true ) ) {
                return $data;
            }
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

    if ( isset( $data['@graph'] ) && is_array( $data['@graph'] ) ) {
        $data['@graph'][] = $data['VideoObject'];
        unset( $data['VideoObject'] );
    }

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
/**
 * Recursively collapses nested Person sub-objects to pure @id pointers and
 * guarantees strictly ONE top-level / @graph Person (#person) node per page.
 */
function keystone_dedup_person_jsonld_tree( $node, string $person_id, array $person_node, bool &$seen_primary_person, bool $is_root_entity = false ) {
    if ( ! is_array( $node ) ) {
        return $node;
    }

    $is_list = ( array_keys( $node ) === range( 0, count( $node ) - 1 ) );
    if ( $is_list ) {
        $out = array();
        foreach ( $node as $item ) {
            $res = keystone_dedup_person_jsonld_tree( $item, $person_id, $person_node, $seen_primary_person, false );
            if ( null !== $res ) {
                $out[] = $res;
            }
        }
        return $out;
    }

    if ( isset( $node['@type'] ) && in_array( 'Person', (array) $node['@type'], true ) ) {
        $nid  = isset( $node['@id'] ) ? (string) $node['@id'] : '';
        $name = isset( $node['name'] ) ? trim( (string) $node['name'] ) : '';
        $is_wayne = ( $nid === $person_id || false !== strpos( $nid, '/#person' ) || in_array( $name, array( '', 'Wayne', 'Wayne Stevenson' ), true ) );
        if ( $is_wayne ) {
            if ( $is_root_entity ) {
                if ( ! $seen_primary_person ) {
                    $seen_primary_person = true;
                    return array_merge( $node, $person_node );
                }
                return null;
            }
            return array( '@id' => $person_id );
        }
    }

    foreach ( $node as $k => $v ) {
        if ( is_array( $v ) ) {
            $res = keystone_dedup_person_jsonld_tree( $v, $person_id, $person_node, $seen_primary_person, false );
            if ( null !== $res ) {
                $node[ $k ] = $res;
            }
        }
    }

    return $node;
}

add_action( 'wp_head', function() {
    ob_start( function( $output ) {
        $person_node         = function_exists( 'keystone_get_wayne_stevenson_person_schema' ) ? keystone_get_wayne_stevenson_person_schema() : array();
        $person_id           = 'https://keystonerecomposition.com/#wayne-stevenson';
        $clean_logo_url      = get_stylesheet_directory_uri() . '/assets/images/kp_badge_icon.png';
        $seen_primary_person = false;

        // Strategy: find all JSON-LD script tags, decode, sanitize legacy handles, strip corrupt VideoObject, and enforce single #person across page
        $output = preg_replace_callback(
            '~(<script\s+type=["\']application/ld\+json["\'][^>]*>)(.*?)(</script>)~is',
            function( $matches ) use ( $person_node, $person_id, $clean_logo_url, &$seen_primary_person ) {
                $json = json_decode( $matches[2], true );
                if ( ! is_array( $json ) ) {
                    return $matches[0];
                }

                $before_serialized = wp_json_encode( $json );

                // 0. Recursively sanitize legacy email, YouTube handles, lowercase squamish, blocked logo, and stub Person nodes
                if ( function_exists( 'keystone_sanitize_rank_math_json_ld_node' ) && ! empty( $person_node ) ) {
                    $json = keystone_sanitize_rank_math_json_ld_node( $json, $person_node, $clean_logo_url );
                }

                // 1. Single Top-Level VideoObject check
                if ( isset( $json['@type'] ) && ( $json['@type'] === 'VideoObject' || in_array( 'VideoObject', (array) $json['@type'], true ) ) ) {
                    $embed   = $json['embedUrl'] ?? '';
                    $content = $json['contentUrl'] ?? '';
                    if ( strpos( (string) $embed, 'maxresdefau' ) !== false || strpos( (string) $content, 'maxresdefau' ) !== false ) {
                        return '';
                    }
                    if ( ! isset( $json['publisher'] ) ) {
                        return '';
                    }
                }

                // 2. Nested @graph VideoObject + Page-Wide #person Deduplication + Flatten Nested Indexed Lists
                if ( isset( $json['@graph'] ) && is_array( $json['@graph'] ) ) {
                    $flat_graph_nodes = array();
                    foreach ( $json['@graph'] as $raw_g_node ) {
                        if ( is_array( $raw_g_node ) && ! isset( $raw_g_node['@type'] ) && ! empty( $raw_g_node ) && array_keys( $raw_g_node ) === range( 0, count( $raw_g_node ) - 1 ) ) {
                            foreach ( $raw_g_node as $sub_g_node ) {
                                if ( is_array( $sub_g_node ) ) {
                                    $flat_graph_nodes[] = $sub_g_node;
                                }
                            }
                        } elseif ( is_array( $raw_g_node ) ) {
                            $flat_graph_nodes[] = $raw_g_node;
                        }
                    }
                    $filtered_graph = array();
                    foreach ( $flat_graph_nodes as $node ) {
                        if ( isset( $node['@type'] ) && ( $node['@type'] === 'VideoObject' || in_array( 'VideoObject', (array) $node['@type'], true ) ) ) {
                            $embed   = $node['embedUrl'] ?? '';
                            $content = $node['contentUrl'] ?? '';
                            if ( strpos( (string) $embed, 'maxresdefau' ) !== false || strpos( (string) $content, 'maxresdefau' ) !== false || ! isset( $node['publisher'] ) ) {
                                continue;
                            }
                        }
                        if ( ! empty( $person_node ) ) {
                            $deduped_node = keystone_dedup_person_jsonld_tree( $node, $person_id, $person_node, $seen_primary_person, true );
                            if ( null === $deduped_node ) {
                                continue;
                            }
                            $node = $deduped_node;
                        }
                        $filtered_graph[] = $node;
                    }
                    if ( empty( $filtered_graph ) ) {
                        return '';
                    }
                    $json['@graph'] = $filtered_graph;
                } elseif ( ! empty( $person_node ) ) {
                    $deduped_root = keystone_dedup_person_jsonld_tree( $json, $person_id, $person_node, $seen_primary_person, true );
                    if ( null === $deduped_root ) {
                        return '';
                    }
                    $json = $deduped_root;
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
        'keystone_video_sitemap', 'keystone_indexnow_ping', 'keystone_indexnow_key',
    );

    $known_301_sources = array(
        '/about/',
        '/about-the-founder/',
        '/about-the-founder-the-keystone-blueprint/',
        '/music-releases/',
        '/old-store/',
        '/watch-iron-grace-2/',
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

// Exclude thin taxonomies ('category', 'post_tag' and 'post_format') from Rank Math XML sitemaps to prevent index bloat
add_filter( 'rank_math/sitemap/exclude_taxonomy', function( bool $exclude, string $taxonomy ): bool {
    if ( in_array( $taxonomy, array( 'category', 'post_tag', 'post_format' ), true ) ) {
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
add_filter( 'robots_txt', 'keystone_recomposition_sanitize_robots_txt', 999999, 2 );
function keystone_recomposition_sanitize_robots_txt( $output, $public ) {
    $sitemap_url       = home_url( '/sitemap_index.xml' );
    $video_sitemap_url = home_url( '/keystone-video-sitemap.xml' );

    $robots  = "# Keystone Recomposition - Sovereign Robots & GEO Crawl Policy
";
    $robots .= "# Machine-Readable LLM Corpus: https://keystonerecomposition.com/llms.txt
";
    $robots .= "# Expanded Technical & Sonic Corpus: https://keystonerecomposition.com/llms-full.txt

";
    $robots .= "User-agent: *
";
    $robots .= "Allow: /llms.txt
";
    $robots .= "Allow: /llms-full.txt
";
    $robots .= "Disallow: /wp-admin/
";
    $robots .= "Allow: /wp-admin/admin-ajax.php
";
    $robots .= "Allow: /wp-content/uploads/
";
    $robots .= "Allow: /wp-content/themes/
";
    $robots .= "Allow: /wp-includes/
";
    $robots .= "Disallow: /wp-content/plugins/
";
    $robots .= "Disallow: /readme.html
";
    $robots .= "Disallow: /license.txt
";
    $robots .= "Disallow: /search/
";
    $robots .= "Disallow: /?s=
";
    $robots .= "Disallow: /*.html$

";

    // Explicit AI Search & Answer Engine Crawler Permissions
    $ai_agents = array(
        'GPTBot',
        'OAI-SearchBot',
        'ChatGPT-User',
        'ClaudeBot',
        'anthropic-ai',
        'PerplexityBot',
        'Perplexity-User',
        'Google-Extended',
        'Applebot-Extended',
        'Bingbot',
        'DuckDuckBot',
        'CCBot',
    );
    foreach ( $ai_agents as $agent ) {
        $robots .= "User-agent: {$agent}
";
        $robots .= "Allow: /

";
    }

    $robots .= "Sitemap: " . esc_url( $sitemap_url ) . "
";
    $robots .= "Sitemap: " . esc_url( $video_sitemap_url ) . "
";

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
            'keystone_video_sitemap', 'keystone_indexnow_ping', 'keystone_indexnow_key',
            'keystone_sync_geo', 'create_missing_watch_pages', 'keystone_ls_purge',
            'update_page_sovereign', 'update_post_sovereign',
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

    // 0. Legacy Pre-Channel & Duplicate Watch Page 301 Redirects (Single-Hop to Live New-Channel Pillar Posts)
    $legacy_recomp_id_map = array(
        2316 => '/2026/10/18/byok-local-ai-workstation-replaces-500-mo-saas-wrappers/',
        2315 => '/2026/10/26/the-morning-march-deep-house-4k-music-video/',
        2313 => '/2026/10/02/autonomous-multi-agent-swarms/',
        2693 => '/watch-heavy-civil-focus-keystone-recomposition/',
    );
    $req_id = isset( $_GET['p'] ) ? (int) $_GET['p'] : ( isset( $_GET['page_id'] ) ? (int) $_GET['page_id'] : 0 );
    if ( $req_id > 0 && isset( $legacy_recomp_id_map[ $req_id ] ) ) {
        header( 'Cache-Control: no-cache, no-store, must-revalidate, max-age=0' );
        header( 'X-LiteSpeed-Cache-Control: no-cache' );
        wp_safe_redirect( home_url( $legacy_recomp_id_map[ $req_id ] ), 301 );
        exit;
    }

    $legacy_recomp_path_map = array(
        '/2026/09/28/chrome-devtools-protocol-cdp-port-9222-automation' => '/2026/10/18/byok-local-ai-workstation-replaces-500-mo-saas-wrappers/',
        '/chrome-devtools-protocol-cdp-port-9222-automation' => '/2026/10/18/byok-local-ai-workstation-replaces-500-mo-saas-wrappers/',
        '/watch-chrome-devtools-protocol-cdp-port-9222-automation' => '/watch-byok-local-ai-workstation-replaces-500-mo-saas-wrappers/',
        '/2026/09/28/sovereign-reverb-functional-frequency-architecture' => '/2026/10/26/the-morning-march-deep-house-4k-music-video/',
        '/sovereign-reverb-functional-frequency-architecture' => '/2026/10/26/the-morning-march-deep-house-4k-music-video/',
        '/watch-sovereign-reverb-functional-frequency-architecture' => '/2026/10/26/the-morning-march-deep-house-4k-music-video/',
        '/2026/09/28/autonomous-multi-agent-swarms-fastmcp-architecture' => '/2026/10/02/autonomous-multi-agent-swarms/',
        '/autonomous-multi-agent-swarms-fastmcp-architecture' => '/2026/10/02/autonomous-multi-agent-swarms/',
        '/watch-autonomous-multi-agent-swarms-fastmcp-architecture' => '/watch-autonomous-multi-agent-swarms/',
        '/watch-heavy-civil-focus-deep-house-4k-music-video' => '/watch-heavy-civil-focus-keystone-recomposition/',
    );
    $lower_trimmed = strtolower( $trimmed_path );
    if ( isset( $legacy_recomp_path_map[ $lower_trimmed ] ) ) {
        header( 'Cache-Control: no-cache, no-store, must-revalidate, max-age=0' );
        header( 'X-LiteSpeed-Cache-Control: no-cache' );
        wp_safe_redirect( home_url( $legacy_recomp_path_map[ $lower_trimmed ] ), 301 );
        exit;
    }

    // 1. Canonical Founder 301 Redirects (/about/, /about-the-founder/, /wayne-stevenson/ -> /founder/)
    if ( in_array( strtolower( $trimmed_path ), array( '/about', '/about-the-founder', '/about-the-founder-the-keystone-blueprint', '/wayne-stevenson' ), true ) ) {
        wp_safe_redirect( home_url( '/founder/' ), 301 );
        exit;
    }

    // 1b. Legacy Case Studies 301 Redirect (/case-studies/ -> /ecosystem-partners/)
    if ( '/case-studies' === strtolower( $trimmed_path ) ) {
        wp_safe_redirect( home_url( '/ecosystem-partners/' ), 301 );
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
 * Canonical 5-Question Homepage Executive FAQ Source of Truth
 * Shared 1:1 between template-parts/kr-faq-accordion.php (#faq) and homepage FAQPage JSON-LD.
 *
 * @return array<int, array{q: string, a: string}>
 */
function keystone_get_homepage_executive_faqs(): array {
    return array(
        array(
            'q' => 'What is Keystone Recomposition and what does the Sovereign v4.0 ecosystem unite?',
            'a' => 'Founded by AI systems architect, music producer, and licensed BC builder Wayne Stevenson (#52603) in Squamish, British Columbia, Keystone Recomposition unites two sovereign disciplines under one command center: (1) zero-SaaS autonomous multi-agent AI engineering, dark-luxury web systems, and native Rust + Tauri desktop workstations, and (2) an official 25-release / 246-track 24-bit sonic catalog engineered in 432Hz, 528Hz, and deep melodic house.',
        ),
        array(
            'q' => 'Which AI Protocol Vault tier should I choose: $49.50, $199, or $800?',
            'a' => 'Tier 1 ($49.50 USD) delivers the foundational 4-folder AI Brain architecture, ~20-word Google Flow video prompt workflow, and 4 illustrated PDF setup manuals. Tier 2 ($199 USD) unlocks the 6-Agent Role Suite + Multi-Agent Architecture, 3-source fact verification gates, YouTube Brand Channel defaults, and dark-luxury Rank Math 100/100 web templates. Tier 3 ($800 USD) provides the Complete Runnable Rust + Tauri v2 Desktop Command Center Source Project + 1-Command Windows .EXE Compiler + all 12 PDF manuals + 14-Day Guided Build Support.',
        ),
        array(
            'q' => 'Are all 25 releases and 246 tracks cleared for 100% One-Stop Sync Licensing?',
            'a' => 'Yes. Keystone Recomposition holds 100% of both the Master Recording and Publishing rights across all 25 official releases and 246 ISRC-registered tracks. Music supervisors, film studios, game developers, and luxury brands receive rapid one-stop clearance with 24-bit / 96kHz WAV masters and instrumental stems directly from our licensing desk.',
        ),
        array(
            'q' => 'Why does Keystone build on Chrome Port 9222 and local hardware instead of cloud SaaS wrappers?',
            'a' => 'Cloud browser wrappers trigger bot gates, leak session context, and charge recurring monthly markups. By attaching directly to authenticated browser sessions over Chrome DevTools Protocol Port 9222 and running local CUDA voice/vector engines, you retain 100% data sovereignty, sub-second responsiveness, and zero recurring SaaS lock-in.',
        ),
        array(
            'q' => 'How does Keystone Recomposition connect to Keystone Possibilities Ltd. (#52603)?',
            'a' => 'Both divisions are led by Wayne Stevenson out of Squamish & Whistler, BC. Keystone Possibilities Ltd. is our licensed BC residential construction and BC Hydro ES54 civil contracting firm (BC Housing Builder #52603), delivering custom homes and Bill 44 multiplexes under open-book CCDC 5B contracts—bringing real-world critical-path engineering discipline to every digital system we ship.',
        ),
    );
}

/**
 * Canonical 7-Question AI Protocols Buyer FAQ Source of Truth
 * Shared 1:1 between template-ai-protocols.php (#ai-protocols-faq) and /ai-protocols/#faq FAQPage JSON-LD.
 *
 * @return array<int, array{q: string, a: string}>
 */
function keystone_get_ai_protocols_buyer_faqs(): array {
    return array(
        array(
            'q' => 'What happens in the first 60 seconds after I pay with Visa or Mastercard?',
            'a' => 'Within seconds of completing 256-bit Stripe USD checkout, you are redirected back to /ai-protocols/ where your personal Buyer KR-UID unlocks the Self-Service Buyer Vault on screen—giving you immediate access to your unlisted 4K recorded walkthrough videos, downloadable .ZIP starter packs, illustrated %PDF-1.7 setup books, and an automated backup receipt emailed straight to your inbox.',
        ),
        array(
            'q' => 'Do I need prior coding or terminal experience to set up Tier 01 or Tier 02?',
            'a' => 'No prior coding is required. Every module uses copy-paste starter prompts, ready-to-drop Markdown rule files (AGENTS.md), timestamped 4K walkthrough chapters, and illustrated %PDF-1.7 manuals designed so Google Antigravity writes and organizes your folders, prompts, and website layouts step by step.',
        ),
        array(
            'q' => 'How does the 100% dollar-for-dollar Tier Upgrade Credit work if I start at $49.50?',
            'a' => 'Every dollar you spend on an earlier tier is credited 100% toward higher tiers at any time using your Buyer KR-UID. Starting at Tier 01 ($49.50 USD) means upgrading later to Tier 02 ($199 USD) costs only $149.50 USD, or upgrading to Tier 03 ($800 USD) costs only $750.50 USD (and upgrading from Tier 02 to Tier 03 costs $601.00 USD).',
        ),
        array(
            'q' => 'Are there any recurring monthly fees or subscriptions charged by Keystone?',
            'a' => 'Zero recurring fees to Keystone. Each tier ($49.50, $199, or $800 USD) is a single one-time purchase with permanent ownership of your downloaded .ZIP starter files and %PDF-1.7 books. You simply run the workflows inside your own Google Antigravity and Google Flow workspace.',
        ),
        array(
            'q' => 'Does the AI Builder Suite work on both Mac and Windows, and what are the Tier 03 .EXE prerequisites?',
            'a' => 'Yes—Tier 01 (4-Folder AI Brain & Google Flow ~20-word video workflow) and Tier 02 (Dark-Luxury Website, SEO Schema & 6-Agent Role Suite) work identically on macOS, Windows, and Linux. Compiling the standalone Windows .EXE binary in Tier 03 uses Windows 10/11 (64-bit) with the free Microsoft WebView2, Node.js LTS, and Rust (rustup) toolchain guided step by step.',
        ),
        array(
            'q' => 'What exactly is inside Tier 03 ($800 USD) — is it a locked binary or runnable Rust + Tauri v2 source code?',
            'a' => 'Tier 03 gives you the Complete Runnable Rust + Tauri v2 Desktop Command Center Source Project (Cargo.toml, src-tauri/src/main.rs, tauri.conf.json, dark-luxury UI dashboard, and 1-command Windows .EXE compiler script), plus everything in Tiers 01 and 02, all 12 illustrated %PDF-1.7 manuals, and 14-Day Guided Build Support so you own and customize your own desktop executable.',
        ),
        array(
            'q' => 'Can I apply a promo code at Visa checkout, and what is included in the Guided Setup Support window?',
            'a' => 'Yes—enter a valid promo code (such as BUILDER10) on the Express Checkout card or order modal before clicking Pay with Visa / Mastercard and the discounted USD total is passed directly to Stripe. Tier 01 includes a 7-day Guided Setup Window (up to 3 follow-up questions), Tier 02 includes 7 days (up to 5 follow-ups), and Tier 03 includes 14 days of Guided Build Support (up to 8 follow-ups plus architectural review).',
        ),
    );
}

/**
 * 14. Inject 2026 SoftwareApplication & FAQPage Schema for AI Protocols & Homepage
 * Maximizes global Google Rich Results with AggregateOffer ($49.50–$800.00 USD) and 1:1 visible FAQ parity.
 */
add_action( 'wp_head', 'keystone_inject_ai_protocols_software_schema', 15 );
function keystone_inject_ai_protocols_software_schema() {
    global $post;
    $slug     = ( $post && isset( $post->post_name ) ) ? $post->post_name : '';
    $template = ( $post && isset( $post->ID ) ) ? (string) get_page_template_slug( $post->ID ) : '';
    $is_ai_protocols_page = is_page() && ( 'ai-protocols' === $slug || false !== strpos( $template, 'ai-protocols' ) );

    if ( is_front_page() || is_home() || $is_ai_protocols_page ) {
        $graph_nodes = array(
            array(
                '@type'               => 'SoftwareApplication',
                '@id'                 => home_url( '/ai-protocols/#software' ),
                'name'                => 'Keystone AI Protocols & Multi-Agent Builder Suite',
                'alternateName'       => 'Keystone Sovereign AI Brain, 6-Agent Role Suite & Tauri v2 Desktop Command Center',
                'url'                 => home_url( '/ai-protocols/' ),
                'description'         => '3-Tier Sovereign AI Builder Suite engineered by Wayne Stevenson: 4-Folder AI Brain & Google Flow starter ($49.50 USD), 6-Agent Role Suite + Dark-Luxury Website Architecture ($199 USD), and Complete Runnable Rust + Tauri v2 Desktop Command Center Source + 1-Command Windows .EXE Compiler ($800 USD).',
                'applicationCategory' => 'DeveloperApplication',
                'operatingSystem'     => 'Windows, macOS, Linux',
                'offers'              => array(
                    '@type'         => 'AggregateOffer',
                    'lowPrice'      => '49.50',
                    'highPrice'     => '800.00',
                    'priceCurrency' => 'USD',
                    'offerCount'    => 3,
                    'availability'  => 'https://schema.org/InStock',
                    'url'           => home_url( '/ai-protocols/' ),
                ),
                'author'              => array(
                    '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
                ),
                'publisher'           => array(
                    '@id' => 'https://keystonerecomposition.com/#organization',
                ),
            ),
        );

        if ( $is_ai_protocols_page || is_front_page() ) {
            $faq_rows = $is_ai_protocols_page
                ? keystone_get_ai_protocols_buyer_faqs()
                : keystone_get_homepage_executive_faqs();
            $faq_entities = array();
            foreach ( $faq_rows as $row ) {
                $faq_entities[] = array(
                    '@type'          => 'Question',
                    'name'           => $row['q'],
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text'  => $row['a'],
                    ),
                );
            }
            $graph_nodes[] = array(
                '@type'      => 'FAQPage',
                '@id'        => $is_ai_protocols_page ? home_url( '/ai-protocols/#faq' ) : home_url( '/#faq' ),
                'mainEntity' => $faq_entities,
            );
        }

        $ai_schema = array(
            '@context' => 'https://schema.org',
            '@graph'   => $graph_nodes,
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
            'description' => 'AI Systems Architect, FastMCP Multi-Agent Engineer & 24-Release Electronic Music Producer across Vancouver, Squamish, and Whistler.',
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
            'slugs'       => array( 'worldwide', 'ai-protocols', 'newyork-executive-ai-systems', 'new-york-autonomous-agent-swarms' ),
            'name'        => 'Keystone Protocols — Worldwide Autonomous Intelligence & Music Publishing Hub',
            'description' => 'Autonomous multi-agent AI swarms, quantitative prediction market intelligence, and 25-release TooLost functional electronic music universe distributed globally.',
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
                            '@id' => 'https://keystonerecomposition.com/#wayne-stevenson',
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
/**
 * 16. IndexNow Instant Search & AI Crawler Batch Ping (Bing, Copilot, ChatGPT Search, Yandex, Seznam, Naver)
 * Serves verification key at /8f4b2e9a1c6d7e3f5a0b9c8d7e6f5a4b.txt and fires batch pings via ?keystone_indexnow_ping=1
 * or automatically whenever a post/page is published.
 */
if ( ! defined( 'KEYSTONE_RECOMPOSITION_INDEXNOW_KEY' ) ) {
    define( 'KEYSTONE_RECOMPOSITION_INDEXNOW_KEY', '8f4b2e9a1c6d7e3f5a0b9c8d7e6f5a4b' );
}

add_action( 'init', 'keystone_recomposition_handle_indexnow_endpoints', 0 );
function keystone_recomposition_handle_indexnow_endpoints() {
    $req_uri = $_SERVER['REQUEST_URI'] ?? '';
    $path    = strtok( (string) $req_uri, '?' );
    $key     = function_exists( 'keystone_recomp_get_indexnow_key' )
        ? keystone_recomp_get_indexnow_key()
        : KEYSTONE_RECOMPOSITION_INDEXNOW_KEY;

    // 1. Serve IndexNow Key Verification File (/<key>.txt)
    if ( $path === '/' . $key . '.txt' || $path === '/' . KEYSTONE_RECOMPOSITION_INDEXNOW_KEY . '.txt' || isset( $_GET['keystone_indexnow_key'] ) ) {
        $served_key = ( $path === '/' . KEYSTONE_RECOMPOSITION_INDEXNOW_KEY . '.txt' ) ? KEYSTONE_RECOMPOSITION_INDEXNOW_KEY : $key;
        status_header( 200 );
        header( 'Content-Type: text/plain; charset=utf-8' );
        header( 'Cache-Control: public, max-age=86400' );
        echo $served_key;
        exit;
    }

    // 2. On-Demand Batch Ping (?keystone_indexnow_ping=1)
    if ( isset( $_GET['keystone_indexnow_ping'] ) && current_user_can( 'manage_options' ) ) {
        $result = keystone_recomposition_execute_indexnow_batch_ping();
        status_header( 200 );
        header( 'Content-Type: application/json; charset=utf-8' );
        header( 'Cache-Control: no-cache, no-store, must-revalidate, max-age=0' );
        echo wp_json_encode( $result, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
        exit;
    }
}

function keystone_recomposition_execute_indexnow_batch_ping( $specific_urls = array() ) {
    $key          = function_exists( 'keystone_recomp_get_indexnow_key' )
        ? keystone_recomp_get_indexnow_key()
        : KEYSTONE_RECOMPOSITION_INDEXNOW_KEY;
    $host         = (string) wp_parse_url( home_url(), PHP_URL_HOST );
    $key_location = home_url( '/' . $key . '.txt' );

    if ( ! empty( $specific_urls ) ) {
        $url_list = array_values( array_unique( $specific_urls ) );
    } elseif ( function_exists( 'keystone_recomp_collect_canonical_indexnow_urls' ) ) {
        $url_list = keystone_recomp_collect_canonical_indexnow_urls();
    } else {
        $url_list = array(
            home_url( '/' ),
            home_url( '/ai-protocols/' ),
            home_url( '/sonic-universe/' ),
            home_url( '/founder/' ),
            home_url( '/ecosystem-partners/' ),
            home_url( '/llms.txt' ),
            home_url( '/llms-full.txt' ),
        );
    }

    $payload = array(
        'host'        => $host,
        'key'         => $key,
        'keyLocation' => $key_location,
        'urlList'     => $url_list,
    );

    $endpoints = array(
        'api_indexnow'  => 'https://api.indexnow.org/indexnow',
        'bing_indexnow' => 'https://www.bing.com/indexnow',
    );
    $results = array();
    foreach ( $endpoints as $label => $endpoint_url ) {
        $response  = wp_remote_post( $endpoint_url, array(
            'headers' => array( 'Content-Type' => 'application/json; charset=utf-8' ),
            'body'    => wp_json_encode( $payload, JSON_UNESCAPED_SLASHES ),
            'timeout' => 15,
        ) );
        $http_code = is_wp_error( $response ) ? 0 : (int) wp_remote_retrieve_response_code( $response );
        $body_text = is_wp_error( $response ) ? $response->get_error_message() : wp_remote_retrieve_body( $response );
        $results[ $label ] = array(
            'endpoint'      => $endpoint_url,
            'http_code'     => $http_code,
            'accepted'      => in_array( $http_code, array( 200, 202 ), true ),
            'response_body' => $body_text,
        );
    }

    return array(
        'domain'          => $host,
        'key'             => $key,
        'key_location'    => $key_location,
        'submitted_count' => count( $url_list ),
        'endpoints'       => $results,
        'url_list'        => $url_list,
    );
}

add_action( 'transition_post_status', 'keystone_recomposition_auto_ping_indexnow_on_publish', 20, 3 );
function keystone_recomposition_auto_ping_indexnow_on_publish( $new_status, $old_status, $post ) {
    if ( 'publish' !== $new_status || ! in_array( $post->post_type, array( 'post', 'page' ), true ) ) {
        return;
    }
    $urls = array( get_permalink( $post->ID ), home_url( '/' ), home_url( '/sitemap_index.xml' ), home_url( '/keystone-video-sitemap.xml' ) );
    keystone_recomposition_execute_indexnow_batch_ping( $urls );
}
