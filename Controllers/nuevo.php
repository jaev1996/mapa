<?php
    class Nuevo extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "";
            //echo "<p>Funcion Main</p>";
        }

        function render(){
            $this->view->render('nuevo/index');
        }
        function nrepuesto(){
            $marcas = $this->model->getAllFromMarca();
            $tipos = $this->model->getAllFromTipo();
            $this->view->tipos = $tipos;
            $this->view->marcas = $marcas;
            $this->view->render('nuevo/repuesto');
        }
        function ncliente(){
            $vendedor = $this->model->getAllFromVendedor();
            $this->view->vendedor = $vendedor;


            $this->view->render('nuevo/cliente');
        }
        function nproveedor(){
            $this->view->render('nuevo/proveedor');
        }
        function nvendedor(){
            $this->view->render('nuevo/vendedor');
        }
        function nmarca(){
            $this->view->render('nuevo/marca');
        }
        function ntipo(){
            $this->view->render('nuevo/tipo');
        }

        function nuevoRep(){
            $codigoRep   = $_POST['codigoRep'];
            $descripRep  = $_POST['descripRep'];
            $cantidadRep = $_POST['cantidadRep'];
            $precioRep   = $_POST['precioRep'];
            $idMarca     = $_POST['idMarca'];
            $idTipo      = $_POST['idTipo'];
            $ubicRep     = $_POST['ubicRep'];

            if($idMarca == "NULL" || $idTipo == "NULL"){
                echo "<script type='text/javascript'>alert('Debe Seleccionar la Marca y el Tipo de Repuesto');window.location.replace('".constant('URL')."nuevo/nrepuesto');</script>";
            }elseif($this->model->getRepuestoById($codigoRep)) {
                echo "<script type='text/javascript'>alert('No se pudo Registrar porque este Codigo ya esta en Uso');window.location.replace('".constant('URL')."nuevo/nrepuesto');</script>";
            }else {          
                if($this->model->insertRep([    'codigoRep'   => $codigoRep, 
                                                'descripRep'  => $descripRep, 
                                                'cantidadRep' => $cantidadRep,
                                                'idMarca'     => $idMarca,
                                                'idTipo'      => $idTipo,
                                                'ubicRep'     => $ubicRep,
                                                'precioRep'   => $precioRep])){
                    echo "<script type='text/javascript'>alert('Registro realizado con Exito');window.location.replace('".constant('URL')."nuevo/nrepuesto');</script>";
    
                }else {
                    echo "<script type='text/javascript'>alert('Ha ocurrido un Error!');</script>";                 
                }
            }

        }

        function nuevoCliente(){

            $cod1  = $_POST['tipoDoc'];
            $cod2  = $_POST['codigoCliente'];
            $codigoCliente   = $cod1." ".$cod2;
            $nombreCliente   = $_POST['nombreCliente'];
            $telefonoCliente = $_POST['telefonoCliente'];
            $direccionCliente = $_POST['direccionCliente'];
            $idVendedor      = $_POST['idVendedor'];

            if($this->model->getClienteByCodigo($codigoCliente)){
                echo "<script type='text/javascript'>alert('Ya existe este Cliente!');window.location.replace('".constant('URL')."nuevo/ncliente');</script>";                 
            }else{     
                if($this->model->insertCli([    'codigoCliente'   => $codigoCliente, 
                                                'nombreCliente'   => $nombreCliente, 
                                                'direccionCliente'=> $direccionCliente, 
                                                'idVendedor'      => $idVendedor, 
                                                'telefonoCliente' => $telefonoCliente])){
                echo "<script type='text/javascript'>alert('Registro realizado con Exito');window.location.replace('".constant('URL')."nuevo/ncliente');</script>";
    
                }else {
                    echo "<script type='text/javascript'>alert('Ha ocurrido un Error!');</script>";                 
                }
            }


        }
   
        function nuevoProveedor(){
            $codigoProveedor   = $_POST['codigoProveedor'];
            $nombreProveedor   = $_POST['nombreProveedor'];
            $telefonoProveedor = $_POST['telefonoProveedor'];

            if($this->model->insertPro([    'codigoProveedor'   => $codigoProveedor, 
                                            'nombreProveedor'   => $nombreProveedor, 
                                            'telefonoProveedor' => $telefonoProveedor])){
            echo "<script type='text/javascript'>alert('Registro realizado con Exito');window.location.replace('".constant('URL')."nuevo/proveedor');</script>";

            }else {
                echo "<script type='text/javascript'>alert('Ha ocurrido un Error!');</script>";                 
            }
        }
        function nuevoVendedor(){
            $codigoVendedor   = $_POST['codigoVendedor'];
            $nombreVendedor   = $_POST['nombreVendedor'];
            $telefonoVendedor = $_POST['telefonoVendedor'];

            if($this->model->getVendedorByCodigo($codigoVendedor)){
                echo "<script type='text/javascript'>alert('Ya existe este Vendedor!');window.location.replace('".constant('URL')."nuevo/nvendedor');</script>";                 
            }else {    
                if($this->model->insertVend([   'codigoVendedor'   => $codigoVendedor, 
                                                'nombreVendedor'   => $nombreVendedor, 
                                                'telefonoVendedor' => $telefonoVendedor])){
                    echo "<script type='text/javascript'>alert('Registro realizado con Exito');window.location.replace('".constant('URL')."nuevo/nvendedor');</script>";
                    
                }else {
                    echo "<script type='text/javascript'>alert('Ha ocurrido un Error!');</script>";                 
                }
            }
        }
        function nuevoMarca(){
            $descripMarca  = $_POST['descripMarca'];
            if($this->model->getMarcaByDesc($descripMarca)){
                echo "<script type='text/javascript'>alert('Ya existe esta Marca de Repuesto!');window.location.replace('".constant('URL')."nuevo/nmarca');</script>";                 
            }
            else{
                if($this->model->insertMarca(['descripMarca' => $descripMarca])){
                echo "<script type='text/javascript'>alert('Registro realizado con Exito');window.location.replace('".constant('URL')."nuevo/nmarca');</script>";

                }else {
                    echo "<script type='text/javascript'>alert('Ha ocurrido un Error!');</script>";                 
                }
            }

        }
        function nuevoTipo(){
            $descripTipo  = $_POST['descripTipo'];
            if($this->model->getTipoByDesc($descripTipo)){
                echo "<script type='text/javascript'>alert('Ya existe este Tipo de Repuesto!');window.location.replace('".constant('URL')."nuevo/ntipo');</script>";                 
            }
            else{
                if($this->model->insertTipo(['descripTipo' => $descripTipo])){
                echo "<script type='text/javascript'>alert('Registro realizado con Exito');window.location.replace('".constant('URL')."nuevo/ntipo');</script>";

                }else {
                    echo "<script type='text/javascript'>alert('Ha ocurrido un Error!');</script>";                 
                }
            }
        }

    }  


?>