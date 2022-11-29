<?php

require_once "models/marca_MO.php";

class marca_CO
{

  function __construct()
  {
  }

  function agregarmarca()
  {

    $conexion = new conexion();

    $marca_MO = new  marca_MO($conexion);
   
    $codigo = htmlentities($_POST['codigo'], ENT_QUOTES);
    $nombre=htmlentities($_POST['nombre'], ENT_QUOTES);
   
    if ( empty($codigo) or empty($nombre) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($codigo) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo deber ser menor de 2 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nombre) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del nombres deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
 
    $arreglo_marcas = $marca_MO->seleccionar_codigo($codigo);
    if ($arreglo_marcas) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El codigo ($codigo) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    $arreglo_marcas = $marca_MO->seleccionar_nombre($nombre);
    if ($arreglo_marcas) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El nombre ($nombre) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }


    $marca_MO->agregarmarca( $codigo, $nombre);

    /*$codigo= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "codigo" => $codigo,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarmarca()
  {

    $conexion = new conexion();
    $marca_MO = new  marca_MO($conexion);
 
    $codigo = htmlentities($_POST['codigo'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES);
    $codigo_mar=htmlentities($_POST['codige'], ENT_QUOTES);

    if (  empty($codigo) or empty($nombre) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($codigo) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del codigo debe ser menor de 4 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($nombre) > 30) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del nombre  deber ser menor de 30 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }



    if($codigo == $codigo_mar){
      $marca_MO->actualizarmarca($codigo, $nombre,$codigo_mar);

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
    }else {
      $arreglo_marcas = $marca_MO->seleccionar_codigo($codigo);
      if ($arreglo_marcas) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El codigo ($codigo) esta duplicado"

        ];

        exit(json_encode($arreglo_respuesta));
      }

    }
    $marca_MO->actualizarmarca($codigo, $nombre,$codigo_mar);

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
