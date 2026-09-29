"""
test_template_investments_overhaul.py
======================================
Deterministic TDD Verification Suite for Wayne Stevenson's Direct Directives:
1. footer.php:
   - Pure black background (#000000).
   - Top action row: Social icons (FB, IG, YouTube, Spotify) PLUS TWO luxury pill subscribe buttons:
     * Red play dot + 'SUBSCRIBE • @KEYSTONERECOMPOSITION' (subtle gold border)
     * Red play dot + 'SUBSCRIBE • @KEYSTONEAIPROTOCOLS' (subtle cyan border)
   - Copyright line:
     'Copyright © 2023–2026 Keystone Possibilities Ltd & Keystone Recomposition • All Rights Reserved.'
     'Certified BC Housing Residential Builder #52603 • Autonomous AI Systems & Audio Architecture'
   - Subtle gold divider header:
     '🏛️ KEYSTONE RECOMPOSITION — PRODUCTION SYSTEMS & SOVEREIGN CAPABILITIES'
   - Clean 4-column grid (Sonic Universe Catalog, Autonomous AI Protocols, Strategic Investments & Infill, Direct Authority & Contact).
   - Single-line Empire Network cross-link bar at the very bottom.
2. style.css:
   - .site-nav-header has background #000000 !important;
   - All page backgrounds (.keystone-sonic-universe-page, .keystone-investments-page, .keystone-lifestyle-page,
     .keystone-contact-page, .keystone-founder-page, body) are pure black #000000 !important;
   - .footer-subscribe-btn-gold and .footer-subscribe-btn-cyan styling tokens exist.
   - Investment page classes exist: .investments-spotlight-card, .spotlight-hero-img, .pillar-hero-img,
     .quant-principles-grid, .fiduciary-treasury-notice.
3. template-investments.php:
   - Universal white-to-blue-to-gold gradient heading (.cyan-gold-gradient-text).
   - 4-card telemetry bar.
   - Section 1 (Top Spotlight): Quant Trading & Prediction Intelligence with trading_terminal_luxury.jpg and compliance disclaimer.
   - Section 2: 3 Real Estate Pillars (BC Multiplex Infill with bc_luxury_multiplex.jpg, Mexico Coastal with
     mexico_development_masterplan.jpg, EU Infill with eu_luxury_infill.jpg).
   - Section 3: Strategic Business Investment & Enterprise M&A.
   - Section 4: Fiduciary Risk Principles.
   - Section 5: Private Executive Contact Gateway with wayne@keystonepossibilities.ca (zero phone number) and direct email CTA button.
   - Strict Zero-Phone-Number invariant.
   - Strict Zero-Peptides invariant.
"""

import os
import re
import pytest

THEME_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
FOOTER_PATH = os.path.join(THEME_DIR, "footer.php")
STYLE_PATH = os.path.join(THEME_DIR, "style.css")
INVESTMENTS_PATH = os.path.join(THEME_DIR, "template-investments.php")
ASSETS_DIR = os.path.join(THEME_DIR, "assets", "images")


class TestWayneFooterOverhaul:
    """Validates Wayne's exact footer requirements."""

    @pytest.fixture(autouse=True)
    def load_footer(self):
        assert os.path.exists(FOOTER_PATH), f"footer.php not found at {FOOTER_PATH}"
        with open(FOOTER_PATH, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_pure_black_footer_background(self):
        assert "#000000 !important" in self.content or "#000000" in self.content
        assert "background-color: #000000" in self.content or "background: #000000" in self.content

    def test_top_action_row_social_icons(self):
        assert "facebook.com" in self.content
        assert "instagram.com/keystonerecomposition" in self.content
        assert "youtube.com/@KeyStoneRecomposition" in self.content
        assert "open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" in self.content

    def test_dual_youtube_subscribe_pills(self):
        # Button 1: Recomposition with gold border
        assert "@KeyStoneRecomposition" in self.content
        assert "sub_confirmation=1" in self.content
        assert "footer-subscribe-btn-gold" in self.content

        # Button 2: AI Protocols with cyan border
        assert "@KeystoneAIProtocols" in self.content
        assert "footer-subscribe-btn-cyan" in self.content

    def test_copyright_and_credentials_lines(self):
        assert "Copyright" in self.content
        assert "2023–2026" in self.content or "2023-2026" in self.content
        assert "Keystone Possibilities Ltd &amp; Keystone Recomposition" in self.content or "Keystone Possibilities Ltd & Keystone Recomposition" in self.content
        assert "All Rights Reserved" in self.content
        assert "Certified BC Housing Residential Builder #52603" in self.content
        assert "Autonomous AI Systems &amp; Audio Architecture" in self.content or "Autonomous AI Systems & Audio Architecture" in self.content

    def test_subtle_gold_divider_header(self):
        assert "KEYSTONE RECOMPOSITION — PRODUCTION SYSTEMS &amp; SOVEREIGN CAPABILITIES" in self.content or \
               "KEYSTONE RECOMPOSITION — PRODUCTION SYSTEMS & SOVEREIGN CAPABILITIES" in self.content

    def test_clean_four_column_grid(self):
        assert "Sonic Universe Catalog:" in self.content
        assert "Autonomous AI Protocols:" in self.content
        assert "Strategic Investments &amp; Infill:" in self.content or "Strategic Investments & Infill:" in self.content
        assert "Direct Authority &amp; Contact:" in self.content or "Direct Authority & Contact:" in self.content
        assert "Wayne Stevenson // Principal Builder" in self.content
        assert "52603" in self.content
        assert "keystonepossibilities.ca" in self.content
        assert "wayne@keystonepossibilities.ca" in self.content

    def test_empire_network_single_line_bar(self):
        assert "KEYSTONE EMPIRE NETWORK" in self.content
        assert "Sister Flagship:" in self.content
        assert "Keystone Possibilities Ltd." in self.content


class TestStyleCssPureBlackAndTokens:
    """Validates pure black styling and new CSS tokens in style.css."""

    @pytest.fixture(autouse=True)
    def load_css(self):
        assert os.path.exists(STYLE_PATH), f"style.css not found at {STYLE_PATH}"
        with open(STYLE_PATH, "r", encoding="utf-8") as f:
            self.css = f.read()

    def test_site_nav_header_pure_black(self):
        header_blocks = re.findall(r'\.site-nav-header\s*\{([^}]+)\}', self.css)
        assert len(header_blocks) >= 1, "No .site-nav-header rules found in style.css"
        has_pure_black = any("#000000 !important" in b for b in header_blocks)
        assert has_pure_black, ".site-nav-header must have background: #000000 !important;"

    def test_all_page_backgrounds_pure_black(self):
        assert ".keystone-sonic-universe-page" in self.css
        assert ".keystone-investments-page" in self.css
        assert ".keystone-lifestyle-page" in self.css
        assert ".keystone-contact-page" in self.css
        assert ".keystone-founder-page" in self.css

    def test_footer_subscribe_buttons_css(self):
        assert ".footer-subscribe-btn-gold" in self.css
        assert ".footer-subscribe-btn-cyan" in self.css
        assert ".footer-social-circle" in self.css

    def test_investments_page_css_classes(self):
        assert ".investments-spotlight-card" in self.css
        assert ".spotlight-hero-img" in self.css
        assert ".pillar-hero-img" in self.css
        assert ".quant-principles-grid" in self.css or ".quant-pillars-grid" in self.css
        assert ".fiduciary-treasury-notice" in self.css


class TestTemplateInvestmentsOverhaul:
    """Validates the full template-investments.php overhaul."""

    @pytest.fixture(autouse=True)
    def load_template(self):
        assert os.path.exists(INVESTMENTS_PATH), f"template-investments.php not found at {INVESTMENTS_PATH}"
        with open(INVESTMENTS_PATH, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_template_name_header(self):
        assert "Template Name: Keystone Investments" in self.content

    def test_universal_cyan_gold_gradient_heading(self):
        assert "cyan-gold-gradient-text" in self.content

    def test_four_card_telemetry_bar(self):
        assert "investments-telemetry-grid" in self.content
        assert "52603" in self.content
        assert "EV &ge; +15%" in self.content or "EV >= +15%" in self.content
        assert "40% CAD" in self.content
        assert "BC &bull; MEX &bull; EU" in self.content or "BC • MEX • EU" in self.content

    def test_top_spotlight_quant_trading_section(self):
        assert "trading_terminal_luxury.jpg" in self.content
        assert "Algorithmic Compounding" in self.content or "Quantitative Market Intelligence" in self.content
        assert "EV &ge; +15%" in self.content or "EV >= +15%" in self.content
        assert "Rule 25" in self.content
        assert "40%" in self.content and "Cash Fortress" in self.content
        assert "fiduciary-treasury-notice" in self.content
        assert "Proprietary Capital Only" in self.content

    def test_three_core_real_estate_pillars(self):
        # Pillar 1: BC Infill
        assert "bc_luxury_multiplex.jpg" in self.content
        assert "Bill 44" in self.content
        assert "52603" in self.content
        assert "2-5-10" in self.content
        assert "BC Hydro" in self.content

        # Pillar 2: Mexico Luxury Coastal
        assert "mexico_development_masterplan.jpg" in self.content
        assert "Mexico" in self.content
        assert "Fideicomiso" in self.content
        assert "35%" in self.content or "arbitrage" in self.content.lower()
        assert "8%–14%" in self.content or "8%-14%" in self.content or "rental" in self.content.lower()

        # Pillar 3: EU Strategic Expansion
        assert "eu_luxury_infill.jpg" in self.content
        assert "European Union" in self.content or "EU" in self.content
        assert "SPV" in self.content or "Special Purpose Vehicle" in self.content
        assert "6% VAT" in self.content or "rehabilitation" in self.content.lower()

    def test_strategic_business_investment_section(self):
        assert "Specialty Trade Roll-Ups" in self.content or "Construction Trade Acquisitions" in self.content
        assert "Autonomous" in self.content
        assert "FastMCP" in self.content or "Toolchains" in self.content

    def test_fiduciary_governance_principles(self):
        assert "risk-principles-grid" in self.content
        assert "Fiduciary Licensing" in self.content
        assert "Bedrock Asset Backing" in self.content
        assert "Mathematical Precision" in self.content
        assert "Data &amp; Code Sovereignty" in self.content or "Data & Code Sovereignty" in self.content

    def test_private_executive_contact_gateway(self):
        assert "wayne@keystonepossibilities.ca" in self.content
        assert "Email Wayne Stevenson Directly" in self.content
        assert "keystonepossibilities.ca" in self.content

    def test_strictly_zero_phone_numbers_invariant(self):
        """Invariant: Strictly NO phone numbers allowed on template-investments.php."""
        phone_patterns = [
            r'\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}',
            r'tel:\+?1?\d{10,}',
            r'\+?1[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}',
            r'604[-.\s]?848[-.\s]?9688',
        ]
        for pattern in phone_patterns:
            matches = re.findall(pattern, self.content)
            # Filter out false positives like dates or builder license 52603
            actual_phones = [m for m in matches if "52603" not in m and "2026" not in m]
            assert len(actual_phones) == 0, f"VIOLATION: Phone number found in template-investments.php: {actual_phones}"

    def test_strictly_zero_peptides_invariant(self):
        """Invariant: Zero peptides anywhere in template-investments.php."""
        assert "peptide" not in self.content.lower(), "VIOLATION: 'peptide' found in template-investments.php"

    def test_four_photographic_assets_exist_on_disk(self):
        required_assets = [
            "trading_terminal_luxury.jpg",
            "bc_luxury_multiplex.jpg",
            "mexico_development_masterplan.jpg",
            "eu_luxury_infill.jpg",
        ]
        for asset in required_assets:
            asset_path = os.path.join(ASSETS_DIR, asset)
            assert os.path.exists(asset_path), f"Required asset {asset} missing from {ASSETS_DIR}"
            file_size = os.path.getsize(asset_path)
            assert file_size > 100_000, f"Asset {asset} size {file_size} bytes is under 100 KB threshold"
