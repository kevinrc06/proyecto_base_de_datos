<?php

class entrada_VI
{

    function __construct()
    {
    }

    function agregarEntrada()
    {

        
        require_once "models/entrada_MO.php";
        require_once "models/usuario_MO.php";

        $conexion = new conexion();
        $entrada_MO = new  entrada_MO($conexion);
        $usuario_MO = new usuario_MO($conexion);
        $arreglo_entrada = $entrada_MO->seleccionar();
        $arreglo_usuario = $usuario_MO->seleccionar();
        

        
       

?>
        
        <div class="card">
            <div class="card-header">
                Agregar entrada
            </div>
            <div class="card-body">
                <form id="formulario_agregar_entrada">

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
                                <label for="fecha_entrada">fecha entrada</label>
                                <input   type="date" class="form-control" id="fecha_entrada" name="fecha_entrada">

                            </div>
                        </div>
                       
                        <div class="col-md-12">
                        <br>
                            <button type="button" onclick="agregarentrada();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        
             <div class="card">
                <div class="card-header">
                    Listar entrada
                </div>
                <div class="card-body">
                   <div class="table-responsive">
                    <table  class="table table-striped table-bordered" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th style="text-align: center;">consecutivo entrada</th>
                                <th style="text-align: center;">usuario</th>
                                <th style="text-align: center;">fecha</th>
                                <th style="text-align: center;">Accion</th>
                            </tr>
                        </thead>
                        <tbody id="lista_entrada">
                        <?php
                            if ($arreglo_entrada) {

                                foreach ($arreglo_entrada as $objeto_entrada) {
                                    $id_usuario= $objeto_entrada->id_usuario;

                               
    
                                    $arreglo_usuario1 = $usuario_MO->seleccionar($id_usuario);
                                    $objeto_usuario = $arreglo_usuario1[0];
                                    $usuario = $objeto_usuario->usuario;

 

                                    $consecutivo_entrada= $objeto_entrada->consecutivo_entrada;
                                    $fecha_entrada = $objeto_entrada->fecha_entrada;
     
                                   
                            ?>
                                    <tr>
                                        <td id="consecutivo_entrada_td_<?php echo $consecutivo_entrada; ?>"> <?php echo $consecutivo_entrada; ?> </td>
                                        <td id="usuario_td_<?php echo $consecutivo_entrada; ?>"> <?php echo $usuario; ?> </td>
                                        <td id="fecha_entrada_td_<?php echo $consecutivo_entrada; ?>"> <?php echo $fecha_entrada; ?> </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="consecutivo_entrada_<?php echo $consecutivo_entrada; ?>" value="<?php echo $consecutivo_entrada; ?>">
                                            <input type="hidden" id="usuario_<?php echo $consecutivo_entrada; ?>" value="<?php echo $usuario; ?>">
                                            <input type="hidden" id="fecha_entrada_<?php echo $consecutivo_entrada; ?>" value="<?php echo $fecha_entrada; ?>">
                                            <input type="hidden" id="id_usuario<?php echo $consecutivo_entrada; ?>" value="<?php echo $id_usuario; ?>">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarentrada('<?php echo $consecutivo_entrada; ?>')"></i>
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
           
            function agregarentrada() {

               
               
                var dato_usuario = document.getElementById("id_usuario");
                var usuario = dato_usuario.options[dato_usuario.selectedIndex].text;

                var cadena = new FormData(document.querySelector('#formulario_agregar_entrada'));
               
                fetch('entrada_CO/agregarentrada', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let fecha_entrada = document.querySelector('#formulario_agregar_entrada #fecha_entrada').value;
                        let id_usuario = document.querySelector('#formulario_agregar_entrada #id_usuario').value;

                        if (respuesta.estado == 'EXITO') {
             
                            let fila = `
                            <?php  
                                  $max_val= $entrada_MO->seleccionarMax();
                                  //print_r($max_val);
                                  foreach($max_val as $valor){
                                      $max_valor=$valor->mayor;
                                  }
                            ?>
                             <tr>        
                             <td id="consecutivo_entrada_td_<?php echo $max_valor; ?>"> <?php echo $max_valor; ?> </td>
                                        <td id="usuario_td_<?php echo $max_valor; ?>"> ${usuario} </td>
                                        <td id="fecha_entrada_td_<?php echo $max_valor; ?>"> ${fecha_entrada} </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="usuario_<?php echo $max_valor; ?>" value="${usuario}">
                                            <input type="hidden" id="fecha_entrada_<?php echo $max_valor; ?>" value="${fecha_entrada}">
                                            <input type="hidden" id="id_usuario<?php echo $max_valor; ?>" value="${id_usuario}">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarentrada('<?php echo $max_valor; ?>')"></i>
                                        </td>
                                    </tr>
                                    `;
                            document.querySelector('#lista_entrada').insertAdjacentHTML('afterbegin', fila);
                            
                            document.querySelector('#formulario_agregar_entrada ').reset();
                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarentrada(consecutivo_entrada) {
                //let especie1 = document.querySelector('#especie_' + especie).value;


                let usuario = document.querySelector('#usuario_' + consecutivo_entrada).value;
                let codi_usuario = document.querySelector('#id_usuario' + consecutivo_entrada).value; 
                let fecha_entrada = document.querySelector('#fecha_entrada_' + consecutivo_entrada).value;                         
                //console.log(codi_origen);
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_entrada">

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
                                        <label for="fecha_entrada">fecha entrada</label>
                                        <input  type="date" class="form-control" id="fecha_entrada" name="fecha_entrada"
                                            value="${fecha_entrada}">
                                    </div>
                                    <input    type="hidden" id="consecutivo_entrada" name="consecutivo_entrada" value="${consecutivo_entrada}">
                                    <button type="button" onclick="actualizarentrada();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar entradas';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarentrada() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_entrada'));
                var dato_usuario = document.getElementById("id_usuario");
                var usuario = dato_usuario.options[dato_usuario.selectedIndex].text;
                


                fetch('entrada_CO/actualizarentrada', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') { 
                            let consecutivo_entrada = document.querySelector('#formulario_actualizar_entrada #consecutivo_entrada').value;
                            let fecha_entrada = document.querySelector('#formulario_actualizar_entrada #fecha_entrada').value;
                            let id_usuario = document.querySelector('#formulario_actualizar_entrada #id_usuario').value;
                           



                            document.querySelector('#usuario_td_' + consecutivo_entrada).innerHTML = usuario;
                            document.querySelector('#usuario_' + consecutivo_entrada).value = usuario;
                            document.querySelector('#fecha_entrada_td_' + consecutivo_entrada).innerHTML = fecha_entrada;
                            document.querySelector('#fecha_entrada_' + consecutivo_entrada).value = fecha_entrada;
                            document.querySelector('#id_usuario' + consecutivo_entrada).value = id_usuario;
                            
                        
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