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
            <form action="<?php echo constant('URL'); ?>actualizar/ejecutaractipo/" method="POST">
                
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-8">
                    <p><label class="font-weight-bold" for="resultado">Seleccione el Tipo de Repuesto</label></p>
                    <select class="form-control form-control-sm col-md-8" name="idTipo" id="">
                        <?php 
                        require_once 'models/marca.php';
                        $t = $this->tipos;
                        foreach($t as $row){
                            $tipo = new Tipo();
                            $tipo = $row;
                        ?>
                            <option value="<?php echo $tipo->idTipo; ?>"><?php echo $tipo->descripTipo; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <p><label class="font-weight-bold" for="resultado">Escriba el Nuevo Tipo</label></p>
                    <textarea class="form-control form-control-sm col-md-8" name="descripTipo"></textarea>
                    </div>
                </div>
        </div>
        <div class="card-footer">
                <p><input type="submit" class="btn btn-sm btn-success" value="Actualizar"></p>
        </div>
            </form>
    </div>
    </center>

</body>
</html>