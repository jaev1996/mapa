<?php

    class Ayuda extends Controller{
        
        function __construct(){
            parent::__construct();
            //echo "<p>Error al Cargar Recurso</p>";
        }

        function render(){
            $this->view->render('ayuda/index');
        }

        function showstats(){
            $this->view->render('ayuda/stats');
        }
    }
?>