<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Confirmar Nota de Entrega</title>
</head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function(){
            $("#txtbusca").keyup(function(){
              var parametros="txtbusca="+$(this).val()
              if (parametros.length > 11) {
                $.ajax({
                  data:  parametros,
                  url:   '../notas/buscaCliente',
                  type:  'post',
                    beforeSend: function () { },
                    success:  function (response) {                 
                        $(".salida").html(response);
                  },
                  error:function(){
                      alert("error")
                    }
                });
              }
              
            });
        });
    </script>
<body class="bg-secondary">
    <?php if (!isset($_SESSION['notaDeEntrega'])) {
        session_start();
    }
    require_once 'Views/header.php'; 
    ?>
    <center>

    <form action="<?php echo constant('URL'); ?>notas/realizarNota" method="POST">
        <br>
        <div class="card col-md-6">
            <div class="card-header mt-2 bg-primary">
                <h2 class="text-white">Nota de Entrega Nro: <?php echo $this->numeroNota; ?> </h2>
            </div>
            <div class="card-body">
                <div class="form-row justify-content-center">
                    <label for="">Cliente:</label>
                        <div class="form-group col-md-2">
                                <input class="form-control form-control-sm" type="text" name="txtbusca" id="txtbusca" placeholder="Buscar Cliente">
                        </div><br>
                        <div class="salida col-md-4">
                        </div>
                </div>
                <div class="form-row justify-content-center">
                    
                    <label for="">Vendedor:</label>
                    <div class="form-group col-md-6">
                    <select class="form-control form-control-sm" name="idVendedor" id="">
                        <option value="NULL">Seleccione un Vendedor</option>
                        <?php foreach($this->vendedor as $row){ ?>
                        <option value="<?php echo $row->codigoVendedor; ?>"> <?php echo $row->codigoVendedor." ".$row->nombreVendedor; ?></option>
                        <?php }?>
                    </select>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <label for="">Tipo de Pago:</label>
                    <div class="form-group col-md-6">
                            <input class="form-control form-control-sm" type="text" name="tipoPago" placeholder="Contado, Transferencia u Otro" id="" required="true">
                    </div>
                    <input type="text" name="numeroNota" value="<?php echo $this->numeroNota; ?>" id="" hidden="true">
                </div>
                <br><br>
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
                                foreach ($notaDeEntrega as $row) {
                                $total+=$row->precioRep * $row->cantidadRep;
                        ?>
                        <tr>
                                <td><?php echo $row->codigoRep; ?></td>
                                <td><textarea class="form-control form-control-sm" readonly="true" name="descripRep" id="" rows="3"><?php echo $row->descripRep; ?></textarea>
                                </td>
                                <td><?php echo $row->idMarca; ?></td>
                                <td><?php echo $row->cantidadRep; ?></td>
                                <td><?php echo $row->precioRep; ?></td>
                                <td><?php echo $row->precioRep * $row->cantidadRep; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
            </table>
            <div class="form-row justify-content-right">
                    <label class="float-right" for="">Total: <?php echo $total; ?></label>
                </div>
            </div>
            <div class="card-footer">
                <p><a href="<?php echo constant("URL"); ?>notas/nuevaNota/" class="mr-4 btn btn-sm btn-danger">Volver</a><input type="submit" class="btn btn-sm btn-success" value="Emitir Nota"></p>
            </div>
        </div>
        
    </form>
    </center>

</body>
</html>