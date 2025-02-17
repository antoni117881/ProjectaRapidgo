<?php
                require_once 'Controlador/Menu.php'; // Asegúrate de que esto esté correcto
                
                // Crear una instancia de ProductoModelo
                $productoModelo = new ProductoModelo($conection);
                $productos = $productoModelo->ProductosInicio(); // Llama al método

                if ($productos) {   
                    foreach ($productos as $producto) {
                        ?>
                        <div class="producto-card">
                            <div class="producto-content">
                                <h2><?php echo $producto['Nombre']; ?></h2>
                                <p class="imagen-producto"><img src="<?php echo $producto['Imagen']; ?>" alt="<?php echo $producto['Nombre']; ?>" /></p>
                                <p class="descripcion"><?php echo $producto['Descripcion']; ?></p>
                                <p class="precio">Precio: $<?php echo number_format($producto['PrecioUnidad'], 2); ?></p>
                                <p class="id_producto">Id Producto: <?php echo $producto['ID']; ?></p>
                            </div>
                         </div>
                        <?php
                    }
                }
                ?>