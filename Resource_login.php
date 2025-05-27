<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body {
            background-color: #f9f3d2; /* Color de fondo */
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #ffffff; /* Fondo blanco para el contenedor */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #333; /* Color del título */
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%; /* Ancho completo */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #00b894; /* Color del botón */
            color: white; /* Color del texto del botón */
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            width: 100%; /* Ancho completo */
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #009688; /* Color al pasar el ratón */
        }

        .form-links {
            text-align: center;
            margin-top: 10px;
        }

        .form-links a {
            color: #007bff; /* Color de los enlaces */
            text-decoration: none;
        }

        .form-links a:hover {
            text-decoration: underline; /* Subrayar al pasar el ratón */
        }

        .error-message {
            color: red; 
            margin-bottom: 15px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .container-login {
            flex: 1;
            padding: 10px;
        }

        .logo-container {
            flex: 1;
            text-align: center;
        }

        .logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .product-card {
            background-color: #ffcc66; /* Color de fondo de las tarjetas */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 10px;
            padding: 15px;
            width: 250px; /* Ancho de las tarjetas */
            text-align: center;
        }

        .product-card img {
            width: 100%; /* Imagen ocupa todo el ancho de la tarjeta */
            border-radius: 10px;
        }

        .product-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333; /* Color del texto */
        }

        .product-category {
            font-size: 1rem;
            color: #666; /* Color del texto de la categoría */
        }

        .product-price {
            font-size: 1.2rem;
            color: #e67e22; /* Color del precio */
        }

        .button {
            background-color: #00b894; /* Color de fondo del botón */
            color: white; /* Color del texto del botón */
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #009688; /* Color al pasar el ratón */
        }
    </style>
</head>
<header>
<?php include 'Vista/Vistaheader.php'; ?>
</header>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="assets/images/logo.png" alt="Logo de la empresa" class="logo">
        </div>
        
        <h2>Iniciar Sesión</h2>
        
        <!-- Mensajes de error o éxito -->
        <div class="container">
        <div class="container-login">
            <form action="?action=login2" method="post" class="form-login">
               

                <label for="nameAccount">Usuario</label>
                <input type="text" id="nameAccount" name="nameAccount" maxlength="12" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" maxlength="12" required>
                <br>


                <input type="submit" value="Iniciar Sesión" class="boton-logear">

                <div class="form-links">
                    <a href="?action=newpassword">¿Olvidaste tu contraseña?</a>
                    <a href="?action=registro">Crear Cuenta</a>
                </div>
                <div class="form-group">
                <label>
                    <input type="checkbox" name="remember" 
                           <?php echo isset($_COOKIE['remember_email']) ? 'checked' : ''; ?>>
                    Recordar correo
                </label>
            </div>
            </form>
        </div>
    </div>

</body>
</html>