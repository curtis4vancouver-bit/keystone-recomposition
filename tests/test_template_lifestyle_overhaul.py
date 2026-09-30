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
        """3. Hero header contains Wayne's concise high-end overview and action buttons.

        Must include:
        - AI systems for company built using music & videos
        - Stock trading & polymarkets prediction intelligence
        - Finding clientele & client acquisition
        - High-performance mountain living / biological architecture
        - High-end action buttons at the top
        """
        # Extract hero header area
        hero_match = re.search(
            r'<header[^>]*class=["\'][^"\']*(?:lifestyle-hero|hero-header)[^"\']*["\']>(.*?)</header>',
            self.content,
            re.DOTALL
        )
        assert hero_match is not None, "FAIL (RED): Hero header block not found in template-lifestyle.php"
        hero_html = hero_match.group(1).lower()

        # Check AI for company built using music & videos
        has_ai = ("ai" in hero_html or "autonomous" in hero_html)
        has_music_video = ("music" in hero_html and "video" in hero_html)
        assert has_ai and has_music_video, (
            "FAIL (RED): Hero overview missing Wayne's description of AI for company built using music & videos."
        )

        # Check stock trading and polymarkets
        has_stocks = "stock" in hero_html
        has_polymarket = "polymarket" in hero_html
        assert has_stocks and has_polymarket, (
            "FAIL (RED): Hero overview missing Wayne's stock trading & polymarkets prediction engine overview."
        )

        # Check client acquisition / finding clientele
        has_clientele = ("client" in hero_html or "clientele" in hero_html or "acquisition" in hero_html)
        assert has_clientele, (
            "FAIL (RED): Hero overview missing Wayne's mandate on using AI to find clientele / client acquisition."
        )

        # Check high-performance living / mountain lifestyle
        has_performance = ("high-performance" in hero_html or "alpine" in hero_html or "mountain" in hero_html or "biological" in hero_html)
        assert has_performance, (
            "FAIL (RED): Hero overview missing high-performance living or mountain lifestyle positioning."
        )

        # Check top buttons
        assert ("btn-primary-gold" in hero_html or "btn-secondary-glass" in hero_html or "hero-cta" in hero_html or "cta-button" in hero_html or "btn-" in hero_html), (
            "FAIL (RED): Top action buttons are missing from the hero header. "
            "Wayne Stevenson specified: 'Make sure the buttons at the top are set good'."
        )

    def test_pillar_01_autonomous_media_and_video(self):
        """4. Pillar 01: Autonomous Media & Video Pipeline.

        Must include:
        - Autonomous Media / Video Pipeline
        - Music & video production
        - Google Flow
        - Suno
        - DaVinci Resolve
        """
        assert "PILLAR 01" in self.content, "FAIL (RED): PILLAR 01 badge missing"
        lower = self.content.lower()

        has_media_title = ("autonomous media" in lower or "media & video" in lower or "video pipeline" in lower)
        assert has_media_title, "FAIL (RED): Pillar 01 title must be 'Autonomous Media & Video Pipeline'"

        assert "google flow" in lower, "FAIL (RED): Pillar 01 missing 'Google Flow' toolchain reference"
        assert "suno" in lower, "FAIL (RED): Pillar 01 missing 'Suno' audio generation reference"
        assert "davinci" in lower, "FAIL (RED): Pillar 01 missing 'DaVinci Resolve' video pipeline reference"
        assert "music" in lower and "video" in lower, "FAIL (RED): Pillar 01 must highlight music & video production"

    def test_pillar_02_quantitative_trading_and_prediction_intelligence(self):
        """4. Pillar 02: Quantitative Trading & Prediction Intelligence.

        Must include:
        - Quantitative Trading & Prediction Intelligence
        - Stock trading (stocks)
        - Polymarket
        - Probability modeling
        - 40% Cash Fortress
        """
        assert "PILLAR 02" in self.content, "FAIL (RED): PILLAR 02 badge missing"
        lower = self.content.lower()

        has_quant_title = ("quantitative trading" in lower or "prediction intelligence" in lower or "trading & prediction" in lower)
        assert has_quant_title, (
            "FAIL (RED): Pillar 02 title must be 'Quantitative Trading & Prediction Intelligence'"
        )

        assert "stock" in lower, "FAIL (RED): Pillar 02 missing stock trading reference"
        assert "polymarket" in lower, "FAIL (RED): Pillar 02 missing Polymarket prediction reference"
        assert "probability" in lower or "algorithmic" in lower or "ev >=" in lower or "ev &ge;" in lower, (
            "FAIL (RED): Pillar 02 missing probability modeling / mathematical edge reference"
        )
        assert "40%" in self.content and "Cash Fortress" in self.content, (
            "FAIL (RED): Pillar 02 missing Wayne's mandatory '40% Cash Fortress' risk floor"
        )

    def test_pillar_03_autonomous_client_acquisition(self):
        """4. Pillar 03: Autonomous Client Acquisition & Enterprise Outreach.

        Must include:
        - Autonomous Client Acquisition & Enterprise Outreach / Finding Clientele
        - Finding clientele / client pipeline
        - B2B swarms / autonomous outreach
        - Municipal zoning
        - BC builder partnerships
        """
        assert "PILLAR 03" in self.content, "FAIL (RED): PILLAR 03 badge missing"
        lower = self.content.lower()

        has_client_title = ("client acquisition" in lower or "clientele" in lower or "enterprise outreach" in lower)
        assert has_client_title, (
            "FAIL (RED): Pillar 03 title must be 'Autonomous Client Acquisition & Enterprise Outreach'"
        )

        assert "client" in lower or "clientele" in lower, (
            "FAIL (RED): Pillar 03 missing direct reference to finding clientele"
        )
        assert "swarm" in lower or "b2b" in lower or "outreach" in lower, (
            "FAIL (RED): Pillar 03 missing B2B autonomous outreach swarms reference"
        )
        assert "zoning" in lower or "municipal" in lower, (
            "FAIL (RED): Pillar 03 missing municipal zoning intelligence reference"
        )
        assert "builder" in lower or "partnership" in lower or "contractor" in lower, (
            "FAIL (RED): Pillar 03 missing BC builder partnerships reference"
        )

    def test_pillar_04_licensed_physical_construction(self):
        """4. Pillar 04: Licensed Physical Construction & Structural Building.

        Must include:
        - Licensed Physical Construction & Structural Building
        - BC Housing Licensed Builder
        - License #52603
        - Bill 44
        - Multiplex infill
        """
        assert "PILLAR 04" in self.content, "FAIL (RED): PILLAR 04 badge missing"
        lower = self.content.lower()

        has_builder_title = ("physical construction" in lower or "structural building" in lower or "licensed construction" in lower)
        assert has_builder_title, (
            "FAIL (RED): Pillar 04 title must be 'Licensed Physical Construction & Structural Building'"
        )

        assert "52603" in self.content, "FAIL (RED): Pillar 04 missing BC Housing License #52603"
        assert "bc housing" in lower, "FAIL (RED): Pillar 04 missing 'BC Housing' credential"
        assert "bill 44" in lower, "FAIL (RED): Pillar 04 missing 'Bill 44' provincial legislation reference"
        assert "multiplex" in lower or "infill" in lower, (
            "FAIL (RED): Pillar 04 missing multiplex infill housing reference"
        )

    def test_pillar_05_high_performance_mountain_lifestyle(self):
        """4. Pillar 05: High-Performance Mountain Lifestyle & Recomposition.

        Must include:
        - High-Performance Mountain Lifestyle & Recomposition
        - Squamish & Whistler (Sea-to-Sky)
        - -48 lb recomposition
        - 205-lb permanent athletic set-point
        - Daily cold plunge thermal resets
        """
        assert "PILLAR 05" in self.content, "FAIL (RED): PILLAR 05 badge missing"
        lower = self.content.lower()

        has_lifestyle_title = ("mountain lifestyle" in lower or "lifestyle & recomposition" in lower or "high-performance" in lower)
        assert has_lifestyle_title, (
            "FAIL (RED): Pillar 05 title must be 'High-Performance Mountain Lifestyle & Recomposition'"
        )

        assert "squamish" in lower, "FAIL (RED): Pillar 05 missing Squamish habitat reference"
        assert "whistler" in lower, "FAIL (RED): Pillar 05 missing Whistler alpine reference"
        assert "-48" in self.content or "48 lb" in lower or "48-lb" in lower, (
            "FAIL (RED): Pillar 05 missing Wayne's authentic -48 lb recomposition data"
        )
        assert "205-lb" in lower or "205 lbs" in lower or "205 lb" in lower or "205lbs" in lower, (
            "FAIL (RED): Pillar 05 missing 205-lb athletic set-point metric"
        )
        assert "cold plunge" in lower, "FAIL (RED): Pillar 05 missing daily cold plunge recovery protocol"

    def test_pillar_06_strategic_investments_and_worldwide_travel(self):
        """4. Pillar 06: Strategic Investments & Worldwide Travel.

        Must include:
        - Strategic Investments & Worldwide Travel
        - Global asset expansion / strategic investment
        - Mexico coastal villas
        - EU infill pipeline / European development
        - Worldwide travel mobility / international travel
        """
        assert "PILLAR 06" in self.content, "FAIL (RED): PILLAR 06 badge missing"
        lower = self.content.lower()

        has_invest_travel_title = ("worldwide travel" in lower or "investments and worldwide travel" in lower or "strategic investments" in lower)
        assert has_invest_travel_title, (
            "FAIL (RED): Pillar 06 title must be 'Strategic Investments & Worldwide Travel'"
        )

        assert "mexico" in lower, "FAIL (RED): Pillar 06 missing Mexico coastal development reference"
        assert "eu" in lower or "europe" in lower or "european" in lower, (
            "FAIL (RED): Pillar 06 missing EU / European infill pipeline reference"
        )
        assert "travel" in lower, "FAIL (RED): Pillar 06 missing worldwide travel mobility reference"
        assert "investment" in lower or "asset" in lower, (
            "FAIL (RED): Pillar 06 missing strategic asset / investment expansion reference"
        )

    def test_all_six_pillar_cards_exist_in_dom(self):
        """4. Verifies all 6 pillar cards exist as .lifestyle-pillar-card in the DOM."""
        cards = re.findall(r'class=["\'][^"\']*lifestyle-pillar-card[^"\']*["\']', self.content)
        assert len(cards) == 6, (
            f"FAIL (RED): Expected exactly 6 .lifestyle-pillar-card elements, found {len(cards)}."
        )

    def test_explore_keystone_ecosystem_all_five_links(self):
        """5. 'Explore the Keystone Ecosystem' section is present and links to all 5 required pages:

        - /sonic-universe/
        - /ai-protocols/
        - /investments/
        - /founder/
        - /contact/
        """
        lower = self.content.lower()
        assert "explore the keystone ecosystem" in lower or "keystone ecosystem" in lower, (
            "FAIL (RED): 'Explore the Keystone Ecosystem' section header missing"
        )

        required_endpoints = [
            "/sonic-universe/",
            "/ai-protocols/",
            "/investments/",
            "/founder/",
            "/contact/",
        ]
        for endpoint in required_endpoints:
            assert endpoint in self.content, (
                f"FAIL (RED): Ecosystem section is missing required link to '{endpoint}'"
            )

    def test_private_executive_contact_gateway(self):
        """6. Private Executive Contact Gateway features curtis4vancouver@gmail.com and link to /contact/."""
        assert "curtis4vancouver@gmail.com" in self.content, (
            "FAIL (RED): Wayne's direct email 'curtis4vancouver@gmail.com' missing from lifestyle template"
        )
        assert "/contact/" in self.content, (
            "FAIL (RED): Link to '/contact/' missing from executive contact gateway"
        )
        lower = self.content.lower()
        has_wayne = "wayne stevenson" in lower or "wayne" in lower or "curtis" in lower
        assert has_wayne, (
            "FAIL (RED): Contact gateway must reference Wayne Stevenson or Curtis"
        )

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
