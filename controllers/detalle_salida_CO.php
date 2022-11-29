<?php

require_once "models/detalle_salida_MO.php";

class detalle_salida_CO
{

  function __construct()
  {
  }

  function agregardetalle_salida()
  {

    $conexion = new conexion();

    $detalle_salida_MO = new  detalle_salida_MO($conexion);
   
    $ordinal_salida = htmlentities($_POST['ordinal_salida'], ENT_QUOTES);
    $consecutivo_salida = htmlentities($_POST['consecutivo_salida'], ENT_QUOTES);
    $id_producto = htmlentities($_POST['id_producto'], ENT_QUOTES);

    $cantidad = htmlentities($_POST['cantidad'], ENT_QUOTES);
    $precio = htmlentities($_POST['precio'], ENT_QUOTES);


    if ( empty($ordinal_salida) or empty($consecutivo_salida) or empty($id_producto) or empty($cantidad) or empty($precio)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($ordinal_salida) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo deber ser menor de 2 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    
 

    $detalle_salida_MO->agregardetalle_salida($ordinal_salida,$id_producto,$cantidad, $precio, $consecutivo_salida);
    /*$familia= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizardetalle_salida()
  {

    $conexion = new conexion();
    $detalle_salida_MO = new  detalle_salida_MO($conexion);
 

    $ordinal_salida = htmlentities($_POST['ordinal_salida'], ENT_QUOTES);
    $consecutivo_salida = htmlentities($_POST['consecutivo_salida'], ENT_QUOTES);
    $id_producto = htmlentities($_POST['id_producto'], ENT_QUOTES);

    $cantidad = htmlentities($_POST['cantidad'], ENT_QUOTES);
    $precio = htmlentities($_POST['precio'], ENT_QUOTES);
    
    if ( empty($consecutivo_salida) or empty($id_producto) or empty($cantidad) or empty($precio)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
   
    $detalle_salida_MO->actualizardetalle_salida($ordinal_salida,$consecutivo_salida,$id_producto,$cantidad, $precio);

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
