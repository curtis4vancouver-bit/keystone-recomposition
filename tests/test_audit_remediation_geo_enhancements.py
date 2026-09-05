"""
test_audit_remediation_geo_enhancements.py
==========================================
Automated Test Suite for Keystone Recomposition Audit Remediation & Worldwide SEO/GEO Enhancements.

Validates:
1. Elimination of Soft 404 Catch-All in inc/seo-schema.php.
2. Verified canonical routes in template-global-landing-pages.php (New York, LA, London, Europe, Mexico).
3. Verified H1 tag on Recommended Gear in inc/calculators.php.
4. Wayne Stevens Person entity schema: alternateName, canonical URL, and authentic portrait photo.
5. Master Organization schema: worldwide areaServed (US, UK, CA, CH, MX, NYC, LA, London), currenciesAccepted, availableLanguage, and localized city landing page GeoCoordinates/Place schema.
6. YouTube lazy player unmuted playback (&mute=1 eliminated) and aesthetic gold "Watch on YouTube ↗" button in js/lazy-player.js and style.css.
7. AI Search Engine Optimization (GEO) in /llms.txt generator: Wayne Stevens alias, protocols YouTube channel, international advisory coverage, and music catalog.
8. Elimination of duplicate watch-* pages from Rank Math XML sitemaps.
"""

import os
import pytest

CHILD_THEME_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
SEO_SCHEMA_PATH = os.path.join(CHILD_THEME_DIR, "inc", "seo-schema.php")
INDEXING_API_PATH = os.path.join(CHILD_THEME_DIR, "inc", "indexing-api.php")
CALCULATORS_PATH = os.path.join(CHILD_THEME_DIR, "inc", "calculators.php")
GLOBAL_LANDING_PATH = os.path.join(CHILD_THEME_DIR, "template-global-landing-pages.php")
LAZY_PLAYER_JS = os.path.join(CHILD_THEME_DIR, "js", "lazy-player.js")
STYLE_CSS_PATH = os.path.join(CHILD_THEME_DIR, "style.css")


class TestAuditRemediationAndGeoEnhancements:
    """Complete verification of all 8 audit remediation and SEO/GEO requirements."""

    def test_soft_404_catch_all_eliminated(self):
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            code = f.read()
        assert "if ( is_404() )" not in code

    def test_global_landing_page_card_links(self):
        with open(GLOBAL_LANDING_PATH, "r", encoding="utf-8") as f:
            html = f.read()
        assert 'href="/newyork-longevity-coaching/"' in html
        assert 'href="/la-longevity-coaching/"' in html
        assert 'href="/london-longevity-coaching/"' in html
        assert 'href="/europe-longevity-wellness-guide/"' in html
        assert 'href="/mexico-longevity-retreat-investment/"' in html
        assert "new-york-quiet-luxury" not in html
        assert "los-angeles-quiet-luxury" not in html
        assert "london-quiet-luxury" not in html

    def test_recommended_gear_h1(self):
        with open(CALCULATORS_PATH, "r", encoding="utf-8") as f:
            code = f.read()
        assert '<h1 class="tool-title">Curated Gear, Biohacking Hardware &amp; Partner Codes</h1>' in code
        assert '<h2 class="tool-title">Curated Gear' not in code

    def test_wayne_stevens_entity_schema(self):
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            code = f.read()
        assert "'Wayne Stevens'" in code
        assert "https://keystonerecomposition.com/about-the-founder-the-keystone-blueprint/" in code
        assert "'mainEntityOfPage'" in code
        assert "Man_reaching_for_pepper_grinder11_202605021316.jpeg" in code
        assert "'url' => 'https://keystonerecomposition.com/about/'" not in code

    def test_worldwide_geo_and_organization_schema(self):
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            code = f.read()
        assert "'areaServed'" in code
        assert "'United States'" in code
        assert "'United Kingdom'" in code
        assert "'Canada'" in code
        assert "'Switzerland'" in code
        assert "'Mexico'" in code
        assert "'currenciesAccepted' => 'USD, GBP, CAD, EUR'" in code
        assert "'availableLanguage'" in code
        assert "keystone_inject_city_landing_pages_geo_schema" in code
        assert "40.7128" in code
        assert "-74.006" in code
        assert "34.0522" in code
        assert "-118.2437" in code
        assert "51.5074" in code
        assert "-0.1278" in code
        # 5-hub complete global coverage
        assert "47.3769" in code  # Zurich
        assert "8.5417" in code
        assert "20.2114" in code  # Tulum
        assert "-87.4654" in code

    def test_lazy_player_unmuted_and_youtube_button(self):
        with open(LAZY_PLAYER_JS, "r", encoding="utf-8") as f:
            js = f.read()
        assert "&mute=1" not in js
        assert "https://www.youtube.com/watch?v=${videoId}" in js
        assert "watch-on-youtube-btn" in js
        assert "Watch on YouTube ↗" in js

        with open(STYLE_CSS_PATH, "r", encoding="utf-8") as f:
            css = f.read()
        assert ".luxury-video-facade .watch-on-youtube-btn" in css

    def test_llms_txt_geo_identity(self):
        with open(INDEXING_API_PATH, "r", encoding="utf-8") as f:
            content = f.read()
        assert "Wayne Stevenson (known in music and protocol communities as Wayne Stevens)" in content
        assert "https://www.youtube.com/@keystoneprotocols" in content
        assert "Concrete Foundations" in content
        assert "Resonantia" in content
        assert "Global Advisory" in content or "Worldwide Executive Advisory" in content

    def test_duplicate_watch_pages_filtered_from_sitemaps(self):
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            code = f.read()
        assert "/watch-" in code
        assert "keystone_recomposition_sanitize_rank_math_sitemap" in code

    def test_asset_cache_busting_versions(self):
        enqueue_path = os.path.join(CHILD_THEME_DIR, "inc", "enqueue.php")
        with open(enqueue_path, "r", encoding="utf-8") as f:
            code = f.read()
        assert "'astra-child-keystone-css', get_stylesheet_directory_uri() . '/style.css', array( 'astra-parent-theme-css' ), '2.6.0'" in code
        assert "'keystone-lazy-player', get_stylesheet_directory_uri() . '/js/lazy-player.js', array(), '1.1.0'" in code
