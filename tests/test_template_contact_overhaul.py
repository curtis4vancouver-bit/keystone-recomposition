"""
test_template_contact_overhaul.py
=================================
Deterministic TDD Verification Suite for Wayne Stevenson's Direct Directives
for the template-contact.php Overhaul & style.css Alignment.

Wayne's Exact Directives:
"For the contact page, I don't know if we need the three buttons at the top that
break down the Masterclass, the BC Builder, and the Artist. You can take the Artist
out of there and put Spotify, the BC Builder, and the Masterclass. Make sure the links
go to the proper links. And then that bottom form, can you shorten it up a little bit?
Make it look high-end. And then the writing that's in the inquiry category and the
project budget, make sure that it's inked properly and that it's ready to go to
curtis4vancouver@gmail.com. The bottom areas sound good, and then I think we are done
everything for now on this website once that's all finished."

Tasks & Invariants Verified:
1. template-contact.php exists with 'Template Name: Keystone Contact'.
2. Universal white-to-blue-to-gold header gradient (.cyan-gold-gradient-text) is used in the main title.
3. Three Top Engagement Channels:
   - Channel 1 (Spotify): Contains 'Spotify', '22 official releases' (or '22 releases'), '216', link to 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y' with target="_blank".
   - Channel 2 (BC Builder): Contains 'BC BUILDER #52603', 'Keystone Possibilities Ltd', 'Bill 44', link to 'https://keystonepossibilities.ca' with target="_blank".
   - Channel 3 (Masterclass): Contains '$800 MASTERCLASS', 'Executive Workstation Architecture', 'FastMCP', link to '#inquiry-form'.
4. Form Shortening & Structure:
   - In template-contact.php, form has a compact 3-row layout:
     * Row 1: Full Name * (contact_name) and Email Address * (contact_email)
     * Row 2: Inquiry Category * (contact_category) and Project Budget / Capital Allocation (contact_budget)
     * Row 3: Project Overview & Requirements * (contact_message)
   - Redundant full-width rows and unnecessary fields (contact_entity) are removed.
5. Inked Inquiry Categories & Project Budgets:
   - Category options include:
     * 'Executive Workstation Architecture ($800 Masterclass)'
     * 'BC Bill 44 General Contracting & Infill (BC Builder #52603)'
     * 'Private Real Estate Infill Investment & Co-Development'
     * 'Spotify Music Catalog, Sync & Audio Architecture'
     * 'General Executive Consultation'
   - Budget options include CAD currency:
     * '$800 CAD'
     * '$25,000'
     * '$100,000'
     * '$500,000'
     * 'Wayne Stevenson'
6. Direct Executive Routing to curtis4vancouver@gmail.com:
   - $to = 'curtis4vancouver@gmail.com' in the PHP mail handler.
   - Mail body sends to curtis4vancouver@gmail.com.
   - Direct Email link in the SLA section points to mailto:curtis4vancouver@gmail.com.
7. STRICT RULE: ZERO PEPTIDES ('peptide' must NOT exist anywhere in template-contact.php).
8. In style.css:
   - .contact-channels-grid has repeat(3, 1fr) for desktop and align-items: stretch.
   - .contact-channel-card has display: flex, flex-direction: column, height: 100%.
   - .channel-action has margin-top: auto.
   - .contact-form-glass-card has compact padding (e.g. max-width: 820px, backdrop-filter: blur).
"""

import os
import re
import sys
import pytest

THEME_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
CONTACT_PATH = os.path.join(THEME_DIR, "template-contact.php")
STYLE_PATH = os.path.join(THEME_DIR, "style.css")


class TestTemplateContactOverhaul:
    """Deterministic DOM & Content Verification for template-contact.php."""

    @pytest.fixture(autouse=True)
    def load_contact(self):
        assert os.path.exists(CONTACT_PATH), f"template-contact.php not found at {CONTACT_PATH}"
        with open(CONTACT_PATH, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_template_contact_exists_and_registered(self):
        """1. Verify template-contact.php exists and contains WordPress template name header."""
        assert os.path.exists(CONTACT_PATH), "template-contact.php does not exist"
        assert "Template Name: Keystone Contact" in self.content, (
            "FAIL: 'Template Name: Keystone Contact' not found in template header"
        )

    def test_main_title_cyan_gold_gradient(self):
        """2. Universal white-to-blue-to-gold header gradient (.cyan-gold-gradient-text) is used in the main title."""
        title_match = re.search(
            r'<h1[^>]*class=["\'][^"\']*contact-main-title[^"\']*["\']>(.*?)</h1>',
            self.content,
            re.DOTALL
        )
        assert title_match is not None, "FAIL (RED): .contact-main-title h1 not found in template-contact.php"
        title_html = title_match.group(1)

        assert "cyan-gold-gradient-text" in title_html, (
            "FAIL (RED): Main title must use universal white-to-blue-to-gold gradient "
            "class '.cyan-gold-gradient-text' instead of '.cyan-gradient-text'."
        )

    def test_three_engagement_channels_order_and_count(self):
        """3. Verifies exactly 3 engagement channel cards exist in the correct Wayne order:
        Channel 1: Spotify
        Channel 2: BC Builder
        Channel 3: Masterclass
        """
        grid_match = re.search(
            r'<div[^>]*class=["\'][^"\']*contact-channels-grid[^"\']*["\']>(.*?)</div>\s*</section>',
            self.content,
            re.DOTALL
        )
        assert grid_match is not None, "FAIL (RED): .contact-channels-grid section not found"
        grid_html = grid_match.group(1)

        cards = re.findall(
            r'<div[^>]*class=["\'][^"\']*contact-channel-card[^"\']*["\']>(.*?)(?=<div[^>]*class=["\'][^"\']*contact-channel-card[^"\']*["\']|\s*</div>\s*$)',
            grid_html,
            re.DOTALL
        )
        assert len(cards) == 3, (
            f"FAIL (RED): Expected exactly 3 .contact-channel-card elements in channels grid, found {len(cards)}."
        )

        card_1_html = cards[0].lower()
        card_2_html = cards[1].lower()
        card_3_html = cards[2].lower()

        assert "spotify" in card_1_html, (
            "FAIL (RED): Channel 1 must be Spotify per Wayne's directive: "
            "'take the Artist out of there and put Spotify, the BC Builder, and the Masterclass'."
        )
        assert ("bc builder" in card_2_html or "builder #52603" in card_2_html or "keystone possibilities" in card_2_html), (
            "FAIL (RED): Channel 2 must be BC Builder / Keystone Possibilities Ltd."
        )
        assert ("masterclass" in card_3_html or "800" in card_3_html), (
            "FAIL (RED): Channel 3 must be the $800 Masterclass."
        )

    def test_channel_1_spotify_card(self):
        """3. Channel 1 (Spotify):
        - Contains 'Spotify'
        - Contains '22 official releases' (or '22 releases')
        - Contains '216' (master recordings / tracks)
        - Link to 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y'
        - Link has target="_blank"
        """
        grid_match = re.search(
            r'<div[^>]*class=["\'][^"\']*contact-channels-grid[^"\']*["\']>(.*?)</div>\s*</section>',
            self.content,
            re.DOTALL
        )
        assert grid_match is not None, "FAIL (RED): .contact-channels-grid section not found"
        cards = re.findall(
            r'<div[^>]*class=["\'][^"\']*contact-channel-card[^"\']*["\']>(.*?)(?=<div[^>]*class=["\'][^"\']*contact-channel-card[^"\']*["\']|\s*</div>\s*$)',
            grid_match.group(1),
            re.DOTALL
        )
        assert len(cards) >= 1, "FAIL (RED): No cards found in contact-channels-grid"
        card_1 = cards[0]
        card_1_lower = card_1.lower()

        assert "spotify" in card_1_lower, "FAIL (RED): Channel 1 must contain 'Spotify'"
        assert ("22 official releases" in card_1_lower or "22 releases" in card_1_lower), (
            "FAIL (RED): Channel 1 missing reference to '22 official releases' or '22 releases'"
        )
        assert "216" in card_1, "FAIL (RED): Channel 1 missing '216' master recordings count"
        assert "https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" in card_1, (
            "FAIL (RED): Channel 1 missing Spotify artist URL 'https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y'"
        )
        assert 'target="_blank"' in card_1, (
            "FAIL (RED): Spotify link must open in a new tab with target=\"_blank\""
        )

    def test_channel_2_bc_builder_card(self):
        """3. Channel 2 (BC Builder):
        - Contains 'BC BUILDER #52603'
        - Contains 'Keystone Possibilities Ltd'
        - Contains 'Bill 44'
        - Link to 'https://keystonepossibilities.ca' with target="_blank"
        """
        grid_match = re.search(
            r'<div[^>]*class=["\'][^"\']*contact-channels-grid[^"\']*["\']>(.*?)</div>\s*</section>',
            self.content,
            re.DOTALL
        )
        assert grid_match is not None, "FAIL (RED): .contact-channels-grid section not found"
        cards = re.findall(
            r'<div[^>]*class=["\'][^"\']*contact-channel-card[^"\']*["\']>(.*?)(?=<div[^>]*class=["\'][^"\']*contact-channel-card[^"\']*["\']|\s*</div>\s*$)',
            grid_match.group(1),
            re.DOTALL
        )
        assert len(cards) >= 2, "FAIL (RED): Second card missing in contact-channels-grid"
        card_2 = cards[1]

        assert "52603" in card_2, "FAIL (RED): Channel 2 missing BC Housing License #52603"
        assert "Keystone Possibilities Ltd" in card_2, (
            "FAIL (RED): Channel 2 missing 'Keystone Possibilities Ltd' corporate entity"
        )
        assert "Bill 44" in card_2, "FAIL (RED): Channel 2 missing 'Bill 44' legislative reference"
        assert "https://keystonepossibilities.ca" in card_2, (
            "FAIL (RED): Channel 2 missing link to 'https://keystonepossibilities.ca'"
        )
        assert 'target="_blank"' in card_2, (
            "FAIL (RED): Channel 2 external link must have target=\"_blank\""
        )

    def test_channel_3_masterclass_card(self):
        """3. Channel 3 (Masterclass):
        - Contains '$800 MASTERCLASS'
        - Contains 'Executive Workstation Architecture'
        - Contains 'FastMCP'
        - Link to '#inquiry-form'
        """
        grid_match = re.search(
            r'<div[^>]*class=["\'][^"\']*contact-channels-grid[^"\']*["\']>(.*?)</div>\s*</section>',
            self.content,
            re.DOTALL
        )
        assert grid_match is not None, "FAIL (RED): .contact-channels-grid section not found"
        cards = re.findall(
            r'<div[^>]*class=["\'][^"\']*contact-channel-card[^"\']*["\']>(.*?)(?=<div[^>]*class=["\'][^"\']*contact-channel-card[^"\']*["\']|\s*</div>\s*$)',
            grid_match.group(1),
            re.DOTALL
        )
        assert len(cards) >= 3, "FAIL (RED): Third card missing in contact-channels-grid"
        card_3 = cards[2]

        assert ("$800" in card_3 and "MASTERCLASS" in card_3), (
            "FAIL (RED): Channel 3 missing '$800 MASTERCLASS' badge or title"
        )
        assert "Executive Workstation Architecture" in card_3, (
            "FAIL (RED): Channel 3 missing 'Executive Workstation Architecture'"
        )
        assert "FastMCP" in card_3, "FAIL (RED): Channel 3 missing 'FastMCP' swarms reference"
        assert "#inquiry-form" in card_3, "FAIL (RED): Channel 3 missing smooth jump link to '#inquiry-form'"

    def test_form_compact_three_row_layout(self):
        """4. Form Shortening & Structure:
        - In template-contact.php, form has a compact 3-row layout:
          * Row 1: Full Name * (contact_name) and Email Address * (contact_email)
          * Row 2: Inquiry Category * (contact_category) and Project Budget / Capital Allocation (contact_budget)
          * Row 3: Project Overview & Requirements * (contact_message)
        """
        form_match = re.search(
            r'<form[^>]*class=["\'][^"\']*luxury-inquiry-form[^"\']*["\']>(.*?)</form>',
            self.content,
            re.DOTALL
        )
        assert form_match is not None, "FAIL (RED): .luxury-inquiry-form not found in template-contact.php"
        form_html = form_match.group(1)

        # Check required fields exist
        assert 'name="contact_name"' in form_html, "FAIL (RED): contact_name input missing"
        assert 'name="contact_email"' in form_html, "FAIL (RED): contact_email input missing"
        assert 'name="contact_category"' in form_html, "FAIL (RED): contact_category select missing"
        assert 'name="contact_budget"' in form_html, "FAIL (RED): contact_budget select missing"
        assert 'name="contact_message"' in form_html, "FAIL (RED): contact_message textarea missing"

        # Check Row 2 pairing: contact_category and contact_budget must be together in a form-grid-two
        row2_pattern = re.compile(
            r'<div[^>]*class=["\'][^"\']*form-grid-two[^"\']*["\'][^>]*>(?:(?!form-grid-two).)*?'
            r'name=["\']contact_category["\'].*?name=["\']contact_budget["\']',
            re.DOTALL
        )
        assert row2_pattern.search(form_html) is not None, (
            "FAIL (RED): Form must pair 'contact_category' and 'contact_budget' in Row 2 (.form-grid-two) "
            "to create the shortened 3-row compact layout requested by Wayne."
        )

    def test_form_redundant_rows_removed(self):
        """4. Redundant full-width rows and unnecessary fields (contact_entity) are removed from form."""
        form_match = re.search(
            r'<form[^>]*class=["\'][^"\']*luxury-inquiry-form[^"\']*["\']>(.*?)</form>',
            self.content,
            re.DOTALL
        )
        assert form_match is not None, "FAIL (RED): .luxury-inquiry-form not found"
        form_html = form_match.group(1)

        # Assert contact_entity input is removed from the form inputs
        assert 'name="contact_entity"' not in form_html, (
            "FAIL (RED): 'contact_entity' field is still present in the form. "
            "Remove redundant 'contact_entity' to streamline form into 3 tight rows."
        )

    def test_inked_inquiry_categories(self):
        """5. Inked Inquiry Categories under contact_category:
        Must include exact required categories:
        - 'Executive Workstation Architecture ($800 Masterclass)'
        - 'BC Bill 44 General Contracting & Infill (BC Builder #52603)'
        - 'Private Real Estate Infill Investment & Co-Development'
        - 'Spotify Music Catalog, Sync & Audio Architecture'
        - 'General Executive Consultation'
        """
        cat_match = re.search(
            r'<select[^>]*name=["\']contact_category["\'][^>]*>(.*?)</select>',
            self.content,
            re.DOTALL
        )
        assert cat_match is not None, "FAIL (RED): contact_category select element not found"
        cat_html = cat_match.group(1)

        required_categories = [
            "Executive Workstation Architecture ($800 Masterclass)",
            "BC Bill 44 General Contracting & Infill (BC Builder #52603)",
            "Private Real Estate Infill Investment & Co-Development",
            "Spotify Music Catalog, Sync & Audio Architecture",
            "General Executive Consultation",
        ]

        # Normalization helper for HTML entities
        def normalize_text(text: str) -> str:
            return text.replace("&amp;", "&").replace("&#038;", "&").strip()

        normalized_cat_html = normalize_text(cat_html)

        for category in required_categories:
            assert category in normalized_cat_html, (
                f"FAIL (RED): Required category '{category}' not found in contact_category select options."
            )

    def test_inked_project_budgets_cad(self):
        """5. Inked Project Budgets under contact_budget:
        Must include CAD currency and Wayne's tiers:
        - '$800 CAD'
        - '$25,000'
        - '$100,000'
        - '$500,000'
        - 'Wayne Stevenson'
        """
        budget_match = re.search(
            r'<select[^>]*name=["\']contact_budget["\'][^>]*>(.*?)</select>',
            self.content,
            re.DOTALL
        )
        assert budget_match is not None, "FAIL (RED): contact_budget select element not found"
        budget_html = budget_match.group(1)

        required_budget_tokens = [
            "$800 CAD",
            "$25,000",
            "$100,000",
            "$500,000",
            "Wayne Stevenson",
        ]

        for token in required_budget_tokens:
            assert token in budget_html, (
                f"FAIL (RED): Required budget tier token '{token}' not found in contact_budget options."
            )

    def test_direct_executive_email_routing_curtis4vancouver(self):
        """6. Direct Executive Routing to curtis4vancouver@gmail.com:
        - $to = 'curtis4vancouver@gmail.com' in the PHP mail handler.
        - Mail recipient is curtis4vancouver@gmail.com.
        - Direct Email link in the SLA section points to mailto:curtis4vancouver@gmail.com.
        """
        assert re.search(r'\$to\s*=\s*[\'"]curtis4vancouver@gmail\.com[\'"]', self.content) is not None, (
            "FAIL (RED): PHP mail handler must set $to = 'curtis4vancouver@gmail.com'"
        )
        assert ("mailto:curtis4vancouver@gmail.com" in self.content), (
            "FAIL (RED): Direct Email link pointing to mailto:curtis4vancouver@gmail.com missing"
        )

    def test_strictly_zero_peptides_invariant(self):
        """7. STRICT INVARIANT: ZERO PEPTIDES ('peptide' must NOT exist anywhere in template-contact.php)."""
        assert "peptide" not in self.content.lower(), (
            "CRITICAL VIOLATION: 'peptide' found in template-contact.php! "
            "Wayne Stevenson strictly bans all peptide references."
        )

    def test_strictly_zero_phone_numbers_invariant(self):
        """STRICT INVARIANT: Strictly NO phone numbers allowed anywhere on template-contact.php."""
        phone_patterns = [
            r'\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}',
            r'tel:\+?1?\d{10,}',
            r'\+?1[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}',
            r'604[-.\s]?848[-.\s]?9688',
        ]
        for pattern in phone_patterns:
            matches = re.findall(pattern, self.content)
            # Filter false positives: license #52603, year 2026/2025/2024, or SLA hours 24-48
            actual_phones = [
                m for m in matches
                if "52603" not in m and "2026" not in m and "2025" not in m and "2024" not in m
            ]
            assert len(actual_phones) == 0, (
                f"VIOLATION: Phone number found in template-contact.php: {actual_phones}"
            )


class TestStyleCssContactLayout:
    """Deterministic CSS Rule Verification for Contact Channels Grid & Form Glass Card in style.css."""

    @pytest.fixture(autouse=True)
    def load_css(self):
        assert os.path.exists(STYLE_PATH), f"style.css not found at {STYLE_PATH}"
        with open(STYLE_PATH, "r", encoding="utf-8") as f:
            self.css = f.read()

    def test_contact_channels_grid_three_columns_desktop(self):
        """8. .contact-channels-grid has repeat(3, 1fr) for desktop in style.css."""
        grid_matches = re.findall(r'\.contact-channels-grid\s*\{([^}]+)\}', self.css)
        assert len(grid_matches) >= 1, "FAIL (RED): .contact-channels-grid rule block not found in style.css"

        has_3_cols = any(
            re.search(r'grid-template-columns:\s*repeat\(\s*3\s*,\s*(?:1fr|minmax\([^)]+\))\)', block) is not None
            for block in grid_matches
        )
        assert has_3_cols, (
            "FAIL (RED): .contact-channels-grid desktop rule must have "
            "'grid-template-columns: repeat(3, 1fr)'."
        )

    def test_contact_channels_grid_align_items_stretch(self):
        """8. .contact-channels-grid has align-items: stretch in style.css."""
        grid_matches = re.findall(r'\.contact-channels-grid\s*\{([^}]+)\}', self.css)
        assert len(grid_matches) >= 1, "FAIL (RED): .contact-channels-grid rule block not found in style.css"

        has_stretch = any(
            re.search(r'align-items:\s*stretch', block) is not None
            for block in grid_matches
        )
        assert has_stretch, (
            "FAIL (RED): .contact-channels-grid must have 'align-items: stretch' "
            "to ensure all 3 channel cards equalize in height."
        )

    def test_contact_channel_card_flex_column_and_height(self):
        """8. .contact-channel-card has display: flex, flex-direction: column, and height: 100%."""
        card_matches = re.findall(r'\.contact-channel-card\s*\{([^}]+)\}', self.css)
        assert len(card_matches) >= 1, "FAIL (RED): .contact-channel-card rule block not found in style.css"

        has_flex = any(re.search(r'display:\s*flex', block) is not None for block in card_matches)
        has_col = any(re.search(r'flex-direction:\s*column', block) is not None for block in card_matches)
        has_height_100 = any(re.search(r'height:\s*100%', block) is not None for block in card_matches)

        assert has_flex, "FAIL (RED): .contact-channel-card must have 'display: flex'"
        assert has_col, "FAIL (RED): .contact-channel-card must have 'flex-direction: column'"
        assert has_height_100, (
            "FAIL (RED): .contact-channel-card must have 'height: 100%' "
            "so that all cards stretch to uniform height across the 3-column row."
        )

    def test_channel_action_margin_top_auto(self):
        """8. .channel-action has margin-top: auto in style.css."""
        action_matches = re.findall(r'\.channel-action\s*\{([^}]+)\}', self.css)
        assert len(action_matches) >= 1, "FAIL (RED): .channel-action rule block not found in style.css"

        has_margin_auto = any(re.search(r'margin-top:\s*auto', block) is not None for block in action_matches)
        assert has_margin_auto, (
            "FAIL (RED): .channel-action must have 'margin-top: auto' "
            "to anchor action buttons flush to the bottom."
        )

    def test_contact_form_glass_card_compact_styling(self):
        """8. .contact-form-glass-card has compact padding, max-width <= 820px, and backdrop-filter blur."""
        card_matches = re.findall(r'\.contact-form-glass-card\s*\{([^}]+)\}', self.css)
        assert len(card_matches) >= 1, "FAIL (RED): .contact-form-glass-card rule block not found in style.css"

        has_max_width = any(re.search(r'max-width:\s*820px', block) is not None for block in card_matches)
        has_blur = any(re.search(r'backdrop-filter:\s*blur', block) is not None for block in card_matches)

        assert has_max_width, "FAIL (RED): .contact-form-glass-card must have 'max-width: 820px'"
        assert has_blur, "FAIL (RED): .contact-form-glass-card must have 'backdrop-filter: blur(...)';"


def run_standalone_red_baseline():
    """Runs all test methods directly and outputs clean baseline results."""
    print("=" * 70)
    print("B0 TEST HARNESS: RUNNING BASELINE (TDD RED VERIFICATION)")
    print("=" * 70)

    test_classes = [TestTemplateContactOverhaul, TestStyleCssContactLayout]
    total_tests = 0
    failed_tests = 0
    passed_tests = 0
    failures = []

    for cls in test_classes:
        instance = cls()
        if hasattr(instance, "load_contact"):
            instance.load_contact()
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
