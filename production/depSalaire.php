<?php
include("config.php");
$cursorNbclients = $collection_nbClients->find()->sort(array("ordre" => 1));
$salaire=$collection_salaire->find();
$department = $collection_Department->find()->sort(array('nameDep'=>1));
$saison=$collection_saison->find();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DataTables | Gentelella</title>
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->

    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <!-- sidebar menu -->
                <?php include("sidebar menu.php"); ?>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <?php include("menuFooter.html"); ?>
                <!-- /menu footer buttons -->
            </div>
        </div>
        <!-- top navigation -->
        <?php include("topNavigation.php"); ?>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Nombre des personnels par departement</h3>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Chercher...">
                                <span class="input-group-btn">
										<button class="btn btn-default" type="button">Ok!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form class="form-horizontal form-label-left" method="post" action="table.php">
                                            <div class=" table-responsive">
                                                <table class="table table-striped jambo_table bulk_action" id="table"
                                                       style="width:100%">


                                                    <thead class="headings">
                                                    <tr>
                                                        <th>Département</th>
                                                        <th style="text-align: center;">Type saison</th>
                                                        <?php foreach ($cursorNbclients as $int) {?>
                                                        <td style="text-align: center; vertical-align: middle;"> <?php echo $int['n1']; ?>
                                                            - <?php echo $int['n2']; ?></td>
                                                        <td>
                                                        <?php }?>

                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php foreach ($department as $dep){?>

                                                        <tr>
                                                            <td> <?php echo $dep['nameDep']; ?></td>
                                                            <td>
                                                                <table style=" margin-left: auto; margin-right: auto;">
                                                                    <?php foreach ($saison as $s) { ?>
                                                                        <tr>
                                                                            <?php if ($s['typeS'] == 'haute') { ?>
                                                                                <td>

                                                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Haute</label>
                                                                                </td>

                                                                                <?php
                                                                            }
                                                                            if ($s['typeS'] == 'moyenne') {
                                                                                ?>
                                                                                <td>
                                                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Moyenne</label>
                                                                                </td>

                                                                                <?php
                                                                            }
                                                                            if ($s['typeS'] == 'basse') {
                                                                                ?>
                                                                                <td>
                                                                                    <label class="col-form-label col-md-3 col-sm-3 label-align">Basse</label>
                                                                                </td>

                                                                            <?php } ?>
                                                                        </tr>

                                                                        <?php

                                                                    } ?>

                                                                </table>
                                                            </td>
                                                            <?php foreach ($salaire as $s){
                                                                if($s['department']==$dep){?>


                                                            <td>
                                                                <?php echo 'hhhh';?>
                                                            </td>
                                                                <?php }}?>



                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>



                                                    </tbody>


                                                </table>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <!--        <footer>-->
        <!---->
        <!--            <div class="clearfix"></div>-->
        <!--        </footer>-->
        <!-- /footer content -->
    </div>
</div>
<!-- jQuery -->


<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>
