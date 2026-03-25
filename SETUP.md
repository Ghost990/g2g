# G2G WordPress Theme — Local Setup

## Prerequisites
- Docker & Docker Compose

## Quick Start

```bash
# 1. Start WordPress + MySQL
docker compose up -d

# 2. Wait for WP to initialize (~30 sec), then open:
#    http://localhost:8080
#    Admin: http://localhost:8080/wp-admin (admin / admin123)

# 3. Activate the theme
docker exec g2g-wordpress-1 wp theme activate g2g --path=/var/www/html --allow-root

# 4. Import content (posts, pages, media references)
docker exec g2g-wordpress-1 wp import /var/www/html/wp-content/themes/g2g/content-export.xml \
  --path=/var/www/html --allow-root --authors=create

# 5. Copy media uploads into WP
docker cp uploads/. g2g-wordpress-1:/var/www/html/wp-content/uploads/
```

## What's Included

- `docker-compose.yml` — WP + MySQL stack
- `content-export.xml` — WP WXR export (pages, posts, projects, categories)
- `uploads/` — Media files (project thumbnails, images)
- `setup.sh` — Original setup script
- `add-projects.php` / `add-test-projects.sh` — Project import helpers

## Theme Structure

```
├── assets/
│   ├── css/custom.css    — Main styles
│   ├── js/main.js        — Filter tabs + interactions
│   └── images/           — Theme assets
├── patterns/             — WP block patterns (hero, projects-grid, etc.)
├── parts/                — Template parts (header, footer)
├── templates/            — Page templates
├── functions.php         — Theme functions + pattern registration
├── style.css             — Theme metadata
└── theme.json            — Block theme config
```

## Notes
- Theme text domain: `g2f-theme` (historical)
- The docker-compose mounts this repo as the theme directory
- WP_HOME/WP_SITEURL default to `http://100.127.212.31:8080` — change in docker-compose.yml for your setup
