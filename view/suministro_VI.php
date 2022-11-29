<?php

class suministro_VI
{

    function __construct()
    {
    }

    function agregarSuministro()
    {
        require_once "models/suministro_MO.php";
        require_once "models/producto_MO.php";
        require_once "models/proveedor_MO.php";
        $conexion = new conexion();
        
        $suministro_MO = new suministro_MO($conexion);
        $producto_MO = new producto_MO($conexion);
        $proveedor_MO = new proveedor_MO($conexion);

        $arreglo_productos = $producto_MO->seleccionar();      
        $arreglo_proveedores = $proveedor_MO->seleccionar();  
        $arreglo_suministros = $suministro_MO->seleccionar();

?>
        
        <div class="card">
            <div class="card-header">
                registro de suministro 
            </div>
            <div class="card-body">
                <form id="formulario_agregar_suministros">

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
                            <label for="id_proveedor">nombre proveedor</label>
                            <select class="form-control" name="id_proveedor" id="id_proveedor">
                                <option value=""></option>
                                <?php
                                if ($arreglo_proveedores) {

                                    foreach ($arreglo_proveedores as $objeto_proveedor) {
                                        $id_proveedor = $objeto_proveedor->id_proveedor;
                                        $nombre_proveedor = $objeto_proveedor->nombre_proveedor;

                                ?>
                                        <option value="<?php echo $id_proveedor; ?>"><?php echo  $nombre_proveedor; ?></option>
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
                                <label for="id_suministro">codigo suministro</label>
                                <input   type="text" class="form-control" id="id_suministro" name="id_suministro">

                            </div>
                        </div>
  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cantidad_producto">Cantidad</label>
                                <input  type="number" class="form-control" id="cantidad_producto" name="cantidad_producto">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha">fecha suministro</label>
                                <input type="date" class="form-control" id="fecha" name="fecha">

                            </div>
                        </div>
 
                        <div class="col-md-12">
                        <br>
                            <button type="button" onclick="agregarsuministro();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        
             <div class="card">
                <div class="card-header">
                    Listar suministro
                </div>
                <div class="card-body">
                   
                <table id="example1" class="table table-bordered table-sm table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">codigo suministro</th>
                                <th style="text-align: center;">producto</th>
                                <th style="text-align: center;">proveedor</th>
                                <th style="text-align: center;">cantidad</th>
                                <th style="text-align: center;">fecha</th>
                                <th style="text-align: center;">Accion</th>
                            </tr>
                        </thead>
                        <tbody id="lista_suministro">
                        <?php
                            if ($arreglo_suministros) {

                                foreach ($arreglo_suministros as $objeto_suministros) {
                                    $id_producto= $objeto_suministros->id_producto;
                                    $id_proveedor= $objeto_suministros->id_proveedor;
    
                                    $arreglo_producto = $producto_MO->seleccionar($id_producto);
                                    $objeto_producto = $arreglo_producto[0];
                                    $nombre_producto = $objeto_producto->nombre_producto;
                                    $arreglo_proveedor = $proveedor_MO->seleccionar($id_proveedor);
                                    $objeto_proveedor = $arreglo_proveedor[0];
                                    $nombre_proveedor = $objeto_proveedor->nombre_proveedor;

                                    $id_suministro= $objeto_suministros->id_suministro;

                                    $cantidad_producto = $objeto_suministros->cantidad_producto;
                                    $fecha = $objeto_suministros->fecha;
                                   
                            ?>
                                    <tr>
                                        <td id="id_suministro_td_<?php echo $id_suministro; ?>"> <?php echo $id_suministro; ?> </td>
                                        <td id="nombre_producto_td_<?php echo $id_suministro; ?>"> <?php echo $nombre_producto; ?> </td>
                                        <td id="nombre_proveedor_td_<?php echo $id_suministro; ?>"> <?php echo $nombre_proveedor; ?> </td>
                                        <td id="cantidad_producto_td_<?php echo $id_suministro; ?>"> <?php echo $cantidad_producto; ?> </td>
                                        <td id="fecha_td_<?php echo $id_suministro; ?>"> <?php echo $fecha; ?> </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="id_suministro_<?php echo $id_suministro; ?>" value="<?php echo $id_suministro; ?>">
                                            <input type="hidden" id="nombre_producto_<?php echo $id_suministro; ?>" value="<?php echo $nombre_producto; ?>">
                                            <input type="hidden" id="nombre_proveedor_<?php echo $id_suministro; ?>" value="<?php echo $nombre_proveedor; ?>">
                                            <input type="hidden" id="cantidad_producto_<?php echo $id_suministro; ?>" value="<?php echo $cantidad_producto; ?>">
                                            <input type="hidden" id="fecha_<?php echo $id_suministro; ?>" value="<?php echo $fecha; ?>">
                                            <input type="hidden" id="id_producto<?php echo $id_suministro; ?>" value="<?php echo $id_producto; ?>">
                                            <input type="hidden" id="id_proveedor<?php echo $id_suministro; ?>" value="<?php echo $id_proveedor; ?>">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarsuministro('<?php echo $id_suministro; ?>')"></i>
                                            <i class="fas fa-trash" style="cursor: pointer;" onclick="showDelateUser('<?php echo $id_suministro; ?>')"></i>
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
        <script type="text/javascript" src="datatables/ent.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <script>

    function showDelateUser(id){
      Swal.fire({
      icon: "info",
      title: "!! REALMENTE DESEA ELIMINAR ESTE USUARIO  ¡¡",
      cancelButtonColor: "#7a82ff",
      showCancelButton: true,
      confirmButtonColor: "#FF5733",
      confirmButtonText: "ELIMINAR",
    }).then((result) => {
      if (result.isConfirmed) {
        var object = new FormData();
        object.append("id", id);
        object.append("confir", result.isConfirmed);

        fetch("suministro_CO/delateUser", {
          method: "POST",
          body: object,
        })
          .then((repuesta) => repuesta.text())
          .then(function (reponse) {
            //document.querySelector("#content").innerHTML = reponse;
          })
          .catch(function (error) {
            console.log(error);
          });
        Swal.fire({
          icon: "success",
          title: "ELIMINADO CON EXITO",
          showConfirmButton: false,
          timer: 1500,
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "ELIMINACION CANCELADA",
          showConfirmButton: false,
          timer: 1500,
        });
      }
    });

         


            }
           
            function agregarsuministro() {


                var dato_producto = document.getElementById("id_producto");
                var nombre_producto = dato_producto.options[dato_producto.selectedIndex].text;
                var dato_proveedor = document.getElementById("id_proveedor");
                var nombre_proveedor1 = dato_proveedor.options[dato_proveedor.selectedIndex].text;

                var cadena = new FormData(document.querySelector('#formulario_agregar_suministros'));

                fetch('suministro_CO/agregarsuministro', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let id_suministro = document.querySelector('#formulario_agregar_suministros #id_suministro').value;
                        let fecha = document.querySelector('#formulario_agregar_suministros #fecha').value;
                        let cantidad_producto = document.querySelector('#formulario_agregar_suministros #cantidad_producto').value;

                        let id_producto = document.querySelector('#formulario_agregar_suministros #id_producto').value;
                        let id_proveedor = document.querySelector('#formulario_agregar_suministros #id_proveedor').value;

                        if (respuesta.estado == 'EXITO') {
             
                            let fila = `
                             <tr>
                                        <td id="id_suministro_td_${id_suministro}"> ${id_suministro} </td>
                                        <td id="nombre_producto_td_${id_suministro}"> ${nombre_producto} </td>
                                        <td id="nombre_proveedor_td_${id_suministro}"> ${nombre_proveedor1} </td>
                                        <td id="cantidad_producto_td_${id_suministro}"> ${cantidad_producto} </td>
                                        <td id="fecha_td_${id_suministro}"> ${fecha} </td>

                                        <td style="text-align: center;">
                                            <input type="hidden" id="id_suministro_${id_suministro}" value="${id_suministro}">
                                            <input type="hidden" id="nombre_producto_${id_suministro}" value="${nombre_producto}">
                                            <input type="hidden" id="nombre_proveedor_${id_suministro}" value="${nombre_proveedor1}">
                                            <input type="hidden" id="cantidad_producto_${id_suministro}" value="${cantidad_producto}">
                                            <input type="hidden" id="fecha_${id_suministro}" value="${fecha}">
                                            <input type="hidden" id="id_producto${id_suministro}" value="${id_producto}">
                                            <input type="hidden" id="id_proveedor${id_suministro}" value="${id_proveedor}">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarsuministro('${id_suministro}')"></i>
                                        </td>
                                    </tr>
                                    `;
                            document.querySelector('#lista_suministro').insertAdjacentHTML('afterbegin', fila);
                            
                            document.querySelector('#formulario_agregar_suministros ').reset();
                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

 
  

            function verActualizarsuministro(id_suministro) {
                //let especie1 = document.querySelector('#especie_' + id_$id_producto).value;
                let nombre_producto = document.querySelector('#nombre_producto_' + id_suministro).value;
                let nombre_proveedor = document.querySelector('#nombre_proveedor_' + id_suministro).value;
                let codi_producto = document.querySelector('#id_producto' + id_suministro).value;
                let codi_proveedor = document.querySelector('#id_proveedor' + id_suministro).value;
                let cantidad_producto = document.querySelector('#cantidad_producto_' + id_suministro).value;
                let fecha = document.querySelector('#fecha_' + id_suministro).value;
                

                //console.log(codi_origen);
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_suministros">
 
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
                            <label for="id_proveedor">proveedor</label>
                            <select class="form-control" name="id_proveedor" id="id_proveedor">
                                <option value="${codi_proveedor}">${nombre_proveedor}</option>
                                <?php
                                if ($arreglo_proveedores) {

                                    foreach ($arreglo_proveedores as $objeto_proveedor) {
                                        $id_proveedor = $objeto_proveedor->id_proveedor;
                                        $nombre_proveedor = $objeto_proveedor->nombre_proveedor;

                                ?>
                                        <option value="<?php echo $id_proveedor; ?>"><?php echo  $nombre_proveedor; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                                    <div class="form-group">
                                        <label for="cantidad_producto">cantidad producto</label>
                                        <input   type="number" class="form-control" id="cantidad_producto" name="cantidad_producto"
                                            value="${cantidad_producto}">
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha">fecha </label>
                                        <input type="date" class="form-control" id="fecha" name="fecha"
                                            value="${fecha}">
                                    </div>
                                    
                                    <input    type="hidden" id="id_suministro" name="id_suministro" value="${id_suministro}">
                                    <button type="button" onclick="actualizarsuministro();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar suministros';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarsuministro() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_suministros'));
                var dato_producto = document.getElementById("id_producto");
                var nombre_producto = dato_producto.options[dato_producto.selectedIndex].text;
                var dato_proveedor = document.getElementById("id_proveedor");
                var nombre_proveedor = dato_proveedor.options[dato_proveedor.selectedIndex].text;


                fetch('suministro_CO/actualizarsuministro', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') { 
                            let id_suministro = document.querySelector('#formulario_actualizar_suministros #id_suministro').value;
                            let cantidad_producto = document.querySelector('#formulario_actualizar_suministros #cantidad_producto').value;
                            let id_producto = document.querySelector('#formulario_actualizar_suministros #id_producto').value;
                            let id_proveedor = document.querySelector('#formulario_actualizar_suministros #id_proveedor').value;
                            let fecha = document.querySelector('#formulario_actualizar_suministros #fecha').value;
                           

                           


                            document.querySelector('#nombre_producto_td_' + id_suministro).innerHTML = nombre_producto;
                            document.querySelector('#nombre_producto_' + id_suministro).value = nombre_producto;
                            document.querySelector('#nombre_proveedor_td_' + id_suministro).innerHTML = nombre_proveedor;
                            document.querySelector('#nombre_proveedor_' + id_suministro).value = nombre_proveedor;
                            document.querySelector('#cantidad_producto_td_' + id_suministro).innerHTML = cantidad_producto;
                            document.querySelector('#cantidad_producto_' + id_suministro).value = cantidad_producto;
                            document.querySelector('#fecha_td_' + id_suministro).innerHTML = fecha;
                            document.querySelector('#fecha_' + id_suministro).value = fecha;
                            document.querySelector('#id_producto' + id_suministro).value = id_proveedor;
                            document.querySelector('#id_proveedor' + id_suministro).value = id_proveedor;
                            
                        
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