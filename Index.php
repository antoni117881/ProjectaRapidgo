<?php
// index.php
session_start();

$action = $_GET['action'] ?? null; //es mas robusta ?? si es null 

switch ($action) { //aqui solo apuntamos a controladores y resource no a modulos
   
    case 'Login':
        include __DIR__.'/Resource_login.php';
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
            case 'RestauranteMenu':
                include __DIR__.'./RegistroRestaurante.php';
                break;

                
            default:
            include __DIR__.'/RegistroMenu.php';
            break;
    }
?>
<html>
    <body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  
    </body>
</html>
