<?php
                require_once 'Controlador/Menu.php'; // Asegúrate de que esto esté correcto
                
                // Crear una instancia de ProductoModelo
                $productoModelo = new ProductoModelo($conection);
                $productos = $productoModelo->ProductosInicio(); // Llama al método

                if ($productos) {  
                    ?>
                    <div class="productos"> 
                         <?php 
                    foreach ($productos as $producto) {
                        ?>
                        <div class="producto-card">
                          
                            <div class="producto-content">
                              
                                <div class="Productos" style="width: 18rem;">
                                <h2 class="nombre-producto"><?php echo $producto['Nombre']; ?></h2>
                                    <img class="imagen-producto" ><img src="<?php echo $producto['Imagen']; ?>" alt="<?php echo $producto['Nombre']; ?>" width=' 300px' height ='300px'/>
                                    <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="descripcion"><?php echo $producto['Descripcion']; ?></p>
                                    <p class="precio">Precio: $<?php echo number_format($producto['PrecioUnidad'], 2); ?></p>
                                    <p class="id_producto">Id Producto: <?php echo $producto['ID']; ?></p>
                                    <a href="#" class="btn btn-primary">ver detalles</a>
                                </div>
                                </div>
                                
                                
                                
                               
                            </div>
                         </div>
                        <?php
                    }
                }
                    ?>
                    </div>
                    <?php>
         