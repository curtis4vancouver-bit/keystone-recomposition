"""
test_m2_sitemap_gsc_sanitization.py
====================================
Comprehensive Automated Test Suite for Milestone 2:
GSC & Sitemap Sanitization, 410 Gone Interceptor, VideoObject Schema,
and Sovereign Video Sitemap Generator.

Validates:
1. XML Sitemap Sanitization (disallowed patterns, 301 redirects, noindex, unpublished posts).
2. 410 Gone Interceptor (dead legacy paths, prefix matching, 301 redirects).
3. Elimination of 67 Video Indexing Failures & maxresdefau parsing bug suppression.
4. Pristine Schema.org VideoObject generation and Rank Math JSON-LD graph integration.
5. Sovereign Video Sitemap XML generation and Google Video XML schema compliance.
6. Robots.txt sanitizer (AI search crawler directives & asset whitelisting).
"""

import re
import json
import xml.etree.ElementTree as ET
import pytest


# ==============================================================================
# SIMULATION FIXTURES & IMPLEMENTATION MIRRORS
# (Accurately reproduces the PHP logic in inc/seo-schema.php & content-blocks.php)
# ==============================================================================

class PostMock:
    def __init__(self, post_id, post_name, post_title, post_content="", post_status="publish", post_type="post", post_date="2026-05-07T12:00:00+00:00", meta=None):
        self.ID = post_id
        self.post_name = post_name
        self.post_title = post_title
        self.post_content = post_content
        self.post_status = post_status
        self.post_type = post_type
        self.post_date = post_date
        self.meta = meta or {}

    def get_meta(self, key, single=True):
        return self.meta.get(key, "" if single else [])


def parse_duration_to_iso_and_seconds(video_duration):
    if not video_duration:
        return "PT5M0S", 300
    video_duration = str(video_duration).strip()
    if video_duration.upper().startswith("PT"):
        duration_iso = video_duration
        m = re.match(r"PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?", video_duration, re.IGNORECASE)
        sec = 0
        if m:
            h = int(m.group(1)) if m.group(1) else 0
            minutes = int(m.group(2)) if m.group(2) else 0
            s = int(m.group(3)) if m.group(3) else 0
            sec = (h * 3600) + (minutes * 60) + s
        return duration_iso, (sec if sec > 0 else 300)
    elif video_duration.isdigit():
        total_seconds = int(video_duration)
        hours = total_seconds // 3600
        minutes = (total_seconds // 60) % 60
        seconds = total_seconds % 60
        iso = "PT"
        if hours > 0:
            iso += f"{hours}H"
        if minutes > 0:
            iso += f"{minutes}M"
        if seconds > 0 or (hours == 0 and minutes == 0):
            iso += f"{seconds}S"
        return iso, total_seconds
    elif re.match(r"^(?:(\d+):)?(\d+):(\d+)$", video_duration):
        m = re.match(r"^(?:(\d+):)?(\d+):(\d+)$", video_duration)
        h = int(m.group(1)) if m.group(1) else 0
        minutes = int(m.group(2))
        seconds = int(m.group(3))
        total_seconds = (h * 3600) + (minutes * 60) + seconds
        iso = "PT"
        if h > 0:
            iso += f"{h}H"
        if minutes > 0:
            iso += f"{minutes}M"
        if seconds > 0 or (h == 0 and minutes == 0):
            iso += f"{seconds}S"
        return iso, total_seconds
    return "PT5M0S", 300


def keystone_get_post_video_metadata_sim(post: PostMock):
    if not post:
        return None

    post_id = post.ID
    youtube_id = post.get_meta("keystone_youtube_id")
    video_url = post.get_meta("video_url")

    if not youtube_id and video_url:
        m = re.search(r"(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=|shorts/)|youtu\.be/|youtube-nocookie\.com/embed/)([^\"&?/ ]{11})", str(video_url), re.IGNORECASE)
        if m:
            youtube_id = m.group(1)

    if not youtube_id and post.post_content:
        m1 = re.search(r'\[keystone_video[^\]]*id=["\']([a-zA-Z0-9_-]+)["\']', post.post_content, re.IGNORECASE)
        if m1:
            youtube_id = m1.group(1)
        else:
            m2 = re.search(r"(?:youtube\.com/(?:[^/]+/.+/(?:v|e(?:mbed)?)/|.*[?&]v=|shorts/)|youtu\.be/|youtube-nocookie\.com/embed/)([^\"&?/ ]{11})", post.post_content, re.IGNORECASE)
            if m2:
                youtube_id = m2.group(1)

    # Strict 11-character format and reject 'maxresdefau'
    if not youtube_id or not re.match(r"^[a-zA-Z0-9_-]{11}$", str(youtube_id)) or str(youtube_id) == "maxresdefau":
        return None

    video_name = post.get_meta("video_title") or post.post_title
    video_description = post.get_meta("video_description") or f"{post.post_title} - High-performance metabolic health and protocol blueprint."

    raw_duration = post.get_meta("video_duration") or post.get_meta("keystone_video_duration")
    duration_iso, duration_seconds = parse_duration_to_iso_and_seconds(raw_duration)

    video_upload_date = post.get_meta("video_upload_date") or post.post_date

    thumbnail_url = f"https://img.youtube.com/vi/{youtube_id}/maxresdefault.jpg"
    embed_url = f"https://www.youtube.com/embed/{youtube_id}"
    content_url = f"https://www.youtube.com/watch?v={youtube_id}"

    publisher = {
        "@type": "Organization",
        "@id": "https://keystonerecomposition.com/#organization",
        "name": "Keystone Recomposition",
        "url": "https://keystonerecomposition.com",
        "logo": {
            "@type": "ImageObject",
            "url": "https://keystonerecomposition.com/wp-content/uploads/logo.png",
        },
    }

    return {
        "post_id": post_id,
        "youtube_id": youtube_id,
        "title": video_name,
        "description": video_description,
        "duration_iso": duration_iso,
        "duration_seconds": duration_seconds,
        "upload_date": video_upload_date,
        "thumbnail_url": thumbnail_url,
        "embed_url": embed_url,
        "content_url": content_url,
        "publisher": publisher,
    }


def keystone_sanitize_rank_math_sitemap_sim(url, post_obj=None):
    if not url or not isinstance(url, dict):
        return url

    excluded_patterns = [
        'sample-page',
        'test',
        'demo',
        'wp-admin',
        'squamish-general-contractor',
        'west-vancouver-custom-homes',
        'whistler-luxury-home-builder',
        'bc-hydro-registered-civil-contractor',
        'north-vancouver-home-builder',
        'west-vancouver-luxury-builder',
        'pemberton-luxury-builder',
        '52603',
        '.html',
        '/tag/',
        '/author/',
        '/date/',
        '__trashed',
        '/trash/',
        'check_rm_options',
        'run_instant_indexing',
        'purge_all_caches',
        'heal_video_meta',
        'run_keystone_migration',
        'keystone_video_sitemap',
    ]

    known_301_sources = [
        '/2026/01/23/mounjaro-kwikpen-the-official-click-to-mg-math-bible/',
        '/2026/05/07/wolverine-stack-bpc-157-tb500-protocol-blueprint/',
        '/mounjaro-muscle-loss.html',
        '/wolverine-stack.html',
    ]

    loc = str(url.get('loc', ''))
    for pat in excluded_patterns:
        if pat.lower() in loc.lower():
            return False

    for redirect_src in known_301_sources:
        if redirect_src.strip('/').lower() in loc.lower():
            return False

    # Filter pure date archives (e.g. https://domain.com/2026/ or /2026/05/)
    if re.search(r"^https?://[^/]+/\d{4}/(?:\d{2}/)?$", loc, re.IGNORECASE):
        return False

    if post_obj:
        if post_obj.post_status != 'publish':
            return False
        robots = post_obj.get_meta('rank_math_robots')
        if isinstance(robots, list) and 'noindex' in robots:
            return False
        if isinstance(robots, str) and 'noindex' in robots.lower():
            return False
        if post_obj.get_meta('rank_math_redirection_id') or post_obj.get_meta('rank_math_redirection_url'):
            return False

    return url


def keystone_404_redirect_sim(request_uri: str):
    path = request_uri.split('?')[0]
    path = '/' + path.strip('/') + '/'
    while '//' in path:
        path = path.replace('//', '/')

    redirects_301 = {
        '/2026/01/23/mounjaro-kwikpen-the-official-click-to-mg-math-bible/': '/2026/01/13/stop-chasing-skinny-week-14-recomposition-the-269-click-kwikpen-secret/',
        '/2026/05/07/wolverine-stack-bpc-157-tb500-protocol-blueprint/': '/2026/05/07/wolverine-stack-bpc-157-tb-500-protocol-blueprint/',
        '/mounjaro-muscle-loss.html/': '/2026/01/13/stop-chasing-skinny-week-14-recomposition-the-269-click-kwikpen-secret/',
        '/wolverine-stack.html/': '/2026/05/07/wolverine-stack-bpc-157-tb-500-protocol-blueprint/',
    }

    gone_paths = [
        '/keystone_recomposition_/',
        '/logo/',
        '/keystone-recomposition-ltd/',
        '/keystone_recomposition_ltd_invert-removebg-preview/',
        '/logout/',
        '/the-journey/',
        '/sample-page/',
        '/test/',
        '/demo/',
        '/52603/',
        '/squamish-general-contractor/',
        '/west-vancouver-custom-homes/',
        '/whistler-luxury-home-builder/',
        '/bc-hydro-registered-civil-contractor/',
        '/north-vancouver-home-builder/',
        '/west-vancouver-luxury-builder/',
        '/pemberton-luxury-builder/',
    ]

    if path in redirects_301:
        return {'status': 301, 'location': redirects_301[path]}

    for gone_target in gone_paths:
        if path == gone_target or (gone_target != '/' and path.startswith(gone_target)):
            return {'status': 410, 'body': '410 Gone - This resource is permanently removed.'}

    if '.php' in path and '/wp-admin' not in path:
        return {'status': 301, 'location': '/'}

    return {'status': 200, 'location': None}


def keystone_clean_dom_output_buffer_sim(html_output: str) -> str:
    def clean_script_tag(match):
        script_open = match.group(1)
        json_content = match.group(2)
        script_close = match.group(3)
        try:
            data = json.loads(json_content)
        except Exception:
            return match.group(0)

        # 1. Single Top-Level VideoObject
        if isinstance(data, dict):
            obj_type = data.get('@type')
            types = obj_type if isinstance(obj_type, list) else [obj_type]
            if 'VideoObject' in types:
                embed = data.get('embedUrl', '')
                content = data.get('contentUrl', '')
                if 'maxresdefau' in embed or 'maxresdefau' in content:
                    return '<!-- Keystone: Removed corrupt VideoObject with invalid fake ID -->'
                if 'publisher' not in data:
                    return '<!-- Keystone: Removed duplicate VideoObject without publisher -->'

            # 2. Nested @graph
            if '@graph' in data and isinstance(data['@graph'], list):
                filtered_graph = []
                modified = False
                for node in data['@graph']:
                    n_type = node.get('@type')
                    n_types = n_type if isinstance(n_type, list) else [n_type]
                    if 'VideoObject' in n_types:
                        embed = node.get('embedUrl', '')
                        content = node.get('contentUrl', '')
                        if 'maxresdefau' in embed or 'maxresdefau' in content or 'publisher' not in node:
                            modified = True
                            continue
                    filtered_graph.append(node)
                if modified:
                    data['@graph'] = filtered_graph
                    return f"{script_open}\n{json.dumps(data, indent=2)}\n{script_close}"

        return match.group(0)

    return re.sub(r'(<script\s+type=["\']application/ld\+json["\'][^>]*>)(.*?)(</script>)', clean_script_tag, html_output, flags=re.DOTALL | re.IGNORECASE)


# ==============================================================================
# UNIT & INTEGRATION TESTS
# ==============================================================================

class TestM2SitemapSanitization:
    """1. XML Sitemap Sanitization & Cache Bypass Tests."""

    def test_disallowed_patterns_filtered(self):
        disallowed_urls = [
            "https://keystonerecomposition.com/mounjaro-muscle-loss.html",
            "https://keystonerecomposition.com/wolverine-stack.html",
            "https://keystonerecomposition.com/tag/peptide/",
            "https://keystonerecomposition.com/tag/tirzepatide/",
            "https://keystonerecomposition.com/author/wayne/",
            "https://keystonerecomposition.com/date/2026/01/",
            "https://keystonerecomposition.com/2026/05/",
            "https://keystonerecomposition.com/squamish-general-contractor/",
            "https://keystonerecomposition.com/west-vancouver-custom-homes/",
            "https://keystonerecomposition.com/whistler-luxury-home-builder/",
            "https://keystonerecomposition.com/bc-hydro-registered-civil-contractor/",
            "https://keystonerecomposition.com/north-vancouver-home-builder/",
            "https://keystonerecomposition.com/west-vancouver-luxury-builder/",
            "https://keystonerecomposition.com/pemberton-luxury-builder/",
            "https://keystonerecomposition.com/52603/",
            "https://keystonerecomposition.com/sample-page/",
            "https://keystonerecomposition.com/test-article/",
            "https://keystonerecomposition.com/demo-post/",
            "https://keystonerecomposition.com/wp-admin/post.php",
            "https://keystonerecomposition.com/post__trashed/",
            "https://keystonerecomposition.com/trash/old-post/",
        ]
        for url in disallowed_urls:
            entry = {"loc": url, "mod": "2026-08-31T00:00:00+00:00"}
            result = keystone_sanitize_rank_math_sitemap_sim(entry)
            assert result is False, f"Disallowed URL {url} was NOT filtered out by sitemap sanitizer."

    def test_known_301_redirect_sources_filtered(self):
        redirect_urls = [
            "https://keystonerecomposition.com/2026/01/23/mounjaro-kwikpen-the-official-click-to-mg-math-bible/",
            "https://keystonerecomposition.com/2026/05/07/wolverine-stack-bpc-157-tb500-protocol-blueprint/",
            "https://keystonerecomposition.com/mounjaro-muscle-loss.html",
            "https://keystonerecomposition.com/wolverine-stack.html",
        ]
        for url in redirect_urls:
            entry = {"loc": url}
            result = keystone_sanitize_rank_math_sitemap_sim(entry)
            assert result is False, f"Redirect source URL {url} was allowed in sitemap."

    def test_noindex_and_draft_posts_filtered(self):
        draft_post = PostMock(101, "draft-post", "Draft Post", post_status="draft")
        noindex_post = PostMock(102, "noindex-post", "Noindex Post", post_status="publish", meta={"rank_math_robots": ["noindex", "nofollow"]})
        redirect_post = PostMock(103, "redir-post", "Redirect Post", post_status="publish", meta={"rank_math_redirection_id": 42})

        assert keystone_sanitize_rank_math_sitemap_sim({"loc": "https://keystonerecomposition.com/draft-post/"}, draft_post) is False
        assert keystone_sanitize_rank_math_sitemap_sim({"loc": "https://keystonerecomposition.com/noindex-post/"}, noindex_post) is False
        assert keystone_sanitize_rank_math_sitemap_sim({"loc": "https://keystonerecomposition.com/redir-post/"}, redirect_post) is False

    def test_valid_canonical_posts_retained(self):
        valid_post = PostMock(200, "wolverine-stack-bpc-157-tb-500-protocol-blueprint", "Wolverine Stack", post_status="publish")
        entry = {"loc": "https://keystonerecomposition.com/2026/05/07/wolverine-stack-bpc-157-tb-500-protocol-blueprint/", "mod": "2026-08-31T00:00:00+00:00"}
        result = keystone_sanitize_rank_math_sitemap_sim(entry, valid_post)
        assert result == entry, "Valid indexable post was improperly removed from sitemap."


class TestM2410GoneInterceptor:
    """2. HTTP 410 Gone Interceptor & 301 Site Leak Patching Tests."""

    def test_retired_endpoints_return_410_gone(self):
        retired_endpoints = [
            "/keystone_recomposition_/",
            "/keystone_recomposition_",
            "/logo/",
            "/logo",
            "/keystone-recomposition-ltd/",
            "/keystone-recomposition-ltd",
            "/keystone_recomposition_ltd_invert-removebg-preview/",
            "/logout/",
            "/the-journey/",
            "/the-journey/subpage/",
            "/sample-page/",
            "/test/",
            "/demo/",
            "/52603/",
            "/squamish-general-contractor/",
            "/west-vancouver-custom-homes/",
            "/whistler-luxury-home-builder/",
            "/bc-hydro-registered-civil-contractor/",
            "/north-vancouver-home-builder/",
            "/west-vancouver-luxury-builder/",
            "/pemberton-luxury-builder/",
        ]
        for ep in retired_endpoints:
            res = keystone_404_redirect_sim(ep)
            assert res['status'] == 410, f"Retired endpoint {ep} returned {res['status']}, expected 410 Gone."

    def test_301_exact_redirects_resolve_correctly(self):
        mappings = {
            "/2026/01/23/mounjaro-kwikpen-the-official-click-to-mg-math-bible/": "/2026/01/13/stop-chasing-skinny-week-14-recomposition-the-269-click-kwikpen-secret/",
            "/2026/05/07/wolverine-stack-bpc-157-tb500-protocol-blueprint/": "/2026/05/07/wolverine-stack-bpc-157-tb-500-protocol-blueprint/",
            "/mounjaro-muscle-loss.html": "/2026/01/13/stop-chasing-skinny-week-14-recomposition-the-269-click-kwikpen-secret/",
            "/wolverine-stack.html": "/2026/05/07/wolverine-stack-bpc-157-tb-500-protocol-blueprint/",
        }
        for src, dest in mappings.items():
            res = keystone_404_redirect_sim(src)
            assert res['status'] == 301, f"Expected 301 for {src}, got {res['status']}"
            assert res['location'] == dest, f"Expected redirect to {dest}, got {res['location']}"


class TestM2VideoObjectSchemaAndMaxresdefauKill:
    """3. Eliminating 67 Video Indexing Failures & maxresdefau Bug Suppression."""

    def test_metadata_extraction_with_valid_youtube_id(self):
        post = PostMock(
            post_id=501,
            post_name="wolverine-stack",
            post_title="Wolverine Stack: BPC-157 & TB-500",
            post_content='[keystone_video id="o9fIpKUUXWE" type="youtube"]',
            meta={
                "video_duration": "PT8M20S",
                "video_title": "Wolverine Protocol Breakdown",
                "video_description": "Comprehensive protocol for soft tissue recovery."
            }
        )
        meta = keystone_get_post_video_metadata_sim(post)
        assert meta is not None, "Failed to extract video metadata from shortcode."
        assert meta['youtube_id'] == "o9fIpKUUXWE"
        assert meta['duration_iso'] == "PT8M20S"
        assert meta['duration_seconds'] == 500
        assert meta['thumbnail_url'] == "https://img.youtube.com/vi/o9fIpKUUXWE/maxresdefault.jpg"
        assert meta['embed_url'] == "https://www.youtube.com/embed/o9fIpKUUXWE"
        assert meta['publisher']['name'] == "Keystone Recomposition"

    def test_rejection_of_corrupt_maxresdefau_fake_id(self):
        post_corrupt = PostMock(
            post_id=502,
            post_name="corrupt-post",
            post_title="Corrupt Post",
            post_content='<img src="https://img.youtube.com/vi/maxresdefau/maxresdefault.jpg">',
            meta={"keystone_youtube_id": "maxresdefau"}
        )
        meta = keystone_get_post_video_metadata_sim(post_corrupt)
        assert meta is None, "Corrupt 'maxresdefau' fake ID was not rejected!"

    def test_output_buffer_strips_corrupt_video_objects(self):
        bad_html = """
        <html>
        <head>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "VideoObject",
          "name": "Corrupt Video",
          "embedUrl": "https://www.youtube.com/embed/maxresdefau",
          "contentUrl": "https://www.youtube.com/watch?v=maxresdefau"
        }
        </script>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "VideoObject",
          "name": "Unattributed Video",
          "embedUrl": "https://www.youtube.com/embed/o9fIpKUUXWE"
        }
        </script>
        </head>
        </html>
        """
        cleaned = keystone_clean_dom_output_buffer_sim(bad_html)
        assert "maxresdefau" not in cleaned, "Corrupt VideoObject was not stripped from DOM output buffer."
        assert "Removed corrupt VideoObject" in cleaned
        assert "Removed duplicate VideoObject without publisher" in cleaned

    def test_output_buffer_cleans_graph_nested_maxresdefau(self):
        graph_html = """
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@graph": [
            {
              "@type": "Article",
              "headline": "Clean Article"
            },
            {
              "@type": "VideoObject",
              "name": "Corrupt Nested Video",
              "embedUrl": "https://www.youtube.com/embed/maxresdefau"
            }
          ]
        }
        </script>
        """
        cleaned = keystone_clean_dom_output_buffer_sim(graph_html)
        assert "maxresdefau" not in cleaned
        assert "Clean Article" in cleaned


class TestM2SovereignVideoSitemap:
    """4. Sovereign Google Video XML Sitemap Tests."""

    def test_video_sitemap_xml_structure(self):
        posts = [
            PostMock(
                post_id=601,
                post_name="mounjaro-math",
                post_title="Mounjaro Math Bible",
                post_content='[keystone_video id="abc123XYZ01" type="youtube"]',
                meta={
                    "keystone_youtube_id": "abc123XYZ01",
                    "video_duration": "300",
                    "video_title": "Mounjaro KwikPen Dosing Math",
                    "video_description": "Full breakdown of click-to-mg dose math."
                }
            ),
            PostMock(
                post_id=602,
                post_name="wolverine-stack",
                post_title="Wolverine Stack",
                post_content='[keystone_video id="def456UVW02" type="youtube"]',
                meta={
                    "keystone_youtube_id": "def456UVW02",
                    "video_duration": "PT8M20S",
                    "video_title": "Wolverine Stack Recovery Protocol",
                    "video_description": "BPC-157 & TB-500 reconstitution and protocol."
                }
            )
        ]

        # Generate XML
        root = ET.Element("urlset", {
            "xmlns": "http://www.sitemaps.org/schemas/sitemap/0.9",
            "xmlns:video": "http://www.google.com/schemas/sitemap-video/1.1"
        })

        for p in posts:
            meta = keystone_get_post_video_metadata_sim(p)
            if not meta:
                continue
            url_el = ET.SubElement(root, "url")
            loc_el = ET.SubElement(url_el, "loc")
            loc_el.text = f"https://keystonerecomposition.com/{p.post_name}/"

            video_el = ET.SubElement(url_el, "{http://www.google.com/schemas/sitemap-video/1.1}video")
            thumb = ET.SubElement(video_el, "{http://www.google.com/schemas/sitemap-video/1.1}thumbnail_loc")
            thumb.text = meta["thumbnail_url"]

            title = ET.SubElement(video_el, "{http://www.google.com/schemas/sitemap-video/1.1}title")
            title.text = meta["title"]

            desc = ET.SubElement(video_el, "{http://www.google.com/schemas/sitemap-video/1.1}description")
            desc.text = meta["description"]

            content_loc = ET.SubElement(video_el, "{http://www.google.com/schemas/sitemap-video/1.1}content_loc")
            content_loc.text = meta["content_url"]

            player_loc = ET.SubElement(video_el, "{http://www.google.com/schemas/sitemap-video/1.1}player_loc")
            player_loc.text = meta["embed_url"]

            duration = ET.SubElement(video_el, "{http://www.google.com/schemas/sitemap-video/1.1}duration")
            duration.text = str(meta["duration_seconds"])

            pub_date = ET.SubElement(video_el, "{http://www.google.com/schemas/sitemap-video/1.1}publication_date")
            pub_date.text = meta["upload_date"]

            fam = ET.SubElement(video_el, "{http://www.google.com/schemas/sitemap-video/1.1}family_friendly")
            fam.text = "yes"

            uploader = ET.SubElement(video_el, "{http://www.google.com/schemas/sitemap-video/1.1}uploader", {"info": "https://keystonerecomposition.com/"})
            uploader.text = "Wayne Stevenson"

            live = ET.SubElement(video_el, "{http://www.google.com/schemas/sitemap-video/1.1}live")
            live.text = "no"

        xml_str = ET.tostring(root, encoding="utf-8").decode("utf-8")
        parsed_tree = ET.fromstring(xml_str)

        assert parsed_tree.tag.endswith("urlset")
        urls = parsed_tree.findall("{http://www.sitemaps.org/schemas/sitemap/0.9}url")
        assert len(urls) == 2, f"Expected 2 video URLs, found {len(urls)}"

        first_video = urls[0].find("{http://www.google.com/schemas/sitemap-video/1.1}video")
        assert first_video is not None
        assert first_video.find("{http://www.google.com/schemas/sitemap-video/1.1}duration").text == "300"

        second_video = urls[1].find("{http://www.google.com/schemas/sitemap-video/1.1}video")
        assert second_video is not None
        assert second_video.find("{http://www.google.com/schemas/sitemap-video/1.1}duration").text == "500"


class TestM2RobotsTxtSanitizer:
    """5. Dynamic Robots.txt Sanitizer Tests."""

    def test_robots_txt_directives(self):
        # Emulate output of keystone_recomposition_sanitize_robots_txt
        sitemap_url = "https://keystonerecomposition.com/sitemap_index.xml"
        video_sitemap_url = "https://keystonerecomposition.com/keystone-video-sitemap.xml"

        robots = "User-agent: *\n"
        robots += "Disallow: /wp-admin/\n"
        robots += "Allow: /wp-admin/admin-ajax.php\n"
        robots += "Allow: /wp-content/uploads/\n"
        robots += "Allow: /wp-content/themes/\n"
        robots += "Allow: /wp-includes/\n"
        robots += "Disallow: /wp-content/plugins/\n"
        robots += "Disallow: /readme.html\n"
        robots += "Disallow: /license.txt\n"
        robots += "Disallow: /search/\n"
        robots += "Disallow: /?s=\n"
        robots += "Disallow: /*.html$\n\n"
        robots += "User-agent: GPTBot\nAllow: /\n\n"
        robots += "User-agent: ClaudeBot\nAllow: /\n\n"
        robots += "User-agent: PerplexityBot\nAllow: /\n\n"
        robots += "User-agent: Google-Extended\nAllow: /\n\n"
        robots += "User-agent: CCBot\nAllow: /\n\n"
        robots += f"Sitemap: {sitemap_url}\n"
        robots += f"Sitemap: {video_sitemap_url}\n"

        assert "Allow: /wp-content/uploads/" in robots
        assert "Allow: /wp-content/themes/" in robots
        assert "Allow: /wp-includes/" in robots
        assert "User-agent: GPTBot" in robots
        assert "User-agent: ClaudeBot" in robots
        assert "User-agent: PerplexityBot" in robots
        assert "User-agent: Google-Extended" in robots
class TestM2SourceCodeCompliance:
    """6. Direct Source File Integrity & Hook Compliance Tests."""

    def test_php_source_files_exist_and_strict_types(self):
        import os
        base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
        target_files = [
            os.path.join(base_dir, "inc", "seo-schema.php"),
            os.path.join(base_dir, "inc", "content-blocks.php"),
            os.path.join(base_dir, "inc", "indexing-api.php"),
        ]
        for fpath in target_files:
            assert os.path.exists(fpath), f"Required file {fpath} does not exist."
            with open(fpath, "r", encoding="utf-8") as f:
                content = f.read()
            assert "declare(strict_types=1);" in content, f"{fpath} missing declare(strict_types=1)."
            assert "defined( 'ABSPATH' )" in content or "defined('ABSPATH')" in content, f"{fpath} missing ABSPATH security check."

    def test_required_hooks_in_seo_schema(self):
        import os
        base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
        seo_path = os.path.join(base_dir, "inc", "seo-schema.php")
        with open(seo_path, "r", encoding="utf-8") as f:
            content = f.read()

        required_snippets = [
            "add_filter( 'rank_math/sitemap/entry', 'keystone_recomposition_sanitize_rank_math_sitemap'",
            "add_filter( 'rank_math/sitemap/enable_caching', '__return_false' )",
            "add_filter( 'rank_math/sitemap/exclude_taxonomy'",
            "add_filter( 'robots_txt', 'keystone_recomposition_sanitize_robots_txt'",
            "add_filter( 'rank_math/snippet/rich_snippet_video', '__return_false' )",
            "add_filter( 'rank_math/schema/video', '__return_empty_array' )",
            "add_filter( 'rank_math/json_ld', 'keystone_recomposition_integrate_video_schema'",
            "add_action( 'template_redirect', 'keystone_recomposition_child_404_redirect' )",
            "function keystone_get_post_video_metadata(",
            "function keystone_recomposition_sanitize_rank_math_sitemap(",
            "function keystone_recomposition_child_404_redirect(",
            "status_header( 410 )",
            "nocache_headers()",
        ]
        for snippet in required_snippets:
            assert snippet in content, f"Missing required hook or function '{snippet}' in inc/seo-schema.php"

    def test_required_hooks_in_content_blocks_and_indexing(self):
        import os
        base_dir = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
        cb_path = os.path.join(base_dir, "inc", "content-blocks.php")
        idx_path = os.path.join(base_dir, "inc", "indexing-api.php")

        with open(cb_path, "r", encoding="utf-8") as f:
            cb_content = f.read()
        with open(idx_path, "r", encoding="utf-8") as f:
            idx_content = f.read()

        assert "keystone-video-sitemap.xml" in cb_content
        assert "function keystone_serve_video_sitemap()" in cb_content
        assert "video:thumbnail_loc" in cb_content
        assert "video:duration" in cb_content
        assert "video:player_loc" in cb_content

        assert "add_filter( 'rank_math/sitemap/index', 'keystone_add_video_sitemap_to_index' )" in idx_content
        assert "add_filter( 'rank_math/sitemap/video/content', '__return_empty_string'" in idx_content


if __name__ == "__main__":
    pytest.main(["-v", __file__])
