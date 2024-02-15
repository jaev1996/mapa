<?php

    class Login extends Controller{

        function __construct(){
            parent::__construct();
            //echo "<p>Funcion Main</p>";
        }

        function saludo(){
            echo "<p>Metodo Saludo</p>";            
        }

        function render(){
            $this->view->render('login/index');
        }
        function validarSession(){
            $var = isset($_SESSION['user']); 
            if ($var == false) {
                echo "<script type='text/javascript'>alert('¡Debe Iniciar Sesion para poder acceder!');window.history.back(1);</script>";                
            }
        }
        function cerrarSession(){
            session_start();
            session_destroy();
    echo "<script type='text/javascript'>alert('¡Su Sesion ha Culminado!');window.location.replace('".constant('URL')."login/');</script>";
        }

        function iniciarSession(){
            $user  = $_POST['user'];
            $clave = $_POST['pass'];
            $start = $this->model->getDataLogin($user, $clave);
            if($start != false){
                session_start();
                $_SESSION['user'] = $start->nombreUser." ".$start->apellidoUser;

                echo "<script type='text/javascript'>alert('Sus Datos Son Correctos');window.location.replace('../main');</script>";
            }else{
                echo "<script type='text/javascript'>alert('Sus Datos No Son Correctos');window.history.back(1);</script>";
                
            }

        }
        function actualizar(){
            //$this->validarSession();
            $user = $this->model->getData();
            $this->view->user = $user;
            $this->view->render('login/actualizar');

        }
        function updUserData(){
            //$this->validarSession();

                $nombre     = $_POST['nombre'];
                $apellido   = $_POST['apellido'];
                $cedula     = $_POST['cedula'];
                $id         = $_POST['idUser'];
    
                if ($this->model->updateUserData([
                                            'nombre'     => $nombre,
                                            'apellido'    => $apellido,
                                            'cedula'  => $cedula,
                                            'id'    => $id])) {

                    echo "<script type='text/javascript'>alert('Se ha Actualizado con Exito');window.location.replace('".constant('URL')."login/actualizar/');</script>";
                }else {
                    echo "<script type='text/javascript'>alert('Error al Actualizar');window.location.replace('".constant('URL')."login/actualizar/');</script>";               
                }
        }

        function updDataAccess(){
            //$this->validarSession();
            
            $clave     = $_POST['clave'];
            $user   = $_POST['user'];
            $confirmar     = $_POST['confirmar'];
            $id         = $_POST['idUser'];
            if ($this->model->confirmarClave($id, $confirmar)) {
                if ($this->model->updateDataAccess([
                    'clave'     => $clave,
                    'usuario'    => $user,
                    'id'    => $id])) {

                echo "<script type='text/javascript'>alert('Se ha Actualizado con Exito');window.location.replace('".constant('URL')."login/actualizar/');</script>";
                }else {
                echo "<script type='text/javascript'>alert('Error al Actualizar');window.location.replace('".constant('URL')."login/actualizar/');</script>";               
                }
            }else{
                echo "<script type='text/javascript'>alert('La Clave de Confirmacion que ha Ingresado, no es Correcta.');window.location.replace('".constant('URL')."login/actualizar/');</script>";               
            }
            
    }

    }


?>