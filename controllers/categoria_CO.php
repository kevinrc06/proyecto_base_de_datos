<?php

require_once "models/categoria_MO.php";

class categoria_CO
{

  function __construct()
  {
  }

  function agregarcategoria()
  {

    $conexion = new conexion();

    $categoria_MO = new  categoria_MO($conexion);
   
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
 
    $arreglo_categorias = $categoria_MO->seleccionar_codigo($codigo);
    if ($arreglo_categorias) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El codigo ($codigo) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    $arreglo_categorias = $categoria_MO->seleccionar_nombre($nombre);
    if ($arreglo_categorias) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El nombre ($nombre) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    $categoria_MO->agregarcategoria( $codigo, $nombre);

    /*$codigo= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "codigo" => $codigo,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarcategoria()
  {

    $conexion = new conexion();
    $categoria_MO = new  categoria_MO($conexion);
 
    $codigo = htmlentities($_POST['codigo'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES);
    $codigo_cat=htmlentities($_POST['codige'], ENT_QUOTES);

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
        "mensaje" => "El tamaño del codigo debe ser menor de 2 caracteres"

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
    

    if($codigo == $codigo_cat){
      $categoria_MO->actualizarcategoria($codigo, $nombre,$codigo_cat);

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
      $arreglo_categorias = $categoria_MO->seleccionar_codigo($codigo);
      if ($arreglo_categorias) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El codigo ($codigo) esta duplicado"

        ];

        exit(json_encode($arreglo_respuesta));
      }

    }
    $categoria_MO->actualizarcategoria($codigo, $nombre,$codigo_cat);

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
