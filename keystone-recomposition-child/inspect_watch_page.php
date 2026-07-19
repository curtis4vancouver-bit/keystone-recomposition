<?php
/**
 * Inspect watch page configuration details
 */
$wp_load_path = dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php';
if ( file_exists( $wp_load_path ) ) {
    require_once( $wp_load_path );
    
    $slug = 'watch-fda-epitalon-ban';
    $page = get_page_by_path( $slug, OBJECT, 'page' );
    
    if ($page) {
        $meta = get_post_meta($page->ID);
        $template = get_post_meta($page->ID, '_wp_page_template', true);
        
        $report = array(
            'id' => $page->ID,
            'slug' => $page->post_name,
            'title' => $page->post_title,
            'template' => $template,
            'meta' => $meta
        );
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode( $report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
        exit;
    } else {
        echo "Page watch-fda-epitalon-ban not found";
        exit;
    }
} else {
    echo "wp-load not found";
    exit;
}
