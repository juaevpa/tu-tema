<?php
get_header();

// Obtener todas las categorías
$categories = get_terms(array(
    'taxonomy' => 'explore_category',
    'hide_empty' => false
));

// Obtener los elementos con filtros si existen
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'xativa_explore',
    'posts_per_page' => 12,
    'paged' => $paged,
);

// Aplicar filtros de categoría
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $categories = is_array($_GET['category']) ? $_GET['category'] : array($_GET['category']);
    $args['tax_query'][] = array(
        'taxonomy' => 'explore_category',
        'field' => 'slug',
        'terms' => $categories,
        'operator' => 'IN'
    );
}

// Aplicar filtro de búsqueda
if (isset($_GET['s']) && !empty($_GET['s'])) {
    $args['s'] = sanitize_text_field($_GET['s']);
}

$explore_query = new WP_Query($args);
?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col  flex-1">
        <!-- Hero Section -->
        <div class="@container">
            <div class="@[480px]:p-4">
                <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-xl items-center justify-center p-4"
                    style="background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url('<?php echo get_theme_file_uri('assets/images/explore-hero.jpg'); ?>');">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em] text-center">
                        <?php _e('Explora Xàtiva', 'tu-tema'); ?>
                    </h1>
                    
                    <!-- Buscador -->
                    <form role="search" method="get" class="w-full max-w-[480px]" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="hidden" name="post_type" value="xativa_explore">
                        <label class="flex flex-col min-w-40 h-14 w-full @[480px]:h-16">
                            <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                                <div class="text-[#4e7097] flex border border-[#d0dbe7] bg-slate-50 items-center justify-center pl-[15px] rounded-l-xl border-r-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                                    </svg>
                                </div>
                                <input type="search" 
                                       name="s"
                                       placeholder="<?php esc_attr_e('Buscar lugares para explorar...', 'tu-tema'); ?>"
                                       class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#0e141b] focus:outline-0 focus:ring-0 border border-[#d0dbe7] bg-slate-50 focus:border-[#d0dbe7] h-full placeholder:text-[#4e7097] px-[15px] rounded-r-none border-r-0 pr-2 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal"
                                       value="<?php echo get_search_query(); ?>">
                                <div class="flex items-center justify-center rounded-r-xl border-l-0 border border-[#d0dbe7] bg-slate-50 pr-[7px]">
                                    <button type="submit"
                                            class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-[#1979e6] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em]">
                                        <span class="truncate"><?php _e('Buscar', 'tu-tema'); ?></span>
                                    </button>
                                </div>
                            </div>
                        </label>
                    </form>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="filters-section mb-6">
            <h3 class="text-[#0e141b] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">
                <?php _e('Filtros', 'tu-tema'); ?>
            </h3>
            <div class="flex flex-wrap gap-3 p-3" id="categoryFilters">
                <?php if (!is_wp_error($categories) && !empty($categories)) : 
                    foreach ($categories as $category) : ?>
                        <button type="button" 
                                data-category="<?php echo esc_attr($category->slug); ?>"
                                class="filter-button flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-xl bg-[#e7edf3] px-4 hover:bg-[#d0dbe7] transition-colors <?php echo (isset($_GET['category']) && in_array($category->slug, (array)$_GET['category'])) ? 'active bg-[#1979e6] text-white hover:bg-[#1979e6]' : ''; ?>">
                            <span class="text-sm font-medium leading-normal whitespace-nowrap">
                                <?php echo esc_html($category->name); ?>
                            </span>
                        </button>
                    <?php endforeach;
                endif; ?>
            </div>
        </div>

        <!-- Contenedor para los resultados AJAX -->
        <div id="exploreResults">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
                <!-- El contenido se cargará aquí -->
            </div>
        </div>

        <!-- Paginación -->
        <div class="flex justify-center py-8">
            <?php
            echo paginate_links(array(
                'total' => $explore_query->max_num_pages,
                'current' => $paged,
                'prev_text' => '<i class="ph ph-caret-left text-xl"></i>',
                'next_text' => '<i class="ph ph-caret-right text-xl"></i>',
                'type' => 'list',
                'class' => 'pagination'
            ));
            ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-button');
    const resultsContainer = document.getElementById('exploreResults');
    let activeFilters = new Set();

    // Función para cargar los resultados
    function loadResults() {
        // Añadir fade out
        resultsContainer.style.opacity = '0.6';
        resultsContainer.style.transition = 'opacity 0.2s ease';

        const data = new FormData();
        data.append('action', 'filter_explore');
        data.append('categories', Array.from(activeFilters).join(','));
        data.append('search', '<?php echo esc_js(get_search_query()); ?>');

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: data
        })
        .then(response => response.text())
        .then(html => {
            resultsContainer.innerHTML = html;
            // Restaurar opacidad
            setTimeout(() => {
                resultsContainer.style.opacity = '1';
            }, 50);
        });
    }

    // Manejar clicks en los botones de filtro
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            
            if (activeFilters.has(category)) {
                activeFilters.delete(category);
                this.classList.remove('active', 'bg-[#1979e6]', 'text-white');
                this.classList.add('bg-[#e7edf3]');
            } else {
                activeFilters.add(category);
                this.classList.add('active', 'bg-[#1979e6]', 'text-white');
                this.classList.remove('bg-[#e7edf3]');
            }

            loadResults();
        });
    });

    // Cargar resultados iniciales
    loadResults();
});
</script>

<?php get_footer(); ?> 