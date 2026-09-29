<?php
/**
 * The template for displaying 404 Not Found pages (Quiet Luxury Sovereign Routing)
 *
 * @package Keystone Recomposition Child
 * @since 3.2.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div id="primary" class="content-area primary keystone-404-template" style="background: #030712; min-height: 75vh; display: flex; align-items: center; justify-content: center;">
    <main id="main" class="site-main" style="width: 100%;">
        <div class="ast-container" style="max-width: 900px; margin: 0 auto; padding: 40px 20px;">
            <section class="error-404 not-found" style="padding: 60px 24px 80px; text-align: center; background: radial-gradient(circle at 50% 20%, rgba(212, 175, 55, 0.06) 0%, rgba(3, 7, 18, 0.95) 75%); border: 1px solid rgba(212, 175, 55, 0.2); border-radius: 24px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.7);">
                
                <!-- Status Pill Badge -->
                <div class="luxury-badge-pill" style="display: inline-flex; align-items: center; gap: 10px; background: rgba(212, 175, 55, 0.08); color: #f6d365; border: 1px solid rgba(212, 175, 55, 0.35); padding: 8px 24px; border-radius: 9999px; font-size: 0.82rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 28px; box-shadow: 0 0 20px rgba(212, 175, 55, 0.12);">
                    <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #00f0ff; box-shadow: 0 0 10px #00f0ff;"></span>
                    HTTP 404 — ROUTE UNCHARTED
                </div>
                
                <!-- Headline -->
                <h1 class="page-title" style="font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(2.2rem, 4.5vw, 3.4rem); font-weight: 800; margin: 0 0 20px 0; color: #ffffff; letter-spacing: -0.025em; line-height: 1.2;">
                    The Architecture You Seek Has Moved or Never Existed
                </h1>
                
                <!-- Subtitle / Body Copy -->
                <p class="lead-text" style="font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; color: #94a3b8; font-size: 1.12rem; line-height: 1.8; margin: 0 auto 44px auto; max-width: 660px; font-weight: 300;">
                    You have arrived at an unmapped coordinate within the Keystone Recomposition infrastructure. Navigate directly to Wayne Stevenson's autonomous agent swarm protocols, stream the 18-album sonic discography, or explore the founder blueprint below.
                </p>

                <!-- Primary CTAs -->
                <div class="action-grid" style="display: flex; flex-direction: column; gap: 20px; align-items: center;">
                    <div style="display: flex; flex-wrap: wrap; gap: 16px; justify-content: center; width: 100%;">
                        <a href="/ai-protocols/" class="btn-luxury-gold" style="display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: linear-gradient(135deg, #d4af37 0%, #f6d365 50%, #aa820a 100%); color: #030712; font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.05rem; padding: 15px 34px; border-radius: 9999px; text-decoration: none; box-shadow: 0 10px 30px rgba(212, 175, 55, 0.35); transition: transform 0.2s ease, box-shadow 0.2s ease;">
                            Explore AI Protocols &amp; Swarms →
                        </a>
                        <a href="/sonic-universe/" class="btn-luxury-glass" style="display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: rgba(15, 23, 42, 0.85); color: #f8fafc; border: 1px solid rgba(212, 175, 55, 0.35); font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.05rem; padding: 15px 34px; border-radius: 9999px; text-decoration: none; backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);">
                            🎵 Stream Sonic Universe (18 Albums) →
                        </a>
                    </div>
                    
                    <!-- Secondary Navigation Links -->
                    <div style="display: flex; flex-wrap: wrap; gap: 24px; justify-content: center; margin-top: 14px; align-items: center;">
                        <a href="/about-the-founder/" style="color: #00f0ff; font-family: 'Outfit', sans-serif; font-weight: 600; text-decoration: none; font-size: 0.95rem; text-shadow: 0 0 10px rgba(0, 240, 255, 0.3);">
                            About Founder Wayne Stevenson →
                        </a>
                        <span style="color: rgba(212, 175, 55, 0.35);">•</span>
                        <a href="/" style="color: #d4af37; font-family: 'Outfit', sans-serif; font-weight: 600; text-decoration: none; font-size: 0.95rem;">
                            Return to Homepage →
                        </a>
                    </div>
                </div>

            </section>
        </div>
    </main>
</div>

<?php
get_footer();
