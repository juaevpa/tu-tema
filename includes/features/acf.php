<?php
/**
 * Configuración de Advanced Custom Fields
 *
 * @package Tu_Tema
 */

// Verificar si ACF está activo
if (!function_exists('acf_add_local_field_group')) {
    return;
}

// Registrar campos personalizados para hoteles
acf_add_local_field_group(array(
    'key' => 'group_hotel_details',
    'title' => 'Detalles del Hotel',
    'fields' => array(
        array(
            'key' => 'field_hotel_address',
            'label' => 'Dirección',
            'name' => 'hotel_address',
            'type' => 'text',
            'required' => 1,
        ),
        array(
            'key' => 'field_hotel_phone',
            'label' => 'Teléfono',
            'name' => 'hotel_phone',
            'type' => 'text',
            'required' => 1,
        ),
        array(
            'key' => 'field_hotel_email',
            'label' => 'Email',
            'name' => 'hotel_email',
            'type' => 'email',
            'required' => 0,
        ),
        array(
            'key' => 'field_hotel_website',
            'label' => 'Sitio Web',
            'name' => 'hotel_website',
            'type' => 'url',
            'required' => 0,
        ),
        array(
            'key' => 'field_hotel_coordinates',
            'label' => 'Coordenadas',
            'name' => 'hotel_coordinates',
            'type' => 'google_map',
            'required' => 1,
            'center_lat' => '38.9889',
            'center_lng' => '-0.5209',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'xativa_hotel',
            ),
        ),
    ),
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
));

// Registrar campos personalizados para restaurantes
acf_add_local_field_group(array(
    'key' => 'group_restaurant_details',
    'title' => 'Detalles del Restaurante',
    'fields' => array(
        array(
            'key' => 'field_restaurant_address',
            'label' => 'Dirección',
            'name' => 'restaurant_address',
            'type' => 'text',
            'required' => 1,
        ),
        array(
            'key' => 'field_restaurant_phone',
            'label' => 'Teléfono',
            'name' => 'restaurant_phone',
            'type' => 'text',
            'required' => 1,
        ),
        array(
            'key' => 'field_restaurant_coordinates',
            'label' => 'Ubicación',
            'name' => 'restaurant_coordinates',
            'type' => 'google_map',
            'required' => 1,
            'center_lat' => '38.9889',
            'center_lng' => '-0.5209',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'xativa_restaurant',
            ),
        ),
    ),
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
)); 