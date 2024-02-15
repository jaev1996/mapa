<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Nuevo</title>
    <style type="text/css" src="">
        .re{
         resize: none;
        }
    </style>
</head>
<body>
    <?php 
    if (!isset($_SESSION['cotizacion'])) {
        session_start();
    }
    require_once 'Views/header.php';
    ?>
    <h1 class="text-center display-4">Nueva Cotizaci&oacute;n</h1><center>
    <br>
    <div class="card float-right mr-4 col-md-5">
        <div class="card-header">
            <h3>Lista de Repuestos</h3>
        </div>
        <div class="card-body">
            <table class="col-md-12 text-center table table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Cod.</th>
                                <th>Descripcion...</th>
                                <th>Marca</th>
                                <th>Cant.</th>
                                <th>Precio</th>
                                <th>Sub.To.</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                        require_once 'models/repuesto.php';
                        
                        if (isset($_POST['limpiar'])) {
                            unset($_SESSION['cotizacion']);
                        }

                        if (isset($_POST['eliminarCod'])) {
                            $eliminarCod = $_POST['eliminarCod'];
                            $auxNotaDeEntrega = $_SESSION['cotizacion'];
                            $nuevaNotaDeEntrega = [];
                            foreach ($auxNotaDeEntrega as $row) {
                                if ($row->codigoRep != $eliminarCod) {
                                   array_push($nuevaNotaDeEntrega, $row);
                                }
                            }
                            $_SESSION['cotizacion'] = $nuevaNotaDeEntrega;
                        }
                        if (isset($_POST['precioNew'])) {
                            $codigoRep = $_POST['codigoRep2'];
                            $precioNew = $_POST['precioNew'];
                            $auxNotaDeEntrega = $_SESSION['cotizacion'];
                            $nuevaNotaDeEntrega = [];
                            foreach ($auxNotaDeEntrega as $row) {
                                if ($row->codigoRep != $codigoRep) {
                                   array_push($nuevaNotaDeEntrega, $row);
                                }elseif ($row->codigoRep == $codigoRep) {
                                    $row->precioRep = $precioNew;
                                    array_push($nuevaNotaDeEntrega, $row);
                                } 
                                    
                            }
                            $_SESSION['cotizacion'] = $nuevaNotaDeEntrega;
                        }

                        if(isset($_SESSION['cotizacion'])){
                                $notaDeEntrega = $_SESSION['cotizacion'];
                                foreach ($notaDeEntrega as $row) {
                            ?>
                            <tr>
                                <td><?php echo $row->codigoRep; ?></td>
                                <td><textarea class="form-control form-control-sm" readonly="true" name="descripRep" id="" rows="4"><?php echo $row->descripRep; ?></textarea>
                                </td>
                                <td><?php echo $row->idMarca; ?></td>
                                <td><?php echo $row->cantidadRep; ?></td>
                                <form action="<?php echo constant('URL'); ?>notas/cotizacion" method="post">
                                <td><input class="form-control form-control-sm" name="precioNew" type="text" value="<?php echo $row->precioRep; ?>"></td>
                                <td><?php echo $row->precioRep * $row->cantidadRep; ?></td>
                                <td>
                                <input type="text" name="codigoRep2" value="<?php echo $row->codigoRep; ?>" id="" hidden="true">
                                <input class="btn btn-sm btn-success mb-3" type="submit" value="Actualizar">
                                </form>
                                    <form action="<?php echo constant('URL'); ?>notas/cotizacion" method="post">
                                        <input type="text" name="eliminarCod" value="<?php echo $row->codigoRep; ?>" id="" hidden="true">
                                        <input class="btn btn-sm btn-danger" type="submit" value="Eliminar">
                                    </form>
                                </td>
                            </tr>
                        <?php }} ?>
                        </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row justify-content-center">
            <?php if(isset($_SESSION['cotizacion'])){
                ?>
                <form action="<?php echo constant('URL'); ?>notas/cotizacion" method="post">
                    <input type="text" name="limpiar" value="LIMPIAR" hidden="true">
                    <input class="btn btn-sm btn-warning mr-2" type="submit" value="Limpiar Nota">
                </form>
               
                <form action="<?php echo constant('URL'); ?>notas/cotizar" method="post">
                    <input class="btn btn-sm btn-success" type="submit" value="Realizar Cotizacion">
                </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="card float-right mr-4 col-md-6">
        <div class="card-header">
            <h3>Repuestos Disponibles</h3> 
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-5">
                <form action="<?php echo constant('URL'); ?>notas/cotizacion" method="post">

                    <label class="font-weight-bold" for="">Buscar Por Codigo:</label>
                    <p class="form-inline">
                        <input type="text" name="codigoRep" class="form-control form-control-sm col-md-8">
                        <input type="submit" class="ml-2 btn btn-sm btn-success" value="Buscar">
                    </p>
                </form>
                </div>
                <div class="col-6">
                    <form action="<?php echo constant('URL'); ?>notas/cotizacion" method="post">
                    <label class="font-weight-bold" for="">Listado Por Tipo</label>
                    <p class="form-inline">
                    <select class="form-control form-control-sm col-md-9" name="idTipo" id="">
                        <option value="NULL">Seleccione El Tipo de Repuesto</option>
                            <?php 
                            require_once 'models/tipo.php';
                            $t = $this->tipos;
                            foreach($t as $row){
                                $tipos = new Tipo();
                                $tipos = $row;
                            ?>
                            <option value="<?php echo $tipos->idTipo; ?>"><?php echo $tipos->descripTipo; ?></option>
                            <?php
                            }
                            ?>
                    </select>
                    <input type="submit" class="ml-2 btn btn-sm btn-success" value="Buscar">
                    </p>
                    </form>

                </div>
            </div><br><br>

            <div class="row justify-content-center">

                <?php 
                    if (isset($_POST['idTipo'])) {
                ?>
                <table class="col-md-10 table table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Codigo de Repuesto</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>Disponible</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody class="">
                        <form action="<?php echo constant('URL'); ?>notas/cotizacion" method="post">
                            <?php
                                require_once 'Models/repuesto.php';
                                foreach ($this->repuesto as $row) {
                                $repuesto = new Repuesto();
                                $repuesto = $row;
                                $val = number_format($repuesto->precioRep,2,'.','')
                            ?>
                                <tr>
                                    <td><?php echo $repuesto->codigoRep; ?></td>
                                    <td><?php echo $repuesto->descripRep; ?></td>
                                    <td><?php echo $repuesto->idMarca; ?></td>
                                    <td><?php echo $repuesto->cantidadRep; ?></td>
                                    <td><?php echo $val; ?></td>                
                                    <td class="text-center">
                                    
                                    <input class="form-control form-control-sm" type="number" name="cantidad[]" value="0" id="" required="true">
                                    <input class="form-control form-control-sm" type="text" name="codigoVenta[]" value="<?php echo $repuesto->codigoRep; ?>" id="" hidden="true">
                                    
                                    </td>                
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input type="submit" class="btn btn-sm btn-info mt-2" value="Añadir"></td>
                            </tr>
                    </tbody>
                </table>
                </form>

                        <?php }?>

                <?php 
                    if (isset($_POST['codigoRep'])) {
                ?>
                <table class="col-md-10 table table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Codigo</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>Disponible</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody class="">
                    <?php
                        $repuesto = $this->repuesto;
                        $val = number_format($repuesto->precioRep,2,'.','')
                            ?>
                                <tr>
                                    <td><?php echo $repuesto->codigoRep; ?></td>
                                    <td><?php echo $repuesto->descripRep; ?></td>
                                    <td><?php echo $repuesto->idMarca; ?></td>
                                    <td><?php echo $repuesto->cantidadRep; ?></td>
                                    <td><?php echo $val; ?></td> 
                                    <td class="text-center">
                                    <form action="<?php echo constant('URL'); ?>notas/nuevaNota" method="post">
                                    <input class="form-control form-control-sm" type="number" name="cantidad" id="" required="true">
                                    <input class="form-control form-control-sm" type="text" name="codigoVenta[]" value="<?php echo $repuesto->codigoRep; ?>" id="" hidden="true">
                                    <input type="submit" class="btn btn-sm btn-info mt-2" value="Añadir">
                                    </form>
                                    </td>                
                                </tr>
                    </tbody>
                </table>

                        <?php }?>

            </div>

        </div>
    </div>
    
    </center>

</body>
</html>