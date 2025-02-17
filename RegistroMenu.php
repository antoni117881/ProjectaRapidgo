<html>
<head>
    <title>Página Principal</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenido a rapid go </h1>
        <nav>
            <ul>
                <li><a href="?action=Login">Login</a></li>
                <li><a href="?action=registro">Registre</a></li>
                <li><a href="?action=Usuario">Mi Cuenta</a></li>
                <li><a href="?action=Restaurantes">Restaurantes</a></li>
                <li><a href="?action=Menus">Menús</a></li>
                <li><a href="?action=Ofertas">Ofertas Especiales</a></li>
            </ul>
        </nav>
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
