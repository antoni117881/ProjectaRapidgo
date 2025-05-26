<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Obtener el email del usuario desde la sesión
$email = $_SESSION['user']['email'];

// Obtener los datos del usuario desde la base de datos
$userData = getUserByEmail($email); // Asegúrate de tener esta función en tu modelo

if (!isset($userData)) {
    // Manejo de error si no hay datos
    echo "No se encontraron datos del usuario.";
    exit();
}

// Inicializar datos de usuario si no existen
if (!isset($_SESSION['userData'])) {
    $_SESSION['userData'] = [
        'nombre' => 'Ana',
        'email' => 'w1917252611@gmail.com',
        'telefono' => '+34641590899',
        'idioma' => 'es',
        'direccion' => 'Calle Ejemplo 123, 28001 Madrid'
    ];
}
if (!isset($_SESSION['codigos'])) {
    $_SESSION['codigos'] = [];
}

// Inicializar pedidos de ejemplo si no existen
if (!isset($_SESSION['pedidos'])) {
    $_SESSION['pedidos'] = [
        [
            'id' => 'PED-001',
            'fecha' => '10/05/2025',
            'total' => '€12.99',
            'estado' => 'Entregado',
            'items' => [
                ['nombre' => 'Pizza Margarita', 'cantidad' => 1, 'precio' => '€12.99']
            ]
        ],
        [
            'id' => 'PED-002',
            'fecha' => '05/05/2025',
            'total' => '€17.25',
            'estado' => 'Entregado',
            'items' => [
                ['nombre' => 'Tacos al Pastor', 'cantidad' => 1, 'precio' => '€9.75'],
                ['nombre' => 'Refresco', 'cantidad' => 1, 'precio' => '€2.50'],
                ['nombre' => 'Postre', 'cantidad' => 1, 'precio' => '€5.00']
            ]
        ],
        [
            'id' => 'PED-003',
            'fecha' => '01/05/2025',
            'total' => '€7.50',
            'estado' => 'Entregado',
            'items' => [
                ['nombre' => 'Spageti Carbonara', 'cantidad' => 1, 'precio' => '€7.50']
            ]
        ]
    ];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        margin: 0 0 25px 0;
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
    .data-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px #0001;
        padding: 20px;
        margin-bottom: 25px;
    }
    .data-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 16px;
    }
    .data-item:last-child {
        margin-bottom: 0;
    }
    .data-icon {
        color: #e67e22;
        font-size: 20px;
        min-width: 24px;
        text-align: center;
    }
    .data-label {
        font-weight: 600;
        margin-bottom: 4px;
    }
    .data-value {
        color: #444;
    }
    .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0 0 15px 0;
    }
    .accordion {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px #0001;
        overflow: hidden;
        margin-bottom: 25px;
    }
    .accordion-item {
        border-bottom: 1px solid #eee;
    }
    .accordion-item:last-child {
        border-bottom: none;
    }
    .accordion-header {
        display: flex;
        justify-content: space-between;
        padding: 16px 20px;
        cursor: pointer;
        user-select: none;
    }
    .accordion-header:hover {
        background: #f9f9f9;
    }
    .order-info {
        display: flex;
        flex-direction: column;
    }
    .order-id {
        font-weight: 600;
    }
    .order-date {
        font-size: 0.9rem;
        color: #777;
    }
    .order-total {
        font-weight: bold;
        color: #e67e22;
    }
    .accordion-content {
        padding: 0 20px 16px 20px;
        display: none;
    }
    .order-details {
        background: #f7f7f7;
        padding: 15px;
        border-radius: 8px;
    }
    .order-status {
        margin-bottom: 10px;
        font-size: 0.9rem;
    }
    .order-status-value {
        color: green;
        font-weight: 600;
    }
    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-top: 1px solid #ddd;
    }
    .item-quantity {
        font-weight: 600;
        margin-right: 5px;
    }
    .item-price {
        font-weight: 500;
    }
    .order-total-row {
        display: flex;
        justify-content: space-between;
        margin-top: 12px;
        padding-top: 8px;
        border-top: 1px solid #aaa;
        font-weight: bold;
    }
    .toggle-icon {
        transition: transform 0.3s;
    }
    .active .toggle-icon {
        transform: rotate(180deg);
    }
    @media (max-width: 480px) {
        .profile-container {
            margin: 20px auto;
            padding: 0 15px;
        }
        .profile-header {
            gap: 15px;
        }
        .avatar-circle {
            width: 60px;
            height: 60px;
        }
        .profile-name {
            font-size: 1.8rem;
        }
    }
    </style>
</head>
<body>
    <div class="profile-container">
        <?php
        // Título y breadcrumb dinámico
        $action = $_GET['action'] ?? 'DatosUsuario';
        $breadcrumbs = [
            'DatosUsuario' => 'Datos de Usuario',
            'UltimosPedidos' => 'Últimos Pedidos',
            'Cuenta' => 'Cuenta',
            'Codigos' => 'Códigos promocionales',
            'Idioma' => 'Idioma',
            'FAQ' => 'Preguntas frecuentes'
        ];
        $titulo = $breadcrumbs[$action] ?? 'Datos de Usuario';
        ?>
        <div style="margin-bottom: 18px;">
            <span style="color:#009688; font-weight:bold;">Perfil</span>
            <?php if ($titulo !== 'Datos de Usuario'): ?>
                <span style="color:#888;">/</span>
                <span style="color:#888;"><?php echo $titulo; ?></span>
            <?php endif; ?>
        </div>
        <div class="profile-header">
            <div class="avatar-circle">
                <span class="avatar-letter">
                    <?php echo strtoupper(substr($userData['nombre'], 0, 1)); ?>
                </span>
            </div>
            <div>
                <h1 class="profile-name"><?php echo htmlspecialchars($userData['nombre']); ?></h1>
                <span class="profile-label">Perfil</span>
            </div>
        </div>
        <div class="profile-cards">
            <div class="profile-card">
                <div style="width:48px; height:48px; margin:0 auto 10px; display:flex; align-items:center; justify-content:center;">
                    <span style="font-size:32px; color:#e67e22;">🛒</span>
                </div>
                <a href="?action=UltimosPedidos" class="card-title">Pedidos</a>
            </div>
            <div class="profile-card">
                <div style="width:48px; height:48px; margin:0 auto 10px; display:flex; align-items:center; justify-content:center;">
                    <span style="font-size:32px; color:#e67e22;">👤</span>
                </div>
                <a href="?action=DatosUsuario" class="card-title">Cuenta</a>
            </div>
        </div>

        <ul class="profile-menu">
            <li><a href="?action=DatosUsuario"><span>👤</span> Datos de Usuario</a></li>
            <li><a href="?action=UltimosPedidos"><span>🛒</span> Últimos Pedidos</a></li>
            <li><a href="?action=ComparteYGana"><span>🗑️</span> Comparte y gana</a></li>
            <li><a href="?action=Codigos"><span>🏷️</span> Códigos promocionales</a></li>
            <li><a href="?action=Idioma"><span>🌐</span> Idioma</a></li>
            <li><a href="?action=FAQ"><span>❓</span> Preguntas frecuentes</a></li>
            <li><a href="?action=cerrarsesion"><span>🔓</span> Cerrar sesión</a></li>
        </ul>

        <div>
        <?php
        switch($action) {
            case 'DatosUsuario':
                // Guardar cambios si se envió el formulario
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_datos'])) {
                    $_SESSION['userData']['nombre'] = $_POST['nombre'];
                    $_SESSION['userData']['email'] = $_POST['email'];
                    $_SESSION['userData']['telefono'] = $_POST['telefono'];
                    $_SESSION['userData']['direccion'] = $_POST['direccion'];
                    $userData = $_SESSION['userData'];
                    echo "<div style='color:green; margin-bottom:15px;'>Datos actualizados correctamente.</div>";
                }
                ?>
                <h2 class="section-title">Datos de Usuario</h2>
                <div class="data-card">
                    <div class="data-item">
                        <div class="data-icon">👤</div>
                        <div>
                            <div class="data-label">Nombre de Usuario</div>
                            <div class="data-value"><?php echo htmlspecialchars($userData['nombre']); ?></div>
                        </div>
                    </div>
                    <div class="data-item">
                        <div class="data-icon">🌐</div>
                        <div>
                            <div class="data-label">Idioma</div>
                            <div class="data-value">
                                <?php 
                                    $idiomas = ['es' => 'Español', 'en' => 'Inglés', 'fr' => 'Francés'];
                                    echo $idiomas[$userData['idioma']] ?? $userData['idioma']; 
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="data-item">
                        <div class="data-icon">📍</div>
                        <div>
                            <div class="data-label">Dirección</div>
                            <div class="data-value"><?php echo htmlspecialchars($userData['direccion'] ?? 'No especificada'); ?></div>
                        </div>
                    </div>
                </div>

                <form method="post" class="data-card">
                    <h3 style="margin-top:0; margin-bottom:15px;">Editar información</h3>
                    <div style="margin-bottom:16px;">
                        <label for="nombre" style="display:block; margin-bottom:5px; font-weight:600;">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($userData['nombre']); ?>" required
                               style="width:100%; padding:8px; border-radius:8px; border:1px solid #ddd; box-sizing:border-box;">
                    </div>
                    <div style="margin-bottom:16px;">
                        <label for="email" style="display:block; margin-bottom:5px; font-weight:600;">E-mail:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required
                               style="width:100%; padding:8px; border-radius:8px; border:1px solid #ddd; box-sizing:border-box;">
                    </div>
                    <div style="margin-bottom:16px;">
                        <label for="telefono" style="display:block; margin-bottom:5px; font-weight:600;">Número de teléfono:</label>
                        <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($userData['telefono']); ?>" required
                               style="width:100%; padding:8px; border-radius:8px; border:1px solid #ddd; box-sizing:border-box;">
                    </div>
                    <div style="margin-bottom:16px;">
                        <label for="direccion" style="display:block; margin-bottom:5px; font-weight:600;">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($userData['direccion'] ?? ''); ?>"
                               style="width:100%; padding:8px; border-radius:8px; border:1px solid #ddd; box-sizing:border-box;">
                    </div>
                    <button type="submit" name="guardar_datos" 
                            style="padding:10px 20px; border-radius:12px; background:#00b894; color:#fff; border:none; cursor:pointer;">
                        Guardar cambios
                    </button>
                </form>
                <?php
                break;
            case 'UltimosPedidos':
                ?>
                <h2 class="section-title">Últimos Pedidos</h2>
                <?php if (empty($_SESSION['pedidos'])): ?>
                    <div class="data-card">
                        <p>No tienes pedidos recientes.</p>
                    </div>
                <?php else: ?>
                    <div class="accordion">
                        <?php foreach ($_SESSION['pedidos'] as $index => $pedido): ?>
                            <div class="accordion-item">
                                <div class="accordion-header" onclick="toggleAccordion(<?php echo $index; ?>)">
                                    <div class="order-info">
                                        <div class="order-id">Pedido: <?php echo htmlspecialchars($pedido['id']); ?></div>
                                        <div class="order-date"><?php echo htmlspecialchars($pedido['fecha']); ?></div>
                                    </div>
                                    <div style="display:flex; align-items:center; gap:10px;">
                                        <div class="order-total"><?php echo htmlspecialchars($pedido['total']); ?></div>
                                        <span class="toggle-icon">▼</span>
                                    </div>
                                </div>
                                <div id="accordion-content-<?php echo $index; ?>" class="accordion-content">
                                    <div class="order-details">
                                        <div class="order-status">
                                            Estado: <span class="order-status-value"><?php echo htmlspecialchars($pedido['estado']); ?></span>
                                        </div>
                                        
                                        <?php foreach ($pedido['items'] as $item): ?>
                                            <div class="order-item">
                                                <div>
                                                    <span class="item-quantity"><?php echo htmlspecialchars($item['cantidad']); ?>x</span>
                                                    <?php echo htmlspecialchars($item['nombre']); ?>
                                                </div>
                                                <div class="item-price"><?php echo htmlspecialchars($item['precio']); ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                        
                                        <div class="order-total-row">
                                            <div>Total</div>
                                            <div><?php echo htmlspecialchars($pedido['total']); ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php
                break;
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
    function toggleAccordion(index) {
        const content = document.getElementById('accordion-content-' + index);
        const isHidden = content.style.display !== 'block';
        
        // Cerrar todos los acordeones
        const allContents = document.getElementsByClassName('accordion-content');
        const allHeaders = document.getElementsByClassName('accordion-header');
        
    }
    </script>
</body>
</html>