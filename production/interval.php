<?php
include("config.php");
session_start();
if (isset($_GET['id'])) {

    $dep_intervalle = $collection_Department->findOne(array('nameDep' => $_GET['id']));

    usort($dep_intervalle['interval'], function ($a, $b) { // anonymous function

        return $a['ordre'] - $b['ordre'];
    });
    $collection_Department->update(array('nameDep' => $dep_intervalle['nameDep']), array('$set' => array('interval' => $dep_intervalle['interval'])));

    $dep=$_GET['id'];

} else {
    header("Location:departments.php");
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
                                    <h3>Intervalle des clients</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <br/>
                                <div class="row">
                                    <div class="col-sm-6 offset-md-2">
                                        <div class="table-responsive">


                                            <table class="table table-striped jambo_table bulk_action">
                                                <thead class="headings">
                                                <th class="column-title"> Ordre</th>
                                                <th class="column-title"> Intervalle</th>
                                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                                </th>
                                                </thead>
                                                <tbody>

                                                <?php


                                                for ($i = 0; $i < count($dep_intervalle['interval']); $i++) {
                                                    ?>
                                                    <tr class="odd pointer">
                                                        <td><?php echo $dep_intervalle['interval'][$i]['ordre'] ?></td>
                                                        <td><?php echo $dep_intervalle['interval'][$i]['n1'] . " - " . $dep_intervalle['interval'][$i]['n2'] ?></td>
                                                        <td class="last">
                                                            <a
                                                                    href="editNbCleints.php?id=<?php echo $i; ?>&dep=<?php echo $dep_intervalle['nameDep']; ?>"><i
                                                                        class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                            <a href="deleteInterval.php?id=<?php echo $i; ?>&dep=<?php echo $dep_intervalle['nameDep']; ?>"
                                                               onclick="return sure();"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php

                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <input class="btn btn-success" name="submit" type="submit"
                                               value="Ajouter nouveau" onclick="window.location='nbClients.php?id=<?php echo $dep;?>'"/>
                                        <input class="btn btn-primary" name="cancel" type="button" value="Retour"
                                               onclick="window.location='departments.php';"/>
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
            </
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<script>
    function sure() {
        return (confirm('Etes-vous s??r de vouloir supprimer cet interval?'));
    }
</script>
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


