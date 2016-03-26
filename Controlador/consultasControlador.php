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

    public function insertarEpisodio() {

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

    public function editarEpisodio() {
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

    public function listarEpisodio() {
        $this->modelo->setIdCitaMedica();
        echo json_encode($this->modelo->listarEpisodio(), TRUE);
    }

}
