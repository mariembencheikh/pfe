<?php include ('config.php');
$salaire= $collection_salaire->find()->sort(array("department"=>1));
$department= $collection_Department->find()->sort(array("nameDep"=>1));
$dep=[];
$totSalH=[];
$totSalB=[];
$totSalM=[];
foreach ($department as $d){
    $dep[]= $d['nameDep'];
}

$a = array();

foreach ($salaire as $item) {
    array_push($a, $item);
}
foreach ($department as $d) {
$TotSaison1=0;
$TotSaison2=0;
$TotSaison3=0;
    $depp = $d['nameDep'];
    for ($j = 0; $j < count($d['interval']); $j++) {


        $i = 0;
        $filtre_interval = array();
        $interval = $d['interval'][$j]['n1'] . " - " . $d['interval'][$j]['n2'];
        $filtre_interval = array_filter($a, function ($p) use ($interval, $depp) {
            return (($p["interval"] == $interval) && $p['department'] == $depp);
        });
        while ($i < count($a)) {

            $TotSaison1 += $filtre_interval[$i]['salaireTotale']['haute'];
            $TotSaison2 += $filtre_interval[$i]['salaireTotale']['moyenne'];
            $TotSaison3 += $filtre_interval[$i]['salaireTotale']['basse'];


            $i++;
        }
    }
    $totSalH[]=$TotSaison1;
    $totSalM[]=$TotSaison2;
    $totSalB[]=$TotSaison3;

}


?>
<html>
<body>
<!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>-->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="../vendors/Chart.js/dist/Chart.min.js"></script>

<!-- Custom Theme Scripts -->
<!--<script src="../build/js/custom.min.js"></script>-->

<canvas id="mybarChart"></canvas>
<script>
    if ($('#mybarChart').length) {

        var ctx = document.getElementById("mybarChart");
        var mybarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dep);?>,
                datasets: [{
                    label: '# Haute saison',
                    backgroundColor: "#26B99A",
                    data: <?php echo json_encode($totSalH);?>,
                },

                    {
                        label: '# Boyenne saison',
                        backgroundColor: "#03586A",
                        data: <?php echo json_encode($totSalM);?>,
                    },
                    {
                        label: '# Basse saison',
                        backgroundColor: "#BDC3C7",
                        data: <?php echo json_encode($totSalB);?>,
                    },]
            },

            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    }
</script>
</body>
</html>

