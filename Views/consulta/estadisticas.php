<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Estadisticas</title>
    <style type="text/css" src="">
        .re{
         resize: none;
        }
    </style>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center>
    <div class="card col-md-12">
        <div class="card-header bg-primary mt-2">
            <h2 class="text-center text-white font-weight-bold">Resumen Estadistico de Ventas Por Repuesto</h2>
        </div>
        <div class="card-body">
        <h3>Filtrar Informacion de Ventas</h3>

        <div class="row">
            <div class="col-md-4 border-right">
                <p class="h4">Filtrar por Rango de Mes</p><br>
                <form action="<?php echo constant('URL'); ?>consulta/verEstadisticas" method="post">
                    <div class="row">
                        <div class="col-md-4">
                        <label for="desde">DESDE:</label>
                            <select class="form-control" name="desdeMes" id="desde">
                                <option value="01-01">ENERO</option>
                                <option value="02-01">FEBRERO</option>
                                <option value="03-01">MARZO</option>
                                <option value="04-01">ABRIL</option>
                                <option value="05-01">MAYO</option>
                                <option value="06-01">JUNIO</option>
                                <option value="07-01">JULIO</option>
                                <option value="08-01">AGOSTO</option>
                                <option value="09-01">SEPTIEMBRE</option>
                                <option value="10-01">OCTUBRE</option>
                                <option value="11-01">NOVIEMBRE</option>
                                <option value="12-01">DICIEMBRE</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                        <label for="hasta">HASTA:</label>
                            <select name="hastaMes" class="form-control" id="hasta">
                                <option value="01-31">ENERO</option>
                                <option value="02-29">FEBRERO</option>
                                <option value="03-31">MARZO</option>
                                <option value="04-30">ABRIL</option>
                                <option value="05-31">MAYO</option>
                                <option value="06-30">JUNIO</option>
                                <option value="07-31">JULIO</option>
                                <option value="08-31">AGOSTO</option>
                                <option value="09-30">SEPTIEMBRE</option>
                                <option value="10-31">OCTUBRE</option>
                                <option value="11-30">NOVIEMBRE</option>
                                <option value="12-31">DICIEMBRE</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                        <label for="year">AÑO:</label><br>
                            <select class="form-control" name="year" id="year">
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
				<option value="2022">2022</option>
                            </select>
                        </div>
                        <br>
                        
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                        <select class="form-control col-md-8" name="tipoRep" id="tipo">
                            <option value="All">------Todo------</option>
                            <?php
                                foreach ($this->tipo as $row) {
                                    $tipo1 = new Tipo();
                                    $tipo1 = $row;
                                    ?>
                                    <option value="<?php echo $tipo1->descripTipo;?>"><?php echo $tipo1->descripTipo;?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        </div>
                    </div>
                    <br>
                    <input class="btn btn-success" type="submit" value="FILTRAR">
                </form>
            </div>
            <div class="col-md-4 border-right">
                <p class="h4">Filtrar por Repuesto</p>
                <form action="<?php echo constant('URL'); ?>consulta/verEstadisticas" method="post">
                <br>
                        <div class="col-md-8">
                            <label for="codigo">Codigo del Repuesto</label>
                            <input type="text" class="form-control" name="codigoRep" id="codigo" required>
                        </div>
                        <br>
                    <input class="btn btn-success" type="submit" value="FILTRAR">

                </form>
            </div>
            <div class="col-md-4">
                <p class="h4">Filtrar por Tipo de Repuesto</p>
                <br>
                <form action="<?php echo constant('URL'); ?>consulta/verEstadisticas" method="post">

                <label for="tipoRep">Seleccionar Tipo de Repuesto</label><br>
                <select class="form-control col-md-8" name="tipoRep" id="tipo">
                    <?php
                        foreach ($this->tipo as $row) {
                            $tipo1 = new Tipo();
                            $tipo1 = $row;
                            ?>
                            <option value="<?php echo $tipo1->idTipo;?>"><?php echo $tipo1->descripTipo;?></option>
                            <?php
                        }
                    ?>
                </select><br>
                <input class="btn btn-success" type="submit" value="FILTRAR">
                </form>

            </div>
        </div>
    
            <?php  
            if ($this->xview == 0) {
                $mostrar = $this->mostrar;
            //CUANDO SE BUSCA POR FECHA Y LA PAGINA EN GENERAL
                foreach ($this->tipo as $row) {
                    $tipo = new Tipo();
                    $tipo = $row;
                    if ($tipo->descripTipo == $mostrar) {
                    ?><br>
                    <h2><?php echo $tipo->descripTipo; ?></h2>
                    <table class="col-md-8 table table-primary table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Codigo de Repuesto</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>Cant. Vendida</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-bold">
                    <?php
                    $i=0;
                    $codigoRep = [];
                    $cantidadRep = [];
                    $descripRep = [];
                    $idMarca = []; 
                    foreach ($this->repuesto as $row) {
                        $repuesto = new Repuesto();
                        $repuesto = $row;
                        if ($repuesto->idTipo == $tipo->idTipo) {

                            $codigoRep[$i]   = $repuesto->codigoRep;
                            $cantidadRep[$i] = $repuesto->cantidadRep;
                            $descripRep[$i]  = $repuesto->descripRep;
                            $idMarca[$i]     = $repuesto->idMarca;
                            $i++;     
                        }
                    }

                    $count = count($cantidadRep);
                    for($i=1; $i<$count; $i++){
                      //auxiliares
                      $tmp      = $cantidadRep[$i];
                      $tmpCod   = $codigoRep[$i];
                      $tmpDescrip = $descripRep[$i];
                      $tmpMarca = $idMarca[$i];
                      
                      for ($j=$i-1; $j>=0 && $cantidadRep[$j] < $tmp; $j--){
                        $cantidadRep[$j+1] = $cantidadRep[$j];
                        $codigoRep[$j+1] = $codigoRep[$j];
                        $descripRep[$j+1] = $descripRep[$j];
                        $idMarca[$j+1] = $idMarca[$j];
                        
                        $cantidadRep[$j] = $tmp;
                        $codigoRep[$j] = $tmpCod;
                        $descripRep[$j] = $tmpDescrip;
                        $idMarca[$j] = $tmpMarca;
                      }
                    }
                    for ($i=0; $i < $count ; $i++) {
                    ?>
                        <tr>
                                <td><?php echo $codigoRep[$i]; ?></td>
                                <td><?php echo $descripRep[$i]; ?></td>
                                <td><?php echo $idMarca[$i]; ?></td>
                                <td><?php echo $cantidadRep[$i]; ?></td>                            
                        </tr>
                        <?php 
                    }
                    
                    ?>
                    </tbody>
                    </table>
                    <?php
                    
                }
            }
            }
            ?>

            <?php
            //CUANDO SE BUSCA POR CODIGO
            if ($this->xview == 1) {
            
                ?><br>
                <h2>Datos del Repuesto</h2>
                <table class="col-md-8 table table-primary table-sm table-bordered text-dark table-hover">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th>Codigo de Repuesto</th>
                            <th>Descripcion</th>
                            <th>Marca</th>
                            <th>Cant. Vendida</th>
                        </tr>
                    </thead>
                    <tbody class="font-weight-bold">
                <?php
                foreach ($this->repuesto as $row) {
                
                    $repuesto = new Repuesto();
                    $repuesto = $row;
                        ?>
                            <tr>
                                <td><?php echo $repuesto->codigoRep; ?></td>
                                <td><?php echo $repuesto->descripRep; ?></td>
                                <td><?php echo $repuesto->idMarca; ?></td>
                                <td><?php echo $repuesto->cantidadRep; ?></td>                            
                            </tr>
                        <?php
                }
                ?>
                </tbody>
                </table>
                <?php
                
            }
        ?>
        <?php 
        if ($this->xview == 2) {
            
            ?><br>
            <h2><?php echo $this->tipoRep; ?></h2>
            <table class="col-md-8 table table-primary table-sm table-bordered text-dark table-hover">
                <thead class="bg-primary text-light">
                    <tr>
                        <th>Codigo de Repuesto</th>
                        <th>Descripcion</th>
                        <th>Marca</th>
                        <th>Cant. Vendida</th>
                    </tr>
                </thead>
                <tbody class="font-weight-bold">
            <?php
            $i = 0;
            foreach ($this->repuesto as $row) {
            
                $repuesto = new Repuesto();
                $repuesto = $row;
                    
                $codigoRep[$i]   = $repuesto->codigoRep;
                $cantidadRep[$i] = $repuesto->cantidadRep;
                $descripRep[$i]  = $repuesto->descripRep;
                $idMarca[$i]     = $repuesto->idMarca;
                $i++;     
            }
                $count = count($cantidadRep);
                for($i=1; $i<$count; $i++){
                  //auxiliares
                  $tmp      = $cantidadRep[$i];
                  $tmpCod   = $codigoRep[$i];
                  $tmpDescrip = $descripRep[$i];
                  $tmpMarca = $idMarca[$i];
                  
                  for ($j=$i-1; $j>=0 && $cantidadRep[$j] < $tmp; $j--){
                    $cantidadRep[$j+1] = $cantidadRep[$j];
                    $codigoRep[$j+1] = $codigoRep[$j];
                    $descripRep[$j+1] = $descripRep[$j];
                    $idMarca[$j+1] = $idMarca[$j];
                    
                    $cantidadRep[$j] = $tmp;
                    $codigoRep[$j] = $tmpCod;
                    $descripRep[$j] = $tmpDescrip;
                    $idMarca[$j] = $tmpMarca;
                  }
                }
                for ($i=0; $i < $count ; $i++) {
                ?>
                    <tr>
                            <td><?php echo $codigoRep[$i]; ?></td>
                            <td><?php echo $descripRep[$i]; ?></td>
                            <td><?php echo $idMarca[$i]; ?></td>
                            <td><?php echo $cantidadRep[$i]; ?></td>                            
                    </tr>
                    <?php 
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