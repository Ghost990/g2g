# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Theme Overview

G2F Design is a **WordPress Full Site Editing (FSE) block theme** for a creative agency portfolio. It uses WordPress's native block editor with pattern-based composition—no classic PHP template hierarchy.

**Key Requirements:** WordPress 6.4+, PHP 8.0+

## Development Commands

**No build system required.** All CSS and JavaScript are written directly without transpilation.

- **Edit styles:** `assets/css/custom.css`
- **Edit scripts:** `assets/js/main.js`
- **Edit design tokens:** `theme.json`
- **Clear cache:** Changes to PHP files (functions.php, patterns/) require browser refresh; asset changes use version-based cache busting via theme version in style.css

## Architecture

### File Structure
```
├── functions.php          # Theme hooks, asset loading, custom features
├── theme.json             # Design system (colors, typography, spacing, layout)
├── assets/
│   ├── css/custom.css     # Main stylesheet (1100+ lines)
│   ├── js/main.js         # Vanilla JS interactivity (IIFE pattern)
│   └── fonts/             # Self-hosted Roboto & Inter (woff2)
├── templates/             # Block templates (HTML with block markup)
├── patterns/              # Reusable block patterns (PHP with HTML)
└── parts/                 # Template parts (header.html, footer.html)
```

### Design System (theme.json)

- **Layout:** contentSize 1218px, wideSize 1920px
- **Colors:** 10-color monochromatic palette (black/white dominant)
- **Typography:** Roboto (body), Inter (headings), 9 font sizes (14px–100px)
- **Spacing:** 8 sizes (8px–100px), sectionPadding: 100px

### CSS Architecture

Custom properties prefix: `--g2f-*`
Component prefix: `.g2f-*`

Key breakpoints in custom.css:
- 1440px: Desktop adjustments
- 1024px: Tablet (2-column grids)
- 768px: Mobile (1-column, reduced padding)
- 480px: Small mobile (font size reduction)

### JavaScript Features (main.js)

Vanilla JS using Intersection Observer API:
- Scroll-triggered animations (`.g2f-fade-in`, `.g2f-slide-left`, `.g2f-slide-right` → `.is-visible`)
- Sticky header (`.is-sticky` class when scroll > 100px)
- Project filter tabs (data-category filtering)
- Testimonial slider with autoplay
- Client logo marquee animation

### Block Patterns

Patterns compose the front page (`front-page.html`):
1. `hero-section.php` – Full-width cover with overlay
2. `about-section.php` – Column layout with vertical text
3. `services-section.php` – Zig-zag 3-service layout
4. `portfolio-text.php` – Split text/CTA layout
5. `projects-grid.php` – Filterable 3-column project grid
6. `testimonials.php` – Slider with dot navigation
7. `clients-section.php` – Logo marquee

### Custom Image Sizes

Registered in functions.php:
- `g2f-hero`: 1688×868
- `g2f-service`: 609×500
- `g2f-about`: 490×601
- `g2f-project`: 386×316
- `g2f-avatar`: 64×64

### Custom Block Styles

Registered styles (usable in block editor):
- Buttons: `g2f-outline`, `g2f-solid`
- Images: `g2f-rounded`
- Groups: `g2f-section`, `g2f-card`

## Key Files Reference

| File | Purpose |
|------|---------|
| `functions.php:16-61` | Theme setup, menus, supports |
| `functions.php:66-95` | Asset enqueuing with cache busting |
| `functions.php:130-174` | Custom block style registration |
| `theme.json` | All design tokens and block settings |
| `custom.css:1-50` | CSS custom properties |
| `main.js:1-30` | Scroll animation setup |
| `main.js:90-140` | Project filter functionality |

## Naming Conventions

- **PHP functions:** `g2f_theme_*` prefix
- **CSS classes:** `.g2f-*` for custom components
- **CSS properties:** `--g2f-*` for custom properties
- **Text domain:** `g2f-theme` (all strings use `__()` or `_e()`)

## Navigation Menus

Three registered menus:
- `primary` – Main header navigation
- `footer` – Footer links
- `social` – Social media icons

## Performance Notes

- Emoji scripts disabled (see `g2f_theme_disable_emojis`)
- Self-hosted fonts eliminate Google Fonts blocking requests
- JS uses passive event listeners and Intersection Observer
- No jQuery dependency
