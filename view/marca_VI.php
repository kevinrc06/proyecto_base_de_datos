<?php

class marca_VI
{

    function __construct()
    {
    }

    function agregarMarca()
    {

        require_once "models/marca_MO.php";
        $conexion = new conexion();
        $marca_MO = new marca_MO($conexion);
        $arreglo_marcas = $marca_MO->seleccionar();

?>
        <div class="card">
        <div class="card-header">
                Agregar marca
            </div>
            <div class="card-body">
                <form id="formulario_agregar_marca">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo">Codigo marca</label>
                                <input type="text" class="form-control" id="codigo" name="codigo">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">nombre marca</label>
                                <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="nombre" name="nombre">

                            </div>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button type="button" onclick="agregarmarca();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Listar marcas
            </div>
            <div class="card-body">

                <table class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Codigo marca</th>
                            <th style="text-align: center;">Nombre marca</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_marca">
                        <?php
                        if ($arreglo_marcas) {

                            foreach ($arreglo_marcas as $objeto_marcas) {

                                $codigo = $objeto_marcas->id_marca;
                                $nombre = $objeto_marcas->nombre_marca;
                        ?>
                                <tr>
                                    <td id="codigo_td_<?php echo $codigo; ?>"> <?php echo $codigo; ?> </td>
                                    <td id="nombre_td_<?php echo $codigo; ?>"> <?php echo $nombre; ?> </td>
                                    <td style="text-align: center;">
                                        <input type="hidden" id="codigo_<?php echo $codigo; ?>" value="<?php echo $codigo; ?>">
                                        <input type="hidden" id="nombre_<?php echo $codigo; ?>" value="<?php echo $nombre; ?>">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarmarca('<?php echo $codigo; ?>')"></i>
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
            function agregarmarca() {


                var cadena = new FormData(document.querySelector('#formulario_agregar_marca'));

                fetch('marca_CO/agregarmarca', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let codigo = document.querySelector('#formulario_agregar_marca #codigo').value;
                        let nombre = document.querySelector('#formulario_agregar_marca #nombre').value;
                        if (respuesta.estado == 'EXITO') {

                            let fila = `
                                    <tr>
                                            <td id="codigo_td_${codigo}"> ${codigo} </td>
                                            <td id="nombre_td_${codigo}"> ${nombre } </td>
                                            <td style="text-align: center;">
                                                <input type="hidden" id="codigo_${codigo}" value="${codigo}">
                                                <input type="hidden" id="nombre_${codigo}" value="${nombre }">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarmarca('${codigo}')"></i>
                                            </td>
                                        </tr>

                                    <tr>`;
                            document.querySelector('#lista_marca').insertAdjacentHTML('afterbegin', fila);
                            document.querySelector('#formulario_agregar_marca ').reset();

                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarmarca(cod) {

                let codigo = document.querySelector('#codigo_' + cod).value;
                let nombre = document.querySelector('#nombre_' + cod).value;
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_marca">

                              
                          
                                    <div class="form-group">
                                        <label for="codigo">Codigo del origen</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo"
                                            value="${codigo}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">nombre del origen</label>
                                        <input onkeypress="return sololetras(event)" type="text" class="form-control" id="nombre" name="nombre"
                                            value="${nombre}">
                                    </div>
                                    <input type="hidden" id="codige" name="codige" value="${codigo}">
                                    <button type="button" onclick="actualizarmarca();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar marca';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarmarca() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_marca'));

                fetch('marca_CO/actualizarmarca', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {


                            let codigo = document.querySelector('#formulario_actualizar_marca #codigo').value;

                            let codige = document.querySelector('#formulario_actualizar_marca #codige').value;

                            let nombre = document.querySelector('#formulario_actualizar_marca #nombre').value;

                            document.querySelector('#codigo_td_' + codige).innerHTML = codigo;
                            document.querySelector('#codigo_' + codige).value = codigo;
                            document.querySelector('#nombre_td_' + codige).innerHTML = nombre;
                            document.querySelector('#nombre_' + codige).value = nombre;



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