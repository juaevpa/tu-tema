<?php
/**
 * Gestión de Meta Boxes
 */

function register_custom_meta_boxes() {
    // Meta box para lugares de exploración
    add_meta_box(
        'explore_meta_box',
        __('Detalles del Lugar', 'tu-tema'),
        'display_explore_meta_box',
        'xativa_explore',
        'normal',
        'high'
    );
    
    // Aquí otros meta boxes...
}
add_action('add_meta_boxes', 'register_custom_meta_boxes');

// Funciones de display y guardado de meta boxes... 

function add_restaurant_coordinates_meta_box() {
    add_meta_box(
        'restaurant_coordinates',
        __('Coordenadas del Restaurante', 'tu-tema'),
        'render_restaurant_coordinates_meta_box',
        'xativa_restaurant',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_restaurant_coordinates_meta_box');

function render_restaurant_coordinates_meta_box($post) {
    $lat = get_post_meta($post->ID, 'latitude', true);
    $lng = get_post_meta($post->ID, 'longitude', true);
    
    wp_nonce_field('restaurant_coordinates_meta_box', 'restaurant_coordinates_nonce');
    ?>
    <div class="restaurant-coordinates">
        <p>
            <label for="latitude"><?php _e('Latitud:', 'tu-tema'); ?></label>
            <input type="text" id="latitude" name="latitude" value="<?php echo esc_attr($lat); ?>" class="widefat">
        </p>
        <p>
            <label for="longitude"><?php _e('Longitud:', 'tu-tema'); ?></label>
            <input type="text" id="longitude" name="longitude" value="<?php echo esc_attr($lng); ?>" class="widefat">
        </p>
    </div>
    <?php
}

function save_restaurant_coordinates($post_id) {
    if (!isset($_POST['restaurant_coordinates_nonce']) || 
        !wp_verify_nonce($_POST['restaurant_coordinates_nonce'], 'restaurant_coordinates_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (isset($_POST['latitude'])) {
        update_post_meta($post_id, 'latitude', sanitize_text_field($_POST['latitude']));
    }
    if (isset($_POST['longitude'])) {
        update_post_meta($post_id, 'longitude', sanitize_text_field($_POST['longitude']));
    }
}
add_action('save_post_xativa_restaurant', 'save_restaurant_coordinates');

function add_hotel_meta_boxes() {
    add_meta_box(
        'hotel_details',
        __('Detalles del Hotel', 'tu-tema'),
        'render_hotel_meta_box',
        'xativa_hotel',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_hotel_meta_boxes');

function render_hotel_meta_box($post) {
    // Obtener valores guardados
    $address = get_post_meta($post->ID, 'address', true);
    $phone = get_post_meta($post->ID, 'phone', true);
    $website = get_post_meta($post->ID, 'website', true);
    $lat = get_post_meta($post->ID, 'latitude', true);
    $lng = get_post_meta($post->ID, 'longitude', true);
    $rating = get_post_meta($post->ID, 'rating', true);
    
    wp_nonce_field('hotel_meta_box', 'hotel_meta_box_nonce');
    ?>
    <div class="hotel-meta-fields">
        <p>
            <label for="rating"><?php _e('Valoración:', 'tu-tema'); ?></label>
            <input type="number" 
                   id="rating" 
                   name="rating" 
                   value="<?php echo esc_attr($rating); ?>" 
                   min="0" 
                   max="5" 
                   step="0.1" 
                   class="widefat">
        </p>
        <p>
            <label for="address"><?php _e('Dirección:', 'tu-tema'); ?></label>
            <input type="text" id="address" name="address" value="<?php echo esc_attr($address); ?>" class="widefat">
        </p>
        <p>
            <label for="phone"><?php _e('Teléfono:', 'tu-tema'); ?></label>
            <input type="tel" id="phone" name="phone" value="<?php echo esc_attr($phone); ?>" class="widefat">
        </p>
        <p>
            <label for="website"><?php _e('Sitio Web:', 'tu-tema'); ?></label>
            <input type="url" id="website" name="website" value="<?php echo esc_url($website); ?>" class="widefat">
        </p>
        <p>
            <label for="latitude"><?php _e('Latitud:', 'tu-tema'); ?></label>
            <input type="text" id="latitude" name="latitude" value="<?php echo esc_attr($lat); ?>" class="widefat">
        </p>
        <p>
            <label for="longitude"><?php _e('Longitud:', 'tu-tema'); ?></label>
            <input type="text" id="longitude" name="longitude" value="<?php echo esc_attr($lng); ?>" class="widefat">
        </p>
    </div>
    <?php
}

// Registrar meta box para valoraciones
function registrar_meta_box_valoracion() {
    add_meta_box(
        'valoracion_hotel',
        'Valoración del Hotel',
        'mostrar_meta_box_valoracion',
        'xativa_hotel',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'registrar_meta_box_valoracion');

function mostrar_meta_box_valoracion($post) {
    $rating = get_post_meta($post->ID, 'rating', true);
    ?>
    <div>
        <label for="rating">Valoración (sobre 5):</label>
        <input 
            type="number" 
            id="rating" 
            name="rating" 
            value="<?php echo esc_attr($rating); ?>" 
            min="0" 
            max="5" 
            step="0.1" 
            style="width: 70px;"
        >
    </div>
    <?php
}

// Guardar el valor del meta box
function guardar_meta_box_valoracion($post_id) {
    if (array_key_exists('rating', $_POST)) {
        update_post_meta($post_id, 'rating', sanitize_text_field($_POST['rating']));
    }
}
add_action('save_post_xativa_hotel', 'guardar_meta_box_valoracion');

function save_hotel_meta_box($post_id) {
    // Verificar el nonce
    if (!isset($_POST['hotel_meta_box_nonce']) || 
        !wp_verify_nonce($_POST['hotel_meta_box_nonce'], 'hotel_meta_box')) {
        return;
    }
    
    // Si es autoguardado, no hacer nada
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Verificar permisos
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Guardar los campos
    if (isset($_POST['address'])) {
        update_post_meta($post_id, 'address', sanitize_text_field($_POST['address']));
    }
    if (isset($_POST['phone'])) {
        update_post_meta($post_id, 'phone', sanitize_text_field($_POST['phone']));
    }
    if (isset($_POST['website'])) {
        update_post_meta($post_id, 'website', esc_url_raw($_POST['website']));
    }
    if (isset($_POST['latitude'])) {
        update_post_meta($post_id, 'latitude', sanitize_text_field($_POST['latitude']));
    }
    if (isset($_POST['longitude'])) {
        update_post_meta($post_id, 'longitude', sanitize_text_field($_POST['longitude']));
    }
    if (isset($_POST['rating'])) {
        update_post_meta($post_id, 'rating', floatval($_POST['rating']));
    }
}
add_action('save_post_xativa_hotel', 'save_hotel_meta_box');