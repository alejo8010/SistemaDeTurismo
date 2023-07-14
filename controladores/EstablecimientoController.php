<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/modelos/establecimiento.php");
    class establecimientocontroller{

        public function mostrar(): PDOStatement
        {
            $establecimiento = new establecimiento();
            return $establecimiento -> mostrar();
        }

        public function mostrarResponsable(int $id): PDOStatement
        {
            $establecimiento = new establecimiento();
            return $establecimiento -> mostrarResponsable($id);
        }

        public function guardar(String $nombre, String $direccion, String $iddestino, String $idusuario){
            $establecimiento = new establecimiento();
            $resultado = $establecimiento->guardar( $nombre, $direccion, $iddestino, $idusuario);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }

        public function editar(int $id, String $nombre, String $direccion, String $iddestino){
            $establecimiento = new establecimiento();
            $resultado = $establecimiento->editar($id, $nombre, $direccion, $iddestino?$iddestino:0);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }

        public function asignar(int $idestablecimiento, int $idresponsable){
            $establecimiento = new establecimiento();
            $resultado = $establecimiento->asignar($idestablecimiento, $idresponsable);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }
       
    }

?>