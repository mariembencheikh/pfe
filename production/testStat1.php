<?php include ('config.php');
$department= $collection_Department->find()->sort(array("nameDep"=>1));
$json1 = [];
$json2=  [];
foreach($department as $dep){
    $json1[]=$dep['nameDep'];
    $json2[]=$dep['number'];
//    echo json_encode($json1);
//    echo json_encode($json2);
}
?>
<html>
<body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>

<canvas id="myChart"></canvas>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {

            labels: <?php echo json_encode($json1);?>,
            datasets: [{
                label: '# of Votes',
                data: <?php echo json_encode($json2);?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {

        }
    });
</script>
</body>
</html>

