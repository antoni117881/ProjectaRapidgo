<?php
// resource_filtro.php
require_once __DIR__. '/../Modelo/BDDConection.php';
require_once __DIR__. '/../Modelo/modelofiltro.php';

// Crear conexión
$conection = DB::getInstance();
$productoModelo = new filtroModelo($conection);

// Obtener todas las categorías
$categorias = $productoModelo->obtenerTodasCategorias(); // Asegúrate de que este método esté definido

// Verifica si se obtuvieron categorías
if ($categorias) {
    foreach ($categorias as $categoria) {
        echo 'Categoría: ' . htmlspecialchars($categoria['nombre']) . '<br>';
    }
} else {
    echo "No se encontraron categorías.";
}

// Verificar si se han enviado categorías
if (isset($_GET['categorias'])) {
    $categoriasSeleccionadas = $_GET['categorias'];

    // Crear una cadena de consulta con las categorías seleccionadas
    $ids = implode(',', array_map('intval', $categoriasSeleccionadas));
    $consulta = "SELECT * FROM productos WHERE id_categoria IN ($ids)";

    // Ejecutar la consulta
    $resultado = $conection->query($consulta);

    // Verificar si hay resultados
    
}
?>
