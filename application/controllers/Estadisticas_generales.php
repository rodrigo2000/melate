<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Estadisticas_generales extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->table_name = "";
        $this->module['name'] = 'estadisticas_generales';
        $this->module['folder'] = '';
        $this->module['controller'] = 'Estadisticas_generales';
        $this->id_field = "";
    }

    function censo($numero = NULL) {
        if ($numero == NULL)
            $numero = $this->input->post("numero");
        echo $this->Estadisticas_model->censo($numero, '2014-01-01', '2015-01-01');
    }

    function getNumero() {
        $numero = $this->input->post("numero");
        $anios = explode(",", $this->input->post("anios"));
        $json = $this->Estadisticas_model->getNumero($numero, $anios);
        $temp = array();
        foreach ($json as $j) {
            $temp[$j['anio']] = $j['total'];
        }
        //print_r($temp);
        echo json_encode($temp);
    }

    function getAnio() {
        $numeros = explode(",", $this->input->post("numeros"));
        $anios = $this->input->post("anios");
        $json = $this->Estadisticas_model->getAnio($numeros, $anios);
        echo json_encode($json);
    }

}
