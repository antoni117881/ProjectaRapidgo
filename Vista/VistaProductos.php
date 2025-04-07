<?php   
require_once 'Controlador/productos_controller.php';

?>

<style>
    .body{
        margin:0;
        padding: 0;
        box-sizing:border-box;
        background: rgba(255, 177, 100, 0.97);
    }
    main {
        max-width: 100%;
        padding: 20px;
        overflow-x: hidden;
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
        flex-wrap: nowrap;
        gap: 20px;
        padding: 20px;
        overflow-x: auto;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }

    .productos::-webkit-scrollbar {
        height: 8px;
    }

    .productos::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .productos::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .productos::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .producto-card {
        flex: 0 0 300px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .producto-content {
        padding: 15px;
    }

    .imagen-producto {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .nombre-producto {
        font-size: 1.2em;
        color: #333;
        margin: 8px 0;
        font-weight: 600;
    }

    .descripcion {
        color: #666;
        font-size: 0.9em;
        margin: 8px 0;
    }

    .precio {
        color: #007bff;
        font-size: 1.3em;
        font-weight: bold;
        margin: 12px 0;
    }

    .cantidad-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 6px;
        text-align: center;
        margin: 8px 0;
    }

    .btn {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        margin: 5px 0;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .producto-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* Responsive */
    @media (min-width: 992px) {
        .productos {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .productos {
            grid-template-columns: 1fr;
        }
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
