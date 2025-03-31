<style>
    .productos {
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        padding: 20px;
        justify-content: flex-start;
        max-width: 1200px;
        margin: 0 auto;
    }

    .producto-card {
        width: calc(33.33% - 25px);
        border-radius: 20px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
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
        font-size: 1.5em;
        color: #333;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .descripcion, .horario {
        color: #666;
        margin: 8px 0;
        font-size: 0.95em;
    }

    .btn-primary {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 25px;
        width: 100%;
        margin: 8px 0;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-primary:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 15px rgba(0,123,255,0.3);
    }

    /* Estilo para el segundo botón (reseña) */
    .btn-secondary {
        background: white;
        color: #007bff;
        border: 2px solid #007bff;
        padding: 10px 20px;
        border-radius: 25px;
        width: 100%;
        margin: 8px 0;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-secondary:hover {
        background: #f8f9fa;
        transform: scale(1.02);
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
                        <p class="descripcion">📍 <?php echo $restaurante['Ubicacion']; ?></p>
                        <p class="horario">🕒 <?php echo $restaurante['Horario']; ?></p>
                        
                        <form action="?action=RestauranteMenu" method="POST">
                            <input type="hidden" name="idRestaurante" value="<?php echo $restaurante['ID']; ?>">
                            <button type="submit" class="btn-primary">Ver menú del restaurante</button>
                        </form>
                        
                        <form action="?action=reseñarestaurante" method="POST">
                            <input type="hidden" name="idRestaurante" value="<?php echo $restaurante['ID']; ?>">
                            <button type="submit" class="btn-secondary">Ver reseñas</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay restaurantes disponibles en este momento.</p>
        <?php endif; ?>
    </div>
<?php
} else {
    echo "<p>No se encontraron restaurantes.</p>";
}
?>
         
