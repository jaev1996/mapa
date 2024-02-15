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
    <h1 class="text-center display-4">Nuevo Registro de Expediente</h1><center>

    <form action="<?php echo constant('URL'); ?>nuevo/registrarExpediente" method="POST">
    <br>
    <div class="row col-md-12 justify-content-center">
            <p class="col-2">
            <label for="anioGestion">Año de Gestion</label><br>
            <input class="form-control form-control-sm" type="number" name="anio_gestion" id="" required>
            </p>
            <br>

            <p class="col-2">
            <label for="codAf">Codigo Actuacion Fiscal</label><br>
            <input class="form-control form-control-sm" type="text" name="codigo_af" id="" required>
            </p>
            <br>
            <p class="col-4">
            <label for="tipoAf">Tipo de Actuacion Fiscal</label><br>
            <input class="form-control form-control-sm" type="text" name="tipo_af" id="" required>
            </p>
            <br>
            <p class="col-4">
            <label for="orgAud">Organos o Dependencias Auditadas</label><br>
            <textarea class="form-control form-control-sm re" rows="3" name="organosAudi" id="" required></textarea>
            </p>
    </div>
    
    <div class="row col-md-12 justify-content-center">
            <p class="col-2">
            <label for="fechaInforme">Fecha de Informe Definitivo</label><br>
            <input class="form-control form-control-sm" type="date" name="fecha_informedef" id="" required>
            </p>
            <br>

            <p class="col-2">
            <label for="compExpe">Composici&oacute;n del Expediente</label><br>
            <select class="form-control form-control-sm" name="comp_expediente" id="">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>

            </select>
            </p>
            <br>
            <p class="col-4">
            <label for="alcance">Alcance</label><br>
            <textarea class="form-control form-control-sm re" rows="3" name="alcance" id="" required></textarea>
            </p>
            <br>
            <p class="col-4">
            <label for="objetivo">Objetivo</label><br>
            <textarea class="form-control form-control-sm re" rows="3" name="objetivo_general" id="" required></textarea>
            </p>
    </div>
    <br>
    <div class="row col-md-12 justify-content-center">
            <p class="col-2">
            <label for="estadoAct">Estado Actual</label><br>
            <input class="form-control form-control-sm" type="text" name="estadoAct" id="" required>
            </p>
            <br>

            <p class="col-2">
            <label for="ubicacionFis">Ubicacion Fisica</label><br>
            <input class="form-control form-control-sm" type="text" name="ubicacionFis" id="" required>
            </p>
            <br>
            <p class="col-4">
            <label for="observaciones">Observaciones Adicionales</label><br>
            <textarea class="form-control form-control-sm re" rows="3" name="observaciones" id="" required></textarea>
            </p>
            <br>
            <p class="col-4">
            
            </p>
    </div>
    <br>




<!--

    <div class="row col-md-8">
        <div class="col mr-4">
            <p>
            <label for="anioGestion">Año de Gestion</label><br>
            <input class="form-control form-control-sm" type="number" name="anio_gestion" id="" required>
            </p>
            <br>

            <p>
            <label for="codAf">Codigo Actuacion Fiscal</label><br>
            <input class="form-control form-control-sm" type="text" name="codigo_af" id="" required>
            </p>
            <br>
            <p>
            <label for="tipoAf">Tipo de Actuacion Fiscal</label><br>
            <input class="form-control form-control-sm" type="text" name="tipo_af" id="" required>
            </p>
            <br>
            <p>
            <label for="orgAud">Organos o Dependencias Auditadas</label><br>
            <textarea class="form-control form-control-sm" name="organosAudi" id="" required></textarea>
            </p>
            
            
        </div>
        <div class="col mr-4">
               
            <p>
            <label for="fechaInforme">Fecha de Informe Definitivo</label><br>
            <input class="form-control form-control-sm" type="date" name="fecha_informedef" id="" required>
            </p>
            <br>
            <p>
            <label for="alcance">Alcance</label><br>
            <textarea class="form-control form-control-sm" name="alcance" id="" required></textarea>
            </p>
            <p>
            <label for="objetivo">Objetivo</label><br>
            <textarea class="form-control form-control-sm" name="objetivo_general" id="" required></textarea>
            </p>
            <br>
            <p>
            <label for="compExpe">Composici&oacute;n del Expediente</label><br>
            <select class="form-control form-control-sm" name="comp_expediente" id="">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>

            </select>
            </p>
        </div>

        <div class="col">
 
            <p>
            <label for="estadoAct">Estado Actual</label><br>
            <input class="form-control form-control-sm" type="text" name="estadoAct" id="" required>
            </p>
            <br>

            <p>
            <label for="ubicacionFis">Ubicacion Fisica</label><br>
            <input class="form-control form-control-sm" type="text" name="ubicacionFis" id="" required>
            </p>
            <br>
            <p>
            <label for="observaciones">Observaciones Adicionales</label><br>
            <textarea class="form-control form-control-sm" name="observaciones" id="" required></textarea>
            </p>
        </div>
    </div>-->
        <p><a href="<?php echo constant("URL"); ?>main" class="mr-4 btn btn-sm btn-danger">Volver</a><input class="btn btn-sm btn-success" type="submit" value="Nuevo Registro"></p>
    </form>
    </center>

</body>
</html>