<?php
/**
 * Registro de Taxonomías
 *
 * @package Tu_Tema
 */

// Mover estos hooks al principio del archivo, justo después de los comentarios iniciales
add_action('init', 'register_route_taxonomies', 5);
add_action('init', 'register_explore_taxonomies', 5);
add_action('init', 'register_restaurant_taxonomies', 5);
add_action('init', 'register_hotel_taxonomies', 5);

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

// Registrar taxonomía para categorías de exploración
function register_explore_taxonomies() {
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

// Registrar taxonomía para categorías de restaurantes
function register_restaurant_taxonomies() {
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

    register_taxonomy('restaurant_category', 'xativa_restaurant', array(
        'hierarchical'      => true,
        'labels'           => $tax_labels,
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'categoria-restaurante'),
        'show_in_rest'     => true,
    ));
}

// Registrar taxonomía para categorías de hoteles
function register_hotel_taxonomies() {
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

    register_taxonomy('hotel_category', 'xativa_hotel', array(
        'hierarchical'      => true,
        'labels'           => $tax_labels,
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'categoria-hotel'),
        'show_in_rest'     => true,
    ));

    // Servicios para ciclistas
    register_taxonomy('hotel_bike_services', 'xativa_hotel', array(
        'hierarchical'      => true,
        'labels'           => array(
            'name'              => _x('Servicios Ciclistas', 'taxonomy general name', 'tu-tema'),
            'singular_name'     => _x('Servicio Ciclista', 'taxonomy singular name', 'tu-tema'),
            'menu_name'         => __('Servicios Ciclistas', 'tu-tema'),
        ),
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'servicios-ciclistas'),
        'show_in_rest'     => true,
    ));

    // Rango de precios
    register_taxonomy('hotel_price_range', 'xativa_hotel', array(
        'hierarchical'      => true,
        'labels'           => array(
            'name'              => _x('Rango de Precios', 'taxonomy general name', 'tu-tema'),
            'singular_name'     => _x('Rango de Precio', 'taxonomy singular name', 'tu-tema'),
            'menu_name'         => __('Rango de Precios', 'tu-tema'),
        ),
        'show_ui'          => true,
        'show_admin_column' => true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'rango-precio'),
        'show_in_rest'     => true,
    ));
}

// Crear términos por defecto
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

    // Términos para categorías de exploración
    $explore_terms = array(
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

    foreach ($explore_terms as $slug => $term) {
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

// Hooks
add_action('init', 'register_route_taxonomies');
add_action('init', 'register_explore_taxonomies');
add_action('after_switch_theme', 'create_default_terms');
add_action('init', 'create_default_terms', 20); 