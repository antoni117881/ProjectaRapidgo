<?php if (!empty($reseñas)): ?>
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
       
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .review {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
        }
        .review p {
            margin: 0 0 10px;
        }
        .stars {
            color: #f39c12;
        }
        .date {
            font-size: 0.9em;
            color: #888;
        }
        .form-container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
        }
        .reviews-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .review-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 20px;
            margin-bottom: 10px;
        }
        .review-desc {
            font-size: 1.1em;
            margin-bottom: 10px;
        }
        .review-stars {
            color: #f39c12;
            font-size: 1.2em;
            margin-bottom: 8px;
        }
        .review-date {
            color: #888;
            font-size: 0.95em;
        }
    </style>
</head>
<header>
<?php include 'Vista/Vistaheader.php'?>
</header>
<body>
   
    <div class="container">
        <div class="reseñas-header">
            <h1>Reseñas del restaurante</h1>
        </div>
        <br>
        <div class="form-container">
            <h2>Agregar Reseña</h2>
            <form method="POST" action="">
                <input type="text" name="nombre_restaurante" required placeholder="Nombre del Restaurante" style="width: 100%; margin-bottom: 10px;">
                <textarea name="descripcion" required placeholder="Escribe tu reseña aquí..." rows="4" style="width: 100%;"></textarea>
                <select name="estrellas" required>
                    <option value="">Selecciona estrellas</option>
                    <option value="1">★</option>
                    <option value="2">★★</option>
                    <option value="3">★★★</option>
                    <option value="4">★★★★</option>
                    <option value="5">★★★★★</option>
                </select>
                <button type="submit">Enviar Reseña</button>
            </form>
        </div>
        
        <div class="reviews-list">
            <?php foreach ($reseñas as $reseña): ?>
                <div class="review-card">
                    <div class="review-desc">
                        <?php echo htmlspecialchars($reseña['descripcion']); ?>
                    </div>
                    <div class="review-stars">
                        <?php
                            $numEstrellas = intval($reseña['estrellas']);
                            for ($i = 0; $i < $numEstrellas; $i++) {
                                echo '★';
                            }
                        ?>
                    </div>
                    <div class="review-date">
                        Fecha: <?php echo htmlspecialchars($reseña['fecha']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <p>No hay reseñas disponibles para este restaurante.</p>
<?php endif; ?>
