<?php
class entrada_MO
{
  private $conexion;
  function __construct($conexion)
  {

    $this->conexion = $conexion;
  }

  function agregarentrada($id_usuario,$fecha_entrada)
  {

    $sql = "insert into tienda.entrada (consecutivo_entrada,id_usuario,fecha_entrada) values (default,'$id_usuario','$fecha_entrada')";

    $this->conexion->consultar($sql);
  }
  function actualizarentrada($consecutivo_entrada,$id_usuario,$fecha_entrada)
  {

    $sql = "update tienda.entrada set  id_usuario='$id_usuario',fecha_entrada='$fecha_entrada'  where consecutivo_entrada='$consecutivo_entrada'";

    $this->conexion->consultar($sql);
  }

  function seleccionar($consecutivo_entrada = '')
  {

    if (empty($consecutivo_entrada)) {

      $sql = "select * from tienda.entrada";
    } else {

      $sql = "select * from tienda.entrada  where consecutivo_entrada='$consecutivo_entrada'";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionar_entrada($consecutivo_entrada = '')
  {
    if ($consecutivo_entrada) {

      $sql = "select * from tienda.entrada where consecutivo_entrada='$consecutivo_entrada'";
    } else {

      $sql = "select * from tienda.entrada";
    }

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
  function seleccionarMax()
  {
    $sql = "select max(consecutivo_entrada) as mayor from tienda.entrada";

    $this->conexion->consultar($sql);

    $arreglo = $this->conexion->extraerRegistro();

    return $arreglo;
  }
}
