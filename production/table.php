<?php
include("config.php");
session_start();
$_SESSION["email"];


if (isset($_POST["ok"])) {
    $dep = $_POST['dep'];
    $cursorDep = $collection_Department->findOne(array('nameDep' => $dep));


    $cursor = $collection_Employees->find(array('department' => $dep));
    $nbPersonnel = $collection_nbPersonnel->findOne(array('department' => $dep));
    $saison = $collection_saison->find();
    $salaire = $collection_salaire->findOne(array('department' => $dep));
    if (empty($nbPersonnel)) {

//        $i = 0;

        for ($i = 0; $i < count($cursorDep['interval']); $i++) {


            $test = array("department" => $dep);
            $j = 0;

            $test["interval"] = $cursorDep['interval'][$i]['n1'] . ' - ' . $cursorDep['interval'][$i]['n2'];

            foreach ($cursor as $item) {
                $test[$item['function']] = array('basse' => $_POST['basse' . $i . $j], 'moyenne' => $_POST['moyenne' . $i . $j], 'haute' => $_POST['haute' . $i . $j]);
                $j++;
            }
            $a = array();
            array_push($a, $test);

            $collection_nbPersonnel->insert($test);

            //insert fi base salaire
            $k = 0;
            $d = array("department" => $dep);

            $d["interval"] = $cursorDep['interval'][$i]['n1'] . ' - ' . $cursorDep['interval'][$i]['n2'];

            $filtre_interval = array();
            $interval = $cursorDep['interval'][$i]['n1'] . ' - ' . $cursorDep['interval'][$i]['n2'];
            $filtre_interval = array_filter($a, function ($p) use ($interval) {
                return $p["interval"] == $interval;
            });
            $saison1 = 0;
            $saison2 = 0;
            $saison3 = 0;
            foreach ($cursor as $cs) {
                $saison1 += ($cs['salary']/26) * $filtre_interval[$k][$cs['function']]['haute'];
                $saison2 += ($cs['salary']/26) * $filtre_interval[$k][$cs['function']]['moyenne'];
                $saison3 += ($cs['salary']/26) * $filtre_interval[$k][$cs['function']]['basse'];

                $d['salaireTotale'] = array('haute' => $saison1, 'moyenne' => $saison2, 'basse' => $saison3);
                $j++;
            }

            $collection_salaire->insert($d);
            $k++;
            //fin insert


        }

        sleep(3);
        header("Location:table.php?select=$dep");

    } else {
//        $i = 0;

        for ($i = 0; $i < count($cursorDep['interval']); $i++) {
            $test = array();

            $j = 0;
            foreach ($cursor as $item) {
                $test[$item['function']] = array('basse' => $_POST['basse' . $i . $j], 'moyenne' => $_POST['moyenne' . $i . $j], 'haute' => $_POST['haute' . $i . $j]);

                $j++;
            }
            $newData = array('$set' => $test);
            $a = array();
            array_push($a, $test);
            $collection_nbPersonnel->update(array('department' => $dep, 'interval' => $cursorDep['interval'][$i]['n1'] . ' - ' . $cursorDep['interval'][$i]['n2']), $newData, array('upsert' => true));

            $k = 0;
            $d = array();


            $saison1 = 0;
            $saison2 = 0;
            $saison3 = 0;
            foreach ($cursor as $cs) {
                $saison1 += ($cs['salary']/26) * $a[$k][$cs['function']]['haute'];
                $saison2 += ($cs['salary']/26) * $a[$k][$cs['function']]['moyenne'];
                $saison3 += ($cs['salary']/26) * $a[$k][$cs['function']]['basse'];

                $d['salaireTotale'] = array('haute' => $saison1, 'moyenne' => $saison2, 'basse' => $saison3);
                $j++;
            }
            $nData = array('$set' => $d);
            $collection_salaire->update(array('department' => $dep, 'interval' => $cursorDep['interval'][$i]['n1'] . ' - ' . $cursorDep['interval'][$i]['n2']), $nData, array('upsert' => true));
            $k++;


//            $i++;


        }
        sleep(1);
        header("Location:table.php?select=$dep");

    }
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
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
                        <h3>Nombre des personnels par département</h3>
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
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> Choisir departement<span
                                                    class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select class="select2_single form-control" tabindex="-1" name="select"
                                                    required="required"
                                                    onchange="this.form.submit()">
                                                <option></option>
                                                <?php $department = $collection_Department->find()->sort(array('nameDep' => 1));
                                                foreach ($department as $c) {
                                                    ?>
                                                    <option value="<?php echo $c['nameDep']; ?>"<?php if ($_GET['select'] == $c['nameDep']) { ?> selected="selected"<?php } ?>>
                                                        <?php echo $c['nameDep']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                </form>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form class="form-horizontal form-label-left" method="post" action="table.php">
                                            <div class=" table-responsive">
                                                <table class="table table-striped jambo_table bulk_action" id="table"
                                                       style="width:100%">

                                                    <?php
                                                    if (isset($_GET["select"])) {
                                                        $select = $_GET['select'];
                                                        $cursor = $collection_Department->findOne(array('nameDep' => $select));
                                                        usort($cursor['interval'], function ($a, $b) {

                                                            return $a['ordre'] - $b['ordre'];
                                                        });
                                                        if (count($cursor['interval']) == 0) {
                                                            echo '<script type="text/javascript">$(document).ready(function(){Swal.fire({title: "Erreur!",text: "Ajouter intervalles occupation pour ce department d\'abord",icon: "error",confirmButtonText: "OK"})});</script>';
                                                        } else {


                                                            $cursorFunction = $collection_Employees->find(array('department' => $select));
                                                            

                                                            $nb = $collection_nbPersonnel->count(array('department' => $select));
                                                            $saison = $collection_saison->find();
                                                            if ($nb == 0) {
                                                                ?>
                                                                <input type="text" name="dep"
                                                                       value="<?php echo $select; ?>"
                                                                       hidden>

                                                                <thead class="headings">
                                                                <tr>
                                                                    <th style="text-align: center;">Ordre</th>
                                                                    <th style="text-align: center;">Nb clients</th>
                                                                    <th style="text-align: center;">Type saison</th>
                                                                    <?php foreach ($cursorFunction as $c) { ?>

                                                                        <th style="text-align: center;"><?php echo $c['function'] ?> </th>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </tr>
                                                                </thead>

                                                                <tbody>
                                                                <?php
                                                                //                                                            $i = 0;
                                                                for ($i = 0; $i < count($cursor['interval']); $i++) {
                                                                    $j = 0;

                                                                    ?>
                                                                    <tr>
                                                                        <td style="text-align: center; vertical-align: middle;"> <?php echo $cursor['interval'][$i]['ordre']; ?></td>
                                                                        <td style="text-align: center; vertical-align: middle;"> <?php echo $cursor['interval'][$i]['n1']; ?>
                                                                            - <?php echo $cursor['interval'][$i]['n2']; ?></td>
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
                                                                        foreach ($cursorFunction as $c) { ?>

                                                                            <td>
                                                                                <?php foreach ($saison as $s) { ?>
                                                                                    <table style=" margin-left: auto; margin-right: auto;">
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="number"
                                                                                                       class="form-control"
                                                                                                       name="<?php echo $s['typeS'] . $i . $j; ?>"
                                                                                                       required="required"
                                                                                                       style="width: 80px;text-align: right"
                                                                                                       min="0"
                                                                                                >
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                <?php } ?>
                                                                            </td>
                                                                            <?php
                                                                            $j++;
                                                                        }
                                                                        ?>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>


                                                                </tbody>
                                                                <?php
                                                            } else {

                                                                $nbPersonnel = $collection_nbPersonnel->find(array('department' => $select));

                                                                $a = array();

                                                                foreach ($nbPersonnel as $item) {
                                                                    array_push($a, $item);
                                                                }


                                                                ?>

                                                                <input type="text" name="dep"
                                                                       value="<?php echo $select; ?>" hidden>
                                                                <thead class="headings">
                                                                <tr>
                                                                    <th style="text-align: center;">Ordre</th>
                                                                    <th style="text-align: center; ">Nb clients</th>
                                                                    <th style="text-align: center;">Type saison</th>
                                                                    <?php
                                                                    foreach ($cursorFunction as $cs) {
                                                                        ?>
                                                                        <th style="text-align: center;"
                                                                            class="column-title no-link last"
                                                                            colspan="2"><?php echo $cs['function']; ?></th>

                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <th style="text-align: center;"><img
                                                                                src="https://as2.ftcdn.net/jpg/02/23/33/09/500_F_223330987_RI7wJWZK5aewcHm4dDJ7PXfF5mwdH5EZ.jpg"
                                                                                alt="Girl in a jacket" width="30"
                                                                                height="30"> par saison
                                                                    </th>
                                                                    <th style="text-align: center;"><img
                                                                                src="https://as2.ftcdn.net/jpg/02/23/33/09/500_F_223330987_RI7wJWZK5aewcHm4dDJ7PXfF5mwdH5EZ.jpg"
                                                                                alt="Girl in a jacket" width="30"
                                                                                height="30"> total
                                                                    </th>
                                                                    <!--                                                                <th style="text-align: center;">Somme total</th>-->


                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                <?php
                                                                for ($i = 0; $i < count($cursor['interval']); $i++) {


                                                                    $saison1 = 0;
                                                                    $saison2 = 0;
                                                                    $saison3 = 0;
                                                                    $totalSal = 0;

                                                                    $j = 0;


                                                                    $filtre_interval = array();
                                                                    $interval = $cursor['interval'][$i]['n1'] . " - " . $cursor['interval'][$i]['n2'];
                                                                    $saison = $collection_saison->find();

                                                                    $filtre_interval = array_filter($a, function ($p) use ($interval) {
                                                                        return $p["interval"] == $interval;
                                                                    });
                                                                    ?>

                                                                    <tr>
                                                                        <td style="text-align: center; vertical-align: middle;">
                                                                            <?php echo $cursor['interval'][$i]['ordre']; ?>
                                                                        </td>
                                                                        <td style="text-align: center; vertical-align: middle;">
                                                                            <?php echo $cursor['interval'][$i]['n1']; ?>
                                                                            - <?php echo $cursor['interval'][$i]['n2']; ?>
                                                                        </td>
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
                                                                        foreach ($cursorFunction as $cs) {
                                                                            $saison1 += ($cs['salary']/26) * $filtre_interval[$i][$cs['function']]['haute'];
                                                                            $saison2 += ($cs['salary']/26) * $filtre_interval[$i][$cs['function']]['moyenne'];
                                                                            $saison3 += ($cs['salary']/26) * $filtre_interval[$i][$cs['function']]['basse'];


                                                                            ?>
                                                                            <td colspan="2">
                                                                                <?php foreach ($saison as $s) {
                                                                                    ?>
                                                                                    <table style=" margin-left: auto; margin-right: auto;">
                                                                                        <tr>
                                                                                            <td>
                                                                                                <input type="number"
                                                                                                       class="form-control"
                                                                                                       name="<?php echo $s['typeS'] . $i . $j; ?>"
                                                                                                       value="<?php echo $filtre_interval[$i][$cs['function']][$s['typeS']]; ?>"
                                                                                                       required
                                                                                                       style="height:35px;width: 75px;text-align: right"
                                                                                                       min="0">
                                                                                            </td>
                                                                                            <td style="text-align: right;">
                                                                                                <input
                                                                                                        value="<?php
                                                                                                        echo number_format(($cs['salary']/26) * $filtre_interval[$i][$cs['function']][$s['typeS']], 3, '.', '');
                                                                                                        ?>" disabled
                                                                                                        style="height: 35px;width: 75px; text-align: right"
                                                                                                >
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                    <?php
                                                                                } ?>
                                                                            </td>
                                                                            <?php

                                                                            $j++;
                                                                        }
                                                                        ?>
                                                                        <td style="text-align:center;">
                                                                            <?php foreach ($saison as $s) { ?>
                                                                                <table style=" margin-left: auto; margin-right: auto;">
                                                                                    <tr>
                                                                                        <td>
                                                                                            <?php
                                                                                            if ($s['typeS'] == 'haute') {
                                                                                                $totalSal += $saison1;
                                                                                                ?>
                                                                                                <input style="height: 35px;width: 75px;text-align: right;"

                                                                                                       name="salSaison1"

                                                                                                       value="<?php echo number_format($saison1, 3, '.', '');
                                                                                                       ?>"
                                                                                                       disabled="disabled">

                                                                                                <?php

                                                                                            }

                                                                                            if ($s['typeS'] == 'moyenne') {
                                                                                                $totalSal += $saison2; ?>


                                                                                                <input
                                                                                                        style="height: 35px;width: 75px;text-align: right;"
                                                                                                        name="salSaison2"

                                                                                                        value="<?php echo number_format($saison2, 3, '.', '');
                                                                                                        ?>"
                                                                                                        disabled="disabled">

                                                                                            <?php }
                                                                                            if ($s['typeS'] == 'basse') {
                                                                                                $totalSal += $saison3; ?>
                                                                                                <input
                                                                                                        style="height: 35px;width: 75px;text-align: right;"
                                                                                                        ;
                                                                                                        name="salSaison2"
                                                                                                        value="<?php echo number_format($saison3, 3, '.', '');
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
                                                                                    echo number_format($totalSal, 3, '.', '');

                                                                                    ?>" disabled
                                                                                    style="height: 35px;width: 75px;text-align: right;"
                                                                            >


                                                                        </td>

                                                                    </tr>

                                                                    <?php
//                                                                $i++;

                                                                }
                                                                ?>
                                                                </tbody>
                                                            <?php }
                                                            ?>
                                                            <input type="submit" class="btn btn-success" name="ok"
                                                                   value="Valider">
                                                            <?php
                                                        }
                                                    } ?>
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


