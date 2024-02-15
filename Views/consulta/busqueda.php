<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Busqueda Avanzada</title>
    <style type="text/css" src="">
        .re{
         resize: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function(){
            $("#txtbusca").keyup(function(){
              var parametros="txtbusca="+$(this).val()
              if (parametros.length > 11) {
                $.ajax({
                  data:  parametros,
                  url:   '../consulta/busqueda',
                  type:  'post',
                    beforeSend: function () { },
                    success:  function (response) {                 
                        $(".salida").html(response);
                  },
                  error:function(){
                      alert("error")
                    }
                });
              }
              
            });
        });
    </script>
</head>
<body class="bg-secondary">
    <?php 
    require_once 'Views/header.php'; 
    require_once 'libs/conexionaux.php'
    
    ?>
    <div class="card col-md-12">
        <div class="card-header bg-primary mt-2">
            <h2 class="text-white text-center">Busqueda Avanzada</h2>
        </div>
        <div class="card-body"><br>
            <div class="row justify-content-center">
                <div class="col-md-4 border">
                <center>
                        <label for="">Buscar Por Nombre o Codigo:</label>
                        <input class="form-control form-control-sm col-8" type="text" id="txtbusca">
                </center>
                <br>
                </div>
            </div><br><br>
            <center>
            <table class="col-md-10 table table-primary table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Codigo de Repuesto</th>
                                <th>Descripcion</th>
                                <th>Cantidad</th>
                                <th>Precio($)</th>
                                <th>Ubicacion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-bold salida">
                            
                        </tbody>
            </table>
            </center>
        </div>             
</body>
</html>