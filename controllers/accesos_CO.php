
<?php
require_once "models/accesos_MO.php";

class accesos_CO
{
    function __construct(){}
    function iniciarSesion($usuario,$clave)
    {
      $conexion=new conexion();
      $accesos_MO=new  accesos_MO ($conexion);
      $arreglo=$accesos_MO->iniciarSesion($usuario,$clave);
      
      if( $arreglo)
      {
         $objeto_accesos=$arreglo[0];
         $id_usuario=$objeto_accesos->id_usuario;
         $_SESSION['id_usuario']= $id_usuario;
      } 
      header('Location: index.php');
    }

   

    function salir()
    {
        session_destroy();
        
    }

}
?>