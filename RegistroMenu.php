<html>
<head>
    <title>Página Principal</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'Vista/Vistaheader.php'; ?>
        <button onclick="location.href='Vista/ResenaView.php'" class="btn-resena">Reseñas</button>
        <button onclick="location.href='Controller/pago.php'" class="btn-pago">Pagar</button>
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
