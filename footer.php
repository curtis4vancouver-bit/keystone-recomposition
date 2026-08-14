<?php
/**
 * The template for displaying the footer
 * Keystone Recomposition Child Theme - Quiet Luxury Master Footer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<footer id="colophon" class="site-footer keystone-luxury-footer" style="background: #080808; border-top: 1px solid rgba(196, 162, 101, 0.25); color: #D1D5DB; padding: 60px 20px 40px 20px; font-family: 'Inter', sans-serif;">
    <div class="footer-container" style="max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column; gap: 40px; text-align: center;">

        <!-- 1. YouTube & Ecosystem Subscribe Buttons -->
        <div class="footer-cta-row" style="display: flex; justify-content: center; align-items: center; gap: 20px; flex-wrap: wrap;">
            <a href="https://www.youtube.com/@KeyStoneRecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" class="footer-pill-btn" style="display: inline-flex; align-items: center; gap: 10px; background: rgba(196, 162, 101, 0.1); border: 1px solid #C4A265; color: #FFFFFF; font-family: 'Outfit', sans-serif; font-size: 13px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; padding: 12px 28px; border-radius: 9999px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.4);">
                <span style="color: #FF0000; font-size: 14px;">▶</span> SUBSCRIBE: KEYSTONE RECOMPOSITION
            </a>
            <a href="https://www.youtube.com/@KeyStoneRecomposition" target="_blank" rel="noopener noreferrer" class="footer-pill-btn" style="display: inline-flex; align-items: center; gap: 10px; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2); color: #FFFFFF; font-family: 'Outfit', sans-serif; font-size: 13px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; padding: 12px 28px; border-radius: 9999px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.4);">
                <span style="color: #C4A265; font-size: 14px;">▶</span> OFFICIAL VIDEO PROTOCOLS
            </a>
        </div>

        <!-- 2. Founder & Human Infrastructure Statement -->
        <div class="footer-founder-card" style="background: #111111; border: 1px solid rgba(196, 162, 101, 0.15); border-radius: 16px; padding: 30px 24px; max-width: 900px; margin: 0 auto;">
            <h4 style="font-family: 'Outfit', sans-serif; font-size: 16px; font-weight: 700; color: #FFFFFF; letter-spacing: 0.06em; margin: 0 0 12px 0; text-transform: uppercase;">
                Wayne Stevenson <span style="color: #C4A265;">—</span> Metabolic Researcher &amp; Founder
            </h4>
            <p style="font-size: 14px; line-height: 1.7; color: #9CA3AF; margin: 0 auto; max-width: 780px;">
                I document the <strong style="color: #FFFFFF;">Human Infrastructure</strong> of body recomposition for the <strong style="color: #C4A265;">High-Cadence Era</strong>. No white coats, no lab theories—just an evidence-based practitioner auditing the blueprints, tracking load data, and providing real-world guidance for the 30+ demographic navigating the <strong style="color: #FFFFFF;">Metabolic Shift</strong>.
            </p>
        </div>

        <!-- 3. Medical Disclaimer Box -->
        <div class="footer-disclaimer-box" style="border: 1px solid rgba(196, 162, 101, 0.2); background: rgba(196, 162, 101, 0.03); border-radius: 12px; padding: 20px; max-width: 900px; margin: 0 auto;">
            <p style="font-size: 12px; line-height: 1.6; color: #9CA3AF; margin: 0;">
                <strong style="color: #C4A265; text-transform: uppercase; letter-spacing: 0.05em;">Medical Disclaimer:</strong> I am not a physician. Keystone Recomposition is personal documentation and clinical research synthesis for educational purposes. Information is not medical advice. Always consult your doctor before modifying any GLP-1 or peptide protocol.
            </p>
        </div>

        <!-- 4. Copyright & Sonic Universe / Sister Flagship Links -->
        <div class="footer-bottom-row" style="border-top: 1px solid rgba(255, 255, 255, 0.08); padding-top: 24px; display: flex; flex-direction: column; gap: 12px; font-size: 12px; color: #6B7280;">
            <div>
                © 2025–2026 Keystone Recomposition LTD. All Rights Reserved. • Founder: Wayne Stevenson
            </div>
            <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
                <a href="https://open.spotify.com/artist/1L9H4M7C8r4F0a8Z" target="_blank" rel="noopener noreferrer" style="color: #C4A265; text-decoration: none; font-weight: 600;">Sonic Universe: Spotify Official Artist ↗</a>
                <span style="color: #374151;">•</span>
                <a href="https://www.youtube.com/@KeyStoneRecomposition" target="_blank" rel="noopener noreferrer" style="color: #C4A265; text-decoration: none; font-weight: 600;">YouTube Channel ↗</a>
                <span style="color: #374151;">•</span>
                <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener noreferrer" style="color: #9CA3AF; text-decoration: none;">Sister Flagship: Keystone Possibilities Ltd (Custom Luxury Building) ↗</a>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
