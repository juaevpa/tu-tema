<?php

function get_chat_assistant_response($query) {
    $query = strtolower(trim($query));
    
    // Detectar intención
    if (strpos($query, 'comer') !== false || strpos($query, 'restaurante') !== false) {
        return get_restaurant_response($query);
    } elseif (strpos($query, 'dormir') !== false || strpos($query, 'alojamiento') !== false || strpos($query, 'hotel') !== false) {
        return get_hotel_response($query);
    } elseif (strpos($query, 'ruta') !== false || strpos($query, 'cicli') !== false || strpos($query, 'bici') !== false) {
        return get_route_response($query);
    } elseif (strpos($query, 'visitar') !== false || strpos($query, 'ver') !== false || strpos($query, 'explorar') !== false) {
        return get_explore_response($query);
    }

    return array(
        'message' => '¿Qué te gustaría saber específicamente?',
        'options' => array(
            'Restaurantes y gastronomía',
            'Alojamientos disponibles',
            'Rutas ciclistas',
            'Lugares para visitar'
        )
    );
}

function get_restaurant_response($query) {
    // Si el usuario quiere ver más
    if (strpos(strtolower($query), 'ver más restaurantes') !== false && isset($_POST['context'])) {
        $context = json_decode(stripslashes($_POST['context']), true);
        $offset = $context['offset'] ?? 0;
        
        $args = array(
            'post_type' => 'xativa_restaurant',
            'posts_per_page' => 3,
            'offset' => $offset,
            'orderby' => 'date',
            'order' => 'DESC'
        );

        // Si hay una categoría en el contexto, la usamos
        if (isset($context['category'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'restaurant_category',
                    'field' => 'slug',
                    'terms' => $context['category']
                )
            );
        }

        $restaurants = get_posts($args);
        
        if (!empty($restaurants)) {
            $response = "Aquí tienes más restaurantes:<br><br>";
            foreach ($restaurants as $restaurant) {
                $rating = get_post_meta($restaurant->ID, 'rating', true);
                $address = get_post_meta($restaurant->ID, 'address', true);
                $permalink = get_permalink($restaurant->ID);
                
                $response .= "<div class='mb-4'>";
                $response .= "<a href='{$permalink}' class='text-[#1979e6] hover:underline font-medium'>";
                $response .= "🍽️ " . $restaurant->post_title . "</a><br>";
                if ($rating) $response .= "⭐ Valoración: $rating/5<br>";
                if ($address) $response .= "📍 $address<br>";
                $response .= "</div>";
            }
            
            return array(
                'message' => $response,
                'options' => array(
                    'Ver más restaurantes',
                    'Necesito otras recomendaciones'
                ),
                'context' => array(
                    'offset' => $offset + 3,
                    'category' => $context['category'] ?? null
                )
            );
        }
    }

    $categories = get_terms(array(
        'taxonomy' => 'restaurant_category',
        'hide_empty' => false
    ));

    if (!contains_restaurant_category($query, $categories)) {
        $category_options = array_map(function($category) {
            return "Restaurantes de " . $category->name;
        }, $categories);
        
        return array(
            'message' => '¿Qué tipo de restaurante te interesa?',
            'options' => $category_options
        );
    }

    $category_slug = get_mentioned_category_slug($query, $categories);
    $args = array(
        'post_type' => 'xativa_restaurant',
        'posts_per_page' => 3,
        'tax_query' => array(
            array(
                'taxonomy' => 'restaurant_category',
                'field' => 'slug',
                'terms' => $category_slug
            )
        )
    );

    $restaurants = get_posts($args);
    
    if (empty($restaurants)) {
        return array(
            'message' => 'No encontré restaurantes de ese tipo. ¿Te gustaría ver otras opciones?',
            'options' => array('Ver todos los restaurantes', 'Buscar otro tipo de restaurante')
        );
    }

    $response = "He encontrado estos restaurantes que podrían interesarte:<br><br>";
    foreach ($restaurants as $restaurant) {
        $rating = get_post_meta($restaurant->ID, 'rating', true);
        $address = get_post_meta($restaurant->ID, 'address', true);
        $permalink = get_permalink($restaurant->ID);
        
        $response .= "<div class='mb-4'>";
        $response .= "<a href='{$permalink}' class='text-[#1979e6] hover:underline font-medium'>";
        $response .= "🍽️ " . $restaurant->post_title . "</a><br>";
        if ($rating) $response .= "⭐ Valoración: $rating/5<br>";
        if ($address) $response .= "📍 $address<br>";
        $response .= "</div>";
    }

    return array(
        'message' => $response,
        'options' => array(
            'Ver más restaurantes',
            'Buscar otro tipo de restaurante',
            'Necesito otras recomendaciones'
        ),
        'context' => array(
            'offset' => 3,
            'category' => $category_slug
        )
    );
}

function get_hotel_response($query) {
    $args = array(
        'post_type' => 'xativa_hotel',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $hotels = get_posts($args);
    
    if (empty($hotels)) {
        return array(
            'message' => 'Lo siento, no encontré alojamientos disponibles.',
            'options' => array('Ver otras opciones', 'Necesito otra información')
        );
    }

    $response = "Aquí tienes algunos alojamientos recomendados:\n\n";
    foreach ($hotels as $hotel) {
        $rating = get_post_meta($hotel->ID, 'rating', true);
        $address = get_post_meta($hotel->ID, 'address', true);
        $permalink = get_permalink($hotel->ID);
        
        $response .= "<a href='{$permalink}' class='text-[#1979e6] hover:text-[#1565c0]'>";
        $response .= "🏨 " . $hotel->post_title . "</a>\n";
        if ($rating) $response .= "⭐ Valoración: $rating/5\n";
        if ($address) $response .= "📍 $address\n\n";
    }

    return array(
        'message' => $response,
        'options' => array(
            'Ver más alojamientos',
            'Buscar otra información'
        )
    );
}

function get_route_response($query) {
    $args = array(
        'post_type' => 'xativa_route',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $routes = get_posts($args);
    
    if (empty($routes)) {
        return array(
            'message' => 'Lo siento, no encontré rutas disponibles.',
            'options' => array('Ver otras opciones', 'Necesito otra información')
        );
    }

    $response = "Te sugiero estas rutas ciclistas:\n\n";
    foreach ($routes as $route) {
        $distance = get_post_meta($route->ID, 'distance', true);
        $difficulty = get_post_meta($route->ID, 'difficulty', true);
        $permalink = get_permalink($route->ID);
        
        $response .= "<a href='{$permalink}' class='text-[#1979e6] hover:text-[#1565c0]'>";
        $response .= "🚴 " . $route->post_title . "</a>\n";
        if ($distance) $response .= "📏 Distancia: $distance km\n";
        if ($difficulty) $response .= "📊 Dificultad: $difficulty\n\n";
    }

    return array(
        'message' => $response,
        'options' => array(
            'Ver más rutas',
            'Buscar otra información'
        )
    );
}

function get_explore_response($query) {
    $args = array(
        'post_type' => 'xativa_explore',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $places = get_posts($args);
    
    if (empty($places)) {
        return array(
            'message' => 'Lo siento, no encontré lugares para visitar.',
            'options' => array('Ver otras opciones', 'Necesito otra información')
        );
    }

    $response = "Estos lugares de interés te pueden gustar:\n\n";
    foreach ($places as $place) {
        $category = get_the_terms($place->ID, 'explore_category');
        $address = get_post_meta($place->ID, 'address', true);
        $permalink = get_permalink($place->ID);
        
        $response .= "<a href='{$permalink}' class='text-[#1979e6] hover:text-[#1565c0]'>";
        $response .= "🏛️ " . $place->post_title . "</a>\n";
        if ($category) $response .= "📍 Categoría: " . $category[0]->name . "\n";
        if ($address) $response .= "📍 $address\n\n";
    }

    return array(
        'message' => $response,
        'options' => array(
            'Ver más lugares',
            'Buscar otra información'
        )
    );
}

// Funciones auxiliares existentes...

// Funciones auxiliares
function contains_restaurant_category($query, $categories) {
    foreach ($categories as $category) {
        if (strpos(strtolower($query), strtolower($category->name)) !== false) {
            return true;
        }
    }
    return false;
}

function get_mentioned_category_slug($query, $categories) {
    foreach ($categories as $category) {
        if (strpos(strtolower($query), strtolower($category->name)) !== false) {
            return $category->slug;
        }
    }
    return '';
}

// Endpoint AJAX
add_action('wp_ajax_chat_assistant_search', 'chat_assistant_search_callback');
add_action('wp_ajax_nopriv_chat_assistant_search', 'chat_assistant_search_callback');

function chat_assistant_search_callback() {
    check_ajax_referer('chat_assistant_nonce', 'nonce');
    
    $query = sanitize_text_field($_POST['query']);
    $response = get_chat_assistant_response($query);
    
    wp_send_json_success($response);
} 