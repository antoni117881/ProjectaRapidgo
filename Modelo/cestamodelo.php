<?php 
class Cesta {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerCesta($usuario_id) {
        $stmt = $this->db->prepare("SELECT cp.producto_id, cp.cantidad 
                                    FROM cesta_productos cp
                                    JOIN cestas c ON cp.cesta_id = c.id
                                    WHERE c.usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarProducto($usuario_id, $producto_id, $cantidad = 1) {
        try {
            // Iniciar una transacción para evitar inconsistencias
            $this->db->beginTransaction();

            // Verificar si el usuario ya tiene una cesta
            $stmt = $this->db->prepare("SELECT id FROM cestas WHERE usuario_id = ?");
            $stmt->execute([$usuario_id]);
            $cesta = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$cesta) {
                // Crear una nueva cesta si no existe
                $stmt = $this->db->prepare("INSERT INTO cestas (usuario_id) VALUES (?)");
                $stmt->execute([$usuario_id]);
                $cesta_id = $this->db->lastInsertId();
            } else {
                $cesta_id = $cesta['id'];
            }

            // Verificar si el producto ya está en la cesta
            $stmt = $this->db->prepare("SELECT cantidad FROM cesta_productos WHERE cesta_id = ? AND producto_id = ?");
            $stmt->execute([$cesta_id, $producto_id]);
            $producto_existente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($producto_existente) {
                // Si el producto ya existe, actualizar la cantidad
                $stmt = $this->db->prepare("UPDATE cesta_productos SET cantidad = cantidad + ? WHERE cesta_id = ? AND producto_id = ?");
                $stmt->execute([$cantidad, $cesta_id, $producto_id]);
            } else {
                // Si el producto no existe, insertarlo
                $stmt = $this->db->prepare("INSERT INTO cesta_productos (cesta_id, producto_id, cantidad) VALUES (?, ?, ?)");
                $stmt->execute([$cesta_id, $producto_id, $cantidad]);
            }

            // Confirmar la transacción
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return "Error: " . $e->getMessage();
        }
    }

    public function eliminarProducto($usuario_id, $producto_id) {
        try {
            // Obtener la cesta del usuario
            $stmt = $this->db->prepare("SELECT id FROM cestas WHERE usuario_id = ?");
            $stmt->execute([$usuario_id]);
            $cesta = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$cesta) {
                return "No hay cesta para este usuario.";
            }

            // Eliminar el producto de la cesta
            $stmt = $this->db->prepare("DELETE FROM cesta_productos WHERE cesta_id = ? AND producto_id = ?");
            $stmt->execute([$cesta['id'], $producto_id]);

            // Verificar si la cesta quedó vacía
            $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM cesta_productos WHERE cesta_id = ?");
            $stmt->execute([$cesta['id']]);
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

            if ($total == 0) {
                // Si la cesta está vacía, eliminarla
                $stmt = $this->db->prepare("DELETE FROM cestas WHERE id = ?");
                $stmt->execute([$cesta['id']]);
            }

            return "Producto eliminado correctamente.";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function vaciarCesta($usuario_id) {
        try {
            // Obtener la cesta del usuario
            $stmt = $this->db->prepare("SELECT id FROM cestas WHERE usuario_id = ?");
            $stmt->execute([$usuario_id]);
            $cesta = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$cesta) {
                return "No hay cesta para este usuario.";
            }

            // Eliminar todos los productos de la cesta
            $stmt = $this->db->prepare("DELETE FROM cesta_productos WHERE cesta_id = ?");
            $stmt->execute([$cesta['id']]);

            // Eliminar la cesta vacía
            $stmt = $this->db->prepare("DELETE FROM cestas WHERE id = ?");
            $stmt->execute([$cesta['id']]);

            return "Cesta vaciada correctamente.";
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
