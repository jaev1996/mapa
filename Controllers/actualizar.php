<?php
    class Actualizar extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->mensaje = "";
            //echo "<p>Funcion Main</p>";
        }

        function render(){
            $this->view->render('nuevo/index');
        }

        function actualizarpastillas(){
            $var = $this->model->actualizarpastillas();
            $this->view->var = $var;
            $this->view->render('actualizar/vercambios');
        }

        function actualizargomas(){
            $var = $this->model->actualizargomas();
            $this->view->var = $var;
            $this->view->render('actualizar/vercambios');
        }

        function actualizarprecios(){
            $var = $this->model->actualizarprecios();
            $this->view->var = $var;
            $this->view->render('actualizar/actualizarprecios');
        }
        function uprepuesto(){

            $tipos = $this->model->getAllFromTipo();
            $this->view->tipos = $tipos;

            if (isset($_POST['idTipo'])) {
                $tipo = $_POST['idTipo'];
                $repuesto = $this->model->getRepuestoForTipo($tipo);
                $descripcion = $this->model->getTipoById($tipo);
            
                $this->view->repuesto = $repuesto;
                $this->view->descrip = $descripcion;
                $this->view->render('actualizar/actrepuesto');
            }

            if (isset($_POST['codigoRep'])) {
                
                $codigoRep = $_POST['codigoRep'];
                if($repuesto = $this->model->getRepuestoForCode($codigoRep)){                  
                        $this->view->repuesto = $repuesto;
                        $this->view->render('actualizar/actrepuesto');
                }else {
                    echo "<script type='text/javascript'>alert('No hay ningun Repuesto con este Codigo');window.location.replace('".constant('URL')."actualizar/uprepuesto');</script>";                
                }
            
            }

            $this->view->render('actualizar/actrepuesto');
            
        }

        function updateRep(){

            $tipos = $this->model->getAllFromTipo();
            $this->view->tipos = $tipos;

            if (isset($_POST['buscaTipo'])) {
                $tipo = $_POST['buscaTipo'];
                $repuesto = $this->model->getRepuestoForTipo2($tipo);
                $descripcion = $this->model->getTipoById($tipo); 
            
            }

            if (isset($_POST['codigoRep'])) {
                
                $codigoRep = $_POST['codigoRep'];
                if($repuesto = $this->model->getRepuestoForCode($codigoRep)){                  
                        $this->view->repuesto = $repuesto;
                        $this->view->render('actualizar/actrepuesto');
                }else {
                    echo "<script type='text/javascript'>alert('No hay ningun Repuesto con este Codigo');window.location.replace('".constant('URL')."actualizar/uprepuesto');</script>";                
                }
            
            }

            $this->view->render('actualizar/actrepuesto');
            
        }
        
        function detallesVendedor($param = NULL){
            $id = $param[0];
            $vendedor = $this->model->getVendedorById($id);
            $this->view->vendedor = $vendedor;
            $this->view->render('actualizar/detallevendedor');
        }

        function detallesCliente($param = NULL){
            $id = $param[0];
            $vendedor = $this->model->getAllFromVendedor();
            $cliente = $this->model->getClienteById($id);
            $this->view->cliente = $cliente;
            $this->view->vendedor = $vendedor;
            $this->view->render('actualizar/detallecliente');
        }


        function actualizarep($param = NULL){
            $codigoRep = $param[0];
            $tipos = $this->model->getAllFromTipo();
            $marcas = $this->model->getAllFromMarca();
            $this->view->tipos = $tipos;
            $this->view->marcas = $marcas;
            if($repuesto = $this->model->getRepuestoForCode($codigoRep)){                  
                $this->view->repuesto = $repuesto;
                $this->view->render('actualizar/repuesto');
            }else {
                echo "<script type='text/javascript'>alert('No hay ningun Repuesto con este Codigo');</script>";                
            }
            $this->view->render('actualizar/repuesto');
        }

        function ejecutaractvend(){
            $codigoVendedor   = $_POST['codigoVendedor'];
            $idVendedor       = $_POST['idVendedor'];
            $nombreVendedor   = $_POST['nombreVendedor'];
            $telefonoVendedor = $_POST['telefonoVendedor'];

            if($resultado = $this->model->getCodigoVendedor($idVendedor, $codigoVendedor)){
                if ($this->model->updateVend([  'codigoVendedor'   => $codigoVendedor, 
                                                'idVendedor'       => $idVendedor, 
                                                'nombreVendedor'   => $nombreVendedor, 
                                                'telefonoVendedor' => $telefonoVendedor])) {
                        echo "<script type='text/javascript'>alert('Actualizado Correctamente');window.location.replace('".constant('URL')."actualizar/detallesVendedor/".$idVendedor."');</script>";                
                        }else {
                            echo "<script type='text/javascript'>alert('No se pudo Realizar la Operacion');window.location.replace('".constant('URL')."actualizar/detallesVendedor/".$idVendedor."');</script>";                
                        }             
                }else {  
                    echo "<script type='text/javascript'>alert('Esta Cedula esta Aignada a Otro Vendedor');window.location.replace('".constant('URL')."actualizar/detallesVendedor/".$idVendedor."');</script>";                    
                }
        }

        function ejecutaractrep(){      
            $codigoRep  = $_POST['codigoRep'];
            $idRep      = $_POST['idRep'];
            $idMarca    = $_POST['idMarca'];
            $descripRep = $_POST['descripRep'];
            $idTipo     = $_POST['idTipo'];
            $cantidadRep= $_POST['cantidadRep'];
            $precioRep  = $_POST['precioRep'];
            $ubicRep    = $_POST['ubicRep'];

            if($resultado = $this->model->getCodigoRepuesto($idRep, $codigoRep)){
                if ($cantidadRep < 0) {
                    echo "<script type='text/javascript'>alert('No puede Ingresar una Cantidad Negativa');window.location.replace('".constant('URL')."actualizar/actualizarep/".$codigoRep."');</script>";                    
                }elseif ($precioRep <= 0) {
                    echo "<script type='text/javascript'>alert('El Monto Asignado no es Valido');window.location.replace('".constant('URL')."actualizar/actualizarep/".$codigoRep."');</script>";                    
                }else {
                    if ($this->model->updateRep([   'codigoRep'   => $codigoRep, 
                                                    'idRep'       => $idRep, 
                                                    'descripRep'  => $descripRep, 
                                                    'cantidadRep' => $cantidadRep,
                                                    'idMarca'     => $idMarca,
                                                    'idTipo'      => $idTipo,
                                                    'ubicRep'     => $ubicRep,
                                                    'precioRep'   => $precioRep])) {
                    echo "<script type='text/javascript'>alert('Actualizado Correctamente');window.location.replace('".constant('URL')."actualizar/actualizarep/".$codigoRep."');</script>";                
                    }else {
                        echo "<script type='text/javascript'>alert('No se pudo Realizar la Operacion');window.location.replace('".constant('URL')."actualizar/actualizarep/".$codigoRep."');</script>";                
                    }
                    
                }
            }else {
                echo "<script type='text/javascript'>alert('Este Codigo ya esta Asignado a Otro Repuesto');window.location.replace('".constant('URL')."actualizar/actualizarep/".$codigoRep."');</script>";                
                
            }
        }


        function ejecutaractrep2(){      
            $conteo = 0;
            $codigoRep  = $_POST['codigoRep'];
            $cantidadRep= $_POST['cantidadRep'];
            $precioRep  = $_POST['precioRep'];
            $ubicRep    = $_POST['ubicRep'];
            $repeticiones = count($codigoRep);
            for ($i=0; $i < $repeticiones; $i++) { 
                    if ($cantidadRep[$i] < 0) {
                        echo "<script type='text/javascript'>alert('No puede Ingresar una Cantidad Negativa');window.location.replace('".constant('URL')."actualizar/uprepuesto');</script>";                    
                    }elseif ($precioRep[$i] <= 0) {
                        echo "<script type='text/javascript'>alert('El Monto Asignado no es Valido');window.location.replace('".constant('URL')."actualizar/uprepuesto');</script>";                    
                    }else {
                        if ($this->model->updateRepMassive([    'codigoRep'   => $codigoRep[$i], 
                                                                'cantidadRep' => $cantidadRep[$i],
                                                                'ubicRep'     => $ubicRep[$i],
                                                                'precioRep'   => $precioRep[$i]])) {
                            $conteo++;
                        }else {
                            echo "<script type='text/javascript'>alert('No se pudo Realizar la Operacion');window.location.replace('".constant('URL')."actualizar/uprepuesto');</script>";                
                        }
                        
                    }
                }
                if ($conteo == $repeticiones) {
                    echo "<script type='text/javascript'>alert('Actualizado Correctamente');window.location.replace('".constant('URL')."actualizar/uprepuesto');</script>";                
                }else {
                    echo "<script type='text/javascript'>alert('Ocurrio un Error al Actualizar ".$conteo."');window.location.replace('".constant('URL')."actualizar/uprepuesto');</script>";                
                    
                }

        }

        function ejecutaractmarca(){     

            $idMarca    = $_POST['idMarca'];
            $descripMarca = $_POST['descripMarca'];
            if ($descripMarca == "") {
                echo "<script type='text/javascript'>alert('Este Campo no puede estar Vacio');window.location.replace('".constant('URL')."actualizar/upmarca/');</script>";                
                
            }elseif($resultado = $this->model->getDescripMarca($idMarca, $descripMarca)){

                    if ($this->model->updateMarca(['descripMarca'   => $descripMarca, 'idMarca'   => $idMarca])) {
                    echo "<script type='text/javascript'>alert('Actualizado Correctamente');window.location.replace('".constant('URL')."actualizar/upmarca/');</script>";                
                    }else {
                        echo "<script type='text/javascript'>alert('No se pudo Realizar la Operacion');window.location.replace('".constant('URL')."actualizar/upmarca/');</script>";                
                    }
                    
            }else {
                echo "<script type='text/javascript'>alert('Esta Marca ya Esta Registrada');window.location.replace('".constant('URL')."actualizar/upmarca/');</script>";                
                
            }
        }

        function ejecutaractipo(){     

            $idTipo    = $_POST['idTipo'];
            $descripTipo = $_POST['descripTipo'];
            if ($descripTipo == "") {
                echo "<script type='text/javascript'>alert('Este Campo no puede estar Vacio');window.location.replace('".constant('URL')."actualizar/uptiporep/');</script>";                
                
            }elseif($resultado = $this->model->getDescripTipo($idTipo, $descripTipo)){

                    if ($this->model->updateTipo(['descripTipo'   => $descripTipo, 'idTipo'   => $idTipo])) {
                    echo "<script type='text/javascript'>alert('Actualizado Correctamente');window.location.replace('".constant('URL')."actualizar/uptiporep/');</script>";                
                    }else {
                        echo "<script type='text/javascript'>alert('No se pudo Realizar la Operacion');window.location.replace('".constant('URL')."actualizar/uptiporep/');</script>";                
                    }
                    
            }else {
                echo "<script type='text/javascript'>alert('Ya Existe Este Tipo de Repuesto');window.location.replace('".constant('URL')."actualizar/uptiporep/');</script>";                
                
            }
        }


        function upcliente(){
            $this->view->render('nuevo/cliente');
        }
        function upproveedor(){
            $this->view->render('nuevo/proveedor');
        }
        function upvendedor(){
            $this->view->render('nuevo/vendedor');
        }
        function upmarca(){
            $marcas = $this->model->getAllFromMarca();
            $this->view->marcas = $marcas;
            $this->view->render('actualizar/marca');
        }
        function uptiporep(){
            $tipos = $this->model->getAllFromTipo();
            $this->view->tipos = $tipos;
            $this->view->render('actualizar/tipo');
        }

        function nuevoRep(){
            $codigoRep   = $_POST['codigoRep'];
            $descripRep  = $_POST['descripRep'];
            $cantidadRep = $_POST['cantidadRep'];
            $precioRep   = $_POST['precioRep'];
            $idMarca     = $_POST['idMarca'];
            $idTipo      = $_POST['idTipo'];

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

            if($this->model->getClienteByCodigo($codigoCliente)){
                echo "<script type='text/javascript'>alert('Ya existe este Cliente!');window.location.replace('".constant('URL')."nuevo/ncliente');</script>";                 
            }else{     
                if($this->model->insertCli([    'codigoCliente'   => $codigoCliente, 
                                                'nombreCliente'   => $nombreCliente, 
                                                'direccionCliente'=> $direccionCliente, 
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