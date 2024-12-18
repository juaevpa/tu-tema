<?php
/**
 * Gestión de assets (scripts y estilos)
 */

function enqueue_theme_assets() {
    // Estilos principales
    wp_enqueue_style('theme-styles', get_stylesheet_uri());
    
    // Registrar y cargar ajaxurl primero
    wp_register_script('ajax-vars', false);
    wp_enqueue_script('ajax-vars');
    wp_add_inline_script('ajax-vars', 'var ajaxurl = "' . admin_url('admin-ajax.php') . '";');
    
    // Chat assistant en todas las páginas - con dependencia de ajax-vars
    wp_enqueue_script('chat-assistant', get_template_directory_uri() . '/assets/js/chat-assistant.js', array('ajax-vars'), '1.0', true);
    
    // Leaflet (solo en páginas necesarias)
   // if (is_post_type_archive('xativa_restaurant') || is_post_type_archive('xativa_hotel')) {
        wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css', [], '1.7.1');
        wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', [], '1.7.1', true);
    //}
    
}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets'); 