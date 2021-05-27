<?php
include("config.php");
$salaire = $collection_salaire->find()->sort(array('department' => 1));
$department = $collection_Department->find()->sort(array('nameDep' => 1));

$saison = $collection_saison->findOne(array('typeS' => 'moyenne'));

$a = array();

foreach ($salaire as $item) {
    array_push($a, $item);
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
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Cout salariale</h3>
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
                            <?php
                            $x = 0;
                            foreach ($department as $dep) {

                                ?>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class=" table-responsive">
                                                <table class="table table-striped jambo_table bulk_action" id="table"
                                                       style="width:100%">


                                                    <thead class="headings">
                                                    <tr>
                                                        <th style="text-align: center;">Département</th>
                                                        <th style="text-align: center;">
                                                            <?php echo $dep['interval'][0]['n1']; ?>
                                                            -
                                                            <?php echo $dep['interval'][0]['n2'] * $saison['days']; ?>
                                                        </th>

                                                        <?php for ($j = 1; $j < count($dep['interval']); $j++) { ?>
                                                            <th style="text-align: center;">
                                                                <?php echo ($dep['interval'][$j - 1]['n2'] * $saison['days']) + 1; ?>
                                                                -
                                                                <?php echo $dep['interval'][$j]['n2'] * $saison['days']; ?>
                                                            </th>
                                                        <?php } ?>
                                                        <th style="text-align: center;">Totale</th>

                                                    </tr>
                                                    </thead>


                                                    <tbody>
                                                    <?php


                                                    $Total = 0;
                                                    $TotSaison1 = 0;

                                                    ?>


                                                    <tr>
                                                        <td style="text-align: center;"> <?php echo $dep['nameDep']; ?></td>

                                                        <?php
                                                        $depp = $dep['nameDep'];
                                                        for ($j = 0; $j < count($dep['interval']); $j++) {


                                                            $i = 0;
                                                            $filtre_interval = array();
                                                            $interval = $dep['interval'][$j]['n1'] . " - " . $dep['interval'][$j]['n2'];
                                                            $filtre_interval = array_filter($a, function ($p) use ($interval, $depp) {
                                                                return (($p["interval"] == $interval) && $p['department'] == $depp);
                                                            });
                                                            while ($i < count($a)) {

                                                                $TotSaison1 += $filtre_interval[$i]['salaireTotale']['moyenne']  * $saison['days'];


                                                                $i++;
                                                            }
                                                            ?>
                                                            <td style="text-align: right">
                                                                <?php


                                                                if (sizeof($filtre_interval) != 0) {


                                                                    ?>
                                                                    <div class="form-group row ">
                                                                        <label class="control-label col-md-12 col-sm-3 "><?php echo number_format($filtre_interval[$x]['salaireTotale']['moyenne']  * $saison['days'], 3, ',', ','); ?></label>
                                                                    </div>

                                                                    <?php


                                                                } else {
                                                                    ?>
                                                                    <div class="form-group row ">
                                                                        <label  class="control-label col-md-12 col-sm-3 "><?php echo number_format(0, 3, ',', ','); ?></label>
                                                                    </div>

                                                                    <?php
                                                                }


                                                                if (sizeof($filtre_interval) != 0) {
                                                                    $x++;
                                                                }


                                                                ?>
                                                            </td>

                                                            <?php


                                                        }


                                                        ?>

                                                        <td>


                                                            <?php

                                                            $Total += $TotSaison1;
                                                            ?>
                                                            <div class="form-group row " style="vertical-align: middle; text-align: right;" >
                                                                <label  class="control-label col-md-12 col-sm-3 "><?php echo number_format($Total, 3, ',', ','); ?></label>
                                                            </div>



                                                        </td>

                                                    </tr>
                                                    <?php

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
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



