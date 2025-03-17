<?php
require_once 'BDDCconexion.php';

function getConexion() {
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=rapidgobdd', 'root', '');
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        // Manejo del error
        return null;
    }
}

function getUserByEmailAndPassword($email, $password) {
    try {
        $conexion = getConexion();
        $query = "SELECT nombre, email, fecha_registro FROM users WHERE email = :email";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Después de verificar las credenciales
            session_start();
            $_SESSION['user'] = $user; // Almacena la información del usuario en la sesión
            return $user;
        }
        return false;
    } catch (PDOException $e) {
        // Manejo del error
        return false;
    }
}

function registerUser($nombre, $email, $password) {
    try {
        $conexion = getConexion();
        // Verificar si el email ya existe
        $query = "SELECT id FROM users WHERE email = :email";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return false; // El email ya existe
        }

        // Hash de la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertar nuevo usuario
        $query = "INSERT INTO users (nombre, email, password) VALUES (:nombre, :email, :password)";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        // Manejo del error
        return false;
    }
} 

session_start();
if (isset($_SESSION['user'])) {
    $nombre = $_SESSION['user']['nombre'];
    $email = $_SESSION['user']['email'];
    $fecha_registro = $_SESSION['user']['fecha_registro'];
} else {
    // Redirigir a la página de login si no hay sesión
    header("Location: login.php");
    exit();
}