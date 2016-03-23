<?php

session_start();

class consultasControlador {

    private $modelo;

    public function __construct() {
        if (!$_SESSION['valido']) {
            header('Location: ' . URL_BASE);
        }
        $this->modelo = Modelo::cargar('Consultas');
    }

    public function consulta() { 
        $datos['titulo'] = "Consultas Medicas";
        $datos['idCitaMedica'] = $_POST['idCitaMedica'];
        $datos['idBeneficiario'] = $_POST['idBeneficiario'];
        Vista::mostrar('consultas', $datos);
    }
    
    //-------------------------------------------------------------------------
    //EPISODIOS
    //-------------------------------------------------------------------------
 
    public function insertarEpisodio (){
        
        if (isset($_POST['btnRegistrarEpisodio'])){
            $this->modelo->setIdBeneficiario($_POST['idBeneficiario']);
            $this->modelo->setIdCitaMedica($_POST['idCitaMedica']);
            $this->modelo->setFechaHoraAtencion($_POST['txfFechaHora']);
            $this->modelo->setPesoEpisodio($_POST['txfPeso']);
            $this->modelo->setTemperaturaEpisodio($_POST['txfTemperatura']);
            $this->modelo->setPresionArterialEpisodio($_POST['txfPresion']);
            $this->modelo->setAnamnesisEpisodio($_POST['txfAnmanesis']);
            $this->modelo->setExploracionEpisodio($_POST['txfExploracion']);
            $this->modelo->setIdHistoriaClinica();
            
            //insertar el episodio      =   el episodio depende del id cita medica
            $registro = $this->modelo->insertarEpisodio();
            $idConsulta = $this->modelo->consultarId();
            $registrarDiagnostico = $this->modelo->insertarDiagnostico($idConsulta);
            
            if ($registro) {
                $datos['mensaje'] = "Se inserto el episodio correctamente";
            } else {
                $datos['mensaje'] = "No se inserto el episodio";
            }
        }
    }
    
    public function editarEpisodio (){
        $datos['titulo'] = "Editar Episodio";
        $this->modelo->setIdCitaMedica($_POST['idCitaMedica']);
        
        if (!isset($_POST['btnGuardar'])) {
            $datos['episodio'] = $this->modelo->listarEpisodio();
            Vista::mostrar('editarFuncionario', $datos);
        } else {
            $this->modelo->setIdOrden();
            $this->modelo->editarOrden();
        }
    }
    public function listarEpisodio (){
        $this->modelo->setIdCitaMedica();
        echo json_encode($this->modelo->listarEpisodio(),TRUE);
    }
     public function eliminarEpisodio (){
      
    }
    
    //--------------------------------------------------------------------------
    //DIAGNOSTICOS
    //--------------------------------------------------------------------------
    
    
    public function insertarDiagnostico (){

        $this->modelo->setIdEpisodio($idEpisodio['idEpisodio']);
        $this->modelo->setDescripcionDiagnostico($_POST['txfDescripcionDiagnostico']);
        $this->modelo->setIdEnfermedad($_POST['cmbEnfermedad']);
        //insertar el diagnostico   =   el diagnostico depende del id episodio 
        $registro = $this->modelo->insertarDiagnostico();
        
        if ($registro) {
            $datos['mensaje'] = "Se inserto el diagnostico correctamente";
        } else {
            $datos['mensaje'] = "No se inserto el diagnostico";
        }
    }
     public function editarDiagnostico (){
        $this->modelo->setIdMedicamentoFormula();
        $this->modelo->editarMedicamentoFormula();
    }
    public function listarDiagnostico (){
         $this->modelo->setIdEpisodio();
        echo json_encode($this->modelo->listarOrdenes(),TRUE);
    }
    public function eliminarDiagnostico (){
        
    }
    //--------------------------------------------------------------------------
    //ORDENES
    //--------------------------------------------------------------------------
        

    public function insertarOrden (){

        $this->modelo->setIdDiagnostico();
        $this->modelo->set($_POST['txfFechaHoraOrden']);
        $this->modelo->set($_POST['txfCantidadOrden']);
        $this->modelo->set($_POST['txfObservacionesOrden']);
        $this->modelo->set($_POST['cmbIdTipoOrden']);
        $this->modelo->set($_POST['IdDiagnostico']);
        $this->modelo->set($_POST['cmbCup']);
        
        //insertar las ordenes      =   las ordenes dependen del id diagnostico
        $registro = $this->modelo->insertarOrden();
        if ($registro) {
            $datos['mensaje'] = "Se inserto la orden correctamente";
        } else {
            $datos['mensaje'] = "No se inserto la orden";
        }
    }
    
     public function editarOrden (){
        
        $this->modelo->setIdOrden();
        $this->modelo->editarOrden();
    }
    public function listarOrdenes (){
        $this->modelo->setIdDiagnostico();
        echo json_encode($this->modelo->listarOrdenes(),TRUE);
    }
    public function eliminarOrdene (){
     
    }
    //--------------------------------------------------------------------------
    //FORMULAS MEDICAS
    //--------------------------------------------------------------------------
    
    
    public function insertarFormulaMedica (){

        $this->modelo->setIdDiagnostico();
        $this->modelo->set($_POST['txfObservacionesFormula']);
        $this->modelo->set($_POST['txfPosologia']);
        //insertar la formula medica=   la formula depende del id del diagnostico
        $registro = $this->modelo->insertarFormulaMedica();
        if ($registro) {
            $datos['mensaje'] = "Se inserto la formula medica correctamente";
        } else {
            $datos['mensaje'] = "No se inserto la formula medica";
        }
    }
    
    public function editarFormulaMedica (){
        
        $this->modelo->setIdMedicamentoFormula();
        $this->modelo->editarMedicamentoFormula();
    }
    public function listarFormulaMedica (){
        $this->modelo->setIdDiagnostico();
        echo json_encode($this->modelo->listarFormulaMedica(),TRUE);
    }
    public function eliminarFormulaMedica (){
       
    }
    
    //--------------------------------------------------------------------------
    //MEDICAMENTOS FORMULAS
    //--------------------------------------------------------------------------
    
    
    public function insertarMedicamento (){

        $this->modelo->setIdFormulaMedica();
        $this->modelo->setIdMedicamentoFormula($_POST['Medicamento']);
        $this->modelo->setCantidadMedicamento($_POST['cantidadMedicamento']);
        $this->modelo->setDosificacionMedicamento($_POST['dosificacion']);
        
        //insertar los medicamentos =   los medicamentos dependen del id formula
        $registro = $this->modelo->insertarMedicamentoFormula();
        if ($registro) {
            $datos['mensaje'] = "Se inserto el medicamento correctamente";
        } else {
            $datos['mensaje'] = "No se inserto el medicamento";
        }
    }
     public function editarMedicamento (){
        $this->modelo->setIdMedicamentoFormula();
        $this->modelo->editarMedicamentoFormula();
    }
    public function listarMedicamentos (){
        $this->modelo->setIdFormulaMedica();
        echo json_encode($this->modelo->listarMedicamentosFormula(),TRUE);
    }
    public function eliminarMedicamento (){
        
    }

    //--------------------------------------------------------------------------
    //HISTORIAS CLINICAS
    //--------------------------------------------------------------------------
   
    public function listarHistoriaClinica (){
        $this->modelo->setIdBeneficiario();
        echo json_encode($this->modelo->listarHistoriaClinica(), TRUE);
    }
}
