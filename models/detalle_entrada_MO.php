<?php
class detalle_entrada_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregardetalle_entrada($ordinal_entrada,$id_producto,$cantidad, $precio, $consecutivo_entrada)
  {

    $sql = "insert into tienda.detalle_entrada (ordinal_entrada,id_producto,cantidad, precio, consecutivo_entrada) values ('$ordinal_entrada','$id_producto','$cantidad', '$precio', '$consecutivo_entrada')";

    $this->conexion->consultar($sql);
  }
  function actualizardetalle_entrada($ordinal_entrada,$consecutivo_entrada,$id_producto,$cantidad, $precio)
  {

    $sql = "update tienda.detalle_entrada set id_producto='$id_producto',cantidad='$cantidad', precio='$precio' where ordinal_entrada='$ordinal_entrada' and consecutivo_entrada='$consecutivo_entrada' ";

    $this->conexion->consultar($sql);
  }

  function seleccionar($ordinal_entrada = '', $consecutivo_entrada='')
  {

    if (empty($ordinal_entrada)or empty($consecutivo_entrada)) {

      $sql = "select * from tienda.detalle_entrada";
    } else {

      $sql = "select * from tienda.detalle_entrada  where ordinal_entrada='$ordinal_entrada' and consecutivo_entrada='$consecutivo_entrada'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_detalle_entrada($ordinal_entrada = '', $consecutivo_entrada='')
  {
    if ($ordinal_entrada and $consecutivo_entrada) {

      $sql = "select * from tienda.detalle_entrada where ordinal_entrada='$ordinal_entrada' and consecutivo_entrada='$consecutivo_entrada'";
    } else {

      $sql = "select * from tienda.detalle_entrada";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
