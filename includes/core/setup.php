<?php
/**
 * Configuración básica del tema
 *
 * @package Tu_Tema
 */

if (!function_exists('tu_tema_core_setup')):
    function tu_tema_core_setup() {
        // Añadir soporte para traducciones
        load_theme_textdomain('tu-tema', get_template_directory() . '/languages');

        // Añadir soporte para feeds automáticos
        add_theme_support('automatic-feed-links');

        // Permitir que WordPress maneje el título
        add_theme_support('title-tag');

        // Habilitar imágenes destacadas
        add_theme_support('post-thumbnails');

        // Registrar menús de navegación
        register_nav_menus(array(
            'primary' => esc_html__('Menú Principal', 'tu-tema'),
            'footer' => esc_html__('Menú Footer', 'tu-tema'),
        ));

        // Soporte para formatos HTML5
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Soporte para alineación completa y ancha
        add_theme_support('align-wide');

        // Soporte para el editor de bloques
        add_theme_support('wp-block-styles');
        add_theme_support('responsive-embeds');

        // Definir tamaños de imagen personalizados
        add_image_size('hero-image', 1920, 1080, true);
        add_image_size('card-image', 400, 300, true);
        add_image_size('thumbnail-large', 300, 300, true);
    }
endif;
add_action('after_setup_theme', 'tu_tema_core_setup');

// Configurar el ancho del contenido
if (!function_exists('tu_tema_content_width')):
    function tu_tema_content_width() {
        $GLOBALS['content_width'] = apply_filters('tu_tema_content_width', 1200);
    }
endif;
add_action('after_setup_theme', 'tu_tema_content_width', 0);