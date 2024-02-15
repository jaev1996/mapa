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
    <?php require_once 'Views/header.php'; ?>
    
    <h1 class="text-center display-4">Actualizar Repuestos</h1>
    <center>
    <br>
    
    <div class="card mr-4 col-md-8">
        <div class="card-header">
            <h3>Buscar Repuesto</h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-5">
                <form action="<?php echo constant('URL'); ?>actualizar/uprepuesto" method="post">

                    <label class="font-weight-bold" for="">Buscar Por Codigo:</label>
                    <p class="form-inline">
                        <input type="text" name="codigoRep" class="form-control form-control-sm col-md-8">
                        <input type="submit" class="ml-2 btn btn-sm btn-success" value="Buscar">
                    </p>
                </form>
                </div>
                <div class="col-6">
                    <form action="<?php echo constant('URL'); ?>actualizar/uprepuesto" method="post">
                    <label class="font-weight-bold" for="">Listado Por Tipo</label>
                    <p class="form-inline">
                    <select class="form-control form-control-sm col-md-9" name="idTipo" id="buscaTipo">
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
                    <form action="<?php echo constant('URL'); ?>actualizar/ejecutaractrep2" method="POST">
                <table class="col-md-10 table table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Codigo de Repuesto</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>U.D.</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php
                                require_once 'Models/repuesto.php';
                                foreach ($this->repuesto as $row) {
                                $repuesto = new Repuesto();
                                $repuesto = $row;
                            ?>
                                <tr>
                                    <td><?php echo $repuesto->codigoRep; ?></td>
                                    <td><?php echo $repuesto->descripRep; ?></td>
                                    <td><?php echo $repuesto->idMarca; ?></td>
                                    <td><input type="text" name="ubicRep[]" value="<?php echo $repuesto->ubicRep; ?>" class="form-control form-control-sm col-md-8"></td>                
                                    <td><input type="text" name="cantidadRep[]" value="<?php echo $repuesto->cantidadRep; ?>" class="form-control form-control-sm col-md-8"></td>                
                                    <td><input type="text" name="precioRep[]" value="<?php echo $repuesto->precioRep; ?>" class="form-control form-control-sm col-md-8"></td>                
                                    <td class="text-center">
                                    <a class="btn btn-sm btn-info mt-2 mb-2" href="<?php echo constant('URL')."actualizar/actualizarep/".$repuesto->codigoRep; ?>">Editar</a>
                                    </td>                
                                </tr>
                                    <input hidden="true" type="text" name="codigoRep[]" value="<?php echo $repuesto->codigoRep; ?>" class="form-control form-control-sm col-md-8">
                            <?php
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><input class="btn btn-sm btn-success" type="submit" value="Actualizar"></td>
                            </tr>

                    </tbody>
                </table>
                </form>

                        <?php }?>

                <?php 
                    if (isset($_POST['codigoRep'])) {
                        $codigoRep = $_POST['codigoRep'];
                ?>
                <table class="col-md-10 table table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Codigo</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="">
                    <?php
                        $repuesto = $this->repuesto;
                            ?>
                                <tr>
                                    <td><?php echo $repuesto->codigoRep; ?></td>
                                    <td><?php echo $repuesto->descripRep; ?></td>
                                    <td><?php echo $repuesto->idMarca; ?></td>
                                    <td><?php echo $repuesto->cantidadRep; ?></td>
                                    <td><?php echo $repuesto->precioRep; ?></td> 
                                    <td class="text-center">
                                    <a class="btn btn-sm btn-info mt-2 mb-2" href="<?php echo constant('URL')."actualizar/actualizarep/".$repuesto->codigoRep; ?>">Editar</a>
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