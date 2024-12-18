<?php 
/*
Template Name: Página Inicio
*/
get_header(); ?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col  flex-1">
        <div class="@container">
            <div class="@[480px]:p-4">
                <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-xl items-start justify-end px-4 pb-10 @[480px]:px-10"
                    style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url("https://cdn.usegalileo.ai/sdxl10/c5224f2a-2c7f-45e9-a794-944d15e6a3c4.png");'>
                    <div class="flex flex-col gap-2 text-left">
                        <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em]">
                           Paraíso Ciclista
                        </h1>
                        <h2 class="text-white text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal">
                        Descubre las mejores rutas ciclistas en Xàtiva y sus alrededores. Explora la historia, gastronomía y naturaleza de nuestra región.
                        </h2>
                    </div>
                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex flex-col min-w-40 h-14 w-full max-w-[480px] @[480px]:h-16">
                        <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                            <div class="text-[#4e7097] flex border border-[#d0dbe7] bg-slate-50 items-center justify-center pl-[15px] rounded-l-xl border-r-0">
                                <i class="ph ph-magnifying-glass text-xl"></i>
                            </div>
                            <input 
                                type="search"
                                name="s"
                                placeholder="Buscar, rutas, y más..."
                                class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#0e141b] focus:outline-0 focus:ring-0 border border-[#d0dbe7] bg-slate-50 focus:border-[#d0dbe7] h-full placeholder:text-[#4e7097] px-[15px] rounded-r-none border-r-0 pr-2 rounded-l-none border-l-0 pl-2 text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal"
                                value="<?php echo get_search_query(); ?>" 
                            />
                            <div class="flex items-center justify-center rounded-r-xl border-l-0 border border-[#d0dbe7] bg-slate-50 pr-[7px]">
                                <button type="submit" class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-[#1979e6] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em]">
                                    <span class="truncate">Buscar</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <h2 class="text-[#0e141b] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Featured routes</h2>
        <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
            <?php
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

            if ($featured_routes->have_posts()) :
                while ($featured_routes->have_posts()) : $featured_routes->the_post();
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
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <div class="col-span-3 text-center py-4 text-[#4e7097]">
                    <?php _e('No featured routes found.', 'tu-tema'); ?>
                </div>
            <?php endif; ?>
        </div>

        <h2 class="text-[#0e141b] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Dónde comer y alojarse</h2>
        <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
            <?php
            // Obtener los últimos restaurantes
            $restaurants = new WP_Query(array(
                'post_type' => 'xativa_restaurant',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            if ($restaurants->have_posts()) :
                while ($restaurants->have_posts()) : $restaurants->the_post();
                    $rating = get_post_meta(get_the_ID(), 'rating', true);
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
                            <?php if ($rating) : ?>
                                <p class="text-[#4e7097] text-sm font-normal leading-normal">
                                    <?php echo esc_html($rating); ?>/5 ⭐
                                </p>
                            <?php endif; ?>
                        </div>
                    </a>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;

            // Obtener los últimos hoteles
            $hotels = new WP_Query(array(
                'post_type' => 'xativa_hotel',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            ));

            if ($hotels->have_posts()) :
                while ($hotels->have_posts()) : $hotels->the_post();
                    $rating = get_post_meta(get_the_ID(), 'rating', true);
                    $permalink = get_permalink();
            ?>
                    <a href="<?php echo esc_url($permalink); ?>" class="group flex flex-col gap-3 pb-3 hover:opacity-90 transition-opacity">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl group-hover:shadow-md transition-shadow"
                                style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>');">
                            </div>
                        <?php endif; ?>
                        <div>
                            <p class="text-[#0e141b] text-base font-medium leading-normal group-hover:text-[#1979e6] transition-colors">
                                <i class="ph ph-bed text-[#4e7097]"></i> <?php the_title(); ?>
                            </p>
                            <?php if ($rating) : ?>
                                <p class="text-[#4e7097] text-sm font-normal leading-normal">
                                    <?php echo esc_html($rating); ?>/5 ⭐
                                </p>
                            <?php endif; ?>
                        </div>
                    </a>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="flex justify-center gap-4 mt-4 mb-8">
            <a href="<?php echo get_post_type_archive_link('xativa_restaurant'); ?>" 
               class="inline-flex items-center px-4 py-2 bg-[#1979e6] text-white rounded-lg hover:bg-[#1565c0] transition-colors">
                <i class="ph ph-fork-knife mr-2"></i>
                Ver todos los restaurantes
            </a>
            <a href="<?php echo get_post_type_archive_link('xativa_hotel'); ?>" 
               class="inline-flex items-center px-4 py-2 bg-[#1979e6] text-white rounded-lg hover:bg-[#1565c0] transition-colors">
                <i class="ph ph-bed mr-2"></i>
                Ver todos los alojamientos
            </a>
        </div>

        <h2 class="text-[#0e141b] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Explora Xàtiva</h2>
        <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
            <?php
            $explore_categories = get_terms(array(
                'taxonomy' => 'explore_category',
                'hide_empty' => false
            ));

            if (!is_wp_error($explore_categories) && !empty($explore_categories)) :
                foreach ($explore_categories as $category) :
                    // Obtener la imagen del custom field
                    $imagen_categoria = get_field('imagen_categoria', 'explore_category_' . $category->term_id);
                    $category_url = get_term_link($category);
            ?>
                    <a href="<?php echo esc_url($category_url); ?>" class="group flex flex-col gap-3 pb-3 hover:opacity-90 transition-opacity">
                        <?php if ($imagen_categoria && is_array($imagen_categoria)) : ?>
                            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl group-hover:shadow-md transition-shadow"
                                style="background-image: url('<?php echo esc_url($imagen_categoria['url']); ?>');">
                            </div>
                        <?php endif; ?>
                        <div>
                            <p class="text-[#0e141b] text-base font-medium leading-normal group-hover:text-[#1979e6] transition-colors">
                                <?php echo esc_html($category->name); ?>
                            </p>
                            <p class="text-[#4e7097] text-sm font-normal leading-normal">
                                <?php echo esc_html($category->description); ?>
                            </p>
                        </div>
                    </a>
            <?php
                endforeach;
            endif;
            ?>
        </div>

    </div>
</div>



<?php get_footer(); ?> 