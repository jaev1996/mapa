<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Lista de Clientes</title>
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

            $("#searchTxtCli").keyup(function(){
                var parametro1 = $(this).val();
                var parametro2 = $("#searchSelectVend").val(); 
                if (parametro2 == '0') {
                    parametro2 = null;
                }
                console.log(parametro2)
                var parametros = {
                    "searchSelectVend": parametro2,
                    "searchTxtCli": parametro1
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
    </script>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center>
    <div class="card col-md-10">
        <div class="card-header bg-primary mt-2">
            <h2 class="text-center text-white font-weight-bold">Lista de Clientes</h2>
        </div>
        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card col-6 float-right">
                        <div class="card-body">
                            <form class="" method="post">
                                <label for="">Buscar Cliente Por Nombre:</label>
                                <input class="form-control form-control-sm col-8" type="text" name="codigoRep" id="searchTxtCli" value="">
                                
                            </form>
                        </div>            
                    </div>
                    <div class="card col-6 float-right">
                        <div class="card-body">
                            <form class="" method="post">
                                <label for="">Seleccione el Vendedor</label>
                                <select class="form-control form-control-sm col-12" name="tipoRep" id="searchSelectVend">
                                    <option value="null" selected>-- Seleccionar --</option>
                                
                                    <?php 
                                        include_once 'Models/vendedor.php';
                                        
                                        foreach ($this->vendedores as $row) {
                                            $vendedor = new Vendedor();
                                            $vendedor = $row;
                                            echo '<option value="'.$vendedor->idVendedor.'">'.$vendedor->nombreVendedor.'</option>';
                                        }
                                        ?>
                                </select>
                                
                            </form>
                        </div>
                    </div>
                </div>
                    
            </div>
            <br>
            <br>

            <div class="row col-md-10 justify-content-center">
                
                <table class="col-md-12 table table-sm table-bordered text-dark table-hover">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>Nombre del Cliente</th>
                            <th>Identificacion</th>
                            <th>Direccion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="font-weight-bold salida">
                        
                    </tbody>
                </table>
            </div>
    
        </div>

        <div class="card-footer"><br></div>
    </div>
    <br><br>
    
</body>
</html>