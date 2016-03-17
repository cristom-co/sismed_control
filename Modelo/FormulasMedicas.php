<?php

class FormulasMedicas {

    private $idFormulaMedica;
    private $observaciones;
    private $posologia;
 
    private $idMedicamentoFormula;
    private $cantidadMedicamento;
    private $dosficacionMedicamento;
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexiones();
    }

    public function insertarFormulaMedica() {
        $sql = "INSERT INTO formulas_medicas(idFormulaMedica, "
                . "observacionesFormulaMedica, "
                . "posologiaFormulaMedica)"
                . "VALUES (null, "
                . "'{$this->getObservaciones()}', "
                . "'{$this->getPosologia()}');";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function insertarMedicamento(){
        $sql ="INSERT INTO medicamentos_formulas (
            idMedicamentoFormula, formulas_medicas_idFormulaMedica,
            medicamentos_idMedicamento, cantidadMedicamento,dosificacionMedicamento)
            values (null,
            '{$this->getIdFormulaMedica()}',
            '{$this->getIdMedicamentoFormula()}',
            '{$this->getCantidadMedicamento()}',
            '{$this->getDosficacionMedicamento()}')";
        return $this->conexion->consultaSimple($sql);
    }

    public function listarFormulasMedicas() {
        $sql = "SELECT * FROM formulas_medicas";
        return $this->conexion->consulta($sql);
    }
    
    public function listarMedicamentosFormula(){
        $sql="SELECT * FROM medicamentos_formulas 
        WHERE formulas_medicas_idFormulaMedica = '{$this->getIdFormulaMedica()}'";
        return $this->conexion->consulta($sql);
    }

    public function editarFormulaMedica() {
        $sql = "UPDATE formulas_medicas SET 
                observacionesFormulaMedica = '{$this->getObservaciones()}',
                posologiaFormulaMedica = '{$this->getPosologia()}'
                WHERE idFormulaMedica = '{$this->getIdFormulaMedica()}'";
        return $this->conexion->consultaSimple($sql);
    }

    public function editarMedicamentoFormula(){
        $sql="UPDATE medicamentos_formulas SET 
            formulas_medicas_idFormulaMedica = '{$this->getIdFormulaMedica()}',
            medicamentos_idMedicamento = '{$this->getIdMedicamentoFormula}'";
        return  $this->conexion->consultaSimple($sql);
    }
    
    public function eliminarFormulaMedica() {
        $sql = "DELETE FROM formulas_medicas WHERE idFormulaMedica={$this->getIdFormulaMedica()}";

        return $this->conexion->consultaSimple($sql);
    }
    function getIdFormulaMedica() {
        return $this->idFormulaMedica;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getPosologia() {
        return $this->posologia;
    }

    function setIdFormulaMedica($idFormulaMedica) {
        $this->idFormulaMedica = $idFormulaMedica;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setPosologia($posologia) {
        $this->posologia = $posologia;
    }

    function getIdMedicamentoFormula() {
        return $this->idMedicamentoFormula;
    }

    function getCantidadMedicamento() {
        return $this->cantidadMedicamento;
    }

    function getDosficacionMedicamento() {
        return $this->dosficacionMedicamento;
    }

    function setIdMedicamentoFormula($idMedicamentoFormula) {
        $this->idMedicamentoFormula = $idMedicamentoFormula;
    }

    function setCantidadMedicamento($cantidadMedicamento) {
        $this->cantidadMedicamento = $cantidadMedicamento;
    }

    function setDosficacionMedicamento($dosficacionMedicamento) {
        $this->dosficacionMedicamento = $dosficacionMedicamento;
    }
}
