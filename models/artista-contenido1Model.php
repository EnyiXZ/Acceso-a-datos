<?php
require_once "../Db/Con1Db.php";

class ArtistaContenidoModel
{
    public function associate($ide_art, $ide_con)
    {
        try {
            $mysqli = (new Con1Db())->con1();

            $sql = "INSERT INTO artistas_contenidos (ide_art, ide_con) VALUES (?, ?)";
            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $mysqli->error);
            }

            $stmt->bind_param("ii", $ide_art, $ide_con);

            if (!$stmt->execute()) {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }

            $result = ["status" => "success", "message" => "Asociación creada con éxito."];

        } catch (Exception $e) {
            $result = ["status" => "error", "message" => $e->getMessage()];
        } finally {
            if ($stmt) $stmt->close();
            $mysqli->close();
        }

        return $result;
    }

    public function getArtistasContenidos()
    {
        try {
            $mysqli = (new Con1Db())->con1();

            $sql = "SELECT ac.ide_arc, ac.ide_art, ac.ide_con, a.non_art, c.tit_con 
                    FROM artistas_contenidos ac 
                    JOIN artistas a ON ac.ide_art = a.ide_art 
                    JOIN contenidos c ON ac.ide_con = c.ide_con 
                    ORDER BY c.tit_con, a.non_art";
            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $mysqli->error);
            }

            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];

            if ($result->num_rows >= 1) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = [
                        'ide_arc' => $row['ide_arc'],
                        'ide_art' => $row['ide_art'],
                        'ide_con' => $row['ide_con'],
                        'non_art' => $row['non_art'],
                        'tit_con' => $row['tit_con'],
                    ];
                }
            }

            $result->free();
            $stmt->close();
            $mysqli->close();

            return $data;

        } catch (Exception $e) {
            return ["status" => "error", "message" => $e->getMessage()];
        }
    }
}
?>
