<?php   
require_once 'Controlador/productos_controller.php';

?>

<style>
    main {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 10px;
        font-size: 2.2em;
    }

    .cantidad-info {
        text-align: center;
        color: #666;
        margin-bottom: 30px;
        font-size: 1.1em;
    }

    .productos {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        justify-content: flex-start;
    }

    .producto-card {
        width: calc(33.33% - 25px);
        border-radius: 20px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .producto-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .producto-content {
        padding: 20px;
    }

    .imagen-producto {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 15px;
        margin-bottom: 15px;
    }

    .nombre-producto {
        font-size: 1.4em;
        color: #333;
        margin: 10px 0;
        font-weight: 600;
    }

    .descripcion {
        color: #666;
        margin: 10px 0;
        font-size: 0.95em;
        line-height: 1.5;
    }

    .precio {
        font-size: 1.3em;
        color: #007bff;
        font-weight: bold;
        margin: 15px 0;
    }

    .cantidad-input {
        width: 100%;
        padding: 10px;
        border: 2px solid #ddd;
        border-radius: 15px;
        margin: 10px 0;
        text-align: center;
        font-size: 1em;
    }

    .btn {
        width: 100%;
        padding: 12px 20px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        margin: 8px 0;
    }

    .btn-primary {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: white;
    }

    .btn-success {
        background: linear-gradient(145deg, #28a745, #218838);
        color: white;
    }

    .btn:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .no-productos {
        text-align: center;
        color: #666;
        font-size: 1.1em;
        width: 100%;
        padding: 40px;
    }
</style>

<main>
    <h1>Productos del Restaurante</h1>
    <p class="cantidad-info">Cantidad de productos encontrados: <?php echo $cantidadProductos; ?></p>
    
    <div class="productos">
        <?php if ($productos && count($productos) > 0): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="producto-card">
                    <div class="producto-content">
                        <img class="imagen-producto" 
                             src="<?php echo $producto['Imagen']; ?>" 
                             alt="<?php echo $producto['Nombre']; ?>"/>
                        
                        <h5 class="nombre-producto"><?php echo $producto['Nombre']; ?></h5>
                        <p class="descripcion"><?php echo $producto['Descripcion']; ?></p>
                        <p class="precio">€<?php echo number_format($producto['PrecioUnidad'], 2); ?></p>
                        
                        <form action="?action=registroProduct" method="POST">
                            <input type="hidden" name="idProducto" value="<?php echo $producto['ID']; ?>">
                            <button type="submit" class="btn btn-primary">
                                Ver detalles del producto
                            </button>
                        </form>

                        <form action="?action=agregarCesta" method="POST">
                            <input type="hidden" name="idProducto" value="<?php echo $producto['ID']; ?>">
                            <input type="number" 
                                   name="cantidad" 
                                   value="1" 
                                   min="1" 
                                   max="10" 
                                   class="cantidad-input">
                            <button type="submit" class="btn btn-success">
                                Añadir a la cesta
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-productos">No hay productos disponibles para este restaurante.</p>
        <?php endif; ?>
    </div>
</main>
