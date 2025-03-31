<?php
                require_once 'Controlador/Menu.php'; // Asegúrate de que esto esté correcto
                
                // Crear una instancia de ProductoModelo
                $RestaurantesModelo = new RestaurantesModelo($conection);
                $restaurantes = $RestaurantesModelo->RestaurantesInicio(); // Llama al método

              

                if ($restaurantes) {    
                    ?>
                    <div id="restaurantCarousel" class="carousel slide" data-ride="carousel">
                    <h1 class="titulo" >Nuestros Restaurantes</h1>
                        <div class="carousel-inner">
                            
                            <?php
                            foreach ($restaurantes as $index => $restaurante) {
                                $activeClass = $index === 0 ? 'active' : ''; // Solo el primer elemento debe ser activo
                                ?>
                                <div class="carousel-item <?php echo $activeClass; ?>">
                                    
                                    <img src="<?php echo $restaurante['imagen']; ?>" class="d-block w-100" alt="<?php echo $restaurante['Nombre']; ?>" style="height: 700px; object-fit: cover;">
                                    <div class="carousel-caption d-none d-md-block">
                                        
                                        <p>Teléfono: <?php echo number_format($restaurante['Telefono'], 2); ?></p>
                                        <p>ID del restaurante: <?php echo $restaurante['ID']; ?></p>
                                        <form action="?action=RestauranteMenu" method="POST">
                                            <input type="hidden" name="idRestaurante" value="<?php echo $restaurante['ID']; ?>">
                                            <button type="submit" class="btn btn-primary">Ver menú del restaurante</button>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#restaurantCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#restaurantCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                    <style>
                        /* Asegúrate de que el carrusel ocupe todo el ancho de la pantalla */
                        #restaurantCarousel {
                            width: 100%;
                            position: relative;
                        }
                        .carousel-item img {
                            width: 100%; /* Asegura que la imagen ocupe todo el ancho */
                            height: 700px; /* Ajusta la altura aquí según tus necesidades */
                            object-fit: cover; /* Asegura que la imagen cubra el área del slider */
                        }
                        .titulo{
                            justify-content : center;
                            font-weight:600;
                            font-size: 50px;
                        }
                    </style>
                    <?php
                } else {
                    echo "<p>No se encontraron restaurantes.</p>"; // Mensaje si no hay restaurantes
                }
                    ?>
         
<!-- Incluye Bootstrap CSS en el <head> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Incluye jQuery y Bootstrap JS justo antes de cerrar el <body> -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
         