<?php

require_once "models/suministro_MO.php";

class suministro_CO
{

  function __construct()
  {
  }

  function agregarsuministro()
  {

    $conexion = new conexion();

    $suministro_MO = new  suministro_MO($conexion);
   
    $id_suministro = htmlentities($_POST['id_suministro'], ENT_QUOTES);

    $id_producto = htmlentities($_POST['id_producto'], ENT_QUOTES);
    $id_proveedor = htmlentities($_POST['id_proveedor'], ENT_QUOTES);
    $cantidad_producto = htmlentities($_POST['cantidad_producto'], ENT_QUOTES);
    $fecha = htmlentities($_POST['fecha'], ENT_QUOTES);

    if ( empty($id_suministro) or empty($id_producto) or empty($id_proveedor) or empty($cantidad_producto) or empty($fecha)  ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($id_suministro) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo del producto deber ser menor de 2 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($id_producto) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo de la marca deber ser menor de 2 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($id_proveedor) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo de la categoria deber ser menor de 2 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }


   
   
    
 

    $suministro_MO->agregarsuministro($id_suministro,$id_producto,$id_proveedor,$cantidad_producto, $fecha);
    /*$familia= $conexion->lastInsertId();*/
    $arreglo_respuesta = [
      "id_suministro" => $id_suministro,
      "estado" => "EXITO",
      "mensaje" => "Registro agregado"

    ];

    exit(json_encode($arreglo_respuesta));
  }

  function actualizarsuministro()
  {

    $conexion = new conexion();
    $suministro_MO = new  suministro_MO($conexion);
 

    $id_suministro = htmlentities($_POST['id_suministro'], ENT_QUOTES);

    $id_producto = htmlentities($_POST['id_producto'], ENT_QUOTES);
    $id_proveedor = htmlentities($_POST['id_proveedor'], ENT_QUOTES);
    $cantidad_producto = htmlentities($_POST['cantidad_producto'], ENT_QUOTES);
    $fecha = htmlentities($_POST['fecha'], ENT_QUOTES);
     

    if (  empty($id_producto) or empty($id_proveedor) or empty($cantidad_producto) or empty($fecha)  ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }

    if (strlen($id_producto) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo de la marca deber ser menor de 2 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
    if (strlen($id_proveedor) > 2) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "El tamaño del  codigo de la categoria deber ser menor de 2 caracteres"

      ];

      exit(json_encode($arreglo_respuesta));
    }
   
    $suministro_MO->actualizarsuministro($id_suministro,$id_producto,$id_proveedor,$cantidad_producto, $fecha);

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
  function delateUser()
    {  
     
      $conexion = new conexion();
      $suministro_MO = new  suministro_MO($conexion);

        $cod = $_POST['id'];
        $confit = $_POST['confir'];
        if(!$cod)
        {
            
            $response = ["message"=>'ERROR AL INTERTAR ELIMINAR EL SUSARIO'];
            exit(json_encode($response));
        }
        $suministro_MO->delateUser($cod);

        
        
    }

}
