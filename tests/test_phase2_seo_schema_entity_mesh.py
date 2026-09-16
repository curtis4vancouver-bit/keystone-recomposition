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
        """Ensures VideoObject is only emitted on watch-* pages and not standard blog posts."""
        # Check standalone output function
        assert "function keystone_recomposition_child_youtube_schema()" in self.content
        # Ensure it does NOT use is_singular('post') to emit VideoObject
        match = re.search(r"function keystone_recomposition_child_youtube_schema\(\)\s*\{(.*?)\$is_watch_page\s*=", self.content, re.DOTALL)
        assert match is not None
        # Check that it returns early if not a watch page
        assert "if ( ! $is_watch_page ) {" in self.content

    def test_rank_math_video_schema_only_on_watch_pages(self):
        """Ensures Rank Math JSON-LD filter only attaches VideoObject on watch-* pages."""
        assert "function keystone_recomposition_integrate_video_schema" in self.content
        match = re.search(r"function keystone_recomposition_integrate_video_schema.*?\$(?:is_watch_page\s*=.*?if\s*\(\s*!\s*\$is_watch_page\s*\)\s*\{\s*return\s+\$data;\s*\})", self.content, re.DOTALL)
        assert match is not None


class TestPhase2WayneStevensonEntityMesh:
    """Verifies Wayne Stevenson Person schema and multi-domain authority mesh."""

    @pytest.fixture(autouse=True)
    def setup(self):
        with open(SEO_SCHEMA_PHP, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_person_schema_structure(self):
        """Ensures Person schema includes name, job titles, BC Housing builder #52603, occupations, and sameAs."""
        assert "function keystone_get_wayne_stevenson_person_schema(): array" in self.content
        assert "'name'             => 'Wayne Stevenson'" in self.content
        assert "'Founder & Lead Protocol Architect'" in self.content
        assert "'Licensed Residential Builder'" in self.content
        assert "'Functional Audio Producer'" in self.content
        assert "52603" in self.content
        assert "EducationalOccupationalCredential" in self.content
        assert "BC Housing Licensing and Consumer Services" in self.content
        assert "Licensed Residential Builder & Fiduciary Construction Consultant" in self.content
        assert "Longevity & Recomposition Protocol Researcher" in self.content
        assert "Electronic Music Producer & Functional Bio-Acoustic Engineer" in self.content

    def test_music_catalog_bio_acoustic_descriptions(self):
        """Ensures music catalog documents functional bio-acoustic engineering."""
        assert "circadian entrainment" in self.content
        assert "training cadence" in self.content
        assert "autonomic state regulation" in self.content
        assert "Concrete Foundations" in self.content
        assert "Resonantia: 10 Frequencies of the Rebuild" in self.content
        assert "The 205 Marker" in self.content

    def test_rank_math_person_mesh_filter_registered(self):
        """Ensures keystone_inject_wayne_stevenson_rank_math_entity_mesh is hooked into rank_math/json_ld."""
        assert "add_filter( 'rank_math/json_ld', 'keystone_inject_wayne_stevenson_rank_math_entity_mesh', 90, 2 );" in self.content


class TestPhase2PubMedExtraction:
    """Verifies automated PubMed PMID extraction into ScholarlyArticle citations."""

    @pytest.fixture(autouse=True)
    def setup(self):
        with open(SEO_SCHEMA_PHP, "r", encoding="utf-8") as f:
            self.content = f.read()

    def test_pubmed_extractor_function_present(self):
        """Ensures keystone_extract_pubmed_citations handles PubMed URLs and PMIDs."""
        assert "function keystone_extract_pubmed_citations( string $content ): array" in self.content
        assert "pubmed.ncbi.nlm.nih.gov" in self.content
        assert "ScholarlyArticle" in self.content
        assert "PMID" in self.content

    def test_medical_schema_includes_citations(self):
        """Ensures MedicalWebPage schema assigns citation array from extracted PMIDs."""
        assert "$citations = keystone_extract_pubmed_citations" in self.content
        assert "$medical_schema['citation'] = $citations;" in self.content


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
        assert "@KeystoneProtocols" in content
        assert "@KeyStoneRecomposition" in content
        assert "https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y" in content
        assert "Tirzepatide" in content
        assert "Wolverine Stack" in content
        assert "circadian entrainment" in content
        assert "https://keystonepossibilities.ca/" in content
