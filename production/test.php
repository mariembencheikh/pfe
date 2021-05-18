<?php
include('config.php');
$tabMois = array('janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre');
$currentSaison = $collection_saison->findOne(array('typeS' => $_GET['saison']));
$liste = $collection_saison->find();
$tab = array();

foreach ($liste as $l) {
    for ($i = 0; $i < count($l['listeM']); $i++) {
        array_push($tab, $l['listeM'][$i]);
    }
}

foreach ($tab as $item) {
    for ($j = 0; $j < count($currentSaison['listeM']); $j++) {
        if ($currentSaison['listeM'][$j] == $item) {
            $tab = array_diff($tab, $currentSaison['listeM']);
        }
    }
}

?>

<?php foreach ($tabMois as $t) { ?>
    <div class="col-md-9 col-sm-9 ">
        <div class="checkbox">
            <label>
                <input type="checkbox" class="flat" name="listeM[]" value="<?php echo $t; ?>"
                    <?php
                    for ($j = 0; $j < count($currentSaison['listeM']); $j++) {
                        if ($currentSaison['listeM'][$j] == $t) {
                            ?>
                            checked="checked"
                        <?php }
                    }
                    foreach ($tab as $item) {
                        if ($item == $t) {
                            ?>
                            disabled="disabled"
                            <?php
                        }


                    } ?>
                />
                <?php echo $t; ?>

            </label>

        </div>
    </div>
    <?php
}
?>

<div class="item form-group">
    <label class="col-form-label col-md-3 col-sm-3 label-align">Nb jours</label>
    <div class="col-md-6 col-sm-6 offset-md-5 ">
        <input style="height: 40px;width: 75px" disabled value="<?php echo $currentSaison['days']; ?>">
    </div>
</div>

<!--        <div class="item form-group">-->
<!--            <label class="col-form-label col-md-3 col-sm-3 label-align">Total de jours</label>-->
<!--    <div class="col-md-6 col-sm-6 offset-md-5">-->
<!--        <input style="height: 35px;width: 75px" disabled value="--><?php //echo $currentSaison['days']; ?><!--">-->
<!--    </div>-->
<!--</div>-->



















