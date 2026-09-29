<?php
/**
 * The template for displaying the Keystone Recomposition Cyber-Celestial Home Page
 *
 * @package Keystone Recomposition Child
 * @since 3.3.0 (Cyber-Celestial AI Sound Lab Edition)
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
                        <span class="telemetry-text">// 196 MASTER TRACKS REGISTERED • 16 AUTONOMOUS AGENTS ACTIVE</span>
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
                        <span class="cyan-gradient-text">Meets Bio-Acoustic Frequency Architecture</span>
                    </h1>
                    
                    <p class="cyber-hero-subtitle">
                        The sovereign digital headquarters of Wayne Stevenson — bridging autonomous multi-agent engineering, FastMCP server infrastructure, and an 18-album electronic music universe.
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

        <!-- 2. INTERACTIVE CYBER SOUND LAB ENGINE -->
        <section id="sound-lab" class="cyber-sound-lab-section">
            <div class="ast-container">
                
                <div class="sound-lab-card">
                    <!-- Corner HUD Reticles -->
                    <div class="hud-corner hud-tl"></div>
                    <div class="hud-corner hud-tr"></div>
                    <div class="hud-corner hud-bl"></div>
                    <div class="hud-corner hud-br"></div>

                    <div class="sound-lab-header">
                        <div class="sound-lab-meta">
                            <span class="lab-live-badge">● LIVE ENGINE</span>
                            <span class="lab-freq-badge">96kHz • 24-BIT MASTER STUDIO</span>
                        </div>
                        <h2 class="sound-lab-title">Bio-Acoustic Frequency Synthesizer</h2>
                        <p class="sound-lab-desc">
                            Real-time neural spline visualization and harmonic tone generation engineered for deep-focus agentic coding.
                        </p>
                    </div>

                    <!-- HTML5 60fps Canvas Visualizer -->
                    <div class="visualizer-wrapper">
                        <canvas id="cyberVisualizer" width="1000" height="240"></canvas>
                        <div class="visualizer-hud-overlay">
                            <div class="track-info">
                                <span class="track-label">NOW LOADED:</span>
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
                            <span id="playLabel">INITIATE FREQUENCY STREAM</span>
                        </button>

                        <div class="track-chips-matrix">
                            <button class="track-chip active" onclick="switchTrack('Builder in the Pines', 'Deep House • 122 BPM • Organic Cello', 220)">
                                01 • Builder in the Pines
                            </button>
                            <button class="track-chip" onclick="switchTrack('Squamish Monolith', 'Melodic Techno • 124 BPM • Analog Moog', 174)">
                                02 • Squamish Monolith
                            </button>
                            <button class="track-chip" onclick="switchTrack('Antigravity Chronicles', 'Ambient Brain • 118 BPM • FastMCP Core', 261)">
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
                    <div class="cyber-album-card" onclick="switchTrack('Builder in the Pines', 'Deep House • 122 BPM • Organic Cello', 220)">
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
                                <span class="album-stream-prompt">⚡ Click to Load Stream</span>
                                <a href="/sonic-universe/" class="album-details-link">Album Details →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Album 2: Squamish Monolith -->
                    <div class="cyber-album-card" onclick="switchTrack('Squamish Monolith', 'Melodic Techno • 124 BPM • Analog Moog', 174)">
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
                                <span class="album-stream-prompt">⚡ Click to Load Stream</span>
                                <a href="/sonic-universe/" class="album-details-link">Album Details →</a>
                            </div>
                        </div>
                    </div>

                    <!-- Album 3: Antigravity Chronicles -->
                    <div class="cyber-album-card" onclick="switchTrack('Antigravity Chronicles', 'Ambient Brain • 118 BPM • FastMCP Core', 261)">
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
                                <span class="album-stream-prompt">⚡ Click to Load Stream</span>
                                <a href="/sonic-universe/" class="album-details-link">Album Details →</a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="text-center" style="margin-top: 36px;">
                    <a href="/sonic-universe/" class="btn-cyan-outline">
                        🎵 Explore All 18 Studio Albums in Sonic Universe →
                    </a>
                </div>

            </div>
        </section>

        <!-- 4. AI PROTOCOLS & TIERED KNOWLEDGE BLUEPRINT ($49 / $199 / $800) -->
        <section id="ai-funnel" class="cyber-funnel-section">
            <div class="ast-container">
                
                <div class="section-header text-center">
                    <span class="cyber-section-tag">AGENTIC ENGINEERING BLUEPRINTS</span>
                    <h2 class="cyber-section-title">Autonomous AI Protocols &amp; Workstations</h2>
                    <p class="cyber-section-desc">
                        Direct access to Wayne Stevenson's production FastMCP architectures, agent swarms, and turn-key deployment blueprints.
                    </p>
                </div>

                <div class="pricing-tiers-grid">
                    
                    <!-- Tier 1: $49 Starter Fast-Track (Wayne's Special Feature) -->
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
                        </div>
                        <ul class="tier-features-list">
                            <li><span>✔</span> Full video breakdown of building websites from scratch with Antigravity</li>
                            <li><span>✔</span> Production prompt library &amp; multi-agent configuration recipes</li>
                            <li><span>✔</span> Complete source code template &amp; deployment checklist</li>
                            <li><span>✔</span> Instant direct delivery to your email inbox</li>
                        </ul>
                        <div class="tier-action">
                            <a href="/contact/" class="btn-tier-action btn-gold-filled">
                                🚀 Get Instant Access ($49 USD) →
                            </a>
                            <span class="instant-delivery-note">⚡ Instant digital blueprint delivery</span>
                        </div>
                    </div>

                    <!-- Tier 2: $199 Pro Autonomous Suite -->
                    <div class="tier-card">
                        <div class="tier-header">
                            <span class="tier-level">TIER 02 // PRO BUILDER</span>
                            <h3 class="tier-name">Autonomous Swarm &amp; Email Engine</h3>
                            <div class="tier-price-box">
                                <span class="currency">$</span>
                                <span class="amount">199</span>
                                <span class="currency-tag">USD</span>
                            </div>
                            <p class="tier-tagline">
                                Full-cadence multi-agent research swarms, automated email outreach pipelines, and FastMCP tool integration.
                            </p>
                        </div>
                        <ul class="tier-features-list">
                            <li><span>✔</span> 16-agent research &amp; coding swarm orchestration templates</li>
                            <li><span>✔</span> Automated high-deliverability email outreach pipelines</li>
                            <li><span>✔</span> FastMCP JSON-RPC server contracts with zero cloud lock-in</li>
                            <li><span>✔</span> Bi-weekly architectural code audits and swarm updates</li>
                        </ul>
                        <div class="tier-action">
                            <a href="/contact/" class="btn-tier-action btn-cyan-glass">
                                Deploy Pro Swarms ($199 USD) →
                            </a>
                            <span class="instant-delivery-note">Includes complete GitHub template repository</span>
                        </div>
                    </div>

                    <!-- Tier 3: $800 Custom Workstation & Torii HUD -->
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
                                Dedicated 1-on-1 architecture by Wayne Stevenson: custom desktop HUD workstation, daemons, and tailored agentic models.
                            </p>
                        </div>
                        <ul class="tier-features-list">
                            <li><span>✔</span> Tailored desktop HUD control center (Tauri / Rust / WebSockets)</li>
                            <li><span>✔</span> Custom background concurrency daemons (:9876-:9879)</li>
                            <li><span>✔</span> Chrome CDP Port 9222 stream automation customized for your stack</li>
                            <li><span>✔</span> Private 1-on-1 implementation &amp; system handover session</li>
                        </ul>
                        <div class="tier-action">
                            <a href="/contact/" class="btn-tier-action btn-cyan-glass">
                                Request Private Consultation ($800 USD) →
                            </a>
                            <span class="instant-delivery-note">Strictly limited client capacity per month</span>
                        </div>
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

                <div class="intel-cards-grid">
                    <?php
                    $recent_posts = new WP_Query( array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                    ) );

                    if ( $recent_posts->have_posts() ) :
                        while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
                    ?>
                        <article class="cyber-intel-card">
                            <span class="intel-tag">TECHNICAL PROTOCOL</span>
                            <h3 class="intel-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="intel-excerpt">
                                <?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?>
                            </p>
                            <a href="<?php the_permalink(); ?>" class="intel-read-link">Read Full Protocol →</a>
                        </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <div class="text-center" style="margin-top: 32px;">
                    <a href="/intel/" class="btn-cyan-outline">View All Intelligence Dispatches →</a>
                </div>
            </div>
        </section>

        <!-- 6. FOUNDER PROFILE & PHYSICAL FIDUCIARY CONNECTION -->
        <section class="cyber-founder-section">
            <div class="ast-container">
                <div class="founder-profile-card">
                    <div class="founder-profile-grid">
                        
                        <div class="founder-photo-col">
                            <div class="founder-photo-lens">
                                <img src="<?php echo esc_url( $theme_uri . '/assets/images/wayne_avatar.jpg' ); ?>" 
                                     alt="Wayne Stevenson — Founder" 
                                     class="founder-lens-img" loading="lazy" decoding="async" />
                                <div class="lens-scanline"></div>
                            </div>
                            <div class="founder-credentials-pills">
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

        <!-- 7. WAYNE'S PREFERRED 4-COLUMN REGIONAL DIVISIONS & EMPIRE NETWORK FOOTER -->
        <section class="keystone-geo-footer-mesh">
            <div class="ast-container">
                
                <!-- Copyright Line -->
                <div class="footer-copyright-center">
                    Copyright Keystone Possibilities Ltd &amp; Keystone Recomposition 2023-2026, All Rights Reserved.
                </div>

                <!-- 4-Column Regional Divisions Matrix -->
                <div class="regional-divisions-wrap">
                    <div class="regional-header-cyan">
                        <span>🏛️</span> KEYSTONE POSSIBILITIES — REGIONAL DIVISIONS &amp; SPECIALIZED SERVICES
                    </div>
                    <div class="regional-divisions-grid">
                        
                        <!-- Column 1: Sea-to-Sky -->
                        <div class="regional-col">
                            <strong>Sea-to-Sky Corridor:</strong>
                            <a href="https://keystonepossibilities.ca/squamish-custom-homes/" target="_blank" rel="noopener">• Squamish Custom Home Builder</a>
                            <a href="https://keystonepossibilities.ca/whistler-custom-homes/" target="_blank" rel="noopener">• Whistler Luxury Estate Builder</a>
                            <a href="https://keystonepossibilities.ca/pemberton-luxury-builder/" target="_blank" rel="noopener">• Pemberton Acreage Builder</a>
                        </div>

                        <!-- Column 2: Metro Vancouver -->
                        <div class="regional-col">
                            <strong>Metro Vancouver:</strong>
                            <a href="https://keystonepossibilities.ca/north-vancouver-custom-homes/" target="_blank" rel="noopener">• North Vancouver Luxury Builder</a>
                            <a href="https://keystonepossibilities.ca/north-vancouver-multiplex-conversions/" target="_blank" rel="noopener">• North Vancouver Bill 44 Multiplex</a>
                            <a href="https://keystonepossibilities.ca/west-vancouver-custom-homes/" target="_blank" rel="noopener">• West Vancouver Steep Slope Builds</a>
                        </div>

                        <!-- Column 3: Civil & Fiduciary PM -->
                        <div class="regional-col">
                            <strong>Civil &amp; Fiduciary PM:</strong>
                            <a href="https://keystonepossibilities.ca/bc-hydro-registered-civil-contractor/" target="_blank" rel="noopener">• BC Hydro Civil Utility Contractor</a>
                            <a href="https://keystonepossibilities.ca/feasibility-plan/" target="_blank" rel="noopener">• Construction Feasibility Studies</a>
                            <a href="https://keystonepossibilities.ca/private-investors/" target="_blank" rel="noopener">• Private Investor Joint Ventures</a>
                        </div>

                        <!-- Column 4: Direct Authority & Contact (NO PHONE NUMBER) -->
                        <div class="regional-col">
                            <strong>Direct Authority &amp; Contact:</strong>
                            <span class="authority-badge-text">BC Housing License #52603</span>
                            <span class="verification-status-text">Direct Field Verification: Active</span>
                            <a href="/contact/" class="consultation-link">• Schedule Fiduciary Consultation</a>
                        </div>

                    </div>
                </div>

                <!-- Bottom Keystone Empire Network Bar -->
                <div class="empire-network-bar">
                    <div class="network-title-line">
                        <span class="network-title-gold">⚔️ KEYSTONE EMPIRE NETWORK</span> | Keystone Possibilities — BC Building Code &amp; Construction Consulting
                    </div>
                    <div class="network-sister-link">
                        Sister Flagship: <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener">Keystone Possibilities — Licensed Residential Builder #52603 &amp; BC Hydro Utility Contractor →</a>
                    </div>
                </div>

            </div>
        </section>

    </main>
</div>

<!-- Web Audio API Interactive Sound Lab Engine Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 60fps Canvas Neural Visualizer
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

    let isPlaying = false;
    let audioCtx = null;
    let currentOsc = null;
    let currentGain = null;
    let currentFreq = 220;

    function renderFrame() {
        ctx.clearRect(0, 0, width, height);

        // Draw connections
        for (let i = 0; i < nodes.length; i++) {
            for (let j = i + 1; j < nodes.length; j++) {
                const dx = nodes[i].x - nodes[j].x;
                const dy = nodes[i].y - nodes[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 120) {
                    const alpha = (1 - dist / 120) * (isPlaying ? 0.7 : 0.25);
                    ctx.strokeStyle = 'rgba(56, 189, 248, ' + alpha + ')';
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(nodes[i].x, nodes[i].y);
                    ctx.lineTo(nodes[j].x, nodes[j].y);
                    ctx.stroke();
                }
            }
        }

        // Draw nodes
        for (let i = 0; i < nodes.length; i++) {
            const n = nodes[i];
            n.x += n.vx * (isPlaying ? 2.0 : 0.8);
            n.y += n.vy * (isPlaying ? 2.0 : 0.8);

            if (n.x < 0 || n.x > width) n.vx *= -1;
            if (n.y < 0 || n.y > height) n.vy *= -1;

            ctx.beginPath();
            ctx.arc(n.x, n.y, n.radius * (isPlaying ? 1.4 : 1.0), 0, Math.PI * 2);
            ctx.fillStyle = isPlaying ? '#38bdf8' : 'rgba(56, 189, 248, 0.4)';
            ctx.shadowColor = '#38bdf8';
            ctx.shadowBlur = isPlaying ? 12 : 4;
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

    function startAudioTone() {
        try {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            if (!audioCtx) audioCtx = new AudioContext();
            if (audioCtx.state === 'suspended') audioCtx.resume();

            if (currentOsc) {
                currentOsc.stop();
                currentOsc.disconnect();
            }

            currentOsc = audioCtx.createOscillator();
            currentGain = audioCtx.createGain();

            currentOsc.type = 'sine';
            currentOsc.frequency.setValueAtTime(currentFreq, audioCtx.currentTime);

            currentGain.gain.setValueAtTime(0.001, audioCtx.currentTime);
            currentGain.gain.exponentialRampToValueAtTime(0.08, audioCtx.currentTime + 0.15);

            currentOsc.connect(currentGain);
            currentGain.connect(audioCtx.destination);
            currentOsc.start();
        } catch (e) {
            console.log('Audio Tone initialized:', e);
        }
    }

    function stopAudioTone() {
        if (currentGain && audioCtx) {
            try {
                currentGain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.1);
                setTimeout(function() {
                    if (currentOsc) {
                        currentOsc.stop();
                        currentOsc.disconnect();
                        currentOsc = null;
                    }
                }, 120);
            } catch (e) {}
        }
    }

    if (playBtn) {
        playBtn.addEventListener('click', function() {
            isPlaying = !isPlaying;
            if (isPlaying) {
                playIcon.textContent = '⏸';
                playLabel.textContent = 'PAUSE FREQUENCY STREAM';
                engineBadge.textContent = 'STREAMING 96kHz';
                engineBadge.className = 'engine-active';
                startAudioTone();
            } else {
                playIcon.textContent = '▶';
                playLabel.textContent = 'RESUME FREQUENCY STREAM';
                engineBadge.textContent = 'STANDBY';
                engineBadge.className = 'engine-idle';
                stopAudioTone();
            }
        });
    }

    window.switchTrack = function(title, meta, freq) {
        document.getElementById('currentTrackTitle').textContent = title + ' (' + meta + ')';
        currentFreq = freq;
        if (isPlaying) {
            startAudioTone();
        }
        document.querySelectorAll('.track-chip').forEach(function(chip) {
            if (chip.textContent.includes(title)) {
                chip.classList.add('active');
            } else {
                chip.classList.remove('active');
            }
        });
    };
});
</script>

<?php
get_footer();
