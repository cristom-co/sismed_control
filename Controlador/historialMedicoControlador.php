<?php

session_start();

class historialMedicoControlador {

    private $modelo;

    public function __construct() {
        if (!$_SESSION['valido']) {
            header('Location: ' . URL_BASE);
        }
        $this->modelo = Modelo::cargar('Consultas');
    }

    public function historial() {
        $datos['titulo'] = "Historial Medico";
        Vista::mostrar('historialMedico', $datos);
    }

    public function editarHistorialMedico (){
        $datos['titulo'] = "Historial Medico";
        $datos['idCitaMedica'] = $_POST['idCitaMedica'];
        $datos['idBeneficiario'] = $_POST['idBeneficiario'];

        $this->modelo->setIdCitaMedica($_POST['idCitaMedica']);
        if (!isset($_POST['btnGuardar'])) {
        
            $datos['Episodio'] = $this->modelo->listarEpisodio();
            
            //$this->modelo->setIdEpisodio(); //$datos['Episodio']['idEpisodio'] 
            $datos['Diagnostico'] = $this->modelo->listarDiagnostico();
            
            //$this->modelo->setIdDiagnostico();
            $datos['Ordenes'] = $this->modelo->listarOrdenes();
            
            //$this->modelo->setIdDiagnostico();
            $datos['FormulaMedica'] = $this->modelo->listarFormulaMedica();
            
            //$this->modelo->setIdFormulaMedica();
            $datos['Medicamentos'] = $this->modelo->listarMedicamentosFormula();
            
            Vista::mostrar('editarConsulta', $datos);
        
            
        } else {
            $this->modelo->setIdentificacionFuncionario($_POST['txfIdentificacionFuncionario']);

            $registro = $this->modelo->editar();
            if ($registro) {
                $datos['mensaje'] = "Funcionario Editado correctamente";
            } else {
                $datos['mensaje'] = "No se edito el funcionario";
            }
            $datos['titulo'] = "Funcionarios";
            Vista::mostrar('funcionarios', $datos);
        }
    }
}
