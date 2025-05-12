</html>
</head>

<body>
    <div>
    
    </div>

    <div class="container">
        <div class="container-login">
            <form action="?action=login2" method="post" class="form-login">
                <h1>Iniciar Sesión</h1>

                <label for="nameAccount">Usuario</label>
                <input type="text" id="nameAccount" name="nameAccount" maxlength="12" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" maxlength="12" required>

                <input type="submit" value="Iniciar Sesión" class="boton-logear">

                <div class="form-links">
                    <a href="?action=NewPassword">¿Olvidaste tu contraseña?</a>
                    <a href="?action=Registro">Crear Cuenta</a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        Footer
    </footer>
</body>

</html>
