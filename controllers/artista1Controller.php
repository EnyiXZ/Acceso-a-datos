<?php

header('Content-Type: application/json');

try {
    if (isset($_GET['action']) && $_GET['action'] === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $non_art = $_POST['non_art'] ?? null;

        if (empty($non_art)) {
            throw new Exception("El nombre del artista es obligatorio.");
        }

        require_once "../models/artista1Model.php";
        $artistaModel = new ArtistaModel();
        $response = $artistaModel->insertArtista($non_art);

        echo json_encode($response);

    } elseif (isset($_GET['action']) && $_GET['action'] === 'load') {
        require_once "../models/artista1Model.php";
        $artistaModel = new ArtistaModel();
        $artistas = $artistaModel->getArtistas();

        echo json_encode(["status" => "success", "artistas" => $artistas]);

    } else {
        throw new Exception("Acción no válida.");
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
