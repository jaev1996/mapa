<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Consulta</title>
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
            <h2 class="text-white">Detalles del Repuesto</h2>
        </div>
        <div class="card-body">
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
                    require_once 'Models/repuesto.php';
                        $repuesto = $this->repuesto;
                            ?>
                                <tr>
                                    <td><?php echo $repuesto->codigoRep; ?></td>
                                    <td><?php echo $repuesto->descripRep; ?></td>
                                    <td><?php echo $repuesto->idMarca; ?></td>
                                    <td><?php echo $repuesto->cantidadRep; ?></td>
                                    <td><?php echo $repuesto->precioRep; ?></td>
                                    <td><?php echo $repuesto->ubicRep; ?></td>
                                    <td><a class="btn btn-sm btn-info mt-2 mb-2" href="<?php echo constant('URL')."actualizar/actualizarep/".$repuesto->codigoRep; ?>">Editar</a></td>                

                                </tr>
                    </tbody>
                </table>
        </div>
        <div class="card-footer">
        <a class="btn btn-sm btn-danger mt-2 mb-2" href="<?php echo constant('URL')."consulta/"; ?>">Volver</a>                

        </div>
    </div>

                    
</body>
</html>