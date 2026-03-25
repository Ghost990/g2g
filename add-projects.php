<?php
// WP betöltés
define('ABSPATH', '/var/www/html/');
require('/var/www/html/wp-load.php');

$projects = [
    // title, service_slug, category_slug
    ['Medtrend Patient Portal',       'ux-design',     'website'],
    ['ChipMonk Mobile App',           'ux-design',     'website'],
    ['AsicMinerz Dashboard',          'ux-design',     'branding'],
    ['Aeroprodukt Visual Identity',   'art-direction', 'branding'],
    ['Ipari Marketing Campaign',      'art-direction', 'branding'],
    ['Captured in Tones — Branding',  'art-direction', 'branding'],
    ['Studio Portraits Series',       'photography',   'website'],
    ['Aeroprodukt Product Shots',     'photography',   'website'],
    ['Architecture Editorial',        'photography',   'website'],
];

foreach ($projects as [$title, $service, $cat]) {
    $id = wp_insert_post([
        'post_title'  => $title,
        'post_type'   => 'project',
        'post_status' => 'publish',
    ]);
    if (is_wp_error($id)) { echo "❌ $title: " . $id->get_error_message() . "\n"; continue; }
    wp_set_object_terms($id, $service, 'project_service');
    wp_set_object_terms($id, $cat,     'project_category');
    echo "✅ [$id] $title ($service)\n";
}
echo "\nKész!\n";
