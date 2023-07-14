<?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/modelos/responsable.php");
    class responsablecontroller{

        public function mostrar(): PDOStatement
        {
            $responsable = new responsable();
            return $responsable -> mostrar();
        }

        public function mostrarDiferente(int $id): PDOStatement
        {
            $responsable = new responsable();
            return $responsable -> mostrarDiferente($id);
        }

        public function guardar(String $dni, String $apellidos, String $nombres, String $password){
            $responsable = new responsable();
            $resultado = $responsable->guardar($dni, $apellidos, $nombres, $password);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }

        public function actualizar(int $id, String $dni, String $apellidos, String $nombres, String $password){
            $responsable = new responsable();
            $resultado = $responsable->actualizar($id, $dni, $apellidos, $nombres, $password);
            if($resultado!=0){
                return true;
            }else{
                return false;
            }
        }
       
    }

?>