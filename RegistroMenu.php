<html>
<head>
    <title>Página Principal</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#">RAPIDGO</a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?action=Login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?action=registro">Registro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?action=Usuario">Mi cuenta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?action=Restaurantes">Restaurantes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?action=Menus">Menus</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="?action=Ofertas">Ofertas</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
    <main>
        <div class="productos">
            <?php
            require_once 'Controlador/Menu.php'; // Asegúrate de que esto esté correcto
            
            // Crear una instancia de ProductoModelo
            $productoModelo = new ProductoModelo($conection);
            $productos = $productoModelo->ProductosInicio(); // Llama al método

            // Incluir el archivo que muestra los productos
            require_once 'Vista/VistaProductos.php';
            ?>
        </div>
    </main>
</body>
</html>
