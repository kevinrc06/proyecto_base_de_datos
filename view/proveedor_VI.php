<?php

class proveedor_VI
{

    function __construct()
    {
    }

    function agregarProveedor()
    {

        require_once "models/proveedor_MO.php";
        $conexion = new conexion();
        $proveedor_MO = new proveedor_MO($conexion);
        $arreglo_proveedores = $proveedor_MO->seleccionar();

?>
        <div class="card">
        <div class="card-header">
                Agregar proveedor
            </div>
            <div class="card-body">
                <form id="formulario_agregar_proveedor">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo">Codigo proveedor</label>
                                <input type="text" class="form-control" id="codigo" name="codigo">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">nombre proveedor</label>
                                <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="nombre" name="nombre">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">direccion</label>
                                <input   type="text" class="form-control" id="direccion" name="direccion">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">telefono</label>
                                <input   type="text" class="form-control" id="telefono" name="telefono">

                            </div>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button type="button" onclick="agregarproveedor();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Listar proveedores
            </div>
            <div class="card-body">

                <table class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Codigo proveedor</th>
                            <th style="text-align: center;">Nombre proveedor</th>
                            <th style="text-align: center;"> direccion</th>
                            <th style="text-align: center;">telefono</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_proveedor">
                        <?php
                        if ($arreglo_proveedores) {

                            foreach ($arreglo_proveedores as $objeto_proveedor) {

                                $codigo = $objeto_proveedor->id_proveedor;
                                $nombre = $objeto_proveedor->nombre_proveedor;
                                $direccion = $objeto_proveedor->direccion;
                                $telefono = $objeto_proveedor->telefono;
                        ?>
                                <tr>
                                    <td id="codigo_td_<?php echo $codigo; ?>"> <?php echo $codigo; ?> </td>
                                    <td id="nombre_td_<?php echo $codigo; ?>"> <?php echo $nombre; ?> </td>
                                    <td id="direccion_td_<?php echo $codigo; ?>"> <?php echo $direccion; ?> </td>
                                    <td id="telefono_td_<?php echo $codigo; ?>"> <?php echo $telefono; ?> </td>
                                    <td style="text-align: center;">
                                        <input type="hidden" id="codigo_<?php echo $codigo; ?>" value="<?php echo $codigo; ?>">
                                        <input type="hidden" id="nombre_<?php echo $codigo; ?>" value="<?php echo $nombre; ?>">
                                        <input type="hidden" id="direccion_<?php echo $codigo; ?>" value="<?php echo $direccion; ?>">
                                        <input type="hidden" id="telefono_<?php echo $codigo; ?>" value="<?php echo $telefono; ?>">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarproveedor('<?php echo $codigo; ?>')"></i>
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

        <script>
function agregarproveedor() {


var cadena = new FormData(document.querySelector('#formulario_agregar_proveedor'));

fetch('proveedor_CO/agregarproveedor', {
        method: 'POST',
        body: cadena
    })
    .then(respuesta => respuesta.json())
    .then(respuesta => {
        let codigo = document.querySelector('#formulario_agregar_proveedor #codigo').value;
        let nombre = document.querySelector('#formulario_agregar_proveedor #nombre').value;
        let direccion = document.querySelector('#formulario_agregar_proveedor #direccion').value;
        let telefono = document.querySelector('#formulario_agregar_proveedor #telefono').value;
        if (respuesta.estado == 'EXITO') {

            let fila = `
                    <tr>
                            <td id="codigo_td_${codigo}"> ${codigo} </td>
                            <td id="nombre_td_${codigo}"> ${nombre } </td>
                            <td id="direccion_td_${codigo}"> ${direccion } </td>
                            <td id="telefono_td_${codigo}"> ${telefono } </td>
                            <td style="text-align: center;">
                                <input type="hidden" id="codigo_${codigo}" value="${codigo}">
                                <input type="hidden" id="nombre_${codigo}" value="${nombre }">
                                <input type="hidden" id="direccion_${codigo}" value="${direccion }">
                                <input type="hidden" id="telefono_${codigo}" value="${telefono }">
                                <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarproveedor('${codigo}')"></i>
                            </td>
                        </tr>

                    <tr>`;
            document.querySelector('#lista_proveedor').insertAdjacentHTML('afterbegin', fila);
            document.querySelector('#formulario_agregar_proveedor ').reset();

            toastr.success(respuesta.mensaje);
        } else if (respuesta.estado = 'ERROR') {

            toastr.error(respuesta.mensaje);

        } else {

            toastr.error('No se devolvio un estado');
        }
    })
}

            function verActualizarproveedor(cod) {

                let codigo = document.querySelector('#codigo_' + cod).value;
                let nombre = document.querySelector('#nombre_' + cod).value;
                let direccion = document.querySelector('#direccion_' + cod).value;
                let telefono = document.querySelector('#telefono_' + cod).value;

                var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_proveedor">

                              
                          
                                    <div class="form-group">
                                        <label for="codigo">Codigo del proveedor</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo"
                                            value="${codigo}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">nombre del proveedor</label>
                                        <input onkeypress="return sololetras(event)" type="text" class="form-control" id="nombre" name="nombre"
                                            value="${nombre}">
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">direccion</label>
                                        <input  type="text" class="form-control" id="direccion" name="direccion"
                                            value="${direccion}">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">telefono proveedor</label>
                                        <input  type="text" class="form-control" id="telefono" name="telefono"
                                            value="${telefono}">
                                    </div>
                                    <input type="hidden" id="codige" name="codige" value="${codigo}">
                                    <button type="button" onclick="actualizarproveedor();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar proveedor';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

function actualizarproveedor() {

var cadena = new FormData(document.querySelector('#formulario_actualizar_proveedor'));

fetch('proveedor_CO/actualizarproveedor', {
        method: 'POST',
        body: cadena
    })
    .then(respuesta => respuesta.json())
    .then(respuesta => {

        if (respuesta.estado == 'EXITO') {


            let codigo = document.querySelector('#formulario_actualizar_proveedor #codigo').value;

            let codige = document.querySelector('#formulario_actualizar_proveedor #codige').value;

            let nombre = document.querySelector('#formulario_actualizar_proveedor #nombre').value;

            let direccion = document.querySelector('#formulario_actualizar_proveedor #direccion').value;

            let telefono = document.querySelector('#formulario_actualizar_proveedor #telefono').value;

            document.querySelector('#codigo_td_' + codige).innerHTML = codigo;
            document.querySelector('#codigo_' + codige).value = codigo;
            document.querySelector('#nombre_td_' + codige).innerHTML = nombre;
            document.querySelector('#nombre_' + codige).value = nombre;
            document.querySelector('#direccion_td_' + codige).innerHTML = direccion;
            document.querySelector('#direccion_' + codige).value = direccion;
            document.querySelector('#telefono_td_' + codige).innerHTML = telefono;
            document.querySelector('#telefono_' + codige).value = telefono;



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