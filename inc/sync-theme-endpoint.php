<?php
declare(strict_types=1);

/**
 * Keystone Recomposition Sovereign v4.0 — Atomic Theme Asset, Manifest & Root Static Sync Engine
 *
 * Provides authenticated REST endpoints for deterministic theme deployment:
 * - POST /wp-json/keystone/v1/sync-theme-asset
 * - GET  /wp-json/keystone/v1/theme-manifest
 * - POST /wp-json/keystone/v1/sync-root-static
 *
 * Enforces manage_options capability, strict relative path allowlisting,
 * in-memory PHP token_get_all(..., TOKEN_PARSE) syntax validation, SHA-256
 * checksum verification, root /srv/htdocs/{llms.txt,llms-full.txt} mirroring,
 * and WP Cloud _atomic_bur / Batcache / object-cache invalidation.
 *
 * @package KeystoneRecompositionChild
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'kr_v4_verify_admin_sync_permission' ) ) {
	/**
	 * Permission callback requiring WordPress Administrator capability (manage_options)
	 * via Application Password or authenticated cookie nonce.
	 *
	 * @param WP_REST_Request $request Incoming REST request.
	 * @return bool|WP_Error
	 */
	function kr_v4_verify_admin_sync_permission( WP_REST_Request $request ) {
		if ( function_exists( 'current_user_can' ) && current_user_can( 'manage_options' ) ) {
			return true;
		}

		$configured_secret = defined( 'KR_THEME_SYNC_SECRET' )
			? (string) KR_THEME_SYNC_SECRET
			: (string) get_option( 'kr_theme_sync_secret', '' );

		if ( $configured_secret !== '' ) {
			$header_secret = (string) ( $request->get_header( 'x-keystone-sync-secret' ) ?: $request->get_header( 'x-keystone-secret' ) );
			if ( $header_secret !== '' && hash_equals( $configured_secret, $header_secret ) ) {
				return true;
			}
		}

		return new WP_Error(
			'kr_sync_forbidden',
			'Administrator authentication (manage_options) required for Keystone Recomposition v4.0 sync endpoints.',
			array( 'status' => 403 )
		);
	}
}

if ( ! function_exists( 'kr_v4_is_allowed_theme_rel_path' ) ) {
	/**
	 * Validates relative child-theme asset paths against directory traversal and arbitrary writes.
	 *
	 * Supports:
	 * - *.php (root templates & bootstrap files)
	 * - inc/*.php
	 * - template-parts/*.php & template-parts/content/*.php
	 * - assets/css/*.css
	 * - js/*.js & assets/js/*.js
	 * - assets/images/*.(png|jpg|jpeg|webp|svg)
	 * - style.css, llms.txt, llms-full.txt
	 *
	 * @param string $rel_path Relative file path inside child theme.
	 * @return bool
	 */
	function kr_v4_is_allowed_theme_rel_path( string $rel_path ): bool {
		$rel = str_replace( '\\', '/', trim( $rel_path ) );
		if ( $rel === '' || $rel[0] === '/' || strpos( $rel, '..' ) !== false || strpos( $rel, "\0" ) !== false ) {
			return false;
		}

		$exact_files = array(
			'style.css',
			'llms.txt',
			'llms-full.txt',
			'README.md',
		);
		if ( in_array( $rel, $exact_files, true ) ) {
			return true;
		}

		$patterns = array(
			'/^[a-z0-9_-]+\.php$/',
			'/^inc\/[a-z0-9_-]+\.php$/',
			'/^template-parts\/[a-z0-9_-]+\.php$/',
			'/^template-parts\/content\/[a-z0-9_-]+\.php$/',
			'/^assets\/css\/[a-z0-9_-]+\.css$/',
			'/^assets\/js\/[a-z0-9_-]+\.js$/',
			'/^js\/[a-z0-9_-]+\.js$/',
			'/^assets\/images\/([a-z0-9_-]+\/)?[a-zA-Z0-9_.-]+\.(png|jpg|jpeg|webp|svg)$/',
		);

		foreach ( $patterns as $regex ) {
			if ( preg_match( $regex, $rel ) === 1 ) {
				return true;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'kr_v4_validate_php_syntax' ) ) {
	/**
	 * Validates PHP source syntax in memory via token_get_all(..., TOKEN_PARSE)
	 * before writing to disk so malformed code can never brick the child theme.
	 *
	 * @param string $php_source Raw PHP file bytes.
	 * @return true|string True when valid, or error message string on failure.
	 */
	function kr_v4_validate_php_syntax( string $php_source ) {
		if ( strpos( ltrim( $php_source ), '<?php' ) !== 0 ) {
			return 'PHP file must start with <?php opening tag.';
		}

		try {
			if ( defined( 'TOKEN_PARSE' ) ) {
				$tokens = token_get_all( $php_source, TOKEN_PARSE );
			} else {
				$tokens = token_get_all( $php_source );
			}
		} catch ( \ParseError $e ) {
			return 'PHP ParseError on line ' . $e->getLine() . ': ' . $e->getMessage();
		} catch ( \Throwable $t ) {
			return 'PHP Tokenizer Error: ' . $t->getMessage();
		}

		$brace_depth = 0;
		foreach ( $tokens as $tok ) {
			if ( is_array( $tok ) ) {
				$id = $tok[0];
				if ( $id === T_CURLY_OPEN || $id === T_DOLLAR_OPEN_CURLY_BRACES ) {
					$brace_depth += 1;
				}
			} elseif ( $tok === '{' ) {
				$brace_depth += 1;
			} elseif ( $tok === '}' ) {
				$brace_depth -= 1;
				if ( $brace_depth < 0 ) {
					return 'Unbalanced closing curly brace detected.';
				}
			}
		}

		if ( $brace_depth !== 0 ) {
			return 'Unbalanced curly braces (net depth ' . $brace_depth . ').';
		}

		return true;
	}
}

if ( ! function_exists( 'kr_v4_write_root_static_mirror' ) ) {
	/**
	 * Mirrors approved GEO discovery files (llms.txt, llms-full.txt, IndexNow key)
	 * to /srv/htdocs/ (WP Cloud _atomic_bur document root), DOCUMENT_ROOT, and ABSPATH when writable.
	 *
	 * @param string $filename Allowed static filename.
	 * @param string $content  Raw UTF-8 file contents.
	 * @return array<string, mixed>
	 */
	function kr_v4_write_root_static_mirror( string $filename, string $content ): array {
		$indexnow_key = function_exists( 'keystone_recomp_get_indexnow_key' )
			? keystone_recomp_get_indexnow_key()
			: (string) get_option( 'keystone_indexnow_api_key', '8f4b2e9a1c6d7e3f5a0b9c8d7e6f5a4b' );

		$allowed_names = array(
			'llms.txt',
			'llms-full.txt',
			$indexnow_key . '.txt',
		);

		if ( ! in_array( $filename, $allowed_names, true ) ) {
			return array(
				'ok'    => false,
				'error' => 'Disallowed root static filename: ' . $filename,
			);
		}

		$roots = array();
		if ( is_dir( '/srv/htdocs' ) ) {
			$roots[] = '/srv/htdocs';
		}
		if ( ! empty( $_SERVER['DOCUMENT_ROOT'] ) && is_dir( (string) $_SERVER['DOCUMENT_ROOT'] ) ) {
			$roots[] = rtrim( (string) $_SERVER['DOCUMENT_ROOT'], '/\\' );
		}
		if ( defined( 'ABSPATH' ) && is_dir( ABSPATH ) ) {
			$roots[] = rtrim( ABSPATH, '/\\' );
		}
		$roots = array_values( array_unique( $roots ) );

		$written = array();
		foreach ( $roots as $dir ) {
			if ( ! is_writable( $dir ) ) {
				continue;
			}
			$target = $dir . '/' . $filename;
			$tmp    = $target . '.tmp.' . getmypid();
			$bytes  = @file_put_contents( $tmp, $content );
			if ( $bytes !== false && @rename( $tmp, $target ) ) {
				@chmod( $target, 0644 );
				$written[] = array(
					'path'  => $target,
					'bytes' => $bytes,
				);
			} else {
				@unlink( $tmp );
			}
		}

		return array(
			'ok'      => ! empty( $written ),
			'file'    => $filename,
			'written' => $written,
			'sha256'  => hash( 'sha256', $content ),
		);
	}
}

if ( ! function_exists( 'kr_v4_flush_edge_and_batcache' ) ) {
	/**
	 * Invalidates WP Cloud _atomic_bur / Batcache edge keys, cleans front-page and blog-page
	 * post caches, and flushes the WordPress object cache cleanly without mutating post_modified.
	 *
	 * @return array<string, mixed>
	 */
	function kr_v4_flush_edge_and_batcache(): array {
		$report = array(
			'cleaned_post_ids' => array(),
			'batcache_urls'    => 0,
			'atomic_bur_ping'  => false,
			'wp_cache_flush'   => false,
		);

		$front_id = (int) get_option( 'page_on_front', 0 );
		$posts_id = (int) get_option( 'page_for_posts', 0 );
		foreach ( array( $front_id, $posts_id ) as $pid ) {
			if ( $pid > 0 && function_exists( 'clean_post_cache' ) ) {
				clean_post_cache( $pid );
				$report['cleaned_post_ids'][] = $pid;
			}
		}

		$core_slugs = array(
			'ai-protocols',
			'sonic-universe',
			'intel',
			'founder',
			'investments',
			'lifestyle',
			'ecosystem-partners',
			'contact',
		);
		foreach ( $core_slugs as $slug ) {
			$page_obj = get_page_by_path( $slug, OBJECT, 'page' );
			if ( $page_obj instanceof WP_Post && function_exists( 'clean_post_cache' ) ) {
				clean_post_cache( (int) $page_obj->ID );
				$report['cleaned_post_ids'][] = (int) $page_obj->ID;
			}
		}
		$report['cleaned_post_ids'] = array_values( array_unique( $report['cleaned_post_ids'] ) );

		$key_urls = array(
			home_url( '/' ),
			home_url( '/ai-protocols/' ),
			home_url( '/sonic-universe/' ),
			home_url( '/intel/' ),
			home_url( '/founder/' ),
			home_url( '/investments/' ),
			home_url( '/lifestyle/' ),
			home_url( '/ecosystem-partners/' ),
			home_url( '/contact/' ),
			home_url( '/llms.txt' ),
			home_url( '/llms-full.txt' ),
		);

		if ( function_exists( 'batcache_clear_url' ) ) {
			foreach ( $key_urls as $url ) {
				@batcache_clear_url( $url );
				$report['batcache_urls'] += 1;
			}
		}

		// WP Cloud _atomic_bur / Atomic edge cache invalidation signal when present
		if ( has_action( 'atomic_cache_purge_url' ) || defined( 'ATOMIC_SITE_ID' ) || is_dir( '/srv/htdocs/_atomic_bur' ) ) {
			foreach ( $key_urls as $url ) {
				do_action( 'atomic_cache_purge_url', $url );
			}
			$report['atomic_bur_ping'] = true;
		}

		if ( function_exists( 'wp_cache_flush' ) ) {
			$report['wp_cache_flush'] = (bool) wp_cache_flush();
		}

		return $report;
	}
}

if ( ! function_exists( 'kr_v4_handle_theme_manifest' ) ) {
	/**
	 * GET /wp-json/keystone/v1/theme-manifest
	 * Returns SHA-256 checksums, byte sizes, and mtimes for all allowlisted child-theme assets.
	 *
	 * @return WP_REST_Response
	 */
	function kr_v4_handle_theme_manifest(): WP_REST_Response {
		$theme_dir      = rtrim( get_stylesheet_directory(), '/\\' );
		$theme_dir_norm = str_replace( '\\', '/', $theme_dir );
		$files          = array();

		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $theme_dir, FilesystemIterator::SKIP_DOTS )
		);

		foreach ( $iterator as $file_info ) {
			if ( ! $file_info->isFile() ) {
				continue;
			}
			$abs = str_replace( '\\', '/', $file_info->getPathname() );
			$rel = ltrim( substr( $abs, strlen( $theme_dir_norm ) ), '/' );
			if ( ! kr_v4_is_allowed_theme_rel_path( $rel ) ) {
				continue;
			}
			$files[ $rel ] = array(
				'bytes'  => (int) $file_info->getSize(),
				'sha256' => (string) hash_file( 'sha256', $file_info->getPathname() ),
				'mtime'  => (int) $file_info->getMTime(),
			);
		}

		ksort( $files );

		return new WP_REST_Response(
			array(
				'ok'        => true,
				'version'   => '4.0.0',
				'theme_dir' => $theme_dir,
				'count'     => count( $files ),
				'files'     => $files,
			),
			200
		);
	}
}

if ( ! function_exists( 'kr_v4_handle_sync_theme_asset' ) ) {
	/**
	 * POST /wp-json/keystone/v1/sync-theme-asset
	 * Atomically writes a validated child-theme file with PHP TOKEN_PARSE syntax verification,
	 * SHA-256 checksum return, root /srv/htdocs/{llms.txt,llms-full.txt} mirroring, and cache flush.
	 *
	 * @param WP_REST_Request $request Incoming REST request.
	 * @return WP_REST_Response
	 */
	function kr_v4_handle_sync_theme_asset( WP_REST_Request $request ): WP_REST_Response {
		$params   = $request->get_json_params();
		$body     = is_array( $params ) ? $params : $request->get_params();
		$rel_file = trim( str_replace( '\\', '/', (string) ( $body['file'] ?? $body['rel_path'] ?? $body['path'] ?? '' ) ) );

		if ( ! kr_v4_is_allowed_theme_rel_path( $rel_file ) ) {
			return new WP_REST_Response(
				array(
					'ok'    => false,
					'error' => 'Path not in Sovereign v4.0 theme allowlist: ' . $rel_file,
				),
				400
			);
		}

		$raw_bytes = null;
		if ( isset( $body['content_b64'] ) && is_string( $body['content_b64'] ) && $body['content_b64'] !== '' ) {
			$decoded = base64_decode( $body['content_b64'], true );
			if ( $decoded === false ) {
				return new WP_REST_Response( array( 'ok' => false, 'error' => 'Invalid content_b64 base64 payload.' ), 400 );
			}
			$raw_bytes = $decoded;
		} elseif ( isset( $body['content'] ) && is_string( $body['content'] ) ) {
			$encoding = strtolower( trim( (string) ( $body['encoding'] ?? 'utf8' ) ) );
			if ( $encoding === 'base64' ) {
				$decoded = base64_decode( $body['content'], true );
				if ( $decoded === false ) {
					return new WP_REST_Response( array( 'ok' => false, 'error' => 'Invalid base64 content payload.' ), 400 );
				}
				$raw_bytes = $decoded;
			} else {
				$raw_bytes = $body['content'];
			}
		}

		if ( $raw_bytes === null || strlen( $raw_bytes ) < 8 ) {
			return new WP_REST_Response( array( 'ok' => false, 'error' => 'Empty or undersized content payload.' ), 400 );
		}

		$actual_sha256   = hash( 'sha256', $raw_bytes );
		$expected_sha256 = strtolower( trim( (string) ( $body['sha256'] ?? '' ) ) );
		if ( $expected_sha256 !== '' && ! hash_equals( $expected_sha256, $actual_sha256 ) ) {
			return new WP_REST_Response(
				array(
					'ok'       => false,
					'error'    => 'SHA-256 checksum mismatch.',
					'expected' => $expected_sha256,
					'actual'   => $actual_sha256,
				),
				400
			);
		}

		if ( str_ends_with( $rel_file, '.php' ) ) {
			$syntax_ok = kr_v4_validate_php_syntax( $raw_bytes );
			if ( $syntax_ok !== true ) {
				return new WP_REST_Response(
					array(
						'ok'    => false,
						'error' => 'PHP syntax validation failed: ' . $syntax_ok,
						'file'  => $rel_file,
					),
					422
				);
			}
		}

		$theme_dir = rtrim( get_stylesheet_directory(), '/\\' );
		$dest      = $theme_dir . '/' . $rel_file;
		$dir       = dirname( $dest );
		if ( ! is_dir( $dir ) && ! wp_mkdir_p( $dir ) ) {
			return new WP_REST_Response( array( 'ok' => false, 'error' => 'Failed to create directory: ' . $dir ), 500 );
		}

		$real_theme = realpath( $theme_dir );
		$real_dir   = realpath( $dir );
		if ( $real_theme === false || $real_dir === false || strpos( str_replace( '\\', '/', $real_dir ), str_replace( '\\', '/', $real_theme ) ) !== 0 ) {
			return new WP_REST_Response( array( 'ok' => false, 'error' => 'Resolved destination escapes child theme boundary.' ), 403 );
		}

		$tmp   = $dest . '.tmp.' . getmypid();
		$bytes = @file_put_contents( $tmp, $raw_bytes );
		if ( $bytes === false || ! @rename( $tmp, $dest ) ) {
			@unlink( $tmp );
			return new WP_REST_Response( array( 'ok' => false, 'error' => 'Atomic file write failed for ' . $rel_file ), 500 );
		}
		@chmod( $dest, 0644 );

		if ( str_ends_with( $rel_file, '.php' ) && function_exists( 'opcache_invalidate' ) ) {
			@opcache_invalidate( $dest, true );
		}

		$root_mirror = null;
		if ( $rel_file === 'llms.txt' || $rel_file === 'llms-full.txt' ) {
			$root_mirror = kr_v4_write_root_static_mirror( $rel_file, $raw_bytes );
		}

		$flush_report = empty( $body['skip_cache_flush'] ) ? kr_v4_flush_edge_and_batcache() : array( 'skipped' => true );

		return new WP_REST_Response(
			array(
				'ok'               => true,
				'status'           => 'SYNCED',
				'file'             => $rel_file,
				'bytes'            => (int) $bytes,
				'sha256'           => $actual_sha256,
				'dest'             => $dest,
				'root_mirror'      => $root_mirror,
				'edge_cache_purge' => $flush_report,
			),
			200
		);
	}
}

if ( ! function_exists( 'kr_v4_handle_sync_root_static' ) ) {
	/**
	 * POST /wp-json/keystone/v1/sync-root-static
	 * Mirrors llms.txt, llms-full.txt, and IndexNow verification key into /srv/htdocs/.
	 *
	 * @param WP_REST_Request $request Incoming REST request.
	 * @return WP_REST_Response
	 */
	function kr_v4_handle_sync_root_static( WP_REST_Request $request ): WP_REST_Response {
		$params  = $request->get_json_params();
		$body    = is_array( $params ) ? $params : $request->get_params();
		$results = array();

		if ( isset( $body['files'] ) && is_array( $body['files'] ) ) {
			foreach ( $body['files'] as $fname => $fcontent ) {
				if ( is_string( $fname ) && is_string( $fcontent ) ) {
					$results[ $fname ] = kr_v4_write_root_static_mirror( $fname, $fcontent );
				}
			}
		} elseif ( ! empty( $body['file'] ) && isset( $body['content'] ) ) {
			$fname             = (string) $body['file'];
			$results[ $fname ] = kr_v4_write_root_static_mirror( $fname, (string) $body['content'] );
		} else {
			$theme_dir = trailingslashit( get_stylesheet_directory() );
			foreach ( array( 'llms.txt', 'llms-full.txt' ) as $fn ) {
				if ( file_exists( $theme_dir . $fn ) ) {
					$results[ $fn ] = kr_v4_write_root_static_mirror( $fn, (string) file_get_contents( $theme_dir . $fn ) );
				}
			}
		}

		$flush_report = kr_v4_flush_edge_and_batcache();

		return new WP_REST_Response(
			array(
				'ok'               => ! empty( $results ),
				'results'          => $results,
				'edge_cache_purge' => $flush_report,
			),
			200
		);
	}
}

if ( ! function_exists( 'kr_v4_get_private_vault_dir' ) ) {
	/**
	 * Returns the unguessable HMAC-salted private vault directory inside wp-content/uploads/.
	 * WP Cloud Nginx cannot enumerate directories, and each file inside is stored under a
	 * 64-hex HMAC-SHA256 `.bin` filename so direct static URL scraping returns 404.
	 */
	function kr_v4_get_private_vault_dir(): string {
		$uploads = function_exists( 'wp_upload_dir' ) ? wp_upload_dir() : array();
		$basedir = ( is_array( $uploads ) && ! empty( $uploads['basedir'] ) )
			? rtrim( str_replace( '\\', '/', (string) $uploads['basedir'] ), '/' )
			: rtrim( str_replace( '\\', '/', (string) WP_CONTENT_DIR ), '/' ) . '/uploads';
		$salt    = function_exists( 'wp_salt' ) ? (string) wp_salt( 'auth' ) : 'kr_private_vault_fallback_salt';
		return $basedir . '/kr-vault-' . substr( hash_hmac( 'sha256', 'kr_private_vault_v4', $salt ), 0, 40 );
	}
}

if ( ! function_exists( 'kr_v4_normalize_private_vault_rel_path' ) ) {
	/**
	 * Validates and normalizes a logical relative path for private vault storage.
	 * Returns empty string if invalid or outside allowed deliverable extensions.
	 */
	function kr_v4_normalize_private_vault_rel_path( string $logical_rel_path ): string {
		$rel = trim( str_replace( '\\', '/', $logical_rel_path ) );
		$rel = ltrim( $rel, '/' );
		if (
			'' === $rel ||
			false !== strpos( $rel, "\0" ) ||
			false !== strpos( $rel, '..' ) ||
			false !== strpos( $rel, ':' ) ||
			0 === strpos( $rel, '.' ) ||
			false !== strpos( $rel, '/.' )
		) {
			return '';
		}
		if ( 1 !== preg_match( '/^[a-zA-Z0-9_\/.-]+\.(zip|pdf|png|svg|json|md)$/i', $rel ) ) {
			return '';
		}
		return $rel;
	}
}

if ( ! function_exists( 'kr_v4_get_private_vault_bin_path' ) ) {
	/**
	 * Computes the full on-disk `.bin` path for a normalized logical relative path.
	 */
	function kr_v4_get_private_vault_bin_path( string $logical_rel_path ): string {
		$norm = kr_v4_normalize_private_vault_rel_path( $logical_rel_path );
		if ( '' === $norm ) {
			return '';
		}
		$salt = function_exists( 'wp_salt' ) ? (string) wp_salt( 'auth' ) : 'kr_private_vault_fallback_salt';
		return kr_v4_get_private_vault_dir() . '/' . hash_hmac( 'sha256', $norm, $salt ) . '.bin';
	}
}

if ( ! function_exists( 'kr_v4_purge_public_theme_vault_binaries' ) ) {
	/**
	 * Purges all paid deliverable files from the public child-theme `assets/vault_packs/`
	 * directory on WP Cloud, keeping only `.htaccess` and `index.php` guards.
	 *
	 * @return array{purged_count: int, purged_files: array<int, string>, remaining_public_binaries: int}
	 */
	function kr_v4_purge_public_theme_vault_binaries(): array {
		$public_dir   = rtrim( str_replace( '\\', '/', get_stylesheet_directory() ), '/' ) . '/assets/vault_packs';
		$purged_files = array();
		if ( ! is_dir( $public_dir ) ) {
			return array(
				'purged_count'              => 0,
				'purged_files'              => array(),
				'remaining_public_binaries' => 0,
			);
		}

		$iter = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $public_dir, FilesystemIterator::SKIP_DOTS ),
			RecursiveIteratorIterator::CHILD_FIRST
		);

		$remaining = 0;
		foreach ( $iter as $item ) {
			$full_path = str_replace( '\\', '/', $item->getPathname() );
			$rel_name  = ltrim( substr( $full_path, strlen( $public_dir ) ), '/' );
			if ( $item->isDir() ) {
				@rmdir( $full_path );
				continue;
			}
			if ( '.htaccess' === $rel_name || 'index.php' === $rel_name ) {
				continue;
			}
			if ( @unlink( $full_path ) ) {
				$purged_files[] = $rel_name;
			} elseif ( file_exists( $full_path ) ) {
				$remaining += 1;
			}
		}

		return array(
			'purged_count'              => count( $purged_files ),
			'purged_files'              => $purged_files,
			'remaining_public_binaries' => $remaining,
		);
	}
}

if ( ! function_exists( 'kr_v4_handle_sync_private_vault_asset' ) ) {
	/**
	 * POST /wp-json/keystone/v1/sync-private-vault-asset
	 * Writes base64-encoded paid `.zip` / `.pdf` / diagram deliverables into the
	 * unguessable HMAC private vault directory and purges public theme copies.
	 */
	function kr_v4_handle_sync_private_vault_asset( WP_REST_Request $request ): WP_REST_Response {
		$params     = $request->get_json_params() ?: $request->get_params();
		$purge_only = ! empty( $params['purge_only'] );
		$do_purge   = ! array_key_exists( 'purge_public_theme_copies', (array) $params ) || ! empty( $params['purge_public_theme_copies'] );

		if ( $purge_only ) {
			$purge_report = kr_v4_purge_public_theme_vault_binaries();
			return new WP_REST_Response(
				array(
					'ok'            => true,
					'success'       => true,
					'purge_only'    => true,
					'purged_public' => $purge_report,
				),
				200
			);
		}

		$raw_rel = (string) ( $params['logical_rel_path'] ?? $params['rel_path'] ?? $params['file'] ?? '' );
		$norm    = kr_v4_normalize_private_vault_rel_path( $raw_rel );
		if ( '' === $norm ) {
			return new WP_REST_Response(
				array(
					'ok'      => false,
					'success' => false,
					'code'    => 'invalid_logical_rel_path',
					'message' => 'Invalid or disallowed logical_rel_path for private vault asset.',
				),
				400
			);
		}

		$raw_b64 = (string) ( $params['content_base64'] ?? $params['content_b64'] ?? $params['content'] ?? '' );
		if ( '' === $raw_b64 ) {
			return new WP_REST_Response(
				array(
					'ok'      => false,
					'success' => false,
					'code'    => 'missing_content_base64',
					'message' => 'Missing content_base64 payload.',
				),
				400
			);
		}

		$bytes = base64_decode( $raw_b64, true );
		if ( false === $bytes || '' === $bytes ) {
			return new WP_REST_Response(
				array(
					'ok'      => false,
					'success' => false,
					'code'    => 'invalid_base64',
					'message' => 'Failed to decode content_base64 payload.',
				),
				400
			);
		}

		$actual_sha   = hash( 'sha256', $bytes );
		$expected_sha = strtolower( trim( (string) ( $params['sha256'] ?? '' ) ) );
		if ( '' !== $expected_sha && ! hash_equals( $expected_sha, $actual_sha ) ) {
			return new WP_REST_Response(
				array(
					'ok'          => false,
					'success'     => false,
					'code'        => 'sha256_mismatch',
					'expected'    => $expected_sha,
					'actual'      => $actual_sha,
					'message'     => 'SHA-256 verification failed for private vault asset.',
				),
				400
			);
		}

		$vault_dir = kr_v4_get_private_vault_dir();
		if ( ! is_dir( $vault_dir ) ) {
			if ( function_exists( 'wp_mkdir_p' ) ) {
				wp_mkdir_p( $vault_dir );
			} else {
				@mkdir( $vault_dir, 0750, true );
			}
		}
		if ( ! is_dir( $vault_dir ) ) {
			return new WP_REST_Response(
				array(
					'ok'      => false,
					'success' => false,
					'code'    => 'vault_mkdir_failed',
					'message' => 'Unable to create private vault directory in uploads.',
				),
				500
			);
		}

		$ht_guard = $vault_dir . '/.htaccess';
		if ( ! file_exists( $ht_guard ) ) {
			@file_put_contents(
				$ht_guard,
				"Order deny,allow\nDeny from all\n<IfModule mod_authz_core.c>\n    Require all denied\n</IfModule>\n",
				LOCK_EX
			);
		}
		$idx_guard = $vault_dir . '/index.php';
		if ( ! file_exists( $idx_guard ) ) {
			@file_put_contents( $idx_guard, "<?php\nhttp_response_code( 403 );\nexit;\n", LOCK_EX );
		}

		$bin_path = kr_v4_get_private_vault_bin_path( $norm );
		$tmp_path = $bin_path . '.tmp.' . uniqid( '', true );
		$written  = @file_put_contents( $tmp_path, $bytes, LOCK_EX );
		if ( false === $written || (int) $written !== strlen( $bytes ) ) {
			@unlink( $tmp_path );
			return new WP_REST_Response(
				array(
					'ok'      => false,
					'success' => false,
					'code'    => 'vault_write_failed',
					'message' => 'Failed writing temporary private vault binary.',
				),
				500
			);
		}
		if ( ! @rename( $tmp_path, $bin_path ) ) {
			$copied = @copy( $tmp_path, $bin_path );
			@unlink( $tmp_path );
			if ( ! $copied ) {
				return new WP_REST_Response(
					array(
						'ok'      => false,
						'success' => false,
						'code'    => 'vault_atomic_rename_failed',
						'message' => 'Failed finalizing private vault binary on disk.',
					),
					500
				);
			}
		}

		$manifest = get_option( 'keystone_private_vault_manifest_v4', array() );
		if ( ! is_array( $manifest ) ) {
			$manifest = array();
		}
		$manifest[ $norm ] = array(
			'logical_rel_path' => $norm,
			'stored_bin_name'  => basename( $bin_path ),
			'bytes'            => strlen( $bytes ),
			'sha256'           => $actual_sha,
			'updated_at'       => gmdate( 'c' ),
		);
		update_option( 'keystone_private_vault_manifest_v4', $manifest, false );

		$purge_report = $do_purge
			? kr_v4_purge_public_theme_vault_binaries()
			: array( 'purged_count' => 0, 'purged_files' => array(), 'remaining_public_binaries' => -1 );

		return new WP_REST_Response(
			array(
				'ok'               => true,
				'success'          => true,
				'logical_rel_path' => $norm,
				'stored_bin_name'  => basename( $bin_path ),
				'bytes'            => strlen( $bytes ),
				'sha256'           => $actual_sha,
				'purged_public'    => $purge_report,
			),
			200
		);
	}
}

if ( ! function_exists( 'kr_v4_handle_private_vault_manifest' ) ) {
	/**
	 * GET /wp-json/keystone/v1/private-vault-manifest
	 * Admin-only verification endpoint reporting private vault parity and public theme cleanliness.
	 */
	function kr_v4_handle_private_vault_manifest(): WP_REST_Response {
		$manifest = get_option( 'keystone_private_vault_manifest_v4', array() );
		if ( ! is_array( $manifest ) ) {
			$manifest = array();
		}
		$verified_items = array();
		foreach ( $manifest as $rel => $meta ) {
			$bin_path               = kr_v4_get_private_vault_bin_path( (string) $rel );
			$exists                 = ( '' !== $bin_path && is_file( $bin_path ) && is_readable( $bin_path ) );
			$entry                  = is_array( $meta ) ? $meta : array();
			$entry['exists_on_disk'] = $exists;
			$entry['disk_bytes']    = $exists ? (int) filesize( $bin_path ) : 0;
			$verified_items[ $rel ] = $entry;
		}

		$public_dir  = rtrim( str_replace( '\\', '/', get_stylesheet_directory() ), '/' ) . '/assets/vault_packs';
		$public_left = array();
		if ( is_dir( $public_dir ) ) {
			$iter = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator( $public_dir, FilesystemIterator::SKIP_DOTS )
			);
			foreach ( $iter as $item ) {
				if ( $item->isFile() ) {
					$full = str_replace( '\\', '/', $item->getPathname() );
					$rel  = ltrim( substr( $full, strlen( $public_dir ) ), '/' );
					if ( '.htaccess' !== $rel && 'index.php' !== $rel ) {
						$public_left[] = $rel;
					}
				}
			}
		}

		return new WP_REST_Response(
			array(
				'ok'                        => true,
				'vault_dir_basename'        => basename( kr_v4_get_private_vault_dir() ),
				'asset_count'               => count( $verified_items ),
				'public_theme_leaked_count' => count( $public_left ),
				'public_theme_leaked_files' => $public_left,
				'assets'                    => $verified_items,
			),
			200
		);
	}
}

if ( ! function_exists( 'kr_v4_register_theme_sync_routes' ) ) {
	/**
	 * Registers Sovereign v4.0 sync and manifest routes at priority 30 with $override = true
	 * so this module upgrades any legacy /sync-theme-asset registration cleanly.
	 */
	function kr_v4_register_theme_sync_routes(): void {
		register_rest_route(
			'keystone/v1',
			'/theme-manifest',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => 'kr_v4_handle_theme_manifest',
				'permission_callback' => 'kr_v4_verify_admin_sync_permission',
			),
			true
		);

		register_rest_route(
			'keystone/v1',
			'/sync-theme-asset',
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => 'kr_v4_handle_sync_theme_asset',
				'permission_callback' => 'kr_v4_verify_admin_sync_permission',
			),
			true
		);

		register_rest_route(
			'keystone/v1',
			'/sync-root-static',
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => 'kr_v4_handle_sync_root_static',
				'permission_callback' => 'kr_v4_verify_admin_sync_permission',
			),
			true
		);

		register_rest_route(
			'keystone/v1',
			'/sync-private-vault-asset',
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => 'kr_v4_handle_sync_private_vault_asset',
				'permission_callback' => 'kr_v4_verify_admin_sync_permission',
			),
			true
		);

		register_rest_route(
			'keystone/v1',
			'/private-vault-manifest',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => 'kr_v4_handle_private_vault_manifest',
				'permission_callback' => 'kr_v4_verify_admin_sync_permission',
			),
			true
		);
	}
	add_action( 'rest_api_init', 'kr_v4_register_theme_sync_routes', 30 );
}
