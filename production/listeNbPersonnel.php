<?php
include("config.php");
session_start();
if (isset($_POST["ok"])) {
    $dep = $_POST['dep'];
    $cursorNbclients = $collection_nbClients->find()->sort(array("ordre" => 1));
    $cursor = $collection_Employees->find(array('department' => $dep));
    $nbPersonnel = $collection_nbPersonnel->findOne(array('department' => $dep));

    $i = 0;
    foreach ($cursorNbclients as $c) {
        $test = array();
        $j = 0;
        foreach ($cursor as $item) {
            $test[$item['function']] = array('basse' => $_POST['basse' . $i . $j], 'moyenne' => $_POST['moyenne' . $i . $j], 'haute' => $_POST['haute' . $i . $j],);

//            $test[$item['function']] = $_POST[$i . $j];
            $j++;
        }
        $newData = array('$set' => $test);
        $collection_nbPersonnel->update(array('department' => $dep, 'interval' => $c['n1'] . ' - ' . $c['n2']), $newData);
        $i++;
    }
    header("Location:listeNbPersonnel.php");


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

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

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
                <!-- /menu footer buttons -->
            </div>
        </div>


        <!-- top navigation -->
        <?php include("topNavigation.php"); ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <div class="title_left">
                                    <h3>Number of personnel</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" method="post">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> Choose
                                            department<span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <select class="select2_single form-control" tabindex="-1" name="select"
                                                    required="required" onchange="this.form.submit()">
                                                <option></option>
                                                <?php
                                                $department = $collection_Department->find();
                                                foreach ($department as $dep) {
                                                    if ($collection_nbPersonnel->count(array("department" => $dep['nameDep']))) {
                                                        if (count($dep['nameDep']) != 0) {
                                                            ?>
                                                            <option value="<?php echo $dep['nameDep']; ?>" <?php if ($_POST['select'] == $dep['nameDep']) { ?> selected="selected"<?php } ?>>
                                                                <?php echo $dep['nameDep']; ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>

                                </form>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <form class="form-horizontal form-label-left" method="post"
                                          action="listeNbPersonnel.php">
                                        <div class="table-responsive">
                                            <table class="table table-striped jambo_table bulk_action" id="table"
                                                   style="width:100%">

                                                <?php
                                                if (isset($_POST["select"])) {
                                                    $select = $_POST['select'];
                                                    $cursor = $collection_nbPersonnel->find(array('department' => $select));
                                                    $cursor_interval = $collection_nbClients->find()->sort(array("ordre" => 1));;
                                                    $cursor_fonction = $collection_Employees->find(array('department' => $select));
                                                    $a = array();

                                                    foreach ($cursor as $item) {
                                                        array_push($a, $item);
                                                    }
                                                    ?>

                                                    <input type="text" name="dep"
                                                           value="<?php echo $select; ?>" hidden>
                                                    <thead class="headings">
                                                    <tr>
                                                        <th>Ordre</th>
                                                        <th>Nombre de clients</th>
                                                        <?php
                                                        foreach ($cursor_fonction as $cs) {
                                                            ?>
                                                            <th class="column-title no-link last"
                                                                colspan="2"><?php echo $cs['function']; ?></th>

                                                            <?php
                                                        }
                                                        ?>
                                                        <th>Somme salariale</th>


                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                                    $i = 0;

                                                    foreach ($cursor_interval as $c) {
                                                        $j = 0;
                                                        $salary=array();
                                                        $filtre_interval = array();
                                                        $interval = $c['n1'] . " - " . $c['n2'];
                                                        $saison = $collection_saison->find();

                                                        $filtre_interval = array_filter($a, function ($p) use ($interval) {
                                                            return $p["interval"] == $interval;
                                                        });
                                                        ?>

                                                        <tr>
                                                            <td>
                                                                <?php echo $c['ordre']; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $c['n1']; ?> - <?php echo $c['n2']; ?>
                                                            </td>


                                                            <?php
                                                            foreach ($cursor_fonction as $cs) {

                                                                ?>
                                                                <td colspan="2">
                                                                    <?php foreach ($saison as $s) {

                                                                        ?>
                                                                        <div class="input-group mb-1">

                                                                            <input type="number" class="form-control"
                                                                                   name="<?php echo $s['typeS'] . $i . $j; ?>"
                                                                                   value="<?php

                                                                                   echo $filtre_interval[$i][$cs['function']][$s['typeS']];


                                                                                   ?>" required="required"
                                                                            >
                                                                            &nbsp;
                                                                            <input value="<?php
                                                                                   echo number_format(($cs['salary'] * $filtre_interval[$i][$cs['function']][$s['typeS']]), 3, ',', ',');
                                                                                   ?>"
                                                                                   disabled>
                                                                            &nbsp;


                                                                        </div>
                                                                    <?php  array_push($salary,$cs['salary'] * $filtre_interval[$i][$cs['function']][$s['typeS']]);
                                                                    } ?>


                                                                </td>



                                                                <?php

                                                                $j++;
                                                            }
                                                            ?>
                                                            <td>
                                                                <?php  foreach ($saison as $s){?>


                                                                <input value="<?php
                                                                echo number_format(array_sum($salary), 3, ',', ',');

                                                                ?>"
                                                                       disabled>
                                                                &nbsp;
                                                                <?php }?>

                                                            </td>
                                                        </tr>

                                                        <?php
                                                        $i++;

                                                    }
                                                    ?>

                                                    <input type="submit" class="btn btn-success" name="ok"
                                                           value="submit">
                                                    </tbody>

                                                <?php }
                                                ?>

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
    <footer>
        <div class="pull-right">
            <!--                div>Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
        </
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
</div>


<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="../vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="../vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="../vendors/starrr/dist/starrr.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>
</html>


