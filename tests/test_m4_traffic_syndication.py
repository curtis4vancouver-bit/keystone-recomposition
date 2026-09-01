"""
test_m4_traffic_syndication.py
==============================
Automated Test Suite for Milestone 4:
YouTube & Music Cross-Channel Traffic Syndication.

Validates:
1. Above-The-Fold Video Theater Box:
   - CSS properties in style.css (.wp-block-embed-youtube.aligncenter, .luxury-video-theater).
   - 16:9 ratio (56.25% padding-bottom), max-width 880px, gold border & glow.
   - Luxury video player facade (.luxury-video-facade) with custom play button and lazy JS player.
   - Content dedup filter (keystone_deduplicate_video_facades) preventing multiple facades.
2. Glassmorphic Audio Decks & Sonic Universe:
   - [keystone_sonic_universe] shortcode outputting Concrete Foundations, Resonantia, and singles.
   - Official Artist Channel streaming buttons linking to Spotify (52v3Qe6Jo0hg764driOl5Y) and YouTube (@KeyStoneRecomposition).
   - Template file template-sonic-universe.php.
3. Cross-Channel Traffic Conversion:
   - Dual YouTube channel subscribe buttons appended to content (@keystonerecomposition and @keystoneprotocols) with sub_confirmation=1.
   - Keystone Empire Network footer backlink to sister flagship https://keystonepossibilities.ca.
   - 3D Gold Pill CTA button utility (.gold-pill-cta, .luxury-3d-pill).
"""

import os
import re
import pytest

CHILD_THEME_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
STYLE_CSS_PATH = os.path.join(CHILD_THEME_DIR, "style.css")
CONTENT_BLOCKS_PATH = os.path.join(CHILD_THEME_DIR, "inc", "content-blocks.php")
CALCULATORS_PATH = os.path.join(CHILD_THEME_DIR, "inc", "calculators.php")
INDEXING_API_PATH = os.path.join(CHILD_THEME_DIR, "inc", "indexing-api.php")
TEMPLATE_SONIC_PATH = os.path.join(CHILD_THEME_DIR, "template-sonic-universe.php")


# ==============================================================================
# TEST SUITE: ABOVE-THE-FOLD VIDEO THEATER BOX
# ==============================================================================

class TestM4VideoTheaterBox:
    """Verifies video theater styling and facade deduplication."""

    def test_video_theater_css_rules(self):
        """Validates theater container CSS in style.css."""
        with open(STYLE_CSS_PATH, "r", encoding="utf-8") as f:
            css = f.read()

        assert ".luxury-video-theater" in css
        assert ".wp-block-embed-youtube.aligncenter" in css
        assert "56.25%" in css
        assert "880px" in css or "860px" in css

    def test_luxury_video_facade_styling(self):
        """Validates video facade rules in style.css."""
        with open(STYLE_CSS_PATH, "r", encoding="utf-8") as f:
            css = f.read()

        assert ".luxury-video-facade" in css
        assert ".facade-background" in css
        assert ".play-button" in css
        assert ".play-icon" in css

    def test_facade_deduplication_filter(self):
        """Validates keystone_deduplicate_video_facades filter."""
        with open(CONTENT_BLOCKS_PATH, "r", encoding="utf-8") as f:
            php = f.read()

        assert "keystone_deduplicate_video_facades" in php
        assert "add_filter( 'the_content', 'keystone_deduplicate_video_facades', 15 );" in php or "add_filter('the_content', 'keystone_deduplicate_video_facades'" in php


# ==============================================================================
# TEST SUITE: GLASSMORPHIC AUDIO DECKS & SONIC UNIVERSE
# ==============================================================================

class TestM4GlassmorphicAudioDecks:
    """Verifies Sonic Universe discography hub and streaming pills."""

    def test_sonic_universe_shortcode_registration(self):
        """Validates [keystone_sonic_universe] shortcode."""
        with open(CALCULATORS_PATH, "r", encoding="utf-8") as f:
            php = f.read()

        assert "keystone_sonic_universe_shortcode" in php
        assert "add_shortcode( 'keystone_sonic_universe', 'keystone_sonic_universe_shortcode' );" in php
        assert "Concrete Foundations" in php
        assert "Resonantia: 10 Frequencies of the Rebuild" in php
        assert "The 205 Marker" in php
        assert "https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" in php
        assert "https://www.youtube.com/@KeyStoneRecomposition" in php

    def test_template_sonic_universe_file_exists(self):
        """Validates template-sonic-universe.php exists and renders shortcode."""
        assert os.path.isfile(TEMPLATE_SONIC_PATH)
        with open(TEMPLATE_SONIC_PATH, "r", encoding="utf-8") as f:
            content = f.read()
        assert "Template Name: Keystone Sonic Universe" in content
        assert "do_shortcode( '[keystone_sonic_universe]' )" in content or "do_shortcode('[keystone_sonic_universe]')" in content


# ==============================================================================
# TEST SUITE: CROSS-CHANNEL TRAFFIC SYNDICATION
# ==============================================================================

class TestM4CrossChannelTrafficSyndication:
    """Verifies YouTube subscription CTAs, partner links, and 3D pill buttons."""

    def test_dual_youtube_subscribe_buttons_appended(self):
        """Validates automatic injection of dual YouTube subscription CTAs."""
        with open(CONTENT_BLOCKS_PATH, "r", encoding="utf-8") as f:
            php = f.read()

        assert "keystone_recomposition_child_append_subscribe_buttons" in php
        assert "https://www.youtube.com/@keystonerecomposition?sub_confirmation=1" in php
        assert "https://www.youtube.com/@keystoneprotocols?sub_confirmation=1" in php

    def test_keystone_empire_sister_site_backlink(self):
        """Validates standardized footer partner backlink."""
        with open(INDEXING_API_PATH, "r", encoding="utf-8") as f:
            php = f.read()

        assert "keystone_recomposition_add_sister_site_backlink" in php
        assert "KEYSTONE EMPIRE NETWORK" in php
        assert "https://keystonepossibilities.ca" in php

    def test_3d_gold_pill_cta_css_classes(self):
        """Validates .gold-pill-cta and .luxury-3d-pill styling."""
        with open(STYLE_CSS_PATH, "r", encoding="utf-8") as f:
            css = f.read()

        assert ".gold-pill-cta" in css
        assert ".luxury-3d-pill" in css
        assert "#d4af37" in css
        assert "border-radius:" in css
