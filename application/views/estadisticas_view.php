<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Estadísticas</h1>
    </div>
</div>
<div class="row">
    <div class="">
        <form class="form-inline" onsubmit="return false;">
            <div class="form-group">
                <label for="exampleInputName2">Censo del número</label>
                <input type="number" class="form-control" id="numero" placeholder="" min="1" max="56">
            </div>
            <button type="button" class="btn btn-default" id="btnGraficaCenso">Graficar</button>
        </form>
        <div id="graficaCenso"></div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.post(base_url + 'Estadisticas/Censo', {numero: 1, fechaInicio: null, fechaFin: null}, function (json) {
        }, "json");
    });
</script>