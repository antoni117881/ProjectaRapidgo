<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Inicializar datos de usuario si no existen
if (!isset($_SESSION['userData'])) {
    $_SESSION['userData'] = [
        'nombre' => 'Ana',
        'email' => 'w1917252611@gmail.com',
        'telefono' => '+34641590899',
        'idioma' => 'es'
    ];
}
if (!isset($_SESSION['codigos'])) {
    $_SESSION['codigos'] = [];
}
$userData = $_SESSION['userData'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <style>
    body {
        background: #ffc247;
        font-family: 'Segoe UI', Arial, sans-serif;
        margin: 0;
    }
    .profile-container {
        max-width: 420px;
        margin: 40px auto;
        background: none;
    }
    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }
    .avatar-circle {
        width: 70px;
        height: 70px;
        background: #b2e6e6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-letter {
        font-size: 2.5rem;
        color: #222;
        font-weight: bold;
    }
    .profile-name {
        font-size: 2.2rem;
        font-weight: bold;
        margin: 0;
    }
    .profile-label {
        font-size: 1.2rem;
        color: #333;
        font-weight: 600;
    }
    .profile-cards {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
    }
    .profile-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px #0001;
        flex: 1;
        text-align: center;
        padding: 20px 0;
        transition: box-shadow 0.2s;
    }
    .profile-card:hover {
        box-shadow: 0 4px 16px #0002;
    }
    .card-icon {
        width: 48px;
        height: 48px;
        margin-bottom: 10px;
    }
    .card-title {
        display: block;
        font-size: 1.1rem;
        font-weight: bold;
        color: #222;
        text-decoration: none;
    }
    .profile-menu {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px #0001;
        padding: 0;
        list-style: none;
        margin: 0;
        overflow: hidden;
    }
    .profile-menu li, .profile-menu li a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        font-size: 1rem;
        color: #222;
        border-bottom: 1px solid #eee;
        text-decoration: none;
        cursor: pointer;
    }
    .profile-menu li:last-child, .profile-menu li:last-child a {
        border-bottom: none;
    }
    .profile-menu li a {
        width: 100%;
        color: #222;
    }
    .profile-menu li a:hover {
        color: #e67e22;
    }
    </style>
</head>
<body>
    <div class="profile-container">
        <?php
        // Título y breadcrumb dinámico
        $breadcrumbs = [
            'Cuenta' => 'Cuenta',
            'Codigos' => 'Códigos promocionales',
            'Idioma' => 'Idioma',
            'FAQ' => 'Preguntas frecuentes'
        ];
        $titulo = $breadcrumbs[$action] ?? 'Cuenta';
        ?>
        <div style="margin-bottom: 18px;">
            <span style="color:#009688; font-weight:bold;">Perfil</span>
            <?php if ($titulo !== 'Cuenta'): ?>
                <span style="color:#888;">/</span>
                <span style="color:#888;"><?php echo $titulo; ?></span>
            <?php endif; ?>
        </div>
        <div class="profile-header">
            <div class="avatar-circle">
                <span class="avatar-letter">
                    <?php echo strtoupper(substr($_SESSION['nameAccount'] ?? 'U', 0, 1)); ?>
                </span>
            </div>
            <div>
                <h1 class="profile-name"><?php echo $_SESSION["nameAccount"]?? 'Usuario'; ?></h1>
                <span class="profile-label">Perfil</span>
            </div>
        </div>
        <div class="profile-cards">
            <div class="profile-card">
                <img src="icono-pedidos.png" alt="Pedidos" class="card-icon">
                <a href="?action=MisPedidos" class="card-title">Pedidos</a>
            </div>
            <div class="profile-card">
                <img src="icono-cuenta.png" alt="Cuenta" class="card-icon">
                <a href="?action=Cuenta" class="card-title">Cuenta</a>
            </div>
        </div>
        <ul class="profile-menu">
            <li><a href="?action=ComparteYGana"><span>🗑️</span> Comparte y gana</a></li>
            <li><a href="?action=Codigos"><span>🏷️</span> Códigos promocionales</a></li>
            <li><a href="?action=Idioma"><span>🌐</span> Idioma</a></li>
            <li><a href="?action=FAQ"><span>❓</span> Preguntas frecuentes</a></li>
            <li><a href="?action=cerrarsesion"><span>🔓</span> Cerrar sesión</a></li>
        </ul>
        <div style="margin-top:30px;">
        <?php
        $action = $_GET['action'] ?? 'Cuenta';
        switch($action) {
            case 'Cuenta':
                // Guardar cambios si se envió el formulario
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $_SESSION['userData']['nombre'] = $_POST['nombre'];
                    $_SESSION['userData']['email'] = $_POST['email'];
                    $_SESSION['userData']['telefono'] = $_POST['telefono'];
                    $userData = $_SESSION['userData'];
                    echo "<div style='color:green;'>Datos actualizados correctamente.</div>";
                }
                ?>
                <h2>Cuenta</h2>
                <form method="post" style="background:#fff; border-radius:12px; padding:24px; margin-bottom:20px;">
                    <div style="margin-bottom:16px;">
                        <b>Nombre:</b> <input type="text" name="nombre" value="<?php echo htmlspecialchars($userData['nombre']); ?>" required>
                    </div>
                    <div style="margin-bottom:16px;">
                        <b>E-mail:</b> <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                    </div>
                    <div style="margin-bottom:16px;">
                        <b>Número de teléfono:</b> <input type="text" name="telefono" value="<?php echo htmlspecialchars($userData['telefono']); ?>" required>
                    </div>
                    <button type="submit" style="padding:8px 18px; border-radius:12px; background:#00b894; color:#fff; border:none;">Guardar cambios</button>
                </form>
                <?php
                break;
            case 'Codigos':
                // Añadir código si se envió el formulario
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'])) {
                    $codigo = trim($_POST['codigo']);
                    if ($codigo && !in_array($codigo, $_SESSION['codigos'])) {
                        $_SESSION['codigos'][] = $codigo;
                        echo "<div style='color:green;'>¡Código añadido!</div>";
                    } elseif (in_array($codigo, $_SESSION['codigos'])) {
                        echo "<div style='color:orange;'>Ese código ya está añadido.</div>";
                    }
                }
                ?>
                <h2>Tus códigos promocionales</h2>
                <form method="post" style="background:#fff; border-radius:12px; padding:24px; margin-bottom:20px;">
                    <label for="codigo">Añade un código promocional</label><br>
                    <input type="text" id="codigo" name="codigo" style="padding:8px; border-radius:8px; border:1px solid #ccc; width:60%; margin-right:10px;">
                    <button type="submit" style="padding:8px 18px; border-radius:12px; background:#bbb; color:#fff; border:none;">Añadir</button>
                </form>
                <div style="background:#f7f7f7; border-radius:8px; padding:12px; margin-bottom:10px;">
                    Si tienes varios códigos promocionales, se usará primero el que caduque antes
                </div>
                <ul>
                    <?php foreach ($_SESSION['codigos'] as $c): ?>
                        <li><?php echo htmlspecialchars($c); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php
                break;
            case 'Idioma':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idioma'])) {
                    $_SESSION['userData']['idioma'] = $_POST['idioma'];
                    $userData = $_SESSION['userData'];
                    echo "<div style='color:green;'>Idioma actualizado correctamente.</div>";
                }
                ?>
                <h2>Idioma</h2>
                <form method="post" style="background:#fff; border-radius:12px; padding:24px; margin-bottom:20px;">
                    <label for="idioma">Idioma de preferencia</label><br>
                    <select id="idioma" name="idioma" style="padding:8px; border-radius:8px; border:1px solid #ccc; width:60%; margin-bottom:12px;">
                        <option value="es" <?php if($userData['idioma']=='es') echo 'selected'; ?>>Español</option>
                        <option value="en" <?php if($userData['idioma']=='en') echo 'selected'; ?>>Inglés</option>
                        <option value="fr" <?php if($userData['idioma']=='fr') echo 'selected'; ?>>Francés</option>
                    </select><br>
                    <div style="background:#f7f7f7; border-radius:8px; padding:12px; margin-bottom:12px;">
                        Verás la aplicación y todas las comunicaciones en tu idioma de preferencia.
                    </div>
                    <button type="submit" style="padding:10px 28px; border-radius:20px; background:#00b894; color:#fff; border:none; font-size:1.1rem;">Guardar</button>
                </form>
                <?php
                break;
            case 'FAQ':
                // Sección Preguntas frecuentes
                ?>
                <h2>Preguntas frecuentes</h2>
                <div style="display:flex; gap:40px;">
                    <div style="min-width:200px;">
                        <div style="font-weight:bold; color:#009688; margin-bottom:10px;">Preguntas frecuentes</div>
                        <div style="margin-bottom:8px; color:#009688;">¿Cómo puedo eliminar mi cuenta de Glovo?</div>
                        <div style="margin-bottom:8px; color:#009688;">Métodos de pago e incidencias</div>
                        <div style="margin-bottom:8px; color:#009688;">Otras preguntas</div>
                    </div>
                    <div>
                        <div style="font-weight:bold; color:#e67e22;">¿Quiénes son los repartidores?</div>
                        <div style="margin-bottom:18px;">Los repartidores son mensajeros independientes conectados a nuestra plataforma. Son personas que disponen de tiempo libre, vehículo y smartphone propio, y buscan sacarle el máximo rendimiento ayudándote a resolver tus gestiones del modo más rápido y eficaz.<br>¿Quieres ser repartidor? ¡Genial! Solo tienes que rellenar la solicitud de este enlace <a href='https://couriers.glovoapp.com/es/' target='_blank'>couriers.glovoapp.com/es/</a>.</div>
                        <div style="font-weight:bold; color:#e67e22;">¿Cómo hago un pedido?</div>
                        <div style="margin-bottom:18px;">Pedir tu primer glovo es muy fácil. Simplemente sigue estos pasos:<br><br>(1) Ve a la sección "Administrar métodos de pago" y añade una tarjeta de crédito/débito.<br>(2) Vuelve a la pantalla principal e introduce la dirección de entrega. Recuerda seleccionar la ciudad correcta en el menú desplegable.<br>Si tienes un código promocional, no olvides validarlo en tu perfil antes de realizar el pedido.<br><br>Ahora, tienes tres opciones:<br>(1) Comprar algo en un restaurante o tienda: elige uno de los Partners en cualquiera de las categorías.<br>(2) Enviar algo: solo necesitas un punto de recogida y un destino, y los repartidores se ocuparán del resto.<br>(3) Pedir algo (Lo que sea): ¡describe lo que sea que necesites y los repartidores tratarán de conseguirlo!<br>Sigue los pasos necesarios para cada opción y, cuando termines, un repartidor aceptará tu pedido y lo entregará en unos minutos.<br>Si necesitas añadir más de una dirección de entrega, deberás realizar el pedido en nuestro sitio web, <a href='https://glovoapp.com' target='_blank'>glovoapp.com</a>.</div>
                        <div style="font-weight:bold; color:#e67e22;">¿Cuánto cuesta el envío?</div>
                        <div>El coste del envío depende de la distancia, la ciudad y la demanda. Puedes ver el precio antes de confirmar tu pedido.</div>
                    </div>
                </div>
                <?php
                break;
            default:
                echo '<div>Bienvenido a tu perfil.</div>';
        }
        ?>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Aquí puedes agregar cualquier funcionalidad JavaScript adicional
        // Por ejemplo, para actualizar dinámicamente la información del usuario
        
        const cerrarSesion = document.querySelector('a[href="?action=CerrarSesion"]');
        if (cerrarSesion) {
            cerrarSesion.addEventListener('click', function(e) {
                if (!confirm('¿Está seguro que desea cerrar sesión?')) {
                    e.preventDefault();
                }
            });
        }
    });
    </script>
</body>
</html>