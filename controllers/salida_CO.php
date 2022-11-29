<?php

require_once "models/salida_MO.php";

class salida_CO
{

  function __construct()
  {
  }

  function agregarsalida()
  {

    $conexion = new conexion();

    $salida_MO = new  salida_MO($conexion);

    $id_usuario = htmlentities($_POST['id_usuario'], ENT_QUOTES);
    $fecha_salida = htmlentities($_POST['fecha_salida'], ENT_QUOTES);
   
    if ( empty($id_usuario) or empty($fecha_salida)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }



  
 

    $salida_MO->agregarsalida($id_usuario,$fecha_salida);
    /*$id_marca= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarsalida()
  {

    $conexion = new conexion();

    $salida_MO = new  salida_MO($conexion);
   
    $consecutivo_salida = htmlentities($_POST['consecutivo_salida'], ENT_QUOTES);
    $id_usuario = htmlentities($_POST['id_usuario'], ENT_QUOTES);
    $fecha_salida = htmlentities($_POST['fecha_salida'], ENT_QUOTES);
   
    if (empty($id_usuario) or empty($fecha_salida)) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    

    $salida_MO->actualizarsalida($consecutivo_salida,$id_usuario,$fecha_salida);

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
