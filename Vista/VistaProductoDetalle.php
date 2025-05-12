<?php

require_once 'Controlador/RegistroProductoIndividual.php';

// Verifica si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Asegúrate de que la sesión esté iniciada para gestionar el carrito.
}

if (isset($_POST['add_to_cart'])) {
    $producto_id = $_POST['producto_id'];
    $producto_nombre = $_POST['producto_nombre'];
    $producto_precio = $_POST['producto_precio'];
    $producto_imagen = $_POST['producto_imagen'];
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Si el producto ya está en el carrito, suma la cantidad
    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$producto_id] = [
            'nombre' => $producto_nombre,
            'precio' => $producto_precio,
            'imagen' => $producto_imagen,
            'cantidad' => $cantidad
        ];
    }

    header('Location: Vista/VistaCarrito.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="../style.css">
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

        .descripcion-amplia {
            background: #f9f9f9;
            border-left: 4px solid #e53935;
            padding: 18px 20px;
            margin-bottom: 20px;
            font-size: 1.15rem;
            color: #444;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(229,57,53,0.05);
        }

        .btn-anadir {
            background: #e91e63;
            color: #fff;
            font-weight: bold;
            font-size: 1.2rem;
            border: none;
            border-radius: 25px;
            padding: 14px 32px;
            margin-top: 10px;
            box-shadow: 0 2px 8px rgba(233,30,99,0.15);
            transition: background 0.2s;
        }

        .btn-anadir:hover {
            background: #ad1457;
        }

        .badge-producto {
            display: inline-block;
            background: #f8bbd0;
            color: #ad1457;
            font-weight: 600;
            border-radius: 20px;
            padding: 7px 18px;
            margin-top: 12px;
            font-size: 1rem;
            box-shadow: 0 1px 4px rgba(233,30,99,0.10);
        }

        .cantidad-control {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 15px;
            justify-content: center;
        }

        .btn-circular {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #28a745;
            color: #fff;
            border: none;
            font-size: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            cursor: pointer;
        }

        .btn-circular:disabled {
            background: #e0e0e0;
            color: #bdbdbd;
            cursor: not-allowed;
        }

        .btn-circular:hover:not(:disabled) {
            background: #218838;
        }

        .cantidad-numero {
            font-size: 1.5rem;
            font-weight: bold;
            min-width: 24px;
            text-align: center;
            color: #222;
        }
    </style>
</head>
<body>
    <header>
        <?php include 'Vistaheader.php'; ?>
    </header>

    <main>
        <div class="producto-container">
            <h1>Detalles del Producto</h1>
            <?php if (isset($producto) && !empty($producto) && isset($producto['Nombre'])): ?>
                <div class="producto-detalle">
                    <div class="producto-imagen">
                        <img src="<?php echo $producto['Imagen']; ?>" alt="<?php echo $producto['Nombre']; ?>" />
                    </div>
                    <div class="producto-info">
                        <h2><?php echo $producto['Nombre']; ?></h2>
                        <div class="descripcion-amplia">
                            <?php echo $producto['Descripcion']; ?>
                        </div>
                        <p class="precio">Precio: $<?php echo number_format($producto['PrecioUnidad'], 2); ?></p>
                        
                        <!-- Botón Añadir al Carrito -->
                        <form id="add-to-cart-form" method="POST" action="Vista/VistaCarrito.php">
                            <input type="hidden" name="producto_id" value="<?php echo $producto['ID']; ?>">
                            <input type="hidden" name="producto_nombre" value="<?php echo $producto['Nombre']; ?>">
                            <input type="hidden" name="producto_precio" id="producto_precio" value="<?php echo $producto['PrecioUnidad']; ?>">
                            <input type="hidden" name="producto_imagen" value="<?php echo $producto['Imagen']; ?>">

                            <div class="cantidad-control">
                                <button type="button" id="decrementar" class="btn-circular">−</button>
                                <span id="cantidad" class="cantidad-numero">1</span>
                                <input type="hidden" name="cantidad" id="cantidad_input" value="1">
                                <button type="button" id="incrementar" class="btn-circular">+</button>
                            </div>

                            <button type="submit" id="btn-add-cart" class="btn-anadir">
                                Añadir <?php echo $producto['Nombre']; ?> (<?php echo $producto['PrecioUnidad']; ?> $)
                            </button>
                        </form>

                        <?php if (isset($_SESSION['carrito'][$producto['ID']])): ?>
                            <span class="badge-producto">
                                Añadido: <?php echo $_SESSION['carrito'][$producto['ID']]['cantidad']; ?> x <?php echo $producto['Nombre']; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <p>Producto no encontrado.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <?php include 'Vista/vistafooter.php'; ?>
    </footer>

    <script>
        const precioUnidad = parseFloat(document.getElementById('producto_precio').value);
        let cantidad = 1;

        function actualizarBoton() {
            let total = precioUnidad * cantidad;
            document.getElementById('btn-add-cart').textContent = `Añadir ${cantidad} por $${total.toFixed(2)}`;
            document.getElementById('cantidad').textContent = cantidad;
            document.getElementById('cantidad_input').value = cantidad;
        }

        document.getElementById('incrementar').onclick = function() {
            cantidad++;
            actualizarBoton();
        };

        document.getElementById('decrementar').onclick = function() {
            if (cantidad > 1) {
                cantidad--;
                actualizarBoton();
            }
        };
    </script>
</body>
</html>

