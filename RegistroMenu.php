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
                //icnluir la vista de los restaurantes 
                
                
             include_once 'Vista/VistaRestaurantes.php'; 
             
            ?>
        </div>
    </main>
</body>
</html>
