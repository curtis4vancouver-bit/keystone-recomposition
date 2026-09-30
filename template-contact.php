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
            $to = 'curtis4vancouver@gmail.com';
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
            $feedback_message = 'Thank you, ' . esc_html( $name ) . '. Your inquiry has been routed directly to Wayne Stevenson (curtis4vancouver@gmail.com). You will receive a response within 24–48 hours.';
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
                        Direct builder-to-client consultations for sovereign AI workstation architecture, British Columbia residential general contracting under Bill 44, and official Spotify catalog streaming.
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
                                <li>&bull; Full Tracklists, ISRC &amp; Musixmatch Synced Rights</li>
                            </ul>
                            <div class="channel-action">
                                <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener" class="channel-btn-gold">Stream on Spotify &nearr;</a>
                            </div>
                        </div>

                        <!-- CHANNEL 2: GENERAL CONTRACTING BC #52603 -->
                        <div class="contact-channel-card">
                            <div class="channel-card-top">
                                <span class="channel-tag-cyan">BC BUILDER #52603</span>
                                <span class="channel-icon">🏛️</span>
                            </div>
                            <h3 class="channel-title">General Contracting &amp; Infill</h3>
                            <p class="channel-desc">
                                Executed via Keystone Possibilities Ltd. High-performance small-scale multi-unit housing (SSMUH) infill, duplex, triplex, and multiplex developments across Squamish, Whistler, and Greater Vancouver under BC Bill 44.
                            </p>
                            <ul class="channel-features">
                                <li>&bull; Full 2-5-10 Year New Home Warranty Coverage</li>
                                <li>&bull; Extreme Alpine Step Code &amp; Seismic Engineering</li>
                                <li>&bull; Pre-Construction Feasibility &amp; Land Assembly</li>
                            </ul>
                            <div class="channel-action">
                                <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener" class="channel-btn-cyan">Visit Keystone Possibilities Ltd. &nearr;</a>
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
                                Bespoke 1-on-1 architecture consultation with Wayne Stevenson. Full deployment of custom Tauri sovereign workstation, 16-agent FastMCP swarms, and Chrome CDP automated production pipelines.
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
                                        <option value="Executive Workstation Architecture ($800 Masterclass)">Executive Workstation Architecture ($800 Masterclass)</option>
                                        <option value="BC Bill 44 General Contracting & Infill (BC Builder #52603)">BC Bill 44 General Contracting &amp; Infill (BC Builder #52603)</option>
                                        <option value="Private Real Estate Infill Investment & Co-Development">Private Real Estate Infill Investment &amp; Co-Development</option>
                                        <option value="Spotify Music Catalog, Sync & Audio Architecture">Spotify Music Catalog, Sync &amp; Audio Architecture</option>
                                        <option value="General Executive Consultation">General Executive Consultation</option>
                                    </select>
                                </div>

                                <div class="form-field-group">
                                    <label for="contact_budget" class="luxury-form-label">Project Budget / Capital Allocation</label>
                                    <select id="contact_budget" name="contact_budget" class="luxury-form-select">
                                        <option value="" disabled selected>Select Capital Allocation / Budget...</option>
                                        <option value="$800 CAD — Executive Workstation Architecture Masterclass">$800 CAD — Executive Workstation Architecture Masterclass</option>
                                        <option value="$25,000 – $100,000 CAD — Autonomous AI Software & Music Sync">$25,000 &ndash; $100,000 CAD — Autonomous AI Software &amp; Music Sync</option>
                                        <option value="$100,000 – $500,000 CAD — Private Infill Co-Investment & Feasibility">$100,000 &ndash; $500,000 CAD — Private Infill Co-Investment &amp; Feasibility</option>
                                        <option value="$500,000 – $2,500,000+ CAD — Turnkey Residential Multiplex Build">$500,000 &ndash; $2,500,000+ CAD — Turnkey Residential Multiplex Build</option>
                                        <option value="Undisclosed / Private Discussion with Wayne Stevenson">Undisclosed / Private Discussion with Wayne Stevenson</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Row 3: Overview & Requirements -->
                            <div class="form-field-group">
                                <label for="contact_message" class="luxury-form-label">Project Overview &amp; Requirements <span class="required-asterisk">*</span></label>
                                <textarea id="contact_message" name="contact_message" rows="3" required 
                                          placeholder="Briefly outline your project scope, location (if construction), or workstation requirements..." class="luxury-form-textarea"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-submit-row text-center">
                                <button type="submit" class="btn-cyan-submit">
                                    Transmit Executive Inquiry &rarr;
                                </button>
                                <p class="form-encryption-notice">
                                    🔒 TLS Encrypted &bull; Fiduciary Non-Disclosure Standard &bull; Direct Personal Routing to curtis4vancouver@gmail.com
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
                                <a href="mailto:curtis4vancouver@gmail.com" class="cyan-link">curtis4vancouver@gmail.com</a><br>
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

<?php
get_footer();
