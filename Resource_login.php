<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .error-message {
            color: red; 
            margin-bottom: 15px;
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
                    <a href="?action=NewPassword">¿Olvidaste tu contraseña?</a>
                    <a href="?action=Registro">Crear Cuenta</a>
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