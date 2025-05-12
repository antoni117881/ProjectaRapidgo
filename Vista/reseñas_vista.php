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
        .header {
            background-color: #333;
            color: white;
            padding: 15px 0;
            margin-bottom: 20px;
        }
        .header-content {
            width: 80%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            background-color: #4CAF50;
        }
        .header a:hover {
            background-color: #45a049;
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
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>Reseñas de Usuarios</h1>
            <a href="../index.php">Volver a Inicio</a>
        </div>
    </div>
    <div class="container">
        <h1>Reseñas de Usuarios</h1>

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
        
        <ul>
            <?php foreach ($reseñas as $reseña): ?>
                <li>
                    <strong><?php echo htmlspecialchars($reseña['descripcion']); ?></strong>: 
                    <?php echo htmlspecialchars($reseña['estrellas']); ?> 
                    <em>(<?php echo htmlspecialchars($reseña['fecha']); ?>)</em>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    <p>No hay reseñas disponibles para este restaurante.</p>
<?php endif; ?>
