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
        <?php if(isset($_GET['error'])): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        
        <form action="Controller/login.php" method="POST" onsubmit="return validarFormulario()">
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" required 
                           placeholder="ejemplo@correo.com"
                           value="<?php echo isset($_COOKIE['remember_email']) ? htmlspecialchars($_COOKIE['remember_email']) : ''; ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" required 
                           placeholder="Ingresa tu contraseña">
                    <i class="fas fa-eye toggle-password"></i>
                </div>
            </div>
            
            <div class="form-group">
                <label>
                    <input type="checkbox" name="remember" 
                           <?php echo isset($_COOKIE['remember_email']) ? 'checked' : ''; ?>>
                    Recordar correo
                </label>
            </div>
            
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i>
                Iniciar Sesión
            </button>
        </form>
        
        <div class="social-login">
            <p>O inicia sesión con:</p>
            <div class="social-buttons">
                <a href="#" class="btn-social btn-google">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#" class="btn-social btn-facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>
        </div>
        
        <div class="links">
            <a href="register.php">
                <i class="fas fa-user-plus"></i>
                ¿No tienes cuenta? Regístrate
            </a>
            <a href="forgot-password.php">
                <i class="fas fa-key"></i>
                ¿Olvidaste tu contraseña?
            </a>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.querySelector('#password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                this.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });

        function validarFormulario() {
            const email = document.querySelector('#email').value;
            const password = document.querySelector('#password').value;
            let isValid = true;

            // Validar email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Por favor, ingrese un email válido');
                isValid = false;
            }

            // Validar contraseña
            if (password.length < 6) {
                alert('La contraseña debe tener al menos 6 caracteres');
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>