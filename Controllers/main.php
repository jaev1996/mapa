<?php

    class Main extends Controller{

        function __construct(){
            parent::__construct();
            //echo "<p>Funcion Main</p>";
        }

        function saludo(){
            echo "<p>Metodo Saludo</p>";            
        }

        function render(){
            $this->view->render('main/index');
        }

        

    }


?>