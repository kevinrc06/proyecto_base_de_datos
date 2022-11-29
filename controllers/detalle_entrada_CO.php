<?php

require_once "models/detalle_entrada_MO.php";

class detalle_entrada_CO
{

  function __construct()
  {
  }

  function agregardetalle_entrada()
  {

    $conexion = new conexion();

    $detalle_entrada_MO = new  detalle_entrada_MO($conexion);
   
    $ordinal_entrada = htmlentities($_POST['ordinal_entrada'], ENT_QUOTES);
    $consecutivo_entrada = htmlentities($_POST['consecutivo_entrada'], ENT_QUOTES);
    $id_producto = htmlentities($_POST['id_producto'], ENT_QUOTES);

    $cantidad = htmlentities($_POST['cantidad'], ENT_QUOTES);
    $precio = htmlentities($_POST['precio'], ENT_QUOTES);

    if ( empty($ordinal_entrada) or empty($consecutivo_entrada) or empty($id_producto) or empty($cantidad) or empty($precio)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($ordinal_entrada) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo deber ser menor de 2 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }

   

    $detalle_entrada_MO->agregardetalle_entrada($ordinal_entrada,$id_producto,$cantidad, $precio, $consecutivo_entrada);
    /*$familia= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizardetalle_entrada()
  {

    $conexion = new conexion();
    $detalle_entrada_MO = new  detalle_entrada_MO($conexion);
 

    $ordinal_entrada = htmlentities($_POST['ordinal_entrada'], ENT_QUOTES);
    $consecutivo_entrada = htmlentities($_POST['consecutivo_entrada'], ENT_QUOTES);
    $id_producto = htmlentities($_POST['id_producto'], ENT_QUOTES);

    $cantidad = htmlentities($_POST['cantidad'], ENT_QUOTES);
    $precio = htmlentities($_POST['precio'], ENT_QUOTES);
    

    if (  empty($consecutivo_entrada) or empty($id_producto) or empty($cantidad) or empty($precio)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
   
    $detalle_entrada_MO->actualizardetalle_entrada($ordinal_entrada,$consecutivo_entrada,$id_producto,$cantidad, $precio);

    $actualizado = $conexion->filasAfectadas();

    if ($actualizado) {

      $mensaje = "Registro Actualizado";
      $estado = 'EXITO';
    } else {

      $mensaje = "No se realizaron cambios";
      $estado = 'ADVERTENCIA';
    }

    $arreglo_respuesta = [
      "estado" => $estado,
      "mensaje" => $mensaje
    ];

    exit(json_encode($arreglo_respuesta, true));
   
  }
}
