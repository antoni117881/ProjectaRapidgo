<?php

class ModeloUsuario {

    public function verificarEmail($email) {
        $sql = "SELECT COUNT(*) as count FROM usuarios WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$email]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['count'] > 0;
    }

    public function guardarTokenRecuperacion($email, $token, $expira) {
        $sql = "UPDATE usuarios SET token_recuperacion = ?, token_expiracion = ? WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$token, $expira, $email]);
    }

    public function verificarToken($token) {
        $sql = "SELECT email FROM usuarios WHERE token_recuperacion = ? AND token_expiracion > NOW()";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarContraseña($email, $nuevaContraseña) {
        $hash = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET password = ?, token_recuperacion = NULL, token_expiracion = NULL WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([$hash, $email]);
    }
} 