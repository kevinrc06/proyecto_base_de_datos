<?php

class detalle_entrada_VI
{

    function __construct()
    {
    }

    function agregarDetalle_entrada()
    {
        require_once "models/detalle_entrada_MO.php";
        require_once "models/producto_MO.php";
        require_once "models/entrada_MO.php";
        $conexion = new conexion();
        
        $detalle_entrada_MO = new detalle_entrada_MO($conexion);
        $producto_MO = new producto_MO($conexion);
        $entrada_MO = new entrada_MO($conexion);

        $arreglo_productos = $producto_MO->seleccionar();      
        $arreglo_entrada = $entrada_MO->seleccionar();  
        $arreglo_detalle_entradas = $detalle_entrada_MO->seleccionar();

?>
        
        <div class="card">
            <div class="card-header">
                registro de detalle entrada
            </div>
            <div class="card-body">
                <form id="formulario_agregar_detalle_entrada">

                    <div class="row">
                       

                        <div class="col-md-3">
                            <label for="id_producto">Nombre producto</label>
                            <select class="form-control" name="id_producto" id="id_producto">
                                <option value=""></option>
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
                                                 
                        <div class="col-md-3">
                            <label for="consecutivo_entrada">numero  factura</label>
                            <select class="form-control" name="consecutivo_entrada" id="consecutivo_entrada">
                                <option value=""></option>
                                <?php
                                if ($arreglo_entrada) {

                                    foreach ($arreglo_entrada as $objeto_entrada) {
                                        $consecutivo_entrada = $objeto_entrada->consecutivo_entrada;

                                ?>
                                        <option value="<?php echo $consecutivo_entrada; ?>"><?php echo  $consecutivo_entrada; ?></option>
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
                                <label for="ordinal_entrada">codigo detalle</label>
                                <input   type="text" class="form-control" id="ordinal_entrada" name="ordinal_entrada">

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
                            <button type="button" onclick="agregardetalle_entrada();" class="btn btn-success float-right">Agregar</button>
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
                    <table  id="example1" class="table table-bordered table-sm table-hover" style="width:100%">
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
                        <tbody id="lista_detalle_entrada">
                        <?php
                            if ($arreglo_detalle_entradas) {

                                foreach ($arreglo_detalle_entradas as $objeto_detalle_entradas) {
                                    $id_producto= $objeto_detalle_entradas->id_producto;
    
                                    $arreglo_producto = $producto_MO->seleccionar($id_producto);
                                    $objeto_producto = $arreglo_producto[0];
                                    $nombre_producto = $objeto_producto->nombre_producto;

                                    $ordinal_entrada= $objeto_detalle_entradas->ordinal_entrada;
                                    $consecutivo_entrada= $objeto_detalle_entradas->consecutivo_entrada;
                                    $cantidad = $objeto_detalle_entradas->cantidad;
                                    $precio = $objeto_detalle_entradas->precio;
                                   
                            ?>
                                    <tr>
                                        <td id="ordinal_entrada_td_<?php echo $ordinal_entrada.''.$consecutivo_entrada ?>"> <?php echo $ordinal_entrada; ?> </td>
                                        <td id="consecutivo_entrada_td_<?php echo $ordinal_entrada.''.$consecutivo_entrada ?>"> <?php echo $consecutivo_entrada; ?> </td>
                                        <td id="nombre_producto_td_<?php echo $ordinal_entrada.''.$consecutivo_entrada ?>"> <?php echo $nombre_producto; ?> </td>
                                        <td id="cantidad_td_<?php echo $ordinal_entrada.''.$consecutivo_entrada ?>"> <?php echo $cantidad; ?> </td>
                                        <td id="precio_td_<?php echo $ordinal_entrada.''.$consecutivo_entrada ?>"> <?php echo $precio; ?> </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="ordinal_entrada_<?php echo $ordinal_entrada.''.$consecutivo_entrada ?>" value="<?php echo $ordinal_entrada; ?>">
                                            <input type="hidden" id="consecutivo_entrada_<?php echo $ordinal_entrada.''.$consecutivo_entrada ?>" value="<?php echo $consecutivo_entrada; ?>">
                                            <input type="hidden" id="nombre_producto_<?php echo $ordinal_entrada.$consecutivo_entrada?>" value="<?php echo $nombre_producto; ?>">
                                            <input type="hidden" id="cantidad_<?php echo $ordinal_entrada.''.$consecutivo_entrada ?>" value="<?php echo $cantidad; ?>">
                                            <input type="hidden" id="precio_<?php echo $ordinal_entrada.''.$consecutivo_entrada ?>" value="<?php echo $precio; ?>">
                                            <input type="hidden" id="id_producto<?php echo $ordinal_entrada.''.$consecutivo_entrada ?>" value="<?php echo $id_producto; ?>">
                                            

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizardetalle_entrada('<?php echo $ordinal_entrada; ?>','<?php echo $consecutivo_entrada; ?>')"></i>
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
           
            function agregardetalle_entrada() {
 
                var dato_entrada = document.getElementById("consecutivo_entrada");
                var consecutivo_entrada = dato_entrada.options[dato_entrada.selectedIndex].text;
                var dato_producto = document.getElementById("id_producto");
                var nombre_producto = dato_producto.options[dato_producto.selectedIndex].text;

                var cadena = new FormData(document.querySelector('#formulario_agregar_detalle_entrada'));

                fetch('detalle_entrada_CO/agregardetalle_entrada', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let ordinal_entrada = document.querySelector('#formulario_agregar_detalle_entrada #ordinal_entrada').value;
                        let consecutivo_entrada = document.querySelector('#formulario_agregar_detalle_entrada #consecutivo_entrada').value;
                        let precio = document.querySelector('#formulario_agregar_detalle_entrada #precio').value;
                        let cantidad = document.querySelector('#formulario_agregar_detalle_entrada #cantidad').value;

                        let id_producto = document.querySelector('#formulario_agregar_detalle_entrada #id_producto').value;
                       
                        if (respuesta.estado == 'EXITO') {
             
                            let fila = `
                             <tr>       
                                        <td id="consecutivo_entrada_td_${ ordinal_entrada+consecutivo_entrada}"> ${consecutivo_entrada} </td>
                                        <td id="ordinal_entrada_td_${ ordinal_entrada+consecutivo_entrada}"> ${ordinal_entrada} </td>
                                        <td id="nombre_producto_td_${ ordinal_entrada+consecutivo_entrada}"> ${nombre_producto} </td>
                                        
                                        <td id="cantidad_td_${ ordinal_entrada+consecutivo_entrada}"> ${cantidad} </td>
                                        <td id="precio_td_${ ordinal_entrada+consecutivo_entrada}"> ${precio} </td>

                                        <td style="text-align: center;">
                                            <input type="hidden" id="ordinal_entrada_${ordinal_entrada+consecutivo_entrada}" value="${ordinal_entrada}">
                                        <input type="hidden" id="consecutivo_entrada_${ordinal_entrada+consecutivo_entrada}" value="${consecutivo_entrada}">

                                            <input type="hidden" id="nombre_producto_${ordinal_entrada+consecutivo_entrada}" value="${nombre_producto}">
                                            <input type="hidden" id="cantidad_${ordinal_entrada+consecutivo_entrada}" value="${cantidad}">
                                            <input type="hidden" id="precio_${ordinal_entrada+consecutivo_entrada}" value="${precio}">
                                            <input type="hidden" id="id_producto${ordinal_entrada+consecutivo_entrada}" value="${id_producto}">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizardetalle_entrada('${ordinal_entrada+consecutivo_entrada}')"></i>
                                        </td>
                                    </tr>
                                    `;
                            document.querySelector('#lista_detalle_entrada').insertAdjacentHTML('afterbegin', fila);
                            
                            document.querySelector('#formulario_agregar_detalle_entrada ').reset();
                            $.post('detalle_entrada_VI/agregarDetalle_entrada', function(respuesta) {
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

            function verActualizardetalle_entrada(ordinal_entrada,consecutivo_entrada) {
                //let especie1 = document.querySelector('#especie_' + id_$id_producto).value;
                let nombre_producto = document.querySelector('#nombre_producto_' + ordinal_entrada+consecutivo_entrada).value;
                let codi_producto = document.querySelector('#id_producto' + ordinal_entrada+consecutivo_entrada).value;
                let cantidad = document.querySelector('#cantidad_' + ordinal_entrada+consecutivo_entrada).value;
                let precio = document.querySelector('#precio_' + ordinal_entrada+consecutivo_entrada).value;
                

                //console.log(codi_origen);
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_detalle_entrada">
 
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
                                    
                                    <input    type="hidden" id="ordinal_entrada" name="ordinal_entrada" value="${ordinal_entrada}">
                                    <input    type="hidden" id="consecutivo_entrada" name="consecutivo_entrada" value="${consecutivo_entrada}">
                                    <button type="button" onclick="actualizardetalle_entrada();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar detalles';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizardetalle_entrada() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_detalle_entrada'));
                var dato_producto = document.getElementById("id_producto");
                var nombre_producto = dato_producto.options[dato_producto.selectedIndex].text;


                fetch('detalle_entrada_CO/actualizardetalle_entrada', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') { 
                            let ordinal_entrada = document.querySelector('#formulario_actualizar_detalle_entrada #ordinal_entrada').value;
                            let consecutivo_entrada = document.querySelector('#formulario_actualizar_detalle_entrada #consecutivo_entrada').value;
                            let cantidad = document.querySelector('#formulario_actualizar_detalle_entrada #cantidad').value;
                            let id_producto = document.querySelector('#formulario_actualizar_detalle_entrada #id_producto').value;
                            let precio = document.querySelector('#formulario_actualizar_detalle_entrada #precio').value;
                           

                           


                            document.querySelector('#nombre_producto_td_' + ordinal_entrada+consecutivo_entrada ).innerHTML = nombre_producto;
                            document.querySelector('#nombre_producto_' + ordinal_entrada+consecutivo_entrada).value = nombre_producto;
                            document.querySelector('#cantidad_td_' + ordinal_entrada+consecutivo_entrada).innerHTML = cantidad;
                            document.querySelector('#cantidad_' + ordinal_entrada+consecutivo_entrada).value = cantidad;
                            document.querySelector('#precio_td_' + ordinal_entrada+consecutivo_entrada).innerHTML = precio;
                            document.querySelector('#precio_' + ordinal_entrada+consecutivo_entrada).value = precio;
                            document.querySelector('#id_producto' + ordinal_entrada+consecutivo_entrada).value = id_producto;
                            
                            $.post('detalle_entrada_VI/agregarDetalle_entrada', function(respuesta) {
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