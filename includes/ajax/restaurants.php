<?php
/**
 * Manejadores AJAX para filtros de restaurantes
 */

// Agregar la acción para usuarios no logueados
add_action('wp_ajax_nopriv_filter_restaurants', 'filter_restaurants_ajax');
// Agregar la acción para usuarios logueados
add_action('wp_ajax_filter_restaurants', 'filter_restaurants_ajax');

function filter_restaurants_ajax() {
    $category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
    
    $args = array(
        'post_type' => 'xativa_restaurant',
        'posts_per_page' => -1,
    );

    if (!empty($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'restaurant_category',
                'field' => 'slug',
                'terms' => $category,
            ),
        );
    }

    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            include(locate_template('template-parts/restaurant-card.php'));
        }
        wp_reset_postdata();
    } else {
        echo '<div class="col-span-full text-center py-8 text-[#4e7097] w-full">';
        _e('No se encontraron restaurantes.', 'tu-tema');
        echo '</div>';
    }

    die();
} 