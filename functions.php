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

// Registrar taxonomías para rutas
function register_route_taxonomies() {
    // Dificultad
    register_taxonomy('route_difficulty', 'xativa_route', array(
        'hierarchical'      => true,
        'labels'           => array(
            'name'              => _x('Dificultades', 'taxonomy general name', 'tu-tema'),
            'singular_name'     => _x('Dificultad', 'taxonomy singular name', 'tu-tema'),
            'search_items'      => __('Buscar Dificultades', 'tu-tema'),
            'all_items'         => __('Todas las Dificultades', 'tu-tema'),
            'parent_item'       => __('Dificultad Padre', 'tu-tema'),
            'parent_item_colon' => __('Dificultad Padre:', 'tu-tema'),
            'edit_item'         => __('Editar Dificultad', 'tu-tema'),
            'update_item'       => __('Actualizar Dificultad', 'tu-tema'),
            'add_new_item'      => __('Añadir Nueva Dificultad', 'tu-tema'),
            'new_item_name'     => __('Nueva Dificultad', 'tu-tema'),
            'menu_name'         => __('Dificultad', 'tu-tema'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'dificultad'),
        'show_in_rest'      => true,
    ));

    // Tipo de ruta
    register_taxonomy('route_type', 'xativa_route', array(
        'hierarchical'      => true,
        'labels'           => array(
            'name'              => _x('Tipos de Ruta', 'taxonomy general name', 'tu-tema'),
            'singular_name'     => _x('Tipo de Ruta', 'taxonomy singular name', 'tu-tema'),
            'search_items'      => __('Buscar Tipos', 'tu-tema'),
            'all_items'         => __('Todos los Tipos', 'tu-tema'),
            'parent_item'       => __('Tipo Padre', 'tu-tema'),
            'parent_item_colon' => __('Tipo Padre:', 'tu-tema'),
            'edit_item'         => __('Editar Tipo', 'tu-tema'),
            'update_item'       => __('Actualizar Tipo', 'tu-tema'),
            'add_new_item'      => __('Añadir Nuevo Tipo', 'tu-tema'),
            'new_item_name'     => __('Nuevo Tipo', 'tu-tema'),
            'menu_name'         => __('Tipo de Ruta', 'tu-tema'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'tipo'),
        'show_in_rest'      => true,
    ));

    // Paisaje
    register_taxonomy('route_scenery', 'xativa_route', array(
        'hierarchical'      => true,
        'labels'           => array(
            'name'              => _x('Paisajes', 'taxonomy general name', 'tu-tema'),
            'singular_name'     => _x('Paisaje', 'taxonomy singular name', 'tu-tema'),
            'search_items'      => __('Buscar Paisajes', 'tu-tema'),
            'all_items'         => __('Todos los Paisajes', 'tu-tema'),
            'parent_item'       => __('Paisaje Padre', 'tu-tema'),
            'parent_item_colon' => __('Paisaje Padre:', 'tu-tema'),
            'edit_item'         => __('Editar Paisaje', 'tu-tema'),
            'update_item'       => __('Actualizar Paisaje', 'tu-tema'),
            'add_new_item'      => __('Añadir Nuevo Paisaje', 'tu-tema'),
            'new_item_name'     => __('Nuevo Paisaje', 'tu-tema'),
            'menu_name'         => __('Paisaje', 'tu-tema'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'paisaje'),
        'show_in_rest'      => true,
    ));

    // Crear términos por defecto
    $default_terms = array(
        'route_difficulty' => array(
            'facil' => 'Fácil',
            'moderada' => 'Moderada',
            'dificil' => 'Difícil',
            'muy-dificil' => 'Muy Difícil'
        ),
        'route_type' => array(
            'montana' => 'Montaña',
            'carretera' => 'Carretera',
            'mixta' => 'Mixta',
            'gravel' => 'Gravel'
        ),
        'route_scenery' => array(
            'montanoso' => 'Montañoso',
            'urbano' => 'Urbano',
            'rural' => 'Rural',
            'bosque' => 'Bosque',
            'rio' => 'Río'
        )
    );

    // Insertar los términos
    foreach ($default_terms as $taxonomy => $terms) {
        foreach ($terms as $slug => $name) {
            if (!term_exists($slug, $taxonomy)) {
                wp_insert_term($name, $taxonomy, array('slug' => $slug));
            }
        }
    }
}

// Registrar las taxonomías en init con prioridad 0 (antes que otros hooks de init)
add_action('init', 'register_route_taxonomies', 0);

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

// Cargar scripts y estilos
function tu_tema_scripts() {
    // Solo cargar el script en el archivo de rutas
    if (is_post_type_archive('xativa_route')) {
        wp_enqueue_script('tu-tema-routes', get_template_directory_uri() . '/assets/js/routes.js', array(), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'tu_tema_scripts');

// Crear términos por defecto para las taxonomías
function create_default_terms() {
    // Términos para Dificultad
    $difficulty_terms = array(
        'facil' => array(
            'name' => 'Fácil',
            'description' => 'Rutas sin dificultad técnica significativa'
        ),
        'moderada' => array(
            'name' => 'Moderada',
            'description' => 'Rutas con alguna dificultad técnica'
        ),
        'dificil' => array(
            'name' => 'Difícil',
            'description' => 'Rutas con dificultad técnica considerable'
        ),
        'muy-dificil' => array(
            'name' => 'Muy Difícil',
            'description' => 'Rutas con alta dificultad técnica'
        )
    );

    // Términos para Tipo de Ruta
    $type_terms = array(
        'montana' => array(
            'name' => 'Montaña',
            'description' => 'Rutas por terreno montañoso'
        ),
        'carretera' => array(
            'name' => 'Carretera',
            'description' => 'Rutas por carretera asfaltada'
        ),
        'mixta' => array(
            'name' => 'Mixta',
            'description' => 'Combinación de diferentes tipos de terreno'
        ),
        'gravel' => array(
            'name' => 'Gravel',
            'description' => 'Rutas por caminos de grava y tierra compactada'
        )
    );

    // Términos para Paisaje
    $scenery_terms = array(
        'montanoso' => array(
            'name' => 'Montañoso',
            'description' => 'Paisajes de montaña y sierra'
        ),
        'urbano' => array(
            'name' => 'Urbano',
            'description' => 'Rutas por zonas urbanas'
        ),
        'rural' => array(
            'name' => 'Rural',
            'description' => 'Paisajes rurales y agrícolas'
        ),
        'bosque' => array(
            'name' => 'Bosque',
            'description' => 'Rutas a través de zonas boscosas'
        ),
        'rio' => array(
            'name' => 'Río',
            'description' => 'Rutas cercanas a ríos'
        )
    );

    // Crear términos para cada taxonomía
    foreach ($difficulty_terms as $slug => $term) {
        if (!term_exists($slug, 'route_difficulty')) {
            wp_insert_term(
                $term['name'],
                'route_difficulty',
                array(
                    'slug' => $slug,
                    'description' => $term['description']
                )
            );
        }
    }

    foreach ($type_terms as $slug => $term) {
        if (!term_exists($slug, 'route_type')) {
            wp_insert_term(
                $term['name'],
                'route_type',
                array(
                    'slug' => $slug,
                    'description' => $term['description']
                )
            );
        }
    }

    foreach ($scenery_terms as $slug => $term) {
        if (!term_exists($slug, 'route_scenery')) {
            wp_insert_term(
                $term['name'],
                'route_scenery',
                array(
                    'slug' => $slug,
                    'description' => $term['description']
                )
            );
        }
    }
}

// Ejecutar la creación de términos cuando se active el tema
add_action('after_switch_theme', 'create_default_terms');

// También ejecutar la creación de términos cuando se registren las taxonomías
// (esto es útil durante el desarrollo)
add_action('init', 'create_default_terms', 20);
  