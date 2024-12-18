<?php
/**
 * Registro de Custom Post Types
 *
 * @package Tu_Tema
 */

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

// Registrar tipo de contenido para Explorar Xàtiva
function register_xativa_explore_post_type() {
    $labels = array(
        'name'                  => _x('Explorar Xàtiva', 'Post type general name', 'tu-tema'),
        'singular_name'         => _x('Explorar', 'Post type singular name', 'tu-tema'),
        'menu_name'            => _x('Explorar Xàtiva', 'Admin Menu text', 'tu-tema'),
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
        'rewrite'             => array('slug' => 'explorar'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-location',
        'show_in_rest'        => true,
    );

    register_post_type('xativa_explore', $args);
}

// Registrar tipo de contenido personalizado para hoteles
function register_xativa_hotel_post_type() {
    $labels = array(
        'name'                  => _x('Hoteles', 'Post type general name', 'tu-tema'),
        'singular_name'         => _x('Hotel', 'Post type singular name', 'tu-tema'),
        'menu_name'            => _x('Hoteles', 'Admin Menu text', 'tu-tema'),
        'add_new'              => __('Añadir Nuevo', 'tu-tema'),
        'add_new_item'         => __('Añadir Nuevo Hotel', 'tu-tema'),
        'edit_item'            => __('Editar Hotel', 'tu-tema'),
        'new_item'             => __('Nuevo Hotel', 'tu-tema'),
        'view_item'            => __('Ver Hotel', 'tu-tema'),
        'search_items'         => __('Buscar Hoteles', 'tu-tema'),
        'not_found'            => __('No se encontraron hoteles', 'tu-tema'),
        'not_found_in_trash'   => __('No hay hoteles en la papelera', 'tu-tema'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'hoteles'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-building',
        'show_in_rest'        => true,
    );

    register_post_type('xativa_hotel', $args);
}

// Registrar tipo de contenido personalizado para restaurantes
function register_xativa_restaurant_post_type() {
    $labels = array(
        'name'                  => _x('Restaurantes', 'Post type general name', 'tu-tema'),
        'singular_name'         => _x('Restaurante', 'Post type singular name', 'tu-tema'),
        'menu_name'            => _x('Restaurantes', 'Admin Menu text', 'tu-tema'),
        'add_new'              => __('Añadir Nuevo', 'tu-tema'),
        'add_new_item'         => __('Añadir Nuevo Restaurante', 'tu-tema'),
        'edit_item'            => __('Editar Restaurante', 'tu-tema'),
        'new_item'             => __('Nuevo Restaurante', 'tu-tema'),
        'view_item'            => __('Ver Restaurante', 'tu-tema'),
        'search_items'         => __('Buscar Restaurantes', 'tu-tema'),
        'not_found'            => __('No se encontraron restaurantes', 'tu-tema'),
        'not_found_in_trash'   => __('No hay restaurantes en la papelera', 'tu-tema'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'restaurantes'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 5,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-restaurant',
        'show_in_rest'        => true,
    );

    register_post_type('xativa_restaurant', $args);
}

// Hooks para registrar los post types
add_action('init', 'register_xativa_route_post_type', 10);
add_action('init', 'register_xativa_explore_post_type', 10);
add_action('init', 'register_xativa_restaurant_post_type', 10);
add_action('init', 'register_xativa_hotel_post_type', 10);