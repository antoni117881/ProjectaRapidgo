<?php

class Check_email {
    
    public function validateEmail($email) {
        // Limpia el email de espacios
        $email = trim($email);
        
        // Verifica si el email tiene un formato válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        // Verifica si el dominio del email existe
        $domain = explode('@', $email)[1];
        if (!checkdnsrr($domain, 'MX')) {
            return false;
        }
        
        return true;
    }
    
    public function checkEmailExists($email, $connection) {
        // Previene inyección SQL
        $email = mysqli_real_escape_string($connection, $email);
        
        $query = "SELECT COUNT(*) as count FROM users WHERE email = '$email'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        
        return $row['count'] > 0;
    }
}
?>
