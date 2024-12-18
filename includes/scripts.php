<?php
/**
 * Registro de Scripts y Estilos
 *
 * @package Tu_Tema
 */

function tu_tema_scripts() {
    // Chat assistant en todas las páginas
    wp_enqueue_script('chat-assistant', get_template_directory_uri() . '/assets/js/chat-assistant.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'tu_tema_scripts'); 