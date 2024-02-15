<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Nuevo Marca de Repuesto</title>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center>

    <form action="<?php echo constant('URL'); ?>actualizar/ejecutaractmarca/" method="POST">
        <br>
        <div class="card col-md-6">
            <div class="card-header mt-2 bg-primary">
                <h2 class="text-white">Actualizar Marca de Repuestos</h2>
            </div>
            <div class="card-body">
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-8">
                    <p><label class="font-weight-bold" for="resultado">Seleccione una Marca</label></p>
                    <select class="form-control form-control-sm col-md-6" name="idMarca" id="">
                        <?php 
                        require_once 'models/marca.php';
                        $m = $this->marcas;
                        foreach($m as $row){
                            $marca = new Marca();
                            $marca = $row;
                        ?>
                            <option value="<?php echo $marca->idMarca; ?>"><?php echo $marca->descripMarca; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <p><label class="font-weight-bold" for="resultado">Escriba el Nuevo Nombre</label></p>
                    <textarea class="form-control form-control-sm col-md-8" name="descripMarca"></textarea>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p><a href="<?php echo constant("URL"); ?>consulta/repuestos/" class="mr-4 btn btn-sm btn-danger">Volver</a><input type="submit" class="btn btn-sm btn-success" value="Guardar"></p>
            </div>
        </div>
        
    </form>
    </center>

</body>
</html>