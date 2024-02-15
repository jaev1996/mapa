<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Ver Ficha</title>
    <style type="text/css" src="">
        .re{
         resize: none;
        }
    </style>
</head>
<body>
    <?php require_once 'Views/header.php'; ?>
    <h2 class="text-center">Ver Expediente N°: <?php echo $this->afiscal->numeroInterno;?> Completo</h2><center>
    <br>
    <div class="row col-md-12 justify-content-center">
            <p class="col-2">
            <label for="anioGestion">Año de Gestion</label><br>
            <input class="form-control form-control-sm" type="number" name="anioGestion" value="<?php echo $this->afiscal->anioGestion;?>" id="" required>
            </p>
            <br>

            <p class="col-2">
            <label for="codAf">Codigo Actuacion Fiscal</label><br>
            <input class="form-control form-control-sm" type="text" name="codigoActuacion" value="<?php echo $this->afiscal->codigoActuacion;?>" id="" required>
            </p>
            <br>
            <p class="col-4">
            <label for="tipoAf">Tipo de Actuacion Fiscal</label><br>
            <input class="form-control form-control-sm" type="text" name="tipoActuacion" value="<?php echo $this->afiscal->tipoActuacion;?>" id="" required>
            </p>
            <br>
            <p class="col-4">
            <label for="orgAud">Organos o Dependencias Auditadas</label><br>
            <textarea class="form-control form-control-sm re" rows="3" name="organosAudi" id="" required><?php echo $this->afiscal->organosAudi;?></textarea>
            </p>
    </div>
    
    <div class="row col-md-12 justify-content-center">
            <p class="col-2">
            <label for="fechaInforme">Fecha de Informe Definitivo</label><br>
            <input class="form-control form-control-sm" type="date" value="<?php echo $this->afiscal->fechaSuscripcion;?>" name="fechaSuscripcion" id="" required>
            </p>
            <br>

            <p class="col-2">
            <label for="compExpe">Composici&oacute;n del Expediente</label><br>
            <select class="form-control form-control-sm" name="composicionExp" id="">
                <option value="<?php echo $this->afiscal->composicionExp;?>"><?php echo $this->afiscal->composicionExp;?></option>                
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
            <textarea class="form-control form-control-sm re" rows="3" name="alcance" id="" required><?php echo $this->afiscal->alcance;?></textarea>
            </p>
            <br>
            <p class="col-4">
            <label for="objetivo">Objetivo</label><br>
            <textarea class="form-control form-control-sm re" rows="3" name="objetivoGeneral" id="" required><?php echo $this->afiscal->objetivoGeneral;?></textarea>
            </p>
    </div>
    <br>
    <div class="row col-md-12 justify-content-center">
            <p class="col-2">
            <label for="estadoAct">Estado Actual</label><br>
            <input class="form-control form-control-sm" type="text" name="estadoAct" value="<?php echo $this->afiscal->estadoAct;?>" id="" required>
            </p>
            <br>

            <p class="col-2">
            <label for="ubicacionFis">Ubicacion Fisica</label><br>
            <input class="form-control form-control-sm" type="text" name="ubicacionFis" value="<?php echo $this->afiscal->ubicacionFis;?>" id="" required>
            </p>
            <br>
            <p class="col-4">
            <label for="observaciones">Observaciones Adicionales</label><br>
            <textarea class="form-control form-control-sm re" rows="3" name="observaciones" id="" required><?php echo $this->afiscal->observaciones;?></textarea>
            </p>
            <br>
            <p class="col-4">
            
            </p>
    </div>
    <br>
    <div class="row col-md-12 justify-content-center">
    
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p class="h5">Direccion de Control</p>
                </div> 
                <div class="card-body">
                    <label> <label class="font-weight-bold">Informe Definitivo: </label> <?php echo $this->control->informeDef; ?></label><br>
                    <label> <label class="font-weight-bold">Resumen Ejecutivo: </label> <?php echo $this->control->resumenEjec; ?></label><br>     
                    <label> <label class="font-weight-bold">Valoraci&oacute;n Juridica: </label> <?php echo $this->control->valoracionJur; ?></label><br>     
                    <label> <label class="font-weight-bold">Auto de Archivo: </label> <?php echo $this->control->autoArchivo; ?></label><br>     
                    <label> <label class="font-weight-bold">Resultado: </label> <?php echo $this->control->resultado; ?></label><br>     

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card"> 
                <div class="card-header">
                    <p class="h5">Potestad Investigativa</p>
                </div> 
                <div class="card-body">
                <label> <label class="font-weight-bold">Auto de Proceder: </label> <?php echo $this->potestad->autoProceder; ?></label><br>     
                <label> <label class="font-weight-bold">Auto de Archivo: </label> <?php echo $this->potestad->autoArchivo; ?></label><br>     
                <label> <label class="font-weight-bold">Informe de Resultados: </label> <?php echo $this->potestad->informeRes; ?></label><br>     
                <label> <label class="font-weight-bold">Resultado: </label> <?php echo $this->potestad->resultado; ?></label><br>     
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <p class="h5">Determinacion de Responsabilidades</p>
                </div>  
                <div class="card-body"> 
                <label> <label class="font-weight-bold">Auto de Inicio o Apertura: </label> <?php echo $this->deter->autoInicio; ?></label><br>     
                <label> <label class="font-weight-bold">Auto de Archivo: </label> <?php echo $this->deter->autoArchivo; ?></label><br>     
                <label> <label class="font-weight-bold">Decision: </label> <?php echo $this->deter->decision; ?></label><br>     
                <label> <label class="font-weight-bold">Resultado: </label> <?php echo $this->deter->resultado; ?></label><br>     
                </div>
            </div>
        </div>
    </div>
    
        <p><a href="<?php echo constant("URL"); ?>consulta/listado/1" class="mr-4 btn btn-sm btn-danger">Volver</a>
    </center>

</body>
</html>