<?php
session_start();
require_once "../Model/Conection_BD.php";
require_once "Check_email.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $emailChecker = new Check_email();
    
    // Obtener y limpiar datos del formulario
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmar_password = $_POST['confirmar_password'];
    
    // Validaciones
    $errores = [];
    
    // Validar nombre
    if (strlen($nombre) < 3) {
        $errores[] = "El nombre debe tener al menos 3 caracteres";
    }
    
    // Validar email
    if (!$emailChecker->validateEmail($email)) {
        $errores[] = "Email inválido";
    }
    
    // Verificar si el email ya existe
    try {
        $query = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        if ($stmt->fetchColumn() > 0) {
            $errores[] = "Este email ya está registrado";
        }
    } catch(PDOException $e) {
        $errores[] = "Error al verificar el email";
    }
    
    // Validar contraseña
    if (strlen($password) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres";
    }
    
    // Validar confirmación de contraseña
    if ($password !== $confirmar_password) {
        $errores[] = "Las contraseñas no coinciden";
    }
    
    // Si hay errores, redirigir de vuelta al formulario
    if (!empty($errores)) {
        $error_string = implode(", ", $errores);
        header("Location: ../Resource_registro.php?error=" . urlencode($error_string));
        exit();
    }
    
    // Si no hay errores, proceder con el registro
    try {
        // Hash de la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertar nuevo usuario
        $query = "INSERT INTO usuarios (nombre, email, password, estado) VALUES (:nombre, :email, :password, 'activo')";
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password_hash);
        
        if ($stmt->execute()) {
            // Registro exitoso
            $_SESSION['registro_exitoso'] = true;
            header("Location: ../Resource_login.php?success=Registro exitoso. Por favor, inicia sesión.");
            exit();
        } else {
            header("Location: ../Resource_registro.php?error=Error al crear la cuenta");
            exit();
        }
        
    } catch(PDOException $e) {
        error_log("Error de registro: " . $e->getMessage());
        header("Location: ../Resource_registro.php?error=Error del sistema");
        exit();
    }
}

// Si alguien intenta acceder directamente a este archivo sin POST
header("Location: ../Resource_registro.php");
exit();
?> 