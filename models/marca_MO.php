<?php
class marca_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarMarca($marca, $nombre)
  {

    $sql = "insert into tienda.marca (id_marca, nombre_marca) values ('$marca','$nombre' )";

    $this->conexion->consultar($sql);
  }
  function actualizarmarca($marca, $nombre,$marca_org)
  {

    $sql = "update tienda.marca set nombre_marca='$nombre', id_marca='$marca'   where id_marca='$marca_org'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($id_marca = '')
  {

    if (empty($id_marca)) {

      $sql = "select * from tienda.marca";
    } else {

      $sql = "select * from tienda.marca where id_marca ='$id_marca'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_codigo($marca = '')
  {
    if ($marca) {

      $sql = "select * from tienda.marca where id_marca='$marca'";
    } else {

      $sql = "select * from tienda.marca";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }

  function seleccionar_nombre($nombre = '')
  {
    if ($nombre) {

      $sql = "select * from tienda.marca where nombre_marca='$nombre'";
    } else {

      $sql = "select * from tienda.marca";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
