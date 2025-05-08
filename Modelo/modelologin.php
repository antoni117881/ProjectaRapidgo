<?php
function login($conection, $nameAccount, $password) {
    try {
        // Consulta para obtener la contraseña y el rol del usuario
        $consult_dataUser = $conection->prepare("SELECT contrasena, rol FROM usuarios WHERE NombreUsuario = ?");
        $consult_dataUser->bindParam(1, $nameAccount, PDO::PARAM_STR);
        $consult_dataUser->execute();
        $result = $consult_dataUser->fetch(PDO::FETCH_ASSOC); // Solo necesitamos una fila
        // Si el usuario no existe
        if (!$result) {
            return false;
        }
        
        // Verificar la contraseña
        if (password_verify($password, $result['contrasena'])) {
            $_SESSION["rol"] = $result['rol']; // Asigna el rol a la sesión
            echo "<script>alert('Bienvenido, tu rol es: " . $result['rol'] . "');</script>";
            return $result['rol'];         // Retorna el rol
        } else {
            return false;
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    return false;
}