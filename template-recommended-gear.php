<?php
/**
 * Template Name: Keystone Recommended Gear & Partner Codes
 * Description: Curated Biohacking Tools, Reconstitution Supplies, and Exclusive Partner Codes
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
                    <?php echo do_shortcode( '[keystone_gear_portal]' ); ?>
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    </main>
</div>

<?php get_footer(); ?>
