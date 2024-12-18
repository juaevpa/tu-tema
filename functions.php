<?php
/**
 * Funciones y definiciones del tema
 *
 * @package Tu_Tema
 */

// Cargar todos los archivos de funcionalidad
$includes = [
    'post-types.php',     // Custom Post Types
    'taxonomies.php',     // Taxonomías
    'scripts.php',        // Scripts y estilos
    'theme-support.php',  // Soporte del tema
    'acf.php',           // Configuración de ACF
    'admin.php',         // Funciones de administración
    'helpers.php'        // Funciones auxiliares
];

foreach ($includes as $file) {
    require_once get_template_directory() . '/includes/' . $file;
}