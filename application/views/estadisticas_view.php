<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Estadísticas</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" onsubmit="return false;">
            <div class="form-group">
                <label for="numero" class="control-label col-sm-2">Números</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="numero" value="1" autocomplete="off">
                    <p class="help-block pull-left">Escriba un número entre el 1 y el 56</p>
                </div>
            </div>
            <div class="form-group">
                <label for="anio" class="control-label col-sm-2">Años</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="anio" value="2015" autocomplete="off">
                    <p class="text-left help-block">Escriba un año entre 1984 y 2015</p>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="graficaCenso"></div>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script src="<?= base_url(); ?>resources/bootstrap/selectize.js-master/dist/js/standalone/selectize.min.js" type="text/javascript"></script>
<link href="<?= base_url(); ?>resources/bootstrap/selectize.js-master/dist/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css"/>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>
            var chart;
            var REGEX_NUMBER = /^([0-9])*$/;
            $(document).ready(function () {
                numero = $("#numero").selectize({
                    maxItems: 6,
                    delimiter: ',',
                    persist: false,
                    addPrecedence: false,
                    create: function (input) {
                        return {
                            value: input,
                            text: input
                        }
                    },
                    createFilter: function (input) {
                        return REGEX_NUMBER.test(input) && parseInt(input) > 0 && parseInt(input) < 57
                    },
                    onItemAdd: function (value, data) {
                        todosAnios = $("#anio").val();
                        if (todosAnios != "") {
                            $.post(base_url + 'Estadisticas/getNumero', {numero: value, anios: todosAnios}, function (json) {
                                $.each(json, function (anio, total) {
                                    var anios = $("#anio").val().split(",");
                                    idSerie = getIdDeLaSerie(anio);
                                    chart.series[idSerie].addPoint(parseInt(total));
                                });
                                chart.xAxis[0].setCategories($("#numero").val().split(","));
                                chart.redraw();
                            }, "json");
                        }
                    },
                    onItemRemove: function (value) {
                        for (var idSerie = 0; idSerie < chart.series.length; idSerie++) {
                            idData = getIdDelDataDeLaSerie(idSerie, value);
                            if (idData != null) {
                                chart.series[idSerie].data[idData].remove();
                            }
                        }
                        chart.xAxis[0].setCategories($("#numero").val().split(","));
                        chart.redraw();
                    }
                });

                anio = $("#anio").selectize({
                    maxItems: 10,
                    delimiter: ',',
                    persist: false,
                    addPrecedence: false,
                    create: function (input) {
                        return {
                            value: input,
                            text: input
                        }
                    },
                    createFilter: function (input) {
                        return REGEX_NUMBER.test(input) && parseInt(input) >= 1984 && parseInt(input) < <?= date("Y"); ?>
                    },
                    onItemAdd: function (value, data) {
                        todosNumeros = $("#numero").val();
                        if (todosNumeros != "") {
                            $.post(base_url + 'Estadisticas/getAnio', {numeros: todosNumeros, anios: value}, function (json) {
                                valores = [];
                                $.each(json, function (index, total) {
                                    id = getIdDelDataDeLaSerie(0, index)
                                    valores[id] = parseInt(total)
                                });
                                chart.addSeries({name: value, data: valores});
                            }, "json");
                            chart.redraw();
                        }
                    },
                    onItemRemove: function (value) {
                        id = getIdDeLaSerie(value);
                        chart.series[id].remove();
                    }
                });

                chart = new Highcharts.Chart({
                    chart: {
                        type: 'column',
                        renderTo: 'container'
                    },
                    title: {
                        text: 'Cardinalidad'
                    },
                    xAxis: {
                        categories: ['1']
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Cardinalidad'
                        },
                        stackLabels: {
                            enabled: true,
                            style: {
                                fontWeight: 'bold',
                                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                            }
                        }
                    },
                    legend: {
                        align: 'right',
                        x: -30,
                        verticalAlign: 'top', y: 25,
                        floating: true,
                        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                        borderColor: '#CCC',
                        borderWidth: 1,
                        shadow: false
                    },
                    tooltip: {
                        headerFormat: '<b>Número: {point.x}</b><br/>',
                        pointFormat: 'Año {series.name}: {point.y}<br/>Total: {point.stackTotal}'
                    },
                    plotOptions: {
                        column: {
                            stacking: 'normal',
                            dataLabels: {
                                enabled: true,
                                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                                style: {
                                    textShadow: '0 0 3px black'
                                }
                            }
                        }
                    },
                    series: [{
                            name: '2015',
                            data: [15]
                        }]
                });
            });

            function getIdDeLaSerie(anio) {
                for (var i = 0; i < chart.series.length; i++) {
                    if (parseInt(chart.series[i].name) == parseInt(anio)) {
                        return chart.series[i].index;
                    }
                }
                return false;
            }

            function getIdDelDataDeLaSerie(idSerie, categoria) {
                for (var i = 0; i < chart.series[idSerie].data.length; i++) {
                    if (chart.series[idSerie].data[i].category == categoria) {
                        return chart.series[idSerie].data[i].index;
                    }
                }
                return false;
            }
</script>