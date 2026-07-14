<?php
require_once( dirname(__FILE__) . '/../keystonerecomposition/wp-load.php' );
global $wpdb;

$post_id = 1088;
$post = $wpdb->get_row("SELECT ID, post_title, post_name, post_type, post_status, post_content FROM {$wpdb->posts} WHERE ID = $post_id");

if ($post) {
    echo "ID: " . $post->ID . "\n";
    echo "Title: " . $post->post_title . "\n";
    echo "Slug: " . $post->post_name . "\n";
    echo "Type: " . $post->post_type . "\n";
    echo "Status: " . $post->post_status . "\n";
    
    // Check post meta
    $youtube_id = get_post_meta($post_id, 'keystone_youtube_id', true);
    echo "Post Meta keystone_youtube_id: " . ($youtube_id ? $youtube_id : "empty") . "\n";
    
    // Check if watch page exists
    $watch_slug = 'watch-' . $post->post_name;
    $watch_page = get_page_by_path($watch_slug, OBJECT, 'page');
    if ($watch_page) {
        echo "Watch Page ID: " . $watch_page->ID . "\n";
        echo "Watch Page Slug: " . $watch_page->post_name . "\n";
        $watch_youtube_id = get_post_meta($watch_page->ID, 'keystone_youtube_id', true);
        echo "Watch Page Meta keystone_youtube_id: " . ($watch_youtube_id ? $watch_youtube_id : "empty") . "\n";
    } else {
        echo "No watch page found for slug: $watch_slug\n";
    }
} else {
    echo "Post 1088 not found.\n";
}
