<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/modelos/Capacitacion.php");
    class CapacitacionController{

        public function mostrar(int $id)
        {
            $destino = new Capacitacion();
            return $destino -> mostrar($id);
        }

        public function guardar(String $idestablecimiento,String $nombre, String $fecha){
            $destino = new Capacitacion();
            $resultado = $destino->guardar($idestablecimiento,$nombre,$fecha);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }
       
    }

?>