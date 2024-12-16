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

// Aplicar filtros si existen
if (!empty($_GET['category'])) {
    $args['tax_query'][] = array(
        'taxonomy' => 'explore_category',
        'field' => 'slug',
        'terms' => $_GET['category'],
        'operator' => 'IN'
    );
}

$explore_query = new WP_Query($args);
?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
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
        <form method="get" class="filter-form relative">
            <h3 class="text-[#0e141b] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">
                <?php _e('Filtros', 'tu-tema'); ?>
            </h3>
            <div class="flex gap-3 p-3">
                <!-- Categorías -->
                <?php if (!is_wp_error($categories) && !empty($categories)) : ?>
                <div class="relative">
                    <button type="button" class="filter-dropdown-toggle flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-xl bg-[#e7edf3] pl-4 pr-2">
                        <p class="text-[#0e141b] text-sm font-medium leading-normal whitespace-nowrap"><?php _e('Categoría', 'tu-tema'); ?></p>
                        <div class="text-[#0e141b]">
                            <i class="ph ph-caret-down text-xl"></i>
                        </div>
                    </button>
                    <div class="filter-dropdown hidden absolute top-full left-0 mt-2 w-48 rounded-xl bg-white shadow-lg z-50">
                        <div class="py-2">
                            <?php foreach ($categories as $category) : ?>
                                <label class="flex items-center px-4 py-2 hover:bg-[#e7edf3] cursor-pointer">
                                    <input type="checkbox" 
                                           name="category[]" 
                                           value="<?php echo esc_attr($category->slug); ?>"
                                           <?php checked(isset($_GET['category']) && in_array($category->slug, (array)$_GET['category'])); ?>>
                                    <span class="ml-2"><?php echo esc_html($category->name); ?></span>
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

        <!-- Listado de lugares -->
        <?php if ($explore_query->have_posts()): ?>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
                <?php while ($explore_query->have_posts()): $explore_query->the_post(); 
                    $categories = get_the_terms(get_the_ID(), 'explore_category');
                    $category_name = $categories ? $categories[0]->name : '';
                ?>
                    <a href="<?php the_permalink(); ?>" class="group flex flex-col gap-3 pb-3 hover:opacity-90 transition-opacity">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl group-hover:shadow-md transition-shadow"
                                style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>');">
                            </div>
                        <?php endif; ?>
                        <div>
                            <p class="text-[#0e141b] text-base font-medium leading-normal group-hover:text-[#1979e6] transition-colors"><?php the_title(); ?></p>
                            <?php if ($category_name): ?>
                                <p class="text-[#4e7097] text-sm font-normal leading-normal"><?php echo esc_html($category_name); ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endwhile; ?>
            </div>

            <!-- Paginación -->
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
        <?php else: ?>
            <p class="text-center py-8"><?php _e('No se encontraron lugares para explorar.', 'tu-tema'); ?></p>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>

<?php get_footer(); ?> 