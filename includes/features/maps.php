<?php
/**
 * Configuración y funciones relacionadas con mapas
 *
 * @package Tu_Tema
 */

// Configuración por defecto del mapa
function get_default_map_coordinates() {
    return [
        'lat' => 38.9889,
        'lng' => -0.5209,
        'zoom' => 14
    ];
}

// Cargar recursos necesarios para los mapas
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
        
        // Cargar CSS de Leaflet
        wp_enqueue_style(
            'leaflet-css',
            'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
            array(),
            '1.9.4'
        );
        
        // Cargar JavaScript de Leaflet
        wp_enqueue_script(
            'leaflet-js',
            'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
            array(),
            '1.9.4',
            true
        );

        // Cargar nuestro script personalizado para mapas
        wp_enqueue_script(
            'xativa-maps',
            THEME_URI . '/assets/js/maps.js',
            array('leaflet-js'),
            '1.0.0',
            true
        );
    }
} 