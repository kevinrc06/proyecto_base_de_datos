<?php
class suministro_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarsuministro($id_suministro,$id_producto,$id_proveedor,$cantidad_producto, $fecha)
  {

    $sql = "insert into tienda.suministro (id_suministro,id_producto,id_proveedor,cantidad_producto, fecha) values ('$id_suministro','$id_producto','$id_proveedor','$cantidad_producto',' $fecha')";

    $this->conexion->consultar($sql);
  }
  function actualizarsuministro($id_suministro,$id_producto,$id_proveedor,$cantidad_producto, $fecha)
  {

    $sql = "update tienda.suministro set id_producto='$id_producto',id_proveedor='$id_proveedor',cantidad_producto='$cantidad_producto', fecha='$fecha' where id_suministro='$id_suministro'";

    $this->conexion->consultar($sql);
  }

  function delateUser($cod)
  {
    $sql = "delete from tienda.suministro where id_suministro='$cod'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($id_suministro = '')
  {

    if (empty($id_suministro)) {

      $sql = "select * from tienda.suministro";
    } else {

      $sql = "select * from tienda.suministro where id_suministro='$id_suministro'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_suministro($id_suministro = '')
  {
    if ($id_suministro) {

      $sql = "select * from tienda.suministro where id_suministro='$id_suministro'";
    } else {

      $sql = "select * from tienda.suministro";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
