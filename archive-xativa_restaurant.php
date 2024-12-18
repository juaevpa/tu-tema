<?php
/**
 * Plantilla para mostrar el listado de restaurantes
 *
 * @package Tu_Tema
 */

get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-[#0e141b] text-4xl font-bold mb-8">Restaurantes en Xàtiva</h1>

    <!-- Filtros -->
    <div class="mb-8">
        <h2 class="text-[#0e141b] text-xl font-bold mb-4">Filtros</h2>
        
        <div class="flex flex-wrap gap-4 mb-4">
            <?php
            $current_category = isset($_GET['restaurant_category']) ? $_GET['restaurant_category'] : '';
            $categories = get_terms(array(
                'taxonomy' => 'restaurant_category',
                'hide_empty' => false,
            ));

            if (!empty($categories) && !is_wp_error($categories)) {
                foreach ($categories as $category) {
                    $is_active = $current_category === $category->slug;
                    ?>
                    <button 
                        class="filter-btn px-4 py-2 rounded-lg text-sm font-medium <?php echo $is_active ? 'bg-[#1979e6] text-white' : 'bg-[#e7edf3] text-[#0e141b]'; ?>"
                        data-category="<?php echo esc_attr($category->slug); ?>"
                        onclick="filterRestaurants(this)">
                        <?php echo esc_html($category->name); ?>
                    </button>
                    <?php
                }
            }
            ?>
        </div>

        <div class="flex justify-end gap-4">
            <button onclick="resetFilters()" class="px-4 py-2 rounded-lg bg-[#e7edf3] text-[#0e141b] text-sm font-medium">
                Resetear filtros
            </button>
        </div>
    </div>

    <!-- Listado de Restaurantes -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="restaurants-grid">
        <?php
        $args = array(
            'post_type' => 'xativa_restaurant',
            'posts_per_page' => -1,
        );

        if (!empty($current_category)) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'restaurant_category',
                    'field' => 'slug',
                    'terms' => $current_category,
                ),
            );
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $rating = get_post_meta(get_the_ID(), 'rating', true);
                $address = get_post_meta(get_the_ID(), 'address', true);
                $phone = get_post_meta(get_the_ID(), 'phone', true);
                ?>
                <div class="restaurant-card bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="aspect-video">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" 
                                 alt="<?php echo esc_attr(get_the_title()); ?>"
                                 class="w-full h-full object-cover">
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-4">
                        <h3 class="text-[#0e141b] text-xl font-bold mb-2"><?php the_title(); ?></h3>
                        
                        <?php if ($rating) : ?>
                            <div class="flex items-center gap-1 text-[#4e7097] mb-2">
                                <i class="ph ph-star-fill"></i>
                                <span><?php echo esc_html($rating); ?>/5</span>
                            </div>
                        <?php endif; ?>

                        <?php if ($address) : ?>
                            <div class="flex items-center gap-2 text-[#4e7097] text-sm mb-1">
                                <i class="ph ph-map-pin"></i>
                                <span><?php echo esc_html($address); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($phone) : ?>
                            <div class="flex items-center gap-2 text-[#4e7097] text-sm mb-3">
                                <i class="ph ph-phone"></i>
                                <span><?php echo esc_html($phone); ?></span>
                            </div>
                        <?php endif; ?>

                        <a href="<?php the_permalink(); ?>" 
                           class="inline-block bg-[#1979e6] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#1565c0] transition-colors">
                            Ver detalles
                        </a>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <div class="col-span-full text-center py-8 text-[#4e7097]">
                No se encontraron restaurantes.
            </div>
            <?php
        endif;
        ?>
    </div>
</div>

<script>
function filterRestaurants(button) {
    const category = button.dataset.category;
    const currentUrl = new URL(window.location.href);
    
    // Actualizar o añadir el parámetro de categoría
    if (category) {
        currentUrl.searchParams.set('restaurant_category', category);
    } else {
        currentUrl.searchParams.delete('restaurant_category');
    }
    
    // Recargar la página con los nuevos parámetros
    window.location.href = currentUrl.toString();
}

function resetFilters() {
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.delete('restaurant_category');
    window.location.href = currentUrl.toString();
}

// Marcar el botón activo al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const activeCategory = urlParams.get('restaurant_category');
    
    if (activeCategory) {
        const activeButton = document.querySelector(`[data-category="${activeCategory}"]`);
        if (activeButton) {
            activeButton.classList.remove('bg-[#e7edf3]', 'text-[#0e141b]');
            activeButton.classList.add('bg-[#1979e6]', 'text-white');
        }
    }
});
</script>

<?php get_footer(); ?> 