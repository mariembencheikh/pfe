<?php
include("config.php");
session_start();
$UserConnect = $collection->findOne(array("email" => $_SESSION['email']));
$cursor = $collection->find();

if ($UserConnect['role'] != "1") {
    header('Location:index.php');
}

if (isset($_GET['id'])) {
    $user = $collection->findOne(array("_id" => $_GET['id']));

    if ($_GET['etat'] == "actif") {
        $new = array('$set' => array('etat' => "1"));
        $collection->update(array("_id" => new MongoId($_GET['id']) ), $new);
    } else {
        $new = array('$set' => array('etat' => "0"));
        $collection->update(array("_id" => new MongoId($_GET['id'])), $new);
    }
    header("location:listeUser.php");
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

    <!-- Bootstrap -->
    <!--    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
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


                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Liste des utilisateurs</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box table-responsive">


                                            <table id="datatable" class="table table-striped table-bordered"
                                                   style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th style="text-align: center;">Nom</th>
                                                    <th style="text-align: center;">Email</th>
                                                    <th style="text-align: center;">Telephone</th>
                                                    <th style="text-align: center;">Mot de passe</th>
                                                    <th style="text-align: center;">Role</th>
                                                    <th style="text-align: center;">Etat</th>
                                                    <th style="text-align: center;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php

                                                $cursor = $collection->find();
                                                foreach ($cursor

                                                as $c) { ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $c['name']; ?></td>
                                                    <td style="text-align: center;"><?php echo $c['email']; ?></td>
                                                    <td style="text-align: center;"><?php echo $c['telephone']; ?></td>
                                                    <td style="text-align: center;"><?php echo $c['password']; ?></td>
                                                    <td style="text-align: center;">
                                                        <?php if ($c['role'] == "1") {
                                                            echo "Admin";
                                                        } else echo "User"; ?>
                                                    </td>

                                                    <td style="text-align: center;" class="last">
                                                        <?php if ($c['etat'] == "1") { ?>

                                                            <label>
                                                                <input type="checkbox" class="js-switch"
                                                                       name="switch"
                                                                       value="<?php echo $c['_id']; ?>"
                                                                       onchange="action(this.value,'desac');"
                                                                       checked="true"

                                                                />
                                                            </label>

                                                        <?php } else { ?>
                                                            <div class="">
                                                                <label>
                                                                    <input type="checkbox" class="js-switch"
                                                                           name="switch"
                                                                           value="<?php echo $c['_id']; ?>"
                                                                           onchange="action(this.value,'actif');"
                                                                    />


                                                                </label>
                                                            </div>
                                                        <?php } ?>
                                                    </td>


                                                    <td style="text-align: center;" class="last">

                                                        <a href="editUser.php?id=<?php echo $c['_id']; ?>"><input
                                                                    type="button" class="btn btn-warning"
                                                                    value="Modifier"/></a>


                                                        <a href="delUser.php?id=<?php echo $c['_id']; ?>"> <input
                                                                    type="button" class="btn btn-danger"
                                                                    value="Supprimer" onclick="return sure();"
                                                                    <?php if ($UserConnect['name'] == $c['name']){ ?>disabled<?php } ?>/></a>

                                                    </td>

                                                    <?php
                                                    }
                                                    $dep = $_SESSION["nameDep"]; ?>
                                                </tbody>
                                            </table>
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
        <footer>
            <!--            <div class="pull-right">-->
            <!--                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
            <!--            </div>-->
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<script>
    function sure() {
        return (confirm('Etes-vous sûr de vouloir supprimer cet utilisateur ?'));
    }

    function action(user_id, etat) {

        window.location = "listeUser.php?id=" + user_id + "&etat=" + etat;

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
