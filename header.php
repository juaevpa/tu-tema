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
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Plus+Jakarta+Sans%3Awght%40400%3B500%3B700%3B800"
    />
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <?php wp_head(); ?>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>
<body <?php body_class(); ?>>
    <div class="relative flex size-full min-h-screen flex-col bg-slate-50 group/design-root overflow-x-hidden" style='font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'>
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#e7edf3] px-10 py-3">
          <div class="flex items-center gap-8">
            <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-4 text-[#0e141b]">
                <div class="size-4">
                    <i class="ph ph-mountains text-xl"></i>
                </div>
                <h2 class="text-[#0e141b] text-lg font-bold leading-tight tracking-[-0.015em]">Cycling Xàtiva</h2>
            </a>
            <div class="flex items-center gap-9">
              <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_post_type_archive_link('xativa_route'); ?>">Routes</a>
              <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Blog</a>
              <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_page_link(get_page_by_path('about')); ?>">About</a>
              <a class="text-[#0e141b] text-sm font-medium leading-normal" href="<?php echo get_page_link(get_page_by_path('add-route')); ?>">Add a route</a>
            </div>
          </div>
          <div class="flex flex-1 justify-end gap-8">
            <?php get_search_form(); ?>
            <div class="flex gap-2">
              <button class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 bg-[#e7edf3] text-[#0e141b] gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5">
                <i class="ph ph-globe text-xl"></i>
              </button>
              <button class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 bg-[#e7edf3] text-[#0e141b] gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5">
                <i class="ph ph-user text-xl"></i>
              </button>
            </div>
          </div>
        </header>
</body>
</html> 