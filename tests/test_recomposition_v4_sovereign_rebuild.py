"""Keystone Recomposition Sovereign v4.0 Rebuild — Comprehensive Verification Suite (36 Tests)."""

from __future__ import annotations

import json
import re
import shutil
import subprocess
from pathlib import Path

import pytest

THEME_DIR = Path(__file__).resolve().parents[1]
PHP_BIN = shutil.which("php") or "php"

BANNED_GREENS = ("#10b981", "#22c55e", "#4ade80", "#86efac")
BANNED_PEPTIDES = (
    "peptide",
    "glp-1",
    "mounjaro",
    "tirzepatide",
    "retatrutide",
    "bpc-157",
    "tb-500",
    "semaglutide",
)
BANNED_DAEMON_LEAKS = (
    "chrome_overlay_daemon.py",
    "local_stt_daemon.py",
    "agent_voice_tts_daemon.py",
    "instant_watchdog.py",
)

V4_FILES = (
    "header.php",
    "footer.php",
    "inc/enqueue.php",
    "assets/css/sovereign-v4-shell.css",
    "front-page.php",
    "template-parts/kr-watch-theater.php",
    "template-parts/kr-discography-reel.php",
    "template-parts/kr-architecture-reel.php",
    "template-parts/kr-faq-accordion.php",
    "assets/css/sovereign-v4-frontpage.css",
    "inc/sync-theme-endpoint.php",
    "inc/core-routes.php",
    "home.php",
    "template-sonic-universe.php",
    "template-founder-story.php",
    "template-contact.php",
    "template-investments.php",
    "template-lifestyle.php",
    "template-ecosystem-partners.php",
)


def _read(rel: str) -> str:
    return (THEME_DIR / rel).read_text(encoding="utf-8")


# ── 1. Native Color Tokens & Zero Emerald Drift ──────────────────────────────


@pytest.mark.parametrize("token", ["#04070d", "#000000", "#d4af37", "#f6d365", "#38bdf8", "#00ced1"])
def test_shell_css_contains_native_sovereign_color_tokens(token: str) -> None:
    css = _read("assets/css/sovereign-v4-shell.css").lower()
    assert token in css, f"Missing native color token {token} in sovereign-v4-shell.css"


@pytest.mark.parametrize("token", ["#04070d", "#000000", "#d4af37", "#f6d365", "#38bdf8", "#00ced1"])
def test_frontpage_css_contains_native_sovereign_color_tokens(token: str) -> None:
    css = _read("assets/css/sovereign-v4-frontpage.css").lower()
    assert token in css, f"Missing native color token {token} in sovereign-v4-frontpage.css"


@pytest.mark.parametrize("rel_file", V4_FILES)
def test_zero_emerald_green_cta_drift_in_v4_files(rel_file: str) -> None:
    src = _read(rel_file).lower()
    for green in BANNED_GREENS:
        assert green not in src, f"Forbidden emerald green {green} found in {rel_file}"


# ── 2. Header, Top Utility Bar, 44x44 Logo & Mobile Drawer FOUC Guard ────────


def test_header_top_utility_bar_and_locked_44x44_logo() -> None:
    hdr = _read("header.php")
    assert "kr-utility-bar" in hdr
    assert "kp-badge-img" in hdr
    assert 'width="44"' in hdr and 'height="44"' in hdr
    assert "@KeystoneAIProtocols" in hdr
    assert "@KeyStoneRecomposition" in hdr


def test_mobile_drawer_hidden_by_default_fouc_guard() -> None:
    enq = _read("inc/enqueue.php")
    shell_css = _read("assets/css/sovereign-v4-shell.css")
    assert "sovereign-v4-shell.css" in enq
    assert "sovereign-v4-frontpage.css" in enq
    assert "#mobileDrawer:not(.active)" in enq
    assert "display:none!important" in enq.replace(" ", "")
    assert "#mobileDrawer" in shell_css


def test_footer_pure_black_sister_bridge_and_lightbox() -> None:
    ftr = _read("footer.php")
    assert "#000000" in ftr
    assert "https://keystonepossibilities.ca/" in ftr
    assert "krLightboxModal" in ftr
    assert "@KeystonePossibilitiesLtd" in ftr


# ── 3. Sovereign v4.0 8-Section Front Page & 4 Cinema Reel Components ────────


def test_front_page_8_sections_and_4_template_parts() -> None:
    fp = _read("front-page.php")
    for part in (
        "template-parts/kr-watch-theater",
        "template-parts/kr-discography-reel",
        "template-parts/kr-architecture-reel",
        "template-parts/kr-faq-accordion",
    ):
        assert part in fp, f"front-page.php missing {part}"
    for sec_id in ('id="hero"', 'id="domain-matrix"', 'id="sync-partner-desk"', 'id="latest-intel"', 'id="consultation-desk"'):
        assert sec_id in fp, f"front-page.php missing section {sec_id}"


@pytest.mark.parametrize(
    "part_rel",
    [
        "template-parts/kr-watch-theater.php",
        "template-parts/kr-discography-reel.php",
        "template-parts/kr-architecture-reel.php",
        "template-parts/kr-faq-accordion.php",
    ],
)
def test_kr_template_parts_exist_and_non_empty(part_rel: str) -> None:
    path = THEME_DIR / part_rel
    assert path.is_file(), f"Missing {part_rel}"
    assert path.stat().st_size > 500, f"Undersized {part_rel}"


# ── 4. Secondary Hubs, /ecosystem-partners/ Backlink Preservation & Air-Gap ──


def test_ecosystem_partners_template_preserves_wp_content_and_air_gap() -> None:
    eco = _read("template-ecosystem-partners.php")
    assert "Template Name: Ecosystem Partners" in eco
    assert "the_content()" in eco
    assert "apply_filters( 'the_content'" in eco
    assert "keystone_recomp_build_ecosystem_partner_cards_markup" in eco
    assert "https://keystonepossibilities.ca/" in eco
    assert "overflow-x: clip" in eco
    for civil_sub in ("Fast + Epp", "Glotman Simpson", "Thurber", "Lewkowich", "Measured Architecture", "/industry-partners/"):
        assert civil_sub.lower() not in eco.lower(), f"Air-gap breach: {civil_sub} leaked into template-ecosystem-partners.php"


def test_core_routes_registers_ecosystem_partners_and_drops_stub_recreation() -> None:
    routes = _read("inc/core-routes.php")
    assert "$slug === 'ecosystem-partners'" in routes
    assert "template-ecosystem-partners.php" in routes
    # 301 redirect for legacy /about-the-founder/ stays intact, while stub page auto-creation is removed
    assert "'about-the-founder'" in routes.split("function keystone_ensure_core_pages_exist")[0]
    pages_fn_body = routes.split("function keystone_ensure_core_pages_exist")[1].split("function keystone_check_sovereign_purge_trigger")[0]
    assert "'about-the-founder'" not in pages_fn_body
    assert "'ecosystem-partners'" in pages_fn_body


@pytest.mark.parametrize(
    "hub_rel",
    [
        "home.php",
        "template-founder-story.php",
        "template-contact.php",
        "template-investments.php",
        "template-lifestyle.php",
        "template-ecosystem-partners.php",
    ],
)
def test_secondary_hubs_enforce_overflow_clip_and_sister_empire_bridge(hub_rel: str) -> None:
    src = _read(hub_rel)
    assert "overflow-x: clip" in src, f"{hub_rel} missing overflow-x: clip guard"
    assert "https://keystonepossibilities.ca" in src, f"{hub_rel} missing clickable Sister-Empire bridge"


# ── 5. SHA-256 REST Sync Endpoint & Live PHP Runtime Verification ────────────


def test_functions_requires_sync_theme_endpoint() -> None:
    fn_php = _read("functions.php")
    assert "inc/sync-theme-endpoint.php" in fn_php


def test_sync_theme_endpoint_contracts_and_guards() -> None:
    sync_php = _read("inc/sync-theme-endpoint.php")
    assert "declare(strict_types=1);" in sync_php
    assert "current_user_can( 'manage_options' )" in sync_php
    assert "'/sync-theme-asset'" in sync_php
    assert "'/theme-manifest'" in sync_php
    assert "'/sync-root-static'" in sync_php
    assert "TOKEN_PARSE" in sync_php
    assert "hash( 'sha256'" in sync_php and "hash_equals" in sync_php
    assert "/srv/htdocs" in sync_php
    assert "clean_post_cache" in sync_php and "wp_cache_flush" in sync_php


def test_sync_endpoint_php_runtime_allowlist_and_syntax_validator() -> None:
    php_probe = r"""
    define('ABSPATH', __DIR__ . '/');
    function add_action($h, $c, $p = 10) {}
    require '09_Keystone_websites/themes/keystone-recomposition-child/inc/sync-theme-endpoint.php';
    $out = [
        'allow_root' => kr_v4_is_allowed_theme_rel_path('front-page.php'),
        'allow_part' => kr_v4_is_allowed_theme_rel_path('template-parts/kr-watch-theater.php'),
        'allow_css'  => kr_v4_is_allowed_theme_rel_path('assets/css/sovereign-v4-shell.css'),
        'allow_llms' => kr_v4_is_allowed_theme_rel_path('llms-full.txt'),
        'deny_trav'  => kr_v4_is_allowed_theme_rel_path('../wp-config.php'),
        'deny_abs'   => kr_v4_is_allowed_theme_rel_path('/etc/passwd'),
        'valid_php'  => kr_v4_validate_php_syntax("<?php\ndeclare(strict_types=1);\nfunction ok(): int { return 1; }\n"),
        'broken_php' => kr_v4_validate_php_syntax("<?php\nfunction broken( { return 1; }\n"),
    ];
    echo json_encode($out);
    """
    res = subprocess.run([PHP_BIN, "-r", php_probe], cwd=str(THEME_DIR.parents[2]), capture_output=True, text=True, check=True)
    data = json.loads(res.stdout.strip())
    assert data["allow_root"] is True
    assert data["allow_part"] is True
    assert data["allow_css"] is True
    assert data["allow_llms"] is True
    assert data["deny_trav"] is False
    assert data["deny_abs"] is False
    assert data["valid_php"] is True
    assert isinstance(data["broken_php"], str) and "ParseError" in data["broken_php"]


# ── 6. GEO llms.txt & llms-full.txt Refresh ──────────────────────────────────


def test_llms_and_llms_full_sovereign_v4_refresh() -> None:
    llms = _read("llms.txt")
    llms_full = _read("llms-full.txt")
    for doc in (llms, llms_full):
        assert "Sovereign v4.0" in doc
        assert "25 Official Releases" in doc
        assert "246" in doc
        assert "https://keystonerecomposition.com/#wayne-stevenson" in doc
        assert "https://keystonepossibilities.ca/" in doc
        assert "#52603" in doc and "ES54" in doc
        for route in ("/ai-protocols/", "/sonic-universe/", "/intel/", "/founder/", "/investments/", "/lifestyle/", "/ecosystem-partners/", "/contact/"):
            assert route in doc, f"Missing canonical route {route} in GEO discovery file"
    assert "24-Release" not in llms_full and "236" not in llms_full


# ── 7. Rule 11 Zero-Peptide Ban, Rule 30 Air-Gap & Full Theme php -l Lint ───


def test_rule11_zero_peptide_and_rule30_zero_daemon_leaks_across_theme() -> None:
    targets = list(THEME_DIR.glob("*.php")) + list((THEME_DIR / "template-parts").rglob("*.php")) + [
        THEME_DIR / "llms.txt",
        THEME_DIR / "llms-full.txt",
    ]
    for path in targets:
        low = path.read_text(encoding="utf-8", errors="ignore").lower()
        for pep in BANNED_PEPTIDES:
            assert re.search(rf"\b{re.escape(pep)}s?\b", low) is None, f"Rule 11 violation ({pep}) in {path.name}"
        for leak in BANNED_DAEMON_LEAKS:
            assert leak not in low, f"Rule 30 daemon leak ({leak}) in {path.name}"


def test_php_syntax_lint_passes_every_php_file_in_child_theme() -> None:
    php_files = sorted(
        p for p in THEME_DIR.rglob("*.php") if ".git" not in p.parts and "logs" not in p.parts
    )
    assert len(php_files) >= 25
    for php_file in php_files:
        proc = subprocess.run([PHP_BIN, "-l", str(php_file)], capture_output=True, text=True, check=False)
        assert proc.returncode == 0, f"php -l failed on {php_file}: {proc.stdout}\n{proc.stderr}"


# ── 8. Musixmatch Graduate Diploma, Corporate #BC1573685 & Sister 305 CPD ───


def test_musixmatch_diploma_asset_staged_clean_and_allowlisted() -> None:
    diploma_path = THEME_DIR / "assets" / "images" / "musixmatch-academy-graduate-2026.jpg"
    assert diploma_path.is_file(), "Missing staged Musixmatch graduate diploma JPEG"
    raw = diploma_path.read_bytes()
    assert 50_000 < len(raw) < 600_000, f"Unexpected diploma byte size: {len(raw)}"
    assert raw[:3] == b"\xff\xd8\xff", "Diploma file is not a valid JPEG"

    php_probe = r"""
    define('ABSPATH', __DIR__ . '/');
    function add_action($h, $c, $p = 10) {}
    require '09_Keystone_websites/themes/keystone-recomposition-child/inc/sync-theme-endpoint.php';
    echo json_encode([
        'allowed' => kr_v4_is_allowed_theme_rel_path('assets/images/musixmatch-academy-graduate-2026.jpg'),
    ]);
    """
    res = subprocess.run([PHP_BIN, "-r", php_probe], cwd=str(THEME_DIR.parents[2]), capture_output=True, text=True, check=True)
    assert json.loads(res.stdout.strip())["allowed"] is True


@pytest.mark.parametrize("tpl_rel", ["template-sonic-universe.php", "template-founder-story.php"])
def test_sonic_and_founder_showcase_musixmatch_diploma_and_statutory_credentials(tpl_rel: str) -> None:
    src = _read(tpl_rel)
    for token in (
        "Certified Musixmatch Graduate",
        "Class of February 2026",
        "Vanessa Hurst",
        "musixmatch-academy-graduate-2026.jpg",
        'data-kr-lightbox="1"',
        "data-kr-lightbox-open=",
        "72648585",
        "1a30328b-20b2-48bd-8e56-2884d3b040c0",
        "52v3Qe6Jo0hg764driOl5Y",
        "BC1573685",
        "BC1408830",
        "BC Housing Licensed Developer &amp; General Contractor #52603",
        "305 Verified CPD Points",
        "230088",
        "ES54",
    ):
        assert token in src, f"{tpl_rel} missing required credential token: {token}"


def test_footer_and_frontpage_corporate_bc1573685_and_305_cpd_badges() -> None:
    ftr = _read("footer.php")
    for token in (
        "Keystone Recomposition Ltd. (BC Corp #BC1573685)",
        "Keystone Possibilities Ltd. (BC Corp #BC1408830)",
        "Certified Musixmatch Graduate",
        "305 Verified CPD Points",
        "230088",
        "Developer &amp; General Contractor #52603",
    ):
        assert token in ftr, f"footer.php missing {token}"

    fp = _read("front-page.php")
    for token in ("BC1408830", "305", "230088", "Developer &amp; General Contractor #52603"):
        assert token in fp, f"front-page.php missing {token}"


def test_seo_schema_bc1573685_musixmatch_diploma_and_head_budget_under_30kb() -> None:
    php_probe = r"""
    define('ABSPATH', __DIR__ . '/');
    function add_filter($h, $c, $p = 10, $a = 1) {}
    function add_action($h, $c, $p = 10, $a = 1) {}
    function get_stylesheet_directory_uri() { return 'https://keystonerecomposition.com/wp-content/themes/keystone-recomposition'; }
    function get_stylesheet_directory() { return __DIR__ . '/09_Keystone_websites/themes/keystone-recomposition-child'; }
    function home_url($p = '/') { return 'https://keystonerecomposition.com/' . ltrim($p, '/'); }
    function wp_json_encode($d, $f = 0) { return json_encode($d, $f); }
    function is_page($s = '') { return false; }
    function is_front_page() { return true; }
    function is_home() { return false; }
    function is_singular($t = '') { return false; }
    $_SERVER['REQUEST_URI'] = '/';
    require '09_Keystone_websites/themes/keystone-recomposition-child/inc/seo-schema.php';
    ob_start();
    keystone_recomposition_child_inject_schema();
    keystone_inject_ai_protocols_software_schema();
    $head_out = ob_get_clean();
    $person = keystone_get_wayne_stevenson_person_schema();
    echo json_encode([
        'head_bytes' => strlen($head_out),
        'head_out'   => $head_out,
        'person'     => $person,
    ]);
    """
    res = subprocess.run([PHP_BIN, "-r", php_probe], cwd=str(THEME_DIR.parents[2]), capture_output=True, text=True, check=True)
    payload = json.loads(res.stdout.strip())
    assert payload["head_bytes"] < 30_000, f"<head> JSON-LD exceeded 30KB budget: {payload['head_bytes']} bytes"
    head_out = payload["head_out"]
    for token in ("Keystone Recomposition Ltd.", "BC1573685", "BC1408830", "Certified Musixmatch Graduate", "305 Verified CPD Points", "230088"):
        assert token in head_out, f"Rendered <head> JSON-LD missing {token}"
    cred_names = " | ".join(c.get("name", "") for c in payload["person"].get("hasCredential", []))
    assert "Certified Musixmatch Graduate" in cred_names
    assert "305 Verified CPD Points" in cred_names
    assert "230088" in cred_names


@pytest.mark.parametrize("geo_file", ["llms.txt", "llms-full.txt"])
def test_geo_files_sync_musixmatch_diploma_bc1573685_and_305_cpd(geo_file: str) -> None:
    doc = _read(geo_file)
    for token in (
        "BC1573685",
        "BC1408830",
        "Certified Musixmatch Graduate",
        "Vanessa Hurst",
        "72648585",
        "305 Verified CPD Points",
        "Developer and General Contractor",
        "230088",
        "musixmatch-academy-graduate-2026.jpg",
    ):
        assert token in doc, f"{geo_file} missing {token}"


def test_zero_public_vault_pack_zip_or_pdf_binaries_in_theme() -> None:
    vault_dir = THEME_DIR / "assets" / "vault_packs"
    if vault_dir.exists():
        leaked = [p.name for p in vault_dir.rglob("*") if p.is_file() and p.suffix.lower() in {".zip", ".pdf"}]
        assert not leaked, f"Forbidden public binaries in assets/vault_packs/: {leaked}"

