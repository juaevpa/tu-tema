<?php
/**
 * Funciones para enriquecer el contenido del sitio
 */

function enrich_content_with_images($post_type, $search_suffix = '') {
    $places = get_posts(array(
        'post_type' => $post_type,
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ));

    echo "Encontrados " . count($places) . " elementos para procesar...\n";

    foreach ($places as $place) {
        echo "Procesando: " . $place->post_title . "\n";

        // Primero eliminamos la imagen destacada si es el icono de Google
        if (has_post_thumbnail($place->ID)) {
            $thumbnail_id = get_post_thumbnail_id($place->ID);
            $image_url = wp_get_attachment_url($thumbnail_id);
            
            if (strpos($image_url, 'gstatic.com') !== false || 
                strpos($image_url, 'icon') !== false || 
                strpos($image_url, 'favicon') !== false) {
                delete_post_thumbnail($place->ID);
                wp_delete_attachment($thumbnail_id, true);
                echo "- Eliminada imagen basura anterior\n";
            }
        }

        // Ahora buscamos una nueva imagen
        if (!has_post_thumbnail($place->ID)) {
            echo "- Buscando nueva imagen...\n";
            
            $search_query = urlencode($place->post_title . ' ' . $search_suffix);
            $url = "https://www.bing.com/images/search?q={$search_query}&qft=+filterui:imagesize-large";
            
            $response = wp_remote_get($url, array(
                'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'headers' => array(
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Language' => 'es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3',
                )
            ));
            
            if (!is_wp_error($response)) {
                $body = wp_remote_retrieve_body($response);
                preg_match_all('/murl&quot;:&quot;(https?:\/\/[^&]+\.(?:jpg|jpeg|png))/', $body, $matches);
                
                if (!empty($matches[1])) {
                    $valid_images = array_filter($matches[1], function($url) {
                        return !strpos($url, 'icon') && 
                               !strpos($url, 'favicon') &&
                               strlen($url) > 50;
                    });

                    foreach ($valid_images as $image_url) {
                        echo "- Intentando con imagen: " . $image_url . "\n";
                        
                        require_once(ABSPATH . 'wp-admin/includes/media.php');
                        require_once(ABSPATH . 'wp-admin/includes/file.php');
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        
                        $upload = media_sideload_image($image_url, $place->ID, $place->post_title, 'id');
                        
                        if (!is_wp_error($upload)) {
                            $image_data = wp_get_attachment_image_src($upload, 'full');
                            if ($image_data && $image_data[1] >= 400 && $image_data[2] >= 300) {
                                set_post_thumbnail($place->ID, $upload);
                                echo "✅ Imagen añadida exitosamente para: {$place->post_title}\n";
                                break;
                            } else {
                                wp_delete_attachment($upload, true);
                                echo "- Imagen demasiado pequeña, eliminando...\n";
                            }
                        } else {
                            echo "❌ Error al subir la imagen: " . $upload->get_error_message() . "\n";
                        }
                    }
                } else {
                    echo "- No se encontraron imágenes válidas para este lugar\n";
                }
            }
            
            sleep(2);
        }
        
        echo "-------------------\n";
    }
    
    echo "Proceso completado.\n";
}

// Función específica para lugares de Xàtiva
function add_real_photos_to_explore_places() {
    enrich_content_with_images('xativa_explore', 'Xàtiva monumento');
} 