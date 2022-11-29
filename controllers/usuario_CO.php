<?php

require_once "models/usuario_MO.php";

class coordinador_CO
{

  function __construct()
  {
  }
  function actualizarusuario()
  {

    $conexion = new conexion();
    $usuario_MO = new  coordinador_MO($conexion);

 
    $usuario=htmlentities($_POST['usuario'], ENT_QUOTES);
    $contrasena=htmlentities($_POST['contrasena'], ENT_QUOTES);
    $id_usuario=htmlentities($_POST['id_usuario'], ENT_QUOTES);
    
    if ( or empty($usuario)or empty($contrasena) ) {
      $arreglo_respuesta = [
        "estado" => "ERROR",
        "mensaje" => "Todos los campos son obligatorios"

      ];

      exit(json_encode($arreglo_respuesta));
    }


      if (strlen($correo) > 50) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño del correo del coordinador deber ser menor de 50 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      if (strlen($contrasena) > 30) {
        $arreglo_respuesta = [
          "estado" => "ERROR",
          "mensaje" => "El tamaño de la contraseña deber ser menor de 30 caracteres"
  
        ];
  
        exit(json_encode($arreglo_respuesta));
      }
      

    $usuario_MO->actualizarusuario($id_usuario,$usuario,$contrasena);

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