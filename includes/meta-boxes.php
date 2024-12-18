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