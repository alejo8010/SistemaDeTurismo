<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/modelos/Establecimiento.php");
    class EstablecimientoController{

        public function mostrar(): PDOStatement
        {
            $establecimiento = new Establecimiento();
            return $establecimiento -> mostrar();
        }

        public function mostrarResponsable(int $id): PDOStatement
        {
            $establecimiento = new Establecimiento();
            return $establecimiento -> mostrarResponsable($id);
        }

        public function guardar(String $nombre, String $direccion, String $iddestino, String $idusuario){
            $establecimiento = new Establecimiento();
            $resultado = $establecimiento->guardar( $nombre, $direccion, $iddestino, $idusuario);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }

        public function editar(int $id, String $nombre, String $direccion, String $iddestino){
            $establecimiento = new Establecimiento();
            $resultado = $establecimiento->editar($id, $nombre, $direccion, $iddestino?$iddestino:0);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }

        public function asignar(int $idestablecimiento, int $idresponsable){
            $establecimiento = new Establecimiento();
            $resultado = $establecimiento->asignar($idestablecimiento, $idresponsable);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }
       
    }

?>