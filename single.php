<?php
get_header();

while (have_posts()) : the_post();
    // Obtener el tiempo de lectura
    $reading_time = get_field('reading_time') ?: '5';
?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col  flex-1">
        <article class="@container">
            <!-- Cabecera del artículo -->
            <header class="flex flex-col gap-6 px-4 py-10 @[480px]:gap-8">
                <div class="flex flex-col gap-4">
                    <h1 class="text-[#0e141b] text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em]">
                        <?php the_title(); ?>
                    </h1>
                    <div class="flex items-center gap-4">
                        <?php
                        // Obtener el avatar del autor
                        $author_avatar = get_avatar(get_the_author_meta('ID'), 40, '', '', array('class' => 'rounded-full'));
                        ?>
                        <div class="flex items-center gap-2">
                            <?php echo $author_avatar; ?>
                            <div class="flex flex-col">
                                <span class="text-[#0e141b] text-sm font-medium leading-normal">
                                    <?php the_author(); ?>
                                </span>
                                <span class="text-[#4e7097] text-sm font-normal leading-normal">
                                    <?php echo get_the_date(); ?> • <?php echo $reading_time; ?> min de lectura
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (has_post_thumbnail()): ?>
                    <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl"
                        style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>');">
                    </div>
                <?php endif; ?>
            </header>

            <!-- Contenido del artículo -->
            <div class="prose prose-lg max-w-none px-4 py-6">
                <?php the_content(); ?>
            </div>

            <!-- Etiquetas -->
            <?php
            $tags = get_the_tags();
            if ($tags): ?>
                <div class="flex flex-wrap gap-2 px-4 py-6">
                    <?php foreach ($tags as $tag): ?>
                        <a href="<?php echo get_tag_link($tag->term_id); ?>"
                           class="rounded-xl bg-[#e7edf3] px-4 py-2 text-sm font-medium text-[#0e141b]">
                            <?php echo $tag->name; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Navegación entre posts -->
            <nav class="flex justify-between px-4 py-6 border-t border-[#e7edf3]">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>
                <div class="flex-1">
                    <?php if ($prev_post): ?>
                        <a href="<?php echo get_permalink($prev_post); ?>" class="flex items-center gap-2 text-[#0e141b]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"></path>
                            </svg>
                            <span class="text-sm font-medium">Anterior</span>
                        </a>
                        <p class="mt-2 text-[#4e7097] text-sm"><?php echo get_the_title($prev_post); ?></p>
                    <?php endif; ?>
                </div>
                <div class="flex-1 text-right">
                    <?php if ($next_post): ?>
                        <a href="<?php echo get_permalink($next_post); ?>" class="flex items-center justify-end gap-2 text-[#0e141b]">
                            <span class="text-sm font-medium">Siguiente</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path>
                            </svg>
                        </a>
                        <p class="mt-2 text-[#4e7097] text-sm"><?php echo get_the_title($next_post); ?></p>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Posts relacionados -->
            <?php
            $related_posts = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => [get_the_ID()],
                'orderby' => 'rand'
            ]);

            if ($related_posts->have_posts()): ?>
                <div class="px-4 py-6 border-t border-[#e7edf3]">
                    <h2 class="text-[#0e141b] text-2xl font-bold mb-6">Posts relacionados</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <?php while ($related_posts->have_posts()): $related_posts->the_post(); ?>
                            <div class="flex flex-col gap-3">
                                <a href="<?php the_permalink(); ?>" class="block">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl mb-3"
                                            style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>');">
                                        </div>
                                    <?php endif; ?>
                                    <h3 class="text-[#0e141b] text-base font-medium leading-normal"><?php the_title(); ?></h3>
                                    <p class="text-[#4e7097] text-sm">
                                        <?php printf(
                                            __('Por %s • %s min de lectura', 'tu-tema'),
                                            get_the_author(),
                                            get_field('reading_time') ?: '5'
                                        ); ?>
                                    </p>
                                </a>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Comentarios -->
            <?php
            if (comments_open() || get_comments_number()):
                comments_template();
            endif;
            ?>
        </article>
    </div>
</div>

<?php
endwhile;
get_footer();
?> 