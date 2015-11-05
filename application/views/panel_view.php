<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tablero</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">26</div>
                        <div>New Comments!</div>
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
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">12</div>
                        <div>New Tasks!</div>
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
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">124</div>
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
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">13</div>
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
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" id="descargarArchivoMelate">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Archivo Melate.xls
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="col-xs-6">
                    <h3>Archivo actual</h3>
                    <?php
                    $archivoMelate = "Melate.csv";
                    $rutaArchivoMelate = implode(DIRECTORY_SEPARATOR, array(realpath("."), "resources", $archivoMelate));
                    if (!file_exists($rutaArchivoMelate)) {
                        echo '<p>No se encontró el archivo de MELATE en el directorio: ' . $rutaArchivoMelate . '</p>';
                    } else {
                        $csv = file($rutaArchivoMelate);
                        $keys = str_getcsv($csv[0]);
                        $values = str_getcsv($csv[1]);
                        $datos = array_combine($keys, $values);
                        $this->load->helper("varios_helper");
                        list($dia, $mes, $anio) = explode("/", $datos['FECHA']);
                        echo "<p>La última fecha del archivo <b>" . $archivoMelate . "</b> es: " . $dia . ' de ' . Meses($mes) . ' de ' . $anio . "<br>"
                        . 'Descarga la última versión haciendo <a href="#" id="getArchivoMelateFromURL">clic aquí</a></p>';
                    }
                    ?>
                </div>
                <div class="col-xs-6">Archivo servidor</div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-8 -->
</div>
<!-- /.row -->