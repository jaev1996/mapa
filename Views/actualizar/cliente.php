<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>LISTA DE CLIENTES</title>
</head>
<body>
    <?php require_once 'Views/header.php'; ?>
    <h1 class="text-center display-4">Lista de Clientes</h1>
    <br>
    <div class="col-md-8 text-center">
        <div class="col-6">
                    <div class="">
                            <?php
                            require_once 'models/cliente.php';
                            $i = 0;
                                $v = $this->clientes;
                                foreach($v as $row){
                                    $cliente = new Cliente();
                                    $cliente = $row;
                                    $i++;
                                }
                                ?>
                           <h5>Total de Clientes: <?php echo $i;?></h5>
                    </div>
        </div>
    </div>
    
            <center>
    <div class="row col-md-10 justify-content-center">
        
    <table class="col-md-12 table table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Nombre del Cliente</th>
                                <th>Identificacion</th>
                                <th>Direccion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-bold">
                        <?php 
                        $v = $this->clientes;
                        foreach($v as $row){
                            $cliente = new Cliente();
                            $cliente = $row;
                        ?>
                        <tr>
                            <td><?php echo $cliente->nombreCliente; ?></td>
                            <td><?php echo $cliente->codigoCliente; ?></td>
                            <td><?php echo $cliente->direccionCliente; ?></td>
                            <td class="text-center"><a class="btn btn-sm btn-info" href="<?php echo constant('URL').'actualizar/detallesCliente/'.$cliente->idCliente; ?>">Ver Detalles</a>
                            </td>
                        <?php
                        }
                        ?>
                        </tr>
                    </select>
            </p>
            <br> <br><br> 

    </div><br>
    
    </center>

</body>
</html>