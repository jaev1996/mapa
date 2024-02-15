<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Nota Realizada</title>
</head>
<body class="bg-secondary">
    <?php if (!isset($_SESSION['notaDeEntrega'])) {
        session_start();
    }
    require_once 'Views/header.php'; 
    ?>
    <center>

        <br>
        <div class="card col-md-8">
            <div class="card-header mt-2 bg-primary">
                <h2 class="text-white">Nota de Entrega Nro: <?php echo $this->codigoVenta; ?></h2>
            </div>
            <div class="card-body">
                <div class="form-row justify-content-center">
                <table class="col-md-12 text-center table table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Rif/Cedula</th>
                                <th>Direccion</th>
                                <th>Vendedor.</th>
                                <th>Tipo de Pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $this->fecha; ?></td>
                                <td><?php echo $this->cliente['nombreCliente']; ?></td>
                                <td><?php echo $this->cliente['codigoCliente']; ?></td>
                                <td><textarea class="form-control form-control-sm" readonly="true" id="" rows="3"><?php echo $this->cliente['direccionCliente']; ?></textarea></td>
                                <td><?php echo $this->vendedor; ?></td>
                                <td><?php echo $this->tipoPago; ?></td>
                            </tr>
                        </tbody>
                </table>

                </div>
                <br><br>
                <form action="<?php echo constant("URL"); ?>notas/printNota/" method="post">
                <table class="col-md-12 text-center table table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Cod.</th>
                                <th>Descripcion...</th>
                                <th>Marca</th>
                                <th>Cant.</th>
                                <th>Precio</th>
                                <th>Sub.To.</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                        require_once 'models/repuesto.php';
                        $notaDeEntrega = $_SESSION['notaDeEntrega'];
                        $total = 0;
                        $conteo = 0;
                                foreach ($notaDeEntrega as $row) {
                                $total+=$row->precioRep * $row->cantidadRep;
                        ?>
                            <tr>
                                <td><?php echo $row->codigoRep; ?></td>
                                <td><textarea class="form-control form-control-sm" readonly="true" name="" id="" rows="3"><?php echo $row->descripRep; ?></textarea>
                                </td>
                                <td><?php echo $row->idMarca; ?></td>
                                <td><?php echo $row->cantidadRep; ?></td>
                                <td><?php echo $row->precioRep; ?></td>
                                <td><?php echo $row->precioRep * $row->cantidadRep; ?></td>
                            </tr>
                            <input type="text" name="codigoRep[]" hidden="true" value="<?php echo $row->codigoRep; ?>">
                            <input type="text" name="descripRep[]" hidden="true" value="<?php echo $row->descripRep; ?>">
                            <input type="number" name="cantidadRep[]" hidden="true" value="<?php echo $row->cantidadRep; ?>">
                            <input type="number" name="precioRep[]" hidden="true" value="<?php echo $row->precioRep; ?>">
                            <input type="number" name="subtotal[]" hidden="true" value="<?php echo $row->precioRep * $row->cantidadRep; ?>">
                            
                        <?php 
                        $conteo++;    
                    } 
                        unset($_SESSION['notaDeEntrega']);
                        ?>
                        </tbody>
            </table>
            <div class="form-row justify-content-right">
                    <label class="float-right" for="">Total: <?php echo $total; ?></label>
            </div>
            <div class="card-footer">
                <input type="text" name="fecha" value="<?php echo $this->fecha; ?>" id="" hidden="true">
                <input type="text" name="nombreCliente" value="<?php echo $this->cliente['nombreCliente']; ?>" id="" hidden="true">
                <input type="text" name="codigoCliente" value="<?php echo $this->cliente['codigoCliente']; ?>" id="" hidden="true">
                <input type="text" name="direccionCliente" value="<?php echo $this->cliente['direccionCliente']; ?>" id="" hidden="true">
                <input type="text" name="vendedor" value="<?php echo $this->vendedor; ?>" id="" hidden="true">
                <input type="text" name="tipoPago" value="<?php echo $this->tipoPago; ?>" id="" hidden="true">
                <input type="text" name="total" value="<?php echo $total; ?>" id="" hidden="true">
                <input type="text" name="numeroNota" value="<?php echo $this->codigoVenta; ?>" id="" hidden="true">
                <input type="number" name="repeticiones" value="<?php echo $conteo; ?>" id="" hidden="true">
                <p><a href="<?php echo constant("URL"); ?>notas/nuevaNota/" class="mr-4 btn btn-sm btn-danger">Volver</a><input type="submit" class="btn btn-sm btn-success" value="Imprimir Excel"></p>
            </div>
            </form>

        </div>
    </center>

</body>
</html>