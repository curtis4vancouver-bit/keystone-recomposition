<?php
/**
 * The template for displaying the Keystone Recomposition Cyber-Celestial Home Page
 *
 * @package Keystone Recomposition Child
 * @since 3.4.0 (Cyber-Celestial Real Audio & Multi-Agent Monetization Edition)
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$theme_uri = get_stylesheet_directory_uri();
?>

<div id="primary" class="content-area primary keystone-cyber-home">
    <main id="main" class="site-main">

        <!-- 1. HERO ORCHESTRATION SECTION -->
        <section class="cyber-hero-section">
            <div class="ast-container">
                <div class="cyber-hero-wrap text-center">
                    
                    <!-- FastMCP Telemetry Pill -->
                    <div class="cyber-telemetry-pill">
                        <span class="telemetry-pulse"></span>
                        <span class="telemetry-text">// AUTONOMOUS AI ARCHITECTURE • 16 AGENTS ACTIVE • HIGH-CADENCE BUILDER</span>
                    </div>

                    <!-- Founder Verification Chip -->
                    <div class="cyber-founder-chip">
                        <img src="<?php echo esc_url( $theme_uri . '/assets/images/wayne_avatar.jpg' ); ?>" 
                             alt="Wayne Stevenson — Founder &amp; Architect" 
                             class="founder-chip-avatar" 
                             width="52" height="52" loading="eager" decoding="async" />
                        <div class="founder-chip-meta">
                            <span class="chip-name">Wayne Stevenson</span>
                            <span class="chip-role">AI Systems Architect • Music Producer • BC Builder #52603</span>
                        </div>
                        <span class="chip-verified-badge">✔ VERIFIED</span>
                    </div>
                    
                    <h1 class="cyber-hero-title">
                        Where Autonomous Machine Intelligence<br/>
                        <span class="cyan-gradient-text">Meets Real-World Building &amp; Sound</span>
                    </h1>
                    
                    <p class="cyber-hero-subtitle">
                        The sovereign digital headquarters of Wayne Stevenson — showing how a licensed builder uses autonomous multi-agent engineering, FastMCP server infrastructure, and an 18-album electronic music universe to scale high-cadence companies.
                    </p>

                    <div class="cyber-cta-group">
                        <a href="#sound-lab" class="btn-cyan-primary">
                            ⚡ Engage Sound Lab
                        </a>
                        <a href="/sonic-universe/" class="btn-glass-secondary">
                            🎵 Stream 18 Albums
                        </a>
                        <a href="#ai-funnel" class="btn-gold-subtle">
                            🚀 AI Agent Blueprints ($49)
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <!-- 2. INTERACTIVE CYBER SOUND LAB ENGINE (REAL AUDIO STREAMING) -->
        <section id="sound-lab" class="cyber-sound-lab-section">
            <div class="ast-container">
                
                <div class="sound-lab-card">
                    <!-- Corner HUD Reticles -->
                    <div class="hud-corner hud-tl"></div>
                    <div class="hud-corner hud-tr"></div>
                    <div class="hud-corner hud-bl"></div>
                    <div class="hud-corner hud-br"></div>

                    <!-- Hidden HTML5 Audio Element for Real Music Streaming -->
                    <audio id="cyberAudio" preload="auto" crossorigin="anonymous"></audio>

                    <div class="sound-lab-header">
                        <div class="sound-lab-meta">
                            <span class="lab-live-badge">● LIVE ENGINE</span>
                            <span class="lab-freq-badge">96kHz • 24-BIT MASTER STUDIO</span>
                        </div>
                        <h2 class="sound-lab-title">Bio-Acoustic Frequency Synthesizer</h2>
                        <p class="sound-lab-desc">
                            Stream real master recordings from Wayne Stevenson's catalog with 60fps Web Audio frequency spectrum analysis engineered for deep-focus agentic coding.
                        </p>
                    </div>

                    <!-- HTML5 60fps Canvas Visualizer -->
                    <div class="visualizer-wrapper">
                        <canvas id="cyberVisualizer" width="1000" height="240"></canvas>
                        <div class="visualizer-hud-overlay">
                            <div class="track-info">
                                <span class="track-label">NOW STREAMING:</span>
                                <span id="currentTrackTitle" class="track-name">Builder in the Pines (Deep House • 122 BPM)</span>
                            </div>
                            <div class="engine-state">
                                <span id="engineStateBadge" class="engine-idle">STANDBY</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tactile Control Deck -->
                    <div class="sound-lab-controls">
                        <button id="cyberPlayBtn" class="cyber-play-button" aria-label="Play or Pause Sound Lab Engine">
                            <span id="playIcon">▶</span>
                            <span id="playLabel">INITIATE REAL MUSIC STREAM</span>
                        </button>

                        <div class="track-chips-matrix">
                            <button class="track-chip active" onclick="switchTrack('Builder in the Pines', 'Deep House • 122 BPM • Organic Cello', 0)">
                                01 • Builder in the Pines
                            </button>
                            <button class="track-chip" onclick="switchTrack('Squamish Monolith', 'Melodic Techno • 124 BPM • Analog Moog', 1)">
                                02 • Squamish Monolith
                            </button>
                            <button class="track-chip" onclick="switchTrack('Antigravity Chronicles', 'Ambient Brain • 118 BPM • FastMCP Core', 2)">
                                03 • Antigravity Chronicles
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- 3. MASTER STUDIO ALBUMS (RICH PHOTOGRAPHY & ARTWORK) -->
        <section class="cyber-albums-section">
            <div class="ast-container">
                
                <div class="section-header text-center">
                    <span class="cyber-section-tag">OFFICIAL ARTIST CATALOG</span>
                    <h2 class="cyber-section-title">Latest Master Studio Releases</h2>
                    <p class="cyber-section-desc">
                        18 complete albums | 196 canonical tracks registered with TooLost Digital &amp; distributed worldwide on Spotify, Apple Music &amp; YouTube Music.
                    </p>
                </div>

                <div class="albums-grid">
                    
                    <!-- Album 1: Builder in the Pines -->
                    <div class="cyber-album-card" onclick="loadAndPlayAlbum(0, 'Builder in the Pines', 'Deep House • 122 BPM • Organic Cello')">
                        <div class="album-media-box">
                            <img src="<?php echo esc_url( $theme_uri . '/assets/images/sonic_universe_banner.png' ); ?>" 
                                 alt="Builder in the Pines Album Cover Art" 
                                 class="album-cover-img" loading="lazy" decoding="async" />
                            <div class="album-media-overlay"></div>
                            <span class="album-format-pill">VOL. 01 • 96kHz</span>
                            <div class="album-vinyl-preview"></div>
                        </div>
                        <div class="album-card-body">
                            <div class="album-genre-meta">
                                <span class="genre-tag">DEEP HOUSE • 122 BPM</span>
                                <span class="lossless-tag">★ LOSSLESS</span>
                            </div>
                            <h3 class="album-card-title">Builder in the Pines</h3>
                            <p class="album-card-desc">
                                Organic cello and soaring violin arrangements recorded against old-growth timber, engineered for sustained creative focus.
                            </p>
                            <div class="album-action-row">
                                <span class="album-stream-prompt">⚡ Play Real Stream</span>
                                <a href="/intel/" class="album-details-link">Read Intel Protocol →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Album 2: Squamish Monolith -->
                    <div class="cyber-album-card" onclick="loadAndPlayAlbum(1, 'Squamish Monolith', 'Melodic Techno • 124 BPM • Analog Moog')">
                        <div class="album-media-box">
                            <img src="<?php echo esc_url( $theme_uri . '/assets/images/ai_protocols_banner.png' ); ?>" 
                                 alt="Squamish Monolith Album Cover Art" 
                                 class="album-cover-img" loading="lazy" decoding="async" />
                            <div class="album-media-overlay"></div>
                            <span class="album-format-pill">VOL. 02 • 96kHz</span>
                            <div class="album-vinyl-preview"></div>
                        </div>
                        <div class="album-card-body">
                            <div class="album-genre-meta">
                                <span class="genre-tag">MELODIC TECHNO • 124 BPM</span>
                                <span class="lossless-tag">★ LOSSLESS</span>
                            </div>
                            <h3 class="album-card-title">Squamish Monolith</h3>
                            <p class="album-card-desc">
                                Analog Moog basslines and crisp metallic transient attacks driving high-cadence evening building and flow states.
                            </p>
                            <div class="album-action-row">
                                <span class="album-stream-prompt">⚡ Play Real Stream</span>
                                <a href="/intel/" class="album-details-link">Read Intel Protocol →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Album 3: Antigravity Chronicles -->
                    <div class="cyber-album-card" onclick="loadAndPlayAlbum(2, 'Antigravity Chronicles', 'Ambient Brain • 118 BPM • FastMCP Core')">
                        <div class="album-media-box">
                            <img src="<?php echo esc_url( $theme_uri . '/assets/images/sonic_universe_banner.png' ); ?>" 
                                 alt="Antigravity Chronicles Album Cover Art" 
                                 class="album-cover-img" loading="lazy" decoding="async" />
                            <div class="album-media-overlay"></div>
                            <span class="album-format-pill">VOL. 03 • 96kHz</span>
                            <div class="album-vinyl-preview"></div>
                        </div>
                        <div class="album-card-body">
                            <div class="album-genre-meta">
                                <span class="genre-tag">AMBIENT BRAIN • 118 BPM</span>
                                <span class="lossless-tag">★ LOSSLESS</span>
                            </div>
                            <h3 class="album-card-title">Antigravity Chronicles</h3>
                            <p class="album-card-desc">
                                Binaural algorithmic pulses and modular synth pads calibrated specifically for multi-agent autonomous software development.
                            </p>
                            <div class="album-action-row">
                                <span class="album-stream-prompt">⚡ Play Real Stream</span>
                                <a href="/intel/" class="album-details-link">Read Intel Protocol →</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="albums-footer-cta text-center">
                    <a href="/sonic-universe/" class="btn-glass-secondary">
                        🎵 Explore All 18 Studio Albums in Sonic Universe →
                    </a>
                </div>

            </div>
        </section>

        <!-- 4. MONETIZATION & CONVERSION ENGINE (3-TIER BLUEPRINTS & STRIPE CHECKOUT) -->
        <section id="ai-funnel" class="cyber-pricing-section">
            <div class="ast-container">
                
                <div class="section-header text-center">
                    <span class="cyber-section-tag">AGENTIC ENGINEERING BLUEPRINTS</span>
                    <h2 class="cyber-section-title">Autonomous AI Protocols &amp; Workstations</h2>
                    <p class="cyber-section-desc">
                        Direct access to Wayne Stevenson's production FastMCP architectures, agent swarms, and turn-key deployment blueprints.
                    </p>
                </div>

                <div class="pricing-tiers-grid">
                    
                    <!-- Tier 1: $49 Starter Fast-Track Blueprint -->
                    <div class="tier-card featured-tier">
                        <div class="tier-badge-glow">MOST POPULAR • 50% OFF</div>
                        <div class="tier-header">
                            <span class="tier-level">TIER 01 // STARTER BLUEPRINT</span>
                            <h3 class="tier-name">Antigravity Website Fast-Track</h3>
                            <div class="tier-price-box">
                                <span class="currency">$</span>
                                <span class="amount">49</span>
                                <span class="currency-tag">USD</span>
                                <span class="regular-price"><del>$100</del></span>
                            </div>
                            <p class="tier-tagline">
                                Complete turn-key training &amp; template to build and deploy a modern full-stack website using Google Antigravity &amp; AI swarms.
                            </p>
                            
                            <!-- Video Breakdown Badge -->
                            <div class="tier-video-pill">
                                <span>▶</span> Includes 3-Min Multi-Agent Video Breakdown
                            </div>
                        </div>
                        <ul class="tier-features-list">
                            <li><span>✔</span> Full video walkthrough of building websites from scratch with Antigravity</li>
                            <li><span>✔</span> Production prompt library &amp; multi-agent configuration recipes</li>
                            <li><span>✔</span> Headless Gutenberg AST schemas &amp; automated GSC indexing scripts</li>
                            <li><span>✔</span> Complete source code template &amp; deployment checklist</li>
                            <li><span>✔</span> Direct email delivery within 60 seconds of checkout</li>
                        </ul>
                        <div class="tier-action">
                            <a href="https://buy.stripe.com/test_keystone_tier1_49" target="_blank" rel="noopener" class="btn-tier-action btn-gold-filled">
                                ⚡ BUY BLUEPRINT — $49 USD →
                            </a>
                            <div class="payment-trust-badge">
                                💳 Apple Pay • Google Pay • Visa/MC • Instant Deposit
                            </div>
                            <span class="instant-delivery-note">⚡ 100% Direct bank deposit via Stripe</span>
                        </div>
                    </div>

                    <!-- Tier 2: $199 Pro Autonomous Suite -->
                    <div class="tier-card">
                        <div class="tier-header">
                            <span class="tier-level">TIER 02 // PRO BUILDER</span>
                            <h3 class="tier-name">Autonomous 16-Agent Swarm &amp; B2B Engine</h3>
                            <div class="tier-price-box">
                                <span class="currency">$</span>
                                <span class="amount">199</span>
                                <span class="currency-tag">USD</span>
                            </div>
                            <p class="tier-tagline">
                                Full-cadence multi-agent research swarms, automated B2B outreach pipelines, and FastMCP tool integration.
                            </p>
                            
                            <!-- Video Breakdown Badge -->
                            <div class="tier-video-pill">
                                <span>▶</span> Includes 5-Min 16-Agent Concurrency Video Breakdown
                            </div>
                        </div>
                        <ul class="tier-features-list">
                            <li><span>✔</span> 16-agent research &amp; coding swarm orchestration templates (R1-R3, B0-B5)</li>
                            <li><span>✔</span> Autonomous B2B lead generation &amp; DNS MX verification pipeline</li>
                            <li><span>✔</span> FastMCP JSON-RPC server contracts with zero cloud lock-in</li>
                            <li><span>✔</span> 6-Phase TDD lifecycle blueprint forcing red-to-green test passes</li>
                            <li><span>✔</span> Complete GitHub template repo with turn-key setup scripts</li>
                        </ul>
                        <div class="tier-action">
                            <a href="https://buy.stripe.com/test_keystone_tier2_199" target="_blank" rel="noopener" class="btn-tier-action btn-cyan-glass">
                                🚀 DEPLOY 16-AGENT SWARM — $199 USD →
                            </a>
                            <div class="payment-trust-badge">
                                💳 Apple Pay • Google Pay • Visa/MC • Instant Deposit
                            </div>
                            <span class="instant-delivery-note">⚡ Direct bank deposit via Stripe</span>
                        </div>
                    </div>

                    <!-- Tier 3: $800 Custom Workstation & Torii HUD (Wayne Stevenson Direct) -->
                    <div class="tier-card">
                        <div class="tier-header">
                            <span class="tier-level">TIER 03 // ENTERPRISE ARCHITECTURE</span>
                            <h3 class="tier-name">Custom Torii HUD &amp; Workstation</h3>
                            <div class="tier-price-box">
                                <span class="currency">$</span>
                                <span class="amount">800</span>
                                <span class="currency-tag">USD</span>
                            </div>
                            <p class="tier-tagline">
                                Dedicated 1-on-1 private architecture by Wayne Stevenson: custom desktop HUD workstation, daemons, and tailored agentic models.
                            </p>
                            
                            <!-- Video Breakdown Badge -->
                            <div class="tier-video-pill">
                                <span>▶</span> Includes 4-Min Live Workstation Tour &amp; Case Study
                            </div>
                        </div>
                        <ul class="tier-features-list">
                            <li><span>✔</span> Two 90-minute private 1-on-1 remote engineering sessions with Wayne</li>
                            <li><span>✔</span> Bespoke desktop HUD control center (Tauri / Rust / WebSockets) compiled for your machine</li>
                            <li><span>✔</span> 5 detached Windows OS background daemons (:9876-:9879)</li>
                            <li><span>✔</span> Local CUDA Faster-Whisper + F9 push-to-talk voice interface</li>
                            <li><span>✔</span> Direct integration into your business workflows (construction, CAD, video, CRM)</li>
                        </ul>
                        <div class="tier-action">
                            <a href="/contact/" class="btn-tier-action btn-cyan-glass">
                                🤝 BOOK PRIVATE ARCHITECTURE ($800 USD) →
                            </a>
                            <div class="payment-trust-badge">
                                🏛️ Strictly Limited to 4 Clients / Month
                            </div>
                            <span class="instant-delivery-note">Screen-share build directly on your machine</span>
                        </div>
                    </div>

                </div>

                <!-- Google Universe vs Claude Code Comparison Callout -->
                <div class="competitive-matrix-card">
                    <div class="matrix-header">
                        <span class="matrix-tag">BUILDER BENCHMARK</span>
                        <h3 class="matrix-title">Why We Choose Google Antigravity over Claude Code &amp; Cursor</h3>
                        <p class="matrix-desc">
                            "On a real construction site, stalling out mid-pour because of a metered quota is intolerable. Here is why high-cadence builders run on Google Antigravity &amp; FastMCP." — Wayne Stevenson
                        </p>
                    </div>
                    <div class="matrix-grid">
                        <div class="matrix-col">
                            <h4>⚡ Context Capacity</h4>
                            <p><strong>1,000,000 to 2,000,000 tokens</strong> in Gemini vs 200,000 in Claude Code. Ingest entire building codes, CAD drawings, and full codebases concurrently without lossy truncation.</p>
                        </div>
                        <div class="matrix-col">
                            <h4>🛡️ Unbroken Continuity</h4>
                            <p>Generous multi-agent plan quotas with <strong>zero 5-hour rate-limit lockouts</strong> that shut down competing terminal tools mid-execution.</p>
                        </div>
                        <div class="matrix-col">
                            <h4>💰 10x-30x Token Economics</h4>
                            <p>Gemini Flash at <strong>$0.10–$0.30 per 1M tokens</strong> vs Claude Sonnet at $3.00–$15.00. Multi-agent swarm loops become mathematically practical instead of cost-prohibitive.</p>
                        </div>
                        <div class="matrix-col">
                            <h4>🌐 Native Browser &amp; Workspace</h4>
                            <p>Native <strong>Chrome CDP (Port 9222)</strong> live DOM automation and direct Google Workspace integration (Drive, Docs, Sheets, Calendar) vs isolated terminal sandboxes.</p>
                        </div>
                    </div>
                    <div class="matrix-footer-cta text-center">
                        <a href="/ai-protocols/" class="btn-cyan-primary">
                            Explore Detailed AI Protocols &amp; Video Walkthroughs →
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- 5. TECHNICAL INTEL ARTICLES PREVIEW -->
        <section class="cyber-intel-section">
            <div class="ast-container">
                <div class="section-header text-center">
                    <span class="cyber-section-tag">ENGINEERING DISPATCHES</span>
                    <h2 class="cyber-section-title">Technical Protocols &amp; Intelligence</h2>
                    <p class="cyber-section-desc">
                        Deep architectural breakdowns on agentic coding, Chrome CDP automation, and bio-acoustic sound design.
                    </p>
                </div>

                <div class="intel-articles-grid">
                    
                    <!-- Article 1 -->
                    <article class="cyber-intel-card">
                        <div class="intel-card-meta">
                            <span class="intel-category">AUTONOMOUS AGENTS</span>
                            <span class="intel-date">SEPT 2026</span>
                        </div>
                        <h3 class="intel-title">
                            <a href="/intel/">Architecting 16-Agent Concurrency Swarms on Port 9879</a>
                        </h3>
                        <p class="intel-excerpt">
                            How we isolate research scouts, test-driven engineers, and live browsers across detached background daemons without thread collisions.
                        </p>
                        <div class="intel-card-footer">
                            <a href="/intel/" class="intel-read-more">Read Technical Protocol →</a>
                        </div>
                    </article>

                    <!-- Article 2 -->
                    <article class="cyber-intel-card">
                        <div class="intel-card-meta">
                            <span class="intel-category">DEVTOOLS CDP</span>
                            <span class="intel-date">SEPT 2026</span>
                        </div>
                        <h3 class="intel-title">
                            <a href="/intel/">Headless DOM Automation &amp; Instant Google Indexing</a>
                        </h3>
                        <p class="intel-excerpt">
                            Bypassing brittle web drivers: connecting autonomous subagents directly to Chrome Port 9222 for zero-fallback publishing.
                        </p>
                        <div class="intel-card-footer">
                            <a href="/intel/" class="intel-read-more">Read Technical Protocol →</a>
                        </div>
                    </article>

                    <!-- Article 3 -->
                    <article class="cyber-intel-card">
                        <div class="intel-card-meta">
                            <span class="intel-category">BIO-ACOUSTIC SOUND</span>
                            <span class="intel-date">SEPT 2026</span>
                        </div>
                        <h3 class="intel-title">
                            <a href="/intel/">Binaural Audio Synthesis for Sustained High-Cadence Focus</a>
                        </h3>
                        <p class="intel-excerpt">
                            Engineering deep-house frequency harmonics and analog Moog basslines to prevent cognitive fatigue during complex builds.
                        </p>
                        <div class="intel-card-footer">
                            <a href="/intel/" class="intel-read-more">Read Technical Protocol →</a>
                        </div>
                    </article>

                </div>
            </div>
        </section>

        <!-- 6. FOUNDER PROFILE & DUAL-PILLAR DOSSIER -->
        <section class="cyber-founder-section">
            <div class="ast-container">
                <div class="founder-profile-card">
                    
                    <div class="founder-card-inner">
                        
                        <div class="founder-photo-col">
                            <div class="founder-photo-frame">
                                <img src="<?php echo esc_url( $theme_uri . '/assets/images/wayne_avatar.jpg' ); ?>" 
                                     alt="Wayne Stevenson — Founder &amp; Architect" 
                                     class="founder-portrait-img" loading="lazy" decoding="async" />
                                <div class="founder-photo-glow"></div>
                            </div>
                            <div class="founder-credentials-stack">
                                <span class="cred-pill">🏛️ BC Housing Builder #52603</span>
                                <span class="cred-pill">⚡ FastMCP Architect</span>
                                <span class="cred-pill">🎵 18 Studio Albums</span>
                            </div>
                        </div>

                        <div class="founder-bio-col">
                            <span class="cyber-section-tag">THE ARCHITECT</span>
                            <h2 class="founder-name-heading">Wayne Stevenson</h2>
                            <p class="founder-lead-para">
                                "Machine intelligence without physical grounding is hallucination. Every line of code, every agentic swarm, and every bio-acoustic frequency I engineer is rooted in the rigorous discipline of real-world master building."
                            </p>
                            <p class="founder-detail-para">
                                Beyond autonomous software engineering and 196 registered electronic master recordings, Wayne Stevenson is the founder of <strong>Keystone Possibilities Ltd.</strong>, a licensed British Columbia residential builder delivering high-performance custom mountain residences and municipal infill across the Sea-to-Sky corridor.
                            </p>
                            <div class="founder-actions-row">
                                <a href="/about-the-founder/" class="btn-cyan-primary">
                                    Read Full Founder Dossier →
                                </a>
                                <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener" class="btn-glass-secondary">
                                    Visit Keystone Possibilities Ltd. ↗
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- 7. SOVEREIGN AI & MUSIC ECOSYSTEM FOOTER -->
        <section class="keystone-geo-footer-mesh">
            <div class="ast-container">
                
                <!-- Copyright Line -->
                <div class="footer-copyright-center">
                    Copyright Keystone Possibilities Ltd &amp; Keystone Recomposition 2023-2026, All Rights Reserved.
                </div>

                <!-- 4-Column Sovereign AI & Music Matrix -->
                <div class="regional-divisions-wrap">
                    <div class="regional-header-cyan">
                        <span>⚡</span> KEYSTONE RECOMPOSITION — AUTONOMOUS AI &amp; SONIC ARCHITECTURE
                    </div>
                    <div class="regional-divisions-grid">
                        
                        <!-- Column 1: Autonomous AI Protocols -->
                        <div class="regional-col">
                            <strong>Autonomous AI Protocols:</strong>
                            <a href="/ai-protocols/">• Antigravity Workstation Blueprint</a>
                            <a href="/ai-protocols/">• 16-Agent FastMCP Swarms</a>
                            <a href="/ai-protocols/">• Chrome CDP Stream Automation</a>
                            <a href="/ai-protocols/">• High-Cadence Builder Workflows</a>
                        </div>

                        <!-- Column 2: Sonic Universe Discography -->
                        <div class="regional-col">
                            <strong>Sonic Universe Discography:</strong>
                            <a href="/sonic-universe/">• Builder in the Pines (Deep House)</a>
                            <a href="/sonic-universe/">• Squamish Monolith (Melodic Techno)</a>
                            <a href="/sonic-universe/">• Antigravity Chronicles (Ambient Brain)</a>
                            <a href="/sonic-universe/">• TooLost Worldwide Distribution</a>
                        </div>

                        <!-- Column 3: Intelligence & Architecture -->
                        <div class="regional-col">
                            <strong>Intelligence &amp; Architecture:</strong>
                            <a href="/intel/">• INTEL Technical Protocol Dispatches</a>
                            <a href="/about-the-founder/">• The Architect Dossier</a>
                            <a href="/ai-protocols/">• Multi-Agent Systems Consulting</a>
                            <a href="/intel/">• Bio-Acoustic Frequency Research</a>
                        </div>

                        <!-- Column 4: Governance & Sister Flagship -->
                        <div class="regional-col">
                            <strong>Governance &amp; Sister Flagship:</strong>
                            <span class="authority-badge-text">Wayne Stevenson // Architect</span>
                            <span class="verification-status-text">BC Housing Builder #52603</span>
                            <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener" style="color: #f6d365 !important; font-weight: 600;">• Keystone Possibilities Ltd. ↗</a>
                            <a href="/contact/" class="consultation-link">• Schedule Private Consultation</a>
                        </div>

                    </div>
                </div>

                <!-- Bottom Keystone Empire Network Bar -->
                <div class="empire-network-bar">
                    <div class="network-title-line">
                        <span class="network-title-gold">⚔️ KEYSTONE EMPIRE NETWORK</span> | Keystone Recomposition — Evidence-Based AI Systems &amp; Sonic Architecture
                    </div>
                    <div class="network-sister-link">
                        Sister Flagship: <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener">Keystone Possibilities Ltd. — Licensed Residential Builder #52603 &amp; BC Hydro Utility Contractor →</a>
                    </div>
                </div>

            </div>
        </section>

    </main>
</div>

<!-- Web Audio API Interactive Sound Lab Engine Script (Real Music Streaming & Reactive Analyser) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Audio Tracks Configuration
    const trackList = [
        {
            title: 'Builder in the Pines',
            meta: 'Deep House • 122 BPM • Organic Cello',
            url: '<?php echo esc_url( $theme_uri . "/assets/audio/track1_steady_incline.mp3" ); ?>',
            freq: 220
        },
        {
            title: 'Squamish Monolith',
            meta: 'Melodic Techno • 124 BPM • Analog Moog',
            url: '<?php echo esc_url( $theme_uri . "/assets/audio/track2_fluid_dynamics.mp3" ); ?>',
            freq: 174
        },
        {
            title: 'Antigravity Chronicles',
            meta: 'Ambient Brain • 118 BPM • FastMCP Core',
            url: '<?php echo esc_url( $theme_uri . "/assets/audio/track3_tier_one_flow.mp3" ); ?>',
            freq: 261
        }
    ];

    let currentTrackIdx = 0;
    let isPlaying = false;
    let audioCtx = null;
    let audioEl = document.getElementById('cyberAudio');
    let audioSource = null;
    let analyser = null;
    let freqData = null;

    // Synthetic fallback tone if browser policy blocks audio element
    let currentOsc1 = null;
    let currentOsc2 = null;
    let currentGain = null;

    // 2. 60fps Canvas Neural Visualizer
    const canvas = document.getElementById('cyberVisualizer');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let width = canvas.width = canvas.offsetWidth;
    let height = canvas.height = canvas.offsetHeight;

    window.addEventListener('resize', function() {
        if (canvas) {
            width = canvas.width = canvas.offsetWidth;
            height = canvas.height = canvas.offsetHeight;
        }
    });

    // Particle nodes network
    const nodeCount = 32;
    const nodes = [];
    for (let i = 0; i < nodeCount; i++) {
        nodes.push({
            x: Math.random() * width,
            y: Math.random() * height,
            vx: (Math.random() - 0.5) * 1.5,
            vy: (Math.random() - 0.5) * 1.5,
            radius: Math.random() * 3 + 2,
            pulse: Math.random() * Math.PI
        });
    }

    function initWebAudio() {
        if (!audioCtx) {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            audioCtx = new AudioContext();
        }
        if (audioCtx.state === 'suspended') {
            audioCtx.resume();
        }
        if (!analyser) {
            analyser = audioCtx.createAnalyser();
            analyser.fftSize = 128;
            analyser.smoothingTimeConstant = 0.8;
            freqData = new Uint8Array(analyser.frequencyBinCount);
        }
        if (audioEl && !audioSource) {
            try {
                audioSource = audioCtx.createMediaElementSource(audioEl);
                audioSource.connect(analyser);
                analyser.connect(audioCtx.destination);
            } catch (err) {
                console.log('MediaElementSource connection note:', err);
            }
        }
    }

    function renderFrame() {
        ctx.clearRect(0, 0, width, height);

        const time = Date.now() * 0.004;
        let avgEnergy = 0.35;

        // Extract real frequency data if streaming
        if (analyser && isPlaying && freqData) {
            analyser.getByteFrequencyData(freqData);
            let sum = 0;
            for (let k = 0; k < freqData.length; k++) {
                sum += freqData[k];
            }
            avgEnergy = (sum / (freqData.length * 255));
        }

        // Draw dynamic reactive frequency bars at bottom when active
        if (isPlaying) {
            const barCount = 48;
            const barWidth = width / barCount;
            for (let b = 0; b < barCount; b++) {
                let barHeight = 12;
                if (freqData && freqData.length > 0) {
                    const binVal = freqData[b % freqData.length] / 255;
                    barHeight = binVal * 65 + 10;
                } else {
                    barHeight = Math.abs(Math.sin(time * 2.5 + b * 0.35)) * 45 + Math.cos(time + b * 0.2) * 15 + 10;
                }
                const grad = ctx.createLinearGradient(0, height, 0, height - barHeight);
                grad.addColorStop(0, 'rgba(56, 189, 248, 0.45)');
                grad.addColorStop(1, 'rgba(0, 240, 255, 0.0)');
                ctx.fillStyle = grad;
                ctx.fillRect(b * barWidth, height - barHeight, barWidth - 2, barHeight);
            }
        }

        // Draw connections with dynamic bounce synced to real audio energy
        for (let i = 0; i < nodes.length; i++) {
            for (let j = i + 1; j < nodes.length; j++) {
                const bounceI = isPlaying ? Math.sin(time * 3 + nodes[i].pulse) * (10 + avgEnergy * 18) : 0;
                const bounceJ = isPlaying ? Math.sin(time * 3 + nodes[j].pulse) * (10 + avgEnergy * 18) : 0;
                const yI = nodes[i].y + bounceI;
                const yJ = nodes[j].y + bounceJ;

                const dx = nodes[i].x - nodes[j].x;
                const dy = yI - yJ;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 130) {
                    const alpha = (1 - dist / 130) * (isPlaying ? (0.5 + avgEnergy * 0.4) : 0.25);
                    ctx.strokeStyle = 'rgba(56, 189, 248, ' + alpha + ')';
                    ctx.lineWidth = isPlaying ? (1 + avgEnergy * 1.5) : 1;
                    ctx.beginPath();
                    ctx.moveTo(nodes[i].x, yI);
                    ctx.lineTo(nodes[j].x, yJ);
                    ctx.stroke();
                }
            }
        }

        // Draw bouncing nodes
        for (let i = 0; i < nodes.length; i++) {
            const n = nodes[i];
            const speedMult = isPlaying ? (1.5 + avgEnergy * 1.5) : 0.8;
            n.x += n.vx * speedMult;
            n.y += n.vy * speedMult;

            if (n.x < 0 || n.x > width) n.vx *= -1;
            if (n.y < 0 || n.y > height) n.vy *= -1;

            const bounce = isPlaying ? Math.sin(time * 3 + n.pulse) * (10 + avgEnergy * 18) : 0;
            const currentY = Math.max(10, Math.min(height - 10, n.y + bounce));
            const currentRadius = n.radius * (isPlaying ? (1.2 + avgEnergy * 0.8) : 1.0);

            ctx.beginPath();
            ctx.arc(n.x, currentY, currentRadius, 0, Math.PI * 2);
            ctx.fillStyle = isPlaying ? '#38bdf8' : 'rgba(56, 189, 248, 0.4)';
            ctx.shadowColor = '#00f0ff';
            ctx.shadowBlur = isPlaying ? (12 + avgEnergy * 16) : 4;
            ctx.fill();
            ctx.shadowBlur = 0;
        }

        requestAnimationFrame(renderFrame);
    }
    requestAnimationFrame(renderFrame);

    // Audio Engine Controls
    const playBtn = document.getElementById('cyberPlayBtn');
    const playIcon = document.getElementById('playIcon');
    const playLabel = document.getElementById('playLabel');
    const engineBadge = document.getElementById('engineStateBadge');

    function playActiveTrack() {
        initWebAudio();
        const track = trackList[currentTrackIdx];
        if (audioEl) {
            if (audioEl.src !== track.url) {
                audioEl.src = track.url;
            }
            audioEl.play().then(() => {
                isPlaying = true;
                updateUIAfterPlay();
            }).catch(e => {
                console.log('Real audio play blocked or loading error, falling back to harmonic synth:', e);
                isPlaying = true;
                startSyntheticTone(track.freq);
                updateUIAfterPlay();
            });
        } else {
            isPlaying = true;
            startSyntheticTone(track.freq);
            updateUIAfterPlay();
        }
    }

    function pauseActiveTrack() {
        if (audioEl) {
            audioEl.pause();
        }
        stopSyntheticTone();
        isPlaying = false;
        playIcon.textContent = '▶';
        playLabel.textContent = 'RESUME REAL MUSIC STREAM';
        engineBadge.textContent = 'STANDBY';
        engineBadge.className = 'engine-idle';
    }

    function updateUIAfterPlay() {
        playIcon.textContent = '⏸';
        playLabel.textContent = 'PAUSE MUSIC STREAM';
        engineBadge.textContent = 'STREAMING 96kHz';
        engineBadge.className = 'engine-active';
    }

    function startSyntheticTone(freq) {
        try {
            initWebAudio();
            stopSyntheticTone();

            currentOsc1 = audioCtx.createOscillator();
            currentOsc2 = audioCtx.createOscillator();
            currentGain = audioCtx.createGain();

            currentOsc1.type = 'sine';
            currentOsc1.frequency.setValueAtTime(freq, audioCtx.currentTime);
            currentOsc2.type = 'triangle';
            currentOsc2.frequency.setValueAtTime(freq * 0.5, audioCtx.currentTime);

            currentGain.gain.setValueAtTime(0.001, audioCtx.currentTime);
            currentGain.gain.exponentialRampToValueAtTime(0.05, audioCtx.currentTime + 0.15);

            currentOsc1.connect(currentGain);
            currentOsc2.connect(currentGain);
            if (analyser) {
                currentGain.connect(analyser);
            }
            currentGain.connect(audioCtx.destination);

            currentOsc1.start();
            currentOsc2.start();
        } catch (e) {}
    }

    function stopSyntheticTone() {
        if (currentGain && audioCtx) {
            try {
                currentGain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.1);
                setTimeout(function() {
                    if (currentOsc1) { currentOsc1.stop(); currentOsc1.disconnect(); currentOsc1 = null; }
                    if (currentOsc2) { currentOsc2.stop(); currentOsc2.disconnect(); currentOsc2 = null; }
                }, 120);
            } catch (e) {}
        }
    }

    if (playBtn) {
        playBtn.addEventListener('click', function() {
            if (isPlaying) {
                pauseActiveTrack();
            } else {
                playActiveTrack();
            }
        });
    }

    window.switchTrack = function(title, meta, idx) {
        currentTrackIdx = idx;
        const track = trackList[idx];
        document.getElementById('currentTrackTitle').textContent = track.title + ' (' + track.meta + ')';
        
        if (isPlaying) {
            playActiveTrack();
        } else {
            if (audioEl) audioEl.src = track.url;
        }

        document.querySelectorAll('.track-chip').forEach(function(chip, i) {
            if (i === idx) {
                chip.classList.add('active');
            } else {
                chip.classList.remove('active');
            }
        });
    };

    window.loadAndPlayAlbum = function(idx, title, meta) {
        window.switchTrack(title, meta, idx);
        if (!isPlaying) {
            playActiveTrack();
        }
        const lab = document.getElementById('sound-lab');
        if (lab) lab.scrollIntoView({ behavior: 'smooth' });
    };
});
</script>

<?php
get_footer();
