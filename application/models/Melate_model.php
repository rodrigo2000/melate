<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

class Melate_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = "melate";
        $this->id_field = "id_resultado";
    }

    function insert($data) {
        return parent::insert($data);
    }

    function update($id, $data) {
        return parent::update($id, $data);
    }

    function csvFile2Array($archivoCSV, $tieneCabeceras = TRUE) {
        $array = array();
        if (file_exists($archivoCSV)) {
            $array = array_map('str_getcsv', file($archivoCSV));
        }
        if ($tieneCabeceras) {
            $cabeceras = array_shift($array);
        }
        return $array;
    }

}
