<?php
include("config.php");
session_start();
$_SESSION["email"];
$cursor = $collection_nbNuitPrevisionnel->find();


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
                                <form class="form-horizontal form-label-left" method="GET" action="simulateur.php?id=">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> Type saison<span
                                                    class="required">*</span></label>
                                        <div class="col-md-2 col-sm-2 ">
                                            <select id="saison" class="select2_single form-control" tabindex="-1"
                                                    name="typeS"
                                                    required>
                                                <option></option>

                                                <option value="haute"
                                                    <?php if ($_GET['typeS'] == 'haute') { ?> selected="selected"
                                                    <?php } ?> >
                                                    Haute Saison
                                                </option>
                                                <option value="moyenne"
                                                    <?php if ($_GET['typeS'] == 'moyenne') { ?> selected="selected"
                                                    <?php } ?> >
                                                    Moyenne saison
                                                </option>
                                                <option value="basse"
                                                    <?php if ($_GET['typeS'] == 'basse') { ?> selected="selected"
                                                    <?php } ?> >
                                                    Basse saison
                                                </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> Nombre de nuitée
                                            Prévisionnel<span
                                                    class="required">*</span></label>
                                        <div class="col-md-2 col-sm-2 ">
                                            <input type="number" id="number" step="any" name="nbNuit"
                                                   class="form-control" min="0" value="<?php echo $_GET['nbNuit']; ?>"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <input class="btn btn-success" name="submit" type="submit" value="Simuler"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--                        <div class="ln_solid"></div>-->

                        <div class="row">
                            <div class="col-sm-12">
                                <div class=" table-responsive">
                                    <table class="table table-striped jambo_table bulk_action" id="table"
                                           style="width:100%">
                                        <?php if (isset($_GET['submit'])){
                                        $nbNuit = $collection_nbNuitPrevisionnel->findOne(array('typeS' => $_GET['typeS']));

                                        if (empty($nbNuit)) {
                                            $collection_nbNuitPrevisionnel->insert(array('typeS' => $_GET['typeS'], 'nbNuit' => $_GET['nbNuit']));
                                        } else {

                                            $collection_nbNuitPrevisionnel->update(array('typeS' => $_GET['typeS']), array('typeS' => $_GET['typeS'], 'nbNuit' => $_GET['nbNuit']));
                                        }


                                        $departments = $collection_Department->find()->sort(array('nameDep' => 1));
                                        $salaire = $collection_salaire->find()->sort(array('department' => 1));
                                        $department = $collection_Department->find()->sort(array('nameDep' => 1));

                                        $saison = $collection_saison->findOne(array('typeS' => 'basse'));

                                        $a = array();

                                        foreach ($salaire as $item) {
                                            array_push($a, $item);
                                        }


                                        ?>
                                        <thead class="headings">
                                        <tr>
                                            <th>Service</th>
                                            <th style="text-align: center;">Charge Fixe</th>
                                            <th style="text-align: center;">Charge Variable</th>
                                            <th style="text-align: center;">Charge Totale</th>
                                            <th style="text-align: center;">Journal de paie</th>
                                            <th style="text-align: center;">Ecart</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $x = 0;
                                        $TotaleChargeFixe = 0;
                                        $TotaleChargeVariable = 0;
                                        $TotaleChargeTotale = 0;
                                        $TotaleEcart = 0;
                                        $TotaleJournalePaie = 0;

                                        foreach ($departments as $dep) {
                                            $journalePaie = 0;
                                            $ChargeTotale = 0;
                                            $Ecart = 0;

                                            $depp = $dep['nameDep'];
                                            $interval = $dep['interval'][0]['n1'] . " - " . $dep['interval'][0]['n2'];
                                            $s_dep_int = $collection_salaire->findOne(array("department" => $depp, "interval" => $interval));

                                            ?>
                                            <tr>

                                                <td><?php echo $dep['nameDep']; ?></td>


                                                <!-- Charge fixe Basse saison -->
                                                <td style="text-align: center">
                                                    <?php
                                                    $fixe = $s_dep_int['salaireTotale']['basse'] * $saison['days'];
                                                    $TotaleChargeFixe += $fixe;

                                                    if (!empty($s_dep_int)) {
                                                        ?>
                                                        <div class="form-group row " style="text-align: right">
                                                            <label
                                                                    class="control-label col-md-12 col-sm-3 "><?php echo number_format($fixe, 3, ',', ','); ?>
                                                            </label>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="form-group row ">
                                                            <label style="vertical-align: middle; text-align: right;"
                                                                   class="control-label col-md-12 col-sm-3 "><?php echo number_format(0, 3, ',', ','); ?></label>
                                                        </div>

                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <!-- Fin Charge fixe Basse saison -->

                                                <!-- Charge variable Basse saison -->
                                                <?php

                                                for ($j = 0; $j < count($dep['interval']); $j++) {
                                                    $filtre_interval = array();
                                                    $interval = $dep['interval'][$j]['n1'] . " - " . $dep['interval'][$j]['n2'];
                                                    $filtre_interval = array_filter($a, function ($p) use ($interval, $depp) {
                                                        return (($p["interval"] == $interval) && $p['department'] == $depp);
                                                    });
                                                    if (sizeof($filtre_interval) != 0) {

                                                        if (($_GET['nbNuit'] <= $dep['interval'][$j]['n2'] * $saison['days']) && ($_GET['nbNuit'] >= $dep['interval'][$j - 1]['n2'] * $saison['days'])) {
                                                            $variable = ($filtre_interval[$x]['salaireTotale']['basse'] - $s_dep_int['salaireTotale']['basse']) * $saison['days'];
                                                        } elseif ($_GET['nbNuit'] >= $dep['interval'][$j]['n2'] * $saison['days']) {
                                                            $variable = ($filtre_interval[$x]['salaireTotale']['basse'] - $s_dep_int['salaireTotale']['basse']) * $saison['days'];

                                                        }
                                                        $ChargeTotale = $fixe + $variable;
                                                        $Ecart = $ChargeTotale - $journalePaie;
                                                        $x++;

                                                    } else {

                                                        $variable = 0;
                                                    }

                                                }

                                                $TotaleChargeVariable += $variable;
                                                $TotaleChargeTotale += $ChargeTotale;
                                                $TotaleEcart += $Ecart;

                                                ?>
                                                <td style="text-align: right">

                                                    <div class="form-group row ">
                                                        <label
                                                                class="control-label col-md-12 col-sm-3 "><?php echo number_format($variable, 3, ',', ','); ?></label>
                                                    </div>

                                                </td>

                                                <!-- Fin Charge variable Basse saison -->

                                                <!-- Charge totale Basse saison -->
                                                <td style="text-align: right">
                                                    <div class="form-group row ">
                                                        <label
                                                                class="control-label col-md-12 col-sm-3 "><?php echo number_format($ChargeTotale, 3, ',', ','); ?></label>
                                                    </div>
                                                </td>
                                                <!-- Fin Charge totale Basse saison -->

                                                <!-- Journal  de paie Basse saison -->
                                                <td style="text-align: right">
                                                    <div class="form-group row ">
                                                        <label
                                                                class="control-label col-md-12 col-sm-3 "><?php echo number_format($journalePaie, 3, ',', ','); ?></label>
                                                    </div>
                                                </td>
                                                <!-- Fin Journal  de paie Basse saison -->

                                                <!-- Ecart Basse saison -->
                                                <td style="text-align: right">
                                                    <div class="form-group row ">
                                                        <label
                                                                class="control-label col-md-12 col-sm-3 "><?php echo number_format($Ecart, 3, ',', ','); ?></label>
                                                    </div>
                                                </td>
                                                <!-- Fin Ecart Basse saison -->
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td style="font-size: x-large; color: #5e79ff;">Charge Brute Totale</td>


                                            <!-- Totale charge fixe Basse saison -->
                                            <td style="text-align: right">
                                                <div class="form-group row ">
                                                    <label
                                                            class="control-label col-md-12 col-sm-3 "><?php echo number_format($TotaleChargeFixe, 3, ',', ','); ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <!-- fin  Totale charge fixe Basse saison -->


                                            <!-- Totale charge Variable Basse saison -->
                                            <td style="text-align: right">
                                                <div class="form-group row ">
                                                    <label
                                                            class="control-label col-md-12 col-sm-3 "><?php echo number_format($TotaleChargeVariable, 3, ',', ','); ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <!-- Fin Totale charge variable Basse saison -->

                                            <!-- Totale charge totale Basse saison -->
                                            <td style="text-align: right">
                                                <div class="form-group row ">
                                                    <label
                                                            class="control-label col-md-12 col-sm-3 "><?php echo number_format($TotaleChargeTotale, 3, ',', ','); ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <!-- Fin Totale charge totale Basse saison -->

                                            <!--  Totale Journal  de paie Basse saison -->
                                            <td style="text-align: right">
                                                <div class="form-group row ">
                                                    <label
                                                            class="control-label col-md-12 col-sm-3 "><?php echo number_format($TotaleJournalePaie, 3, ',', ','); ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <!-- fin Totale Journal  de paie Basse saison -->

                                            <!-- Totale Ecart Basse saison -->
                                            <td style="text-align: right">
                                                <div class="form-group row ">
                                                    <label
                                                            class="control-label col-md-12 col-sm-3 "><?php echo number_format($TotaleEcart, 3, ',', ','); ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <!-- Fin Totale Ecart Basse saison -->

                                        </tr>
                                        <?php } ?>
                                    </table>
                                    <br>
                                    <br>

                                    <div class="col-md-6 col-sm-12">


                                        <?php if (isset($_GET['nbNuit'])) {
                                            $nb = $_GET['nbNuit'];
                                            $coutFixe = $collection_coutFixe->find();
                                            ?>
                                            <table class="table">
                                                <tbody>
                                                <?php
                                                $chargeSalarialeTotale = 0;
                                                $cursor = $collection_coutFixe->find();
                                                foreach ($cursor as $c) {
                                                    $tfp = ($TotaleChargeTotale * $c['foprolos']) / 100;
                                                    $patronale = ($TotaleChargeTotale * $c['chargePat']) / 100;
                                                    $prime = ($TotaleChargeTotale / 6) * $c['prime'];
                                                    $conge = ($TotaleChargeTotale / 26) * $c['conge'];
                                                    $chargeSalarialeTotale += $TotaleChargeTotale + $tfp + $patronale + $prime + $conge; ?>
                                                    <tr>
                                                        <th>TFP & FOPROLOS</th>
                                                        <td><?php echo number_format($tfp, 0, ' ', ' '); ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Charge sociale patronale</th>
                                                        <td><?php echo number_format($patronale, 0, ' ', ' '); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Provision Prime</th>
                                                        <td><?php echo number_format($prime, 0, ' ', ' '); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Provision congé</th>
                                                        <td><?php echo number_format($conge, 0, ' ', ' '); ?></td>


                                                    </tr>
                                                    <tr>
                                                        <th>Charge salariale totale</th>
                                                        <td><?php echo number_format($chargeSalarialeTotale, 0, ' ', ' '); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Charge Variable / Nuitée</th>
                                                        <td><?php echo $TotaleChargeVariable / $nb; ?></td>
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


