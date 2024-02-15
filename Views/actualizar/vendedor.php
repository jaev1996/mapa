<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Vendedor</title>
</head>
<body>
    <?php require_once 'Views/header.php'; ?>
    <h1 class="text-center display-4">Lista de Vendedores</h1><center>
    <br>
    <div class="row col-md-12 justify-content-center">
        
    <table class="col-md-10 table table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Nombre del Vendedor</th>
                                <th>Cedula</th>
                                <th>Telefono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-bold">
                        <?php 
                        require_once 'models/vendedor.php';
                        $v = $this->vendedores;
                        foreach($v as $row){
                            $vendedor = new Vendedor();
                            $vendedor = $row;
                        ?>
                        <tr>
                            <td><?php echo $vendedor->nombreVendedor; ?></td>
                            <td><?php echo $vendedor->codigoVendedor; ?></td>
                            <td><?php echo $vendedor->telefonoVendedor; ?></td>
                            <td class="text-center"><a class="btn btn-sm btn-info" href="<?php echo constant('URL'); ?>actualizar/detallesVendedor/<?php echo $vendedor->idVendedor; ?>">Ver Detalles</a>
                            <a class="btn btn-sm btn-info ml-2" href="<?php echo constant('URL'); ?>notas/verNotasVendedor/<?php echo $vendedor->idVendedor; ?>">Lista De Ventas</a>
                            </td>
                        <?php
                        }
                        ?>
                        </tr>
                    </select>
            </p>
            <br>          
    </div><br>
    
    </center>

</body>
</html>