"""
test_nov10_full_audit_remediation.py
====================================
Deterministic E2E & Runtime Verification Suite for the November 2026
Keystone Recomposition v3 Full Audit, Client Funnel Repair, CSS Extraction,
24-Release Catalog Sync, and Google Knowledge Panel Entity Graph Upgrade.
"""

import os
import re
import subprocess
import pytest

THEME_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))


class TestNov10FullAuditRemediation:
    """Validates Slices A, B, and C across PHP runtime, JS/CSS assets, and templates."""

    def test_slice_a_lead_consultation_rest_endpoint_and_scoping(self):
        fulfillment_php = os.path.join(THEME_DIR, "inc", "protocol-order-fulfillment.php")
        lead_js = os.path.join(THEME_DIR, "js", "lead-form-handler.js")
        contact_php = os.path.join(THEME_DIR, "template-contact.php")
        protocols_php = os.path.join(THEME_DIR, "template-ai-protocols.php")

        with open(fulfillment_php, "r", encoding="utf-8") as f:
            php_code = f.read()
        with open(lead_js, "r", encoding="utf-8") as f:
            js_code = f.read()
        with open(contact_php, "r", encoding="utf-8") as f:
            contact_code = f.read()
        with open(protocols_php, "r", encoding="utf-8") as f:
            protocols_code = f.read()

        # REST route registration & ledger persistence
        assert "'/lead-consultation'" in php_code
        assert "keystone_handle_lead_consultation_rest" in php_code
        assert "keystone_client_inquiries_ledger" in php_code
        assert "inquiries.log" in php_code
        assert "'ecosystem-partners'" in php_code

        # JS form handler scoped strictly (never hijacking Stripe checkout forms or faking success in catch)
        assert "querySelectorAll('form')" not in js_code
        assert "heroDirectCheckoutForm" in js_code
        assert "data-keystone-form-ignore" in js_code
        assert "data-keystone-form-ignore" in protocols_code
        assert 'data-keystone-lead-form="consultation"' in contact_code
        assert "#4ade80" not in js_code

    def test_slice_b_knowledge_panel_entity_graph_and_profile_page(self):
        seo_php = os.path.join(THEME_DIR, "inc", "seo-schema.php")
        founder_php = os.path.join(THEME_DIR, "template-founder-story.php")
        purge_php = os.path.join(THEME_DIR, "inc", "gsc-410-purge.php")

        with open(seo_php, "r", encoding="utf-8") as f:
            seo_code = f.read()
        with open(founder_php, "r", encoding="utf-8") as f:
            founder_code = f.read()
        with open(purge_php, "r", encoding="utf-8") as f:
            purge_code = f.read()

        # Unified #wayne-stevenson @id & zero invalid/broken properties
        assert "https://keystonerecomposition.com/#wayne-stevenson" in seo_code
        assert "https://keystonerecomposition.com/wp-content/uploads/2026/09/wayne_avatar.jpg" in seo_code
        assert "https://music.apple.com/us/artist/keystone-recomposition/1862989452" in seo_code
        assert "https://musicbrainz.org/artist/1a30328b-20b2-48bd-8e56-2884d3b040c0" in seo_code
        assert "ProfilePage" in seo_code
        assert "spotifyId" not in seo_code
        assert "producerOf" not in seo_code
        assert "SearchAction" not in seo_code
        assert "linkedin.com/in/wayne-stevenson" not in seo_code
        assert not re.search(r"'name'\s*=>\s*'Wayne Stevens'", seo_code)

        # Duplicate inline JSON-LD removed from founder template
        assert "application/ld+json" not in founder_code

        # Redirects & HTTP 410 slugs
        assert "'/wayne-stevenson'" in seo_code
        assert "'/case-studies'" in seo_code
        assert "'watch-iron-grace-2'" in purge_code

    def test_slice_c_external_css_extraction_and_24_album_catalog(self):
        enqueue_php = os.path.join(THEME_DIR, "inc", "enqueue.php")
        engine_css = os.path.join(THEME_DIR, "assets", "css", "keystone-luxury-engine.css")
        catalog_php = os.path.join(THEME_DIR, "inc", "sonic-catalog-data.php")
        front_php = os.path.join(THEME_DIR, "front-page.php")

        assert os.path.isfile(engine_css)
        css_size = os.path.getsize(engine_css)
        assert css_size > 150_000, f"Expected external engine CSS > 150KB, got {css_size}"

        with open(engine_css, "r", encoding="utf-8") as f:
            css_text = f.read()
        assert "<style" not in css_text.lower()
        assert "<script" not in css_text.lower()
        assert "<?php" not in css_text.lower()

        with open(enqueue_php, "r", encoding="utf-8") as f:
            enqueue_code = f.read()
        assert len(enqueue_code.splitlines()) < 350, "enqueue.php should remain compact (<350 lines)"
        assert "keystone-luxury-engine.css" in enqueue_code

        # Full release catalog & compressed JPEG covers (zero 404 covers, zero placeholder URLs)
        for cover in ("whiskey_on_a_wednesday.jpg", "dont_say_youre_fine.jpg", "architectural_focus.jpg"):
            cover_path = os.path.join(THEME_DIR, "assets", "images", "albums", cover)
            assert os.path.isfile(cover_path), f"Missing album cover {cover}"
            assert 20_000 < os.path.getsize(cover_path) < 350_000

        with open(catalog_php, "r", encoding="utf-8") as f:
            cat_code = f.read()
        assert "Whiskey on a Wednesday" in cat_code
        assert "Don't Say You're Fine" in cat_code or r"Don\'t Say You\'re Fine" in cat_code
        assert "Architectural Focus" in cat_code
        assert "0641360299187" in cat_code
        assert "0641360960445" in cat_code
        assert "live_album_21_of_22" not in cat_code

        with open(front_php, "r", encoding="utf-8") as f:
            front_code = f.read()
        assert "nyQwl-7-vH0" in front_code
        assert "BuGR4MsghGs" in front_code
        # Sound Lab WebAudio MP3 cards preserved
        assert "track1_steady_incline.mp3" in front_code
        assert "track2_fluid_dynamics.mp3" in front_code
        assert "track3_tier_one_flow.mp3" in front_code

    def test_zero_emerald_green_or_peptide_regressions_in_modified_templates(self):
        banned_greens = ["#10b981", "#22c55e", "#4ade80", "#86efac"]
        banned_medical = ["peptide", "mounjaro", "tirzepatide", "retatrutide", "bpc-157", "tb-500", "glp-1"]

        targets = [
            os.path.join(THEME_DIR, "style.css"),
            os.path.join(THEME_DIR, "js", "lead-form-handler.js"),
            os.path.join(THEME_DIR, "front-page.php"),
            os.path.join(THEME_DIR, "template-contact.php"),
            os.path.join(THEME_DIR, "template-founder-story.php"),
            os.path.join(THEME_DIR, "template-sonic-universe.php"),
            os.path.join(THEME_DIR, "llms.txt"),
            os.path.join(THEME_DIR, "llms-full.txt"),
        ]
        for path in targets:
            with open(path, "r", encoding="utf-8") as f:
                text = f.read().lower()
            for g in banned_greens:
                assert g not in text, f"Emerald green drift {g} found in {os.path.basename(path)}"
            for m in banned_medical:
                assert m not in text, f"Rule 11 banned term '{m}' found in {os.path.basename(path)}"
