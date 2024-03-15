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
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Codigo', 'Cantidad'],
          <?php 
                foreach ($this->rep as $key) {
                    echo "['".$key["codigoRep"]."',".$key["TotalVendido"]."],";
                }
            ?> 
        ]);

        var options = {
          width: 850,
          height: 600,
          legend: { position: 'none' },
          chart: {
            title: 'Stats de Repuestos mas Vendidos',
            subtitle: 'Cantidades' },
          axes: {
            x: {
              0: {label: 'Principales en Ventas'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };
        
        var data2 = new google.visualization.arrayToDataTable([
          ['Codigo', 'Recaudacion($)'],
            <?php 
                $result = $this->rep;
                usort($result, function($a, $b) {
                    return $b['Subtotal'] <=> $a['Subtotal'];
                });
                foreach ($result as $key) {
                    echo "['".$key["codigoRep"]."',".$key["Subtotal"]."],";
                }
            ?> 
        ]);
        

        var options2 = {
          height: 600,
          width: 850,
          legend: { position: 'none' },
          chart: {
            title: 'Stats de Repuestos Con Mayor Recaudacion',
            subtitle: 'Monto en Dolares' },
          axes: {
            x: {
              0: {label: 'Principales en Ventas'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" },
        };

        var chart = new google.charts.Bar(document.getElementById('statsporcantidades'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));

        var chart2 = new google.charts.Bar(document.getElementById('statspordolares'));
        // Convert the Classic options to Material options.
        chart2.draw(data2, google.charts.Bar.convertOptions(options2));
      };

      $(document).ready(function(){
            $("#searchStats").submit(function(e){

              e.preventDefault(); // Evita que el formulario se envíe normalmente
                var parametro1 = $("#cantidadNotas").val(); 
                var parametros = {
                    "cantidadNotas": parametro1
                };

                    $.ajax({
                    data:  parametro1,
                    url:   '../consulta/searchStatsRepuestos',
                    type:  'post',
                    success:  function (response) {                 
                      var newData = google.visualization.arrayToDataTable([
                        ['Codigo', 'Cantidad'],
                      ]);
                      
                      for (var i = 0; i < response.length; i++) {
                          var codigo = response[i][0]; // Primer campo: Código
                          var cantidad = response[i][1]; // Segundo campo: Cantidad
                          console.log(cantidad);
                          newData.addRow([codigo, cantidad]);
                      }
                      var options2 = {
                        height: 600,
                        width: 850,
                        legend: { position: 'none' },
                        chart: {
                          title: 'Stats de Repuestos Con Mayor Recaudacion',
                          subtitle: 'Monto en Dolares' },
                        axes: {
                          x: {
                            0: {label: 'Principales en Ventas'} // Top x-axis.
                          }
                        },
                        bar: { groupWidth: "90%" },
                      };
                      var chart2 = new google.charts.Bar(document.getElementById('statspordolares'));
                      chart2.draw(newData, google.charts.Bar.convertOptions(options2));
                    },
                    error:function(){
                        alert("error")
                    }
                });
              
            });

        });

    
    </script>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center>
    <div class="card col-md-12">
        <div class="card-header bg-primary mt-2">
            <h3 class="text-center text-white font-weight-bold">Estadisticas de Ventas</h3>
        </div>
        <div class="card-body">

            <div class="text-center text-black h4 font-weight-bold mb-4">Estadisticas Generales:</div>
            <div class="row">
            <form id="searchStats" action="" method="post">
              <input type="text" name="cantidadNotas" id="cantidadNotas"> <!-- Cambia el nombre aquí -->
              <input type="submit" value="Buscar">
            </form>
            </div>
            <div class="row mt-4">
                
                    <div class="col-md-6" id="statsporcantidades"></div>
                
                    <div class="col-md-6" id="statspordolares"></div>
                
            </div>
    
        </div>

        <div class="card-footer"><br>
    
        </div>
    </div>
    <br><br>
    
</body>
</html>