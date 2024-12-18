<?php
/**
 * Plantilla para mostrar un restaurante individual
 *
 * @package Tu_Tema
 */

get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('max-w-7xl mx-auto px-4 py-8'); ?>>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <header class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4"><?php the_title(); ?></h1>
            
            <?php
            // Mostrar categorías del restaurante
            $categories = get_the_terms(get_the_ID(), 'restaurant_category');
            if ($categories && !is_wp_error($categories)) : ?>
                <div class="mb-4">
                    <?php foreach ($categories as $category) : ?>
                        <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                            <?php echo esc_html($category->name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="restaurant-gallery">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="mb-4 rounded-lg overflow-hidden">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-auto')); ?>
                    </div>
                <?php endif; ?>
                
                <?php
                // Aquí puedes añadir más imágenes si usas un campo personalizado para galería
                ?>
            </div>

            <div class="restaurant-info">
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-semibold mb-4"><?php _e('Información del Restaurante', 'tu-tema'); ?></h2>
                    
                    <?php
                    // Aquí puedes añadir campos personalizados como:
                    // - Dirección
                    // - Teléfono
                    // - Email
                    // - Sitio web
                    // - Horario de apertura
                    // - Tipo de cocina
                    // - Rango de precios
                    // etc.
                    ?>
                    
                    <div class="prose max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-2xl font-semibold mb-4"><?php _e('Menú', 'tu-tema'); ?></h2>
                    <?php
                    // Aquí puedes añadir información del menú si usas campos personalizados
                    ?>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4"><?php _e('Ubicación', 'tu-tema'); ?></h2>
                    <?php
                    // Aquí puedes añadir un mapa si usas un campo personalizado para la ubicación
                    ?>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4"><?php _e('Restaurantes Relacionados', 'tu-tema'); ?></h2>
            <?php
            // Consulta para restaurantes relacionados
            $related_args = array(
                'post_type' => 'xativa_restaurant',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand'
            );

            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="aspect-w-16 aspect-h-9">
                                    <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover')); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-2">
                                    <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-primary">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="text-gray-600">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata();
            endif; ?>
        </div>

    <?php endwhile; endif; ?>
</article>

<script>
function initMaps() {
    document.querySelectorAll('.google-map').forEach(function(mapDiv) {
        const lat = parseFloat(mapDiv.dataset.lat);
        const lng = parseFloat(mapDiv.dataset.lng);
        
        const map = new google.maps.Map(mapDiv, {
            center: { lat, lng },
            zoom: 15
        });

        new google.maps.Marker({
            position: { lat, lng },
            map: map
        });
    });
}
</script>

<?php get_footer(); ?> 