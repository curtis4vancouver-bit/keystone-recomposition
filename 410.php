<?php
/**
 * The template for displaying 410 Gone pages (Permanent Protocol Retirement)
 *
 * @package Keystone Recomposition Child
 * @since 3.0.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div id="primary" class="content-area primary keystone-410-template">
    <main id="main" class="site-main">
        <div class="ast-container">
            <section class="error-410 not-found text-center" style="padding: 90px 20px 120px; max-width: 820px; margin: 0 auto;">
                <div class="luxury-badge-pill" style="display: inline-block; background: rgba(212, 175, 55, 0.12); color: #f6d365; border: 1px solid rgba(212, 175, 55, 0.45); padding: 8px 22px; border-radius: 9999px; font-size: 0.85rem; font-weight: 800; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 24px; box-shadow: 0 0 20px rgba(212, 175, 55, 0.15);">
                    HTTP 410 — PROTOCOL RETIRED
                </div>
                
                <h1 class="page-title" style="font-size: 2.6rem; font-weight: 800; margin: 0 0 20px 0; color: #ffffff; letter-spacing: -0.02em; line-height: 1.25;">
                    This Protocol Has Been Permanently Retired
                </h1>
                
                <p class="lead-text" style="color: #94a3b8; font-size: 1.15rem; line-height: 1.85; margin: 0 auto 40px auto; max-width: 660px;">
                    As part of Keystone Recomposition's 2026 architectural evolution, all legacy metabolic and peptide case studies have been permanently removed from our digital index under RFC 9110. We invite you to explore our Autonomous AI Systems or stream our 22-Release Sonic Universe.
                </p>

                <div class="action-grid" style="display: flex; flex-direction: column; gap: 16px; justify-content: center; align-items: center;">
                    <div style="display: flex; flex-wrap: wrap; gap: 16px; justify-content: center;">
                        <a href="/ai-protocols/" class="btn-luxury-gold" style="display: inline-block; background: linear-gradient(135deg, #d4af37 0%, #f6d365 50%, #aa820a 100%); color: #000000; font-weight: 800; font-size: 1.05rem; padding: 16px 36px; border-radius: 9999px; text-decoration: none; box-shadow: 0 10px 25px rgba(212, 175, 55, 0.35);">
                            Explore AI Protocols &amp; Swarms →
                        </a>
                        <a href="/sonic-universe/" class="btn-luxury-glass" style="display: inline-block; background: rgba(10, 10, 10, 0.95); color: #f8fafc; border: 1px solid rgba(212, 175, 55, 0.35); font-weight: 700; font-size: 1.05rem; padding: 16px 36px; border-radius: 9999px; text-decoration: none; backdrop-filter: blur(12px);">
                            🎵 Stream Sonic Universe (22 Releases) →
                        </a>
                    </div>
                    <a href="/founder/" style="color: #00f0ff; font-weight: 600; text-decoration: none; font-size: 0.95rem; margin-top: 10px;">
                        Learn About Founder Wayne Stevenson →
                    </a>
                </div>
            </section>
        </div>
    </main>
</div>

<?php
get_footer();
