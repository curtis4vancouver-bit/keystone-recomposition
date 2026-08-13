<?php
require_once( dirname(__FILE__) . '/../keystonerecomposition/wp-load.php' );
global $wpdb;

$slug = 'watch-fda-peptides-bpc-157-tb-500-update-2026';
$page = get_page_by_path( $slug, OBJECT, 'page' );

if ($page) {
    echo "ID: " . $page->ID . "\n";
    echo "Title: " . $page->post_title . "\n";
    echo "Content: " . $page->post_content . "\n";
    
    // Check meta
    $meta = get_post_meta($page->ID);
    echo "Meta keys:\n";
    print_r(array_keys($meta));
} else {
    echo "Page not found for slug: $slug\n";
}
