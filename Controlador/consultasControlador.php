<?php

session_start();

class consultasControlador {

    private $modelo;
    private $modeloCitas;
    private $modeloBenficiario; 
    private $modeloAgenda;

    public function __construct() {
        if (!$_SESSION['valido']) {
            header('Location: ' . URL_BASE);
        }
        $this->modelo = Modelo::cargar('Consultas');
        $this->modeloCitas = Modelo::cargar('CitasMedicas');
        $this->modeloBenficiario = Modelo::cargar('Beneficiarios');
        $this->modeloAgenda = Modelo::cargar('AgendasMedicas');
        
    }

    public function consulta() {
        if(!$_POST){
            $datos['titulo']="citas medicas";
            Vista::mostrar('citasMedicas', $datos);
        }
        else{
            $datos['titulo'] = "Consultas Medicas";
            $datos['idCitaMedica'] = $_POST['idCitaMedica'];
            $datos['idBeneficiario'] = $_POST['idBeneficiario'];
            Vista::mostrar('consultas', $datos);
        }
    }

    public function insertarConsulta() {
    if (!$_POST){
        header('location: consulta');
    }
    else {
        $datos['titulo'] = "Citas Medicas";
        //Episodio
        $this->modelo->setFechaHoraAtencion($_POST['txfFechaHora']);
        $this->modelo->setPesoEpisodio($_POST['txfPeso']);
        $this->modelo->setTemperaturaEpisodio($_POST['txfTemperatura']);
        $this->modelo->setPresionArterialEpisodio($_POST['txfPresion']);
        $this->modelo->setAnamnesisEpisodio($_POST['txfAnamnesis']);
        $this->modelo->setExploracionEpisodio($_POST['txfExploracion']);
        $this->modelo->setIdCitaMedica($_POST['idCitaMedica']);
        $this->modelo->setIdBeneficiario($_POST['idBeneficiario']);
        $idHistoriaClinica = $this->modelo->listarHistoriaClinica();
        $this->modelo->setIdHistoriaClinica($idHistoriaClinica[0]['idHistoriaClinica']);
        $registro = $this->modelo->insertarEpisodio();
        //Diagnostico
        $idEpisodio = $this->modelo->listarEpisodio();
        if (!empty($_POST['cmbEnfermedad']) || !empty($_POST['txfDescripcionDiagnostico'])) {
            $this->modelo->setDescripcionDiagnostico($_POST['txfDescripcionDiagnostico']);
            $this->modelo->setIdEnfermedad($_POST['cmbEnfermedad']);
            $this->modelo->setIdEpisodio($idEpisodio[0]['idEpisodio']);
            $registro = $this->modelo->insertarDiagnostico();
        }
        //Orden
        if (isset($_POST['fechaOrden']) || isset($_POST['cantOrden']) || isset($_POST['observacionOrden']) || isset($_POST['tipoOrden'])) {
            $fechaOrden = $_POST['fechaOrden'];
            $cantOrden = $_POST['cantOrden'];
            $observacionOrden = $_POST['observacionOrden'];
            $tipoOrden = $_POST['tipoOrden'];
            for ($i = 0; $i < count($fechaOrden); $i++) {
                $this->modelo->setFechaHoraOrden($fechaOrden[$i]);
                $this->modelo->setCantidadOrden($cantOrden[$i]);
                $this->modelo->setObservacionesOrden($observacionOrden[$i]);
                $this->modelo->setIdTipoOrden($tipoOrden[$i]);
                $registro = $this->modelo->insertarOrden();
            }
        }
        //Formula
        if (isset($_POST['idMedicamento']) || isset($_POST['cantMedicamento']) && !empty($_POST['txfObservacionesFormula'])) {
            $this->modelo->setObservacionesFormulaMedica($_POST['txfObservacionesFormula']);
            $this->modelo->insertarFormulaMedica();
            $idFormula = $this->modelo->listarFormulaMedica();
            $this->modelo->setIdFormulaMedica($idFormula[0]['idFormulaMedica']);
            $idMedicamento = $_POST['idMedicamento'];
            $cantMedicamento = $_POST['cantMedicamento'];
            $dosis = $_POST['dosis'];
            for ($f = 0; $f < count($idMedicamento); $f++) {
                $this->modelo->setIdMedicamentoFormula($idMedicamento[$f]);
                $this->modelo->setCantidadMedicamento($cantMedicamento[$f]);
                $this->modelo->setDosificacionMedicamento($dosis[$f]);
                $registro = $this->modelo->insertarMedicamentoFormula();
            }
        }
        $this->modelo->citaMedicaAtendida();
        if ($registro) {
            $datos['mensaje'] = "Se inserto el episodio correctamente";
            
        } else {
            $datos['mensaje'] = "No se inserto el episodio";
        }
        Vista::mostrar('citasMedicas', $datos);
    }

    }


    public function editarConsulta() {
        if(!$_POST){
            header('location: consulta');
        }else{
            if ($_POST['btnGrabarConsulta']){
               
               
               
               
                        
                if ($registro) {
                    $datos['mensaje'] = "Se edito la consulta correctamente";
                } else {
                    $datos['mensaje'] = "No se edito la consulta";
                }        
                Vista::mostrar('editarConsulta',$datos);
                
            }else{
                $this->modelo->setIdCitaMedica($_POST['idCitaMedica']);
                //consulta el episodio asociado al id cita medica
                $datos['episodio'] = $this->modelo->listarEpisodio();
                $this->modelo->setIdEpisodio($datos['episodio'][0]['idEpisodio']);
                ////consulta el diagnostico, las ordenes y formula medica asociada al episodio
                $datos['diagnostico'] = $this->modelo->listarDiagnostico();
                //$this->modelo->listarOrdenes();
                ////lista el id de la formula medica
                $datos['formula'] = $this->modelo->listarFormulaMedica();
                ////consulta los medicamentos asociados al id formula medica
                //$this->modelo->setIdFormulaMedica($idFormula[0]['idFormulaMedica']);
                //$this->modelo->listarMedicamentosFormula();
                
                $datos['titulo']= "Editar Consulta";
                Vista::mostrar('editarConsulta',$datos);
            }
        }
    }

    public function listarConsulta() {
        if ($_POST){
        $this->modelo->setIdCitaMedica($_POST['idCitaMedica']);
        $this->modeloCitas->setIdCitaMedica($_POST['idCitaMedica']);
        $datos['citaMedica']= $this->modeloCitas->listarIdCitaMedica();
        //consulta el episodio asociado al id cita medica
        
        $this->modeloBenficiario->setIdBeneficiario($_POST['idBeneficiario']);
        $datos['beneficiario']= $this->modeloBenficiario->listarIdBeneficiario();
        
        $this->modeloAgenda->setIdAgendaMedica($_POST['idAgendaMedica']);
        $datos['empleado'] = $this->modeloAgenda->listarAgendaDatosEmpleado();
        
        $datos['episodio'] = $this->modelo->listarEpisodio();
        $this->modelo->setIdEpisodio($datos['episodio'][0]['idEpisodio']);
        
        $datos['diagnostico'] = $this->modelo->listarDiagnostico();
        $datos['formula'] = $this->modelo->listarFormulaMedica();
        
        
        $datos['titulo']= "Consulta";
        Vista::mostrar('mostrarConsulta',$datos);
        }
        else{
            header('location: consulta');
        }
    }
    
    public function listarOrdenes (){
        $this->modelo->setIdEpisodio($_POST['idEpisodio']);
        echo json_encode($this->modelo->listarOrdenes());
    }
    
    public function listarMedicamentos (){
        $this->modelo->setIdFormulaMedica($_POST['idFormula']);
        echo json_encode($this->modelo->listarMedicamentosFormula());
    }

}
