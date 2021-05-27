<?php
include("config.php");
session_start();
$_SESSION["email"];


if (isset($_POST["ok"])) {
}


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
            <!---->
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Simulation</h3>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
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
                                <form class="form-horizontal form-label-left" method="GET">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> Nombre de nuitée
                                            Prévisionnel<span
                                                    class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" id="number" step="any" name="nbNuit"
                                                   class="form-control" min="0" value="<?php echo $_GET['nbNuit']; ?>">
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <input class="btn btn-success" name="submit" type="submit" value="Simuler"/>
                            </div>
                        </div>
                        <div class="ln_solid"></div>

                        </form>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class=" table-responsive">
                                    <table class="table table-striped jambo_table bulk_action" id="table"
                                           style="width:100%">
                                        <?php if (isset($_GET['nbNuit'])){
                                        $departments = $collection_Department->find()->sort(array('nameDep' => 1));
                                        $salaire = $collection_salaire->find()->sort(array('department' => 1));
                                        $department = $collection_Department->find()->sort(array('nameDep' => 1));

                                        $saison = $collection_saison->find();

                                        $a = array();

                                        foreach ($salaire as $item) {
                                            array_push($a, $item);
                                        }

                                        ?>
                                        <thead class="headings">
                                        <tr>
                                            <th style="text-align: center;">Service</th>
                                            <th style="text-align: center;">Charge Fixe</th>
                                            <th style="text-align: center;">Charge Variable</th>
                                            <th style="text-align: center;">Charge Totale</th>
                                            <th style="text-align: center;">Journal de paie</th>
                                            <th style="text-align: center;">Ecart</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach ($departments as $dep) {
                                            ?>
                                            <tr>

                                                <td><?php echo $dep['nameDep']; ?></td>
                                                <td style="text-align: center">test</td><td style="text-align: center">test</td><td style="text-align: center">test</td><td style="text-align: center">test</td><td style="text-align: center">test</td>

                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td style="font-size: medium; color: #5e79ff">Charge Brute Totale</td>
                                            <td style="text-align: center">test</td><td style="text-align: center">test</td><td style="text-align: center">test</td><td style="text-align: center">test</td><td style="text-align: center">test</td>
                                        </tr>


                                        <?php } ?>
                                    </table>
                                    <br>
                                    <br>
                                    <div class="col-md-6 col-sm-12">


                                        <?php if (isset($_GET['nbNuit'])) {
                                            $coutFixe=$collection_coutFixe->find();
                                            ?>
                                            <table class="table">

                                                <tbody>
                                                <?php
                                                $cursor = $collection_coutFixe->find();
                                                foreach ($cursor as $c) {?>
                                                    <tr>
                                                        <th>TFP & FOPROLOS</th>
                                                        <td><?php echo $c['foprolos'];?>&nbsp;%</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Charge sociale patronale</th>
                                                        <td><?php echo $c['chargePat'];?>&nbsp;%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Provision Prime</th>
                                                        <td><?php echo $c['prime'];?>&nbsp;%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Provision congé</th>
                                                        <td><?php echo $c['conge'];?>&nbsp;%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Charge salariale totale</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Charge Variable / Nuitée</th>
                                                        <td></td>
                                                    </tr>



                                                    <?php

                                                }
                                                ?>
                                                </tbody>

                                            </table>
                                        <?php } ?>

                                    </div>
                                </div>
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


