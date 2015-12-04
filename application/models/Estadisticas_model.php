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
        $this->group_by("YEAR(fecha)")->select("YEAR(fecha) ano");
        $t = $this->db->get("melate")->row()->total;
        //echo $this->db->last_query() . "<br><br>";
        return $t;
    }

    function getCensoPorAnio1($numero, $fechaInicio = NULL, $fechaFin = NULL) {
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
        $this->db->group_by("anio")->select("YEAR(fecha) anio");
        $t = $this->db->get("melate");
        //echo $this->db->last_query() . "<br><br>";
        if ($t->num_rows() > 0) {
            return $t->result_array();
        } else {
            return array();
        }
    }

    function getNumero($numero, $anios) {
        $res = $this->db
                ->select("COUNT(id_resultado) total")
                ->like("CONCAT('-',r1,'-',r2,'-',r3,'-',r4,'-',r5,'-',r6,'-')", '-' . $numero . '-')
                ->where_in("YEAR(fecha)", $anios)
                ->group_by("anio")->select("YEAR(fecha) anio")
                ->get("melate");
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return array();
        }
    }

    function getAnio($numeros, $anio) {
        $return = array();
        foreach ($numeros as $n) {
            $res = $this->db
                    ->select("COUNT(id_resultado) total")
                    ->where("YEAR(fecha)", $anio)
                    ->where_in($n, array("r1", "r2", "r3", "r4", "r5", "r6", "r7"), FALSE)
                    ->get("melate");
            if ($res->num_rows() == 1) {
                $return[$n] = intval($res->row()->total);
            } else {
                $return[$n] = 0;
            }
        }
        return $return;
    }

}
