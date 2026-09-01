<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! current_user_can( 'manage_options' ) ) {
    exit( 'Unauthorized' );
}

$post_slug = 'retatrutide-phase-3-data';
$watch_page = get_page_by_path( 'watch-' . $post_slug, OBJECT, 'page' );
if ($watch_page) {
    echo "Found watch page! ID: " . $watch_page->ID . " Slug: " . $watch_page->post_name . " Status: " . $watch_page->post_status . "\n";
} else {
    echo "Watch page watch-" . $post_slug . " NOT found via get_page_by_path.\n";
}

// Let's do a direct database query to see if it exists
global $wpdb;
$db_page = $wpdb->get_row( $wpdb->prepare( "SELECT ID, post_name, post_status FROM $wpdb->posts WHERE post_name = %s AND post_type = 'page'", 'watch-' . $post_slug ) );
if ($db_page) {
    echo "Found via direct SQL query! ID: " . $db_page->ID . " Slug: " . $db_page->post_name . " Status: " . $db_page->post_status . "\n";
} else {
    echo "NOT found via direct SQL query.\n";
}
