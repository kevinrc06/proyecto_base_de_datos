<?php

class salida_VI
{

    function __construct()
    {
    }

    function agregarSalida()
    {

        
        require_once "models/salida_MO.php";
        require_once "models/usuario_MO.php";

        $conexion = new conexion();
        $salida_MO = new  salida_MO($conexion);
        $usuario_MO = new usuario_MO($conexion);
        $arreglo_salida = $salida_MO->seleccionar();
        $arreglo_usuario = $usuario_MO->seleccionar();
        

        
       

?>
        
        <div class="card">
            <div class="card-header">
                Agregar salida
            </div>
            <div class="card-body">
                <form id="formulario_agregar_salida">

                    <div class="row">
                       

                        <div class="col-md-3">
                            <label for="id_usuario">Nombre usuario</label>
                            <select class="form-control" name="id_usuario" id="id_usuario">
                                <option value=""></option>
                                <?php
                                if ($arreglo_usuario) {

                                    foreach ($arreglo_usuario as $objeto_usuario) {
                                        $id_usuario = $objeto_usuario->id_usuario;
                                        $usuario = $objeto_usuario->usuario;

                                ?>
                                        <option value="<?php echo $id_usuario; ?>"><?php echo  $usuario; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                      


                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_salida">fecha salida</label>
                                <input   type="date" class="form-control" id="fecha_salida" name="fecha_salida">

                            </div>
                        </div>
                       
                        <div class="col-md-12">
                        <br>
                            <button type="button" onclick="agregarsalida();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        
             <div class="card">
                <div class="card-header">
                    Listar salida
                </div>
                <div class="card-body">
                   <div class="table-responsive">
                    <table  class="table table-striped table-bordered" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th style="text-align: center;">consecutivo salida</th>
                                <th style="text-align: center;">usuario</th>
                                <th style="text-align: center;">fecha</th>
                                <th style="text-align: center;">Accion</th>
                            </tr>
                        </thead>
                        <tbody id="lista_salida">
                        <?php
                            if ($arreglo_salida) {

                                foreach ($arreglo_salida as $objeto_salida) {
                                    $id_usuario= $objeto_salida->id_usuario;

                               
    
                                    $arreglo_usuario1 = $usuario_MO->seleccionar($id_usuario);
                                    $objeto_usuario = $arreglo_usuario1[0];
                                    $usuario = $objeto_usuario->usuario;

 

                                    $consecutivo_salida= $objeto_salida->consecutivo_salida;
                                    $fecha_salida = $objeto_salida->fecha_salida;
     
                                   
                            ?>
                                    <tr>
                                        <td id="consecutivo_salida_td_<?php echo $consecutivo_salida; ?>"> <?php echo $consecutivo_salida; ?> </td>
                                        <td id="usuario_td_<?php echo $consecutivo_salida; ?>"> <?php echo $usuario; ?> </td>
                                        <td id="fecha_salida_td_<?php echo $consecutivo_salida; ?>"> <?php echo $fecha_salida; ?> </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="consecutivo_salida_<?php echo $consecutivo_salida; ?>" value="<?php echo $consecutivo_salida; ?>">
                                            <input type="hidden" id="usuario_<?php echo $consecutivo_salida; ?>" value="<?php echo $usuario; ?>">
                                            <input type="hidden" id="fecha_salida_<?php echo $consecutivo_salida; ?>" value="<?php echo $fecha_salida; ?>">
                                            <input type="hidden" id="id_usuario<?php echo $consecutivo_salida; ?>" value="<?php echo $id_usuario; ?>">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarsalida('<?php echo $consecutivo_salida; ?>')"></i>
                                        </td>
                                    </tr>
                            <?php
                                      
                                    }
                                }
                            
                            ?>
                        </tbody>
                    </table>

                    </div>
                </div>
            </div>
        <script type="text/javascript" src="datatables/main.js"></script>

        <script>
           
            function agregarsalida() {

               
               
                var dato_usuario = document.getElementById("id_usuario");
                var usuario = dato_usuario.options[dato_usuario.selectedIndex].text;

                var cadena = new FormData(document.querySelector('#formulario_agregar_salida'));
               
                fetch('salida_CO/agregarsalida', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let fecha_salida = document.querySelector('#formulario_agregar_salida #fecha_salida').value;
                        let id_usuario = document.querySelector('#formulario_agregar_salida #id_usuario').value;

                        if (respuesta.estado == 'EXITO') {
             
                            let fila = `
                            <?php  
                                  $max_val= $salida_MO->seleccionarMax();
                                  //print_r($max_val);
                                  foreach($max_val as $valor){
                                      $max_valor=$valor->mayor;
                                  }
                            ?>
                             <tr>        
                             <td id="consecutivo_salida_td_<?php echo $max_valor; ?>"> <?php echo $max_valor; ?> </td>
                                        <td id="usuario_td_<?php echo $max_valor; ?>"> ${usuario} </td>
                                        <td id="fecha_salida_td_<?php echo $max_valor; ?>"> ${fecha_salida} </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="usuario_<?php echo $max_valor; ?>" value="${usuario}">
                                            <input type="hidden" id="fecha_salida_<?php echo $max_valor; ?>" value="${fecha_salida}">
                                            <input type="hidden" id="id_usuario<?php echo $max_valor; ?>" value="${id_usuario}">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarsalida('<?php echo $max_valor; ?>')"></i>
                                        </td>
                                    </tr>
                                    `;
                            document.querySelector('#lista_salida').insertAdjacentHTML('afterbegin', fila);
                            
                            document.querySelector('#formulario_agregar_salida ').reset();
                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarsalida(consecutivo_salida) {
                //let especie1 = document.querySelector('#especie_' + especie).value;


                let usuario = document.querySelector('#usuario_' + consecutivo_salida).value;
                let codi_usuario = document.querySelector('#id_usuario' + consecutivo_salida).value; 
                let fecha_salida = document.querySelector('#fecha_salida_' + consecutivo_salida).value;                         
                //console.log(codi_origen);
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_salida">

                        <div class="form-group">
                            <label for="id_usuario">Nombre usuario</label>
                            <select class="form-control" name="id_usuario" id="id_usuario">
                                <option value="${codi_usuario}">${usuario}</option>
    
                                 <?php
                                 
                                           if ($arreglo_usuario) {
           
                                               foreach ($arreglo_usuario as $objeto_usuario1) {
                                                   $id_usuario = $objeto_usuario1->id_usuario;
                                                   $usuario = $objeto_usuario1->usuario;
           
                                           ?>
                                    <option value="<?php echo $id_usuario; ?>"><?php echo  $usuario; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>

    
                                    <div class="form-group">
                                        <label for="fecha_salida">fecha salida</label>
                                        <input  type="date" class="form-control" id="fecha_salida" name="fecha_salida"
                                            value="${fecha_salida}">
                                    </div>
                                    <input    type="hidden" id="consecutivo_salida" name="consecutivo_salida" value="${consecutivo_salida}">
                                    <button type="button" onclick="actualizarsalida();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar salidas';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarsalida() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_salida'));
                var dato_usuario = document.getElementById("id_usuario");
                var usuario = dato_usuario.options[dato_usuario.selectedIndex].text;
                


                fetch('salida_CO/actualizarsalida', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') { 
                            let consecutivo_salida = document.querySelector('#formulario_actualizar_salida #consecutivo_salida').value;
                            let fecha_salida = document.querySelector('#formulario_actualizar_salida #fecha_salida').value;
                            let id_usuario = document.querySelector('#formulario_actualizar_salida #id_usuario').value;
                           



                            document.querySelector('#usuario_td_' + consecutivo_salida).innerHTML = usuario;
                            document.querySelector('#usuario_' + consecutivo_salida).value = usuario;
                            document.querySelector('#fecha_salida_td_' + consecutivo_salida).innerHTML = fecha_salida;
                            document.querySelector('#fecha_salida_' + consecutivo_salida).value = fecha_salida;
                            document.querySelector('#id_usuario' + consecutivo_salida).value = id_usuario;
                            
                            $.post('salida_VI/agregarSalida', function(respuesta) {
                          $('#contenido').html(respuesta);
                           });
                            toastr.success(respuesta.mensaje);

                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else if (respuesta.estado = 'ADVERTENCIA') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    });
            }
        </script>
<?php
    }
}
?>