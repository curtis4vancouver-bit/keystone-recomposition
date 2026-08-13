<?php
/**
 * Template Name: Keystone Sonic Universe
 * Description: Spotify Discography, Electronic Music OAC, and High-Energy Sound Design Hub
 * Stamped: August 2026
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div id="primary" class="content-area primary keystone-custom-template">
    <main id="main" class="site-main">
        <div class="ast-container">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content clear">
                    <?php echo do_shortcode( '[keystone_sonic_universe]' ); ?>
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    </main>
</div>

<?php get_footer(); ?>
