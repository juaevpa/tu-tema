<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        rel="stylesheet"
        as="style"
        onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Plus+Jakarta+Sans%3Awght%40400%3B500%3B700%3B800"
    />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class('relative flex size-full min-h-screen flex-col bg-slate-50 group/design-root overflow-x-hidden'); ?> style='font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e7edf3] px-10 py-3">
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-4 text-[#0e141b]">
                    <a href="<?php echo home_url(); ?>" class="flex items-center gap-4 text-[#0e141b]">
                        <div class="size-4">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.8261 30.5736C16.7203 29.8826 20.2244 29.4783 24 29.4783C27.7756 29.4783 31.2797 29.8826 34.1739 30.5736C36.9144 31.2278 39.9967 32.7669 41.3563 33.8352L24.8486 7.36089C24.4571 6.73303 23.5429 6.73303 23.1514 7.36089L6.64374 33.8352C8.00331 32.7669 11.0856 31.2278 13.8261 30.5736Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M39.998 35.764C39.9944 35.7463 39.9875 35.7155 39.9748 35.6706C39.9436 35.5601 39.8949 35.4259 39.8346 35.2825C39.8168 35.2403 39.7989 35.1993 39.7813 35.1602C38.5103 34.2887 35.9788 33.0607 33.7095 32.5189C30.9875 31.8691 27.6413 31.4783 24 31.4783C20.3587 31.4783 17.0125 31.8691 14.2905 32.5189C12.0012 33.0654 9.44505 34.3104 8.18538 35.1832C8.17384 35.2075 8.16216 35.233 8.15052 35.2592C8.09919 35.3751 8.05721 35.4886 8.02977 35.589C8.00356 35.6848 8.00039 35.7333 8.00004 35.7388C8.00004 35.739 8 35.7393 8.00004 35.7388C8.00004 35.7641 8.0104 36.0767 8.68485 36.6314C9.34546 37.1746 10.4222 37.7531 11.9291 38.2772C14.9242 39.319 19.1919 40 24 40C28.8081 40 33.0758 39.319 36.0709 38.2772C37.5778 37.7531 38.6545 37.1746 39.3151 36.6314C39.9006 36.1499 39.9857 35.8511 39.998 35.764Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <h2 class="text-[#0e141b] text-lg font-bold leading-tight tracking-[-0.015em]">
                            <?php bloginfo('name'); ?>
                        </h2>
                    </a>
                </div>
                <nav class="flex items-center gap-9">
                    <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_post_type_archive_link('xativa_route'); ?>">Rutas</a>
                    <a class="text-[#0e141b] text-sm font-medium leading-normal" href="/blog">Blog</a>
                    <a class="text-[#0e141b] text-sm font-medium leading-normal" href="/about">Sobre Nosotros</a>
                    <a class="text-[#0e141b] text-sm font-medium leading-normal" href="/add-route">Añadir Ruta</a>
                </nav>
            </div>
            <div class="flex flex-1 justify-end gap-8">
                <?php get_search_form(); ?>
            </div>
        </header>
</body>
</html> 