<?php
$numero = NULL;
$anio = NULL;
$minYear = 1980;
$maxYear = intval(date("Y"));
if ($this->input->get("numero")) {
    $numero = $this->input->get("numero");
}
if ($this->input->get("anio")) {
    $anio = $this->input->get("anio");
}
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Estadísticas</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" method="get">
            <div class="form-group">
                <label for="numero" class="control-label col-sm-2">Números</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="numero" name="numero" value="<?= $numero; ?>" autocomplete="off" min="1" max="56">
                    <p class="help-block pull-left">Escriba un número entre el 1 y el 56</p>
                </div>
            </div>
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
<?php
if (!empty($numero)) {
    $minYear = $this->input->get("min_year");
    $maxYear = $this->input->get("max_year");
    $anios = array();
    if ($minYear && $maxYear) {
        $anios = range($minYear, $maxYear);
    }
    $valores = $this->Estadisticas_model->getCensoPorAnio($numero, $anios);
    $sumaPorcentaje = array();
    ?>
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
                        <th>Anio</th>
                        <th title="Cantidad de veces que salió durante el año">Cardinalidad</th>
                        <th title="Probabilidad de que salga (Cardinalidad/Numero de juegos)">Probabilidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($valores as $k => $v): ?>
                        <tr>
                            <td><a href="<?= base_url() . "estadisticas?numero=" . $numero . "&anio=" . $k; ?>"><?= $k; ?></a></td>
                            <td align="center"><?= $v; ?></td>
                            <td align="right"><?= number_format($v / 104 * 100, 2); ?>%</td>
                            <?php array_push($sumaPorcentaje, $v / 104 * 100); ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Promedio</td>
                        <td align="center"><?= number_format(array_sum($valores) / count($valores), 2); ?></td>
                        <td align="right"><?= number_format(array_sum($sumaPorcentaje) / count($sumaPorcentaje)); ?>%</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<?php } ?>

<?php if (!empty($anio)) { ?>
    <?php
    $this->load->helper("varios");
    $valores = $this->Estadisticas_model->getCensoDelAnioPorMes($numero, $anio);
    $meses = array_keys($valores);
    ?>
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">
            Distribución del número <strong><?= $numero; ?></strong> durante el año <strong><?= $anio; ?></strong>
            <span class="form-group pull-right"><label><input type="checkbox" id="ocultar_ceros"> Ocultar ceros</label></span>
        </div>

        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <?php for ($i = 1; $i <= 12; $i++): ?><th class="<?= !isset($valores[$i]) ? "esCero" : ""; ?>"><center><?= Meses($i); ?></center></th><?php endfor; ?>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <?php for ($i = 1; $i <= 12; $i++): ?><td align="center" class="<?= !isset($valores[$i]) ? "esCero" : ""; ?>"><?= isset($valores[$i]) ? $valores[$i] : 0; ?></td><?php endfor; ?>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>
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
            pips:{
                mode:'range',
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
    });
</script>