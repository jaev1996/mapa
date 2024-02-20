<?php

    class Consulta extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->afiscal = [];
        }

        function render(){
            $repuesto = $this->model->get();
            $tipo = $this->model->getTipo();
            $this->view->tipo = $tipo;
            $this->view->repuesto = $repuesto;
            $this->view->render('consulta/index');
        }
        function invagotado(){
            $repuesto = $this->model->get();
            $tipo = $this->model->getTipo();
            $this->view->tipo = $tipo;
            $this->view->repuesto = $repuesto;
            $this->view->render('consulta/agotado');
        }
        
        function busqueda(){
            $html = "";
            if (isset($_POST["txtbusca"])) {
                $txtbusca = $_POST["txtbusca"];
                $html = $this->model->getRepuestoByDescAndCod($txtbusca);
                //$u=$user->buscar("repuestos"," descripRep like '%".$_POST['txtbusca']."%' OR codigoRep like '%".$_POST['txtbusca']."%'");
                //return $html;
                /*else:
                echo "Error";
                endif;*/
                //$x = $_POST["txtbusca"];
                echo $html;
            }else {
                $this->view->render('consulta/busqueda');
            }
            
        }
        function searchClientes(){
            $html = "";
            if (isset($_POST["searchSelectVend"])) {
                $search = $_POST["searchSelectVend"];
                $search2 = NULL;
                if (isset($_POST["searchTxtCli"])) {
                    $search2 = $_POST["searchTxtCli"];
                }
                $html = $this->model->getAllFromClienteByVendedor($search, $search2);
                echo  $html;

                
            }elseif (isset($_POST["txtCli"])) {
                $search = $_POST["txtCli"];
                $search2 = $_POST["txtVend"];
                $html = $this->model->getAllFromClienteByNombre($search, $search2);
                echo  $html;
                
            }
            
        }



        function showType(){
            $tipo = $_POST['tipoRep'];
            $repuesto = $this->model->getRepuestoForTipo($tipo);
            $descripcion = $this->model->getTipoById($tipo);
            
            $this->view->repuesto = $repuesto;
            $this->view->tipo = $descripcion;
            $this->view->render('consulta/categoria');
        }
        
        function showDetalle(){
            $code = $_POST['codigoRep'];
            if ($repuesto = $this->model->getRepuestoForCode($code)) {
                $this->view->repuesto = $repuesto;
                $this->view->render('consulta/detalle');
            }
            else{
                echo "<script type='text/javascript'>alert('No hay ningun Repuesto con este Codigo');window.location.replace('".constant('URL')."consulta/');</script>";                

            }  
        }

        function verRepuestos($param = NULL){
            /*$pag = $param[0];
            $afiscal    = $this->model->consultaPaginado($pag);
            $print      = $this->model->get();
            
            $this->view->paginaActual = $pag;
            $this->view->afiscal = $afiscal;
            $this->view->print = $print;*/
            $this->view->render('consulta/repuestos');
        }
        function verMarcas($param = NULL){
            $this->view->render('consulta/marcas');
        }

        function verTipos($param = NULL){
            $this->view->render('consulta/tipos');
        }
        function verClientes($param = NULL){
            //$clientes = $this->model->getAllFromCliente();
            $vendedores = $this->model->getAllFromVendedor();
            $this->view->vendedores = $vendedores;
            $this->view->render('consulta/clientes');
        }
        function verProveedores($param = NULL){
            $this->view->render('consulta/proveedores');
        }
        function verVendedores(){

            $vendedores = $this->model->getAllFromVendedor();
            $this->view->vendedores = $vendedores;
            $this->view->render('actualizar/vendedor');
        }

        function verEstadisticas($param = NULL){

            if (isset($_POST['desdeMes'])) {
                $desde = $_POST['year']."-".$_POST['desdeMes'];
                $hasta = $_POST['year']."-".$_POST['hastaMes'];
                $mostrar = $_POST['tipoRep'];
                echo "<script type='text/javascript'>alert('ENTRO EN FILTRO POR FECHA ".$desde."   ".$hasta."');</script>";                
            $repuesto = $this->model->historicoPorFecha($desde,$hasta,$mostrar);
            $this->view->repuesto = $repuesto;
            $this->view->mostrar  = $mostrar;
            $tipo = $this->model->getTipo();
            $this->view->tipo = $tipo;
            $this->view->xview = 0;
            
            }elseif (isset($_POST['codigoRep'])) {
            echo "<script type='text/javascript'>alert('ENTRO EN FILTRO POR CODIGO');</script>";
            $codigo = $_POST['codigoRep'];
            $repuesto = $this->model->historicoPorCodigo($codigo);
            $this->view->repuesto = $repuesto;
            $tipo = $this->model->getTipo();
            $this->view->tipo = $tipo;                
            $this->view->xview = 1;
            }elseif (isset($_POST['tipoRep'])) {

            echo "<script type='text/javascript'>alert('ENTRO EN FILTRO POR TIPO');</script>";                
            $this->view->xview = 2;
            $tipoRep = $_POST['tipoRep'];
            $repuesto = $this->model->historicoPorTipo($tipoRep);
            $this->view->repuesto = $repuesto;
            $tipoTitle = $this->model->getTipoById($tipoRep);
            $this->view->tipoRep = $tipoTitle;
            $tipo = $this->model->getTipo();
            $this->view->tipo = $tipo;
            
            }else {

            $tipo = $this->model->getTipo();
            $this->view->tipo = $tipo;
            $this->view->xview = 3;
            }

            
            
            $this->view->render('consulta/estadisticas');
        }
        



        function printInventario($param = NULL){
            //$pag = 1;
            //$y = $param[0];
            //$afiscal = $this->model->consultaYear($pag, $y);
            //$this->view->afiscal = $afiscal;
            $this->view->render('consulta/printInventario');
        }

        

    }


?>