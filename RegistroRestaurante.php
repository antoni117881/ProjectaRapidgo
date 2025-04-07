<style>
    
    .productos{
        margin:0;
        padding: 0;
        background: rgba(255, 177, 100, 0.97);
    }
    .body{
        background: rgba(255, 177, 100, 0.97);
    }
    </style>
<html>
<head>
    <title>Página Productos</title>
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

                //icnluir la vista de los productos de el restaurante 
             include_once 'Vista/VistaProductos.php'; 
            ?>
        </div>
    </main>
</body>
</html>
