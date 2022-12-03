<?php

class detalle_salida_VI
{

    function __construct()
    {
    }

    function agregarDetalle_salida()
    {
        require_once "models/detalle_salida_MO.php";
        require_once "models/producto_MO.php";
        require_once "models/salida_MO.php";
        $conexion = new conexion();
        
        $detalle_salida_MO = new detalle_salida_MO($conexion);
        $producto_MO = new producto_MO($conexion);
        $salida_MO = new salida_MO($conexion);

        $arreglo_productos = $producto_MO->seleccionar();      
        $arreglo_salida = $salida_MO->seleccionar();  
        $arreglo_detalle_salidas = $detalle_salida_MO->seleccionar();

?>
        
        <div class="card">
            <div class="card-header">
                registro de detalle salida
            </div>
            <div class="card-body">
                <form id="formulario_agregar_detalle_salida">

                    <div class="row">
                       

                        <div class="col-md-3">
                            <label for="id_producto">Nombre producto</label>
                            <select class="form-control" name="id_producto" id="id_producto">
                                <option value=""></option>
                                <?php
                                if ($arreglo_productos) {

                                    foreach ($arreglo_productos as $objeto_producto) {
                                        $id_producto = $objeto_producto->id_marca;
                                        $nombre_producto = $objeto_producto->nombre_producto;

                                ?>
                                        <option value="<?php echo $id_producto; ?>"><?php echo  $nombre_producto; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                                                 
                        <div class="col-md-3">
                            <label for="consecutivo_salida">numero  factura</label>
                            <select class="form-control" name="consecutivo_salida" id="consecutivo_salida">
                                <option value=""></option>
                                <?php
                                if ($arreglo_salida) {

                                    foreach ($arreglo_salida as $objeto_salida) {
                                        $consecutivo_salida = $objeto_salida->consecutivo_salida;

                                ?>
                                        <option value="<?php echo $consecutivo_salida; ?>"><?php echo  $consecutivo_salida; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
  
                     <br>
                     <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ordinal_salida">codigo detalle</label>
                                <input   type="text" class="form-control" id="ordinal_salida" name="ordinal_salida">

                            </div>
                        </div>
  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cantidad">Cantidad</label>
                                <input  type="number" class="form-control" id="cantidad" name="cantidad">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="precio">precio</label>
                                <input type="number" class="form-control" id="precio" name="precio">

                            </div>
                        </div>
 
                        <div class="col-md-12">
                        <br>
                            <button type="button" onclick="agregardetalle_salida();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        
             <div class="card">
                <div class="card-header">
                    Listar detalles
                </div>
                <div class="card-body">
                   <div class="table-responsive">
                    <table   id="example1" class="table table-bordered table-sm table-hover" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th style="text-align: center;">codigo detalle</th>
                                <th style="text-align: center;">codigo factura</th>
                                <th style="text-align: center;">producto</th>
                                <th style="text-align: center;">cantidad</th>
                                <th style="text-align: center;">precio</th>
                                <th style="text-align: center;">Accion</th>
                            </tr>
                        </thead>
                        <tbody id="lista_detalle_salida">
                        <?php
                            if ($arreglo_detalle_salidas) {

                                foreach ($arreglo_detalle_salidas as $objeto_detalle_salidas) {
                                    $id_producto= $objeto_detalle_salidas->id_producto;
    
                                    $arreglo_producto = $producto_MO->seleccionar($id_producto);
                                    $objeto_producto = $arreglo_producto[0];
                                    $nombre_producto = $objeto_producto->nombre_producto;

                                    $ordinal_salida= $objeto_detalle_salidas->ordinal_salida;
                                    $consecutivo_salida= $objeto_detalle_salidas->consecutivo_salida;
                                    $cantidad = $objeto_detalle_salidas->cantidad;
                                    $precio = $objeto_detalle_salidas->precio;
                                   
                            ?>
                                    <tr>
                                        <td id="ordinal_salida_td_<?php echo $ordinal_salida.''.$consecutivo_salida ?>"> <?php echo $ordinal_salida; ?> </td>
                                        <td id="consecutivo_salida_td_<?php echo $ordinal_salida.''.$consecutivo_salida ?>"> <?php echo $consecutivo_salida; ?> </td>

                                        <td id="nombre_producto_td_<?php echo $ordinal_salida.''.$consecutivo_salida ?>"> <?php echo $nombre_producto; ?> </td>
                                        <td id="cantidad_td_<?php echo $ordinal_salida.''.$consecutivo_salida ?>"> <?php echo $cantidad; ?> </td>
                                        <td id="precio_td_<?php echo $ordinal_salida.''.$consecutivo_salida ?>"> <?php echo $precio; ?> </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="ordinal_salida_<?php echo $ordinal_salida.''.$consecutivo_salida ?>" value="<?php echo $ordinal_salida; ?>">
                                            <input type="hidden" id="consecutivo_salida_<?php echo $ordinal_salida.''.$consecutivo_salida ?>" value="<?php echo $consecutivo_salida; ?>">
                                            <input type="hidden" id="nombre_producto_<?php echo $ordinal_salida.$consecutivo_salida?>" value="<?php echo $nombre_producto; ?>">
                                            <input type="hidden" id="cantidad_<?php echo $ordinal_salida.''.$consecutivo_salida ?>" value="<?php echo $cantidad; ?>">
                                            <input type="hidden" id="precio_<?php echo $ordinal_salida.''.$consecutivo_salida ?>" value="<?php echo $precio; ?>">
                                            <input type="hidden" id="id_producto<?php echo $ordinal_salida.''.$consecutivo_salida ?>" value="<?php echo $id_producto; ?>">
                                            

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizardetalle_salida('<?php echo $ordinal_salida; ?>','<?php echo $consecutivo_salida; ?>')"></i>
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
            <script type="text/javascript" src="datatables/ent.js"></script>

        <script>
function agregardetalle_salida() {
 
 var dato_salida = document.getElementById("consecutivo_salida");
 var consecutivo_salida = dato_salida.options[dato_salida.selectedIndex].text;
 var dato_producto = document.getElementById("id_producto");
 var nombre_producto = dato_producto.options[dato_producto.selectedIndex].text;

 var cadena = new FormData(document.querySelector('#formulario_agregar_detalle_salida'));

 fetch('detalle_salida_CO/agregardetalle_salida', {
         method: 'POST',
         body: cadena
     })
     .then(respuesta => respuesta.json())
     .then(respuesta => {
         let ordinal_salida = document.querySelector('#formulario_agregar_detalle_salida #ordinal_salida').value;
         let consecutivo_salida = document.querySelector('#formulario_agregar_detalle_salida #consecutivo_salida').value;
         let precio = document.querySelector('#formulario_agregar_detalle_salida #precio').value;
         let cantidad = document.querySelector('#formulario_agregar_detalle_salida #cantidad').value;

         let id_producto = document.querySelector('#formulario_agregar_detalle_salida #id_producto').value;
        
         if (respuesta.estado == 'EXITO') {

             let fila = `
              <tr>       
                         <td id="consecutivo_salida_td_${ ordinal_salida+consecutivo_salida}"> ${consecutivo_salida} </td>
                         <td id="ordinal_salida_td_${ ordinal_salida+consecutivo_salida}"> ${ordinal_salida} </td>
                         <td id="nombre_producto_td_${ ordinal_salida+consecutivo_salida}"> ${nombre_producto} </td>
                         
                         <td id="cantidad_td_${ ordinal_salida+consecutivo_salida}"> ${cantidad} </td>
                         <td id="precio_td_${ ordinal_salida+consecutivo_salida}"> ${precio} </td>

                         <td style="text-align: center;">
                         <input type="hidden" id="ordinal_salida_${ordinal_salida+consecutivo_salida}" value="${ordinal_salida}">
                         <input type="hidden" id="consecutivo_salida_${ordinal_salida+consecutivo_salida}" value="${consecutivo_salida}">

                             <input type="hidden" id="nombre_producto_${ordinal_salida+consecutivo_salida}" value="${nombre_producto}">
                             <input type="hidden" id="cantidad_${ordinal_salida+consecutivo_salida}" value="${cantidad}">
                             <input type="hidden" id="precio_${ordinal_salida+consecutivo_salida}" value="${precio}">
                             <input type="hidden" id="id_producto${ordinal_salida+consecutivo_salida}" value="${id_producto}">

                             <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizardetalle_salida('${ordinal_salida+consecutivo_salida}')"></i>
                         </td>
                     </tr>
                     `;
             document.querySelector('#lista_detalle_salida').insertAdjacentHTML('afterbegin', fila);
             
             document.querySelector('#formulario_agregar_detalle_salida ').reset();

             $.post('detalle_salida_VI/agregarDetalle_salida', function(respuesta) {
                          $('#contenido').html(respuesta);
                           });
             toastr.success(respuesta.mensaje);
         } else if (respuesta.estado = 'ERROR') {

             toastr.error(respuesta.mensaje);

         } else {

             toastr.error('No se devolvio un estado');
         }
     })
}
           
 
        

            function verActualizardetalle_salida(ordinal_salida,consecutivo_salida) {
                //let especie1 = document.querySelector('#especie_' + id_$id_producto).value;
                let nombre_producto = document.querySelector('#nombre_producto_' + ordinal_salida+consecutivo_salida).value;
                let codi_producto = document.querySelector('#id_producto' + ordinal_salida+consecutivo_salida).value;
                let cantidad = document.querySelector('#cantidad_' + ordinal_salida+consecutivo_salida).value;
                let precio = document.querySelector('#precio_' + ordinal_salida+consecutivo_salida).value;
                

                //console.log(codi_origen);
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_detalle_salida">
 
                        <div class="form-group">
                            <label for="id_producto">Nombre producto</label>
                            <select class="form-control" name="id_producto" id="id_producto">
                                <option value="${codi_producto}">${nombre_producto}</option>
                                <?php
                                if ($arreglo_productos) {

                                    foreach ($arreglo_productos as $objeto_producto) {
                                        $id_producto = $objeto_producto->id_producto;
                                        $nombre_producto = $objeto_producto->nombre_producto;
                                 

                                ?>
                                        <option value="<?php echo $id_producto; ?>"><?php echo  $nombre_producto; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                       

                                    <div class="form-group">
                                        <label for="cantidad">cantidad producto</label>
                                        <input   type="number" class="form-control" id="cantidad" name="cantidad"
                                            value="${cantidad}">
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">precio </label>
                                        <input type="number" class="form-control" id="precio" name="precio"
                                            value="${precio}">
                                    </div>
                                    
                                    <input    type="hidden" id="ordinal_salida" name="ordinal_salida" value="${ordinal_salida}">
                                    <input    type="hidden" id="consecutivo_salida" name="consecutivo_salida" value="${consecutivo_salida}">
                                    <button type="button" onclick="actualizardetalle_salida();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar detalles';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizardetalle_salida() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_detalle_salida'));
                var dato_producto = document.getElementById("id_producto");
                var nombre_producto = dato_producto.options[dato_producto.selectedIndex].text;


                fetch('detalle_salida_CO/actualizardetalle_salida', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') { 
                            let ordinal_salida = document.querySelector('#formulario_actualizar_detalle_salida #ordinal_salida').value;
                            let consecutivo_salida = document.querySelector('#formulario_actualizar_detalle_salida #consecutivo_salida').value;
                            let cantidad = document.querySelector('#formulario_actualizar_detalle_salida #cantidad').value;
                            let id_producto = document.querySelector('#formulario_actualizar_detalle_salida #id_producto').value;
                            let precio = document.querySelector('#formulario_actualizar_detalle_salida #precio').value;
                           

                           


                            document.querySelector('#nombre_producto_td_' + ordinal_salida+consecutivo_salida ).innerHTML = nombre_producto;
                            document.querySelector('#nombre_producto_' + ordinal_salida+consecutivo_salida).value = nombre_producto;
                            document.querySelector('#cantidad_td_' + ordinal_salida+consecutivo_salida).innerHTML = cantidad;
                            document.querySelector('#cantidad_' + ordinal_salida+consecutivo_salida).value = cantidad;
                            document.querySelector('#precio_td_' + ordinal_salida+consecutivo_salida).innerHTML = precio;
                            document.querySelector('#precio_' + ordinal_salida+consecutivo_salida).value = precio;
                            document.querySelector('#id_producto' + ordinal_salida+consecutivo_salida).value = id_producto;
                             

                            $.post('detalle_salida_VI/agregarDetalle_salida', function(respuesta) {
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