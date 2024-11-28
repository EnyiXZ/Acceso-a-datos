<?php
require_once "../Db/Con1Db.php";

class ArtistaModel
{
    public function insertArtista($non_art)
    {
        try {

            $mysqli = (new Con1Db())->con1();

  
            $sql = "INSERT INTO artistas (non_art) VALUES (?)";
            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $mysqli->error);
            }

           
            $stmt->bind_param("s", $non_art);

  
            if (!$stmt->execute()) {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }


            $result = ["status" => "success", "message" => "Artista insertado con éxito."];

        } catch (Exception $e) {

            $result = ["status" => "error", "message" => $e->getMessage()];
        } finally {

            if ($stmt) $stmt->close();
            $mysqli->close();
        }


        return $result;
    }

    public function getArtistas() {
        try {

            $mysqli = (new Con1Db())->con1();

  
            $sql = "SELECT ide_art, non_art FROM artistas ORDER BY non_art";
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
                        'ide_art' => $row['ide_art'],
                        'non_art' => $row['non_art'],
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
