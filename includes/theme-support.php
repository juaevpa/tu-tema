<?php
/**
 * Configuración del Tema
 *
 * @package Tu_Tema
 */

if (!function_exists('tu_tema_setup')):
    function tu_tema_setup() {
        // Soporte para miniaturas en posts
        add_theme_support('post-thumbnails');
        
        // Soporte para título del sitio
        add_theme_support('title-tag');
        
        // Registro del menú de navegación
        register_nav_menus(array(
            'primary' => esc_html__('Menú Principal', 'tu-tema'),
        ));

        // Soporte para HTML5
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Soporte para el editor de bloques
        add_theme_support('wp-block-styles');
        add_theme_support('responsive-embeds');
        add_theme_support('align-wide');
    }
endif;
add_action('after_setup_theme', 'tu_tema_setup'); 