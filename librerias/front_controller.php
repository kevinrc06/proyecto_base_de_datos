<?php
class front_controller
{
    function __construct($ruta)
    {
            if(empty($ruta)){
            require_once "view/menu_VI.php";
            $menu_VI= new menu_VI();
            $menu_VI->verMenu();
            }else
           { 
                list($clase,$metodo)=explode('/',$ruta);
                $sufijo=substr($clase,'-2');
                if ($sufijo=='VI') {
                    $carpeta='view';
                }   
                else if( $sufijo=='CO'){

                        $carpeta='controllers';

                    }else{
                        exit('ERROR: sufijo no enviado');
                    }
                    require_once $carpeta."/".$clase.".php";
                    $instancia=new $clase();
                    $instancia->$metodo();
           }

    }
}
?>