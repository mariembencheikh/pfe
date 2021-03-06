<?php
include("config.php");
session_start();
$cursor = $collection_coutFixe->find();
$UserConnect = $collection->findOne(array("email" => $_SESSION['email']));

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
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Cout fixe</h2>
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
                                                    <th>Note RBE</th>
                                                    <th>Cout</th>
                                                    <?php if($UserConnect['role']==1){?>
                                                        <th>Cr??ee par</th>
                                                        <th>Date de cr??ation</th>
                                                        <th>Derni??re modification par</th>
                                                        <th>Date et heure de  modification</th>
                                                    <?php }?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $cursor = $collection_coutFixe->find();
                                                foreach ($cursor as $c) {?>
                                                    <tr>
                                                        <td>TFP & FOPROLOS</td>
                                                        <td><?php echo $c['foprolos'];?>&nbsp;%</td>
                                                        <?php if($UserConnect['role']==1){?>
                                                            <td><?php echo $c['createdBy'];?></td>
                                                            <td><?php echo $c['time']['date'];?></td>
                                                            <td><?php echo $c['modifiedBy'];?></td>
                                                            <td><?php echo $c['editTime']['date'];?></td>
                                                        <?php }?>
                                                    </tr>

                                                    <tr>
                                                        <td>Charge sociale patronale</td>
                                                        <td><?php echo $c['chargePat'];?>&nbsp;%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provision Prime</td>
                                                        <td><?php echo $c['prime'];?>&nbsp;%</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provision cong??</td>
                                                        <td><?php echo $c['conge'];?>&nbsp;%</td>
                                                    </tr>



                                                    <?php

                                                }
                                                ?>
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
    function sure()
    {
        return(confirm('Etes-vous s??r de vouloir supprimer cette fonction ?'));
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