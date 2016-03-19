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


}
