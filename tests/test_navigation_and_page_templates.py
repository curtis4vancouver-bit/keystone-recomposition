"""
test_navigation_and_page_templates.py
=====================================
Automated Verification Suite for Keystone Recomposition Navigation & Page Templates:
1. header.php: 8 navigation items in exact order in both desktop nav and mobile drawer:
   HOME (/), AI PROTOCOLS (/ai-protocols/), INTEL (/intel/), SONIC UNIVERSE (/sonic-universe/),
   INVESTMENTS (/investments/), LIFESTYLE (/lifestyle/), FOUNDER (/founder/), CONTACT (/contact/).
2. template-investments.php: Zero gray gaps dark luxury, centered hero, 3 strategic pillars
   (Bill 44 Infill, Algorithmic Compounding, Sovereign Tech Infrastructure), CTA to contact.
   Strict rule: ZERO peptides.
3. template-lifestyle.php: Sea-to-Sky alpine lifestyle, Squamish/Whistler mountain expeditions,
   205-lb permanent athletic set-point with daily protein floor & cold plunge, Sonic studio flow.
   Strict rule: ZERO peptides.
4. template-contact.php: Executive consultation for $800 masterclass, General contracting BC #52603,
   TooLost licensing, dark luxury inquiry form with cyan glowing inputs, response SLA, direct contacts.
   Strict rule: ZERO peptides.
5. footer.php: 4-column regional grid links directly to /investments/, /lifestyle/, /founder/, /contact/.
6. style.css: .nav-links-menu (gap: 16px, font-size: 0.70rem, breakpoint 1100px), contact form styling,
   investments and lifestyle card layouts.
"""

import os
import re
import pytest

CHILD_THEME_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
HEADER_PATH = os.path.join(CHILD_THEME_DIR, "header.php")
FOOTER_PATH = os.path.join(CHILD_THEME_DIR, "footer.php")
INVESTMENTS_PATH = os.path.join(CHILD_THEME_DIR, "template-investments.php")
LIFESTYLE_PATH = os.path.join(CHILD_THEME_DIR, "template-lifestyle.php")
CONTACT_PATH = os.path.join(CHILD_THEME_DIR, "template-contact.php")
STYLE_PATH = os.path.join(CHILD_THEME_DIR, "style.css")


class TestKeystoneRecompositionNavigation:
    """Validates 8-item navigation ordering and active states."""

    def test_header_desktop_nav_items_order(self):
        with open(HEADER_PATH, "r", encoding="utf-8") as f:
            code = f.read()

        desktop_nav_match = re.search(r'<ul class="nav-links-menu">(.*?)</ul>', code, re.DOTALL)
        assert desktop_nav_match is not None, "Desktop nav-links-menu not found in header.php"
        nav_html = desktop_nav_match.group(1)

        expected_order = [
            "home_url( '/' )",
            "home_url( '/ai-protocols/' )",
            "home_url( '/intel/' )",
            "home_url( '/sonic-universe/' )",
            "home_url( '/investments/' )",
            "home_url( '/lifestyle/' )",
            "home_url( '/founder/' )",
            "home_url( '/contact/' )",
        ]

        last_pos = -1
        for item in expected_order:
            pos = nav_html.find(item)
            assert pos != -1, f"Missing nav link for {item} in desktop menu"
            assert pos > last_pos, f"Incorrect order for {item} in desktop menu"
            last_pos = pos

    def test_header_mobile_drawer_items_order(self):
        with open(HEADER_PATH, "r", encoding="utf-8") as f:
            code = f.read()

        mobile_nav_match = re.search(r'<div class="mobile-menu-drawer" id="mobileDrawer">(.*?)</div>', code, re.DOTALL)
        assert mobile_nav_match is not None, "mobileDrawer not found in header.php"
        drawer_html = mobile_nav_match.group(1)

        expected_order = [
            "home_url( '/' )",
            "home_url( '/ai-protocols/' )",
            "home_url( '/intel/' )",
            "home_url( '/sonic-universe/' )",
            "home_url( '/investments/' )",
            "home_url( '/lifestyle/' )",
            "home_url( '/founder/' )",
            "home_url( '/contact/' )",
        ]

        last_pos = -1
        for item in expected_order:
            pos = drawer_html.find(item)
            assert pos != -1, f"Missing nav link for {item} in mobile drawer"
            assert pos > last_pos, f"Incorrect order for {item} in mobile drawer"
            last_pos = pos


class TestKeystonePageTemplates:
    """Validates existence, structure, and strict zero-peptide rule on new templates."""

    def test_template_investments_structure_and_zero_peptides(self):
        assert os.path.exists(INVESTMENTS_PATH), "template-investments.php does not exist"
        with open(INVESTMENTS_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "Template Name: Keystone Investments" in content
        assert "Bill 44" in content
        assert "Algorithmic Compounding" in content
        assert "Sovereign Tech Infrastructure" in content
        assert "52603" in content
        assert "/contact/" in content

        # STRICT RULE: ZERO PEPTIDES
        assert "peptide" not in content.lower(), "VIOLATION: 'peptide' found in template-investments.php"

    def test_template_lifestyle_structure_and_zero_peptides(self):
        assert os.path.exists(LIFESTYLE_PATH), "template-lifestyle.php does not exist"
        with open(LIFESTYLE_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "Template Name: Keystone Lifestyle" in content
        assert "Squamish" in content
        assert "Whistler" in content
        assert "205-lb" in content or "205 LBS" in content
        assert "protein" in content.lower()
        assert "cold plunge" in content.lower()
        assert ("20" in content or "22" in content or "18" in content) and "albums" in content.lower()

        # STRICT RULE: ZERO PEPTIDES
        assert "peptide" not in content.lower(), "VIOLATION: 'peptide' found in template-lifestyle.php"

    def test_template_contact_structure_and_zero_peptides(self):
        assert os.path.exists(CONTACT_PATH), "template-contact.php does not exist"
        with open(CONTACT_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "Template Name: Keystone Contact" in content
        assert "$800" in content
        assert "52603" in content
        assert "TooLost" in content
        assert "curtis4vancouver@gmail.com" in content
        assert "luxury-inquiry-form" in content or "contact-form" in content
        assert "SLA" in content

        # STRICT RULE: ZERO PEPTIDES
        assert "peptide" not in content.lower(), "VIOLATION: 'peptide' found in template-contact.php"


class TestKeystoneFooterAndStyles:
    """Validates footer links and CSS rules."""

    def test_footer_regional_grid_links(self):
        with open(FOOTER_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert 'href="/investments/"' in content, "Missing /investments/ in footer.php"
        assert 'href="/lifestyle/"' in content, "Missing /lifestyle/ in footer.php"
        assert 'href="/founder/"' in content, "Missing /founder/ in footer.php"
        assert 'href="/contact/"' in content, "Missing /contact/ in footer.php"

    def test_style_css_rules(self):
        with open(STYLE_PATH, "r", encoding="utf-8") as f:
            css = f.read()

        # Nav menu gap 16px & font-size 0.70rem
        assert "gap: 16px !important;" in css, "Missing gap: 16px !important in style.css"
        assert "font-size: 0.70rem !important;" in css, "Missing font-size: 0.70rem !important in style.css"

        # Breakpoint 1100px
        assert "@media (max-width: 1100px)" in css, "Missing @media (max-width: 1100px) in style.css"

        # Contact form styling & cyan glow
        assert ".contact-form-glass-card" in css
        assert "rgba(0, 240, 255" in css or "#00f0ff" in css
        assert ".btn-cyan-submit" in css

        # Investment & lifestyle card layouts
        assert ".investments-pillars-grid" in css
        assert ".investment-pillar-card" in css
        assert ".lifestyle-pillars-grid" in css
        assert ".lifestyle-pillar-card" in css
