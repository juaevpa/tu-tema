<?php
/**
 * Configuración y funciones relacionadas con mapas
 */

function get_default_map_coordinates() {
    return [
        'lat' => 38.9889,
        'lng' => -0.5209,
        'zoom' => 14
    ];
}

function enqueue_map_resources() {
    // Array de páginas donde necesitamos mapas
    $map_pages = array(
        'is_post_type_archive' => array('xativa_restaurant', 'xativa_hotel'),
        'is_singular' => array('xativa_restaurant', 'xativa_hotel')
    );
    
    $load_maps = false;
    
    foreach ($map_pages as $condition => $post_types) {
        foreach ($post_types as $post_type) {
            if (function_exists($condition) && $condition($post_type)) {
                $load_maps = true;
                break 2;
            }
        }
    }
    
    if ($load_maps) {
        wp_deregister_script('xativa-maps'); // Desregistrar cualquier versión anterior
        
        wp_enqueue_style(
            'leaflet-css',
            'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
            array(),
            '1.9.4'
        );
        
        wp_enqueue_script(
            'leaflet-js',
            'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
            array(),
            '1.9.4',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_map_resources');

// Otras funciones relacionadas con mapas... 