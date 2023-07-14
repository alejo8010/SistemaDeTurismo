<?php
      include_once($_SERVER["DOCUMENT_ROOT"] . "/modelos/destino.php");
    class DestinoController{

        public function mostrar()
        {
            $destino = new Destino();
            return $destino -> mostrar();
        }

        public function guardar(String $nombre, String $departamento, String $provincia, String $distrito){
            $destino = new Destino();
            $resultado = $destino->guardar( $nombre, $departamento, $provincia, $distrito);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }
       
    }

?>