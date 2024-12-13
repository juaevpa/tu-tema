<?php
get_header();

// Obtener rutas destacadas
$featured_routes = new WP_Query(array(
    'post_type' => 'xativa_route',
    'posts_per_page' => 3,
    'meta_query' => array(
        array(
            'key' => 'featured',
            'value' => '1',
            'compare' => '='
        )
    )
));

// Obtener términos de las taxonomías para los filtros con argumentos específicos
$difficulties = get_terms(array(
    'taxonomy' => 'route_difficulty',
    'hide_empty' => false
));

$types = get_terms(array(
    'taxonomy' => 'route_type',
    'hide_empty' => false
));

$sceneries = get_terms(array(
    'taxonomy' => 'route_scenery',
    'hide_empty' => false
));

// Obtener rutas con filtros si existen
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'xativa_route',
    'posts_per_page' => 12,
    'paged' => $paged,
);

// Aplicar filtros si existen
if (!empty($_GET['difficulty'])) {
    $args['tax_query'][] = array(
        'taxonomy' => 'route_difficulty',
        'field' => 'slug',
        'terms' => $_GET['difficulty'],
        'operator' => 'IN'
    );
}

if (!empty($_GET['type'])) {
    $args['tax_query'][] = array(
        'taxonomy' => 'route_type',
        'field' => 'slug',
        'terms' => $_GET['type'],
        'operator' => 'IN'
    );
}

if (!empty($_GET['scenery'])) {
    $args['tax_query'][] = array(
        'taxonomy' => 'route_scenery',
        'field' => 'slug',
        'terms' => $_GET['scenery'],
        'operator' => 'IN'
    );
}

$routes_query = new WP_Query($args);
?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        <!-- Hero Section -->
        <div class="@container">
            <div class="@[480px]:p-4">
                <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-xl items-center justify-center p-4"
                    style="background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url('<?php echo get_theme_file_uri('assets/images/routes-hero.jpg'); ?>');">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em] text-center">
                        <?php _e('Descubre las mejores rutas ciclistas en Xàtiva', 'tu-tema'); ?>
                    </h1>
                    
                    <!-- Buscador -->
                    <form role="search" method="get" class="w-full max-w-[480px]" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="hidden" name="post_type" value="xativa_route">
                        <label class="flex flex-col min-w-40 h-14 w-full @[480px]:h-16">
                            <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                                <div class="text-[#4e7097] flex border border-[#d0dbe7] bg-slate-50 items-center justify-center pl-[15px] rounded-l-xl border-r-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                                    </svg>
                                </div>
                                <input type="search" 
                                       name="s"
                                       placeholder="<?php esc_attr_e('Buscar una ruta...', 'tu-tema'); ?>"
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

        <!-- Rutas Destacadas -->
        <?php if ($featured_routes->have_posts()) : ?>
            <h2 class="text-[#0e141b] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">
                <?php _e('Rutas destacadas', 'tu-tema'); ?>
            </h2>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
                <?php while ($featured_routes->have_posts()) : $featured_routes->the_post(); 
                    $distance = get_field('distance');
                    $permalink = get_permalink();
                ?>
                    <a href="<?php echo esc_url($permalink); ?>" class="group flex flex-col gap-3 pb-3 hover:opacity-90 transition-opacity">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl group-hover:shadow-md transition-shadow"
                                style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>');">
                            </div>
                        <?php endif; ?>
                        <div>
                            <p class="text-[#0e141b] text-base font-medium leading-normal group-hover:text-[#1979e6] transition-colors"><?php the_title(); ?></p>
                            <?php if ($distance) : ?>
                                <p class="text-[#4e7097] text-sm font-normal leading-normal"><?php echo esc_html($distance); ?> km</p>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>

        <!-- Filtros -->
        <form method="get" class="filter-form relative">
            <h3 class="text-[#0e141b] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">
                <?php _e('Filtros', 'tu-tema'); ?>
            </h3>
            <div class="flex gap-3 p-3">
                <!-- Dificultad -->
                <?php if (!is_wp_error($difficulties) && !empty($difficulties)) : ?>
                <div class="relative">
                    <button type="button" class="filter-dropdown-toggle flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-xl bg-[#e7edf3] pl-4 pr-2">
                        <p class="text-[#0e141b] text-sm font-medium leading-normal whitespace-nowrap"><?php _e('Dificultad', 'tu-tema'); ?></p>
                        <div class="text-[#0e141b]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="filter-dropdown hidden absolute top-full left-0 mt-2 w-48 rounded-xl bg-white shadow-lg z-50">
                        <div class="py-2">
                            <?php foreach ($difficulties as $difficulty) : ?>
                                <label class="flex items-center px-4 py-2 hover:bg-[#e7edf3] cursor-pointer">
                                    <input type="checkbox" 
                                           name="difficulty[]" 
                                           value="<?php echo esc_attr($difficulty->slug); ?>"
                                           <?php checked(isset($_GET['difficulty']) && in_array($difficulty->slug, (array)$_GET['difficulty'])); ?>>
                                    <span class="ml-2"><?php echo esc_html($difficulty->name); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Paisaje -->
                <?php if (!is_wp_error($sceneries) && !empty($sceneries)) : ?>
                <div class="relative">
                    <button type="button" class="filter-dropdown-toggle flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-xl bg-[#e7edf3] pl-4 pr-2">
                        <p class="text-[#0e141b] text-sm font-medium leading-normal whitespace-nowrap"><?php _e('Paisaje', 'tu-tema'); ?></p>
                        <div class="text-[#0e141b]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="filter-dropdown hidden absolute top-full left-0 mt-2 w-48 rounded-xl bg-white shadow-lg z-50">
                        <div class="py-2">
                            <?php foreach ($sceneries as $scenery) : ?>
                                <label class="flex items-center px-4 py-2 hover:bg-[#e7edf3] cursor-pointer">
                                    <input type="checkbox" 
                                           name="scenery[]" 
                                           value="<?php echo esc_attr($scenery->slug); ?>"
                                           <?php checked(isset($_GET['scenery']) && in_array($scenery->slug, (array)$_GET['scenery'])); ?>>
                                    <span class="ml-2"><?php echo esc_html($scenery->name); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Tipo de ruta -->
                <?php if (!is_wp_error($types) && !empty($types)) : ?>
                <div class="relative">
                    <button type="button" class="filter-dropdown-toggle flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-xl bg-[#e7edf3] pl-4 pr-2">
                        <p class="text-[#0e141b] text-sm font-medium leading-normal whitespace-nowrap"><?php _e('Tipo de ruta', 'tu-tema'); ?></p>
                        <div class="text-[#0e141b]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                            </svg>
                        </div>
                    </button>
                    <div class="filter-dropdown hidden absolute top-full left-0 mt-2 w-48 rounded-xl bg-white shadow-lg z-50">
                        <div class="py-2">
                            <?php foreach ($types as $type) : ?>
                                <label class="flex items-center px-4 py-2 hover:bg-[#e7edf3] cursor-pointer">
                                    <input type="checkbox" 
                                           name="type[]" 
                                           value="<?php echo esc_attr($type->slug); ?>"
                                           <?php checked(isset($_GET['type']) && in_array($type->slug, (array)$_GET['type'])); ?>>
                                    <span class="ml-2"><?php echo esc_html($type->name); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Botones de filtro -->
            <div class="flex justify-stretch">
                <div class="flex flex-1 gap-3 flex-wrap px-4 py-3 justify-end">
                    <button type="reset" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#e7edf3] text-[#0e141b] text-sm font-bold leading-normal tracking-[0.015em]">
                        <span class="truncate"><?php _e('Resetear filtros', 'tu-tema'); ?></span>
                    </button>
                    <button type="submit" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#1979e6] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em]">
                        <span class="truncate"><?php _e('Aplicar filtros', 'tu-tema'); ?></span>
                    </button>
                </div>
            </div>
        </form>

        <!-- Listado de rutas -->
        <?php if ($routes_query->have_posts()): ?>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
                <?php while ($routes_query->have_posts()): $routes_query->the_post(); 
                    $distance = get_field('distance');
                ?>
                    <div class="flex flex-col gap-3 pb-3">
                        <a href="<?php the_permalink(); ?>" class="block">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl"
                                    style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>');">
                                </div>
                            <?php endif; ?>
                            <div>
                                <p class="text-[#0e141b] text-base font-medium leading-normal"><?php the_title(); ?></p>
                                <?php if ($distance): ?>
                                    <p class="text-[#4e7097] text-sm font-normal leading-normal"><?php echo esc_html($distance); ?> km</p>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Paginación -->
            <?php
            echo paginate_links(array(
                'total' => $routes_query->max_num_pages,
                'current' => $paged,
                'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" fill="currentColor" viewBox="0 0 256 256"><path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"></path></svg>',
                'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" fill="currentColor" viewBox="0 0 256 256"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>',
                'type' => 'list',
                'class' => 'pagination'
            ));
            ?>
        <?php else: ?>
            <p class="text-center py-8"><?php _e('No se encontraron rutas.', 'tu-tema'); ?></p>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>

<?php get_footer(); ?> 