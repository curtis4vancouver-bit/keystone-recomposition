<?php
/**
 * Template Name: Keystone GLP-1 KwikPen Calculator
 * Description: Interactive GLP-1 Click-to-mg Math Bible & 5-Day Pharmacokinetic Half-Life Scaler
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
                    <?php echo do_shortcode( '[keystone_glp1_calculator]' ); ?>
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    </main>
</div>

<?php get_footer(); ?>
