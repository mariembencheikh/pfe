<?php
include("config.php");
session_start();
if (isset($_POST["submit"])) {
    $foprolos = $_POST['foprolos'];
    $chargePat = $_POST['chargePat'];
    $prime=$_POST['prime'];
    $conge=$_POST['conge'];
    $cursor_cost = $collection_coutFixe->findOne(array('foprolos'=>$foprolos,'chargePat' => $chargePat,'prime'=>$prime,'conge'=>$conge));
    if (empty($cursor_cost)) {
        $collection_coutFixe->insert(array('foprolos'=>$foprolos,'chargePat' => $chargePat,'prime'=>$prime,'conge'=>$conge));
    } else {
        echo "<script>alert(\"Cost already existed\")</script>";
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
                <div class="page-title">
                    <div class="title_left">
                        <h3>Couts fixes</h3>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
<!--                            <div class="input-group">-->
<!--                                <input type="text" class="form-control" placeholder="Search for...">-->
<!--                                <span class="input-group-btn">-->
<!--										<button class="btn btn-default" type="button">Go!</button>-->
<!--									</span>-->
<!--                            </div>-->
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
                                <br/>
                                <form class="form-horizontal form-label-left" action="coutsFixes.php"  method="POST">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align">TFP-Foprolos<span class="required">*</span></label>
                                        <div class="col-md-2 col-sm-2 ">
                                            <div class="input-group mb-3">
                                                <input type="number" step="any" class="form-control" name="foprolos" required="required" aria-label="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"
                                               for="name">Charge patronal<span class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-2 ">
                                            <div class="input-group mb-3">
                                                <input type="number" step="any" class="form-control" name="chargePat" required="required" aria-label="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Provision prime<span class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-2 ">
                                            <div class="input-group mb-3">
                                                <input type="number" step="any" class="form-control" name="prime" required="required" aria-label="">
<!--                                                <div class="input-group-append">-->
<!--                                                    <span class="input-group-text">/6*0.85</span>-->
<!--                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Provision conge<span class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-2 ">
                                            <div class="input-group mb-3">
                                                <input type="number" step="any" class="form-control" name="conge" required="required" aria-label="">
<!--                                                <div class="input-group-append">-->
<!--                                                    <span class="input-group-text">/ 26*2</span>-->
<!--                                                </div>-->
                                            </div>

                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>

                                    <div class="item form-group">
                                        <div class="col-md-6 col-sm-6 offset-md-3">
                                            <input class="btn btn-success" name="submit" type="submit" value="Ajouter"/>
                                            <input class="btn btn-primary" name="cancel" type="button" value="Annuler" onclick="window.location=''"/>
                                        </div>
                                    </div>

                                </form>
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
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
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


