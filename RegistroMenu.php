<html>
<head>
    <title>Página Principal</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'Vista/Vistaheader.php'; ?>
    </header>
    <main>
        <div class="productos">
            <?php
            require_once 'Controlador/Menu.php'; // Asegúrate de que esto esté correcto
            
            // Crear una instancia de ProductoModelo
            $productoModelo = new ProductoModelo($conection);
            $productos = $productoModelo->ProductosInicio(); // Llama al método

            // Incluir el archivo que muestra los productos
            require_once 'Vista/VistaProductos.php';
            ?>
        </div>
    </main>
</body>
</html>
