<?php
/**
 * Template Name: Keystone AI Protocols
 * Description: Dedicated 3-Tier Monetization, Self-Service 6-Tab Course Portal, Visual Brain Setup Diagram, Copy-Paste Antigravity & ~20-Word Google Flow Prompts, 12 Breakdown PDFs, Interactive Setup Intake Form & 24/7 AI Architect Tutor
 *
 * @package Keystone Recomposition Child
 * @since 3.8.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$theme_uri = get_stylesheet_directory_uri();
?>

<style>
.kr-code-pill {
	display: inline-block;
	background: rgba(56, 189, 248, 0.14);
	border: 1px solid rgba(56, 189, 248, 0.45);
	color: #38bdf8;
	font-family: 'JetBrains Mono', monospace;
	font-size: 0.76em;
	font-weight: 700;
	padding: 1px 7px;
	border-radius: 6px;
	letter-spacing: 0.02em;
}
.kr-code-pill-gold {
	display: inline-block;
	background: rgba(212, 175, 55, 0.15);
	border: 1px solid rgba(212, 175, 55, 0.5);
	color: #f6d365;
	font-family: 'JetBrains Mono', monospace;
	font-size: 0.76em;
	font-weight: 700;
	padding: 1px 7px;
	border-radius: 6px;
}
.kr-portal-tab-btn {
	background: rgba(11, 17, 30, 0.92);
	border: 1px solid rgba(56, 189, 248, 0.32);
	color: #cbd5e1;
	font-family: 'Outfit', sans-serif;
	font-size: 0.78rem;
	font-weight: 800;
	padding: 10px 16px;
	border-radius: 9999px;
	cursor: pointer;
	transition: all 0.2s ease;
	white-space: nowrap;
}
.kr-portal-tab-btn:hover {
	border-color: #38bdf8;
	color: #ffffff;
}
.kr-portal-tab-btn.active {
	background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%);
	border-color: #d4af37;
	color: #04070d !important;
	box-shadow: 0 6px 18px rgba(212, 175, 55, 0.35);
}
.kr-portal-tab-pane {
	display: none;
}
.kr-portal-tab-pane.active {
	display: block;
}
.kr-copy-prompt-box {
	background: #04070d;
	border: 1.5px solid rgba(56, 189, 248, 0.45);
	border-radius: 14px;
	padding: 14px 16px;
	margin: 12px 0;
	position: relative;
}
.kr-copy-prompt-box.gold-border {
	border-color: rgba(212, 175, 55, 0.55);
}
.kr-copy-btn {
	background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%);
	color: #04070d !important;
	border: none;
	border-radius: 9999px;
	padding: 6px 14px;
	font-family: 'Outfit', sans-serif;
	font-size: 0.72rem;
	font-weight: 900;
	cursor: pointer;
	letter-spacing: 0.04em;
}
.kr-brain-diagram-grid {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
	gap: 12px;
	margin: 14px 0;
}
.kr-brain-node {
	background: linear-gradient(145deg, #070c18 0%, #04070d 100%);
	border: 1.5px solid #d4af37;
	border-radius: 14px;
	padding: 14px;
	position: relative;
}
.kr-brain-node.cyan-node {
	border-color: #38bdf8;
}
.kr-copy-prompt-box pre,
#krSpecPdfModal pre,
#kr-self-service-portal pre {
	background: #02050a !important;
	color: #f8fafc !important;
	border: 1px solid rgba(56, 189, 248, 0.35) !important;
	border-radius: 10px !important;
	padding: 12px 14px !important;
	margin: 0 !important;
	font-family: 'JetBrains Mono', monospace !important;
	font-size: 0.78rem !important;
	line-height: 1.55 !important;
	white-space: pre-wrap !important;
}
#krSpecPdfModal code {
	background: rgba(56, 189, 248, 0.14) !important;
	color: #38bdf8 !important;
	padding: 1px 5px !important;
	border-radius: 4px !important;
}
.kr-video-first-strip {
	background: linear-gradient(145deg, #070e1c 0%, #04070d 100%);
	border: 1.5px solid #d4af37;
	border-radius: 18px;
	padding: 20px;
	margin-bottom: 20px;
	box-shadow: 0 14px 36px rgba(0, 0, 0, 0.72);
}
.kr-video-first-strip.cyan-accent {
	border-color: #38bdf8;
}
.kr-video-first-grid {
	display: grid;
	grid-template-columns: 1.15fr 1fr;
	gap: 18px;
	align-items: stretch;
	margin-top: 12px;
}
@media (max-width: 920px) {
	.kr-video-first-grid {
		grid-template-columns: 1fr;
	}
}
.kr-chapter-btn {
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 10px;
	width: 100%;
	text-align: left;
	background: rgba(4, 7, 13, 0.92);
	border: 1px solid rgba(56, 189, 248, 0.35);
	border-radius: 12px;
	padding: 9px 12px;
	color: #f8fafc;
	font-family: 'Outfit', sans-serif;
	font-size: 0.78rem;
	font-weight: 700;
	cursor: pointer;
	transition: all 0.18s ease;
}
.kr-chapter-btn:hover {
	border-color: #d4af37;
	background: rgba(212, 175, 55, 0.12);
	color: #ffffff;
}
.kr-chapter-time {
	background: rgba(212, 175, 55, 0.18);
	border: 1px solid #d4af37;
	color: #f6d365;
	font-family: 'JetBrains Mono', monospace;
	font-size: 0.70rem;
	font-weight: 900;
	padding: 2px 8px;
	border-radius: 9999px;
	white-space: nowrap;
	flex-shrink: 0;
}
</style>

<div id="primary" class="content-area primary keystone-cyber-protocols">
	<main id="main" class="site-main">

		<!-- 1. LANDING HERO SECTION WITH TOP-RIGHT EXPRESS CHECKOUT & VAULT UID PORTAL -->
		<section class="cyber-hero-section protocols-hero">
			<div class="ast-container">
				<div class="protocols-hero-split">

					<!-- Left Column: High-Conviction Value Positioning -->
					<div class="protocols-hero-left">
						<div class="cyber-telemetry-pill">
							<span class="telemetry-pulse"></span>
							<span class="telemetry-text">// 2026 AI CREATOR &amp; BUILDER SUITE • COPY-PASTE BRAIN PROMPTS + GOOGLE FLOW VIDEO SYSTEM</span>
						</div>

						<div class="cyber-founder-chip">
							<img src="<?php echo esc_url( $theme_uri . '/assets/images/wayne_avatar.jpg' ); ?>"
								 alt="Wayne Stevenson — Founder &amp; Architect"
								 class="founder-chip-avatar"
								 data-recalc-dims="0" loading="eager" fetchpriority="high" decoding="async"
								 style="width: 48px; height: 48px; min-width: 48px; min-height: 48px; border-radius: 50%; border: 2px solid #d4af37; object-fit: cover; flex-shrink: 0; display: block;" />
							<div class="founder-chip-meta">
								<span class="chip-name">Wayne Stevenson</span>
								<span class="chip-role">Licensed BC Builder #52603 • AI Systems Architect</span>
							</div>
							<span class="chip-verified-badge">✔ VERIFIED</span>
						</div>

						<h1 class="cyber-hero-title">
							Build Your AI Brain, Google Flow Videos &amp; Website<br/>
							<span class="cyan-gradient-text">With Copy-Paste Prompts &amp; Visual Diagrams</span>
						</h1>

						<p class="cyber-hero-subtitle">
							Learn step-by-step how to take the <code class="kr-code-pill-gold">$30/mo</code> Google Antigravity plan, build your 4-folder AI Brain using our <strong>Visual Brain Setup Diagram (<code class="kr-code-pill">PDF-01</code>)</strong>, generate <strong>~20-word (18–24 word) Google Flow video prompts (<code class="kr-code-pill">PDF-02</code>)</strong> to export 1080p MP4s, launch your <strong>YouTube Brand Channel (<code class="kr-code-pill">PDF-03</code>)</strong>, and build your dark-luxury website with <strong>Copy-Paste Website Prompts (<code class="kr-code-pill">PDF-04</code>)</strong>—backed by our <strong>24/7 AI Architect Tutor</strong>.
						</p>

						<!-- 100% Automated 3-Step Delivery Strip -->
						<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px; margin: 0 0 18px 0; width: 100%;">
							<div style="background: rgba(11, 17, 30, 0.9); border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 12px; padding: 10px 12px;">
								<div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; font-weight: 800;">STEP 01 // VISUAL BRAIN SETUP</div>
								<div style="color: #f8fafc; font-family: 'Outfit', sans-serif; font-size: 0.80rem; font-weight: 800; margin-top: 2px;">🧠 $30 Antigravity Brain Diagram</div>
								<div style="color: #94a3b8; font-size: 0.72rem; line-height: 1.35; margin-top: 2px;">Visual diagram + copy-paste prompts that build your 4 AI Brain folders in 60 seconds.</div>
							</div>
							<div style="background: rgba(11, 17, 30, 0.9); border: 1px solid rgba(212, 175, 55, 0.40); border-radius: 12px; padding: 10px 12px;">
								<div style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; font-weight: 800;">STEP 02 // ~20-WORD FLOW PROMPTS</div>
								<div style="color: #f8fafc; font-family: 'Outfit', sans-serif; font-size: 0.80rem; font-weight: 800; margin-top: 2px;">🎬 Google Flow Video &amp; Export</div>
								<div style="color: #94a3b8; font-size: 0.72rem; line-height: 1.35; margin-top: 2px;">Generate 18–24 word scene prompts, paste into Google Flow &amp; export crisp MP4 videos.</div>
							</div>
							<div style="background: rgba(11, 17, 30, 0.9); border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 12px; padding: 10px 12px;">
								<div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.65rem; font-weight: 800;">STEP 03 // WEBSITE &amp; 24/7 AI TUTOR</div>
								<div style="color: #f8fafc; font-family: 'Outfit', sans-serif; font-size: 0.80rem; font-weight: 800; margin-top: 2px;">🌐 Copy-Paste Website &amp; YouTube</div>
								<div style="color: #94a3b8; font-size: 0.72rem; line-height: 1.35; margin-top: 2px;">Copy-paste Website &amp; YouTube Brand Channel prompts + 24/7 AI Teacher &amp; email support.</div>
							</div>
						</div>

						<div class="protocols-quick-nav" style="display: flex; flex-wrap: wrap; gap: 8px;">
							<a href="#kr-self-service-portal" class="quick-nav-pill" style="border-color: #d4af37; color: #f6d365;">🎓 Open 6-Tab Course, 12 PDFs &amp; 24/7 AI Tutor</a>
							<a href="#tier-blueprint" class="quick-nav-pill">01 • $49.50 Brain, Flow Video &amp; Website Blueprint</a>
							<a href="#tier-swarm" class="quick-nav-pill">02 • $199 Multi-Agent &amp; B2B Suite</a>
							<a href="#tier-workstation" class="quick-nav-pill">03 • $800 Full Creator Workstation</a>
						</div>
					</div>

					<!-- Right Column: Top-Right Express Checkout, Automated Delivery & Vault UID Verification Portal -->
					<div class="protocols-hero-right">
						<div class="express-checkout-card">
							<div class="checkout-card-header">
								<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
									<span class="checkout-badge-live">🔒 NEXT COHORT RELEASING SOON • NO CARD REQUIRED TODAY</span>
									<span id="vaultUidStatusBadge" style="background: rgba(56, 189, 248, 0.14); border: 1px solid #38bdf8; color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.64rem; font-weight: 800; padding: 3px 9px; border-radius: 9999px;">
										🔐 UID RESERVATION: ACTIVE
									</span>
								</div>
								<h3 class="checkout-portal-title">Lock In Launch Rate &amp; Unlock Self-Service Portal</h3>
								<p class="checkout-portal-sub">Reserve your launch rate today with zero card required &rarr; Receive your priority <code class="kr-code-pill">KR-UID</code> &amp; instant access to the <strong>Visual Brain Setup Diagram, Copy-Paste Prompts &amp; 24/7 AI Tutor</strong> below.</p>
							</div>

							<div class="checkout-tier-selector">
								<label class="checkout-label">Select Protocol Tier:</label>
								<div class="tier-select-grid">
									<button type="button" class="tier-select-btn active" data-tier="1" data-price="49.50" data-name="Tier 01 — $49.50 AI Brain, Flow Video & Website Blueprint" data-url="/contact/?inquiry=tier1_blueprint#inquiry-form">
										<span class="btn-tier-num">TIER 01</span>
										<span class="btn-tier-name">Brain, Flow &amp; Website</span>
										<span class="btn-tier-price">$49.50</span>
									</button>
									<button type="button" class="tier-select-btn" data-tier="2" data-price="199" data-name="Tier 02 — $199 Multi-Agent Prompt System & B2B Engine" data-url="/contact/?inquiry=tier2_swarm#inquiry-form">
										<span class="btn-tier-num">TIER 02</span>
										<span class="btn-tier-name">Multi-Agent &amp; B2B</span>
										<span class="btn-tier-price">$199</span>
									</button>
									<button type="button" class="tier-select-btn" data-tier="3" data-price="800" data-name="Tier 03 — $800 Full-Stack AI Creator Workstation" data-url="/contact/?inquiry=tier3_workstation#inquiry-form">
										<span class="btn-tier-num">TIER 03</span>
										<span class="btn-tier-name">Creator Workstation</span>
										<span class="btn-tier-price">$800</span>
									</button>
								</div>
							</div>

							<!-- Promo Code Entry -->
							<div class="promo-code-box">
								<label for="promoInput" class="checkout-label">Have a Promo Code?</label>
								<div class="promo-input-row">
									<input type="text" id="promoInput" placeholder="Enter code (e.g. BUILDER10)" class="promo-input" />
									<button type="button" id="applyPromoBtn" class="btn-promo-apply">APPLY</button>
								</div>
								<div id="promoFeedback" class="promo-feedback-msg" style="display:none;"></div>
							</div>

							<!-- Dynamic Express Reserve / Buy Button -->
							<div class="checkout-cta-wrap">
								<button type="button" id="portalExpressBuyBtn" class="btn-cyan-express-buy" style="width: 100%; border: none; cursor: pointer;">
									⚡ LOCK IN LAUNCH RATE &amp; RESERVE ACCESS ($49.50 USD) →
								</button>
								<div class="checkout-payment-methods">
									<span>🔒 $0 Charged Today</span> • <span>🔐 Priority <code class="kr-code-pill">KR-UID</code> Saved</span> • <span>✉️ Custom Prompts Emailed</span>
								</div>
								<div class="checkout-fiduciary-note">
									🏛️ Direct Release by <strong>Keystone Possibilities Ltd.</strong> • Protected by Priority UID Lock
								</div>
							</div>

							<!-- Vault Menu User UID Verification Gate -->
							<div style="margin-top: 14px; padding-top: 12px; border-top: 1px solid rgba(56, 189, 248, 0.22);">
								<label for="existingVaultUidInput" style="display: block; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 800; color: #f6d365; letter-spacing: 0.05em; margin-bottom: 6px;">
									🔐 ALREADY RESERVED? CHECK YOUR PRIORITY UID OR LAUNCH PREVIEW:
								</label>
								<div style="display: flex; gap: 6px;">
									<input type="text" id="existingVaultUidInput" placeholder="e.g. KR-UID-XXXXXXXXXXXX" style="flex: 1; background: rgba(4, 7, 13, 0.9); border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 9999px; color: #f8fafc; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; padding: 6px 12px; outline: none;" />
									<button type="button" id="verifyVaultUidBtn" style="background: rgba(56, 189, 248, 0.18); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 6px 12px; font-family: 'Outfit', sans-serif; font-size: 0.70rem; font-weight: 800; cursor: pointer; white-space: nowrap;">
										CHECK UID
									</button>
								</div>
								<div id="vaultUidVerifyFeedback" style="display: none; margin-top: 8px; font-size: 0.74rem; line-height: 1.4; padding: 8px 10px; border-radius: 10px; background: rgba(8, 14, 26, 0.95); border: 1px solid rgba(56, 189, 248, 0.35);"></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>

		<!-- 1B. SELF-SERVICE 6-TAB INTERACTIVE COURSE, VISUAL BRAIN DIAGRAM, 12 BREAKDOWN PDFs, SETUP FORM & 24/7 AI TUTOR PORTAL -->
		<section id="kr-self-service-portal" style="padding: 36px 0 48px 0; background: linear-gradient(180deg, #04070d 0%, #070d19 100%); border-top: 1px solid rgba(212, 175, 55, 0.35); border-bottom: 1px solid rgba(56, 189, 248, 0.28);">
			<div class="ast-container">
				<div style="background: rgba(8, 13, 24, 0.96); border: 1.5px solid #d4af37; border-radius: 22px; padding: 28px 26px; box-shadow: 0 20px 55px rgba(0, 0, 0, 0.85);">

					<!-- Portal Header Strip -->
					<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 18px; padding-bottom: 16px; border-bottom: 1px solid rgba(212, 175, 55, 0.28);">
						<div>
							<div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(212, 175, 55, 0.14); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 4px 12px; border-radius: 9999px; margin-bottom: 8px;">
								🎓 INTERACTIVE SELF-SERVICE COURSE PORTAL • VISUAL BRAIN DIAGRAM + COPY-PASTE PROMPTS + 24/7 AI TEACHER
							</div>
							<h2 style="font-family: 'Outfit', sans-serif; font-size: 1.65rem; font-weight: 900; color: #ffffff; margin: 0;">
								The $49.50 AI Brain, ~20-Word Google Flow Video &amp; Website Implementation Portal
							</h2>
							<p style="color: #cbd5e1; font-size: 0.88rem; margin: 6px 0 0 0; line-height: 1.55;">
								Everything is laid out step-by-step below so you never get stuck: follow the <strong>Visual Brain Setup Diagram</strong>, copy-paste the exact prompts into your <code class="kr-code-pill-gold">$30/mo</code> Antigravity workspace and <strong>Google Flow</strong>, download all <strong>12 Breakdown Spec PDFs (<code class="kr-code-pill">%PDF-1.4</code>)</strong>, or ask the <strong>24/7 AI Architect Tutor</strong> any question.
							</p>
						</div>
						<div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
							<button type="button" id="launchDemoPortalBtn" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 10px 18px; font-family: 'Outfit', sans-serif; font-size: 0.78rem; font-weight: 900; cursor: pointer;">
								🔓 UNLOCK FULL SELF-SERVICE PREVIEW
							</button>
							<a href="?vault_download=tier1_blueprint_pack&amp;uid=KR-DEMO-SELF-SERVICE" id="portalQuickZipBtn" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 10px 16px; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 800; text-decoration: none;">
								📦 DOWNLOAD COPY-PASTE PROMPT PACK (.ZIP)
							</a>
						</div>
					</div>

					<!-- 6-Tab Navigation Bar -->
					<div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 22px;" role="tablist">
						<button type="button" class="kr-portal-tab-btn active" data-portal-tab="tab1">
							🧠 Tab 1: $30 Antigravity Brain Diagram &amp; Custom Setup Form
						</button>
						<button type="button" class="kr-portal-tab-btn" data-portal-tab="tab2">
							🎬 Tab 2: ~20-Word Google Flow Video Prompts &amp; Export
						</button>
						<button type="button" class="kr-portal-tab-btn" data-portal-tab="tab3">
							🌐 Tab 3: Copy-Paste Website &amp; YouTube Brand Channel
						</button>
						<button type="button" class="kr-portal-tab-btn" data-portal-tab="tab4">
							🐝 Tab 4: Multi-Agent Role Prompts &amp; B2B Outreach (Tier 02)
						</button>
						<button type="button" class="kr-portal-tab-btn" data-portal-tab="tab5">
							🏛️ Tab 5: DaVinci 2-Track Edit &amp; Creator Workstation (Tier 03)
						</button>
						<button type="button" class="kr-portal-tab-btn" data-portal-tab="tab6">
							🤖 Tab 6: 24/7 AI Architect Tutor &amp; All 12 Breakdown PDFs
						</button>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 1: $30 ANTIGRAVITY BRAIN SETUP DIAGRAM + COPY-PASTE PROMPT + FORM     -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab1" class="kr-portal-tab-pane active">

						<!-- STEP 1: VIDEO-FIRST WALKTHROUGH & TIMESTAMP CHAPTER STRIP (MODULE V01 — 4M 00S) -->
						<div class="kr-video-first-strip">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
								<div>
									<div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(212, 175, 55, 0.16); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; padding: 4px 12px; border-radius: 9999px; margin-bottom: 6px;">
										🎬 STEP 1: WATCH VIDEO WALKTHROUGH FIRST &bull; MODULE V01 (4M 00S RUNTIME)
									</div>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.28rem; font-weight: 900; margin: 0;">
										Module V01 Walkthrough: Building Your 4-Folder AI Brain on the $30/mo Antigravity Plan
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krDownloadStarterAgentsMd()" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 8px 16px; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 900; cursor: pointer; box-shadow: 0 6px 18px rgba(212, 175, 55, 0.35);">
										⬇ Download AGENTS.md Starter File
									</button>
									<button type="button" onclick="krOpenSpecModal('PDF-01')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 8px 14px; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 800; cursor: pointer;">
										📄 Open Companion PDF-01
									</button>
								</div>
							</div>

							<div class="kr-video-first-grid">
								<!-- Left Column: Embedded 16:9 YouTube Player (youtube-nocookie.com) -->
								<div style="background: #02050a; border: 1.5px solid rgba(56, 189, 248, 0.45); border-radius: 14px; overflow: hidden; display: flex; flex-direction: column;">
									<div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; background: #04070d;">
										<iframe id="krVideoPlayerV01"
												src="https://www.youtube-nocookie.com/embed/JCgZ5SsN_bc?rel=0"
												title="Module V01 — $30 Antigravity Brain Setup & 4-Folder Architecture Walkthrough (4m 00s)"
												style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
												allowfullscreen loading="lazy"></iframe>
									</div>
									<div style="padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; background: rgba(8, 14, 26, 0.96); border-top: 1px solid rgba(56, 189, 248, 0.25);">
										<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">▶ MODULE V01 // 4M 00S STEP-BY-STEP VIDEO</span>
										<span style="color: #cbd5e1; font-size: 0.74rem;">Click any chapter on the right to jump to that timestamp &rarr;</span>
									</div>
								</div>

								<!-- Right Column: Clickable Video Chapter Breakdown & Runtime Checklist + 1-Click .MD Starter File Download -->
								<div style="background: rgba(8, 13, 24, 0.95); border: 1px solid rgba(212, 175, 55, 0.42); border-radius: 14px; padding: 14px 16px; display: flex; flex-direction: column; justify-content: space-between; gap: 10px;">
									<div>
										<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 8px;">
											<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 900;">⏱️ VIDEO CHAPTER BREAKDOWN &amp; RUNTIME CHECKLIST</span>
											<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800;">TOTAL: 4M 00S</span>
										</div>
										<div style="display: flex; flex-direction: column; gap: 7px;">
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV01', 'JCgZ5SsN_bc', 0)">
												<span><strong>Ch 01:</strong> $30/mo Antigravity Plan &amp; Opening <code class="kr-code-pill">My_AI_Brain</code></span>
												<span class="kr-chapter-time">▶ 00:00</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV01', 'JCgZ5SsN_bc', 65)">
												<span><strong>Ch 02:</strong> Pasting Prompt #1 to Build All 4 Brain Folders</span>
												<span class="kr-chapter-time">▶ 01:05</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV01', 'JCgZ5SsN_bc', 135)">
												<span><strong>Ch 03:</strong> Dropping <code class="kr-code-pill">AGENTS.md</code> Inside <code class="kr-code-pill">01_Brain_Rules/</code></span>
												<span class="kr-chapter-time">▶ 02:15</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV01', 'JCgZ5SsN_bc', 195)">
												<span><strong>Ch 04:</strong> Verifying 2M-Token Persistent Brand Memory</span>
												<span class="kr-chapter-time">▶ 03:15</span>
											</button>
										</div>
									</div>

									<!-- Tool A: 1-Click Starter AGENTS.md Download Box -->
									<div style="background: rgba(4, 7, 13, 0.95); border: 1px solid #d4af37; border-radius: 12px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
										<div>
											<div style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 900;">TOOL A // READY-TO-DROP STARTER FILE</div>
											<div style="color: #e2e8f0; font-size: 0.76rem; font-weight: 700;">Pre-configured for <code class="kr-code-pill">01_Brain_Rules/AGENTS.md</code></div>
										</div>
										<button type="button" class="kr-copy-btn" onclick="krDownloadStarterAgentsMd()">
											⬇ Download AGENTS.md Starter File
										</button>
									</div>
								</div>
							</div>
						</div>

						<!-- STEP 2: VISUAL BRAIN SETUP DIAGRAM (PDF-01) + COPY-PASTE PROMPT #1 -->
						<div style="background: #04070d; border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 18px; padding: 20px; margin-bottom: 20px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 10px;">
								<div>
									<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">STEP 2 &bull; MODULE V01 &bull; SPEC SHEET PDF-01 // VISUAL BRAIN ARCHITECTURE</span>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 900; margin: 4px 0 0 0;">
										Visual Brain Setup Diagram: How Your $30/mo Antigravity Brain Works
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krDownloadStarterAgentsMd()" style="background: rgba(212, 175, 55, 0.16); border: 1px solid #d4af37; color: #f6d365; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
										⬇ Download AGENTS.md Starter File
									</button>
									<button type="button" onclick="krOpenSpecModal('PDF-01')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
										👁️ View PDF-01 On Screen
									</button>
									<button type="button" onclick="krDownloadRealPdf('PDF-01')" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 900; cursor: pointer;">
										⬇ Download PDF-01 (%PDF-1.4)
									</button>
								</div>
							</div>

							<!-- HIGH-CONTRAST 4-STEP VISUAL BRAIN SETUP FLOWCHART DIAGRAM -->
							<div class="kr-brain-diagram-grid">
								<div class="kr-brain-node">
									<div style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900;">STEP 1 // $30/MO ANTIGRAVITY</div>
									<div style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.92rem; font-weight: 800; margin: 4px 0;">Get $30 Antigravity Plan &amp; Open Folder</div>
									<div style="color: #cbd5e1; font-size: 0.76rem; line-height: 1.45;">Install Google Antigravity, subscribe to the <code class="kr-code-pill-gold">$30/mo</code> plan, and open a new empty folder on your computer named <code class="kr-code-pill">My_AI_Brain</code>.</div>
								</div>
								<div class="kr-brain-node cyan-node">
									<div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900;">STEP 2 // PASTE PROMPT #1</div>
									<div style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.92rem; font-weight: 800; margin: 4px 0;">Creates Your 4 AI Brain Folders</div>
									<div style="color: #cbd5e1; font-size: 0.76rem; line-height: 1.45;">
										Antigravity automatically builds:<br/>
										• <code class="kr-code-pill">01_Brain_Rules/AGENTS.md</code><br/>
										• <code class="kr-code-pill">02_Video_Prompts/</code><br/>
										• <code class="kr-code-pill">03_Website_Builder/</code><br/>
										• <code class="kr-code-pill">04_YouTube_Channel/</code>
									</div>
								</div>
								<div class="kr-brain-node">
									<div style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900;">STEP 3 // ~20-WORD FLOW CLIPS</div>
									<div style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.92rem; font-weight: 800; margin: 4px 0;">Generate ~20-Word Prompts &amp; Export MP4s</div>
									<div style="color: #cbd5e1; font-size: 0.76rem; line-height: 1.45;">Antigravity writes 18–24 word scene prompts. Paste them into <strong>Google Flow</strong> with your reference photos and click <strong>Export MP4</strong>.</div>
								</div>
								<div class="kr-brain-node cyan-node">
									<div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900;">STEP 4 // WEBSITE &amp; YOUTUBE</div>
									<div style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.92rem; font-weight: 800; margin: 4px 0;">Paste Website &amp; YouTube Prompts</div>
									<div style="color: #cbd5e1; font-size: 0.76rem; line-height: 1.45;">Paste the Website Builder Prompt &amp; YouTube Brand Channel Prompt to launch your homepage, SEO articles, and 480-char tags.</div>
								</div>
							</div>

							<!-- READY-TO-COPY BRAIN SETUP PROMPT #1 -->
							<div class="kr-copy-prompt-box gold-border">
								<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
									<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">📋 COPY-PASTE PROMPT #1: BUILD YOUR 4-FOLDER AI BRAIN IN ANTIGRAVITY ($30 PLAN)</span>
									<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('krPromptBrainMaster', this)">📋 COPY BRAIN SETUP PROMPT</button>
								</div>
								<pre id="krPromptBrainMaster" style="margin: 0; white-space: pre-wrap; word-break: break-word; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc; line-height: 1.55;">You are my lead AI Systems Architect inside Google Antigravity. Initialize my 4-folder AI Brain workspace right now:
1. Create folder 01_Brain_Rules/ and write AGENTS.md storing my brand name, target audience, core offer, and website domain so you remember my rules in every chat.
2. Create folder 02_Video_Prompts/ with a master prompt generator that writes 10-second Google Flow video scene prompts strictly between 18 and 24 words (~20 words per clip).
3. Create folder 03_Website_Builder/ with dark-luxury design tokens (#04070d Obsidian background, #d4af37 Sovereign Gold pill buttons, #38bdf8 Baby Blue accents) for my homepage and SEO articles.
4. Create folder 04_YouTube_Channel/ with my YouTube Brand Channel Upload Defaults template, chapter timestamps, and a calibrated 480-character SEO tag stack.</pre>
							</div>
						</div>

						<!-- STEP 3: INTERACTIVE BRAIN, YOUTUBE CHANNEL & WEBSITE SETUP INTAKE FORM -->
						<div style="background: linear-gradient(145deg, #0b1324 0%, #050911 100%); border: 1.5px solid #38bdf8; border-radius: 18px; padding: 22px;">
							<div style="display: inline-block; background: rgba(56, 189, 248, 0.14); border: 1px solid #38bdf8; color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 3px 10px; border-radius: 9999px; margin-bottom: 8px;">
								⚡ STEP 3: INTERACTIVE CUSTOM PROMPT GENERATOR + EMAIL SYNC
							</div>
							<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.22rem; font-weight: 900; margin: 0 0 6px 0;">
								Generate Your Custom Antigravity Brain, ~20-Word Google Flow &amp; Website Prompts
							</h3>
							<p style="color: #cbd5e1; font-size: 0.84rem; margin: 0 0 16px 0; line-height: 1.5;">
								Enter your YouTube channel name, niche, and website domain below. The portal will immediately generate your tailored <strong>Brain Setup Prompt</strong>, <strong>3 custom ~20-word Google Flow video prompts</strong>, <strong>Website Builder prompt</strong>, and <strong>480-character YouTube tag stack</strong> on screen—and email a copy to your inbox!
							</p>

							<form id="krChannelWebsiteSetupForm" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 12px;">
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #f6d365; margin-bottom: 4px;">YOUR NAME *</label>
									<input type="text" id="setupBuyerName" required placeholder="John Builder" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #f6d365; margin-bottom: 4px;">YOUR EMAIL (TO RECEIVE COPY) *</label>
									<input type="email" id="setupBuyerEmail" required placeholder="you@yourdomain.com" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #38bdf8; margin-bottom: 4px;">YOUTUBE CHANNEL NAME *</label>
									<input type="text" id="setupChannelName" required placeholder="e.g. Apex Builder AI" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #38bdf8; margin-bottom: 4px;">CHANNEL NICHE / TOPIC *</label>
									<input type="text" id="setupChannelNiche" required placeholder="e.g. Custom Homes & AI Systems" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #f6d365; margin-bottom: 4px;">WEBSITE DOMAIN *</label>
									<input type="text" id="setupWebsiteDomain" required placeholder="e.g. apexbuilder.com" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div>
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #cbd5e1; margin-bottom: 4px;">YOUTUBE BRAND ACCOUNT STATUS</label>
									<select id="setupBrandStatus" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;">
										<option value="Need to create Brand Account">Need to set up YouTube Brand Account</option>
										<option value="Brand Account active">YouTube Brand Account already active</option>
										<option value="Launching both Website + Channel">Launching both Website + YouTube Channel</option>
									</select>
								</div>
								<div style="grid-column: 1 / -1;">
									<label style="display: block; font-size: 0.72rem; font-weight: 800; color: #cbd5e1; margin-bottom: 4px;">WHAT DO YOU WANT TO BUILD FIRST? (OPTIONAL)</label>
									<input type="text" id="setupRoadblock" placeholder="e.g. Set up my 4 Brain folders, generate my first three 20-word Google Flow clips, and build my homepage..." style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; padding: 9px 12px; font-size: 0.82rem; box-sizing: border-box;" />
								</div>
								<div style="grid-column: 1 / -1;">
									<button type="submit" id="setupFormSubmitBtn" style="width: 100%; background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; font-family: 'Outfit', sans-serif; font-size: 0.90rem; font-weight: 900; padding: 12px 20px; border-radius: 9999px; border: none; cursor: pointer; box-shadow: 0 8px 24px rgba(212, 175, 55, 0.35);">
										⚡ GENERATE MY CUSTOM BRAIN, ~20-WORD GOOGLE FLOW &amp; WEBSITE PROMPTS →
									</button>
								</div>
							</form>

							<!-- Custom Setup Output Container (Includes Tool C: 1-Click Download All 4 Custom Setup Prompts .TXT) -->
							<div id="krCustomSetupResultBox" style="display: none; margin-top: 18px; padding-top: 16px; border-top: 1px solid rgba(212, 175, 55, 0.4);">
								<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 14px; background: rgba(4, 7, 13, 0.92); border: 1.5px solid #d4af37; border-radius: 14px; padding: 12px 16px;">
									<div>
										<div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900;">TOOL C // 1-CLICK PERSONALIZED CHEAT SHEET DOWNLOAD</div>
										<div id="krCustomSetupStatusMsg" style="color: #f6d365; font-weight: 800; font-size: 0.86rem; margin-top: 2px;"></div>
									</div>
									<div style="display: flex; gap: 8px; flex-wrap: wrap;">
										<button type="button" class="kr-copy-btn" onclick="krDownloadCustomSetupTxt()" style="padding: 9px 16px; font-size: 0.78rem; box-shadow: 0 6px 18px rgba(212, 175, 55, 0.35);">
											⬇ Download All 4 Custom Setup Prompts (.TXT)
										</button>
										<button type="button" onclick="krDownloadStarterAgentsMd()" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 8px 14px; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 800; cursor: pointer;">
											⬇ Download Custom AGENTS.md
										</button>
									</div>
								</div>

								<div class="kr-copy-prompt-box gold-border">
									<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
										<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">🧠 1. YOUR CUSTOM ANTIGRAVITY BRAIN SETUP PROMPT ($30 PLAN)</span>
										<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('outCustomBrainPrompt', this)">📋 COPY PROMPT</button>
									</div>
									<pre id="outCustomBrainPrompt" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc;"></pre>
								</div>

								<div class="kr-copy-prompt-box">
									<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
										<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">🎬 2. YOUR 3 CUSTOM ~20-WORD GOOGLE FLOW VIDEO SCENE PROMPTS</span>
										<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('outCustomFlowPrompts', this)">📋 COPY ALL 3 FLOW PROMPTS</button>
									</div>
									<pre id="outCustomFlowPrompts" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc;"></pre>
								</div>

								<div class="kr-copy-prompt-box gold-border">
									<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
										<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">🌐 3. YOUR CUSTOM ANTIGRAVITY WEBSITE BUILDER PROMPT</span>
										<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('outCustomWebsitePrompt', this)">📋 COPY WEBSITE PROMPT</button>
									</div>
									<pre id="outCustomWebsitePrompt" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc;"></pre>
								</div>

								<div class="kr-copy-prompt-box">
									<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
										<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">📺 4. YOUR YOUTUBE UPLOAD DEFAULTS &amp; 480-CHARACTER TAG STACK</span>
										<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('outCustomYoutubeTags', this)">📋 COPY TAGS &amp; DEFAULTS</button>
									</div>
									<pre id="outCustomYoutubeTags" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc;"></pre>
								</div>
							</div>
						</div>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 2: ~20-WORD GOOGLE FLOW VIDEO PROMPTS & MP4 EXPORT (PDF-02)           -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab2" class="kr-portal-tab-pane">

						<!-- STEP 1: VIDEO-FIRST WALKTHROUGH & TIMESTAMP CHAPTER STRIP (MODULE V02 — 5M 00S) -->
						<div class="kr-video-first-strip cyan-accent">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
								<div>
									<div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; padding: 4px 12px; border-radius: 9999px; margin-bottom: 6px;">
										🎬 STEP 1: WATCH VIDEO WALKTHROUGH FIRST &bull; MODULE V02 (5M 00S RUNTIME)
									</div>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.28rem; font-weight: 900; margin: 0;">
										Module V02 Walkthrough: Writing ~20-Word (18–24 Word) Google Flow Prompts &amp; Exporting 1080p MP4s
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krDownloadStarterFlowMd()" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 8px 16px; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 900; cursor: pointer;">
										⬇ Download 02_Video_Prompts.md Starter
									</button>
									<button type="button" onclick="krOpenSpecModal('PDF-02')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 8px 14px; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 800; cursor: pointer;">
										📄 Open Companion PDF-02
									</button>
								</div>
							</div>

							<div class="kr-video-first-grid">
								<!-- Left Column: Embedded 16:9 YouTube Player (youtube-nocookie.com) -->
								<div style="background: #02050a; border: 1.5px solid rgba(56, 189, 248, 0.45); border-radius: 14px; overflow: hidden; display: flex; flex-direction: column;">
									<div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; background: #04070d;">
										<iframe id="krVideoPlayerV02"
												src="https://www.youtube-nocookie.com/embed/k3fArbXUzQM?rel=0"
												title="Module V02 — ~20-Word Google Flow Video Prompt Formula & 1080p MP4 Export Walkthrough (5m 00s)"
												style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
												allowfullscreen loading="lazy"></iframe>
									</div>
									<div style="padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; background: rgba(8, 14, 26, 0.96); border-top: 1px solid rgba(56, 189, 248, 0.25);">
										<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">▶ MODULE V02 // 5M 00S STEP-BY-STEP VIDEO</span>
										<span style="color: #cbd5e1; font-size: 0.74rem;">Click any chapter on the right to jump to that timestamp &rarr;</span>
									</div>
								</div>

								<!-- Right Column: Clickable Video Chapter Breakdown & Runtime Checklist + 1-Click .MD Starter File Download -->
								<div style="background: rgba(8, 13, 24, 0.95); border: 1px solid rgba(56, 189, 248, 0.42); border-radius: 14px; padding: 14px 16px; display: flex; flex-direction: column; justify-content: space-between; gap: 10px;">
									<div>
										<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 8px;">
											<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 900;">⏱️ VIDEO CHAPTER BREAKDOWN &amp; RUNTIME CHECKLIST</span>
											<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800;">TOTAL: 5M 00S</span>
										</div>
										<div style="display: flex; flex-direction: column; gap: 7px;">
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV02', 'k3fArbXUzQM', 0)">
												<span><strong>Ch 01:</strong> Uploading 3 Reference Chips (Character, Outfit, Studio)</span>
												<span class="kr-chapter-time">▶ 00:00</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV02', 'k3fArbXUzQM', 80)">
												<span><strong>Ch 02:</strong> Why 18–24 Words (~20 Words) Prevents Audio Cutoffs</span>
												<span class="kr-chapter-time">▶ 01:20</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV02', 'k3fArbXUzQM', 165)">
												<span><strong>Ch 03:</strong> Generating 6 Sequential 10s Clips in Antigravity</span>
												<span class="kr-chapter-time">▶ 02:45</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV02', 'k3fArbXUzQM', 240)">
												<span><strong>Ch 04:</strong> Exporting 1080p MP4s &amp; Numbering Clips Cleanly</span>
												<span class="kr-chapter-time">▶ 04:00</span>
											</button>
										</div>
									</div>

									<div style="background: rgba(4, 7, 13, 0.95); border: 1px solid #38bdf8; border-radius: 12px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
										<div>
											<div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 900;">STARTER TEMPLATE // 02_VIDEO_PROMPTS</div>
											<div style="color: #e2e8f0; font-size: 0.76rem; font-weight: 700;">Ready-to-drop <code class="kr-code-pill">02_Video_Prompts.md</code> template</div>
										</div>
										<button type="button" class="kr-copy-btn" onclick="krDownloadStarterFlowMd()">
											⬇ Download .MD Starter File
										</button>
									</div>
								</div>
							</div>
						</div>

						<!-- STEP 2: PDF-02 SPEC SHEET & COPY-PASTE PROMPT #2 -->
						<div style="background: #04070d; border: 1px solid rgba(56, 189, 248, 0.45); border-radius: 18px; padding: 20px; margin-bottom: 20px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
								<div>
									<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">STEP 2 &bull; MODULE V02 &bull; SPEC SHEET PDF-02 // ~20-WORD GOOGLE FLOW VIDEO FORMULA</span>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 900; margin: 4px 0 0 0;">
										How to Generate ~20-Word Prompts in Antigravity, Paste into Google Flow &amp; Export MP4s
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krOpenSpecModal('PDF-02')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
										👁️ View PDF-02 On Screen
									</button>
									<button type="button" onclick="krDownloadRealPdf('PDF-02')" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 7px 14px; font-family: 'Outfit', sans-serif; font-size: 0.74rem; font-weight: 900; cursor: pointer;">
										⬇ Download PDF-02 (%PDF-1.4)
									</button>
								</div>
							</div>

							<p style="color: #cbd5e1; font-size: 0.86rem; line-height: 1.6; margin: 0 0 14px 0;">
								When creating 10-second AI video clips in <strong>Google Flow</strong>, overloaded paragraphs confuse the video model. The sweet spot is <strong>~20 words (18 to 24 words) per 10-second scene prompt</strong> paired with <strong>3 Reference Images</strong> (1 Headshot photo, 1 Outfit photo, 1 Studio Room photo).
							</p>

							<div class="kr-copy-prompt-box">
								<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
									<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">📋 COPY-PASTE PROMPT #2: ~20-WORD GOOGLE FLOW SCENE GENERATOR (PASTE IN ANTIGRAVITY)</span>
									<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('krPromptFlowGenerator', this)">📋 COPY ~20-WORD GENERATOR PROMPT</button>
								</div>
								<pre id="krPromptFlowGenerator" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc; line-height: 1.55;">Write 6 sequential 10-second Google Flow video scene prompts for my episode topic.
Rules for every scene prompt:
1. Keep the visual prompt strictly between 18 and 24 words (~20 words total).
2. Describe the presenter speaking naturally to camera with grounded two-handed gestures in a warm acoustic oak studio on a 35mm cinema lens.
3. Include a separate 22-to-26 word spoken voiceover line for each 10-second clip so pacing never rushes.
4. After generating the 6 prompts, remind me to attach my 3 reference images (Character, Outfit, Studio Background) in Google Flow and click Export MP4 (1080p).</pre>
							</div>
						</div>

						<!-- STEP 3 (TOOL B): INTERACTIVE ~20-WORD (18-24 WORD) GOOGLE FLOW PACING CHECKER -->
						<div style="background: linear-gradient(145deg, #0b1324 0%, #050911 100%); border: 1.5px solid #d4af37; border-radius: 18px; padding: 20px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 10px;">
								<div>
									<div style="display: inline-block; background: rgba(212, 175, 55, 0.16); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; padding: 3px 10px; border-radius: 9999px; margin-bottom: 6px;">
										🎯 TOOL B // INTERACTIVE ~20-WORD (18–24 WORD) GOOGLE FLOW PACING CHECKER
									</div>
									<h4 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.15rem; font-weight: 900; margin: 0;">
										Test Your 10-Second Google Flow Prompt or Spoken Line Before Generating
									</h4>
								</div>
								<div id="krFlowWordCountBadge" style="background: rgba(212, 175, 55, 0.18); border: 1.5px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; font-weight: 900; padding: 6px 14px; border-radius: 9999px;">
									21 words — Perfect 18–24 Word Google Flow Sweet Spot
								</div>
							</div>
							<p style="color: #cbd5e1; font-size: 0.82rem; margin: 0 0 10px 0; line-height: 1.5;">
								Paste or type any 10-second scene prompt or spoken voiceover line below. Keep it inside the <strong>18–24 word sweet spot (~20 words)</strong> so your audio and lip-sync never rush or cut off at the end of a 10-second Google Flow clip.
							</p>
							<textarea id="krFlowWordCountInput" rows="3" style="width: 100%; background: #04070d; border: 1.5px solid rgba(56, 189, 248, 0.45); border-radius: 12px; color: #f8fafc; font-family: 'JetBrains Mono', monospace; font-size: 0.82rem; padding: 12px 14px; box-sizing: border-box; line-height: 1.5;" placeholder="Paste or type your 10-second Google Flow prompt or spoken line here...">Founder speaking warmly to camera with grounded two-handed builder gestures inside a dark acoustic oak studio on a 35mm cinema lens.</textarea>
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; margin-top: 10px;">
								<span id="krFlowWordCountHint" style="color: #38bdf8; font-size: 0.76rem; font-weight: 700;">
									✔ Ready for Google Flow Box 2: Attach your 3 Reference Chips (Character, Outfit, Studio) + Paste Prompt.
								</span>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krLoadSampleFlowPrompt()" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 6px 12px; font-family: 'Outfit', sans-serif; font-size: 0.72rem; font-weight: 800; cursor: pointer;">
										🔄 Load 21-Word Sample
									</button>
									<button type="button" class="kr-copy-btn" onclick="krCopyFlowCheckedPrompt(this)">
										📋 Copy Verified ~20-Word Prompt
									</button>
								</div>
							</div>
						</div>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 3: COPY-PASTE WEBSITE BUILDER & YOUTUBE BRAND CHANNEL (PDF-03..05)    -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab3" class="kr-portal-tab-pane">

						<!-- STEP 1: VIDEO-FIRST WALKTHROUGH & TIMESTAMP CHAPTER STRIP (MODULE V03 — 4M 30S) -->
						<div class="kr-video-first-strip">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
								<div>
									<div style="display: inline-flex; align-items: center; gap: 8px; background: rgba(212, 175, 55, 0.16); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 900; padding: 4px 12px; border-radius: 9999px; margin-bottom: 6px;">
										🎬 STEP 1: WATCH VIDEO WALKTHROUGH FIRST &bull; MODULE V03 (4M 30S RUNTIME)
									</div>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.28rem; font-weight: 900; margin: 0;">
										Module V03 Walkthrough: Launching Your YouTube Brand Channel &amp; #04070d Dark-Luxury Website
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krDownloadStarterWebsiteMd()" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 8px 16px; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 900; cursor: pointer;">
										⬇ Download Website &amp; YouTube .MD Starter
									</button>
									<button type="button" onclick="krOpenSpecModal('PDF-04')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 8px 14px; font-family: 'Outfit', sans-serif; font-size: 0.75rem; font-weight: 800; cursor: pointer;">
										📄 Open Companion PDF-04
									</button>
								</div>
							</div>

							<div class="kr-video-first-grid">
								<!-- Left Column: Embedded 16:9 YouTube Player (youtube-nocookie.com) -->
								<div style="background: #02050a; border: 1.5px solid rgba(56, 189, 248, 0.45); border-radius: 14px; overflow: hidden; display: flex; flex-direction: column;">
									<div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; background: #04070d;">
										<iframe id="krVideoPlayerV03"
												src="https://www.youtube-nocookie.com/embed/uMkZvTbqF2U?rel=0"
												title="Module V03 — Copy-Paste Website Builder & YouTube Brand Channel Walkthrough (4m 30s)"
												style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
												allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
												allowfullscreen loading="lazy"></iframe>
									</div>
									<div style="padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; background: rgba(8, 14, 26, 0.96); border-top: 1px solid rgba(56, 189, 248, 0.25);">
										<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800;">▶ MODULE V03 // 4M 30S STEP-BY-STEP VIDEO</span>
										<span style="color: #cbd5e1; font-size: 0.74rem;">Click any chapter on the right to jump to that timestamp &rarr;</span>
									</div>
								</div>

								<!-- Right Column: Clickable Video Chapter Breakdown & Runtime Checklist + 1-Click .MD Starter File Download -->
								<div style="background: rgba(8, 13, 24, 0.95); border: 1px solid rgba(212, 175, 55, 0.42); border-radius: 14px; padding: 14px 16px; display: flex; flex-direction: column; justify-content: space-between; gap: 10px;">
									<div>
										<div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 8px;">
											<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 900;">⏱️ VIDEO CHAPTER BREAKDOWN &amp; RUNTIME CHECKLIST</span>
											<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800;">TOTAL: 4M 30S</span>
										</div>
										<div style="display: flex; flex-direction: column; gap: 7px;">
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV03', 'uMkZvTbqF2U', 0)">
												<span><strong>Ch 01:</strong> Creating Your Dedicated YouTube Brand Account</span>
												<span class="kr-chapter-time">▶ 00:00</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV03', 'uMkZvTbqF2U', 70)">
												<span><strong>Ch 02:</strong> Upload Defaults &amp; 480-Character SEO Tag Stack (<code class="kr-code-pill">PDF-03</code>)</span>
												<span class="kr-chapter-time">▶ 01:10</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV03', 'uMkZvTbqF2U', 145)">
												<span><strong>Ch 03:</strong> Pasting Dark-Luxury <code class="kr-code-pill">#04070d</code> Website Prompt (<code class="kr-code-pill">PDF-04</code>)</span>
												<span class="kr-chapter-time">▶ 02:25</span>
											</button>
											<button type="button" class="kr-chapter-btn" onclick="krSeekModuleVideo('krVideoPlayerV03', 'uMkZvTbqF2U', 215)">
												<span><strong>Ch 04:</strong> JSON-LD Schema &amp; Search Console Indexing (<code class="kr-code-pill">PDF-05</code>)</span>
												<span class="kr-chapter-time">▶ 03:35</span>
											</button>
										</div>
									</div>

									<div style="background: rgba(4, 7, 13, 0.95); border: 1px solid #d4af37; border-radius: 12px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
										<div>
											<div style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.66rem; font-weight: 900;">STARTER TEMPLATE // 03_WEBSITE_AND_YOUTUBE</div>
											<div style="color: #e2e8f0; font-size: 0.76rem; font-weight: 700;">Ready-to-drop <code class="kr-code-pill">03_Website_Builder.md</code> file</div>
										</div>
										<button type="button" class="kr-copy-btn" onclick="krDownloadStarterWebsiteMd()">
											⬇ Download .MD Starter File
										</button>
									</div>
								</div>
							</div>
						</div>

						<!-- STEP 2: PDF-03, PDF-04 & PDF-05 COPY-PASTE PROMPTS -->
						<div style="background: #04070d; border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 18px; padding: 20px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 12px;">
								<div>
									<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">STEP 2 &bull; MODULE V03 &bull; SPEC SHEETS PDF-03, PDF-04 &amp; PDF-05 // YOUTUBE CHANNEL &amp; WEBSITE BUILDER</span>
									<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 900; margin: 4px 0 0 0;">
										Copy-Paste Prompts for Your YouTube Brand Channel &amp; Dark-Luxury Website
									</h3>
								</div>
								<div style="display: flex; gap: 8px; flex-wrap: wrap;">
									<button type="button" onclick="krOpenSpecModal('PDF-03')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 7px 12px; font-size: 0.72rem; font-weight: 800; cursor: pointer;">👁️ PDF-03 (YouTube)</button>
									<button type="button" onclick="krOpenSpecModal('PDF-04')" style="background: rgba(212, 175, 55, 0.16); border: 1px solid #d4af37; color: #f6d365; border-radius: 9999px; padding: 7px 12px; font-size: 0.72rem; font-weight: 800; cursor: pointer;">👁️ PDF-04 (Website)</button>
									<button type="button" onclick="krOpenSpecModal('PDF-05')" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 7px 12px; font-size: 0.72rem; font-weight: 800; cursor: pointer;">👁️ PDF-05 (SEO &amp; GSC)</button>
								</div>
							</div>

							<div class="kr-copy-prompt-box gold-border">
								<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
									<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">📋 COPY-PASTE PROMPT #3: YOUTUBE BRAND CHANNEL, UPLOAD DEFAULTS &amp; 480-CHAR TAGS (PDF-03)</span>
									<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('krPromptYoutubeSetup', this)">📋 COPY YOUTUBE PROMPT</button>
								</div>
								<pre id="krPromptYoutubeSetup" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc; line-height: 1.55;">Create my complete YouTube Brand Channel setup package in 04_YouTube_Channel/:
1. Channel Bio & Positioning Statement tailored to my brand and website link.
2. YouTube Studio Upload Defaults description template with chapter timestamps (00:00 Intro, 01:15 Architecture, 03:30 Step-by-Step Build, 06:00 Next Steps) and primary website CTA link.
3. A calibrated 480-character comma-separated SEO tag stack (under YouTube's 500-character limit) combining high-intent search terms for my niche.</pre>
							</div>

							<div class="kr-copy-prompt-box">
								<div style="display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 6px;">
									<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">📋 COPY-PASTE PROMPT #4: DARK-LUXURY WEBSITE &amp; SEO ARTICLE BUILDER (PDF-04 &amp; PDF-05)</span>
									<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('krPromptWebsiteBuilder', this)">📋 COPY WEBSITE PROMPT</button>
								</div>
								<pre id="krPromptWebsiteBuilder" style="margin: 0; white-space: pre-wrap; font-family: 'JetBrains Mono', monospace; font-size: 0.78rem; color: #f8fafc; line-height: 1.55;">Build a responsive dark-luxury homepage hero and WordPress/HTML article template inside 03_Website_Builder/:
1. Color Tokens: Obsidian (#04070d) background, Sovereign Gold (#d4af37) 9999px pill CTA buttons, Baby Blue (#38bdf8) accents, and 18px glassmorphic cards.
2. Hero Layout: Left column with authority headline, 3-step value strip, and YouTube video embed; Right column with an instant Email Lead & Offer Reservation card.
3. SEO & Schema: Include Person, VideoObject, and FAQPage JSON-LD schema so every article scores 100/100 in Rank Math and indexes cleanly in Google Search Console.</pre>
							</div>
						</div>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 4: MULTI-AGENT ROLE PROMPTS & B2B OUTREACH (PDF-06 TO PDF-09)         -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab4" class="kr-portal-tab-pane">
						<div style="background: #04070d; border: 1px solid rgba(56, 189, 248, 0.45); border-radius: 18px; padding: 20px;">
							<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">MODULES V04–V05 &bull; SPEC SHEETS PDF-06 TO PDF-09 // TIER 02 MULTI-AGENT &amp; B2B SUITE</span>
							<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 900; margin: 4px 0 10px 0;">
								Multi-Agent Role Prompts, 3-Source Fact Verification &amp; B2B Outreach Templates
							</h3>
							<p style="color: #cbd5e1; font-size: 0.86rem; line-height: 1.6; margin: 0 0 14px 0;">
								Instead of overloading one chat window until it forgets your instructions, Tier 02 gives you dedicated <strong>Subagent Role Prompts</strong> (Researcher, Scriptwriter, Web Builder, Quality Checker, and B2B Outreach Specialist) plus our <strong>Locked Top-and-Bottom Logo HTML Email Template</strong>.
							</p>
							<div style="display: flex; gap: 8px; flex-wrap: wrap;">
								<button type="button" onclick="krOpenSpecModal('PDF-06')" class="kr-copy-btn">👁️ PDF-06: Subagent Role Prompts</button>
								<button type="button" onclick="krOpenSpecModal('PDF-07')" class="kr-copy-btn">👁️ PDF-07: 3-Source Research Gate</button>
								<button type="button" onclick="krOpenSpecModal('PDF-08')" class="kr-copy-btn">👁️ PDF-08: B2B Outreach &amp; DNS Gate</button>
								<button type="button" onclick="krOpenSpecModal('PDF-09')" class="kr-copy-btn">👁️ PDF-09: Branded HTML Email Shell</button>
							</div>
						</div>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 5: DAVINCI RESOLVE 2-TRACK EDIT & CREATOR WORKSTATION (PDF-10..12)    -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab5" class="kr-portal-tab-pane">
						<div style="background: #04070d; border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 18px; padding: 20px;">
							<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">MODULE V06 &bull; SPEC SHEETS PDF-10 TO PDF-12 // TIER 03 CREATOR WORKSTATION</span>
							<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 900; margin: 4px 0 10px 0;">
								2-Track DaVinci Resolve Timeline Assembly, -18dB Music Ducking &amp; Full Workstation Scaling
							</h3>
							<p style="color: #cbd5e1; font-size: 0.86rem; line-height: 1.6; margin: 0 0 14px 0;">
								Combine your exported 10-second Google Flow spoken clips (Video Track 1) with cutaway B-roll clips (Video Track 2) and <code class="kr-code-pill-gold">-18dB</code> background music in DaVinci Resolve for a broadcast-ready 4K master episode.
							</p>
							<div style="display: flex; gap: 8px; flex-wrap: wrap;">
								<button type="button" onclick="krOpenSpecModal('PDF-10')" class="kr-copy-btn">👁️ PDF-10: Multi-Folder Workstation</button>
								<button type="button" onclick="krOpenSpecModal('PDF-11')" class="kr-copy-btn">👁️ PDF-11: DaVinci 2-Track Assembly</button>
								<button type="button" onclick="krOpenSpecModal('PDF-12')" class="kr-copy-btn">👁️ PDF-12: Omnichannel Launch Checklist</button>
							</div>
						</div>
					</div>

					<!-- ========================================================================= -->
					<!-- TAB 6: 24/7 AI ARCHITECT TUTOR + ALL 12 BREAKDOWN SPEC PDFs               -->
					<!-- ========================================================================= -->
					<div id="kr-portal-pane-tab6" class="kr-portal-tab-pane">
						<div id="krAiTutorPanel" style="background: linear-gradient(145deg, #0b1324 0%, #050911 100%); border: 1.5px solid #38bdf8; border-radius: 18px; padding: 22px; margin-bottom: 20px;">
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; margin-bottom: 10px;">
								<span style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 900;">🤖 24/7 INTERACTIVE AI ARCHITECT TUTOR // INSTANT ANSWERS + EMAIL TRANSCRIPTS</span>
								<span style="color: #f6d365; font-size: 0.74rem; font-weight: 700;">Trained on PDF-01 through PDF-12</span>
							</div>
							<h3 style="color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.22rem; font-weight: 900; margin: 0 0 8px 0;">
								Ask Your 24/7 AI Teacher Anything About Setting Up Your Brain, Google Flow Videos, or Website
							</h3>

							<!-- Quick Question Pills -->
							<div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px;">
								<button type="button" class="kr-tutor-quick-btn" data-q="How do I set up my $30 Antigravity Brain?" style="background: rgba(212, 175, 55, 0.15); border: 1px solid #d4af37; color: #f6d365; border-radius: 9999px; padding: 6px 12px; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
									🧠 How do I set up my $30 Antigravity Brain?
								</button>
								<button type="button" class="kr-tutor-quick-btn" data-q="How do I write ~20-word Google Flow prompts & export?" style="background: rgba(56, 189, 248, 0.15); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 6px 12px; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
									🎬 How do I write ~20-word Google Flow prompts &amp; export?
								</button>
								<button type="button" class="kr-tutor-quick-btn" data-q="Give me the copy-paste Website prompt" style="background: rgba(212, 175, 55, 0.15); border: 1px solid #d4af37; color: #f6d365; border-radius: 9999px; padding: 6px 12px; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
									🌐 Give me the copy-paste Website prompt
								</button>
								<button type="button" class="kr-tutor-quick-btn" data-q="How do I set up my YouTube Brand Channel?" style="background: rgba(56, 189, 248, 0.15); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 6px 12px; font-size: 0.74rem; font-weight: 800; cursor: pointer;">
									📺 How do I set up my YouTube Brand Channel?
								</button>
							</div>

							<div style="display: flex; gap: 8px; flex-wrap: wrap;">
								<input type="text" id="krTutorQuestionInput" placeholder="Ask any step-by-step question (e.g. How do I export my 10-second clips from Google Flow?)..." style="flex: 1; min-width: 240px; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.45); border-radius: 9999px; color: #f8fafc; padding: 10px 16px; font-size: 0.84rem;" />
								<input type="email" id="krTutorEmailInput" placeholder="Optional: Email to receive lesson copy" style="width: 240px; background: #04070d; border: 1px solid rgba(212, 175, 55, 0.45); border-radius: 9999px; color: #f8fafc; padding: 10px 14px; font-size: 0.80rem;" />
								<button type="button" id="krAskTutorBtn" style="background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%); color: #04070d; border: none; border-radius: 9999px; padding: 10px 20px; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 900; cursor: pointer;">
									🤖 ASK AI TUTOR
								</button>
								<button type="button" id="krEmailTutorLessonBtn" style="background: linear-gradient(135deg, #f3e5ab 0%, #d4af37 50%, #aa8010 100%); color: #04070d !important; border: none; border-radius: 9999px; padding: 10px 16px; font-family: 'Outfit', sans-serif; font-size: 0.78rem; font-weight: 900; cursor: pointer;">
									✉️ EMAIL ME THIS LESSON
								</button>
							</div>

							<div id="krTutorAnswerBox" style="display: none; margin-top: 14px; background: #04070d; border: 1px solid #d4af37; border-radius: 14px; padding: 16px;"></div>
						</div>

						<!-- All 12 Breakdown Spec PDFs Grid -->
						<div style="background: #04070d; border: 1px solid rgba(212, 175, 55, 0.35); border-radius: 18px; padding: 20px;">
							<h4 style="color: #f6d365; font-family: 'Outfit', sans-serif; font-size: 1.05rem; font-weight: 900; margin: 0 0 12px 0;">
								📄 Complete 12-PDF Breakdown Library (View Copy-Paste Prompts On Screen or Download Real <code class="kr-code-pill">%PDF-1.4</code>)
							</h4>
							<div id="krPdfLibraryGrid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 10px;"></div>
						</div>
					</div>

				</div>
			</div>
		</section>

		<!-- 2. THE 3 DEDICATED PRODUCT SHOWCASE BLOCKS -->
		<section class="protocols-showcase-section">
			<div class="ast-container">

				<!-- PRODUCT 1: $49.50 ANTIGRAVITY AI BRAIN, GOOGLE FLOW VIDEO & WEBSITE FAST-TRACK BLUEPRINT -->
				<div id="tier-blueprint" class="protocol-product-block">
					<div class="product-grid">

						<div class="product-media-col">
							<div class="video-preview-card">
								<div class="video-thumb-wrap" style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 14px 14px 0 0; background: #04070d;">
									<iframe src="https://www.youtube.com/embed/JCgZ5SsN_bc?rel=0"
											title="Wayne's Recorded Walkthrough: $30 Antigravity Brain, ~20-Word Google Flow Prompts & Website Blueprint"
											style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
											allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
											allowfullscreen loading="lazy"></iframe>
								</div>
								<div class="video-card-meta">
									<span class="video-title">Wayne's Recorded Walkthrough: $30 Antigravity Brain, ~20-Word Google Flow Prompts &amp; Website Blueprint</span>
									<span class="video-desc">Watch Wayne Stevenson demonstrate how to set up your 4-folder AI Brain on the $30 Antigravity plan, generate ~20-word Google Flow video prompts, export 1080p MP4 clips, and build a high-converting website.</span>
								</div>
							</div>
						</div>

						<div class="product-info-col">
							<div class="product-badge-row">
								<span class="badge-tier-cyan">TIER 01 // VISUAL BRAIN DIAGRAM + COPY-PASTE PROMPTS</span>
								<span class="badge-discount-gold">50% OFF $99 LAUNCH SPECIAL</span>
							</div>
							<h2 class="product-title">Antigravity AI Brain, ~20-Word Google Flow Video &amp; Website Fast-Track Blueprint</h2>
							<div class="product-price-row">
								<span class="price-symbol">$</span>
								<span class="price-val">49.50</span>
								<span class="price-currency">USD</span>
								<span class="price-original"><del>$99.00</del></span>
							</div>
							<p class="product-lead-copy">
								Stop paying agencies $5,000+ for slow websites or spending weeks guessing how to write AI video prompts. This fast-track blueprint gives you our <strong>Visual Brain Setup Diagram (<code class="kr-code-pill">PDF-01</code>)</strong> and <strong>Copy-Paste Prompt Packs</strong> so you can take the <code class="kr-code-pill-gold">$30/mo</code> Google Antigravity plan, build your 4-folder AI Brain, generate <strong>~20-word (18–24 word) Google Flow video prompts</strong>, export MP4 videos, and launch your YouTube Brand Channel and Website step by step.
							</p>

							<div class="product-deliverables-box">
								<h4>📦 100% Self-Service Deliverables (Unlocked Instantly via Verified <code class="kr-code-pill">KR-UID</code>):</h4>
								<ul>
									<li><strong>🧠 Step 1 — $30 Antigravity Visual Brain Setup Diagram (<code class="kr-code-pill">PDF-01</code>):</strong> Visual flowchart + copy-paste prompt that builds your <code class="kr-code-pill">01_Brain_Rules</code>, <code class="kr-code-pill">02_Video_Prompts</code>, <code class="kr-code-pill">03_Website_Builder</code>, and <code class="kr-code-pill">04_YouTube_Channel</code> folders automatically.</li>
									<li><strong>🎬 Step 2 — ~20-Word Google Flow Video Prompt System (<code class="kr-code-pill">PDF-02</code>):</strong> Copy-paste prompt generator that writes concise 18–24 word Google Flow scene prompts so you can generate and export crisp 10-second MP4 videos.</li>
									<li><strong>📺 Step 3 — YouTube Brand Channel &amp; Copy-Paste Website Prompts (<code class="kr-code-pill">PDF-03</code>–<code class="kr-code-pill">PDF-05</code>):</strong> Ready-to-paste prompts for your dark-luxury <code class="kr-code-pill">#04070d</code> homepage, SEO articles, Upload Defaults, and 480-character tag stack.</li>
									<li><strong>🤖 Step 4 — 24/7 AI Architect Tutor + Personal Email Follow-Up:</strong> Interactive AI Teacher on this page + automated custom prompt email from <code class="kr-code-pill">keystonerecomposition@gmail.com</code>.</li>
								</ul>
							</div>

							<div class="product-checkout-box">
								<button type="button" class="btn-cyan-buy js-open-automated-order" data-tier="1" data-price="49.50" data-name="Tier 01 — $49.50 AI Brain, Flow Video & Website Blueprint" style="border: none; cursor: pointer; width: 100%;">
									⚡ LOCK IN $49.50 LAUNCH RATE &amp; UNLOCK PORTAL →
								</button>
								<div class="checkout-trust-line">
									🔒 $0 Charged Today • Priority <code class="kr-code-pill">KR-UID</code> Reservation • Instant Self-Service Portal &amp; PDFs
								</div>
								<span class="delivery-time-tag">⚡ Priority reservation saved immediately &amp; emailed to your inbox</span>
							</div>
						</div>

					</div>
				</div>

				<!-- PRODUCT 2: $199 MULTI-AGENT PROMPT SYSTEM & B2B OUTREACH ENGINE -->
				<div id="tier-swarm" class="protocol-product-block">
					<div class="product-grid reverse-on-desktop">

						<div class="product-media-col">
							<div class="video-preview-card">
								<div class="video-thumb-wrap" style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 14px 14px 0 0; background: #04070d;">
									<iframe src="https://www.youtube.com/embed/k3fArbXUzQM?rel=0"
											title="Multi-Agent Role Prompts & B2B Outreach Engine"
											style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
											allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
											allowfullscreen loading="lazy"></iframe>
								</div>
								<div class="video-card-meta">
									<span class="video-title">Multi-Agent Role Prompts &amp; B2B Outreach Architecture</span>
									<span class="video-desc">How specialized subagent role prompts execute parallel research, 3-source fact verification, and branded B2B client outreach without context collapse.</span>
								</div>
							</div>
						</div>

						<div class="product-info-col">
							<div class="product-badge-row">
								<span class="badge-tier-cyan">TIER 02 // PRO MULTI-AGENT &amp; B2B SUITE</span>
							</div>
							<h2 class="product-title">Multi-Agent Role Prompt System &amp; B2B Outreach Engine</h2>
							<div class="product-price-row">
								<span class="price-symbol">$</span>
								<span class="price-val">199</span>
								<span class="price-currency">USD</span>
							</div>
							<p class="product-lead-copy">
								Single-prompt chatbots suffer from context rot: after a few turns, they forget your brand rules and emit generic copy. Tier 02 gives you the complete multi-agent role prompt library (<code class="kr-code-pill">PDF-06</code> to <code class="kr-code-pill">PDF-09</code>) to run dedicated Research, Scripting, Website, and B2B Outreach agents inside your Antigravity Brain.
							</p>

							<div class="product-deliverables-box">
								<h4>📦 What You Receive in Tier 02 (Includes Everything in Tier 01 + <code class="kr-code-pill">PDF-06</code>–<code class="kr-code-pill">PDF-09</code>):</h4>
								<ul>
									<li><strong>🎬 Wayne's Recorded Multi-Agent Workflow Walkthrough:</strong> Step-by-step guide showing how to organize specialized role prompts inside your Brain folders.</li>
									<li><strong>📦 Copy-Paste Subagent Role Prompt Library (<code class="kr-code-pill">.ZIP</code>):</strong> Ready-to-use role definitions for Speed Research, Scriptwriting, Full-Stack Web Pages, SEO Auditing, and B2B Lead Outreach.</li>
									<li><strong>✉️ B2B Lead Verification &amp; Locked Crest Logo Email Shell:</strong> Domain MX verification checklist and dark-luxury HTML email templates that build instant executive authority.</li>
									<li><strong>🤖 Full Access to 24/7 AI Architect Tutor:</strong> On-demand coaching across all 9 Breakdown PDFs.</li>
								</ul>
							</div>

							<div class="product-checkout-box">
								<button type="button" class="btn-cyan-buy js-open-automated-order" data-tier="2" data-price="199" data-name="Tier 02 — $199 Multi-Agent Prompt System & B2B Engine" style="border: none; cursor: pointer; width: 100%;">
									🚀 LOCK IN $199 MULTI-AGENT LAUNCH RATE &amp; RESERVE ACCESS →
								</button>
								<div class="checkout-trust-line">
									🔒 $0 Charged Today • Priority <code class="kr-code-pill">KR-UID</code> Reservation • Includes Tier 01 + Multi-Agent Pack
								</div>
								<span class="delivery-time-tag">⚡ Priority reservation saved immediately &amp; emailed to your inbox</span>
							</div>
						</div>

					</div>
				</div>

				<!-- PRODUCT 3: $800 FULL-STACK AI CREATOR WORKSTATION & 1-ON-1 ARCHITECTURE -->
				<div id="tier-workstation" class="protocol-product-block featured-product">
					<div class="product-grid">

						<div class="product-media-col">
							<div class="video-preview-card">
								<div class="video-thumb-wrap" style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 14px 14px 0 0; background: #04070d;">
									<iframe src="https://www.youtube.com/embed/uMkZvTbqF2U?rel=0"
											title="The Full-Stack AI Creator Workstation & DaVinci Resolve Pipeline"
											style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"
											allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
											allowfullscreen loading="lazy"></iframe>
								</div>
								<div class="video-card-meta">
									<span class="video-title">Wayne's Recorded $800 Creator Workstation &amp; AI Video Production Masterclass</span>
									<span class="video-desc">Watch Wayne Stevenson demonstrate the complete multi-brand AI Brain workstation, 2-track DaVinci Resolve timeline assembly, and full-stack conversion funnel suite.</span>
								</div>
							</div>
						</div>

						<div class="product-info-col">
							<div class="product-badge-row">
								<span class="badge-tier-cyan">TIER 03 // $800 CREATOR WORKSTATION + 1-ON-1 FOLLOW-UP</span>
								<span class="badge-capacity-alert">ALL 12 PDFS + PERSONAL ARCHITECTURE REVIEW</span>
							</div>
							<h2 class="product-title">Full-Stack AI Creator Workstation, DaVinci Assembly &amp; 1-on-1 Onboarding</h2>
							<div class="product-price-row">
								<span class="price-symbol">$</span>
								<span class="price-val">800</span>
								<span class="price-currency">USD</span>
							</div>
							<p class="product-lead-copy">
								Designed for founders, builders, and creators who want the complete flagship system (<code class="kr-code-pill">PDF-01</code> through <code class="kr-code-pill">PDF-12</code>): multi-brand Brain architecture, 2-track DaVinci Resolve video &amp; B-roll assembly with <code class="kr-code-pill-gold">-18dB</code> audio ducking, full website funnel templates, and direct personal email onboarding with Wayne Stevenson.
							</p>

							<div class="product-deliverables-box">
								<h4>🏛️ $800 Creator Workstation Deliverables + Personal Follow-Up:</h4>
								<ul>
									<li><strong>🎬 Step 1 — Complete 6-Module Masterclass &amp; All 12 Breakdown PDFs:</strong> Unlocks every module (<code class="kr-code-pill">V01</code>–<code class="kr-code-pill">V06</code>) and all 12 downloadable <code class="kr-code-pill">%PDF-1.4</code> spec sheets.</li>
									<li><strong>📦 Step 2 — Full Creator Workstation Suite (<code class="kr-code-pill">.ZIP</code>):</strong> Multi-brand Brain folder blueprint, 2-track DaVinci Resolve assembly guide, and full website + lead capture templates.</li>
									<li><strong>🔐 Verified Priority <code class="kr-code-pill">KR-UID</code> Lock:</strong> Permanently unlocks all 3 tiers inside the Self-Service Portal.</li>
									<li><strong>✉️ Step 3 — Direct Personal Follow-Up from Wayne:</strong> Alerts Wayne Stevenson (<code class="kr-code-pill">keystonerecomposition@gmail.com</code>) to review your setup intake form and schedule your 1-on-1 architecture onboarding.</li>
								</ul>
							</div>

							<div class="product-checkout-box">
								<button type="button" class="btn-gold-buy js-open-automated-order" data-tier="3" data-price="800" data-name="Tier 03 — $800 Full-Stack AI Creator Workstation" style="border: none; cursor: pointer; width: 100%;">
									🤝 LOCK IN $800 WORKSTATION LAUNCH RATE &amp; RESERVE ACCESS →
								</button>
								<div class="checkout-trust-line">
									🏛️ $0 Charged Today • Priority <code class="kr-code-pill">KR-UID</code> Saved • Direct Personal Email Follow-Up from Wayne Stevenson
								</div>
								<span class="delivery-time-tag">⚡ Priority reservation saved immediately &amp; emailed to your inbox</span>
							</div>
						</div>

					</div>
				</div>

			</div>
		</section>

		<!-- 3. COMPETITIVE ARCHITECTURE CALLOUT -->
		<section class="protocols-benchmark-section">
			<div class="ast-container">
				<div class="competitive-matrix-card">
					<div class="matrix-header">
						<span class="matrix-tag">THE BUILDER BENCHMARK</span>
						<h3 class="matrix-title">Why We Build Our AI Brain in Google Antigravity ($30/mo Plan) + Google Flow</h3>
						<p class="matrix-desc">
							"When you pour concrete or frame high-load timber structures, you learn that unreliable tools cost fortunes. In AI video and website production, the principle is identical." — Wayne Stevenson
						</p>
					</div>
					<div class="matrix-grid">
						<div class="matrix-col">
							<h4>⚡ 2,000,000-Token Brain Memory</h4>
							<p>Gemini provides up to <strong>2M tokens of context</strong> inside Antigravity, allowing your <code class="kr-code-pill">01_Brain_Rules</code> folder to hold your entire brand bible, video scripts, and website templates simultaneously.</p>
						</div>
						<div class="matrix-col">
							<h4>🎬 ~20-Word Google Flow Precision</h4>
							<p>By generating concise <strong>18-to-24 word scene prompts</strong> in Antigravity and pairing them with 3 reference images in <strong>Google Flow</strong>, you export consistent 10-second 1080p MP4 clips on demand.</p>
						</div>
						<div class="matrix-col">
							<h4>🌐 Copy-Paste Website &amp; SEO Speed</h4>
							<p>Instead of wrestling with bloated page builders, you paste our <strong>Website Builder Prompts</strong> directly into Antigravity to generate clean <code class="kr-code-pill">#04070d</code> Obsidian &amp; Gold pages with Rank Math 100/100 schema.</p>
						</div>
						<div class="matrix-col">
							<h4>🤖 24/7 Self-Service AI Teacher</h4>
							<p>Every student gets instant access to our <strong>Visual Brain Setup Diagram</strong>, <strong>12 Breakdown PDFs</strong>, <strong>Interactive Setup Generator</strong>, and <strong>24/7 AI Architect Tutor</strong> right on this page.</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</div>

<!-- 4. ON-SCREEN BREAKDOWN SPEC PDF VIEWER MODAL (WITH 1-CLICK COPY PROMPTS & %PDF-1.4 DOWNLOAD) -->
<div id="krSpecPdfModal" style="display: none; position: fixed; inset: 0; z-index: 10060; background: rgba(4, 7, 13, 0.94); align-items: center; justify-content: center; padding: 20px; overflow-y: auto;">
	<div style="background: linear-gradient(145deg, #0b111e 0%, #050911 100%); border: 1.5px solid #d4af37; border-radius: 22px; max-width: 780px; width: 100%; padding: 26px; box-shadow: 0 24px 64px rgba(0,0,0,0.95); position: relative; color: #f8fafc; max-height: 90vh; overflow-y: auto;">
		<button type="button" onclick="document.getElementById('krSpecPdfModal').style.display='none'" style="position: absolute; top: 16px; right: 16px; width: 34px !important; height: 34px !important; min-width: 34px !important; padding: 0 !important; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; background: #04070d; border: 1px solid #d4af37; color: #f6d365; font-weight: 900; cursor: pointer;">✕</button>
		<div id="krSpecPdfModalBadge" style="display: inline-block; background: rgba(212, 175, 55, 0.15); border: 1px solid #d4af37; color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 4px 12px; border-radius: 9999px; margin-bottom: 8px;"></div>
		<h3 id="krSpecPdfModalTitle" style="font-family: 'Outfit', sans-serif; font-size: 1.35rem; font-weight: 900; color: #ffffff; margin: 0 0 12px 0;"></h3>
		<div id="krSpecPdfModalBody" style="font-size: 0.85rem; color: #cbd5e1; line-height: 1.6;"></div>
		<div style="margin-top: 18px; padding-top: 14px; border-top: 1px solid rgba(212, 175, 55, 0.3); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
			<button type="button" id="krSpecPdfDownloadBtn" class="kr-copy-btn" style="padding: 10px 20px; font-size: 0.80rem;">
				⬇ DOWNLOAD PRINTABLE PDF (%PDF-1.4)
			</button>
			<button type="button" onclick="document.getElementById('krSpecPdfModal').style.display='none'" style="background: rgba(56, 189, 248, 0.15); border: 1px solid #38bdf8; color: #38bdf8; border-radius: 9999px; padding: 9px 18px; font-size: 0.78rem; font-weight: 800; cursor: pointer;">
				Close Spec Viewer
			</button>
		</div>
	</div>
</div>

<!-- 5. INTERACTIVE AUTOMATED INSTANT ORDER / LAUNCH RATE RESERVATION & UID VERIFICATION MODAL -->
<div id="automatedOrderModal" style="display: none; position: fixed; inset: 0; z-index: 10050; background: rgba(4, 7, 13, 0.92); align-items: center; justify-content: center; padding: 20px; overflow-y: auto;">
	<div style="background: linear-gradient(145deg, #0b111e 0%, #060a12 100%); border: 1.5px solid #38bdf8; border-radius: 22px; max-width: 660px; width: 100%; padding: 28px 26px; box-shadow: 0 24px 60px rgba(0, 0, 0, 0.95), 0 0 35px rgba(56, 189, 248, 0.25); position: relative; color: #f8fafc;">
		<button type="button" id="closeAutomatedOrderModal" aria-label="Close modal" style="position: absolute; top: 16px; right: 16px; width: 34px; height: 34px; border-radius: 50%; background: rgba(15, 23, 42, 0.9); border: 1px solid rgba(56, 189, 248, 0.4); color: #38bdf8; font-size: 1rem; font-weight: 800; cursor: pointer;">✕</button>

		<div style="display: inline-block; background: rgba(56, 189, 248, 0.14); border: 1px solid #38bdf8; color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 4px 12px; border-radius: 9999px; letter-spacing: 0.06em; margin-bottom: 10px;">
			🔒 NEXT COHORT RELEASING SOON • NO CARD REQUIRED TODAY
		</div>

		<h3 id="modalTierHeadline" style="font-family: 'Outfit', sans-serif; font-size: 1.45rem; font-weight: 900; color: #ffffff; margin: 0 0 8px 0;">
			Lock In Launch Rate — Tier 01 ($49.50 AI Brain, Flow Video &amp; Website Blueprint)
		</h3>
		<p style="font-size: 0.85rem; color: #cbd5e1; line-height: 1.55; margin: 0 0 18px 0;">
			Enter your name and email below to lock in your launch price and generate your priority <strong>Reservation UID (<code class="kr-code-pill">KR-UID-...</code>)</strong> with zero payment today. Your verified UID immediately unlocks the <strong>6-Tab Self-Service Course Portal, Visual Brain Setup Diagram, Copy-Paste Prompts &amp; 24/7 AI Tutor</strong> on this page and emails your magic access link.
		</p>

		<form id="automatedProtocolOrderForm" style="display: flex; flex-direction: column; gap: 12px;">
			<input type="hidden" id="orderTierInput" name="tier" value="1" />
			<div>
				<label style="display: block; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 700; color: #f6d365; margin-bottom: 5px;">SELECTED PROTOCOL TIER</label>
				<select id="modalTierSelect" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 10px; color: #f8fafc; font-family: 'Outfit', sans-serif; font-size: 0.86rem; font-weight: 700; padding: 10px 12px;">
					<option value="1">Tier 01 — $49.50 USD Antigravity Brain, ~20-Word Flow Video &amp; Website Blueprint (50% OFF)</option>
					<option value="2">Tier 02 — $199.00 USD Multi-Agent Role Prompt System &amp; B2B Outreach Engine</option>
					<option value="3">Tier 03 — $800.00 USD Full-Stack AI Creator Workstation &amp; 1-on-1 Onboarding</option>
				</select>
			</div>
			<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
				<div>
					<label style="display: block; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 700; color: #cbd5e1; margin-bottom: 5px;">YOUR FULL NAME *</label>
					<input type="text" id="orderBuyerName" required placeholder="John Builder" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 10px; color: #f8fafc; font-size: 0.86rem; padding: 10px 12px; box-sizing: border-box;" />
				</div>
				<div>
					<label style="display: block; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 700; color: #cbd5e1; margin-bottom: 5px;">YOUR EMAIL ADDRESS *</label>
					<input type="email" id="orderBuyerEmail" required placeholder="you@company.com" style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 10px; color: #f8fafc; font-size: 0.86rem; padding: 10px 12px; box-sizing: border-box;" />
				</div>
			</div>
			<div>
				<label style="display: block; font-family: 'Outfit', sans-serif; font-size: 0.76rem; font-weight: 700; color: #cbd5e1; margin-bottom: 5px;">YOUTUBE CHANNEL OR WEBSITE GOALS (OPTIONAL)</label>
				<input type="text" id="orderBuyerNotes" placeholder="Tell us your channel niche or website domain..." style="width: 100%; background: #04070d; border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 10px; color: #f8fafc; font-size: 0.84rem; padding: 10px 12px; box-sizing: border-box;" />
			</div>
			<button type="submit" id="submitAutomatedOrderBtn" style="margin-top: 4px; background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%); color: #04070d; font-family: 'Outfit', sans-serif; font-size: 0.92rem; font-weight: 900; letter-spacing: 0.05em; padding: 13px 20px; border-radius: 9999px; border: none; cursor: pointer; box-shadow: 0 8px 24px rgba(56, 189, 248, 0.35);">
				⚡ LOCK IN LAUNCH RATE &amp; UNLOCK PORTAL →
			</button>
		</form>

		<!-- Instant Reservation / Fulfillment Result Screen -->
		<div id="orderFulfillmentSuccessBox" style="display: none; margin-top: 18px; padding: 18px; border-radius: 16px; background: rgba(4, 7, 13, 0.96); border: 1.5px solid #d4af37;">
			<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; margin-bottom: 10px;">
				<span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800;">✔ LAUNCH RATE LOCKED IN &amp; PORTAL UNLOCKED</span>
				<span id="fulfilledUidReadout" style="background: rgba(56, 189, 248, 0.16); border: 1px solid #38bdf8; color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.74rem; font-weight: 900; padding: 3px 10px; border-radius: 9999px;"></span>
			</div>
			<p id="fulfilledMessageText" style="font-size: 0.85rem; color: #f8fafc; margin: 0; line-height: 1.55; font-weight: 600;"></p>
			<div id="fulfilledLiveDownloadsWrap" style="display: none; margin-top: 12px;">
				<div style="margin-bottom: 12px;">
					<div style="font-family: 'Outfit', sans-serif; font-size: 0.80rem; font-weight: 800; color: #38bdf8; margin-bottom: 6px;">🎬 STEP 1: WATCH WAYNE'S RECORDED STEP-BY-STEP WALKTHROUGH</div>
					<a id="fulfilledVideoBtn" href="https://www.youtube.com/watch?v=JCgZ5SsN_bc" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #d4af37 0%, #f3e5ab 50%, #aa8010 100%); color: #04070d !important; -webkit-text-fill-color: #04070d !important; font-family: 'Outfit', sans-serif; font-size: 0.80rem; font-weight: 900; padding: 9px 18px; border-radius: 9999px; text-decoration: none !important;">
						▶ WATCH RECORDED AI VIDEO &amp; BRAIN WALKTHROUGH
					</a>
				</div>
				<div>
					<div style="font-family: 'Outfit', sans-serif; font-size: 0.80rem; font-weight: 800; color: #f6d365; margin-bottom: 6px;">📦 STEP 2: INSTANT UID-UNLOCKED COPY-PASTE PROMPT PACKS</div>
					<ul id="fulfilledDownloadsList" style="margin: 0; padding-left: 18px; color: #cbd5e1; font-size: 0.80rem; line-height: 1.65;"></ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 6. SELF-SERVICE PORTAL, 12 SPEC PDF ENGINE (%PDF-1.4), COPY-PASTE HELPERS, INTAKE FORM & 24/7 AI TUTOR SCRIPT -->
<script>
const KR_SPEC_PDF_CATALOG = {
	'PDF-01': {
		id: 'PDF-01',
		tier: 'Tier 01 ($49.50)',
		filename: 'KR_01_Antigravity_30_Plan_And_Visual_Brain_Setup_Diagram.pdf',
		title: 'PDF-01: $30 Antigravity Plan & Visual 4-Folder AI Brain Setup Diagram',
		steps: [
			'Step 1: Subscribe to the $30/mo Google Antigravity plan and open a new local folder named My_AI_Brain.',
			'Step 2: Paste the Copy-Paste Brain Setup Prompt below into Antigravity.',
			'Step 3: Antigravity automatically creates 01_Brain_Rules, 02_Video_Prompts, 03_Website_Builder, and 04_YouTube_Channel.',
			'Step 4: Open 01_Brain_Rules/AGENTS.md to verify your brand name, niche, and website URL are locked in.'
		],
		copyPromptLabel: 'COPY-PASTE ANTIGRAVITY BRAIN SETUP PROMPT #1',
		copyPrompt: 'You are my lead AI Systems Architect inside Google Antigravity. Create 4 folders in my workspace: 01_Brain_Rules, 02_Video_Prompts, 03_Website_Builder, and 04_YouTube_Channel. Inside 01_Brain_Rules/AGENTS.md, write my brand voice rules, target audience, and website URL so you remember them in every chat.'
	},
	'PDF-02': {
		id: 'PDF-02',
		tier: 'Tier 01 ($49.50)',
		filename: 'KR_02_Google_Flow_20_Word_Video_Prompt_And_Export_Guide.pdf',
		title: 'PDF-02: Generating ~20-Word (18-24 Word) Google Flow Video Prompts & Exporting MP4s',
		steps: [
			'Step 1: Open Google Flow and upload 3 reference images (1 Headshot photo, 1 Outfit photo, 1 Studio Room photo).',
			'Step 2: Paste the ~20-Word Scene Prompt Generator below into Antigravity to write 6 concise 18-to-24 word video prompts.',
			'Step 3: Paste each ~20-word scene prompt into Google Flow to generate 10-second video clips with clean lip-sync.',
			'Step 4: Click Export / Download MP4 (1080p) on each finished clip and save to your project folder.'
		],
		copyPromptLabel: 'COPY-PASTE ~20-WORD GOOGLE FLOW PROMPT GENERATOR',
		copyPrompt: 'Write 6 sequential 10-second Google Flow video scene prompts for my topic. Keep each visual prompt strictly between 18 and 24 words (~20 words) describing the presenter speaking warmly to camera with natural two-handed gestures in a modern acoustic oak studio on a 35mm cinema lens.'
	},
	'PDF-03': {
		id: 'PDF-03',
		tier: 'Tier 01 ($49.50)',
		filename: 'KR_03_YouTube_Brand_Channel_Upload_Defaults_And_Tags.pdf',
		title: 'PDF-03: YouTube Brand Channel Setup, Upload Defaults & 480-Character Tag Stack',
		steps: [
			'Step 1: Visit youtube.com/channel_switcher and create a dedicated Brand Account for your business channel.',
			'Step 2: Open YouTube Studio -> Settings -> Upload Defaults and paste your permanent website link and chapter structure.',
			'Step 3: Paste the Copy-Paste YouTube Channel Prompt below into Antigravity to generate your 480-character SEO tag stack.',
			'Step 4: Link your 30-50 second vertical Companion Short to your main episode using the Related Video field.'
		],
		copyPromptLabel: 'COPY-PASTE YOUTUBE BRAND CHANNEL & 480-CHAR TAG PROMPT',
		copyPrompt: 'Write my YouTube Brand Channel description, Upload Defaults template with chapter timestamps, and a calibrated 480-character comma-separated SEO tag stack for my channel name, niche, and website domain.'
	},
	'PDF-04': {
		id: 'PDF-04',
		tier: 'Tier 01 ($49.50)',
		filename: 'KR_04_Copy_Paste_Antigravity_Website_Builder_Prompts.pdf',
		title: 'PDF-04: Copy-Paste Antigravity Website Builder Prompts (#04070d Dark-Luxury UI)',
		steps: [
			'Step 1: Open your 03_Website_Builder folder inside Google Antigravity.',
			'Step 2: Paste the Master Website Builder Prompt below to generate your responsive homepage hero and article layout.',
			'Step 3: Uses Obsidian (#04070d), Sovereign Gold (#d4af37) 9999px pill buttons, and Baby Blue (#38bdf8) 18px glass cards.',
			'Step 4: Embed your latest YouTube walkthrough video in the left hero column and your lead capture form on the right.'
		],
		copyPromptLabel: 'COPY-PASTE WEBSITE BUILDER PROMPT',
		copyPrompt: 'Build a high-converting dark-luxury homepage hero and article layout (#04070d Obsidian background, #d4af37 Gold 9999px pill CTA buttons, #38bdf8 Baby Blue accents, 18px glassmorphic cards) featuring an embedded YouTube video player and an instant Email Lead Capture form.'
	},
	'PDF-05': {
		id: 'PDF-05',
		tier: 'Tier 01 ($49.50)',
		filename: 'KR_05_SEO_Article_Generator_RankMath_And_GSC_Indexing.pdf',
		title: 'PDF-05: Turning Video Scripts into SEO Articles, JSON-LD Schema & Google Search Console',
		steps: [
			'Step 1: Paste your video script into Antigravity using the Video-to-Article Prompt below.',
			'Step 2: Antigravity outputs a structured long-form article with comparison tables, key takeaways, and FAQ blocks.',
			'Step 3: Attach Person, VideoObject, and FAQPage JSON-LD schema for 100/100 Rank Math SEO scoring.',
			'Step 4: Paste your published URL into Google Search Console URL Inspection and click Request Indexing.'
		],
		copyPromptLabel: 'COPY-PASTE VIDEO-TO-SEO ARTICLE PROMPT',
		copyPrompt: 'Convert my video script into a comprehensive, SEO-optimized article for my website. Include an executive summary box, a comparison table, 5 FAQ questions with FAQPage JSON-LD schema, and a clear call-to-action button.'
	},
	'PDF-06': {
		id: 'PDF-06',
		tier: 'Tier 02 ($199)',
		filename: 'KR_06_Multi_Agent_Role_Templates_And_Workflow.pdf',
		title: 'PDF-06: Multi-Agent Role Prompt Templates (Researcher, Scriptwriter, Builder, QA)',
		steps: [
			'Step 1: Create dedicated role files inside 01_Brain_Rules/roles/ so each specialist has a clean job description.',
			'Step 2: Use the Speed Researcher role for fact discovery and the Builder role for clean HTML/CSS/PHP output.',
			'Step 3: Run a final QA Reviewer pass before publishing any video script or landing page.'
		],
		copyPromptLabel: 'COPY-PASTE MULTI-AGENT ROLE INITIALIZER PROMPT',
		copyPrompt: 'Create 4 specialized subagent role prompt files in 01_Brain_Rules/roles/: 01_Researcher.md, 02_Video_Scriptwriter.md, 03_Website_Engineer.md, and 04_QA_Auditor.md with strict input/output checklists for each role.'
	},
	'PDF-07': {
		id: 'PDF-07',
		tier: 'Tier 02 ($199)',
		filename: 'KR_07_Three_Source_Fact_Verification_Protocol.pdf',
		title: 'PDF-07: The 3-Source Fact Verification Protocol (Zero Hallucinations)',
		steps: [
			'Step 1: Require every statistic, code snippet, or industry regulation to be confirmed across 3 independent sources.',
			'Step 2: Save verified citations in a research notes file before drafting your script or blog post.'
		],
		copyPromptLabel: 'COPY-PASTE 3-SOURCE VERIFICATION PROMPT',
		copyPrompt: 'Research my topic and verify every claim, statistic, and technical requirement across at least 3 independent authoritative sources before drafting my script. List the 3 sources clearly at the top of the document.'
	},
	'PDF-08': {
		id: 'PDF-08',
		tier: 'Tier 02 ($199)',
		filename: 'KR_08_B2B_Lead_Verification_And_Outreach_Workflow.pdf',
		title: 'PDF-08: B2B Client Outreach & Domain Email Verification Workflow',
		steps: [
			'Step 1: Build a clean prospect list with company name, decision-maker role, and website domain.',
			'Step 2: Verify the recipient domain has valid MX mail records before sending outreach.',
			'Step 3: Send personalized value-first outreach offering a concrete teardown or feasibility guide.'
		],
		copyPromptLabel: 'COPY-PASTE B2B VALUE OUTREACH PROMPT',
		copyPrompt: 'Write a concise, high-authority B2B outreach email to a prospective partner in my niche. Lead with a specific observation about their current project, offer a helpful resource link on my website, and keep the email under 140 words.'
	},
	'PDF-09': {
		id: 'PDF-09',
		tier: 'Tier 02 ($199)',
		filename: 'KR_09_Locked_Crest_Logo_HTML_Email_Template.pdf',
		title: 'PDF-09: Locked Top-and-Bottom Logo HTML Email Shell (#04070d & #d4af37)',
		steps: [
			'Step 1: Wrap every automated welcome email and client reply in a consistent Obsidian & Gold HTML table.',
			'Step 2: Lock your brand logo centered in the top header and left-aligned in the bottom executive signature.'
		],
		copyPromptLabel: 'COPY-PASTE HTML EMAIL SHELL PROMPT',
		copyPrompt: 'Generate a dark-luxury HTML email template (#04070d background, #d4af37 gold border, #38bdf8 links) with my brand logo centered in the top header, a clean middle content card with a gold pill CTA button, and an executive signature block at the bottom.'
	},
	'PDF-10': {
		id: 'PDF-10',
		tier: 'Tier 03 ($800)',
		filename: 'KR_10_Multi_Brand_Creator_Workstation_Architecture.pdf',
		title: 'PDF-10: Multi-Brand AI Creator Workstation & Folder Architecture',
		steps: [
			'Step 1: Organize your workstation into numbered project directories for scripts, video assets, websites, and CRM.',
			'Step 2: Maintain a single masterbrand configuration file so every episode and article stays 100% consistent.'
		],
		copyPromptLabel: 'COPY-PASTE WORKSTATION ARCHITECTURE PROMPT',
		copyPrompt: 'Organize my full-stack AI Creator Workstation into numbered folders for Brand Rules, Video Scripts, Google Flow Exports, DaVinci Resolve Timelines, Website Pages, and Client CRM with a master README index.'
	},
	'PDF-11': {
		id: 'PDF-11',
		tier: 'Tier 03 ($800)',
		filename: 'KR_11_DaVinci_Resolve_2_Track_Timeline_And_Audio_Ducking.pdf',
		title: 'PDF-11: DaVinci Resolve 2-Track Video/B-Roll Assembly & -18dB Music Ducking',
		steps: [
			'Step 1: Place your exported 10-second Google Flow spoken MP4 clips end-to-end on Video Track 1.',
			'Step 2: Place visual B-roll cutaway clips on Video Track 2 over clip transitions to keep visual momentum high.',
			'Step 3: Add instrumental background music on Audio Track 2 set to -18dB so your spoken voice stays crisp.'
		],
		copyPromptLabel: 'COPY-PASTE B-ROLL CUTAWAY GENERATOR PROMPT',
		copyPrompt: 'Write 6 cinematic 10-second Google Flow B-roll prompts (18 to 24 words each, zero spoken dialogue) to place on Video Track 2 in DaVinci Resolve over the transitions of my main spoken clips.'
	},
	'PDF-12': {
		id: 'PDF-12',
		tier: 'Tier 03 ($800)',
		filename: 'KR_12_Omnichannel_Publishing_And_Conversion_Checklist.pdf',
		title: 'PDF-12: Omnichannel Episode Launch & Conversion Funnel Checklist',
		steps: [
			'Step 1: Publish your long-form 4K YouTube episode with your 480-character tag stack and website link in line 1.',
			'Step 2: Publish your 30-50s Companion Vertical Short and link it to the main episode via Related Video.',
			'Step 3: Publish the matching SEO article on your website with embedded video and request indexing in Search Console.'
		],
		copyPromptLabel: 'COPY-PASTE OMNICHANNEL LAUNCH PACK PROMPT',
		copyPrompt: 'Generate my complete Omnichannel Launch Pack for today\'s episode: 3 high-CTR YouTube titles, description with timestamps, Companion Short hook script, Facebook/Instagram Reel caption, and WordPress blog post summary.'
	}
};

function krCopyPromptText(elementId, btnEl) {
	const el = document.getElementById(elementId);
	if (!el) return;
	const text = el.innerText || el.textContent || '';
	if (navigator.clipboard && navigator.clipboard.writeText) {
		navigator.clipboard.writeText(text).then(function() {
			if (btnEl) {
				const orig = btnEl.textContent;
				btnEl.textContent = '✔ COPIED TO CLIPBOARD!';
				setTimeout(function() { btnEl.textContent = orig; }, 2200);
			}
		});
	} else {
		const ta = document.createElement('textarea');
		ta.value = text;
		document.body.appendChild(ta);
		ta.select();
		document.execCommand('copy');
		document.body.removeChild(ta);
		if (btnEl) {
			const orig = btnEl.textContent;
			btnEl.textContent = '✔ COPIED!';
			setTimeout(function() { btnEl.textContent = orig; }, 2200);
		}
	}
}

function krOpenSpecModal(pdfId) {
	const spec = KR_SPEC_PDF_CATALOG[pdfId] || KR_SPEC_PDF_CATALOG['PDF-01'];
	const modal = document.getElementById('krSpecPdfModal');
	const badge = document.getElementById('krSpecPdfModalBadge');
	const title = document.getElementById('krSpecPdfModalTitle');
	const body = document.getElementById('krSpecPdfModalBody');
	const dlBtn = document.getElementById('krSpecPdfDownloadBtn');
	if (!modal || !spec) return;

	badge.textContent = spec.id + ' // ' + spec.tier + ' • ' + spec.filename;
	title.textContent = spec.title;

	let diagramHtml = '';
	if (spec.id === 'PDF-01') {
		diagramHtml = `
			<div style="background:#04070d;border:1.5px solid #d4af37;border-radius:14px;padding:14px;margin-bottom:14px;">
				<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:8px;">
					<span style="color:#f6d365;font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:900;">🗺️ VISUAL 4-FOLDER AI BRAIN SETUP FLOWCHART (PDF-01)</span>
					<button type="button" class="kr-copy-btn" onclick="krDownloadStarterAgentsMd()">⬇ Download AGENTS.md Starter File</button>
				</div>
				<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:8px;font-size:0.76rem;">
					<div style="background:#081020;border:1px solid #d4af37;border-radius:10px;padding:10px;"><strong style="color:#f6d365;">1. $30 Antigravity Plan</strong><br/>Open local folder <code>My_AI_Brain</code></div>
					<div style="background:#081020;border:1px solid #38bdf8;border-radius:10px;padding:10px;"><strong style="color:#38bdf8;">2. Paste Setup Prompt</strong><br/>Creates <code>01_Brain_Rules</code> .. <code>04_YouTube_Channel</code></div>
					<div style="background:#081020;border:1px solid #d4af37;border-radius:10px;padding:10px;"><strong style="color:#f6d365;">3. ~20-Word Flow Clips</strong><br/>Paste into Google Flow &amp; Export MP4</div>
					<div style="background:#081020;border:1px solid #38bdf8;border-radius:10px;padding:10px;"><strong style="color:#38bdf8;">4. Website &amp; Channel</strong><br/>Paste Website &amp; YouTube Prompts</div>
				</div>
			</div>`;
	}

	const stepsList = spec.steps.map(s => `<li style="margin-bottom:6px;">${s}</li>`).join('');
	body.innerHTML = `
		${diagramHtml}
		<h4 style="color:#38bdf8;font-size:0.92rem;margin:0 0 8px 0;">Step-by-Step Implementation Checklist:</h4>
		<ol style="margin:0 0 14px 0;padding-left:20px;color:#e2e8f0;">${stepsList}</ol>
		<div class="kr-copy-prompt-box gold-border">
			<div style="display:flex;justify-content:space-between;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:6px;">
				<span style="color:#f6d365;font-family:'JetBrains Mono',monospace;font-size:0.72rem;font-weight:900;">📋 ${spec.copyPromptLabel}</span>
				<button type="button" class="kr-copy-btn" onclick="krCopyPromptText('krModalSpecPromptPre', this)">📋 COPY PROMPT</button>
			</div>
			<pre id="krModalSpecPromptPre" style="margin:0;white-space:pre-wrap;font-family:'JetBrains Mono',monospace;font-size:0.78rem;color:#f8fafc;">${spec.copyPrompt}</pre>
		</div>`;

	if (dlBtn) {
		dlBtn.onclick = function() { krDownloadRealPdf(spec.id); };
	}
	modal.style.display = 'flex';
}

function krSeekModuleVideo(iframeId, videoId, startSec) {
	const iframe = document.getElementById(iframeId);
	if (!iframe) return;
	const sec = Math.max(0, parseInt(startSec, 10) || 0);
	iframe.src = 'https://www.youtube-nocookie.com/embed/' + encodeURIComponent(videoId) + '?start=' + sec + '&autoplay=1&rel=0';
}

function krTriggerTextFileDownload(filename, content, mimeType) {
	const blob = new Blob([content], { type: mimeType || 'text/markdown;charset=utf-8' });
	const url = URL.createObjectURL(blob);
	const a = document.createElement('a');
	a.href = url;
	a.download = filename;
	document.body.appendChild(a);
	a.click();
	document.body.removeChild(a);
	setTimeout(() => URL.revokeObjectURL(url), 3000);
}

// TOOL A: 1-Click Download AGENTS.md Starter File (for 01_Brain_Rules/AGENTS.md)
function krDownloadStarterAgentsMd() {
	const chName = (document.getElementById('setupChannelName') && document.getElementById('setupChannelName').value.trim()) || 'My Brand AI Channel';
	const chNiche = (document.getElementById('setupChannelNiche') && document.getElementById('setupChannelNiche').value.trim()) || 'AI Systems, Digital Products & Modern Authority';
	const domain = (document.getElementById('setupWebsiteDomain') && document.getElementById('setupWebsiteDomain').value.trim()) || 'mybranddomain.com';
	const buyerName = (document.getElementById('setupBuyerName') && document.getElementById('setupBuyerName').value.trim()) || 'Founder & Lead Architect';

	const mdContent = [
		'# AGENTS.md — Master AI Brain Rules (Drop Inside 01_Brain_Rules/AGENTS.md)',
		'',
		'## 1. Brand Identity & Core Offer',
		'- **Founder / Presenter**: ' + buyerName,
		'- **YouTube Brand Channel**: ' + chName,
		'- **Core Niche & Audience**: ' + chNiche,
		'- **Primary Website Domain**: https://' + domain.replace(/^https?:\/\//, ''),
		'',
		'## 2. 4-Folder Workspace Architecture ($30/mo Google Antigravity Plan)',
		'1. `01_Brain_Rules/AGENTS.md` — Permanent brand rules, voice, and offer positioning loaded in every chat.',
		'2. `02_Video_Prompts/` — ~20-word (strictly 18 to 24 words) 10-second Google Flow video scene prompts.',
		'3. `03_Website_Builder/` — Dark-luxury homepage and SEO article templates (#04070d Obsidian, #d4af37 Sovereign Gold, #38bdf8 Baby Blue).',
		'4. `04_YouTube_Channel/` — YouTube Brand Channel Upload Defaults, chapter timestamps, and 480-character SEO tag stacks.',
		'',
		'## 3. ~20-Word Google Flow Video Prompt Invariant (PDF-02)',
		'- Every 10-second Google Flow visual scene prompt MUST be strictly between **18 and 24 words (~20 words)**.',
		'- Always pair each prompt with 3 Reference Chips in Google Flow: Character Headshot (`char_1`), Wardrobe (`cloth_1`), and Studio Room (`background_1`).',
		'- Export finished clips as 1080p MP4s for clean timeline assembly.',
		'',
		'## 4. Website & SEO Publishing Invariant (PDF-04 & PDF-05)',
		'- Enforce Obsidian (`#04070d`) backgrounds, Sovereign Gold (`#d4af37`) `9999px` pill CTA buttons, and Baby Blue (`#38bdf8`) accents.',
		'- Include `Person`, `VideoObject`, and `FAQPage` JSON-LD schema on every article and submit to Google Search Console.'
	].join('\n');

	krTriggerTextFileDownload('AGENTS.md', mdContent, 'text/markdown;charset=utf-8');
}

function krDownloadStarterFlowMd() {
	const mdContent = [
		'# 02_Video_Prompts.md — ~20-Word Google Flow Scene Generator Template',
		'',
		'## Copy-Paste Antigravity Prompt:',
		'Write 6 sequential 10-second Google Flow video scene prompts for my episode topic.',
		'1. Keep each visual prompt strictly between 18 and 24 words (~20 words total).',
		'2. Describe the presenter speaking naturally to camera with grounded two-handed gestures in a warm acoustic oak studio on a 35mm cinema lens.',
		'3. Include a separate 22-to-26 word spoken voiceover line for each 10-second clip.',
		'4. Attach 3 reference images (Character, Outfit, Studio Background) in Google Flow and click Export MP4 (1080p).'
	].join('\n');
	krTriggerTextFileDownload('02_Video_Prompts.md', mdContent, 'text/markdown;charset=utf-8');
}

function krDownloadStarterWebsiteMd() {
	const mdContent = [
		'# 03_Website_And_YouTube_Starter.md — Dark-Luxury Website & YouTube Brand Channel Prompts',
		'',
		'## 1. YouTube Brand Channel & 480-Character Tag Stack Prompt (PDF-03)',
		'Create my complete YouTube Brand Channel setup package in 04_YouTube_Channel/ with Channel Bio, Upload Defaults with chapter timestamps, and a calibrated 480-character SEO tag stack.',
		'',
		'## 2. Dark-Luxury Website & SEO Article Prompt (PDF-04 & PDF-05)',
		'Build a responsive dark-luxury homepage hero and article template inside 03_Website_Builder/ using Obsidian (#04070d), Sovereign Gold (#d4af37) 9999px pill buttons, Baby Blue (#38bdf8) accents, and Person + VideoObject + FAQPage JSON-LD schema.'
	].join('\n');
	krTriggerTextFileDownload('03_Website_And_YouTube_Starter.md', mdContent, 'text/markdown;charset=utf-8');
}

// TOOL B: Interactive ~20-Word (18-24 Word) Google Flow Pacing Checker
function krCountWords(str) {
	const cleaned = String(str || '').trim();
	if (!cleaned) return 0;
	return cleaned.split(/\s+/).filter(Boolean).length;
}

function krUpdateFlowWordCounter() {
	const input = document.getElementById('krFlowWordCountInput');
	const badge = document.getElementById('krFlowWordCountBadge');
	const hint = document.getElementById('krFlowWordCountHint');
	if (!input || !badge) return;
	const count = krCountWords(input.value);

	if (count >= 18 && count <= 24) {
		badge.textContent = count + ' words — Perfect 18–24 Word Google Flow Sweet Spot';
		badge.style.background = 'rgba(212, 175, 55, 0.18)';
		badge.style.borderColor = '#d4af37';
		badge.style.color = '#f6d365';
		if (hint) {
			hint.style.color = '#38bdf8';
			hint.textContent = '✔ Sweet Spot Locked (' + count + ' words): Optimal 10-second pacing so your audio & lip-sync never cut off in Google Flow.';
		}
	} else if (count < 18) {
		const needed = 18 - count;
		badge.textContent = count + ' words — Under 18 Words (Add ' + needed + '+ words for 18–24 Sweet Spot)';
		badge.style.background = 'rgba(56, 189, 248, 0.16)';
		badge.style.borderColor = '#38bdf8';
		badge.style.color = '#38bdf8';
		if (hint) {
			hint.style.color = '#f6d365';
			hint.textContent = '⚠️ Add ' + needed + ' to ' + (24 - count) + ' more words (camera lens, lighting, or gesture) so Google Flow has full 10-second scene context.';
		}
	} else {
		const extra = count - 24;
		badge.textContent = count + ' words — Over 24 Words! (Trim ' + extra + ' words to prevent audio cutoff)';
		badge.style.background = 'rgba(248, 113, 113, 0.16)';
		badge.style.borderColor = '#f87171';
		badge.style.color = '#f87171';
		if (hint) {
			hint.style.color = '#f87171';
			hint.textContent = '⚠️ Over 24 words (' + count + ' words): Trim ' + extra + ' words so Google Flow does not rush or cut off your 10-second clip!';
		}
	}
}

function krLoadSampleFlowPrompt() {
	const input = document.getElementById('krFlowWordCountInput');
	if (!input) return;
	input.value = 'Founder speaking warmly to camera with grounded two-handed builder gestures inside a dark acoustic oak studio on a 35mm cinema lens.';
	krUpdateFlowWordCounter();
}

function krCopyFlowCheckedPrompt(btnEl) {
	const input = document.getElementById('krFlowWordCountInput');
	if (!input) return;
	const text = input.value || '';
	if (navigator.clipboard && navigator.clipboard.writeText) {
		navigator.clipboard.writeText(text).then(function() {
			if (btnEl) {
				const orig = btnEl.textContent;
				btnEl.textContent = '✔ COPIED VERIFIED PROMPT!';
				setTimeout(function() { btnEl.textContent = orig; }, 2200);
			}
		});
	}
}

// TOOL C: 1-Click Download All 4 Custom Setup Prompts (.TXT)
function krDownloadCustomSetupTxt() {
	const chName = (document.getElementById('setupChannelName') && document.getElementById('setupChannelName').value.trim()) || 'My Brand AI Channel';
	const chNiche = (document.getElementById('setupChannelNiche') && document.getElementById('setupChannelNiche').value.trim()) || 'AI Systems & Modern Builder Authority';
	const domain = (document.getElementById('setupWebsiteDomain') && document.getElementById('setupWebsiteDomain').value.trim()) || 'mybranddomain.com';

	const p1 = (document.getElementById('outCustomBrainPrompt') && document.getElementById('outCustomBrainPrompt').textContent.trim()) ||
		(document.getElementById('krPromptBrainMaster') && document.getElementById('krPromptBrainMaster').textContent.trim()) || '';
	const p2 = (document.getElementById('outCustomFlowPrompts') && document.getElementById('outCustomFlowPrompts').textContent.trim()) ||
		(document.getElementById('krPromptFlowGenerator') && document.getElementById('krPromptFlowGenerator').textContent.trim()) || '';
	const p3 = (document.getElementById('outCustomWebsitePrompt') && document.getElementById('outCustomWebsitePrompt').textContent.trim()) ||
		(document.getElementById('krPromptWebsiteBuilder') && document.getElementById('krPromptWebsiteBuilder').textContent.trim()) || '';
	const p4 = (document.getElementById('outCustomYoutubeTags') && document.getElementById('outCustomYoutubeTags').textContent.trim()) ||
		(document.getElementById('krPromptYoutubeSetup') && document.getElementById('krPromptYoutubeSetup').textContent.trim()) || '';

	const txtContent = [
		'======================================================================',
		'KEYSTONE AI PROTOCOLS // YOUR 4 CUSTOM COPY-PASTE SETUP PROMPTS (.TXT)',
		'Channel: ' + chName + ' | Niche: ' + chNiche + ' | Website: ' + domain,
		'Portal: https://keystonerecomposition.com/ai-protocols/',
		'======================================================================',
		'',
		'----------------------------------------------------------------------',
		'1. YOUR CUSTOM ANTIGRAVITY BRAIN SETUP PROMPT ($30/MO PLAN)',
		'----------------------------------------------------------------------',
		p1,
		'',
		'----------------------------------------------------------------------',
		'2. YOUR 3 CUSTOM ~20-WORD (18-24 WORD) GOOGLE FLOW VIDEO PROMPTS',
		'----------------------------------------------------------------------',
		p2,
		'',
		'----------------------------------------------------------------------',
		'3. YOUR CUSTOM ANTIGRAVITY DARK-LUXURY WEBSITE BUILDER PROMPT',
		'----------------------------------------------------------------------',
		p3,
		'',
		'----------------------------------------------------------------------',
		'4. YOUR YOUTUBE BRAND CHANNEL UPLOAD DEFAULTS & 480-CHAR TAG STACK',
		'----------------------------------------------------------------------',
		p4,
		''
	].join('\n');

	const safeSlug = chName.toLowerCase().replace(/[^a-z0-9]+/g, '_').replace(/^_|_$/g, '') || 'keystone_student';
	krTriggerTextFileDownload('Keystone_4_Custom_Setup_Prompts_' + safeSlug + '.txt', txtContent, 'text/plain;charset=utf-8');
}

function krEscapePdfText(str) {
	return String(str || '').replace(/\\/g, '\\\\').replace(/\(/g, '\\(').replace(/\)/g, '\\)').replace(/[^\x20-\x7E]/g, ' ');
}

function krDownloadRealPdf(pdfId) {
	const spec = KR_SPEC_PDF_CATALOG[pdfId] || KR_SPEC_PDF_CATALOG['PDF-01'];
	const lines = [
		'KEYSTONE AI PROTOCOLS // OFFICIAL BREAKDOWN SPEC SHEET',
		spec.id + ' - ' + spec.title,
		'Author: Wayne Stevenson (BC Licensed Builder #52603)',
		'Portal: https://keystonerecomposition.com/ai-protocols/',
		'----------------------------------------------------------------------',
		'VISUAL BRAIN SETUP DIAGRAM FLOW (PDF-01 ARCHITECTURE):',
		'[Step 1: $30 Antigravity Plan] -> [Step 2: Paste Brain Setup Prompt #1]',
		'-> [Creates 01_Brain_Rules, 02_Video_Prompts, 03_Website_Builder, 04_YouTube_Channel]',
		'-> [Step 3: ~20-Word Google Flow Prompts & Export MP4] -> [Step 4: Website & YouTube]',
		'----------------------------------------------------------------------',
		'STEP-BY-STEP CHECKLIST:'
	];
	spec.steps.forEach(s => {
		lines.push('  * ' + s.slice(0, 88));
		if (s.length > 88) lines.push('    ' + s.slice(88, 176));
	});
	lines.push('----------------------------------------------------------------------');
	lines.push(spec.copyPromptLabel + ':');
	const promptStr = spec.copyPrompt || '';
	for (let i = 0; i < promptStr.length; i += 82) {
		lines.push('  ' + promptStr.slice(i, i + 82));
	}

	let streamCmds = 'BT\n/F1 10 Tf\n50 750 Td\n14 TL\n';
	lines.forEach((ln, idx) => {
		const escaped = krEscapePdfText(ln);
		if (idx === 0) {
			streamCmds += `(${escaped}) Tj\n`;
		} else {
			streamCmds += `T* (${escaped}) Tj\n`;
		}
	});
	streamCmds += 'ET\n';

	const obj1 = '1 0 obj\n<< /Type /Catalog /Pages 2 0 R >>\nendobj\n';
	const obj2 = '2 0 obj\n<< /Type /Pages /Kids [3 0 R] /Count 1 >>\nendobj\n';
	const obj3 = '3 0 obj\n<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R /Resources << /Font << /F1 5 0 R >> >> >>\nendobj\n';
	const obj4 = `4 0 obj\n<< /Length ${streamCmds.length} >>\nstream\n${streamCmds}endstream\nendobj\n`;
	const obj5 = '5 0 obj\n<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>\nendobj\n';

	const header = '%PDF-1.4\n';
	const body = obj1 + obj2 + obj3 + obj4 + obj5;
	const fullPdf = header + body + 'xref\n0 6\n0000000000 65535 f \ntrailer\n<< /Size 6 /Root 1 0 R >>\nstartxref\n' + (header.length + body.length) + '\n%%EOF';

	const blob = new Blob([fullPdf], { type: 'application/pdf' });
	const url = URL.createObjectURL(blob);
	const a = document.createElement('a');
	a.href = url;
	a.download = spec.filename || (spec.id + '.pdf');
	document.body.appendChild(a);
	a.click();
	document.body.removeChild(a);
	setTimeout(() => URL.revokeObjectURL(url), 3000);
}

document.addEventListener('DOMContentLoaded', function() {
	// Populate the 12 PDF cards in Tab 6
	const pdfGrid = document.getElementById('krPdfLibraryGrid');
	if (pdfGrid) {
		pdfGrid.innerHTML = Object.keys(KR_SPEC_PDF_CATALOG).map(key => {
			const item = KR_SPEC_PDF_CATALOG[key];
			return `
				<div style="background:#081020;border:1px solid rgba(56,189,248,0.32);border-radius:12px;padding:12px;display:flex;flex-direction:column;justify-content:space-between;gap:8px;">
					<div>
						<div style="color:#f6d365;font-family:'JetBrains Mono',monospace;font-size:0.66rem;font-weight:800;">${item.id} • ${item.tier}</div>
						<div style="color:#ffffff;font-family:'Outfit',sans-serif;font-size:0.84rem;font-weight:800;margin-top:3px;">${item.title}</div>
					</div>
					<div style="display:flex;gap:6px;flex-wrap:wrap;">
						<button type="button" onclick="krOpenSpecModal('${item.id}')" style="background:rgba(56,189,248,0.16);border:1px solid #38bdf8;color:#38bdf8;border-radius:9999px;padding:5px 10px;font-size:0.70rem;font-weight:800;cursor:pointer;">👁️ View &amp; Copy Prompts</button>
						<button type="button" onclick="krDownloadRealPdf('${item.id}')" style="background:rgba(212,175,55,0.18);border:1px solid #d4af37;color:#f6d365;border-radius:9999px;padding:5px 10px;font-size:0.70rem;font-weight:800;cursor:pointer;">⬇ %PDF-1.4</button>
					</div>
				</div>`;
		}).join('');
	}

	// 6-Tab Switcher
	const tabBtns = document.querySelectorAll('.kr-portal-tab-btn');
	const tabPanes = document.querySelectorAll('.kr-portal-tab-pane');
	tabBtns.forEach(btn => {
		btn.addEventListener('click', function() {
			const target = this.getAttribute('data-portal-tab');
			tabBtns.forEach(b => b.classList.remove('active'));
			tabPanes.forEach(p => p.classList.remove('active'));
			this.classList.add('active');
			const pane = document.getElementById('kr-portal-pane-' + target);
			if (pane) pane.classList.add('active');
		});
	});

	// Tool B: Live ~20-Word (18-24 Word) Google Flow Pacing Checker
	const flowWordInput = document.getElementById('krFlowWordCountInput');
	if (flowWordInput) {
		flowWordInput.addEventListener('input', krUpdateFlowWordCounter);
		krUpdateFlowWordCounter();
	}

	// Interactive Brain, YouTube Channel & Website Setup Form Handler
	const setupForm = document.getElementById('krChannelWebsiteSetupForm');
	if (setupForm) {
		setupForm.addEventListener('submit', function(e) {
			e.preventDefault();
			const submitBtn = document.getElementById('setupFormSubmitBtn');
			if (submitBtn) {
				submitBtn.disabled = true;
				submitBtn.textContent = '⏳ GENERATING YOUR CUSTOM BRAIN, FLOW & WEBSITE PROMPTS...';
			}
			const currentUid = (document.getElementById('existingVaultUidInput') && document.getElementById('existingVaultUidInput').value.trim()) || 'KR-DEMO-SELF-SERVICE';
			const payload = {
				uid: currentUid,
				buyer_name: document.getElementById('setupBuyerName').value.trim(),
				buyer_email: document.getElementById('setupBuyerEmail').value.trim(),
				youtube_channel_name: document.getElementById('setupChannelName').value.trim(),
				channel_niche: document.getElementById('setupChannelNiche').value.trim(),
				website_domain: document.getElementById('setupWebsiteDomain').value.trim(),
				brand_account_status: document.getElementById('setupBrandStatus').value,
				current_roadblock: document.getElementById('setupRoadblock').value.trim()
			};

			fetch('/wp-json/keystone/v1/protocol-setup-form', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify(payload)
			})
			.then(r => r.json())
			.then(data => {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.textContent = '✔ CUSTOM PROMPTS GENERATED BELOW (& EMAILED TO YOU)';
				}
				if (data && data.success) {
					const resBox = document.getElementById('krCustomSetupResultBox');
					const statusMsg = document.getElementById('krCustomSetupStatusMsg');
					if (resBox) resBox.style.display = 'block';
					if (statusMsg) statusMsg.textContent = data.message;
					document.getElementById('outCustomBrainPrompt').textContent = data.custom_brain_setup_prompt || '';
					document.getElementById('outCustomFlowPrompts').textContent = Array.isArray(data.custom_flow_20word_prompts) ? data.custom_flow_20word_prompts.join('\n\n') : '';
					document.getElementById('outCustomWebsitePrompt').textContent = data.custom_website_prompt || '';
					document.getElementById('outCustomYoutubeTags').textContent = data.custom_youtube_tags_and_defaults || '';
				}
			})
			.catch(() => {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.textContent = '⚡ GENERATE MY CUSTOM BRAIN, ~20-WORD GOOGLE FLOW & WEBSITE PROMPTS →';
				}
			});
		});
	}

	// 24/7 AI Architect Tutor Handler
	const tutorInput = document.getElementById('krTutorQuestionInput');
	const tutorEmailInput = document.getElementById('krTutorEmailInput');
	const askTutorBtn = document.getElementById('krAskTutorBtn');
	const emailTutorBtn = document.getElementById('krEmailTutorLessonBtn');
	const tutorAnswerBox = document.getElementById('krTutorAnswerBox');

	function runAiTutorQuery(questionText, sendEmail) {
		if (!questionText) return;
		if (tutorAnswerBox) {
			tutorAnswerBox.style.display = 'block';
			tutorAnswerBox.innerHTML = '<div style="color:#38bdf8;font-weight:700;">🤖 24/7 AI Architect Tutor is preparing your step-by-step lesson...</div>';
		}
		const currentUid = (document.getElementById('existingVaultUidInput') && document.getElementById('existingVaultUidInput').value.trim()) || 'KR-DEMO-SELF-SERVICE';
		fetch('/wp-json/keystone/v1/protocol-tutor', {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify({
				uid: currentUid,
				question: questionText,
				buyer_email: tutorEmailInput ? tutorEmailInput.value.trim() : '',
				send_email_copy: Boolean(sendEmail)
			})
		})
		.then(r => r.json())
		.then(data => {
			if (data && data.success && tutorAnswerBox) {
				const emailNotice = data.email_sent ? `<div style="margin-top:8px;color:#f6d365;font-size:0.78rem;font-weight:800;">✔ A copy of this lesson was also emailed to your inbox!</div>` : '';
				tutorAnswerBox.innerHTML = `
					${data.answer_html}
					<div style="margin-top:10px;padding-top:10px;border-top:1px solid rgba(56,189,248,0.25);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;">
						<span style="font-size:0.76rem;color:#38bdf8;font-weight:800;">📄 Recommended Spec Sheet: ${data.recommended_pdf_id} (${data.recommended_pdf_title})</span>
						<div style="display:flex;gap:6px;">
							<button type="button" class="kr-copy-btn" onclick="krOpenSpecModal('${data.recommended_pdf_id}')">👁️ Open ${data.recommended_pdf_id}</button>
							<button type="button" class="kr-copy-btn" onclick="krDownloadRealPdf('${data.recommended_pdf_id}')">⬇ Download PDF</button>
						</div>
					</div>
					${emailNotice}`;
			}
		})
		.catch(() => {});
	}

	document.querySelectorAll('.kr-tutor-quick-btn').forEach(btn => {
		btn.addEventListener('click', function() {
			const q = this.getAttribute('data-q');
			if (tutorInput) tutorInput.value = q;
			runAiTutorQuery(q, false);
		});
	});

	if (askTutorBtn && tutorInput) {
		askTutorBtn.addEventListener('click', function() {
			runAiTutorQuery(tutorInput.value.trim() || 'How do I set up my $30 Antigravity Brain?', false);
		});
	}
	if (emailTutorBtn && tutorInput) {
		emailTutorBtn.addEventListener('click', function() {
			runAiTutorQuery(tutorInput.value.trim() || 'How do I set up my $30 Antigravity Brain?', true);
		});
	}

	// Checkout & UID Verification Logic
	const tierBtns = document.querySelectorAll('.tier-select-btn');
	const expressBuyBtn = document.getElementById('portalExpressBuyBtn');
	const promoInput = document.getElementById('promoInput');
	const applyPromoBtn = document.getElementById('applyPromoBtn');
	const promoFeedback = document.getElementById('promoFeedback');

	const modal = document.getElementById('automatedOrderModal');
	const closeModalBtn = document.getElementById('closeAutomatedOrderModal');
	const modalTierSelect = document.getElementById('modalTierSelect');
	const modalTierHeadline = document.getElementById('modalTierHeadline');
	const orderTierInput = document.getElementById('orderTierInput');
	const orderForm = document.getElementById('automatedProtocolOrderForm');
	const successBox = document.getElementById('orderFulfillmentSuccessBox');
	const fulfilledUidReadout = document.getElementById('fulfilledUidReadout');
	const fulfilledMessageText = document.getElementById('fulfilledMessageText');
	const fulfilledLiveDownloadsWrap = document.getElementById('fulfilledLiveDownloadsWrap');
	const fulfilledVideoBtn = document.getElementById('fulfilledVideoBtn');
	const fulfilledDownloadsList = document.getElementById('fulfilledDownloadsList');

	const vaultUidStatusBadge = document.getElementById('vaultUidStatusBadge');
	const existingVaultUidInput = document.getElementById('existingVaultUidInput');
	const verifyVaultUidBtn = document.getElementById('verifyVaultUidBtn');
	const vaultUidVerifyFeedback = document.getElementById('vaultUidVerifyFeedback');
	const launchDemoPortalBtn = document.getElementById('launchDemoPortalBtn');

	let activeTier = 1;
	let activePrice = 49.50;
	let discount = 0;

	const promoCodes = {
		'BUILDER10': 10,
		'WAYNE10': 10,
		'KEYSTONE20': 20,
		'PROMO2026': 15
	};

	const tierNames = {
		1: 'Tier 01 — $49.50 AI Brain, Flow Video & Website Blueprint',
		2: 'Tier 02 — $199 Multi-Agent Prompt System & B2B Engine',
		3: 'Tier 03 — $800 Full-Stack AI Creator Workstation'
	};

	function formatPrice(val) {
		return (Math.round(val * 100) / 100).toFixed(val % 1 === 0 ? 0 : 2);
	}

	function updateCTA() {
		if (!expressBuyBtn) return;
		const finalPrice = activeTier === 3 ? 800 : Math.max(0, activePrice - discount);
		if (activeTier === 3) {
			expressBuyBtn.textContent = '🤝 LOCK IN $800 WORKSTATION LAUNCH RATE →';
			expressBuyBtn.className = 'btn-cyan-express-buy btn-gold-portal';
		} else {
			expressBuyBtn.textContent = `⚡ LOCK IN LAUNCH RATE & RESERVE ACCESS ($${formatPrice(finalPrice)} USD) →`;
			expressBuyBtn.className = 'btn-cyan-express-buy';
		}
	}

	function openOrderModal(tierNum) {
		activeTier = parseInt(tierNum, 10) || 1;
		if (modalTierSelect) modalTierSelect.value = String(activeTier);
		if (orderTierInput) orderTierInput.value = String(activeTier);
		if (modalTierHeadline) modalTierHeadline.textContent = 'Lock In Launch Rate — ' + (tierNames[activeTier] || tierNames[1]);
		if (modal) modal.style.display = 'flex';
	}

	tierBtns.forEach(btn => {
		btn.addEventListener('click', function() {
			tierBtns.forEach(b => b.classList.remove('active'));
			this.classList.add('active');
			activeTier = parseInt(this.getAttribute('data-tier'), 10);
			activePrice = parseFloat(this.getAttribute('data-price'));
			updateCTA();
		});
	});

	if (expressBuyBtn) {
		expressBuyBtn.addEventListener('click', function(e) {
			e.preventDefault();
			openOrderModal(activeTier);
		});
	}

	document.querySelectorAll('.js-open-automated-order').forEach(btn => {
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			const t = parseInt(this.getAttribute('data-tier'), 10) || 1;
			openOrderModal(t);
		});
	});

	if (modalTierSelect) {
		modalTierSelect.addEventListener('change', function() {
			const t = parseInt(this.value, 10) || 1;
			activeTier = t;
			if (orderTierInput) orderTierInput.value = String(t);
			if (modalTierHeadline) modalTierHeadline.textContent = 'Lock In Launch Rate — ' + (tierNames[t] || tierNames[1]);
		});
	}

	if (closeModalBtn && modal) {
		closeModalBtn.addEventListener('click', function() {
			modal.style.display = 'none';
		});
		modal.addEventListener('click', function(e) {
			if (e.target === modal) modal.style.display = 'none';
		});
	}

	if (applyPromoBtn && promoInput) {
		applyPromoBtn.addEventListener('click', function() {
			const code = promoInput.value.trim().toUpperCase();
			if (promoCodes[code]) {
				discount = promoCodes[code];
				promoFeedback.style.display = 'block';
				promoFeedback.style.color = '#38bdf8';
				promoFeedback.textContent = `✔ Promo code applied: $${discount} USD discount!`;
			} else if (code === '') {
				discount = 0;
				promoFeedback.style.display = 'none';
			} else {
				discount = 0;
				promoFeedback.style.display = 'block';
				promoFeedback.style.color = '#f87171';
				promoFeedback.textContent = '✖ Invalid promo code.';
			}
			updateCTA();
		});
	}

	function applyVerifiedVaultState(data) {
		if (!data || !data.valid) return;
		try { localStorage.setItem('kr_user_vault_uid', data.uid); } catch (e) {}
		if (vaultUidStatusBadge) {
			vaultUidStatusBadge.textContent = '✔ UID UNLOCKED: ' + data.uid;
			vaultUidStatusBadge.style.borderColor = '#d4af37';
			vaultUidStatusBadge.style.color = '#f6d365';
		}
		if (existingVaultUidInput) {
			existingVaultUidInput.value = data.uid;
		}
		const zipBtn = document.getElementById('portalQuickZipBtn');
		if (zipBtn) {
			zipBtn.href = '?vault_download=tier1_blueprint_pack&uid=' + encodeURIComponent(data.uid);
		}
	}

	function verifyUidWithServer(uidToVerify, showFeedbackBox) {
		fetch('/wp-json/keystone/v1/verify-vault-uid?uid=' + encodeURIComponent(uidToVerify || ''))
			.then(r => r.json())
			.then(data => {
				if (data && data.valid) {
					applyVerifiedVaultState(data);
					if (showFeedbackBox && vaultUidVerifyFeedback) {
						vaultUidVerifyFeedback.style.display = 'block';
						vaultUidVerifyFeedback.style.borderColor = '#d4af37';
						let dlLinks = (data.unlocked_downloads || []).map(d => `<div style="margin-top:4px;"><a href="${d.url}" target="_blank" style="color:#38bdf8;font-weight:700;text-decoration:none;">${d.label}</a></div>`).join('');
						vaultUidVerifyFeedback.innerHTML = `<div style="color:#f6d365;font-weight:800;margin-bottom:4px;">✔ UID VERIFIED (${data.uid}) — ${data.tier_name || 'Portal Unlocked'}</div><div style="color:#cbd5e1;margin-bottom:6px;">${data.message || ''}</div><div><a href="${data.walkthrough_video_url}" target="_blank" style="color:#ffffff;font-weight:800;text-decoration:underline;">▶ Watch Wayne's Recorded Walkthrough Video</a></div>${dlLinks}`;
					}
				} else if (showFeedbackBox && vaultUidVerifyFeedback) {
					vaultUidVerifyFeedback.style.display = 'block';
					vaultUidVerifyFeedback.style.borderColor = '#f87171';
					vaultUidVerifyFeedback.innerHTML = `<span style="color:#f87171;font-weight:700;">✖ ${data && data.message ? data.message : 'Invalid User Vault UID.'}</span>`;
				}
			})
			.catch(() => {});
	}

	if (launchDemoPortalBtn) {
		launchDemoPortalBtn.addEventListener('click', function() {
			verifyUidWithServer('KR-DEMO-SELF-SERVICE', true);
			this.textContent = '✔ SELF-SERVICE PREVIEW UNLOCKED (KR-DEMO-SELF-SERVICE)';
		});
	}

	let initialUid = '';
	try {
		const urlParams = new URLSearchParams(window.location.search);
		initialUid = urlParams.get('uid') || localStorage.getItem('kr_user_vault_uid') || '';
	} catch (e) {}
	if (initialUid) {
		verifyUidWithServer(initialUid, true);
	}

	if (verifyVaultUidBtn && existingVaultUidInput) {
		verifyVaultUidBtn.addEventListener('click', function() {
			const val = existingVaultUidInput.value.trim() || 'KR-DEMO-SELF-SERVICE';
			verifyUidWithServer(val, true);
		});
	}

	if (orderForm) {
		orderForm.addEventListener('submit', function(e) {
			e.preventDefault();
			const submitBtn = document.getElementById('submitAutomatedOrderBtn');
			if (submitBtn) {
				submitBtn.disabled = true;
				submitBtn.textContent = '⏳ LOCKING IN LAUNCH RATE & UNLOCKING PORTAL...';
			}
			const payload = {
				tier: modalTierSelect ? modalTierSelect.value : String(activeTier),
				buyer_name: document.getElementById('orderBuyerName').value.trim(),
				buyer_email: document.getElementById('orderBuyerEmail').value.trim(),
				notes: document.getElementById('orderBuyerNotes').value.trim(),
				promo_code: promoInput ? promoInput.value.trim().toUpperCase() : ''
			};
			fetch('/wp-json/keystone/v1/protocol-order', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify(payload)
			})
			.then(r => r.json())
			.then(data => {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.textContent = '✔ LAUNCH RATE LOCKED IN & PRIORITY UID SAVED';
				}
				if (data && data.success) {
					applyVerifiedVaultState({ valid: true, uid: data.user_uid, tier_name: data.tier_name, walkthrough_video_url: data.walkthrough_video_url, unlocked_downloads: data.unlocked_downloads });
					if (successBox) successBox.style.display = 'block';
					if (fulfilledUidReadout) fulfilledUidReadout.textContent = 'UID: ' + data.user_uid;
					if (fulfilledMessageText) fulfilledMessageText.textContent = data.message;
					if (data.unlocked_downloads && data.unlocked_downloads.length > 0 && fulfilledLiveDownloadsWrap) {
						fulfilledLiveDownloadsWrap.style.display = 'block';
						if (fulfilledVideoBtn) fulfilledVideoBtn.href = data.walkthrough_video_url;
						if (fulfilledDownloadsList) {
							fulfilledDownloadsList.innerHTML = data.unlocked_downloads.map(d => `<li><a href="${d.url}" target="_blank" style="color:#38bdf8;font-weight:700;text-decoration:none;">${d.label}</a></li>`).join('');
						}
					}
				}
			})
			.catch(() => {
				if (submitBtn) {
					submitBtn.disabled = false;
					submitBtn.textContent = '⚡ LOCK IN LAUNCH RATE & UNLOCK PORTAL →';
				}
			});
		});
	}
});
</script>

<?php
get_footer();
