/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $("#getArchivoMelateFromURL").click(function () {
        getArchivoMelateFromURL();
    });
});

function getArchivoMelateFromURL() {
    url = 'http://www.pronosticos.gob.mx/Documentos/Historicos/Melate.csv';
    $("span#result", ".panel-body p").html('<img src="' + base_url + '/resources/imagenes/ajax-loader-cfdi.gif">');
    $.post(base_url + "Panel/getArchivoMelateFormURL", {url: url}, function (json) {
        if (json.success) {
            $.post(base_url + "Panel/csvFile2Database", {}, function (json2) {
                if (json2.success) {
                    $("span#result", ".panel-body p").html('<i class="glyphicon glyphicon-ok text-success"></i> Se ha actualizado la base de datos.');
                } else {
                    $("span#result", ".panel-body p").html('<i class="glyphicon glyphicon-remove text-danger"></i> Ocurriones algunos errores.');
                }
                setTimeout(function () {
                    $("span#result", ".panel-body p").html('');
                }, 3000);
            }, "json");
        } else {
            $("span#result", ".panel-body p").html(json.mensaje);
        }
    }, "json");
}