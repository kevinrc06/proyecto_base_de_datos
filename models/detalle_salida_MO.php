<?php
class detalle_salida_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregardetalle_salida($ordinal_salida,$id_producto,$cantidad, $precio, $consecutivo_salida)
  {

    $sql = "insert into tienda.detalle_salida (ordinal_salida,id_producto,cantidad, precio, consecutivo_salida) values ('$ordinal_salida','$id_producto','$cantidad', '$precio', '$consecutivo_salida')";

    $this->conexion->consultar($sql);
  }
  function actualizardetalle_salida($ordinal_salida,$consecutivo_salida,$id_producto,$cantidad, $precio)
  {

    $sql = "update tienda.detalle_salida set id_producto='$id_producto',cantidad='$cantidad', precio='$precio' where ordinal_salida='$ordinal_salida' and consecutivo_salida='$consecutivo_salida' ";

    $this->conexion->consultar($sql);
  }

  function seleccionar($ordinal_salida = '', $consecutivo_salida='')
  {

    if (empty($ordinal_salida)or empty($consecutivo_salida)) {

      $sql = "select * from tienda.detalle_salida";
    } else {

      $sql = "select * from tienda.detalle_salida  where ordinal_salida='$ordinal_salida' and consecutivo_salida='$consecutivo_salida'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_detalle_salida($ordinal_salida = '', $consecutivo_salida='')
  {
    if ($ordinal_salida and $consecutivo_salida) {

      $sql = "select * from tienda.detalle_salida where ordinal_salida='$ordinal_salida' and consecutivo_salida='$consecutivo_salida'";
    } else {

      $sql = "select * from tienda.detalle_salida";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
