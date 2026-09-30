"""
test_sonic_universe_card_alignment.py
======================================
Deterministic TDD Red-to-Green Verification Suite for Sonic Universe Card Alignment:
1. In template-sonic-universe.php:
   - Line 149 (or .album-actions-bar wrapper) does NOT have inline style="margin-top: 14px;"
     hardcoded on .album-actions-bar so flex margin-top: auto can take precedence.
   - Preserves .album-card-play-overlay and 'STREAM RELEASE' overlay pill.
   - Preserves .btn-open-album-modal.
2. In style.css:
   - .album-card-18 has display: flex and flex-direction: column (or with !important).
   - .album-card-details has display: flex, flex-direction: column, and flex-grow: 1.
   - .album-title has min-height defined (e.g. min-height: 54px or min-height: 52px or 2.6em).
   - .album-actions-bar has margin-top: auto.
   - .btn-open-album-modal has a fixed height (e.g. height: 44px or 42px), display: flex,
     align-items: center, justify-content: center.
   - .album-card-play-overlay and .play-overlay-pill are preserved.
"""

import os
import re
import pytest

THEME_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
TEMPLATE_PATH = os.path.join(THEME_DIR, "template-sonic-universe.php")
STYLE_PATH = os.path.join(THEME_DIR, "style.css")


class TestSonicUniverseTemplateCardAlignment:
    """Verifies template-sonic-universe.php DOM invariants and absence of inline style collisions."""

    @pytest.fixture(autouse=True)
    def load_template(self):
        assert os.path.exists(TEMPLATE_PATH), f"template-sonic-universe.php not found at {TEMPLATE_PATH}"
        with open(TEMPLATE_PATH, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_album_actions_bar_no_inline_margin_top(self):
        """Line 149 / .album-actions-bar must NOT have inline style='margin-top: 14px;' hardcoded.

        This allows CSS flexbox rule 'margin-top: auto' in style.css to push the action button
        flush to the bottom of the card regardless of varying album title lengths.
        """
        # Literal string assertion against line 149 hardcoded style
        assert 'class="album-actions-bar" style="margin-top: 14px;"' not in self.content, (
            "FAIL (RED): Hardcoded inline style='margin-top: 14px;' found on .album-actions-bar. "
            "Remove inline style to allow CSS flexbox margin-top: auto to take precedence."
        )

        # General regex check ensuring no inline margin-top is present on .album-actions-bar
        margin_match = re.search(
            r'<div[^>]*class=["\'][^"\']*album-actions-bar[^"\']*["\'][^>]*style=["\'][^"\']*margin-top[^"\']*["\']',
            self.content
        )
        assert margin_match is None, (
            f"FAIL (RED): Inline margin-top detected on .album-actions-bar: {margin_match.group(0) if margin_match else ''}. "
            "Remove inline margin-top so external stylesheet rule margin-top: auto can govern alignment."
        )

    def test_preserves_album_card_play_overlay_and_pill(self):
        """Preserves .album-card-play-overlay and 'STREAM RELEASE' overlay pill."""
        assert "album-card-play-overlay" in self.content, "Missing .album-card-play-overlay container in template"
        assert "play-overlay-pill" in self.content, "Missing .play-overlay-pill element in template"
        assert "STREAM RELEASE" in self.content, "Missing 'STREAM RELEASE' pill text in template"

        # Verify overlay structure inside .album-card-art
        overlay_pattern = r'<div class="album-card-play-overlay">\s*<span class="play-overlay-pill">\s*▶ STREAM RELEASE\s*</span>\s*</div>'
        assert re.search(overlay_pattern, self.content) is not None, (
            "Expected .album-card-play-overlay with ▶ STREAM RELEASE pill inside .album-card-art"
        )

    def test_preserves_btn_open_album_modal(self):
        """Preserves .btn-open-album-modal button in the template."""
        assert "btn-open-album-modal" in self.content, "Missing .btn-open-album-modal button in template"
        assert "Stream &amp; View Tracks" in self.content or "Stream & View Tracks" in self.content, (
            "Missing 'Stream & View Tracks' trigger text on modal button"
        )


class TestSonicUniverseStyleCssAlignment:
    """Verifies style.css rules for flexbox bottom alignment of album cards."""

    @pytest.fixture(autouse=True)
    def load_css(self):
        assert os.path.exists(STYLE_PATH), f"style.css not found at {STYLE_PATH}"
        with open(STYLE_PATH, "r", encoding="utf-8") as f:
            self.css = f.read()

    def test_album_card_18_flex_column(self):
        """.album-card-18 has display: flex and flex-direction: column (or with !important)."""
        match = re.search(r'\.album-card-18\s*\{([^}]+)\}', self.css)
        assert match is not None, ".album-card-18 rule block not found in style.css"
        block = match.group(1)
        assert re.search(r'display:\s*flex(\s*!important)?;', block) is not None, (
            ".album-card-18 must have display: flex (or with !important)"
        )
        assert re.search(r'flex-direction:\s*column(\s*!important)?;', block) is not None, (
            ".album-card-18 must have flex-direction: column (or with !important)"
        )

    def test_album_card_details_flex_column_and_grow(self):
        """.album-card-details has display: flex, flex-direction: column, and flex-grow: 1."""
        match = re.search(r'\.album-card-details\s*\{([^}]+)\}', self.css)
        assert match is not None, ".album-card-details rule block not found in style.css"
        block = match.group(1)
        assert re.search(r'display:\s*flex(\s*!important)?;', block) is not None, (
            ".album-card-details must have display: flex"
        )
        assert re.search(r'flex-direction:\s*column(\s*!important)?;', block) is not None, (
            ".album-card-details must have flex-direction: column"
        )
        assert re.search(r'flex-grow:\s*1(\s*!important)?;', block) is not None or \
               re.search(r'flex:\s*1(\s*!important)?;', block) is not None, (
            ".album-card-details must have flex-grow: 1"
        )

    def test_album_title_min_height_defined(self):
        """.album-title has min-height defined (e.g. min-height: 54px or min-height: 52px or 2.6em)."""
        match = re.search(r'\.album-title\s*\{([^}]+)\}', self.css)
        assert match is not None, ".album-title rule block not found in style.css"
        block = match.group(1)
        assert re.search(r'min-height:\s*(\d+px|\d*\.?\d+em|\d*\.?\d+rem)(\s*!important)?;', block) is not None, (
            ".album-title must have min-height defined (e.g. min-height: 54px, 52px, or 2.6em)"
        )

    def test_album_actions_bar_margin_top_auto(self):
        """.album-actions-bar has margin-top: auto."""
        match = re.search(r'\.album-actions-bar\s*\{([^}]+)\}', self.css)
        assert match is not None, ".album-actions-bar rule block not found in style.css"
        block = match.group(1)
        assert re.search(r'margin-top:\s*auto(\s*!important)?;', block) is not None, (
            ".album-actions-bar must have margin-top: auto (or with !important)"
        )

    def test_btn_open_album_modal_fixed_height_and_flex_centering(self):
        """.btn-open-album-modal has a fixed height (e.g. height: 44px or 42px), display: flex, align-items: center, justify-content: center."""
        match = re.search(r'\.btn-open-album-modal\s*\{([^}]+)\}', self.css)
        assert match is not None, ".btn-open-album-modal rule block not found in style.css"
        block = match.group(1)
        assert re.search(r'height:\s*\d+px(\s*!important)?;', block) is not None, (
            ".btn-open-album-modal must have fixed height (e.g. height: 44px or 42px)"
        )
        assert re.search(r'display:\s*flex(\s*!important)?;', block) is not None, (
            ".btn-open-album-modal must have display: flex"
        )
        assert re.search(r'align-items:\s*center(\s*!important)?;', block) is not None, (
            ".btn-open-album-modal must have align-items: center"
        )
        assert re.search(r'justify-content:\s*center(\s*!important)?;', block) is not None, (
            ".btn-open-album-modal must have justify-content: center"
        )

    def test_preserves_album_card_play_overlay_and_pill_css(self):
        """.album-card-play-overlay and .play-overlay-pill are preserved in style.css."""
        assert ".album-card-play-overlay" in self.css, ".album-card-play-overlay missing from style.css"
        assert ".play-overlay-pill" in self.css, ".play-overlay-pill missing from style.css"

        overlay_match = re.search(r'\.album-card-play-overlay\s*\{([^}]+)\}', self.css)
        assert overlay_match is not None, ".album-card-play-overlay rule block not found in style.css"

        pill_match = re.search(r'\.play-overlay-pill\s*\{([^}]+)\}', self.css)
        assert pill_match is not None, ".play-overlay-pill rule block not found in style.css"
