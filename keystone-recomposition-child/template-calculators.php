<?php
/**
 * Template Name: Keystone Master Calculators Hub
 * Description: Unified High-Performance Calculators: GLP-1 KwikPen Click Scaler & FDA Category 1 Peptide Reconstitution
 * Stamped: August 2026 - Wayne Stevenson
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
                    <!-- Tab Switcher Header -->
                    <div class="calc-hub-nav" style="text-align:center; margin: 30px auto 40px auto; max-width: 600px;">
                        <span class="tool-badge" style="display:inline-block; font-size:11px; font-weight:800; letter-spacing:0.15em; color:#C4A265; text-transform:uppercase; margin-bottom:12px; background:rgba(196,162,101,0.12); padding:6px 14px; border-radius:4px; border:1px solid rgba(196,162,101,0.3);">RESEARCH PROTOCOL ENGINES</span>
                        <h1 style="font-family:'Outfit', sans-serif; font-size:clamp(24px, 4vw, 36px); font-weight:800; color:#FFFFFF; text-transform:uppercase; margin-bottom:20px; letter-spacing:0.02em;">Protocol Calculators</h1>
                        <div class="calc-tab-buttons" style="display:flex; justify-content:center; gap:12px; flex-wrap:wrap;">
                            <a href="#glp1-section" class="calc-tab-btn active" onclick="showCalcSection('glp1', event)" id="tab-btn-glp1" style="background:#C4A265; color:#000000; font-weight:800; padding:12px 24px; border-radius:6px; text-decoration:none; text-transform:uppercase; font-size:13px; letter-spacing:0.05em; transition:all 0.2s;">1. GLP-1 KwikPen Dialer</a>
                            <a href="#peptide-section" class="calc-tab-btn" onclick="showCalcSection('peptide', event)" id="tab-btn-peptide" style="background:#141414; color:#C4A265; border:1px solid rgba(196,162,101,0.4); font-weight:800; padding:12px 24px; border-radius:6px; text-decoration:none; text-transform:uppercase; font-size:13px; letter-spacing:0.05em; transition:all 0.2s;">2. Peptide Reconstitution</a>
                        </div>
                    </div>

                    <!-- Calculator Sections -->
                    <div id="calc-glp1-wrap" class="calc-view-section">
                        <?php echo do_shortcode( '[keystone_glp1_calculator]' ); ?>
                    </div>

                    <div id="calc-peptide-wrap" class="calc-view-section" style="margin-top: 50px;">
                        <?php echo do_shortcode( '[keystone_peptide_calculator]' ); ?>
                    </div>

                    <script>
                    function showCalcSection(type, e) {
                        if (e) e.preventDefault();
                        var glp1Wrap = document.getElementById('calc-glp1-wrap');
                        var pepWrap = document.getElementById('calc-peptide-wrap');
                        var glp1Btn = document.getElementById('tab-btn-glp1');
                        var pepBtn = document.getElementById('tab-btn-peptide');
                        
                        if (type === 'glp1') {
                            glp1Wrap.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            glp1Btn.style.background = '#C4A265';
                            glp1Btn.style.color = '#000000';
                            pepBtn.style.background = '#141414';
                            pepBtn.style.color = '#C4A265';
                        } else {
                            pepWrap.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            pepBtn.style.background = '#C4A265';
                            pepBtn.style.color = '#000000';
                            glp1Btn.style.background = '#141414';
                            glp1Btn.style.color = '#C4A265';
                        }
                    }
                    </script>

                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    </main>
</div>

<?php get_footer(); ?>
