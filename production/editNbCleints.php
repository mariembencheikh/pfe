<?php
include("config.php");
session_start();
if (isset($_POST["submit"])) {
    $n1 = $_POST['n1'];
    $n2 = $_POST['n2'];
    $ordre=$_POST['ordre'];
    $id = $_POST['id'];


    $newdata = array('$set' => array('ordre'=>$ordre,'n1' => $n1 , 'n2' => $n2));
    $collection_nbClients->update(array('_id'=> new MongoId($id)), $newdata);
    //header("Location:interval.php");
}
if (isset($_GET['id'])) {
   $nb_edit = $collection_nbClients->findOne(array('_id' => new MongoId($_GET['id'])));
} else{
    header("Location:interval.php");

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
                <?php include ("sidebar menu.php"); ?>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <?php include ("menuFooter.html"); ?>
                <!-- /menu footer buttons -->
                <!-- /menu footer buttons -->
            </div>
        </div>


        <!-- top navigation -->
        <?php include ("topNavigation.php"); ?>
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
                                <form class="form-horizontal form-label-left" action="editNbCleints.php" method="POST">
                                    <div class="form-group row">
                                        <div class="col-md-4 col-sm-4 offset-md-3">
                                            <div class="input-group mb-3">
                                                <input type="number" name="ordre" class="form-control" required
                                                       style='width:50px;' min='0'
                                                       value="<?php  echo $nb_edit['ordre'];?>"/>
                                                &nbsp;&nbsp;<input type="number" name="n1" class="form-control" required
                                                       style='width:50px;' min='0'
                                                       value="<?php  echo $nb_edit['n1'];?>"/>
                                                &nbsp;&nbsp;
                                                <input type="number" name=" n2" class="form-control" required
                                                style='width:50px;' value="<?php  echo $nb_edit['n2'];?>"/>
                                                &nbsp;&nbsp;<input type="text" name=" id" class="form-control" required hidden
                                                style='width:50px;' value="<?php  echo $nb_edit['_id'];?>" />
                                                &nbsp;&nbsp;
                                                <span class="input-group-btn">
														<input type="submit" class="btn btn-primary" name="submit"
                                                               value="Enregistrer">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="item form-group">
                                        <div class="col-md-6 col-sm-6 offset-md-4">

                                            <input class="btn btn-primary" name="cancel" type="button" value="Annuler"
                                                   onclick="window.location='interval.php';"/>
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
                <!--                div>Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
            </
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



