<?php
/**
 * Direct DB metadata dump for page ID 1496
 */
$wp_load_path = dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php';
if ( file_exists( $wp_load_path ) ) {
    require_once( $wp_load_path );
    
    global $wpdb;
    $page = $wpdb->get_row( "SELECT * FROM $wpdb->posts WHERE ID = 1496" );
    
    if ($page) {
        $meta = $wpdb->get_results( $wpdb->prepare("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id = %d", 1496) );
        $meta_arr = array();
        foreach ($meta as $m) {
            $meta_arr[$m->meta_key] = $m->meta_value;
        }
        
        $report = array(
            'id' => $page->ID,
            'slug' => $page->post_name,
            'title' => $page->post_title,
            'content' => $page->post_content,
            'template' => isset($meta_arr['_wp_page_template']) ? $meta_arr['_wp_page_template'] : 'default',
            'meta' => $meta_arr
        );
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
        exit;
    } else {
        echo "Page ID 1496 not found in DB";
        exit;
    }
} else {
    echo "wp-load not found";
    exit;
}
