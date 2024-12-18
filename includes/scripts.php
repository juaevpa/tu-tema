<?php
/**
 * Registro de Scripts y Estilos
 *
 * @package Tu_Tema
 */

function tu_tema_scripts() {
    // Solo cargar el script en el archivo de rutas
    if (is_post_type_archive('xativa_route')) {
        wp_enqueue_script('tu-tema-routes', get_template_directory_uri() . '/assets/js/routes.js', array(), '1.0', true);
    }

    // Chat assistant en todas las páginas
    wp_enqueue_script('chat-assistant', get_template_directory_uri() . '/assets/js/chat-assistant.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'tu_tema_scripts'); 