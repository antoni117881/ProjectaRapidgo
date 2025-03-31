<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar Productos</title>
    <style>
        .body {
            background: rgb(253, 224, 156);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .filtros-container {
            float: left;
            width: 20%;
            padding: 20px;
            background: white;
            box-shadow: 2px 10px 10px rgba(0,0,0,0.1);
        }
        .filtros-container h3 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.5em;
        }
        .productos-container {
            float: right;
            width: 75%;
            padding: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
        }
        .checkbox-group {
            margin-bottom: 15px;
        }
        .checkbox-group label {
            display: flex;
            align-items: center;
            margin: 8px 0;
            cursor: pointer;
            color: #444;
            font-size: 0.95em;
        }
        .checkbox-group input[type="checkbox"] {
            margin-right: 10px;
        }
        .producto-card {
            border: none;
            padding: 15px;
            border-radius: 20px;
            width: calc(30% - 20px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            background: linear-gradient(145deg,rgb(255, 183, 0),rgb(228, 68, 4));
            color: white;
            margin-bottom: 20px;
        }
        .producto-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .imagen-producto {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 15px;
        }
        .producto-card h3 {
            font-size: 1.4em;
            margin: 10px 0;
        }
        .producto-card p {
            margin: 8px 0;
            font-size: 1.1em;
        }
    
      
        .boton2 {
            background: white;
            color:rgb(221, 16, 16);
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .boton2:hover {
            background: #f8f9fa;
            transform: scale(1.02);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .precio {
            font-size: 1.2em;
            font-weight: bold;
            color: white;
        }
        .categoria {
            font-size: 0.9em;
            color: rgba(255,255,255,0.9);
        }
        .productos-container::after {
            content: '';
            flex: auto;
        }
    </style>
</head>
<body class="body">
    <div class="filtros-container">
        <h3>Filtrar por Alergenos</h3>
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
            echo '<img class="imagen-producto" src="' . $producto['Imagen'] . '" alt="' . $producto['Nombre'] . '"/>';
            echo '<h3>' . htmlspecialchars($producto['Nombre']) . '</h3>';
            echo '<p class="categoria">Categoría: ' . htmlspecialchars($producto['id_categoria']) . '</p>';
            echo '<p class="precio">€' . htmlspecialchars($producto['PrecioUnidad']) . '</p>';
            echo '<form action="?action=registroProduct" method="POST">';
            echo '<input type="hidden" name="idProducto" value="' . $producto['ID'] . '">';
            echo '<button type="submit" class="boton2">Ver detalles del producto</button>';
            echo '</form>';
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