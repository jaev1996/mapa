<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Nuevo Registro de Cliente</title>
    <style type="text/css" src="">
        .re{
         resize: none;
        }
    </style>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center>

    <form action="<?php echo constant('URL'); ?>nuevo/nuevoCliente" method="POST">
    <br>
    <div class="card col-md-6">
            <div class="card-header mt-2 bg-primary">
                <h2 class="text-white">Registrar Nuevo Cliente</h2>
            </div>
            <div class="card-body">
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                    <p><label class="font-weight-bold" for="resultado">Nombre del Cliente</label></p>
                    <input class="form-control form-control-sm" type="text" name="nombreCliente" id="" required><br>
                    <p>
                    <label class="font-weight-bold" for="orgAud">Tipo Doc.</label>
                    </p>
                    <select class="form-control form-control-sm col-4" name="tipoDoc" id="">
                        <option value="V -">V -</option>
                        <option value="J -">J -</option>
                    </select><br>
                    <p><label class="font-weight-bold" for="resultado">Identificacion</label></p>
                    <input class="form-control form-control-sm" type="text" name="codigoCliente" id="" required><br>
                    <p>
                    <label class="font-weight-bold" for="orgAud">Nombre del Vendedor</label>
                    </p>
                    <select class="form-control form-control-sm" name="idVendedor" id="">
                    <?php 
                        require_once 'models/vendedor.php';
                        $v = $this->vendedor;
                        foreach($v as $row){
                            $vendedor = new Vendedor();
                            $vendedor = $row;
                        ?>
                            <option value="<?php echo $vendedor->idVendedor; ?>"><?php echo $vendedor->nombreVendedor; ?></option>
                    <?php
                        }
                    ?>
                    </select><br>
                    <p><label class="font-weight-bold" for="resultado">Telefono</label></p>
                    <input class="form-control form-control-sm" type="text" name="telefonoCliente" id="" required><br>
                    <p>
                    <label class="font-weight-bold" for="anioGestion">Direccion del Cliente</label><br>
                    </p>
                    <textarea class="form-control form-control-sm" name="direccionCliente" id="" cols="" rows=""></textarea>
                    
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