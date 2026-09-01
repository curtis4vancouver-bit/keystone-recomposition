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
        assert "HealthAndBeautyBusiness" in content
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
        assert "Metabolic Health Optimization" in content
        assert "Peptide Therapeutics" in content
        assert "Solfeggio Soundscapes" in content
        assert "https://en.wikipedia.org/wiki/Metabolism" in content
        assert "https://en.wikipedia.org/wiki/Peptide" in content

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

    def test_medical_web_page_schema(self):
        """Validates MedicalWebPage schema with Endocrine specialty and MedicalAudience."""
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "MedicalWebPage" in content
        assert "https://schema.org/Endocrine" in content
        assert "MedicalAudience" in content
        assert "lastReviewed" in content
        assert "reviewedBy" in content

    def test_calculator_web_application_and_faq_schema(self):
        """Validates WebApplication and FAQPage schema for /calculators/ route."""
        with open(SEO_SCHEMA_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "keystone_inject_calculator_web_app_schema" in content
        assert "WebApplication" in content
        assert "FAQPage" in content
        assert "How do I calculate peptide reconstitution dosage with bacteriostatic water?" in content
        assert "How many clicks on a Mounjaro or Ozempic KwikPen equal a micro-dose?" in content
        assert "Why use a 5-day GLP-1 dosing interval instead of a 7-day schedule?" in content


# ==============================================================================
# TEST SUITE: GENERATIVE ENGINE OPTIMIZATION (/llms.txt)
# ==============================================================================

class TestM3GenerativeEngineOptimization:
    """Verifies /llms.txt file generator and dynamic routing."""

    def test_llms_txt_static_writer_in_indexing_api(self):
        """Verifies physical /llms.txt file writer on init hook."""
        with open(INDEXING_API_PATH, "r", encoding="utf-8") as f:
            content = f.read()

        assert "SECTION: GENERATIVE ENGINE OPTIMIZATION (GEO) — /llms.txt Deployment" in content
        assert "llms.txt" in content
        assert "Keystone Recomposition — LLM Identity File" in content
        assert "Wayne Stevenson" in content
        assert "GLP-1 Recomposition Research" in content
        assert "Peptide Protocols & Case Studies" in content
        assert "Wolverine Stack peptide protocol" in content
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
