<header>
    <style>
        
        .navbar {
    width: 100%;
    height: 85px;
    background: linear-gradient(90deg, #ff7e5f, #feb47b, #86a8e7);
    background-size: 200% 100%;
    animation: moveGradient 5s ease-in-out infinite alternate;
    font-family: 'Faculty Glyphic' ;
    text-shadow: 0px 0px 4px rgba(161, 11, 11, 0.91);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    font-size: 25;

}

@keyframes moveGradient {
    0% {
        background-position: 0% 50%;
    }
    100% {
        background-position: 100% 50%;
    }
}

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color:rgb(222, 35, 10) !important;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
            padding: 10px;
            border-radius: 5px;
        }

        .nav-link:hover {
            color: rgb(255, 255, 255) !important;
            background-color: rgba(255, 94, 0, 0.7);
        }

        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar-nav .nav-item {
            margin: 0 5px;
        }

        .nav-Us .nav-link {
            padding: 8px 15px;
            border-radius: 5px;
        }

        .nav-Us .nav-link:hover {
            background-color: #f8f9fa;
        }

        .usu {
            margin-left: auto;
        }

        @media (max-width: 991px) {
            .navbar-collapse {
                background-color: white;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
        }

        /* Estilo específico para el botón Mi cuenta (solo icono) */
        .nav-Us .nav-link[href="?action=Usuario"] {
            background-color: rgb(255, 94, 0);
            color: white !important;
            padding: 10px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .nav-Us .nav-link[href="?action=Usuario"]:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Ajustar tamaño del icono */
        .nav-Us .nav-link[href="?action=Usuario"] i {
            font-size: 18px;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
        }

        .btn-resena, .btn-pago, .btn-cesta {
            border: 1px solid #333;
            background-color: white;
            color: #333;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-resena:hover, .btn-pago:hover, .btn-cesta:hover {
            background-color: #ff7e5f;
            color: white;
        }
    </style>

    <!-- Asegúrate de incluir Font Awesome en el head de tu documento -->
    <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="navbar-brand" href="index.php">RAPIDGO</a>
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
                <button onclick="location.href='Vista/ResenaView.php'" class="btn-resena">Reseñas</button>
        <button onclick="location.href='Vista/CestaView.php'" class="btn-cesta">Cesta</button>
            </ul>
            <div class="usu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item nav-Us">
                        <a class="nav-link active" aria-current="page" href="?action=Login">Login</a>
                    </li>
                    <li class="nav-item nav-Us">
                        <a class="nav-link active" aria-current="page" href="?action=registro">Iniciar Sesion</a>
                    </li>
                    <li class="nav-item nav-Us">
                        <a class="nav-link active" aria-current="page" href="?action=Usuario">
                            <i class="fas fa-user"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
</header>
