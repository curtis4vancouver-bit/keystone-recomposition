<?php
/**
 * The blog archive template for INTEL (/intel/)
 * Keystone Recomposition Child Theme
 */

get_header(); ?>

<div id="primary" class="content-area primary" style="background: #0A0A0A; min-height: 100vh; padding: 60px 20px;">
    <main id="main" class="site-main" style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Hero Header -->
        <header class="intel-archive-header" style="text-align: center; margin-bottom: 50px;">
            <span class="tool-badge" style="display: inline-block; font-size: 11px; font-weight: 700; color: #C4A265; text-transform: uppercase; letter-spacing: 0.15em; border: 1px solid rgba(196, 162, 101, 0.3); padding: 6px 16px; border-radius: 9999px; margin-bottom: 16px; background: rgba(196, 162, 101, 0.05);">PEER-REVIEWED CLINICAL RESEARCH &amp; BIO-ARCHITECTURAL PROTOCOLS</span>
            <h1 class="page-title" style="font-family: 'Outfit', sans-serif; font-size: clamp(2rem, 5vw, 3.2rem); font-weight: 800; color: #FFFFFF; letter-spacing: 0.04em; text-transform: uppercase; margin: 0 0 16px 0;">INTEL &amp; PROTOCOLS</h1>
            <p style="font-size: 16px; color: #9CA3AF; max-width: 720px; margin: 0 auto; line-height: 1.6;">
                Real-world observational case studies, GLP-1 pharmacokinetic modeling, and peptide science compiled by Wayne Stevenson during his 48-lb body recomposition.
            </p>
        </header>

        <!-- Blog Posts Grid -->
        <?php if ( have_posts() ) : ?>
            <div class="intel-posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px; margin-bottom: 50px;">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'intel-post-card' ); ?> style="background: #111111; border: 1px solid rgba(196, 162, 101, 0.2); border-radius: 12px; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;">
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail-wrap" style="position: relative; overflow: hidden; max-height: 220px;">
                                <a href="<?php the_permalink(); ?>" style="display: block;">
                                    <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: 220px; object-fit: cover; transition: transform 0.4s ease;' ) ); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="post-card-content" style="padding: 24px; display: flex; flex-direction: column; flex-grow: 1;">
                            <div class="post-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; font-size: 12px; color: #C4A265; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em;">
                                <span><?php echo get_the_date( 'M j, Y' ); ?></span>
                                <span>PROTOCOL INTEL</span>
                            </div>

                            <h2 class="post-card-title" style="font-family: 'Outfit', sans-serif; font-size: 19px; font-weight: 700; line-height: 1.4; margin: 0 0 14px 0;">
                                <a href="<?php the_permalink(); ?>" style="color: #FFFFFF; text-decoration: none; transition: color 0.2s ease;">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <div class="post-card-excerpt" style="color: #9CA3AF; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                                <?php echo wp_trim_words( get_the_excerpt(), 22, '...' ); ?>
                            </div>

                            <div class="post-card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.08); padding-top: 16px; display: flex; justify-content: space-between; align-items: center;">
                                <a href="<?php the_permalink(); ?>" class="read-more-link" style="color: #C4A265; font-weight: 700; font-size: 13px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.06em; display: inline-flex; align-items: center; gap: 6px;">
                                    Read Protocol <span>→</span>
                                </a>
                                <span style="font-size: 11px; color: #6B7280;">Wayne Stevenson</span>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="intel-pagination" style="text-align: center; margin-top: 40px;">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '← Previous', 'keystone' ),
                    'next_text' => __( 'Next →', 'keystone' ),
                ) );
                ?>
            </div>

        <?php else : ?>
            <div class="no-posts-found" style="text-align: center; padding: 60px 20px; background: #111; border: 1px solid rgba(196,162,101,0.2); border-radius: 12px;">
                <h2 style="color: #FFF; font-family: 'Outfit', sans-serif;">No Intel Protocols Found</h2>
                <p style="color: #9CA3AF;">New case studies and biological research entries are published weekly.</p>
            </div>
        <?php endif; ?>

    </main>
</div>

<?php get_footer(); ?>
