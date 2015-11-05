<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

class Estadisticas_model extends MY_Model {

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
    
    function censo($numero, $fechaInicio = NULL, $fechaFin = NULL) {
        $this->db
                ->select("COUNT(id_resultado) total")
                ->like("CONCAT('-',r1,'-',r2,'-',r3,'-',r4,'-',r5,'-',r6,'-')", '-' . $numero . '-');
        if ($fechaInicio != NULL && $fechaFin !== NULL) {
            $this->db->where("fecha BETWEEN '" . $fechaInicio . "' AND '" . $fechaFin . "'", NULL, FALSE);
        } else if ($fechaInicio !== NULL) {
            $this->db->where("fecha >= ", $fechaInicio);
        } else if ($fechaFin !== NULL) {
            $this->db->where("fecha <=", $fechaFin);
        }
        $t = $this->db->get("melate")->row()->total;
        //echo $this->db->last_query() . "<br><br>";
        return $t;
    }

}
