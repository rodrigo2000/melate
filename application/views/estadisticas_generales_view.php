<?php
$minYear = 1984;
$maxYear = intval(date("Y"));

$aux = $this->input->get("min_year");
if (!empty($aux)) {
    $minYear = $aux;
}

$aux = $this->input->get("max_year");
if (!empty($aux)) {
    $maxYear = $aux;
}
$c = $this->Estadisticas_model->getNumeroAparicionesDeTodosLosNumeros($minYear, $maxYear);
$max = max($c);
$key_max = encuentraValor($max, $c);
$min = min($c);
$key_min = encuentraValor($min, $c);
$anios = range($minYear, $maxYear);

function encuentraValor($valor, $array) {
    $index = array();
    foreach ($array as $k => $a) {
        if ($a == $valor)
            array_push($index, $k);
    }
    return $index;
}
?>
<style>
    #myTable tbody td { text-align: center;}
    #myTable tbody td:first-child, .tablesorter tbody td:last-child{ font-weight: bolder; }
    /*    .tablesorter td { font-size: 20px;}*/
    #myTable tbody td.high { background: #0f0 !important; font-weight: bold; }
    #myTable tbody td.low { background: #f00 !important; font-weight: bold; }
    #myTable tfoot tr:last-child {text-align: center; font-weight: bolder; }
    #myTable thead td { text-align: center;}
</style>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Estadísticas</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" method="get">
            <div class="form-group">
                <label for="anio" class="control-label col-sm-2">Años</label>
                <div class="col-sm-4">
                    <div id="slider"></div>
                    <p class="text-left help-block">&nbsp;</p>
                    <input type="hidden" name="min_year" id="min_year">
                    <input type="hidden" name="max_year" id="max_year">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Realizar estadística</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= implode(", ", $key_max); ?></div>
                        <div><?= $max; ?> apariciones</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Número con más apariciones</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= implode(", ", $key_min); ?></div>
                        <div><?= $min; ?> apariciones</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Número con menos apariciones</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">0</div>
                        <div>New Orders!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">0</div>
                        <div>Support Tickets!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Cardinalidad</div>
        <div class="panel-body">
            <p>El cardinal indica el número o cantidad de elementos de un conjunto, sea esta cantidad finita o infinita.</p>
        </div>
        <!-- Table -->
        <table id="myTable" class="tablesorter">
            <thead>
                <tr>
                    <th>Número</th>
                    <?php foreach ($anios as $a) : ?>
                        <th><?= $a; ?></th>
                    <?php endforeach; ?>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (range(1, 56) as $k => $v): $data = $this->Estadisticas_model->getCensoPorAnio($v, $anios); ?>
                    <tr>
                        <td><?= $v; ?></td>
                        <?php foreach ($anios as $a) : ?>
                            <td><?= !empty($data[$a]) ? $data[$a] : 0; ?></td>
                        <?php endforeach; ?>
                        <td><?= array_sum($data); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<link href="<?= base_url(); ?>resources/jquery/noUiSlider.8.3.0/nouislider.tooltips.css" rel="stylesheet" type="text/css"/>
<link href="<?= base_url(); ?>resources/jquery/noUiSlider.8.3.0/nouislider.min.css" rel="stylesheet" type="text/css"/>
<script src="<?= base_url(); ?>resources/jquery/noUiSlider.8.3.0/nouislider.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>resources/jquery/noUiSlider.8.3.0/wNumb.js" type="text/javascript"></script>

<link href="<?= base_url(); ?>resources/jquery/jquery.tablesorter/themes/blue/style.css" rel="stylesheet" type="text/css"/>
<script src="<?= base_url(); ?>resources/jquery/jquery.tablesorter/jquery-latest.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>resources/jquery/jquery.tablesorter/jquery.tablesorter.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#myTable").tablesorter();

        $("#ocultar_ceros").change(function () {
            if ($(this).is(":checked")) {
                $(".esCero").hide();
            } else {
                $(".esCero").show();
            }
        });

        var slider = document.getElementById('slider');
        var valorInicial = <?= $minYear ? $minYear : 1980; ?>;
        var valorFinal = <?= $maxYear ? $maxYear : date("Y") ?>;
        noUiSlider.create(slider, {
            start: [valorInicial, valorFinal],
            step: 1,
            tooltips: [wNumb({decimals: 0}), wNumb({decimals: 0})],
            connect: true,
            behaviour: 'drag-tap',
            range: {
                'min': 1984,
                'max': 2016
            },
            pips: {
                mode: 'range',
                density: 3
            }
        }).on('update', function (values, handle) {
            var value = values[handle];
            if (handle) {
                $("#max_year").val(Math.round(value));
            } else {
                $("#min_year").val(Math.round(value));
            }
        });

        var columnas = $('#myTable tbody tr:eq(2) td').length;
        for (var i = 2; i < columnas; i++) {
            var array = $(".tablesorter tbody td:nth-child(" + i + ")").map(function () {
                return parseInt($(this).text(), 10);
            }).get();
            var max = Math.max.apply(null, array);
            var min = Math.min.apply(null, array);
            $(".tablesorter tbody td:nth-child(" + i + ")").map(function () {
                text = $(this).text();
                if (text == max)
                    $(this).addClass('high');
            });
            $(".tablesorter tbody td:nth-child(" + i + ")").map(function () {
                text = $(this).text();
                if (text == min)
                    $(this).addClass('low');
            });
        }
    });

</script>