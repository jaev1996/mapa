<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChart2);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Tareas', 'Horas al Dia'],
            ['Work',     5],
            ['Eat',      1],
            ['Commute',  2],
            ['Watch TV', 0.1],
            ['Sleep',    5]
            ]);

            var options = {
            title: 'Productos Mas Vendidos',
            pieHole: 0.3,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }

        function drawChart2() {

            var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work',     11],
            ['Eat',      2],
            ['Commute',  2],
            ['Watch TV', 2],
            ['Sleep',    7]
            ]);

            var options = {
            title: 'My Daily Activities'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    <title>Ayuda</title>
</head>
<body>
    <?php require_once 'Views/header.php'; ?>
    <h1 class="text-center display-1">Seccion de Ayuda</h1>
    <div class="row">
        <div id="donutchart" class="col-3" style="height: 400px;"></div>
        <div id="piechart" class="col-3" style="height: 400px;"></div>
    </div>
    

    <?php require_once 'Views/footer.php'; ?>

</body>
</html>