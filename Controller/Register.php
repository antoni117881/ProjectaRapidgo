<?php
require_once __DIR__ . '/../Model/conection_BD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = 'usuario'; // Por defecto

    // Verificar si el correo ya existe
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "El correo ya está en uso.";
    } else {
        // Insertar nuevo usuario
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $hashed_password, $role);
        $stmt->execute();

        echo "Registro exitoso.";
        header('Location: ../View/index.php?action=LoginUser');
        exit;
    }
}