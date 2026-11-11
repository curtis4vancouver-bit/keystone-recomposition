"""
Test Suite: Swarm Phase 2 - SEO, Schema & Entity Mesh Engineer Verification
Verifies:
1. Video Schema Separation (VideoObject restricted to watch-* pages)
2. Wayne Stevenson Multi-Domain Entity Mesh (Person schema, BC Builder #52603, occupations, music bio-acoustics)
3. Automated PubMed PMID Extraction into MedicalWebPage citations
4. Archive Bloat Elimination (rank_math/frontend/robots and rank_math/sitemap/exclude_taxonomy)
5. Child theme llms.txt knowledge base file integrity
"""

import os
import re
import pytest

THEME_DIR = os.path.abspath(os.path.join(os.path.dirname(__file__), ".."))
SEO_SCHEMA_PHP = os.path.join(THEME_DIR, "inc", "seo-schema.php")
LLMS_TXT = os.path.join(THEME_DIR, "llms.txt")


class TestPhase2VideoSchemaSeparation:
    """Verifies VideoObject schema separation to eliminate 76 GSC notices."""

    @pytest.fixture(autouse=True)
    def setup(self):
        with open(SEO_SCHEMA_PHP, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_video_schema_only_on_watch_pages(self):
        """Ensures standalone VideoObject guard checks watch-* pages and defers cleanly when Rank Math is active."""
        assert "function keystone_recomposition_child_youtube_schema()" in self.content
        match = re.search(r"function keystone_recomposition_child_youtube_schema\(\)\s*\{(.*?)\$is_watch_page\s*=", self.content, re.DOTALL)
        assert match is not None
        assert "if ( ! $is_watch_page" in self.content

    def test_rank_math_video_schema_only_on_watch_pages(self):
        """Ensures Rank Math JSON-LD filter checks $is_watch_page before attaching VideoObject."""
        assert "function keystone_recomposition_integrate_video_schema" in self.content
        assert "$is_watch_page = ( is_page()" in self.content


class TestPhase2WayneStevensonEntityMesh:
    """Verifies Wayne Stevenson Person schema and multi-domain authority mesh."""

    @pytest.fixture(autouse=True)
    def setup(self):
        with open(SEO_SCHEMA_PHP, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_person_schema_structure(self):
        """Ensures Person schema includes unified #wayne-stevenson @id, BC Housing builder #52603, occupations, and sameAs."""
        assert "function keystone_get_wayne_stevenson_person_schema(): array" in self.content
        assert "https://keystonerecomposition.com/#wayne-stevenson" in self.content
        assert "=> 'Wayne Stevenson'" in self.content
        assert "'Founder & Managing Director'" in self.content
        assert "'Electronic Music Producer & Composer'" in self.content
        assert "'Autonomous AI Systems Architect'" in self.content
        assert "52603" in self.content
        assert "EducationalOccupationalCredential" in self.content
        assert "BC Housing" in self.content
        assert "Licensed Residential Builder & Fiduciary Construction Consultant" in self.content
        assert "Electronic Music Producer & Functional Bio-Acoustic Engineer" in self.content

    def test_music_catalog_bio_acoustic_descriptions(self):
        """Ensures music catalog documents functional bio-acoustic engineering across 25 releases."""
        catalog_path = os.path.join(THEME_DIR, "inc", "sonic-catalog-data.php")
        with open(catalog_path, "r", encoding="utf-8") as cf:
            catalog = cf.read()
        assert "circadian entrainment" in self.content
        assert "training cadence" in self.content
        assert "autonomic state regulation" in self.content
        assert "Concrete Foundations" in catalog
        assert "Resonantia: 10 Frequencies of the Rebuild" in catalog
        assert "Whiskey on a Wednesday" in catalog
        assert "The 205 Marker" in catalog

    def test_rank_math_person_mesh_filter_registered(self):
        """Ensures keystone_inject_wayne_stevenson_rank_math_entity_mesh is hooked into rank_math/json_ld."""
        assert "keystone_inject_wayne_stevenson_rank_math_entity_mesh" in self.content
        assert "add_filter( 'rank_math/json_ld', 'keystone_inject_wayne_stevenson_rank_math_entity_mesh'" in self.content


class TestPhase2PubMedExtraction:
    """Verifies legacy MedicalWebPage / PubMed schema remains retired per Rule 11 brand pivot."""

    @pytest.fixture(autouse=True)
    def setup(self):
        with open(SEO_SCHEMA_PHP, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_pubmed_extractor_function_present(self):
        """Ensures retired MedicalWebPage and PubMed extractors are absent."""
        assert "MedicalWebPage" not in self.content
        assert "keystone_extract_pubmed_citations" not in self.content

    def test_schema_includes_citations(self):
        """Ensures BlogPosting / TechArticle schema is used instead of MedicalWebPage."""
        assert "BlogPosting" in self.content


class TestPhase2ArchiveBloatElimination:
    """Verifies Rank Math robots and sitemap taxonomy exclusions."""

    @pytest.fixture(autouse=True)
    def setup(self):
        with open(SEO_SCHEMA_PHP, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_rank_math_frontend_robots_hook(self):
        """Ensures rank_math/frontend/robots sets noindex, follow on tags, categories, dates, search, and paged."""
        assert "add_filter( 'rank_math/frontend/robots'" in self.content
        assert "is_tag()" in self.content
        assert "is_category()" in self.content
        assert "is_date()" in self.content
        assert "is_search()" in self.content
        assert "is_paged()" in self.content
        assert "$robots['index']  = 'noindex';" in self.content
        assert "$robots['follow'] = 'follow';" in self.content

    def test_rank_math_sitemap_exclude_taxonomy(self):
        """Ensures rank_math/sitemap/exclude_taxonomy excludes both post_tag and post_format."""
        assert "add_filter( 'rank_math/sitemap/exclude_taxonomy'" in self.content
        assert "'post_tag'" in self.content
        assert "'post_format'" in self.content


class TestPhase2LlmsTxt:
    """Verifies llms.txt knowledge base file exists and contains essential sections."""

    def test_llms_txt_exists(self):
        assert os.path.exists(LLMS_TXT)

    def test_llms_txt_content(self):
        with open(LLMS_TXT, "r", encoding="utf-8") as f:
            content = f.read()

        assert "Wayne Stevenson" in content
        assert "52603" in content
        assert "@KeystoneAIProtocols" in content
        assert "@KeyStoneRecomposition" in content
        assert "https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" in content
        assert "https://music.apple.com/us/artist/keystone-recomposition/1862989452" in content
        assert "multi-agent" in content.lower()
        assert "25 Official Releases" in content
        assert "https://keystonepossibilities.ca" in content
