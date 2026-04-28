# AGENTS.md — G2F Design Theme

WordPress 6.9 FSE block téma, kreatív ügynökség portfólió.
**Live:** https://g2f.lumenpixl.com | **Local:** http://localhost:8080 (Docker)
**Részletes AI handoff + session összefoglaló:** `SESSION-HANDOFF.md`

---

## Fejlesztői parancsok

Build system nincs — közvetlen fájlszerkesztés.

```bash
# Docker indítás
docker compose up -d

# WP-CLI a containerben
docker exec g2g-wordpress-1 wp [parancs] --path=/var/www/html --allow-root

# Téma fájlok live mount-olva: ./ → /var/www/html/wp-content/themes/g2g/
```

---

## Architektúra

| Réteg | Hol van |
|-------|---------|
| Stílusok | `assets/css/custom.css` (minden itt, nincs build) |
| Animációk | `assets/js/main.js` + GSAP 3.12.5 CDN |
| Design tokenek | `theme.json` |
| Patterns | `patterns/*.php` — `register_block_pattern()`-rel regisztrálva |
| Template parts | `parts/header.html`, `parts/footer.html` |
| Oldalak | `templates/*.html` |

**Custom Post Type:** `project` (portfólió munkák, functions.php-ban regisztrálva)
**Téma slug:** `g2g` | **Text domain:** `g2f-theme`

---

## WP 6.9 — KRITIKUS: block validáció

WP 6.9 a block editor JS-ben validálja a mentett HTML-t. Ha a layout osztályok hiányoznak → **"Block contains unexpected content"** hiba a Site Editorban.

**Minden `wp-block-group` `<div>`-nek kötelező layout osztály:**

```html
<!-- flex -->
<div class="wp-block-group is-layout-flex wp-block-group-is-layout-flex is-nowrap is-content-justification-center">

<!-- constrained -->
<div class="wp-block-group is-layout-constrained wp-block-group-is-layout-constrained">

<!-- flow (default) -->
<div class="wp-block-group is-layout-flow wp-block-group-is-layout-flow">
```

A JSON attribútumban lévő `layout.type` értéknek pontosan meg kell egyeznie az osztályokkal.

---

## Header navigation

A header `wp:navigation {"ref":132}` — ez egy konkrét `wp_navigation` post a DB-ben (ID: 132).

Ha DB reset vagy új szerver → újra kell létrehozni:
```bash
docker exec g2g-wordpress-1 wp eval '
wp_update_post(["ID"=>132,"post_status"=>"publish","post_type"=>"wp_navigation",
"post_content"=>"<!-- wp:navigation-link {\"label\":\"HOME\",\"url\":\"/\",\"kind\":\"custom\",\"isTopLevelLink\":true} /--><!-- wp:navigation-link {\"label\":\"ABOUT US\",\"url\":\"/about/\",\"kind\":\"custom\",\"isTopLevelLink\":true} /--><!-- wp:navigation-link {\"label\":\"SERVICES\",\"url\":\"/services/\",\"kind\":\"custom\",\"isTopLevelLink\":true} /--><!-- wp:navigation-link {\"label\":\"GALLERY\",\"url\":\"/gallery/\",\"kind\":\"custom\",\"isTopLevelLink\":true} /--><!-- wp:navigation-link {\"label\":\"CONTACT\",\"url\":\"/contact/\",\"kind\":\"custom\",\"isTopLevelLink\":true} /-->"
]);
' --path=/var/www/html --allow-root
```

**FONTOS:** `wp post create --post_content='<!-- wp:... -->'` escapeli a `<!--`-t `<\!--`-ra → üres tartalom! Mindig `wp eval` + `wp_update_post()` PHP-val.

---

## Button arrow (nyíl ikonok)

Nincs SVG a DOM-ban — `::after` pseudo-element, SVG data URI-val (custom.css):
- `.g2f-button-arrow` → fekete nyíl, hover fehér
- `.g2f-button-arrow-light` → fehér nyíl, hover fekete

**Soha ne adj hozzá `wp:html` SVG blokkot** a gomb pattern-ekhez — az mindig raw kódként jelenik meg a Site Editorban.

---

## GSAP animációk (main.js)

Minden entrance animáció minden oldalbetöltésnél fut (nincs sessionStorage gate — WP full page reload, nem SPA).

| Függvény | Mit animál |
|----------|-----------|
| `initLogoAnimation()` | SVG logo — blur → betűk → dekor elemek → kis szöveg |
| `initHeaderEntrance()` | Nav itemek + CTA stagger felülről (desktop only, >768px) |
| `initHomeHeroEntrance()` | Hero strip / eyebrow / separator / leírás (csak homepage) |
| `initHeroAnimations()` | H1 szavak word-split reveal (minden oldal) |
| `initScrollReveal()` | Scroll-triggered reveals (ScrollTrigger, `start: 'top bottom'`) |

**Logo SVG path indexek — ha az SVG változik, ezeket frissíteni kell:**
- `paths[0–19]` = "CREATIVE STUDIO" kis karakterek
- `paths[20–22]` = G, 2, F fő betűformák
- `paths[23+]` = dekoratív elemek

---

## Hero layout (főoldal)

```
[60px strip] [cover image — flex:1] [60px strip]
```

Kritikus CSS — ha ezek hiányoznak, sötét csíkok jelennek meg a kép oldalain:
```css
.g2f-hero .g2f-hero-wrapper { gap: 0 !important; }
.g2f-hero .wp-block-cover { flex: 1; padding: 0 !important; }
.g2f-hero .wp-block-cover__image-background { left: 0 !important; width: 100% !important; }
```

---

## Design rendszer

- **Layout:** contentSize 1218px, wideSize 1920px
- **Breakpointok:** 1440px / 1024px / 768px / 480px
- **Fontok:** Inter (folyószöveg), Roboto (heading)
- **CSS prefix:** `--g2f-*` változók, `.g2f-*` komponens classok
- **`useRootPaddingAwareAlignments: false`** a theme.json-ban — ne változtasd, ettől működik a full-width hero breakout

---

## Deployment

Részletes leírás: `SETUP.md` — 3 opció (rsync, full DB migráció, All-in-One WP Migration plugin).

```bash
# Gyors téma-only deploy SSH-val:
rsync -avz --exclude='.git' /Users/nagyz/Private/DEV/gg2/ user@g2f.lumenpixl.com:/path/to/themes/g2g/
```
