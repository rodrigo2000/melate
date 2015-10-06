<?php

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->template = "";
        $this->module['name'] = '';
        $this->module['folder'] = '';
        $this->module['controller'] = '';
        $this->module['title'] = '';
        $this->module['title_list'] = "";
        $this->module['title_new'] = "";
        $this->module['title_edit'] = "";
        $this->module['title_delete'] = "";
        $this->module['id_field'] = "";
        $this->module['tabla'] = "";
        $this->configForm = array();
    }

    protected function _user_is_logged_in() {
        if (!$this->session->userdata("logueado")) {
            redirect(base_url() . "login/");
        }
    }

    function _initialize() {
        $this->_user_is_logged_in();
        $this->module['url'] = base_url() . $this->module['controller'];
        $this->module['listado_url'] = $this->module['url'] . '/listado';
        $this->module['edit_url'] = $this->module['url'] . '/modificar';
        $this->module['delete_url'] = $this->module['url'] . '/eliminar';
        $this->module['new_url'] = $this->module['url'] . '/nuevo';
        $this->module['read_url'] = $this->module['url'] . '/leer';
    }

    function index() {
        $this->listado();
    }

    function listado() {
        $this->template = $this->parser->parse($this->module['name'] . "_view", array(), TRUE);
        $this->load->view("panelcontrol_view");
    }

    function nuevo($data = array()) {
        $data['id'] = 0;
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->form_validation->set_rules($this->rulesForm);
            foreach ($this->rulesForm as $rule) {
                $r[$rule['field']] = $this->input->post($rule['field']);
            }
            if ($this->form_validation->run() == FALSE) {
                $data['r'] = $r;
            } else {
                $s = $this->_insert($r);
                if ($s['state'] == 'success') {
                    $this->session->set_flashdata("informacion", $s);
                    redirect(base_url() . $this->module['name'] . "/");
                }
            }
        }
        $data['accion'] = "nuevo";
        $this->template = $this->parser->parse($this->module['name'] . "_nuevo_view", $data, TRUE);
        $this->load->view("panelcontrol_view");
    }

    function _insert($data) {
        return $this->{$this->module['controller'] . '_model'}->insert($data);
    }

    function modificar($id = null, $data = array()) {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->form_validation->set_rules($this->rulesForm);
            $id = $this->input->post($this->module['id_field']);
            foreach ($this->rulesForm as $rule) {
                $r[$rule['field']] = $this->input->post($rule['field']);
            }
            if ($this->form_validation->run() == FALSE) {
                $data['r'] = $r;
            } else {
                $s = $this->_update($id, $r);
                if ($s['state'] == 'success') {
                    $this->session->set_flashdata("informacion", $s);
                    redirect(base_url() . $this->module['name'] . "/");
                }
            }
        } else {
            $this->db = $this->getConfigDelUsuario($this->session->userdata('username'), $this->session->userdata('contrasena'));
            $res = $this->db->where($this->module['id_field'], $id)->get($this->module['tabla']);
            if ($res->num_rows() == 1) {
                $data['r'] = $res->row_array();
            }
        }
        $data['accion'] = "modificar";
        $this->template = $this->parser->parse($this->module['name'] . "_nuevo_view", $data, TRUE);
        $this->load->view("panelcontrol_view");
    }

    function _update($id, $data) {
        return $this->{$this->module['controller'] . '_model'}->update($id, $data);
    }

    function eliminar($id, $data) {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = $this->input->post("id");
            $s = $this->_delete($id);
            $this->session->set_flashdata("informacion", $s);
            if ($s['state'] == 'success') {
                redirect(base_url() . "empresas/");
            }
        }

        $this->template = $this->parser->parse("eliminar_view", $data, TRUE);
        $this->load->view("panelcontrol_view");
    }

    function _delete($id) {
        return $this->{$this->module['controller'] . '_model'}->delete($id);
    }

}
