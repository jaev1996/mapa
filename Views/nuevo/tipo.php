<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Nuevo Tipo de Repuesto</title>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center><br>
    <div class="card col-md-6">
        <div class="card-header bg-primary mt-2">
            <h2 class="text-white">Registrar Nuevo Tipo de Repuesto</h2>
        </div>
        <div class="card-body">
            <form action="<?php echo constant('URL'); ?>nuevo/nuevoTipo/" method="POST">
                
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-8">
                    <p><label class="font-weight-bold" for="resultado">Escribir Nuevo</label></p>
                    <textarea class="form-control form-control-sm col-md-8" name="descripTipo"></textarea>
                    </div>
                </div>
        </div>
        <div class="card-footer">
                <p><a href="<?php echo constant("URL"); ?>consulta/repuestos/" class="mr-4 btn btn-sm btn-danger">Volver</a><input type="submit" class="btn btn-sm btn-success" value="Guardar"></p>
        </div>
            </form>
    </div>
    </center>

</body>
</html>