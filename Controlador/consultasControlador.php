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
        Vista::mostrar('consultas', $datos);
    }
    
    public function insertarConsulta(){ //insertar todos los datos estaticos de la consulta
        //Capturar los datos para el episodio
        $this->modelo->setIdCitaMedica($_POST['idCitaMedica']);
        $this->modelo->set($_POST['']);
        //insertar el episodio      =   el episodio depende del id cita medica
        $this->modelo->insertarEpisodio();
        //Listar el id del episodio generado
        $idEpisodio = $this->modelo->listarEpisodio(); //where idCitaMedica = $_POST['idCitaMedica'] 
        
        //---------------------------------------------------------------------
        //Capturar los datos para el dignostico
        $this->modelo->setIdEpisodio($idEpisodio['idEpisodio']);
        $this->modelo->set($_POST['']);
        //insertar el diagnostico   =   el diagnostico depende del id episodio 
        $this->modelo->insertarDiagnostico();
        //Listar el id del diagnostico generado
        $idDiagnostico = $this->modelo->listarDiagnostico();
        
        //---------------------------------------------------------------------
        //Capturar los datos para la formula medica
        $this->modelo->setIdDiagnostico($idDiagnostico['idDiagnostico']);
        $this->modelo->set($_POST['']);
        //insertar la formula medica=   la formula depende del id del diagnostico
        $this->modelo->insertarFormulaMedica();
        //Listar el id de la formula medica generada
        $idDiagnostico = $this->modelo->listarFormulaMedica();
    }

    public function insertarOrden (){
        //Capturar los datos para las ordenes
        $this->modelo->setIdDiagnostico();
        $this->modelo->set($_POST['']);
        //insertar las ordenes      =   las ordenes dependen del id diagnostico
        
    }
    
    public function insertarMedicamento (){
        //Capturar los datos para los medicamentos
        $this->modelo->setIdFormulaMedica();
        $this->modelo->set($_POST['']);
        //insertar los medicamentos =   los medicamentos dependen del id formula
    }

    public function editarConsulta (){
        //select episodio where idCitaMedica = value
        //select diagnostico where idEpisodio = value
        //select ordenes where idDiagnostico = value
        //select formulas_medicas where idDiagnostico = value
        //select medicamentos_formulas where idFormula = value
    }
    
    public function editarOrden (){
        //editar orden donde idOrden = value
        $this->modelo->setIdOrden();
        $this->modelo->editarOrden();
    }
    
    public function editarMedicamento (){
        //editar medicamento donde idMedicamentoFormula = value
        $this->modelo->setIdMedicamentoFormula();
        $this->modelo->editarMedicamentoFormula();
    }
    
    
    public function listarOrdenes (){
        //Listar las ordenes donde diagnosticos_idDiagnostico = value
        $this->modelo->setIdDiagnostico();
        $this->modelo->listarOrdenes();
    }
    
    public function listarMedicamento (){
        //Listar los medicamentos donde formulas_idFormula = value
        $this->setIdFormulaMedica();
        $this->modelo->listarMedicamentosFormula();
    }
    
    
    public function eliminarConsulta (){
        
    }

}
