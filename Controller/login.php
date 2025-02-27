<?php
session_start();
require_once __DIR__ . "/../Model/Conection_BD.php";
require_once __DIR__ . "/Check_email.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $emailChecker = new Check_email();
    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    // Validar email
    if (!$emailChecker->validateEmail($email)) {
        header("Location: ../Resource_login.php?error=Email inválido");
        exit();
    }
    
    try {
        $query = "SELECT id, email, password, nombre, estado FROM usuarios WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar si la cuenta está activa
            if ($row['estado'] != 'activo') {
                header("Location: ../Resource_login.php?error=Cuenta no activada");
                exit();
            }
            
            if (password_verify($password, $row['password'])) {
                // Login exitoso
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_name'] = $row['nombre'];
                
                // Manejar "recordar correo"
                if (isset($_POST['remember'])) {
                    setcookie('remember_email', $email, time() + (30 * 24 * 60 * 60), '/');
                } else {
                    setcookie('remember_email', '', time() - 3600, '/');
                }
                
                // Registrar el último acceso
                $updateQuery = "UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = :id";
                $updateStmt = $db->prepare($updateQuery);
                $updateStmt->bindParam(":id", $row['id']);
                $updateStmt->execute();
                
                header("Location: ../dashboard.php");
                exit();
            } else {
                header("Location: ../Resource_login.php?error=Contraseña incorrecta");
                exit();
            }
        } else {
            header("Location: ../Resource_login.php?error=Usuario no encontrado");
            exit();
        }
    } catch(PDOException $e) {
        error_log("Error de login: " . $e->getMessage());
        header("Location: ../Resource_login.php?error=Error del sistema");
        exit();
    }
}
?>