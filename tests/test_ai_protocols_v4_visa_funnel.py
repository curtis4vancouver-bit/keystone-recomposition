"""Keystone AI Protocols v4.0 Visa Funnel, Real %PDF-1.7 Vault, Upgrade Credit & FAQ/Schema Suite."""

from __future__ import annotations

import json
import re
import shutil
import subprocess
from pathlib import Path

import pytest

THEME_DIR = Path(__file__).resolve().parents[1]
PHP_BIN = shutil.which("php") or "php"

OWNED_V4_FUNNEL_FILES = (
    "template-ai-protocols.php",
    "inc/seo-schema.php",
    "front-page.php",
    "template-parts/kr-faq-accordion.php",
    "assets/css/sovereign-v4-shell.css",
)

SERVER_PDF_SLUGS = (
    "tier1_pdf_01",
    "tier1_pdf_02",
    "tier1_pdf_03",
    "tier1_pdf_04",
    "tier2_pdf_05",
    "tier2_pdf_06",
    "tier2_pdf_07",
    "tier2_pdf_08",
    "tier2_pdf_09",
    "tier3_pdf_10",
    "tier3_pdf_11",
    "tier3_pdf_12",
    "tier1_pdf_master",
    "tier2_pdf_master",
    "tier3_pdf_master",
)

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


def _read(rel: str) -> str:
    return (THEME_DIR / rel).read_text(encoding="utf-8")


# ── 1. Real Server %PDF-1.7 Downloads & Zero Fake Client-Side %PDF-1.4 ───────


def test_fake_ascii_pdf14_synthesizer_completely_removed() -> None:
    tpl = _read("template-ai-protocols.php")
    assert "krEscapePdfText" not in tpl
    assert "%PDF-1.4" not in tpl
    assert "%PDF-1.7" in tpl


def test_real_pdf_and_master_book_download_helpers_use_server_vault_stream() -> None:
    tpl = _read("template-ai-protocols.php")
    assert "function krDownloadRealPdf(" in tpl
    assert "window.krDownloadMasterBook = function(" in tpl
    assert "?vault_download=" in tpl
    assert "portalMasterBookQuickBtn" in tpl
    assert "krMasterPdfBooksRow" in tpl
    assert 'data-master-slug="tier1_pdf_master"' in tpl
    assert 'data-master-slug="tier2_pdf_master"' in tpl
    assert 'data-master-slug="tier3_pdf_master"' in tpl


@pytest.mark.parametrize("pdf_slug", SERVER_PDF_SLUGS)
def test_all_15_server_pdf_slugs_wired_between_template_and_fulfillment_engine(pdf_slug: str) -> None:
    tpl = _read("template-ai-protocols.php")
    fulfillment = _read("inc/protocol-order-fulfillment.php")
    assert pdf_slug in tpl, f"Missing server PDF slug {pdf_slug} in template-ai-protocols.php"
    assert pdf_slug in fulfillment, f"Missing server PDF slug {pdf_slug} in inc/protocol-order-fulfillment.php"


# ── 2. Zero $0 Reservation Bypass When Visa Checkout Is Live ─────────────────


def test_reservation_submit_button_gated_behind_php_visa_live_flag() -> None:
    tpl = _read("template-ai-protocols.php")
    assert "$kr_visa_live = function_exists( 'keystone_is_stripe_ready' )" in tpl
    assert "window.KR_VISA_LIVE = <?php echo $kr_visa_live ? 'true' : 'false'; ?>;" in tpl
    gate_idx = tpl.index("<?php if ( ! $kr_visa_live ) : ?>")
    btn_idx = tpl.index('id="submitAutomatedOrderBtn"', gate_idx)
    end_idx = tpl.index("<?php endif; ?>", btn_idx)
    assert gate_idx < btn_idx < end_idx


def test_order_form_submit_redirects_to_stripe_when_visa_live() -> None:
    tpl = _read("template-ai-protocols.php")
    form_block_start = tpl.index("orderForm.addEventListener('submit'")
    form_block = tpl[form_block_start : form_block_start + 380]
    assert "if (window.KR_VISA_LIVE)" in form_block
    assert "runModalStripeCheckout();" in form_block


def test_stripe_checkout_handlers_have_zero_fallback_to_protocol_order_endpoint() -> None:
    tpl = _read("template-ai-protocols.php")
    hero_start = tpl.index("heroDirectForm.addEventListener('submit'")
    hero_end = tpl.index("document.querySelectorAll('.js-open-automated-order')", hero_start)
    hero_handler = tpl[hero_start:hero_end]
    assert "/wp-json/keystone/v1/create-checkout-session" in hero_handler
    assert "/wp-json/keystone/v1/protocol-order" not in hero_handler

    modal_start = tpl.index("function runModalStripeCheckout()")
    modal_end = tpl.index("if (stripeCardBtn)", modal_start)
    modal_handler = tpl[modal_start:modal_end]
    assert "/wp-json/keystone/v1/create-checkout-session" in modal_handler
    assert "/wp-json/keystone/v1/protocol-order" not in modal_handler


# ── 3. 1-Click Express Visa Checkout, Optional Pre-Fill & Modal Promo Sync ──


def test_hero_direct_checkout_form_preserves_ignore_guard_and_optional_fields() -> None:
    tpl = _read("template-ai-protocols.php")
    assert 'id="heroDirectCheckoutForm"' in tpl
    assert 'data-keystone-form-ignore="true"' in tpl
    assert "function isValidOptionalEmail(emailStr)" in tpl

    for input_id in ("heroBuyerName", "heroBuyerEmail", "orderBuyerName", "orderBuyerEmail"):
        m = re.search(rf"<input\b[^>]*\bid=\"{input_id}\"[^>]*>", tpl)
        assert m is not None, f"Missing input #{input_id}"
        tag = m.group(0)
        assert "required" not in tag.lower(), f"Input #{input_id} must be optional (no required attribute)"


def test_modal_and_hero_promo_code_inputs_synced_for_all_live_codes() -> None:
    tpl = _read("template-ai-protocols.php")
    assert 'id="promoInput"' in tpl
    assert 'id="applyPromoBtn"' in tpl
    assert 'id="modalPromoInput"' in tpl
    assert 'id="modalApplyPromoBtn"' in tpl
    assert 'id="modalPromoFeedback"' in tpl
    assert "function applySharedPromoCode(" in tpl
    for code in ("'BUILDER10': 10", "'WAYNE10': 10", "'KEYSTONE20': 20"):
        assert code in tpl


# ── 4. 100% Dollar-for-Dollar Upgrade Credit UX & Net Math ───────────────────


def test_upgrade_credit_banners_and_checkout_payload_wired() -> None:
    tpl = _read("template-ai-protocols.php")
    for elem_id in (
        "heroUpgradeCreditCallout",
        "krVaultUpgradeCreditBanner",
        "modalUpgradeCreditBanner",
    ):
        assert f'id="{elem_id}"' in tpl
    assert "function krComputeUpgradeNetPrice(" in tpl
    assert "window.krStartCreditUpgradeCheckout = function(" in tpl
    assert "upgrade_from_uid" in tpl
    for net_str in ("149.50", "750.50", "601"):
        assert net_str in tpl


def test_stripe_session_return_verifies_payment_and_unlocks_vault() -> None:
    tpl = _read("template-ai-protocols.php")
    assert "/wp-json/keystone/v1/verify-checkout-session?session_id=" in tpl
    assert "stripeSessionId.indexOf('cs_') === 0" in tpl
    assert "applyVerifiedVaultState({" in tpl


# ── 5. 4K Walkthrough Video IDs, Tier 03 Facade & Sticky Anchor Offsets ──────


def test_canonical_video_ids_and_tier3_preview_facade_present() -> None:
    tpl = _read("template-ai-protocols.php")
    for vid in ("u1gUjk9xcB4", "-ZYdbPXenCU", "LxbjlX_nh2Q", "_bSpYdvm6tc"):
        assert vid in tpl, f"Missing canonical walkthrough video ID {vid}"
    assert "s2s_lZ62g6g" not in tpl
    assert 'id="krTier3PreviewFacade"' in tpl
    assert "krActivateTierVideoFacade(" in tpl
    assert "5:54" in tpl
    assert "@KeyStoneRecomposition" in tpl


def test_tier_anchor_aliases_and_sticky_scroll_margin_offset() -> None:
    tpl = _read("template-ai-protocols.php")
    shell_css = _read("assets/css/sovereign-v4-shell.css")
    for anchor in ('id="kr-tier-1"', 'id="kr-tier-2"', 'id="kr-tier-3"', 'id="tier-blueprint"', 'id="tier-swarm"', 'id="tier-workstation"'):
        assert anchor in tpl
    assert "scroll-margin-top: 120px" in shell_css


# ── 6. Returning-Buyer Drawer Collapse & Auto-Expand Triggers ────────────────


def test_returning_buyer_uid_drawer_collapsed_by_default_with_smart_auto_expand() -> None:
    tpl = _read("template-ai-protocols.php")
    assert 'id="krReturningBuyerToggleBtn"' in tpl
    assert 'aria-expanded="false"' in tpl
    m = re.search(r'<div\s+id="krReturningBuyerDrawer"[^>]*>', tpl)
    assert m is not None
    assert "display: none" in m.group(0)
    assert "function setReturningDrawerOpen(" in tpl
    for trigger in ("urlParams.get('session_id')", "urlParams.get('uid')", "#kr-self-service-portal", "kr_user_vault_uid"):
        assert trigger in tpl


# ── 7. 60-Second Takeaway Strip, 7-Question Buyer FAQ & AggregateOffer Schema ─


def test_sixty_second_post_visa_takeaway_strip_and_buyer_faq_section_present() -> None:
    tpl = _read("template-ai-protocols.php")
    assert 'id="krSixtySecondTakeawayStrip"' in tpl
    assert "WHAT HAPPENS IN 60 SECONDS AFTER VISA CHECKOUT" in tpl.upper()
    assert 'id="ai-protocols-faq"' in tpl
    assert "keystone_get_ai_protocols_buyer_faqs()" in tpl


def test_inline_product_jsonld_offers_match_usd_tiers_and_anchors() -> None:
    tpl = _read("template-ai-protocols.php")
    ld_match = re.search(r'<script type="application/ld\+json">\s*(\{.*?\})\s*</script>', tpl, re.S)
    assert ld_match is not None
    graph = json.loads(ld_match.group(1))["@graph"]
    assert len(graph) == 3
    prices = [node["offers"]["price"] for node in graph]
    urls = [node["offers"]["url"] for node in graph]
    assert prices == ["49.50", "199.00", "800.00"]
    assert urls == [
        "https://keystonerecomposition.com/ai-protocols/#kr-tier-1",
        "https://keystonerecomposition.com/ai-protocols/#kr-tier-2",
        "https://keystonerecomposition.com/ai-protocols/#kr-tier-3",
    ]


def test_seo_schema_php_emits_valid_aggregate_offer_and_route_specific_faqpage() -> None:
    php_harness = r"""
define('ABSPATH', __DIR__ . '/');
function add_action($h, $c, $p = 10, $a = 1) {}
function add_filter($h, $c, $p = 10, $a = 1) {}
function add_shortcode($t, $c) {}
function home_url($path = '/') { return 'https://keystonerecomposition.com' . $path; }
function wp_json_encode($data, $opts = 0) { return json_encode($data, $opts); }
function esc_url($u) { return $u; }
function esc_attr($s) { return $s; }
function esc_html($s) { return $s; }
function get_page_template_slug($id = 0) { return $GLOBALS['__mock_tpl'] ?? ''; }
function is_page($slug = '') { return (bool) ($GLOBALS['__mock_is_page'] ?? false); }
function is_front_page() { return (bool) ($GLOBALS['__mock_is_front'] ?? false); }
function is_home() { return false; }

require 'inc/seo-schema.php';

$home_faqs = keystone_get_homepage_executive_faqs();
$buyer_faqs = keystone_get_ai_protocols_buyer_faqs();

// 1) Simulate /ai-protocols/
$GLOBALS['post'] = (object) ['ID' => 77, 'post_name' => 'ai-protocols'];
$GLOBALS['__mock_tpl'] = 'template-ai-protocols.php';
$GLOBALS['__mock_is_page'] = true;
$GLOBALS['__mock_is_front'] = false;
ob_start();
keystone_inject_ai_protocols_software_schema();
$ai_out = ob_get_clean();

// 2) Simulate Homepage /
$GLOBALS['post'] = (object) ['ID' => 2, 'post_name' => 'home'];
$GLOBALS['__mock_tpl'] = '';
$GLOBALS['__mock_is_page'] = false;
$GLOBALS['__mock_is_front'] = true;
ob_start();
keystone_inject_ai_protocols_software_schema();
$front_out = ob_get_clean();

echo json_encode([
    'home_faq_count' => count($home_faqs),
    'buyer_faq_count' => count($buyer_faqs),
    'buyer_faqs' => $buyer_faqs,
    'home_faqs' => $home_faqs,
    'ai_out' => $ai_out,
    'front_out' => $front_out,
]);
"""
    proc = subprocess.run(
        [PHP_BIN, "-r", php_harness],
        cwd=str(THEME_DIR),
        capture_output=True,
        text=True,
        check=False,
    )
    assert proc.returncode == 0, f"PHP schema harness failed: {proc.stderr}\n{proc.stdout}"
    payload = json.loads(proc.stdout)
    assert payload["home_faq_count"] == 5
    assert payload["buyer_faq_count"] == 7

    ai_json_match = re.search(r'<script type="application/ld\+json">\s*(\{.*?\})\s*</script>', payload["ai_out"], re.S)
    assert ai_json_match is not None
    ai_graph = json.loads(ai_json_match.group(1))["@graph"]
    sw_node = next(n for n in ai_graph if n.get("@type") == "SoftwareApplication")
    offers = sw_node["offers"]
    assert offers["@type"] == "AggregateOffer"
    assert offers["lowPrice"] == "49.50"
    assert offers["highPrice"] == "800.00"
    assert offers["priceCurrency"] == "USD"
    assert offers["offerCount"] == 3
    assert offers["availability"] == "https://schema.org/InStock"

    ai_faq_node = next(n for n in ai_graph if n.get("@type") == "FAQPage")
    assert ai_faq_node["@id"] == "https://keystonerecomposition.com/ai-protocols/#faq"
    assert len(ai_faq_node["mainEntity"]) == 7

    front_json_match = re.search(r'<script type="application/ld\+json">\s*(\{.*?\})\s*</script>', payload["front_out"], re.S)
    assert front_json_match is not None
    front_graph = json.loads(front_json_match.group(1))["@graph"]
    front_faq_node = next(n for n in front_graph if n.get("@type") == "FAQPage")
    assert front_faq_node["@id"] == "https://keystonerecomposition.com/#faq"
    assert len(front_faq_node["mainEntity"]) == 5

    # Verify 1:1 visible fallback FAQ question parity in template-ai-protocols.php & kr-faq-accordion.php
    tpl = _read("template-ai-protocols.php")
    home_acc = _read("template-parts/kr-faq-accordion.php")
    for item in payload["buyer_faqs"]:
        assert item["q"] in tpl
    for item in payload["home_faqs"]:
        assert item["q"] in home_acc


# ── 8. Copy Alignment, Hero Eager/Opacity Lock, CSS Braces & Lint Gates ──────


def test_tier2_6_agent_and_tier3_runnable_tauri_copy_aligned_with_zero_28_agent_drift() -> None:
    for rel in ("template-ai-protocols.php", "front-page.php", "template-parts/kr-faq-accordion.php", "inc/seo-schema.php"):
        src = _read(rel)
        assert "6-Agent Role Suite" in src, f"Missing '6-Agent Role Suite' in {rel}"
        assert "Rust + Tauri v2" in src, f"Missing 'Rust + Tauri v2' in {rel}"
        assert "28-Agent" not in src and "28-agent" not in src, f"Stale '28-Agent' reference in {rel}"


def test_front_page_hero_portrait_eager_and_above_fold_opacity_locked() -> None:
    fp = _read("front-page.php")
    assert "assets/images/wayne_avatar.jpg" in fp
    assert 'class="kr-fp-portrait-card" style="opacity: 1; transform: none;"' in fp
    assert 'class="kr-fp-quote" style="opacity: 1; transform: none;"' in fp
    img_match = re.search(r'<div class="kr-fp-portrait-card"[^>]*>\s*(<img\b.*?/>)', fp, re.S)
    assert img_match is not None
    img_tag = img_match.group(1)
    assert "$kr_wayne_avatar" in img_tag
    assert 'loading="eager"' in img_tag
    assert "opacity: 1" in img_tag


def test_shell_css_shared_faq_takeaway_and_upgrade_selectors_present() -> None:
    shell_css = _read("assets/css/sovereign-v4-shell.css")
    for sel in (
        ".kr-faq-list",
        ".kr-faq-item",
        ".kr-faq-plus",
        ".kr-faq-answer",
        ".kr-takeaway-strip-grid",
        ".kr-takeaway-card",
        ".kr-upgrade-credit-pill",
        ".kr-returning-uid-toggle",
    ):
        assert sel in shell_css, f"Missing selector {sel} in sovereign-v4-shell.css"


def test_shell_css_balanced_braces_and_zero_emerald_or_crlf_corruption() -> None:
    shell_css = _read("assets/css/sovereign-v4-shell.css")
    assert shell_css.count("{") == shell_css.count("}"), "Unbalanced CSS braces in sovereign-v4-shell.css"
    for rel in OWNED_V4_FUNNEL_FILES:
        raw = (THEME_DIR / rel).read_bytes()
        assert b"\r\r\n" not in raw, f"Double CR line ending corruption in {rel}"
        low = raw.decode("utf-8").lower()
        for green in BANNED_GREENS:
            assert green not in low, f"Forbidden emerald green {green} in {rel}"
        for pep in BANNED_PEPTIDES:
            assert re.search(rf"\b{re.escape(pep)}s?\b", low) is None, f"Rule 11 violation ({pep}) in {rel}"
        for leak in BANNED_DAEMON_LEAKS:
            assert leak not in low, f"Rule 30 daemon leak ({leak}) in {rel}"


@pytest.mark.parametrize(
    "php_rel",
    ("template-ai-protocols.php", "inc/seo-schema.php", "front-page.php", "template-parts/kr-faq-accordion.php"),
)
def test_modified_php_files_pass_php_syntax_lint(php_rel: str) -> None:
    proc = subprocess.run(
        [PHP_BIN, "-l", str(THEME_DIR / php_rel)],
        capture_output=True,
        text=True,
        check=False,
    )
    assert proc.returncode == 0, f"php -l failed on {php_rel}: {proc.stdout}\n{proc.stderr}"
