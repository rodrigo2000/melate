<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Estadisticas extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->table_name = "";
        $this->module['name'] = 'estadisticas';
        $this->module['folder'] = '';
        $this->module['controller'] = 'Estadisticas';
        $this->id_field = "";
    }
    
    function censo($numero){
        //$numero = $this->input->post("numero");
        echo $this->Estadisticas_model->censo($numero, '2014-01-01', '2015-01-01');
    }

}
