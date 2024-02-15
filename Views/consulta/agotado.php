<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Inventario de Repuestos</title>
    <style type="text/css" src="">
        .re{
         resize: none;
        }
        .ir-arriba {
            display:none;
            padding:25px;
            background:#0275d8;
            font-size:20px;
            color:#fff;
            cursor:pointer;
            position: fixed;
            bottom:20px;
            right:20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        
        $('.ir-arriba').click(function(){
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });

        $(window).scroll(function(){
            if( $(this).scrollTop() > 0 ){
                $('.ir-arriba').slideDown(300);
            } else {
                $('.ir-arriba').slideUp(300);
            }
        });

        });
    </script>
</head>
<body class="bg-secondary">
    <?php require_once 'Views/header.php'; ?>
    <center>
    <div class="card col-md-10">
        <div class="card-header bg-primary mt-2">
            <h2 class="text-center text-white font-weight-bold">Repuestos Agotados/Con Baja Existencia</h2>
        </div>
        <div class="card-body">
    
            <?php  
                foreach ($this->tipo as $row) {
                    $tipo = new Tipo();
                    $tipo = $row;
                    ?><br>
                    <h2><?php echo $tipo->descripTipo; ?></h2>
                    <span class="ir-arriba">UP</span>

                    <table class="col-md-8 table table-primary table-sm table-bordered text-dark table-hover">
                        <thead class="bg-primary text-light">
                            <tr>
                                <th>Codigo de Repuesto</th>
                                <th>Descripcion</th>
                                <th>Marca</th>
                                <th>Cantidad</th>
                                <th>Precio($)</th>
                                <th>Ubicacion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="font-weight-bold">
                    <?php

                    foreach ($this->repuesto as $row) {
                        $repuesto = new Repuesto();
                        $repuesto = $row;
                        if ($repuesto->idTipo == $tipo->idTipo) {
                            if ($repuesto->cantidadRep < 5) {
                            $val = number_format($repuesto->precioRep,2,'.','')
                            ?>
                                <tr>
                                    <td><?php echo $repuesto->codigoRep; ?></td>
                                    <td><?php echo $repuesto->descripRep; ?></td>
                                    <td><?php echo $repuesto->idMarca; ?></td>
                                    <td><?php echo $repuesto->cantidadRep; ?></td>
                                    <td><?php echo $val; ?></td>                
                                    <td><?php echo $repuesto->ubicRep; ?></td>
                                    <td><a class="btn btn-sm btn-info mt-2 mb-2" href="<?php echo constant('URL')."actualizar/actualizarep/".$repuesto->codigoRep; ?>">Editar</a></td>                
                                </tr>
                            <?php
                            }
                        }
                    }
                    ?>
                    </tbody>
                    </table>
                    <?php
                }
            ?>
        </div>

        <div class="card-footer"><br></div>
    </div>
    <br><br>
    
</body>
</html>