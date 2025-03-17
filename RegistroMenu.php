<html>
<head>
    <title>Página Principal</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php 
        
        include 'Vista/Vistaheader.php'; 
        
        ?>
    </header>
    <main>
        <div class="productos">
            <?php
                // Mostrar el usuario conectado
                if (isset($_SESSION['user_name'])) {
                    echo "<p>El usuario conectado es: " . htmlspecialchars($_SESSION['user_name']) . "</p>";
                } else {
                    echo "<p>No hay usuario conectado.</p>";
                }
                
                // Incluir la vista de los restaurantes 
                include_once 'Vista/VistaRestaurantes.php';
                include 'Vista/filtro_productos.php';

                 
            ?>
        </div>
    </main>
</body>
</html>
