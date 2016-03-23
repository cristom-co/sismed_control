<?php

session_start();

class citasMedicasControlador {

    private $modelo;
    private $modeloAgenda;

    public function __construct() {
        if (!$_SESSION['valido']) {
            header('Location: ' . URL_BASE);
        }
        $this->modelo = Modelo::cargar('CitasMedicas');
        $this->modeloAgenda = Modelo::cargar('AgendasMedicas');
    }

    public function citas() {
        $datos['titulo'] = "Citas Medicas";
        Vista::mostrar('citasMedicas', $datos);
    }

    public function insertarCitaMedica() {
        $this->modelo->setComentariosCitaMedica($_POST['txfComentario']);
        $this->modelo->setIdBeneficarios($_POST['cmbBeneficiario']);
        $this->modelo->setIdConsultorio($_POST['cmbConsultorio']);
        $this->modelo->setIdAgendaMedica($_POST['cmbHoraCita']);
        $registro = $this->modelo->insertarCitaMedica();
        $this->modeloAgenda->setIdAgendaMedica($_POST['cmbHoraCita']);
        $this->modeloAgenda->setDiponibilidadAgendaMedica(0);
        $registroAgenda = $this->modeloAgenda->editarDisponibilidad();
        if ($registro && $registroAgenda) {
            $datos['mensaje'] = "Se inserto la Cita Medica correctamente";
        } else {
            $datos['mensaje'] = "No se inserto la Cita Medica";
        }
        $datos['titulo'] = "Citas Medicas";
        Vista::mostrar('citasMedicas', $datos);
    }

    public function listarCitasMedicas() {
        echo json_encode($this->modelo->listarCitasMedicas(), TRUE);
    }
    
    public function listarCitasMedicasAtentidas (){
        echo json_encode($this->modelo->listarCitasMedicasAtentidas(), TRUE);
    }

    public function editarcitaMedica() {
        $datos['titulo'] = "Editar Cita Medica";
        $this->modelo->setIdcitaMedica($_POST['idCitaMedica']);
        if (!isset($_POST['btnGuardar'])) {
            $datos['citaMedica'] = $this->modelo->listarIdCitaMedica(); 
            Vista::mostrar('editarCitaMedica', $datos);
        } else {
            $this->modelo->setIdCitaMedica($_POST['idCitaMedica']);
            $registro = $this->modelo->editarCitaMedica();
            if ($registro) {
                $datos['mensaje'] = "Cita Medica Editado correctamente";
            } else {
                $datos['mensaje'] = "No se edito el Cita Medica";
            }
            $datos['titulo'] = "Citas Medicas";
            Vista::mostrar('citasMedicas', $datos);
        }
    }
    
    public function eliminarcitaMedica() {
        $this->modelo->setIdCitaMedica($_POST['idCitaMedica']);
        $registro = $this->modelo->eliminarCitaMedica();
        if ($registro) {
            $datos['mensaje'] = "Registro eliminado correctamente";
        } else {
            $datos['mensaje'] = "Error al eliminar registro";
        }
        $datos['titulo'] = "Citas Medicas";
        Vista::mostrar('citasMedicas', $datos);
    }
}
