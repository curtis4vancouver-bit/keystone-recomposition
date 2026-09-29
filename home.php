<?php
/**
 * The blog archive template for INTEL & PROTOCOLS (/intel/ or /blog/)
 * Keystone Recomposition Child Theme
 * Version: 3.5.0 (PHP 8.2+ Strict Types)
 *
 * Designed to Wayne's exact standard:
 * - Sleek, centered top header with cyan telemetry pill
 * - Zero gray bars or headers
 * - 3 rotating vertical column blocks styled like Wayne's approved columns
 * - 16:9 widescreen master video containers staged and ready for new blogs and videos
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div id="primary" class="content-area primary keystone-intel-archive">
    <main id="main" class="site-main">
        <div class="ast-container">
            
            <!-- 1. Sleek, Centered Top Area -->
            <header class="intel-archive-header text-center">
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

            <!-- 2. 3 Rotating Vertical Column Blocks (Staged & Ready for Blogs with Video) -->
            <div class="intel-posts-grid">
                
                <?php
                // Staged slot specifications ready to receive Wayne's upcoming video masterclasses and blogs
                $staged_slots = array(
                    1 => array(
                        'tier'    => 'STAGED INTEL DROP 01',
                        'cat'     => 'AI &amp; ARCHITECTURE',
                        'title'   => 'Autonomous Multi-Agent Swarms: The 16-Agent FastMCP Production Blueprint',
                        'desc'    => 'Deep-dive architectural breakdown of Wayne Stevenson\'s local 16-agent swarms, typed FastMCP contracts, and automated Chrome DevTools execution. Staged for master video release.',
                        'runtime' => '16:9 4K VIDEO SLOT // STAGED',
                    ),
                    2 => array(
                        'tier'    => 'STAGED INTEL DROP 02',
                        'cat'     => 'CHROME CDP AUTOMATION',
                        'title'   => 'Zero-Cloud Chrome CDP Automation: Eliminating Headless Browser Bot Detection',
                        'desc'    => 'How to eliminate flaky Selenium and Puppeteer cloud proxies by latching sovereign AI agents directly into Wayne\'s active desktop Chrome browser on Port 9222. Staged for master video release.',
                        'runtime' => '16:9 4K VIDEO SLOT // STAGED',
                    ),
                    3 => array(
                        'tier'    => 'STAGED INTEL DROP 03',
                        'cat'     => 'SONIC ARCHITECTURE',
                        'title'   => 'Sovereign Reverb: Functional Frequency Architecture &amp; High-Cadence Focus',
                        'desc'    => 'Engineering electronic audio frequencies to sustain deep flow state during intensive building sprints. Complete 18-album studio master telemetry. Staged for master video release.',
                        'runtime' => '16:9 4K VIDEO SLOT // STAGED',
                    ),
                );

                for ( $slot = 1; $slot <= 3; $slot++ ) : 
                    $slot_data = $staged_slots[ $slot ];
                ?>
                    <article class="intel-post-card staged-card">
                        
                        <!-- 16:9 Video Container / Player Frame -->
                        <div class="card-video-slot">
                            <div class="video-placeholder-frame">
                                <div class="video-play-pulse">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                                <span class="video-status-tag"><?php echo esc_html( $slot_data['runtime'] ); ?></span>
                                <span class="video-helper-text">Ready for Video &amp; Blog Drop</span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="post-card-content">
                            <div class="post-meta-row">
                                <span class="meta-date"><?php echo esc_html( $slot_data['tier'] ); ?></span>
                                <span class="meta-tag"><?php echo wp_kses_post( $slot_data['cat'] ); ?></span>
                            </div>

                            <h2 class="post-card-title">
                                <?php echo esc_html( $slot_data['title'] ); ?>
                            </h2>

                            <div class="post-card-excerpt">
                                <?php echo esc_html( $slot_data['desc'] ); ?>
                            </div>

                            <div class="post-card-footer">
                                <span class="read-more-link staged-link">
                                    Staged for Video Drop ↗
                                </span>
                                <span class="author-name">Wayne Stevenson</span>
                            </div>
                        </div>
                    </article>
                <?php endfor; ?>

            </div>

        </div>
    </main>
</div>

<?php get_footer(); ?>
