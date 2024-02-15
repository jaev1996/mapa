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
    <?php require_once 'Views/header.php'; ?>
    <center>

    <form action="<?php echo constant('URL'); ?>nuevo/nuevoRep" method="POST">

    <div class="card col-md-6">
        <div class="card-header bg-primary mt-2">
            <h2 class="text-white">Nuevo Repuesto</h2>
        </div>
        <div class="card-body">
            <p class="">
            <label class="font-weight-bold mr-2" for="anioGestion">Codigo: </label><br>
            <input class="form-control form-control-sm col-md-4" type="text" name="codigoRep" id="" required>
            </p>
            
            <p class="">
            <label class="font-weight-bold mr-2" for="codAf">Marca: </label>
            <select class="form-control form-control-sm col-md-4" name="idMarca" id="">
            <option value="NULL">Seleccione La Marca</option>
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
            </select>
            </p>
            <p class="">
            <label class="font-weight-bold mr-2" for="tipoAf">Descripcion</label><br>
            <textarea class="form-control form-control-sm col-md-6" name="descripRep" id=""></textarea>
            </p>
            <p class="">
            <label class="font-weight-bold mr-2" for="codAf">Tipo de Repuesto</label><br>
            <select class="form-control form-control-sm col-md-6" name="idTipo" id="">
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
            </p>

            <p class="">
            <label class="font-weight-bold mr-2" for="anioGestion">Cantidad</label><br>
            <input class="form-control form-control-sm col-md-3" type="text" name="cantidadRep" id="" required>
            </p>
            
            <p class="">
            <label class="font-weight-bold mr-2" for="tipoAf">Precio</label><br>
            <input class="form-control form-control-sm col-md-3" type="text" name="precioRep" id="" required>
            </p>

            <p class="">
            <label class="font-weight-bold mr-2" for="tipoAf">Ubicacion Deposito</label><br>
            <input class="form-control form-control-sm col-md-3" type="text" name="ubicRep" id="" required>
            </p>
            
            <br>
        </div>
        <div class="card-footer mb-2">
        <p><a href="<?php echo constant("URL"); ?>consulta/ncliente" class="mr-4 btn btn-sm btn-danger">Volver</a><input class="btn btn-sm btn-success" type="submit" value="Registrar"></p>
        </div>
    </div>
    
    </form>
    </center>
    <br><br><br>

</body>
</html>