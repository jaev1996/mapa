<?php

    class Bugs extends Controller{
        
        function __construct(){
            parent::__construct();
            $this->view->mensaje = "Error al cargar Recurso";
            $this->view->render('error/index');
            //echo "<p>Error al Cargar Recurso</p>";
        }
    }
?>