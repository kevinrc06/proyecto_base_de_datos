<?php
class categoria_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarCategoria($categoria, $nombre)
  {

    $sql = "insert into tienda.categoria (id_categoria, nombre_categoria) values ('$categoria','$nombre' )";

    $this->conexion->consultar($sql);
  }
  function actualizarcategoria($categoria, $nombre,$categoria_org)
  {

    $sql = "update tienda.categoria set nombre_categoria='$nombre', id_categoria='$categoria'   where id_categoria='$categoria_org'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($id_categoria = '')
  {

    if (empty($id_categoria)) {

      $sql = "select * from tienda.categoria";
    } else {

      $sql = "select * from tienda.categoria where id_categoria ='$id_categoria'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_codigo($categoria = '')
  {
    if ($categoria) {

      $sql = "select * from tienda.categoria where id_categoria='$categoria'";
    } else {

      $sql = "select * from tienda.categoria";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_nombre($nombre = '')
  {
    if ($nombre) {

      $sql = "select * from tienda.categoria where nombre_categoria='$nombre'";
    } else {

      $sql = "select * from tienda.categoria";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
