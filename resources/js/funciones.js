/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $("#getArchivoMelateFormURL").click(function () {
        getArchivoMelateFormURL();
    });
});

function getArchivoMelateFormURL() {
    url = 'http://www.pronosticos.gob.mx/Historicos/Melate.csv';
    $.post(base_url + "Panel/getArchivoMelateFormURL", {url: url}, function (json) {
        alert(json.mensaje);
    }, "json");
}