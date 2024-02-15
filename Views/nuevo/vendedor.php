<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Nuevo Vendedor</title>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center>

    <form action="<?php echo constant('URL'); ?>nuevo/nuevoVendedor" method="POST">
    <br>
    <div class="card col-md-6">
            <div class="card-header mt-2 bg-primary">
                <h2 class="text-white">Registrar Nuevo Vendedor</h2>
            </div>
            <div class="card-body">
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                    <p><label class="font-weight-bold" for="resultado">Nombre del Vendedor</label></p>
                    <input class="form-control form-control-sm" type="text" name="nombreVendedor" id="" required><br>
                    <p><label class="font-weight-bold" for="resultado">Cedula</label></p>
                    <input class="form-control form-control-sm" type="text" name="codigoVendedor" id="" required><br>
                    <p><label class="font-weight-bold" for="resultado">Telefono</label></p>
                    <input class="form-control form-control-sm" type="text" name="telefonoVendedor" id="" required><br>
                    
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p><input type="submit" class="btn btn-sm btn-success" value="Guardar"></p>
            </div>
        </div><br><br>
    </form>
    </center>

</body>
</html>