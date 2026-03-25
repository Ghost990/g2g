# G2F Design — WordPress Theme

**Live site:** https://g2f.lumenpixl.com/
**Local dev:** http://localhost:8080

---

## Local Development

### Prerequisites
- Docker & Docker Compose

### Quick Start

```bash
# 1. Start WordPress + MySQL
docker compose up -d

# 2. Wait ~30 sec, then open http://localhost:8080
#    Admin: http://localhost:8080/wp-admin  (admin / admin123)

# 3. Activate the theme
docker exec g2g-wordpress-1 wp theme activate g2g --path=/var/www/html --allow-root

# 4. Import content (posts, pages, media references)
docker exec g2g-wordpress-1 wp import /var/www/html/wp-content/themes/g2g/content-export.xml \
  --path=/var/www/html --allow-root --authors=create

# 5. Copy media uploads
docker cp uploads/. g2g-wordpress-1:/var/www/html/wp-content/uploads/

# 6. Create the navigation post (required for header nav)
docker exec g2g-wordpress-1 wp eval '
wp_update_post([
  "ID" => 132,
  "post_content" => "<!-- wp:navigation-link {\"label\":\"HOME\",\"url\":\"/\",\"kind\":\"custom\",\"isTopLevelLink\":true} /--><!-- wp:navigation-link {\"label\":\"ABOUT US\",\"url\":\"/about/\",\"kind\":\"custom\",\"isTopLevelLink\":true} /--><!-- wp:navigation-link {\"label\":\"SERVICES\",\"url\":\"/services/\",\"kind\":\"custom\",\"isTopLevelLink\":true} /--><!-- wp:navigation-link {\"label\":\"GALLERY\",\"url\":\"/gallery/\",\"kind\":\"custom\",\"isTopLevelLink\":true} /--><!-- wp:navigation-link {\"label\":\"CONTACT\",\"url\":\"/contact/\",\"kind\":\"custom\",\"isTopLevelLink\":true} /-->"
]);
' --path=/var/www/html --allow-root
```

---

## Deploying to Live (g2f.lumenpixl.com)

### Option A — Theme files only (code changes)

Upload via SFTP / rsync (no DB migration needed):

```bash
# rsync (SSH access required)
rsync -avz --exclude='.git' --exclude='node_modules' \
  /Users/nagyz/Private/DEV/gg2/ \
  user@g2f.lumenpixl.com:/path/to/wp-content/themes/g2g/

# Or zip and upload via cPanel File Manager
zip -r g2g-theme.zip . --exclude='.git/*' --exclude='node_modules/*'
```

### Option B — Full migration (DB + files)

Use when deploying fresh or after content changes.

```bash
# 1. Export local DB
docker exec g2g-wordpress-1 wp db export /tmp/local.sql --path=/var/www/html --allow-root
docker cp g2g-wordpress-1:/tmp/local.sql ./local.sql

# 2. Upload local.sql to remote (SFTP or cPanel phpMyAdmin)

# 3. On the remote server (SSH):
wp db import local.sql --path=/var/www/html --allow-root
wp search-replace 'http://localhost:8080' 'https://g2f.lumenpixl.com' --all-tables --allow-root

# 4. Upload media
rsync -avz uploads/ user@g2f.lumenpixl.com:/path/to/wp-content/uploads/
```

### Option C — No SSH (All-in-One WP Migration plugin)

1. Install **All-in-One WP Migration** on both local and remote
2. Local → Export → download `.wpress` file
3. Remote → Import → upload the `.wpress` file
4. Done — handles DB + media + URL replacement automatically

---

## Theme Structure

```
├── assets/
│   ├── css/custom.css        — All theme styles (layout, animations, components)
│   ├── js/main.js            — GSAP animations, project filter, mobile menu
│   └── images/               — Theme assets (icons, SVGs)
├── patterns/                 — Block patterns registered in PHP
│   ├── hero-section.php      — Homepage hero (cover image + vertical strips)
│   ├── projects-grid.php     — Portfolio grid with tab filter
│   ├── services-section.php  — Services overview
│   ├── services-detail-blocks.php
│   ├── portfolio-text.php    — "Creative Portfolio" text split section
│   ├── button-arrow.php      — Reusable dark CTA button
│   └── button-arrow-light.php — Reusable light CTA button
├── parts/                    — FSE template parts
│   ├── header.html           — Site header (logo + nav ref:132 + CTA)
│   └── footer.html           — Site footer (contact + links)
├── templates/                — Page templates (index, page, single, etc.)
├── functions.php             — Theme setup, pattern registration, enqueue
├── style.css                 — Theme metadata (name, version)
└── theme.json                — Global styles, color palette, typography
```

## Key Technical Notes

- **WordPress 6.9 FSE block theme** — all layout blocks require `is-layout-*` and `wp-block-group-is-layout-*` classes in static HTML or the editor shows "Block contains unexpected content" errors
- **Navigation:** Header uses `wp:navigation {"ref":132}` — the nav post must exist in the DB (see step 6 above)
- **Button arrows:** CSS `::after` pseudo-elements with SVG data URIs (no `wp:html` blocks) — dark and light variants in custom.css
- **GSAP 3.12.5 + ScrollTrigger** — CDN loaded in functions.php, entrance animations on every page load, scroll-triggered reveals for sections
- **Theme slug:** `g2g` (directory name) — text domain is `g2f-theme` (historical)
