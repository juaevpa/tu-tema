<?php
/**
 * Gestión de Meta Boxes
 *
 * @package Tu_Tema
 */

// Meta boxes para lugares de exploración
function register_custom_meta_boxes() {
    add_meta_box(
        'explore_meta_box',
        __('Detalles del Lugar', 'tu-tema'),
        'display_explore_meta_box',
        'xativa_explore',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'register_custom_meta_boxes');

// Meta box para coordenadas de restaurantes
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
            <input type="text" id="latitude" name="latitude" value="<?php echo esc_attr($lat); ?>">
        </p>
        <p>
            <label for="longitude"><?php _e('Longitud:', 'tu-tema'); ?></label>
            <input type="text" id="longitude" name="longitude" value="<?php echo esc_attr($lng); ?>">
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

// Meta box para valoraciones de hoteles
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

function guardar_meta_box_valoracion($post_id) {
    if (array_key_exists('rating', $_POST)) {
        update_post_meta($post_id, 'rating', sanitize_text_field($_POST['rating']));
    }
}
add_action('save_post_xativa_hotel', 'guardar_meta_box_valoracion');

// Función para mostrar el meta box de lugares de exploración
function display_explore_meta_box($post) {
    // Obtener valores guardados
    $address = get_post_meta($post->ID, 'address', true);
    $latitude = get_post_meta($post->ID, 'latitude', true);
    $longitude = get_post_meta($post->ID, 'longitude', true);
    $historical_period = get_post_meta($post->ID, 'historical_period', true);
    $square_size = get_post_meta($post->ID, 'square_size', true);
    
    // Nonce para seguridad
    wp_nonce_field('explore_meta_box', 'explore_meta_box_nonce');
    ?>
    <div class="explore-meta-fields">
        <p>
            <label for="address"><?php _e('Dirección:', 'tu-tema'); ?></label>
            <input type="text" id="address" name="address" value="<?php echo esc_attr($address); ?>" class="widefat">
        </p>
        <p>
            <label for="latitude"><?php _e('Latitud:', 'tu-tema'); ?></label>
            <input type="text" id="latitude" name="latitude" value="<?php echo esc_attr($latitude); ?>" class="widefat">
        </p>
        <p>
            <label for="longitude"><?php _e('Longitud:', 'tu-tema'); ?></label>
            <input type="text" id="longitude" name="longitude" value="<?php echo esc_attr($longitude); ?>" class="widefat">
        </p>
        <p>
            <label for="historical_period"><?php _e('Período Histórico:', 'tu-tema'); ?></label>
            <input type="text" id="historical_period" name="historical_period" value="<?php echo esc_attr($historical_period); ?>" class="widefat">
        </p>
        <p>
            <label for="square_size"><?php _e('Tamaño del Espacio:', 'tu-tema'); ?></label>
            <input type="text" id="square_size" name="square_size" value="<?php echo esc_attr($square_size); ?>" class="widefat">
        </p>
    </div>
    <?php
}

// Guardar los datos del meta box de lugares de exploración
function save_explore_meta_box($post_id) {
    // Verificar nonce
    if (!isset($_POST['explore_meta_box_nonce']) || 
        !wp_verify_nonce($_POST['explore_meta_box_nonce'], 'explore_meta_box')) {
        return;
    }

    // Verificar autoguardado
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Verificar permisos
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Guardar campos
    $fields = array('address', 'latitude', 'longitude', 'historical_period', 'square_size');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
} 