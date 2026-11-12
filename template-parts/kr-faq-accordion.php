<?php
/**
 * Keystone Recomposition v4.0 — Visible Executive FAQ Accordion (Section 8)
 *
 * Synced with inc/seo-schema.php homepage FAQPage (#faq) without emitting duplicate JSON-LD.
 *
 * @package KeystoneRecompositionChild
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$kr_faqs = function_exists( 'keystone_get_homepage_executive_faqs' )
	? keystone_get_homepage_executive_faqs()
	: array(
		array(
			'q' => 'What is Keystone Recomposition and what does the Sovereign v4.0 ecosystem unite?',
			'a' => 'Founded by AI systems architect, music producer, and licensed BC builder Wayne Stevenson (#52603) in Squamish, British Columbia, Keystone Recomposition unites two sovereign disciplines under one command center: (1) zero-SaaS autonomous multi-agent AI engineering, dark-luxury web systems, and native Rust + Tauri desktop workstations, and (2) an official 25-release / 246-track 24-bit sonic catalog engineered in 432Hz, 528Hz, and deep melodic house.',
		),
		array(
			'q' => 'Which AI Protocol Vault tier should I choose: $49.50, $199, or $800?',
			'a' => 'Tier 1 ($49.50 USD) delivers the foundational 4-folder AI Brain architecture, ~20-word Google Flow video prompt workflow, and 4 illustrated PDF setup manuals. Tier 2 ($199 USD) unlocks the 6-Agent Role Suite + Multi-Agent Architecture, 3-source fact verification gates, YouTube Brand Channel defaults, and dark-luxury Rank Math 100/100 web templates. Tier 3 ($800 USD) provides the Complete Runnable Rust + Tauri v2 Desktop Command Center Source Project + 1-Command Windows .EXE Compiler + all 12 PDF manuals + 14-Day Guided Build Support.',
		),
		array(
			'q' => 'Are all 25 releases and 246 tracks cleared for 100% One-Stop Sync Licensing?',
			'a' => 'Yes. Keystone Recomposition holds 100% of both the Master Recording and Publishing rights across all 25 official releases and 246 ISRC-registered tracks. Music supervisors, film studios, game developers, and luxury brands receive rapid one-stop clearance with 24-bit / 96kHz WAV masters and instrumental stems directly from our licensing desk.',
		),
		array(
			'q' => 'Why does Keystone build on Chrome Port 9222 and local hardware instead of cloud SaaS wrappers?',
			'a' => 'Cloud browser wrappers trigger bot gates, leak session context, and charge recurring monthly markups. By attaching directly to authenticated browser sessions over Chrome DevTools Protocol Port 9222 and running local CUDA voice/vector engines, you retain 100% data sovereignty, sub-second responsiveness, and zero recurring SaaS lock-in.',
		),
		array(
			'q' => 'How does Keystone Recomposition connect to Keystone Possibilities Ltd. (#52603)?',
			'a' => 'Both divisions are led by Wayne Stevenson out of Squamish & Whistler, BC. Keystone Possibilities Ltd. is our licensed BC residential construction and BC Hydro ES54 civil contracting firm (BC Housing Builder #52603), delivering custom homes and Bill 44 multiplexes under open-book CCDC 5B contracts—bringing real-world critical-path engineering discipline to every digital system we ship.',
		),
	);
?>

<div id="faq" class="kr-faq-wrap" aria-label="Executive Frequently Asked Questions">
	<span class="kr-v4-kicker"><span class="kr-v4-kicker-dot"></span> EXECUTIVE FAQ &middot; ARCHITECTURE, LICENSING &amp; OWNERSHIP</span>
	<h2 class="kr-v4-h2" style="margin-bottom:14px;">Direct Answers Before You Deploy or License</h2>
	<p class="kr-v4-lead" style="margin-bottom:20px;">Clear specifications on protocol ownership, 24-bit master licensing, and cross-division engineering.</p>

	<div class="kr-faq-list">
		<?php foreach ( $kr_faqs as $f_idx => $faq ) : ?>
			<details class="kr-faq-item" <?php echo 0 === $f_idx ? 'open' : ''; ?>>
				<summary>
					<span><?php echo esc_html( $faq['q'] ); ?></span>
					<span class="kr-faq-plus" aria-hidden="true">+</span>
				</summary>
				<div class="kr-faq-answer">
					<?php echo esc_html( $faq['a'] ); ?>
				</div>
			</details>
		<?php endforeach; ?>
	</div>
</div>
