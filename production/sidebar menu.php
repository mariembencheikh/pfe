<?php
include("config.php");
session_start();
$UserConnect = $collection->findOne(array("email" => $_SESSION['email']));
$cursor = $collection_coutFixe->find();
$coutFixes = $collection_coutFixe->find();
foreach ($coutFixes as $cout){
    $id=$cout['_id'];
}
if (empty($UserConnect)) {
    header("Location:login.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<body>
<div class="navbar nav_title" style="border: 0;">
    <a href="index.php" class="site_title"> <span>Simulateur RH</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <!--    <div class="profile_pic">-->
    <!--        <img src="images/img.jpg" alt="..." class="img-circle profile_img">-->
    <!--    </div>-->
    <div class="profile_info">

        <span>Bienvenue,</span>
        <h2><?php echo $UserConnect['name'] ?></h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br/>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <?php if ($UserConnect['role'] == 1) { ?>

                <li><a><i class="fa fa-user"></i> Admin <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                        <li><a href="listeUser.php">Liste des utilisateurs</a></li>
                        <li><a href="ajoutUser.php">Ajouter utilisateur</a></li>
                    </ul>
                </li>
            <?php } ?>

            <li><a><i class="fa fa-desktop"></i> Paramétrage <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a>Départements<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="departments.php">Liste des départements</a>
                            </li>
                            <li>
                                <a href="ajoutDepartment.php" <?php if ($UserConnect['etat'] == 0) { ?> onclick="return false;" style="cursor: default;"<?php } ?>>Ajouter
                                    département</a>
                            </li>
                        </ul>
                    </li>

                    <li><a>Fonctions<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="listeFonctions.php">Liste des fonctions</a>
                            </li>
                            <li>
                                <a href="ajoutFunction.php" <?php if ($UserConnect['etat'] == 0) { ?> onclick="return false;" style="cursor: default;"<?php } ?>>Ajouter
                                    fonction</a>
                            </li>
                        </ul>
                    </li>
                    <li><a>Les couts fixes<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="VoircoutsFixes.php">Consulter</a></li>

                            <li class="sub_menu">
                                <a href="editCoutFixe.php?id=<?php echo $id;?>"
                                    <?php if ($UserConnect['etat'] == 0) { ?> onclick="return false;" style="cursor: default;"
                                    <?php } ?>>Modifier</a>
                            </li>
                        </ul>
                    </li>


                    </li>
                    <li><a href="saison.php">Saisons</a>
                    </li>


                    <li><a href="table.php">Echelle</a></li>


                    <li><a>Cout salariale<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="depSalaire.php">Par jour</a>
                            </li>
                            <li><a>Par saison<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu"><a href="totSalHaute.php">Haute</a></li>
                                    <li class="sub_menu"><a href="totSalMoyenne.php">Moyenne</a></li>
                                    <li class="sub_menu"><a href="totSalBasse.php">Basse</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a>Charge Fixe<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="chargeFixe.php">Par jour</a>
                            </li>
                            <li><a>Par saison<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu"><a href="chargeFixeHaute.php">Haute</a></li>
                                    <li class="sub_menu"><a href="chargeFixeMoyenne.php">Moyenne</a></li>
                                    <li class="sub_menu"><a href="chargeFixeBasse.php">Basse</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a>Charge Variable<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="chargeVariable.php">Par jour</a>
                            </li>
                            <li><a>Par saison<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu"><a href="chargeVariableHaute.php">Haute</a></li>
                                    <li class="sub_menu"><a href="chargeVariableMoyenne.php">Moyenne</a></li>
                                    <li class="sub_menu"><a href="chargeVariableBasse.php">Basse</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a>Charge Totale<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="chargeTotale.php">Par jour</a>
                            </li>
                            <li><a>Par saison<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li class="sub_menu"><a href="chargeTotaleHaute.php">Haute</a></li>
                                    <li class="sub_menu"><a href="chargeTotaleMoyenne.php">Moyenne</a></li>
                                    <li class="sub_menu"><a href="chargeTotaleBasse.php">Basse</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>



                </ul>
            </li>
            <li><a><i class="fa fa-calculator"></i> Simulateur <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">

                    <li><a href="simulateur.php">Table simulation</a></li>

                </ul>
            </li>
            <li><a><i class="fa fa-bar-chart-o"></i> Statistique <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">

                    <li><a href="statDepJour.php">Départment par jour</a></li>

                </ul>
            </li>
        </ul>
    </div>
    <!--    <div class="menu_section">-->
    <!--        <h3>Live On</h3>-->
    <!--        <ul class="nav side-menu">-->
    <!--            <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>-->
    <!--        </ul>-->
    <!--    </div>-->

</div>
</body>
</html>