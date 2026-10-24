<?php
/**
 * Keystone AI Protocols — Automated Video Walkthrough, Instant Download Vault,
 * Strict User UID Verification Gate, Stripe HMAC-SHA256 Webhook,
 * Interactive Brain/Channel/Website Setup Intake Generator,
 * Authenticated .ZIP Download Streamer & 24/7 AI Architect Tutor Engine
 *
 * Endpoints:
 *   POST     /wp-json/keystone/v1/protocol-order
 *   GET      /wp-json/keystone/v1/protocol-orders
 *   GET|POST /wp-json/keystone/v1/verify-vault-uid
 *   POST     /wp-json/keystone/v1/stripe-webhook
 *   POST     /wp-json/keystone/v1/protocol-setup-form
 *   POST     /wp-json/keystone/v1/protocol-tutor
 *
 * @package KeystoneRecompositionChild
 * @since 10.9.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'KEYSTONE_VISA_AND_VIDEOS_LIVE' ) ) {
	define( 'KEYSTONE_VISA_AND_VIDEOS_LIVE', false ); // Flip to true once Wayne connects Stripe & finalizes walkthrough videos
}

if ( ! defined( 'KEYSTONE_STRIPE_TIER1_URL' ) ) {
	define( 'KEYSTONE_STRIPE_TIER1_URL', '' );
}
if ( ! defined( 'KEYSTONE_STRIPE_TIER2_URL' ) ) {
	define( 'KEYSTONE_STRIPE_TIER2_URL', '' );
}
if ( ! defined( 'KEYSTONE_STRIPE_TIER3_URL' ) ) {
	define( 'KEYSTONE_STRIPE_TIER3_URL', '' );
}
if ( ! defined( 'KEYSTONE_STRIPE_WEBHOOK_SECRET' ) ) {
	define( 'KEYSTONE_STRIPE_WEBHOOK_SECRET', '' );
}

/**
 * Return unlocked video modules (V01-V06) and breakdown PDFs (PDF-01 to PDF-12) for a given tier.
 */
function keystone_get_tier_unlocked_curriculum( string $tier ): array {
	switch ( $tier ) {
		case '3':
			return array(
				'unlocked_modules' => array( 'V01', 'V02', 'V03', 'V04', 'V05', 'V06' ),
				'unlocked_pdfs'    => array( 'PDF-01', 'PDF-02', 'PDF-03', 'PDF-04', 'PDF-05', 'PDF-06', 'PDF-07', 'PDF-08', 'PDF-09', 'PDF-10', 'PDF-11', 'PDF-12' ),
			);
		case '2':
			return array(
				'unlocked_modules' => array( 'V01', 'V02', 'V03', 'V04', 'V05' ),
				'unlocked_pdfs'    => array( 'PDF-01', 'PDF-02', 'PDF-03', 'PDF-04', 'PDF-05', 'PDF-06', 'PDF-07', 'PDF-08', 'PDF-09' ),
			);
		case '1':
		default:
			return array(
				'unlocked_modules' => array( 'V01', 'V02', 'V03' ),
				'unlocked_pdfs'    => array( 'PDF-01', 'PDF-02', 'PDF-03', 'PDF-04', 'PDF-05' ),
			);
	}
}

/**
 * Append `&uid=` dynamically to any `?vault_download=` URLs in a downloads array.
 */
function keystone_append_uid_to_downloads( array $downloads, string $uid ): array {
	$clean_uid = trim( $uid );
	if ( '' === $clean_uid ) {
		return $downloads;
	}
	$result = array();
	foreach ( $downloads as $dl ) {
		$url = (string) ( $dl['url'] ?? '' );
		if ( false !== strpos( $url, 'vault_download=' ) && false === strpos( $url, 'uid=' ) ) {
			$sep = ( false !== strpos( $url, '?' ) ) ? '&' : '?';
			$url .= $sep . 'uid=' . rawurlencode( $clean_uid );
		}
		$dl['url'] = $url;
		$result[]  = $dl;
	}
	return $result;
}

/**
 * Return canonical Tier metadata (Video Walkthrough URL, Clean-Room Copy-Paste Prompt Packs, Price, Label).
 * Strictly enforces Rule 30 ("Museum Model" IP Air-Gap): zero private desktop automation or internal daemon leaks.
 */
function keystone_get_protocol_tier_catalog( string $uid = '' ): array {
	$lead_page_url = '' !== trim( $uid )
		? home_url( '/ai-protocols/?uid=' . rawurlencode( trim( $uid ) ) . '#kr-self-service-portal' )
		: home_url( '/ai-protocols/#kr-self-service-portal' );

	$t1_downloads = keystone_append_uid_to_downloads(
		array(
			array(
				'label' => '📦 Keystone_Tier01_Antigravity_Brain_And_Flow_Prompt_Pack.zip (Visual Brain Setup Diagram PDF + Copy-Paste Brain Prompts + ~20-Word Google Flow Prompt Generator)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier1_blueprint_pack' ),
			),
			array(
				'label' => '🌐 Keystone_Tier01_Website_And_YouTube_Channel_Prompts.zip (Copy-Paste Website Builder Prompts + YouTube Brand Channel Upload Defaults & 480-Char Tags)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier1_website_channel_pack' ),
			),
			array(
				'label' => '🎬 Module V01–V03 Step-by-Step Video Walkthroughs (Protected Buyer Lead Page Player)',
				'url'   => $lead_page_url,
			),
		),
		$uid
	);

	$t2_downloads = keystone_append_uid_to_downloads(
		array(
			array(
				'label' => '📦 Keystone_Tier02_Multi_Agent_Role_Prompts_And_B2B_Suite.zip (Copy-Paste Subagent Role Prompt Templates + B2B Outreach & DNS Verification Starter Kit)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier2_swarm_pack' ),
			),
			array(
				'label' => '🎬 Module V04–V05 Multi-Agent Workflow Walkthroughs (Protected Buyer Lead Page Player)',
				'url'   => $lead_page_url,
			),
		),
		$uid
	);

	$t3_downloads = keystone_append_uid_to_downloads(
		array(
			array(
				'label' => '🏛️ Keystone_Tier03_Full_Stack_Creator_Workstation_Suite.zip (Complete Creator Workstation Setup + 2-Track DaVinci Assembly Guide + Omnichannel Templates)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier3_workstation_pack' ),
			),
			array(
				'label' => '🎬 Module V06 Creator Workstation & DaVinci Assembly Masterclass (Protected Buyer Lead Page Player)',
				'url'   => $lead_page_url,
			),
			array(
				'label' => '🤖 24/7 Automated AI Setup Assistant & Complete PDF Setup Library (Buyer Vault)',
				'url'   => $lead_page_url,
			),
		),
		$uid
	);

	return array(
		'1' => array(
			'tier'                  => '1',
			'code'                  => 'tier1_blueprint',
			'name'                  => 'Tier 01 — $49.50 USD AI Brain Setup & Basic Google Flow Walkthrough (One-Time Payment)',
			'price'                 => '49.50',
			'stripe_checkout_url'   => (string) KEYSTONE_STRIPE_TIER1_URL,
			'walkthrough_video_id'  => 'JCgZ5SsN_bc',
			'walkthrough_video_url' => $lead_page_url,
			'walkthrough_title'     => 'Wayne Stevenson Recorded Walkthrough: Setting Up Your AI Brain & Basic Google Flow Video Example (One-Time Payment)',
			'unlocked_downloads'    => $t1_downloads,
			'unlocked_modules'      => keystone_get_tier_unlocked_curriculum( '1' )['unlocked_modules'],
			'unlocked_pdfs'         => keystone_get_tier_unlocked_curriculum( '1' )['unlocked_pdfs'],
		),
		'2' => array(
			'tier'                  => '2',
			'code'                  => 'tier2_swarm',
			'name'                  => 'Tier 02 — $199 USD Custom Website Build, Multi-Agent Workflows & Brand Channel (One-Time Payment)',
			'price'                 => '199.00',
			'stripe_checkout_url'   => (string) KEYSTONE_STRIPE_TIER2_URL,
			'walkthrough_video_id'  => 'k3fArbXUzQM',
			'walkthrough_video_url' => $lead_page_url,
			'walkthrough_title'     => 'Wayne Stevenson Recorded Walkthrough: Custom Website Build, Multi-Agent Workflows & Brand Channel Setup (One-Time Payment)',
			'unlocked_downloads'    => array_merge( $t1_downloads, $t2_downloads ),
			'unlocked_modules'      => keystone_get_tier_unlocked_curriculum( '2' )['unlocked_modules'],
			'unlocked_pdfs'         => keystone_get_tier_unlocked_curriculum( '2' )['unlocked_pdfs'],
		),
		'3' => array(
			'tier'                  => '3',
			'code'                  => 'tier3_workstation',
			'name'                  => 'Tier 03 — $800 USD Full-Stack AI Creator Workstation & Studio Production Pipeline (One-Time Payment)',
			'price'                 => '800.00',
			'stripe_checkout_url'   => (string) KEYSTONE_STRIPE_TIER3_URL,
			'walkthrough_video_id'  => 'uMkZvTbqF2U',
			'walkthrough_video_url' => $lead_page_url,
			'walkthrough_title'     => 'Wayne Stevenson Recorded Walkthrough: Full Creator Workstation & 2-Track DaVinci Production Pipeline (One-Time Payment)',
			'unlocked_downloads'    => array_merge( $t1_downloads, $t2_downloads, $t3_downloads ),
			'unlocked_modules'      => keystone_get_tier_unlocked_curriculum( '3' )['unlocked_modules'],
			'unlocked_pdfs'         => keystone_get_tier_unlocked_curriculum( '3' )['unlocked_pdfs'],
		),
	);
}

/**
 * Generate a deterministic User Vault UID for an email + tier.
 */
function keystone_generate_user_vault_uid( string $email, string $tier ): string {
	$clean_email = strtolower( trim( $email ) );
	$hash        = strtoupper( substr( hash_hmac( 'sha256', $clean_email . '|' . $tier, wp_salt( 'auth' ) ), 0, 12 ) );
	return 'KR-UID-' . $hash;
}

/**
 * Validate a User Vault UID against stored orders, active WP admin session, or owner master key.
 * Strictly guards KR-WP-UID-* and KR-ADMIN-UID-* behind `is_user_logged_in() && current_user_can('manage_options')`.
 */
function keystone_verify_user_vault_uid_internal( string $uid ): array {
	$uid       = strtoupper( sanitize_text_field( trim( $uid ) ) );
	$live_mode = (bool) KEYSTONE_VISA_AND_VIDEOS_LIVE;
	$is_admin  = function_exists( 'is_user_logged_in' ) && is_user_logged_in() && current_user_can( 'manage_options' );

	if ( '' === $uid ) {
		if ( $is_admin ) {
			$wp_uid  = 'KR-ADMIN-UID-' . (int) get_current_user_id();
			$catalog = keystone_get_protocol_tier_catalog( $wp_uid );
			return array(
				'valid'                 => true,
				'verified'              => true,
				'live_mode'             => $live_mode,
				'uid'                   => $wp_uid,
				'buyer_name'            => 'Wayne Stevenson (Admin Verified)',
				'tier'                  => '3',
				'tier_name'             => $catalog['3']['name'],
				'walkthrough_video_id'  => $catalog['3']['walkthrough_video_id'],
				'walkthrough_video_url' => $catalog['3']['walkthrough_video_url'],
				'walkthrough_title'     => $catalog['3']['walkthrough_title'],
				'unlocked_downloads'    => $catalog['3']['unlocked_downloads'],
				'unlocked_modules'      => $catalog['3']['unlocked_modules'],
				'unlocked_pdfs'         => $catalog['3']['unlocked_pdfs'],
				'message'               => 'Admin Session Verified! All 6 Course Modules, 12 Breakdown PDFs, Copy-Paste Prompt Packs, and 24/7 AI Tutor are unlocked.',
			);
		}
		return array(
			'valid'     => false,
			'verified'  => false,
			'live_mode' => $live_mode,
			'uid'       => '',
			'message'   => 'Missing Buyer KR-UID. Please enter a verified Buyer KR-UID or lock in your one-time launch rate reservation first.',
		);
	}

	// Security Gate: KR-WP-UID-* and KR-ADMIN-UID-* are strictly restricted to authenticated WP administrators
	if ( 0 === strpos( $uid, 'KR-WP-UID-' ) || 0 === strpos( $uid, 'KR-ADMIN-UID-' ) ) {
		if ( ! $is_admin ) {
			return array(
				'valid'     => false,
				'verified'  => false,
				'live_mode' => $live_mode,
				'uid'       => $uid,
				'message'   => 'Administrator Vault UIDs require an active authenticated WordPress administrator session. Please reserve your one-time launch rate above to generate your personal Buyer KR-UID.',
			);
		}
		$catalog = keystone_get_protocol_tier_catalog( $uid );
		return array(
			'valid'                 => true,
			'verified'              => true,
			'live_mode'             => $live_mode,
			'uid'                   => $uid,
			'buyer_name'            => 'Wayne Stevenson (Admin Session Verified)',
			'tier'                  => '3',
			'tier_name'             => $catalog['3']['name'],
			'walkthrough_video_id'  => $catalog['3']['walkthrough_video_id'],
			'walkthrough_video_url' => $catalog['3']['walkthrough_video_url'],
			'walkthrough_title'     => $catalog['3']['walkthrough_title'],
			'unlocked_downloads'    => $catalog['3']['unlocked_downloads'],
			'unlocked_modules'      => $catalog['3']['unlocked_modules'],
			'unlocked_pdfs'         => $catalog['3']['unlocked_pdfs'],
			'message'               => 'Admin UID Verified! Full 6-Tab Course Portal, 12 Breakdown PDFs & Copy-Paste Prompt Packs unlocked.',
		);
	}

	// Owner Master UID (Private to Wayne Stevenson)
	if ( in_array( $uid, array( 'KR-OWNER-WAYNE-52603', 'KR-UID-WAYNE52603', 'KR-ADMIN-52603' ), true ) ) {
		$catalog = keystone_get_protocol_tier_catalog( $uid );
		return array(
			'valid'                 => true,
			'verified'              => true,
			'live_mode'             => $live_mode,
			'uid'                   => $uid,
			'buyer_name'            => 'Wayne Stevenson (Founder Master UID)',
			'tier'                  => '3',
			'tier_name'             => $catalog['3']['name'],
			'walkthrough_video_id'  => $catalog['3']['walkthrough_video_id'],
			'walkthrough_video_url' => $catalog['3']['walkthrough_video_url'],
			'walkthrough_title'     => $catalog['3']['walkthrough_title'],
			'unlocked_downloads'    => $catalog['3']['unlocked_downloads'],
			'unlocked_modules'      => $catalog['3']['unlocked_modules'],
			'unlocked_pdfs'         => $catalog['3']['unlocked_pdfs'],
			'message'               => '✔ Founder Master UID Verified! All 6 Course Modules, 12 Breakdown PDFs & Copy-Paste Prompt Packs are unlocked.',
		);
	}

	$orders = get_option( 'keystone_protocol_orders_v10', array() );
	if ( is_array( $orders ) ) {
		foreach ( $orders as $order ) {
			if ( ! empty( $order['user_uid'] ) && strtoupper( (string) $order['user_uid'] ) === $uid ) {
				$verified_uid = (string) $order['user_uid'];

				// 3-Device / IP Anti-Sharing Lock (Prevents forwarding KR-UID links to non-buyers)
				$client_ip = (string) ( $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1' );
				$client_ip = trim( explode( ',', $client_ip )[0] );
				$ip_hash   = substr( hash( 'sha256', $client_ip . '|' . wp_salt( 'auth' ) ), 0, 16 );
				$ip_locks  = get_option( 'keystone_uid_ip_locks_v10', array() );
				if ( ! is_array( $ip_locks ) ) {
					$ip_locks = array();
				}
				$uid_ips = isset( $ip_locks[ $verified_uid ] ) && is_array( $ip_locks[ $verified_uid ] ) ? $ip_locks[ $verified_uid ] : array();
				if ( ! in_array( $ip_hash, $uid_ips, true ) ) {
					if ( count( $uid_ips ) >= 3 && ! $is_admin ) {
						return array(
							'valid'     => false,
							'verified'  => false,
							'live_mode' => $live_mode,
							'uid'       => $verified_uid,
							'message'   => '🔒 Anti-Sharing Security Lock: This Buyer KR-UID is already bound to the maximum of 3 personal devices/IPs. Forwarding or sharing your Buyer Vault link is prohibited.',
						);
					}
					$uid_ips[]                  = $ip_hash;
					$ip_locks[ $verified_uid ]  = $uid_ips;
					update_option( 'keystone_uid_ip_locks_v10', $ip_locks, false );
				}

				$catalog      = keystone_get_protocol_tier_catalog( $verified_uid );
				$t_key        = isset( $catalog[ (string) $order['tier'] ] ) ? (string) $order['tier'] : '1';
				$t_obj        = $catalog[ $t_key ];
				return array(
					'valid'                 => true,
					'verified'              => true,
					'live_mode'             => $live_mode,
					'uid'                   => $verified_uid,
					'order_id'              => (string) ( $order['order_id'] ?? '' ),
					'buyer_name'            => (string) ( $order['buyer_name'] ?? 'Verified Builder' ),
					'buyer_email'           => (string) ( $order['buyer_email'] ?? '' ),
					'tier'                  => $t_key,
					'tier_name'             => (string) ( $order['tier_name'] ?? $t_obj['name'] ),
					'price'                 => (string) ( $order['price'] ?? $t_obj['price'] ),
					'status'                => (string) ( $order['status'] ?? 'waitlist_reserved' ),
					'walkthrough_video_id'  => $t_obj['walkthrough_video_id'],
					'walkthrough_video_url' => $t_obj['walkthrough_video_url'],
					'walkthrough_title'     => $t_obj['walkthrough_title'],
					'unlocked_downloads'    => $t_obj['unlocked_downloads'],
					'unlocked_modules'      => $t_obj['unlocked_modules'],
					'unlocked_pdfs'         => $t_obj['unlocked_pdfs'],
					'message'               => $live_mode
						? '✔ Buyer KR-UID Verified! Your 6-Tab Course Portal, Downloadable Breakdown PDFs, Copy-Paste Prompt Packs & 24/7 AI Tutor are unlocked.'
						: sprintf(
							'✔ One-Time Launch Rate Locked In ($%s USD) & Buyer Vault Unlocked (UID: %s)! Your 6-Tab Course Portal, Downloadable Breakdown PDFs, Copy-Paste Prompt Packs & 24/7 AI Architect Tutor are active below.',
							(string) ( $order['price'] ?? $t_obj['price'] ),
							$verified_uid
						),
				);
			}
		}
	}

	return array(
		'valid'     => false,
		'verified'  => false,
		'live_mode' => $live_mode,
		'uid'       => $uid,
		'message'   => '🔒 Unrecognized Buyer KR-UID. Please enter a verified Buyer KR-UID or lock in your one-time access rate above to receive your personal KR-UID.',
	);
}

/**
 * Build the Locked Top-and-Bottom Keystone Crest Logo HTML Email Shell
 * (#04070d Obsidian, #d4af37 Sovereign Gold, #38bdf8 Baby Blue).
 */
function keystone_build_locked_protocol_email_shell(
	string $buyer_name,
	string $kicker,
	string $headline,
	string $inner_html,
	string $cta_url,
	string $cta_text
): string {
	$logo_url = get_stylesheet_directory_uri() . '/assets/images/keystone_real_logo_badge_bold.png';

	return '
<div style="max-width:640px;margin:16px auto;background-color:#04070d;border-radius:16px;overflow:hidden;border:1.5px solid #d4af37;box-shadow:0 16px 42px rgba(0,0,0,0.85);font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif;color:#f8fafc;">
	<!-- LOCKED TOP HEADER WITH CENTERED KEYSTONE CREST LOGO -->
	<table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;background-color:#04070d;text-align:center;border-bottom:2px solid #d4af37;">
		<tr>
			<td align="center" style="background-color:#04070d;padding:26px 24px 20px 24px;text-align:center;">
				<img src="' . esc_url( $logo_url ) . '" alt="Keystone Recomposition Crest Logo" width="88" style="width:88px !important;max-width:88px !important;height:auto !important;display:block;margin:0 auto 10px auto;border-radius:10px;border:1px solid rgba(212,175,55,0.5);" />
				<div style="color:#d4af37;font-size:11px;font-weight:800;letter-spacing:1.8px;text-transform:uppercase;margin:0 0 4px 0;">' . esc_html( $kicker ) . '</div>
				<h1 style="color:#ffffff;font-size:20px;font-weight:900;letter-spacing:1.2px;text-transform:uppercase;margin:0 0 5px 0;">KEYSTONE AI PROTOCOLS</h1>
				<div style="color:#38bdf8;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin:0;">WAYNE STEVENSON &bull; LICENSED BC BUILDER #52603 &bull; AUTONOMOUS AI SYSTEMS</div>
			</td>
		</tr>
	</table>

	<!-- DYNAMIC MIDDLE BODY -->
	<div style="padding:28px 30px 24px 30px;color:#e2e8f0;font-size:14.5px;line-height:1.68;background-color:#070c18;">
		<h2 style="color:#ffffff;font-size:19px;font-weight:800;margin:0 0 12px 0;">' . esc_html( $headline ) . '</h2>
		<p style="margin:0 0 14px 0;color:#f8fafc;">Hi <strong>' . esc_html( $buyer_name ) . '</strong>,</p>
		' . $inner_html . '

		<!-- 1-CLICK MAGIC PORTAL CTA BUTTON -->
		<div style="text-align:center;margin:24px 0 22px 0;">
			<a href="' . esc_url( $cta_url ) . '" style="display:inline-block;background:linear-gradient(135deg,#f3e5ab 0%,#d4af37 50%,#aa8010 100%);color:#04070d !important;font-weight:900;font-size:13px;text-transform:uppercase;letter-spacing:0.8px;padding:14px 28px;border-radius:9999px;text-decoration:none;box-shadow:0 6px 20px rgba(212,175,55,0.4);">
				' . esc_html( $cta_text ) . ' &rarr;
			</a>
		</div>

		<!-- 24/7 AUTONOMOUS AI TEACHER BANNER -->
		<div style="background:rgba(56,189,248,0.10);border:1px solid #38bdf8;border-radius:12px;padding:14px 16px;margin:18px 0;color:#f8fafc;font-size:13px;line-height:1.55;">
			<strong style="color:#38bdf8;">🤖 24/7 Autonomous AI Teacher Active:</strong> Use the Self-Service Portal or reply directly to this email anytime with questions&mdash;our AI Architect will walk you through every step!
		</div>

		<!-- LOCKED BOTTOM EXECUTIVE SIGNATURE WITH KEYSTONE CREST LOGO -->
		<table width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-top:22px;border-top:1px solid rgba(212,175,55,0.35);padding-top:18px;">
			<tr>
				<td width="76" valign="middle" style="padding-right:14px;">
					<img src="' . esc_url( $logo_url ) . '" alt="Keystone Crest Logo" width="68" style="width:68px !important;max-width:68px !important;height:auto !important;display:block;border-radius:8px;border:1px solid #d4af37;" />
				</td>
				<td valign="middle" style="font-size:12px;color:#94a3b8;line-height:1.55;">
					<div style="font-weight:800;color:#ffffff;font-size:14px;">Wayne Stevenson</div>
					<div style="color:#d4af37;font-weight:700;font-size:11.5px;">Founder &amp; Systems Architect &bull; Keystone Recomposition &amp; Keystone Possibilities Ltd.</div>
					<div style="color:#38bdf8;font-weight:700;font-size:11px;">BC Housing Licensed Builder #52603 &bull; 2-5-10 National Home Warranty &bull; BC Hydro Civil ES54</div>
					<div style="margin-top:4px;font-size:11.5px;color:#cbd5e1;">
						Direct Email: <a href="mailto:keystonerecomposition@gmail.com" style="color:#38bdf8;text-decoration:none;font-weight:700;">keystonerecomposition@gmail.com</a> &bull;
						Portal: <a href="' . esc_url( home_url( '/ai-protocols/' ) ) . '" style="color:#d4af37;text-decoration:underline;font-weight:700;">keystonerecomposition.com/ai-protocols/</a>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>';
}

/**
 * Authenticated `?vault_download=` Stream Handler.
 * Streams the Copy-Paste Prompt Pack (.zip) from `assets/vault_packs/` or generates a valid fallback on the fly.
 */
function keystone_handle_vault_download_stream(): void {
	if ( empty( $_GET['vault_download'] ) ) {
		return;
	}

	$pack_slug = sanitize_key( (string) wp_unslash( $_GET['vault_download'] ) );
	$raw_uid   = isset( $_GET['uid'] ) ? sanitize_text_field( (string) wp_unslash( $_GET['uid'] ) ) : '';

	$allowed_packs = array(
		'tier1_blueprint_pack'       => array(
			'filename' => 'Keystone_Tier01_Antigravity_Brain_And_Flow_Prompt_Pack.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 1,
		),
		'tier1_website_channel_pack' => array(
			'filename' => 'Keystone_Tier01_Website_And_YouTube_Channel_Prompts.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 1,
		),
		'tier1_gsc_indexer'          => array(
			'filename' => 'Keystone_Tier01_Website_And_YouTube_Channel_Prompts.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 1,
		),
		'tier2_swarm_pack'           => array(
			'filename' => 'Keystone_Tier02_Multi_Agent_Role_Prompts_And_B2B_Suite.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 2,
		),
		'tier3_workstation_pack'     => array(
			'filename' => 'Keystone_Tier03_Full_Stack_Creator_Workstation_Suite.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 3,
		),
	);

	if ( ! isset( $allowed_packs[ $pack_slug ] ) ) {
		wp_die( 'Invalid Keystone Vault download package requested.', 'Invalid Package', array( 'response' => 404 ) );
	}

	// Verify Buyer KR-UID strictly (no public demo fallback)
	$check_uid    = '' !== $raw_uid ? $raw_uid : '';
	$verification = keystone_verify_user_vault_uid_internal( $check_uid );

	if ( empty( $verification['verified'] ) ) {
		wp_die(
			'🔒 Buyer KR-UID Verification Required: Please enter your verified Buyer KR-UID on /ai-protocols/ to unlock your Download Vault.',
			'Buyer KR-UID Required',
			array( 'response' => 403 )
		);
	}

	$pack_info = $allowed_packs[ $pack_slug ];
	$file_path = get_stylesheet_directory() . '/assets/vault_packs/' . $pack_info['filename'];

	if ( file_exists( $file_path ) && is_readable( $file_path ) ) {
		$size = (int) filesize( $file_path );
		nocache_headers();
		header( 'Content-Type: ' . $pack_info['mime'] );
		header( 'Content-Disposition: attachment; filename="' . $pack_info['filename'] . '"' );
		header( 'Content-Length: ' . $size );
		readfile( $file_path );
		exit;
	}

	// Fallback on-the-fly valid ZIP archive with Copy-Paste Antigravity Brain, Google Flow ~20-word Prompts & Website Prompts
	$readme_txt  = "============================================================================\r\n";
	$readme_txt .= "KEYSTONE AI PROTOCOLS — COPY-PASTE ANTIGRAVITY BRAIN, FLOW & WEBSITE PACK\r\n";
	$readme_txt .= "Package: " . $pack_info['filename'] . "\r\n";
	$readme_txt .= "Verified UID: " . $verification['uid'] . "\r\n";
	$readme_txt .= "Self-Service Portal & 24/7 AI Tutor: https://keystonerecomposition.com/ai-protocols/?uid=" . $verification['uid'] . "#kr-self-service-portal\r\n";
	$readme_txt .= "============================================================================\r\n\r\n";
	$readme_txt .= "1. PASTE THIS INTO GOOGLE ANTIGRAVITY TO BUILD YOUR 4 BRAIN FOLDERS:\r\n";
	$readme_txt .= "   Create 4 folders in my workspace: 01_Brain_Rules, 02_Video_Prompts, 03_Website_Builder, and 04_YouTube_Channel.\r\n";
	$readme_txt .= "   Inside 01_Brain_Rules/AGENTS.md, write my brand voice rules, target audience, and color palette.\r\n\r\n";
	$readme_txt .= "2. PASTE THIS INTO ANTIGRAVITY TO GENERATE ~20-WORD (18-24 WORD) GOOGLE FLOW VIDEO PROMPTS:\r\n";
	$readme_txt .= "   Generate 6 ten-second Google Flow video scene prompts for my topic. Keep each prompt strictly between 18 and 24 words\r\n";
	$readme_txt .= "   describing the presenter speaking with natural gestures, warm studio lighting, and 35mm cinema camera tracking.\r\n\r\n";
	$readme_txt .= "3. PASTE THIS INTO ANTIGRAVITY TO BUILD YOUR WEBSITE HERO & ARTICLE LAYOUT:\r\n";
	$readme_txt .= "   Build a high-converting dark-luxury homepage hero section and SEO article template (#04070d background, #d4af37 gold buttons,\r\n";
	$readme_txt .= "   #38bdf8 baby-blue accents) with embedded YouTube video player, lead capture form, and FAQ schema.\r\n";

	$zip_bytes = '';
	if ( class_exists( 'ZipArchive' ) ) {
		$tmp_file = wp_tempnam( $pack_slug );
		$zip      = new ZipArchive();
		if ( true === $zip->open( $tmp_file, ZipArchive::OVERWRITE ) ) {
			$zip->addFromString( 'README_COPY_PASTE_PROMPTS.txt', $readme_txt );
			$zip->close();
			$zip_bytes = (string) file_get_contents( $tmp_file );
			@unlink( $tmp_file );
		}
	}

	if ( '' === $zip_bytes ) {
		// Minimal valid PKZIP single-file uncompressed container
		$fname     = 'README_COPY_PASTE_PROMPTS.txt';
		$crc       = crc32( $readme_txt );
		$len       = strlen( $readme_txt );
		$fn_len    = strlen( $fname );
		$lfh       = "\x50\x4b\x03\x04\x0a\x00\x00\x00\x00\x00\x00\x00\x21\x00"
			. pack( 'V', $crc ) . pack( 'V', $len ) . pack( 'V', $len )
			. pack( 'v', $fn_len ) . pack( 'v', 0 ) . $fname . $readme_txt;
		$cdh       = "\x50\x4b\x01\x02\x14\x00\x0a\x00\x00\x00\x00\x00\x00\x00\x21\x00"
			. pack( 'V', $crc ) . pack( 'V', $len ) . pack( 'V', $len )
			. pack( 'v', $fn_len ) . pack( 'v', 0 ) . pack( 'v', 0 ) . pack( 'v', 0 ) . pack( 'v', 0 )
			. pack( 'V', 32 ) . pack( 'V', 0 ) . $fname;
		$eocd      = "\x50\x4b\x05\x06\x00\x00\x00\x00\x01\x00\x01\x00"
			. pack( 'V', strlen( $cdh ) ) . pack( 'V', strlen( $lfh ) ) . "\x00\x00";
		$zip_bytes = $lfh . $cdh . $eocd;
	}

	nocache_headers();
	header( 'Content-Type: application/zip' );
	header( 'Content-Disposition: attachment; filename="' . $pack_info['filename'] . '"' );
	header( 'Content-Length: ' . strlen( $zip_bytes ) );
	echo $zip_bytes;
	exit;
}
add_action( 'template_redirect', 'keystone_handle_vault_download_stream', 5 );

/**
 * Register REST API routes for Automated Order Fulfillment, Vault UID Verification,
 * Stripe Webhook, Interactive Brain/Channel/Website Setup Intake Form & 24/7 Self-Service AI Architect Tutor.
 */
add_action( 'rest_api_init', function () {
	register_rest_route( 'keystone/v1', '/protocol-order', array(
		'methods'             => 'POST',
		'permission_callback' => '__return_true',
		'callback'            => 'keystone_handle_protocol_order_submission',
	) );

	register_rest_route( 'keystone/v1', '/protocol-orders', array(
		'methods'             => 'GET',
		'permission_callback' => function () {
			return current_user_can( 'manage_options' );
		},
		'callback'            => function () {
			$orders  = get_option( 'keystone_protocol_orders_v10', array() );
			$intakes = get_option( 'keystone_protocol_setup_intakes_v10', array() );
			return new WP_REST_Response( array(
				'count'         => is_array( $orders ) ? count( $orders ) : 0,
				'intakes_count' => is_array( $intakes ) ? count( $intakes ) : 0,
				'live_mode'     => (bool) KEYSTONE_VISA_AND_VIDEOS_LIVE,
				'orders'        => is_array( $orders ) ? $orders : array(),
				'setup_intakes' => is_array( $intakes ) ? $intakes : array(),
			), 200 );
		},
	) );

	register_rest_route( 'keystone/v1', '/verify-vault-uid', array(
		'methods'             => array( 'GET', 'POST' ),
		'permission_callback' => '__return_true',
		'callback'            => function ( WP_REST_Request $request ) {
			$uid    = (string) ( $request->get_param( 'uid' ) ?? '' );
			$result = keystone_verify_user_vault_uid_internal( $uid );
			return new WP_REST_Response( $result, 200 );
		},
	) );

	register_rest_route( 'keystone/v1', '/stripe-webhook', array(
		'methods'             => 'POST',
		'permission_callback' => '__return_true',
		'callback'            => 'keystone_handle_stripe_webhook',
	) );

	register_rest_route( 'keystone/v1', '/protocol-setup-form', array(
		'methods'             => 'POST',
		'permission_callback' => '__return_true',
		'callback'            => 'keystone_handle_protocol_setup_form',
	) );

	register_rest_route( 'keystone/v1', '/protocol-tutor', array(
		'methods'             => 'POST',
		'permission_callback' => '__return_true',
		'callback'            => 'keystone_handle_protocol_tutor',
	) );
} );

/**
 * Process Automated AI Protocol Order / Priority Launch Rate Reservation.
 */
function keystone_handle_protocol_order_submission( WP_REST_Request $request ): WP_REST_Response {
	$params      = $request->get_json_params() ?: $request->get_params();
	$buyer_name  = sanitize_text_field( (string) ( $params['buyer_name'] ?? '' ) );
	$buyer_email = sanitize_email( (string) ( $params['buyer_email'] ?? '' ) );
	$tier        = sanitize_text_field( (string) ( $params['tier'] ?? '1' ) );
	$promo_code  = strtoupper( sanitize_text_field( (string) ( $params['promo_code'] ?? '' ) ) );
	$notes       = sanitize_textarea_field( (string) ( $params['notes'] ?? '' ) );

	if ( '' === $buyer_name || ! is_email( $buyer_email ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Please enter your full name and a valid email address to reserve your Launch Rate and generate your priority UID.',
		), 400 );
	}

	if ( ! in_array( $tier, array( '1', '2', '3' ), true ) ) {
		$tier = '1';
	}

	$user_uid     = keystone_generate_user_vault_uid( $buyer_email, $tier );
	$tier_catalog = keystone_get_protocol_tier_catalog( $user_uid );
	$tier_info    = $tier_catalog[ $tier ];
	$price        = (float) $tier_info['price'];

	$promo_discounts = array(
		'BUILDER10'  => 10.0,
		'WAYNE10'    => 10.0,
		'KEYSTONE20' => 20.0,
		'PROMO2026'  => 15.0,
	);
	if ( isset( $promo_discounts[ $promo_code ] ) && '3' !== $tier ) {
		$price = max( 0.0, $price - $promo_discounts[ $promo_code ] );
	}

	$formatted_price = number_format( $price, 2, '.', '' );
	$live_mode       = (bool) KEYSTONE_VISA_AND_VIDEOS_LIVE;
	$order_id        = 'KR-ORD-' . gmdate( 'Ymd-His' ) . '-' . strtoupper( wp_generate_password( 4, false ) );

	$order_record = array(
		'order_id'              => $order_id,
		'user_uid'              => $user_uid,
		'tier'                  => $tier,
		'tier_name'             => $tier_info['name'],
		'price'                 => $formatted_price,
		'promo_code'            => $promo_code,
		'buyer_name'            => $buyer_name,
		'buyer_email'           => $buyer_email,
		'notes'                 => $notes,
		'walkthrough_video_url' => $tier_info['walkthrough_video_url'],
		'status'                => $live_mode ? 'fulfilled_pending_wayne_followup' : 'waitlist_reserved',
		'created_at'            => gmdate( 'c' ),
	);

	$orders = get_option( 'keystone_protocol_orders_v10', array() );
	if ( ! is_array( $orders ) ) {
		$orders = array();
	}
	array_unshift( $orders, $order_record );
	if ( count( $orders ) > 250 ) {
		$orders = array_slice( $orders, 0, 250 );
	}
	update_option( 'keystone_protocol_orders_v10', $orders, false );

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: Wayne Stevenson — Keystone AI Protocols <keystonerecomposition@gmail.com>',
		'Reply-To: keystonerecomposition@gmail.com',
	);

	$magic_portal_url = home_url( '/ai-protocols/?uid=' . rawurlencode( $user_uid ) . '#kr-self-service-portal' );

	$downloads_html = '';
	foreach ( $tier_info['unlocked_downloads'] as $dl ) {
		$downloads_html .= '<li style="margin-bottom:8px;"><a href="' . esc_url( $dl['url'] ) . '" style="color:#38bdf8;font-weight:700;text-decoration:none;">' . esc_html( $dl['label'] ) . '</a></li>';
	}

	$pdf_list_html = '<li style="margin-bottom:6px;"><a href="' . esc_url( $magic_portal_url ) . '" style="color:#d4af37;font-weight:700;text-decoration:none;">📄 Interactive Breakdown PDFs (' . esc_html( implode( ', ', $tier_info['unlocked_pdfs'] ) ) . ') — View Visual Brain Diagram &amp; Copy-Paste Prompts On-Screen or Download %PDF-1.4</a></li>';

	$inner_email_html = '
		<p style="color:#cbd5e1;font-size:14px;line-height:1.6;">Thank you for ' . ( $live_mode ? 'ordering' : 'locking in your priority launch rate for' ) . ' <strong>' . esc_html( $tier_info['name'] ) . ' ($' . esc_html( $formatted_price ) . ' USD)</strong>. Your unique Vault UID is active and unlocks the <strong>Self-Service 6-Tab Course, Visual Brain Setup Diagram, Copy-Paste Antigravity &amp; Google Flow Prompts, Breakdown PDFs &amp; 24/7 AI Architect Tutor</strong> immediately:</p>
		<div style="background:#04070d;border:1.5px solid #d4af37;border-radius:12px;padding:14px 18px;margin:16px 0;">
			<div style="font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;">YOUR VERIFIED VAULT UID</div>
			<div style="font-size:19px;font-weight:900;color:#38bdf8;font-family:monospace;margin-top:4px;">' . esc_html( $user_uid ) . '</div>
			<div style="font-size:11.5px;color:#f6d365;margin-top:4px;">Order / Reservation ID: ' . esc_html( $order_id ) . ' &bull; Locked Rate: $' . esc_html( $formatted_price ) . ' USD</div>
		</div>
		<h3 style="color:#38bdf8;font-size:15px;margin:18px 0 8px 0;">🎬 Step 1: 6-Tab Video Walkthroughs, Visual Brain Diagram &amp; Spec PDFs</h3>
		<ul style="color:#cbd5e1;font-size:13.5px;line-height:1.6;padding-left:18px;">
			<li style="margin-bottom:6px;"><a href="' . esc_url( $tier_info['walkthrough_video_url'] ) . '" style="color:#ffffff;font-weight:800;text-decoration:underline;">▶ Watch Wayne\'s Recorded Step-by-Step AI Video &amp; Brain Setup Walkthrough</a></li>
			' . $pdf_list_html . '
		</ul>
		<h3 style="color:#d4af37;font-size:15px;margin:18px 0 8px 0;">📦 Step 2: Copy-Paste Antigravity Brain, Google Flow &amp; Website Prompt Packs (.ZIP)</h3>
		<ul style="color:#cbd5e1;font-size:13.5px;line-height:1.6;padding-left:18px;">' . $downloads_html . '</ul>';

	$buyer_subject = sprintf(
		'[Keystone AI Protocols] %s: %s (UID: %s)',
		$live_mode ? 'Instant Vault Access Unlocked' : 'Launch Rate Locked In + Self-Service Portal Unlocked',
		$tier_info['name'],
		$user_uid
	);

	$buyer_body = keystone_build_locked_protocol_email_shell(
		$buyer_name,
		$live_mode ? 'AUTOMATED FULFILLMENT VAULT // INSTANT ACCESS' : 'PRIORITY LAUNCH RESERVATION // SELF-SERVICE PORTAL UNLOCKED',
		'Your 6-Tab Course Portal, Visual Brain Diagram & Copy-Paste Prompts Are Ready',
		$inner_email_html,
		$magic_portal_url,
		'OPEN MY 6-TAB COURSE & AI TUTOR PORTAL'
	);

	@wp_mail( $buyer_email, $buyer_subject, $buyer_body, $headers );

	$admin_subject = sprintf( '[Keystone AI Protocols %s] %s ($%s USD) — %s [%s]', $live_mode ? 'Order' : 'Launch Reservation', $tier_info['name'], $formatted_price, $buyer_name, $user_uid );
	$admin_body    = sprintf(
		"Keystone AI Protocols Lead / Reservation Saved!\n\nReservation ID: %s\nPriority UID: %s\nStatus: %s\nTier: %s\nLocked Price: $%s USD\nBuyer Name: %s\nBuyer Email: %s\nPromo Code: %s\nNotes: %s\nMagic Portal Link: %s\nTimestamp: %s",
		$order_id,
		$user_uid,
		$order_record['status'],
		$tier_info['name'],
		$formatted_price,
		$buyer_name,
		$buyer_email,
		$promo_code ?: 'NONE',
		$notes ?: 'None',
		$magic_portal_url,
		gmdate( 'Y-m-d H:i:s \U\T\C' )
	);

	@wp_mail( 'keystonerecomposition@gmail.com', $admin_subject, $admin_body );

	$response_msg = $live_mode
		? '✔ UID Verified & Order Fulfilled! Your 6-Tab Course Portal, Visual Brain Setup Diagram, Copy-Paste Antigravity Prompts, 12 Breakdown PDFs, and 24/7 AI Tutor are unlocked below, and a copy has been emailed to ' . $buyer_email . '.'
		: sprintf(
			'✔ Launch Rate Locked In ($%s USD) & Self-Service Portal Unlocked (UID: %s)! Your 6-Tab Course Portal, Visual Brain Setup Diagram, Copy-Paste Prompt Packs, and 24/7 AI Architect Tutor are unlocked below, and your Magic Portal Link has been emailed to %s.',
			$formatted_price,
			$user_uid,
			$buyer_email
		);

	return new WP_REST_Response( array(
		'success'               => true,
		'live_mode'             => $live_mode,
		'status'                => $order_record['status'],
		'order_id'              => $order_id,
		'user_uid'              => $user_uid,
		'tier'                  => $tier,
		'tier_name'             => $tier_info['name'],
		'price'                 => $formatted_price,
		'buyer_name'            => $buyer_name,
		'buyer_email'           => $buyer_email,
		'stripe_checkout_url'   => $tier_info['stripe_checkout_url'],
		'walkthrough_video_id'  => $tier_info['walkthrough_video_id'],
		'walkthrough_video_url' => $tier_info['walkthrough_video_url'],
		'walkthrough_title'     => $tier_info['walkthrough_title'],
		'unlocked_downloads'    => $tier_info['unlocked_downloads'],
		'unlocked_modules'      => $tier_info['unlocked_modules'],
		'unlocked_pdfs'         => $tier_info['unlocked_pdfs'],
		'magic_portal_url'      => $magic_portal_url,
		'message'               => $response_msg,
	), 200 );
}

/**
 * Stripe Hosted Checkout HMAC-SHA256 Webhook Endpoint (`POST /wp-json/keystone/v1/stripe-webhook`).
 * Verifies `HTTP_STRIPE_SIGNATURE`, checks idempotency (`keystone_stripe_processed_events`),
 * mints deterministic `KR-UID-XXXXXXXXXXXX`, saves order with `status = 'paid_verified'`,
 * and dispatches the Locked Top-and-Bottom Logo Welcome Email.
 */
function keystone_handle_stripe_webhook( WP_REST_Request $request ): WP_REST_Response {
	$raw_payload = (string) $request->get_body();
	$sig_header  = (string) ( $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? $request->get_header( 'stripe-signature' ) ?? '' );
	$secret      = (string) KEYSTONE_STRIPE_WEBHOOK_SECRET;

	if ( '' === $secret ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Stripe webhook secret is not configured yet.',
		), 400 );
	}

	if ( '' === $sig_header || '' === $raw_payload ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Missing Stripe signature header or payload.',
		), 400 );
	}

	$timestamp = '';
	$v1_sigs   = array();
	foreach ( explode( ',', $sig_header ) as $part ) {
		$kv = explode( '=', trim( $part ), 2 );
		if ( 2 === count( $kv ) ) {
			if ( 't' === $kv[0] ) {
				$timestamp = $kv[1];
			} elseif ( 'v1' === $kv[0] ) {
				$v1_sigs[] = $kv[1];
			}
		}
	}

	if ( '' === $timestamp || empty( $v1_sigs ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Malformed Stripe signature header.',
		), 400 );
	}

	$expected_sig = hash_hmac( 'sha256', $timestamp . '.' . $raw_payload, $secret );
	$sig_matched  = false;
	foreach ( $v1_sigs as $candidate ) {
		if ( hash_equals( $expected_sig, $candidate ) ) {
			$sig_matched = true;
			break;
		}
	}

	if ( ! $sig_matched ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Invalid HMAC-SHA256 Stripe webhook signature.',
		), 401 );
	}

	$event = json_decode( $raw_payload, true );
	if ( ! is_array( $event ) || empty( $event['id'] ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Invalid JSON event payload.',
		), 400 );
	}

	$event_id   = sanitize_text_field( (string) $event['id'] );
	$event_type = sanitize_text_field( (string) ( $event['type'] ?? '' ) );

	// Idempotency guard
	$processed_events = get_option( 'keystone_stripe_processed_events', array() );
	if ( ! is_array( $processed_events ) ) {
		$processed_events = array();
	}
	if ( in_array( $event_id, $processed_events, true ) ) {
		return new WP_REST_Response( array(
			'success'    => true,
			'idempotent' => true,
			'event_id'   => $event_id,
			'message'    => 'Event already processed.',
		), 200 );
	}

	$processed_events[] = $event_id;
	if ( count( $processed_events ) > 500 ) {
		$processed_events = array_slice( $processed_events, -500 );
	}
	update_option( 'keystone_stripe_processed_events', $processed_events, false );

	if ( 'checkout.session.completed' !== $event_type ) {
		return new WP_REST_Response( array(
			'success'    => true,
			'event_type' => $event_type,
			'message'    => 'Event acknowledged (non-checkout event).',
		), 200 );
	}

	$session     = $event['data']['object'] ?? array();
	$buyer_email = sanitize_email( (string) ( $session['customer_details']['email'] ?? $session['customer_email'] ?? '' ) );
	$buyer_name  = sanitize_text_field( (string) ( $session['customer_details']['name'] ?? 'Verified Stripe Buyer' ) );
	$tier        = sanitize_text_field( (string) ( $session['metadata']['tier'] ?? '1' ) );
	if ( ! in_array( $tier, array( '1', '2', '3' ), true ) ) {
		$tier = '1';
	}

	if ( ! is_email( $buyer_email ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'No valid customer email in checkout.session.completed.',
		), 400 );
	}

	$user_uid        = keystone_generate_user_vault_uid( $buyer_email, $tier );
	$tier_catalog    = keystone_get_protocol_tier_catalog( $user_uid );
	$tier_info       = $tier_catalog[ $tier ];
	$amount_cents    = isset( $session['amount_total'] ) ? (int) $session['amount_total'] : (int) round( (float) $tier_info['price'] * 100 );
	$formatted_price = number_format( $amount_cents / 100, 2, '.', '' );
	$order_id        = 'KR-STRIPE-' . gmdate( 'Ymd-His' ) . '-' . strtoupper( substr( md5( $event_id ), 0, 6 ) );

	$order_record = array(
		'order_id'              => $order_id,
		'stripe_event_id'       => $event_id,
		'stripe_session_id'     => sanitize_text_field( (string) ( $session['id'] ?? '' ) ),
		'user_uid'              => $user_uid,
		'tier'                  => $tier,
		'tier_name'             => $tier_info['name'],
		'price'                 => $formatted_price,
		'buyer_name'            => $buyer_name,
		'buyer_email'           => $buyer_email,
		'walkthrough_video_url' => $tier_info['walkthrough_video_url'],
		'status'                => 'paid_verified',
		'created_at'            => gmdate( 'c' ),
	);

	$orders = get_option( 'keystone_protocol_orders_v10', array() );
	if ( ! is_array( $orders ) ) {
		$orders = array();
	}
	array_unshift( $orders, $order_record );
	if ( count( $orders ) > 250 ) {
		$orders = array_slice( $orders, 0, 250 );
	}
	update_option( 'keystone_protocol_orders_v10', $orders, false );

	$magic_portal_url = home_url( '/ai-protocols/?uid=' . rawurlencode( $user_uid ) . '#kr-self-service-portal' );
	$downloads_html   = '';
	foreach ( $tier_info['unlocked_downloads'] as $dl ) {
		$downloads_html .= '<li style="margin-bottom:8px;"><a href="' . esc_url( $dl['url'] ) . '" style="color:#38bdf8;font-weight:700;text-decoration:none;">' . esc_html( $dl['label'] ) . '</a></li>';
	}

	$inner_html = '
		<p style="color:#cbd5e1;font-size:14px;line-height:1.6;">Your Stripe payment of <strong>$' . esc_html( $formatted_price ) . ' USD</strong> for <strong>' . esc_html( $tier_info['name'] ) . '</strong> is verified! Your permanent Vault UID is unlocked below:</p>
		<div style="background:#04070d;border:1.5px solid #d4af37;border-radius:12px;padding:14px 18px;margin:16px 0;">
			<div style="font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;">YOUR PAID &amp; VERIFIED VAULT UID</div>
			<div style="font-size:19px;font-weight:900;color:#38bdf8;font-family:monospace;margin-top:4px;">' . esc_html( $user_uid ) . '</div>
			<div style="font-size:11.5px;color:#f6d365;margin-top:4px;">Order ID: ' . esc_html( $order_id ) . ' &bull; Status: PAID_VERIFIED</div>
		</div>
		<h3 style="color:#d4af37;font-size:15px;margin:18px 0 8px 0;">📦 Instant Copy-Paste Prompt Packs &amp; Breakdown PDFs</h3>
		<ul style="color:#cbd5e1;font-size:13.5px;line-height:1.6;padding-left:18px;">' . $downloads_html . '</ul>';

	$email_body = keystone_build_locked_protocol_email_shell(
		$buyer_name,
		'STRIPE PAYMENT VERIFIED // INSTANT VAULT UNLOCK',
		'Welcome to Keystone AI Protocols — Your Vault Is Unlocked',
		$inner_html,
		$magic_portal_url,
		'LAUNCH MY 6-TAB COURSE & AI TUTOR PORTAL'
	);

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: Wayne Stevenson — Keystone AI Protocols <keystonerecomposition@gmail.com>',
		'Reply-To: keystonerecomposition@gmail.com',
	);
	@wp_mail( $buyer_email, sprintf( '[Keystone AI Protocols] Paid & Unlocked: %s (UID: %s)', $tier_info['name'], $user_uid ), $email_body, $headers );

	return new WP_REST_Response( array(
		'success'          => true,
		'status'           => 'paid_verified',
		'order_id'         => $order_id,
		'user_uid'         => $user_uid,
		'tier'             => $tier,
		'magic_portal_url' => $magic_portal_url,
	), 200 );
}

/**
 * Interactive Brain, YouTube Channel & Website Setup Intake Form Endpoint
 * (`POST /wp-json/keystone/v1/protocol-setup-form`).
 *
 * Accepts `{ uid, buyer_name, buyer_email, youtube_channel_name, channel_niche, website_domain, brand_account_status, current_roadblock }`.
 * Generates custom Copy-Paste Antigravity Brain Setup Prompt, 3 custom ~20-word (18–24 word) Google Flow prompts,
 * custom Website Builder prompt, and calibrated 480-character YouTube tag stack + Upload Defaults.
 * Persists to `keystone_protocol_setup_intakes_v10` (and attaches to matching order in `keystone_protocol_orders_v10`),
 * emails the buyer inside `keystone_build_locked_protocol_email_shell()`, and notifies `keystonerecomposition@gmail.com` (`/u/1`).
 */
function keystone_handle_protocol_setup_form( WP_REST_Request $request ): WP_REST_Response {
	$params               = $request->get_json_params() ?: $request->get_params();
	$uid                  = sanitize_text_field( (string) ( $params['uid'] ?? '' ) );
	$uid_verification     = keystone_verify_user_vault_uid_internal( $uid );
	if ( empty( $uid_verification['verified'] ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => '🔒 Buyer KR-UID Verification Required. Please enter your verified Buyer KR-UID to use the Custom Setup Generator and 24/7 AI Tutor.',
		), 403 );
	}
	$uid                  = (string) $uid_verification['uid'];
	$buyer_name           = sanitize_text_field( (string) ( $params['buyer_name'] ?? 'Keystone Builder' ) );
	$buyer_email          = sanitize_email( (string) ( $params['buyer_email'] ?? '' ) );
	$youtube_channel_name = sanitize_text_field( (string) ( $params['youtube_channel_name'] ?? 'My Authority Channel' ) );
	$channel_niche        = sanitize_text_field( (string) ( $params['channel_niche'] ?? 'AI Systems & Business Growth' ) );
	$website_domain       = sanitize_text_field( (string) ( $params['website_domain'] ?? 'mybrandwebsite.com' ) );
	$brand_account_status = sanitize_text_field( (string) ( $params['brand_account_status'] ?? 'Need to create Brand Account' ) );
	$current_roadblock    = sanitize_textarea_field( (string) ( $params['current_roadblock'] ?? 'Setting up my Antigravity Brain and generating my first Google Flow videos.' ) );

	if ( '' === trim( $youtube_channel_name ) ) {
		$youtube_channel_name = 'My Authority Channel';
	}
	if ( '' === trim( $channel_niche ) ) {
		$channel_niche = 'AI Systems & Business Growth';
	}
	if ( '' === trim( $website_domain ) ) {
		$website_domain = 'mybrandwebsite.com';
	}

	// 1. Custom Copy-Paste Antigravity Brain Setup Prompt
	$custom_brain_setup_prompt = sprintf(
		"You are my lead AI Systems Architect inside Google Antigravity. Initialize my 4-folder AI Brain workspace for my brand \"%s\" (%s) and website \"%s\":\n" .
		"1. Create folder 01_Brain_Rules/ and write AGENTS.md defining my brand voice for %s, my core niche (%s), and my primary call-to-action directing viewers to %s.\n" .
		"2. Create folder 02_Video_Prompts/ with a master template that generates 10-second Google Flow video prompts strictly between 18 and 24 words per scene.\n" .
		"3. Create folder 03_Website_Builder/ with dark-luxury design tokens (#04070d Obsidian, #d4af37 Gold, #38bdf8 Baby Blue) for %s.\n" .
		"4. Create folder 04_YouTube_Channel/ containing my Upload Defaults, 480-character tag stack, and episode checklist for %s.",
		$youtube_channel_name,
		$channel_niche,
		$website_domain,
		$youtube_channel_name,
		$channel_niche,
		$website_domain,
		$website_domain,
		$youtube_channel_name
	);

	// 2. Three Custom ~20-Word (18-24 Word) Google Flow 10-Second Video Scene Prompts
	$custom_flow_20word_prompts = array(
		sprintf(
			'Scene 1 (21 words): Confident presenter in dark tailored blazer speaking warmly in a modern acoustic oak studio, introducing %s with natural hand gestures.',
			$youtube_channel_name
		),
		sprintf(
			'Scene 2 (22 words): Medium close-up shot on 35mm cinema lens as the presenter explains %s step by step under soft golden rim lighting.',
			$channel_niche
		),
		sprintf(
			'Scene 3 (20 words): Presenter smiles with grounded two-handed builder posture, inviting viewers to visit %s and subscribe for weekly step-by-step tutorials.',
			$website_domain
		),
	);

	// 3. Custom Copy-Paste Antigravity Website Builder Prompt
	$custom_website_prompt = sprintf(
		"Build a high-converting dark-luxury homepage and SEO article template for \"%s\" (%s — %s).\n" .
		"- Use Obsidian (#04070d) backgrounds, Sovereign Gold (#d4af37) 9999px pill CTA buttons, and Baby Blue (#38bdf8) accents with 18px glassmorphic cards.\n" .
		"- Include a split Hero section featuring our latest %s YouTube video embed on the left and a 1-click Email Lead Capture card on the right.\n" .
		"- Generate valid Person, VideoObject, and FAQPage JSON-LD schema so every page scores 100/100 in Rank Math SEO.",
		$website_domain,
		$youtube_channel_name,
		$channel_niche,
		$youtube_channel_name
	);

	// 4. Calibrated 480-Character YouTube Tag Stack & Upload Defaults Template
	$clean_channel_tag = preg_replace( '/[^a-zA-Z0-9 ]/', '', $youtube_channel_name );
	$clean_niche_tag   = preg_replace( '/[^a-zA-Z0-9 ]/', '', $channel_niche );
	$raw_tags          = array(
		$clean_channel_tag,
		$clean_niche_tag,
		$clean_channel_tag . ' tutorial',
		$clean_niche_tag . ' guide',
		'AI video workflow',
		'Google Antigravity',
		'Google Flow AI video',
		'AI content creation 2026',
		'automated website builder',
		'YouTube brand growth',
		'digital business systems',
		'creator workstation setup',
		'step by step AI blueprint',
		$website_domain,
	);
	$tag_string        = implode( ', ', array_filter( array_map( 'trim', $raw_tags ) ) );
	if ( strlen( $tag_string ) > 480 ) {
		$tag_string = substr( $tag_string, 0, 477 );
		$last_comma = strrpos( $tag_string, ',' );
		if ( false !== $last_comma ) {
			$tag_string = substr( $tag_string, 0, $last_comma );
		}
	}

	$custom_youtube_tags_and_defaults = sprintf(
		"=== YOUTUBE UPLOAD DEFAULTS DESCRIPTION (%s) ===\n" .
		"Welcome to %s! In this episode, we break down practical %s strategies you can deploy today.\n\n" .
		"🌐 Explore our full resources & guides: https://%s\n" .
		"🔔 Subscribe to %s for weekly episodes!\n\n" .
		"=== CALIBRATED YOUTUBE TAG STACK (%d / 500 CHARS) ===\n%s",
		$youtube_channel_name,
		$youtube_channel_name,
		$channel_niche,
		preg_replace( '#^https?://#i', '', $website_domain ),
		$youtube_channel_name,
		strlen( $tag_string ),
		$tag_string
	);

	$intake_id     = 'KR-SETUP-' . gmdate( 'Ymd-His' ) . '-' . strtoupper( wp_generate_password( 4, false ) );
	$intake_record = array(
		'intake_id'                        => $intake_id,
		'uid'                              => $uid,
		'buyer_name'                       => $buyer_name,
		'buyer_email'                      => $buyer_email,
		'youtube_channel_name'             => $youtube_channel_name,
		'channel_niche'                    => $channel_niche,
		'website_domain'                   => $website_domain,
		'brand_account_status'             => $brand_account_status,
		'current_roadblock'                => $current_roadblock,
		'custom_brain_setup_prompt'        => $custom_brain_setup_prompt,
		'custom_flow_20word_prompts'       => $custom_flow_20word_prompts,
		'custom_website_prompt'            => $custom_website_prompt,
		'custom_youtube_tags_and_defaults' => $custom_youtube_tags_and_defaults,
		'created_at'                       => gmdate( 'c' ),
	);

	$intakes = get_option( 'keystone_protocol_setup_intakes_v10', array() );
	if ( ! is_array( $intakes ) ) {
		$intakes = array();
	}
	array_unshift( $intakes, $intake_record );
	if ( count( $intakes ) > 250 ) {
		$intakes = array_slice( $intakes, 0, 250 );
	}
	update_option( 'keystone_protocol_setup_intakes_v10', $intakes, false );

	// Also attach to matching order in `keystone_protocol_orders_v10` if present
	$orders = get_option( 'keystone_protocol_orders_v10', array() );
	if ( is_array( $orders ) ) {
		$updated_orders = false;
		foreach ( $orders as &$ord ) {
			$ord_uid   = strtoupper( (string) ( $ord['user_uid'] ?? '' ) );
			$ord_email = strtolower( (string) ( $ord['buyer_email'] ?? '' ) );
			if ( ( '' !== $uid && $ord_uid === strtoupper( $uid ) ) || ( '' !== $buyer_email && $ord_email === strtolower( $buyer_email ) ) ) {
				$ord['setup_intake'] = $intake_record;
				$updated_orders      = true;
				break;
			}
		}
		unset( $ord );
		if ( $updated_orders ) {
			update_option( 'keystone_protocol_orders_v10', $orders, false );
		}
	}

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: Wayne Stevenson — Keystone AI Protocols <keystonerecomposition@gmail.com>',
		'Reply-To: keystonerecomposition@gmail.com',
	);

	$magic_portal_url = home_url( '/ai-protocols/?uid=' . rawurlencode( $uid ) . '#kr-self-service-portal' );

	// Email the buyer their custom Copy-Paste Setup Plan if valid email provided
	$buyer_email_sent = false;
	if ( is_email( $buyer_email ) ) {
		$flow_list_items = '';
		foreach ( $custom_flow_20word_prompts as $fp ) {
			$flow_list_items .= '<li style="margin-bottom:6px;font-family:monospace;font-size:12.5px;color:#f8fafc;">' . esc_html( $fp ) . '</li>';
		}

		$inner_html = '
			<p style="color:#cbd5e1;font-size:14px;line-height:1.6;">Your custom <strong>Antigravity Brain, ~20-Word Google Flow Prompts, Website Builder Prompt &amp; YouTube Channel Setup Plan</strong> for <strong>' . esc_html( $youtube_channel_name ) . '</strong> (<code>' . esc_html( $website_domain ) . '</code>) is ready to copy and paste below:</p>
			<div style="background:#04070d;border:1.5px solid #d4af37;border-radius:12px;padding:14px 16px;margin:14px 0;">
				<div style="color:#d4af37;font-size:11.5px;font-weight:800;text-transform:uppercase;margin-bottom:6px;">🧠 1. COPY-PASTE ANTIGRAVITY BRAIN SETUP PROMPT</div>
				<pre style="white-space:pre-wrap;word-break:break-word;font-family:monospace;font-size:12px;color:#e2e8f0;margin:0;line-height:1.5;">' . esc_html( $custom_brain_setup_prompt ) . '</pre>
			</div>
			<div style="background:#04070d;border:1.5px solid #38bdf8;border-radius:12px;padding:14px 16px;margin:14px 0;">
				<div style="color:#38bdf8;font-size:11.5px;font-weight:800;text-transform:uppercase;margin-bottom:6px;">🎬 2. THREE ~20-WORD GOOGLE FLOW VIDEO SCENE PROMPTS (18–24 WORDS)</div>
				<ul style="margin:0;padding-left:18px;">' . $flow_list_items . '</ul>
			</div>
			<div style="background:#04070d;border:1.5px solid #d4af37;border-radius:12px;padding:14px 16px;margin:14px 0;">
				<div style="color:#d4af37;font-size:11.5px;font-weight:800;text-transform:uppercase;margin-bottom:6px;">🌐 3. COPY-PASTE WEBSITE BUILDER PROMPT (' . esc_html( $website_domain ) . ')</div>
				<pre style="white-space:pre-wrap;word-break:break-word;font-family:monospace;font-size:12px;color:#e2e8f0;margin:0;line-height:1.5;">' . esc_html( $custom_website_prompt ) . '</pre>
			</div>
			<div style="background:#04070d;border:1.5px solid #38bdf8;border-radius:12px;padding:14px 16px;margin:14px 0;">
				<div style="color:#38bdf8;font-size:11.5px;font-weight:800;text-transform:uppercase;margin-bottom:6px;">📺 4. YOUTUBE UPLOAD DEFAULTS &amp; 480-CHAR TAG STACK</div>
				<pre style="white-space:pre-wrap;word-break:break-word;font-family:monospace;font-size:12px;color:#e2e8f0;margin:0;line-height:1.5;">' . esc_html( $custom_youtube_tags_and_defaults ) . '</pre>
			</div>';

		$buyer_body = keystone_build_locked_protocol_email_shell(
			$buyer_name,
			'CUSTOM AI BRAIN, GOOGLE FLOW & WEBSITE SETUP PLAN',
			'Your Custom Copy-Paste Prompts for ' . $youtube_channel_name,
			$inner_html,
			$magic_portal_url,
			'OPEN MY SELF-SERVICE PORTAL & SPEC PDFS'
		);

		$buyer_email_sent = (bool) @wp_mail(
			$buyer_email,
			sprintf( '[Keystone AI Protocols] Your Custom Brain, Flow & Website Prompts: %s (%s)', $youtube_channel_name, $uid ),
			$buyer_body,
			$headers
		);
	}

	// Send `[Keystone Setup Intake]` notification to `keystonerecomposition@gmail.com` (`/u/1`) for Antigravity Email Automation
	$admin_subject = sprintf( '[Keystone Setup Intake] %s — %s (%s) [%s]', $youtube_channel_name, $buyer_name, $website_domain, $uid );
	$admin_body    = sprintf(
		"Keystone Interactive Brain, Channel & Website Setup Intake Submitted!\n\nIntake ID: %s\nVault UID: %s\nBuyer Name: %s\nBuyer Email: %s\nYouTube Channel Name: %s\nChannel Niche: %s\nWebsite Domain: %s\nBrand Account Status: %s\nCurrent Roadblock / Goal: %s\n\n--- GENERATED BRAIN SETUP PROMPT ---\n%s\n\n--- GENERATED WEBSITE PROMPT ---\n%s\n\nTimestamp: %s",
		$intake_id,
		$uid,
		$buyer_name,
		$buyer_email ?: 'Not provided',
		$youtube_channel_name,
		$channel_niche,
		$website_domain,
		$brand_account_status,
		$current_roadblock,
		$custom_brain_setup_prompt,
		$custom_website_prompt,
		gmdate( 'Y-m-d H:i:s \U\T\C' )
	);
	@wp_mail( 'keystonerecomposition@gmail.com', $admin_subject, $admin_body );

	return new WP_REST_Response( array(
		'success'                          => true,
		'intake_id'                        => $intake_id,
		'uid'                              => $uid,
		'buyer_name'                       => $buyer_name,
		'buyer_email'                      => $buyer_email,
		'youtube_channel_name'             => $youtube_channel_name,
		'channel_niche'                    => $channel_niche,
		'website_domain'                   => $website_domain,
		'brand_account_status'             => $brand_account_status,
		'current_roadblock'                => $current_roadblock,
		'custom_brain_setup_prompt'        => $custom_brain_setup_prompt,
		'custom_flow_20word_prompts'       => $custom_flow_20word_prompts,
		'custom_website_prompt'            => $custom_website_prompt,
		'custom_youtube_tags_and_defaults' => $custom_youtube_tags_and_defaults,
		'buyer_email_sent'                 => $buyer_email_sent,
		'message'                          => '✔ Custom Antigravity Brain Setup Prompt, 3 ~20-Word Google Flow Prompts, Website Prompt & YouTube Tag Stack generated!' . ( $buyer_email_sent ? ' A copy has also been emailed to ' . $buyer_email . '.' : '' ),
	), 200 );
}

/**
 * 24/7 Self-Service AI Architect Tutor Endpoint (`POST /wp-json/keystone/v1/protocol-tutor`).
 * Teaches the Visual Brain Setup Diagram (PDF-01), ~20-Word Google Flow Video Prompting & Export (PDF-02),
 * YouTube Brand Channel Setup & 480-Char Tags (PDF-03), and Copy-Paste Website Prompts (PDF-04, PDF-05).
 * Strictly enforces Wayne's IP Air-Gap: never exposes private desktop automation or internal daemons.
 */
function keystone_handle_protocol_tutor( WP_REST_Request $request ): WP_REST_Response {
	$params           = $request->get_json_params() ?: $request->get_params();
	$uid              = sanitize_text_field( (string) ( $params['uid'] ?? '' ) );
	$uid_verification = keystone_verify_user_vault_uid_internal( $uid );
	if ( empty( $uid_verification['verified'] ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => '🔒 Buyer KR-UID Verification Required. Please enter your verified Buyer KR-UID to use the Custom Setup Generator and 24/7 AI Tutor.',
		), 403 );
	}
	$uid             = (string) $uid_verification['uid'];
	$question        = sanitize_text_field( (string) ( $params['question'] ?? '' ) );
	$tier            = sanitize_text_field( (string) ( $params['tier'] ?? '1' ) );
	$buyer_email     = sanitize_email( (string) ( $params['buyer_email'] ?? '' ) );
	$send_email_copy = ! empty( $params['send_email_copy'] );

	if ( '' === trim( $question ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Please enter or click a question for the 24/7 AI Architect Tutor.',
		), 400 );
	}

	$q_lower = strtolower( $question );

	// Intelligent topic matching across the 6 Modules & 12 Breakdown PDFs
	$recommended_pdf_id       = 'PDF-01';
	$recommended_pdf_title    = 'KR_01_Antigravity_Visual_Brain_Setup_Diagram.pdf';
	$recommended_video_module = 'V01 — Module 01: Visual AI Brain Architecture & Starter Folder Blueprint';
	$answer_html              = '';

	if ( false !== strpos( $q_lower, 'flow' ) || false !== strpos( $q_lower, '20-word' ) || false !== strpos( $q_lower, '20 word' ) || false !== strpos( $q_lower, 'export' ) || false !== strpos( $q_lower, 'mp4' ) || false !== strpos( $q_lower, 'video' ) ) {
		$recommended_pdf_id       = 'PDF-02';
		$recommended_pdf_title    = 'KR_02_Google_Flow_20_Word_Video_Prompt_And_Export_Guide.pdf';
		$recommended_video_module = 'V02 — Module 02: Generating ~20-Word Google Flow Prompts, Reference Images & Exporting MP4s';
		$answer_html              = '
			<div style="color:#f6d365;font-weight:800;font-size:0.86rem;margin-bottom:6px;">🎬 AI ARCHITECT LESSON // ~20-WORD GOOGLE FLOW PROMPTS &amp; MP4 EXPORT WORKFLOW (PDF-02)</div>
			<ol style="margin:0 0 10px 0;padding-left:18px;color:#e2e8f0;font-size:0.84rem;line-height:1.6;">
				<li><strong>Keep Every Google Flow Prompt to ~20 Words (18–24 Words):</strong> Google Flow produces the cleanest lip-sync and camera movement when your scene prompt is concise—strictly <strong>18 to 24 words per 10-second clip</strong>.</li>
				<li><strong>Attach Your 3 Reference Images in Google Flow:</strong> Upload 1 clear headshot photo (Character), 1 outfit photo (Wardrobe), and 1 studio room photo (Background) so every clip matches visually.</li>
				<li><strong>Download Your Prompt Generator in PDF-02:</strong> Open or download <strong>PDF-02</strong> inside your Buyer Vault to copy the exact 10-second scene prompt generator template.</li>
				<li><strong>Export &amp; Download MP4s:</strong> Paste each ~20-word prompt into Google Flow, generate your 10-second clips, and click <strong>Export / Download MP4 (1080p)</strong> into your project folder.</li>
			</ol>';
	} elseif ( false !== strpos( $q_lower, 'youtube' ) || false !== strpos( $q_lower, 'channel' ) || false !== strpos( $q_lower, 'brand account' ) || false !== strpos( $q_lower, 'tag' ) || false !== strpos( $q_lower, 'upload' ) ) {
		$recommended_pdf_id       = 'PDF-03';
		$recommended_pdf_title    = 'KR_03_YouTube_Brand_Channel_Upload_Defaults_And_Tags.pdf';
		$recommended_video_module = 'V02 — Module 02: YouTube Brand Channel Setup, Upload Defaults & 480-Character Tag Stack';
		$answer_html              = '
			<div style="color:#f6d365;font-weight:800;font-size:0.86rem;margin-bottom:6px;">📺 AI ARCHITECT LESSON // YOUTUBE BRAND CHANNEL SETUP &amp; 480-CHAR TAG STACK (PDF-03)</div>
			<ol style="margin:0 0 10px 0;padding-left:18px;color:#e2e8f0;font-size:0.84rem;line-height:1.6;">
				<li><strong>Create a YouTube Brand Account:</strong> Go to <code>youtube.com/channel_switcher</code> and click <strong>Create a new channel</strong> so your business channel is separate from your personal Gmail name.</li>
				<li><strong>Configure Upload Defaults Once:</strong> In <strong>YouTube Studio &rarr; Settings &rarr; Upload Defaults</strong>, paste your permanent website link, social links, and chapter template so every upload is pre-filled automatically.</li>
				<li><strong>Download PDF-03 for the Copy-Paste YouTube Setup Prompt:</strong> Open or download <strong>PDF-03</strong> in your Buyer Vault to copy your Upload Defaults template and 480-character SEO tag generator.</li>
				<li><strong>Link Your Companion Short:</strong> Upload a 30–50s vertical highlight clip and set the <strong>Related Video</strong> field in YouTube Studio to point directly to your full-length episode.</li>
			</ol>';
	} elseif ( false !== strpos( $q_lower, 'website' ) || false !== strpos( $q_lower, 'landing' ) || false !== strpos( $q_lower, 'gutenberg' ) || false !== strpos( $q_lower, 'css' ) || false !== strpos( $q_lower, 'rank math' ) || false !== strpos( $q_lower, 'seo' ) ) {
		$recommended_pdf_id       = 'PDF-04';
		$recommended_pdf_title    = 'KR_04_Copy_Paste_Antigravity_Website_Builder_Prompts.pdf';
		$recommended_video_module = 'V03 — Module 03: Building Your Website & SEO Articles with Copy-Paste Antigravity Prompts';
		$answer_html              = '
			<div style="color:#f6d365;font-weight:800;font-size:0.86rem;margin-bottom:6px;">🌐 AI ARCHITECT LESSON // COPY-PASTE ANTIGRAVITY WEBSITE BUILDER PROMPTS (PDF-04 &amp; PDF-05)</div>
			<ol style="margin:0 0 10px 0;padding-left:18px;color:#e2e8f0;font-size:0.84rem;line-height:1.6;">
				<li><strong>Open Your Website Folder in Antigravity:</strong> Point Antigravity at your local WordPress theme or static site folder.</li>
				<li><strong>Download PDF-04 &amp; PDF-05:</strong> Open or download <strong>PDF-04</strong> and <strong>PDF-05</strong> inside your Buyer Vault to copy the complete dark-luxury homepage hero, SEO article layout, and JSON-LD schema prompts.</li>
				<li><strong>Turn Every Video Into an SEO Blog Post (PDF-05):</strong> Paste your video script into Antigravity using the PDF-05 template to output a formatted WordPress article with comparison tables, key takeaways, and Rank Math 100/100 metadata.</li>
				<li><strong>Submit to Google Search Console:</strong> Paste your published article URL into Google Search Console URL Inspection and click <strong>Request Indexing</strong>.</li>
			</ol>';
	} elseif ( false !== strpos( $q_lower, 'swarm' ) || false !== strpos( $q_lower, 'multi-agent' ) || false !== strpos( $q_lower, 'agent' ) || false !== strpos( $q_lower, 'role' ) || false !== strpos( $q_lower, 'b2b' ) || false !== strpos( $q_lower, 'outreach' ) ) {
		$recommended_pdf_id       = 'PDF-06';
		$recommended_pdf_title    = 'KR_06_Multi_Agent_Role_Templates_And_Research_Workflow.pdf';
		$recommended_video_module = 'V04 — Module 04: Multi-Agent Role Prompts, Research Verification & B2B Outreach';
		$answer_html              = '
			<div style="color:#f6d365;font-weight:800;font-size:0.86rem;margin-bottom:6px;">🐝 AI ARCHITECT LESSON // MULTI-AGENT ROLE PROMPTS &amp; B2B OUTREACH WORKFLOW (PDF-06 TO PDF-09)</div>
			<ol style="margin:0 0 10px 0;padding-left:18px;color:#e2e8f0;font-size:0.84rem;line-height:1.6;">
				<li><strong>Why Separate Role Prompts Beat Single Chat Windows:</strong> Long single-chat threads forget rules after a few turns. By storing dedicated role prompts in your Brain folder (Researcher, Scriptwriter, Web Builder, QA Reviewer), each task runs cleanly.</li>
				<li><strong>3-Source Fact Verification Gate:</strong> Instruct your Research Agent to verify every industry stat across at least 3 authoritative sources before writing your script or article.</li>
				<li><strong>B2B Outreach &amp; Lead Verification (PDF-08):</strong> Verify prospect email domains before sending outreach and wrap your messages in a clean, branded HTML signature.</li>
			</ol>';
	} elseif ( false !== strpos( $q_lower, 'davinci' ) || false !== strpos( $q_lower, 'edit' ) || false !== strpos( $q_lower, 'timeline' ) || false !== strpos( $q_lower, 'workstation' ) || false !== strpos( $q_lower, '800' ) ) {
		$recommended_pdf_id       = 'PDF-10';
		$recommended_pdf_title    = 'KR_10_Full_Stack_Creator_Workstation_And_DaVinci_Assembly.pdf';
		$recommended_video_module = 'V06 — Module 06: 2-Track DaVinci Resolve Assembly, -18dB Music Ducking & Full Workstation Scaling';
		$answer_html              = '
			<div style="color:#f6d365;font-weight:800;font-size:0.86rem;margin-bottom:6px;">🏛️ AI ARCHITECT LESSON // 2-TRACK DAVINCI RESOLVE ASSEMBLY &amp; CREATOR WORKSTATION (PDF-10 TO PDF-12)</div>
			<ol style="margin:0 0 10px 0;padding-left:18px;color:#e2e8f0;font-size:0.84rem;line-height:1.6;">
				<li><strong>Track 1 (Main Spoken Clips):</strong> Drop your exported Google Flow 10-second spoken MP4 clips sequentially onto Video Track 1 in DaVinci Resolve.</li>
				<li><strong>Track 2 (Visual B-Roll Cutaways):</strong> Place your B-roll clips on Video Track 2 over transition points so the viewer sees dynamic visuals while your spoken audio continues seamlessly underneath.</li>
				<li><strong>Audio Ducking (-18dB Background Music):</strong> Place your instrumental background track on Audio Track 2 at <strong>-18dB</strong> so your voice on Audio Track 1 remains crystal clear, then export in 4K/1080p MP4.</li>
			</ol>';
	} else {
		$recommended_pdf_id       = 'PDF-01';
		$recommended_pdf_title    = 'KR_01_Antigravity_Visual_Brain_Setup_Diagram.pdf';
		$recommended_video_module = 'V01 — Module 01: Visual AI Brain Architecture & Starter Folder Blueprint';
		$answer_html              = '
			<div style="color:#f6d365;font-weight:800;font-size:0.86rem;margin-bottom:6px;">🧠 AI ARCHITECT LESSON // HOW TO SET UP YOUR 4-PART AI BRAIN ARCHITECTURE (PDF-01)</div>
			<ol style="margin:0 0 10px 0;padding-left:18px;color:#e2e8f0;font-size:0.84rem;line-height:1.6;">
				<li><strong>Step 1 — Open Your Workspace in Google Antigravity:</strong> Install Google Antigravity and open a clean workspace folder on your computer.</li>
				<li><strong>Step 2 — Download PDF-01 &amp; Your .ZIP Starter Pack:</strong> Open or download <strong>PDF-01</strong> in Tab 1 to view the Visual 4-Part AI Brain Setup Diagram and copy your master initialization prompt.</li>
				<li><strong>Step 3 — Paste the Master Brain Initialization Prompt:</strong> Paste Prompt #1 from <strong>PDF-01</strong> into your Antigravity chat window to automatically generate your 4-folder AI Brain structure and starter rules file.</li>
				<li><strong>Step 4 — Generate Your Custom Prompts in Tab 1:</strong> Fill out the <strong>Interactive Brain, Channel &amp; Website Setup Form</strong> in Tab 1 to generate prompts tailored to your exact YouTube channel and domain!</li>
			</ol>';
	}

	$email_sent = false;
	if ( $send_email_copy && is_email( $buyer_email ) ) {
		$magic_url  = home_url( '/ai-protocols/?uid=' . rawurlencode( $uid ) . '#kr-self-service-portal' );
		$inner_mail = '
			<p style="color:#cbd5e1;font-size:14px;">Here is your custom step-by-step lesson from the <strong>Keystone 24/7 AI Architect Tutor</strong>:</p>
			<div style="background:#04070d;border:1px solid #38bdf8;border-radius:12px;padding:14px 16px;margin:14px 0;">
				<div style="font-size:11px;color:#38bdf8;font-weight:800;text-transform:uppercase;">YOUR QUESTION:</div>
				<div style="font-size:14px;color:#ffffff;font-weight:700;margin-top:4px;">' . esc_html( $question ) . '</div>
			</div>
			<div style="background:#0b111e;border:1px solid rgba(212,175,55,0.45);border-radius:12px;padding:16px;margin:14px 0;">
				' . $answer_html . '
				<div style="margin-top:10px;padding-top:10px;border-top:1px solid rgba(255,255,255,0.1);font-size:12.5px;color:#f6d365;">
					<strong>Recommended Breakdown Spec PDF:</strong> ' . esc_html( $recommended_pdf_id . ' — ' . $recommended_pdf_title ) . '<br/>
					<strong>Recommended Video Walkthrough:</strong> ' . esc_html( $recommended_video_module ) . '
				</div>
			</div>';

		$mail_body = keystone_build_locked_protocol_email_shell(
			'Keystone Builder',
			'24/7 AI ARCHITECT TUTOR // CUSTOM LESSON TRANSCRIPT',
			'Your Step-by-Step AI Protocols Coaching Lesson',
			$inner_mail,
			$magic_url,
			'OPEN 6-TAB PORTAL & SPEC SHEET ' . $recommended_pdf_id
		);
		$headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'From: Wayne Stevenson — Keystone AI Protocols <keystonerecomposition@gmail.com>',
			'Reply-To: keystonerecomposition@gmail.com',
		);
		$email_sent = (bool) @wp_mail(
			$buyer_email,
			sprintf( '[Keystone AI Tutor Lesson] %s (%s)', $recommended_pdf_id, $uid ),
			$mail_body,
			$headers
		);
	}

	return new WP_REST_Response( array(
		'success'                  => true,
		'uid'                      => $uid,
		'tier'                     => $tier,
		'question'                 => $question,
		'answer_html'              => $answer_html,
		'recommended_pdf_id'       => $recommended_pdf_id,
		'recommended_pdf_title'    => $recommended_pdf_title,
		'recommended_video_module' => $recommended_video_module,
		'email_sent'               => $email_sent,
	), 200 );
}

if ( ! function_exists( 'keystone_v10_handle_protocol_order' ) ) {
	function keystone_v10_handle_protocol_order( WP_REST_Request $request ): WP_REST_Response {
		return keystone_handle_protocol_order_submission( $request );
	}
}

if ( ! function_exists( 'keystone_v10_handle_verify_vault_uid' ) ) {
	function keystone_v10_handle_verify_vault_uid( WP_REST_Request $request ): WP_REST_Response {
		$uid    = (string) ( $request->get_param( 'uid' ) ?? '' );
		$result = keystone_verify_user_vault_uid_internal( $uid );
		return new WP_REST_Response( $result, 200 );
	}
}
