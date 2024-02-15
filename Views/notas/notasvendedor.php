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
    </style>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; 
    $id = $this->id;
    ?>
    <center>
    <div class="card col-md-10">
        <div class="card-header bg-primary mt-2">
            <h2 class="text-center text-white font-weight-bold">Listado de Notas de Entrega(Ulitmas 50 Ventas)</h2>
        </div>
        <div class="card-body">

        <div class="row justify-content-center">
                <div class="card col-6">
                    <div class="card-body">
                        <form class="" action="<?php echo constant('URL'); ?>notas/verNotasVendedor/<?php echo $id; ?>" method="post">
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
                        <label class="font-weight-bold" for="">Porcentaje Pagado al Vendedor: <?php echo $total * 0.05; ?></label>
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
        <a class="btn btn-sm btn-danger mt-2 mb-2" href="<?php echo constant('URL')."notas/verNotasVendedor/";?><?php echo $id; ?>">Volver</a>               
        <?php
        }
        ?>
        </div>
    </div>
    <br><br>
    
</body>
</html>