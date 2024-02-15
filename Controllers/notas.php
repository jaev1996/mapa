<?php
    class Notas extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "";
            //echo "<p>Funcion Main</p>";
        }

    

        function confirmarNota(){
            $numeroNota = $this->model->getNumeroNota();
            $cliente = $this->model->getAllFromCliente();
            $vendedor = $this->model->getAllFromVendedor();
            $this->view->numeroNota = $numeroNota;
            $this->view->cliente = $cliente;
            $this->view->vendedor = $vendedor;
            $this->view->render('notas/notadeentrega');
        }
        
        function cotizar(){
            $vendedor = $this->model->getAllFromVendedor();
            $this->view->vendedor = $vendedor;
            $this->view->render('notas/cotizar');
        }

        function buscaCliente(){
            $html = "ENTRA EN LA FUNCION";
            if (isset($_POST["txtbusca"])) {
                $txtbusca = $_POST["txtbusca"];
                $html = $this->model->getClienteByDescAndCod($txtbusca);
                //$u=$user->buscar("repuestos"," descripRep like '%".$_POST['txtbusca']."%' OR codigoRep like '%".$_POST['txtbusca']."%'");
                //return $html;
                /*else:
                echo "Error";
                endif;*/
                //$x = $_POST["txtbusca"];
                return $html;
            }else {
                $this->view->render('consulta/busqueda');
            }
            
        }
        function printNota(){
            
            $this->view->render('notas/printnota');
        }

        function realizarNota(){
            session_start();
            if (!isset($_POST['idCliente'])) {
                echo "<script type='text/javascript'>alert('POR FAVOR INGRESE EL NOMBRE DE UN CLIENTE');window.location.replace('".constant('URL')."notas/confirmarNota');</script>";                
            }else{

                $idCliente = $_POST['idCliente'];
                $idVendedor = $_POST['idVendedor'];
                $tipoPago = $_POST['tipoPago'];
                $fecha = date("Y-m-d");
                $codigoVenta = $_POST["numeroNota"];
                
                if($this->model->insertNota([   'codigoVenta'   => $codigoVenta, 
                'idCliente'  => $idCliente, 
                'idVendedor' => $idVendedor,
                'tipoPago'     => $tipoPago,
                'fechaVenta'      => $fecha])){
                    echo "<script type='text/javascript'>alert('SE HA INSERTADO LA NOTA');</script>";                
                }
                $notaDeEntrega = $_SESSION['notaDeEntrega'];
                foreach ($notaDeEntrega as $row) {
                    $this->model->insertDatosNota([ 'codigoVenta'  => $codigoVenta, 
                    'codigoRep'    => $row->codigoRep, 
                    'cantidadRep'  => $row->cantidadRep,
                    'precioRep'    => $row->precioRep,
                    'subtotalRep'  => $row->precioRep * $row->cantidadRep]);
                    
                    $this->model->updateDatosRep([  'codigoRep'    => $row->codigoRep, 
                    'cantidadRep'  => $row->cantidadRep]);
                }
                
                
                $cliente = $this->model->getClienteById($idCliente);
                $vendedor = $this->model->getVendedorById($idVendedor);
                $this->view->cliente = $cliente;
                $this->view->vendedor = $vendedor;
                $this->view->fecha = $fecha;
                $this->view->tipoPago =$tipoPago;
                $this->view->codigoVenta = $codigoVenta;
                
                $this->view->render('notas/notarealizada');
            }
        }

        function verNota($param = NULL){
            $codigoVenta = $param[0];
            $venta = $this->model->getVentaByCodigo($codigoVenta);
            $idCliente = $venta['idCliente'];
            $idVendedor = $venta['idVendedor'];
            $cliente = $this->model->getClienteById($idCliente);
            $vendedor = $this->model->getVendedorById($idVendedor);
            $historico = $this->model->getHistorico($codigoVenta);
            $this->view->historico = $historico;
            $this->view->cliente = $cliente;
            $this->view->vendedor = $vendedor;
            $this->view->venta = $venta;

            $this->view->render('notas/vernota');
        }

    

        function nuevaNota(){

            $numeroNota = $this->model->getNumeroNota();
            $tipos = $this->model->getAllFromTipo();
            $this->view->tipos = $tipos;
            $this->view->numeroNota = $numeroNota;

            if (isset($_POST['idTipo'])) {
                $tipo = $_POST['idTipo'];
                $repuesto = $this->model->getRepuestoForTipo($tipo);
                $descripcion = $this->model->getTipoById($tipo);
            
                $this->view->repuesto = $repuesto;
                $this->view->descrip = $descripcion;
                $this->view->render('notas/index');
            }

            if (isset($_POST['codigoRep'])) {
                
                $codigoRep = $_POST['codigoRep'];
                if($repuesto = $this->model->getRepuestoForCode($codigoRep)){
                    if ($repuesto->cantidadRep > 0) {
                        $this->view->repuesto = $repuesto;
                        $this->view->render('notas/index');
                    }else{
                        echo "<script type='text/javascript'>alert('Repuesto Agotado');window.location.replace('".constant('URL')."notas/nuevaNota');</script>";                
                    }
                }else {
                    echo "<script type='text/javascript'>alert('No hay ningun Repuesto con este Codigo');window.location.replace('".constant('URL')."notas/nuevaNota');</script>";                
                }
            
            }

            //PROCESOS DE VENTA Y CARRO DE COMPRAS PARA LAS NOTAS DE ENTREGA
            if (isset($_POST['codigoVenta'])) {

                $codigoRep = $_POST['codigoVenta'];
                $ct = count($codigoRep);
                session_start();
                    for ($i=0; $i < $ct ; $i++) { 
                        //echo "<script type='text/javascript'>alert('".$ct."');</script>";
                        $repuesto = $this->model->getRepuestoForCode($codigoRep[$i]);
                        $cantidadVenta = $_POST['cantidad'];
                        if ($repuesto->cantidadRep < $cantidadVenta[$i]) {
                            echo "<script type='text/javascript'>alert('La Cantidad Solicitada es Superior a la Disponible en Inventario');window.location.replace('".constant('URL')."notas/nuevaNota');</script>";                
                        }elseif ($cantidadVenta[$i] < 0) {
                            echo "<script type='text/javascript'>alert('No puedes Introducir ningun numero Menor o Igual a Cero (0)');window.location.replace('".constant('URL')."notas/nuevaNota');</script>";                
                        }elseif($cantidadVenta[$i] == 0){
                            //NO HACEMOS NADA
                        }else {
                            
                            if (isset($_SESSION['notaDeEntrega'])) {
                                if(count($_SESSION['notaDeEntrega']) > 49){
                                    echo "<script type='text/javascript'>alert('Solo Puedes Ingresar 50 Objetos por Nota de Entrega');window.location.replace('".constant('URL')."notas/nuevaNota');</script>";                
                                }else{
                                $auxNotaDeEntrega = $_SESSION['notaDeEntrega'];
                                $sumaCantidades = $cantidadVenta[$i];
                                $nuevaNotaDeEntrega = [];
                                $detector = false;
                                foreach ($auxNotaDeEntrega as $row) {
                                    if ($repuesto->codigoRep == $row->codigoRep) {
                                        $detector = true;
                                        $row->cantidadRep += $sumaCantidades;
                                        if ($repuesto->cantidadRep < $row->cantidadRep) {
                                            echo "<script type='text/javascript'>alert('La Cantidad Solicitada es Superior a la Disponible en Inventario');window.location.replace('".constant('URL')."notas/nuevaNota');</script>";                
                                        }else {
                                            array_push($nuevaNotaDeEntrega, $row);
                                        }
                                    }else {
                                        array_push($nuevaNotaDeEntrega, $row);
                                    }
                                }
                                if (!$detector) {
                                    $repuesto->cantidadRep = $cantidadVenta[$i];
                                    array_push($auxNotaDeEntrega, $repuesto);
                                    $_SESSION['notaDeEntrega'] = $auxNotaDeEntrega;   
                                }else {
                                    $_SESSION['notaDeEntrega'] = $nuevaNotaDeEntrega;
                                }
                            }
                            }else {                
                                $repuesto->cantidadRep = $cantidadVenta[$i];
                                $notaDeEntrega[0] = $repuesto;
                                $_SESSION['notaDeEntrega'] = $notaDeEntrega;
                            }
                        }
                    }
                $this->view->render('notas/index');
            }


            $this->view->render('notas/index');
        }
         ################################################
        ##//     PARA EL MODULO DE COTIZACION       //##
        ################################################
        function cotizacion(){

            $tipos = $this->model->getAllFromTipo();
            $this->view->tipos = $tipos;
            if (isset($_POST['idTipo'])) {
                $tipo = $_POST['idTipo'];
                $repuesto = $this->model->getRepuestoForTipo($tipo);
                $descripcion = $this->model->getTipoById($tipo);
            
                $this->view->repuesto = $repuesto;
                $this->view->descrip = $descripcion;
                $this->view->render('notas/cotizacion');
            }

            if (isset($_POST['codigoRep'])) {
                
                $codigoRep = $_POST['codigoRep'];
                if($repuesto = $this->model->getRepuestoForCode($codigoRep)){
                    if ($repuesto->cantidadRep > 0) {
                        $this->view->repuesto = $repuesto;
                        $this->view->render('notas/cotizacion');
                    }else{
                        echo "<script type='text/javascript'>alert('Repuesto Agotado');window.location.replace('".constant('URL')."notas/cotizacion');</script>";                
                    }
                }else {
                    echo "<script type='text/javascript'>alert('No hay ningun Repuesto con este Codigo');window.location.replace('".constant('URL')."notas/cotizacion');</script>";                
                }
            
            }

            //PROCESOS DE VENTA Y CARRO DE COMPRAS PARA LAS NOTAS DE ENTREGA
            if (isset($_POST['codigoVenta'])) {

                $codigoRep = $_POST['codigoVenta'];
                $ct = count($codigoRep);
                session_start();
                    for ($i=0; $i < $ct ; $i++) { 
                        //echo "<script type='text/javascript'>alert('".$ct."');</script>";
                        $repuesto = $this->model->getRepuestoForCode($codigoRep[$i]);
                        $cantidadVenta = $_POST['cantidad'];
                        if ($cantidadVenta[$i] < 0) {
                            echo "<script type='text/javascript'>alert('No puedes Introducir ningun numero Menor o Igual a Cero (0)');window.location.replace('".constant('URL')."notas/cotizacion');</script>";                
                        }elseif($cantidadVenta[$i] == 0){
                            //NO HACEMOS NADA
                        }else {
                            
                            if (isset($_SESSION['cotizacion'])) {
                                if(count($_SESSION['cotizacion']) > 49){
                                    echo "<script type='text/javascript'>alert('Solo Puedes Ingresar 50 Objetos por Cotizacion');window.location.replace('".constant('URL')."notas/cotizacion');</script>";                
                                }else{
                                    $auxNotaDeEntrega = $_SESSION['cotizacion'];
                                    $sumaCantidades = $cantidadVenta[$i];
                                    $nuevaNotaDeEntrega = [];
                                    $detector = false;
                                    foreach ($auxNotaDeEntrega as $row) {
                                        if ($repuesto->codigoRep == $row->codigoRep) {
                                            $detector = true;
                                            $row->cantidadRep += $sumaCantidades;
                                            array_push($nuevaNotaDeEntrega, $row);
                                        }else {
                                            array_push($nuevaNotaDeEntrega, $row);
                                        }
                                }
                                if (!$detector) {
                                    $repuesto->cantidadRep = $cantidadVenta[$i];
                                    array_push($auxNotaDeEntrega, $repuesto);
                                    $_SESSION['cotizacion'] = $auxNotaDeEntrega;   
                                }else {
                                    $_SESSION['cotizacion'] = $nuevaNotaDeEntrega;
                                }
                            }
                            }else {                
                                $repuesto->cantidadRep = $cantidadVenta[$i];
                                $notaDeEntrega[0] = $repuesto;
                                $_SESSION['cotizacion'] = $notaDeEntrega;
                            }
                        }
                    }
                $this->view->render('notas/cotizacion');
            }


            $this->view->render('notas/cotizacion');
        }

        function destroyNotaDeEntrega(){
            unset($_SESSION['notaDeEntrega']);
        }

        function verListadoNotas(){

            if (isset($_POST['codigoVenta'])) {
                $codigoVenta = $_POST['codigoVenta'];
                $ventas = $this->model->getAllFromVentasByCodigo($codigoVenta);
                $this->view->ventas = $ventas;
                $this->view->render('notas/listanotas');
            }elseif (isset($_POST['fechaInicio'])) {
                $f1 = $_POST['fechaInicio'];
                $f2 = $_POST['fechaFinal'];
                $ventas = $this->model->getAllFromVentasByFecha($f1,$f2);
                $this->view->ventas = $ventas;
                $this->view->render('notas/listanotas');
            }else {   
                $ventas = $this->model->getAllFromVentas();
                $this->view->ventas = $ventas;
                $this->view->render('notas/listanotas');
            }
        }

        function verNotasVendedor($param = NULL){
            $idVendedor = $param[0];
            $this->view->id = $idVendedor;
            $codigoVendedor = $this->model->getVendedor($idVendedor);
           if (isset($_POST['fechaInicio'])) {
                $f1 = $_POST['fechaInicio'];
                $f2 = $_POST['fechaFinal'];
                $ventas = $this->model->getAllFromVentasByFechaAndVendedor($f1,$f2,$codigoVendedor);
                $this->view->ventas = $ventas;
                $this->view->render('notas/notasvendedor');
            }else {   
                $ventas = $this->model->getAllFromVentasByVendedor($codigoVendedor);
                $this->view->ventas = $ventas;
                $this->view->render('notas/notasvendedor');
            }
        }


        

    }  


?>