<?php
/**
 * Template for displaying all pages
 */

get_header(); ?>

<div class="flex flex-col">
    <!-- Cabecera de la página -->
    <div class="relative flex flex-col overflow-hidden bg-gradient-to-b from-[#0e141b] to-[#232b35] pb-8 pt-16">
        <div class="@container">
            <div class="flex flex-col items-center gap-6 px-4 py-10 @[480px]:gap-8 @[480px]:px-10">
                <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl text-center">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="px-4 md:px-10 py-5">
        <div class="mx-auto max-w-4xl">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-xl p-6 md:p-10 shadow-sm'); ?>>
                    <div class="prose prose-slate max-w-none
                        prose-headings:text-[#0e141b] prose-headings:font-bold
                        prose-h1:text-3xl prose-h1:mb-8
                        prose-h2:text-2xl prose-h2:mt-8 prose-h2:mb-4
                        prose-p:text-[#4e7097] prose-p:text-base prose-p:leading-relaxed
                        prose-ul:text-[#4e7097] prose-ul:my-4
                        prose-li:my-2
                        prose-a:text-[#1979e6] prose-a:no-underline hover:prose-a:text-[#1565c0]">
                        <?php the_content(); ?>
                    </div>

                    <?php if (get_edit_post_link()) : ?>
                        <div class="mt-8 text-sm text-[#4e7097]">
                            <?php edit_post_link(__('Editar', 'xativa')); ?>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 