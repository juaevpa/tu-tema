<?php
/**
 * Manejadores AJAX para filtros de hoteles
 */

add_action('wp_ajax_nopriv_filter_hotels', 'filter_hotels_ajax');
add_action('wp_ajax_filter_hotels', 'filter_hotels_ajax');

function filter_hotels_ajax() {
    // Mover aquí el código de la función filter_hotels_ajax
} 