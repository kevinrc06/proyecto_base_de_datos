<?php
class accesos_MO{
    private $conexion;
    function __construct($conexion)
    {
     $this->conexion=$conexion;
    }
      function iniciarSesion($usuario,$clave)
    {

      $sql="select id_usuario from tienda.usuario where usuario='$usuario' and contrasena='$clave'";
     
      $this->conexion->consultar($sql);
    
      return $this->conexion->extraerRegistro();
       
    }

   
}
?>
