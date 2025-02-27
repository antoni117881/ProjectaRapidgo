<?php
require_once 'conexion.php';

function getUserByEmailAndPassword($email, $password) {
    try {
        $conexion = getConexion();
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
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