<?php
                require_once 'Controlador/Menu.php'; // Asegúrate de que esto esté correcto
                
                // Crear una instancia de ProductoModelo
                $RestaurantesModelo = new RestaurantesModelo($conection);
                $restaurantes = $RestaurantesModelo->RestaurantesInicio(); // Llama al método

                if ($restaurantes) {    
                    ?>
                    <div class="productos"> 
                         <?php 
                    foreach ($restaurantes as $restaurante) {
                        ?>
                        <div class="producto-card">
                          
                            <div class="producto-content">
                              
                                <div class="Productos" style="width: 18rem;">
                                    <img class="imagen-producto" src="<?php echo $restaurante['imagen']; ?>" alt="<?php echo $restaurante['Nombre']; ?>" width='300px' height='300px'/>
                                    <div class="card-body">
                                    <h5 class="nombre-producto"><?php echo $restaurante['Nombre']; ?></h5>
                                    <p class="descripcion"><?php echo $restaurante['Horario']; ?></p>
                                    <p class="precio">Telefono-><?php echo number_format($restaurante['Telefono'], 2); ?></p>
                                    <p>ID del restaurante: <?php echo $restaurante['ID']; ?></p>
                                    <form action="?action=RestauranteMenu" method="POST">
    <input type="hidden" name="idRestaurante" value="<?php echo $restaurante['ID']; ?>">
    <button type="submit" class="btn btn-primary">ver menú del restaurante</button>
</form>
                                </div>
                                </div>
                                
                                
                                
                               
                            </div>
                         </div>
                        <?php
                    }
                }
                ?>
                    </div>