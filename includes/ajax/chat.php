<?php
/**
 * Manejadores AJAX para el chat assistant
 */

add_action('wp_ajax_chat_assistant_search', 'handle_chat_assistant_search');
add_action('wp_ajax_nopriv_chat_assistant_search', 'handle_chat_assistant_search');

function handle_chat_assistant_search() {
    // Mover aquí el código de la función handle_chat_assistant_search
} 