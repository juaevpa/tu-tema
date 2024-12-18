<?php
/**
 * Plantilla para mostrar un hotel individual
 *
 * @package Tu_Tema
 */

get_header();

while (have_posts()) :
    the_post();
    $lat = get_post_meta(get_the_ID(), 'latitude', true);
    $lng = get_post_meta(get_the_ID(), 'longitude', true);
    ?>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Columna principal -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                    <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>

                <?php 
                $gallery = get_post_meta(get_the_ID(), 'hotel_gallery', true);
                if (!empty($gallery)): ?>
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                        <h2 class="text-2xl font-semibold mb-4"><?php _e('Galería de imágenes', 'tu-tema'); ?></h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <?php foreach ($gallery as $image_id): 
                                $image_url = wp_get_attachment_image_url($image_id, 'large');
                                $image_thumb = wp_get_attachment_image_url($image_id, 'medium');
                                if ($image_url && $image_thumb): ?>
                                    <a href="<?php echo esc_url($image_url); ?>" class="block">
                                        <img src="<?php echo esc_url($image_thumb); ?>" 
                                             alt="<?php echo esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)); ?>" 
                                             class="w-full h-48 object-cover rounded-lg">
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Barra lateral -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                    <h2 class="text-2xl font-semibold mb-4"><?php _e('Información de contacto', 'tu-tema'); ?></h2>
                    
                    <div class="space-y-4">
                        <?php 
                        $address = get_post_meta($post->ID, 'address', true);
                        $phone = get_post_meta($post->ID, 'phone', true);
                        $website = get_post_meta($post->ID, 'website', true);
                        ?>

                        <?php if ($address): ?>
                            <div class="flex items-start gap-3">
                                <i class="ph ph-map-pin text-xl text-[#4e7097]"></i>
                                <div>
                                    <strong class="block text-[#0e141b] mb-1"><?php _e('Dirección:', 'tu-tema'); ?></strong>
                                    <p class="text-[#4e7097]"><?php echo esc_html($address); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($phone): ?>
                            <div class="flex items-start gap-3">
                                <i class="ph ph-phone text-xl text-[#4e7097]"></i>
                                <div>
                                    <strong class="block text-[#0e141b] mb-1"><?php _e('Teléfono:', 'tu-tema'); ?></strong>
                                    <a href="tel:<?php echo esc_attr($phone); ?>" 
                                       class="text-[#1979e6] hover:text-[#1565c0] transition-colors">
                                        <?php echo esc_html($phone); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($website): ?>
                            <div class="flex items-start gap-3">
                                <i class="ph ph-globe text-xl text-[#4e7097]"></i>
                                <div>
                                    <strong class="block text-[#0e141b] mb-1"><?php _e('Web:', 'tu-tema'); ?></strong>
                                    <a href="<?php echo esc_url($website); ?>" 
                                       target="_blank" 
                                       class="text-[#1979e6] hover:text-[#1565c0] transition-colors">
                                        <?php echo esc_html($website); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if (!empty($lat) && !empty($lng)): ?>
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4"><?php _e('Ubicación', 'tu-tema'); ?></h2>
                    <div class="hotel-map" data-lat="<?php echo esc_attr($lat); ?>" data-lng="<?php echo esc_attr($lng); ?>">
                        <div id="map-<?php echo get_the_ID(); ?>" style="height: 300px;" class="rounded-lg"></div>
                    </div>
                </div>
                <?php endif; ?>

                <?php
                $servicios_ciclistas = get_the_terms(get_the_ID(), 'hotel_bike_services');
                if ($servicios_ciclistas && !is_wp_error($servicios_ciclistas)): ?>
                    <div class="bg-white rounded-lg shadow-lg p-6 mt-8">
                        <h2 class="text-2xl font-semibold mb-4"><?php _e('Servicios Ciclistas', 'tu-tema'); ?></h2>
                        <ul class="list-disc pl-5">
                            <?php foreach ($servicios_ciclistas as $servicio): ?>
                                <li><?php echo esc_html($servicio->name); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php
endwhile;
get_footer();
?> 