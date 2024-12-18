<?php
/**
 * Configuración básica del tema
 */

// Soporte del tema
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');
    // ... otros soportes
}
add_action('after_setup_theme', 'theme_setup'); 