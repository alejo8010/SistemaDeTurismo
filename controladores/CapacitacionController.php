<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/modelos/capacitacion.php");
    class capacitacioncontroller{

        public function mostrar(int $id)
        {
            $destino = new capacitacion();
            return $destino -> mostrar($id);
        }

        public function guardar(String $idestablecimiento,String $nombre, String $fecha){
            $destino = new capacitacion();
            $resultado = $destino->guardar($idestablecimiento,$nombre,$fecha);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }
       
    }

?>