<?php
require_once 'Controlador/RegistroProductoIndividual.php';
session_start(); // Asegúrate de que la sesión esté iniciada para gestionar el carrito.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilo general */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        /* Cabecera */
        header {
            background-color: #2d2d2d;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        /* Contenedor principal */
        main {
            padding: 50px 10%;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
            margin-bottom: 50px;
        }

        /* Contenedor de detalles del producto */
        .producto-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Estilo para la sección de detalles */
        .producto-detalle {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1000px;
        }

        /* Imagen del producto */
        .producto-imagen img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .producto-imagen img:hover {
            transform: scale(1.05);
        }

        /* Información del producto */
        .producto-info {
            max-width: 500px;
            margin-left: 30px;
        }

        .producto-info h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 20px;
        }

        .producto-info p {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.5;
        }

        /* Estilo para el precio */
        .precio {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e53935;
            margin: 20px 0;
        }

        /* Botón "Añadir al carrito" */
        button {
            padding: 12px 25px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        /* Botón en estado de desactivado */
        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        /* Contenedor de la imagen y el texto */
        .producto-imagen,
        .producto-info {
            flex: 1;
        }

        /* Diseño responsivo para dispositivos pequeños */
        @media (max-width: 768px) {
            .producto-detalle {
                flex-direction: column;
                align-items: center;
            }

            .producto-info {
                margin-left: 0;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>

    <header>
        <?php include 'Vista/Vistaheader.php'; ?>
    </header>

    <main>
        <div class="producto-container">
            <h1>Detalles del Producto</h1>
            <?php if (isset($producto) && !empty($producto)): ?>
                <div class="producto-detalle">
                    <div class="producto-imagen">
                        <img src="<?php echo $producto['Imagen']; ?>" alt="<?php echo $producto['Nombre']; ?>" />
                    </div>
                    <div class="producto-info">
                        <h2><?php echo $producto['Nombre']; ?></h2>
                        <p><?php echo $producto['Descripcion']; ?></p>
                        <p class="precio">Precio: $<?php echo number_format($producto['PrecioUnidad'], 2); ?></p>
                        
                        <!-- Botón Añadir al Carrito -->
                        <form method="POST" action="Vistacesta.php">
                            <input type="hidden" name="producto_id" value="<?php echo $producto['ID']; ?>">
                            <input type="hidden" name="producto_nombre" value="<?php echo $producto['Nombre']; ?>">
                            <input type="hidden" name="producto_precio" value="<?php echo $producto['PrecioUnidad']; ?>">
                            <input type="hidden" name="producto_imagen" value="<?php echo $producto['Imagen']; ?>">
                            <button type="submit" name="add_to_cart" class="btn btn-primary">Añadir al Carrito</button>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <p>Producto no encontrado.</p>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>

