<?php
class producto_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarproducto($id_producto,$id_marca,$id_categoria,$nombre_producto, $stock, $precio_unitario, $descripcion_producto)
  {

    $sql = "insert into tienda.producto (id_producto,id_marca,id_categoria,nombre_producto, stock, precio_unitario, descripcion_producto) values ('$id_producto','$id_marca','$id_categoria','$nombre_producto', '$stock', '$precio_unitario', '$descripcion_producto' )";

    $this->conexion->consultar($sql);
  }
  function actualizarproducto($id_producto,$id_marca,$id_categoria,$nombre_producto, $stock, $precio_unitario, $descripcion_producto)
  {

    $sql = "update tienda.producto set id_marca='$id_marca',id_categoria='$id_categoria',nombre_producto='$nombre_producto', stock='$stock', precio_unitario='$precio_unitario', descripcion_producto='$descripcion_producto'  where id_producto='$id_producto'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($id_producto = '')
  {

    if (empty($id_producto)) {

      $sql = "select * from tienda.producto";
    } else {

      $sql = "select * from tienda.producto where id_producto='$id_producto'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_producto($id_producto = '')
  {
    if ($id_producto) {

      $sql = "select * from tienda.producto where id_producto='$id_producto'";
    } else {

      $sql = "select * from tienda.producto";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_nombre($nombre_producto = '')
  {
    if ($nombre_producto) {

      $sql = "select * from tienda.producto where nombre_producto='$nombre_producto'";
    } else {

      $sql = "select * from tienda.producto";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
