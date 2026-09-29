<?php
/**
 * Keystone Recomposition — Master Sonic Catalog Data Store
 * Version: 3.0.0 (PHP 8.2+ Strict Types)
 * Author: Keystone Architecture
 * Source: TooLost Digital Distribution Master ISRC Registry
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Returns the complete master discography array.
 *
 * @return array<int, array<string, mixed>>
 */
function keystone_get_all_albums(): array {
    static $albums = null;
    if ( $albums !== null ) {
        return $albums;
    }

    $albums = array(
        array(
            'id'           => 1239327,
            'title'        => 'Sovereign Reverb',
            'upc'          => '0682286183785',
            'release_date' => '2026-08-16',
            'genre'        => 'Organic Downtempo Chill House',
            'bpm'          => 115,
            'track_count'  => 10,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/sovereign_reverb.jpg',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'The Cold Reset',
                    'isrc'     => 'QT62V2662081',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Stature & Calm',
                    'isrc'     => 'QT62V2662082',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'The Evening Taper',
                    'isrc'     => 'QT62V2662083',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Rest-Day Rhythm',
                    'isrc'     => 'QT62V2662084',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'Echoes of the Scaffold',
                    'isrc'     => 'QT62V2662085',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Lakeside Shadows',
                    'isrc'     => 'QT62V2662086',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Thermal Shift',
                    'isrc'     => 'QT62V2662087',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Autophagy Flow',
                    'isrc'     => 'QT62V2662088',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'Sea-to-Sky Horizon',
                    'isrc'     => 'QT62V2662089',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'Quiet Scaffolding',
                    'isrc'     => 'QT62V2662090',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1239295,
            'title'        => 'APOLLO Protocol',
            'upc'          => '0682286183778',
            'release_date' => '2026-08-07',
            'genre'        => 'Progressive Deep House',
            'bpm'          => 124,
            'track_count'  => 10,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/apollo_protocol.jpg',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'Secretagogue',
                    'isrc'     => 'QT62V2662071',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Circadian Lock',
                    'isrc'     => 'QT62V2662072',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'The 5-AM Cold Plunge',
                    'isrc'     => 'QT62V2662073',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Cellular Rebuild',
                    'isrc'     => 'QT62V2662074',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'Systemic Yield',
                    'isrc'     => 'QT62V2662075',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'The Peptide Loop',
                    'isrc'     => 'QT62V2662076',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Optimal Axis',
                    'isrc'     => 'QT62V2662077',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Somatic Reset',
                    'isrc'     => 'QT62V2662078',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'The Fasting Window',
                    'isrc'     => 'QT62V2662079',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'Mitochondrial Fire',
                    'isrc'     => 'QT62V2662080',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1239280,
            'title'        => 'Blue Collar Symphony',
            'upc'          => '0682286183761',
            'release_date' => '2026-07-28',
            'genre'        => 'Melodic Deep House',
            'bpm'          => 120,
            'track_count'  => 10,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/blue_collar_symphony.jpg',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'Grade and Level',
                    'isrc'     => 'QT62V2662061',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Concrete Cure',
                    'isrc'     => 'QT62V2662062',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'Grain of the Wood',
                    'isrc'     => 'QT62V2662063',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Shear Wall',
                    'isrc'     => 'QT62V2662064',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'The First Footing',
                    'isrc'     => 'QT62V2662065',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Granite Ascent',
                    'isrc'     => 'QT62V2662066',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Legacy Frame',
                    'isrc'     => 'QT62V2662067',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'The Plumb Line',
                    'isrc'     => 'QT62V2662068',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'Timberline Resonance',
                    'isrc'     => 'QT62V2662069',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'Squamish Ridge Orbit',
                    'isrc'     => 'QT62V2662070',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1237856,
            'title'        => 'Sarcopenic Threshold',
            'upc'          => '0682286183754',
            'release_date' => '2026-07-27',
            'genre'        => 'Industrial Tech House',
            'bpm'          => 122,
            'track_count'  => 10,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/sarcopenic_threshold.jpg',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'Hypertrophic Shift',
                    'isrc'     => 'QT62V2662051',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Myosin Pulse',
                    'isrc'     => 'QT62V2662052',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'The 205 Marker',
                    'isrc'     => 'QT62V2662053',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Load Vector',
                    'isrc'     => 'QT62V2662054',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'Type II Fibers',
                    'isrc'     => 'QT62V2662055',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Density Index',
                    'isrc'     => 'QT62V2662056',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Anabolic Rhythm',
                    'isrc'     => 'QT62V2662057',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Myofibrillar Tension',
                    'isrc'     => 'QT62V2662058',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'Threshold Cross',
                    'isrc'     => 'QT62V2662059',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'Sovereign Fiber',
                    'isrc'     => 'QT62V2662060',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1147269,
            'title'        => 'Concrete Foundations',
            'upc'          => '0672896614533',
            'release_date' => '2026-06-22',
            'genre'        => 'Deep Tech House',
            'bpm'          => 126,
            'track_count'  => 11,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/concrete_foundations.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'Phase One Rebuild',
                    'isrc'     => 'QT4K52640742',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'The Groundwork',
                    'isrc'     => 'QT4K52640743',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'Pouring the Core',
                    'isrc'     => 'QT4K52640744',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Sea-to-Sky Horizon',
                    'isrc'     => 'QT4K52640745',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'Structural Integrity',
                    'isrc'     => 'QT4K52640746',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Heavy Civil Focus',
                    'isrc'     => 'QT4K52640747',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'The Master Blueprint',
                    'isrc'     => 'QT4K52640748',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Rising Architecture',
                    'isrc'     => 'QT4K52640749',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'Cold Curing',
                    'isrc'     => 'QT4K52640750',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'Setting the Line',
                    'isrc'     => 'QT4K52640751',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 11,
                    'title'    => 'The Empire Base',
                    'isrc'     => 'QT4K52640752',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1104174,
            'title'        => 'The Architect\'s Groove: Phase 2 Deep House',
            'upc'          => '0672896329819',
            'release_date' => '2026-05-27',
            'genre'        => 'Melodic Progressive House',
            'bpm'          => 124,
            'track_count'  => 10,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/the_architects_groove.jpg',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'Phase Two (The Build)',
                    'isrc'     => 'QT4K42635223',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'The 100K Push',
                    'isrc'     => 'QT4K42635224',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'Sarcopenia Defense',
                    'isrc'     => 'QT4K42635225',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'The Cadence (Five and Two)',
                    'isrc'     => 'QT4K42635226',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'East Bending',
                    'isrc'     => 'QT4K42635227',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Squamish Dawn',
                    'isrc'     => 'QT4K42635228',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Two Hundred Grams',
                    'isrc'     => 'QT4K42635229',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'The Set-Point',
                    'isrc'     => 'QT4K42635230',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'Blueprint (Case Study)',
                    'isrc'     => 'QT4K42635231',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'Hold The Line',
                    'isrc'     => 'QT4K42635232',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1099021,
            'title'        => 'Resonantia: 10 Frequencies of the Rebuild',
            'upc'          => '0672896293660',
            'release_date' => '2026-05-17',
            'genre'        => 'Solfeggio & Ambient House',
            'bpm'          => 120,
            'track_count'  => 10,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/resonantia.jpg',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'Fundamentum (174 Hz Grounding & Pain Relief)',
                    'isrc'     => 'QT4K42622855',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Textura Sanat (285 Hz Tissue Repair)',
                    'isrc'     => 'QT4K42622856',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'Timor Liberatus (396 Hz Releasing Fear)',
                    'isrc'     => 'QT4K42622857',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Mutatio (417 Hz Facilitating Change)',
                    'isrc'     => 'QT4K42622858',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'Resonantia Terrae (432 Hz Earth Resonance)',
                    'isrc'     => 'QT4K42622859',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Renovatio Cellulae (528 Hz Miracle Tone)',
                    'isrc'     => 'QT4K42622860',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Harmonia (639 Hz Connection & Unity)',
                    'isrc'     => 'QT4K42622861',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Purificatio (741 Hz Cellular Detox)',
                    'isrc'     => 'QT4K42622862',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'Ordo Spiritus (852 Hz Spiritual Awakening)',
                    'isrc'     => 'QT4K42622863',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'Lux Aeterna (963 Hz Divine Consciousness)',
                    'isrc'     => 'QT4K42622864',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1058778,
            'title'        => 'L’Architettura del Domani',
            'upc'          => '672896091525',
            'release_date' => '2026-04-30',
            'genre'        => 'Cinematic Synth House',
            'bpm'          => 122,
            'track_count'  => 10,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/l_architettura_del_domani.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'L’Inizio (The Foundation)',
                    'isrc'     => 'QT4K32637284',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Strings of Fire',
                    'isrc'     => 'QT4K32637285',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'Il Canto della Forza (Song of Strength)',
                    'isrc'     => 'QT4K32637286',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Beyond the Horizon',
                    'isrc'     => 'QT4K32637287',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'Battito d’Acciaio (Heartbeat of Steel)',
                    'isrc'     => 'QT4K32637288',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Midnight Cello',
                    'isrc'     => 'QT4K32637289',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'The Ascent (L’Ascesa)',
                    'isrc'     => 'QT4K32637290',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Ombre e Luce (Shadows and Light)',
                    'isrc'     => 'QT4K32637291',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'L’Orizzonte di Fuoco (The Horizon of Fire)',
                    'isrc'     => 'QT4K32637292',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'L’Ultimo Mattino (The Final Dawn)',
                    'isrc'     => 'QT4K32637293',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1044310,
            'title'        => 'The Gilded Pulse',
            'upc'          => '672896018379',
            'release_date' => '2026-04-23',
            'genre'        => 'Electro Deep House',
            'bpm'          => 125,
            'track_count'  => 10,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/the_gilded_pulse.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'Kinetic Soul',
                    'isrc'     => 'QT4K32605815',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Track 2_ Deep Foundation',
                    'isrc'     => 'QT4K32605816',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'The Next Phase',
                    'isrc'     => 'QT4K32605807',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Velvet Rhythm',
                    'isrc'     => 'QT4K32605808',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'Cello Momentum',
                    'isrc'     => 'QT4K32605809',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Modern Blueprint',
                    'isrc'     => 'QT4K32605810',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Steady Drive',
                    'isrc'     => 'QT4K32605811',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Rhythmic Resilience',
                    'isrc'     => 'QT4K32605812',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'Strength in Focus',
                    'isrc'     => 'QT4K32605813',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'Midnight Pulse',
                    'isrc'     => 'QT4K32605814',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1028582,
            'title'        => 'The Stabilization Frame',
            'upc'          => '0609360922221',
            'release_date' => '2026-04-16',
            'genre'        => 'Minimal Deep Tech',
            'bpm'          => 123,
            'track_count'  => 10,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/the_stabilization_frame.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'The Level Line',
                    'isrc'     => 'QT2VB2639786',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Set-Point Soul',
                    'isrc'     => 'QT2VB2639787',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'Hypertrophy in Blue',
                    'isrc'     => 'QT2VB2639788',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'The Foreman’s Evening Brief',
                    'isrc'     => 'QT2VB2639789',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => '205 on the Horizon',
                    'isrc'     => 'QT2VB2639790',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Structural Integrity',
                    'isrc'     => 'QT2VB2639791',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Sunday Plunge Blues',
                    'isrc'     => 'QT2VB2639792',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Polished Oak & Iron',
                    'isrc'     => 'QT2VB2639793',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'The 100-Calorie Drift',
                    'isrc'     => 'QT2VB2639794',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'Final Walkthrough',
                    'isrc'     => 'QT2VB2639795',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1027067,
            'title'        => 'The Blueprint Reset',
            'upc'          => '0609360888213',
            'release_date' => '2026-04-09',
            'genre'        => 'Downtempo Electronic',
            'bpm'          => 118,
            'track_count'  => 9,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/the_blueprint_reset.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'Steady Horizon',
                    'isrc'     => 'QT2VB2623140',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Deep Architecture',
                    'isrc'     => 'QT2VB2623141',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'The Daily Cadence',
                    'isrc'     => 'QT2VB2623142',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Iron Elegance',
                    'isrc'     => 'QT2VB2623143',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'Core Resonance',
                    'isrc'     => 'QT2VB2623144',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Persistent Drive',
                    'isrc'     => 'QT2VB2623145',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Structural Flow',
                    'isrc'     => 'QT2VB2623146',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Midnight Momentum',
                    'isrc'     => 'QT2VB2623147',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'Final Symmetry',
                    'isrc'     => 'QT2VB2623148',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1022794,
            'title'        => 'Structural Rhythm',
            'upc'          => '0609360860981',
            'release_date' => '2026-04-02',
            'genre'        => 'Progressive Tech House',
            'bpm'          => 124,
            'track_count'  => 10,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/structural_rhythm.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => '174 Hz Foundation & Deep Pain Relief',
                    'isrc'     => 'QT2VB2611909',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => '285 Hz Cellular Regeneration & Healing',
                    'isrc'     => 'QT2VB2611910',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => '396 Hz Release Fear & Emotional Blockages',
                    'isrc'     => 'QT2VB2611911',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => '417 Hz _ Clearing Negative Energy & Facilitating Change',
                    'isrc'     => 'QT2VB2611912',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => '528 Hz Transformation & DNA Repair',
                    'isrc'     => 'QT2VB2611913',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => '639 Hz Harmonic Relationships & Connection',
                    'isrc'     => 'QT2VB2611914',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => '741 Hz Awakening Intuition & Detoxification',
                    'isrc'     => 'QT2VB2611915',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => '852 Hz Spiritual Order & Clarity',
                    'isrc'     => 'QT2VB2611916',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => '963 Hz _ The _God Frequency_ & Pineal Activation',
                    'isrc'     => 'QT2VB2611917',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => '111 Hz _ Divine Unity & Cellular Reset',
                    'isrc'     => 'QT2VB2611918',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1009791,
            'title'        => 'The Set-Point Shift',
            'upc'          => '0609360793210',
            'release_date' => '2026-03-26',
            'genre'        => 'Body Recomposition House',
            'bpm'          => 126,
            'track_count'  => 13,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/the_set_point_shift.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'Week Zero',
                    'isrc'     => 'QZVEM2671155',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Resonant Ground',
                    'isrc'     => 'QZVEM2671156',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => '25 Weeks of Light',
                    'isrc'     => 'QZVEM2671157',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'The Morning Blitz',
                    'isrc'     => 'QZVEM2671158',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'Blueprint & Bone',
                    'isrc'     => 'QZVEM2671159',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'The Sunday Plunge',
                    'isrc'     => 'QZVEM2671160',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Phase One (The Foundation)',
                    'isrc'     => 'QZVEM2671161',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Hypertrophy (The Muscle Grind)',
                    'isrc'     => 'QZVEM2671162',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'Fresh Air & Footsteps',
                    'isrc'     => 'QZVEM2671163',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'The 205 Vision',
                    'isrc'     => 'QZVEM2671164',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 11,
                    'title'    => 'Global Frequency',
                    'isrc'     => 'QZVEM2671165',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 12,
                    'title'    => 'The Set-Point Reset',
                    'isrc'     => 'QZVEM2671166',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 13,
                    'title'    => 'The Foreman’s Briefing (Outro)',
                    'isrc'     => 'QZVEM2671167',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1005701,
            'title'        => 'Foundation & Flux',
            'upc'          => '0609360767198',
            'release_date' => '2026-03-19',
            'genre'        => 'Deep Melodic House',
            'bpm'          => 122,
            'track_count'  => 12,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/foundation_and_flux.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'The First Foundation',
                    'isrc'     => 'QZVEM2653480',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'Midnight Blueprints',
                    'isrc'     => 'QZVEM2653481',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'Stone on Stone',
                    'isrc'     => 'QZVEM2653482',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Infrastructure of Hope',
                    'isrc'     => 'QZVEM2653483',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'The Silent Forge',
                    'isrc'     => 'QZVEM2653484',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Micro-Dose Melody',
                    'isrc'     => 'QZVEM2653485',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'The Squamish Ascent',
                    'isrc'     => 'QZVEM2653486',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Iron & Grace',
                    'isrc'     => 'QZVEM2653487',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'The Weight of Discipline',
                    'isrc'     => 'QZVEM2653488',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'The Architect’s Dream',
                    'isrc'     => 'QZVEM2653489',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 11,
                    'title'    => '26 March',
                    'isrc'     => 'QZVEM2653490',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 12,
                    'title'    => 'Legacy (Until 80)',
                    'isrc'     => 'QZVEM2653491',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 1001272,
            'title'        => 'Structural Shift',
            'upc'          => '0609360743321',
            'release_date' => '2026-03-12',
            'genre'        => 'Organic Downtempo',
            'bpm'          => 116,
            'track_count'  => 12,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/structural_shift.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'First Light',
                    'isrc'     => 'QZVEM2641406',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'The Cold Entry',
                    'isrc'     => 'QZVEM2641407',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'Structural Shift',
                    'isrc'     => 'QZVEM2641408',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'February Signals',
                    'isrc'     => 'QZVEM2641409',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'Universal Blueprint',
                    'isrc'     => 'QZVEM2641410',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'The Morning March',
                    'isrc'     => 'QZVEM2641411',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Momentum',
                    'isrc'     => 'QZVEM2641412',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'Spring Horizon',
                    'isrc'     => 'QZVEM2641413',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'System Flow',
                    'isrc'     => 'QZVEM2641414',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'The Foundation',
                    'isrc'     => 'QZVEM2641415',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 11,
                    'title'    => 'The Final Millimeter',
                    'isrc'     => 'QZVEM2641416',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 12,
                    'title'    => 'Peak State',
                    'isrc'     => 'QZVEM2641417',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 993447,
            'title'        => 'Pulse of the Forge',
            'upc'          => '0609360701031',
            'release_date' => '2026-03-04',
            'genre'        => 'Heavy Industrial House',
            'bpm'          => 128,
            'track_count'  => 13,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/pulse_of_the_forge.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'THE STARTING LINE',
                    'isrc'     => 'QZVEM2620019',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'MOMENTUM',
                    'isrc'     => 'QZVEM2620020',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'IRON PULSE',
                    'isrc'     => 'QZVEM2620021',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'THE LEGACY FRAME',
                    'isrc'     => 'QZVEM2620022',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'SUB-SURFACE',
                    'isrc'     => 'QZVEM2620023',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'COLD STEEL',
                    'isrc'     => 'QZVEM2620024',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'STONE BY STONE',
                    'isrc'     => 'QZVEM2620025',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'THE TURNING POINT',
                    'isrc'     => 'QZVEM2620026',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'THE COUNTDOWN',
                    'isrc'     => 'QZVEM2620027',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'SHARPENING',
                    'isrc'     => 'QZVEM2620028',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 11,
                    'title'    => 'PEAK INTENSITY',
                    'isrc'     => 'QZVEM2620029',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 12,
                    'title'    => 'THE SHIFT',
                    'isrc'     => 'QZVEM2620030',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 13,
                    'title'    => 'MARCH 26 (THE REVEAL)',
                    'isrc'     => 'QZVEM2620031',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 981883,
            'title'        => '12 Solfeggio Protocols: Total Cellular Rebuild',
            'upc'          => '0609360632663',
            'release_date' => '2026-02-07',
            'genre'        => 'Cellular Rebuild Frequencies',
            'bpm'          => 110,
            'track_count'  => 12,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/solfeggio_protocols.jpg',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => '174Hz Foundation - Ut Queant Laxis',
                    'isrc'     => 'QZPEW2691327',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => '285Hz Reconstruction - El Na Refa Na La',
                    'isrc'     => 'QZPEW2691328',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => '396Hz Liberation - Om Mani Padme Hum',
                    'isrc'     => 'QZPEW2691329',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => '417Hz Change - Ya Tawwab',
                    'isrc'     => 'QZPEW2691330',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => '432Hz Harmony - Lokah Samastah',
                    'isrc'     => 'QZPEW2691331',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => '528Hz Transformation - Mira Gestorum',
                    'isrc'     => 'QZPEW2691332',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => '639Hz Connection - Hine Ma Tov',
                    'isrc'     => 'QZPEW2691333',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => '741Hz Detox - Namu Myoho Renge Kyo',
                    'isrc'     => 'QZPEW2691334',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => '852Hz Order - Kyrie Eleison',
                    'isrc'     => 'QZPEW2691335',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => '963Hz Divinity - Aham Brahmasmi',
                    'isrc'     => 'QZPEW2691336',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 11,
                    'title'    => '1074Hz Awareness - Tayata Om Bekanze',
                    'isrc'     => 'QZPEW2691337',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 12,
                    'title'    => '1152Hz Purification - Allah Hu',
                    'isrc'     => 'QZPEW2691338',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 965602,
            'title'        => 'BIOLOGICAL OVERDRIVE',
            'upc'          => '0609360527112',
            'release_date' => '2026-01-22',
            'genre'        => 'High-Energy Fitness Electronic',
            'bpm'          => 130,
            'track_count'  => 11,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/biological_overdrive.jpg',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'The Winter Arc',
                    'isrc'     => 'QT62W2555506',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'The Unseen',
                    'isrc'     => 'QT62W2566780',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => '9. Metabolic Fire',
                    'isrc'     => 'QT62W2596145',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => '5. The Iron Resolve',
                    'isrc'     => 'QT62W2596146',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => '11. Evergreen',
                    'isrc'     => 'QT62W2596147',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => '6. The Honest Hour',
                    'isrc'     => 'QT62W2596148',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => '3. The Unbroken Line',
                    'isrc'     => 'QT62W2596149',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => '8. The Blueprint',
                    'isrc'     => 'QT62W2596150',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => '4. The Second Wind',
                    'isrc'     => 'QT62W2596151',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => '7. The Cold Reveal',
                    'isrc'     => 'QT62W2596152',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 11,
                    'title'    => '10. frozen mirror',
                    'isrc'     => 'QT62W2596153',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 956051,
            'title'        => 'The Unseen',
            'upc'          => '0609360475222',
            'release_date' => '2026-01-10',
            'genre'        => 'Cinematic Single',
            'bpm'          => 110,
            'track_count'  => 1,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/the_unseen.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'The Unseen',
                    'isrc'     => 'QT62W2566780',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 952815,
            'title'        => 'The Winter Arc',
            'upc'          => '0609360455552',
            'release_date' => '2026-01-06',
            'genre'        => 'Winter Arc Anthem',
            'bpm'          => 128,
            'track_count'  => 1,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/the_winter_arc.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'The Winter Arc',
                    'isrc'     => 'QT62W2555506',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 939655,
            'title'        => 'Iron & Ice',
            'upc'          => '0609360358631',
            'release_date' => '2025-12-14',
            'genre'        => 'Alpine Deep House',
            'bpm'          => 124,
            'track_count'  => 13,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/iron_and_ice.jpg',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'Glacial Hymn',
                    'isrc'     => 'QT62V2592405',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'The Winter Aria',
                    'isrc'     => 'QT62V2592406',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'Frozen Momentum',
                    'isrc'     => 'QT62V2592407',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'Titan’s Stride',
                    'isrc'     => 'QT62V2592408',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'The Northern Saga',
                    'isrc'     => 'QT62V2592409',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'Frozen Fire',
                    'isrc'     => 'QT62V2592410',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Storm Runner',
                    'isrc'     => 'QT62V2592411',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'The Morning Protocol',
                    'isrc'     => 'QT62V2592412',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 9,
                    'title'    => 'Thunder in the Deep',
                    'isrc'     => 'QT62V2592413',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 10,
                    'title'    => 'Subzero Pulse',
                    'isrc'     => 'QT62V2592414',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 11,
                    'title'    => 'The Northern Fortress',
                    'isrc'     => 'QT62V2592415',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 12,
                    'title'    => 'iron Momentum',
                    'isrc'     => 'QT62V2592416',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 13,
                    'title'    => 'Highland Echo',
                    'isrc'     => 'QT62V2592417',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
        array(
            'id'           => 931397,
            'title'        => 'Keystone: The Northern Saga',
            'upc'          => '0609360356637',
            'release_date' => '2025-12-04',
            'genre'        => 'Northern Electronic Saga',
            'bpm'          => 120,
            'track_count'  => 8,
            'cover_image'  => get_stylesheet_directory_uri() . '/assets/images/albums/keystone_the_northern_saga.png',
            'spotify_url'  => 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y',
            'youtube_url'  => 'https://www.youtube.com/@KeyStoneRecomposition',
            'tracks'       => array(
                array(
                    'pos'      => 1,
                    'title'    => 'The Warrior’s Charge',
                    'isrc'     => 'QT62V2591834',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 2,
                    'title'    => 'The Forge of Iron.',
                    'isrc'     => 'QT62V2591835',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 3,
                    'title'    => 'Echoes of the Mist',
                    'isrc'     => 'QT62V2591836',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 4,
                    'title'    => 'The Turning Point',
                    'isrc'     => 'QT62V2591837',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 5,
                    'title'    => 'he Legacy We Build',
                    'isrc'     => 'QT62V2591838',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 6,
                    'title'    => 'The Unyielding Will',
                    'isrc'     => 'QT62V2591839',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 7,
                    'title'    => 'Path of the Berserker',
                    'isrc'     => 'QT62V2591840',
                    'duration' => 'PT4M15S',
                ),
                array(
                    'pos'      => 8,
                    'title'    => 'A New Dawn',
                    'isrc'     => 'QT62V2591841',
                    'duration' => 'PT4M15S',
                ),
            ),
        ),
    );

    return $albums;
}

/**
 * Retrieve album by TooLost ID.
 */
function keystone_get_album_by_id( int $id ): ?array {
    foreach ( keystone_get_all_albums() as $album ) {
        if ( (int) $album['id'] === $id ) {
            return $album;
        }
    }
    return null;
}

/**
 * Retrieve album by UPC barcode.
 */
function keystone_get_album_by_upc( string $upc ): ?array {
    foreach ( keystone_get_all_albums() as $album ) {
        if ( $album['upc'] === $upc ) {
            return $album;
        }
    }
    return null;
}

/**
 * Total count of registered tracks.
 */
function keystone_get_total_tracks_count(): int {
    $count = 0;
    foreach ( keystone_get_all_albums() as $album ) {
        $count += (int) $album['track_count'];
    }
    return $count;
}
/**
 * Dynamic Catalog Metrics & Synchronization Helper.
 * Returns exact counts across 22 official releases and 20 studio albums.
 *
 * @return array<string, mixed>
 */
function keystone_get_catalog_stats(): array {
    $albums = keystone_get_all_albums();
    $total_releases = count( $albums );
    $studio_albums  = 0;
    $singles        = 0;
    $total_tracks   = 0;

    foreach ( $albums as $album ) {
        $track_count = isset( $album['track_count'] ) ? (int) $album['track_count'] : 0;
        $total_tracks += $track_count;
        if ( $track_count <= 2 ) {
            $singles++;
        } else {
            $studio_albums++;
        }
    }

    return array(
        'total_releases' => $total_releases, // 22
        'studio_albums'  => $studio_albums,  // 20
        'singles'        => $singles,        // 2
        'total_tracks'   => $total_tracks,   // 201
        'display_label'  => $total_releases . ' Official Releases • ' . $studio_albums . ' Studio Albums',
        'short_label'    => $total_releases . ' Releases',
    );
}
