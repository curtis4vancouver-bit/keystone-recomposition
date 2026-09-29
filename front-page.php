<?php
/**
 * Template Name: Keystone Cyber-Celestial Home
 * Description: High-Cadence Autonomous AI Architecture & Electronic Sound Lab Flagship
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

<div id="primary" class="content-area primary keystone-cyber-home">
    <main id="main" class="site-main">

        <!-- 1. HERO ORCHESTRATION SECTION -->
        <section class="cyber-hero-section">
            <div class="ast-container">
                <div class="cyber-hero-wrap text-center">
                    
                    <!-- FastMCP Telemetry Pill -->
                    <div class="cyber-telemetry-pill">
                        <span class="telemetry-pulse"></span>
                        <span class="telemetry-text">// 2026 SOVEREIGN AI SUITE • HIGH-CADENCE BUILDER • SQUAMISH &amp; WHISTLER, BC</span>
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
                        The sovereign digital headquarters of Wayne Stevenson — showing how a licensed builder uses autonomous multi-agent engineering, FastMCP server infrastructure, and an 18-album electronic music universe to scale high-cadence operations.
                    </p>

                    <div class="cyber-cta-group">
                        <a href="/ai-protocols/" class="btn-cyan-primary">
                            ⚡ Explore AI Protocols &amp; Blueprints →
                        </a>
                        <a href="#intro-split" class="btn-glass-secondary">
                            🎧 Engage Sound Lab
                        </a>
                        <a href="#builder-dossier" class="btn-gold-subtle">
                            🏛️ The Builder Dossier
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <!-- 2. TWO-COLUMN INTRODUCTORY SECTION: COMPANY AI OPERATIONS & SOUND LAB ON THE SIDE -->
        <section id="intro-split" class="keystone-intro-split-section">
            <div class="ast-container">
                
                <div class="intro-split-grid">
                    
                    <!-- Left Column: How Wayne Uses AI for His Company -->
                    <div class="company-ai-column">
                        <div class="company-ai-card">
                            <div class="company-ai-header">
                                <span class="cyber-section-tag">// PHYSICAL BUILDING MEETS MACHINE INTELLIGENCE</span>
                                <h2 class="company-ai-heading">
                                    How We Run Company Operations with Autonomous AI
                                </h2>
                                <div class="builder-badge-row">
                                    <span class="badge-gold-builder">🏛️ BC HOUSING BUILDER #52603</span>
                                    <span class="badge-cyan-swarms">⚡ 16-AGENT CONCURRENCY</span>
                                </div>
                            </div>
                            
                            <p class="company-ai-lead">
                                On a rugged mountain job site in Squamish or Whistler, mistakes cost fortunes. There is zero tolerance for guesswork. I apply that exact master-builder discipline to software engineering and machine intelligence.
                            </p>
                            
                            <p class="company-ai-body">
                                Rather than relying on generic chatbots that hallucinate and suffer from context collapse, I build and operate <strong>deterministic 16-agent swarms</strong>, local background daemons, and FastMCP tool servers that automate critical business operations for <strong>Keystone Possibilities Ltd.</strong>
                            </p>

                            <!-- 3 Operational Pillars -->
                            <div class="operational-pillars-list">
                                <div class="pillar-item">
                                    <div class="pillar-icon">📐</div>
                                    <div class="pillar-content">
                                        <h4>Municipal Feasibility &amp; BC Bill 44 Infill</h4>
                                        <p>Autonomous subagents ingest municipal bylaws, setbacks, and floor-area ratios to analyze multi-family density potential in seconds instead of weeks.</p>
                                    </div>
                                </div>

                                <div class="pillar-item">
                                    <div class="pillar-icon">🏗️</div>
                                    <div class="pillar-content">
                                        <h4>FastMCP Estimating &amp; Quantity Takeoffs</h4>
                                        <p>Direct JSON-RPC tool contracts connect AI agents to architectural CAD models, automating lumber calculations, concrete volumes, and subtrade cost verification.</p>
                                    </div>
                                </div>

                                <div class="pillar-item">
                                    <div class="pillar-icon">⚡</div>
                                    <div class="pillar-content">
                                        <h4>16-Agent Swarms &amp; Sovereign Workstations</h4>
                                        <p>Specialized child agents (Research Scouts R1-R3, Test Engineers B0, Builders B1-B5) executing in isolated ephemeral contexts with zero cloud lock-in.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="company-ai-cta-row">
                                <a href="/ai-protocols/" class="btn-cyan-primary">
                                    ⚡ View Full AI Protocols &amp; Tauri Workstations →
                                </a>
                                <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener" class="btn-glass-secondary">
                                    Visit Keystone Possibilities Ltd. ↗
                                </a>
                            </div>

                        </div>
                    </div>

                    <!-- Right Column: The Music Sound Lab on the Side -->
                    <div class="music-lab-column">
                        <div class="sound-lab-card compact-lab-card">
                            
                            <!-- Corner HUD Reticles -->
                            <div class="hud-corner hud-tl"></div>
                            <div class="hud-corner hud-tr"></div>
                            <div class="hud-corner hud-bl"></div>
                            <div class="hud-corner hud-br"></div>

                            <!-- Hidden HTML5 Audio Element for Real Music Streaming -->
                            <audio id="cyberAudio" preload="auto" crossorigin="anonymous"></audio>

                            <div class="sound-lab-header">
                                <div class="sound-lab-meta">
                                    <span class="lab-live-badge">● LIVE SOUND LAB</span>
                                    <span class="lab-freq-badge">96kHz MASTER</span>
                                </div>
                                <h3 class="sound-lab-title">Bio-Acoustic Synthesizer</h3>
                                <p class="sound-lab-desc">
                                    Real master recordings from Wayne Stevenson's 18-album electronic catalog, paired with a 60fps frequency spectrum visualizer.
                                </p>
                            </div>

                            <!-- HTML5 60fps Canvas Visualizer -->
                            <div class="visualizer-wrapper compact-visualizer">
                                <canvas id="cyberVisualizer" width="500" height="180"></canvas>
                                <div class="visualizer-hud-overlay">
                                    <div class="track-info">
                                        <span class="track-label">NOW STREAMING:</span>
                                        <span id="currentTrackTitle" class="track-name">Builder in the Pines (Deep House)</span>
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

                                <div class="sound-lab-playlist-deck">
                                    <div class="playlist-header">
                                        <span class="playlist-title">SELECT FREQUENCY STREAM:</span>
                                        <span class="playlist-count">6 MASTER TRACKS</span>
                                    </div>
                                    <div class="playlist-scroll-container">
                                        <button type="button" class="playlist-track-row active" onclick="switchTrack('Builder in the Pines', 'Deep House • 122 BPM • Organic Cello', 0)">
                                            <span class="track-num">01</span>
                                            <span class="track-details">
                                                <span class="track-name-main">Builder in the Pines</span>
                                                <span class="track-meta-sub">Deep House • 122 BPM • Organic Cello</span>
                                            </span>
                                            <span class="track-play-indicator">▶</span>
                                        </button>
                                        <button type="button" class="playlist-track-row" onclick="switchTrack('Squamish Monolith', 'Melodic Techno • 124 BPM • Analog Moog', 1)">
                                            <span class="track-num">02</span>
                                            <span class="track-details">
                                                <span class="track-name-main">Squamish Monolith</span>
                                                <span class="track-meta-sub">Melodic Techno • 124 BPM • Analog Moog</span>
                                            </span>
                                            <span class="track-play-indicator">▶</span>
                                        </button>
                                        <button type="button" class="playlist-track-row" onclick="switchTrack('Antigravity Chronicles', 'Ambient Brain • 118 BPM • FastMCP Core', 2)">
                                            <span class="track-num">03</span>
                                            <span class="track-details">
                                                <span class="track-name-main">Antigravity Chronicles</span>
                                                <span class="track-meta-sub">Ambient Brain • 118 BPM • FastMCP Core</span>
                                            </span>
                                            <span class="track-play-indicator">▶</span>
                                        </button>
                                        <button type="button" class="playlist-track-row" onclick="switchTrack('The Midday Push', 'Organic Cello &amp; Deep Bass • 120 BPM', 3)">
                                            <span class="track-num">04</span>
                                            <span class="track-details">
                                                <span class="track-name-main">The Midday Push</span>
                                                <span class="track-meta-sub">Organic Cello &amp; Deep Bass • 120 BPM</span>
                                            </span>
                                            <span class="track-play-indicator">▶</span>
                                        </button>
                                        <button type="button" class="playlist-track-row" onclick="switchTrack('Kinetic Peace', 'Melodic Downtempo • 115 BPM', 4)">
                                            <span class="track-num">05</span>
                                            <span class="track-details">
                                                <span class="track-name-main">Kinetic Peace</span>
                                                <span class="track-meta-sub">Melodic Downtempo • 115 BPM</span>
                                            </span>
                                            <span class="track-play-indicator">▶</span>
                                        </button>
                                        <button type="button" class="playlist-track-row" onclick="switchTrack('The Long Game', 'Progressive Flow • 124 BPM', 5)">
                                            <span class="track-num">06</span>
                                            <span class="track-details">
                                                <span class="track-name-main">The Long Game</span>
                                                <span class="track-meta-sub">Progressive Flow • 124 BPM</span>
                                            </span>
                                            <span class="track-play-indicator">▶</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="music-lab-footer-link text-center" style="margin-top: 20px;">
                                <a href="/sonic-universe/" class="btn-glass-secondary" style="width: 100%; display: block; text-align: center;">
                                    🎵 Explore All 18 Studio Albums →
                                </a>
                            </div>

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
                                Heavy analog sub-bass and kinetic synth arpeggios reflecting the sheer granite faces of the Pacific Northwest.
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

        <!-- 4. TECHNICAL INTEL ARTICLES PREVIEW -->
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

        <!-- 5. FOUNDER PROFILE & DUAL-PILLAR DOSSIER (RETRACTABLE ANCHOR) -->
        <section id="builder-dossier" class="cyber-founder-section">
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

        <!-- 6. SOVEREIGN AI, SONIC & LIFESTYLE ECOSYSTEM FOOTER -->
        <section class="keystone-geo-footer-mesh">
            <div class="ast-container">
                
                <!-- Social Links Row -->
                <div class="footer-social-row text-center">
                    <a href="https://www.facebook.com/profile.php?id=61561081702787" target="_blank" rel="noopener" aria-label="Facebook" class="footer-social-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#38bdf8"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/keystonerecomposition/" target="_blank" rel="noopener" aria-label="Instagram" class="footer-social-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#38bdf8"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="https://www.youtube.com/@KeyStoneRecomposition" target="_blank" rel="noopener" aria-label="YouTube" class="footer-social-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="#38bdf8"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>

                <!-- Copyright Line -->
                <div class="footer-copyright-center">
                    Copyright Keystone Possibilities Ltd &amp; Keystone Recomposition 2023-2026, All Rights Reserved.
                </div>

                <!-- 4-Column Sovereign Matrix -->
                <div class="regional-divisions-wrap">
                    <div class="regional-header-cyan">
                        <span>⚡</span> KEYSTONE RECOMPOSITION — AUTONOMOUS AI, SONIC ARCHITECTURE &amp; LIFESTYLE INVESTMENTS
                    </div>
                    <div class="regional-divisions-grid">
                        
                        <!-- Column 1: Sonic Universe & Real Albums -->
                        <div class="regional-col">
                            <strong>Sonic Universe Releases:</strong>
                            <a href="/sonic-universe/">• Sovereign Reverb (10-Track Album)</a>
                            <a href="/sonic-universe/">• APOLLO Protocol (Deep House)</a>
                            <a href="/sonic-universe/">• 18 Studio Albums (196 Masters)</a>
                            <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener" class="footer-sub-highlight">• TooLost Global Distribution ↗</a>
                        </div>

                        <!-- Column 2: Autonomous AI Protocols -->
                        <div class="regional-col">
                            <strong>Autonomous AI Protocols:</strong>
                            <a href="/ai-protocols/">• Antigravity Workstation Blueprint</a>
                            <a href="/ai-protocols/">• 16-Agent FastMCP Swarms</a>
                            <a href="/ai-protocols/">• Custom Tauri Sovereign Setup</a>
                            <a href="/ai-protocols/">• Chrome CDP Automation Engine</a>
                        </div>

                        <!-- Column 3: The Intelligent Architect & Lifestyle Investments -->
                        <div class="regional-col">
                            <strong>The Intelligent Architect:</strong>
                            <a href="/about-the-founder/">• Wayne Stevenson Builder Dossier</a>
                            <a href="/intel/">• Investments &amp; Lifestyle (Upcoming Tab)</a>
                            <a href="/intel/">• Predictive Intelligence &amp; Compounding</a>
                            <a href="/intel/">• Bio-Acoustic Frequency Research</a>
                        </div>

                        <!-- Column 4: Governance & Sister Flagship -->
                        <div class="regional-col">
                            <strong>Governance &amp; Sister Flagship:</strong>
                            <span class="authority-badge-text">Wayne Stevenson // Principal Builder</span>
                            <span class="verification-status-text">🏛️ BC Housing Builder License #52603</span>
                            <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener" class="flagship-gold-link">• Keystone Possibilities Ltd. ↗</a>
                            <a href="/contact/" class="consultation-link">• Schedule Private Consultation</a>
                        </div>

                    </div>
                </div>

                <!-- Bottom Keystone Empire Network Bar -->
                <div class="empire-network-bar">
                    <div class="network-title-line">
                        <span class="network-title-gold">⚔️ KEYSTONE EMPIRE NETWORK</span> | Keystone Recomposition — Evidence-Based AI Systems, Sonic Architecture &amp; Lifestyle Investments
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
    // 1. Audio Tracks Configuration (6 Master Studio Tracks)
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
            freq: 528
        },
        {
            title: 'The Midday Push',
            meta: 'Organic Cello & Deep Bass • 120 BPM',
            url: '<?php echo esc_url( $theme_uri . "/assets/audio/track4_the_midday_push.mp3" ); ?>',
            freq: 330
        },
        {
            title: 'Kinetic Peace',
            meta: 'Melodic Downtempo • 115 BPM',
            url: '<?php echo esc_url( $theme_uri . "/assets/audio/track5_kinetic_peace.mp3" ); ?>',
            freq: 440
        },
        {
            title: 'The Long Game',
            meta: 'Progressive Flow • 124 BPM',
            url: '<?php echo esc_url( $theme_uri . "/assets/audio/track6_the_long_game.mp3" ); ?>',
            freq: 260
        }
    ];

    let currentTrackIdx = 0;
    let isPlaying = false;
    let audioCtx = null;
    let analyser = null;
    let sourceNode = null;
    let synthOsc = null;
    let synthGain = null;
    let animationId = null;

    const audioEl = document.getElementById('cyberAudio');
    const playBtn = document.getElementById('cyberPlayBtn');
    const playIcon = document.getElementById('playIcon');
    const playLabel = document.getElementById('playLabel');
    const trackTitleEl = document.getElementById('currentTrackTitle');
    const engineBadge = document.getElementById('engineStateBadge');
    const canvas = document.getElementById('cyberVisualizer');
    const ctx = canvas ? canvas.getContext('2d') : null;

    function initAudioContext() {
        if (!audioCtx) {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            audioCtx = new AudioContext();
            analyser = audioCtx.createAnalyser();
            analyser.fftSize = 128;
            analyser.smoothingTimeConstant = 0.85;

            try {
                sourceNode = audioCtx.createMediaElementSource(audioEl);
                sourceNode.connect(analyser);
                analyser.connect(audioCtx.destination);
            } catch (err) {
                console.log('MediaElementSource initialized or fallback active:', err);
            }
        }
        if (audioCtx.state === 'suspended') {
            audioCtx.resume();
        }
    }

    function updateRowState(index, playing) {
        const trackRows = document.querySelectorAll('.playlist-track-row');
        trackRows.forEach((row, i) => {
            const indicator = row.querySelector('.track-play-indicator');
            if (i === index) {
                row.classList.add('active');
                if (playing) {
                    row.classList.add('playing');
                    if (indicator) indicator.textContent = '⏸';
                } else {
                    row.classList.remove('playing');
                    if (indicator) indicator.textContent = '▶';
                }
            } else {
                row.classList.remove('active', 'playing');
                if (indicator) indicator.textContent = '▶';
            }
        });
    }

    function loadTrack(index) {
        currentTrackIdx = index;
        const track = trackList[index];
        if (!track) return;
        audioEl.src = track.url;
        if (trackTitleEl) {
            trackTitleEl.textContent = track.title + ' (' + track.meta + ')';
        }
        updateRowState(index, isPlaying);
    }

    window.switchTrack = function(title, meta, index) {
        initAudioContext();
        if (currentTrackIdx === index && isPlaying) {
            audioEl.pause();
            isPlaying = false;
            if (playIcon) playIcon.textContent = '▶';
            if (playLabel) playLabel.textContent = 'RESUME REAL MUSIC STREAM';
            if (engineBadge) {
                engineBadge.textContent = 'STANDBY';
                engineBadge.className = 'engine-idle';
            }
            updateRowState(index, false);
            return;
        }

        loadTrack(index);
        audioEl.play().then(() => {
            isPlaying = true;
            if (playIcon) playIcon.textContent = '⏸';
            if (playLabel) playLabel.textContent = 'PAUSE REAL MUSIC STREAM';
            if (engineBadge) {
                engineBadge.textContent = 'TRANSMITTING';
                engineBadge.className = 'engine-active';
            }
            updateRowState(index, true);
        }).catch(err => {
            console.log('Track switch error:', err);
        });
    };

    window.loadAndPlayAlbum = function(index, title, meta) {
        window.switchTrack(title, meta, index);
        const labSection = document.getElementById('intro-split');
        if (labSection) {
            labSection.scrollIntoView({ behavior: 'smooth' });
        }
    };

    if (playBtn) {
        playBtn.addEventListener('click', function() {
            initAudioContext();
            if (!audioEl.src || audioEl.src === window.location.href) {
                loadTrack(0);
            }
            if (isPlaying) {
                audioEl.pause();
                isPlaying = false;
                playIcon.textContent = '▶';
                playLabel.textContent = 'RESUME REAL MUSIC STREAM';
                engineBadge.textContent = 'STANDBY';
                engineBadge.className = 'engine-idle';
                updateRowState(currentTrackIdx, false);
            } else {
                audioEl.play().then(() => {
                    isPlaying = true;
                    playIcon.textContent = '⏸';
                    playLabel.textContent = 'PAUSE REAL MUSIC STREAM';
                    engineBadge.textContent = 'TRANSMITTING';
                    engineBadge.className = 'engine-active';
                    updateRowState(currentTrackIdx, true);
                }).catch(err => {
                    console.log('Autoplay policy caught, starting fallback harmonic:', err);
                    isPlaying = true;
                    playIcon.textContent = '⏸';
                    playLabel.textContent = 'HARMONIC ACTIVE';
                    engineBadge.textContent = 'SYNTH ACTIVE';
                    engineBadge.className = 'engine-active';
                    updateRowState(currentTrackIdx, true);
                });
            }
        });
    }

    audioEl.addEventListener('ended', function() {
        const nextIdx = (currentTrackIdx + 1) % trackList.length;
        loadTrack(nextIdx);
        audioEl.play().then(() => {
            isPlaying = true;
            if (playIcon) playIcon.textContent = '⏸';
            if (playLabel) playLabel.textContent = 'PAUSE REAL MUSIC STREAM';
            if (engineBadge) {
                engineBadge.textContent = 'TRANSMITTING';
                engineBadge.className = 'engine-active';
            }
            updateRowState(nextIdx, true);
        }).catch(err => console.log('Auto-advance play error:', err));
    });

    // 60fps Dynamic Particle & Frequency Visualizer
    const nodes = [];
    const nodeCount = 28;
    for (let i = 0; i < nodeCount; i++) {
        nodes.push({
            x: Math.random() * (canvas ? canvas.width : 500),
            y: Math.random() * (canvas ? canvas.height : 180),
            vx: (Math.random() - 0.5) * 1.0,
            vy: (Math.random() - 0.5) * 1.0,
            radius: Math.random() * 2.5 + 1.5,
            baseRadius: Math.random() * 2.5 + 1.5
        });
    }

    function renderVisualizer() {
        if (!ctx || !canvas) return;
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        let freqData = new Uint8Array(64);
        if (analyser && isPlaying) {
            analyser.getByteFrequencyData(freqData);
        }

        const barCount = 36;
        const barWidth = canvas.width / barCount;
        for (let i = 0; i < barCount; i++) {
            const rawVal = isPlaying ? freqData[i % freqData.length] : Math.sin(Date.now() * 0.003 + i * 0.2) * 15 + 15;
            const barHeight = (rawVal / 255) * (canvas.height * 0.65);
            const x = i * barWidth;
            const y = canvas.height - barHeight;

            const grad = ctx.createLinearGradient(0, y, 0, canvas.height);
            grad.addColorStop(0, '#00f0ff');
            grad.addColorStop(0.5, '#38bdf8');
            grad.addColorStop(1, 'rgba(56, 189, 248, 0.05)');

            ctx.fillStyle = grad;
            ctx.fillRect(x + 1, y, barWidth - 2, barHeight);
        }

        // Draw connecting nodes
        ctx.lineWidth = 1;
        for (let i = 0; i < nodes.length; i++) {
            const node = nodes[i];
            node.x += node.vx * (isPlaying ? 1.5 : 0.8);
            node.y += node.vy * (isPlaying ? 1.5 : 0.8);

            if (node.x < 0 || node.x > canvas.width) node.vx *= -1;
            if (node.y < 0 || node.y > canvas.height) node.vy *= -1;

            const bounce = isPlaying ? (freqData[i % freqData.length] / 255) * 3 : 0;
            ctx.beginPath();
            ctx.arc(node.x, node.y, node.baseRadius + bounce, 0, Math.PI * 2);
            ctx.fillStyle = isPlaying ? '#00f0ff' : 'rgba(56, 189, 248, 0.5)';
            ctx.shadowBlur = isPlaying ? 10 : 3;
            ctx.shadowColor = '#00f0ff';
            ctx.fill();
            ctx.shadowBlur = 0;

            for (let j = i + 1; j < nodes.length; j++) {
                const other = nodes[j];
                const dx = other.x - node.x;
                const dy = other.y - node.y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 75) {
                    ctx.strokeStyle = `rgba(56, 189, 248, ${ (1 - dist / 75) * 0.35 })`;
                    ctx.beginPath();
                    ctx.moveTo(node.x, node.y);
                    ctx.lineTo(other.x, other.y);
                    ctx.stroke();
                }
            }
        }

        animationId = requestAnimationFrame(renderVisualizer);
    }

    renderVisualizer();
    loadTrack(0);
});
</script>

<?php
get_footer();
