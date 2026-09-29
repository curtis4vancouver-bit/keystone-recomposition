<?php
/**
 * The blog archive template for INTEL & PROTOCOLS (/intel/ or /blog/)
 * Keystone Recomposition Child Theme
 * Version: 3.0.0 (PHP 8.2+ Strict Types)
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div id="primary" class="content-area primary keystone-intel-archive">
    <main id="main" class="site-main">
        <div class="ast-container">
            
            <!-- Hero Header -->
            <header class="intel-archive-header text-center">
                <span class="gold-badge-pill">AUTONOMOUS SYSTEMS ARCHITECTURE &amp; SONIC INTELLIGENCE</span>
                <h1 class="page-title">
                    Technical Intel &amp; <span class="gold-gradient-text">Architectural Protocols</span>
                </h1>
                <p class="archive-subtitle">
                    Production FastMCP server patterns, local multi-agent swarm case studies, Chrome DevTools Protocol automation, and high-performance frequency sound design by Wayne Stevenson.
                </p>
            </header>

            <!-- Blog Posts Grid -->
            <?php if ( have_posts() ) : ?>
                <div class="intel-posts-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'intel-post-card' ); ?>>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumbnail-wrap">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'large', array( 'class' => 'post-card-thumb' ) ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="post-card-content">
                                <div class="post-meta-row">
                                    <span class="meta-date"><?php echo get_the_date( 'M j, Y' ); ?></span>
                                    <span class="meta-tag">AI &amp; ARCHITECTURE</span>
                                </div>

                                <h2 class="post-card-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <div class="post-card-excerpt">
                                    <?php echo wp_trim_words( get_the_excerpt(), 24, '...' ); ?>
                                </div>

                                <div class="post-card-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more-link">
                                        Read Technical Protocol →
                                    </a>
                                    <span class="author-name">Wayne Stevenson</span>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="intel-pagination">
                    <?php
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <div class="no-posts-found text-center">
                    <h2>Ready for Technical Drops</h2>
                    <p>New autonomous multi-agent case studies and sound design architecture entries are currently being deployed.</p>
                    <a href="/ai-protocols/" class="btn-primary-gold" style="margin-top: 20px; display: inline-block;">
                        Explore AI Protocols →
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </main>
</div>

<?php get_footer(); ?>
