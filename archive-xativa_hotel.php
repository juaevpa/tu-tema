<?php
/**
 * Plantilla para mostrar el listado de hoteles
 *
 * @package Tu_Tema
 */

get_header(); ?>

<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-[#0e141b] text-4xl font-bold mb-8">Hoteles en Xàtiva</h1>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Contenido principal (2/3) -->
        <div class="md:col-span-2">
            <!-- Filtros existentes -->
            <?php include('template-parts/hotel-filters.php'); ?>

            <!-- Lista de hoteles -->
            <div id="list-container" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
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
                                    
                                    <?php 
                                    $rating = get_post_meta(get_the_ID(), 'rating', true);
                                    $address = get_post_meta(get_the_ID(), 'address', true);
                                    $phone = get_post_meta(get_the_ID(), 'phone', true);
                                    ?>

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
                        No se encontraron hoteles.
                    </div>';
                endif;
                ?>
            </div>
        </div>

        <!-- Sidebar (1/3) -->
        <aside class="md:col-span-1">
            <div class="sticky top-0 space-y-8">
                <!-- Buscador con fechas -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-[#0e141b] text-xl font-bold mb-4">Buscar disponibilidad</h2>
                    <form class="flex flex-col gap-4" id="hotel-search">
                        <div class="flex flex-col">
                            <label class="text-[#0e141b] font-medium mb-2">Fecha de entrada</label>
                            <input type="date" 
                                   class="border border-[#e7edf3] rounded-lg px-4 py-2"
                                   id="check-in"
                                   min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-[#0e141b] font-medium mb-2">Fecha de salida</label>
                            <input type="date" 
                                   class="border border-[#e7edf3] rounded-lg px-4 py-2"
                                   id="check-out"
                                   min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                        </div>
                        <div class="flex flex-col">
                            <label class="text-[#0e141b] font-medium mb-2">Huéspedes</label>
                            <select class="border border-[#e7edf3] rounded-lg px-4 py-2"
                                    id="guests">
                                <option value="1">1 persona</option>
                                <option value="2">2 personas</option>
                                <option value="3">3 personas</option>
                                <option value="4">4 personas</option>
                            </select>
                        </div>
                        <button type="button" 
                                onclick="searchHotels()"
                                class="bg-[#1979e6] text-white px-6 py-2 rounded-lg hover:bg-[#1565c0] transition-colors w-full">
                            Buscar en Google Travel
                        </button>
                    </form>
                </div>

                <!-- Mapa -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-[#0e141b] text-xl font-bold mb-4">Ubicación</h2>
                    <div id="map-container" class="h-[400px] rounded-lg overflow-hidden"></div>
                </div>
            </div>
        </aside>
    </div>
</div>

<style>
    #list-container {
        opacity: 1;
        transition: opacity 0.1s ease;
    }
</style>

<script>
function searchHotels() {
    const checkIn = document.getElementById('check-in').value;
    const checkOut = document.getElementById('check-out').value;
    const guests = document.getElementById('guests').value;
    
    const baseUrl = 'https://www.google.com/travel/hotels/Xativa';
    const params = new URLSearchParams({
        ap: 'MAEqEQoNCgkKB1hBVElWQRgBIgAqAA',
        dates: `${checkIn},${checkOut}`,
        guests: guests,
        hl: 'es'
    });
    
    window.open(`${baseUrl}?${params.toString()}`, '_blank');
}

function filterHotels(button) {
    // Actualizar clases de los botones
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('bg-[#1979e6]', 'text-white');
        btn.classList.add('bg-[#e7edf3]', 'text-[#0e141b]');
    });
    
    button.classList.remove('bg-[#e7edf3]', 'text-[#0e141b]');
    button.classList.add('bg-[#1979e6]', 'text-white');

    const category = button.dataset.category;
    const listContainer = document.getElementById('list-container');
    
    // Añadir transición de salida más rápida
    listContainer.style.opacity = '0';
    listContainer.style.transition = 'opacity 0.1s ease';
    
    // Realizar petición AJAX con menos delay
    setTimeout(() => {
        fetch(`${ajaxurl}?action=filter_hotels&category=${category}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text())
        .then(html => {
            listContainer.innerHTML = html;
            // Transición de entrada inmediata
            requestAnimationFrame(() => {
                listContainer.style.opacity = '1';
            });
        })
        .catch(error => console.error('Error:', error));
    }, 100);
}

// Cambiar el evento de carga por esto:
</script>

<script>
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

        // Añadir marcadores para cada hotel
        <?php
        if (have_posts()) : while (have_posts()) : the_post();
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
        ?>

        // Ajustar el mapa para mostrar todos los marcadores si hay más de uno
        if (markers.length > 1) {
            const group = L.featureGroup(markers);
            map.fitBounds(group.getBounds());
        }
    } catch (error) {
        console.error('Error al inicializar el mapa:', error);
    }
}, { once: true });
</script>

<?php get_footer(); ?> 