<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<?php
include("config.php");
session_start();
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $pwd = $_POST['pwd'];
    $role= $_POST['role'];
    $errmsg='';
    $fetch=$collection->findOne(array("email" => $email));
    if(empty($fetch)){
        $collection->insert(array("name" => $name, "email" => $email,"telephone"=>$tel,'password'=>$pwd,'role'=>$role,"etat"=>"0"));

        header("Location:listeUser.php");
    }
    else{
        echo '<script type="text/javascript">$(document).ready(function(){Swal.fire({title: "Erreur!",text: "Email existe",icon: "error",confirmButtonText: "OK"})});</script>';

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
                        <h3>Ajouter utilisateur</h3>
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
                                <form class="form-horizontal form-label-left" action="ajoutUser.php" method="POST">
<!--                                    <div id="errMsg">-->
<!--                                        <p style="color: red;"><b>--><?php //if(!empty($_SESSION['errMsg'])) { echo $_SESSION['errMsg']; } ?><!--</b><br/></p>-->
<!--                                    </div>-->
<!--                                    <br>-->
<!--                                    --><?php //unset($_SESSION['errMsg']); ?>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nom <span
                                                class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" required="required" class="form-control "
                                                   name="name" value="<?php echo $name;?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Email
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" name="email" required="required"
                                                   class="form-control" value="<?php echo $email;?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">T??l??phone
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="number" name="tel" required="required"
                                                   class="form-control" value="<?php echo $tel;?>">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Mot de
                                            passe <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">
                                            <input type="text" name="pwd" required="required"
                                                   class="form-control" >
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="number">Role
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 ">

                                            <select class="select2_single form-control" tabindex="-1" name="role"
                                                    required="required">
                                                <option></option>
                                                <option value="1" >
                                                    Admin
                                                </option>
                                                <option value="0" >
                                                    User
                                                </option>

                                            </select>
                                            <!--                                            <input type="text"  name="email" required="required"-->
                                            <!--                                                   class="form-control" value="-->
                                            <?php //echo $user['role']; ?><!--">-->
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="item form-group">
                                        <div class="col-md-6 col-sm-6 offset-md-3">
                                            <input class="btn btn-success" name="submit" type="submit"
                                                   value="Ajouter"/>

                                            <input class="btn btn-primary" name="cancel" type="button" value="Annuler"
                                                   onclick="window.location='listeUser.php';"/>


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

