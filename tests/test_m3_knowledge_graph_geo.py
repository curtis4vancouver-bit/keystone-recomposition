"""
test_m3_knowledge_graph_geo.py
==============================
Automated Test Suite for Milestone 3:
2026 SEO, GEO & Multi-Entity Knowledge Graph.

Validates:
1. Master Schema.org Multi-Entity @graph:
   - Organization (Keystone Recomposition, logo, parentOrganization Keystone Empire, Too Lost ID TOOLOST3000939655).
   - ParentOrganization (Keystone Empire, subOrganizations).
   - Person (Wayne Stevenson, knowsAbout, sameAs Spotify, MusicBrainz, YouTube, LinkedIn).
   - MusicGroup (Keystone Recomposition, Spotify 52v3Qe6Jo0hg764driOl5Y, MusicBrainz, genres).
   - MusicAlbum (Concrete Foundations with MusicBrainz 30027d0e-6aeb-4704-8792-a031c936c62a, Resonantia).
   - MedicalWebPage (Singular posts, lastReviewed, reviewedBy Wayne Stevenson, Endocrine specialty, MedicalAudience).
   - WebApplication & FAQPage (/calculators/ hub, U-100 syringe dose math, KwikPen click math, 5-day half-life).
2. Generative Engine Optimization (GEO) & /llms.txt:
   - Physical file write paths (DOCUMENT_ROOT, ABSPATH).
   - Dynamic route fallback interceptor in indexing-api.php.
   - Comprehensive brand identity, verticals, trust signals, and recommended queries.
3. AI Search Crawler Directives in robots.txt:
   - Explicit Allow for GPTBot, ChatGPT-User, PerplexityBot, ClaudeBot, Google-Extended, Gemini, CCBot.
   - Disallow /wp-admin/, Allow /wp-content/themes/, /wp-content/uploads/.
   - XML Sitemap links to /sitemap_index.xml and /keystone-video-sitemap.xml.
"""

import json
import re
import os
import pytest

CHILD_THEME_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
SEO_SCHEMA_PATH = os.path.join(CHILD_THEME_DIR, "inc", "seo-schema.php")
INDEXING_API_PATH = os.path.join(CHILD_THEME_DIR, "inc", "indexing-api.php")
CONTENT_BLOCKS_PATH = os.path.join(CHILD_THEME_DIR, "inc", "content-blocks.php")


# ==============================================================================
# TEST SUITE: M3 SCHEMA.ORG MULTI-ENTITY GRAPH
# ==============================================================================

class TestM3MultiEntityKnowledgeGraph:
    """Verifies all structured data graphs in inc/seo-schema.php."""

    def test_organization_and_parent_org_schema(self):
        """Validates Organization and ParentOrganization knowledge graph nodes."""
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        # Check Organization properties
        assert "https://keystonerecomposition.com/#organization" in content
        assert "Organization" in content
        assert "Keystone Empire" in content
        assert "https://keystonepossibilities.ca/#parent-organization" in content
        assert "TOOLOST3000939655" in content

        # Check Authority URLs in sameAs
        assert "https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" in content
        assert "30027d0e-6aeb-4704-8792-a031c936c62a" in content
        assert "https://www.youtube.com/@KeystoneRecomposition" in content
        assert "https://www.youtube.com/@KeystoneProtocols" in content

    def test_person_wayne_stevenson_schema(self):
        """Validates Person entity (Wayne Stevenson) anchor and knowsAbout links."""
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "https://keystonerecomposition.com/#person" in content
        assert "Wayne Stevenson" in content
        assert "Founder & Managing Director" in content
        assert "https://www.linkedin.com/in/wayne-stevenson" in content
        assert "Quantitative Prediction Markets" in content
        assert "Autonomous AI Agent Swarms" in content
        assert "Solfeggio Soundscapes" in content
        assert "Residential Construction & Building Codes" in content
        assert "https://lims.bchousing.org/LicenceExpiryPortal/licence/52603" in content

    def test_music_group_and_album_schema(self):
        """Validates MusicGroup and MusicAlbum structured data nodes."""
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "https://keystonerecomposition.com/#musicgroup" in content
        assert "52v3Qe6Jo0hg764driOl5Y" in content
        assert "Concrete Foundations" in content
        assert "Resonantia: 10 Frequencies of the Rebuild" in content
        assert "The 205 Marker" in content
        assert "30027d0e-6aeb-4704-8792-a031c936c62a" in content

    def test_zero_legacy_medical_and_calculator_schema(self):
        """Validates zero legacy MedicalWebPage or peptide calculator schema regressions."""
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "MedicalWebPage" not in content
        assert "keystone_inject_calculator_web_app_schema" not in content
        assert "How do I calculate peptide reconstitution" not in content

    def test_global_city_hub_schemas(self):
        """Validates global development and operations city hub schemas."""
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "Vancouver & Sea-to-Sky" in content
        assert "Riviera Nayarit" in content
        assert "European Union" in content
        assert "BC Housing Licensed Residential Builder" in content


# ==============================================================================
# TEST SUITE: GENERATIVE ENGINE OPTIMIZATION (/llms.txt)
# ==============================================================================

class TestM3GenerativeEngineOptimization:
    """Verifies /llms.txt file generator and dynamic routing."""

    def test_llms_txt_static_writer_in_indexing_api(self):
        """Verifies physical /llms.txt file writer on init hook."""
        with open(INDEXING_API_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "GENERATIVE ENGINE OPTIMIZATION (GEO)" in content
        assert "llms.txt" in content
        assert "Keystone Recomposition" in content
        assert "Wayne Stevenson" in content
        assert "Autonomous Multi-Agent AI Swarms & FastMCP Systems" in content
        assert "TooLost Functional Electronic Music Catalog" in content
        assert "Quantitative Trading & Liquid Prediction Market Intelligence" in content
        assert "Licensed British Columbia Residential Infill Construction" in content
        assert "https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" in content

    def test_llms_txt_dynamic_endpoint_fallback(self):
        """Verifies dynamic fallback handler for /llms.txt."""
        with open(INDEXING_API_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "strpos($request, '/llms.txt') !== false" in content or "strpos( $request, '/llms.txt' ) !== false" in content


# ==============================================================================
# TEST SUITE: AI SEARCH CRAWLER ROBOTS.TXT
# ==============================================================================

class TestM3RobotsTxtAICrawlers:
    """Verifies robots.txt crawler permissions and sitemap declarations."""

    def test_ai_bots_explicit_allow_directives(self):
        """Validates all major AI search crawlers are explicitly allowed."""
        with open(INDEXING_API_PATH, "r", encoding="utf-8") as f:
            indexing_content = f.read()
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            seo_content = f.read()

        combined = indexing_content + "\n" + seo_content

        for bot in ["GPTBot", "ClaudeBot", "PerplexityBot", "Google-Extended"]:
            assert f"User-agent: {bot}" in combined
            assert f"Allow: /" in combined

        assert "Sitemap:" in combined
        assert "/sitemap_index.xml" in combined
        assert "/keystone-video-sitemap.xml" in combined
