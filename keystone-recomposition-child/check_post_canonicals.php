<?php
/**
 * Standalone Post Meta Auditor
 */
$wp_load_path = dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php';
if ( file_exists( $wp_load_path ) ) {
    require_once( $wp_load_path );
    
    global $wpdb;
    $watch_pages = $wpdb->get_results( 
        "SELECT ID, post_title, post_name FROM $wpdb->posts 
         WHERE post_type = 'page' AND post_name LIKE 'watch-%' AND post_status = 'publish'" 
    );
    
    $report = array();
    foreach ( $watch_pages as $p ) {
        $canonical = get_post_meta( $p->ID, 'rank_math_canonical_url', true );
        $report[] = array(
            'id' => $p->ID,
            'slug' => $p->post_name,
            'title' => $p->post_title,
            'rank_math_canonical' => $canonical ? $canonical : 'Not Set'
        );
    }
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( $report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
    exit;
} else {
    echo "wp-load not found";
    exit;
}
