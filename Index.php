<?php
// index.php
session_start();

$action = $_GET['action'] ?? null; //es mas robusta ?? si es null 

switch ($action) { //aqui solo apuntamos a controladores y resource no a modulos
   
    case 'Login':
        include __DIR__.'/Resource_lgin.php';
        break;
    case 'registro':
        include __DIR__.'/Resource_registro.php';
         break;
             
    case 'Restaurantes':
        include __DIR__.'./Vista/restaurantes.php';
          break;
          case 'Ofertas':
            include __DIR__.'./Vista/Ofertas.php';
              break;
    case 'Menus':
        include __DIR__.'./Vista/Menus.php';
        break;
        case 'Usuario':
            include __DIR__.'./Resource_usuario.php';
            break;
     
            default:
            include __DIR__.'/RegistroMenu.php'; // Corrige la ruta
            break;
    }
?>