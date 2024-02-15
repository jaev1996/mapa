<?php
require_once 'Controllers/error.php';
    class App{

        function __construct(){
            //echo "<p>Nueva App</p>";
            $url = $_GET['url'];
            $url = rtrim($url,'/');
            $url = explode('/', $url);
            //A partir de archivo controller obtenemos la url para identificar el controlador y el metodo 

            if (empty($url[0])) {
                $archivoController='Controllers/main.php';
                require_once $archivoController;
                $controller = new Main();
                $controller->loadModel('main');
                $controller->render();
                return false;
            }

            $archivoController = 'Controllers/'.$url[0].'.php';
            
            //Verificamos si el Archivo Controlador Existe
            if(file_exists($archivoController)){
                require_once $archivoController;
                $controller = new $url[0];
                $controller->loadModel($url[0]);

                $nparam = sizeof($url);
                if ($nparam > 1) {
                    if ($nparam >2) {
                        $param = [];
                        for ($i=2; $i < $nparam; $i++) { 
                            array_push($param, $url[$i]);
                        }
                        $controller->{$url[1]}($param);
                    }else {
                        $controller->{$url[1]}();
                    }
                }else {
                    $controller->render();
                }
                //Verificamos si se esta llamando a un metodo del controllador
            }else{
                //Notifica que hay un error en la URL del controllador
                $controller = new Bugs();
            }
            
            //var_dump($url);
        }       
    }

?>