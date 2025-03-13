<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Recuperar Contraseña</h2>
        
        <?php if(isset($_GET['error'])): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['success'])): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>
        
        <form action="Controller/reset-password.php" method="POST">
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" required 
                           placeholder="Ingresa tu correo electrónico">
                </div>
            </div>
            
            <button type="submit" class="btn-login">
                Enviar enlace de recuperación
            </button>
        </form>
        
        <div class="links">
            <a href="Resource_login.php">
                <i class="fas fa-arrow-left"></i>
                Volver al inicio de sesión
            </a>
        </div>
    </div>
</body>
</html> 