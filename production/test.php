<?php
include ('config.php');
$tabMois = array('janvier','fevrier','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre');
$currentSaison = $collection_saison->findOne(array('typeS' => $_GET['saison']));
$liste= $collection_saison->find();
$tab=array();
$mois=array();
foreach ($liste as $l){
    for($i=0;$i<count($l['listeM']);$i++){
        array_push($tab,$l['listeM'][$i]);
    }
}

    for($j=0;$j<count($currentSaison['listeM']);$j++) {
        array_push($mois, $currentSaison['listeM'][$j]);
    }
$tabMois = array_diff($tabMois, $tab);
?>

    <?php  foreach ($mois as $m){?>
        <div class="checkbox">
            <label>
                <input type="checkbox" class="flat" checked="checked" name="listeM[]" value="<?php echo $m;?>"/> <?php echo $m;?>
            </label>
        </div>
        <?php
    }
    ?>
    <?php  foreach ($tabMois as $t){?>
        <div class="checkbox">
            <label>
                <input type="checkbox" class="flat"   name="listeM[]" value="<?php echo $t;?>" /> <?php echo $t;?>
            </label>
        </div>
    <?php
    }
    ?>




<!--</select><select class="select2_single form-control" tabindex="-1" name="listeM[]" required multiple size="12">-->
<!--    --><?php // foreach ($mois as $m){?>
<!--        <option value="--><?php //echo $m;?><!--"selected>--><?php //echo $m;?><!--</option>-->
<!--        --><?php
//    }
//    ?>
<!--    --><?php // foreach ($tabMois as $t){?>
<!--        <option value="--><?php //echo $t;?><!--" >--><?php //echo $t;?><!--</option>-->
<!--    --><?php
//    }
//    ?>
<!---->
<!---->
<!---->
<!---->
<!---->
<!--</select>-->











