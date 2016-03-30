<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Melate Admin</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <!-- Timeline CSS -->
        <link href="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/dist/css/timeline.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/dist/css/sb-admin-2.css" rel="stylesheet">
        <!-- Morris Charts CSS -->
        <link href="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/bower_components/morrisjs/morris.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- jQuery -->
        <script src="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            var base_url = "<?= base_url(); ?>";
        </script>
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Admin v2.0</a>
                </div>
                <!-- /.navbar-header -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard fa-fw"></i> Tablero</a></li>
                            <li><a href="<?= base_url(); ?>estadisticas_generales"><i class="fa fa-dashboard fa-fw"></i> Estadística General</a></li>
                            <li><a href="<?= base_url(); ?>estadisticas"><i class="fa fa-dashboard fa-fw"></i> Estadísticas</a></li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <div id="page-wrapper">
                <?= $this->template; ?>
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- Metis Menu Plugin JavaScript -->
        <!--<script src="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/bower_components/metisMenu/dist/metisMenu.min.js"></script>-->

        <!-- Morris Charts JavaScript -->
<!--        <script src="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/bower_components/raphael/raphael-min.js"></script>
        <script src="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/bower_components/morrisjs/morris.min.js"></script>
        <script src="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/js/morris-data.js"></script>-->

        <!-- Custom Theme JavaScript -->
        <script src="<?= base_url(); ?>resources/bootstrap/startbootstrap-sb-admin-2-1.0.7/dist/js/sb-admin-2.js"></script>
        <script src="<?= base_url(); ?>resources/js/funciones.js"></script>
    </body>
</html>