<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Inventario de Repuestos</title>
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
            <h2 class="text-center text-white font-weight-bold">Repuestos Disponibles</h2>
        </div>
        <div class="card-body">

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card col-3 float-right">
                    <div class="card-body">
                        <form class="" action="<?php echo constant('URL'); ?>consulta/showDetalle/" method="post">
                            <label for="">Buscar Por Codigo:</label>
                            <input class="form-control form-control-sm col-8" type="text" name="codigoRep" id="" required="true">
                            <input type="submit" class="btn btn-sm btn-success mt-2" value="Buscar">
                            
                        </form>
                    </div>            
                </div>
                <div class="card col-4 float-right">
                    <div class="card-body">
                        <form class="" action="<?php echo constant('URL'); ?>consulta/showType/" method="post">
                            <label for="">Buscar Por Tipo:</label>
                            <select class="form-control form-control-sm col-12" name="tipoRep" id="">
                            
                                <?php 
                                    include_once 'Models/tipo.php';
                                    
                                    foreach ($this->tipo as $row) {
                                        $tipo = new Tipo();
                                        $tipo = $row;
                                        echo '<option value="'.$tipo->idTipo.'">'.$tipo->descripTipo.'</option>';
                                    }
                                    ?>
                            </select>
                            <input type="submit" class="btn btn-sm btn-success mt-2" value="Filtrar">
                            
                        </form>
                    </div>
                </div>

                <div class="card col-4 float-right">
                    <div class="card-body">
                        <div class="form-row justify-content-center mb-3">
                            <form action="<?php echo constant('URL'); ?>consulta/printInventario/" method="post">
                
                                <input type="text" name="fecha" hidden="true" value="<?php echo date("j-M-Y"); ?>">
                                <input type="number" name="tipo" hidden="true" value="0">
                                <input type="submit" class="btn btn-sm btn-success mr-4" value="Inventario Disponible">
                            </form>
                            <form action="<?php echo constant('URL'); ?>consulta/printInventario/" method="post">
            
                            <input type="number" name="tipo" hidden="true" value="1">
                            <input type="text" name="fecha" hidden="true" value="<?php echo date("j-M-Y"); ?>">
                            <input type="submit" class="btn btn-sm btn-success" value="Inventario Total"><br>
                            </form>
                        </div>
                            <?php  
                $totalRep = 0;
                $totalLub = 0;
                $valRep = 0;
                $valLub = 0;

                foreach ($this->tipo as $row) {
                    $tipo = new Tipo();
                    $tipo = $row;
                    ?>
                    <?php

                    foreach ($this->repuesto as $row) {
                        $repuesto = new Repuesto();
                        $repuesto = $row;
                        if ($repuesto->idTipo == $tipo->idTipo) {
                            if ($repuesto->cantidadRep > 0) {
                                if ($tipo->descripTipo != "LUBRICANTES LAMBORGHINI") {
                                    
                                    $valRep += $repuesto->cantidadRep * $repuesto->precioRep;
                                    $totalRep = $valRep;
                                }else {
                                    
                                    $valLub += $repuesto->cantidadRep * $repuesto->precioRep;
                                    $totalLub = $valLub;
                                }
                            
                            }
                        }
                    }
                    }
                    ?>  
                        <p class="text-center h6"><?php echo "INVENTARIO DE REPUESTOS: ".$totalRep."$";  ?></p>
                        <p class="text-center h6"><?php echo "INVENTARIO DE LUBRICANTES: ".$totalLub."$";  ?></p>

                    </div>
                </div>
            </div>
                
        </div>
    
            <?php  
                foreach ($this->tipo as $row) {
                    $tipo = new Tipo();
                    $tipo = $row;
                    ?><br>
                    <h2><?php echo $tipo->descripTipo; ?></h2>
                    <span class="ir-arriba">UP</span>

                    <table class="col-md-12 table table-primary table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Codigo de Repuesto</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>Cantidad</th>
                                <th>Precio($)</th>
                                <th>Ubicacion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-bold">
                    <?php

                    foreach ($this->repuesto as $row) {
                        $repuesto = new Repuesto();
                        $repuesto = $row;
                        if ($repuesto->idTipo == $tipo->idTipo) {
                            if ($repuesto->cantidadRep > 0) {
                            $val = number_format($repuesto->precioRep,2,'.','')
                            ?>
                                <tr>
                                    <td><?php echo $repuesto->codigoRep; ?></td>
                                    <td><?php echo $repuesto->descripRep; ?></td>
                                    <td><?php echo $repuesto->idMarca; ?></td>
                                    <td class="text-center"><?php echo $repuesto->cantidadRep; ?></td>
                                    <td><?php echo $val;//$repuesto->precioRep; ?></td>                
                                    <td><?php echo $repuesto->ubicRep; ?></td>
                                    <td><a class="btn btn-sm btn-info mt-2 mb-2" href="<?php echo constant('URL')."actualizar/actualizarep/".$repuesto->codigoRep; ?>">Editar</a></td>                
                                </tr>
                            <?php
                            }
                        }
                    }
                    ?>
                    </tbody>
                    </table>
                    <?php
                }
            ?>
        </div>

        <div class="card-footer"><br></div>
    </div>
    <br><br>
    
</body>
</html>