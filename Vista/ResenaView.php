<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .review {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
        }
        .review p {
            margin: 0 0 10px;
        }
        .stars {
            color: #f39c12;
        }
        .date {
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reseñas de Usuarios</h1>
        <?php
        $servername = "localhost";
        $username = "usuario";
        $password = "contraseña";
        $dbname = "nombre_base_datos";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "SELECT descripcion, estrellas, fecha FROM reseñas ORDER BY fecha DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='review'>";
                echo "<p>" . htmlspecialchars($row["descripcion"]) . "</p>";
                echo "<p class='stars'>" . str_repeat("★", $row["estrellas"]) . "</p>";
                echo "<p class='date'>Fecha: " . $row["fecha"] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay reseñas.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
