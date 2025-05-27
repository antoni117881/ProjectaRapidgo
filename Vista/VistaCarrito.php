<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .carrito-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .carrito-titulo {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .carrito-vacio {
            text-align: center;
            padding: 50px;
            background: #f9f9f9;
            border-radius: 8px;
            margin: 20px 0;
        }

        .producto-carrito {
            display: flex;
            align-items: center;
            padding: 20px;
            background: white;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .producto-imagen {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 20px;
        }

        .producto-info {
            flex-grow: 1;
        }

        .producto-nombre {
            font-size: 1.2em;
            color: #333;
            margin-bottom: 5px;
        }

        .producto-precio {
            color: #e53935;
            font-weight: bold;
        }

        .producto-cantidad {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-cantidad {
            background: #f0f0f0;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-eliminar {
            background: #ff5252;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 20px;
        }

        .carrito-resumen {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .total {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 20px;
        }

        .btn-pagar {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-vaciar {
            background: #f44336;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
            width: 100%;
        }

        .btn-pagar:hover {
            background: #45a049;
        }

        .btn-vaciar:hover {
            background: #da190b;
        }

        .boton-volver {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .btn-volver {
            display: inline-block;
            background: #2196F3;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background 0.3s ease;
        }

        .btn-volver:hover {
            background: #1976D2;
        }
    </style>
</head>
<body>

    <main class="carrito-container">
        <h1 class="carrito-titulo">Carrito de Compras</h1>
        <div class="boton-volver">
            <a href="/PROJECTARAPIDGO/index.php" class="btn-volver">Volver a Inicio</a>
        </div>

        <?php if (empty($_SESSION['carrito'])): ?>
            <div class="carrito-vacio">
                <h2>Tu carrito está vacío</h2>
                <p>¡Añade algunos productos para comenzar a comprar!</p>
            </div>
        <?php else: ?>
            <?php 
            $total = 0;
            foreach ($_SESSION['carrito'] as $id => $producto): 
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $total += $subtotal;
            ?>
                <div class="producto-carrito">
                    <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" class="producto-imagen">
                    <div class="producto-info">
                        <h3 class="producto-nombre"><?php echo $producto['nombre']; ?></h3>
                        <p class="producto-precio">$<?php echo number_format($producto['precio'], 2); ?></p>
                        <div class="producto-cantidad">
                            <button class="btn-cantidad" onclick="actualizarCantidad(<?php echo $id; ?>, -1)">-</button>
                            <span><?php echo $producto['cantidad']; ?></span>
                            <button class="btn-cantidad" onclick="actualizarCantidad(<?php echo $id; ?>, 1)">+</button>
                        </div>
                    </div>
                    <button class="btn-eliminar" onclick="eliminarProducto(<?php echo $id; ?>)">Eliminar</button>
                </div>
            <?php endforeach; ?>

            <div class="carrito-resumen">
                <h2 class="total">Total: $<?php echo number_format($total, 2); ?></h2>
                <button class="btn-pagar" onclick="procederPago()">Proceder al Pago</button>
                <button class="btn-vaciar" onclick="vaciarCarrito()">Vaciar Carrito</button>
            </div>
        <?php endif; ?>
    </main>

    <footer>
        <?php include 'vistafooter.php'; ?>
    </footer>

    <script>
        function actualizarCantidad(id, delta) {
            fetch('/PROJECTARAPIDGO/Controlador/ControladorCarrito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `actualizar_cantidad=1&id=${id}&delta=${delta}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        }

        function eliminarProducto(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este producto del carrito?')) {
                fetch('/PROJECTARAPIDGO/Controlador/ControladorCarrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `eliminar_producto=1&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }

        function vaciarCarrito() {
            if (confirm('¿Estás seguro de que deseas vaciar el carrito?')) {
                fetch('/PROJECTARAPIDGO/Controlador/ControladorCarrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'vaciar_carrito=1'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }

        function procederPago() {
            window.location.href = '/PROJECTARAPIDGO/Vista/pago.php';
        }
    </script>
</body>
</html>