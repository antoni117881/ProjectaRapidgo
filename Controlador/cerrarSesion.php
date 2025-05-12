<?php
session_start(); // Iniciar la sesión

// Destruir todas las variables de sesión
$_SESSION = [];

// Si se desea destruir la sesión completamente, se puede usar:
session_destroy();

// Redirigir a la página de inicio o de inicio de sesión
header("Location: /ProjectaRapidgo/?action=Login"); // Cambia "Login" por la acción que desees
exit();
?>
