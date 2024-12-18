<?php
/**
 * La plantilla principal del tema
 *
 * @package Tu_Tema
 */

get_header(); ?>

<div class="flex flex-col">
    <!-- Cabecera de la página -->
    <div class="relative flex flex-col overflow-hidden bg-gradient-to-b from-[#0e141b] to-[#232b35] pb-8 pt-16">
        <div class="@container">
            <div class="flex flex-col items-center gap-6 px-4 py-10 @[480px]:gap-8 @[480px]:px-10">
                <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl text-center">
                    <?php _e('Blog de Xàtiva', 'tu-tema'); ?>
                </h1>
                
                <!-- Buscador -->
                <form role="search" method="get" class="w-full max-w-[480px]" action="<?php echo esc_url(home_url('/')); ?>">
                    <label class="flex flex-col min-w-40 h-14 w-full @[480px]:h-16">
                        <div class="flex w-full flex-1 items-stretch rounded-xl h-full">
                            <div class="text-[#4e7097] flex border border-[#d0dbe7] bg-slate-50 items-center justify-center pl-[15px] rounded-l-xl border-r-0">
                                <i class="ph ph-magnifying-glass text-xl"></i>
                            </div>
                            <input type="search" name="s" 
                                class="flex-1 rounded-r-xl border border-[#d0dbe7] border-l-0 bg-slate-50 px-3 text-[#0e141b] placeholder:text-[#4e7097]" 
                                placeholder="<?php esc_attr_e('Buscar en el blog...', 'tu-tema'); ?>"
                                value="<?php echo get_search_query(); ?>">
                        </div>
                    </label>
                </form>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="px-4 md:px-10 py-5">
        <div class="mx-auto">
            <?php if (have_posts()) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('flex flex-col bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow'); ?>>
                            <?php if (has_post_thumbnail()): ?>
                                <div class="aspect-video">
                                    <img src="<?php echo get_the_post_thumbnail_url(null, 'medium_large'); ?>" 
                                         alt="<?php the_title_attribute(); ?>"
                                         class="w-full h-full object-cover">
                                </div>
                            <?php endif; ?>
                            
                            <div class="flex flex-col gap-4 p-4">
                                <div class="flex flex-col gap-2">
                                    <h2 class="text-[#0e141b] text-xl font-bold leading-tight">
                                        <?php the_title(); ?>
                                    </h2>
                                    <p class="text-[#4e7097] text-sm">
                                        <?php echo get_the_date(); ?> • <?php echo get_the_author(); ?>
                                    </p>
                                </div>
                                
                                <div class="text-[#4e7097] text-sm line-clamp-3">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="flex items-center justify-center rounded-xl h-10 px-4 bg-[#1979e6] text-white text-sm font-bold hover:bg-[#1565c0] transition-colors">
                                    <?php _e('Leer más', 'tu-tema'); ?>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="flex items-center justify-center p-8">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => '<i class="ph ph-caret-left"></i>',
                        'next_text' => '<i class="ph ph-caret-right"></i>',
                        'before_page_number' => '<span class="flex items-center justify-center w-10 h-10 rounded-full bg-[#e7edf3] text-[#0e141b] font-bold">',
                        'after_page_number' => '</span>'
                    ));
                    ?>
                </div>
            <?php else : ?>
                <p><?php esc_html_e('No hay entradas para mostrar.', 'tu-tema'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 