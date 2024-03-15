<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/bootstrap.min.css">
    <script src="<?php echo constant('URL'); ?>public/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo constant('URL'); ?>public/js/bootstrap.min.js"></script>
    <title></title>
</head>
<?php
/*if (($_SESSION['user'] == NULL) || ($_SESSION['user'] == "")) {
    echo "<script type='text/javascript'>alert('¡Debe Iniciar Sesion para poder acceder!');window.location.replace('".constant('URL')."login/');</script>";
}*/ 
date_default_timezone_set('America/Caracas');
//echo "fecha actual".date("j.n.Y");

?>
<body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo constant('URL'); ?>main">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Repuestos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>nuevo/nrepuesto">Registrar Nuevo</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>nuevo/nmarca">Registrar Marca</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>nuevo/ntipo">Registrar Tipo de Repuesto</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>actualizar/uprepuesto">Actualizar Repuesto</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>actualizar/upmarca">Actualizar Marca</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>actualizar/uptiporep">Actualizar Tipo de Repuesto</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Inventario
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>consulta/">Disponible</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>consulta/busqueda">Busqueda Avanzada</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>consulta/invagotado">Agotado o Baja Cantidad</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Clientes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>nuevo/ncliente">Registrar Nuevo</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>consulta/verClientes">Lista de Clientes</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Vendedores
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>nuevo/nvendedor">Registrar Nuevo</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>consulta/verVendedores">Lista de Vendedores</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Notas de Entrega
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>notas/nuevaNota/">Nueva Nota</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>notas/verListadoNotas/">Lista de Notas</a>
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>notas/cotizacion/">Cotizacion</a>

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Estadisticas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo constant('URL'); ?>consulta/verStatsRepuestos">Ver Estadisticas</a>
                </div>
            </li>
            <!--
            <li class="nav-item">
                <a class="nav-link" href="#">Usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Cerrar Sesion</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <div class="form-inline my-2 my-lg-0">
                <label class="text-white" for="">Usuario: <div class="nav-item"><a class="nav-link text-white" href=""><?php //echo $_SESSION['user']; ?></a></div></label>
            </div>-->
            </ul>
  
            
        </nav>
</body>
</html>