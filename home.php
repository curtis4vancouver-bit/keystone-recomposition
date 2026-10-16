<?php
/**
 * The blog archive template for INTEL & PROTOCOLS (/intel/ or /blog/)
 * Keystone Recomposition Child Theme
 * Version: 4.2.0 (PHP 8.2+ Strict Types)
 *
 * Designed to Wayne's exact standard:
 * - Sleek, centered top header with cyan telemetry pill
 * - Dual-media featured hero section: Recomposition Long Video (uMkZvTbqF2U) + Recomposition Short (XUiFyItyyzo) on left, SEO/GEO write-up on right
 * - 2x3 grid of 6 luxury cards per view (3 up top, 3 below it) with interactive pagination
 * - Strictly styled in Keystone Recomposition electric cyan & cyber obsidian aesthetic
 * - 100% responsive on all viewports (desktop, tablet, mobile)
 * - Dynamic REST API ingestion for automatic updates on newly published posts
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div id="primary" class="content-area primary keystone-intel-archive">
    <main id="main" class="site-main">
        <div class="ast-container">
            
            <!-- 1. Sleek, Centered Top Header Area -->
            <header class="intel-archive-header text-center" style="margin-bottom: 2.5rem; text-align: center;">
                <div class="intel-telemetry-pill">
                    <span class="telemetry-pulse"></span>
                    <span class="telemetry-text">// 2026 TECHNICAL INTEL • AI ARCHITECTURE &amp; SONIC RESEARCH</span>
                </div>
                <h1 class="page-title">
                    Technical Intel &amp; <span class="cyan-gold-gradient-text">Architectural Protocols</span>
                </h1>
                <p class="archive-subtitle">
                    Production FastMCP server patterns, local multi-agent swarm case studies, Chrome DevTools Protocol automation, and high-performance frequency sound design by Wayne Stevenson.
                </p>
            </header>

            <!-- 2. Dual-Media Featured Hero Section (Video on Left with Short Underneath, Write-up on Right) -->
            <section id="recomp-featured-intel-container" class="recomp-featured-hero-wrap" style="background: linear-gradient(145deg, #0b111e 0%, #060a12 100%); border: 1px solid rgba(56, 189, 248, 0.35); border-radius: 24px; padding: 32px; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6); position: relative; z-index: 2; isolation: isolate; margin-bottom: 3.5rem;">
                <div class="recomp-featured-layout" style="display: flex; gap: 36px; align-items: stretch; width: 100%;">
                    
                    <!-- Left Column (55%): Keystone Recomposition Master 16:9 Video + 9:16 Companion Short Deck -->
                    <div class="recomp-featured-left-col" style="flex: 1 1 55%; width: 55%; min-width: 0; display: flex; flex-direction: column;">
                        
                        <!-- 16:9 Master Video Frame (Keystone Recomposition Masterclass) -->
                        <div class="recomp-featured-video-frame" style="position: relative; width: 100%; aspect-ratio: 16 / 9; border-radius: 16px; overflow: hidden; background: #000; border: 1px solid rgba(56, 189, 248, 0.3); box-shadow: 0 8px 30px rgba(56, 189, 248, 0.15);">
                            <iframe id="recomp-featured-long-video" 
                                    src="https://www.youtube.com/embed/JCgZ5SsN_bc?rel=0" 
                                    title="Autonomous Multi-Agent Swarms: FastMCP Production Architecture" 
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen></iframe>
                        </div>

                        <!-- 9:16 Field Companion Short Deck (Keystone Recomposition Short) -->
                        <div class="recomp-featured-short-deck" style="margin-top: 16px; background: rgba(8, 12, 20, 0.85); border: 1px solid rgba(56, 189, 248, 0.25); border-radius: 14px; padding: 14px 18px; display: flex; align-items: center; gap: 16px;">
                            
                            <!-- 9:16 Vertical Player Frame -->
                            <div class="recomp-featured-short-player-box" style="position: relative; width: 120px; height: 213px; min-width: 120px; border-radius: 10px; overflow: hidden; background: #000; border: 1.5px solid rgba(56, 189, 248, 0.4); box-shadow: 0 4px 16px rgba(0,0,0,0.6); flex-shrink: 0;">
                                <iframe id="recomp-featured-short-video" 
                                        src="https://www.youtube.com/embed/vk2i18V28Bw?rel=0" 
                                        title="FastMCP Swarms Field Companion Short" 
                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen></iframe>
                            </div>

                            <!-- Short Details & CTA -->
                            <div class="recomp-featured-short-details" style="flex: 1; min-width: 0;">
                                <div style="display: inline-block; background: rgba(56, 189, 248, 0.12); border: 1px solid rgba(56, 189, 248, 0.35); color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.06em; margin-bottom: 6px;">
                                    ⚡ 9:16 FIELD INTEL SHORT
                                </div>
                                <h4 class="recomp-featured-short-title" style="margin: 0 0 4px 0; color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.96rem; font-weight: 800; line-height: 1.3;">
                                    FastMCP Companion Short
                                </h4>
                                <p class="recomp-featured-short-desc" style="margin: 0 0 10px 0; color: #94a3b8; font-size: 0.78rem; line-height: 1.45;">
                                    Rapid 40-second mobile field breakdown &amp; sovereign 28-agent swarm architecture.
                                </p>
                                <div class="recomp-featured-short-actions" style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                    <a id="recomp-featured-short-link" href="https://youtube.com/shorts/vk2i18V28Bw" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #d4af37 0%, #f3e5ab 50%, #aa8010 100%); color: #04070d !important; -webkit-text-fill-color: #04070d !important; font-size: 0.78rem; font-weight: 800; padding: 8px 14px; border-radius: 9999px; text-decoration: none !important; box-shadow: 0 4px 12px rgba(212, 175, 55, 0.35);">
                                        <span>▶</span> Watch Short on YouTube
                                    </a>
                                    <a href="https://youtube.com/@keystonerecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background: rgba(15, 23, 42, 0.9); border: 1px solid rgba(56, 189, 248, 0.45); color: #38bdf8 !important; -webkit-text-fill-color: #38bdf8 !important; font-size: 0.78rem; font-weight: 700; padding: 8px 14px; border-radius: 50px; text-decoration: none !important;">
                                        <span>🔔</span> Subscribe
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column (45%): SEO & GEO Technical Intel Write-up -->
                    <div class="recomp-featured-content-wrap" style="flex: 1 1 45%; width: 45%; min-width: 0; display: flex; flex-direction: column; justify-content: center; box-sizing: border-box; position: relative; z-index: 3; transform: translateZ(0);">
                        
                        <!-- Metadata Pill Row -->
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 0.85rem; flex-wrap: wrap;">
                            <span id="recomp-featured-cat" class="recomp-cat-badge" style="background: rgba(56, 189, 248, 0.12); border: 1px solid rgba(56, 189, 248, 0.4); color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em;">
                                FAST_MCP // SOVEREIGN AI &amp; SOUND
                            </span>
                            <span id="recomp-featured-date" style="color: #94a3b8; font-size: 0.80rem; font-weight: 600;">October 2026</span>
                            <span id="recomp-featured-readtime" style="color: #f6d365; font-size: 0.78rem; font-weight: 700;">12 MIN READ</span>
                        </div>

                        <!-- Main Title -->
                        <h2 id="recomp-featured-title" class="recomp-featured-h2" style="font-family: 'Outfit', sans-serif; font-size: clamp(1.4rem, 2.2vw, 1.95rem); font-weight: 900; line-height: 1.25; color: #ffffff; margin: 0 0 1rem 0; letter-spacing: -0.01em;">
                            Autonomous Multi-Agent Swarms: The 28-Agent FastMCP Architecture
                        </h2>

                        <!-- SEO & GEO Excerpt Write-up -->
                        <p id="recomp-featured-excerpt" class="recomp-featured-excerpt" style="font-size: clamp(0.90rem, 1.05vw, 1.0rem); color: #cbd5e1; line-height: 1.7; margin: 0 0 1.5rem 0;">
                            Production FastMCP server architecture, local 28-agent swarms via Google Antigravity, and zero-cloud Chrome DevTools Protocol automation latching directly into desktop Port 9222. Engineered in Squamish and Vancouver, BC by Wayne Stevenson to eliminate cloud API latency, vendor lock-in, and fragile bot-detection proxies.
                        </p>

                        <!-- Wayne Stevenson Author Signature & Credentials -->
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
                            <img decoding="async" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/wayne_avatar.jpg' ); ?>" alt="Wayne Stevenson" style="width: 48px; height: 48px; border-radius: 50%; border: 2px solid #38bdf8; object-fit: cover; flex-shrink: 0; box-shadow: 0 0 12px rgba(56, 189, 248, 0.3);" />
                            <div>
                                <div style="color: #ffffff; font-weight: 800; font-size: 0.92rem; line-height: 1.2;">Wayne Stevenson</div>
                                <div style="color: #38bdf8; font-size: 0.78rem; font-weight: 600;">Sovereign AI Architect &bull; Music Producer &bull; Squamish, BC</div>
                            </div>
                        </div>

                        <!-- Action Buttons Box -->
                        <div class="recomp-featured-buttons-box" style="display: flex; flex-direction: column; gap: 10px; max-width: 360px; width: 100%;">
                            <a id="recomp-featured-link" href="/2026/09/28/autonomous-multi-agent-swarms-fastmcp-architecture/" style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 42px; min-height: 42px; background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%); color: #04070d !important; -webkit-text-fill-color: #04070d !important; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 800; letter-spacing: 0.05em; padding: 0 20px; border-radius: 50px; text-decoration: none !important; box-shadow: 0 6px 20px rgba(56, 189, 248, 0.35); box-sizing: border-box; transition: all 0.25s ease;">
                                <span>READ TECHNICAL INTEL &rarr;</span>
                            </a>
                            <a href="/ai-protocols/" style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 42px; min-height: 42px; background: rgba(15, 23, 42, 0.90); border: 1.5px solid rgba(56, 189, 248, 0.45); color: #ffffff !important; -webkit-text-fill-color: #ffffff !important; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.04em; padding: 0 20px; border-radius: 50px; text-decoration: none !important; box-sizing: border-box; transition: all 0.25s ease;">
                                <span>EXPLORE AI PROTOCOLS &rarr;</span>
                            </a>
                        </div>

                    </div>

                </div>
            </section>

            <!-- 2B. SONIC UNIVERSE / SOUND LAB FEATURED HERO SECTION -->
            <section id="recomp-featured-sound-container" class="recomp-featured-hero-wrap" style="background: linear-gradient(145deg, #0b111e 0%, #060a12 100%); border: 1px solid rgba(245, 158, 11, 0.35); border-radius: 24px; padding: 32px; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6); position: relative; z-index: 2; isolation: isolate; margin-bottom: 3.5rem;">
                <div class="recomp-featured-layout" style="display: flex; gap: 36px; align-items: stretch; width: 100%;">
                    
                    <!-- Left Column (55%): Master 16:9 4K Video + Streaming Audio Deck -->
                    <div class="recomp-featured-left-col" style="flex: 1 1 55%; width: 55%; min-width: 0; display: flex; flex-direction: column;">
                        
                        <!-- 16:9 Master Video Frame (The Zen Builder) -->
                        <div class="recomp-featured-video-frame" style="position: relative; width: 100%; aspect-ratio: 16 / 9; border-radius: 16px; overflow: hidden; background: #000; border: 1px solid rgba(245, 158, 11, 0.3); box-shadow: 0 8px 30px rgba(245, 158, 11, 0.15);">
                            <iframe id="recomp-featured-sound-video" 
                                    src="https://www.youtube.com/embed/1I1eLu9v_hM" 
                                    title="Wayne Stevenson - The Zen Builder (Official 4K Music Video)" 
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen></iframe>
                        </div>

                        <!-- Audio Streaming Deck & Quick Links -->
                        <div class="recomp-featured-short-deck" style="margin-top: 16px; background: rgba(8, 12, 20, 0.85); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 14px; padding: 14px 18px; display: flex; align-items: center; gap: 16px;">
                            
                            <!-- Track Thumbnail Box -->
                            <div style="position: relative; width: 120px; height: 68px; min-width: 120px; border-radius: 8px; overflow: hidden; background: #000; border: 1.5px solid rgba(245, 158, 11, 0.4); flex-shrink: 0;">
                                <img src="https://img.youtube.com/vi/1I1eLu9v_hM/maxresdefault.jpg" alt="The Zen Builder" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://img.youtube.com/vi/1I1eLu9v_hM/hqdefault.jpg'" />
                            </div>

                            <!-- Track Details & Audio Meta -->
                            <div style="flex: 1; min-width: 0;">
                                <div style="display: inline-block; background: rgba(245, 158, 11, 0.12); border: 1px solid rgba(245, 158, 11, 0.35); color: #fbbf24; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; padding: 2px 8px; border-radius: 4px; letter-spacing: 0.06em; margin-bottom: 6px;">
                                    🎵 24-BIT / 48kHz LOSSLESS MASTER
                                </div>
                                <h4 style="margin: 0 0 4px 0; color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 0.96rem; font-weight: 800; line-height: 1.3;">
                                    Architectural Focus &bull; Track 1
                                </h4>
                                <p style="margin: 0 0 10px 0; color: #94a3b8; font-size: 0.78rem; line-height: 1.45;">
                                    432Hz Cellular Healing &bull; Too Lost Digital Distribution
                                </p>
                                <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                                    <a href="https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #d4af37 0%, #f3e5ab 50%, #aa8010 100%); color: #04070d !important; -webkit-text-fill-color: #04070d !important; font-size: 0.78rem; font-weight: 800; padding: 8px 14px; border-radius: 9999px; text-decoration: none !important; box-shadow: 0 4px 12px rgba(212, 175, 55, 0.35);">
                                        <span>🎧</span> Stream on Spotify
                                    </a>
                                    <a href="https://www.youtube.com/@KeyStoneRecomposition?sub_confirmation=1" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; background: rgba(56, 189, 248, 0.12); border: 1px solid rgba(56, 189, 248, 0.45); color: #38bdf8 !important; -webkit-text-fill-color: #38bdf8 !important; font-size: 0.78rem; font-weight: 700; padding: 8px 14px; border-radius: 9999px; text-decoration: none !important;">
                                        <span>🔔</span> Subscribe Channel
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column (45%): Sonic Architecture Write-up -->
                    <div class="recomp-featured-content-wrap" style="flex: 1 1 45%; width: 45%; min-width: 0; display: flex; flex-direction: column; justify-content: center; box-sizing: border-box; position: relative; z-index: 3; transform: translateZ(0);">
                        
                        <!-- Metadata Pill Row -->
                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 0.85rem; flex-wrap: wrap;">
                            <span class="recomp-cat-badge" style="background: rgba(245, 158, 11, 0.12); border: 1px solid rgba(245, 158, 11, 0.4); color: #fbbf24; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 800; padding: 4px 10px; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.05em;">
                                432Hz_SOUND_HEALING // SONIC UNIVERSE
                            </span>
                            <span style="color: #94a3b8; font-size: 0.80rem; font-weight: 600;">October 2026</span>
                            <span style="color: #f6d365; font-size: 0.78rem; font-weight: 700;">4:10 DURATION</span>
                        </div>

                        <!-- Main Title -->
                        <h2 style="font-family: 'Outfit', sans-serif; font-size: clamp(1.4rem, 2.2vw, 1.95rem); font-weight: 900; line-height: 1.25; color: #ffffff; margin: 0 0 1rem 0; letter-spacing: -0.01em;">
                            The Zen Builder: 432Hz Sound Healing, Deep Focus &amp; Cellular Recovery Architecture
                        </h2>

                        <!-- Excerpt Write-up -->
                        <p style="font-size: clamp(0.90rem, 1.05vw, 1.0rem); color: #cbd5e1; line-height: 1.7; margin: 0 0 1.5rem 0;">
                            The flagship 432Hz restorative music release from <em>Architectural Focus</em>. Produced in Squamish, BC by Wayne Stevenson &mdash; combining deep analog basslines, 432Hz cellular recovery frequencies, and a structured narrative arc rendered in 4K resolution using Google Flow and DaVinci Resolve Studio.
                        </p>

                        <!-- Wayne Stevenson Author Signature & Credentials -->
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
                            <img decoding="async" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/wayne_avatar.jpg' ); ?>" alt="Wayne Stevenson" style="width: 48px; height: 48px; border-radius: 50%; border: 2px solid #fbbf24; object-fit: cover; flex-shrink: 0; box-shadow: 0 0 12px rgba(245, 158, 11, 0.3);" />
                            <div>
                                <div style="color: #ffffff; font-weight: 800; font-size: 0.92rem; line-height: 1.2;">Wayne Stevenson</div>
                                <div style="color: #fbbf24; font-size: 0.78rem; font-weight: 600;">Music Producer &bull; Sovereign AI Architect &bull; Squamish, BC</div>
                            </div>
                        </div>

                        <!-- Action Buttons Box -->
                        <div class="recomp-featured-buttons-box" style="display: flex; flex-direction: column; gap: 10px; max-width: 360px; width: 100%;">
                            <a href="https://keystonerecomposition.com/2026/10/08/zen-healing-frequency-432hz/" style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 42px; min-height: 42px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #04070d !important; -webkit-text-fill-color: #04070d !important; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 800; letter-spacing: 0.05em; padding: 0 20px; border-radius: 50px; text-decoration: none !important; box-shadow: 0 6px 20px rgba(245, 158, 11, 0.35); box-sizing: border-box; transition: all 0.25s ease;">
                                <span>READ SONIC ESSAY &amp; CREDITS &rarr;</span>
                            </a>
                            <a href="https://youtu.be/1I1eLu9v_hM" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 42px; min-height: 42px; background: rgba(15, 23, 42, 0.90); border: 1.5px solid rgba(245, 158, 11, 0.45); color: #ffffff !important; -webkit-text-fill-color: #ffffff !important; font-family: 'Outfit', sans-serif; font-size: 0.82rem; font-weight: 700; letter-spacing: 0.04em; padding: 0 20px; border-radius: 50px; text-decoration: none !important; box-sizing: border-box; transition: all 0.25s ease;">
                                <span>WATCH IN 4K ON YOUTUBE &rarr;</span>
                            </a>
                        </div>

                    </div>

                </div>
            </section>

            <!-- 3. Chronological 2x3 Grid of Blog Posts (3 Up Top, 3 Below It = 6 Cards Per Page with Page Controls) -->
            <section class="recomp-blog-grid-section-wrap" style="margin-top: 2rem;">

                <!-- Header & Pagination Controls -->
                <div class="recomp-grid-header-row" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 2rem; border-bottom: 1px solid rgba(56, 189, 248, 0.25); padding-bottom: 1.25rem;">
                    <div style="flex: 1; min-width: 250px;">
                        <div style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.74rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 0.25rem;">
                            ✦ MASTER ARCHIVES &bull; 6 INTEL DROPS PER VIEW
                        </div>
                        <h3 class="recomp-grid-heading" style="font-family: 'Outfit', sans-serif; font-size: clamp(1.25rem, 2.2vw, 1.65rem); font-weight: 800; color: #ffffff; margin: 0; line-height: 1.25;">
                            Chronological Technical Intel Stream
                        </h3>
                    </div>

                    <!-- Page Buttons & Counter -->
                    <div class="recomp-grid-controls-top" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <span id="recomp-grid-page-indicator" style="color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.80rem; font-weight: 800; letter-spacing: 0.06em;">
                            PAGE 1 OF 2 &bull; INTEL 1–6 OF 12
                        </span>
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <button type="button" id="recomp-prev-btn" onclick="window.recompChangePage(-1)" aria-label="Previous Page" style="width: 42px; height: 42px; border-radius: 50%; background: rgba(15, 23, 42, 0.95); border: 1.5px solid #38bdf8; color: #38bdf8; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease;">
                                <span style="font-size: 1.2rem; font-weight: 900; line-height: 1;">&#10094;</span>
                            </button>
                            <button type="button" id="recomp-page-1-btn" onclick="window.recompGoToPage(1)" style="min-width: 42px; height: 42px; border-radius: 21px; background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%); border: 1.5px solid #38bdf8; color: #04070d; font-weight: 900; font-size: 0.90rem; cursor: pointer; padding: 0 14px; box-shadow: 0 0 12px rgba(56, 189, 248, 0.4);">
                                1
                            </button>
                            <button type="button" id="recomp-page-2-btn" onclick="window.recompGoToPage(2)" style="min-width: 42px; height: 42px; border-radius: 21px; background: rgba(15, 23, 42, 0.95); border: 1.5px solid rgba(56, 189, 248, 0.4); color: #94a3b8; font-weight: 800; font-size: 0.90rem; cursor: pointer; padding: 0 14px;">
                                2
                            </button>
                            <button type="button" id="recomp-next-btn" onclick="window.recompChangePage(1)" aria-label="Next Page" style="width: 42px; height: 42px; border-radius: 50%; background: rgba(15, 23, 42, 0.95); border: 1.5px solid #38bdf8; color: #38bdf8; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease;">
                                <span style="font-size: 1.2rem; font-weight: 900; line-height: 1;">&#10095;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- 2x3 Grid Container (Cards 1 to 6 on Page 1, Cards 7 to 12 on Page 2) -->
                <div id="recomp-intel-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; margin-bottom: 2.5rem;">

                    <?php
                    $theme_assets_uri = get_stylesheet_directory_uri() . '/assets/images';
                    // 12 Authentic High-End Technical Intel & Sonic Research Drops
                    $drops = array(
                        1 => array(
                            'page' => 1, 'slot' => '01', 'tier' => 'INTEL DROP 01', 'cat' => 'AI &amp; ARCHITECTURE', 'read' => '12 MIN READ',
                            'title' => 'Autonomous Multi-Agent Swarms: The 28-Agent FastMCP Architecture',
                            'excerpt' => 'Deep-dive architectural breakdown of Wayne Stevenson\'s local 28-agent FastMCP swarms, typed tool contracts, and automated Chrome DevTools execution.',
                            'image' => $theme_assets_uri . '/ai_protocols_banner.png',
                            'link' => '/2026/09/28/autonomous-multi-agent-swarms-fastmcp-architecture/',
                            'status' => '● LIVE INTEL', 'status_color' => '#38bdf8',
                        ),
                        2 => array(
                            'page' => 1, 'slot' => '02', 'tier' => 'INTEL DROP 02', 'cat' => 'CHROME CDP AUTOMATION', 'read' => '10 MIN READ',
                            'title' => 'Zero-Cloud Chrome CDP Automation: Eliminating Headless Browser Bot Detection',
                            'excerpt' => 'How to eliminate flaky Selenium and Puppeteer cloud proxies by latching sovereign AI agents directly into Wayne\'s active desktop Chrome browser on Port 9222.',
                            'image' => $theme_assets_uri . '/trading_terminal_luxury.jpg',
                            'link' => '/2026/09/28/chrome-devtools-protocol-cdp-port-9222-automation/',
                            'status' => '● LIVE INTEL', 'status_color' => '#38bdf8',
                        ),
                        3 => array(
                            'page' => 1, 'slot' => '03', 'tier' => 'INTEL DROP 03', 'cat' => 'SONIC ARCHITECTURE', 'read' => '15 MIN READ',
                            'title' => 'Sovereign Reverb: Functional Frequency Architecture &amp; High-Cadence Focus',
                            'excerpt' => 'Engineering electronic audio frequencies to sustain deep flow state during intensive building sprints. Complete 22-release studio master telemetry.',
                            'image' => $theme_assets_uri . '/albums/sovereign_reverb.jpg',
                            'link' => '/2026/09/28/sovereign-reverb-functional-frequency-architecture/',
                            'status' => '● LIVE INTEL', 'status_color' => '#38bdf8',
                        ),
                        4 => array(
                            'page' => 1, 'slot' => '04', 'tier' => 'INTEL DROP 04', 'cat' => 'FASTMCP PROTOCOLS', 'read' => '11 MIN READ',
                            'title' => 'FastMCP Typed Tool Contracts: Bridging Python Daemons with Desktop Workstations',
                            'excerpt' => 'Implementing strictly typed schemas, non-blocking asynchronous socket dispatch, and IPC telemetry across local FastMCP background daemons.',
                            'image' => $theme_assets_uri . '/ai_protocols_banner.png',
                            'link' => '/ai-protocols/',
                            'status' => '● ARCHITECTURAL BRIEFING', 'status_color' => '#38bdf8',
                        ),
                        5 => array(
                            'page' => 1, 'slot' => '05', 'tier' => 'INTEL DROP 05', 'cat' => 'QUANTITATIVE INTELLIGENCE', 'read' => '13 MIN READ',
                            'title' => 'Deterministic NOAA HRRR Weather Modeling: Autonomous Prediction Swarms',
                            'excerpt' => 'High-resolution rapid refresh physics engines analyzing wind shear and temperature anomalies for convex prediction market positioning.',
                            'image' => $theme_assets_uri . '/trading_terminal_luxury.jpg',
                            'link' => '/investments/',
                            'status' => '● ARCHITECTURAL BRIEFING', 'status_color' => '#38bdf8',
                        ),
                        6 => array(
                            'page' => 1, 'slot' => '06', 'tier' => 'INTEL DROP 06', 'cat' => 'AUDIO ENGINEERING', 'read' => '9 MIN READ',
                            'title' => 'Local-First Voice Telemetry: Piper TTS &amp; Whisper STT OS Daemon Engineering',
                            'excerpt' => 'Eliminating cloud voice API roundtrips with sub-50ms local neural text-to-speech and speech-to-text daemons running directly on RTX silicon.',
                            'image' => $theme_assets_uri . '/sonic_universe_banner.png',
                            'link' => '/sonic-universe/',
                            'status' => '● ARCHITECTURAL BRIEFING', 'status_color' => '#38bdf8',
                        ),
                        7 => array(
                            'page' => 2, 'slot' => '07', 'tier' => 'INTEL DROP 07', 'cat' => 'FINANCIAL ARCHITECTURE', 'read' => '14 MIN READ',
                            'title' => 'The 40% Cash Fortress CAD Protocol: Algorithmic Treasury Compounding',
                            'excerpt' => 'Protecting core liquidity with an inviolable 40% cash reserve floor while compounding surplus float through automated momentum locks.',
                            'image' => $theme_assets_uri . '/trading_terminal_luxury.jpg',
                            'link' => '/investments/',
                            'status' => '● ARCHITECTURAL BRIEFING', 'status_color' => '#38bdf8',
                        ),
                        8 => array(
                            'page' => 2, 'slot' => '08', 'tier' => 'INTEL DROP 08', 'cat' => 'GENERATIVE VIDEO', 'read' => '12 MIN READ',
                            'title' => 'Google Flow Box 2 Generative Video: Automated Reverse Grid Canvas Renaming',
                            'excerpt' => 'CDP automation protocols for reverse grid batch prompt generation, Angular CDK virtual scroll interaction, and 100% prompt verification.',
                            'image' => $theme_assets_uri . '/ai_protocols_banner.png',
                            'link' => '/ai-protocols/',
                            'status' => '● ARCHITECTURAL BRIEFING', 'status_color' => '#38bdf8',
                        ),
                        9 => array(
                            'page' => 2, 'slot' => '09', 'tier' => 'INTEL DROP 09', 'cat' => 'DAVINCI AUTOMATION', 'read' => '10 MIN READ',
                            'title' => 'DaVinci Resolve Studio API: 2-Track Master Assembly &amp; -18dB Audio Ducking',
                            'excerpt' => 'Automating dual-track timeline construction, optical flow slow-motion interpolation, and dynamic audio ducking via Python Resolve scripting.',
                            'image' => $theme_assets_uri . '/sonic_universe_banner.png',
                            'link' => '/sonic-universe/',
                            'status' => '● ARCHITECTURAL BRIEFING', 'status_color' => '#38bdf8',
                        ),
                        10 => array(
                            'page' => 2, 'slot' => '10', 'tier' => 'INTEL DROP 10', 'cat' => 'PHYSICAL RECOMPOSITION', 'read' => '16 MIN READ',
                            'title' => 'Squamish High-Performance Living: N=1 Physical Recomposition Case Study',
                            'excerpt' => 'Documented 48-pound fat loss, heavy compound strength training, sub-50°F cold water immersion, and metabolic protocols in the Sea-to-Sky corridor.',
                            'image' => $theme_assets_uri . '/bc_luxury_multiplex.jpg',
                            'link' => '/lifestyle/',
                            'status' => '● ARCHITECTURAL BRIEFING', 'status_color' => '#38bdf8',
                        ),
                        11 => array(
                            'page' => 2, 'slot' => '11', 'tier' => 'INTEL DROP 11', 'cat' => 'SOVEREIGN ASSETS', 'read' => '13 MIN READ',
                            'title' => 'Sovereign Fideicomiso Real Estate Assets: Multi-Jurisdictional Wealth Defense',
                            'excerpt' => 'Navigating Mexican bank trusts (Fideicomiso) and EU property acquisitions to establish sovereign, resilient international asset footholds.',
                            'image' => $theme_assets_uri . '/trading_terminal_luxury.jpg',
                            'link' => '/founder/',
                            'status' => '● ARCHITECTURAL BRIEFING', 'status_color' => '#38bdf8',
                        ),
                        12 => array(
                            'page' => 2, 'slot' => '12', 'tier' => 'INTEL DROP 12', 'cat' => 'LICENSED CONSTRUCTION', 'read' => '15 MIN READ',
                            'title' => 'Building BC Housing Licensed Infill: Bill 44 Multiplex Yield Engineering',
                            'excerpt' => 'Vancouver R1-1 multiplex zoning yields, BC Step Code 5 compliance, and structural engineering under statutory BC Housing License #52603.',
                            'image' => $theme_assets_uri . '/keystone_possibilities_crest.png',
                            'link' => 'https://keystonepossibilities.ca',
                            'status' => '● ARCHITECTURAL BRIEFING', 'status_color' => '#38bdf8',
                        ),
                    );

                    for ( $i = 1; $i <= 12; $i++ ) :
                        $d = $drops[ $i ];
                        $page_class = ( $d['page'] === 1 ) ? 'recomp-grid-page-1' : 'recomp-grid-page-2';
                        $initial_display = ( $d['page'] === 1 ) ? 'display: flex;' : 'display: none;';
                    ?>
                        <article class="recomp-grid-card <?php echo esc_attr( $page_class ); ?>" 
                                 data-slot="<?php echo esc_attr( $d['slot'] ); ?>" 
                                 style="<?php echo esc_attr( $initial_display ); ?> cursor: pointer; background: rgba(10, 15, 25, 0.75); border: 1px solid rgba(56, 189, 248, 0.28); border-radius: 18px; padding: 18px; flex-direction: column; justify-content: space-between; box-shadow: 0 10px 25px rgba(0,0,0,0.55); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;" 
                                 onclick="window.location.href='<?php echo esc_url( $d['link'] ); ?>';">
                            <div>
                                <!-- 16:9 Thumbnail Slot -->
                                <div style="position: relative; width: 100%; aspect-ratio: 16 / 9; border-radius: 12px; overflow: hidden; margin-bottom: 14px; background: #000; border: 1px solid rgba(56, 189, 248, 0.2);">
                                    <img decoding="async" src="<?php echo esc_url( $d['image'] ); ?>" alt="<?php echo esc_attr( $d['title'] ); ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" loading="lazy" />
                                    <div style="position: absolute; top: 10px; left: 10px; background: rgba(10, 15, 25, 0.85); border: 1px solid rgba(56, 189, 248, 0.5); padding: 3px 8px; border-radius: 9999px; font-family: 'JetBrains Mono', monospace; font-size: 0.68rem; font-weight: 800; color: #38bdf8;">
                                        <?php echo esc_html( $d['tier'] ); ?>
                                    </div>
                                    <div style="position: absolute; bottom: 10px; right: 10px; background: rgba(10, 15, 25, 0.85); border: 1px solid rgba(255, 255, 255, 0.1); padding: 3px 8px; border-radius: 9999px; font-size: 0.68rem; font-weight: 700; color: #ffffff;">
                                        <?php echo esc_html( $d['read'] ); ?>
                                    </div>
                                </div>

                                <!-- Category & Slot Meta -->
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span class="recomp-category-badge" style="background: rgba(56, 189, 248, 0.12); color: #38bdf8; font-family: 'JetBrains Mono', monospace; font-size: 0.70rem; font-weight: 800; padding: 2px 8px; border-radius: 9999px;">
                                        <?php echo wp_kses_post( $d['cat'] ); ?>
                                    </span>
                                    <span style="color: #f6d365; font-family: 'JetBrains Mono', monospace; font-size: 0.72rem; font-weight: 700;">
                                        SLOT <?php echo esc_html( $d['slot'] ); ?>
                                    </span>
                                </div>

                                <!-- Title -->
                                <h4 class="recomp-card-title" style="margin: 0 0 8px 0; color: #ffffff; font-family: 'Outfit', sans-serif; font-size: 1.12rem; font-weight: 800; line-height: 1.35;">
                                    <?php echo esc_html( $d['title'] ); ?>
                                </h4>

                                <!-- Excerpt -->
                                <p class="recomp-card-excerpt" style="margin: 0 0 14px 0; color: #94a3b8; font-size: 0.85rem; line-height: 1.55;">
                                    <?php echo esc_html( $d['excerpt'] ); ?>
                                </p>
                            </div>

                            <!-- Footer -->
                            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255, 255, 255, 0.08); padding-top: 12px; margin-top: 8px;">
                                <span style="color: #38bdf8; font-weight: 800; font-size: 0.82rem; letter-spacing: 0.03em;">
                                    Read Technical Intel &rarr;
                                </span>
                                <span style="color: <?php echo esc_attr( $d['status_color'] ); ?>; font-size: 0.72rem; font-weight: 700;">
                                    <?php echo esc_html( $d['status'] ); ?>
                                </span>
                            </div>
                        </article>
                    <?php endfor; ?>

                </div>

                <!-- Bottom Pagination Bar -->
                <div class="recomp-pagination-bottom" style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-top: 1.5rem; margin-bottom: 3.5rem;">
                    <button type="button" onclick="window.recompChangePage(-1)" class="recomp-nav-pill-btn" style="width: 155px; min-width: 155px; max-width: 155px; height: 42px; border-radius: 50px; background: rgba(15, 23, 42, 0.95); border: 1.5px solid #38bdf8; color: #38bdf8; font-weight: 800; font-size: 0.84rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 6px; box-sizing: border-box; padding: 0; transition: all 0.2s ease;">
                        <span style="font-size: 1.05rem; line-height: 1;">&#10094;</span> Previous Page
                    </button>
                    <button type="button" onclick="window.recompGoToPage(1)" id="recomp-bottom-page-1" style="width: 42px; min-width: 42px; max-width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%); border: 1.5px solid #38bdf8; color: #04070d; font-weight: 900; font-size: 0.90rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; line-height: 1; flex-shrink: 0; box-sizing: border-box; padding: 0; box-shadow: 0 0 12px rgba(56, 189, 248, 0.4);">
                        1
                    </button>
                    <button type="button" onclick="window.recompGoToPage(2)" id="recomp-bottom-page-2" style="width: 42px; min-width: 42px; max-width: 42px; height: 42px; border-radius: 50%; background: rgba(15, 23, 42, 0.95); border: 1.5px solid rgba(56, 189, 248, 0.4); color: #94a3b8; font-weight: 800; font-size: 0.90rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; line-height: 1; flex-shrink: 0; box-sizing: border-box; padding: 0;">
                        2
                    </button>
                    <button type="button" onclick="window.recompChangePage(1)" class="recomp-nav-pill-btn" style="width: 155px; min-width: 155px; max-width: 155px; height: 42px; border-radius: 50px; background: rgba(15, 23, 42, 0.95); border: 1.5px solid #38bdf8; color: #38bdf8; font-weight: 800; font-size: 0.84rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 6px; box-sizing: border-box; padding: 0; transition: all 0.2s ease;">
                        Next Page <span style="font-size: 1.05rem; line-height: 1;">&#10095;</span>
                    </button>
                </div>

            </section>

        </div>
    </main>
</div>

<!-- Dynamic REST API Ingestion, Pagination & Responsive Engine -->
<script>
(function() {
    var styleId = 'recomp-responsive-hub-styles';
    if (!document.getElementById(styleId)) {
        var s = document.createElement('style');
        s.id = styleId;
        s.textContent = '.recomp-featured-layout > p, #recomp-intel-grid > p, .recomp-blog-grid-section-wrap > p { display: none !important; margin: 0 !important; padding: 0 !important; height: 0 !important; width: 0 !important; border: none !important; position: absolute !important; pointer-events: none !important; } .recomp-grid-card:hover { transform: translateY(-5px) !important; border-color: #38bdf8 !important; box-shadow: 0 12px 35px rgba(56, 189, 248, 0.25) !important; } @media (max-width: 1080px) { #recomp-intel-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 20px !important; } } @media (max-width: 900px) { .recomp-featured-layout { flex-direction: column !important; gap: 28px !important; } .recomp-featured-left-col, .recomp-featured-content-wrap { width: 100% !important; max-width: 100% !important; flex: none !important; } .recomp-featured-content-wrap { margin-top: 10px !important; } .recomp-featured-buttons-box { max-width: 100% !important; } .recomp-featured-buttons-box a { width: 100% !important; } } @media (max-width: 600px) { #recomp-featured-intel-container { padding: 1.25rem 1rem !important; border-radius: 18px !important; } .recomp-featured-short-deck { flex-direction: column !important; text-align: center !important; padding: 16px 14px !important; gap: 14px !important; } .recomp-featured-short-player-box { width: 160px !important; height: 284px !important; margin: 0 auto !important; } .recomp-featured-short-actions { display: flex !important; flex-direction: row !important; gap: 8px !important; justify-content: center !important; width: 100% !important; flex-wrap: wrap !important; } .recomp-featured-short-actions a { font-size: 0.78rem !important; padding: 9px 15px !important; } .recomp-featured-h2 { font-size: 1.45rem !important; line-height: 1.3 !important; } .recomp-featured-excerpt { font-size: 0.90rem !important; line-height: 1.6 !important; } .recomp-grid-header-row { flex-direction: column !important; align-items: flex-start !important; gap: 12px !important; } .recomp-grid-header-row .recomp-grid-heading { font-size: 1.32rem !important; } .recomp-grid-controls-top { width: 100% !important; justify-content: space-between !important; } #recomp-intel-grid { grid-template-columns: 1fr !important; gap: 20px !important; } .recomp-pagination-bottom { flex-wrap: wrap !important; gap: 8px !important; } .recomp-pagination-bottom .recomp-nav-pill-btn { width: 135px !important; min-width: 135px !important; font-size: 0.78rem !important; } }';
        document.head.appendChild(s);
    }
})();

window.recompCurrentPage = 1;
window.recompGoToPage = function(p) {
    window.recompCurrentPage = p;
    var p1Cards = document.querySelectorAll('.recomp-grid-page-1');
    var p2Cards = document.querySelectorAll('.recomp-grid-page-2');
    var ind = document.getElementById('recomp-grid-page-indicator');
    var b1 = document.getElementById('recomp-page-1-btn');
    var b2 = document.getElementById('recomp-page-2-btn');
    var bb1 = document.getElementById('recomp-bottom-page-1');
    var bb2 = document.getElementById('recomp-bottom-page-2');

    if (p === 1) {
        p1Cards.forEach(function(c) { c.style.display = 'flex'; });
        p2Cards.forEach(function(c) { c.style.display = 'none'; });
        if (ind) ind.innerText = 'PAGE 1 OF 2 • INTEL 1–6 OF 12';
        if (b1) {
            b1.style.background = 'linear-gradient(135deg, #38bdf8 0%, #0284c7 100%)';
            b1.style.color = '#04070d';
            b1.style.borderColor = '#38bdf8';
            b1.style.boxShadow = '0 0 12px rgba(56, 189, 248, 0.4)';
        }
        if (b2) {
            b2.style.background = 'rgba(15, 23, 42, 0.95)';
            b2.style.color = '#94a3b8';
            b2.style.borderColor = 'rgba(56, 189, 248, 0.4)';
            b2.style.boxShadow = 'none';
        }
        if (bb1) {
            bb1.style.background = 'linear-gradient(135deg, #38bdf8 0%, #0284c7 100%)';
            bb1.style.color = '#04070d';
            bb1.style.borderColor = '#38bdf8';
            bb1.style.boxShadow = '0 0 12px rgba(56, 189, 248, 0.4)';
        }
        if (bb2) {
            bb2.style.background = 'rgba(15, 23, 42, 0.95)';
            bb2.style.color = '#94a3b8';
            bb2.style.borderColor = 'rgba(56, 189, 248, 0.4)';
            bb2.style.boxShadow = 'none';
        }
    } else {
        p1Cards.forEach(function(c) { c.style.display = 'none'; });
        p2Cards.forEach(function(c) { c.style.display = 'flex'; });
        if (ind) ind.innerText = 'PAGE 2 OF 2 • INTEL 7–12 OF 12';
        if (b2) {
            b2.style.background = 'linear-gradient(135deg, #38bdf8 0%, #0284c7 100%)';
            b2.style.color = '#04070d';
            b2.style.borderColor = '#38bdf8';
            b2.style.boxShadow = '0 0 12px rgba(56, 189, 248, 0.4)';
        }
        if (b1) {
            b1.style.background = 'rgba(15, 23, 42, 0.95)';
            b1.style.color = '#94a3b8';
            b1.style.borderColor = 'rgba(56, 189, 248, 0.4)';
            b1.style.boxShadow = 'none';
        }
        if (bb2) {
            bb2.style.background = 'linear-gradient(135deg, #38bdf8 0%, #0284c7 100%)';
            bb2.style.color = '#04070d';
            bb2.style.borderColor = '#38bdf8';
            bb2.style.boxShadow = '0 0 12px rgba(56, 189, 248, 0.4)';
        }
        if (bb1) {
            bb1.style.background = 'rgba(15, 23, 42, 0.95)';
            bb1.style.color = '#94a3b8';
            bb1.style.borderColor = 'rgba(56, 189, 248, 0.4)';
            bb1.style.boxShadow = 'none';
        }
    }
};

window.recompChangePage = function(delta) {
    var nextP = window.recompCurrentPage + delta;
    if (nextP < 1) nextP = 1;
    if (nextP > 2) nextP = 2;
    window.recompGoToPage(nextP);
};

function recompDecodeHtml(raw) {
    var el = document.createElement('div');
    el.innerHTML = raw;
    return (el.textContent || el.innerText || '').trim();
}

async function loadPublishedIntel() {
    try {
        var u = new URL('/wp-json/wp/v2/posts', window.location.origin);
        u.searchParams.set('per_page', '13');
        u.searchParams.set('_embed', '1');
        u.searchParams.set('orderby', 'date');
        u.searchParams.set('order', 'desc');
        u.searchParams.set('status', 'publish');

        var response = await fetch(u.toString());
        if (!response.ok) return;
        var posts = await response.json();
        if (!Array.isArray(posts) || posts.length === 0) return;

        // 1. Ingest Featured Post into Hero Section
        var featuredPost = posts[0];
        var featTitle = document.getElementById('recomp-featured-title');
        var featExcerpt = document.getElementById('recomp-featured-excerpt');
        var featLink = document.getElementById('recomp-featured-link');
        var featDate = document.getElementById('recomp-featured-date');

        if (featTitle && featuredPost.title && featuredPost.title.rendered) {
            featTitle.innerHTML = featuredPost.title.rendered;
        }
        if (featExcerpt && featuredPost.excerpt && featuredPost.excerpt.rendered) {
            var cleanExcerpt = recompDecodeHtml(featuredPost.excerpt.rendered)
                .replace(/\[.*?\]/g, '')
                .replace(/^\/\/\s*2026[^\n\r.]*[\n\r.]*\s*/i, '')
                .replace(/^\/\/\s*[A-Z0-9 _•&\/:-]{6,85}\s*/i, '')
                .trim();
            if (cleanExcerpt.length > 20) {
                featExcerpt.innerText = cleanExcerpt.substring(0, 240) + '...';
            }
        }
        if (featLink && featuredPost.link) {
            featLink.href = featuredPost.link;
        }
        if (featDate && featuredPost.date) {
            featDate.innerText = new Date(featuredPost.date).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
        }

        // Parse YouTube embeds if present in content (filtering out retired/unavailable staging IDs)
        var contentHtml = (featuredPost.content && featuredPost.content.rendered) ? featuredPost.content.rendered : '';
        var longIframe = document.getElementById('recomp-featured-long-video');
        var shortIframe = document.getElementById('recomp-featured-short-video');
        var shortLink = document.getElementById('recomp-featured-short-link');
        var shortDeck = document.querySelector('.recomp-featured-short-deck');
        var retiredIds = ['3rYyZ0c8_1o', 'XUiFyItyyzo'];

        var ytRegex = /(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/g;
        var match;
        var ytIds = [];
        while ((match = ytRegex.exec(contentHtml)) !== null) {
            if (match[1] && retiredIds.indexOf(match[1]) === -1 && ytIds.indexOf(match[1]) === -1) {
                ytIds.push(match[1]);
            }
        }

        var foundLong = ytIds.length > 0 ? ytIds[0] : null;
        var foundShort = ytIds.length > 1 ? ytIds[1] : null;
        var explicitShort = contentHtml.match(/shorts\/([a-zA-Z0-9_-]{11})/);
        if (explicitShort && explicitShort[1] && retiredIds.indexOf(explicitShort[1]) === -1) {
            foundShort = explicitShort[1];
        }

        if (foundLong && longIframe) {
            longIframe.src = 'https://www.youtube.com/embed/' + foundLong + '?rel=0';
        }
        if (foundShort) {
            if (shortDeck) shortDeck.style.display = 'flex';
            if (shortIframe) shortIframe.src = 'https://www.youtube.com/embed/' + foundShort + '?rel=0';
            if (shortLink) shortLink.href = 'https://youtube.com/shorts/' + foundShort;
        }

        // 2. Populate Grid Cards with actual published posts
        var cards = document.querySelectorAll('.recomp-grid-card');
        posts.forEach(function(post, idx) {
            if (idx < cards.length) {
                var card = cards[idx];
                var postMedia = (post._embedded && post._embedded['wp:featuredmedia']) ? post._embedded['wp:featuredmedia'][0] : null;
                var postThumb = null;
                if (postMedia) {
                    if (postMedia.media_details && postMedia.media_details.sizes && postMedia.media_details.sizes.medium_large) {
                        postThumb = postMedia.media_details.sizes.medium_large.source_url;
                    } else {
                        postThumb = postMedia.source_url;
                    }
                }

                var postTitle = (post.title && post.title.rendered) ? post.title.rendered : '';
                var postExcerpt = '';
                if (post.excerpt && post.excerpt.rendered) {
                    var cEx = recompDecodeHtml(post.excerpt.rendered)
                        .replace(/\[.*?\]/g, '')
                        .replace(/^\/\/\s*2026[^\n\r.]*[\n\r.]*\s*/i, '')
                        .replace(/^\/\/\s*[A-Z0-9 _•&\/:-]{6,85}\s*/i, '')
                        .trim();
                    postExcerpt = cEx.substring(0, 125) + '...';
                }

                if (postThumb) {
                    var imgEl = card.querySelector('img');
                    if (imgEl) imgEl.src = postThumb;
                }
                if (postTitle) {
                    var titleEl = card.querySelector('.recomp-card-title');
                    if (titleEl) titleEl.innerHTML = postTitle;
                }
                if (postExcerpt) {
                    var excerptEl = card.querySelector('.recomp-card-excerpt');
                    if (excerptEl) excerptEl.innerText = postExcerpt;
                }
                var statusSpans = card.querySelectorAll('div:last-child span');
                if (statusSpans.length >= 2) {
                    statusSpans[1].innerText = '● LIVE INTEL';
                    statusSpans[1].style.color = '#38bdf8';
                }
                card.style.cursor = 'pointer';
                card.onclick = function() {
                    window.location.href = post.link;
                };
            }
        });
    } catch (e) {
        console.warn('[Keystone Recomposition Intel] Ingestion check:', e);
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadPublishedIntel);
} else {
    loadPublishedIntel();
}
</script>

<?php get_footer(); ?>
