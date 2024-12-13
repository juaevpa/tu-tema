<?php
get_header();

// Obtener rutas destacadas
$featured_routes = new WP_Query([
    'post_type' => 'xativa_route',
    'posts_per_page' => 3,
    'meta_query' => [
        [
            'key' => 'featured',
            'value' => '1',
            'compare' => '=',
        ],
    ],
]);

// Obtener secciones de exploración
$explore_sections = [
    'history' => get_posts(['post_type' => 'xativa_history', 'posts_per_page' => 1]),
    'gastronomy' => get_posts(['post_type' => 'xativa_gastronomy', 'posts_per_page' => 1]),
];

// Obtener configuración de la página de inicio
$hero_image = get_field('hero_image', 'option');
$hero_title = get_field('hero_title', 'option');
$hero_subtitle = get_field('hero_subtitle', 'option');
?>

<div class="layout-content-container flex flex-col max-w-[960px] flex-1">
    <!-- Hero Section -->
    <div class="@container">
        <div class="@[480px]:p-4">
            <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-xl items-start justify-end px-4 pb-10 @[480px]:px-10"
                style="background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url('<?php echo esc_url($hero_image['url']); ?>');">
                <div class="flex flex-col gap-2 text-left">
                    <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em]">
                        <?php echo esc_html($hero_title); ?>
                    </h1>
                    <h2 class="text-white text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal">
                        <?php echo esc_html($hero_subtitle); ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Routes -->
    <?php if ($featured_routes->have_posts()): ?>
        <h2 class="text-[#0e141b] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">
            Rutas destacadas
        </h2>
        <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
            <?php while ($featured_routes->have_posts()): $featured_routes->the_post(); ?>
                <div class="flex flex-col gap-3 pb-3">
                    <?php 
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    $distance = get_field('distance');
                    ?>
                    <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl"
                         style="background-image: url('<?php echo esc_url($thumbnail); ?>');">
                    </div>
                    <div>
                        <p class="text-[#0e141b] text-base font-medium leading-normal"><?php the_title(); ?></p>
                        <p class="text-[#4e7097] text-sm font-normal leading-normal"><?php echo esc_html($distance); ?> km</p>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>

    <!-- Explore Section -->
    <!-- Código para la sección de exploración -->
</div>

<?php get_footer(); ?> 