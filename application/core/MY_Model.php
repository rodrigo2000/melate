<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed.');

class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = "";
        $this->id_field = "";
    }

    function delete($id) {
        $this->db->where($this->id_field, $id);
        $this->db->delete($this->table_name);
        if ($this->db->affected_rows() > 0) {
            return array(
                'state' => 'success',
                'message' => 'Se ha eliminado el registro.'
            );
        } else {
            return array(
                'state' => 'error',
                'message' => 'No se pudo eliminar el registro.'
            );
        }
    }

    function update($id, $data) {
        if (count($data) > 0) {
            $this->db->where($this->id_field, $id);
            $result = $this->db->update($this->table_name, $data);
        } else {
            $result = true;
        }
        if ($result) {
            return array(
                'state' => 'success',
                'message' => 'Se ha editado el registro.',
                'data' => array(
                    'affected_rows' => $result === true ? 0 : $this->db->affected_rows(),
                    'query' => $result === true ? '' : $this->db->last_query()
                )
            );
        } else {
            return array(
                'state' => 'error',
                'message' => 'Ocurrió un error al editar el registro.',
            );
        }
    }

    function insert($data) {
        if ($this->db->insert($this->table_name, $data)) {
            return array(
                'state' => 'success',
                'message' => 'Se ha agregado el registro.',
                'data' => array(
                    'insert_id' => isset($data[$this->id_field]) ? $data[$this->id_field] : $this->db->insert_id()
                )
            );
        } else {
            $this->inserted_id = false;
            return array(
                'state' => 'warning',
                'message' => 'No fue posible agregar el registro. ' . $this->db->_error_message()
            );
        }
    }

}
