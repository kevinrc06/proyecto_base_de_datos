<?php

require_once "models/proveedor_MO.php";

class proveedor_CO
{

  function __construct()
  {
  }

  function agregarproveedor()
  {

    $conexion = new conexion();

    $proveedor_MO = new  proveedor_MO($conexion);
   
    $codigo = htmlentities($_POST['codigo'], ENT_QUOTES);
    $nombre=htmlentities($_POST['nombre'], ENT_QUOTES);
    $direccion=htmlentities($_POST['direccion'], ENT_QUOTES);
    $telefono=htmlentities($_POST['telefono'], ENT_QUOTES);
   
    if ( empty($codigo) or empty($nombre) or empty($direccion) or empty($direccion) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($codigo) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo deber ser menor de 4 caracteres"

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
      if (strlen($direccion) > 50) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de la direccion deber ser menor de 50 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }

      if (strlen($telefono) > 20) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del telefono deber ser menor de 20 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }


 
    $arreglo_proveedores = $proveedor_MO->seleccionar_codigo($codigo);
    if ($arreglo_proveedores) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El codigo ($codigo) esta duplicado"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    $proveedor_MO->agregarproveedor( $codigo, $nombre, $direccion, $telefono);

    /*$codigo= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "codigo" => $codigo,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarproveedor()
  {

    $conexion = new conexion();
    $proveedor_MO = new  proveedor_MO($conexion);
 
    $codigo = htmlentities($_POST['codigo'], ENT_QUOTES);
    $nombre = htmlentities($_POST['nombre'], ENT_QUOTES);
    $direccion = htmlentities($_POST['direccion'], ENT_QUOTES);
    $telefono = htmlentities($_POST['telefono'], ENT_QUOTES);
    $codigo_cat=htmlentities($_POST['codige'], ENT_QUOTES);

    if ( empty($codigo) or empty($nombre) or empty($direccion) or empty($direccion) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($codigo) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo deber ser menor de 4 caracteres"

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
      if (strlen($direccion) > 50) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de la direccion deber ser menor de 50 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }

      if (strlen($telefono) > 20) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del telefono deber ser menor de 20 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }


    if($codigo == $codigo_cat){
      $proveedor_MO->actualizarproveedor($codigo, $nombre, $direccion, $telefono, $codigo_cat);

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
      $arreglo_proveedores = $proveedor_MO->seleccionar_codigo($codigo);
      if ($arreglo_proveedores) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El codigo ($codigo) esta duplicado"

        ];

        exit(json_encode($arreglo_respuesta));
      }

    }
    $proveedor_MO->actualizarproveedor($codigo, $nombre, $direccion, $telefono, $codigo_cat);

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
