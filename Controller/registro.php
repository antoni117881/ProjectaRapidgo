<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__. '/../Modelo/BDDConection.php';
require_once "Check_email.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        
        $conection = DB::getInstance();
        
        
        

        $emailChecker = new Check_email();
        
        // Obtener y limpiar datos del formulario
        $nombreUsuario = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING) ?? null;
        $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING) ?? null;
        $rol = 'usuario'; // Valor por defecto
        
        // Validaciones
        $errores = [];
        
        // Validar nombre (máximo 100 caracteres según la BD)
        if (empty($nombreUsuario) || strlen($nombreUsuario) > 100) {
            $errores[] = "El nombre debe tener entre 1 y 100 caracteres";
        }
        
        // Validar email (máximo 100 caracteres según la BD)
        if (!$emailChecker->validateEmail($email) || strlen($email) > 100) {
            $errores[] = "Email inválido o demasiado largo";
        }
        
        // Validar contraseña (máximo 255 caracteres según la BD)
        if (strlen($password) < 8 || strlen($password) > 255) {
            $errores[] = "La contraseña debe tener entre 8 y 255 caracteres";
        }
        
        // Validar dirección si se proporciona (máximo 255 caracteres)
        if (!empty($direccion) && strlen($direccion) > 255) {
            $errores[] = "La dirección no puede exceder los 255 caracteres";
        }
        
        // Validar teléfono si se proporciona (máximo 20 caracteres)
        if (!empty($telefono)) {
            if (!preg_match("/^[0-9]{9}$/", $telefono) || strlen($telefono) > 20) {
                $errores[] = "El teléfono debe tener 9 dígitos";
            }
        }
        
        // Verificar si el email ya existe
        $stmt = $conection->prepare("SELECT COUNT(*) FROM usuarios WHERE Email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        if ($stmt->fetchColumn() > 0) {
            $errores[] = "Este email ya está registrado";
        }
        
        // Si hay errores, redirigir
        if (!empty($errores)) {
            throw new Exception(implode(", ", $errores));
        }
        
        // Hash de la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertar nuevo usuario
        $query = "INSERT INTO usuarios (NombreUsuario, Email, Contrasena, Direccion, Telefono, Rol) 
                 VALUES (:nombre, :email, :password, :direccion, :telefono, :rol)";
        
        $stmt = $conection->prepare($query);
        $stmt->bindParam(":nombre", $nombreUsuario);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password_hash);
        $stmt->bindParam(":direccion", $direccion);
        $stmt->bindParam(":telefono", $telefono);
        $stmt->bindParam(":rol", $rol);
        
        if ($stmt->execute()) {
            $_SESSION['registro_exitoso'] = true;
            header("Location: ../Resource_login.php?success=Registro exitoso. Por favor, inicia sesión.");
            exit();
        } else {
            throw new Exception("Error al crear la cuenta");
        }
        
    } catch(Exception $e) {
        echo "Error en registro: " . $e->getMessage();
        error_log("Error en registro: " . $e->getMessage());
        header("Location: ../Resource_registro.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}