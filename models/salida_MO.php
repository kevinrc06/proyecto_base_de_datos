<?php
class salida_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarsalida($id_usuario,$fecha_salida)
  {

    $sql = "insert into tienda.salida (consecutivo_salida,id_usuario,fecha_salida) values (default,'$id_usuario','$fecha_salida')";

    $this->conexion->consultar($sql);
  }
  function actualizarsalida($consecutivo_salida,$id_usuario,$fecha_salida)
  {

    $sql = "update tienda.salida set  id_usuario='$id_usuario',fecha_salida='$fecha_salida'  where consecutivo_salida='$consecutivo_salida'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($consecutivo_salida = '')
  {

    if (empty($consecutivo_salida)) {

      $sql = "select * from tienda.salida";
    } else {

      $sql = "select * from tienda.salida  where consecutivo_salida='$consecutivo_salida'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_salida($consecutivo_salida = '')
  {
    if ($consecutivo_salida) {

      $sql = "select * from tienda.salida where consecutivo_salida='$consecutivo_salida'";
    } else {

      $sql = "select * from tienda.salida";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionarMax()
  {
    $sql = "select max(consecutivo_salida) as mayor from tienda.salida";

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
