<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Clase para manejar los datos del usuario
class DatosUsuario {
    private $db;
    private $userData;

    public function __construct() {
        // Inicializar datos de usuario desde la sesión
        $this->userData = $_SESSION['userData'] ?? [
            'nombre' => '',
            'email' => '',
            'telefono' => '',
            'idioma' => 'es',
            'direccion' => ''
        ];
    }

    public function actualizarDatos($datos) {
        // Validar datos
        if (!$this->validarDatos($datos)) {
            return false;
        }

        // Actualizar datos en la sesión
        $_SESSION['userData'] = array_merge($this->userData, $datos);
        $this->userData = $_SESSION['userData'];
        return true;
    }

    private function validarDatos($datos) {
        // Validar email
        if (isset($datos['email']) && !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Validar teléfono (formato básico)
        if (isset($datos['telefono']) && !preg_match('/^\+?[\d\s-]{8,}$/', $datos['telefono'])) {
            return false;
        }

        return true;
    }

    public function obtenerDatos() {
        return $this->userData;
    }
}

// Procesar formulario si se envió
$mensaje = '';
$tipoMensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar_datos'])) {
    $datosUsuario = new DatosUsuario();
    
    $datosActualizados = [
        'nombre' => $_POST['nombre'] ?? '',
        'email' => $_POST['email'] ?? '',
        'telefono' => $_POST['telefono'] ?? '',
        'direccion' => $_POST['direccion'] ?? ''
    ];

    if ($datosUsuario->actualizarDatos($datosActualizados)) {
        $mensaje = 'Datos actualizados correctamente.';
        $tipoMensaje = 'success';
        // Redirigir a la página inicial después de 2 segundos
        header("refresh:2;url=index.php");
    } else {
        $mensaje = 'Error al actualizar los datos. Por favor, verifica la información.';
        $tipoMensaje = 'error';
    }
}

// Obtener datos actuales
$datosUsuario = new DatosUsuario();
$userData = $datosUsuario->obtenerDatos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de Usuario</title>
    <style>
        .mensaje {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .mensaje.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .mensaje.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn-guardar {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-guardar:hover {
            background-color: #218838;
        }
        .btn-volver {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
        .btn-volver:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Datos de Usuario</h1>
        
        <?php if ($mensaje): ?>
            <div class="mensaje <?php echo $tipoMensaje; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($userData['nombre']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($userData['telefono']); ?>" required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($userData['direccion']); ?>">
            </div>

            <button type="submit" name="guardar_datos" class="btn-guardar">Guardar Cambios</button>
            <a href="index.php" class="btn-volver">Volver al Inicio</a>
        </form>
    </div>
</body>
</html> 