<?php
    
    class View{

        function __construct(){
            //echo "<p>Vista Base</p>";
        }

        function render($nombre){
            require_once 'Views/'.$nombre.'.php';
        }
    }

?>