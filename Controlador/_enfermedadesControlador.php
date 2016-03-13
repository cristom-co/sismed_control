<?php

session_start();

class enfermedadesControlador {

    private $modelo;

    public function __construct() {
        if (!$_SESSION['valido']) {
            header('Location: ' . URL_BASE);
        }
        $this->modelo = Modelo::cargar('Enfermedades');
    }

    public function enfermedades() {
        $datos['titulo'] = "Enfermedades";
        Vista::mostrar('enfermedades', $datos);
    }

    public function insertarEnfermedad() {
        $this->modelo->setNombreEnfermedad($_POST['']);
        $this->modelo->setSimtomatologiaEnfermedad($_POST['']);
        $this->modelo->setTratamientoEnfermedad($_POST['']);
        
        $registro = $this->modelo->insertarEnfermedad();
        if ($registro) {
            $datos['mensaje'] = "Se inserto Enfermedad correctamente";
        } else {
            $datos['mensaje'] = "No se inserto Enfermedad";
        }
        $datos['titulo'] = "Enfermedades";
        Vista::mostrar('enfermedades', $datos);
    }

    public function listarEnfermedades() {
        echo json_encode($this->modelo->listarEnfermedades(), TRUE);
    }
    
 //Faltante -------------------------------------------------------------------
    public function editarEnfermedad() {
        $datos['titulo'] = "Editar enfermedad";
        $this->modelo->setIdEnfermedad($_POST['']);
        
        if (!isset($_POST['btnGuardar'])) {
            $datos['enfermedades'] = $this->modelo->listarIdFuncionario();
            Vista::mostrar('editarEnfermedad', $datos);
            
        } else {
            $this->modelo->setNombreEnfermedad($_POST['']);
            $this->modelo->setSimtomatologiaEnfermedad($_POST['']);
            $this->modelo->setTratamientoEnfermedad($_POST['']);
        /* ID Enfermedad ?*/
            $registro = $this->modelo->editarEnfermedad();
            if ($registro) {
                $datos['mensaje'] = "Enfermedad Editado correctamente";
            } else {
                $datos['mensaje'] = "No se edito el Enfermedad";
            }
            $datos['titulo'] = "Enfermedades";
            Vista::mostrar('enfermedades', $datos);
        }
    }
    
    public function eliminarEnfermedad() {
        $this->modelo->setIdEnfermedad($_POST['']);
        $registro = $this->modelo->eliminarEnfermedad();
        if ($registro) {
            $datos['mensaje'] = "Registro eliminado correctamente";
        } else {
            $datos['mensaje'] = "Error al eliminar registro";
        }
        $datos['titulo'] = "Enfermedades";
        Vista::mostrar('enfermedades', $datos);
    }

}
