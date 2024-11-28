<?php
require_once "../Db/Con1Db.php";

class ContenidoModel
{
    public function insertContenido($tit_con)
    {
        try {
            $mysqli = (new Con1Db())->con1();

            $sql = "INSERT INTO contenidos (tit_con) VALUES (?)";
            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $mysqli->error);
            }
            $stmt->bind_param("s", $tit_con);

            if (!$stmt->execute()) {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }
            $result = ["status" => "success", "message" => "Contenido insertado con éxito."];

        } catch (Exception $e) {
            $result = ["status" => "error", "message" => $e->getMessage()];
        } finally {
            if ($stmt) $stmt->close();
            $mysqli->close();
        }
        return $result;
    }

    public function getContenidos()
    {
        try {
            $mysqli = (new Con1Db())->con1();
            $sql = "SELECT ide_con, tit_con FROM contenidos ORDER BY tit_con";
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
                        'ide_con' => $row['ide_con'],
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
