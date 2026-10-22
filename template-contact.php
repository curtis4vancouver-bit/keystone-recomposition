<?php
/**
 * Template Name: Keystone Contact
 * Description: Executive Consultation, General Contracting BC #52603 & Spotify Artist Portal
 * Version: 3.7.0 (High-End Dark Quiet Luxury Edition)
 * Stamped: September 2026
 *
 * @package KeystoneRecompositionChild
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$feedback_status = null;
$feedback_message = '';

// Handle Direct Inquiry Form Submission
if ( 'POST' === ( $_SERVER['REQUEST_METHOD'] ?? '' ) && isset( $_POST['keystone_contact_submitted'] ) ) {
    $nonce = $_POST['keystone_contact_nonce'] ?? '';
    if ( ! wp_verify_nonce( (string) $nonce, 'keystone_contact_action' ) ) {
        $feedback_status = 'error';
        $feedback_message = 'Security validation failed. Please refresh the page and try again.';
    } else {
        $name     = sanitize_text_field( $_POST['contact_name'] ?? '' );
        $email    = sanitize_email( $_POST['contact_email'] ?? '' );
        $category = sanitize_text_field( $_POST['contact_category'] ?? '' );
        $budget   = sanitize_text_field( $_POST['contact_budget'] ?? '' );
        $details  = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

        if ( empty( $name ) || empty( $email ) || empty( $details ) ) {
            $feedback_status = 'error';
            $feedback_message = 'Please provide your name, valid email address, and a project overview.';
        } else {
            $to = 'keystonerecomposition@gmail.com';
            $subject = '[Keystone Recomposition Inquiry] ' . ( $category ? $category : 'Executive Consultation' ) . ' - ' . $name;
            $body = "Name: {$name}\n";
            $body .= "Email: {$email}\n";
            $body .= "Category: {$category}\n";
            $body .= "Budget/Scale: {$budget}\n\n";
            $body .= "Project Overview:\n{$details}\n\n";
            $body .= "---\nSent from keystonerecomposition.com/contact/ on " . gmdate( 'Y-m-d H:i:s' ) . " UTC\n";

            $headers = [
                'Content-Type: text/plain; charset=UTF-8',
                'From: Keystone Recomposition <contact@keystonerecomposition.com>',
                'Reply-To: ' . $name . ' <' . $email . '>',
            ];

            // Send notification
            $mail_sent = wp_mail( $to, $subject, $body, $headers );
            
            // Also write to inquiries log if directory exists
            $log_dir = get_stylesheet_directory() . '/logs';
            if ( ! is_dir( $log_dir ) ) {
                @mkdir( $log_dir, 0755, true );
            }
            if ( is_dir( $log_dir ) ) {
                $log_line = sprintf( "[%s] [%s] %s <%s> - %s\n", gmdate( 'Y-m-d H:i:s' ), $category, $name, $email, $budget );
                @file_put_contents( $log_dir . '/inquiries.log', $log_line, FILE_APPEND | LOCK_EX );
            }

            $feedback_status = 'success';
            $feedback_message = 'Thank you, ' . esc_html( $name ) . '. Your inquiry has been routed directly to Wayne Stevenson (keystonerecomposition@gmail.com). You will receive a response within 24–48 hours.';
        }
    }
}

get_header();

$theme_uri = get_stylesheet_directory_uri();
?>

<div id="primary" class="content-area primary keystone-contact-page">
    <main id="main" class="site-main">
        <div class="ast-container">

            <article class="contact-master-article">
                
                <!-- 1. HERO HEADER -->
                <header class="contact-hero-header text-center">
                    <div class="hero-badge-row">
                        <span class="gold-badge-pill">DIRECT ENGAGEMENT</span>
                        <span class="license-badge-pill">BC HOUSING LICENSED BUILDER #52603</span>
                        <span class="music-badge-pill">24&ndash;48H EXECUTIVE SLA</span>
                    </div>

                    <h1 class="contact-main-title">
                        Executive Inquiries &amp;<br>
                        <span class="cyan-gold-gradient-text">Private Consultations</span>
                    </h1>

                    <p class="contact-hero-subtitle">
                        Direct builder-to-client consultations for sovereign AI workstation architecture, custom enterprise 28-agent FastMCP swarm buildouts ($3,500&ndash;$7,500), and 432Hz commercial music sync licensing.
                    </p>
                </header>

                <!-- 2. THREE PRIMARY ENGAGEMENT CHANNELS -->
                <section class="contact-channels-section">
                    <div class="contact-channels-grid">
                        
                        <!-- CHANNEL 1: SPOTIFY OFFICIAL ARTIST CHANNEL -->
                        <div class="contact-channel-card">
                            <div class="channel-card-top">
                                <span class="channel-tag-gold">SPOTIFY ARTIST</span>
                                <span class="channel-icon">🎵</span>
                            </div>
                            <h3 class="channel-title">Spotify Official Artist Channel</h3>
                            <p class="channel-desc">
                                Stream Wayne Stevenson's catalog of 22 official releases (20 studio albums) and 216 verified recordings distributed worldwide via TooLost Digital on Spotify. High-fidelity ambient, deep house, and electronic architecture.
                            </p>
                            <ul class="channel-features">
                                <li>&bull; 22 Official Releases &amp; 216 Master Recordings</li>
                                <li>&bull; Spotify Verified Official Artist Channel</li>
                                <li>&bull; Direct-to-Creator 432Hz Commercial Sync Licensing</li>
                            </ul>
                            <div class="channel-action">
                                <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener" class="channel-btn-gold">Stream on Spotify &nearr;</a>
                            </div>
                        </div>

                        <!-- CHANNEL 2: CUSTOM ENTERPRISE AI WORKSTATION & SWARM BUILDOUT -->
                        <div class="contact-channel-card">
                            <div class="channel-card-top">
                                <span class="channel-tag-cyan">$3,500&ndash;$7,500 ENTERPRISE</span>
                                <span class="channel-icon">🤖</span>
                            </div>
                            <h3 class="channel-title">Custom Enterprise AI Workstation &amp; Swarm Buildout</h3>
                            <p class="channel-desc">
                                Turnkey enterprise deployment of custom Tauri HUDs, 28-agent FastMCP tool servers, Chrome CDP Port 9222 automation engines, and direct-to-creator 432Hz commercial music sync licensing.
                            </p>
                            <ul class="channel-features">
                                <li>&bull; $3,500&ndash;$7,500 Custom Enterprise Swarm Buildouts</li>
                                <li>&bull; 28-Agent FastMCP &amp; Local Daemon Engineering</li>
                                <li>&bull; 432Hz Commercial Music Sync Licensing (216 ISRCs)</li>
                            </ul>
                            <div class="channel-action">
                                <a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="channel-btn-cyan">Explore AI Protocols &amp; Vault &rarr;</a>
                            </div>
                        </div>

                        <!-- CHANNEL 3: EXECUTIVE WORKSTATION MASTERCLASS -->
                        <div class="contact-channel-card">
                            <div class="channel-card-top">
                                <span class="channel-tag-gold">$800 MASTERCLASS</span>
                                <span class="channel-icon">⚡</span>
                            </div>
                            <h3 class="channel-title">Executive Workstation Architecture</h3>
                            <p class="channel-desc">
                                Bespoke 1-on-1 architecture consultation with Wayne Stevenson. Full deployment of custom Tauri sovereign workstation, 28-agent FastMCP swarms, and Chrome CDP automated production pipelines.
                            </p>
                            <ul class="channel-features">
                                <li>&bull; 1-on-1 Screen-to-Screen Blueprint Walkthrough</li>
                                <li>&bull; Complete Local-First Codebase &amp; Tools Provided</li>
                                <li>&bull; Zero-Cloud SaaS Dependency Configuration</li>
                            </ul>
                            <div class="channel-action">
                                <a href="#inquiry-form" class="channel-btn-gold">Book $800 Masterclass &darr;</a>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- 3. DARK LUXURY INQUIRY FORM -->
                <section class="contact-form-section" id="inquiry-form">
                    <div class="contact-form-glass-card">
                        
                        <div class="form-header text-center">
                            <span class="section-tag-cyan">DIRECT SUBMISSION PORTAL</span>
                            <h2 class="form-title">Submit an Executive Inquiry</h2>
                            <p class="form-subtitle">
                                Complete the parameters below. Qualified inquiries receive a comprehensive response within 24&ndash;48 hours.
                            </p>
                        </div>

                        <?php if ( ! empty( $feedback_status ) ) : ?>
                            <div class="form-feedback-alert <?php echo 'success' === $feedback_status ? 'alert-success' : 'alert-error'; ?>" role="alert">
                                <div class="feedback-icon"><?php echo 'success' === $feedback_status ? '✅' : '⚠️'; ?></div>
                                <div class="feedback-text"><?php echo esc_html( $feedback_message ); ?></div>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo esc_url( get_permalink() ); ?>" method="POST" class="luxury-inquiry-form">
                            <?php wp_nonce_field( 'keystone_contact_action', 'keystone_contact_nonce' ); ?>
                            <input type="hidden" name="keystone_contact_submitted" value="1">

                            <!-- Row 1: Name and Email -->
                            <div class="form-grid-two">
                                <div class="form-field-group">
                                    <label for="contact_name" class="luxury-form-label">Full Name <span class="required-asterisk">*</span></label>
                                    <input type="text" id="contact_name" name="contact_name" required 
                                           placeholder="e.g. Marcus Vance" class="luxury-form-input">
                                </div>

                                <div class="form-field-group">
                                    <label for="contact_email" class="luxury-form-label">Email Address <span class="required-asterisk">*</span></label>
                                    <input type="email" id="contact_email" name="contact_email" required 
                                           placeholder="e.g. marcus@firm.com" class="luxury-form-input">
                                </div>
                            </div>

                            <!-- Row 2: Category and Budget -->
                            <div class="form-grid-two">
                                <div class="form-field-group">
                                    <label for="contact_category" class="luxury-form-label">Inquiry Category <span class="required-asterisk">*</span></label>
                                    <select id="contact_category" name="contact_category" required class="luxury-form-select">
                                        <option value="" disabled selected>Select Inquiry Category...</option>
                                        <option value="Tier 01 — Antigravity Website Fast-Track Blueprint ($49.50 USD)">Tier 01 — Antigravity Website Fast-Track Blueprint ($49.50 USD)</option>
                                        <option value="Tier 02 — Autonomous 28-Agent Swarm & B2B Engine ($199 USD)">Tier 02 — Autonomous 28-Agent Swarm &amp; B2B Engine ($199 USD)</option>
                                        <option value="Executive Workstation Architecture ($800 Masterclass)">Tier 03 — Executive Workstation Architecture ($800 Masterclass)</option>
                                        <option value="Custom Enterprise AI Workstation & Swarm Buildout ($3,500–$7,500)">Custom Enterprise AI Workstation &amp; Swarm Buildout ($3,500&ndash;$7,500)</option>
                                        <option value="432Hz Commercial Music Sync Licensing (22 Albums / 216 ISRCs)">432Hz Commercial Music Sync Licensing (22 Albums / 216 ISRCs)</option>
                                        <option value="International Co-Investment (Mexico & European Union)">International Co-Investment (Mexico &amp; European Union)</option>
                                        <option value="General Executive Consultation">General Executive Consultation</option>
                                    </select>
                                </div>

                                <div class="form-field-group">
                                    <label for="contact_budget" class="luxury-form-label">Project Budget / Capital Allocation</label>
                                    <select id="contact_budget" name="contact_budget" class="luxury-form-select">
                                        <option value="" disabled selected>Select Capital Allocation / Budget...</option>
                                        <option value="$49.50 USD — Tier 01 Antigravity Website Blueprint">$49.50 USD — Tier 01 Antigravity Website Blueprint</option>
                                        <option value="$199 USD — Tier 02 Autonomous 28-Agent Swarm">$199 USD — Tier 02 Autonomous 28-Agent Swarm</option>
                                        <option value="$800 USD — Executive Workstation Architecture Masterclass">$800 USD — Executive Workstation Architecture Masterclass</option>
                                        <option value="$3,500 – $7,500 USD — Custom Enterprise AI Workstation & Swarm Buildout">$3,500 &ndash; $7,500 USD — Custom Enterprise AI Workstation &amp; Swarm Buildout</option>
                                        <option value="$1,500 – $25,000 USD — 432Hz Commercial Music Sync Licensing">$1,500 &ndash; $25,000 USD — 432Hz Commercial Music Sync Licensing</option>
                                        <option value="$100,000 – $500,000+ USD — International Real Estate Co-Investment">$100,000 &ndash; $500,000+ USD — International Real Estate Co-Investment</option>
                                        <option value="Undisclosed / Private Discussion with Wayne Stevenson">Undisclosed / Private Discussion with Wayne Stevenson</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Row 3: Overview & Requirements -->
                            <div class="form-field-group">
                                <label for="contact_message" class="luxury-form-label">Project Overview &amp; Requirements <span class="required-asterisk">*</span></label>
                                <textarea id="contact_message" name="contact_message" rows="5" required 
                                          placeholder="Briefly outline your AI workstation requirements, FastMCP swarm scope, or 432Hz music sync licensing request..." class="luxury-form-textarea"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-submit-row text-center">
                                <button type="submit" class="btn-cyan-submit">
                                    Transmit Executive Inquiry &rarr;
                                </button>
                                <p class="form-encryption-notice">
                                    🔒 TLS Encrypted &bull; Fiduciary Non-Disclosure Standard &bull; Direct Personal Routing to keystonerecomposition@gmail.com
                                </p>
                            </div>
                        </form>

                    </div>
                </section>

                <!-- 4. DIRECT CONTACT SLA & REGIONAL HEADQUARTERS -->
                <section class="contact-details-section">
                    <div class="contact-details-grid">
                        
                        <div class="detail-box">
                            <span class="detail-box-badge">EXECUTIVE SLA</span>
                            <h4>24&ndash;48 Hour Turnaround</h4>
                            <p>Every qualified inquiry is reviewed directly by Wayne Stevenson. We do not use automated marketing funnels or third-party call centers.</p>
                        </div>

                        <div class="detail-box">
                            <span class="detail-box-badge">DIRECT ROUTING</span>
                            <h4>Direct Email Communication</h4>
                            <p>
                                <a href="mailto:keystonerecomposition@gmail.com" class="cyan-link">keystonerecomposition@gmail.com</a><br>
                                <a href="mailto:contact@keystonerecomposition.com" class="cyan-link">contact@keystonerecomposition.com</a>
                            </p>
                        </div>

                        <div class="detail-box">
                            <span class="detail-box-badge">OPERATIONAL HQ</span>
                            <h4>Sea-to-Sky Mountain Corridor</h4>
                            <p>Squamish &amp; Whistler, British Columbia, Canada<br>Active projects across Squamish, Whistler &amp; Greater Vancouver.</p>
                        </div>

                        <div class="detail-box">
                            <span class="detail-box-badge">LEGAL FIDUCIARY</span>
                            <h4>Licensed General Contractor</h4>
                            <p>Keystone Possibilities Ltd.<br>BC Housing Residential Builder Licence #52603</p>
                        </div>

                    </div>
                </section>

            </article>

        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    const inquiry = params.get('inquiry');
    const promo = params.get('promo');
    const catSelect = document.getElementById('contact_category');
    const budSelect = document.getElementById('contact_budget');
    const msgInput = document.getElementById('contact_message');

    if (inquiry && catSelect && budSelect) {
        const promoSuffix = promo ? ` (Promo Code Applied: ${promo})` : '';
        if (inquiry === 'tier1_blueprint') {
            catSelect.value = 'Tier 01 — Antigravity Website Fast-Track Blueprint ($49.50 USD)';
            budSelect.value = '$49.50 USD — Tier 01 Antigravity Website Blueprint';
            if (msgInput && !msgInput.value) {
                msgInput.value = `Requesting instant access & licensing invoice for Tier 01: Antigravity Autonomous Website Fast-Track Blueprint ($49.50 USD)${promoSuffix}.`;
            }
        } else if (inquiry === 'tier2_swarm') {
            catSelect.value = 'Tier 02 — Autonomous 28-Agent Swarm & B2B Engine ($199 USD)';
            budSelect.value = '$199 USD — Tier 02 Autonomous 28-Agent Swarm';
            if (msgInput && !msgInput.value) {
                msgInput.value = `Requesting instant access & GitHub repository onboarding for Tier 02: Autonomous 28-Agent Swarm & B2B Engine ($199 USD)${promoSuffix}.`;
            }
        } else if (inquiry === 'tier3_workstation') {
            catSelect.value = 'Executive Workstation Architecture ($800 Masterclass)';
            budSelect.value = '$800 USD — Executive Workstation Architecture Masterclass';
            if (msgInput && !msgInput.value) {
                msgInput.value = `Applying for Tier 03: Custom Tauri HUD & Sovereign Workstation 1-on-1 Private Architecture with Wayne Stevenson ($800 USD)${promoSuffix}.`;
            }
        }
    }
});
</script>

<?php
get_footer();
