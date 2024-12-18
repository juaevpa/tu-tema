<?php
/**
 * Plantilla para mostrar un restaurante individual
 *
 * @package Tu_Tema
 */

get_header();

while (have_posts()) :
    the_post();
    
    // DEBUG
    $additional_photos = get_post_meta(get_the_ID(), 'additional_photos', true);
    $google_reviews = get_post_meta(get_the_ID(), 'google_reviews', true);

    $lat = get_post_meta(get_the_ID(), 'latitude', true);
    $lng = get_post_meta(get_the_ID(), 'longitude', true);
    ?>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Columna principal -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                    <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
                    
                    <!-- Imagen destacada -->
                    <?php if (has_post_thumbnail()): 
                        $full_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    ?>
                        <div class="mb-6">
                            <button onclick="document.getElementById('imageModal').classList.remove('hidden')" 
                                    class="w-full block aspect-[16/9] overflow-hidden rounded-lg group cursor-pointer relative">
                                <?php the_post_thumbnail('large', array(
                                    'class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-105'
                                )); ?>
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-50 transition-opacity duration-300"></div>
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <i class="ph ph-magnifying-glass-plus text-white text-4xl"></i>
                                </div>
                            </button>
                        </div>

                        <!-- Modal imagen destacada -->
                        <div id="imageModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-75 flex items-center justify-center p-4">
                            <div class="relative max-w-7xl w-full">
                                <button onclick="document.getElementById('imageModal').classList.add('hidden')" 
                                        class="absolute -top-10 right-0 text-white hover:text-gray-300">
                                    <i class="ph ph-x text-3xl"></i>
                                </button>
                                <img src="<?php echo esc_url($full_image_url); ?>" 
                                     alt="<?php echo esc_attr(get_the_title()); ?>" 
                                     class="w-full h-auto">
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Rating y Precio -->
                    <div class="flex items-center gap-6 mb-6">
                        <?php 
                        $rating = get_post_meta(get_the_ID(), 'rating', true);
                        $price_level = get_post_meta(get_the_ID(), 'price_level', true);
                        ?>
                        <?php if ($rating): ?>
                            <div class="flex items-center gap-2">
                                <span class="text-[#4e7097] font-medium">Valoración:</span>
                                <div class="flex text-yellow-400">
                                    <?php 
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '<i class="ph ' . ($i <= $rating ? 'ph-star-fill' : 'ph-star') . '"></i>';
                                    }
                                    ?>
                                </div>
                                <span class="text-[#4e7097]">(<?php echo esc_html($rating); ?>/5)</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($price_level): ?>
                            <div class="flex items-center gap-2">
                                <span class="text-[#4e7097] font-medium">Precio:</span>
                                <span class="text-[#4e7097]"><?php echo str_repeat('€', intval($price_level)); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php the_content(); ?>

                    

                    <!-- Reseñas de Google -->
                    <?php 
                    $google_reviews = get_post_meta(get_the_ID(), 'google_reviews', true);
                    if (!empty($google_reviews)): 
                        // Si es una string, deserialízala
                        if (is_string($google_reviews)) {
                            $reviews = maybe_unserialize($google_reviews);
                        } else {
                            $reviews = $google_reviews;
                        }
                        
                        if (is_array($reviews)): 
                    ?>
                        <div class="mt-8">
                            <h2 class="text-2xl font-semibold mb-4"><?php _e('Reseñas de Google', 'tu-tema'); ?></h2>
                            <div class="space-y-6">
                                <?php foreach ($reviews as $review): ?>
                                    <div class="border-b border-gray-200 last:border-0 pb-6 last:pb-0">
                                        <div class="flex items-center gap-3 mb-2">
                                            <?php if (!empty($review['profile_photo'])): ?>
                                                <img src="<?php echo esc_url($review['profile_photo']); ?>" 
                                                     alt="<?php echo esc_attr($review['author']); ?>"
                                                     class="w-10 h-10 rounded-full">
                                            <?php endif; ?>
                                            <div>
                                                <p class="font-medium text-[#0e141b]"><?php echo esc_html($review['author']); ?></p>
                                                <div class="flex items-center gap-1 text-yellow-400">
                                                    <?php 
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        echo '<i class="ph ' . ($i <= $review['rating'] ? 'ph-star-fill' : 'ph-star') . '"></i>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-[#4e7097]"><?php echo esc_html($review['text']); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php 
                        endif;
                    endif; 
                    ?>
                </div>
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
                    <div class="restaurant-map" data-lat="<?php echo esc_attr($lat); ?>" data-lng="<?php echo esc_attr($lng); ?>">
                        <div id="map-<?php echo get_the_ID(); ?>" style="height: 300px;" class="rounded-lg"></div>
                    </div>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const mapContainer = document.getElementById('map-<?php echo get_the_ID(); ?>');
                    const lat = parseFloat('<?php echo esc_js($lat); ?>');
                    const lng = parseFloat('<?php echo esc_js($lng); ?>');
                    
                    if (!mapContainer || typeof L === 'undefined') return;

                    const map = L.map(mapContainer).setView([lat, lng], 15);
                    
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    L.marker([lat, lng])
                        .addTo(map)
                        .bindPopup(`
                            <div class="p-3">
                                <h3 class="font-bold text-lg mb-2"><?php echo esc_js(get_the_title()); ?></h3>
                                <?php if ($address): ?>
                                    <p class="text-sm text-[#4e7097] mb-2"><?php echo esc_js($address); ?></p>
                                <?php endif; ?>
                            </div>
                        `);
                });
                </script>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php
endwhile;
get_footer();
?> 