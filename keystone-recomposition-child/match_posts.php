<?php
/**
 * Match Posts and Watch Pages Diagnostic Tool
 */
$wp_load_path = dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php';
if ( file_exists( $wp_load_path ) ) {
    require_once( $wp_load_path );
    
    global $wpdb;
    
    // Fetch all published posts
    $posts = $wpdb->get_results(
        "SELECT ID, post_title, post_name FROM $wpdb->posts 
         WHERE post_type = 'post' AND post_status = 'publish' 
         ORDER BY post_date DESC"
    );
    
    // Fetch all published watch pages
    $watch_pages = $wpdb->get_results(
        "SELECT ID, post_title, post_name FROM $wpdb->posts 
         WHERE post_type = 'page' AND post_status = 'publish' AND post_name LIKE 'watch-%'"
    );
    
    $watch_slugs = array();
    foreach ( $watch_pages as $wp ) {
        $watch_slugs[$wp->post_name] = $wp;
    }
    
    $report = array();
    foreach ( $posts as $p ) {
        // Try to find matching watch page slug
        $expected_watch_slug = 'watch-' . $p->post_name;
        
        // Handle potential slug variations/truncations if any
        $has_watch_page = false;
        $matched_slug = '';
        $watch_page_id = 0;
        
        if ( isset( $watch_slugs[$expected_watch_slug] ) ) {
            $has_watch_page = true;
            $matched_slug = $expected_watch_slug;
            $watch_page_id = $watch_slugs[$expected_watch_slug]->ID;
        } else {
            // Check for loose match
            foreach ( $watch_slugs as $slug => $wp_obj ) {
                if ( strpos( $slug, $p->post_name ) !== false || strpos( $p->post_name, str_replace('watch-', '', $slug) ) !== false ) {
                    $has_watch_page = true;
                    $matched_slug = $slug;
                    $watch_page_id = $wp_obj->ID;
                    break;
                }
            }
        }
        
        // Check if video meta exists on the post
        $youtube_id = get_post_meta( $p->ID, 'keystone_youtube_id', true );
        $video_url = get_post_meta( $p->ID, 'video_url', true );
        
        $report[] = array(
            'post_id' => $p->ID,
            'post_slug' => $p->post_name,
            'post_title' => $p->post_title,
            'youtube_id' => $youtube_id ? $youtube_id : ($video_url ? $video_url : 'None'),
            'has_watch_page' => $has_watch_page,
            'watch_page_slug' => $matched_slug ? $matched_slug : 'MISSING',
            'watch_page_id' => $watch_page_id
        );
    }
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( $report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
    exit;
} else {
    echo "wp-load not found";
    exit;
}
