<?php
    require_once 'conexiones.php';
        
    class enfermedades{
        
      private  $idEnfermedad;
      private  $nombreEnfermedad;
      private  $sintomatologiaEnfermedad;
      private  $tratamientoEnfermedad;
      
      function __construct() {
        $this->conexion = new Conexiones();
        }
    
    public function listarEnfermedades() {
        $sql = "SELECT idEnfermedad,"
            ."nombreEnfermedad,"
            ."sintomatologiaEnfermedad,"
            ."tratamientoEnfermedad"
            ." FROM enfermedades;";
            return $this->conexion->consulta($sql); 
    }
    
    public function  insertarEnfermedad(){
           $sql = "INSERT INTO enfermedades ("
           ."idEnfermedad," 
           ."nombreEnfermedad,"
           ."sintomatologiaEnfermedad,"
           ."tratamientoEnfermedad)"
           ." VALUES (null,"
           ."'{$this->getNombreEnfermedad()}',"
           ."'{$this->getSintomatologiaEnfermedad()}',"
           ."'{$this->getTratamientoEnfermedad()}')";
           return $this->conexion->consultaSimple($sql);  
    }
      
    public function editarEnfermedad(){
            $sql = "UPDATE `enfermedades` SET "
            ."`nombreEnfermedad`='{$this->getNombreEnfermedad}',"
            ."`sintomatologiaEnfermedad`='{$this->getSintomatologiaEnfermedad}',"
            ."`tratamientoEnfermedad`= '{$this->getTratamientoEnfermedad}'"
            ."WHERE idEnfermedad = '{$this->getIdEnfermedad}'";
            
           return $this->conexion->consultaSimple($sql);
    }
    
    public function eliminarEnfermedad(){
           $sql = "DELETE FROM `enfermedades` WHERE '{$this->getIdEnfermedad()}'";
           return $this->conexion->consultaSimple($sql);
    }
        
    public function setIdEnfermedad($idEnfermedad) {
         $this->idEnfermedad = $idEnfermedad;
    }

    public function setNombreEnfermedad($nombreEnfermedad) {
        $this->nombreEnfermedad = $nombreEnfermedad;
    }

    public function setSintomatologiaEnfermedad($sintomatologiaEnfermedad) {
        $this->sintomatologiaEnfermedad = $sintomatologiaEnfermedad;
    }

    public function setTratamientoEnfermedad($tratamientoEnfermedad) {
        $this->tratamientoEnfermedad = $tratamientoEnfermedad;
    }
      
    public function getIdEnfermedad() {
           return $this->idEnfermedad;
       }

    public function getNombreEnfermedad() {
           return $this->nombreEnfermedad;
       }

    public function getSintomatologiaEnfermedad() {
           return $this->sintomatologiaEnfermedad;
       }

    public function getTratamientoEnfermedad() {
           return $this->tratamientoEnfermedad;
       }
       
}  
