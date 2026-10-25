<?php
/**
 * The template for displaying all single posts
 * Keystone Recomposition Child Theme
 * Version: 4.6.0 (PHP 8.2+ Strict Types)
 *
 * Ensures:
 * - Long-form 16:9 YouTube video is cleanly framed at the top of the post
 * - Short-form 9:16 YouTube video is cleanly framed in a true 9:16 vertical player at the bottom (#field-companion-short)
 * - Pure-black (#04070d) buttons with pulsating Blue/Gold word wave on hover
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div id="primary" class="content-area primary keystone-single-post">
    <main id="main" class="site-main">
        <div class="ast-container">

            <?php
            while ( have_posts() ) :
                the_post();
                $raw_post_content      = get_the_content();
                $has_custom_hero_h1    = ( stripos( $raw_post_content, '<h1' ) !== false );
                $has_inline_hero_media = ( stripos( $raw_post_content, '<iframe' ) !== false || stripos( $raw_post_content, '<img' ) !== false );
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'luxury-article-entry' ); ?>>
                    
                    <?php if ( ! $has_custom_hero_h1 ) : ?>
                        <!-- Article Header -->
                        <header class="entry-header text-center">
                            <div class="post-meta-badges" style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; margin-bottom: 14px;">
                                <span class="gold-badge-pill ks-p3-pill-gold" style="padding: 5px 14px; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.08em;">
                                    <span class="ks-wave-text">TECHNICAL BRIEFING</span>
                                </span>
                                <span class="date-badge-pill ks-p3-pill-blue" style="padding: 5px 14px; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.06em;">
                                    <span class="ks-wave-text"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></span>
                                </span>
                            </div>

                            <h1 class="entry-title">
                                <?php the_title(); ?>
                            </h1>

                            <div class="entry-author-byline">
                                <span class="byline-author">Architected by <strong>Wayne Stevenson</strong></span>
                                <span class="byline-divider">&bull;</span>
                                <span class="byline-cred">BC Housing Builder #52603</span>
                                <span class="byline-divider">&bull;</span>
                                <span class="byline-audio">Soundtrack by Keystone Recomposition</span>
                            </div>
                        </header>
                    <?php endif; ?>

                    <!-- Featured Image / Schematic (Suppressed if post already embeds inline hero media) -->
                    <?php if ( has_post_thumbnail() && ! $has_inline_hero_media ) : ?>
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
                        <div class="author-dossier-card" style="background: #04070d; border: 1.5px solid rgba(56, 189, 248, 0.45); border-radius: 20px; padding: 28px; margin-top: 36px; box-shadow: 0 18px 42px rgba(0, 0, 0, 0.85);">
                            <div class="author-avatar-wrap">
                                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/wayne_avatar.jpg' ); ?>" alt="Wayne Stevenson" class="author-avatar-img" style="border: 2px solid #d4af37;" />
                            </div>
                            <div class="author-dossier-info">
                                <div class="author-badge-row" style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 10px;">
                                    <span class="author-role-badge ks-p3-pill-gold" style="padding: 4px 12px; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">
                                        <span class="ks-wave-text">FOUNDER &amp; ARCHITECT</span>
                                    </span>
                                    <span class="author-badge-pill ks-p3-pill-blue" style="padding: 4px 12px; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">
                                        <span class="ks-wave-text">BC BUILDER #52603</span>
                                    </span>
                                </div>
                                <h3 class="author-dossier-name" style="color: #ffffff; font-family: 'Outfit', sans-serif; font-weight: 800;">Wayne Stevenson</h3>
                                <p class="author-dossier-bio" style="color: #cbd5e1; line-height: 1.65;">
                                    Certified BC Housing Licensed Residential Builder (#52603), electronic music producer with 22 official releases on Too Lost, and lead architect of autonomous multi-agent desktop workstations. Operating across Squamish, Whistler, and Greater Vancouver.
                                </p>
                                <div class="author-dossier-links" style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 16px;">
                                    <a href="<?php echo esc_url( home_url( '/founder/' ) ); ?>" class="dossier-link ks-p3-btn-blue" style="padding: 9px 18px; font-size: 0.78rem; font-weight: 800; text-decoration: none;">
                                        <span class="ks-wave-text">Full Founder Dossier &rarr;</span>
                                    </a>
                                    <a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="dossier-link ks-p3-btn-gold" style="padding: 9px 18px; font-size: 0.78rem; font-weight: 800; text-decoration: none;">
                                        <span class="ks-wave-text">Explore AI Protocols &rarr;</span>
                                    </a>
                                    <a href="<?php echo esc_url( home_url( '/sonic-universe/' ) ); ?>" class="dossier-link ks-p3-btn-blue" style="padding: 9px 18px; font-size: 0.78rem; font-weight: 800; text-decoration: none;">
                                        <span class="ks-wave-text">22-Release Sonic Universe &rarr;</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Sovereign AI Protocols & Archive Conversion Card -->
                        <div class="single-skool-card text-center" style="background: linear-gradient(145deg, rgba(8, 13, 24, 0.96) 0%, #04070d 100%); border: 1.5px solid rgba(212, 175, 55, 0.58); border-radius: 20px; padding: 32px 28px; margin-top: 28px; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.85);">
                            <span class="skool-tag ks-p3-pill-gold" style="padding: 5px 14px; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.08em; margin-bottom: 14px;">
                                <span class="ks-wave-text">// KEYSTONE AI PROTOCOLS &amp; WORKSTATIONS</span>
                            </span>
                            <h3 class="skool-title" style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.55rem; font-weight: 900; margin: 12px 0 10px 0;">
                                Deploy Autonomous Multi-Agent Systems with Wayne Stevenson
                            </h3>
                            <p class="skool-desc" style="color: #cbd5e1; max-width: 720px; margin: 0 auto 22px auto; line-height: 1.65;">
                                Explore our one-time setup blueprints for Google Flow, multi-agent websites, and custom Tauri desktop command centers — engineered with guided onboarding and zero monthly subscription lock-in.
                            </p>
                            <div style="display: flex; justify-content: center; gap: 14px; flex-wrap: wrap;">
                                <a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="ks-p3-btn-gold" style="min-height: 46px; padding: 0 24px; font-family: 'Outfit', sans-serif; font-size: 0.84rem; font-weight: 800; letter-spacing: 0.05em; text-transform: uppercase; text-decoration: none;">
                                    <span class="ks-wave-text">Explore AI Protocols &rarr;</span>
                                </a>
                                <a href="<?php echo esc_url( home_url( '/intel-videos/' ) ); ?>" class="ks-p3-btn-blue" style="min-height: 46px; padding: 0 24px; font-family: 'Outfit', sans-serif; font-size: 0.84rem; font-weight: 800; letter-spacing: 0.05em; text-transform: uppercase; text-decoration: none;">
                                    <span class="ks-wave-text">&larr; Back to Intel &amp; Videos</span>
                                </a>
                            </div>
                        </div>
                    </footer>

                </article>
            <?php endwhile; ?>

        </div>
    </main>
</div>

<script id="keystone-single-post-video-normalizer">
document.addEventListener('DOMContentLoaded', function() {
    var entry = document.querySelector('body.single-post .entry-content');
    if (!entry) return;

    // 1. Ensure top Long-Form 16:9 YouTube embed is cleanly framed in 16:9 widescreen
    var topEmbeds = entry.querySelectorAll('.watch-theater-embed, figure.wp-block-embed-youtube:first-of-type');
    topEmbeds.forEach(function(fig) {
        if (fig.closest('#field-companion-short')) return;
        fig.classList.add('ks-single-long-video-frame');
    });

    // 2. Ensure bottom #field-companion-short (or 9:16 Short section) always displays a live 9:16 vertical player (315x560)
    var shortContainer = document.getElementById('field-companion-short');
    if (shortContainer) {
        var shortWrap = shortContainer.tagName === 'H2' ? shortContainer.nextElementSibling : shortContainer;
        if (shortWrap) {
            // Find the short ID from any /shorts/ link or embed inside shortWrap
            var shortId = null;
            var shortAnchor = shortWrap.querySelector('a[href*="/shorts/"]');
            if (shortAnchor) {
                var m = shortAnchor.href.match(/\/shorts\/([a-zA-Z0-9_-]{11})/);
                if (m && m[1]) shortId = m[1];
            }
            var existingIframe = shortWrap.querySelector('iframe');
            if (!shortId && existingIframe && existingIframe.src) {
                var m2 = existingIframe.src.match(/embed\/([a-zA-Z0-9_-]{11})/);
                if (m2 && m2[1]) shortId = m2[1];
            }
            // Find the 315px right-hand column inside the Short deck
            var rightCol = shortWrap.querySelector('div[style*="315px"]');
            if (rightCol && shortId) {
                rightCol.innerHTML = '<div class="ks-single-short-9x16-frame"><iframe src="https://www.youtube.com/embed/' + shortId + '?rel=0" title="9:16 Companion Short" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>';
            }
        }
    }

    // 3. Upgrade inline CTA buttons inside single post content to Pure-Black (#04070d) + Blue/Gold Pulsating Wave
    var inlineLinks = entry.querySelectorAll('a[style*="border-radius"]');
    inlineLinks.forEach(function(a) {
        var st = (a.getAttribute('style') || '').toLowerCase();
        var isGold = st.indexOf('d4af37') !== -1 || st.indexOf('f6d365') !== -1 || st.indexOf('f59e0b') !== -1;
        a.classList.add(isGold ? 'ks-p3-btn-gold' : 'ks-p3-btn-blue');
        a.style.padding = '10px 20px';
        a.style.textDecoration = 'none';
        if (!a.querySelector('.ks-wave-text')) {
            var sp = document.createElement('span');
            sp.className = 'ks-wave-text';
            while (a.firstChild) {
                sp.appendChild(a.firstChild);
            }
            a.appendChild(sp);
        }
    });
});
</script>

<?php get_footer(); ?>
