<?php
/**
 * Keystone Recomposition — Sovereign Navigation Menu, Site Identity & Page Purge Engine
 * Version: 3.2.1 (PHP 8.2+ Strict Types)
 * Author: Keystone Architecture
 * Purpose: Provisions the canonical 6-item Sovereign Nav menu into Astra's primary-menu
 *          location, guarantees clean brand titles & Rank Math SEO metadata,
 *          and permanently trashes all legacy workout/peptide pages (The Forge, Mental Strength, etc.).
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. Provision Sovereign Primary Navigation Menu
 */
function keystone_provision_sovereign_nav_menu(): array {
    if ( function_exists( 'wp_set_current_user' ) ) {
        wp_set_current_user( 1 );
    }

    $menu_name = 'Keystone Sovereign Nav';
    $menu_obj  = wp_get_nav_menu_object( $menu_name );

    if ( ! $menu_obj ) {
        $menu_id = wp_create_nav_menu( $menu_name );
        if ( is_wp_error( $menu_id ) ) {
            return array(
                'status'  => 'error',
                'message' => $menu_id->get_error_message(),
            );
        }
    } else {
        $menu_id = (int) $menu_obj->term_id;
    }

    // Canonical 8-item navigation manifest strictly conforming to Wayne Stevenson's directive:
    // Home, AI Protocols, INTEL, Sonic Universe, Investments, Lifestyle, Founder, Contact
    $desired_items = array(
        array(
            'title'  => 'Home',
            'url'    => home_url( '/' ),
            'target' => '',
        ),
        array(
            'title'  => 'AI Protocols',
            'url'    => home_url( '/ai-protocols/' ),
            'target' => '',
        ),
        array(
            'title'  => 'INTEL',
            'url'    => home_url( '/intel/' ),
            'target' => '',
        ),
        array(
            'title'  => 'Sonic Universe',
            'url'    => home_url( '/sonic-universe/' ),
            'target' => '',
        ),
        array(
            'title'  => 'Investments',
            'url'    => home_url( '/investments/' ),
            'target' => '',
        ),
        array(
            'title'  => 'Lifestyle',
            'url'    => home_url( '/lifestyle/' ),
            'target' => '',
        ),
        array(
            'title'  => 'Founder',
            'url'    => home_url( '/founder/' ),
            'target' => '',
        ),
        array(
            'title'  => 'Contact',
            'url'    => home_url( '/contact/' ),
            'target' => '',
        ),
    );

    // Audit existing menu items
    $existing_items = wp_get_nav_menu_items( $menu_id );
    $has_ai         = false;

    if ( ! empty( $existing_items ) ) {
        foreach ( $existing_items as $item ) {
            if ( stripos( (string) $item->title, 'AI Protocols' ) !== false || str_contains( (string) $item->url, 'ai-protocols' ) ) {
                $has_ai = true;
                break;
            }
        }
    }

    $needs_update = empty( $existing_items ) || ! $has_ai || count( $existing_items ) !== count( $desired_items );

    if ( $needs_update ) {
        // Purge obsolete items to maintain deterministic ordering without duplicates
        if ( ! empty( $existing_items ) ) {
            foreach ( $existing_items as $old_item ) {
                wp_delete_post( (int) $old_item->ID, true );
            }
        }

        // Insert canonical navigation items
        foreach ( $desired_items as $order => $item ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'    => $item['title'],
                'menu-item-url'      => $item['url'],
                'menu-item-target'   => $item['target'],
                'menu-item-status'   => 'publish',
                'menu-item-type'     => 'custom',
                'menu-item-position' => $order + 1,
            ) );
        }
    }

    // Assign to theme location 'primary-menu' in Astra child theme mods
    $locations = get_theme_mod( 'nav_menu_locations' );
    if ( ! is_array( $locations ) ) {
        $locations = array();
    }
    $locations['primary-menu'] = $menu_id;
    $locations['mobile_menu']  = $menu_id;
    set_theme_mod( 'nav_menu_locations', $locations );

    // Direct synchronization for parent theme 'theme_mods_astra'
    $astra_mods = get_option( 'theme_mods_astra' );
    if ( is_array( $astra_mods ) ) {
        if ( ! isset( $astra_mods['nav_menu_locations'] ) || ! is_array( $astra_mods['nav_menu_locations'] ) ) {
            $astra_mods['nav_menu_locations'] = array();
        }
        $astra_mods['nav_menu_locations']['primary-menu'] = $menu_id;
        $astra_mods['nav_menu_locations']['mobile_menu']  = $menu_id;
        update_option( 'theme_mods_astra', $astra_mods );
    }

    // Direct synchronization for child theme 'theme_mods_keystone-recomposition-child'
    $child_mods = get_option( 'theme_mods_keystone-recomposition-child' );
    if ( is_array( $child_mods ) ) {
        if ( ! isset( $child_mods['nav_menu_locations'] ) || ! is_array( $child_mods['nav_menu_locations'] ) ) {
            $child_mods['nav_menu_locations'] = array();
        }
        $child_mods['nav_menu_locations']['primary-menu'] = $menu_id;
        $child_mods['nav_menu_locations']['mobile_menu']  = $menu_id;
        update_option( 'theme_mods_keystone-recomposition-child', $child_mods );
    }

    return array(
        'status'      => 'success',
        'menu_id'     => $menu_id,
        'updated'     => $needs_update,
        'location'    => 'primary-menu',
        'items_count' => count( $desired_items ),
    );
}

/**
 * 2. Synchronize Site Identity & Sanitize Rank Math Titles
 */
function keystone_sync_sovereign_site_identity(): array {
    $changes = array();

    // 2.1 Core WordPress Identity Options
    $current_name = (string) get_option( 'blogname' );
    $desired_name = 'Keystone Recomposition';
    if ( $current_name !== $desired_name ) {
        update_option( 'blogname', $desired_name );
        $changes['blogname'] = array( 'before' => $current_name, 'after' => $desired_name );
    }

    $current_desc = (string) get_option( 'blogdescription' );
    $desired_desc = 'Autonomous AI Systems & Sonic Architecture';
    if ( $current_desc !== $desired_desc ) {
        update_option( 'blogdescription', $desired_desc );
        $changes['blogdescription'] = array( 'before' => $current_desc, 'after' => $desired_desc );
    }

    // 2.2 Rank Math Options Titles & Description ('rank_math_options_titles')
    $rm_titles = get_option( 'rank_math_options_titles' );
    if ( is_array( $rm_titles ) ) {
        $rm_modified     = false;
        $target_rm_title = 'Keystone Recomposition %sep% Autonomous AI Systems & Sonic Architecture';
        $target_rm_desc  = 'Autonomous AI Multi-Agent Swarms, FastMCP Servers, Chrome DevTools Automation, and Sovereign Electronic Music Architecture by Wayne Stevenson.';

        if ( ( $rm_titles['homepage_title'] ?? '' ) !== $target_rm_title ) {
            $changes['rank_math_homepage_title'] = array(
                'before' => $rm_titles['homepage_title'] ?? '',
                'after'  => $target_rm_title,
            );
            $rm_titles['homepage_title'] = $target_rm_title;
            $rm_modified = true;
        }

        if ( ( $rm_titles['homepage_description'] ?? '' ) !== $target_rm_desc ) {
            $changes['rank_math_homepage_description'] = array(
                'before' => $rm_titles['homepage_description'] ?? '',
                'after'  => $target_rm_desc,
            );
            $rm_titles['homepage_description'] = $target_rm_desc;
            $rm_modified = true;
        }

        // Deep scrub of legacy strings (GLP-1 Data, Peptide Data, etc.)
        $scrub_targets = array( 'GLP-1 Data', 'GLP-1', 'Peptide Data', 'Peptides', 'Mounjaro', 'Tirzepatide' );
        foreach ( $rm_titles as $key => $val ) {
            if ( is_string( $val ) ) {
                foreach ( $scrub_targets as $needle ) {
                    if ( stripos( $val, $needle ) !== false ) {
                        $rm_titles[ $key ] = str_ireplace( $needle, 'Autonomous AI Systems', $val );
                        $rm_modified = true;
                        $changes[ 'rank_math_scrub_' . $key ] = "Scrubbed $needle";
                    }
                }
            }
        }

        if ( $rm_modified ) {
            update_option( 'rank_math_options_titles', $rm_titles );
        }
    }

    // 2.3 Static Front Page Meta Sanitization
    $front_id = (int) get_option( 'page_on_front' );
    if ( $front_id > 0 ) {
        $fp_title = (string) get_post_meta( $front_id, 'rank_math_title', true );
        if ( empty( $fp_title ) || stripos( $fp_title, 'GLP-1' ) !== false ) {
            update_post_meta( $front_id, 'rank_math_title', 'Keystone Recomposition %sep% Autonomous AI Systems & Sonic Architecture' );
            $changes['front_page_rank_math_title'] = 'Sanitized';
        }

        $fp_desc = (string) get_post_meta( $front_id, 'rank_math_description', true );
        if ( empty( $fp_desc ) || stripos( $fp_desc, 'GLP-1' ) !== false ) {
            update_post_meta( $front_id, 'rank_math_description', 'Autonomous AI Multi-Agent Swarms, FastMCP Servers, Chrome DevTools Automation, and Sovereign Electronic Music Architecture by Wayne Stevenson.' );
            $changes['front_page_rank_math_description'] = 'Sanitized';
        }
    }

    // 2.4 Scrub Astra Footer HTML of any medical disclaimer
    $astra_settings = get_option( 'astra-settings' );
    if ( is_array( $astra_settings ) ) {
        $modified_settings = false;
        if ( isset( $astra_settings['footer-html-1'] ) && stripos( (string) $astra_settings['footer-html-1'], 'Medical' ) !== false ) {
            $astra_settings['footer-html-1'] = '';
            $modified_settings = true;
            $changes['astra_settings_footer_html_1'] = 'Scrubbed Medical Disclaimer';
        }
        if ( $modified_settings ) {
            update_option( 'astra-settings', $astra_settings );
        }
    }

    $astra_mods = get_option( 'theme_mods_astra' );
    if ( is_array( $astra_mods ) ) {
        $mod_changed = false;
        if ( isset( $astra_mods['footer-html-1'] ) && stripos( (string) $astra_mods['footer-html-1'], 'Medical' ) !== false ) {
            $astra_mods['footer-html-1'] = '';
            $mod_changed = true;
            $changes['theme_mods_astra_footer_html_1'] = 'Scrubbed Medical Disclaimer';
        }
        if ( $mod_changed ) {
            update_option( 'theme_mods_astra', $astra_mods );
        }
    }

    return array(
        'status'  => 'success',
        'changes' => $changes,
    );
}

/**
 * 3. Permanently Trash All Legacy Workout, Duplicate & Peptide Pages
 * Purges The Forge, Mental Strength, Recommended Gear, Global Advisory, Blueprint, Watch-* pages,
 * and duplicates (/lifestyle-2/, /about-the-founder/, /about-the-founder-the-keystone-blueprint/).
 */
function keystone_purge_all_legacy_pages(): array {
    global $wpdb;

    // Preserved slugs: strictly Wayne's core 8 sovereign canonical pages
    $preserved_page_slugs = array(
        'home',
        'ai-protocols',
        'intel',
        'sonic-universe',
        'investments',
        'lifestyle',
        'founder',
        'contact',
    );

    $front_id = (int) get_option( 'page_on_front' );
    $posts_id = (int) get_option( 'page_for_posts' );

    // Explicitly trash known duplicates and legacy drafts/clones
    $explicit_trash_slugs = array(
        'lifestyle-2',
        'about-the-founder',
        'about-the-founder-the-keystone-blueprint',
    );
    foreach ( $explicit_trash_slugs as $trash_slug ) {
        $wpdb->query( $wpdb->prepare(
            "UPDATE {$wpdb->posts} SET post_status = 'trash' WHERE post_type = 'page' AND post_name = %s",
            $trash_slug
        ) );
    }

    // Explicitly trash post-1325 if present
    $wpdb->query( "UPDATE {$wpdb->posts} SET post_status = 'trash' WHERE post_type = 'page' AND ID = 1325" );

    $pages = $wpdb->get_results(
        "SELECT ID, post_name, post_title FROM {$wpdb->posts} WHERE post_type = 'page' AND post_status = 'publish'"
    );

    $trashed = array();

    if ( $pages ) {
        foreach ( $pages as $p ) {
            $slug = strtolower( (string) $p->post_name );
            $id   = (int) $p->ID;

            if ( in_array( $slug, $preserved_page_slugs, true ) || $id === $front_id || $id === $posts_id ) {
                continue;
            }

            // Move legacy page to trash
            $wpdb->update(
                $wpdb->posts,
                array( 'post_status' => 'trash' ),
                array( 'ID' => $id )
            );
            clean_post_cache( $id );
            $trashed[] = array(
                'id'    => $id,
                'slug'  => $slug,
                'title' => $p->post_title,
            );
        }
    }

    return array(
        'status'  => 'success',
        'count'   => count( $trashed ),
        'trashed' => $trashed,
    );
}

/**
 * 3.5 Synchronize Canonical Page Titles, Rank Math SEO & High-Resolution Lead Pictures
 */
function keystone_sync_sovereign_lead_pictures_and_titles(): array {
    global $wpdb;

    $manifest = array(
        'home' => array(
            'post_id'     => (int) get_option( 'page_on_front' ) ?: 12,
            'clean_title' => 'Home',
            'asset_rel'   => 'assets/images/albums/sovereign_reverb.jpg',
            'attach_title'=> 'Keystone Sovereign Reverb — Official Artwork',
            'focus_kw'    => 'Keystone Recomposition',
            'desc'        => 'Autonomous AI Multi-Agent Swarms, FastMCP Systems, 22-Release Sonic Universe, and BC Licensed Builder #52603.',
        ),
        'ai-protocols' => array(
            'post_id'     => 2228,
            'clean_title' => 'AI Protocols',
            'asset_rel'   => 'assets/images/ai_protocols_banner.png',
            'attach_title'=> 'Keystone AI Protocols — Multi-Agent Swarms',
            'focus_kw'    => 'Keystone AI Protocols',
            'desc'        => 'Autonomous Multi-Agent Swarms, FastMCP Workstation Architecture, and Desktop Automation by Wayne Stevenson.',
        ),
        'intel' => array(
            'post_id'     => (int) get_option( 'page_for_posts' ) ?: 119,
            'clean_title' => 'INTEL',
            'asset_rel'   => 'assets/images/ai_protocols_banner.png',
            'attach_title'=> 'Keystone INTEL — Technical Research & Analysis',
            'focus_kw'    => 'Keystone Intel',
            'desc'        => 'Technical engineering intelligence, multi-agent teardowns, and sovereign systems architecture.',
        ),
        'sonic-universe' => array(
            'post_id'     => 320,
            'clean_title' => 'Sonic Universe',
            'asset_rel'   => 'assets/images/sonic_universe_banner.png',
            'attach_title'=> 'Keystone Sonic Universe — 22 Official Releases',
            'focus_kw'    => 'Keystone Sonic Universe',
            'desc'        => 'Wayne Stevenson official music catalog: 22 releases, 20 studio albums, 216 master recordings on Spotify OAC.',
        ),
        'investments' => array(
            'post_id'     => 2364,
            'clean_title' => 'Investments',
            'asset_rel'   => 'assets/images/trading_terminal_luxury.jpg',
            'attach_title'=> 'Keystone Strategic Capital & Quantitative Markets',
            'focus_kw'    => 'Keystone Investments',
            'desc'        => 'Quantitative trading intelligence (EV >= +15%), 40% Cash Fortress, BC Bill 44 infill, Mexico and EU developments.',
        ),
        'lifestyle' => array(
            'post_id'     => 2365,
            'clean_title' => 'Lifestyle',
            'asset_rel'   => 'assets/images/bc_luxury_multiplex.jpg',
            'attach_title'=> 'Keystone Sovereign Operations & Lifestyle',
            'focus_kw'    => 'Keystone Lifestyle',
            'desc'        => 'The Six Sovereign Pillars of operations: AI media pipeline, quant markets, client acquisition, BC construction, mountain living, and global infill.',
        ),
        'founder' => array(
            'post_id'     => 2363,
            'clean_title' => 'About the Founder',
            'asset_rel'   => 'assets/images/wayne_avatar.jpg',
            'attach_title'=> 'Wayne Stevenson — Founder & Managing Director',
            'focus_kw'    => 'Wayne Stevenson',
            'desc'        => 'Wayne Stevenson: Founder of Keystone Possibilities Ltd (BC Builder #52603), AI systems architect, recording artist, and high-performance builder.',
        ),
        'contact' => array(
            'post_id'     => 2367,
            'clean_title' => 'Contact',
            'asset_rel'   => 'assets/images/keystone_possibilities_crest.png',
            'attach_title'=> 'Keystone Executive Contact Gateway',
            'focus_kw'    => 'Contact Keystone',
            'desc'        => 'Direct executive consultation with Wayne Stevenson for AI workstation architecture, BC Bill 44 general contracting, and Spotify catalog rights.',
        ),
    );

    $results = array();

    foreach ( $manifest as $slug => $data ) {
        $target_id = $data['post_id'];
        $post = get_post( $target_id );
        if ( ! $post || 'page' !== $post->post_type ) {
            $found_id = (int) $wpdb->get_var( $wpdb->prepare(
                "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'page' AND post_name = %s AND post_status = 'publish' LIMIT 1",
                $slug
            ) );
            if ( $found_id > 0 ) {
                $target_id = $found_id;
                $post = get_post( $target_id );
            }
        }

        if ( ! $post ) {
            continue;
        }

        // 1. Clean Title
        if ( $post->post_title !== $data['clean_title'] ) {
            $wpdb->update(
                $wpdb->posts,
                array( 'post_title' => $data['clean_title'] ),
                array( 'ID' => $target_id )
            );
            clean_post_cache( $target_id );
        }

        // 2. Lead Picture Attachment
        $attach_id = 0;
        $filename = basename( $data['asset_rel'] );
        $existing_attach = (int) $wpdb->get_var( $wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND guid LIKE %s LIMIT 1",
            '%' . $wpdb->esc_like( $filename )
        ) );

        if ( $existing_attach > 0 ) {
            $attach_id = $existing_attach;
        } else {
            $asset_path = get_stylesheet_directory() . '/' . ltrim( $data['asset_rel'], '/' );
            if ( file_exists( $asset_path ) ) {
                $upload_dir = wp_upload_dir();
                $target_upload = $upload_dir['path'] . '/' . $filename;
                @copy( $asset_path, $target_upload );

                $filetype = wp_check_filetype( $filename, null );
                $attach_arr = array(
                    'guid'           => $upload_dir['url'] . '/' . $filename,
                    'post_mime_type' => $filetype['type'],
                    'post_title'     => $data['attach_title'],
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                );
                $new_attach_id = wp_insert_attachment( $attach_arr, $target_upload, $target_id );
                if ( ! is_wp_error( $new_attach_id ) && $new_attach_id > 0 ) {
                    if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) {
                        require_once ABSPATH . 'wp-admin/includes/image.php';
                    }
                    $attach_meta = wp_generate_attachment_metadata( $new_attach_id, $target_upload );
                    wp_update_attachment_metadata( $new_attach_id, $attach_meta );
                    $attach_id = (int) $new_attach_id;
                }
            }
        }

        if ( $attach_id > 0 ) {
            update_post_meta( $target_id, '_thumbnail_id', $attach_id );
            $attach_url = wp_get_attachment_url( $attach_id );
            if ( $attach_url ) {
                update_post_meta( $target_id, 'rank_math_facebook_image', $attach_url );
                update_post_meta( $target_id, 'rank_math_twitter_image', $attach_url );
            }
        }

        // 3. Rank Math SEO Metadata
        update_post_meta( $target_id, 'rank_math_title', $data['clean_title'] . ' %sep% %sitename%' );
        update_post_meta( $target_id, 'rank_math_description', $data['desc'] );
        update_post_meta( $target_id, 'rank_math_focus_keyword', $data['focus_kw'] );

        $results[ $slug ] = array(
            'id'           => $target_id,
            'title'        => $data['clean_title'],
            'thumbnail_id' => $attach_id,
        );
    }

    return $results;
}

/**
 * 4. Guarantee Sovereign Navigation Menu rendering across all Astra menu locations
 */
add_filter( 'wp_nav_menu_items', 'keystone_filter_sovereign_nav_menu_items', 10, 2 );
function keystone_filter_sovereign_nav_menu_items( string $items, $args ): string {
    if ( ! str_contains( $items, 'ai-protocols' ) && ! str_contains( $items, 'AI Protocols' ) ) {
        $ai_item  = '<li class="menu-item menu-item-type-custom"><a href="' . esc_url( home_url( '/ai-protocols/' ) ) . '" class="menu-link"><span class="menu-text">AI Protocols</span></a></li>';
        
        $first_close = strpos( $items, '</li>' );
        if ( $first_close !== false ) {
            $items = substr_replace( $items, '</li>' . $ai_item, $first_close, 5 );
        } else {
            $items = $ai_item . $items;
        }
    }
    return $items;
}

/**
 * 5. Automatic Hook Execution on 'init' (Priority 15)
 */
add_action( 'init', 'keystone_run_sovereign_nav_and_options_sync', 15 );
function keystone_run_sovereign_nav_and_options_sync(): void {
    $manual_trigger = isset( $_GET['keystone_sync_sovereign'] );
    $synced_flag    = get_option( 'keystone_sovereign_nav_synced_v3_7_lead_pictures' );

    if ( ! $synced_flag || $manual_trigger ) {
        $nav_res      = keystone_provision_sovereign_nav_menu();
        $identity_res = keystone_sync_sovereign_site_identity();
        $purge_res    = keystone_purge_all_legacy_pages();
        $media_res    = keystone_sync_sovereign_lead_pictures_and_titles();

        update_option( 'keystone_sovereign_nav_synced_v3_7_lead_pictures', '1' );

        if ( $manual_trigger ) {
            header( 'Content-Type: application/json; charset=utf-8' );
            echo wp_json_encode( array(
                'navigation' => $nav_res,
                'identity'   => $identity_res,
                'page_purge' => $purge_res,
                'lead_media' => $media_res,
            ), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
            exit;
        }
    }
}
