<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! current_user_can( 'manage_options' ) ) {
    exit( 'Unauthorized' );
}

/**
 * Standalone WordPress Post Auditor
 */

global $wpdb;
$posts = $wpdb->get_results( 
    "SELECT ID, post_title, post_name, post_date, post_content 
     FROM $wpdb->posts 
     WHERE post_type = 'post' AND post_status = 'publish' 
     ORDER BY post_date DESC" 
);

$report = array();
if ( $posts ) {
    foreach ( $posts as $p ) {
        // Find if there is a youtube video embedded
        $youtube_id = '';
        if ( preg_match( '~(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/|youtube\.com/shorts/)([^"&?/ ]{11})~i', $p->post_content, $matches ) ) {
            $youtube_id = $matches[1];
        }
        
        $report[] = array(
            'id' => $p->ID,
            'title' => $p->post_title,
            'slug' => $p->post_name,
            'date' => $p->post_date,
            'youtube_id' => $youtube_id,
            'length' => strlen( $p->post_content ),
            'snippet' => wp_html_excerpt( wp_strip_all_tags( strip_shortcodes( $p->post_content ) ), 200, '...' )
        );
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode( $report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
exit;
