<?php
require_once __DIR__ . "/../Model/Conection_BD.php";

header('Content-Type: application/json');

try {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = isset($_GET['query']) ? trim($_GET['query']) : '';
    $filters = isset($_GET['filters']) ? explode(',', $_GET['filters']) : ['productos', 'restaurantes', 'tipo_comida'];
    
    if (empty($query)) {
        echo json_encode([]);
        exit;
    }

    $results = [];
    $searchQuery = "%{$query}%";

    // Búsqueda en productos
    if (in_array('productos', $filters)) {
        $stmt = $db->prepare("
            SELECT 
                id,
                nombre,
                precio,
                'producto' as tipo
            FROM productos 
            WHERE nombre LIKE :query 
            OR descripcion LIKE :query
            LIMIT 10
        ");
        $stmt->bindParam(':query', $searchQuery);
        $stmt->execute();
        $results = array_merge($results, $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    // Búsqueda en restaurantes
    if (in_array('restaurantes', $filters)) {
        $stmt = $db->prepare("
            SELECT 
                id,
                nombre,
                tipo_comida,
                'restaurante' as tipo
            FROM restaurantes 
            WHERE nombre LIKE :query 
            OR descripcion LIKE :query
            LIMIT 10
        ");
        $stmt->bindParam(':query', $searchQuery);
        $stmt->execute();
        $results = array_merge($results, $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    // Búsqueda en tipos de comida
    if (in_array('tipo_comida', $filters)) {
        $stmt = $db->prepare("
            SELECT DISTINCT 
                tipo_comida as nombre,
                'tipo_comida' as tipo
            FROM restaurantes 
            WHERE tipo_comida LIKE :query
            LIMIT 10
        ");
        $stmt->bindParam(':query', $searchQuery);
        $stmt->execute();
        $results = array_merge($results, $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    // Ordenar resultados por relevancia
    usort($results, function($a, $b) use ($query) {
        // Priorizar coincidencias exactas
        $aStartsWith = stripos($a['nombre'], $query) === 0;
        $bStartsWith = stripos($b['nombre'], $query) === 0;
        
        if ($aStartsWith && !$bStartsWith) return -1;
        if (!$aStartsWith && $bStartsWith) return 1;
        
        return strcasecmp($a['nombre'], $b['nombre']);
    });

    echo json_encode($results);

} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la búsqueda']);
} 