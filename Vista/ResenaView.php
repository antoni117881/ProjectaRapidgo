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
        .header {
            background-color: #333;
            color: white;
            padding: 15px 0;
            margin-bottom: 20px;
        }
        .header-content {
            width: 80%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        .form-container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
        }
        .input-resena {
    width: 100%;
    padding: 15px 20px;
    margin-bottom: 15px;
    border: none;
    border-radius: 30px;
    background: #f7e7b5;
    font-size: 1.2em;
    color: #333;
    box-shadow: 0 2px 8px rgba(216, 168, 77, 0.15);
    outline: none;
    transition: box-shadow 0.2s;
}

.input-resena:focus {
    box-shadow: 0 4px 16px rgba(216, 168, 77, 0.25);
    background: #fffbe6;
}

.btn-resena {
    width: 100%;
    padding: 15px 0;
    border: none;
    border-radius: 60px;
    background: linear-gradient(90deg, #ffb347, #ffcc33);
    color: #a94400;
    font-size: 1.2em;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(216, 168, 77, 0.15);
    transition: background 0.3s, color 0.3s;
}

.btn-resena:hover {
    background: linear-gradient(90deg, #ffcc33, #ffb347);
    color: #fff;
}
    </style>
</head>
<header>
<?php include 'Vista/Vistaheader.php'?>
</header>
<body>
   
    <div class="container">
        <h1>Reseñas de Usuarios</h1>

        <div class="form-container">
            <h2>Agregar Reseña</h2>
            <form method="POST" action="">
                <textarea class="input-resena" name="descripcion" required placeholder="Escribe tu reseña aquí..." rows="4"></textarea>
                <select class="input-resena" name="estrellas" required>
                    <option value="">Selecciona estrellas</option>
                    <option value="1">★</option>
                    <option value="2">★★</option>
                    <option value="3">★★★</option>
                    <option value="4">★★★★</option>
                    <option value="5">★★★★★</option>
                </select>
                <button class="btn-resena" type="submit">Enviar Reseña</button>
            </form>
        </div>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "rapidgobdd";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Manejar la inserción de nuevas reseñas
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $descripcion = htmlspecialchars($_POST["descripcion"]);
            $estrellas = intval($_POST["estrellas"]);
            $fecha = date("Y-m-d H:i:s");

            $sql_insert = "INSERT INTO reseñas (descripcion, estrellas, fecha) VALUES ('$descripcion', $estrellas, '$fecha')";
            if ($conn->query($sql_insert) === TRUE) {
                echo "<p>Reseña añadida con éxito.</p>";
            } else {
                echo "<p>Error: " . $sql_insert . "<br>" . $conn->error . "</p>";
            }
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
