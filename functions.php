<?php
/**
 * Funciones y definiciones del tema
 *
 * @package Tu_Tema
 */

// Definir constantes del tema
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());

// Cargar archivos de funcionalidad core
require_once THEME_DIR . '/includes/core/setup.php';        // Configuración básica
require_once THEME_DIR . '/includes/core/assets.php';       // Scripts y estilos
require_once THEME_DIR . '/includes/core/theme-support.php'; // Soporte del tema

// Cargar archivos de funcionalidad de contenido
require_once THEME_DIR . '/includes/content/post-types.php';  // Custom Post Types
require_once THEME_DIR . '/includes/content/taxonomies.php';  // Taxonomías
require_once THEME_DIR . '/includes/content/meta-boxes.php';  // Meta Boxes

// Cargar archivos de funcionalidad específica
require_once THEME_DIR . '/includes/features/maps.php';      // Configuración de mapas
require_once THEME_DIR . '/includes/features/admin.php';     // Funciones admin
require_once THEME_DIR . '/includes/features/acf.php';       // Config ACF

// Cargar archivos de AJAX handlers
require_once THEME_DIR . '/includes/ajax/restaurants.php';   // Filtros restaurantes
require_once THEME_DIR . '/includes/ajax/hotels.php';        // Filtros hoteles
require_once THEME_DIR . '/includes/ajax/chat.php';          // Chat assistant

// Cargar archivos de enriquecimiento de contenido
require_once THEME_DIR . '/includes/content-enrichment.php';

// Añadir al menú de administración
function add_photo_update_menu() {
    add_submenu_page(
        'edit.php?post_type=xativa_explore',
        'Actualizar Fotos',
        'Actualizar Fotos Reales',
        'manage_options',
        'update-explore-photos',
        'render_photo_update_page'
    );
}
add_action('admin_menu', 'add_photo_update_menu');

// Renderizar página de administración
function render_photo_update_page() {
    ?>
    <div class="wrap">
        <h1>Actualizar Fotos de Lugares</h1>
        <p>Haz clic en el botón para buscar y actualizar las fotos reales de los lugares.</p>
        <form method="post">
            <?php wp_nonce_field('update_explore_photos', 'explore_photos_nonce'); ?>
            <input type="submit" name="update_photos" class="button button-primary" value="Actualizar Fotos">
        </form>
    </div>
    <?php
    
    if (isset($_POST['update_photos']) && check_admin_referer('update_explore_photos', 'explore_photos_nonce')) {
        add_real_photos_to_explore_places();
    }
}

// Agregar función AJAX para filtrar lugares
function filter_explore_ajax_handler() {
    $categories = !empty($_POST['categories']) ? explode(',', $_POST['categories']) : [];
    $search = !empty($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $args = array(
        'post_type' => 'xativa_explore',
        'posts_per_page' => 12,
    );

    if (!empty($categories)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'explore_category',
            'field' => 'slug',
            'terms' => $categories,
            'operator' => 'IN'
        );
    }

    if (!empty($search)) {
        $args['s'] = $search;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">';
        while ($query->have_posts()) : $query->the_post();
            $categories = get_the_terms(get_the_ID(), 'explore_category');
            $category_name = $categories ? $categories[0]->name : '';
            ?>
            <a href="<?php the_permalink(); ?>" class="group flex flex-col overflow-hidden rounded-xl border border-[#d0dbe7] bg-white transition-all hover:-translate-y-0.5 hover:shadow-lg">
                <?php if (has_post_thumbnail()): ?>
                    <div class="aspect-[16/10] w-full overflow-hidden">
                        <div class="h-full w-full bg-cover bg-center bg-no-repeat transition-transform duration-300 group-hover:scale-105"
                            style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>');">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="flex flex-col gap-2 p-4">
                    <div class="flex items-center gap-2">
                        <?php if ($category_name): ?>
                            <span class="rounded-lg bg-[#e7edf3] px-3 py-1 text-sm font-medium text-[#4e7097]">
                                <?php echo esc_html($category_name); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <h3 class="text-lg font-bold text-[#0e141b] group-hover:text-[#1979e6]">
                        <?php the_title(); ?>
                    </h3>
                </div>
            </a>
        <?php endwhile;
        echo '</div>';
    else:
        echo '<p class="text-center py-8">' . __('No se encontraron lugares para explorar.', 'tu-tema') . '</p>';
    endif;
    wp_reset_postdata();
    die();
}
add_action('wp_ajax_filter_explore', 'filter_explore_ajax_handler');
add_action('wp_ajax_nopriv_filter_explore', 'filter_explore_ajax_handler');

