<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Productos</title>
    <style>
        .filtros-container {
            float: left;
            width: 20%;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 8px;
        }
        .productos-container {
            float: right;
            width: 75%;
            padding: 15px;
        }
        .checkbox-group {
            margin-bottom: 10px;
        }
        .checkbox-group label {
            display: block;
            margin: 5px 0;
            cursor: pointer;
        }
        .producto-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .btn-filtrar {
            background: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        .btn-filtrar:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="filtros-container">
        <h3>Filtrar por Categorías</h3>
        <form id="filtroForm" action="" method="GET">
            <?php
            require_once 'Controller/filtro.php';
            require_once __DIR__. '/../Modelo/BDDConection.php';
           

            // Obtener categorías seleccionadas previamente
            $categoriasSeleccionadas = isset($_GET['categorias']) ? $_GET['categorias'] : [];
            
            foreach ($categorias as $categoria) {
                $checked = in_array($categoria['id_categoria'], $categoriasSeleccionadas) ? 'checked' : '';
                echo '<div class="checkbox-group">';
                echo '<label>';
                echo '<input type="checkbox" name="categorias[]" value="' . htmlspecialchars($categoria['id_categoria']) . '" ' . $checked . '>';
                echo htmlspecialchars($categoria['nombre']);
                echo '</label>';
                echo '</div>';
            }
            ?>
            <button type="submit" class="btn-filtrar">Aplicar Filtros</button>
        </form>
    </div>

    <div class="productos-container">
        <?php
        // Construir la consulta SQL base
        $sql = "SELECT * FROM productos WHERE 1=1";
        $params = [];

        // Añadir filtros si hay categorías seleccionadas
        if (!empty($categoriasSeleccionadas)) {
            $placeholders = str_repeat('?,', count($categoriasSeleccionadas) - 1) . '?';
            $sql .= " AND id_categoria IN ($placeholders)";
            $params = $categoriasSeleccionadas;
        }

        // Ejecutar la consulta
        $stmt = $conection->prepare($sql);
        $stmt->execute($params);

        // Mostrar resultados
        while ($producto = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="producto-card">';
            echo '<h3>' . htmlspecialchars($producto['Nombre']) . '</h3>';
            echo '<p>Categoría: ' . htmlspecialchars($producto['id_categoria']) . '</p>';
            echo '<p>Precio: €' . htmlspecialchars($producto['PrecioUnidad']) . '</p>';
            // Añade más detalles del producto según tu estructura de base de datos
            echo '</div>';
        }

        if ($stmt->rowCount() == 0) {
            echo '<p>No se encontraron productos con los filtros seleccionados.</p>';
        }
        ?>
    </div>

    <script>
        // Actualización dinámica de los resultados (opcional)
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                document.getElementById('filtroForm').submit();
            });
        });
    </script>
</body>
</html> 