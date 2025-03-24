

<?php
                require_once 'Controlador/Menu.php'; // Asegúrate de que esto esté correcto
                
                // Crear una instancia de ProductoModelo
                $RestaurantesModelo = new RestaurantesModelo($conection);
                $restaurantes = $RestaurantesModelo->RestaurantesInicio(); // Llama al método

              

                if ($restaurantes) {    
                    ?>
                    <link rel="stylesheet" href="style.css">
                    <header>
                    <?php include 'Vista/Vistaheader.php'; ?>
                    </header>
                    <div class="productos">
            <?php if ($restaurantes && count($restaurantes) > 0):  ?>
                
                <?php foreach ($restaurantes as $restaurantes): ?>
                    <div class="producto-card">
                        <div class="producto-content">
                            <div class="Productos" style="width: 18rem;">
                                <img class="imagen-producto" src="<?php echo $restaurantes['imagen']; ?>" alt="<?php echo $restaurantes['Nombre']; ?>" width='300px' height='300px'/>
                                <div class="card-body">
                                    <h5 class="nombre-producto"><?php echo $restaurantes['Nombre']; ?></h5>
                                    <p class="descripcion"><?php echo $restaurantes['Ubicacion']; ?></p>
                                    <p class="horario"><?php echo ($restaurantes['Horario']); ?></p>
                                    <p>ID restaurante: <?php echo $restaurantes['ID']; ?></p>
                                    
                                    <form action="?action=RestauranteMenu" method="POST">
                                            <input type="hidden" name="idRestaurante" value="<?php echo $restaurantes['ID']; ?>">
                                            <button type="submit" class="btn btn-primary">Ver menú del restaurante</button>
                                        </form>
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
                   
                    <?php
                } else {
                    echo "<p>No se encontraron restaurantes.</p>"; // Mensaje si no hay restaurantes
                }
                    ?>
         
