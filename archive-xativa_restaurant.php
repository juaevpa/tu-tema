<?php
/**
 * Plantilla para mostrar el listado de restaurantes
 *
 * @package Tu_Tema
 */

get_header(); ?>

<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-[#0e141b] text-4xl font-bold mb-8">Restaurantes en Xàtiva</h1>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Contenido principal (2/3) -->
        <div class="md:col-span-2">
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

                    // Botón "Todos"
                    $is_active = empty($current_category);
                    ?>
                    <button 
                        onclick="filterRestaurants(this)" 
                        data-category=""
                        class="filter-btn px-4 py-2 rounded-lg text-sm font-medium <?php echo $is_active ? 'bg-[#1979e6] text-white' : 'bg-[#e7edf3] text-[#0e141b]'; ?>">
                        Todos
                    </button>

                    <?php
                    if (!empty($categories) && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            $is_active = $current_category === $category->slug;
                            ?>
                            <button 
                                onclick="filterRestaurants(this)" 
                                data-category="<?php echo esc_attr($category->slug); ?>"
                                class="filter-btn px-4 py-2 rounded-lg text-sm font-medium <?php echo $is_active ? 'bg-[#1979e6] text-white' : 'bg-[#e7edf3] text-[#0e141b]'; ?>">
                                <?php echo esc_html($category->name); ?>
                            </button>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Lista de restaurantes -->
            <div id="list-container" class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                        <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <a href="<?php the_permalink(); ?>" class="block h-full hover:text-inherit">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="aspect-video">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium_large'); ?>" 
                                             alt="<?php echo esc_attr(get_the_title()); ?>"
                                             class="w-full h-full object-cover">
                                    </div>
                                <?php endif; ?>
                                
                                <div class="p-4">
                                    <h3 class="text-[#0e141b] text-xl font-bold mb-2">
                                        <span class="hover:text-[#1979e6] transition-colors">
                                            <?php the_title(); ?>
                                        </span>
                                    </h3>
                                    
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

                                    <div class="text-[#4e7097] text-sm mb-4">
                                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                    </div>

                                    <span class="inline-block bg-[#1979e6] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#1565c0] transition-colors">
                                        Ver detalles
                                    </span>
                                </div>
                            </a>
                        </article>
                        <?php
                    endwhile;
                    
                    // Paginación
                    echo '<div class="col-span-full flex justify-center mt-8">';
                    echo paginate_links(array(
                        'prev_text' => __('← Anterior'),
                        'next_text' => __('Siguiente →')
                    ));
                    echo '</div>';
                    
                    wp_reset_postdata();
                else :
                    echo '<div class="col-span-full text-center py-8 text-[#4e7097]">
                        No se encontraron restaurantes.
                    </div>';
                endif;
                ?>
            </div>
        </div>

        <!-- Sidebar (1/3) -->
        <aside class="md:col-span-1">
            <div class="sticky top-0 space-y-8">
                <!-- Mapa -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-[#0e141b] text-xl font-bold mb-4">Ubicación</h2>
                    <div id="map-container" class="h-[400px] rounded-lg overflow-hidden">
                        <?php
                        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                            $lat = get_post_meta(get_the_ID(), 'latitude', true);
                            $lng = get_post_meta(get_the_ID(), 'longitude', true);
                            if ($lat && $lng) :
                        ?>
                            <div class="hidden"
                                 data-lat="<?php echo esc_attr($lat); ?>"
                                 data-lng="<?php echo esc_attr($lng); ?>"
                                 data-title="<?php echo esc_attr(get_the_title()); ?>"
                                 data-url="<?php echo esc_url(get_permalink()); ?>">
                            </div>
                        <?php
                            endif;
                        endwhile; endif;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>

<style>
    #restaurants-grid {
        opacity: 1;
        transition: opacity 0.1s ease;
    }
</style>

<script>
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

function filterRestaurants(button) {
    // Actualizar clases de los botones
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('bg-[#1979e6]', 'text-white');
        btn.classList.add('bg-[#e7edf3]', 'text-[#0e141b]');
    });
    
    button.classList.remove('bg-[#e7edf3]', 'text-[#0e141b]');
    button.classList.add('bg-[#1979e6]', 'text-white');

    const category = button.dataset.category;
    const listContainer = document.getElementById('list-container');
    
    // Añadir efecto de carga
    listContainer.style.opacity = '0.5';
    
    // Realizar petición AJAX
    fetch(`${ajaxurl}?action=filter_restaurants&category=${category}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.text())
    .then(html => {
        listContainer.innerHTML = html;
        // Añadir efecto de carga
        setTimeout(() => {
            listContainer.style.opacity = '1';
        }, 10);
    })
    .catch(error => console.error('Error:', error));
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

document.addEventListener('DOMContentLoaded', function() {
    const mapContainer = document.getElementById('map-container');
    if (!mapContainer || typeof L === 'undefined') return;

    // Limpiar el contenedor
    mapContainer.innerHTML = '';
    
    try {
        // Crear nuevo mapa
        const map = L.map('map-container').setView([38.9889, -0.5209], 14);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Array para almacenar todos los marcadores
        const markers = [];

        // Añadir marcadores para cada restaurante
        <?php
        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
            $lat = get_post_meta(get_the_ID(), 'latitude', true);
            $lng = get_post_meta(get_the_ID(), 'longitude', true);
            if ($lat && $lng) :
        ?>
            markers.push(L.marker([<?php echo $lat; ?>, <?php echo $lng; ?>])
                .bindPopup(`
                    <div class="p-3">
                        <h3 class="font-bold text-lg mb-2"><?php echo esc_js(get_the_title()); ?></h3>
                        <a href="<?php echo esc_js(get_permalink()); ?>" 
                           class="inline-block bg-[#1979e6] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#1565c0] transition-colors">
                            Ver detalles
                        </a>
                    </div>
                `)
                .addTo(map));
        <?php
            endif;
        endwhile; endif;
        wp_reset_postdata();
        ?>

        // Ajustar el mapa para mostrar todos los marcadores
        if (markers.length > 1) {
            const group = L.featureGroup(markers);
            map.fitBounds(group.getBounds());
        }
    } catch (error) {
        console.error('Error al inicializar el mapa:', error);
    }
});
</script>

<?php get_footer(); ?> 