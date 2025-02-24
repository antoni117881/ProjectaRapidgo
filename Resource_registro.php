<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .error {
            color: red;
            background-color: #ffe6e6;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .input-group {
            position: relative;
        }
        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }
        .input-group input {
            padding-left: 35px;
        }
        .menu-link {
            display: inline-block;
            margin-top: 20px;
            color: #666;
            text-decoration: none;
        }
        .menu-link:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Registro de Usuario</h1>
    
    <?php if(isset($_GET['error'])): ?>
        <div class="error">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>
    
    <form action="Controller/registro.php" method="POST" onsubmit="return validarFormulario()">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="nombre" name="nombre" required minlength="2" maxlength="100">
            </div>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" required maxlength="100">
            </div>
        </div>
        
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <div class="input-group">
                <i class="fas fa-home"></i>
                <input type="text" id="direccion" name="direccion" maxlength="255">
            </div>
        </div>
        
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <div class="input-group">
                <i class="fas fa-phone"></i>
                <input type="tel" id="telefono" name="telefono" pattern="[0-9]{9}" 
                       title="Ingrese un número de teléfono válido de 9 dígitos">
            </div>
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" required minlength="8" maxlength="255">
            </div>
        </div>
        
        <div class="form-group">
            <label for="confirmar_password">Confirmar Contraseña:</label>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="confirmar_password" name="confirmar_password" required>
            </div>
        </div>
        
        <button type="submit" class="btn">
            <i class="fas fa-user-plus"></i> Registrarse
        </button>
    </form>

    <p style="text-align: center; margin-top: 20px;">
        ¿Ya tienes una cuenta? <a href="?action=Login">Iniciar Sesión</a>
    </p>

    <a href="?action=menu" class="menu-link">Volver al menú</a>

    <script>
        function validarFormulario() {
            const password = document.getElementById('password').value;
            const confirmarPassword = document.getElementById('confirmar_password').value;
            const telefono = document.getElementById('telefono').value;
            
            if (password !== confirmarPassword) {
                alert('Las contraseñas no coinciden');
                return false;
            }
            
            if (password.length < 8) {
                alert('La contraseña debe tener al menos 8 caracteres');
                return false;
            }
            
            if (telefono && !telefono.match(/^[0-9]{9}$/)) {
                alert('El teléfono debe tener 9 dígitos');
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>