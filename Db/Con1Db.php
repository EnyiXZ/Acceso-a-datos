<?php
class Con1Db {
    public function con1() {
        $se = "localhost";
        $us = "root";
        $co = "";
        $bd = "bd1";
        $mysqli = new mysqli($se, $us, $co, $bd);

        if ($mysqli->connect_errno) {
            $mensaje = "Error de conexión a BD\r\n" . $mysqli->connect_error;
            $mensaje = wordwrap($mensaje, 70, "\r\n");
 
            mail('xxx@xxx.com', 'Error de conexión a BD', $mensaje);
            exit();
        } else {
            $mysqli->set_charset("utf8");
            return $mysqli;
        }
    }
}
?>
