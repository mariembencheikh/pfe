<?php
include("config.php");
session_start();
$UserConnect = $collection->findOne(array("email" => $_SESSION['email']));

?>
<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<body>
<div class="navbar nav_title" style="border: 0;">
    <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="images/img.jpg" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome</span>
        <h2><?php echo $UserConnect['name'] ?></h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">


            <li><a><i class="fa fa-table"></i> Paramétrage <span class="fa fa-chevron-down"></span></a>
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
                    <li><a>Intervalle  des clients<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li class="sub_menu"><a href="interval.php">Voir</a>
                            </li>
                            <li><a href="nbClients.php">Ajouter </a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="table.php">Echelle</a>
                    <li><a href="depSalaire.php">Couts salariale</a>
<!--                        <ul class="nav child_menu">-->
<!--                            <li class="sub_menu"><a href="table.php">Add</a>-->
<!--                            </li>-->
<!--                            <li><a href="listeNbPersonnel.php">Show </a>-->
<!--                            </li>-->
<!--                        </ul>-->
                    </li>
                    </li>
<!--                    <li><a href="nbClients.php">Interval</a></li>-->

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