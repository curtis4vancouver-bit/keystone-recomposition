<?php
/**
 * The template for displaying all single posts
 * Keystone Recomposition Child Theme
 * Version: 3.0.0 (PHP 8.2+ Strict Types)
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div id="primary" class="content-area primary keystone-single-post">
    <main id="main" class="site-main">
        <div class="ast-container">

            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'luxury-article-entry' ); ?>>
                    
                    <!-- Article Header -->
                    <header class="entry-header text-center">
                        <div class="post-meta-badges">
                            <span class="gold-badge-pill">TECHNICAL PROTOCOL</span>
                            <span class="date-badge-pill"><?php echo get_the_date( 'F j, Y' ); ?></span>
                        </div>

                        <h1 class="entry-title">
                            <?php the_title(); ?>
                        </h1>

                        <div class="entry-author-byline">
                            <span class="byline-author">Architected by <strong>Wayne Stevenson</strong></span>
                            <span class="byline-divider">•</span>
                            <span class="byline-cred">BC Housing Builder #52603</span>
                            <span class="byline-divider">•</span>
                            <span class="byline-audio">Soundtrack by Keystone Recomposition</span>
                        </div>
                    </header>

                    <!-- Featured Image / Schematic -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-featured-media text-center">
                            <?php the_post_thumbnail( 'full', array( 'class' => 'featured-hero-image' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Article Body Content -->
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <!-- Post Footer & Author Card -->
                    <footer class="entry-footer">
                        <div class="author-dossier-card">
                            <div class="author-avatar-wrap">
                                <img src="https://i0.wp.com/keystonerecomposition.com/wp-content/uploads/2026/05/Man_reaching_for_pepper_grinder11_202605021316.jpeg?w=300&ssl=1" alt="Wayne Stevenson" class="author-avatar-img" />
                            </div>
                            <div class="author-dossier-info">
                                <span class="author-role-badge">FOUNDER &amp; ARCHITECT</span>
                                <h3 class="author-dossier-name">Wayne Stevenson</h3>
                                <p class="author-dossier-bio">
                                    Certified BC Housing Licensed Residential Builder (#52603), electronic music producer with 18 studio albums on TooLost, and lead architect of autonomous FastMCP swarm workstations. Operating across Squamish, Whistler, and Greater Vancouver.
                                </p>
                                <div class="author-dossier-links">
                                    <a href="/about-the-founder/" class="dossier-link">Full Founder Dossier →</a>
                                    <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener" class="dossier-link">Keystone Possibilities Ltd. →</a>
                                    <a href="/sonic-universe/" class="dossier-link">18-Album Sonic Universe →</a>
                                </div>
                            </div>
                        </div>

                        <!-- Skool $49/mo Guild Conversion Card -->
                        <div class="single-skool-card text-center">
                            <span class="skool-tag">JOIN THE GUILD</span>
                            <h3 class="skool-title">Build Autonomous Workstations with Wayne Stevenson</h3>
                            <p class="skool-desc">
                                Access production FastMCP servers, local vector brain templates, and weekly swarm drops in the Autonomous Builder Guild.
                            </p>
                            <a href="https://skool.com" target="_blank" rel="noopener" class="btn-primary-gold">
                                Join the Guild ($49/mo) →
                            </a>
                        </div>
                    </footer>

                </article>
            <?php endwhile; ?>

        </div>
    </main>
</div>

<?php get_footer(); ?>
