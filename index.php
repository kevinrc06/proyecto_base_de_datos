<?php
require_once "librerias/constantes.php";
require_once "librerias/conexion.php";
      if(isset($_SESSION['id_usuario']))
      {

          require_once "librerias/front_controller.php";
          
          if(isset($_GET['ruta'])){
            $ruta=$_GET['ruta'];
          }else{
            $ruta='';}

          $front_controller=new front_controller($ruta);

      }else if(isset($_POST['usuario']) and isset($_POST['clave'])){
          $usuario=$_POST['usuario'];
          $clave=$_POST['clave']; 
          require_once "controllers/accesos_CO.php";

          $accesos_CO=new  accesos_CO ();
          $accesos_CO->iniciarSesion($usuario,$clave);
      }
        else
      {
          require_once "view/accesos_VI.php";
          $accesos_VI=new accesos_VI();
          $accesos_VI->iniciarSesion();
      }

?>