<?php get_header(); ?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        <?php
        // Obtener el post más reciente
        $featured_post = new WP_Query(array(
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        
        if ($featured_post->have_posts()) : while ($featured_post->have_posts()) : $featured_post->the_post(); ?>
            <div class="@container">
                <div class="flex flex-col gap-6 px-4 py-10 @[480px]:gap-8 @[864px]:flex-row">
                    <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl @[480px]:h-auto @[480px]:min-w-[400px] @[864px]:w-full"
                        style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
                    </div>
                    <div class="flex flex-col gap-6 @[480px]:min-w-[400px] @[480px]:gap-8 @[864px]:justify-center">
                        <div class="flex flex-col gap-2 text-left">
                            <h1 class="text-[#0e141b] text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em]">
                                <?php the_title(); ?>
                            </h1>
                            <h2 class="text-[#0e141b] text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal">
                                <?php echo get_the_author(); ?> • <?php echo get_the_date(); ?>
                            </h2>
                        </div>
                        <a href="<?php the_permalink(); ?>" 
                           class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-[#1979e6] text-slate-50 text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em]">
                            <span class="truncate"><?php _e('Leer', 'tu-tema'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        <?php 
        endwhile; 
        wp_reset_postdata();
        endif; 
        ?>

        <!-- Grid de posts -->
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'posts_per_page' => 6,
            'offset' => 1,
            'paged' => $paged
        );
        $the_query = new WP_Query($args);
        
        if ($the_query->have_posts()) : ?>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <div class="flex flex-col gap-3 pb-3">
                        <a href="<?php the_permalink(); ?>" class="block">
                            <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl"
                                style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>');">
                            </div>
                            <div>
                                <p class="text-[#0e141b] text-base font-medium leading-normal"><?php the_title(); ?></p>
                                <p class="text-[#4e7097] text-sm font-normal leading-normal">
                                    <?php echo get_the_author(); ?> • <?php echo get_the_date(); ?>
                                </p>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Paginación -->
            <div class="flex items-center justify-center p-4">
                <?php
                echo paginate_links(array(
                    'total' => $the_query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" fill="currentColor" viewBox="0 0 256 256"><path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"></path></svg>',
                    'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" fill="currentColor" viewBox="0 0 256 256"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>',
                    'type' => 'list',
                    'class' => 'pagination-links'
                ));
                ?>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </div>
</div>

<?php get_footer(); ?> 