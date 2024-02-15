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
    </style>
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
                        
                        <form action="<?php echo constant('URL'); ?>consulta/printInventario/" method="post">
                        <?php
                        $ctipos = 0;
                        $rtotales = 0;
                        foreach ($this->tipo as $row) {
                                    $crepuestos=0;
                                    $tipo = new Tipo();
                                    $tipo = $row;
                                    echo '<input type="text" name="idTipo[]" hidden="false" value="'.$tipo->idTipo.'">';
                                    echo '<input type="text" name="descripTipo[]" hidden="false" value="'.$tipo->descripTipo.'">';
                                    foreach ($this->repuesto as $row) {
                                        $repuesto = new Repuesto();
                                        $repuesto = $row;
                                        if ($repuesto->idTipo == $tipo->idTipo) {
                                            $crepuestos++;
                                            if ($rtotales < 10) {
                                               
                                                ?>
                                                <input type="text" name="codigoRep[]" hidden="true" value="<?php echo $repuesto->codigoRep; ?>">
                                                <input type="text" name="descripRep[]" hidden="true" value="<?php echo $repuesto->descripRep; ?>">
                                                <input type="text" name="idMarca[]" hidden="true" value="<?php echo $repuesto->idMarca; ?>">
                                                <input type="number" name="cantidadRep[]" hidden="true" value="<?php echo $repuesto->cantidadRep; ?>">
                                                <input type="number" name="precioRep[]" hidden="true" value="<?php echo $repuesto->precioRep; ?>">                
                                            <?php
                                            $rtotales++;
                                            }
                                        }
                                        
                                    }
                                    echo '<input type="text" name="repeticiones[]" hidden="true" value="'.$crepuestos.'">';
                                    $ctipos++;
                                }
                                echo '<input type="text" name="conteoTipos" hidden="true" value="'.$ctipos.'">';
                                echo '<input type="text" name="rtotales" hidden="true" value="'.$rtotales.'">';
                                
                                ?>
                            <input type="text" name="fecha" hidden="true" value="<?php echo date("j-M-Y"); ?>">
                            <br><input type="submit" class="btn btn-sm btn-success" value="Imprimir Inventario Actual"><br><br><br>
                        </form>
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
                    <table class="col-md-8 table table-primary table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Codigo de Repuesto</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>Cantidad</th>
                                <th>Precio($)</th>
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
                            
                            ?>
                                <tr>
                                    <td><?php echo $repuesto->codigoRep; ?></td>
                                    <td><?php echo $repuesto->descripRep; ?></td>
                                    <td><?php echo $repuesto->idMarca; ?></td>
                                    <td><?php echo $repuesto->cantidadRep; ?></td>
                                    <td><?php echo $repuesto->precioRep; ?></td>                
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