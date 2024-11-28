<?php

header('Content-Type: application/json');

try {
    if (isset($_GET['action']) && $_GET['action'] === 'associate' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $ide_art = $_POST['ide_art'] ?? null;
        $ide_con = $_POST['ide_con'] ?? null;

        if (empty($ide_art) || empty($ide_con)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        require_once "../models/artista-contenido1Model.php";
        $artistaContenidoModel = new ArtistaContenidoModel();

        $response = $artistaContenidoModel->associate($ide_art, $ide_con);

        echo json_encode($response);

    } elseif (isset($_GET['action']) && $_GET['action'] === 'load') {
        require_once "../models/artista-contenido1Model.php";
        $artistaContenidoModel = new ArtistaContenidoModel();

        $data = $artistaContenidoModel->getArtistasContenidos();

        echo json_encode(["status" => "success", "artistas_contenidos" => $data]);
    } else {
        throw new Exception("Acción no válida.");
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
