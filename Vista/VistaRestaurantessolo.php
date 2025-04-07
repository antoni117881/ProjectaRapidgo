<style>
    .body{
        margin:0;
        padding: 0;
        box-sizing:border-box;
        
    }
    .productos {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        padding: 20px;
        justify-content: flex-start;
        max-width: 100%;
        margin: 0 auto;
        background: rgba(255, 177, 100, 0.97);
    }

    .producto-card {
        width: calc(33.33% - 25px);
        border-radius: 20px;
        overflow: hidden;
        background: linear-gradient(145deg,rgb(255, 183, 0),rgb(228, 68, 4));
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        
    }

    .producto-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
    }

    .producto-content {
        padding: 20px;
        background: white;
        border-radius: 20px;
        margin: 3px;
        background: linear-gradient(145deg,rgb(255, 183, 0),rgb(228, 68, 4));
    }

    .imagen-producto {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 15px;
        margin-bottom: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .nombre-producto {
        font-size: 1.5em;
        color: #333;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .descripcion, .horario {
        color: #666;
        margin: 8px 0;
        font-size: 0.95em;
        display: flex;
        align-items: center;
        gap: 8px;
    }

   

   
   

    
    /* Estilo para los iconos */
    .descripcion::before {
        content: "📍";
        font-size: 1.2em;
    }

    .horario::before {
        content: "🕒";
        font-size: 1.2em;
    }

    /* Mensaje de no disponibilidad */
    .no-restaurantes {
        width: 100%;
        text-align: center;
        padding: 40px;
        color: #666;
        font-size: 1.2em;
    }
   
        .producto-card{
            width: 25%;
            padding: 15px;
        }
        .boton{
            background-color: rgb(239, 238, 238);
            border: 3px rgba(90, 139, 49, 0.78) solid;
            border-radius: 10px;
            color:rgb(221, 16, 16);
        }
</style>

<?php
require_once 'Controlador/Menu.php';
$RestaurantesModelo = new RestaurantesModelo($conection);
$restaurantes = $RestaurantesModelo->RestaurantesInicio();

if ($restaurantes) {    
?>
    <header>
        <?php include 'Vista/Vistaheader.php'; ?>
    </header>
    <div class="productos">
        <?php if ($restaurantes && count($restaurantes) > 0): ?>
            <?php foreach ($restaurantes as $restaurante): ?>
                <div class="producto-card">
                    <div class="producto-content">
                        <img class="imagen-producto" src="<?php echo $restaurante['imagen']; ?>" alt="<?php echo $restaurante['Nombre']; ?>"/>
                        <h5 class="nombre-producto"><?php echo $restaurante['Nombre']; ?></h5>
                        <p class="descripcion"><?php echo $restaurante['Ubicacion']; ?></p>
                        <p class="horario"><?php echo $restaurante['Horario']; ?></p>
                        
                        <form action="?action=RestauranteMenu" class="boton" method="POST">
                            <input type="hidden" name="idRestaurante" value="<?php echo $restaurante['ID']; ?>">
                            <button type="submit" class="btn">Ver menú del restaurante</button>
                        </form>
                        
                        <form action="?action=reseñarestaurante" method="POST" class="boton">
                            <input type="hidden" name="idRestaurante" value="<?php echo $restaurante['ID']; ?>">
                            <button type="submit" class="btn">Ver reseñas</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-restaurantes">No hay restaurantes disponibles en este momento.</p>
        <?php endif; ?>
    </div>
<?php
} else {
    echo "<p>No se encontraron restaurantes.</p>";
}
?>
         
