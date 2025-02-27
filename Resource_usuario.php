<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    
</head>
<body>
    <div class="container">
        <header>
            <h1>Mi Perfil de Usuario</h1>
        </header>

        <section class="user-info">
            <h2>Información Personal</h2>
            <p><strong>Nombre:</strong> <span id="userName"><?php echo $userData['nombre'] ?? ''; ?></span></p>
            <p><strong>Email:</strong> <span id="userEmail"><?php echo $userData['email'] ?? ''; ?></span></p>
            <p><strong>Fecha de registro:</strong> <span id="userRegDate"><?php echo $userData['fecha_registro'] ?? ''; ?></span></p>
        </section>

        <nav>
            <ul class="actions-menu">
                <li><a href="?action=EditarPerfil">Editar Perfil</a></li>
                <li><a href="?action=CambiarPassword">Cambiar Contraseña</a></li>
                <li><a href="?action=MisPedidos">Mis Pedidos</a></li>
                <li><a href="?action=Favoritos">Mis Favoritos</a></li>
                <li><a href="?action=Menu">Volver al Menú Principal</a></li>
                <li><a href="?action=CerrarSesion">Cerrar Sesión</a></li>
            </ul>
        </nav>

        <section class="user-orders">
            <h2>Últimos Pedidos</h2>
            <table class="order-history">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Número de Pedido</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($ultimosPedidos) && !empty($ultimosPedidos)): ?>
                        <?php foreach ($ultimosPedidos as $pedido): ?>
                            <tr>
                                <td><?php echo $pedido['fecha']; ?></td>
                                <td><?php echo $pedido['numero_pedido']; ?></td>
                                <td><?php echo $pedido['total']; ?> €</td>
                                <td><?php echo $pedido['estado']; ?></td>
                                <td>
                                    <a href="?action=VerPedido&id=<?php echo $pedido['id']; ?>">Ver Detalles</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay pedidos recientes</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Aquí puedes agregar cualquier funcionalidad JavaScript adicional
        // Por ejemplo, para actualizar dinámicamente la información del usuario
        
        const cerrarSesion = document.querySelector('a[href="?action=CerrarSesion"]');
        if (cerrarSesion) {
            cerrarSesion.addEventListener('click', function(e) {
                if (!confirm('¿Está seguro que desea cerrar sesión?')) {
                    e.preventDefault();
                }
            });
        }
    });
    </script>
</body>
</html>