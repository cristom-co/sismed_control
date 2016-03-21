<?php

class CitasMedicas {

    private $idCitaMedica;
    private $fechaHoraRegistro;
    private $fechaCitaMedica;
    private $horaCitaMedica;
    private $duracionCitaMedica;
    private $comentariosCitaMedica;
    private $estadoCitaMedica;
    private $idBeneficarios;
    private $idConsultorio;
    private $idAgendaMedica;
    private $conexion;

    
    public function __construct() {
        $this->conexion = new Conexiones();
    }

    public function insertarCitaMedica() {
        $sql = "INSERT INTO citas_medicas("
                . "idCitaMedica,"
                . "fechaHoraRegistroCitaMedica,"
                . " fechaCitaMedica, "
                . "horaCitaMedica, "
                . "duracionCitaMedica, "
                . "comentariosCitaMedica, "
                . "estadoCitaMedica, "
                . "beneficiarios_idBeneficiario, "
                . "consultorios_idConsultorio, "
                . "agendas_medicas_idAgendasMedica) "
                . "VALUES ("
                . "null ,"
                . "'{$this->getFechaHoraRegistro()}' ,"
                . "'{$this->getFechaCitaMedica()}' ,"
                . "'{$this->getHoraCitaMedica()}' ,"
                . "'{$this->getDuracionCitaMedica()}' ,"
                . "'{$this->getComentariosCitaMedica()}' ,"
                . "'{$this->getEstadoCitaMedica()}' ,"
                . "'{$this->getIdBeneficarios()}' ,"
                . "'{$this->getIdConsultorio()}' ,"
                . "'{$this->getIdAgendaMedica()}' )";
        return $this->conexion->consultaSimple($sql);
    }
    
    public function listarIdCitaMedica(){
        $sql ="SELECT idCitaMedica, 
           fechaHoraRegistroCitaMedica, 
           am.fechaAgendaMedica, 
           hs.hora, 
           duracionCitaMedica,
           comentariosCitaMedica, 
           estadoCitaMedica, 
           numeroIdentificacionBeneficiario,
           nombresBeneficiario, 
           apellidosBeneficiario, 
           numeroConsultorio,
           ct.agendas_medicas_idAgendasMedica,
           nombresEmpleado, 
           apellidosEmpleado
        FROM citas_medicas ct
        INNER JOIN beneficiarios b ON b.idBeneficiario = ct.beneficiarios_idBeneficiario
        INNER JOIN consultorios c ON c.idConsultorio = ct.consultorios_idConsultorio
        INNER JOIN agendas_medicas am ON am.idAgendaMedica = ct.agendas_medicas_idAgendasMedica
        INNER JOIN empleados e ON e.idEmpleado = am.empleados_idEmpleado
        INNER JOIN hora_20 hs ON hs.idhora_20 = am.hora_20_idhora_20
        WHERE idCitaMedica = '{$this->getIdCitaMedica()}'";
        return $this->conexion->consulta($sql);
    }

    public function listarCitasMedicas() {
       $sql ="SELECT idCitaMedica, 
           fechaHoraRegistroCitaMedica, 
           am.fechaAgendaMedica, 
           hs.hora, 
           duracionCitaMedica,
           comentariosCitaMedica, 
           estadoCitaMedica, 
           b.idBeneficiario,
           numeroIdentificacionBeneficiario,
           nombresBeneficiario, 
           apellidosBeneficiario, 
           numeroConsultorio,
           ct.agendas_medicas_idAgendasMedica,
           nombresEmpleado, 
           apellidosEmpleado
        FROM citas_medicas ct
        INNER JOIN beneficiarios b ON b.idBeneficiario = ct.beneficiarios_idBeneficiario
        INNER JOIN consultorios c ON c.idConsultorio = ct.consultorios_idConsultorio
        INNER JOIN agendas_medicas am ON am.idAgendaMedica = ct.agendas_medicas_idAgendasMedica
        INNER JOIN empleados e ON e.idEmpleado = am.empleados_idEmpleado
        INNER JOIN hora_20 hs ON hs.idhora_20 = am.hora_20_idhora_20";
               
        return$this->conexion->consulta($sql);
    }

    public function editarCitaMedica() {
        $sql = "UPDATE citas_medicas SET "
                . "fechaCitaMedica=''{$this->getFechaCitaMedica()}',"
                . "horaCitaMedica='{$this->getHoraCitaMedica()}',"
                ."duracionCitaMedica = '{$this->getDuracionCitaMedica()}',"
                . "comentariosCitaMedica = '{$this->getComentariosCitaMedica()}'"
                . "consultorios_idConsultorio = '{$this->getIdConsultorio()}'"
                . "estadoCitaMedica='{$this->getEstadoCitaMedica()}',"
                . "agendas_medicas_idAgendasMedica='{$this->getIdAgendaMedica()}'"
                . " WHERE idCitaMedica = '{$this->getIdCitaMedica()}'";
        return $this->conexion->consultaSimple($sql);
    }

    public function eliminarCitaMedica() {
        $sql = "DELETE FROM citas_medicas WHERE idCitaMedica = '{$this->getIdCitaMedica()}'";

        return $this->conexion->consultaSimple($sql);
    }

    function getIdCitaMedica() {
        return $this->idCitaMedica;
    }

    function getFechaHoraRegistro() {
        return $this->fechaHoraRegistro;
    }

    function getFechaCitaMedica() {
        return $this->fechaCitaMedica;
    }

    function getHoraCitaMedica() {
        return $this->horaCitaMedica;
    }

    function getDuracionCitaMedica() {
        return $this->duracionCitaMedica;
    }

    function getComentariosCitaMedica() {
        return $this->comentariosCitaMedica;
    }

    function getEstadoCitaMedica() {
        return $this->estadoCitaMedica;
    }

    function getIdBeneficarios() {
        return $this->idBeneficarios;
    }

    function getIdConsultorio() {
        return $this->idConsultorio;
    }

    function getIdAgendaMedica() {
        return $this->idAgendaMedica;
    }

    function setIdCitaMedica($idCitaMedica) {
        $this->idCitaMedica = $idCitaMedica;
    }

    function setFechaHoraRegistro($fechaHoraRegistro) {
        $this->fechaHoraRegistro = $fechaHoraRegistro;
    }

    function setFechaCitaMedica($fechaCitaMedica) {
        $this->fechaCitaMedica = $fechaCitaMedica;
    }

    function setHoraCitaMedica($horaCitaMedica) {
        $this->horaCitaMedica = $horaCitaMedica;
    }

    function setDuracionCitaMedica($duracionCitaMedica) {
        $this->duracionCitaMedica = $duracionCitaMedica;
    }

    function setComentariosCitaMedica($comentariosCitaMedica) {
        $this->comentariosCitaMedica = $comentariosCitaMedica;
    }

    function setEstadoCitaMedica($estadoCitaMedica) {
        $this->estadoCitaMedica = $estadoCitaMedica;
    }

    function setIdBeneficarios($idBeneficarios) {
        $this->idBeneficarios = $idBeneficarios;
    }

    function setIdConsultorio($idConsultorio) {
        $this->idConsultorio = $idConsultorio;
    }

    function setIdAgendaMedica($idAgendaMedica) {
        $this->idAgendaMedica = $idAgendaMedica;
    }

}
