<?php

class producto_VI
{

    function __construct()
    {
    }

    function agregarProducto()
    {

        require_once "models/producto_MO.php";
        require_once "models/marca_MO.php";
        require_once "models/categoria_MO.php";
        $conexion = new conexion();
        $producto_MO = new producto_MO($conexion);
        $marca_MO = new marca_MO($conexion);
        $categoria_MO = new categoria_MO($conexion);
        $arreglo_productos = $producto_MO->seleccionar();      
        $arreglo_marcas = $marca_MO->seleccionar();  
        $arreglo_categorias = $categoria_MO->seleccionar();

?>
        
        <div class="card">
            <div class="card-header">
                Agregar productos al inventario
            </div>
            <div class="card-body">
                <form id="formulario_agregar_productos">

                    <div class="row">
                       

                        <div class="col-md-3">
                            <label for="id_marca">Nombre marca</label>
                            <select class="form-control" name="id_marca" id="id_marca">
                                <option value=""></option>
                                <?php
                                if ($arreglo_marcas) {

                                    foreach ($arreglo_marcas as $objeto_marca) {
                                        $id_marca = $objeto_marca->id_marca;
                                        $nombre_marca = $objeto_marca->nombre_marca;

                                ?>
                                        <option value="<?php echo $id_marca; ?>"><?php echo  $nombre_marca; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="id_categoria">categoria</label>
                            <select class="form-control" name="id_categoria" id="id_categoria">
                                <option value=""></option>
                                <?php
                                if ($arreglo_categorias) {

                                    foreach ($arreglo_categorias as $objeto_categoria) {
                                        $id_categoria = $objeto_categoria->id_categoria;
                                        $nombre_categoria = $objeto_categoria->nombre_categoria;

                                ?>
                                        <option value="<?php echo $id_categoria; ?>"><?php echo  $nombre_categoria; ?></option>
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
                                <label for="id_producto">codigo producto</label>
                                <input   type="text" class="form-control" id="id_producto" name="id_producto">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre_producto">Nombre producto</label>
                                <input onkeypress="return sololetras(event)" type="text" class="form-control" id="nombre_producto" name="nombre_producto">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input  type="number" class="form-control" id="stock" name="stock">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="precio_unitario">precio unitario</label>
                                <input type="number" class="form-control" id="precio_unitario" name="precio_unitario">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion_producto">descripcion</label>
                                <input onkeypress="return sololetras(event)" type="text" class="form-control" id="descripcion_producto" name="descripcion_producto">

                            </div>
                        </div>
                        <div class="col-md-12">
                        <br>
                            <button type="button" onclick="agregarproducto();" class="btn btn-success float-right">Agregar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        
             <div class="card">
                <div class="card-header">
                    Listar productos del inventario
                </div>
                <div class="card-body">
                   <div class="table-responsive">
                    <table  class="table table-striped table-bordered" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th style="text-align: center;">codigo producto</th>
                                <th style="text-align: center;">marca</th>
                                <th style="text-align: center;">categoria</th>
                                <th style="text-align: center;">Nombre producto</th>
                                <th style="text-align: center;">Stock</th>
                                <th style="text-align: center;">precio unitario</th>
                                <th style="text-align: center;">descripcion</th>
                                <th style="text-align: center;">Accion</th>
                            </tr>
                        </thead>
                        <tbody id="lista_productos">
                        <?php
                            if ($arreglo_productos) {

                                foreach ($arreglo_productos as $objeto_productos) {
                                    $id_marca= $objeto_productos->id_marca;
                                    $id_categoria= $objeto_productos->id_categoria;
    
                                    $arreglo_marca = $marca_MO->seleccionar($id_marca);
                                    $objeto_marca = $arreglo_marca[0];
                                    $nombre_marca = $objeto_marca->nombre_marca;
                                    $arreglo_categoria = $categoria_MO->seleccionar($id_categoria);
                                    $objeto_categoria = $arreglo_categoria[0];
                                    $nombre_categoria = $objeto_categoria->nombre_categoria;

                                    $id_producto= $objeto_productos->id_producto;

                                    $nombre_producto = $objeto_productos->nombre_producto;
                                    $stock = $objeto_productos->stock;
                                    $precio_unitario = $objeto_productos->precio_unitario;
                                    $descripcion_producto = $objeto_productos->descripcion_producto;
                                   
                            ?>
                                    <tr>
                                        <td id="id_producto_td_<?php echo $id_producto; ?>"> <?php echo $id_producto; ?> </td>
                                        <td id="nombre_marca_td_<?php echo $id_producto; ?>"> <?php echo $nombre_marca; ?> </td>
                                        <td id="nombre_categoria_td_<?php echo $id_producto; ?>"> <?php echo $nombre_categoria; ?> </td>
                                        <td id="nombre_producto_td_<?php echo $id_producto; ?>"> <?php echo $nombre_producto; ?> </td>
                                        <td id="stock_td_<?php echo $id_producto; ?>"> <?php echo $stock; ?> </td>
                                        <td id="precio_unitario_td_<?php echo $id_producto; ?>"> <?php echo $precio_unitario; ?> </td>
                                        <td id="descripcion_producto_td_<?php echo $id_producto; ?>"> <?php echo $descripcion_producto; ?> </td>
                                        <td style="text-align: center;">
                                            <input type="hidden" id="id_producto_<?php echo $id_producto; ?>" value="<?php echo $id_producto; ?>">
                                            <input type="hidden" id="nombre_marca_<?php echo $id_producto; ?>" value="<?php echo $nombre_marca; ?>">
                                            <input type="hidden" id="nombre_categoria_<?php echo $id_producto; ?>" value="<?php echo $nombre_categoria; ?>">
                                            <input type="hidden" id="nombre_producto_<?php echo $id_producto; ?>" value="<?php echo $nombre_producto; ?>">
                                            <input type="hidden" id="stock_<?php echo $id_producto; ?>" value="<?php echo $stock; ?>">
                                            <input type="hidden" id="precio_unitario_<?php echo $id_producto; ?>" value="<?php echo $precio_unitario; ?>">
                                            <input type="hidden" id="descripcion_producto_<?php echo $id_producto; ?>" value="<?php echo $descripcion_producto; ?>">
                                            <input type="hidden" id="id_marca<?php echo $id_producto; ?>" value="<?php echo $id_marca; ?>">
                                            <input type="hidden" id="id_categoria<?php echo $id_producto; ?>" value="<?php echo $id_categoria; ?>">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarproducto('<?php echo $id_producto; ?>')"></i>
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
           
            function agregarproducto() {


                var dato_marca = document.getElementById("id_marca");
                var nombre_marca = dato_marca.options[dato_marca.selectedIndex].text;
                var dato_categoria = document.getElementById("id_categoria");
                var nombre_categoria1 = dato_categoria.options[dato_categoria.selectedIndex].text;

                var cadena = new FormData(document.querySelector('#formulario_agregar_productos'));

                fetch('producto_CO/agregarproducto', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        let id_producto = document.querySelector('#formulario_agregar_productos #id_producto').value;
                        let stock = document.querySelector('#formulario_agregar_productos #stock').value;
                        let nombre_producto = document.querySelector('#formulario_agregar_productos #nombre_producto').value;
                        let precio_unitario = document.querySelector('#formulario_agregar_productos #precio_unitario').value;
                        let descripcion_producto = document.querySelector('#formulario_agregar_productos #descripcion_producto').value;

                        let id_marca = document.querySelector('#formulario_agregar_productos #id_marca').value;
                        let id_categoria = document.querySelector('#formulario_agregar_productos #id_categoria').value;

                        if (respuesta.estado == 'EXITO') {
             
                            let fila = `
                             <tr>
                                        <td id="id_producto_td_${id_producto}"> ${id_producto} </td>
                                        <td id="nombre_marca_td_${id_producto}"> ${nombre_marca} </td>
                                        <td id="nombre_categoria_td_${id_producto}"> ${nombre_categoria1} </td>
                                        <td id="nombre_producto_td_${id_producto}"> ${nombre_producto} </td>
                                        <td id="stock_td_${id_producto}"> ${stock} </td>
                                        <td id="precio_unitario_td_${id_producto}"> ${precio_unitario} </td>
                                        <td id="descripcion_producto_td_${id_producto}"> ${descripcion_producto} </td>

                                        <td style="text-align: center;">
                                            <input type="hidden" id="id_producto_${id_producto}" value="${id_producto}">
                                            <input type="hidden" id="nombre_marca_${id_producto}" value="${nombre_marca}">
                                            <input type="hidden" id="nombre_categoria_${id_producto}" value="${nombre_categoria1}">
                                            <input type="hidden" id="nombre_producto_${id_producto}" value="${nombre_producto}">
                                            <input type="hidden" id="stock_${id_producto}" value="${stock}">
                                            <input type="hidden" id="precio_unitario_${id_producto}" value="${precio_unitario}">
                                            <input type="hidden" id="descripcion_producto_${id_producto}" value="${descripcion_producto}">
                                            <input type="hidden" id="id_marca${id_producto}" value="${id_marca}">
                                            <input type="hidden" id="id_categoria${id_producto}" value="${id_categoria}">

                                            <i class="fas fa-edit" data-toggle="modal" data-target="#Ventana_Modal" style="cursor: pointer;" onclick="verActualizarproducto('${id_producto}')"></i>
                                        </td>
                                    </tr>
                                    `;
                            document.querySelector('#lista_productos').insertAdjacentHTML('afterbegin', fila);
                            
                            document.querySelector('#formulario_agregar_productos ').reset();
                            toastr.success(respuesta.mensaje);
                        } else if (respuesta.estado = 'ERROR') {

                            toastr.error(respuesta.mensaje);

                        } else {

                            toastr.error('No se devolvio un estado');
                        }
                    })
            }

            function verActualizarproducto(id_producto) {
                //let especie1 = document.querySelector('#especie_' + id_$id_producto).value;
                let nombre_marca = document.querySelector('#nombre_marca_' + id_producto).value;
                let nombre_categoria = document.querySelector('#nombre_categoria_' + id_producto).value;
                let codi_marca = document.querySelector('#id_marca' + id_producto).value;
                let codi_categoria = document.querySelector('#id_categoria' + id_producto).value;
                let nombre_producto = document.querySelector('#nombre_producto_' + id_producto).value;
                let stock = document.querySelector('#stock_' + id_producto).value;
                let precio_unitario = document.querySelector('#precio_unitario_' + id_producto).value;
                let descripcion_producto = document.querySelector('#descripcion_producto_' + id_producto).value;

                //console.log(codi_origen);
                var cadena = `
                        <div class="card">
                            <div class="card-body">
                             <form id="formulario_actualizar_productos">
 
                        <div class="form-group">
                            <label for="id_marca">Nombre marca</label>
                            <select class="form-control" name="id_marca" id="id_marca">
                                <option value="${codi_marca}">${nombre_marca}</option>
                                <?php
                                if ($arreglo_marcas) {

                                    foreach ($arreglo_marcas as $objeto_marca) {
                                        $id_marca = $objeto_marca->id_marca;
                                        $nombre_marca = $objeto_marca->nombre_marca;
                                 

                                ?>
                                        <option value="<?php echo $id_marca; ?>"><?php echo  $nombre_marca; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="id_categoria">categoria</label>
                            <select class="form-control" name="id_categoria" id="id_categoria">
                                <option value="${codi_categoria}">${nombre_categoria}</option>
                                <?php
                                if ($arreglo_categorias) {

                                    foreach ($arreglo_categorias as $objeto_categoria) {
                                        $id_categoria = $objeto_categoria->id_categoria;
                                        $nombre_categoria = $objeto_categoria->nombre_categoria;

                                ?>
                                        <option value="<?php echo $id_categoria; ?>"><?php echo  $nombre_categoria; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                                    <div class="form-group">
                                        <label for="nombre_producto">nombre producto</label>
                                        <input onkeypress="return sololetras(event)"  type="text" class="form-control" id="nombre_producto" name="nombre_producto"
                                            value="${nombre_producto}">
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock"
                                            value="${stock}">
                                    </div>
                                    <div class="form-group">
                                        <label for="precio_unitario">precio unitario</label>
                                        <input type="number" class="form-control" id="precio_unitario" name="precio_unitario"
                                            value="${precio_unitario}">
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion_producto">descripcion producto</label>
                                        <input  type="text" class="form-control" id="descripcion_producto" name="descripcion_producto"
                                            value="${descripcion_producto}">
                                    </div>
                                    <input    type="hidden" id="id_producto" name="id_producto" value="${id_producto}">
                                    <button type="button" onclick="actualizarproducto();" class="btn btn-success float-right">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    `;

                document.querySelector('#titulo_modal').innerHTML = 'Actualizar productos';

                document.querySelector('#contenido_modal').innerHTML = cadena;

            }

            function actualizarproducto() {

                var cadena = new FormData(document.querySelector('#formulario_actualizar_productos'));
                var dato_marca = document.getElementById("id_marca");
                var nombre_marca = dato_marca.options[dato_marca.selectedIndex].text;
                var dato_categoria = document.getElementById("id_categoria");
                var nombre_categoria = dato_categoria.options[dato_categoria.selectedIndex].text;

                console.log(nombre_marca);

                fetch('producto_CO/actualizarproducto', {
                        method: 'POST',
                        body: cadena
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        if (respuesta.estado == 'EXITO') { 
                            let id_producto = document.querySelector('#formulario_actualizar_productos #id_producto').value;
                            let nombre_producto = document.querySelector('#formulario_actualizar_productos #nombre_producto').value;
                            let id_marca = document.querySelector('#formulario_actualizar_productos #id_marca').value;
                            let id_categoria = document.querySelector('#formulario_actualizar_productos #id_categoria').value;
                            let stock = document.querySelector('#formulario_actualizar_productos #stock').value;
                            let precio_unitario  = document.querySelector('#formulario_actualizar_productos #precio_unitario').value;
                            let descripcion_producto = document.querySelector('#formulario_actualizar_productos #descripcion_producto').value;

                           


                            document.querySelector('#nombre_marca_td_' + id_producto).innerHTML = nombre_marca;
                            document.querySelector('#nombre_marca_' + id_producto).value = nombre_marca;
                            document.querySelector('#nombre_categoria_td_' + id_producto).innerHTML = nombre_categoria;
                            document.querySelector('#nombre_categoria_' + id_producto).value = nombre_categoria;
                            document.querySelector('#nombre_producto_td_' + id_producto).innerHTML = nombre_producto;
                            document.querySelector('#nombre_producto_' + id_producto).value = nombre_producto;
                            document.querySelector('#stock_td_' + id_producto).innerHTML = stock;
                            document.querySelector('#stock_' + id_producto).value = stock;
                            document.querySelector('#precio_unitario_td_' + id_producto).innerHTML = precio_unitario;
                            document.querySelector('#precio_unitario_' + id_producto).value = precio_unitario;
                            document.querySelector('#descripcion_producto_td_' + id_producto).innerHTML = descripcion_producto;
                            document.querySelector('#descripcion_producto_' + id_producto).value = descripcion_producto;
                            document.querySelector('#id_marca' + id_producto).value = id_marca;
                            document.querySelector('#id_categoria' + id_producto).value = id_categoria;
                            
                        
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