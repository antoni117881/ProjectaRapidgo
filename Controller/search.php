<?php
require_once __DIR__. '/../Modelo/BDDConection.php';

header('Content-Type: application/json');

// Configura tus datos de conexión
$host = 'localhost';
$db = 'rapidgobdd';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

// Recibe el JSON
$input = json_decode(file_get_contents('php://input'), true);
$query = $input['query'] ?? '';
$filters = $input['filter'] ?? [];

// Prepara la consulta según los filtros
$results = [];

// Solo procesar el filtro de productos
if (in_array('productos', $filters)) {
    $sql = "SELECT Nombre, PrecioUnidad, Descripcion, Imagen FROM productos WHERE Nombre LIKE ?";
    $stmt = $conn->prepare($sql);
    $like = "%$query%";
    $stmt->bind_param('s', $like);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $results[] = [
            'nombre' => $row['Nombre'],
            'tipo' => 'producto',
            'precio' => $row['PrecioUnidad'],
            'descripcion' => $row['Descripcion'],
            'imagen' => $row['Imagen']
        ];
    }
}

echo json_encode($results);
?> 