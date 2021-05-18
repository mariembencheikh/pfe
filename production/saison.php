<?php
include("config.php");
if (isset($_GET['submit'])) {
    $tabMois = array('janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre');
    $listeM = $_GET['listeM'];
    $typeS = $_GET['typeS'];
    $countDay = array();
    $d = 0;
    foreach ($tabMois as $t) {
        foreach ($listeM as $item) {
            if ($item == $t) {
                $key = array_search($t, $tabMois);
                array_push($countDay, $key);
            }
        }
    }
    for ($i = 0; $i < count($countDay); $i++) {
        $d += cal_days_in_month(CAL_GREGORIAN, $countDay[$i] + 1, 2021);

    }


    $saison = $collection_saison->findOne(array('typeS' => $typeS));

    if (empty($saison)) {

        $collection_saison->insert(array('typeS' => $typeS, 'listeM' => $listeM, 'days' => $d));


        header("Location:saison.php?typeS=$typeS");
    } else {
        $newData = array('$set' => array('listeM' => $listeM, 'days' => $d));
        $collection_saison->update(array('typeS' => $typeS), $newData);

        header("Location:saison.php?typeS=$typeS");
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
    <link href="../vendors/starrr/dist/starrr. css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script src="jquery.min.js"></script>
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
                                    <h3>Saison</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br/>
                                <form class="form-horizontal form-label-left" action="saison.php" method="GET">
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align"> Type saison<span
                                                    class="required">*</span></label>
                                        <div class="col-md-2 col-sm-2 ">
                                            <select id="saison" class="select2_single form-control" tabindex="-1"
                                                    name="typeS"
                                                    required onchange="traitement(this.value);">
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


                                        <div class="col-md-2 col-sm-2 " id="selectM">
                                        </div>
                                        &nbsp;&nbsp;&nbsp;

                                        <div class="item form-group">
                                            <div class="col-md-6 col-sm-6 offset-md-5">
                                                <input class="btn btn-primary" name="submit" id="ok"
                                                       type="submit"
                                                       value="Enregistrer"/>
                                            </div>
                                        </div>
                                </form>
                                &nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    function traitement(saison) {
        $.ajax({
            type: 'GET',
            url: 'test.php?saison=' + saison,
            cache: false,
            beforeSend: function () {
                $('#selectM').html('<center><h1>loading please wait...</h1></center>');
            },
            success: function (retour) {
                $("#selectM").html(retour);

            },
        });
    }

    $(document).ready(function () {
        $('#ok').click(function () {
            checked = $("input[type=checkbox]:checked").length;

            if (!checked) {
                alert("Il faut cocher au moins une case.");
                return false;
            }

        });
    });
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


