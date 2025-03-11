<?php   
require_once 'Controlador/productos_controller.php';

?>


    <main>
        <h1>Productos del Restaurante</h1>
        <p>Cantidad de productos encontrados: <?php echo $cantidadProductos; ?></p>
        <div class="productos">
            <?php if ($productos && count($productos) > 0): ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="producto-card">
                        <div class="producto-content">
                            <div class="Productos" style="width: 18rem;">
                                <img class="imagen-producto" src="<?php echo $producto['Imagen']; ?>" alt="<?php echo $producto['Nombre']; ?>" width='300px' height='300px'/>
                                <div class="card-body">
                                    <h5 class="nombre-producto"><?php echo $producto['Nombre']; ?></h5>
                                    <p class="descripcion"><?php echo $producto['Descripcion']; ?></p>
                                    <p class="precio">Precio: $<?php echo number_format($producto['PrecioUnidad'], 2); ?></p>
                                    <p>ID producto: <?php echo $producto['ID']; ?></p>
                                    
                                    <form action="?action=registroProduct" method="POST">
                                        <input type="hidden" name="idProducto" value="<?php echo $producto['ID']; ?>">
                                        <button type="submit" class="btn btn-primary" >Ver detalles del producto </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay productos disponibles para este restaurante.</p>
            <?php endif; ?>
        </div>
    </main>
