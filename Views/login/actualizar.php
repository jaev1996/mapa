<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Actualizar Expediente</title>
</head>
<body>
    <?php require_once 'Views/header.php'; ?>
    <h1 class="text-center display-4">Informacion del Usuario</h1><center>
    <br><br>
    <div class="row col-md-8">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> Actualizar Datos Personales </div>
                <div class="card-body">
                    <form action="<?php echo constant('URL'); ?>login/updUserData/" method="POST">

                    <div class="form-row justify-content-center">
                        <div class="form-group">
                        <label for="nombre">Nombres:</label>
                        <input class="form-control form-control-sm " type="text" value="<?php echo $this->user->nombreUser; ?>" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group">
                        <label for="apellidos">Apellidos:</label>
                        <input class="form-control form-control-sm " type="text" value="<?php echo $this->user->apellidoUser; ?>" name="apellido" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group">
                        <label for="Cedula">Cedula:</label>
                        <input class="form-control form-control-sm " type="text" value="<?php echo $this->user->cedula; ?>" name="cedula" required>
                        </div>
                    </div>
                    <br>
                    <input class="form-control form-control-sm " type="number" value="<?php echo $this->user->idUser; ?>" name="idUser" hidden>

                        <input type="submit" class="btn btn-sm btn-success" value="Actualizar Datos">

                    </form>

                
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"> Actualizar Datos de Acceso </div>
                <div class="card-body">  
                    <form action="<?php echo constant('URL'); ?>login/updDataAccess/" method="POST">
                    <div class="form-row justify-content-center">
                        <div class="form-group">
                        <label for="Cedula">Nombre de Usuario:</label>
                        <input class="form-control form-control-sm " type="text" value="<?php echo $this->user->usuario; ?>" name="user" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group">
                        <label for="Cedula">Clave:</label>
                        <input class="form-control form-control-sm " type="password" value="<?php echo $this->user->clave; ?>" name="clave" required>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="form-group">
                        <label for="Cedula">Ingrese su Clave Actual Para Guardar los Cambios:</label>
                        <input class="form-control form-control-sm col-md-6" type="password" value="" name="confirmar" required>
                        </div>
                    </div>
                    <br>
                    <input class="form-control form-control-sm " type="number" value="<?php echo $this->user->idUser; ?>" name="idUser" hidden>

                    <input type="submit" class="btn btn-sm btn-success" value="Actualizar Datos">

                    </form>
                </div>

            </div>
        </div>
        
    </div><br><br>
        <p><a href="<?php echo constant("URL"); ?>main" class="mr-4 btn btn-sm btn-danger">Volver</a></p>
    </center>

</body>
</html>