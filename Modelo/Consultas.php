<?php

class Consultas{
    
    private $conexion;
    private $idCitaMedica;
    
    //Tabla episodios
    private $idEpisodio; 
    private $fechaHoraAtencion; 
    private $pesoEpisodio; 
    private $temperaturaEpisodio; 
    private $anamnesisEpisodio;
    private $exploracionEpisodio;
    #--idCitaMedica
    private $idHistoriaClinica;
    
    //Tabla diagnosticos
    private $idDiagnostico;
    private $descripcionDiagnostico;
    private $idEnfermedad;
    #--idFormulaMedica
    #--idEpisodio

    //Tabla ordenes
    private $idOrden;
    private $fechaHoraOrden;
    private $cantidadOrden;
    private $observacionesOrden;
    private $idTipoOrden;
    #--idEpisodio
    #--idDiagnostico
    private $idCup;

    //Tabla formulas_medicas
    private $idFormulaMedica;
    private $observacionesFormulaMedica;
    private $posologiaFormulaMedica;
    
    //Tabla medicamentos_formulas
    private $idMedicamentoFormula;
    #--idFormulaMedica
    #--idMedicamento
    private $cantidadMedicamento;
    private $dosificacionMedicamento;
    
    public function __construct() {
        $this->conexion = new Conexiones();
    }
    
    //--------------------------------------------------------------------------
    //EPISODIOS
    //--------------------------------------------------------------------------
   
    public function insertarEpisodio (){
        $sql="";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function listarEpisodio (){
        $sql="";
        return $this->conexion->consulta($sql);
    }
    
    public function editarEpisodio (){
        $sql="";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function eliminarEpisodio (){
        $sql="";
        return $this->conexion->consultaSimple($sql);
    }
    
    //--------------------------------------------------------------------------
    //DIAGNOSTICOS
    //--------------------------------------------------------------------------
    
    public function insertarDiagnostico (){
        $sql="";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function listarDiagnostico (){
        $sql="";
        return $this->conexion->consulta($sql);
    }
    
    public function editarDiagnostico (){
        $sql="";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function eliminarDiagnostico (){
        $sql="";
        return $this->conexion->consultaSimple($sql);
    }

    //--------------------------------------------------------------------------
    //ORDENES
    //--------------------------------------------------------------------------
    
    public function insertarOrden (){
        $sql="";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function listarOrden (){
        $sql="";
        return $this->conexion->consulta($sql);
    }
    
    public function editarOrden (){
        $sql="";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function eliminarOrden (){
        $sql="";
        return $this->conexion->consultaSimple($sql);
    }
    
    //--------------------------------------------------------------------------
    //FORMULAS MEDICAS
    //--------------------------------------------------------------------------
    
     public function insertarFormulaMedica (){
        $sql="INSERT INTO formulas_medicas(idFormulaMedica, "
                . "observacionesFormulaMedica, "
                . "posologiaFormulaMedica)"
                . "VALUES (null, "
                . "'{$this->getObservaciones()}', "
                . "'{$this->getPosologia()}');";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function listarFormulaMedica(){
        $sql="";
        return $this->conexion->consulta($sql);
    }
    
    public function editarFormulaMedica (){
        $sql="UPDATE formulas_medicas SET 
                observacionesFormulaMedica = '{$this->getObservaciones()}',
                posologiaFormulaMedica = '{$this->getPosologia()}'
                WHERE idFormulaMedica = '{$this->getIdFormulaMedica()}'";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function eliminarFormulaMedica (){
        $sql="DELETE FROM formulas_medicas 
        WHERE idFormulaMedica={$this->getIdFormulaMedica()}";
        return $this->conexion->consultaSimple($sql);
    }
    
    //--------------------------------------------------------------------------
    //MEDICAMENTOS FORMULAS
    //--------------------------------------------------------------------------
    
    public function insertarMedicamentoFormula (){
        $sql="INSERT INTO medicamentos_formulas (
            idMedicamentoFormula, formulas_medicas_idFormulaMedica,
            medicamentos_idMedicamento, cantidadMedicamento,dosificacionMedicamento)
            values (null,
            '{$this->getIdFormulaMedica()}',
            '{$this->getIdMedicamentoFormula()}',
            '{$this->getCantidadMedicamento()}',
            '{$this->getDosficacionMedicamento()}')";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function listarMedicamentosFormula(){
        $sql="SELECT * FROM medicamentos_formulas 
        WHERE formulas_medicas_idFormulaMedica = '{$this->getIdFormulaMedica()}'";
        return $this->conexion->consulta($sql);
    }
    
    public function editarMedicamentoFormula(){
        $sql="UPDATE medicamentos_formulas SET 
            formulas_medicas_idFormulaMedica = '{$this->getIdFormulaMedica()}',
            medicamentos_idMedicamento = '{$this->getIdMedicamentoFormula()}',
            cantidadMedicamento = '{$this->getCantidadMedicamento()}',
            dosficacionMedicamento = '{$this->getDosficacionMedicamento()}'
            WHERE  idMedicamentoFormula = '{$this->getIdMedicamentoFormula()}'";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function eliminarMedicamentoFormula (){
        $sql="DELETE FROM medicamentos_formulas 
        WHERE idMedicamentoFormula = '{$this->getIdMedicamentoFormula()}'";
        return $this->conexion->consultaSimple($sql);
    }
    
    //--------------------------------------------------------------------------
    //GETTERS AND SETTERS
    //--------------------------------------------------------------------------
    function getIdCitaMedica() {
        return $this->idCitaMedica;
    }
    function getIdEpisodio() {
        return $this->idEpisodio;
    }
    function getFechaHoraAtencion() {
        return $this->fechaHoraAtencion;
    }
    function getPesoEpisodio() {
        return $this->pesoEpisodio;
    }
    function getTemperaturaEpisodio() {
        return $this->temperaturaEpisodio;
    }
    function getAnamnesisEpisodio() {
        return $this->anamnesisEpisodio;
    }
    function getExploracionEpisodio() {
        return $this->exploracionEpisodio;
    }
    function getIdHistoriaClinica() {
        return $this->idHistoriaClinica;
    }
    function getIdDiagnostico() {
        return $this->idDiagnostico;
    }
    function getDescripcionDiagnostico() {
        return $this->descripcionDiagnostico;
    }
    function getIdEnfermedad() {
        return $this->idEnfermedad;
    }
    function getIdOrden() {
        return $this->idOrden;
    }
    function getFechaHoraOrden() {
        return $this->fechaHoraOrden;
    }
    function getCantidadOrden() {
        return $this->cantidadOrden;
    }
    function getObservacionesOrden() {
        return $this->observacionesOrden;
    }
    function getIdTipoOrden() {
        return $this->idTipoOrden;
    }
    function getIdCup() {
        return $this->idCup;
    }
    function getIdFormulaMedica() {
        return $this->idFormulaMedica;
    }
    function getObservacionesFormulaMedica() {
        return $this->observacionesFormulaMedica;
    }
    function getPosologiaFormulaMedica() {
        return $this->posologiaFormulaMedica;
    }
    function getIdMedicamentoFormula() {
        return $this->idMedicamentoFormula;
    }
    function getCantidadMedicamento() {
        return $this->cantidadMedicamento;
    }
    function getDosificacionMedicamento() {
        return $this->dosificacionMedicamento;
    }
    function setIdCitaMedica($idCitaMedica) {
        $this->idCitaMedica = $idCitaMedica;
    }
    function setIdEpisodio($idEpisodio) {
        $this->idEpisodio = $idEpisodio;
    }
    function setFechaHoraAtencion($fechaHoraAtencion) {
        $this->fechaHoraAtencion = $fechaHoraAtencion;
    }
    function setPesoEpisodio($pesoEpisodio) {
        $this->pesoEpisodio = $pesoEpisodio;
    }
    function setTemperaturaEpisodio($temperaturaEpisodio) {
        $this->temperaturaEpisodio = $temperaturaEpisodio;
    }
    function setAnamnesisEpisodio($anamnesisEpisodio) {
        $this->anamnesisEpisodio = $anamnesisEpisodio;
    }
    function setExploracionEpisodio($exploracionEpisodio) {
        $this->exploracionEpisodio = $exploracionEpisodio;
    }
    function setIdHistoriaClinica($idHistoriaClinica) {
        $this->idHistoriaClinica = $idHistoriaClinica;
    }
    function setIdDiagnostico($idDiagnostico) {
        $this->idDiagnostico = $idDiagnostico;
    }
    function setDescripcionDiagnostico($descripcionDiagnostico) {
        $this->descripcionDiagnostico = $descripcionDiagnostico;
    }
    function setIdEnfermedad($idEnfermedad) {
        $this->idEnfermedad = $idEnfermedad;
    }
    function setIdOrden($idOrden) {
        $this->idOrden = $idOrden;
    }
    function setFechaHoraOrden($fechaHoraOrden) {
        $this->fechaHoraOrden = $fechaHoraOrden;
    }
    function setCantidadOrden($cantidadOrden) {
        $this->cantidadOrden = $cantidadOrden;
    }
    function setObservacionesOrden($observacionesOrden) {
        $this->observacionesOrden = $observacionesOrden;
    }
    function setIdTipoOrden($idTipoOrden) {
        $this->idTipoOrden = $idTipoOrden;
    }
    function setIdCup($idCup) {
        $this->idCup = $idCup;
    }
    function setIdFormulaMedica($idFormulaMedica) {
        $this->idFormulaMedica = $idFormulaMedica;
    }
    function setObservacionesFormulaMedica($observacionesFormulaMedica) {
        $this->observacionesFormulaMedica = $observacionesFormulaMedica;
    }
    function setPosologiaFormulaMedica($posologiaFormulaMedica) {
        $this->posologiaFormulaMedica = $posologiaFormulaMedica;
    }
    function setIdMedicamentoFormula($idMedicamentoFormula) {
        $this->idMedicamentoFormula = $idMedicamentoFormula;
    }
    function setCantidadMedicamento($cantidadMedicamento) {
        $this->cantidadMedicamento = $cantidadMedicamento;
    }
    function setDosificacionMedicamento($dosificacionMedicamento) {
        $this->dosificacionMedicamento = $dosificacionMedicamento;
    }
}
