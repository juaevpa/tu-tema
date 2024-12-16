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

    // Registrar taxonomía para categorías de exploración
    $tax_labels = array(
        'name'              => _x('Categorías', 'taxonomy general name', 'tu-tema'),
        'singular_name'     => _x('Categoría', 'taxonomy singular name', 'tu-tema'),
        'search_items'      => __('Buscar Categorías', 'tu-tema'),
        'all_items'         => __('Todas las Categorías', 'tu-tema'),
        'parent_item'       => __('Categoría Padre', 'tu-tema'),
        'parent_item_colon' => __('Categoría Padre:', 'tu-tema'),
        'edit_item'         => __('Editar Categoría', 'tu-tema'),
        'update_item'       => __('Actualizar Categoría', 'tu-tema'),
        'add_new_item'      => __('Añadir Nueva Categoría', 'tu-tema'),
        'new_item_name'     => __('Nueva Categoría', 'tu-tema'),
        'menu_name'         => __('Categorías', 'tu-tema'),
    );

    register_taxonomy('explore_category', 'xativa_explore', array(
        'hierarchical'      => true,
        'labels'           => $tax_labels,
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'categoria-explorar'),
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
}

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

// Crear términos por defecto para la taxonomía de exploración
function create_default_explore_terms() {
    $default_terms = array(
        'historia' => array(
            'name' => 'Historia',
            'description' => 'Historia local de Xàtiva'
        ),
        'gastronomia' => array(
            'name' => 'Gastronomía',
            'description' => 'Gastronomía local de Xàtiva'
        ),
        'naturaleza' => array(
            'name' => 'Naturaleza',
            'description' => 'Entorno natural de Xàtiva'
        ),
        'cultura' => array(
            'name' => 'Cultura',
            'description' => 'Cultura y patrimonio de Xàtiva'
        )
    );

    foreach ($default_terms as $slug => $term) {
        if (!term_exists($slug, 'explore_category')) {
            wp_insert_term(
                $term['name'],
                'explore_category',
                array(
                    'slug' => $slug,
                    'description' => $term['description']
                )
            );
        }
    }
}

// Cargar scripts y estilos
function tu_tema_scripts() {
    // Solo cargar el script en el archivo de rutas
    if (is_post_type_archive('xativa_route')) {
        wp_enqueue_script('tu-tema-routes', get_template_directory_uri() . '/assets/js/routes.js', array(), '1.0', true);
    }
}

// Registrar los post types y taxonomías
add_action('init', 'register_xativa_route_post_type');
add_action('init', 'register_xativa_explore_post_type');
add_action('init', 'register_route_taxonomies');

// Ejecutar la creación de términos cuando se active el tema
add_action('after_switch_theme', 'create_default_terms');
add_action('after_switch_theme', 'create_default_explore_terms');

// También ejecutar la creación de términos durante el desarrollo
add_action('init', 'create_default_terms', 20);
add_action('init', 'create_default_explore_terms', 20);

// Cargar scripts
add_action('wp_enqueue_scripts', 'tu_tema_scripts');

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

// Desregistrar tipos de contenido antiguos
function unregister_old_post_types() {
    global $wp_post_types;
    
    $post_types_to_remove = array(
        'xativa_history',
        'xativa_gastronomy',
        'xativa_local_history',  // por si acaso existe con otro nombre
        'xativa_local_gastronomy'
    );

    foreach ($post_types_to_remove as $post_type) {
        if (post_type_exists($post_type)) {
            unregister_post_type($post_type);
        }
        // También eliminar del array global por si acaso
        if (isset($wp_post_types[$post_type])) {
            unset($wp_post_types[$post_type]);
        }
    }
}
// Usar prioridad alta (99) para asegurarnos de que se ejecuta después de que se registren
add_action('init', 'unregister_old_post_types', 99);

// Ocultar los menús de administración de los tipos de contenido antiguos
function remove_old_post_type_menus() {
    remove_menu_page('edit.php?post_type=xativa_history');
    remove_menu_page('edit.php?post_type=xativa_gastronomy');
    remove_menu_page('edit.php?post_type=xativa_local_history');
    remove_menu_page('edit.php?post_type=xativa_local_gastronomy');
}
add_action('admin_menu', 'remove_old_post_type_menus', 999);
  