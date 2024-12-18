<?php
/**
 * Funciones de Administración
 *
 * @package Tu_Tema
 */

// Ocultar los menús de administración de los tipos de contenido antiguos
function remove_old_post_type_menus() {
    remove_menu_page('edit.php?post_type=xativa_history');
    remove_menu_page('edit.php?post_type=xativa_gastronomy');
    remove_menu_page('edit.php?post_type=xativa_local_history');
    remove_menu_page('edit.php?post_type=xativa_local_gastronomy');
}
add_action('admin_menu', 'remove_old_post_type_menus', 999);

// Mostrar plantilla actual en la barra de admin
function mostrar_plantilla_actual() {
    if (!is_admin() && current_user_can('administrator')) {
        global $template;
        $nombre_plantilla = basename($template);
        
        $post_type = get_post_type();
        
        $mensaje = "Plantilla: <strong>{$nombre_plantilla}</strong>";
        if ($post_type) {
            $mensaje .= " | Post Type: <strong>{$post_type}</strong>";
        }
        
        global $wp_admin_bar;
        $wp_admin_bar->add_node(array(
            'id'    => 'plantilla-actual',
            'title' => $mensaje,
            'href'  => '#',
            'meta'  => array(
                'class' => 'plantilla-actual'
            )
        ));
    }
}
add_action('admin_bar_menu', 'mostrar_plantilla_actual', 100);

// Estilos para el indicador de plantilla
function estilos_plantilla_actual() {
    if (!is_admin() && current_user_can('administrator')) {
        ?>
        <style>
            #wp-admin-bar-plantilla-actual {
                background: #
        </style>
        <?php
    }
}
add_action('admin_head', 'estilos_plantilla_actual'); 