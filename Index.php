
<?php
// index.php
session_start();

$action = $_GET['action'] ?? null; //es mas robusta ?? si es null 

switch ($action) { //aqui solo apuntamos a controladores y resource no a modulos
   
    default:
        include __DIR__.'../RegistroMenu.php';
        break;
    }
?>