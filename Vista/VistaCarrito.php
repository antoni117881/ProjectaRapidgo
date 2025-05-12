<?php
include '../Modelo/BDDConection.php'; // Ajusta la ruta si es necesario
session_start();
if (!isset($_SESSION['usuario_id'])) {
    die("Debes iniciar sesión primero.");
}
$usuario_id = $_SESSION['usuario_id']; // Asegúrate de tener el id del usuario en sesión

// Consulta para obtener los productos del carrito
$sql = "SELECT c.id, p.nombre, c.cantidad, p.imagen 
        FROM carrito c
        JOIN productos p ON c.producto_id = p.id
        WHERE c.usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrito de Compras</title>
    <style>
        img { width: 80px; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        button { padding: 5px 10px; }
    </style>
</head>
<body>
    <h2>Mi Carrito</h2>
    <table>
        <tr>
            <th>Imagen</th>
            <th>Nombre del Producto</th>
            <th>Cantidad</th>
            <th>Aumentar</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><img src="<?php echo $row['imagen']; ?>" alt="Imagen"></td>
            <td><?php echo $row['nombre']; ?></td>
            <td><?php echo $row['cantidad']; ?></td>
            <td>
                <form action="aumentar_cantidad.php" method="POST" style="display:inline;">
                    <input type="hidden" name="carrito_id" value="<?php echo $row['id']; ?>">
                    <button type="submit">+</button>
                </form>
            </td>
            <td>
                <form action="eliminar_producto.php" method="POST" style="display:inline;">
                    <input type="hidden" name="carrito_id" value="<?php echo $row['id']; ?>">
                    <button type="submit">Eliminar</button>
                </form>
                <form action="comprar_producto.php" method="POST" style="display:inline;">
                    <input type="hidden" name="carrito_id" value="<?php echo $row['id']; ?>">
                    <button type="submit">Comprar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
