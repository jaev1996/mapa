<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Nuevo Registro de Repuesto</title>
    <style type="text/css" src="">
        .re{
         resize: none;
        }
    </style>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php';
    $vendedor = $this->vendedor;
    ?>
    <center>

    <form action="<?php echo constant('URL'); ?>actualizar/ejecutaractvend" method="POST">

    <div class="card col-md-6">
        <div class="card-header bg-primary mt-2">
            <h2 class="text-white">Informacion del Vendedor</h2>
        </div>
        <div class="card-body">
            <p class="">
            <label class="font-weight-bold mr-2" for="">Nombre: </label><br>
            <input class="form-control form-control-sm col-md-4" type="text" name="nombreVendedor" value="<?php echo $vendedor['nombreVendedor']; ?>" id="" required>
            </p>
            
            <p class="">
            <label class="font-weight-bold mr-2" for="">Cedula: </label><br>
            <input class="form-control form-control-sm col-md-4" type="text" name="codigoVendedor" value="<?php echo $vendedor['codigoVendedor']; ?>" id="" required>
            </p>

            <p class="">
            <label class="font-weight-bold mr-2" for="">Telefono: </label><br>
            <input class="form-control form-control-sm col-md-4" type="text" name="telefonoVendedor" value="<?php echo $vendedor['telefonoVendedor']; ?>" id="" required>
            <input class="form-control form-control-sm col-md-4" type="text" name="idVendedor" value="<?php echo $vendedor['idVendedor']; ?>" id="" required hidden="true">
            </p>
            
            <br>
        </div>
        <div class="card-footer mb-2">
        <p><a href="<?php echo constant("URL"); ?>consulta/verVendedores" class="mr-4 btn btn-sm btn-danger">Volver</a><input class="btn btn-sm btn-success" type="submit" value="Actualizar"></p>
        </div>
    </div>
    
    </form>
    </center>
    <br><br><br>

</body>
</html>