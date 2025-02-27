<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../View/login.php");
    exit;
}

// Verificar tiempo de inactividad (opcional)
$inactivity_time = 1800; // 30 minutos
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactivity_time)) {
    session_unset();
    session_destroy();
    header("Location: ../View/login.php?error=session_expired");
    exit;
}
$_SESSION['last_activity'] = time();

// Obtener información del usuario si es necesario
require_once __DIR__ . '/../Model/users.php';
// Aquí puedes agregar código para obtener datos del usuario si los necesitas mostrar en el menú

// Incluir la vista del menú
include_once "../View/menu.php";
?>
