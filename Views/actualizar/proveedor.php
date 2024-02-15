<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Nuevo Registro de Proveedor</title>
    <style type="text/css" src="">
        .re{
         resize: none;
        }
    </style>
</head>
<body>
    <?php require_once 'Views/header.php'; ?>
    <h1 class="text-center display-4">Nuevo Proveedor</h1><center>

    <form action="<?php echo constant('URL'); ?>nuevo/nuevoProveedor" method="POST">
    <br>
    <div class="row col-md-12 justify-content-center">
            <p class="col-4">
            <label for="anioGestion">Nombre del Proveedor</label><br>
            <input class="form-control form-control-sm" type="text" name="nombreProveedor" id="" required>
            </p>
            <br>
            <p class="col-1">
            <label for="orgAud">Tipo Doc.</label><br>
            <select class="form-control form-control-sm" name="tipoDoc" id="">
                <option value="V -">V -</option>
                <option value="R -">R -</option>
                <option value="P -">P -</option>
            </select>
            </p>
            <br>
            <p class="col-3">
            <label for="codAf">Identificacion</label><br>
            <input class="form-control form-control-sm" type="text" name="codigoProveedor" id="" required>
            </p>
            <br>
            <p class="col-3">
            <label for="tipoAf">Telefono</label><br>
            <input class="form-control form-control-sm" type="text" name="telefonoProveedor" id="" required>
            </p>
            <br>
            
    </div>
    
    
        <p><a href="<?php echo constant("URL"); ?>consulta/nproveedor" class="mr-4 btn btn-sm btn-danger">Volver</a><input class="btn btn-sm btn-success" type="submit" value="Registrar"></p>
    </form>
    </center>

</body>
</html>