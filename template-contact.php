<?php
/**
 * Template Name: Keystone Contact
 * Description: Executive Consultation, $800 Masterclass, Spotify/Apple/YouTube Official Channels & BC #52603 Portal
 * Version: 4.6.0 (Sovereign Pure-Black Wave & Leveled Architecture Edition)
 *
 * @package KeystoneRecompositionChild
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$feedback_status  = null;
$feedback_message = '';

// Handle Direct Inquiry Form Submission
if ( 'POST' === ( $_SERVER['REQUEST_METHOD'] ?? '' ) && isset( $_POST['keystone_contact_submitted'] ) ) {
	$nonce    = $_POST['keystone_contact_nonce'] ?? '';
	$honeypot = trim( (string) ( $_POST['website_url'] ?? '' ) );

	if ( ! wp_verify_nonce( (string) $nonce, 'keystone_contact_action' ) ) {
		$feedback_status  = 'error';
		$feedback_message = 'Security validation failed. Please refresh the page and try again.';
	} elseif ( '' !== $honeypot ) {
		// Silent anti-bot honeypot trap: return polite confirmation without persisting or mailing spam.
		$feedback_status  = 'success';
		$feedback_message = 'Consultation request received.';
	} else {
		$name     = sanitize_text_field( (string) ( $_POST['contact_name'] ?? '' ) );
		$email    = sanitize_email( (string) ( $_POST['contact_email'] ?? '' ) );
		$category = sanitize_text_field( (string) ( $_POST['contact_category'] ?? '' ) );
		$budget   = sanitize_text_field( (string) ( $_POST['contact_budget'] ?? '' ) );
		$details  = sanitize_textarea_field( (string) ( $_POST['contact_message'] ?? '' ) );

		if ( empty( $name ) || ! is_email( $email ) || '' === trim( $details ) ) {
			$feedback_status  = 'error';
			$feedback_message = 'Please provide your full name, valid email address, and a project overview.';
		} else {
			$resolved_category = '' !== $category ? $category : 'General Executive Consultation';
			$resolved_budget   = '' !== $budget ? $budget : 'Not Specified';

			if ( function_exists( 'keystone_persist_client_inquiry_record' ) ) {
				$client_ip = function_exists( 'keystone_get_lead_consultation_client_ip' )
					? keystone_get_lead_consultation_client_ip()
					: (string) ( $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0' );
				$ip_salt   = function_exists( 'wp_salt' ) ? (string) wp_salt( 'auth' ) : 'kr_lead_salt_v1';
				$store_res = keystone_persist_client_inquiry_record(
					array(
						'name'        => $name,
						'email'       => $email,
						'category'    => $resolved_category,
						'budget'      => $resolved_budget,
						'message'     => $details,
						'page_source' => function_exists( 'get_permalink' ) ? (string) get_permalink() : 'https://keystonerecomposition.com/contact/',
						'ip_hash'     => substr( hash( 'sha256', $client_ip . '|' . $ip_salt ), 0, 16 ),
					)
				);
				$inquiry_id = (string) ( $store_res['entry']['id'] ?? '' );
			} else {
				$inquiry_id = 'KR-INQ-' . gmdate( 'YmdHis' ) . '-' . strtoupper( substr( md5( uniqid( '', true ) ), 0, 4 ) );
				$entry      = array(
					'id'           => $inquiry_id,
					'submitted_at' => gmdate( 'c' ),
					'name'         => $name,
					'email'        => $email,
					'category'     => $resolved_category,
					'budget'       => $resolved_budget,
					'message'      => $details,
					'page_source'  => 'https://keystonerecomposition.com/contact/',
				);
				$existing = get_option( 'keystone_client_inquiries_ledger', array() );
				$ledger   = is_array( $existing ) ? $existing : array();
				array_unshift( $ledger, $entry );
				$ledger = array_slice( $ledger, 0, 200 );
				update_option( 'keystone_client_inquiries_ledger', $ledger, false );

				$log_dir = get_stylesheet_directory() . '/logs';
				if ( ! is_dir( $log_dir ) ) {
					wp_mkdir_p( $log_dir );
				}
				if ( is_dir( $log_dir ) ) {
					if ( ! file_exists( $log_dir . '/.htaccess' ) ) {
						@file_put_contents( $log_dir . '/.htaccess', "Order deny,allow\nDeny from all\n", LOCK_EX );
					}
					if ( ! file_exists( $log_dir . '/index.php' ) ) {
						@file_put_contents( $log_dir . '/index.php', "<?php\n// Silence is golden.\n", LOCK_EX );
					}
					$json_line = wp_json_encode( $entry, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
					if ( is_string( $json_line ) ) {
						@file_put_contents( $log_dir . '/inquiries.log', $json_line . "\n", FILE_APPEND | LOCK_EX );
					}
				}
			}

			$safe_reply_name  = trim( (string) preg_replace( '/[\r\n\0<>"]+/', ' ', $name ) );
			$safe_reply_email = trim( (string) preg_replace( '/[\r\n\0\s]+/', '', $email ) );

			$to      = 'keystonerecomposition@gmail.com';
			$subject = trim( (string) preg_replace( '/[\r\n\0]+/', ' ', '[Keystone Recomposition Inquiry] ' . $resolved_category . ' - ' . $name ) );
			$body    = ( '' !== $inquiry_id ? "Inquiry ID: {$inquiry_id}\n" : '' );
			$body   .= "Name: {$name}\n";
			$body   .= "Email: {$email}\n";
			$body   .= "Category: {$resolved_category}\n";
			$body   .= "Budget/Scale: {$resolved_budget}\n\n";
			$body   .= "Project Overview:\n{$details}\n\n";
			$body   .= "---\nSent from keystonerecomposition.com/contact/ on " . gmdate( 'Y-m-d H:i:s' ) . " UTC\n";

			$headers = [
				'Content-Type: text/plain; charset=UTF-8',
				'From: Keystone Recomposition <contact@keystonerecomposition.com>',
				'Reply-To: ' . ( '' !== $safe_reply_name ? $safe_reply_name . ' <' . $safe_reply_email . '>' : $safe_reply_email ),
			];

			wp_mail( $to, $subject, $body, $headers );

			$feedback_status  = 'success';
			$feedback_message = 'Thank you, ' . esc_html( $name ) . '. Your inquiry has been routed directly to Wayne Stevenson (keystonerecomposition@gmail.com). You will receive a personal response within 24–48 hours.';
		}
	}
}

get_header();
?>

<div id="primary" class="content-area primary keystone-contact-page">
	<main id="main" class="site-main">
		<div class="ast-container contact-container">

			<article class="contact-master-article">

				<!-- =====================================================================
				     1. CLEAN CENTERED EXECUTIVE HERO HEADER (ZERO TOP BUTTON CLUTTER)
				     ===================================================================== -->
				<header class="contact-hero-header text-center">
					<div class="contact-hero-kicker">DIRECT PRINCIPAL CONSULTATION // SQUAMISH &amp; WHISTLER, BC &bull; LICENSED BUILDER #52603</div>

					<h1 class="contact-main-title">
						Executive Inquiries &amp; <span class="cyan-gold-gradient-text">Private Consultations</span>
					</h1>

					<p class="contact-hero-subtitle">
						Direct principal-to-client engagement for our <strong>$800 Masterclass &amp; Custom Tauri Desktop Command Center</strong>, <strong>$49.50 &amp; $199 AI Protocols</strong>, custom enterprise AI &amp; architectural builds, and global <strong>432Hz music streaming &amp; sync licensing</strong> across Spotify, Apple Music, and YouTube.
					</p>

					<!-- Official Streaming & Network Quick-Launch Bar -->
					<div class="contact-network-bar" aria-label="Official Streaming &amp; Network Channels">
						<a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="contact-net-pill ks-p3-btn-gold">
							<span class="ks-wave-text">🎵 Spotify Artist Channel &#8599;</span>
						</a>
						<a href="https://music.apple.com/us/artist/keystone-recomposition/1862989452" target="_blank" rel="noopener noreferrer" class="contact-net-pill ks-p3-btn-blue">
							<span class="ks-wave-text">🍎 Apple Music Catalog &#8599;</span>
						</a>
						<a href="https://www.youtube.com/@KeyStoneRecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" class="contact-net-pill ks-p3-btn-gold">
							<span class="ks-wave-text">▶️ YouTube Music OAC &#8599;</span>
						</a>
						<a href="https://www.youtube.com/@KeystoneAIProtocols?sub_confirmation=1" target="_blank" rel="noopener noreferrer" class="contact-net-pill ks-p3-btn-blue">
							<span class="ks-wave-text">⚡ YouTube AI Protocols &#8599;</span>
						</a>
						<a href="https://keystonepossibilities.ca" target="_blank" rel="noopener noreferrer" class="contact-net-pill ks-p3-btn-gold">
							<span class="ks-wave-text">🏛️ Keystone Possibilities #52603 &#8599;</span>
						</a>
					</div>
				</header>

				<!-- =====================================================================
				     2. THREE EQUAL-HEIGHT PRIMARY ENGAGEMENT CHANNELS
				     ===================================================================== -->
				<section class="contact-channels-section" aria-label="Primary Engagement &amp; Streaming Channels">
					<div class="contact-channels-grid">

						<!-- CARD 01: SPOTIFY, APPLE MUSIC & YOUTUBE OFFICIAL CHANNELS (GOLD) -->
						<article class="contact-channel-card contact-card-gold">
							<div class="channel-card-top">
								<span class="channel-pill ks-p3-pill-gold"><span class="ks-wave-text">01 &bull; SPOTIFY &amp; YOUTUBE</span></span>
								<span class="channel-cat channel-cat-gold">25 RELEASES &bull; 432HZ</span>
							</div>

							<h3 class="channel-title">Spotify, Apple Music &amp; YouTube Official Artist Channels</h3>
							<p class="channel-desc">
								Stream Wayne Stevenson&rsquo;s 25 official releases (23 studio albums and 2 singles &mdash; 246 master recordings) engineered across Spotify, Apple Music, and YouTube, or request direct commercial sync licensing.
							</p>

							<div class="channel-spec-stack">
								<div class="channel-spec-box">
									<span class="channel-spec-icon">🎵</span>
									<div>
										<strong>Spotify &amp; Apple Music Official Artist Catalog</strong>
										<span>25 official releases and 246 studio masters in deep house, outlaw acoustic storytelling, soul, and 432Hz focus architecture.</span>
									</div>
								</div>
								<div class="channel-spec-box">
									<span class="channel-spec-icon">▶️</span>
									<div>
										<strong>YouTube Official Artist &amp; AI Protocols Channels</strong>
										<span>Full-length 4K 432Hz visualizers on @KeyStoneRecomposition plus AI system teardowns on @KeystoneAIProtocols.</span>
									</div>
								</div>
								<div class="channel-spec-box">
									<span class="channel-spec-icon">🎬</span>
									<div>
										<strong>Direct-to-Creator 432Hz Commercial Sync Licensing</strong>
										<span>100% independent principal master ownership for film, luxury real estate media, and commercial brand sync.</span>
									</div>
								</div>
							</div>

							<div class="channel-mini-links-row">
								<a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="channel-mini-pill ks-p3-pill-gold"><span class="ks-wave-text">Spotify &#8599;</span></a>
								<a href="https://music.apple.com/us/artist/keystone-recomposition/1862989452" target="_blank" rel="noopener noreferrer" class="channel-mini-pill ks-p3-pill-blue"><span class="ks-wave-text">Apple Music &#8599;</span></a>
								<a href="https://www.youtube.com/@KeyStoneRecomposition" target="_blank" rel="noopener noreferrer" class="channel-mini-pill ks-p3-pill-gold"><span class="ks-wave-text">YouTube OAC &#8599;</span></a>
							</div>

							<div class="channel-action">
								<a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" class="channel-cta-btn ks-p3-btn-gold">
									<span class="ks-wave-text">🎵 Stream on Spotify Channel &#8599;</span>
								</a>
							</div>
						</article>

						<!-- CARD 02: CUSTOM AI SYSTEMS, SWARMS & 3-TIER VAULT (BLUE) -->
						<article class="contact-channel-card contact-card-blue">
							<div class="channel-card-top">
								<span class="channel-pill ks-p3-pill-blue"><span class="ks-wave-text">02 &bull; CUSTOM AI &amp; VAULT</span></span>
								<span class="channel-cat channel-cat-blue">3-TIER AI ECOSYSTEM</span>
							</div>

							<h3 class="channel-title">Custom AI Systems, Multi-Agent Swarms &amp; Website Builds</h3>
							<p class="channel-desc">
								Deploy our turnkey AI software ecosystem—from our $49.50 AI Brain &amp; Google Flow Blueprint and $199 Multi-Agent Swarms &amp; Website Builder to custom enterprise AI and full-stack web architecture.
							</p>

							<div class="channel-spec-stack">
								<div class="channel-spec-box">
									<span class="channel-spec-icon">🧠</span>
									<div>
										<strong>Tier 1 ($49.50) &mdash; AI Brain &amp; Google Flow Blueprint</strong>
										<span>Persistent local vector memory vault, cinematic video pipeline, and 3 days of guided setup support.</span>
									</div>
								</div>
								<div class="channel-spec-box">
									<span class="channel-spec-icon">🐝</span>
									<div>
										<strong>Tier 2 ($199) &mdash; Multi-Agent Swarms &amp; Website Builder</strong>
										<span>Parallel multi-agent research, verification gates, and luxury full-stack website deployment with 6 days of support.</span>
									</div>
								</div>
								<div class="channel-spec-box">
									<span class="channel-spec-icon">🏗️</span>
									<div>
										<strong>Custom Enterprise AI &amp; Web Builds ($3,500&ndash;$7,500)</strong>
										<span>Bespoke multi-agent workflows, automated B2B outreach engines, and high-converting dark-luxury web platforms.</span>
									</div>
								</div>
							</div>

							<div class="channel-mini-links-row">
								<a href="<?php echo esc_url( home_url( '/ai-protocols/#tier-blueprint' ) ); ?>" class="channel-mini-pill ks-p3-pill-blue"><span class="ks-wave-text">$49.50 Tier 1</span></a>
								<a href="<?php echo esc_url( home_url( '/ai-protocols/#tier-swarm' ) ); ?>" class="channel-mini-pill ks-p3-pill-gold"><span class="ks-wave-text">$199 Tier 2</span></a>
								<a href="#inquiry-form" class="channel-mini-pill ks-p3-pill-blue" data-select-inquiry="enterprise"><span class="ks-wave-text">Custom AI &darr;</span></a>
							</div>

							<div class="channel-action">
								<a href="<?php echo esc_url( home_url( '/ai-protocols/' ) ); ?>" class="channel-cta-btn ks-p3-btn-blue">
									<span class="ks-wave-text">⚡ Explore AI Protocols Vault &rarr;</span>
								</a>
							</div>
						</article>

						<!-- CARD 03: $800 MASTERCLASS & TAURI DESKTOP COMMAND CENTER (GOLD) -->
						<article class="contact-channel-card contact-card-gold">
							<div class="channel-card-top">
								<span class="channel-pill ks-p3-pill-gold"><span class="ks-wave-text">03 &bull; $800 MASTERCLASS</span></span>
								<span class="channel-cat channel-cat-gold">TAURI DESKTOP STUDIO</span>
							</div>

							<h3 class="channel-title">The $800 Masterclass &amp; Custom Tauri Desktop Command Center</h3>
							<p class="channel-desc">
								Bespoke 1-on-1 architecture consultation and turnkey buildout with Wayne Stevenson. Deploy your own custom native Tauri Desktop Command Center, voice HUD, and local-first automation suite.
							</p>

							<div class="channel-spec-stack">
								<div class="channel-spec-box">
									<span class="channel-spec-icon">⚡</span>
									<div>
										<strong>1-on-1 Screen-to-Screen Walkthrough &amp; 6-Day Support</strong>
										<span>Direct principal architecture session with Wayne Stevenson plus 6 days of priority 1-on-1 setup &amp; calibration support.</span>
									</div>
								</div>
								<div class="channel-spec-box">
									<span class="channel-spec-icon">🖥️</span>
									<div>
										<strong>Custom Native Tauri Desktop Command Center</strong>
										<span>Full flagship desktop application uniting your AI Brain, voice HUD, video pipeline, and live telemetry dashboards.</span>
									</div>
								</div>
								<div class="channel-spec-box">
									<span class="channel-spec-icon">🔒</span>
									<div>
										<strong>Complete Local-First Codebase &amp; Zero Cloud Lock-In</strong>
										<span>100% local ownership of your workstation tools, prompts, and automation pipelines with zero recurring SaaS fees.</span>
									</div>
								</div>
							</div>

							<div class="channel-mini-links-row">
								<a href="<?php echo esc_url( home_url( '/ai-protocols/#tier-workstation' ) ); ?>" class="channel-mini-pill ks-p3-pill-gold"><span class="ks-wave-text">$800 Specs</span></a>
								<a href="#inquiry-form" class="channel-mini-pill ks-p3-pill-blue" data-select-inquiry="masterclass800"><span class="ks-wave-text">6-Day SLA &darr;</span></a>
								<a href="mailto:keystonerecomposition@gmail.com?subject=%24800%20Masterclass%20%26%20Custom%20Tauri%20Desktop%20Command%20Center%20Booking" class="channel-mini-pill ks-p3-pill-gold"><span class="ks-wave-text">Direct Email &#8599;</span></a>
							</div>

							<div class="channel-action">
								<a href="#inquiry-form" class="channel-cta-btn ks-p3-btn-gold" data-select-inquiry="masterclass800">
									<span class="ks-wave-text">⚡ Book $800 Masterclass Build &darr;</span>
								</a>
							</div>
						</article>

					</div>
				</section>

				<!-- =====================================================================
				     3. CENTERED EXECUTIVE INQUIRY FORM PORTAL (#inquiry-form)
				     ===================================================================== -->
				<section class="contact-form-section" id="inquiry-form">
					<div class="contact-form-glass-card">

						<div class="form-header text-center">
							<div class="contact-section-kicker">DIRECT SUBMISSION PORTAL // ENCRYPTED PRINCIPAL DISPATCH</div>
							<h2 class="form-title">
								Submit an <span class="cyan-gold-gradient-text">Executive Inquiry</span>
							</h2>
							<p class="form-subtitle">
								Complete the parameters below to book the <strong>$800 Masterclass &amp; Custom Tauri Desktop Command Center</strong>, request a custom AI or construction consultation, or license 432Hz studio masters. Every inquiry is reviewed personally by Wayne Stevenson within 24&ndash;48 hours.
							</p>
						</div>

						<?php if ( ! empty( $feedback_status ) ) : ?>
							<div class="form-feedback-alert <?php echo 'success' === $feedback_status ? 'alert-success' : 'alert-error'; ?>" role="alert">
								<div class="feedback-icon"><?php echo 'success' === $feedback_status ? '✅' : '⚠️'; ?></div>
								<div class="feedback-text"><?php echo esc_html( $feedback_message ); ?></div>
							</div>
						<?php endif; ?>

						<form action="<?php echo esc_url( get_permalink() ); ?>#inquiry-form" method="POST" class="luxury-inquiry-form" data-keystone-lead-form="consultation">
							<?php wp_nonce_field( 'keystone_contact_action', 'keystone_contact_nonce' ); ?>
							<input type="hidden" name="keystone_contact_submitted" value="1">
							<div style="position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;opacity:0;pointer-events:none;" aria-hidden="true">
								<label for="kr_website_url">Website</label>
								<input type="text" id="kr_website_url" name="website_url" value="" tabindex="-1" autocomplete="off" aria-hidden="true">
							</div>

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
										<option value="Tier 3 — $800 Masterclass & Custom Tauri Desktop Command Center (6-Day Priority Support)">Tier 3 &mdash; $800 Masterclass &amp; Custom Tauri Desktop Command Center (6-Day Priority Support)</option>
										<option value="Tier 2 — $199 Multi-Agent Swarms & Website Builder (6-Day Setup Support)">Tier 2 &mdash; $199 Multi-Agent Swarms &amp; Website Builder (6-Day Setup Support)</option>
										<option value="Tier 1 — $49.50 AI Brain & Google Flow Blueprint (3-Day Setup Support)">Tier 1 &mdash; $49.50 AI Brain &amp; Google Flow Blueprint (3-Day Setup Support)</option>
										<option value="Custom Enterprise AI Workstation & Full-Stack Buildout ($3,500–$7,500)">Custom Enterprise AI Workstation &amp; Full-Stack Buildout ($3,500&ndash;$7,500)</option>
										<option value="432Hz Commercial Music Sync Licensing (Spotify / Apple / YouTube — 25 Releases)">432Hz Commercial Music Sync Licensing (Spotify / Apple / YouTube &mdash; 25 Releases)</option>
										<option value="BC Housing #52603 Custom Estate, Bill 44 Multiplex & Civil Consultation">BC Housing #52603 Custom Estate, Bill 44 Multiplex &amp; Civil Consultation</option>
										<option value="International Real Estate & Strategic Co-Investment">International Real Estate &amp; Strategic Co-Investment</option>
										<option value="General Executive Consultation">General Executive Consultation</option>
									</select>
								</div>

								<div class="form-field-group">
									<label for="contact_budget" class="luxury-form-label">Project Budget / Capital Allocation</label>
									<select id="contact_budget" name="contact_budget" class="luxury-form-select">
										<option value="" disabled selected>Select Capital Allocation / Budget...</option>
										<option value="$800 CAD — Tier 3 Custom Tauri Desktop Command Center & 1-on-1 Masterclass">$800 CAD &mdash; Tier 3 Custom Tauri Desktop Command Center &amp; 1-on-1 Masterclass</option>
										<option value="$199 CAD — Tier 2 Multi-Agent Swarms & Website Builder">$199 CAD &mdash; Tier 2 Multi-Agent Swarms &amp; Website Builder</option>
										<option value="$49.50 CAD — Tier 1 AI Brain & Google Flow Blueprint">$49.50 CAD &mdash; Tier 1 AI Brain &amp; Google Flow Blueprint</option>
										<option value="$3,500 – $7,500 — Custom Enterprise AI & Full-Stack Web Buildout">$3,500 &ndash; $7,500 &mdash; Custom Enterprise AI &amp; Full-Stack Web Buildout</option>
										<option value="$1,500 – $25,000 — 432Hz Commercial Music Sync Licensing">$1,500 &ndash; $25,000 &mdash; 432Hz Commercial Music Sync Licensing</option>
										<option value="$100,000 – $500,000+ — Custom Estate, Multiplex or Real-Asset Co-Investment">$100,000 &ndash; $500,000+ &mdash; Custom Estate, Multiplex or Real-Asset Co-Investment</option>
										<option value="Direct Principal Discussion with Wayne Stevenson">Direct Principal Discussion with Wayne Stevenson</option>
									</select>
								</div>
							</div>

							<!-- Row 3: Overview & Requirements -->
							<div class="form-field-group">
								<label for="contact_message" class="luxury-form-label">Project Overview &amp; Requirements <span class="required-asterisk">*</span></label>
								<textarea id="contact_message" name="contact_message" rows="5" required
								          placeholder="Outline your $800 Masterclass &amp; Tauri Desktop goals, custom AI/website scope, BC #52603 construction inquiry, or 432Hz music sync licensing request..." class="luxury-form-textarea"></textarea>
							</div>

							<!-- Submit & Direct Email Action Row -->
							<div class="form-submit-row text-center">
								<div class="contact-form-btn-pair">
									<button type="submit" class="contact-submit-btn ks-p3-btn-gold">
										<span class="ks-wave-text">⚡ Transmit Executive Inquiry &rarr;</span>
									</button>
									<a href="mailto:keystonerecomposition@gmail.com?subject=Executive%20Inquiry%20%E2%80%94%20Wayne%20Stevenson%20%28Keystone%20Recomposition%29" class="contact-direct-email-btn ks-p3-btn-blue">
										<span class="ks-wave-text">✉️ Email Wayne Stevenson Directly &#8599;</span>
									</a>
								</div>
								<p class="form-encryption-notice">
									🔒 TLS Encrypted &bull; Fiduciary Non-Disclosure Standard &bull; Direct Personal Routing to <strong>keystonerecomposition@gmail.com</strong>
								</p>
							</div>
						</form>

					</div>
				</section>

				<!-- =====================================================================
				     4. LEVELED 4-CARD DIRECT CONTACT SLA & REGIONAL HEADQUARTERS GRID
				     ===================================================================== -->
				<section class="contact-details-section" aria-label="Direct Contact SLA &amp; Regional Headquarters">
					<div class="contact-details-grid">

						<div class="detail-box contact-detail-card contact-detail-gold">
							<span class="detail-box-pill ks-p3-pill-gold"><span class="ks-wave-text">01 // EXECUTIVE SLA</span></span>
							<h4>24&ndash;48 Hour Turnaround</h4>
							<p>Every qualified inquiry is reviewed directly by Wayne Stevenson. Zero automated call centers or third-party sales intermediaries.</p>
						</div>

						<div class="detail-box contact-detail-card contact-detail-blue">
							<span class="detail-box-pill ks-p3-pill-blue"><span class="ks-wave-text">02 // DIRECT ROUTING</span></span>
							<h4>Direct Principal Email</h4>
							<p>
								<a href="mailto:keystonerecomposition@gmail.com" class="cyan-link">keystonerecomposition@gmail.com</a><br>
								<a href="mailto:contact@keystonerecomposition.com" class="cyan-link">contact@keystonerecomposition.com</a>
							</p>
						</div>

						<div class="detail-box contact-detail-card contact-detail-gold">
							<span class="detail-box-pill ks-p3-pill-gold"><span class="ks-wave-text">03 // OPERATIONAL HQ</span></span>
							<h4>Sea-to-Sky Mountain Corridor</h4>
							<p>Squamish &amp; Whistler, British Columbia, Canada &bull; Serving Squamish, Whistler, West Vancouver &amp; Greater Vancouver.</p>
						</div>

						<div class="detail-box contact-detail-card contact-detail-blue">
							<span class="detail-box-pill ks-p3-pill-blue"><span class="ks-wave-text">04 // LICENSED BUILDER</span></span>
							<h4>Keystone Possibilities Ltd</h4>
							<p>BC Housing Licensed Residential Builder <strong>#52603</strong> &bull; Custom Estates, Bill 44 Multiplexes &amp; Civil Contracting.</p>
						</div>

					</div>
				</section>

			</article>

		</div>
	</main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var params = new URLSearchParams(window.location.search);
	var inquiry = params.get('inquiry') || params.get('interest') || '';
	var promo = params.get('promo') || '';
	var catSelect = document.getElementById('contact_category');
	var budSelect = document.getElementById('contact_budget');
	var msgInput = document.getElementById('contact_message');

	function applyInquiryPreset(mode) {
		if (!catSelect || !budSelect) return;
		var promoSuffix = promo ? ' (Promo Code Applied: ' + promo + ')' : '';
		if (mode === 'tier1_blueprint' || mode === 'blueprint') {
			catSelect.value = 'Tier 1 — $49.50 AI Brain & Google Flow Blueprint (3-Day Setup Support)';
			budSelect.value = '$49.50 CAD — Tier 1 AI Brain & Google Flow Blueprint';
			if (msgInput && !msgInput.value) {
				msgInput.value = 'Requesting Tier 1: AI Brain & Google Flow Blueprint ($49.50 CAD with 3-Day Setup Support)' + promoSuffix + '.';
			}
		} else if (mode === 'tier2_swarm' || mode === 'swarm') {
			catSelect.value = 'Tier 2 — $199 Multi-Agent Swarms & Website Builder (6-Day Setup Support)';
			budSelect.value = '$199 CAD — Tier 2 Multi-Agent Swarms & Website Builder';
			if (msgInput && !msgInput.value) {
				msgInput.value = 'Requesting Tier 2: Multi-Agent Swarms & Website Builder ($199 CAD with 6-Day Setup Support)' + promoSuffix + '.';
			}
		} else if (mode === 'tier3_workstation' || mode === 'masterclass800' || mode === 'workstation') {
			catSelect.value = 'Tier 3 — $800 Masterclass & Custom Tauri Desktop Command Center (6-Day Priority Support)';
			budSelect.value = '$800 CAD — Tier 3 Custom Tauri Desktop Command Center & 1-on-1 Masterclass';
			if (msgInput && !msgInput.value) {
				msgInput.value = 'Booking Tier 3: The $800 Masterclass & Custom Tauri Desktop Command Center 1-on-1 Architecture with Wayne Stevenson (includes 6-Day Priority Setup Support)' + promoSuffix + '.';
			}
		} else if (mode === 'enterprise') {
			catSelect.value = 'Custom Enterprise AI Workstation & Full-Stack Buildout ($3,500–$7,500)';
			budSelect.value = '$3,500 – $7,500 — Custom Enterprise AI & Full-Stack Web Buildout';
			if (msgInput && !msgInput.value) {
				msgInput.value = 'Inquiring about a Custom Enterprise AI Workstation & Full-Stack Website Buildout ($3,500–$7,500)' + promoSuffix + '.';
			}
		}
	}

	if (inquiry) {
		applyInquiryPreset(inquiry);
	}

	document.querySelectorAll('[data-select-inquiry]').forEach(function(el) {
		el.addEventListener('click', function() {
			var mode = el.getAttribute('data-select-inquiry');
			applyInquiryPreset(mode);
		});
	});
});
</script>

<?php
get_footer();
