<?php
// index.php
session_start();

$action = $_GET['action'] ?? null; //es mas robusta ?? si es null 

switch ($action) { //aqui solo apuntamos a controladores y resource no a modulos
   
    case 'Login':
        include __DIR__.'/Resource_login.php';
        break;
    case 'registro':
        include __DIR__.'/Resource_register.php';
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
    case 'Menu':
         include __DIR__.'../RegistroMenu.php';
          break;   
    case 'Filtro':
        include __DIR__.'/resource_filtro.php';
        break;
    case 'Resenas':
        include __DIR__.'/Vista/ResenaView.php';
        break;
    default:
        include __DIR__.'../RegistroMenu.php';
        break;
    }
?>