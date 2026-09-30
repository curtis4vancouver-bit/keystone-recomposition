---
name: "Keystone Recomposition \u2014 Sovereign Child Theme"
description: "**Sovereign multi-domain enterprise engineering platform for Keystone Recomposition.**"
folder: "09_Keystone_websites/themes/keystone-recomposition-child"
tags: ["keystone_websites", "52603", "000000", "050505", "ffffff", "38bdf8", "vector_brain"]
last_updated: "2026-09-29 18:55:55"
---
# Keystone Recomposition — Sovereign Child Theme

[![WordPress Child Theme](https://img.shields.io/badge/WordPress-6.4%2B-blue.svg)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B%20Strict-777bb4.svg)](https://php.net)
[![License: Proprietary](https://img.shields.io/badge/License-Proprietary-gold.svg)](https://keystonerecomposition.com)
[![BC Housing Builder](https://img.shields.io/badge/BC%20Builder-%2352603-emerald.svg)](https://lims.bchousing.org/LicenceExpiryPortal/licence/52603)
[![Spotify Verified](https://img.shields.io/badge/Spotify-Verified%20Artist-1DB954.svg)](https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y)
[![GitHub Repository](https://img.shields.io/badge/GitHub-curtis4vancouver--bit%2Fkeystone--recomposition-black.svg)](https://github.com/curtis4vancouver-bit/keystone-recomposition)

> **Sovereign multi-domain enterprise engineering platform for Keystone Recomposition.**  
> Engineered by **Wayne Stevenson** — Founder & Managing Director of Keystone Possibilities Ltd (BC Housing Builder #52603) and creator of Keystone Recomposition.

---

## 🏛️ 1. Theme Overview & Modular Architecture

`keystone-recomposition-child` is an institutional-grade, dark quiet luxury WordPress child theme built upon Astra. It powers [keystonerecomposition.com](https://keystonerecomposition.com) with high-performance modern PHP 8.2+ strict-typed components, automated JSON-LD Schema.org graphs, Rank Math 100/100 SEO optimization, and local-first FastMCP multi-agent integrations.

### Directory Structure & Component Matrix

```
keystone-recomposition-child/
├── 404.php                                # Clean 404 error template with auto-redirect
├── 410.php                                # HTTP 410 Gone handler for scrubbed legacy endpoints
├── front-page.php                         # Sovereign ecosystem homepage
├── functions.php                          # Strict-typed modular master bootstrapper
├── header.php / footer.php                # Quiet luxury framing & glassmorphic navigation
├── home.php                               # INTEL technical archive & systems breakdown
├── index.php / single.php / sidebar.php   # Single post views & evidence citation feeds
├── template-ai-protocols.php              # Autonomous multi-agent swarms & FastMCP hub
├── template-sonic-universe.php            # TooLost 22-release music catalog & Spotify player
├── template-investments.php               # Quantitative prediction markets & infill capital
├── template-lifestyle.php                 # Wayne's 6 Sovereign Operations pillars & living
├── template-founder-story.php             # Wayne Stevenson founder blueprint & credentials
├── template-contact.php                   # Compact executive inquiry form to curtis4vancouver@gmail.com
├── template-global-landing-pages.php      # Localized Geo Hub landing templates
├── README.md                              # Institutional engineering documentation
├── assets/
│   ├── css/                               # Quiet luxury stylesheets & responsive rules
│   ├── js/                                # Dynamic audio player, search & modal handlers
│   └── images/                            # High-resolution production assets & lead media
│       ├── albums/                        # 22 official album cover artworks (Sovereign Reverb, etc.)
│       ├── ai_protocols_banner.png        # AI Protocols featured lead banner
│       ├── sonic_universe_banner.png      # Sonic Universe featured lead banner
│       ├── trading_terminal_luxury.jpg    # Investments featured lead banner
│       ├── bc_luxury_multiplex.jpg        # Lifestyle featured lead banner
│       ├── wayne_avatar.jpg               # Wayne Stevenson official founder avatar
│       └── keystone_possibilities_crest.png # Contact page featured lead crest
├── inc/
│   ├── gsc-410-purge.php                  # GSC reset, 301 redirects & 410 Gone enforcement
│   ├── sonic-catalog-data.php             # 22 releases, 20 studio albums, 216 ISRCs & tracks
│   ├── enqueue.php                        # Luxury font preloads & style/script queuing
│   ├── seo-schema.php                     # 2026 Schema.org multi-entity knowledge graph
│   ├── content-blocks.php                 # Glassmorphic cards, video facades & E-E-A-T ledger
│   ├── indexing-api.php                   # Google Indexing API, llms.txt & video sitemap hooks
│   ├── core-routes.php                    # Dynamic template routing & sovereign resets
│   ├── sovereign-migration.php            # Core database migration & cache purgers
│   ├── sovereign-nav-options.php          # 8-item primary menu & site identity synchronizer
│   └── sovereign-page-media-seo.php       # Lead pictures, titles & Rank Math SEO synchronizer
└── tests/                                 # Deterministic pytest and automated test suites
```

---

## 🎨 2. Dark Quiet Luxury Design Tokens

The theme strictly enforces Wayne Stevenson's **Dark Quiet Luxury** aesthetic standard:
- **Pitch Black Foundation**: `#000000` / `#050505` base backgrounds across all 8 canonical routes.
- **Universal Header Gradient**: White-to-Cyan-to-Gold linear text gradient (`linear-gradient(135deg, #ffffff 0%, #38bdf8 50%, #f59e0b 100%)`).
- **Luminous Cyan Accents**: `#38bdf8` / `#0284c7` for interactive protocol links, cyber badges, and technical markers.
- **Subtle Luxury Gold Accents**: `#f59e0b` / `#d97706` for institutional builder seals, TooLost audio indicators, and premium action pills.
- **Glassmorphic Surface System**: `rgba(255, 255, 255, 0.03)` with `backdrop-filter: blur(16px)` and `1px solid rgba(255, 255, 255, 0.08)` borders.
- **Typography Hierarchy**: Outfit (headings, weights 700/800/900) paired with Inter (body copy, weights 400/500/600).

---

## 🗺️ 3. The 8 Canonical Page Templates & Lead Media

Each canonical route is wired to an exact custom template with deterministic database lead pictures (featured images) and Rank Math SEO configuration:

| Page | Route Slug | Template File | Lead Featured Image | Primary Target |
|---|---|---|---|---|
| **Home** | `/` | `front-page.php` | `assets/images/albums/sovereign_reverb.jpg` | Sovereign ecosystem entry & high-cadence production overview |
| **AI Protocols** | `/ai-protocols/` | `template-ai-protocols.php` | `assets/images/ai_protocols_banner.png` | Autonomous multi-agent swarms, FastMCP, and $800 Masterclass |
| **INTEL** | `/intel/` | `home.php` | `assets/images/ai_protocols_banner.png` | Technical articles, engineering intelligence, and system breakdowns |
| **Sonic Universe** | `/sonic-universe/` | `template-sonic-universe.php` | `assets/images/sonic_universe_banner.png` | TooLost 22-release music catalog, Spotify player, and tracklists |
| **Investments** | `/investments/` | `template-investments.php` | `assets/images/trading_terminal_luxury.jpg` | Quant markets, BC Bill 44 infill, Mexico development & EU pipeline |
| **Lifestyle** | `/lifestyle/` | `template-lifestyle.php` | `assets/images/bc_luxury_multiplex.jpg` | The 6 Sovereign Pillars of operations, mountain living & recomposition |
| **Founder** | `/founder/` | `template-founder-story.php` | `assets/images/wayne_avatar.jpg` | Wayne Stevenson builder blueprint, N=1 case study & credentials |
| **Contact** | `/contact/` | `template-contact.php` | `assets/images/keystone_possibilities_crest.png` | Compact executive inquiry gateway routed to `curtis4vancouver@gmail.com` |

---

## 🎵 4. TooLost 22-Release Catalog & Spotify OAC

Wayne Stevenson's musical output is codified in `inc/sonic-catalog-data.php` and dynamically injected into Schema.org `MusicGroup` and `MusicAlbum` entities:
- **22 Official Releases (20 Studio Albums, 2 Singles/EPs)**:
  - *Sovereign Reverb*, *Baseline Architecture*, *High Frequency*, *Vibration Vector*, *The 205 Marker*, *Concrete Foundations*, *Resonantia: 10 Frequencies of the Rebuild*, *Sub-Zero Cadence*, *Kinetic Flow*, *Deep Signal*, and more.
- **Global Music Metadata & Rights Persistence**:
  - **Distributor**: TooLost Digital Global Distribution (`TOOLOST3000939655`)
  - **Spotify OAC**: [Wayne Stevenson Official Artist Profile](https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y)
  - **MusicBrainz Artist**: `52v3Qe6Jo0hg764driOl5Y`
  - **MusicBrainz Label**: `30027d0e-6aeb-4704-8792-a031c936c62a`
  - **Musixmatch Pro**: Verified Synced Lyrics & Catalog Licensing
  - **Functional Audio Engineering**: Composed for circadian entrainment, autonomic regulation, and cognitive flow states.

---

## 🔨 5. BC Housing Builder #52603 & Sovereign Pillars

Wayne Stevenson is the certified Licensed Residential Builder (#52603) and Managing Director of **Keystone Possibilities Ltd**:
1. **Autonomous Multi-Agent AI Swarms**: 16-agent swarms, FastMCP tool servers, and Chrome CDP desktop automation.
2. **TooLost 22-Release Sonic Universe**: 20 studio albums, 216 verified master recordings distributed globally.
3. **Quantitative Prediction Markets**: Polymarket asymmetric trading (EV $\ge$ +15%), Rule 25 trailing profit locks, and an inviolable 40% CAD Cash Fortress liquidity floor.
4. **Licensed Construction #52603**: BC Housing Licensed Builder specializing in BC Bill 44 Small-Scale Multi-Unit Housing (SSMUH) multiplex conversions.
5. **High-Performance Mountain Living**: Sea-to-Sky corridor (Squamish/Whistler), -48 lb recomposition, 205-lb athletic set-point, cold plunge, and sauna protocols.
6. **Strategic Real Estate Infill**: Vancouver infill, Mexico Pacific Coast (Riviera Nayarit) coastal villa co-development, and European Union boutique architectural pipelines.

---

## 🔍 6. Rank Math SEO & 301 Redirect Engine

- **Rank Math 100/100 Calibration**:
  - Every canonical page includes explicit `rank_math_title`, `rank_math_description`, `rank_math_focus_keyword`, and OpenGraph/Twitter summary large image cards.
- **HTTP 301 & 410 Permanent Hygiene**:
  - `inc/gsc-410-purge.php` permanently strips 40+ legacy peptide/workout URL patterns, redirecting them to canonical routes or returning HTTP 410 Gone to cleanly purge Google Search Console indexes.
- **Sitemap Sanitization**:
  - Filters Rank Math XML sitemaps to prevent indexing of orphaned scratch files, legacy posts, or malformed media queries.
- **LLM Knowledge Architecture**:
  - Dynamically serves `/llms.txt` and `/llms-full.txt` endpoints providing LLM web crawlers (GPTBot, PerplexityBot, ClaudeBot) with Wayne Stevenson's authentic sovereign multi-pillar profile.

---

## 🗄️ 7. Database Synchronizer (`inc/sovereign-page-media-seo.php`)

The child theme includes an automated database synchronization engine:
- Hooks cleanly into WordPress `admin_init` and supports manual URL triggering via `?keystone_sync_media_seo=1`.
- **Clean Titles**: Rewrites `post_title` in `wp_posts` for all 8 canonical pages to clean standard titles.
- **Lead Picture Assignment**: Copies high-resolution images from `assets/images/` into `wp-content/uploads/`, registers them as WordPress attachments, and sets `_thumbnail_id` on each page.
- **Rank Math Metadata Sync**: Automatically writes SEO titles, descriptions, focus keywords, and social preview cards.
- **Page Purging**: Moves obsolete legacy/duplicate posts (`post-2366`, `post-2229`, `post-1`, `post-1325`) into Trash to prevent duplicate content penalties.

---

## 🧪 8. Automated Testing & Verification

The repository includes deterministic test suites in `tests/`:

```bash
# Execute automated Python pytest suite
pytest tests/ -v

# Run targeted page template tests
pytest tests/test_navigation_and_page_templates.py
pytest tests/test_template_investments_overhaul.py
pytest tests/test_template_lifestyle_overhaul.py
pytest tests/test_template_contact_overhaul.py
pytest tests/test_sonic_universe_card_alignment.py
```

### Local PHP Syntax Compilation Standard
Every PHP file in the child theme must compile cleanly with 0 syntax errors:
```bash
find . -name "*.php" -exec php -l {} \;
```

---

## 🚀 9. Continuous Deployment (WP Pusher)

Automated deployments to [keystonerecomposition.com](https://keystonerecomposition.com) are managed via GitHub and WP Pusher:

1. **Repository**: `curtis4vancouver-bit/keystone-recomposition`
2. **Branch**: `main`
3. **Automated Webhook**:
   ```
   https://keystonerecomposition.com/?wppusher-hook&token=[WP_PUSHER_TOKEN]&package=a2V5c3RvbmUtcmVjb21wb3NpdGlvbg==
   ```

---

## 📜 Intellectual Property & Governance

Copyright © 2023–2026 Keystone Possibilities Ltd & Keystone Recomposition. All Rights Reserved.  
Certified BC Housing Residential Builder Licence #52603.
