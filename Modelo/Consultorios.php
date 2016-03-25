<?php

class Consultorios {

    private $idConsultorio;
    private $numeroConsultorio;
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexiones();
    }

    public function insertarConsultorio() {
        $sql = "INSERT INTO consultorios(idConsultorio, numeroConsultorio) "
                . "VALUES (null, '{$this->getNumeroConsultorio()}');";

        return $this->conexion->consultaSimple($sql);
    }

    public function listarConsultorios() {
        $sql = "SELECT idConsultorio, numeroConsultorio, 
            centros_medicos_idCentroMedico, cm.nombreCentroMedico 
            FROM consultorios c 
            INNER JOIN centros_medicos cm ON cm.idCentroMedico = c.centros_medicos_idCentroMedico";
        return $this->conexion->consulta($sql);
    }

    public function listarIdConsultorio() {
        $sql = "SELECT idConsultorio, numeroConsultorio, nombreCentroMedico FROM consultorios c "
                ."INNER JOIN centros_medicos cm ON cm.idCentroMedico = c.centros_medicos_idCentroMedico
                WHERE idConsultorio={$this->getIdConsultorio()};";

        return $this->conexion->consulta($sql);
    }

    public function editarConsultorio() {
        $sql = "UPDATE consultorios SET numeroConsultorio='{$this->getNumeroConsultorio()}' "
                . "WHERE idConsultorio={$this->getIdConsultorio()};";

        return $this->conexion->consultaSimple($sql);
    }

    public function eliminarConsultorio() {
        $sql = "DELETE FROM consultorios WHERE idConsultorio={$this->getIdConsultorio()};";

        return $this->conexion->consultaSimple($sql);
    }

    public function getIdConsultorio() {
        return $this->idConsultorio;
    }

    public function getNumeroConsultorio() {
        return $this->numeroConsultorio;
    }

    public function setIdConsultorio($idConsultorio) {
        $this->idConsultorio = $idConsultorio;
    }

    public function setNumeroConsultorio($numeroConsultorio) {
        $this->numeroConsultorio = $numeroConsultorio;
    }

}
