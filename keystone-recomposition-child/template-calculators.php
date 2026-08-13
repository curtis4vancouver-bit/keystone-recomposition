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
                            <a href="#glp1-section" class="calc-tab-btn active" onclick="showCalcSection('glp1', event)" id="tab-btn-glp1" style="background:#C4A265 !important; color:#000000 !important; font-weight:800 !important; padding:12px 24px !important; border-radius:6px !important; text-decoration:none !important; text-transform:uppercase !important; font-size:13px !important; letter-spacing:0.05em !important; display:inline-block !important;">1. GLP-1 KwikPen Dialer</a>
                            <a href="#peptide-section" class="calc-tab-btn" onclick="showCalcSection('peptide', event)" id="tab-btn-peptide" style="background:#141414 !important; color:#C4A265 !important; border:1px solid rgba(196,162,101,0.4) !important; font-weight:800 !important; padding:12px 24px !important; border-radius:6px !important; text-decoration:none !important; text-transform:uppercase !important; font-size:13px !important; letter-spacing:0.05em !important; display:inline-block !important;">2. Peptide Reconstitution</a>
                        </div>
                    </div>

                    <!-- Prominent Case Study Medical Disclaimer Banner -->
                    <div style="background: rgba(196,162,101,0.08); border: 1px solid rgba(196,162,101,0.4); border-left: 4px solid #C4A265; border-radius: 8px; padding: 18px 24px; margin: 0 auto 40px auto; max-width: 900px;">
                        <h4 style="font-family:'Outfit', sans-serif; font-size: 14px; font-weight: 800; color: #C4A265; text-transform: uppercase; letter-spacing: 0.08em; margin: 0 0 8px 0; display:flex; align-items:center; gap:8px;">
                            <span>⚠️</span> PERSONAL CASE STUDY &amp; MATHEMATICAL MODELING ONLY — CONSULT YOUR LICENSED DOCTOR
                        </h4>
                        <p style="font-size: 13px; line-height: 1.6; color: #D1D5DB; margin: 0;">
                            These calculators represent <strong>observational case study data</strong> and educational pharmacokinetic mathematics compiled by Wayne Stevenson during his personal 48-lb body recomposition protocol. <strong>This tool does NOT provide medical advice, diagnosis, treatment, or prescription dosing.</strong> Counting clicks or off-label micro-dosing is not endorsed by pharmaceutical manufacturers. <strong>Always talk to your licensed medical doctor or endocrinologist before starting, modifying, or administering any medication, GLP-1 agonist, or peptide protocol.</strong>
                        </p>
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
