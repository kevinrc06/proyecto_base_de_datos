<?php
class usuario_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function seleccionar($id_usuario= '')
  {

    if (empty($id_usuario)) {

      $sql = "select * from tienda.usuario";
    } else {

      $sql = "select * from tienda.usuario where id_usuario='$id_usuario'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function actualizarusuario($id_usuario,$usuario,$contrasena)
  {

    $sql = "update usuario set usuario='$usuario',contrasena='$contrasena'  where id_usuario='$id_usuario'";

    $this->conexion->consultar($sql);
  }
 
}