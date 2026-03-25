#!/bin/bash
# Test projektek hozzáadása WP CLI-vel
WP="sudo docker exec g2g-wp-wordpress-1 wp --allow-root"

echo "🔧 Projektek létrehozása..."

# UX/UI Design projektek
UX1=$($WP post create --post_type=project --post_status=publish --post_title="Medtrend Patient Portal" --porcelain 2>/dev/null)
UX2=$($WP post create --post_type=project --post_status=publish --post_title="ChipMonk Mobile App" --porcelain 2>/dev/null)
UX3=$($WP post create --post_type=project --post_status=publish --post_title="AsicMinerz Dashboard" --porcelain 2>/dev/null)

# Art Direction projektek
ART1=$($WP post create --post_type=project --post_status=publish --post_title="Aeroprodukt Visual Identity" --porcelain 2>/dev/null)
ART2=$($WP post create --post_type=project --post_status=publish --post_title="Ipari Marketing Campaign" --porcelain 2>/dev/null)
ART3=$($WP post create --post_type=project --post_status=publish --post_title="Captured in Tones — Branding" --porcelain 2>/dev/null)

# Photography projektek
PH1=$($WP post create --post_type=project --post_status=publish --post_title="Studio Portraits Series" --porcelain 2>/dev/null)
PH2=$($WP post create --post_type=project --post_status=publish --post_title="Aeroprodukt Product Shots" --porcelain 2>/dev/null)
PH3=$($WP post create --post_type=project --post_status=publish --post_title="Architecture Editorial" --porcelain 2>/dev/null)

echo "✅ Projektek létrehozva"

# Taxonomy hozzárendelés
echo "🔧 Taxonomy hozzárendelés..."

# UX/UI
for ID in $UX1 $UX2 $UX3; do
  [ -n "$ID" ] && $WP post term set $ID project_service ux-design 2>/dev/null && \
    $WP post term set $ID project_category website 2>/dev/null && echo "  UX: $ID ✅"
done

# Art Direction
for ID in $ART1 $ART2 $ART3; do
  [ -n "$ID" ] && $WP post term set $ID project_service art-direction 2>/dev/null && \
    $WP post term set $ID project_category branding 2>/dev/null && echo "  Art: $ID ✅"
done

# Photography
for ID in $PH1 $PH2 $PH3; do
  [ -n "$ID" ] && $WP post term set $ID project_service photography 2>/dev/null && \
    $WP post term set $ID project_category website 2>/dev/null && echo "  Photo: $ID ✅"
done

echo ""
echo "🎉 Kész! Frissítsd a service oldalakat:"
echo "   http://100.127.212.31:8080/ux-design/"
echo "   http://100.127.212.31:8080/art-direction/"
echo "   http://100.127.212.31:8080/photography/"
