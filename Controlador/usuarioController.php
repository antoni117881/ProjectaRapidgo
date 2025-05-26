<?php
require_once __DIR__ . '/../Modelo/usuario.php';

session_start();

function mostrarPerfil() {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit();
    }

    $email = $_SESSION['user']['email'];
    $userData = getUserByEmail($email);

    // Aquí puedes incluir la vista
    include __DIR__ . './Resource_usuario.php';
}
