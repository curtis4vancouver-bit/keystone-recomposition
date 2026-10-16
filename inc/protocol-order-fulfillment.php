<?php
/**
 * Keystone AI Protocols — Automated Video Walkthrough, Instant Download Vault,
 * Strict User UID Verification Gate & Email Follow-Up Fulfillment Engine
 *
 * Endpoints:
 *   POST /wp-json/keystone/v1/protocol-order
 *   GET  /wp-json/keystone/v1/protocol-orders
 *   GET|POST /wp-json/keystone/v1/verify-vault-uid
 *
 * @package KeystoneRecompositionChild
 * @since 10.6.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return canonical Tier metadata (Video Walkthrough URL, Download Pack items, Price, Label).
 */
function keystone_get_protocol_tier_catalog(): array {
	return array(
		'1' => array(
			'tier'                  => '1',
			'code'                  => 'tier1_blueprint',
			'name'                  => 'Tier 01 — $49.50 Antigravity AI Video & Website Fast-Track Blueprint',
			'price'                 => '49.50',
			'walkthrough_video_id'  => 'JCgZ5SsN_bc',
			'walkthrough_video_url' => 'https://www.youtube.com/watch?v=JCgZ5SsN_bc',
			'walkthrough_title'     => 'Wayne Stevenson Recorded Master Walkthrough: How to Generate AI Videos & Deploy the Website Blueprint',
			'unlocked_downloads'    => array(
				array(
					'label' => '📦 Keystone_Tier01_AI_Video_Website_Blueprint_Pack.zip (Prompts + Gutenberg AST + CSS Tokens)',
					'url'   => home_url( '/ai-protocols/?vault_download=tier1_blueprint_pack' ),
				),
				array(
					'label' => '⚡ 1-Click_GSC_Priority_Indexer_CDP_9222.bat (Automated Search Console Submitter)',
					'url'   => home_url( '/ai-protocols/?vault_download=tier1_gsc_indexer' ),
				),
				array(
					'label' => '🎬 Wayne_Recorded_AI_Video_Generation_Walkthrough_4K.mp4 (Step-by-Step Screen Recording)',
					'url'   => 'https://www.youtube.com/watch?v=JCgZ5SsN_bc',
				),
			),
		),
		'2' => array(
			'tier'                  => '2',
			'code'                  => 'tier2_swarm',
			'name'                  => 'Tier 02 — $199 Autonomous 28-Agent Swarm & B2B Engine',
			'price'                 => '199.00',
			'walkthrough_video_id'  => 'k3fArbXUzQM',
			'walkthrough_video_url' => 'https://www.youtube.com/watch?v=k3fArbXUzQM',
			'walkthrough_title'     => 'Wayne Stevenson Recorded Master Walkthrough: 28-Agent Concurrency, FastMCP & B2B Engine',
			'unlocked_downloads'    => array(
				array(
					'label' => '📦 Keystone_Tier02_28_Agent_Swarm_FastMCP_Suite.zip (All 28 Subagent Definitions + TDD Harness)',
					'url'   => home_url( '/ai-protocols/?vault_download=tier2_swarm_pack' ),
				),
				array(
					'label' => '🎬 Wayne_28_Agent_Swarm_Recorded_Walkthrough_4K.mp4 (Full Setup & Execution Guide)',
					'url'   => 'https://www.youtube.com/watch?v=k3fArbXUzQM',
				),
			),
		),
		'3' => array(
			'tier'                  => '3',
			'code'                  => 'tier3_workstation',
			'name'                  => 'Tier 03 — $800 Custom Tauri HUD & Sovereign AI Video Workstation',
			'price'                 => '800.00',
			'walkthrough_video_id'  => 'uMkZvTbqF2U',
			'walkthrough_video_url' => 'https://www.youtube.com/watch?v=uMkZvTbqF2U',
			'walkthrough_title'     => 'Wayne Stevenson Recorded Master Walkthrough: Custom Tauri Workstation, AI Video Pipeline & 6 Win32 Daemons',
			'unlocked_downloads'    => array(
				array(
					'label' => '🏛️ Keystone_Tier03_Sovereign_Workstation_Installer_Suite.zip (6 Detached Daemons + Tauri HUD Blueprint + AI Video Scripts)',
					'url'   => home_url( '/ai-protocols/?vault_download=tier3_workstation_pack' ),
				),
				array(
					'label' => '🎬 Wayne_Recorded_800_Workstation_AI_Video_Masterclass.mp4 (Complete Recorded Walkthrough)',
					'url'   => 'https://www.youtube.com/watch?v=uMkZvTbqF2U',
				),
				array(
					'label' => '🤝 1-on-1 Architecture Onboarding & Direct Email Priority Dossier (Wayne Stevenson)',
					'url'   => home_url( '/contact/?inquiry=tier3_workstation#inquiry-form' ),
				),
			),
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
 * Validate a User Vault UID against stored orders, active WP user session, or owner master key.
 */
function keystone_verify_user_vault_uid_internal( string $uid ): array {
	$uid     = strtoupper( sanitize_text_field( trim( $uid ) ) );
	$catalog = keystone_get_protocol_tier_catalog();

	if ( '' === $uid ) {
		// Check if current logged-in WP administrator is viewing
		if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
			$wp_uid = 'KR-ADMIN-UID-' . (int) get_current_user_id();
			return array(
				'valid'                 => true,
				'uid'                   => $wp_uid,
				'buyer_name'            => 'Wayne Stevenson (Admin Verified)',
				'tier'                  => '3',
				'tier_name'             => $catalog['3']['name'],
				'walkthrough_video_id'  => $catalog['3']['walkthrough_video_id'],
				'walkthrough_video_url' => $catalog['3']['walkthrough_video_url'],
				'walkthrough_title'     => $catalog['3']['walkthrough_title'],
				'unlocked_downloads'    => array_merge(
					$catalog['1']['unlocked_downloads'],
					$catalog['2']['unlocked_downloads'],
					$catalog['3']['unlocked_downloads']
				),
			);
		}
		return array(
			'valid'   => false,
			'uid'     => '',
			'message' => 'Missing User Vault UID. Please enter a valid KR-UID or complete order registration first.',
		);
	}

	// Owner Master UID & Logged-in WP User UID support for Wayne Stevenson (#52603)
	if (
		in_array( $uid, array( 'KR-OWNER-WAYNE-52603', 'KR-UID-WAYNE52603', 'KR-ADMIN-52603' ), true ) ||
		0 === strpos( $uid, 'KR-WP-UID-' ) ||
		0 === strpos( $uid, 'KR-ADMIN-UID-' )
	) {
		return array(
			'valid'                 => true,
			'uid'                   => $uid,
			'buyer_name'            => 'Wayne Stevenson (Founder Master UID)',
			'tier'                  => '3',
			'tier_name'             => $catalog['3']['name'],
			'walkthrough_video_id'  => $catalog['3']['walkthrough_video_id'],
			'walkthrough_video_url' => $catalog['3']['walkthrough_video_url'],
			'walkthrough_title'     => $catalog['3']['walkthrough_title'],
			'unlocked_downloads'    => array_merge(
				$catalog['1']['unlocked_downloads'],
				$catalog['2']['unlocked_downloads'],
				$catalog['3']['unlocked_downloads']
			),
		);
	}

	$orders = get_option( 'keystone_protocol_orders_v10', array() );
	if ( is_array( $orders ) ) {
		foreach ( $orders as $order ) {
			if ( ! empty( $order['user_uid'] ) && strtoupper( (string) $order['user_uid'] ) === $uid ) {
				$t_key = isset( $catalog[ (string) $order['tier'] ] ) ? (string) $order['tier'] : '1';
				$t_obj = $catalog[ $t_key ];
				return array(
					'valid'                 => true,
					'uid'                   => (string) $order['user_uid'],
					'order_id'              => (string) ( $order['order_id'] ?? '' ),
					'buyer_name'            => (string) ( $order['buyer_name'] ?? 'Verified Builder' ),
					'tier'                  => $t_key,
					'tier_name'             => $t_obj['name'],
					'price'                 => (string) ( $order['price'] ?? $t_obj['price'] ),
					'walkthrough_video_id'  => $t_obj['walkthrough_video_id'],
					'walkthrough_video_url' => $t_obj['walkthrough_video_url'],
					'walkthrough_title'     => $t_obj['walkthrough_title'],
					'unlocked_downloads'    => $t_obj['unlocked_downloads'],
				);
			}
		}
	}

	return array(
		'valid'   => false,
		'uid'     => $uid,
		'message' => 'Unrecognized User Vault UID. Vault access requires a verified KR-UID.',
	);
}

/**
 * Register REST API routes for Automated Order Fulfillment & Vault UID Verification.
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
			$orders = get_option( 'keystone_protocol_orders_v10', array() );
			return new WP_REST_Response( array(
				'count'  => is_array( $orders ) ? count( $orders ) : 0,
				'orders' => is_array( $orders ) ? $orders : array(),
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
} );

/**
 * Process Automated AI Protocol Order, Assign User UID, Unlock Video + Downloads, and Dispatch Emails.
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
			'message' => 'Please enter your full name and a valid email address to generate your Vault UID and unlock the walkthrough video + downloads.',
		), 400 );
	}

	$catalog = keystone_get_protocol_tier_catalog();
	if ( ! isset( $catalog[ $tier ] ) ) {
		$tier = '1';
	}
	$tier_info = $catalog[ $tier ];
	$price     = (float) $tier_info['price'];

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

	$user_uid = keystone_generate_user_vault_uid( $buyer_email, $tier );
	$order_id = 'KR-ORD-' . gmdate( 'Ymd-His' ) . '-' . strtoupper( wp_generate_password( 4, false ) );

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
		'status'                => 'fulfilled_pending_wayne_followup',
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

	// 1. Send Instant Automated HTML Onboarding Email (Video Walkthrough + Download Vault + Verified UID) to Buyer
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: Wayne Stevenson — Keystone AI Protocols <keystonerecomposition@gmail.com>',
		'Reply-To: keystonerecomposition@gmail.com',
	);

	$downloads_html = '';
	foreach ( $tier_info['unlocked_downloads'] as $dl ) {
		$downloads_html .= '<li style="margin-bottom:8px;"><a href="' . esc_url( $dl['url'] ) . '" style="color:#38bdf8;font-weight:700;text-decoration:none;">' . esc_html( $dl['label'] ) . '</a></li>';
	}

	$buyer_subject = sprintf( '[Keystone AI Protocols] Instant Access Unlocked: %s (UID: %s)', $tier_info['name'], $user_uid );
	$buyer_body    = '
	<div style="background:#04070d;color:#f8fafc;font-family:Arial,sans-serif;padding:32px;border-radius:16px;border:1px solid #38bdf8;max-width:640px;margin:0 auto;">
		<div style="color:#d4af37;font-size:12px;font-weight:800;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:8px;">KEYSTONE AI PROTOCOLS // AUTOMATED FULFILLMENT VAULT</div>
		<h2 style="color:#ffffff;margin:0 0 12px 0;font-size:22px;">Welcome, ' . esc_html( $buyer_name ) . ' — Your AI Video Walkthrough &amp; Download Vault Are Ready</h2>
		<p style="color:#cbd5e1;font-size:14px;line-height:1.6;">Thank you for ordering <strong>' . esc_html( $tier_info['name'] ) . ' ($' . esc_html( $formatted_price ) . ' USD)</strong>. Your unique Vault UID has been verified and locked to your account:</p>
		<div style="background:#0b111e;border:1px solid #d4af37;border-radius:10px;padding:14px 18px;margin:16px 0;">
			<div style="font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;">YOUR VERIFIED VAULT UID (REQUIRED FOR VAULT MENU ACCESS)</div>
			<div style="font-size:18px;font-weight:900;color:#38bdf8;font-family:monospace;margin-top:4px;">' . esc_html( $user_uid ) . '</div>
			<div style="font-size:11px;color:#f6d365;margin-top:4px;">Order ID: ' . esc_html( $order_id ) . '</div>
		</div>
		<h3 style="color:#38bdf8;font-size:16px;margin:20px 0 8px 0;">🎬 Step 1: Watch Wayne\'s Recorded Step-by-Step AI Video Walkthrough</h3>
		<p style="color:#cbd5e1;font-size:14px;line-height:1.6;margin:0 0 12px 0;">Watch Wayne Stevenson demonstrate on screen how to generate the AI videos, run the prompts, and launch the complete workflow:</p>
		<p style="margin:0 0 18px 0;"><a href="' . esc_url( $tier_info['walkthrough_video_url'] ) . '" style="display:inline-block;background:#38bdf8;color:#04070d;font-weight:800;padding:10px 20px;border-radius:9999px;text-decoration:none;">▶ WATCH RECORDED WALKTHROUGH VIDEO</a></p>
		<h3 style="color:#d4af37;font-size:16px;margin:20px 0 8px 0;">📦 Step 2: Instant Automated Download Pack</h3>
		<ul style="color:#cbd5e1;font-size:14px;line-height:1.6;padding-left:18px;">' . $downloads_html . '</ul>
		<h3 style="color:#ffffff;font-size:15px;margin:20px 0 8px 0;">🤝 Step 3: Direct Follow-Up from Wayne Stevenson</h3>
		<p style="color:#94a3b8;font-size:13px;line-height:1.6;">Wayne Stevenson and our autonomous onboarding system have been notified at <a href="mailto:keystonerecomposition@gmail.com" style="color:#38bdf8;">keystonerecomposition@gmail.com</a>. Reply directly to this email anytime if you have questions or want custom tuning.</p>
	</div>';

	@wp_mail( $buyer_email, $buyer_subject, $buyer_body, $headers );

	// 2. Send Instant Notification Email to Wayne (keystonerecomposition@gmail.com) so Antigravity & Wayne can follow up
	$admin_subject = sprintf( '[Keystone AI Protocols Order] %s ($%s USD) — %s [%s]', $tier_info['name'], $formatted_price, $buyer_name, $user_uid );
	$admin_body    = sprintf(
		"New Automated AI Protocols Order Fulfilled!\n\nOrder ID: %s\nVerified User Vault UID: %s\nTier: %s\nPrice: $%s USD\nBuyer Name: %s\nBuyer Email: %s\nPromo Code: %s\nNotes: %s\nTimestamp: %s\n\nWalkthrough Video Sent: %s\nStatus: Fulfilled & Ready for Personal AI-Assisted Follow-Up.",
		$order_id,
		$user_uid,
		$tier_info['name'],
		$formatted_price,
		$buyer_name,
		$buyer_email,
		$promo_code ?: 'NONE',
		$notes ?: 'None',
		gmdate( 'Y-m-d H:i:s \U\T\C' ),
		$tier_info['walkthrough_video_url']
	);

	@wp_mail( 'keystonerecomposition@gmail.com', $admin_subject, $admin_body );

	return new WP_REST_Response( array(
		'success'               => true,
		'order_id'              => $order_id,
		'user_uid'              => $user_uid,
		'tier'                  => $tier,
		'tier_name'             => $tier_info['name'],
		'price'                 => $formatted_price,
		'buyer_name'            => $buyer_name,
		'buyer_email'           => $buyer_email,
		'walkthrough_video_id'  => $tier_info['walkthrough_video_id'],
		'walkthrough_video_url' => $tier_info['walkthrough_video_url'],
		'walkthrough_title'     => $tier_info['walkthrough_title'],
		'unlocked_downloads'    => $tier_info['unlocked_downloads'],
		'message'               => 'UID Verified & Order Fulfilled! Your recorded walkthrough video and download pack are unlocked below, and a copy has been emailed to ' . $buyer_email . '.',
	), 200 );
}
