<?php
/**
 * Gestión de assets (scripts y estilos)
 */

function enqueue_theme_assets() {
    // Estilos principales
    wp_enqueue_style('theme-styles', get_stylesheet_uri());
    
    // Leaflet (solo en páginas necesarias)
    if (is_post_type_archive('xativa_restaurant') || is_post_type_archive('xativa_hotel')) {
        wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css', [], '1.7.1');
        wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', [], '1.7.1', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');

// Variable AJAX para el frontend
function add_ajax_url() {
    echo '<script>var ajaxurl = "' . admin_url('admin-ajax.php') . '";</script>';
}
add_action('wp_head', 'add_ajax_url'); 