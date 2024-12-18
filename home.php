<?php get_header(); ?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col flex-1">
        <!-- Post Destacado -->
        <?php
        $featured_post = new WP_Query(array(
            'posts_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC'
        ));
        
        if ($featured_post->have_posts()) : while ($featured_post->have_posts()) : $featured_post->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="block mb-8">
                <div class="flex flex-col md:flex-row gap-6 bg-white rounded-xl overflow-hidden">
                    <div class="w-full md:w-1/2 aspect-video bg-cover bg-center" 
                         style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
                    </div>
                    <div class="flex flex-col justify-center p-6 md:w-1/2">
                        <h2 class="text-4xl font-black mb-4"><?php the_title(); ?></h2>
                        <div class="flex items-center text-[#4e7097] text-sm gap-2">
                            <span>Por <?php the_author(); ?></span>
                            <span>•</span>
                            <span><?php echo get_the_date(); ?></span>
                            <span>•</span>
                            <span>5 min de lectura</span>
                        </div>
                        <div class="mt-4">
                            <span class="inline-block bg-[#1979e6] text-white px-6 py-2 rounded-lg">Leer</span>
                        </div>
                    </div>
                </div>
            </a>
        <?php 
        endwhile; 
        wp_reset_postdata();
        endif; 
        ?>

        <!-- Grid de Posts -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $args = array(
                'posts_per_page' => 6,
                'offset' => 1,
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1
            );
            $the_query = new WP_Query($args);
            
            if ($the_query->have_posts()) : 
                while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="block group">
                        <div class="bg-white rounded-xl overflow-hidden transition-shadow hover:shadow-lg">
                            <div class="aspect-video bg-cover bg-center" 
                                 style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>');">
                            </div>
                            <div class="p-6">
                                <h3 class="font-bold text-xl mb-2 group-hover:text-[#1979e6]"><?php the_title(); ?></h3>
                                <div class="flex items-center text-[#4e7097] text-sm gap-2">
                                    <span>Por <?php the_author(); ?></span>
                                    <span>•</span>
                                    <span>5 min de lectura</span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endwhile;
            endif; 
            wp_reset_postdata(); 
            ?>
        </div>

        <!-- Paginación -->
        <div class="flex justify-center mt-8">
            <?php
            echo paginate_links(array(
                'total' => $the_query->max_num_pages,
                'current' => max(1, get_query_var('paged')),
                'prev_text' => '<i class="ph ph-arrow-left"></i>',
                'next_text' => '<i class="ph ph-arrow-right"></i>',
                'type' => 'list'
            ));
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 