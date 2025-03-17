<?php

namespace App\Controller;

use App\Models\Reseña; // Cambia 'Model' a 'Models' si es necesario
use App\View; // Cambia 'Vista' a 'View'

class ReseñaController
{
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function index()
    {
        $reseñas = Reseña::all(); // Obtener todas las reseñas
        View::render('reseñas/index', ['reseñas' => $reseñas]);
    }

    public function show($id)
    {
        $reseña = Reseña::find($id); // Encontrar una reseña por ID
        if ($reseña) {
            View::render('reseñas/show', ['reseña' => $reseña]);
        } else {
            // Manejar el caso donde no se encuentra la reseña
            View::render('errors/404');
        }
    }

    public function create()
    {
        View::render('reseñas/create');
    }

    public function store($data)
    {
        $reseña = new Reseña($data);
        if ($reseña->save()) {
            // Redirigir a la lista de reseñas
            header('Location: Vista/ResenaView.php');
        } else {
            // Manejar errores de validación
            Vista::render('reseñas/create', ['errors' => $reseña->getErrors()]);
        }
    }

    public function edit($id)
    {
        $reseña = Reseña::find($id);
        if ($reseña) {
            View::render('reseñas/edit', ['reseña' => $reseña]);
        } else {
            View::render('errors/404');
        }
    }

    public function update($id, $data)
    {
        $reseña = Reseña::find($id);
        if ($reseña) {
            $reseña->update($data);
            header('Location: /reseñas/' . $id);
        } else {
            View::render('errors/404');
        }
    }

    public function destroy($id)
    {
        $reseña = Reseña::find($id);
        if ($reseña) {
            $reseña->delete();
            header('Location: /reseñas');
        } else {
            View::render('errors/404');
        }
    }

    public function agregarReseña($descripcion, $estrellas) {
        $descripcion = htmlspecialchars($descripcion);
        $estrellas = intval($estrellas);
        $fecha = date("Y-m-d H:i:s");

        $sql_insert = "INSERT INTO reseñas (descripcion, estrellas, fecha) VALUES ('$descripcion', $estrellas, '$fecha')";
        if ($this->conn->query($sql_insert) === TRUE) {
            return "Reseña añadida con éxito.";
        } else {
            return "Error: " . $sql_insert . "<br>" . $this->conn->error;
        }
    }

    public function obtenerReseñas() {
        $sql = "SELECT descripcion, estrellas, fecha FROM reseñas ORDER BY fecha DESC";
        $result = $this->conn->query($sql);
        $reseñas = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $reseñas[] = $row;
            }
        }
        return $reseñas;
    }

    public function __destruct() {
        $this->conn->close();
    }
}
