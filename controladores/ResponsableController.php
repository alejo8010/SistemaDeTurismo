<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/modelos/Responsable.php");
    class ResponsableController{

        public function mostrar(): PDOStatement
        {
            $responsable = new Responsable();
            return $responsable -> mostrar();
        }

        public function mostrarDiferente(int $id): PDOStatement
        {
            $responsable = new Responsable();
            return $responsable -> mostrarDiferente($id);
        }

        public function guardar(String $dni, String $apellidos, String $nombres, String $password){
            $responsable = new Responsable();
            $resultado = $responsable->guardar($dni, $apellidos, $nombres, $password);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }

        public function actualizar(int $id, String $dni, String $apellidos, String $nombres, String $password){
            $responsable = new Responsable();
            $resultado = $responsable->actualizar($id, $dni, $apellidos, $nombres, $password);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }
       
    }

?>