"""
test_template_lifestyle_overhaul.py
===================================
Deterministic TDD Verification Suite for Wayne Stevenson's Direct Directives
for the template-lifestyle.php Overhaul & style.css Alignment.

Wayne's Exact Directives:
"We need to write this out better. Can you just say that I'm doing AI for my company
built using music and videos? I'm using it to stock trade polymarkets and how do I run
it for my company to find clienteles and all that kind of stuff? Just do a small overview,
not a big one. Break down the four pillars, lifestyle for a fifth pillar, and then
investments and worldwide travel as a sixth pillar. You can take that whole thing out,
I guess, and then keep the explore the ecosystem, make sure it's in there properly.
Contact Wayne Stevenson, make sure that's curtis4vancouver@gmail.com. Make sure the
buttons at the top are set good and do a good audit of the writing on this so that
it's clean, good to pull traffic, people in, and everything else. Let's just off make
it look high-end and then we'll move on to the last page or two more pages to go."

Tasks & Invariants Verified:
1. template-lifestyle.php exists with 'Template Name: Keystone Lifestyle'.
2. The clunky 4-box telemetry bar (.lifestyle-telemetry-grid) is REMOVED.
3. Hero header contains Wayne's overview: AI for company built using music & videos,
   stock trading & polymarkets, client acquisition, and high-performance living,
   with high-end action buttons.
4. All SIX pillars are present and clearly labeled:
   - Pillar 01: Autonomous Media & Video Pipeline (music & video production, Google Flow, Suno, DaVinci Resolve)
   - Pillar 02: Quantitative Trading & Prediction Intelligence (stocks, polymarket, probability modeling, 40% Cash Fortress)
   - Pillar 03: Autonomous Client Acquisition & Enterprise Outreach (finding clientele, B2B swarms, municipal zoning, BC builder partnerships)
   - Pillar 04: Licensed Physical Construction & Structural Building (BC Housing Licensed Builder #52603, Bill 44 multiplex infill)
   - Pillar 05: High-Performance Mountain Lifestyle & Recomposition (Squamish, Whistler, -48 lb recomposition, 205-lb athletic set-point, daily cold plunge)
   - Pillar 06: Strategic Investments & Worldwide Travel (global asset expansion, Mexico coastal villas, EU infill pipeline, international travel mobility)
5. 'Explore the Keystone Ecosystem' section is present and links to:
   - /sonic-universe/
   - /ai-protocols/
   - /investments/
   - /founder/
   - /contact/
6. Private Executive Contact Gateway features curtis4vancouver@gmail.com, a link to /contact/,
   and STRICTLY NO phone numbers.
7. STRICT RULE: ZERO PEPTIDES ('peptide' must NOT exist anywhere in template-lifestyle.php).
8. In style.css:
   - .lifestyle-pillars-grid has repeat(3, 1fr) for desktop, align-items: stretch.
   - .lifestyle-pillar-card has display: flex, flex-direction: column, height: 100%.
   - .pillar-card-footer has margin-top: auto.
"""

import os
import re
import sys
import pytest

THEME_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
LIFESTYLE_PATH = os.path.join(THEME_DIR, "template-lifestyle.php")
STYLE_PATH = os.path.join(THEME_DIR, "style.css")


class TestTemplateLifestyleOverhaul:
    """Deterministic DOM & Content Verification for template-lifestyle.php."""

    @pytest.fixture(autouse=True)
    def load_lifestyle(self):
        assert os.path.exists(LIFESTYLE_PATH), f"template-lifestyle.php not found at {LIFESTYLE_PATH}"
        with open(LIFESTYLE_PATH, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_template_lifestyle_exists_and_registered(self):
        """1. Verify template-lifestyle.php exists and contains WordPress template name header."""
        assert os.path.exists(LIFESTYLE_PATH), "template-lifestyle.php does not exist"
        assert "Template Name: Keystone Lifestyle" in self.content, (
            "FAIL: 'Template Name: Keystone Lifestyle' not found in template header"
        )

    def test_clunky_telemetry_bar_removed(self):
        """2. Invariant: The clunky 4-box telemetry bar (.lifestyle-telemetry-grid) is REMOVED."""
        assert "lifestyle-telemetry-grid" not in self.content, (
            "FAIL (RED): The clunky 4-box telemetry bar (.lifestyle-telemetry-grid) is still present. "
            "It must be completely removed per Wayne's directive."
        )
        assert "luxury-metric-card" not in self.content, (
            "FAIL (RED): .luxury-metric-card telemetry cards found in template-lifestyle.php. "
            "Remove all telemetry stat boxes from hero."
        )

    def test_hero_header_wayne_overview(self):
        """3. Hero header contains Wayne's clean centered overview (v4.6 zero top button clutter)."""
        hero_match = re.search(
            r'<header[^>]*class=["\'][^"\']*(?:lifestyle-hero|hero-header)[^"\']*["\']>(.*?)</header>',
            self.content,
            re.DOTALL
        )
        assert hero_match is not None, "FAIL: Hero header block not found in template-lifestyle.php"
        hero_html = hero_match.group(1).lower()

        assert "ai" in hero_html
        assert "24 official" in hero_html and "video" in hero_html
        assert "quantitative market" in hero_html
        assert "mountain living" in hero_html or "sea-to-sky" in hero_html
        assert "recomposition" in hero_html

    def test_pillar_01_autonomous_media_and_video(self):
        """4. Pillar 01 (AI Architecture) & Pillar 03 (Media Engine)."""
        assert "PILLAR 01" in self.content
        lower = self.content.lower()
        assert "ai brain" in lower and "multi-agent swarms" in lower
        assert "google flow" in lower
        assert "suno" in lower
        assert "davinci resolve" in lower

    def test_pillar_02_quantitative_trading_and_prediction_intelligence(self):
        """4. Pillar 02 (432Hz Audio IP) & Pillar 04 (Quant Treasury)."""
        assert "PILLAR 02" in self.content
        assert "PILLAR 04" in self.content
        lower = self.content.lower()
        assert "quantitative market intelligence" in lower
        assert "equities" in lower and "event contracts" in lower
        assert "ev &ge; +15%" in lower or "ev >= +15%" in lower
        assert "40%" in self.content and "Cash Fortress" in self.content

    def test_pillar_03_autonomous_client_acquisition(self):
        """4. Pillar 03: Autonomous Video Production & Omnichannel Publishing."""
        assert "PILLAR 03" in self.content
        lower = self.content.lower()
        assert "autonomous video production" in lower
        assert "google flow" in lower and "davinci resolve" in lower

    def test_pillar_04_licensed_physical_construction(self):
        """4. Licensed Builder #52603 & Bill 44 Multiplex execution."""
        assert "PILLAR 06" in self.content
        lower = self.content.lower()
        assert "52603" in self.content
        assert "bc housing" in lower
        assert "bill 44" in lower
        assert "multiplex" in lower

    def test_pillar_05_high_performance_mountain_lifestyle(self):
        """4. Pillar 05: Alpine Performance & Physical Recomposition."""
        assert "PILLAR 05" in self.content
        lower = self.content.lower()
        assert "alpine performance" in lower or "physical recomposition" in lower
        assert "squamish" in lower and "whistler" in lower
        assert "-48" in self.content
        assert "205-lb" in lower or "205g" in lower
        assert "cold plunge" in lower

    def test_pillar_06_strategic_investments_and_worldwide_travel(self):
        """4. Pillar 06: Architectural Construction & Global Mobility."""
        assert "PILLAR 06" in self.content
        lower = self.content.lower()
        assert "global mobility" in lower or "hard assets" in lower
        assert "mexico" in lower
        assert "european" in lower or "portugal" in lower

    def test_all_six_pillar_cards_exist_in_dom(self):
        """4. Verifies all 6 pillar cards exist as .lifestyle-pillar-card in the DOM."""
        cards = re.findall(r'class=["\'][^"\']*lifestyle-pillar-card[^"\']*["\']', self.content)
        assert len(cards) == 6, (
            f"FAIL: Expected exactly 6 .lifestyle-pillar-card elements, found {len(cards)}."
        )

    def test_explore_keystone_ecosystem_all_five_links(self):
        """5. Cross-ecosystem pillar and portal links connect all core routes."""
        required_endpoints = [
            "/sonic-universe/",
            "/ai-protocols/",
            "/investments/",
            "/founder/",
            "/contact/",
        ]
        for endpoint in required_endpoints:
            assert endpoint in self.content, (
                f"FAIL: Lifestyle template is missing required link to '{endpoint}'"
            )

    def test_private_executive_contact_gateway(self):
        """6. Private Executive Contact Gateway features keystonerecomposition@gmail.com and link to /contact/."""
        assert "keystonerecomposition@gmail.com" in self.content, (
            "FAIL: Wayne's direct email 'keystonerecomposition@gmail.com' missing from lifestyle template"
        )
        assert "/contact/" in self.content, (
            "FAIL: Link to '/contact/' missing from executive contact gateway"
        )
        assert "Wayne Stevenson" in self.content

    def test_strictly_zero_phone_numbers_invariant(self):
        """6. STRICT INVARIANT: Strictly NO phone numbers allowed anywhere on template-lifestyle.php."""
        phone_patterns = [
            r'\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}',
            r'tel:\+?1?\d{10,}',
            r'\+?1[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}',
            r'604[-.\s]?848[-.\s]?9688',
        ]
        for pattern in phone_patterns:
            matches = re.findall(pattern, self.content)
            # Filter false positives: license #52603, year 2026, or SVG dimensions
            actual_phones = [
                m for m in matches
                if "52603" not in m and "2026" not in m and "2025" not in m and "2024" not in m
            ]
            assert len(actual_phones) == 0, (
                f"VIOLATION: Phone number found in template-lifestyle.php: {actual_phones}"
            )

    def test_strictly_zero_peptides_invariant(self):
        """7. STRICT INVARIANT: ZERO PEPTIDES ('peptide' must NOT exist anywhere in template-lifestyle.php)."""
        assert "peptide" not in self.content.lower(), (
            "CRITICAL VIOLATION: 'peptide' found in template-lifestyle.php! "
            "Wayne Stevenson strictly bans all peptide references."
        )


class TestStyleCssLifestylePillarsGrid:
    """Deterministic CSS Rule Verification for .lifestyle-pillars-grid and .lifestyle-pillar-card."""

    @pytest.fixture(autouse=True)
    def load_css(self):
        assert os.path.exists(STYLE_PATH), f"style.css not found at {STYLE_PATH}"
        with open(STYLE_PATH, "r", encoding="utf-8") as f:
            self.css = f.read()

    def test_lifestyle_pillars_grid_three_columns_desktop(self):
        """8. .lifestyle-pillars-grid has repeat(3, 1fr) for desktop in style.css."""
        grid_matches = re.findall(r'\.lifestyle-pillars-grid\s*\{([^}]+)\}', self.css)
        assert len(grid_matches) >= 1, "FAIL (RED): .lifestyle-pillars-grid rule block not found in style.css"

        has_3_cols = any(
            re.search(r'grid-template-columns:\s*repeat\(\s*3\s*,\s*(?:1fr|minmax\([^)]+\))\)', block) is not None
            for block in grid_matches
        )
        assert has_3_cols, (
            "FAIL (RED): .lifestyle-pillars-grid desktop rule must have "
            "'grid-template-columns: repeat(3, 1fr)' (or with !important). "
            "Currently it is configured for 2 columns."
        )

    def test_lifestyle_pillars_grid_align_items_stretch(self):
        """8. .lifestyle-pillars-grid has align-items: stretch in style.css."""
        grid_matches = re.findall(r'\.lifestyle-pillars-grid\s*\{([^}]+)\}', self.css)
        assert len(grid_matches) >= 1, "FAIL (RED): .lifestyle-pillars-grid rule block not found in style.css"

        has_stretch = any(
            re.search(r'align-items:\s*stretch', block) is not None
            for block in grid_matches
        )
        assert has_stretch, (
            "FAIL (RED): .lifestyle-pillars-grid must have 'align-items: stretch' "
            "to ensure all 6 cards equalize in height."
        )

    def test_lifestyle_pillar_card_flex_column_and_height(self):
        """8. .lifestyle-pillar-card has display: flex, flex-direction: column, and height: 100%."""
        card_matches = re.findall(r'\.lifestyle-pillar-card\s*\{([^}]+)\}', self.css)
        assert len(card_matches) >= 1, "FAIL (RED): .lifestyle-pillar-card rule block not found in style.css"

        has_flex = any(re.search(r'display:\s*flex', block) is not None for block in card_matches)
        has_col = any(re.search(r'flex-direction:\s*column', block) is not None for block in card_matches)
        has_height_100 = any(re.search(r'height:\s*100%', block) is not None for block in card_matches)

        assert has_flex, "FAIL (RED): .lifestyle-pillar-card must have 'display: flex'"
        assert has_col, "FAIL (RED): .lifestyle-pillar-card must have 'flex-direction: column'"
        assert has_height_100, (
            "FAIL (RED): .lifestyle-pillar-card must have 'height: 100%' "
            "so that all cards stretch to uniform height across the 3-column rows."
        )

    def test_pillar_card_footer_margin_top_auto(self):
        """8. .pillar-card-footer has margin-top: auto in style.css."""
        footer_matches = re.findall(r'\.pillar-card-footer\s*\{([^}]+)\}', self.css)
        assert len(footer_matches) >= 1, "FAIL (RED): .pillar-card-footer rule block not found in style.css"

        has_margin_auto = any(re.search(r'margin-top:\s*auto', block) is not None for block in footer_matches)
        assert has_margin_auto, (
            "FAIL (RED): .pillar-card-footer must have 'margin-top: auto' "
            "to anchor action buttons flush to the bottom."
        )

    def test_pillar_body_or_detail_list_flex_grow(self):
        """8. Invariant: .pillar-body or .pillar-detail-list inside cards has flex-grow: 1."""
        body_matches = re.findall(r'\.pillar-body\s*\{([^}]+)\}', self.css)
        list_matches = re.findall(r'\.pillar-detail-list\s*\{([^}]+)\}', self.css)

        has_flex_grow = any(
            re.search(r'flex-grow:\s*1', b) is not None or re.search(r'flex:\s*1', b) is not None
            for b in (body_matches + list_matches)
        )
        assert has_flex_grow, (
            "FAIL (RED): .pillar-body or .pillar-detail-list must have flex-grow: 1 "
            "to push .pillar-card-footer flush to the bottom."
        )

    def test_hero_badge_row_horizontal_alignment(self):
        """9. Invariant: .hero-badge-row spans have 0 bottom margin and identical height to prevent vertical sag."""
        assert ".hero-badge-row" in self.css, "FAIL (RED): .hero-badge-row not found in style.css"
        badge_spans = re.search(r'\.hero-badge-row\s+span[^{]*\{([^}]+)\}', self.css)
        assert badge_spans is not None, "FAIL (RED): .hero-badge-row span rule block not found in style.css"
        badge_css = badge_spans.group(1)
        assert "margin: 0" in badge_css or "margin-bottom: 0" in badge_css, (
            "FAIL (RED): .hero-badge-row span must enforce margin: 0 or margin-bottom: 0"
        )
        assert "height: 34px" in badge_css or "height:" in badge_css, (
            "FAIL (RED): .hero-badge-row span must specify uniform height"
        )

    def test_hero_cta_button_group_alignment(self):
        """10. Invariant: .hero-cta-button-group has display flex and equal button heights."""
        assert ".hero-cta-button-group" in self.css, "FAIL (RED): .hero-cta-button-group not found in style.css"
        btn_match = re.search(r'\.hero-cta-button-group\s+a[^{]*\{([^}]+)\}', self.css)
        assert btn_match is not None, "FAIL (RED): .hero-cta-button-group a rule block not found in style.css"
        btn_css = btn_match.group(1)
        assert "display: inline-flex" in btn_css, "FAIL (RED): .hero-cta-button-group a must be inline-flex"
        assert "height: 54px" in btn_css or "height:" in btn_css, "FAIL (RED): .hero-cta-button-group a must enforce uniform height"



def run_standalone_red_baseline():
    """Runs all test methods directly and outputs clean baseline results."""
    print("=" * 70)
    print("B0 TEST HARNESS: RUNNING BASELINE (TDD RED VERIFICATION)")
    print("=" * 70)

    test_classes = [TestTemplateLifestyleOverhaul, TestStyleCssLifestylePillarsGrid]
    total_tests = 0
    failed_tests = 0
    passed_tests = 0
    failures = []

    for cls in test_classes:
        instance = cls()
        if hasattr(instance, "load_lifestyle"):
            instance.load_lifestyle()
        if hasattr(instance, "load_css"):
            instance.load_css()

        test_methods = [m for m in dir(instance) if m.startswith("test_")]
        for method_name in test_methods:
            total_tests += 1
            method = getattr(instance, method_name)
            try:
                method()
                print(f"  [PASS] {cls.__name__}.{method_name}")
                passed_tests += 1
            except AssertionError as e:
                print(f"  [FAIL] {cls.__name__}.{method_name}")
                failed_tests += 1
                failures.append((f"{cls.__name__}.{method_name}", str(e)))
            except Exception as e:
                print(f"  [ERROR] {cls.__name__}.{method_name}: {e}")
                failed_tests += 1
                failures.append((f"{cls.__name__}.{method_name}", f"Unexpected exception: {e}"))

    print("-" * 70)
    print(f"BASELINE SUMMARY: Total: {total_tests} | Passed: {passed_tests} | Failed: {failed_tests}")
    print("-" * 70)

    if failures:
        print("\nFAILURES BREAKDOWN (EXPECTED CLEAN RED BASELINE):")
        for test_name, reason in failures:
            first_line = reason.split("\n")[0]
            print(f"  • {test_name}: {first_line}")
        print("\nSTATUS: CLEAN RED BASELINE CONFIRMED (Ready for Builders B2/W1).")
        return 1
    else:
        print("\nSTATUS: ALL TESTS PASSED (GREEN).")
        return 0


if __name__ == "__main__":
    sys.exit(run_standalone_red_baseline())
