# Keystone Recomposition — Sovereign Child Theme

[![WordPress Child Theme](https://img.shields.io/badge/WordPress-6.4%2B-blue.svg)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-8.1%20%7C%208.2%2B-777bb4.svg)](https://php.net)
[![License: Proprietary](https://img.shields.io/badge/License-Proprietary-gold.svg)](https://keystonerecomposition.com)
[![BC Housing Builder](https://img.shields.io/badge/BC%20Builder-%2352603-emerald.svg)](https://lims.bchousing.org/LicenceExpiryPortal/licence/52603)
[![Spotify Verified](https://img.shields.io/badge/Spotify-Verified%20Artist-1DB954.svg)](https://open.spotify.com/artist/52v3Qe6Jo0hg764driOl5Y)

> **Sovereign multi-domain enterprise engineering platform for Keystone Recomposition.**  
> Engineered by Wayne Stevenson — Founder & Managing Director of Keystone Possibilities Ltd (BC Housing Builder #52603).

---

## 🏛️ Executive Overview

`keystone-recomposition-child` is a high-performance, dark quiet luxury WordPress child theme designed for seamless cross-domain authority syndication. The theme powers [keystonerecomposition.com](https://keystonerecomposition.com) with custom PHP templates, JSON-LD Schema.org graphs, Rank Math 100/100 SEO optimization, and local-first FastMCP multi-agent integrations.

### Key Capabilities
- **Autonomous Multi-Agent AI Integration**: Workstation protocols, FastMCP tool integration, and desktop Chrome CDP automation.
- **TooLost Digital Music Catalog**: 22 official releases (20 studio albums) and 216 verified master recordings indexed on Spotify OAC, MusicBrainz, and Musixmatch Pro.
- **Quantitative Market Modeling**: Predictive intelligence risk frameworks (EV $\ge$ +15%), Rule 25 trailing profit-locks, and an inviolable 40% CAD Cash Fortress liquidity floor.
- **Licensed Residential Construction**: BC Housing Licensed Builder #52603 execution for Small-Scale Multi-Unit Housing (SSMUH) infill under BC Bill 44.
- **High-Performance Mountain Living**: Authentic N=1 recomposition (-48 lbs, 205-lb athletic set-point) in the Sea-to-Sky corridor (Squamish/Whistler).
- **Global Strategic Infill**: Metro Vancouver multiplexes, Mexico Pacific Coast villa co-development, and European Union boutique infill pipelines.

---

## 🎨 Dark Quiet Luxury Design Tokens

The theme strictly enforces Wayne's **Dark Quiet Luxury** aesthetic standard:
- **Pitch Black Foundation**: `#000000` / `#050505` base backgrounds across all 8 canonical routes.
- **Universal Header Gradient**: White-to-Cyan-to-Gold linear text gradient (`linear-gradient(135deg, #ffffff 0%, #38bdf8 50%, #f59e0b 100%)`).
- **Luminous Cyan Accents**: `#38bdf8` / `#0284c7` for interactive protocol links, cyber badges, and technical markers.
- **Subtle Luxury Gold Accents**: `#f59e0b` / `#d97706` for institutional builder seals, TooLost audio indicators, and premium action pills.
- **Glassmorphic Cards**: `rgba(255, 255, 255, 0.03)` with `backdrop-filter: blur(16px)` and `1px solid rgba(255, 255, 255, 0.08)` borders.
- **Typography Hierarchy**: Outfit (headings, weights 700/800/900) paired with Inter (body copy, weights 400/500/600).

---

## 🗺️ Canonical Page Architecture

The child theme defines eight custom, template-driven canonical endpoints:

| Endpoint | Slug | Custom Template | Primary Purpose |
|---|---|---|---|
| `Home` | `/` | `front-page.php` | Sovereign ecosystem entry & high-cadence production overview |
| `AI Protocols` | `/ai-protocols/` | `template-ai-protocols.php` | Autonomous multi-agent swarms, FastMCP, and $800 Masterclass |
| `Intel` | `/intel/` | `home.php` | Technical articles, engineering intelligence, and system breakdowns |
| `Sonic Universe` | `/sonic-universe/` | `template-sonic-universe.php` | TooLost 22-release music catalog, Spotify player, and tracklists |
| `Investments` | `/investments/` | `template-investments.php` | Quant markets, BC Bill 44 infill, Mexico development & EU pipeline |
| `Lifestyle` | `/lifestyle/` | `template-lifestyle.php` | The 6 Sovereign Pillars of operations, mountain living & recomposition |
| `Founder` | `/founder/` | `template-founder-story.php` | Wayne Stevenson builder blueprint, N=1 case study & credentials |
| `Contact` | `/contact/` | `template-contact.php` | Compact executive inquiry gateway routed to `curtis4vancouver@gmail.com` |

---

## 🎵 Sonic Universe Catalog Integration

The catalog database is managed directly via `inc/sonic-catalog-data.php`:
- **22 Official Releases (20 Studio Albums, 2 Singles/EPs)**:
  - *Sovereign Reverb*, *Baseline Architecture*, *High Frequency*, *Vibration Vector*, *The 205 Marker*, *Concrete Foundations*, *Resonantia*, *Sub-Zero Cadence*, *Kinetic Flow*, *Deep Signal*, and more.
- **Metadata Indexing**:
  - TooLost Digital Global Distribution (`TOOLOST3000939655`)
  - MusicBrainz Artist & Label: `52v3Qe6Jo0hg764driOl5Y` / `30027d0e-6aeb-4704-8792-a031c936c62a`
  - Musixmatch Pro Synced Rights & Verified Lyrics
  - Integrated modal tracklists with direct Spotify streaming links

---

## 🔍 SEO & Search Console Architecture

- **Rank Math SEO**: Calibrated for 100/100 optimization scores with custom title, meta description, and OpenGraph/Twitter card injection.
- **301 Permanent Redirect Protection**: Managed via `inc/gsc-410-purge.php` to permanently redirect legacy URL patterns to canonical pages or return HTTP 410 Gone for purged media.
- **XML Sitemap Sanitization**: Intercepts `sitemap_index.xml` to guarantee only clean canonical URLs are served to Googlebot, preventing legacy indexation.
- **LLM Knowledge Graph**: Native `llms.txt` and endpoint routing providing clean, un-hallucinated multi-domain context for AI crawlers (PerplexityBot, GPTBot, ClaudeBot).

---

## 🧪 Automated Testing Suite

Comprehensive unit and integration test suites reside in `tests/`:

```bash
# Run full automated test suite
pytest tests/

# Targeted template and alignment validation
pytest tests/test_navigation_and_page_templates.py
pytest tests/test_sonic_universe_card_alignment.py
pytest tests/test_template_investments_overhaul.py
pytest tests/test_template_lifestyle_overhaul.py
pytest tests/test_template_contact_overhaul.py
```

All PHP files are strictly validated via PHP syntax linting before deployment:
```bash
find . -name "*.php" -exec php -l {} \;
```

---

## 🚀 Continuous Deployment (WP Pusher)

Deployments are automated through Git version control on GitHub and live-pulled via WP Pusher webhook:

1. **Repository**: `curtis4vancouver-bit/keystone-recomposition`
2. **Branch**: `main`
3. **Pusher Webhook**:
   ```
   https://keystonerecomposition.com/?wppusher-hook&token=[TOKEN]&package=a2V5c3RvbmUtcmVjb21wb3NpdGlvbg==
   ```

---

## 📜 Intellectual Property & Copyright

Copyright © 2023–2026 Keystone Possibilities Ltd & Keystone Recomposition. All Rights Reserved.  
Certified BC Housing Residential Builder Licence #52603.
