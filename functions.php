<?php
/**
 * Funciones y definiciones del tema
 *
 * @package Tu_Tema
 */

// Cargar todos los archivos de funcionalidad
$includes = [
    'setup.php',          // Configuración básica del tema
    'post-types.php',     // Custom Post Types
    'taxonomies.php',     // Taxonomías
    'assets.php',         // Scripts, estilos y recursos
    'acf.php',           // Configuración de ACF
    'admin.php',         // Funciones de administración
    'helpers.php',       // Funciones auxiliares
    'meta-boxes.php',    // Custom Meta Boxes
    'maps.php',          // Configuración de mapas
];

foreach ($includes as $file) {
    $file_path = get_template_directory() . '/includes/' . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
    }
}
