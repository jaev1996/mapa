<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Lista de Notas Por Cliente</title>
    <style type="text/css" src="">
        .re{
         resize: none;
        }
        .ir-arriba {
            display:none;
            padding:25px;
            background:#0275d8;
            font-size:20px;
            color:#fff;
            cursor:pointer;
            position: fixed;
            bottom:20px;
            right:20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function(){
            $("#searchSelectVend").change(function(){
                var parametro1 = $(this).val();
                var parametro2 = $("#searchTxtCli").val(); 
                var parametros = {
                    "searchSelectVend": parametro1,
                    "searchTxtCli": parametro2
                };
                    $.ajax({
                    data:  parametros,
                    url:   '../consulta/searchClientes',
                    type:  'post',
                        beforeSend: function () { },
                        success:  function (response) {                 
                            $(".salida").html(response);
                    },
                    error:function(){
                        alert("error")
                        }
                });
              
            });

        });

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Codigo Repuesto', 'Cantidades'],
            ['B2068',     15],
            ['B2069',      10],
            ['PFS-600',  2],
            ['XS6E-6600-AD', 4],
            ['16100-97405', 3],
            ['16100-B9010', 4],
            ['96293075', 3],
            ['M-83HV',    1]
            ]);

            var options = {
            title: 'Repuestos Mas Solicitados',
            pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

            chart.draw(data, options);
            chart2.draw(data, options);
        }
    </script>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center>
    <div class="card col-md-10">
        <div class="card-header bg-primary mt-2">
            <h2 class="text-center text-white font-weight-bold">Pedidos de <?php echo $this->cliente["nombreCliente"]; ?></h2>
        </div>
        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card col-6 float-right">
                        <div class="card-body">
                            <form class="" method="post">
                                <label for="">Buscar Cliente Por Nombre:</label>
                               
                                
                            </form>
                        </div>            
                    </div>
                    <div class="card col-6 float-right">
                        <div class="card-body">
                            <form class="" method="post">
                                <label for="">Seleccione el Vendedor</label>
                               
                            </form>
                        </div>
                    </div>
                </div>
                    
            </div>

            <div class="row col-md-6 float-right mt-4">
                <div class="text-center text-black h4 font-weight-bold mb-4">Notas Recientes:</div>

                
                <table class="col-md-12 table table-sm table-bordered text-dark table-hover">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>Nro</th>
                            <th>Fecha</th>
                            <th>Tipo de Pago</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="font-weight-bold salida">
                    <?php 
                        foreach ($this->notas as $key) {
                            echo "<tr> <td>".$key["codigoVenta"]."</td> <td>".$key["fechaVenta"]."</td> <td>".$key["tipoPago"]."</td> <td>".$key["estatusVenta"]."</td> <td> <a class='btn btn-sm btn-info mt-2 mb-2' href='#'>Editar</a></td> </tr>";
                        }
                    ?>    
                        
                    </tbody>
                </table>
                
            </div>
            <div class="row col-md-6 float-left mt-4">
                
                <div class="text-center text-black h4 font-weight-bold mb-4">Estadisticas:</div>
                
                <div class="row">
                    <div class="col-md-6" id="piechart" style="width: 1200px; height: 250px;"> holas</div>
                </div>
                <div class="row">
                    <div class="col-md-6" id="piechart2" style="width: 1200px; height: 250px;"></div>
                </div>
                
                
            </div>
    
        </div>

        <div class="card-footer"><br>
            <?php 
                var_dump($this->rep);
            ?>
        </div>
    </div>
    <br><br>
    
</body>
</html>