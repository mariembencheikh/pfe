<?php
include("config.php");
$salaire = $collection_salaire->find()->sort(array('department' => 1));
$department = $collection_Department->find()->sort(array('nameDep' => 1));

$saison = $collection_saison->find();

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
                                                        <th style="text-align: center;">Type saison</th>
                                                        <?php for ($j = 0; $j < count($dep['interval']); $j++) { ?>
                                                            <th style="text-align: center; vertical-align: middle;">
                                                                <?php echo $dep['interval'][$j]['n1']; ?>
                                                                -
                                                                <?php echo $dep['interval'][$j]['n2']; ?>
                                                            </th>
                                                        <?php } ?>
                                                        <th style="text-align: center;">Totale par saison</th>
                                                        <th style="text-align: center;">Totale</th>

                                                    </tr>
                                                    </thead>


                                                    <tbody>
                                                    <?php


                                                    $Total = 0;
                                                    $TotSaison1 = 0;
                                                    $TotSaison2 = 0;
                                                    $TotSaison3 = 0;
                                                    ?>


                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"> <?php echo $dep['nameDep']; ?></td>
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
                                                        <?php
                                                        $depp = $dep['nameDep'];
                                                        $int1 = $dep['interval'][0]['n1'] . " - " . $dep['interval'][0]['n2'];
                                                        $s_dep_int=$collection_salaire->findOne(array("department" => $depp,"interval" => $int1));

                                                        for ($j = 0; $j < count($dep['interval']); $j++) {


                                                            $i = 0;
                                                            $filtre_interval = array();
                                                            $interval = $dep['interval'][$j]['n1'] . " - " . $dep['interval'][$j]['n2'];
                                                            $filtre_interval = array_filter($a, function ($p) use ($interval, $depp) {
                                                                return (($p["interval"] == $interval) && $p['department'] == $depp);
                                                            });
                                                            while ($i < count($a)) {

                                                                $TotSaison1 += $filtre_interval[$i]['salaireTotale']['haute']- $s_dep_int['salaireTotale']['haute'];
                                                                $TotSaison2 += $filtre_interval[$i]['salaireTotale']['moyenne']-$s_dep_int['salaireTotale']['moyenne'];
                                                                $TotSaison3 += $filtre_interval[$i]['salaireTotale']['basse']-$s_dep_int['salaireTotale']['basse'];


                                                                $i++;
                                                            }
                                                            ?>
                                                            <td>
                                                                <?php


                                                                foreach ($saison as $ss) {


                                                                    if (sizeof($filtre_interval) != 0) {


                                                                        ?>
                                                                        <table style=" margin-left: auto; margin-right: auto;">

                                                                            <tr>
                                                                                <td>

                                                                                    <input

                                                                                        value="<?php echo number_format($filtre_interval[$x]['salaireTotale'][$ss['typeS']] - $s_dep_int['salaireTotale'][$ss['typeS']], 3, ',', ','); ?>"
                                                                                        disabled
                                                                                        style="height: 35px;width: 75px"
                                                                                    >

                                                                                </td>
                                                                            </tr>

                                                                        </table>
                                                                        <?php


                                                                    } else {
                                                                        ?>
                                                                        <table style=" margin-left: auto; margin-right: auto;">
                                                                            <tr>
                                                                                <td>
                                                                                    <input

                                                                                        value="<?php echo number_format(0, 3, ',', ','); ?>"
                                                                                        disabled
                                                                                        style="height: 35px;width: 75px">
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <?php
                                                                    }


                                                                }
                                                                if (sizeof($filtre_interval) != 0) {
                                                                    $x++;
                                                                }


                                                                ?>
                                                            </td>

                                                            <?php


                                                        }


                                                        ?>

                                                        <td style="text-align:center;">
                                                            <?php foreach ($saison as $s) { ?>
                                                                <table style=" margin-left: auto; margin-right: auto;">
                                                                    <tr>
                                                                        <td>
                                                                            <?php
                                                                            if ($s['typeS'] == 'haute') {
                                                                                $Total += $TotSaison1;
                                                                                ?>
                                                                                <input style="height: 35px;width: 75px"
                                                                                       ;
                                                                                       name="salSaison1"

                                                                                       value="<?php echo number_format($TotSaison1, 3, ',', ',');
                                                                                       ?>"
                                                                                       disabled="disabled">

                                                                                <?php

                                                                            }

                                                                            if ($s['typeS'] == 'moyenne') {
                                                                                $Total += $TotSaison2; ?>


                                                                                <input
                                                                                    style="height: 35px;width: 75px"
                                                                                    ;
                                                                                    name="salSaison2"

                                                                                    value="<?php echo number_format($TotSaison2, 3, ',', ',');
                                                                                    ?>"
                                                                                    disabled="disabled">

                                                                            <?php }
                                                                            if ($s['typeS'] == 'basse') {
                                                                                $Total += $TotSaison3; ?>
                                                                                <input
                                                                                    style="height: 35px;width: 75px"
                                                                                    ;
                                                                                    name="salSaison2"
                                                                                    value="<?php echo number_format($TotSaison3, 3, ',', ',');
                                                                                    ?>" disabled>


                                                                                <?php

                                                                            } ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <?php
                                                            } ?>
                                                        </td>
                                                        <td style="vertical-align: middle; text-align: center;">

                                                            <input
                                                                value="<?php
                                                                echo number_format($Total, 3, ',', ',');

                                                                ?>" disabled
                                                                style="height: 35px;width: 75px" ;
                                                            >


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


