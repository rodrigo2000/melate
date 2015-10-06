<?php
date_default_timezone_set("America/Merida");
function CI() {
    $CI = & get_instance();
    return $CI;
}

function ahora(){
    return date("Y-m-d H:i:s");
}

function Meses($m) {
    $m = intval($m);
    if ($m > 12) {
        return "";
    }
    $meses = array("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    return $meses[$m];
}

function p($string) {
    return htmlentities($string, ENT_NOQUOTES, "UTF-8");
}

function mysqlDate2Date($f) {  // yyyy-mm-dd H:m:ss    ==>     13 de Febrero de 2015 <br> 00:00pm
    if (trim($f) == "")
        return "";
    $pos = strpos($f, " ");
    $hora = $fecha = "";
    if ($pos !== false) {
        list($fecha, $hora) = explode(" ", $f);
    } else {
        $fecha = $f;
        $hora = "";
    }
    list($a, $m, $d) = preg_split("/[\/|-]/", $fecha);
    if ($hora != "") {
        list($hh, $mm, $ss) = explode(":", $hora);
    }
    $ampm = "am";
    if (isset($hh) && intval($hh) > 12) {
        $ampm = "pm";
        $hh-=12;
    }
    $cadena = $d . ' de ' . Meses($m) . ' de ' . $a . ($hora != "" ? "<br>" . substr("0" . $hh, -2) . ":" . $mm . $ampm : '');
    return $cadena;
}

function mysqlDate2OnlyDate($f) { // yyyy-mm-dd H:m:ss    ==>     13 de Febrero de 2015
    $cadena = "";
    if ($f !== "") {
        $pos = strpos($f, " ");
        $fecha = "";
        if ($pos !== false) {
            list($fecha, $hora) = explode(" ", $f);
        } else {
            $fecha = $f;
        }

        if ($fecha !== "") {
            list($a, $m, $d) = preg_split("/[\/|-]/", $fecha);
            $cadena = $d . ' de ' . Meses($m) . ' de ' . $a;
        }
    }
    return $cadena;
}

if ( !function_exists( 'hex2bin' ) ) {
    function hex2bin( $str ) {
        $sbin = "";
        $len = strlen( $str );
        for ( $i = 0; $i < $len; $i += 2 ) {
            $sbin .= pack( "H*", substr( $str, $i, 2 ) );
        }

        return $sbin;
    }
}