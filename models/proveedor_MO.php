<?php
class proveedor_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarProveedor($proveedor, $nombre, $direccion, $telefono)
  {

    $sql = "insert into tienda.proveedor (id_proveedor, nombre_proveedor, direccion, telefono) values ('$proveedor','$nombre','$direccion','$telefono' )";

    $this->conexion->consultar($sql);
  }
  function actualizarproveedor($proveedor, $nombre, $direccion, $telefono, $proveedor_org)
  {

    $sql = "update tienda.proveedor set nombre_proveedor='$nombre', direccion='$direccion', telefono='$telefono', id_proveedor='$proveedor'   where id_proveedor='$proveedor_org'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($id_proveedor = '')
  {

    if (empty($id_proveedor)) {

      $sql = "select * from tienda.proveedor";
    } else {

      $sql = "select * from tienda.proveedor where id_proveedor ='$id_proveedor'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_codigo($proveedor = '')
  {
    if ($proveedor) {

      $sql = "select * from tienda.proveedor where id_proveedor='$proveedor'";
    } else {

      $sql = "select * from tienda.proveedor";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
