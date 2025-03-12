<?php
// resource_filtro.php

// Verificar si se han enviado categorías
if (isset($_POST['categorias'])) {
    $categorias = $_POST['categorias'];

    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "usuario", "contraseña", "base_de_datos");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Crear una cadena de consulta con las categorías seleccionadas
    $ids = implode(',', array_map('intval', $categorias));
    $consulta = "SELECT * FROM productos WHERE categoria_id IN ($ids)";

    // Ejecutar la consulta
    $resultado = $conexion->query($consulta);

    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // Mostrar los productos filtrados
        while ($producto = $resultado->fetch_assoc()) {
            echo 'Producto: ' . $producto['nombre'] . '<br>';
            echo 'Precio: ' . $producto['precio'] . '<br><br>';
        }
    } else {
        echo "No se encontraron productos para las categorías seleccionadas.";
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo "No se seleccionaron categorías.";
}
?>
