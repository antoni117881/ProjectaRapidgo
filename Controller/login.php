<?php
require_once __DIR__ . '/../Model/users.php'; // Corrige la ruta según tu estructura
session_start();

// Obtén los datos enviados desde el formulario
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

// Verifica que los campos no estén vacíos
if (!$email || !$password) {
    echo "Por favor, completa todos los campos.";
    exit;
}

// Llama a la función para verificar las credenciales
$user = getUserByEmailAndPassword($email, $password); // Esta función debe estar en `users.php`

if ($user) {
    $_SESSION['user_id'] = $user['id'];
    header("Location: ../index.php?action=Menu");
    exit;
} else {
    header("Location: ../View/login.php?error=1");
    exit;
}
?>