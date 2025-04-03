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
            position: relative;
        }
        .checkbox-group input[type="checkbox"] {
            /* Ocultamos el checkbox original */
            opacity: 0;
            position: absolute;
            cursor: pointer;
        }
        .checkbox-group label {
            display: flex;
            align-items: center;
            margin: 8px 0;
            cursor: pointer;
            color: #444;
            font-size: 0.95em;
            padding-left: 35px; /* Espacio para el nuevo checkbox */
            position: relative;
        }
        /* Creamos el nuevo checkbox personalizado */
        .checkbox-group label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 22px;
            height: 22px;
            border: 2px solid rgb(238, 169, 72);
            border-radius: 6px;
            background-color: white;
            transition: all 0.3s ease;
        }
        /* Creamos el check (✓) */
        .checkbox-group label::after {
            content: '';
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%) scale(0);
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform-origin: center;
            transform: translateY(-65%) rotate(45deg) scale(0);
            transition: all 0.2s ease;
        }
        /* Estilo cuando el checkbox está marcado */
        .checkbox-group input[type="checkbox"]:checked + label::before {
            background-color: #007bff;
            border-color:rgb(213, 143, 30);
        }
        .checkbox-group input[type="checkbox"]:checked + label::after {
            transform: translateY(-65%) rotate(45deg) scale(1);
        }
        /* Efecto hover */
        .checkbox-group label:hover::before {
            border-color: #0056b3;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }
        /* Efecto focus para accesibilidad */
        .checkbox-group input[type="checkbox"]:focus + label::before {
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }
        .producto-card {
            border: none;
            padding: 15px;
            border-radius: 10px;
            width: calc(30% - 20px);
            box-shadow: 0 0px 10px rgba(0, 0, 0, 0.34);
            transition: transform 0.3s ease;
            background: linear-gradient(145deg,rgb(255, 183, 0),rgb(228, 68, 4));
            color: white;
            margin-bottom: 20px;
            
        }
        .product-card{
            box-shadow: 0 -3px 5px rgb(0, 0, 0);
        }
        .producto-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 10px rgba(0,0,0,0.2);
        }
        .imagen-producto {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 15px;
            border: 3px rgba(90, 139, 49, 0.78) solid;
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
            border: 3px rgba(90, 139, 49, 0.78) solid;
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
        .checkbox-group >input{
            border: 5px rgba(90, 139, 49, 0.78) solid;
            
        }
    </style>
</head>
<body class="body">
    <div class="filtros-container">
        <h3>Filtrar por Alergenos</h3>
        <br>
        <form id="filtroForm" action="" method="GET">
            <?php
            require_once 'Controller/filtro.php';
            require_once __DIR__. '/../Modelo/BDDConection.php';
           

            // Obtener categorías seleccionadas previamente
            $categoriasSeleccionadas = isset($_GET['categorias']) ? $_GET['categorias'] : [];
            
            foreach ($categorias as $categoria) {
                $checked = in_array($categoria['id_categoria'], $categoriasSeleccionadas) ? 'checked' : '';
                echo '<div class="checkbox-group">';
                echo '<input type="checkbox" id="cat_' . $categoria['id_categoria'] . '" name="categorias[]" value="' . htmlspecialchars($categoria['id_categoria']) . '" ' . $checked . '>';
                echo '<label for="cat_' . $categoria['id_categoria'] . '">' . htmlspecialchars($categoria['nombre']) . '</label>';
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