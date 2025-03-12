<?php
class Cesta {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerCesta($usuario_id) {
        $stmt = $this->db->prepare("SELECT cp.producto_id, cp.cantidad FROM cesta_productos cp
                                    JOIN cestas c ON cp.cesta_id = c.id
                                    WHERE c.usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarProducto($usuario_id, $producto_id, $cantidad = 1) {
        // Obtener o crear la cesta del usuario
        $stmt = $this->db->prepare("SELECT id FROM cestas WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        $cesta = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cesta) {
            $stmt = $this->db->prepare("INSERT INTO cestas (usuario_id) VALUES (?)");
            $stmt->execute([$usuario_id]);
            $cesta_id = $this->db->lastInsertId();
        } else {
            $cesta_id = $cesta['id'];
        }

        // Agregar producto a la cesta
        $stmt = $this->db->prepare("INSERT INTO cesta_productos (cesta_id, producto_id, cantidad) 
                                    VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE cantidad = cantidad + ?");
        return $stmt->execute([$cesta_id, $producto_id, $cantidad, $cantidad]);
    }

    public function eliminarProducto($usuario_id, $producto_id) {
        $stmt = $this->db->prepare("DELETE cp FROM cesta_productos cp
                                    JOIN cestas c ON cp.cesta_id = c.id
                                    WHERE c.usuario_id = ? AND cp.producto_id = ?");
        return $stmt->execute([$usuario_id, $producto_id]);
    }

    public function vaciarCesta($usuario_id) {
        $stmt = $this->db->prepare("DELETE cp FROM cesta_productos cp
                                    JOIN cestas c ON cp.cesta_id = c.id
                                    WHERE c.usuario_id = ?");
        return $stmt->execute([$usuario_id]);
    }
}
