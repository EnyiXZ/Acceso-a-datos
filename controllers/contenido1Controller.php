<?php

header('Content-Type: application/json');

try {
    if (isset($_GET['action']) && $_GET['action'] === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $tit_con = $_POST['titulo'] ?? null;

        if (empty($tit_con)) {
            throw new Exception("El título del contenido es obligatorio.");
        }

        require_once "../models/contenido1Model.php";
        $contenidoModel = new ContenidoModel();
        $response = $contenidoModel->insertContenido($tit_con);

        echo json_encode($response);

    } elseif (isset($_GET['action']) && $_GET['action'] === 'load') {
        require_once "../models/contenido1Model.php";
        $contenidoModel = new ContenidoModel();
        $contenidos = $contenidoModel->getContenidos();

        echo json_encode(["status" => "success", "contenidos" => $contenidos]);

    } else {
        throw new Exception("Acción no válida.");
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
