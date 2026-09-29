<?php
declare(strict_types=1);

/**
 * Keystone Recomposition Child Theme — Modular Architecture
 * Version: 3.0.0 (PHP 8.2+ Strict Types)
 * Author: Keystone Architecture
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// 1. Google Search Console Reset & HTTP 410 Gone Legacy Purge Engine
require_once __DIR__ . '/inc/gsc-410-purge.php';

// 2. Master Sonic Catalog Data Store (18 Albums, 196 Tracks & Canonical ISRCs)
require_once __DIR__ . '/inc/sonic-catalog-data.php';

// 3. Asset Pipeline & Fonts
require_once __DIR__ . '/inc/enqueue.php';

// 4. Schema.org 2026 Multi-Entity Knowledge Graph
require_once __DIR__ . '/inc/seo-schema.php';

// 5. Luxury Content Blocks & Video Facades
require_once __DIR__ . '/inc/content-blocks.php';

// 6. Indexing API & Post Management
require_once __DIR__ . '/inc/indexing-api.php';

// 7. Sovereign Database Migration
if ( file_exists( __DIR__ . '/inc/sovereign-migration.php' ) ) {
	require_once __DIR__ . '/inc/sovereign-migration.php';
}
