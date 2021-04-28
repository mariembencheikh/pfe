<?php
include("config.php");
session_start();
$UserConnect = $collection->findOne(array("email" => $_SESSION['email']));
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
    <div class="profile_pic">
        <img src="images/img.jpg" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">

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

            <li><a><i class="fa fa-desktop"></i>  Paramétrage <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a>Départments<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="departments.php">Liste des départements</a>
                            </li>
                            <li><a href="ajoutDepartment.php">Ajouter département</a>
                            </li>
                        </ul>
                    </li>
                    </li>
                    <li><a>Fonctions<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="employees.php">Liste des fonctions</a>
                            </li>
                            <li><a href="ajoutFunction.php">Ajouter fonction</a>
                            </li>
                        </ul>
                    </li>
                    </li>
                    <li><a href="coutsFixes.php">Les couts fixes</a></li>
                    <li><a href="saison.php">Saisons</a></li>
                    <!--                    <li><a>Saisons<span class="fa fa-chevron-down"></span></a>-->
                    <!--                        <ul class="nav child_menu">-->
                    <!--                            <li class="sub_menu"><a href="voirSaison.php">Voir</a>-->
                    <!--                            </li>-->
                    <!--                            <li><a href="saison.php">Ajouter </a>-->
                    <!--                            </li>-->
                    <!--                        </ul>-->
                    <!--                    </li>-->
                    <!--                    <li><a>Echelle<span class="fa fa-chevron-down"></span></a>-->
                    <!--                        <ul class="nav child_menu">-->
                    <!--                            <li class="sub_menu"><a href="table.php">Par jour</a>-->
                    <!--                            </li>-->
                    <!--                            <li><a href="table.php">Par saison</a>-->
                    <!--                            </li>-->
                    <!--                        </ul>-->
                    <!--                    </li>-->
                    <li><a href="table.php">Echelle</a></li>

                    </li>
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