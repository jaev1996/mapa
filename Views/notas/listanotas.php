<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Listado de Notas</title>
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
    <script type="text/javascript">
        $(document).ready(function(){
        
        $('.ir-arriba').click(function(){
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });

        $(window).scroll(function(){
            if( $(this).scrollTop() > 0 ){
                $('.ir-arriba').slideDown(300);
            } else {
                $('.ir-arriba').slideUp(300);
            }
        });

        });
    </script>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center>
    <div class="card col-md-10">
        <div class="card-header bg-primary mt-2">
            <h2 class="text-center text-white font-weight-bold">Listado de Notas de Entrega(Ulitmas 50 Ventas)</h2>
        </div>
        <div class="card-body">

        <div class="row justify-content-center">
                <div class="card col-4">
                    <div class="card-body">
                        <form class="" action="<?php echo constant('URL'); ?>notas/verListadoNotas/" method="post">
                            <label class="font-weight-bold" for="">Buscar Por Nro de Nota:</label>
                            <input class="form-control form-control-sm col-8" type="text" name="codigoVenta" id="" required="true">
                            <input type="submit" class="btn btn-sm btn-success mt-2" value="Buscar">
                            
                        </form>
                    </div>            
                </div>
                <div class="card col-6">
                    <div class="card-body">
                        <form class="" action="<?php echo constant('URL'); ?>notas/verListadoNotas/" method="post">
                            <label class="font-weight-bold" for="">Buscar Por Fecha:</label><br>
                            <div class="form-row">
                            <label for="">Desde:</label>
                            <input class="form-control form-control-sm col-4 ml-2" type="date" name="fechaInicio" value="<?php echo date("Y-m-d") ?>" id="" required="true">
                            <label class="ml-4" for="">Hasta:</label>
                            <input class="form-control form-control-sm col-4 ml-2" type="date" name="fechaFinal" value="<?php echo date("Y-m-d") ?>" id="" required="true"> 
                            </div>
                            <input type="submit" class="btn btn-sm btn-success mt-2" value="Filtrar">
                            
                        </form>
                    </div>
                </div>
        </div><br>  
        <span class="ir-arriba">UP</span>



                    <table class="col-md-10 table table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Nro de Nota</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Tipo de Pago</th>
                                <th>Total de la Venta($)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-bold">
                    <?php
                    include_once 'Models/ventas.php';
                    $total = 0;
                    foreach ($this->ventas as $row) {
                        $venta = new Ventas();
                        $venta = $row;
                        $total += $venta->totalVenta;
                            ?>
                                <tr>
                                    <td><?php echo "# ".$venta->codigoVenta; ?></td>
                                    <td><?php echo $venta->fecha; ?></td>
                                    <td><?php echo $venta->nombreCliente; ?></td>
                                    <td><?php echo $venta->nombreVendedor; ?></td>
                                    <td><?php echo $venta->tipoPago; ?></td>                
                                    <td class="text-center"><?php echo $venta->totalVenta; ?></td>                
                                    <td><a class="btn btn-sm btn-info mt-2 mb-2" href="<?php echo constant('URL')."notas/verNota/".$venta->codigoVenta; ?>">Ver Detalles</a></td>                
                                </tr>
                            <?php
                    }
                    ?> 


                    </tbody>
                    </table>
                    <div class="row justify-content-center">
                        <div class="col-4 ">
                        <label class="font-weight-bold" for="">DESPACHO: <?php echo $total * 0.065 ; ?></label>
                        </div>
                        <div class="col-4 ">
                        <label class="font-weight-bold" for="">COMISION V. <?php echo $total * 0.05 ; ?></label>
                        </div>
                        <div class="col-4 ">
                        <label class="font-weight-bold" for="">TOTAL: <?php echo $total; ?></label>
                        </div>
                    </div>

        </div>

        <div class="card-footer"><br>
        <?php 
        if (isset($_POST['codigoVenta']) || isset($_POST['fechaInicio'])) {
        ?>
        <a class="btn btn-sm btn-danger mt-2 mb-2" href="<?php echo constant('URL')."notas/verListadoNotas/";?>">Volver</a>               
        <?php
        }
        ?>
        </div>
    </div>
    <br><br>
    
</body>
</html>