<?php
/**
 * Template Name: Keystone AI Protocols
 * Description: Dedicated 3-Tier Monetization & Video Breakdown Sales Landing Page for Keystone Recomposition
 *
 * @package Keystone Recomposition Child
 * @since 3.5.0
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$theme_uri = get_stylesheet_directory_uri();
?>

<div id="primary" class="content-area primary keystone-cyber-protocols">
    <main id="main" class="site-main">

        <!-- 1. LANDING HERO SECTION WITH TOP-RIGHT EXPRESS CHECKOUT PORTAL -->
        <section class="cyber-hero-section protocols-hero">
            <div class="ast-container">
                <div class="protocols-hero-split">
                    
                    <!-- Left Column: High-Conviction Value Positioning -->
                    <div class="protocols-hero-left">
                        <div class="cyber-telemetry-pill">
                            <span class="telemetry-pulse"></span>
                            <span class="telemetry-text">// 2026 SOVEREIGN AI SUITE • FAST-TRACK YOUR WORKSTATION</span>
                        </div>

                        <div class="cyber-founder-chip">
                            <img src="<?php echo esc_url( $theme_uri . '/assets/images/wayne_avatar.jpg' ); ?>" 
                                 alt="Wayne Stevenson — Founder &amp; Architect" 
                                 class="founder-chip-avatar" 
                                 width="52" height="52" loading="eager" decoding="async" />
                            <div class="founder-chip-meta">
                                <span class="chip-name">Wayne Stevenson</span>
                                <span class="chip-role">Licensed BC Builder #52603 • FastMCP Systems Architect</span>
                            </div>
                            <span class="chip-verified-badge">✔ VERIFIED</span>
                        </div>

                        <h1 class="cyber-hero-title">
                            Deploy Production AI Workstations<br/>
                            <span class="cyan-gradient-text">Engineered for High-Cadence Execution</span>
                        </h1>

                        <p class="cyber-hero-subtitle">
                            Step-by-step blueprints, production 16-agent swarms, and bespoke 1-on-1 workstation architecture. Built by a licensed British Columbia residential builder who runs physical multi-million dollar operations and high-velocity digital media on sovereign AI.
                        </p>

                        <div class="protocols-quick-nav">
                            <a href="#tier-blueprint" class="quick-nav-pill">01 • $49 Website Blueprint</a>
                            <a href="#tier-swarm" class="quick-nav-pill">02 • $199 16-Agent Swarm</a>
                            <a href="#tier-workstation" class="quick-nav-pill">03 • $800 Custom Tauri Workstation</a>
                        </div>
                    </div>

                    <!-- Right Column: Top-Right Express Checkout & Payment Portal Card -->
                    <div class="protocols-hero-right">
                        <div class="express-checkout-card">
                            <div class="checkout-card-header">
                                <span class="checkout-badge-live">⚡ DIRECT STRIPE PORTAL</span>
                                <h3 class="checkout-portal-title">Express Checkout &amp; Access</h3>
                                <p class="checkout-portal-sub">Instant digital delivery &amp; corporate direct deposit.</p>
                            </div>
                            
                            <div class="checkout-tier-selector">
                                <label class="checkout-label">Select Protocol Tier:</label>
                                <div class="tier-select-grid">
                                    <button type="button" class="tier-select-btn active" data-tier="1" data-price="49" data-url="https://buy.stripe.com/test_keystone_tier1_49">
                                        <span class="btn-tier-num">TIER 01</span>
                                        <span class="btn-tier-name">Website Blueprint</span>
                                        <span class="btn-tier-price">$49</span>
                                    </button>
                                    <button type="button" class="tier-select-btn" data-tier="2" data-price="199" data-url="https://buy.stripe.com/test_keystone_tier2_199">
                                        <span class="btn-tier-num">TIER 02</span>
                                        <span class="btn-tier-name">16-Agent Swarm</span>
                                        <span class="btn-tier-price">$199</span>
                                    </button>
                                    <button type="button" class="tier-select-btn" data-tier="3" data-price="800" data-url="/contact/">
                                        <span class="btn-tier-num">TIER 03</span>
                                        <span class="btn-tier-name">Custom Tauri Workstation</span>
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

                            <!-- Dynamic Express Buy Button -->
                            <div class="checkout-cta-wrap">
                                <a id="portalExpressBuyBtn" href="https://buy.stripe.com/test_keystone_tier1_49" target="_blank" rel="noopener" class="btn-cyan-express-buy">
                                    ⚡ PAY WITH STRIPE / APPLE PAY ($49 USD) →
                                </a>
                                <div class="checkout-payment-methods">
                                    <span>💳 Apple Pay</span> • <span>Google Pay</span> • <span>Visa / MC</span>
                                </div>
                                <div class="checkout-fiduciary-note">
                                    🏛️ 100% Direct Payout to <strong>Keystone Possibilities Ltd.</strong> (Canadian Corporate Account)
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 2. THE 3 DEDICATED PRODUCT SHOWCASE BLOCKS -->
        <section class="protocols-showcase-section">
            <div class="ast-container">

                <!-- PRODUCT 1: $49 ANTIGRAVITY WEBSITE FAST-TRACK BLUEPRINT -->
                <div id="tier-blueprint" class="protocol-product-block">
                    <div class="product-grid">
                        
                        <div class="product-media-col">
                            <div class="video-preview-card">
                                <div class="video-thumb-wrap">
                                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/ai_protocols_banner.png' ); ?>" 
                                         alt="Antigravity Website Fast-Track Video Preview" 
                                         class="video-thumb-img" loading="lazy" />
                                    <div class="video-play-overlay">
                                        <div class="play-circle-btn">▶</div>
                                        <span class="video-runtime-tag">3-MIN BREAKDOWN</span>
                                    </div>
                                </div>
                                <div class="video-card-meta">
                                    <span class="video-title">The Autonomous Website Machine</span>
                                    <span class="video-desc">Watch 16 AI agents rewrite and deploy a complete production site in minutes. (Staged preview player — ready for custom recording).</span>
                                </div>
                            </div>
                        </div>

                        <div class="product-info-col">
                            <div class="product-badge-row">
                                <span class="badge-tier-cyan">TIER 01 // STARTER BLUEPRINT</span>
                                <span class="badge-discount-gold">50% OFF LAUNCH SPECIAL</span>
                            </div>
                            <h2 class="product-title">Antigravity Autonomous Website Fast-Track</h2>
                            <div class="product-price-row">
                                <span class="price-symbol">$</span>
                                <span class="price-val">49</span>
                                <span class="price-currency">USD</span>
                                <span class="price-original"><del>$100</del></span>
                            </div>
                            <p class="product-lead-copy">
                                Stop paying agencies $5,000 to $15,000 for slow template websites. In this comprehensive blueprint and video walkthrough, Wayne reveals how to configure Google Antigravity and autonomous subagents to deploy custom, high-speed, SEO-dominating web platforms in hours.
                            </p>
                            
                            <div class="product-deliverables-box">
                                <h4>📦 What You Receive Instantly:</h4>
                                <ul>
                                    <li><strong>The Multi-Agent Website Prompt Stack:</strong> The exact system prompts that convert raw requirements into production-ready child themes.</li>
                                    <li><strong>Gutenberg AST &amp; Static Templates:</strong> High-performance Gutenberg block patterns and dark luxury CSS design tokens.</li>
                                    <li><strong>Headless Google Search Console Indexing:</strong> Automated Chrome CDP script to request priority indexing in under 60 seconds.</li>
                                    <li><strong>GitHub-to-WordPress Auto-Deploy Pipeline:</strong> Step-by-step WP Pusher webhook deployment guide.</li>
                                    <li><strong>Complete Video Blueprint Walkthrough:</strong> Full recorded masterclass breaking down the architecture.</li>
                                </ul>
                            </div>

                            <div class="product-checkout-box">
                                <a href="https://buy.stripe.com/test_keystone_tier1_49" target="_blank" rel="noopener" class="btn-cyan-buy">
                                    ⚡ GET INSTANT ACCESS ($49 USD) →
                                </a>
                                <div class="checkout-trust-line">
                                    💳 Apple Pay • Google Pay • Visa / MC • 100% Secure Stripe Checkout
                                </div>
                                <span class="delivery-time-tag">⚡ Immediate digital download &amp; license sent to your email</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- PRODUCT 2: $199 AUTONOMOUS 16-AGENT SWARM & B2B OUTREACH ENGINE -->
                <div id="tier-swarm" class="protocol-product-block">
                    <div class="product-grid reverse-on-desktop">
                        
                        <div class="product-media-col">
                            <div class="video-preview-card">
                                <div class="video-thumb-wrap">
                                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/ai_protocols_logo.png' ); ?>" 
                                         alt="16-Agent Swarm Concurrency Video Preview" 
                                         class="video-thumb-img" loading="lazy" />
                                    <div class="video-play-overlay">
                                        <div class="play-circle-btn">▶</div>
                                        <span class="video-runtime-tag">5-MIN BREAKDOWN</span>
                                    </div>
                                </div>
                                <div class="video-card-meta">
                                    <span class="video-title">16-Agent Swarm Concurrency</span>
                                    <span class="video-desc">How specialized trade crews prevent context window collapse. (Staged preview player — ready for custom recording).</span>
                                </div>
                            </div>
                        </div>

                        <div class="product-info-col">
                            <div class="product-badge-row">
                                <span class="badge-tier-cyan">TIER 02 // PRO BUILDER SUITE</span>
                            </div>
                            <h2 class="product-title">Autonomous 16-Agent Swarm &amp; B2B Engine</h2>
                            <div class="product-price-row">
                                <span class="price-symbol">$</span>
                                <span class="price-val">199</span>
                                <span class="price-currency">USD</span>
                            </div>
                            <p class="product-lead-copy">
                                Single-prompt chatbots suffer from context rot: after a few turns, they forget instructions and emit broken code. This turnkey engine provides the full 16-agent concurrency architecture Wayne uses to research municipal permits, execute test-driven code, and automate B2B outreach in parallel.
                            </p>
                            
                            <div class="product-deliverables-box">
                                <h4>📦 What You Receive:</h4>
                                <ul>
                                    <li><strong>The 16-Agent Role Definitions:</strong> Complete configurations for Research Scouts (R1-R3), Test Engineers (B0), Builders (B1-B5), and Outreach Swarms (O1-O5).</li>
                                    <li><strong>FastMCP Typed Tool Contracts:</strong> Zero-hallucination JSON-RPC schemas connecting agents to local files, databases, and APIs.</li>
                                    <li><strong>B2B Lead Engine &amp; DNS MX Verification:</strong> Multi-tier socket verifier that inspects mail exchangers before sending, protecting your domain reputation.</li>
                                    <li><strong>6-Phase TDD Lifecycle Harness:</strong> Forces subagents to write failing unit tests before building, guaranteeing 100% bug-free delivery.</li>
                                    <li><strong>Full Turn-Key GitHub Repository:</strong> Clone, configure your environment, and launch your first swarm in under 15 minutes.</li>
                                </ul>
                            </div>

                            <div class="product-checkout-box">
                                <a href="https://buy.stripe.com/test_keystone_tier2_199" target="_blank" rel="noopener" class="btn-cyan-buy">
                                    🚀 DEPLOY 16-AGENT SWARM ($199 USD) →
                                </a>
                                <div class="checkout-trust-line">
                                    💳 Apple Pay • Google Pay • Visa / MC • 100% Secure Stripe Checkout
                                </div>
                                <span class="delivery-time-tag">⚡ Immediate GitHub repository access &amp; documentation</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- PRODUCT 3: $800 CUSTOM TAURI HUD & SOVEREIGN WORKSTATION ARCHITECTURE -->
                <div id="tier-workstation" class="protocol-product-block featured-product">
                    <div class="product-grid">
                        
                        <div class="product-media-col">
                            <div class="video-preview-card">
                                <div class="video-thumb-wrap">
                                    <img src="<?php echo esc_url( $theme_uri . '/assets/images/wayne_avatar.jpg' ); ?>" 
                                         alt="Sovereign Builder Workstation Tour" 
                                         class="video-thumb-img" loading="lazy" />
                                    <div class="video-play-overlay">
                                        <div class="play-circle-btn">▶</div>
                                        <span class="video-runtime-tag">15-MIN ARCHITECTURE MASTERCLASS</span>
                                    </div>
                                </div>
                                <div class="video-card-meta">
                                    <span class="video-title">The Sovereign Builder Workstation: Physical Building &amp; Machine Intelligence</span>
                                    <span class="video-desc">Comprehensive deep-dive with Wayne Stevenson on custom Tauri workstations, background daemons, and physical construction workflows. (Staged preview player — ready for custom recording).</span>
                                </div>
                            </div>
                        </div>

                        <div class="product-info-col">
                            <div class="product-badge-row">
                                <span class="badge-tier-cyan">TIER 03 // PRIVATE ARCHITECTURE</span>
                                <span class="badge-capacity-alert">STRICTLY CAPPED: 4 CLIENTS / MONTH</span>
                            </div>
                            <h2 class="product-title">Custom Tauri HUD &amp; Sovereign Workstation</h2>
                            <div class="product-price-row">
                                <span class="price-symbol">$</span>
                                <span class="price-val">800</span>
                                <span class="price-currency">USD</span>
                            </div>
                            <p class="product-lead-copy">
                                Relying on cloud AI platforms is like running extension cords to your neighbor's house: when their power trips, your job site goes dark. In this private 1-on-1 engagement, Wayne Stevenson personally configures, compiles, and deploys a bespoke sovereign AI workstation directly onto your local machine.
                            </p>
                            
                            <div class="product-deliverables-box">
                                <h4>🏛️ What You Receive with Wayne:</h4>
                                <ul>
                                    <li><strong>One 60-Minute Focused Architecture Masterclass:</strong> Direct 1-on-1 screen-share architecture and live deployment with Wayne Stevenson (plus dedicated async follow-up deployment support).</li>
                                    <li><strong>Bespoke Tauri Desktop Binary:</strong> Custom Tauri v2 / Rust / Vite desktop interface compiled specifically for your PC.</li>
                                    <li><strong>5 Win32 Detached Background Daemons:</strong> Ports 9876 (STT), 9877 (TTS), 9878 (Vector Brain), 9879 (CDP Overlay), and 9891 (Janitor) running resiliently across restarts.</li>
                                    <li><strong>Local CUDA Faster-Whisper + F9 Push-to-Talk:</strong> Zero-latency voice interface mapped directly to your hardware with zero monthly subscription fees.</li>
                                    <li><strong>Tailored Business Integration:</strong> Calibrated to your exact industry (construction estimates, CAD analysis, video production, or financial workflows).</li>
                                </ul>
                            </div>

                            <div class="product-checkout-box">
                                <a href="/contact/" class="btn-gold-buy">
                                    🤝 APPLY FOR PRIVATE ARCHITECTURE ($800 USD) →
                                </a>
                                <div class="checkout-trust-line">
                                    🏛️ Private intake application reviewed directly by Wayne Stevenson
                                </div>
                                <span class="delivery-time-tag">Direct scheduling link sent immediately upon acceptance</span>
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
                        <h3 class="matrix-title">Why We Choose Google Antigravity &amp; FastMCP over Claude Code</h3>
                        <p class="matrix-desc">
                            "When you pour concrete or frame high-load timber structures, you learn that unreliable tools cost fortunes. In software and AI swarms, the principle is identical." — Wayne Stevenson
                        </p>
                    </div>
                    <div class="matrix-grid">
                        <div class="matrix-col">
                            <h4>⚡ Context Capacity (2,000,000 Tokens)</h4>
                            <p>Gemini provides up to <strong>2M tokens of context</strong>, allowing you to feed entire building code books, 50-page blueprints, and complete multi-folder repositories simultaneously. Claude Code is constrained to 200k tokens, forcing lossy file exclusions.</p>
                        </div>
                        <div class="matrix-col">
                            <h4>🛡️ Zero Rate-Limit Lockouts</h4>
                            <p>High-cadence builders cannot afford Claude's infamous <strong>5-hour rolling lockouts</strong> in the middle of a project sprint. Antigravity's generous tiers keep your agent swarms executing continuously.</p>
                        </div>
                        <div class="matrix-col">
                            <h4>💰 10x to 30x Token Economics</h4>
                            <p>Gemini Flash costs <strong>$0.10 to $0.30 per million tokens</strong> ($0.03 cached) compared to Claude Sonnet's $3.00 input and $15.00 output. Running complex 16-agent swarms is mathematically viable instead of a financial drain.</p>
                        </div>
                        <div class="matrix-col">
                            <h4>🌐 Native Browser &amp; Google Ecosystem</h4>
                            <p>Direct <strong>Chrome CDP (Port 9222)</strong> headless automation, automated Google Search Console submission, and native Google Drive, Docs, and Calendar tools that isolated terminal CLIs cannot touch.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Interactive Express Checkout & Promo Code Engine -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tierBtns = document.querySelectorAll('.tier-select-btn');
    const expressBuyBtn = document.getElementById('portalExpressBuyBtn');
    const promoInput = document.getElementById('promoInput');
    const applyPromoBtn = document.getElementById('applyPromoBtn');
    const promoFeedback = document.getElementById('promoFeedback');

    let activeTier = 1;
    let activePrice = 49;
    let activeUrl = 'https://buy.stripe.com/test_keystone_tier1_49';
    let discount = 0;

    const promoCodes = {
        'BUILDER10': 10,
        'WAYNE10': 10,
        'KEYSTONE20': 20,
        'PROMO2026': 15
    };

    function updateCTA() {
        if (!expressBuyBtn) return;
        const finalPrice = Math.max(0, activePrice - discount);
        if (activeTier === 3) {
            expressBuyBtn.textContent = '🤝 APPLY FOR PRIVATE ARCHITECTURE ($800 USD) →';
            expressBuyBtn.href = '/contact/';
            expressBuyBtn.className = 'btn-cyan-express-buy btn-gold-portal';
        } else {
            expressBuyBtn.textContent = `⚡ PAY WITH STRIPE / APPLE PAY ($${finalPrice} USD) →`;
            expressBuyBtn.href = activeUrl;
            expressBuyBtn.className = 'btn-cyan-express-buy';
        }
    }

    tierBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            tierBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeTier = parseInt(this.getAttribute('data-tier'), 10);
            activePrice = parseInt(this.getAttribute('data-price'), 10);
            activeUrl = this.getAttribute('data-url');
            updateCTA();
        });
    });

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
});
</script>

<?php
get_footer();
