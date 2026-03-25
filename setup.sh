#!/bin/bash
# G2G WordPress Setup Script
# Futtatás: sudo bash /home/ankyr/Work/DEV/g2g-wp/setup.sh

WP="docker exec g2g-wp-wordpress-1 wp --allow-root --path=/var/www/html"

echo "=== 1. Plugin telepítések ==="
# Icon Block plugin (a téma ezt használja az SVG nyilakhoz)
$WP plugin install icon-block --activate
# Contact Form 7 (Contact oldalhoz)
$WP plugin install contact-form-7 --activate

echo "=== 2. Permalink struktúra ==="
$WP rewrite structure '/%postname%/' --hard
$WP rewrite flush --hard

echo "=== 3. Frontpage beállítás ==="
# Töröljük ha van Sample Page, és csináljunk rendeset
$WP post delete $($WP post list --post_type=page --name='sample-page' --field=ID 2>/dev/null) --force 2>/dev/null || true

# Home oldal
HOME_ID=$($WP post list --post_type=page --name='home' --field=ID 2>/dev/null)
if [ -z "$HOME_ID" ]; then
  HOME_ID=$($WP post create --post_type=page --post_title='Home' --post_status=publish --post_name='home' --porcelain)
  echo "Home page created: $HOME_ID"
else
  echo "Home page exists: $HOME_ID"
fi
$WP post meta set $HOME_ID _wp_page_template 'front-page'

# About oldal
ABOUT_ID=$($WP post list --post_type=page --name='about' --field=ID 2>/dev/null)
if [ -z "$ABOUT_ID" ]; then
  ABOUT_ID=$($WP post create --post_type=page --post_title='About Us' --post_status=publish --post_name='about' --porcelain)
  echo "About page created: $ABOUT_ID"
fi
$WP post meta set $ABOUT_ID _wp_page_template 'page-about'

# Services oldal
SRV_ID=$($WP post list --post_type=page --name='services' --field=ID 2>/dev/null)
if [ -z "$SRV_ID" ]; then
  SRV_ID=$($WP post create --post_type=page --post_title='Services' --post_status=publish --post_name='services' --porcelain)
  echo "Services page created: $SRV_ID"
fi
$WP post meta set $SRV_ID _wp_page_template 'page-services'

# Contact oldal
CONTACT_ID=$($WP post list --post_type=page --name='contact' --field=ID 2>/dev/null)
if [ -z "$CONTACT_ID" ]; then
  CONTACT_ID=$($WP post create --post_type=page --post_title='Contact' --post_status=publish --post_name='contact' --porcelain)
  echo "Contact page created: $CONTACT_ID"
fi

echo "=== 4. Statikus frontpage beállítás ==="
$WP option update show_on_front 'page'
$WP option update page_on_front $HOME_ID

echo "=== 5. Navigáció létrehozása ==="
NAV_ID=$($WP term create nav_menu 'Main Navigation' --porcelain 2>/dev/null || $WP term list nav_menu --name='Main Navigation' --field=term_id 2>/dev/null)
echo "Nav menu ID: $NAV_ID"

# Nav elemek
$WP menu item add-custom $NAV_ID 'HOME' '/' --porcelain
$WP menu item add-post $NAV_ID $ABOUT_ID --porcelain
$WP menu item add-post $NAV_ID $SRV_ID --porcelain
$WP menu item add-custom $NAV_ID 'GALLERY' '/#gallery' --porcelain
$WP menu item add-post $NAV_ID $CONTACT_ID --porcelain

echo "=== 6. Site title / tagline ==="
$WP option update blogname 'G2F Design'
$WP option update blogdescription 'Craft Design Solution'

echo "=== 7. Flush cache ==="
$WP cache flush 2>/dev/null || true

echo ""
echo "✅ SETUP KÉSZ! Nyisd meg: http://localhost:8080"
