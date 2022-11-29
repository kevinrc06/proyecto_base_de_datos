<?php

class categoria_VI
{

    function __construct()
    {
    }

    function agregarCategoria()
    {

        require_once "models/categoria_MO.php";
        $conexion = new conexion();
        $categoria_MO = new categoria_MO($conexion);
        $arreglo_categorias = $categoria_MO->seleccionar();

?>
        <div class="card">
        <div class="card-header">
                Agregar categoria
            </div>
            <div class="card-body">
                <form id="formulario_agregar_categoria">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="codigo">Codigo categoria</label>
                                <input type="text" class="form-control" id="codigo" name="codigo">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">nombre categoria</label>
                                <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="nombre" name="nombre">

                            </div>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button type="button" onclick="agregarcategoria();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Listar categorias
            </div>
            <div class="card-body">

                <table class="table table-bordered table-sm table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Codigo categoria</th>
                            <th style="text-align: center;">Nombre categoria</th>
                            <th style="text-align: center;">Accion</th>
                        </tr>
                    </thead>
                    <tbody id="lista_categoria">
                        <?php
                        if ($arreglo_categorias) {

                            foreach ($arreglo_categorias as $objeto_categorias) {

                                $codigo = $objeto_categorias->id_categoria;
                                $nombre = $objeto_categorias->nombre_categoria;
                        ?>
                                <tr>
                                    <td id="codigo_td_<?php echo $codigo; ?>"> <?php echo $codigo; ?> </td>
                                    <td id="nombre_td_<?php echo $codigo; ?>"> <?php echo $nombre; ?> </td>
                                    <td style="text-align: center;">
                                        <input type="hidden" id="codigo_<?php echo $codigo; ?>" value="<?php echo $codigo; ?>">
                                        <input type="hidden" id="nombre_<?php echo $codigo; ?>" value="<?php echo $nombre; ?>">
                                        <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarcategoria('<?php echo $codigo; ?>')"></i>
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
            function agregarcategoria() {


                var cadena = new FormData(document.querySelector('#formulario_agregar_categoria'));

                fetch('categoria_CO/agregarcategoria', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let codigo = document.querySelector('#formulario_agregar_categoria #codigo').value;
                        let nombre = document.querySelector('#formulario_agregar_categoria #nombre').value;
                        if (respuesta.estado == 'EXITO') {

                            let fila = `
                                    <tr>
                                            <td id="codigo_td_${codigo}"> ${codigo} </td>
                                            <td id="nombre_td_${codigo}"> ${nombre } </td>
                                            <td style="text-align: center;">
                                                <input type="hidden" id="codigo_${codigo}" value="${codigo}">
                                                <input type="hidden" id="nombre_${codigo}" value="${nombre }">
                                                <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarcategoria('${codigo}')"></i>
                                            </td>
                                        </tr>

                                    <tr>`;
                            document.querySelector('#lista_categoria').insertAdjacentHTML('afterbegin', fila);
                            document.querySelector('#formulario_agregar_categoria ').reset();

                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarcategoria(cod) {

                let codigo = document.querySelector('#codigo_' + cod).value;
                let nombre = document.querySelector('#nombre_' + cod).value;
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                                <form id="formulario_actualizar_categoria">

                              
                          
                                    <div class="form-group">
                                        <label for="codigo">Codigo de la categoria</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo"
                                            value="${codigo}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">nombre de la categoria</label>
                                        <input onkeypress="return sololetras(event)" type="text" class="form-control" id="nombre" name="nombre"
                                            value="${nombre}">
                                    </div>
                                    <input type="hidden" id="codige" name="codige" value="${codigo}">
                                    <button type="button" onclick="actualizarcategoria();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar categoria';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarcategoria() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_categoria'));

                fetch('categoria_CO/actualizarcategoria', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') {


                            let codigo = document.querySelector('#formulario_actualizar_categoria #codigo').value;

                            let codige = document.querySelector('#formulario_actualizar_categoria #codige').value;

                            let nombre = document.querySelector('#formulario_actualizar_categoria #nombre').value;

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