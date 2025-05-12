<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
        }
        .productos {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 40px;
        }
        .producto {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
            width: 220px;
            text-align: center;
        }
        .producto button {
            background: #00c48c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .carrito-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 350px;
            height: 100%;
            background: #fff;
            box-shadow: -2px 0 10px rgba(0,0,0,0.15);
            transition: right 0.3s;
            z-index: 1000;
            padding: 30px 20px 20px 20px;
            display: flex;
            flex-direction: column;
        }
        .carrito-sidebar.abierto {
            right: 0;
        }
        .carrito-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .carrito-header h2 {
            margin: 0;
        }
        .cerrar-carrito {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }
        .carrito-productos {
            flex: 1;
            overflow-y: auto;
        }
        .carrito-producto {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .carrito-producto span {
            font-size: 16px;
        }
        .carrito-total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
            text-align: right;
        }
        .carrito-vacio {
            text-align: center;
            color: #888;
            margin-top: 40px;
        }
    </style>
</head>


    <div id="carritoSidebar" class="carrito-sidebar">
        <div class="carrito-header">
            <h2>Tu pedido</h2>
            <button class="cerrar-carrito" onclick="cerrarCarrito()">&times;</button>
        </div>
        <div class="carrito-productos" id="carritoProductos">
            <div class="carrito-vacio" id="carritoVacio">El carrito está vacío.</div>
        </div>
        <div class="carrito-total" id="carritoTotal">Total: 0,00 €</div>
    </div>

    <script>
        
function agregarAlCarrito(nombre, precio, imagen) {
    const formData = new FormData();
    formData.append("agregar", true);
    formData.append("nombre", nombre);
    formData.append("precio", precio);
    formData.append("imagen", imagen);

    fetch("controladorcarrito.php", {
        method: "POST",
        body: formData,
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            mostrarCarritoEmergente(data.carrito);
        } else {
            alert(data.message);
        }
    });
}

function eliminarProducto(nombre) {
    const formData = new FormData();
    formData.append("eliminar", true);
    formData.append("nombre", nombre);

    fetch("controladorcarrito.php", {
        method: "POST",
        body: formData,
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            mostrarCarritoEmergente(data.carrito);
        } else {
            alert("No se pudo eliminar el producto.");
        }
    });
}

function mostrarCarritoEmergente(carrito) {
    let total = 0;

    let html = '<div id="carrito-popup" style="position:fixed; top:10px; right:10px; width:320px; background:#fff; border:1px solid #ccc; padding:15px; box-shadow:0 0 10px rgba(0,0,0,0.2); z-index:1000;">';
    html += '<h3>🛒 Mis pedidos</h3><ul style="list-style:none; padding:0;">';

    carrito.forEach(item => {
        const subtotal = item.price * item.quantity;
        total += subtotal;

        html += `<li style="margin-bottom:10px; border-bottom:1px solid #eee; padding-bottom:8px;">
            <img src="${item.image}" style="width:40px; height:40px; vertical-align:middle;"> 
            <strong>${item.name}</strong> x${item.quantity}<br>
            $${subtotal.toFixed(2)}
            <button onclick="eliminarProducto('${item.name}')" style="margin-top:5px; background:#e74c3c; color:white; border:none; padding:3px 6px; cursor:pointer;">Eliminar</button>
        </li>`;
    });

    html += `</ul><hr><strong>Total: $${total.toFixed(2)}</strong><br><br>`;
    html += '<button onclick="document.getElementById(\'carrito-popup\').remove()" style="background:#555; color:white; padding:5px 10px;">Cerrar</button>';
    html += '</div>';

    const existente = document.getElementById("carrito-popup");
    if (existente) {
        existente.remove();
    }

    document.body.insertAdjacentHTML("beforeend", html);
}
</script>
</body>
</html>
