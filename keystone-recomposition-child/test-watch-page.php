<?php
require_once( dirname(__FILE__) . '/../keystonerecomposition/wp-load.php' );

$slug = 'watch-fighting-glp-1-fatigue-my-personal-otc-energy-stack-recovery-case-study';
$page = get_page_by_path( $slug, OBJECT, 'page' );

if ( ! $page ) {
    echo "Page not found for slug: $slug\n";
    exit;
}

echo "Page ID: " . $page->ID . "\n";
echo "Page Title: " . $page->post_title . "\n";
echo "Page Content: " . substr($page->post_content, 0, 300) . "...\n";

// Let's test the functions on this page object
global $post;
$post = $page;

$youtube_id = get_post_meta( $post->ID, 'keystone_youtube_id', true );
echo "Direct Post Meta youtube_id: " . ($youtube_id ? $youtube_id : "empty") . "\n";

$youtube_id_fallback = '';
if ( preg_match( '~\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']~i', $post->post_content, $m ) ) {
    $youtube_id_fallback = $m[1];
}
echo "Regex fallback youtube_id: " . ($youtube_id_fallback ? $youtube_id_fallback : "empty") . "\n";

// Check if is_singular('post') or is_singular('page') matches
echo "is_singular('post'): " . (is_singular('post') ? "true" : "false") . "\n";
echo "is_singular('page'): " . (is_singular('page') ? "true" : "false") . "\n";
$is_watch_page = ( 'page' === $post->post_type && 0 === strpos( $post->post_name, 'watch-' ) );
echo "is_watch_page: " . ($is_watch_page ? "true" : "false") . "\n";
