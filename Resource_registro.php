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
            background-color: #f5f5f5;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .main-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
            margin-top: 60px;
        }
        .form-container {
            background-color: white;
            padding: 32px 28px 28px 28px;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            color: #222;
        }
        .input-group {
            position: relative;
        }
        .input-group i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 16px;
        }
        .input-group input, .input-group select {
            width: 100%;
            padding: 10px 10px 10px 38px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
            background: #fafbfc;
            transition: border 0.2s;
        }
        .input-group input:focus, .input-group select:focus {
            border-color: #4CAF50;
            outline: none;
            background: #fff;
        }
        .error {
            color: #d32f2f;
            background-color: #ffebee;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .btn-submit {
            background: linear-gradient(90deg, #ff9800 0%, #4CAF50 100%);
            color: white;
            padding: 13px 0;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 17px;
            font-weight: bold;
            margin-top: 10px;
            box-shadow: 0 2px 8px rgba(76,175,80,0.08);
            transition: background 0.3s;
        }
        .btn-submit:hover {
            background: linear-gradient(90deg, #4CAF50 0%, #ff9800 100%);
        }
        .login-link {
            text-align: center;
            margin-top: 22px;
        }
        .login-link a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        header {
            width: 100vw;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            background: linear-gradient(90deg, #ff9800 0%, #ff5722 100%);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        @media (max-width: 600px) {
            .form-container {
                padding: 18px 6vw 18px 6vw;
                max-width: 98vw;
            }
            .main-wrapper {
                min-height: 100vh;
            }
        }
    </style>
</head>
<body>
<header>
    <?php include 'Vista/Vistaheader.php'?>
</header>
<div class="main-wrapper">
    <div class="form-container">
        <h2 style="text-align: center; color: #333; margin-bottom: 28px;">Registro de Usuario</h2>
        <?php if(isset($_GET['error'])): ?>
            <div class="error">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        <form action="Controller/registro.php" method="POST" onsubmit="return validarFormulario()">
            <div class="form-group">
                <label for="nombre">Nombre de Usuario:</label>
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" id="nombre" name="nombre" required 
                           minlength="2" maxlength="100" 
                           placeholder="Ingrese su nombre de usuario">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" required 
                           maxlength="100" 
                           placeholder="ejemplo@correo.com">
                </div>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <div class="input-group">
                    <i class="fas fa-home"></i>
                    <input type="text" id="direccion" name="direccion" 
                           maxlength="255" 
                           placeholder="Ingrese su dirección">
                </div>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <div class="input-group">
                    <i class="fas fa-phone"></i>
                    <input type="tel" id="telefono" name="telefono" 
                           pattern="[0-9]{9}" 
                           maxlength="20"
                           placeholder="Ingrese su teléfono (9 dígitos)"
                           title="Ingrese un número de teléfono válido de 9 dígitos">
                </div>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" 
                           required minlength="8" maxlength="255"
                           placeholder="Mínimo 8 caracteres">
                </div>
            </div>
            <div class="form-group">
                <label for="confirmar_password">Confirmar Contraseña:</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="confirmar_password" 
                           name="confirmar_password" required
                           placeholder="Repita su contraseña">
                </div>
            </div>
            <div class="form-group">
                <label for="rol">Rol:</label>
                <div class="input-group">
                    <i class="fas fa-user-tag"></i>
                    <select id="rol" name="rol" required>
                        <option value="usuario">Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-submit" >
                <i class="fas fa-user-plus"></i> Registrarse
            </button>
        </form>
        <div class="login-link">
            ¿Ya tienes una cuenta? <a href="?action=Login">Iniciar Sesión</a>
        </div>
    </div>
</div>
<script>
    function validarFormulario() {
        const password = document.getElementById('password').value;
        const confirmarPassword = document.getElementById('confirmar_password').value;
        const telefono = document.getElementById('telefono').value;
        const email = document.getElementById('email').value;
        // Validar coincidencia de contraseñas
        if (password !== confirmarPassword) {
            alert('Las contraseñas no coinciden');
            return false;
        }
        // Validar longitud de contraseña
        if (password.length < 8) {
            alert('La contraseña debe tener al menos 8 caracteres');
            return false;
        }
        // Validar formato de teléfono
        if (telefono && !telefono.match(/^[0-9]{9}$/)) {
            alert('El teléfono debe tener 9 dígitos numéricos');
            return false;
        }
        // Validar formato de email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Por favor, ingrese un email válido');
            return false;
        }
        return true;
    }
</script>
</body>
</html>