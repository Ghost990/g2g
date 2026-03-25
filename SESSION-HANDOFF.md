# G2F Design Theme — AI Session Handoff

**Projekt:** G2F Design — kreatív ügynökség WordPress téma
**Live site:** https://g2f.lumenpixl.com
**GitHub repo:** https://github.com/Ghost990/g2g
**Local dev:** http://localhost:8080 (Docker)
**Dátum:** 2026-03-25

---

## Projekt áttekintés

G2F Design egy kreatív grafikai ügynökség portfólió oldala. WordPress 6.9 FSE (Full Site Editing) block téma, teljesen saját fejlesztésű (nincs page builder). A design Figma-ból lett leprogramozva.

**Tulajdonos / fejlesztő:** Zsolt Nagy (Ghost990@gmail.com)
**AI asszisztens volt:** Claude (Anthropic)

---

## Tech stack

| Réteg | Technológia |
|-------|-------------|
| CMS | WordPress 6.9 |
| Téma típus | FSE Block Theme (Full Site Editing) |
| Lokális dev | Docker Compose (WordPress + MySQL 8.0) |
| Animációk | GSAP 3.12.5 + ScrollTrigger (CDN) |
| Fontok | Inter, Roboto (Google Fonts) |
| Ikonok | Inline SVG / CSS data URI |
| Custom Post Type | `project` (portfólió munkák) |
| Verziókezelés | Git → GitHub (Ghost990/g2g) |

---

## Repo struktúra

```
g2g/                          ← Theme gyökér (slug: g2g, text domain: g2f-theme)
├── assets/
│   ├── css/custom.css        ← Minden stílus itt van (layout, animációk, komponensek)
│   ├── js/main.js            ← GSAP animációk, projekt filter, mobil menü
│   └── images/               ← Téma képek, SVG-k
├── patterns/                 ← Block pattern-ök (PHP, register_block_pattern()-rel)
│   ├── hero-section.php      ← Homepage hero (cover kép + bal/jobb függőleges csíkok)
│   ├── projects-grid.php     ← Portfólió grid tab filterrel
│   ├── services-section.php  ← Szolgáltatások overview (alternating sor layout)
│   ├── services-detail-blocks.php ← Részletes szolgáltatás blokkok inner page-re
│   ├── portfolio-text.php    ← "Creative Portfolio" szöveges split szekció
│   ├── about-section.php     ← Rólunk szekció (kép + szöveg)
│   ├── about-page-intro.php  ← About belső oldal bevezető
│   ├── about-page-founder.php ← Alapító bemutatkozása
│   ├── hero-about.php        ← About oldal hero (split: label+cover)
│   ├── hero-service.php      ← Service oldalak hero
│   ├── hero-banner.php       ← Gallery/Contact hero
│   ├── hero-project.php      ← Single project hero
│   ├── button-arrow.php      ← Újrahasználható CTA gomb (sötét, nyíllal)
│   ├── button-arrow-light.php ← Újrahasználható CTA gomb (világos, nyíllal)
│   ├── cta-divider.php       ← "Let's shape something" CTA sáv
│   ├── cta-divider-compact.php ← Kompakt CTA (inner page-ekre)
│   ├── cta-service.php       ← Service-specifikus CTA
│   ├── clients-section.php   ← Kliens logók marquee
│   ├── testimonials.php      ← Vélemények carousel
│   ├── project-info.php      ← Single project metadata sidebar
│   ├── project-sidebar.php   ← Project oldal sidebar
│   ├── project-gallery.php   ← Single project képgaléria (slider)
│   ├── project-view-live.php ← "View live" link blokk
│   └── service-projects-grid.php ← Service oldal projekt grid
├── parts/
│   ├── header.html           ← Site header (logo + nav ref:132 + CTA gomb)
│   └── footer.html           ← Site footer (contact + linkek + copyright)
├── templates/
│   ├── front-page.html       ← Főoldal template
│   ├── page-about.html       ← About oldal
│   ├── page-services.html    ← Főbb services oldal
│   ├── page-ux-design.html   ← UX/UI service aloldal
│   ├── page-art-direction.html ← Art Direction aloldal
│   ├── page-photography.html ← Photography aloldal
│   ├── page-gallery.html     ← Portfólió galéria oldal
│   ├── page-contact.html     ← Kapcsolat oldal
│   ├── single-project.html   ← Egyedi projekt oldal
│   └── ...
├── functions.php             ← Téma setup, pattern regisztráció, script enqueue
├── style.css                 ← Téma metadata (Name: G2F Design Theme, Version: 1.1.0)
├── theme.json                ← Globális stílusok, color palette, tipográfia
├── content-export.xml        ← WP WXR export (oldalak, projektek, tartalom)
├── uploads/                  ← Média fájlok (projekt képek, logók)
├── docker-compose.yml        ← Lokális dev stack
└── SETUP.md                  ← Setup + deployment instrukciók
```

---

## Minden session összefoglalója

### Session 1 — Alapok, Figma → kód

**Mit csináltunk:**
- WordPress FSE block téma felállítása nulláról
- Figma dizájn alapján: főoldal, about, services, gallery, contact oldalak HTML/block markup
- Custom Post Type: `project` (portfólió munkák)
- `functions.php`: pattern regisztráció, script/style enqueue, CPT regisztráció
- `theme.json`: Inter + Roboto fontok, color palette (white, black, gray-dark, gray-light, accent)
- Header 3-oszlopos grid: logo bal / nav közép / CTA jobb
- Footer: "Let's talk" + linkek + social + copyright

### Session 2 — Inner page-ek, hero struktúra

**Mit csináltunk:**
- About, Services, Gallery, Contact oldalak template-jei
- Minden inner page-en egységes hero struktúra: `g2f-hero-about-*` CSS classok, split layout (label bal + cover teljes szélességben)
- Service aloldalak: ux-design, art-direction, photography — mindegyiknek saját hero + projekt grid + CTA
- `single-project.html`: egyedi projekt oldal, projekt galéria slider, info sidebar
- Admin meta box: projekt galéria képek feltöltése WP adminból

**Problémák és fixek:**
- Admin bar 32px gap a hero tetején — JS-ben `--g2f-header-height` CSS változó tartalmazza az admin bar magasságát is
- Hero full-width breakout: `useRootPaddingAwareAlignments: false` a theme.json-ban
- Pattern dupla regisztráció: `unregister_block_pattern()` + `priority: 20` a functions.php-ban
- Scope conflict a PHP pattern include()-ban: title mentése include() előtt

### Session 3 — Figma sync, design fidelity

**Mit csináltunk:**
- Teljes Figma sync: minden oldal frissítve a Figma dizájnhoz
- Gombok: 5 variáció (outline, solid, outline-white, solid-white, ghost), pill alak (100px border-radius)
- Portfólió split szekció, kliens logók, CTA + footer
- About szekció: kép + szöveg columns, ABOUT US vertical label
- Services szekció: alternating image/text sorok (Figma match)
- Tipográfia swap: Inter = folyószöveg, Roboto = headingek

### Session 4 — GSAP animációk

**Mit csináltunk:**
- `assets/js/main.js` teljesen újraírva GSAP-pal
- **Logo animáció** (multi-phase timeline):
  - Phase 1: SVG blur-ből kijön
  - Phase 2: G, 2, F betűk leesnek (`back.out(1.7)`)
  - Phase 3: dekoratív elemek popnak (`elastic.out`)
  - Phase 4: kis szöveg ripple bal→jobb
  - Phase 5: egész logo micro-bounce
- **Header entrance**: nav itemek + CTA staggerelt bejövetel felülről
- **Hero entrance**: vertical strip / eyebrow / separator / description timeline
- **Scroll reveal**: about columns, service rows, project cards, portfolio szekció stb.
- **Hover effects**: project card image scale, magnetic CTA gomb
- **Sticky header**: `is-sticky` class scroll után, CSS transition

**Technikai döntések:**
- SVG logo inline HTML-ként van a headerben (nem `<img>`) — ez kell a path-alapú animációhoz
- `initLogoAnimation()` ellenőrzi: `paths.length < 25` — ha kevés path van, skip
- ScrollTrigger: `start: 'top bottom'` — amint az elem teteje belép a viewport aljára, indul

### Session 5 — SEO, favicon, deployment prep

**Mit csináltunk:**
- SEO meta tagok: `functions.php`-ban custom `wp_head` hook
- Per-page custom fields: `_g2f_seo_title`, `_g2f_seo_description`
- Favicon: `functions.php`-ban `add_theme_support('custom-logo')` + `site_icon`
- Dead code cleanup, content fixes
- Docker setup + WP WXR content export dokumentálva
- `content-export.xml` létrehozva (oldalak, projektek, kategóriák)

### Session 6 (legutóbbi) — WP 6.9 block validáció fixek

**Ez volt a legtöbb munka. Részletesen:**

#### Probléma: "Block contains unexpected or invalid content" / "Attempt recovery"
WordPress 6.9 a block editor JS-ben validálja a mentett HTML-t az elvárt `save()` kimenethez. Ha nem egyezik → piros hiba + "Try to recover" gomb.

**Gyökér ok:** A WP 6.9-ben a layout block-ok kötelező CSS osztályokat várnak a statikus HTML-ben:

| Layout típus | Kötelező osztályok a `<div>`-en |
|---|---|
| flex | `is-layout-flex wp-block-group-is-layout-flex` |
| constrained | `is-layout-constrained wp-block-group-is-layout-constrained` |
| flow (default) | `is-layout-flow wp-block-group-is-layout-flow` |
| + flex modifiers | `is-nowrap`, `is-vertical`, `is-content-justification-center` stb. |

**Fix:** Minden `<div class="wp-block-group ...">` elemhez hozzáadtuk a hiányzó layout osztályokat. Érintett fájlok:
- `parts/header.html`
- `parts/footer.html`
- `patterns/hero-section.php`
- `patterns/button-arrow.php`
- `patterns/button-arrow-light.php`
- `patterns/services-section.php`
- `patterns/services-detail-blocks.php`
- `patterns/portfolio-text.php`
- `patterns/projects-grid.php`

#### Probléma: SVG nyilak raw kódként jelennek meg az editorban
`wp:html` (Custom HTML) blokk mindig az HTML forrást mutatja a Site Editorban, nem a renderelt kimenetet.

**Fix:** Minden `wp:html` SVG nyíl blokkot eltávolítottunk. Helyette CSS `::after` pseudo-element, SVG data URI-val:

```css
.g2f-button-arrow::after {
    content: '';
    display: inline-block;
    width: 20px; height: 20px;
    background-image: url("data:image/svg+xml,%3Csvg...");
    background-size: contain;
    background-repeat: no-repeat;
    transition: transform 0.3s ease;
}
.g2f-button-arrow:hover::after {
    transform: translateX(4px);
    background-image: url("data:image/svg+xml,... white stroke ...");
}
/* Light variant (fehér nyíl → fekete hover) */
.g2f-button-arrow-light::after { /* white arrow */ }
.g2f-button-arrow-light:hover::after { /* black arrow */ }
```

#### Probléma: Hero sötét csíkok bal és jobb oldalán
**Gyökér ok:** régi CSS szabályok `padding-left: 60px; left: 60px; width: calc(100% - 120px)` maradtak a hero cover image-en.

**Fix:**
```css
.g2f-hero .wp-block-cover {
    flex: 1;
    min-height: 868px;
    padding: 0 !important;
}
.g2f-hero .wp-block-cover__image-background,
.g2f-hero .wp-block-cover__background {
    left: 0 !important; right: 0 !important; width: 100% !important;
}
.g2f-hero .g2f-hero-wrapper { gap: 0 !important; }
```

#### Probléma: Jobb oldali strip keskenyebb volt (40px vs 60px)
A `.g2f-vertical-text-strip--right { width: 40px }` override-olta az alap 60px-et. Fix: 60px-re javítva.

#### Probléma: Portfolio-text "classic block" recovery
A `portfolio-text.php` raw PHP/HTML volt, block kommentek nélkül → WP Site Editorban "classic block"-ként értelmezte.

**Fix:** Teljesen átírva proper block markup-ra (`wp:group`, `wp:heading`, `wp:paragraph` kommentekkel).

#### Probléma: Projects grid cím eltűnt recovery után
A heading raw HTML-ben volt, block marker nélkül. Fix: `<!-- wp:heading -->` komment hozzáadva.

#### Probléma: Navigation eltűnt a headerből
**Gyökér ok:** Az inline `wp:navigation-link` lista nem volt mentve WP navigation post-ként → WP 6.9-ben ref nélküli navigation érvénytelen.

**Fix:** Létrehoztunk egy `wp_navigation` post-ot (ID: 132) WP-CLI + PHP eval-lal:

```bash
docker exec g2g-wordpress-1 wp eval '
wp_update_post(["ID" => 132, "post_content" => "<!-- wp:navigation-link ... -->"]);
' --path=/var/www/html --allow-root
```

A header.html navigation block-ja most: `<!-- wp:navigation {"ref":132, ...} /-->`

**Fontos:** WP-CLI `wp post create --post_content='<!-- wp:... -->'` escapeli a `<!--`-t `<\!--`-ra → üres tartalom. Mindig `wp eval` + `wp_update_post()` PHP-val kell!

#### Probléma: Animációk nem játszódtak le
**Gyökér ok:** `sessionStorage('g2f_entered')` gate be volt állítva korábbi tesztelésből.

**Fix:** Eltávolítottuk a `sessionStorage` gate-et. WordPress full page reload-ot csinál minden navigációnál (nem SPA), tehát biztonságos minden oldalbetöltésnél futtatni az animációkat.

---

## Jelenlegi állapot (mi működik)

| Funkció | Állapot |
|---------|---------|
| Főoldal | ✅ teljes |
| About oldal | ✅ teljes |
| Services főoldal | ✅ teljes |
| UX/UI, Art Direction, Photography aloldalak | ✅ teljes |
| Gallery oldal | ✅ teljes |
| Contact oldal | ✅ kontakt form (Contact Form 7) |
| Single project oldal | ✅ (hero, galéria slider, info sidebar) |
| Header (logo + nav + CTA) | ✅ nav post ID: 132 |
| Footer | ✅ |
| GSAP animációk | ✅ (logo, header, hero, scroll reveal) |
| Mobil menü | ✅ (hamburger → fullscreen overlay) |
| Projekt filter tabs | ✅ (all / ux-ui / art-direction / photography) |
| Block editor validáció | ✅ nincs "unexpected content" hiba |
| Deployment docs | ✅ SETUP.md-ben |

---

## Ismert korlátok / ami nincs kész

- **Contact Form 7 styling**: az alap CF7 form stílusok részben vannak, lehet tovább finomítani
- **Live deploy**: a `g2f.lumenpixl.com`-ra még nem volt deploy, csak a GitHub-on van a kód
- **DB migráció**: a lokális tartalom (projektek, media ID-k) nincs átmásolva a live szerverre
- **Navigation post a remote-on**: a `wp_navigation` post ID 132 csak lokálisan létezik — a live szerveren is létre kell hozni (lásd SETUP.md)

---

## Kritikus technikai tudnivalók

### WP 6.9 block validáció
Ha új `wp:group` blokkot adsz hozzá bármely pattern-ben vagy template part-ban, **kötelező** a layout osztályok:
```html
<!-- flex layout -->
<div class="wp-block-group is-layout-flex wp-block-group-is-layout-flex is-nowrap">

<!-- constrained layout -->
<div class="wp-block-group is-layout-constrained wp-block-group-is-layout-constrained">

<!-- flow (default) layout -->
<div class="wp-block-group is-layout-flow wp-block-group-is-layout-flow">
```
Ha ezek hiányoznak → Site Editorban "Block contains unexpected content" hiba.

### Navigation post
A header `wp:navigation {"ref":132}` blokk egy konkrét WP DB post-ra mutat. Ha a DB-t reseteled vagy új szerverre migráltatsz, újra kell létrehozni (SETUP.md 6. lépés).

### SVG logo animáció
A logo SVG az `assets/js/main.js`-ben path index-ek alapján animálódik:
- `[0-19]` = "CREATIVE STUDIO" kis szöveg karakterek
- `[20-22]` = G, 2, F fő betűformák
- `[23+]` = dekoratív elemek

Ha a logo SVG-t cseréled, az index-ek megváltoznak → `initLogoAnimation()` funkcióban frissíteni kell a slice-okat.

### Button arrow CSS
Nincs SVG a DOM-ban a gomboknál — a nyíl `::after` pseudo-element, SVG data URI-val. Sötét és világos variáns:
- `.g2f-button-arrow` → fekete nyíl, hover: fehér
- `.g2f-button-arrow-light` → fehér nyíl, hover: fekete

### WP-CLI + block kommentek
```bash
# HELYES (PHP eval-lal):
wp eval 'wp_update_post(["ID"=>X,"post_content"=>"<!-- wp:... -->"]);'

# HELYTELEN (escapeli a <!-- -t <\!-- -ra):
wp post create --post_content='<!-- wp:... -->'
```

---

## Lokális fejlesztés indítása

```bash
cd /Users/nagyz/Private/DEV/gg2

# Docker indítás
docker compose up -d

# WP-CLI parancsok (wp prefix a containerben)
docker exec g2g-wordpress-1 wp [parancs] --path=/var/www/html --allow-root

# Téma fájlok mount-olva vannak, nincs szükség file copy-ra:
# ./  →  /var/www/html/wp-content/themes/g2g/
```

---

## Deployment a live szerverre (g2f.lumenpixl.com)

Részletes leírás: **SETUP.md** — három opció:
1. **rsync** (SSH szükséges) — csak téma fájlok
2. **Teljes DB migráció** (SSH + WP-CLI szükséges)
3. **All-in-One WP Migration plugin** — SSH nélkül, grafikus

---

## Fájlok amit NE módosíts óvatlanul

| Fájl | Miért érzékeny |
|------|----------------|
| `parts/header.html` | Navigation ref:132 — ha kiveszed, a nav eltűnik |
| `theme.json` | `useRootPaddingAwareAlignments: false` — ha törölöd, a hero full-width elromlik |
| `functions.php` | Pattern regisztráció sorrendje számít (priority: 20) |
| `assets/js/main.js` | Logo path index-ek (0-19, 20-22, 23+) |

---

*Összefoglaló készítette: Claude (Anthropic) — 2026-03-25*
