<?php
/**
 * Keystone AI Protocols — Automated Video Walkthrough, Instant Download Vault,
 * Strict User UID Verification Gate, Stripe HMAC-SHA256 Webhook,
 * Interactive Brain/Channel/Website Setup Intake Generator,
 * Authenticated .ZIP Download Streamer & Guided Setup Assistant Engine (With Setup Window & Follow-Up Cap)
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
if ( ! defined( 'KEYSTONE_TIER1_PUBLIC_VIDEO_ID' ) ) {
	define( 'KEYSTONE_TIER1_PUBLIC_VIDEO_ID', 'JCgZ5SsN_bc' ); // Video A: Public Overview on /ai-protocols/ Tier 01 Card
}
if ( ! defined( 'KEYSTONE_TIER1_BUYER_WALKTHROUGH_VIDEO_ID' ) ) {
	define( 'KEYSTONE_TIER1_BUYER_WALKTHROUGH_VIDEO_ID', '-ZYdbPXenCU' ); // Video B: Unlisted Tier 01 Buyer Setup Walkthrough (4m30s) on @KeyStoneRecomposition
}
if ( ! defined( 'KEYSTONE_TIER2_BUYER_WALKTHROUGH_VIDEO_ID' ) ) {
	define( 'KEYSTONE_TIER2_BUYER_WALKTHROUGH_VIDEO_ID', 'LxbjlX_nh2Q' ); // Video C: Unlisted Tier 02 Buyer Setup Walkthrough (5m30s) on @KeyStoneRecomposition
}
if ( ! defined( 'KEYSTONE_TIER3_BUYER_WALKTHROUGH_VIDEO_ID' ) ) {
	define( 'KEYSTONE_TIER3_BUYER_WALKTHROUGH_VIDEO_ID', '_bSpYdvm6tc' ); // Video D: Unlisted Tier 03 Tauri App Walkthrough (6m00s) on @KeyStoneRecomposition
}

/**
 * Get the current Stripe Checkout mode: 'auto' | 'live' | 'test' | 'reservation'.
 */
function keystone_get_stripe_mode(): string {
	$mode = (string) get_option( 'keystone_stripe_mode', 'auto' );
	if ( 'auto' === $mode ) {
		$live_key = (string) get_option( 'keystone_stripe_live_secret_key', '' );
		if ( empty( $live_key ) && defined( 'KEYSTONE_STRIPE_LIVE_SECRET_KEY' ) ) {
			$live_key = (string) KEYSTONE_STRIPE_LIVE_SECRET_KEY;
		}
		if ( ! empty( $live_key ) ) {
			return 'live';
		}
		$test_key = (string) get_option( 'keystone_stripe_test_secret_key', '' );
		if ( empty( $test_key ) && defined( 'KEYSTONE_STRIPE_TEST_SECRET_KEY' ) ) {
			$test_key = (string) KEYSTONE_STRIPE_TEST_SECRET_KEY;
		}
		if ( ! empty( $test_key ) ) {
			return 'test';
		}
		if ( defined( 'KEYSTONE_VISA_AND_VIDEOS_LIVE' ) && KEYSTONE_VISA_AND_VIDEOS_LIVE ) {
			return 'live';
		}
		return 'reservation';
	}
	return in_array( $mode, array( 'live', 'test', 'reservation' ), true ) ? $mode : 'auto';
}

/**
 * Retrieve active Stripe Secret Key (sk_live_..., rk_live_..., or sk_test_...).
 */
function keystone_get_stripe_secret_key(): string {
	$mode = keystone_get_stripe_mode();
	if ( 'test' === $mode ) {
		$key = (string) get_option( 'keystone_stripe_test_secret_key', '' );
		if ( empty( $key ) && defined( 'KEYSTONE_STRIPE_TEST_SECRET_KEY' ) ) {
			$key = (string) KEYSTONE_STRIPE_TEST_SECRET_KEY;
		}
		return $key;
	}
	$key = (string) get_option( 'keystone_stripe_live_secret_key', '' );
	if ( empty( $key ) && defined( 'KEYSTONE_STRIPE_LIVE_SECRET_KEY' ) ) {
		$key = (string) KEYSTONE_STRIPE_LIVE_SECRET_KEY;
	}
	if ( empty( $key ) && defined( 'KEYSTONE_STRIPE_SECRET_KEY' ) ) {
		$key = (string) KEYSTONE_STRIPE_SECRET_KEY;
	}
	return $key;
}

/**
 * Retrieve active Stripe Webhook Signing Secret (whsec_...).
 */
function keystone_get_stripe_webhook_secret(): string {
	$mode = keystone_get_stripe_mode();
	if ( 'test' === $mode ) {
		$whsec = (string) get_option( 'keystone_stripe_test_webhook_secret', '' );
		if ( empty( $whsec ) && defined( 'KEYSTONE_STRIPE_TEST_WEBHOOK_SECRET' ) ) {
			$whsec = (string) KEYSTONE_STRIPE_TEST_WEBHOOK_SECRET;
		}
		return $whsec;
	}
	$whsec = (string) get_option( 'keystone_stripe_live_webhook_secret', '' );
	if ( empty( $whsec ) && defined( 'KEYSTONE_STRIPE_WEBHOOK_SECRET' ) ) {
		$whsec = (string) KEYSTONE_STRIPE_WEBHOOK_SECRET;
	}
	return $whsec;
}

/**
 * Check if Stripe is configured and ready for live or test checkout.
 */
function keystone_is_stripe_ready(): bool {
	$sec  = keystone_get_stripe_secret_key();
	$mode = keystone_get_stripe_mode();
	return ( 'reservation' !== $mode ) && ! empty( $sec );
}

/**
 * Return dedicated Unlisted Walkthrough Video ID for each tier.
 * Fixes Bug 3 (Dedicated Per-Tier Video IDs, eliminating duplicate uMkZvTbqF2U or JCgZ5SsN_bc).
 */
function keystone_get_tier_walkthrough_video_id( string $tier ): string {
	switch ( $tier ) {
		case '3':
			$opt = (string) get_option( 'keystone_tier3_video_id', '' );
			if ( ! empty( $opt ) ) {
				return $opt;
			}
			return defined( 'KEYSTONE_TIER3_BUYER_WALKTHROUGH_VIDEO_ID' ) ? (string) KEYSTONE_TIER3_BUYER_WALKTHROUGH_VIDEO_ID : '_bSpYdvm6tc';
		case '2':
			$opt = (string) get_option( 'keystone_tier2_video_id', '' );
			if ( ! empty( $opt ) ) {
				return $opt;
			}
			return defined( 'KEYSTONE_TIER2_BUYER_WALKTHROUGH_VIDEO_ID' ) ? (string) KEYSTONE_TIER2_BUYER_WALKTHROUGH_VIDEO_ID : 'LxbjlX_nh2Q';
		case '1':
		default:
			$opt = (string) get_option( 'keystone_tier1_video_id', '' );
			if ( ! empty( $opt ) ) {
				return $opt;
			}
			return defined( 'KEYSTONE_TIER1_BUYER_WALKTHROUGH_VIDEO_ID' ) ? (string) KEYSTONE_TIER1_BUYER_WALKTHROUGH_VIDEO_ID : '-ZYdbPXenCU';
	}
}

/**
 * Calculate exact USD pricing in cents with percentage-based promo code math.
 * Strict US Funds:
 *   Tier 01: 4950 cents ($49.50 USD)
 *   Tier 02: 19900 cents ($199.00 USD)
 *   Tier 03: 80000 cents ($800.00 USD)
 * Promo Codes:
 *   BUILDER10 -> 10% off (4455 / 17910 / 72000 cents)
 *   WAYNE10   -> 10% off (4455 / 17910 / 72000 cents)
 *   KEYSTONE20 -> 20% off (3960 / 15920 / 64000 cents)
 */
function keystone_calculate_tier_price( string $tier, string $promo_code = '' ): array {
	$base_cents_map = array(
		'1' => 4950,
		'2' => 19900,
		'3' => 80000,
	);
	$tier_key   = in_array( $tier, array( '1', '2', '3' ), true ) ? $tier : '1';
	$base_cents = $base_cents_map[ $tier_key ];

	$promo      = strtoupper( trim( $promo_code ) );
	$promo_pcts = array(
		'BUILDER10'  => 10,
		'WAYNE10'    => 10,
		'KEYSTONE20' => 20,
	);

	$discount_pct   = $promo_pcts[ $promo ] ?? 0;
	$discount_cents = 0;
	if ( $discount_pct > 0 ) {
		$discount_cents = (int) round( ( $base_cents * $discount_pct ) / 100 );
	}
	$final_cents = max( 0, $base_cents - $discount_cents );

	return array(
		'tier'             => $tier_key,
		'currency'         => 'usd',
		'base_cents'       => $base_cents,
		'discount_pct'     => $discount_pct,
		'discount_percent' => $discount_pct,
		'discount_cents'   => $discount_cents,
		'final_cents'      => $final_cents,
		'cent_price'       => $final_cents,
		'formatted_price'  => number_format( $final_cents / 100, 2, '.', '' ),
		'promo_code'       => $discount_pct > 0 ? $promo : '',
		'has_promo'        => $discount_pct > 0,
	);
}

/**
 * Check whether a user UID has cumulative entitlement to download a vault pack or PDF.
 */
function keystone_verify_tier_download_access( string $pack_slug, string $uid ): bool {
	$verification = keystone_verify_user_vault_uid_internal( $uid );
	if ( empty( $verification['verified'] ) ) {
		return false;
	}
	$user_tier   = (int) ( $verification['tier'] ?? 1 );
	$tier3_packs = array( 'tier3_zip', 'tier3_workstation_pack', 'tier3_pdf_10', 'tier3_pdf_11', 'tier3_pdf_12' );
	$tier2_packs = array( 'tier2_zip', 'tier2_swarm_pack', 'tier2_pdf_05', 'tier2_pdf_06', 'tier2_pdf_07', 'tier2_pdf_08', 'tier2_pdf_09' );

	if ( in_array( $pack_slug, $tier3_packs, true ) ) {
		return $user_tier >= 3;
	}
	if ( in_array( $pack_slug, $tier2_packs, true ) ) {
		return $user_tier >= 2;
	}
	return $user_tier >= 1;
}

/**
 * On-the-fly valid %PDF-1.4 spec generator for graceful fallback when physical PDF is still generating.
 */
function keystone_generate_fallback_pdf_bytes( string $title, string $uid ): string {
	$clean_title = preg_replace( '/[^a-zA-Z0-9_\-\.\:\s\(\)\/]/', ' ', $title );
	$lines = array(
		'KEYSTONE AI PROTOCOLS // OFFICIAL BREAKDOWN SPEC SHEET',
		(string) $clean_title,
		'Verified Buyer UID: ' . $uid,
		'Author: Wayne Stevenson (BC Licensed Builder #52603)',
		'Platform: https://keystonerecomposition.com/ai-protocols/',
		'----------------------------------------------------------------------',
		'1. AI BRAIN & PROMPT SPECIFICATION OVERVIEW:',
		'Drop this specification into your 01_Brain_Rules/ or 02_Video_Prompts/ workspace.',
		'Maintain 18 to 24 words (~20 words) for 10-second Google Flow video scene prompts.',
		'Enforce strict Obsidian #04070d and Sovereign Gold #d4af37 brand styling tokens.',
		'----------------------------------------------------------------------',
		'Official Keystone AI Protocols Digital Deliverable %PDF-1.4'
	);
	$stream_cmds = "BT\n/F1 10 Tf\n50 740 Td\n15 TL\n";
	foreach ( $lines as $idx => $line ) {
		$escaped = str_replace( array( '\\', '(', ')' ), array( '\\\\', '\\(', '\\)' ), $line );
		if ( 0 === $idx ) {
			$stream_cmds .= "({$escaped}) Tj\n";
		} else {
			$stream_cmds .= "T* ({$escaped}) Tj\n";
		}
	}
	$stream_cmds .= "ET\n";

	$stream_len  = strlen( $stream_cmds );
	$obj1        = "1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n";
	$obj2        = "2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n";
	$obj3        = "3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>\nendobj\n";
	$obj4        = "4 0 obj\n<< /Length {$stream_len} >>\nstream\n{$stream_cmds}endstream\nendobj\n";
	$obj5        = "5 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n";

	$header      = "%PDF-1.4\n";
	$body        = $obj1 . $obj2 . $obj3 . $obj4 . $obj5;
	$xref_offset = strlen( $header . $body );
	$xref        = "xref\n0 6\n0000000000 65535 f \n";
	$trailer     = "trailer\n<< /Size 6 /Root 1 0 R >>\nstartxref\n{$xref_offset}\n%%EOF";
	return $header . $body . $xref . $trailer;
}

/**
 * Return file attachments (the .ZIP starter pack + 4 printable PDF setup guides) for wp_mail() delivery.
 */
function keystone_get_tier_email_attachments( string $tier ): array {
	$vault_dir   = get_stylesheet_directory() . '/assets/vault_packs/';
	$attachments = array();

	$candidate_files = array(
		$vault_dir . 'Keystone_Tier01_Antigravity_Brain_And_Flow_Prompt_Pack.zip',
		$vault_dir . 'tier01_pdfs/KR_T1_01_AI_Brain_Workspace_QuickStart.pdf',
		$vault_dir . 'tier01_pdfs/KR_T1_02_AGENTS_MD_Memory_And_Rules_Guide.pdf',
		$vault_dir . 'tier01_pdfs/KR_T1_03_Google_Flow_Basic_10s_Video_Guide.pdf',
		$vault_dir . 'tier01_pdfs/KR_T1_04_Scene_Prompt_Templates_And_Setup_Support.pdf',
	);
	if ( '2' === $tier || '3' === $tier ) {
		$candidate_files[] = $vault_dir . 'Keystone_Tier02_28_Agent_Swarm_FastMCP_Suite.zip';
	}
	if ( '3' === $tier ) {
		$candidate_files[] = $vault_dir . 'Keystone_Tier03_Sovereign_Workstation_Installer_Suite.zip';
	}
	foreach ( $candidate_files as $fp ) {
		if ( file_exists( $fp ) && is_readable( $fp ) ) {
			$attachments[] = $fp;
		}
	}
	return $attachments;
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
				'unlocked_modules' => array( 'V01', 'V02' ),
				'unlocked_pdfs'    => array( 'PDF-01', 'PDF-02', 'PDF-03', 'PDF-04' ),
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
				'label' => '📦 Keystone_Tier01_Antigravity_Brain_And_Flow_Prompt_Pack.zip (Complete 4-Folder AI Brain Starter Workspace + All 4 PDF Setup Guides + ~20-Word Google Flow Prompts)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier1_zip' ),
			),
			array(
				'label' => '🌐 Keystone_Tier01_AI_Video_Website_Blueprint_Pack.zip (AI Video, Channel & Luxury Website Blueprint Pack)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier1_website_channel_pack' ),
			),
			array(
				'label' => '📄 PDF-01: Setting Up Your 4-Folder AI Brain Workspace in Google Antigravity (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier1_pdf_01' ),
			),
			array(
				'label' => '📄 PDF-02: Locking In Your AI Memory & Brand Voice with AGENTS.md (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier1_pdf_02' ),
			),
			array(
				'label' => '📄 PDF-03: Basic Google Flow 10-Second Video Walkthrough & MP4 Export (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier1_pdf_03' ),
			),
			array(
				'label' => '📄 PDF-04: 15 Plug-and-Play Scene Prompts & Your 7-Day Guided Setup Window (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier1_pdf_04' ),
			),
			array(
				'label' => '🎬 Wayne\'s Recorded Buyer Walkthrough Video & 7-Day Guided Setup Assistant (Up to 3 Follow-Up Questions)',
				'url'   => $lead_page_url,
			),
		),
		$uid
	);

	$t2_downloads = keystone_append_uid_to_downloads(
		array(
			array(
				'label' => '📦 Keystone_Tier02_28_Agent_Swarm_FastMCP_Suite.zip (Copy-Paste Subagent Role Prompt Templates + B2B Outreach & DNS Verification Starter Kit)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier2_zip' ),
			),
			array(
				'label' => '📄 PDF-05: Turning Video Scripts into Rank Math 100/100 SEO Articles & GSC Indexing (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier2_pdf_05' ),
			),
			array(
				'label' => '📄 PDF-06: Multi-Agent Role Prompt Templates (Researcher, Scriptwriter, Web Builder, QA) (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier2_pdf_06' ),
			),
			array(
				'label' => '📄 PDF-07: The 3-Source Fact Verification Protocol (Zero Hallucinations) (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier2_pdf_07' ),
			),
			array(
				'label' => '📄 PDF-08: B2B Client Outreach & Domain Email Verification Workflow (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier2_pdf_08' ),
			),
			array(
				'label' => '📄 PDF-09: Locked Top-and-Bottom Logo HTML Email Shell Architecture (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier2_pdf_09' ),
			),
			array(
				'label' => '🎬 Module V04–V05 Multi-Agent Workflow Walkthroughs & 7-Day Setup Assistant (Up to 5 Follow-Up Questions)',
				'url'   => $lead_page_url,
			),
		),
		$uid
	);

	$t3_downloads = keystone_append_uid_to_downloads(
		array(
			array(
				'label' => '🖥️ Keystone_Tier03_Sovereign_Workstation_Installer_Suite.zip (Custom Tauri Desktop App Setup + Dashboard UI Templates + .EXE Build Guide)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier3_zip' ),
			),
			array(
				'label' => '📄 PDF-10: Custom Tauri Desktop App Architecture & Project Setup (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier3_pdf_10' ),
			),
			array(
				'label' => '📄 PDF-11: Building Custom Dashboard Tabs & One-Click Action Buttons (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier3_pdf_11' ),
			),
			array(
				'label' => '📄 PDF-12: Compiling & Launching Your Standalone Windows .EXE Desktop App (%PDF-1.4)',
				'url'   => home_url( '/ai-protocols/?vault_download=tier3_pdf_12' ),
			),
			array(
				'label' => '🎬 Module V06 Custom Tauri Desktop App Build & .EXE Command Center Walkthrough (Protected Buyer Lead Page Player)',
				'url'   => $lead_page_url,
			),
			array(
				'label' => '🤖 Guided Setup Assistant (14-Day Setup Window + 8 Follow-Up Questions) & Full 12-PDF Spec Library',
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
			'stripe_checkout_url'   => (string) ( get_option( 'keystone_stripe_tier1_url' ) ?: KEYSTONE_STRIPE_TIER1_URL ),
			'walkthrough_video_id'  => keystone_get_tier_walkthrough_video_id( '1' ),
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
			'stripe_checkout_url'   => (string) ( get_option( 'keystone_stripe_tier2_url' ) ?: KEYSTONE_STRIPE_TIER2_URL ),
			'walkthrough_video_id'  => keystone_get_tier_walkthrough_video_id( '2' ),
			'walkthrough_video_url' => $lead_page_url,
			'walkthrough_title'     => 'Wayne Stevenson Recorded Walkthrough: Custom Website Build, Multi-Agent Workflows & Brand Channel Setup (One-Time Payment)',
			'unlocked_downloads'    => array_merge( $t1_downloads, $t2_downloads ),
			'unlocked_modules'      => keystone_get_tier_unlocked_curriculum( '2' )['unlocked_modules'],
			'unlocked_pdfs'         => keystone_get_tier_unlocked_curriculum( '2' )['unlocked_pdfs'],
		),
		'3' => array(
			'tier'                  => '3',
			'code'                  => 'tier3_workstation',
			'name'                  => 'Tier 03 — $800 USD Custom Tauri Desktop App Build & Standalone .EXE Command Center (One-Time Payment)',
			'price'                 => '800.00',
			'stripe_checkout_url'   => (string) ( get_option( 'keystone_stripe_tier3_url' ) ?: KEYSTONE_STRIPE_TIER3_URL ),
			'walkthrough_video_id'  => keystone_get_tier_walkthrough_video_id( '3' ),
			'walkthrough_video_url' => $lead_page_url,
			'walkthrough_title'     => 'Wayne Stevenson Recorded Walkthrough: Custom Tauri Desktop App Build & Standalone .EXE Command Center (One-Time Payment)',
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
				'message'               => 'Admin Session Verified! All 6 Course Modules, 12 Breakdown PDFs, Copy-Paste Prompt Packs, and Guided Setup Assistant are unlocked.',
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
						? '✔ Buyer KR-UID Verified! Your 6-Tab Course Portal, Downloadable Breakdown PDFs, Copy-Paste Prompt Packs & Guided Setup Assistant are unlocked.'
						: sprintf(
							'✔ One-Time Launch Rate Locked In ($%s USD) & Buyer Vault Unlocked (UID: %s)! Your 6-Tab Course Portal, Downloadable Breakdown PDFs, Copy-Paste Prompt Packs & Guided Setup Assistant are active below.',
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

		<!-- GUIDED SETUP ASSISTANT BANNER -->
		<div style="background:rgba(56,189,248,0.10);border:1px solid #38bdf8;border-radius:12px;padding:14px 16px;margin:18px 0;color:#f8fafc;font-size:13px;line-height:1.55;">
			<strong style="color:#38bdf8;">🤖 Guided Setup Assistant Active:</strong> Use the Self-Service Portal or reply directly to this email anytime with questions&mdash;our AI Architect will walk you through every step!
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
			'title'    => 'Keystone Tier 01 Antigravity Brain & Flow Prompt Pack (.ZIP)',
		),
		'tier1_zip'                  => array(
			'filename' => 'Keystone_Tier01_Antigravity_Brain_And_Flow_Prompt_Pack.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 1,
			'title'    => 'Keystone Tier 01 Antigravity Brain & Flow Prompt Pack (.ZIP)',
		),
		'tier1_pdf_01'               => array(
			'filename' => 'tier01_pdfs/KR_T1_01_AI_Brain_Workspace_QuickStart.pdf',
			'dl_name'  => 'KR_T1_01_AI_Brain_Workspace_QuickStart.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 1,
			'title'    => 'PDF-01: Setting Up Your 4-Folder AI Brain Workspace in Google Antigravity',
		),
		'tier1_pdf_02'               => array(
			'filename' => 'tier01_pdfs/KR_T1_02_AGENTS_MD_Memory_And_Rules_Guide.pdf',
			'dl_name'  => 'KR_T1_02_AGENTS_MD_Memory_And_Rules_Guide.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 1,
			'title'    => 'PDF-02: Locking In Your AI Memory & Brand Voice with AGENTS.md',
		),
		'tier1_pdf_03'               => array(
			'filename' => 'tier01_pdfs/KR_T1_03_Google_Flow_Basic_10s_Video_Guide.pdf',
			'dl_name'  => 'KR_T1_03_Google_Flow_Basic_10s_Video_Guide.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 1,
			'title'    => 'PDF-03: Basic Google Flow 10-Second Video Walkthrough & MP4 Export',
		),
		'tier1_pdf_04'               => array(
			'filename' => 'tier01_pdfs/KR_T1_04_Scene_Prompt_Templates_And_Setup_Support.pdf',
			'dl_name'  => 'KR_T1_04_Scene_Prompt_Templates_And_Setup_Support.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 1,
			'title'    => 'PDF-04: 15 Plug-and-Play Scene Prompts & Your 7-Day Guided Setup Window',
		),
		'tier1_website_channel_pack' => array(
			'filename' => 'Keystone_Tier01_AI_Video_Website_Blueprint_Pack.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 1,
			'title'    => 'Keystone Tier 01 AI Video & Website Blueprint Pack (.ZIP)',
		),
		'tier1_gsc_indexer'          => array(
			'filename' => 'Keystone_Tier01_AI_Video_Website_Blueprint_Pack.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 1,
			'title'    => 'Keystone Tier 01 GSC Indexer & Website Pack (.ZIP)',
		),
		'tier2_swarm_pack'           => array(
			'filename' => 'Keystone_Tier02_28_Agent_Swarm_FastMCP_Suite.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 2,
			'title'    => 'Keystone Tier 02 28-Agent Swarm FastMCP Suite (.ZIP)',
		),
		'tier2_zip'                  => array(
			'filename' => 'Keystone_Tier02_28_Agent_Swarm_FastMCP_Suite.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 2,
			'title'    => 'Keystone Tier 02 28-Agent Swarm FastMCP Suite (.ZIP)',
		),
		'tier2_pdf_05'               => array(
			'filename' => 'tier02_pdfs/KR_T2_05_Website_Builder_And_RankMath_SEO.pdf',
			'dl_name'  => 'KR_T2_05_Website_Builder_And_RankMath_SEO.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 2,
			'title'    => 'PDF-05: Turning Video Scripts into SEO Articles, JSON-LD Schema & GSC Indexing',
		),
		'tier2_pdf_06'               => array(
			'filename' => 'tier02_pdfs/KR_T2_06_YouTube_Brand_Channel_And_Tag_Stack.pdf',
			'dl_name'  => 'KR_T2_06_YouTube_Brand_Channel_And_Tag_Stack.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 2,
			'title'    => 'PDF-06: Multi-Agent Role Prompt Templates (Researcher, Scriptwriter, Web Builder, QA)',
		),
		'tier2_pdf_07'               => array(
			'filename' => 'tier02_pdfs/KR_T2_07_Multi_Agent_Role_Swarm_Prompts.pdf',
			'dl_name'  => 'KR_T2_07_Multi_Agent_Role_Swarm_Prompts.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 2,
			'title'    => 'PDF-07: The 3-Source Fact Verification Protocol (Zero Hallucinations)',
		),
		'tier2_pdf_08'               => array(
			'filename' => 'tier02_pdfs/KR_T2_08_B2B_DNS_MX_Lead_Verification_Outreach.pdf',
			'dl_name'  => 'KR_T2_08_B2B_DNS_MX_Lead_Verification_Outreach.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 2,
			'title'    => 'PDF-08: B2B Client Outreach & Domain Email Verification Workflow',
		),
		'tier2_pdf_09'               => array(
			'filename' => 'tier02_pdfs/KR_T2_09_30_Day_Omnichannel_Publishing_Blueprint.pdf',
			'dl_name'  => 'KR_T2_09_30_Day_Omnichannel_Publishing_Blueprint.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 2,
			'title'    => 'PDF-09: Locked Top-and-Bottom Logo HTML Email Shell Architecture',
		),
		'tier3_workstation_pack'     => array(
			'filename' => 'Keystone_Tier03_Sovereign_Workstation_Installer_Suite.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 3,
			'title'    => 'Keystone Tier 03 Sovereign Workstation Installer Suite (.ZIP)',
		),
		'tier3_zip'                  => array(
			'filename' => 'Keystone_Tier03_Sovereign_Workstation_Installer_Suite.zip',
			'mime'     => 'application/zip',
			'type'     => 'zip',
			'min_tier' => 3,
			'title'    => 'Keystone Tier 03 Sovereign Workstation Installer Suite (.ZIP)',
		),
		'tier3_pdf_10'               => array(
			'filename' => 'tier03_pdfs/KR_T3_10_Tauri_v2_Desktop_Toolchain_Scaffold.pdf',
			'dl_name'  => 'KR_T3_10_Tauri_v2_Desktop_Toolchain_Scaffold.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 3,
			'title'    => 'PDF-10: Custom Tauri Desktop App Architecture & Project Setup',
		),
		'tier3_pdf_11'               => array(
			'filename' => 'tier03_pdfs/KR_T3_11_Command_Center_UI_And_Rust_IPC.pdf',
			'dl_name'  => 'KR_T3_11_Command_Center_UI_And_Rust_IPC.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 3,
			'title'    => 'PDF-11: Building Custom Dashboard Tabs & One-Click Action Buttons',
		),
		'tier3_pdf_12'               => array(
			'filename' => 'tier03_pdfs/KR_T3_12_Compiling_Signing_Windows_EXE.pdf',
			'dl_name'  => 'KR_T3_12_Compiling_Signing_Windows_EXE.pdf',
			'mime'     => 'application/pdf',
			'type'     => 'pdf',
			'min_tier' => 3,
			'title'    => 'PDF-12: Compiling & Launching Your Standalone Windows .EXE Desktop App',
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

	// Cumulative Tier Entitlement Enforcement (Tier 3 >= Tier 2 >= Tier 1)
	$user_tier = (int) ( $verification['tier'] ?? 1 );
	$min_tier  = (int) ( $pack_info['min_tier'] ?? 1 );
	$is_admin  = ! empty( $verification['is_admin'] ) ||
		( function_exists( 'is_user_logged_in' ) && is_user_logged_in() && current_user_can( 'manage_options' ) ) ||
		in_array( $verification['uid'] ?? '', array( 'KR-OWNER-WAYNE-52603', 'KR-UID-WAYNE52603', 'KR-ADMIN-52603' ), true ) ||
		( 0 === strpos( (string) ( $verification['uid'] ?? '' ), 'KR-ADMIN-UID-' ) );

	if ( ! $is_admin && $user_tier < $min_tier ) {
		wp_die(
			sprintf(
				'🔒 Upgrade Required: %s requires Tier 0%d setup access or higher. Your verified pass is Tier 0%d. Please upgrade on /ai-protocols/ to unlock.',
				esc_html( $pack_info['title'] ?? $pack_slug ),
				$min_tier,
				$user_tier
			),
			'Upgrade Required',
			array( 'response' => 403 )
		);
	}

	$file_path = get_stylesheet_directory() . '/assets/vault_packs/' . $pack_info['filename'];

	if ( file_exists( $file_path ) && is_readable( $file_path ) ) {
		$size    = (int) filesize( $file_path );
		$dl_name = ! empty( $pack_info['dl_name'] ) ? $pack_info['dl_name'] : basename( $pack_info['filename'] );
		nocache_headers();
		header( 'Content-Type: ' . $pack_info['mime'] );
		header( 'Content-Disposition: attachment; filename="' . $dl_name . '"' );
		header( 'Content-Length: ' . $size );
		readfile( $file_path );
		exit;
	}

	// Graceful On-the-Fly Fallback when physical file is still rendering/compiling
	if ( 'pdf' === ( $pack_info['type'] ?? 'zip' ) ) {
		$dl_name   = ! empty( $pack_info['dl_name'] ) ? $pack_info['dl_name'] : basename( $pack_info['filename'] );
		$pdf_title = ! empty( $pack_info['title'] ) ? $pack_info['title'] : $dl_name;
		$pdf_bytes = keystone_generate_fallback_pdf_bytes( $pdf_title, (string) $verification['uid'] );
		nocache_headers();
		header( 'Content-Type: application/pdf' );
		header( 'Content-Disposition: attachment; filename="' . $dl_name . '"' );
		header( 'Content-Length: ' . strlen( $pdf_bytes ) );
		echo $pdf_bytes;
		exit;
	}

	// Fallback on-the-fly valid ZIP archive with Copy-Paste Antigravity Brain, Google Flow ~20-word Prompts & Website Prompts
	$readme_txt  = "============================================================================\r\n";
	$readme_txt .= "KEYSTONE AI PROTOCOLS — COPY-PASTE ANTIGRAVITY BRAIN, FLOW & WEBSITE PACK\r\n";
	$readme_txt .= "Package: " . $pack_info['filename'] . "\r\n";
	$readme_txt .= "Verified UID: " . $verification['uid'] . "\r\n";
	$readme_txt .= "Self-Service Portal & Guided Setup Assistant: https://keystonerecomposition.com/ai-protocols/?uid=" . $verification['uid'] . "#kr-self-service-portal\r\n";
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
 * Stripe Webhook, Interactive Brain/Channel/Website Setup Intake Form & Guided Setup Assistant.
 */
add_action( 'rest_api_init', function () {
	register_rest_route( 'keystone/v1', '/create-checkout-session', array(
		'methods'             => 'POST',
		'permission_callback' => '__return_true',
		'callback'            => 'keystone_handle_create_checkout_session',
	) );

	register_rest_route( 'keystone/v1', '/verify-checkout-session', array(
		'methods'             => array( 'GET', 'POST' ),
		'permission_callback' => '__return_true',
		'callback'            => 'keystone_handle_verify_checkout_session',
	) );

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

	register_rest_route( 'keystone/v1', '/set-avatar-video-ids', array(
		'methods'             => 'POST',
		'permission_callback' => function (): bool {
			return current_user_can( 'manage_options' );
		},
		'callback'            => 'keystone_handle_set_com_avatar_video_ids',
	) );

	register_rest_route( 'keystone/v1', '/sync-theme-asset', array(
		'methods'             => 'POST',
		'permission_callback' => function (): bool {
			return current_user_can( 'edit_themes' ) && current_user_can( 'manage_options' );
		},
		'callback'            => function ( WP_REST_Request $request ): WP_REST_Response {
			$allowed = array(
				'footer.php',
				'inc/enqueue.php',
				'template-ai-protocols.php',
				'inc/protocol-order-fulfillment.php',
				'inc/core-routes.php',
				'llms.txt',
				'llms-full.txt',
			);
			$params   = $request->get_json_params() ?: $request->get_params();
			$rel_file = isset( $params['file'] ) ? (string) $params['file'] : '';
			$content  = isset( $params['content'] ) ? (string) $params['content'] : '';
			if ( ! in_array( $rel_file, $allowed, true ) || strlen( $content ) < 64 ) {
				return new WP_REST_Response( array( 'ok' => false, 'error' => 'Invalid file or content' ), 400 );
			}
			$dest = trailingslashit( get_stylesheet_directory() ) . $rel_file;
			$dir  = dirname( $dest );
			if ( ! is_dir( $dir ) ) {
				wp_mkdir_p( $dir );
			}
			$bytes = @file_put_contents( $dest, $content );
			if ( false === $bytes ) {
				return new WP_REST_Response( array( 'ok' => false, 'error' => 'Write failed', 'dest' => $dest ), 500 );
			}
			do_action( 'litespeed_purge_all' );
			if ( function_exists( 'wp_cache_flush' ) ) {
				wp_cache_flush();
			}
			return new WP_REST_Response( array( 'ok' => true, 'file' => $rel_file, 'bytes' => $bytes, 'dest' => $dest ), 200 );
		},
	) );
} );

/**
 * Authenticated Admin Setter for Founder Avatar & Tier Walkthrough YouTube IDs (.com).
 *
 * Accepts JSON:
 *   { "hero_intro": "11CHAR_YTID", "tier1": "...", "tier2": "...", "tier3": "..." }
 * (Also accepts canonical option names like "keystone_hero_intro_video_id".)
 */
function keystone_handle_set_com_avatar_video_ids( WP_REST_Request $request ): WP_REST_Response {
	$params = $request->get_json_params() ?: $request->get_params();
	$key_map = array(
		'hero_intro'                   => 'keystone_hero_intro_video_id',
		'keystone_hero_intro_video_id' => 'keystone_hero_intro_video_id',
		'tier1'                        => 'keystone_tier1_video_id',
		'keystone_tier1_video_id'      => 'keystone_tier1_video_id',
		'tier2'                        => 'keystone_tier2_video_id',
		'keystone_tier2_video_id'      => 'keystone_tier2_video_id',
		'tier3'                        => 'keystone_tier3_video_id',
		'keystone_tier3_video_id'      => 'keystone_tier3_video_id',
	);

	$updated = array();
	foreach ( $key_map as $input_key => $option_name ) {
		if ( ! array_key_exists( $input_key, $params ) ) {
			continue;
		}
		$raw_val = trim( sanitize_text_field( (string) $params[ $input_key ] ) );
		if ( '' !== $raw_val && 1 !== preg_match( '/^[A-Za-z0-9_-]{11}$/', $raw_val ) ) {
			return new WP_REST_Response(
				array(
					'ok'    => false,
					'error' => sprintf( 'Invalid 11-character YouTube video ID for %s.', $input_key ),
				),
				400
			);
		}
		update_option( $option_name, $raw_val, false );
		$updated[ $option_name ] = $raw_val;
	}

	if ( empty( $updated ) ) {
		return new WP_REST_Response(
			array(
				'ok'    => false,
				'error' => 'Provide at least one video ID key: hero_intro, tier1, tier2, or tier3.',
			),
			400
		);
	}

	do_action( 'litespeed_purge_all' );
	if ( function_exists( 'wp_cache_flush' ) ) {
		wp_cache_flush();
	}

	return new WP_REST_Response(
		array(
			'ok'      => true,
			'updated' => $updated,
			'active'  => array(
				'keystone_hero_intro_video_id' => (string) get_option( 'keystone_hero_intro_video_id', 'JCgZ5SsN_bc' ),
				'keystone_tier1_video_id'      => (string) get_option( 'keystone_tier1_video_id', '-ZYdbPXenCU' ),
				'keystone_tier2_video_id'      => (string) get_option( 'keystone_tier2_video_id', 'LxbjlX_nh2Q' ),
				'keystone_tier3_video_id'      => (string) get_option( 'keystone_tier3_video_id', '_bSpYdvm6tc' ),
			),
		),
		200
	);
}

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

	$pricing         = keystone_calculate_tier_price( $tier, $promo_code );
	$formatted_price = $pricing['formatted_price'];
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

	// Dispatch Tier-Accurate Dark-Luxury Welcome Email (Tier 01, Tier 02, or Tier 03)
	keystone_send_tier_fulfillment_email(
		$buyer_email,
		$buyer_name,
		$tier,
		$user_uid,
		$order_id,
		$formatted_price,
		$live_mode,
		false
	);

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
		? '✔ UID Verified & Order Fulfilled! Your 6-Tab Course Portal, Visual Brain Setup Diagram, Copy-Paste Antigravity Prompts, 12 Breakdown PDFs, and Guided Setup Assistant are unlocked below, and a copy has been emailed to ' . $buyer_email . '.'
		: sprintf(
			'✔ Launch Rate Locked In ($%s USD) & Self-Service Portal Unlocked (UID: %s)! Your 6-Tab Course Portal, Visual Brain Setup Diagram, Copy-Paste Prompt Packs, and Guided Setup Assistant are unlocked below, and your Magic Portal Link has been emailed to %s.',
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
 * Dispatch Tier-Accurate Dark-Luxury Welcome Email (Tier 01, Tier 02, or Tier 03).
 *
 * @param string $buyer_email
 * @param string $buyer_name
 * @param string $tier ('1', '2', or '3')
 * @param string $user_uid
 * @param string $order_id
 * @param string $formatted_price
 * @param bool   $live_mode
 * @param bool   $sandbox_mode
 * @return bool Whether the email was sent
 */
function keystone_send_tier_fulfillment_email(
	string $buyer_email,
	string $buyer_name,
	string $tier,
	string $user_uid,
	string $order_id,
	string $formatted_price,
	bool $live_mode,
	bool $sandbox_mode = false
): bool {
	if ( ! is_email( $buyer_email ) ) {
		return false;
	}

	$tier_catalog     = keystone_get_protocol_tier_catalog( $user_uid );
	$tier_info        = $tier_catalog[ $tier ] ?? $tier_catalog['1'];
	$magic_portal_url = home_url( '/ai-protocols/?uid=' . rawurlencode( $user_uid ) . '#kr-self-service-portal' );
	$video_id         = keystone_get_tier_walkthrough_video_id( $tier );
	$video_url        = 'https://www.youtube.com/watch?v=' . $video_id;

	$downloads_html = '';
	foreach ( $tier_info['unlocked_downloads'] as $dl ) {
		$downloads_html .= '<li style="margin-bottom:8px;"><a href="' . esc_url( $dl['url'] ) . '" style="color:#38bdf8;font-weight:700;text-decoration:none;">' . esc_html( $dl['label'] ) . '</a></li>';
	}

	$badge_tag = $sandbox_mode ? ' <span style="background:#eab308;color:#000;padding:2px 6px;border-radius:4px;font-size:10px;font-weight:900;">SANDBOX TEST</span>' : '';

	if ( '3' === $tier ) {
		$eyebrow    = 'TIER 03 DESKTOP COMMAND // TAURI BUILDER SUITE & 1-ON-1 ARCHITECTURE' . ( $sandbox_mode ? ' [TEST]' : '' );
		$headline   = 'Welcome to Tier 03 — Custom Tauri Desktop Command Suite & Direct Founder Architecture';
		$inner_html = '
			<p style="color:#cbd5e1;font-size:14.5px;line-height:1.68;">Welcome to the top tier of Keystone AI Protocols, <strong>' . esc_html( $buyer_name ) . '</strong>! Your one-time investment in <strong>' . esc_html( $tier_info['name'] ) . ' ($' . esc_html( $formatted_price ) . ' USD)</strong>' . $badge_tag . ' is verified and fully unlocked.</p>
			<p style="color:#cbd5e1;font-size:14px;line-height:1.65;">Tier 03 gives you the entire sovereign tech stack: from your 4-Folder AI Brain and ~20-word Google Flow pipelines, to multi-agent FastMCP swarms, up to compiling your own standalone <strong>Windows .EXE Desktop Command Center</strong> using Rust and Tauri. Plus, you have an extended <strong>14-Day Setup Window</strong> with up to <strong>8 direct follow-up questions</strong> and direct architectural review with Wayne Stevenson.</p>
			<div style="background:#04070d;border:1.5px solid #d4af37;border-radius:12px;padding:16px 20px;margin:18px 0;">
				<div style="font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;">YOUR VERIFIED BUYER ACCESS UID (14-DAY SETUP WINDOW ACTIVE)</div>
				<div style="font-size:20px;font-weight:900;color:#38bdf8;font-family:monospace;margin-top:4px;">' . esc_html( $user_uid ) . '</div>
				<div style="font-size:11.5px;color:#f6d365;margin-top:4px;">Order ID: ' . esc_html( $order_id ) . ' &bull; Investment: $' . esc_html( $formatted_price ) . ' USD &bull; Status: ' . ( $sandbox_mode ? 'PAID_VERIFIED_SANDBOX' : ( $live_mode ? 'PAID_VERIFIED' : 'WAITLIST_RESERVED' ) ) . '</div>
			</div>
			<div style="background:#0b111e;border:1px solid rgba(56,189,248,0.4);border-radius:12px;padding:16px;margin:18px 0;">
				<div style="color:#38bdf8;font-weight:800;font-size:13px;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:8px;">🎬 TIER 03 UNLISTED WALKTHROUGH VIDEO (DEDICATED FOUNDER WALKTHROUGH)</div>
				<p style="color:#e2e8f0;font-size:13px;margin:0 0 10px 0;line-height:1.5;">Watch Wayne walk you through setting up your Tauri workspace, wiring your buttons to your AI Brain, and compiling your Windows .EXE installer step-by-step:</p>
				<a href="' . esc_url( $video_url ) . '" target="_blank" style="display:inline-block;background:#38bdf8;color:#04070d;font-weight:800;font-size:12.5px;padding:8px 18px;border-radius:9999px;text-decoration:none;">▶ WATCH TIER 03 WALKTHROUGH VIDEO ON YOUTUBE</a>
			</div>
			<h3 style="color:#d4af37;font-size:15px;margin:20px 0 8px 0;">📦 Instant Downloads &amp; All 12 PDF Breakdown Guides (Cumulative Access)</h3>
			<ul style="color:#cbd5e1;font-size:13.5px;line-height:1.6;padding-left:18px;">' . $downloads_html . '</ul>';
	} elseif ( '2' === $tier ) {
		$eyebrow    = 'TIER 02 MULTI-AGENT SWARMS // FULL AUTONOMOUS PROTOCOLS' . ( $sandbox_mode ? ' [TEST]' : '' );
		$headline   = 'Welcome to Tier 02 — Multi-Agent Swarms, 9 PDF Guides & Full Code Packs Unlocked';
		$inner_html = '
			<p style="color:#cbd5e1;font-size:14.5px;line-height:1.68;">Welcome to Tier 02 of Keystone AI Protocols, <strong>' . esc_html( $buyer_name ) . '</strong>! Your access to <strong>' . esc_html( $tier_info['name'] ) . ' ($' . esc_html( $formatted_price ) . ' USD)</strong>' . $badge_tag . ' is verified and active.</p>
			<p style="color:#cbd5e1;font-size:14px;line-height:1.65;">You now have full access to our multi-agent swarm architecture: discrete researcher, scriptwriter, and web builder roles, FastMCP IPC contracts, 3-source research validation, and automated B2B outreach tools. You also receive cumulative access to all Tier 01 foundational assets (PDF-01 through PDF-09) and a <strong>7-Day Setup Window</strong> with up to <strong>5 direct follow-up questions</strong>.</p>
			<div style="background:#04070d;border:1.5px solid #d4af37;border-radius:12px;padding:16px 20px;margin:18px 0;">
				<div style="font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;">YOUR VERIFIED BUYER ACCESS UID (7-DAY SETUP WINDOW ACTIVE)</div>
				<div style="font-size:20px;font-weight:900;color:#38bdf8;font-family:monospace;margin-top:4px;">' . esc_html( $user_uid ) . '</div>
				<div style="font-size:11.5px;color:#f6d365;margin-top:4px;">Order ID: ' . esc_html( $order_id ) . ' &bull; Investment: $' . esc_html( $formatted_price ) . ' USD &bull; Status: ' . ( $sandbox_mode ? 'PAID_VERIFIED_SANDBOX' : ( $live_mode ? 'PAID_VERIFIED' : 'WAITLIST_RESERVED' ) ) . '</div>
			</div>
			<div style="background:#0b111e;border:1px solid rgba(56,189,248,0.4);border-radius:12px;padding:16px;margin:18px 0;">
				<div style="color:#38bdf8;font-weight:800;font-size:13px;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:8px;">🎬 TIER 02 UNLISTED WALKTHROUGH VIDEO (SWARM ARCHITECTURE)</div>
				<p style="color:#e2e8f0;font-size:13px;margin:0 0 10px 0;line-height:1.5;">Watch Wayne explain how multi-agent role prompts communicate, how to wire FastMCP tools, and how to verify facts without hallucinations:</p>
				<a href="' . esc_url( $video_url ) . '" target="_blank" style="display:inline-block;background:#38bdf8;color:#04070d;font-weight:800;font-size:12.5px;padding:8px 18px;border-radius:9999px;text-decoration:none;">▶ WATCH TIER 02 WALKTHROUGH VIDEO ON YOUTUBE</a>
			</div>
			<h3 style="color:#d4af37;font-size:15px;margin:20px 0 8px 0;">📦 Instant Downloads &amp; Breakdown PDFs 01–09 (Cumulative Access)</h3>
			<ul style="color:#cbd5e1;font-size:13.5px;line-height:1.6;padding-left:18px;">' . $downloads_html . '</ul>';
	} else {
		$eyebrow    = 'TIER 01 FOUNDATION // AI BRAIN & GOOGLE FLOW WALKTHROUGH' . ( $sandbox_mode ? ' [TEST]' : '' );
		$headline   = 'Welcome to Tier 01 — Your Walkthrough Video, 4 PDF Setup Guides & Starter .ZIP Are Ready';
		$inner_html = '
			<p style="color:#cbd5e1;font-size:14.5px;line-height:1.68;">Welcome aboard, and thank you for ' . ( $live_mode ? 'getting started with' : 'locking in your one-time setup access for' ) . ' <strong>' . esc_html( $tier_info['name'] ) . ' ($' . esc_html( $formatted_price ) . ' USD)</strong>' . $badge_tag . '.</p>
			<p style="color:#cbd5e1;font-size:14px;line-height:1.65;">Just like pouring a level concrete foundation on a job site, setting up your AI properly takes away all the guesswork. Instead of typing random prompts into messy chat windows that forget your project, we are going to set up your clean <strong>4-Folder AI Brain</strong> inside Google Antigravity and walk through a simple <strong>10-second Google Flow video example</strong> together.</p>
			<div style="background:#04070d;border:1.5px solid #d4af37;border-radius:12px;padding:16px 20px;margin:18px 0;">
				<div style="font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.06em;">YOUR VERIFIED BUYER ACCESS UID (7-DAY SETUP WINDOW ACTIVE)</div>
				<div style="font-size:20px;font-weight:900;color:#38bdf8;font-family:monospace;margin-top:4px;">' . esc_html( $user_uid ) . '</div>
				<div style="font-size:11.5px;color:#f6d365;margin-top:4px;">Order ID: ' . esc_html( $order_id ) . ' &bull; One-Time Payment: $' . esc_html( $formatted_price ) . ' USD &bull; Includes 7-Day Setup Support (Up to 3 Follow-Up Questions)</div>
			</div>
			<div style="background:#0b111e;border:1px solid rgba(56,189,248,0.4);border-radius:12px;padding:16px;margin:18px 0;">
				<div style="color:#38bdf8;font-weight:800;font-size:13px;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:8px;">🎬 TIER 01 UNLISTED WALKTHROUGH VIDEO (STEP-BY-STEP FOUNDATION)</div>
				<p style="color:#e2e8f0;font-size:13px;margin:0 0 10px 0;line-height:1.5;">Watch Wayne walk you through your initial 4-folder AI Brain setup, Google Flow reference images, and prompt generation:</p>
				<a href="' . esc_url( $video_url ) . '" target="_blank" style="display:inline-block;background:#38bdf8;color:#04070d;font-weight:800;font-size:12.5px;padding:8px 18px;border-radius:9999px;text-decoration:none;">▶ WATCH TIER 01 WALKTHROUGH VIDEO ON YOUTUBE</a>
			</div>
			<h3 style="color:#d4af37;font-size:15px;margin:20px 0 8px 0;">📦 Instant Downloads &amp; 4 PDF Setup Guides</h3>
			<ul style="color:#cbd5e1;font-size:13.5px;line-height:1.6;padding-left:18px;">' . $downloads_html . '</ul>';
	}

	$email_body = keystone_build_locked_protocol_email_shell(
		$buyer_name,
		$eyebrow,
		$headline,
		$inner_html,
		$magic_portal_url,
		'OPEN MY BUYER SETUP PAGE & WATCH WALKTHROUGH VIDEO'
	);

	$subject_prefix = $sandbox_mode ? '[SANDBOX TEST] ' : '';
	$buyer_subject  = sprintf( '%s[Keystone AI Protocols] %s — Walkthrough Video & Buyer Vault Ready (UID: %s)', $subject_prefix, $tier_info['name'], $user_uid );

	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: Wayne Stevenson — Keystone AI Protocols <keystonerecomposition@gmail.com>',
		'Reply-To: keystonerecomposition@gmail.com',
	);

	$attachments = keystone_get_tier_email_attachments( $tier );
	return (bool) @wp_mail( $buyer_email, $buyer_subject, $email_body, $headers, $attachments );
}

/**
 * Create Stripe Checkout Session endpoint (`POST /wp-json/keystone/v1/create-checkout-session`).
 *
 * Implements the Stripe Mutual Exclusion Law:
 * - If a promo code was applied in the UI ($pricing['has_promo'] === true), we pass the pre-discounted
 *   `unit_amount` and omit `allow_promotion_codes`.
 * - If NO promo code was applied, we pass the standard unit amount and pass `'allow_promotion_codes' => 'true'`.
 */
function keystone_handle_create_checkout_session( WP_REST_Request $request ): WP_REST_Response {
	$params      = $request->get_json_params() ?: $request->get_params();
	$tier        = sanitize_text_field( (string) ( $params['tier'] ?? '1' ) );
	$promo_code  = strtoupper( sanitize_text_field( (string) ( $params['promo_code'] ?? '' ) ) );
	$buyer_name  = sanitize_text_field( (string) ( $params['buyer_name'] ?? '' ) );
	$buyer_email = sanitize_email( (string) ( $params['buyer_email'] ?? '' ) );

	if ( ! in_array( $tier, array( '1', '2', '3' ), true ) ) {
		$tier = '1';
	}

	$secret_key = keystone_get_stripe_secret_key();
	if ( empty( $secret_key ) ) {
		return new WP_REST_Response( array(
			'success'          => false,
			'stripe_available' => false,
			'message'          => 'Stripe live card checkout is being configured by the site administrator. Please use the Reservation form below to lock in your rate immediately.',
		), 400 );
	}

	$pricing      = keystone_calculate_tier_price( $tier, $promo_code );
	$cent_price   = (int) $pricing['cent_price'];
	$tier_catalog = keystone_get_protocol_tier_catalog();
	$tier_info    = $tier_catalog[ $tier ];

	$success_url = home_url( '/ai-protocols/?session_id={CHECKOUT_SESSION_ID}#buyer-setup-vault' );
	$cancel_url  = home_url( '/ai-protocols/#kr-tier-' . $tier );

	// Build Stripe API payload
	$post_data = array(
		'mode'                                                 => 'payment',
		'payment_method_types[0]'                             => 'card',
		'line_items[0][price_data][currency]'                  => 'usd',
		'line_items[0][price_data][unit_amount]'               => (string) $cent_price,
		'line_items[0][price_data][product_data][name]'        => $tier_info['name'],
		'line_items[0][price_data][product_data][description]' => 'Instant digital access to Keystone AI Protocols ' . $tier_info['name'] . ' with Setup Guides and Walkthrough Video.',
		'line_items[0][quantity]'                              => '1',
		'metadata[tier]'                                      => $tier,
		'metadata[buyer_name]'                                 => $buyer_name,
		'metadata[promo_code]'                                 => $promo_code,
		'success_url'                                          => $success_url,
		'cancel_url'                                           => $cancel_url,
	);

	if ( is_email( $buyer_email ) ) {
		$post_data['customer_email'] = $buyer_email;
	}

	// Stripe Mutual Exclusion Law:
	if ( ! empty( $pricing['has_promo'] ) ) {
		// Promo was already calculated and applied; do NOT pass allow_promotion_codes to prevent Stripe 400
	} else {
		// Allow buyer to enter promo code on Stripe checkout page
		$post_data['allow_promotion_codes'] = 'true';
	}

	$response = wp_remote_post( 'https://api.stripe.com/v1/checkout/sessions', array(
		'headers' => array(
			'Authorization'  => 'Bearer ' . $secret_key,
			'Stripe-Version' => '2024-06-20',
			'Content-Type'   => 'application/x-www-form-urlencoded',
		),
		'body'    => http_build_query( $post_data ),
		'timeout' => 20,
	) );

	if ( is_wp_error( $response ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Failed to connect to Stripe: ' . $response->get_error_message(),
		), 502 );
	}

	$code = wp_remote_retrieve_response_code( $response );
	$body = wp_remote_retrieve_body( $response );
	$data = json_decode( $body, true );

	if ( 200 !== $code || empty( $data['url'] ) ) {
		$err_msg = $data['error']['message'] ?? ( 'Stripe returned HTTP ' . $code );
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Stripe Checkout error: ' . $err_msg,
			'debug'   => WP_DEBUG ? $data : null,
		), 400 );
	}

	return new WP_REST_Response( array(
		'success'      => true,
		'checkout_url' => $data['url'],
		'session_id'   => $data['id'],
		'tier'         => $tier,
		'cent_price'   => $cent_price,
	), 200 );
}

/**
 * Verify Checkout Session endpoint (`GET|POST /wp-json/keystone/v1/verify-checkout-session`).
 *
 * Verifies a returning buyer's `session_id=cs_...` against the Stripe API, retrieves
 * or creates their order and UID, and returns their unlocked curriculum and video.
 */
function keystone_handle_verify_checkout_session( WP_REST_Request $request ): WP_REST_Response {
	$session_id = sanitize_text_field( (string) ( $request->get_param( 'session_id' ) ?? '' ) );
	if ( '' === $session_id || 0 !== strpos( $session_id, 'cs_' ) ) {
		return new WP_REST_Response( array(
			'verified' => false,
			'message'  => 'Invalid or missing Stripe session ID.',
		), 400 );
	}

	$secret_key = keystone_get_stripe_secret_key();
	if ( empty( $secret_key ) ) {
		return new WP_REST_Response( array(
			'verified' => false,
			'message'  => 'Stripe secret key not configured on server.',
		), 500 );
	}

	$response = wp_remote_get( 'https://api.stripe.com/v1/checkout/sessions/' . rawurlencode( $session_id ), array(
		'headers' => array(
			'Authorization'  => 'Bearer ' . $secret_key,
			'Stripe-Version' => '2024-06-20',
		),
		'timeout' => 20,
	) );

	if ( is_wp_error( $response ) ) {
		return new WP_REST_Response( array(
			'verified' => false,
			'message'  => 'Unable to contact Stripe: ' . $response->get_error_message(),
		), 502 );
	}

	$code    = wp_remote_retrieve_response_code( $response );
	$body    = wp_remote_retrieve_body( $response );
	$session = json_decode( $body, true );

	if ( 200 !== $code || empty( $session['id'] ) ) {
		return new WP_REST_Response( array(
			'verified' => false,
			'message'  => 'Stripe session not found or invalid.',
		), 404 );
	}

	$is_paid = ( 'paid' === ( $session['payment_status'] ?? '' ) ) || ( 'complete' === ( $session['status'] ?? '' ) );
	if ( ! $is_paid ) {
		return new WP_REST_Response( array(
			'verified'       => false,
			'payment_status' => $session['payment_status'] ?? 'unpaid',
			'status'         => $session['status'] ?? 'open',
			'message'        => 'Payment is not yet confirmed by Stripe.',
		), 200 );
	}

	$buyer_email = sanitize_email( (string) ( $session['customer_details']['email'] ?? $session['customer_email'] ?? '' ) );
	$buyer_name  = sanitize_text_field( (string) ( $session['customer_details']['name'] ?? 'Verified Stripe Buyer' ) );
	$tier        = sanitize_text_field( (string) ( $session['metadata']['tier'] ?? '1' ) );
	if ( ! in_array( $tier, array( '1', '2', '3' ), true ) ) {
		$tier = '1';
	}

	$is_live      = ! empty( $session['livemode'] );
	$user_uid     = keystone_generate_user_vault_uid( $buyer_email ?: ( 'buyer-' . substr( $session['id'], -8 ) ), $tier );
	$tier_catalog = keystone_get_protocol_tier_catalog( $user_uid );
	$tier_info    = $tier_catalog[ $tier ];

	$amount_cents    = isset( $session['amount_total'] ) ? (int) $session['amount_total'] : (int) round( (float) $tier_info['price'] * 100 );
	$formatted_price = number_format( $amount_cents / 100, 2, '.', '' );

	// Ensure order record is saved if webhook was delayed
	$orders = get_option( 'keystone_protocol_orders_v10', array() );
	if ( ! is_array( $orders ) ) {
		$orders = array();
	}
	$order_exists = false;
	foreach ( $orders as $ord ) {
		if ( isset( $ord['stripe_session_id'] ) && $ord['stripe_session_id'] === $session['id'] ) {
			$order_exists = true;
			break;
		}
	}
	if ( ! $order_exists ) {
		$order_id     = ( $is_live ? 'KR-STRIPE-' : 'KR-TEST-' ) . gmdate( 'Ymd-His' ) . '-' . strtoupper( substr( md5( $session['id'] ), 0, 6 ) );
		$order_record = array(
			'order_id'              => $order_id,
			'stripe_session_id'     => $session['id'],
			'user_uid'              => $user_uid,
			'tier'                  => $tier,
			'tier_name'             => $tier_info['name'],
			'price'                 => $formatted_price,
			'buyer_name'            => $buyer_name,
			'buyer_email'           => $buyer_email,
			'walkthrough_video_url' => $tier_info['walkthrough_video_url'],
			'status'                => $is_live ? 'paid_verified' : 'paid_verified_sandbox',
			'created_at'            => gmdate( 'c' ),
		);
		array_unshift( $orders, $order_record );
		if ( count( $orders ) > 250 ) {
			$orders = array_slice( $orders, 0, 250 );
		}
		update_option( 'keystone_protocol_orders_v10', $orders, false );

		// Dispatch welcome email if email is present
		if ( is_email( $buyer_email ) ) {
			keystone_send_tier_fulfillment_email(
				$buyer_email,
				$buyer_name,
				$tier,
				$user_uid,
				$order_id,
				$formatted_price,
				$is_live,
				! $is_live
			);
		}
	}

	return new WP_REST_Response( array(
		'verified'              => true,
		'session_id'            => $session['id'],
		'uid'                   => $user_uid,
		'tier'                  => $tier,
		'tier_name'             => $tier_info['name'],
		'buyer_name'            => $buyer_name,
		'buyer_email'           => $buyer_email,
		'amount_cents'          => $amount_cents,
		'formatted_price'       => $formatted_price,
		'live_mode'             => $is_live,
		'walkthrough_video_id'  => $tier_info['walkthrough_video_id'],
		'walkthrough_video_url' => $tier_info['walkthrough_video_url'],
		'unlocked_downloads'    => $tier_info['unlocked_downloads'],
		'unlocked_modules'      => $tier_info['unlocked_modules'],
		'unlocked_pdfs'         => $tier_info['unlocked_pdfs'],
		'portal_url'            => home_url( '/ai-protocols/?uid=' . rawurlencode( $user_uid ) . '#buyer-setup-vault' ),
	), 200 );
}

/**
 * Stripe Hosted Checkout HMAC-SHA256 Webhook Endpoint (`POST /wp-json/keystone/v1/stripe-webhook`).
 * Verifies `HTTP_STRIPE_SIGNATURE`, checks 300s replay window, atomic idempotency lock via add_option,
 * mints deterministic `KR-UID-XXXXXXXXXXXX`, saves order with `status = 'paid_verified'` (or sandbox),
 * and dispatches the Distinct Tier-Accurate Dark-Luxury Welcome Email.
 */
function keystone_handle_stripe_webhook( WP_REST_Request $request ): WP_REST_Response {
	// LiteSpeed Cache Control
	if ( ! headers_sent() ) {
		header( 'X-LiteSpeed-Cache-Control: no-cache, no-store, must-revalidate' );
	}

	$raw_payload = (string) $request->get_body();
	$sig_header  = (string) ( $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? $request->get_header( 'stripe-signature' ) ?? '' );
	$secret      = (string) keystone_get_stripe_webhook_secret();

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

	// 300s Replay Protection
	if ( abs( time() - (int) $timestamp ) > 300 ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'Webhook timestamp expired or too far in future (replay protection).',
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

	// Atomic Idempotency Guard via add_option
	$opt_key = 'keystone_stripe_evt_' . $event_id;
	if ( false === add_option( $opt_key, time(), '', 'no' ) ) {
		return new WP_REST_Response( array(
			'success'    => true,
			'idempotent' => true,
			'event_id'   => $event_id,
			'message'    => 'Event already processed (atomic lock).',
		), 200 );
	}

	// Also maintain circular array for admin logging
	$processed_events = get_option( 'keystone_stripe_processed_events', array() );
	if ( ! is_array( $processed_events ) ) {
		$processed_events = array();
	}
	$processed_events[] = $event_id;
	if ( count( $processed_events ) > 500 ) {
		$processed_events = array_slice( $processed_events, -500 );
	}
	update_option( 'keystone_stripe_processed_events', $processed_events, false );

	if ( 'checkout.session.completed' !== $event_type && 'checkout.session.async_payment_succeeded' !== $event_type ) {
		return new WP_REST_Response( array(
			'success'    => true,
			'event_type' => $event_type,
			'message'    => 'Event acknowledged (non-checkout event).',
		), 200 );
	}

	$session        = $event['data']['object'] ?? array();
	$payment_status = (string) ( $session['payment_status'] ?? 'paid' );
	if ( 'paid' !== $payment_status ) {
		return new WP_REST_Response( array(
			'success'        => true,
			'payment_status' => $payment_status,
			'message'        => 'Checkout session completed but payment is pending asynchronous settlement.',
		), 200 );
	}

	$buyer_email = sanitize_email( (string) ( $session['customer_details']['email'] ?? $session['customer_email'] ?? '' ) );
	$buyer_name  = sanitize_text_field( (string) ( $session['customer_details']['name'] ?? 'Verified Stripe Buyer' ) );
	$tier        = sanitize_text_field( (string) ( $session['metadata']['tier'] ?? '1' ) );
	if ( ! in_array( $tier, array( '1', '2', '3' ), true ) ) {
		$tier = '1';
	}

	if ( ! is_email( $buyer_email ) ) {
		return new WP_REST_Response( array(
			'success' => false,
			'message' => 'No valid customer email in checkout session payload.',
		), 400 );
	}

	$is_live         = ! empty( $event['livemode'] );
	$user_uid        = keystone_generate_user_vault_uid( $buyer_email, $tier );
	$tier_catalog    = keystone_get_protocol_tier_catalog( $user_uid );
	$tier_info       = $tier_catalog[ $tier ];
	$amount_cents    = isset( $session['amount_total'] ) ? (int) $session['amount_total'] : (int) round( (float) $tier_info['price'] * 100 );
	$formatted_price = number_format( $amount_cents / 100, 2, '.', '' );
	$order_id        = ( $is_live ? 'KR-STRIPE-' : 'KR-TEST-' ) . gmdate( 'Ymd-His' ) . '-' . strtoupper( substr( md5( $event_id ), 0, 6 ) );

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
		'status'                => $is_live ? 'paid_verified' : 'paid_verified_sandbox',
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

	// Dispatch Distinct Tier-Accurate Dark-Luxury Welcome Email
	keystone_send_tier_fulfillment_email(
		$buyer_email,
		$buyer_name,
		$tier,
		$user_uid,
		$order_id,
		$formatted_price,
		$is_live,
		! $is_live
	);

	return new WP_REST_Response( array(
		'success'          => true,
		'status'           => $is_live ? 'paid_verified' : 'paid_verified_sandbox',
		'order_id'         => $order_id,
		'user_uid'         => $user_uid,
		'tier'             => $tier,
		'magic_portal_url' => home_url( '/ai-protocols/?uid=' . rawurlencode( $user_uid ) . '#kr-self-service-portal' ),
	), 200 );
}

/**
 * Register WP-Admin Menu for Keystone Stripe USD & Visa Gateway.
 */
add_action( 'admin_menu', 'keystone_register_stripe_admin_menu' );
function keystone_register_stripe_admin_menu(): void {
	add_options_page(
		'Keystone Stripe USD & Visa Gateway',
		'Keystone Stripe USD',
		'manage_options',
		'keystone-stripe-settings',
		'keystone_render_stripe_settings_page'
	);
}

/**
 * 1-Screen Owner Setup UI in WP-Admin for Wayne Stevenson.
 * Allows entering live/test Stripe keys, webhook secret, video IDs, and payment links.
 * All keys stored in non-autoloaded options (`autoload = 'no'`).
 */
function keystone_render_stripe_settings_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Access denied.' );
	}

	$saved = false;
	if ( 'POST' === ( $_SERVER['REQUEST_METHOD'] ?? '' ) && check_admin_referer( 'keystone_stripe_settings_nonce', 'keystone_stripe_nonce' ) ) {
		$mode = sanitize_text_field( (string) ( $_POST['keystone_stripe_mode'] ?? 'test' ) );
		update_option( 'keystone_stripe_mode', in_array( $mode, array( 'test', 'live' ), true ) ? $mode : 'test', false );

		$fields = array(
			'keystone_stripe_test_secret_key',
			'keystone_stripe_test_publishable_key',
			'keystone_stripe_test_webhook_secret',
			'keystone_stripe_live_secret_key',
			'keystone_stripe_live_publishable_key',
			'keystone_stripe_live_webhook_secret',
			'keystone_hero_intro_video_id',
			'keystone_tier1_video_id',
			'keystone_tier2_video_id',
			'keystone_tier3_video_id',
			'keystone_tier1_stripe_link',
			'keystone_tier2_stripe_link',
			'keystone_tier3_stripe_link',
		);

		foreach ( $fields as $f ) {
			if ( isset( $_POST[ $f ] ) ) {
				$val = trim( sanitize_text_field( (string) $_POST[ $f ] ) );
				// If submitted value is masked (starts with ***), do not overwrite existing key!
				if ( '' !== $val && 0 !== strpos( $val, '***' ) ) {
					update_option( $f, $val, false );
				} elseif ( '' === $val && false !== strpos( $f, '_link' ) ) {
					update_option( $f, '', false );
				}
			}
		}
		$saved = true;
	}

	$mode         = (string) get_option( 'keystone_stripe_mode', 'test' );
	$live_sk      = (string) get_option( 'keystone_stripe_live_secret_key', '' );
	$live_pk      = (string) get_option( 'keystone_stripe_live_publishable_key', '' );
	$live_whsec   = (string) get_option( 'keystone_stripe_live_webhook_secret', '' );
	$test_sk      = (string) get_option( 'keystone_stripe_test_secret_key', '' );
	$test_pk      = (string) get_option( 'keystone_stripe_test_publishable_key', '' );
	$test_whsec     = (string) get_option( 'keystone_stripe_test_webhook_secret', '' );
	$hero_video_id  = (string) get_option( 'keystone_hero_intro_video_id', 'JCgZ5SsN_bc' );
	$t1_video_id    = (string) get_option( 'keystone_tier1_video_id', '-ZYdbPXenCU' );
	$t2_video_id  = (string) get_option( 'keystone_tier2_video_id', 'LxbjlX_nh2Q' );
	$t3_video_id  = (string) get_option( 'keystone_tier3_video_id', '_bSpYdvm6tc' );
	$t1_link      = (string) get_option( 'keystone_tier1_stripe_link', '' );
	$t2_link      = (string) get_option( 'keystone_tier2_stripe_link', '' );
	$t3_link      = (string) get_option( 'keystone_tier3_stripe_link', '' );

	$active_sk    = 'live' === $mode ? $live_sk : $test_sk;
	$active_whsec = 'live' === $mode ? $live_whsec : $test_whsec;
	$is_ready     = ! empty( $active_sk ) && ! empty( $active_whsec );

	$mask_key = function( string $k ): string {
		if ( empty( $k ) ) {
			return '';
		}
		if ( strlen( $k ) <= 8 ) {
			return '********';
		}
		return substr( $k, 0, 4 ) . '...' . substr( $k, -4 );
	};

	$webhook_url = home_url( '/wp-json/keystone/v1/stripe-webhook' );
	?>
	<div class="wrap" style="max-width:1050px;margin-top:20px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;">
		<div style="background:#04070d;border:1.5px solid #d4af37;border-radius:14px;padding:26px 32px;color:#f8fafc;box-shadow:0 12px 36px rgba(0,0,0,0.6);">
			
			<div style="display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid rgba(212,175,55,0.25);padding-bottom:18px;margin-bottom:22px;">
				<div>
					<div style="color:#38bdf8;font-size:12px;font-weight:800;letter-spacing:0.08em;text-transform:uppercase;">Keystone Sovereignty Infrastructure</div>
					<h1 style="color:#d4af37;font-size:24px;margin:4px 0 0 0;font-weight:900;">💳 Stripe USD &amp; Visa Gateway — 1-Screen Setup</h1>
				</div>
				<div style="text-align:right;">
					<span style="display:inline-block;padding:6px 14px;border-radius:9999px;font-size:12px;font-weight:800;letter-spacing:0.04em;background:<?php echo $is_ready ? 'rgba(56,189,248,0.2)' : 'rgba(239,68,68,0.2)'; ?>;color:<?php echo $is_ready ? '#38bdf8' : '#ef4444'; ?>;border:1px solid <?php echo $is_ready ? '#38bdf8' : '#ef4444'; ?>;">
						<?php echo $is_ready ? '● GATEWAY LIVE &amp; READY' : '○ PENDING STRIPE KEYS'; ?>
					</span>
					<div style="color:#94a3b8;font-size:11px;margin-top:4px;">Active Mode: <strong style="color:#f8fafc;text-transform:uppercase;"><?php echo esc_html( $mode ); ?></strong> &bull; Currency: <strong style="color:#d4af37;">USD ($)</strong></div>
				</div>
			</div>

			<?php if ( $saved ) : ?>
				<div style="background:rgba(56,189,248,0.12);border:1px solid #38bdf8;border-radius:8px;padding:12px 18px;margin-bottom:20px;color:#38bdf8;font-weight:700;font-size:13px;">
					✔ Stripe configuration saved successfully! Non-autoloaded options updated.
				</div>
			<?php endif; ?>

			<!-- 3-Minute Setup Checklist -->
			<div style="background:#0b111e;border:1px solid rgba(212,175,55,0.4);border-radius:12px;padding:20px;margin-bottom:24px;">
				<h3 style="color:#d4af37;font-size:15px;margin:0 0 10px 0;letter-spacing:0.03em;">⚡ 3-Minute Stripe USD &amp; Bank Payout Setup Checklist (Canadian Business Ready)</h3>
				<ol style="color:#cbd5e1;font-size:13px;line-height:1.7;margin:0;padding-left:20px;">
					<li><strong>Stripe Account &amp; Currency:</strong> Log in to <a href="https://dashboard.stripe.com" target="_blank" style="color:#38bdf8;text-decoration:none;font-weight:700;">dashboard.stripe.com</a>. Canadian corporations and sole proprietorships can charge in <strong>USD ($)</strong> directly.</li>
					<li><strong>Bank Payout Options:</strong> In Stripe &rarr; <em>Settings &rarr; Bank accounts and scheduling</em>, connect either:
						<br/>&bull; A <strong>US Dollar bank account located in Canada</strong> (e.g. RBC, TD, BMO US Dollar business accounts) for zero-conversion USD payouts.
						<br/>&bull; Or your standard <strong>Canadian CAD bank account</strong> (Stripe will automatically convert USD to CAD at mid-market rates on payout).
					</li>
					<li><strong>Copy API Keys:</strong> Go to <em>Developers &rarr; API keys</em>. Copy your <strong>Secret key</strong> and <strong>Publishable key</strong>.</li>
					<li><strong>Set Webhook:</strong> Go to <em>Developers &rarr; Webhooks &rarr; Add endpoint</em>. Paste the exact URL below and select events: <code>checkout.session.completed</code> and <code>checkout.session.async_payment_succeeded</code>:
						<div style="background:#04070d;border:1px solid rgba(56,189,248,0.4);border-radius:6px;padding:8px 12px;margin:6px 0;font-family:monospace;color:#38bdf8;font-size:12px;">
							<?php echo esc_html( $webhook_url ); ?>
						</div>
						Copy the Signing Secret (starts with <code>whsec_</code>) into the field below.
					</li>
					<li><strong>Flip to Live:</strong> Toggle Mode to <strong>Live Mode</strong>, paste your keys below, click <strong>Save Stripe Configuration</strong>, and your site is instantly ready to process live Visa / Mastercard payments in US Dollars!</li>
				</ol>
			</div>

			<form method="post" action="">
				<?php wp_nonce_field( 'keystone_stripe_settings_nonce', 'keystone_stripe_nonce' ); ?>

				<div style="margin-bottom:22px;">
					<label style="display:block;color:#f8fafc;font-weight:800;font-size:13px;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.04em;">Stripe Operational Mode</label>
					<select name="keystone_stripe_mode" style="background:#0b111e;color:#f8fafc;border:1.5px solid #d4af37;border-radius:8px;padding:8px 14px;font-size:13px;font-weight:700;width:240px;">
						<option value="test" <?php selected( $mode, 'test' ); ?>>🟡 Test Mode (Sandbox Simulation)</option>
						<option value="live" <?php selected( $mode, 'live' ); ?>>💎 Live Mode (Real Visa/Mastercard USD)</option>
					</select>
				</div>

				<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:22px;">
					<!-- Live Credentials -->
					<div style="background:#0b111e;border:1px solid <?php echo 'live' === $mode ? '#d4af37' : 'rgba(255,255,255,0.1)'; ?>;border-radius:10px;padding:18px;">
						<div style="color:#d4af37;font-weight:800;font-size:14px;margin-bottom:12px;">💎 LIVE PRODUCTION CREDENTIALS (USD)</div>
						
						<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Live Secret Key (sk_live_...)</label>
						<input type="password" name="keystone_stripe_live_secret_key" placeholder="<?php echo esc_attr( $mask_key( $live_sk ) ?: 'sk_live_...' ); ?>" style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(212,175,55,0.4);border-radius:6px;padding:8px 10px;font-family:monospace;font-size:12px;margin-bottom:12px;" />

						<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Live Publishable Key (pk_live_...)</label>
						<input type="text" name="keystone_stripe_live_publishable_key" value="<?php echo esc_attr( $live_pk ); ?>" placeholder="pk_live_..." style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(212,175,55,0.4);border-radius:6px;padding:8px 10px;font-family:monospace;font-size:12px;margin-bottom:12px;" />

						<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Live Webhook Signing Secret (whsec_...)</label>
						<input type="password" name="keystone_stripe_live_webhook_secret" placeholder="<?php echo esc_attr( $mask_key( $live_whsec ) ?: 'whsec_...' ); ?>" style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(212,175,55,0.4);border-radius:6px;padding:8px 10px;font-family:monospace;font-size:12px;" />
					</div>

					<!-- Test Credentials -->
					<div style="background:#0b111e;border:1px solid <?php echo 'test' === $mode ? '#38bdf8' : 'rgba(255,255,255,0.1)'; ?>;border-radius:10px;padding:18px;">
						<div style="color:#38bdf8;font-weight:800;font-size:14px;margin-bottom:12px;">🟡 TEST / SANDBOX CREDENTIALS</div>
						
						<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Test Secret Key (sk_test_...)</label>
						<input type="password" name="keystone_stripe_test_secret_key" placeholder="<?php echo esc_attr( $mask_key( $test_sk ) ?: 'sk_test_...' ); ?>" style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(56,189,248,0.4);border-radius:6px;padding:8px 10px;font-family:monospace;font-size:12px;margin-bottom:12px;" />

						<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Test Publishable Key (pk_test_...)</label>
						<input type="text" name="keystone_stripe_test_publishable_key" value="<?php echo esc_attr( $test_pk ); ?>" placeholder="pk_test_..." style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(56,189,248,0.4);border-radius:6px;padding:8px 10px;font-family:monospace;font-size:12px;margin-bottom:12px;" />

						<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Test Webhook Signing Secret (whsec_...)</label>
						<input type="password" name="keystone_stripe_test_webhook_secret" placeholder="<?php echo esc_attr( $mask_key( $test_whsec ) ?: 'whsec_...' ); ?>" style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(56,189,248,0.4);border-radius:6px;padding:8px 10px;font-family:monospace;font-size:12px;" />
					</div>
				</div>

				<!-- Walkthrough Video IDs (Bug 3 Fix + Hero Intro Slot) -->
				<div style="background:#0b111e;border:1px solid rgba(212,175,55,0.3);border-radius:10px;padding:18px;margin-bottom:22px;">
					<div style="color:#d4af37;font-weight:800;font-size:14px;margin-bottom:12px;">🎬 HERO INTRO &amp; DEDICATED TIER WALKTHROUGH VIDEO IDs (UNLISTED YOUTUBE)</div>
					<div style="margin-bottom:14px;">
						<label style="display:block;color:#38bdf8;font-size:12px;font-weight:700;margin-bottom:4px;">Hero Intro Overview Video ID (/ai-protocols/ Top-Left 3-Tier Overview)</label>
						<input type="text" name="keystone_hero_intro_video_id" value="<?php echo esc_attr( $hero_video_id ); ?>" style="width:100%;max-width:340px;background:#04070d;color:#f8fafc;border:1px solid rgba(56,189,248,0.5);border-radius:6px;padding:8px 10px;font-family:monospace;font-size:12px;" />
					</div>
					<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
						<div>
							<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Tier 01 Video ID ($49.50)</label>
							<input type="text" name="keystone_tier1_video_id" value="<?php echo esc_attr( $t1_video_id ); ?>" style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(212,175,55,0.4);border-radius:6px;padding:8px 10px;font-family:monospace;font-size:12px;" />
						</div>
						<div>
							<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Tier 02 Video ID ($199.00)</label>
							<input type="text" name="keystone_tier2_video_id" value="<?php echo esc_attr( $t2_video_id ); ?>" style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(212,175,55,0.4);border-radius:6px;padding:8px 10px;font-family:monospace;font-size:12px;" />
						</div>
						<div>
							<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Tier 03 Video ID ($800.00)</label>
							<input type="text" name="keystone_tier3_video_id" value="<?php echo esc_attr( $t3_video_id ); ?>" style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(212,175,55,0.4);border-radius:6px;padding:8px 10px;font-family:monospace;font-size:12px;" />
						</div>
					</div>
				</div>

				<!-- Optional Direct Stripe Payment Links -->
				<div style="background:#0b111e;border:1px solid rgba(56,189,248,0.3);border-radius:10px;padding:18px;margin-bottom:24px;">
					<div style="color:#38bdf8;font-weight:800;font-size:14px;margin-bottom:12px;">🔗 OPTIONAL DIRECT STRIPE PAYMENT LINKS (FALLBACK BYPASS)</div>
					<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
						<div>
							<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Tier 01 Stripe Link (buy.stripe.com/...)</label>
							<input type="url" name="keystone_tier1_stripe_link" value="<?php echo esc_attr( $t1_link ); ?>" placeholder="https://buy.stripe.com/..." style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(56,189,248,0.4);border-radius:6px;padding:8px 10px;font-size:12px;" />
						</div>
						<div>
							<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Tier 02 Stripe Link</label>
							<input type="url" name="keystone_tier2_stripe_link" value="<?php echo esc_attr( $t2_link ); ?>" placeholder="https://buy.stripe.com/..." style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(56,189,248,0.4);border-radius:6px;padding:8px 10px;font-size:12px;" />
						</div>
						<div>
							<label style="display:block;color:#cbd5e1;font-size:12px;margin-bottom:4px;">Tier 03 Stripe Link</label>
							<input type="url" name="keystone_tier3_stripe_link" value="<?php echo esc_attr( $t3_link ); ?>" placeholder="https://buy.stripe.com/..." style="width:100%;background:#04070d;color:#f8fafc;border:1px solid rgba(56,189,248,0.4);border-radius:6px;padding:8px 10px;font-size:12px;" />
						</div>
					</div>
				</div>

				<div style="text-align:right;">
					<button type="submit" class="button" style="background:#d4af37;color:#04070d;font-weight:900;font-size:14px;padding:10px 28px;border-radius:9999px;border:none;cursor:pointer;box-shadow:0 4px 14px rgba(212,175,55,0.4);">
						💾 SAVE STRIPE CONFIGURATION
					</button>
				</div>
			</form>
		</div>
	</div>
	<?php
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
			'message' => '🔒 Buyer KR-UID Verification Required. Please enter your verified Buyer KR-UID to use the Custom Setup Generator and Guided Setup Assistant.',
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
 * Guided Setup Assistant Endpoint (`POST /wp-json/keystone/v1/protocol-tutor`).
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
			'message' => '🔒 Buyer KR-UID Verification Required. Please enter your verified Buyer KR-UID to use the Custom Setup Generator and Guided Setup Assistant.',
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
			'message' => 'Please enter or click a setup question for the Guided Setup Assistant.',
		), 400 );
	}

	// Enforce Tier-Based Setup Window (7 Days for Tiers 1-2, 14 Days for Tier 3) & Follow-Up Question Cap (3 / 5 / 8)
	$resolved_tier = (string) ( $uid_verification['tier'] ?? $tier ?: '1' );
	$max_questions = '3' === $resolved_tier ? 8 : ( '2' === $resolved_tier ? 5 : 3 );
	$max_days      = '3' === $resolved_tier ? 14 : 7;
	$usage_map     = get_option( 'keystone_protocol_tutor_usage_v1', array() );
	if ( ! is_array( $usage_map ) ) {
		$usage_map = array();
	}
	if ( 'KR-DEMO-SELF-SERVICE' !== $uid && ! current_user_can( 'manage_options' ) ) {
		$entry = isset( $usage_map[ $uid ] ) && is_array( $usage_map[ $uid ] )
			? $usage_map[ $uid ]
			: array( 'first_ts' => time(), 'count' => 0 );
		$days_elapsed = ( time() - (int) ( $entry['first_ts'] ?? time() ) ) / 86400;
		if ( $days_elapsed > $max_days || (int) ( $entry['count'] ?? 0 ) >= $max_questions ) {
			return new WP_REST_Response( array(
				'success' => false,
				'message' => sprintf(
					'✔ Your Guided Setup Window (%d-Day Setup Window / %d Follow-Up Questions) for %s is complete. Your downloadable PDF Setup Guides remain unlocked in your Buyer Vault.',
					$max_days,
					$max_questions,
					$uid
				),
			), 200 );
		}
		$entry['count']      = (int) ( $entry['count'] ?? 0 ) + 1;
		$usage_map[ $uid ]   = $entry;
		update_option( 'keystone_protocol_tutor_usage_v1', $usage_map, false );
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
	} elseif ( false !== strpos( $q_lower, 'tauri' ) || false !== strpos( $q_lower, 'desktop' ) || false !== strpos( $q_lower, 'exe' ) || false !== strpos( $q_lower, 'app' ) || false !== strpos( $q_lower, '800' ) ) {
		$recommended_pdf_id       = 'PDF-10';
		$recommended_pdf_title    = 'KR_10_Custom_Tauri_Desktop_App_Project_Setup.pdf';
		$recommended_video_module = 'V06 — Module 06: Custom Tauri Desktop App Build, Dashboard Tabs & .EXE Compilation';
		$answer_html              = '
			<div style="color:#f6d365;font-weight:800;font-size:0.86rem;margin-bottom:6px;">🖥️ GUIDED SETUP LESSON // CUSTOM TAURI DESKTOP APP BUILD &amp; .EXE COMPILATION (PDF-10 TO PDF-12)</div>
			<ol style="margin:0 0 10px 0;padding-left:18px;color:#e2e8f0;font-size:0.84rem;line-height:1.6;">
				<li><strong>Step 1 — Initialize Your Tauri Project (PDF-10):</strong> Open your AI Brain workspace in Google Antigravity and use the PDF-10 setup prompt to scaffold your Rust + Tauri + React desktop application.</li>
				<li><strong>Step 2 — Custom Dashboard Tabs &amp; Buttons (PDF-11):</strong> Add your dark-luxury navigation tabs and one-click action buttons wired to your AI Brain folders and custom website.</li>
				<li><strong>Step 3 — Compile Your Standalone Windows .EXE (PDF-12):</strong> Run the production build step in PDF-12 to package your standalone <strong>.exe</strong> desktop command center.</li>
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
			<p style="color:#cbd5e1;font-size:14px;">Here is your custom step-by-step lesson from the <strong>Keystone Guided Setup Assistant</strong>:</p>
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
			'GUIDED SETUP ASSISTANT // CUSTOM LESSON TRANSCRIPT',
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

/**
 * Enforce root .htaccess OpenLiteSpeed RewriteRule blocking direct unauthenticated static scraping
 * of /wp-content/themes/keystone-recomposition-child/assets/vault_packs/* while PHP readfile()
 * (?vault_download=...&uid=KR-UID-...) continues serving verified buyers seamlessly.
 */
function keystone_ensure_vault_packs_htaccess_guard(): void {
	if ( ! defined( 'ABSPATH' ) ) {
		return;
	}
	$ht_path = ABSPATH . '.htaccess';
	if ( ! is_file( $ht_path ) || ! is_writable( $ht_path ) ) {
		return;
	}
	$contents = (string) @file_get_contents( $ht_path );
	if ( false !== strpos( $contents, 'BEGIN KeystoneVaultProtect' ) ) {
		return;
	}
	$block = "# BEGIN KeystoneVaultProtect\n"
		. "<IfModule mod_rewrite.c>\n"
		. "RewriteEngine On\n"
		. "RewriteRule ^wp-content/themes/keystone-recomposition-child/assets/vault_packs/ - [F,L]\n"
		. "</IfModule>\n"
		. "# END KeystoneVaultProtect\n\n";
	@file_put_contents( $ht_path, $block . $contents );
}
if ( function_exists( 'add_action' ) ) {
	add_action( 'init', 'keystone_ensure_vault_packs_htaccess_guard', 1 );
}
