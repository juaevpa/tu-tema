<?php
/**
 * Header template
 *
 * @package Tu_Tema
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?display=swap&family=Noto+Sans:wght@400;500;700;900&family=Plus+Jakarta+Sans:wght@400;500;700;800" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen flex flex-col bg-[#f8fafc]'); ?>>
    <?php wp_body_open(); ?>
    <div class="flex min-h-screen flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e7edf3] px-4 md:px-10 py-3">
            <div class="mx-auto max-w-[1440px] w-full flex items-center justify-between">
                <div class="flex items-center gap-8">
                    <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-4 text-[#0e141b]">
                        <div class="size-4">
                            <i class="ph ph-mountains text-xl"></i>
                        </div>
                        <h2 class="text-[#0e141b] text-lg font-bold leading-tight tracking-[-0.015em]">Paraíso Ciclista</h2>
                    </a>
                    
                    <nav class="items-center gap-9">
                        <button id="mobile-menu-button" class="md:hidden text-[#0e141b]">
                            <i class="ph ph-list text-2xl"></i>
                        </button>
                        
                        <div id="menu-items" class="hidden md:flex items-center gap-9 absolute md:relative left-0 right-0 top-full md:top-auto bg-white md:bg-transparent p-4 md:p-0 border-b border-[#e7edf3] md:border-0 flex-col md:flex-row">
                            <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_post_type_archive_link('xativa_route'); ?>">
                                <i class="ph ph-map-trifold mr-1"></i>Rutas
                            </a>
                            <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_permalink(get_option('page_for_posts')); ?>">
                                <i class="ph ph-article mr-1"></i>Blog
                            </a>
                            <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_permalink(33); ?>">
                                Sobre nosotros
                            </a>
                            <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_post_type_archive_link('xativa_explore'); ?>">
                                <i class="ph ph-compass mr-1"></i>Explorar
                            </a>
                            <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_post_type_archive_link('xativa_restaurant'); ?>">
                                <i class="ph ph-fork-knife mr-1"></i>Restaurantes
                            </a>
                            <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_post_type_archive_link('xativa_hotel'); ?>">
                                <i class="ph ph-bed mr-1"></i>Alojamiento
                            </a>
                        </div>
                    </nav>
                </div>

                <div class="flex flex-1 justify-end gap-8">
                    <?php get_search_form(); ?>
                    <div class="hidden md:flex gap-2">
                        <button class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 bg-[#e7edf3] text-[#0e141b] gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5">
                            <i class="ph ph-globe text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

<script>
document.getElementById('mobile-menu-button').addEventListener('click', function() {
    document.getElementById('menu-items').classList.toggle('hidden');
});
</script>
</body>
</html> 