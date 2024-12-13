<?php
/**
 * Funciones y definiciones del tema
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
    }
endif;
add_action('after_setup_theme', 'tu_tema_setup');

// Registrar tipo de contenido personalizado para rutas
function register_xativa_route_post_type() {
    $labels = array(
        'name'                  => _x('Rutas', 'Post type general name', 'tu-tema'),
        'singular_name'         => _x('Ruta', 'Post type singular name', 'tu-tema'),
        'menu_name'            => _x('Rutas', 'Admin Menu text', 'tu-tema'),
        'add_new'              => __('Añadir Nueva', 'tu-tema'),
        'add_new_item'         => __('Añadir Nueva Ruta', 'tu-tema'),
        'edit_item'            => __('Editar Ruta', 'tu-tema'),
        'new_item'             => __('Nueva Ruta', 'tu-tema'),
        'view_item'            => __('Ver Ruta', 'tu-tema'),
        'search_items'         => __('Buscar Rutas', 'tu-tema'),
        'not_found'            => __('No se encontraron rutas', 'tu-tema'),
        'not_found_in_trash'   => __('No hay rutas en la papelera', 'tu-tema'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'rutas'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-location-alt',
        'show_in_rest'        => true,
    );

    register_post_type('xativa_route', $args);
}

// Registrar tipo de contenido para lugares de interés
function register_xativa_place_post_type() {
    $labels = array(
        'name'                  => _x('Lugares', 'Post type general name', 'tu-tema'),
        'singular_name'         => _x('Lugar', 'Post type singular name', 'tu-tema'),
        'menu_name'            => _x('Lugares', 'Admin Menu text', 'tu-tema'),
        'add_new'              => __('Añadir Nuevo', 'tu-tema'),
        'add_new_item'         => __('Añadir Nuevo Lugar', 'tu-tema'),
        'edit_item'            => __('Editar Lugar', 'tu-tema'),
        'new_item'             => __('Nuevo Lugar', 'tu-tema'),
        'view_item'            => __('Ver Lugar', 'tu-tema'),
        'search_items'         => __('Buscar Lugares', 'tu-tema'),
        'not_found'            => __('No se encontraron lugares', 'tu-tema'),
        'not_found_in_trash'   => __('No hay lugares en la papelera', 'tu-tema'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'lugares'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 6,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-location',
        'show_in_rest'        => true,
    );

    register_post_type('xativa_place', $args);
}

// Registrar taxonomías para lugares
function register_xativa_taxonomies() {
    // Categorías para lugares
    $labels = array(
        'name'              => _x('Categorías de Lugares', 'taxonomy general name', 'tu-tema'),
        'singular_name'     => _x('Categoría de Lugar', 'taxonomy singular name', 'tu-tema'),
        'search_items'      => __('Buscar Categorías', 'tu-tema'),
        'all_items'         => __('Todas las Categorías', 'tu-tema'),
        'parent_item'       => __('Categoría Padre', 'tu-tema'),
        'parent_item_colon' => __('Categoría Padre:', 'tu-tema'),
        'edit_item'         => __('Editar Categoría', 'tu-tema'),
        'update_item'       => __('Actualizar Categoría', 'tu-tema'),
        'add_new_item'      => __('Añadir Nueva Categoría', 'tu-tema'),
        'new_item_name'     => __('Nuevo Nombre de Categoría', 'tu-tema'),
        'menu_name'         => __('Categorías', 'tu-tema'),
    );

    register_taxonomy('place_category', array('xativa_place'), array(
        'hierarchical'      => true,
        'labels'           => $labels,
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'tipo-lugar'),
        'show_in_rest'     => true,
    ));
}

// Registrar los post types y taxonomías
add_action('init', 'register_xativa_route_post_type');
add_action('init', 'register_xativa_place_post_type');
add_action('init', 'register_xativa_taxonomies');

// Configurar página de opciones de ACF
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'    => 'Configuración del Tema',
        'menu_title'    => 'Configuración del Tema',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

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

// Agregar soporte para el editor de bloques
add_theme_support('wp-block-styles');
add_theme_support('responsive-embeds');
add_theme_support('align-wide'); 