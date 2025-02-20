<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <style>
        .error {
            color: red;
            font-size: 0.8em;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Registro de Usuario</h1>
    
    <form action="Controller/registro.php" method="POST" onsubmit="return validarFormulario()">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <span id="nombreError" class="error"></span>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <span id="emailError" class="error"></span>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <span id="passwordError" class="error"></span>
        </div>

        <div class="form-group">
            <label for="confirmar_password">Confirmar Contraseña:</label>
            <input type="password" id="confirmar_password" name="confirmar_password" required>
            <span id="confirmarPasswordError" class="error"></span>
        </div>

        <button type="submit">Registrarse</button>
    </form>

    <ul>
        <li><a href="?action=Menu">Volver al menú</a></li>
    </ul>

    <script>
    function validarFormulario() {
        let isValid = true;
        const nombre = document.getElementById('nombre').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmarPassword = document.getElementById('confirmar_password').value;

        // Validar nombre
        if (nombre.length < 3) {
            document.getElementById('nombreError').textContent = 'El nombre debe tener al menos 3 caracteres';
            isValid = false;
        } else {
            document.getElementById('nombreError').textContent = '';
        }

        // Validar email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            document.getElementById('emailError').textContent = 'Por favor, ingrese un email válido';
            isValid = false;
        } else {
            document.getElementById('emailError').textContent = '';
        }

        // Validar contraseña
        if (password.length < 6) {
            document.getElementById('passwordError').textContent = 'La contraseña debe tener al menos 6 caracteres';
            isValid = false;
        } else {
            document.getElementById('passwordError').textContent = '';
        }

        // Validar confirmación de contraseña
        if (password !== confirmarPassword) {
            document.getElementById('confirmarPasswordError').textContent = 'Las contraseñas no coinciden';
            isValid = false;
        } else {
            document.getElementById('confirmarPasswordError').textContent = '';
        }

        return isValid;
    }
    </script>
</body>
</html>