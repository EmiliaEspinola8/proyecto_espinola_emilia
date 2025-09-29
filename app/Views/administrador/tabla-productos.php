
    <div class="cards flex-tabla">
        <h1 class="h1-productos">Productos</h1>
    <div class="flex-filtros-tabla">
        <div style="align-self: start;  padding: 2px 2px ; font-size: 1em" class="wapper-input input-login input-buscar filtros-flex">
            <a class="material-symbols-outlined a-buscar" onclick="buscar();" title="Buscar por nombre o categoría">search</a>        
            <input class="input input-telefono" id="input-filtro-buscar" type="text" placeholder="Buscar...">
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <div style="align-self: center;align-items: center;  padding: 2px 6px 2px 0; font-size: 1em" class="wapper-input input-login select-filtrar filtros-flex" style="flex: 1;">
                <span onclick="buscar();" class="material-symbols-outlined" title="Filtrar por estado">filter_alt</span>
                <select id="select-estado" required class="input input-telefono" name="">
                    <option value="" disabled selected style="color: #38332f;">Estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
        </div>
        <a href="<?= base_url('alta-producto')?>" style="align-items: center;  padding: 2px 2px; font-size: 1em" class="filtros-flex input-login input-buscar button-admin">
            <span class="material-symbols-outlined">add</span>
            <button class="input input-telefono">Agregar Producto</button>
        </a>
        </div>
    </div>
        <table>
            <thead>
                <tr>
                <th class="filas">Id</th>
                <th class="filas">Nombre Completo</th>
                <th class="filas">Precio</th>
                <th class="filas">Categoría</th>
                <th class="filas">Stock</th>
                <th class="filas">Estado</th>
                <th class="filas">Detalle</th>
                <th class="filas">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td class="filas"><?= $producto['id_producto']; ?></td>
                    <td class="filas"><?= $producto['nombre_producto']; ?></td>
                    <td class="filas">$ <?=number_format($producto['precio'], 2); ?></td>
                    <td class="filas"><?= $producto['categoria']; ?></td>
                    <td class="filas"><?= $producto['stock']; ?></td>  
                    <?php if( $producto['estado'] == 1) {?>  
                    <td class="filas"> <div class="estado estado-activo">activo</div> </td>
                    <?php } else {?>
                        <td class="filas"> <div class="estado estado-inactivo">inactivo</div> </td>
                    <?php }?>
                    <td class="filas"><a href="<?= base_url('tabla_productoDetalle_').$producto['id_producto'];?>" class="material-symbols-outlined icon" title="Ver detalle">visibility</a></td>
                    <td class="filas">
                        <div>
                            <a class="material-symbols-outlined icon" href="<?= base_url('productos_edit_').$producto['id_producto']; ?>" title="Editar">edit</a>
                            <?php if( $producto['estado'] == 1) {?>  
                            <a class="material-symbols-outlined icon estado-producto" class="btn btn-secondary"
                            href="<?= base_url('productos/delete/').$producto['id_producto']; ?>" title="Eliminar">delete</a>
                            <?php } else {?>
                                <a class="material-symbols-outlined icon estado-producto" class="btn btn-secondary"
                            href="<?= base_url('productos/delete/').$producto['id_producto']; ?>" title="Activar">arrow_upward</a>
                            <?php }?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>


    </div>
