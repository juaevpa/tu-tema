<?php
/**
 * Plantilla para mostrar el listado de hoteles
 *
 * @package Tu_Tema
 */

get_header(); ?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-[#0e141b] text-4xl font-bold mb-8">Hoteles en Xàtiva</h1>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Contenido principal (3/4) -->
        <div class="lg:w-3/4">
            <!-- Filtros existentes -->
            <?php include('template-parts/hotel-filters.php'); ?>

            <!-- Lista de hoteles -->
            <div id="list-container" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        include('template-parts/hotel-card.php');
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

        <!-- Sidebar (1/4) -->
        <aside class="lg:w-1/4">
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
    const category = button.dataset.category;
    const currentUrl = new URL(window.location.href);
    
    if (category) {
        currentUrl.searchParams.set('hotel_category', category);
    } else {
        currentUrl.searchParams.delete('hotel_category');
    }
    
    window.location.href = currentUrl.toString();
}

// Inicializar el mapa
let map;
let markers = [];

function initMap() {
    map = L.map('map-container').setView([38.9889, -0.5209], 14);
    
    // Añadir capa de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Añadir marcadores para cada hotel
    <?php
    if (have_posts()) : while (have_posts()) : the_post();
        $lat = get_post_meta(get_the_ID(), 'latitude', true);
        $lng = get_post_meta(get_the_ID(), 'longitude', true);
        if ($lat && $lng) :
    ?>
        addMarker({
            lat: <?php echo $lat; ?>,
            lng: <?php echo $lng; ?>,
            title: '<?php echo esc_js(get_the_title()); ?>',
            url: '<?php echo esc_js(get_permalink()); ?>'
        });
    <?php
        endif;
    endwhile; endif;
    ?>
}

function addMarker(props) {
    const marker = L.marker([props.lat, props.lng]).addTo(map);
    
    // Crear el contenido del popup
    const popupContent = `
        <div class="p-3">
            <h3 class="font-bold text-lg mb-2">${props.title}</h3>
            <a href="${props.url}" 
               class="inline-block bg-[#1979e6] text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-[#1565c0] transition-colors">
                Ver detalles
            </a>
        </div>
    `;
    
    marker.bindPopup(popupContent);
    markers.push(marker);
}

// Inicializar el mapa cuando se carga la página
window.addEventListener('load', initMap);
</script>

<?php get_footer(); ?> 