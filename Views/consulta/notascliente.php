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
            <?php 
                foreach ($this->rep as $key) {
                    echo "['".$key["codigoRep"]."',".$key["TotalVendido"]."],";
                }
            ?> 
            ]);

            var options = {
            title: 'Repuestos Mas Solicitados',
            is3D: true,
            legendTextStyle: { fontSize: 12 }
            };

            var data2 = google.visualization.arrayToDataTable([
            ['Codigo Repuesto', 'Monto Facturado'],
            <?php 
                foreach ($this->rep as $key) {
                    echo "['".$key["codigoRep"]."',".$key["Subtotal"]."],";
                }
            ?> 
            ]);

            var options2 = {
            title: 'Porcetajes de Facturacion',
            is3D: true,
            legendTextStyle: { fontSize: 12 }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

            chart.draw(data, options);
            chart2.draw(data2, options2);
            
        }
    </script>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center>
    <div class="card col-md-10">
        <div class="card-header bg-primary mt-2">
            <h3 class="text-center text-white font-weight-bold"><?php echo $this->cliente["nombreCliente"]; ?></h3>
        </div>
        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card col-6 float-right">
                        <div class="card-body">
                            <form class="" method="post">
                               
                               
                                
                            </form>
                        </div>            
                    </div>
                    <div class="card col-6 float-right">
                        <div class="card-body">
                            <form class="" method="post">
                               
                               
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
                
                <div class="text-center text-black h4 font-weight-bold mb-4">Estadisticas Generales del Cliente:</div>
                
                <div class="">
                    <ul class="list-group list-group-flush font-weight-bold">
                        <li class="list-group-item">Tiene 
                            <?php
                                if ($this->anios == 0) {
                                    echo $this->meses." Meses Comprandonos"; 
                                }elseif ($this->anios == 1) {
                                    echo $this->anios." Año y ".$this->meses." Meses Comprandonos"; 
                                }else {
                                    echo $this->anios." Años y ".$this->meses." Meses Comprandonos"; 
                                }
                            ?>
                            y ha Concretado <?php echo $this->cantidadVentas; ?> Compras.
                        </li>
                        <li class="list-group-item">Tiene una Media de 
                            <?php 
                                echo $promedio = number_format($this->totalVentas/$this->cantidadVentas, 2, ',', '.'); 
                            ?>$$ Por Pedido
                        </li>
                        <li class="list-group-item">Promedia: 
                            <?php 
                                echo $this->promedios["mensual"]." pedidos por Mes y ".$this->promedios["trimestral"]; 
                            ?> Cada 3 Meses.
                        </li>
                        <li class="list-group-item">Fecha Estimada Para Siguiente Pedido: <?php echo $this->fechaProximoPedido; ?></li>
                        <li class="list-group-item">Fecha Ultima Compra: <?php echo $this->fechaUltimaVenta; ?></li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-6" id="piechart" style="width: 1200px; height: 350px;"></div>
                </div>
                <div class="row">
                    <div class="col-md-6" id="piechart2" style="width: 1200px; height: 350px;"></div>
                </div>
                   
            </div>
    
        </div>

        <div class="card-footer"><br>
        <?php 
        var_dump($this->cantidadVentas);
        var_dump($this->totalVentas);
        var_dump($this->anios);
        var_dump($this->meses);
        
        ?>
        </div>
    </div>
    <br><br>
    
</body>
</html>