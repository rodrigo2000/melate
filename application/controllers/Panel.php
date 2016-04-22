<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Panel extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->table_name = "";
        $this->module['name'] = 'panel';
        $this->module['folder'] = '';
        $this->module['controller'] = 'Panel';
        $this->id_field = "";
    }

    function getArchivoMelateFormURL() {
        $url = $this->input->post("url");
        //El nombre del archivo donde se almacenara los datos descargados.
        $path = realpath(".") . implode(DIRECTORY_SEPARATOR, array('', 'resources'));
        $filePath = implode(DIRECTORY_SEPARATOR, array($path, 'Melate.csv'));
        if (!is_writable($path)){
            chmod($path, 777); // chmod -R 755 /Applications/XAMPP/melate/
        }
        $file = fopen($filePath, "w+");
        $result = array(
            'success' => FALSE,
            'mensaje' => ''
        );
        // Crea un nuevo recurso cURL
        $ch = curl_init();

        // Establece la URL y otras opciones apropiadas
        curl_setopt($ch, CURLOPT_URL, $url);
        //Si necesitamos el header del archivo, en este caso no.
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        //Si necesitamos descargar el archivo.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //Lee el header y se mueve a la siguiente localización.
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        //Cantidad de segundo de limite para conectarse.
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        //Cantidad de segundos de limite para ejecutar curl. 0 significa indefinido.
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        //Donde almacenaremos el archivo.
        curl_setopt($ch, CURLOPT_FILE, $file);

        // Captura la URL y la envía al navegador
        $r = curl_exec($ch);

        // Cierrar el recurso cURLy libera recursos del sistema
        curl_close($ch);

        if ($r) {
            $result['mensaje'] = "Descarga exitosa";
            $this->csvFile2Database();
        } else {
            $result['mensaje'] = "CURL Error: #" . curl_errno($ch) . " " . curl_error($ch);
        }
        echo json_encode($result);
    }

    function csvFile2Database() {
        $filePath = implode(DIRECTORY_SEPARATOR, array(realpath("."), 'resources', 'Melate.csv'));
        $result = $this->Melate_model->csvFile2Array($filePath);
        $keys = array("nproducto", "concurso", "r1", "r2", "r3", "r4", "r5", "r6", "r7", "bolsa", "fecha");
        $this->db->truncate("melate");
        $errores = array('success' => TRUE, 'message' => array());
        foreach ($result as $r) {
            $c = array_combine($keys, $r);
            $primerElemento = array_shift($c);
            $c['bolsa'] = filter_var($c['bolsa'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            list($dia, $mes, $anio) = explode("/", $c['fecha']);
            $c['fecha'] = implode("-", array($anio, $mes, $dia));
            $s = $this->Melate_model->insert($c);
            if ($s != 'success') {
                $errores['success'] = FALSE;
                array_push($errores['message'], $s['message']);
            }
        }
        if ($s['state'] == "success") {
            $ss['success'] = TRUE;
            $ss['message'] = 'Se agregaron ' . $s['data']['insert_id'] . ' registros';
        } else {
            $ss['success'] = FALSE;
            $ss['message'] = $s['message'];
        }
        echo json_encode($ss);
    }

}
