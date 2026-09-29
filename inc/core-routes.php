<?php
/**
 * Keystone Recomposition — Core System Routes, Page Provisioning & Sovereign Purge Engine
 * Version: 3.1.0 (PHP 8.2+ Strict Types)
 * Author: Keystone Architecture
 * Purpose: Ensures /ai-protocols/, /sonic-universe/, /about-the-founder/, and /intel/
 *          never return 404, provisions database pages, trashes legacy peptide content,
 *          and publishes cornerstone AI/Music technical intelligence articles.
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 0. Fast Route Interceptor (template_redirect priority 0)
 * Guarantees sovereign routes render directly before canonical redirects can intervene.
 */
add_action( 'template_redirect', 'keystone_fast_core_routes_interceptor', 0 );
function keystone_fast_core_routes_interceptor(): void {
    if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) ) {
        return;
    }

    $request_uri = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ) ?: '', '/' );
    $slug        = strtolower( $request_uri );

    if ( $slug === 'founder' || $slug === 'about-the-founder' || $slug === 'about-the-founder-the-keystone-blueprint' ) {
        $file = get_stylesheet_directory() . '/template-founder-story.php';
        if ( file_exists( $file ) ) {
            status_header( 200 );
            include $file;
            exit;
        }
    }
}

/**
 * 1. Dynamic Route Interceptor (template_include)
 * Intercepts incoming URIs to guarantee custom page templates render with HTTP 200 OK.
 */
add_filter( 'template_include', 'keystone_dynamic_core_template_router', 99 );
function keystone_dynamic_core_template_router( string $template ): string {
    if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ( defined( 'DOING_CRON' ) && DOING_CRON ) ) {
        return $template;
    }

    $request_uri = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ) ?: '', '/' );
    $slug        = strtolower( $request_uri );

    // Route: /ai-protocols/
    if ( $slug === 'ai-protocols' ) {
        $file = get_stylesheet_directory() . '/template-ai-protocols.php';
        if ( file_exists( $file ) ) {
            global $wp_query;
            if ( $wp_query ) {
                $wp_query->is_404  = false;
                $wp_query->is_page = true;
            }
            status_header( 200 );
            return $file;
        }
    }

    // Route: /sonic-universe/
    if ( $slug === 'sonic-universe' ) {
        $file = get_stylesheet_directory() . '/template-sonic-universe.php';
        if ( file_exists( $file ) ) {
            global $wp_query;
            if ( $wp_query ) {
                $wp_query->is_404  = false;
                $wp_query->is_page = true;
            }
            status_header( 200 );
            return $file;
        }
    }

    // Route: /investments/
    if ( $slug === 'investments' ) {
        $file = get_stylesheet_directory() . '/template-investments.php';
        if ( file_exists( $file ) ) {
            global $wp_query;
            if ( $wp_query ) {
                $wp_query->is_404  = false;
                $wp_query->is_page = true;
            }
            status_header( 200 );
            return $file;
        }
    }

    // Route: /lifestyle/
    if ( $slug === 'lifestyle' ) {
        $file = get_stylesheet_directory() . '/template-lifestyle.php';
        if ( file_exists( $file ) ) {
            global $wp_query;
            if ( $wp_query ) {
                $wp_query->is_404  = false;
                $wp_query->is_page = true;
            }
            status_header( 200 );
            return $file;
        }
    }

    // Route: /founder/ & /about-the-founder/
    if ( $slug === 'founder' || $slug === 'about-the-founder' || $slug === 'about-the-founder-the-keystone-blueprint' ) {
        $file = get_stylesheet_directory() . '/template-founder-story.php';
        if ( file_exists( $file ) ) {
            global $wp_query;
            if ( $wp_query ) {
                $wp_query->is_404  = false;
                $wp_query->is_page = true;
            }
            status_header( 200 );
            return $file;
        }
    }

    // Route: /contact/
    if ( $slug === 'contact' ) {
        $file = get_stylesheet_directory() . '/template-contact.php';
        if ( file_exists( $file ) ) {
            global $wp_query;
            if ( $wp_query ) {
                $wp_query->is_404  = false;
                $wp_query->is_page = true;
            }
            status_header( 200 );
            return $file;
        }
    }

    // Route: /intel/ & /blog/ archive
    if ( $slug === 'intel' || $slug === 'blog' ) {
        $file = get_stylesheet_directory() . '/home.php';
        if ( file_exists( $file ) ) {
            global $wp_query;
            if ( $wp_query ) {
                $wp_query->is_404     = false;
                $wp_query->is_home    = true;
                $wp_query->is_archive = true;
            }
            status_header( 200 );
            return $file;
        }
    }

    return $template;
}

/**
 * 2. Automatic Core Page Provisioning on 'init'
 * Creates missing WordPress pages in wp_posts and maps their templates.
 */
add_action( 'init', 'keystone_ensure_core_pages_exist', 10 );
function keystone_ensure_core_pages_exist(): void {
    if ( is_admin() && ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $pages = array(
        'ai-protocols' => array(
            'title'    => 'Keystone AI Protocols — Autonomous Multi-Agent Swarms & FastMCP Systems',
            'template' => 'template-ai-protocols.php',
            'content'  => '<!-- wp:paragraph --><p>Keystone AI Protocols: Autonomous Multi-Agent Swarms, FastMCP Servers &amp; Chrome DevTools Protocol Infrastructure.</p><!-- /wp:paragraph -->',
        ),
        'sonic-universe' => array(
            'title'    => 'Keystone Sonic Universe — Sovereign Reverb Discography & ISRC Registry',
            'template' => 'template-sonic-universe.php',
            'content'  => '<!-- wp:paragraph --><p>Keystone Sonic Universe: Complete 22-Release Discography and Canonical ISRC Registry by Wayne Stevenson.</p><!-- /wp:paragraph -->',
        ),
        'about-the-founder' => array(
            'title'    => 'About the Founder — Wayne Stevenson Builder Blueprint',
            'template' => 'template-founder-story.php',
            'content'  => '<!-- wp:paragraph --><p>Wayne Stevenson: Licensed Residential Builder #52603, Electronic Music Producer &amp; Systems Architect.</p><!-- /wp:paragraph -->',
        ),
        'founder' => array(
            'title'    => 'About the Founder — Wayne Stevenson Builder Blueprint',
            'template' => 'template-founder-story.php',
            'content'  => '<!-- wp:paragraph --><p>Wayne Stevenson: Licensed Residential Builder #52603, Electronic Music Producer &amp; Systems Architect.</p><!-- /wp:paragraph -->',
        ),
        'investments' => array(
            'title'    => 'Keystone Investments — High-Conviction Capital & Sovereign Infrastructure',
            'template' => 'template-investments.php',
            'content'  => '<!-- wp:paragraph --><p>Keystone Investments: Bill 44 Physical Infill, Algorithmic Risk Models &amp; Sovereign Computational Infrastructure.</p><!-- /wp:paragraph -->',
        ),
        'lifestyle' => array(
            'title'    => 'Keystone Lifestyle — Alpine Performance & Biological Architecture',
            'template' => 'template-lifestyle.php',
            'content'  => '<!-- wp:paragraph --><p>Keystone Lifestyle: Sea-to-Sky Mountain Expeditions, 205-lb Set-Point &amp; Sonic Flow.</p><!-- /wp:paragraph -->',
        ),
        'contact' => array(
            'title'    => 'Keystone Contact — Executive Inquiries & Private Consultations',
            'template' => 'template-contact.php',
            'content'  => '<!-- wp:paragraph --><p>Keystone Contact: Executive Consultations, BC Builder #52603 Contracting &amp; TooLost Sync Licensing.</p><!-- /wp:paragraph -->',
        ),
        'intel' => array(
            'title'    => 'Technical Intel & Architectural Protocols',
            'template' => 'default',
            'content'  => '',
        ),
        'investments' => array(
            'title'    => 'Strategic Capital & High-Cadence Investments',
            'template' => 'template-investments.php',
            'content'  => '<!-- wp:paragraph --><p>Keystone Investments: High-Conviction Capital Allocation, Bill 44 Infill, Algorithmic Markets &amp; Sovereign Infrastructure.</p><!-- /wp:paragraph -->',
        ),
        'lifestyle' => array(
            'title'    => 'Alpine Performance & Biological Architecture',
            'template' => 'template-lifestyle.php',
            'content'  => '<!-- wp:paragraph --><p>Keystone Lifestyle: High-Performance Alpine Living, Sea-to-Sky Mountain Expeditions, 205-lb Set-Point &amp; Sonic Flow.</p><!-- /wp:paragraph -->',
        ),
        'founder' => array(
            'title'    => 'About the Founder — Wayne Stevenson Builder Blueprint',
            'template' => 'template-founder-story.php',
            'content'  => '<!-- wp:paragraph --><p>Wayne Stevenson: Licensed Residential Builder #52603, Electronic Music Producer &amp; Systems Architect.</p><!-- /wp:paragraph -->',
        ),
        'contact' => array(
            'title'    => 'Executive Contact & Consultation Gateway',
            'template' => 'template-contact.php',
            'content'  => '<!-- wp:paragraph --><p>Executive Contact: Direct Consultation, General Contracting BC #52603 &amp; TooLost Licensing Inquiries.</p><!-- /wp:paragraph -->',
        ),
    );

    foreach ( $pages as $slug => $data ) {
        $page = get_page_by_path( $slug, OBJECT, 'page' );
        if ( ! $page ) {
            $inserted_id = wp_insert_post( array(
                'post_title'     => $data['title'],
                'post_name'      => $slug,
                'post_content'   => $data['content'],
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
            ) );

            if ( $inserted_id && ! is_wp_error( $inserted_id ) && $data['template'] !== 'default' ) {
                update_post_meta( $inserted_id, '_wp_page_template', $data['template'] );
            }
        } else {
            // Guarantee template mapping
            if ( $data['template'] !== 'default' ) {
                $cur = get_post_meta( $page->ID, '_wp_page_template', true );
                if ( $cur !== $data['template'] ) {
                    update_post_meta( $page->ID, '_wp_page_template', $data['template'] );
                }
            }
        }
    }

    // Ensure intel is set as page_for_posts
    $intel_page = get_page_by_path( 'intel', OBJECT, 'page' );
    if ( $intel_page ) {
        $cur_for_posts = (int) get_option( 'page_for_posts' );
        if ( $cur_for_posts !== $intel_page->ID ) {
            update_option( 'page_for_posts', $intel_page->ID );
            update_option( 'show_on_front', 'page' );
        }
    }
}

/**
 * 3. Autonomous Sovereign Reset & Legacy Purge Pipeline
 * Trashes obsolete peptide posts, generates 3 flagship AI/Music cornerstone articles,
 * and clears XML sitemap transients.
 */
add_action( 'init', 'keystone_check_sovereign_purge_trigger', 5 );
function keystone_check_sovereign_purge_trigger(): void {
    $manual_trigger = isset( $_GET['keystone_purge_action'] ) && $_GET['keystone_purge_action'] === 'purge_legacy_peptides_2026';
    $auto_flag      = get_option( 'keystone_sovereign_rebuild_executed_v3_1' );

    if ( ! $auto_flag || $manual_trigger ) {
        $report = keystone_execute_sovereign_reset_pipeline();
        
        if ( $manual_trigger ) {
            header( 'Content-Type: application/json; charset=utf-8' );
            echo wp_json_encode( $report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
            exit;
        }
    }
}

/**
 * Pipeline Execution Core
 */
function keystone_execute_sovereign_reset_pipeline(): array {
    global $wpdb;

    // A. Ensure core pages exist first
    keystone_ensure_core_pages_exist();

    // B. Query all published posts
    $posts = $wpdb->get_results(
        "SELECT ID, post_name, post_title FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status = 'publish'"
    );

    $purged_ids = array();
    $kept_ids   = array();

    // Specific slugs to preserve if desired
    $preserved_slugs = array(
        'autonomous-multi-agent-swarms-fastmcp-architecture',
        'sovereign-reverb-functional-frequency-architecture',
        'chrome-devtools-protocol-cdp-port-9222-automation',
    );

    if ( $posts ) {
        foreach ( $posts as $p ) {
            $slug  = strtolower( $p->post_name );
            $title = strtolower( $p->post_title );

            if ( in_array( $slug, $preserved_slugs, true ) ) {
                $kept_ids[] = array( 'id' => $p->ID, 'slug' => $slug );
                continue;
            }

            // If post is not an approved Sovereign AI/Music article, trash it
            $is_legacy = true;

            if ( $is_legacy ) {
                wp_set_current_user( 1 );
                wp_trash_post( (int) $p->ID );
                $wpdb->update(
                    $wpdb->posts,
                    array( 'post_status' => 'trash' ),
                    array( 'ID' => (int) $p->ID )
                );
                clean_post_cache( (int) $p->ID );
                $purged_ids[] = array(
                    'id'    => $p->ID,
                    'slug'  => $slug,
                    'title' => $p->post_title,
                );
            } else {
                $kept_ids[] = array( 'id' => $p->ID, 'slug' => $slug );
            }
        }
    }

    // Direct atomic enforcement: any remaining non-cornerstone post goes to trash
    $wpdb->query(
        "UPDATE {$wpdb->posts} SET post_status = 'trash' 
         WHERE post_type = 'post' 
         AND post_status = 'publish'
         AND post_name NOT IN (
             'autonomous-multi-agent-swarms-fastmcp-architecture',
             'sovereign-reverb-functional-frequency-architecture',
             'chrome-devtools-protocol-cdp-port-9222-automation'
         )"
    );

    // Also trash all legacy workout/peptide/calculator/watch pages
    $wpdb->query(
        "UPDATE {$wpdb->posts} SET post_status = 'trash' 
         WHERE post_type = 'page' 
         AND post_status = 'publish'
         AND post_name NOT IN (
             'home',
             'ai-protocols',
             'sonic-universe',
             'about-the-founder',
             'about-the-founder-the-keystone-blueprint',
             'intel'
         )"
    );

    // Synchronize sovereign nav menu and site identity
    if ( function_exists( 'keystone_provision_sovereign_nav_menu' ) ) {
        keystone_provision_sovereign_nav_menu();
    }
    if ( function_exists( 'keystone_sync_sovereign_site_identity' ) ) {
        keystone_sync_sovereign_site_identity();
    }

    // C. Seed Cornerstone AI & Music Intel Articles
    $seeded_posts = keystone_seed_cornerstone_intel_articles();

    // D. Purge Rank Math Sitemap Cache Transients
    $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_rank_math_sitemap_%' OR option_name LIKE '_transient_timeout_rank_math_sitemap_%'" );

    if ( function_exists( 'wp_cache_flush' ) ) {
        wp_cache_flush();
    }

    // E. Mark execution as completed
    update_option( 'keystone_sovereign_rebuild_executed_v3_1', time() );

    return array(
        'status'         => 'SUCCESS',
        'stamped'        => gmdate( 'Y-m-d H:i:s' ) . ' UTC',
        'purged_count'   => count( $purged_ids ),
        'purged_posts'   => $purged_ids,
        'seeded_count'   => count( $seeded_posts ),
        'seeded_posts'   => $seeded_posts,
        'preserved_count'=> count( $kept_ids ),
    );
}

/**
 * Seeds the 3 brand-new AI and Music Cornerstone Articles with full Gutenberg block markup.
 */
function keystone_seed_cornerstone_intel_articles(): array {
    $articles = array(
        array(
            'title'   => 'Autonomous Multi-Agent Swarms: The 16-Agent FastMCP Architecture Behind Keystone Protocols',
            'slug'    => 'autonomous-multi-agent-swarms-fastmcp-architecture',
            'excerpt' => 'The technical blueprint behind Wayne Stevenson’s local 16-agent swarms, FastMCP tool servers, and Chrome DevTools Protocol (CDP Port 9222) automation. High-throughput, sub-second execution with zero cloud lock-in.',
            'content' => keystone_get_article_content_agent_swarms(),
        ),
        array(
            'title'   => 'Sovereign Reverb: How Functional Frequency Architecture Bridges Electronic Music & Human Performance',
            'slug'    => 'sovereign-reverb-functional-frequency-architecture',
            'excerpt' => 'Inside the 196-track TooLost music universe by Wayne Stevenson. Composed for circadian entrainment, training cadence, and autonomic state regulation in Keystone Protocols.',
            'content' => keystone_get_article_content_sovereign_reverb(),
        ),
        array(
            'title'   => 'Chrome DevTools Protocol (CDP Port 9222): Zero-Cloud Automation for Desktop AI Builders',
            'slug'    => 'chrome-devtools-protocol-cdp-port-9222-automation',
            'excerpt' => 'How to eliminate headless browser crashes, cloud proxy costs, and bot captchas by auto-attaching AI agents directly to Wayne’s active Chrome browser via CDP Port 9222.',
            'content' => keystone_get_article_content_cdp_port_9222(),
        ),
    );

    $created = array();

    foreach ( $articles as $art ) {
        $existing = get_page_by_path( $art['slug'], OBJECT, 'post' );
        if ( ! $existing ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $art['title'],
                'post_name'    => $art['slug'],
                'post_content' => $art['content'],
                'post_excerpt' => $art['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'post',
                'post_author'  => 1,
            ) );

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                $created[] = array( 'id' => $post_id, 'slug' => $art['slug'], 'title' => $art['title'] );
            }
        } else {
            $created[] = array( 'id' => $existing->ID, 'slug' => $art['slug'], 'status' => 'already_exists' );
        }
    }

    return $created;
}

/**
 * Article 1: Autonomous Multi-Agent Swarms
 */
function keystone_get_article_content_agent_swarms(): string {
    return <<<'HTML'
<!-- wp:paragraph {"className":"lead-paragraph"} -->
<p class="lead-paragraph">Monolithic AI models are dead. When building real-world enterprise infrastructure, heavy-duty construction automation, or high-volume multi-platform media engines, relying on a single prompt window guarantees context drift, hallucinated references, and catastrophic regressions. At Keystone Protocols, we run an autonomous 16-agent swarm governed by strict Model Context Protocol (FastMCP) contracts and local execution gates.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>The 16-Agent Swarm Lifecycle</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Each subagent in our local cluster operates within an isolated ephemeral context with dedicated roles, zero tool collisions, and strict evaluator-optimizer gates:</p>
<!-- /wp:paragraph -->

<!-- wp:table {"className":"luxury-flow-table"} -->
<figure class="wp-block-table luxury-flow-table">
<table>
<thead>
<tr>
<th>Agent Tier</th>
<th>Designation</th>
<th>Core Operational Mandate</th>
<th>Verification Standard</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>R1-R4</strong></td>
<td>Research Scouts &amp; Synthesis</td>
<td>Exhaustive specification gathering across official RFCs and upstream developer docs</td>
<td>Mandatory 3 independent authoritative sources</td>
</tr>
<tr>
<td><strong>B0</strong></td>
<td>Test Engineer (TDD)</td>
<td>Authors failing (RED) unit and integration test harnesses before code execution</td>
<td>Executable test suites with zero stub mocks</td>
</tr>
<tr>
<td><strong>B1-B2</strong></td>
<td>Architect &amp; Builder</td>
<td>100% working-backwards system architecture and typed production implementation</td>
<td>Strict PHP 8.2+ / Python 3.12+ static validation</td>
</tr>
<tr>
<td><strong>B3</strong></td>
<td>Adversarial Reviewer</td>
<td>Unyielding gatekeeper auditing race conditions, AST types, and memory leaks</td>
<td>Zero-regression approval before build sign-off</td>
</tr>
<tr>
<td><strong>B5</strong></td>
<td>Concurrency Engineer</td>
<td>Windows WMI lifecycle, non-blocking background IPC, and WebSocket daemons</td>
<td>Ports :9876 through :9879 socket health</td>
</tr>
</tbody>
</table>
</figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>FastMCP: High-Throughput Tool Contracts</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Rather than exposing fragile raw bash terminals or bloated REST APIs, our agents communicate through FastMCP servers over stdio and SSE. Every capability—from DaVinci Resolve timeline assembly to WordPress AST block manipulation—is defined as a typed function contract:</p>
<!-- /wp:paragraph -->

<!-- wp:code {"className":"luxury-code-block"} -->
<pre class="wp-block-code luxury-code-block"><code class="language-python">from mcp.server.fastmcp import FastMCP
from pydantic import BaseModel, Field

mcp = FastMCP("KeystoneAutomationServer")

class SwarmTaskSpec(BaseModel):
    task_id: str = Field(description="Unique deterministic UUID")
    action_type: str = Field(description="Strict enum: AUDIT | BUILD | DEPLOY")
    target_manifest: str = Field(description="Canonical path to JSON payload")

@mcp.tool()
async def execute_swarm_task(spec: SwarmTaskSpec) -&gt; dict:
    """Dispatches execution payload across parallel ephemeral subagents."""
    return {"status": "ENQUEUED", "task": spec.task_id}
</code></pre>
<!-- /wp:code -->

<!-- wp:heading {"level":2} -->
<h2>The Bridge to Keystone Possibilities</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Autonomous AI intelligence is not an academic exercise—it is the operational nervous system powering Wayne Stevenson's real-world developments. Under <strong>BC Housing Builder Licence #52603</strong>, these exact agent swarms calculate Bill 44 multiplex zoning densities, audit Step Code energy compliance, and generate architectural BIM schedules at <a href="https://keystonepossibilities.ca" target="_blank" rel="noopener">Keystone Possibilities Ltd</a>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Want to inspect the exact configuration files, prompt scaffolds, and MCP servers? Join our builder community on Skool or subscribe to <a href="https://www.youtube.com/@KeystoneAIProtocols" target="_blank" rel="noopener">@KeystoneAIProtocols on YouTube</a>.</p>
<!-- /wp:paragraph -->
HTML;
}

/**
 * Article 2: Sovereign Reverb
 */
function keystone_get_article_content_sovereign_reverb(): string {
    return <<<'HTML'
<!-- wp:paragraph {"className":"lead-paragraph"} -->
<p class="lead-paragraph">Sound is not background decoration—it is neurochemical architecture. In high-performance engineering, deep creative flow states and sustained autonomic regulation require precise acoustic frequencies. Across 22 official releases (20 studio albums) and 196 cataloged tracks, Wayne Stevenson’s TooLost discography bridges electronic dance music, ambient soundscapes, and cellular circadian entrainment.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Bio-Acoustic Engineering &amp; Solfeggio Tuning</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Unlike commercial pop music tuned to arbitrary 440 Hz standards, Keystone Recomposition audio productions are intentionally engineered around mathematical harmonic ratios:</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"luxury-bullet-list"} -->
<ul class="luxury-bullet-list">
<li><strong>528 Hz (The Transformation Tone):</strong> Resonating at the core of cellular repair and neuromuscular calm, featured extensively in <em>Resonantia: 10 Frequencies of the Rebuild</em>.</li>
<li><strong>432 Hz (Natural Harmonic Order):</strong> Engineered for deep cerebral focus, lowering heart rate variability tension during intense code compilation and architectural drafting.</li>
<li><strong>124-128 BPM Steady-State Cadence:</strong> Calibrated to physiological training rhythms, cold plunge breath control, and aerobic threshold pacing in <em>Concrete Foundations</em> and <em>Biological Overdrive</em>.</li>
</ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2>The 22-Release TooLost Catalog Registry</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Every single track in the Keystone Recomposition catalog is officially registered with canonical International Standard Recording Codes (ISRCs) and UPC barcodes distributed worldwide via TooLost to Spotify, Apple Music, and YouTube Music:</p>
<!-- /wp:paragraph -->

<!-- wp:table {"className":"luxury-flow-table"} -->
<figure class="wp-block-table luxury-flow-table">
<table>
<thead>
<tr>
<th>Album Title</th>
<th>Genre &amp; Aesthetic</th>
<th>Key Tracks</th>
<th>Primary DSP Links</th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>Sovereign Reverb</strong></td>
<td>Deep House / Melodic Techno</td>
<td>Frequency Shift, Sovereign Pulse</td>
<td><a href="/sonic-universe/#sovereign-reverb">Explore Album →</a></td>
</tr>
<tr>
<td><strong>Concrete Foundations</strong></td>
<td>Industrial Electronica / Minimal Tech</td>
<td>Foundation Flux, Rebuild Protocol</td>
<td><a href="/sonic-universe/#concrete-foundations">Explore Album →</a></td>
</tr>
<tr>
<td><strong>Resonantia</strong></td>
<td>Ambient Solfeggio / Organic Drone</td>
<td>528Hz Cellular Awakening, Circadian Reset</td>
<td><a href="/sonic-universe/#resonantia-10-frequencies-of-the-rebuild">Explore Album →</a></td>
</tr>
<tr>
<td><strong>Biological Overdrive</strong></td>
<td>High-Cadence Progressive House</td>
<td>Cellular Overdrive, Deep Drive</td>
<td><a href="/sonic-universe/#biological-overdrive">Explore Album →</a></td>
</tr>
</tbody>
</table>
</figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2>1-Click ISRC Transparency</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We believe in absolute provenance for independent creators. Visit our new <a href="/sonic-universe/">Sonic Universe Hub</a> to audition full albums, filter by BPM, copy official ISRCs with a single click, and stream across verified DSP artist profiles.</p>
<!-- /wp:paragraph -->
HTML;
}

/**
 * Article 3: Chrome DevTools Protocol Automation
 */
function keystone_get_article_content_cdp_port_9222(): string {
    return <<<'HTML'
<!-- wp:paragraph {"className":"lead-paragraph"} -->
<p class="lead-paragraph">Most automated browser workflows fail in production because they rely on broken, headless Selenium or Playwright instances that look like automated bots, get hit with Cloudflare captchas, and consume gigabytes of unnecessary cloud memory. The sovereign builder approach is radically simpler: attach your AI agents directly to your real, daily-driver Google Chrome session over Port 9222.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>The Zero-Cloud Port 9222 Standard</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>By launching Google Chrome with remote debugging enabled, every tab, cookie session, and active OAuth credential remains permanently alive. AI agents don't log in over and over—they simply read the active DOM, dispatch native input events, and manipulate pages with zero latency:</p>
<!-- /wp:paragraph -->

<!-- wp:code {"className":"luxury-code-block"} -->
<pre class="wp-block-code luxury-code-block"><code class="language-bash"># Launch Wayne's Chrome Debugger on Port 9222
chrome.exe --remote-debugging-port=9222 --user-data-dir="C:\ChromeProfile"
</code></pre>
<!-- /wp:code -->

<!-- wp:heading {"level":2} -->
<h2>Python CDP Native Auto-Attach</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Our agents connect via standard HTTP and WebSockets to <code>http://127.0.0.1:9222/json</code>, discovering existing tabs and controlling them directly without heavy external driver binaries:</p>
<!-- /wp:paragraph -->

<!-- wp:code {"className":"luxury-code-block"} -->
<pre class="wp-block-code luxury-code-block"><code class="language-python">import requests
import json
import websockets
import asyncio

async def inspect_active_chrome_tab():
    tabs = requests.get("http://127.0.0.1:9222/json").json()
    target = next((t for t in tabs if "keystonerecomposition.com" in t.get("url", "")), None)
    
    if not target:
        print("Target tab not found.")
        return

    ws_url = target["webSocketDebuggerUrl"]
    async with websockets.connect(ws_url) as ws:
        # Evaluate DOM expression directly
        payload = {
            "id": 1,
            "method": "Runtime.evaluate",
            "params": {"expression": "document.title"}
        }
        await ws.send(json.dumps(payload))
        response = await ws.recv()
        print("DOM Evaluation Result:", response)

asyncio.run(inspect_active_chrome_tab())
</code></pre>
<!-- /wp:code -->

<!-- wp:heading {"level":2} -->
<h2>Production Advantages</h2>
<!-- /wp:heading -->

<!-- wp:list {"className":"luxury-bullet-list"} -->
<ul class="luxury-bullet-list">
<li><strong>Zero Bot Detection:</strong> Operates inside Wayne's authenticated Google profile with real mouse movements and hardware fingerprints.</li>
<li><strong>Sub-50ms Response Times:</strong> Direct local loopback IPC eliminates cloud proxy roundtrips.</li>
<li><strong>Human-in-the-Loop Transparency:</strong> Wayne watches every DOM click, input fill, and navigation live on his desktop HUD in real time.</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>This protocol forms the bedrock of our autonomous publishing engines across WordPress luxury blogs, YouTube Studio metadata updates, and Google Search Console index submissions.</p>
<!-- /wp:paragraph -->
HTML;
}
