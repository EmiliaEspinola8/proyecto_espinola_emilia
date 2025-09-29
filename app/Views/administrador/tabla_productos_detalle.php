    <div class="cards flex-tabla">
        <h1 class="h1-productos">Detalle del Producto</h1>
    <div class="flex-filtros-tabla">
        <div style="align-self: start;  padding: 2px 2px ; font-size: 1em" class="wapper-input input-login input-buscar filtros-flex">
            <span class="material-symbols-outlined">search</span>        
            <input class="input input-telefono" type="text" placeholder="Buscar...">
        </div>
        <div style="display: flex; flex-direction: center; gap: 10px; align-items: center;">

        </div>
    </div>
        <table>
            <thead>
                <tr>
                <th class="filas filas-tabla-detalles">Id</th>
                <th class="filas filas-tabla-detalles">Id_producto</th>
                <th class="filas filas-tabla-detalles">Nombre producto</th>
                <th class="filas filas-tabla-detalles">Talle</th>
                <th class="filas filas-tabla-detalles">Color</th>
                <th class="filas filas-tabla-detalles">Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productosDetalle as $productoDetalle): ?>
                <tr>
                    <td class="filas filas-tabla-detalles"><?= $productoDetalle['id_producto']; ?></td>
                    <td class="filas filas-tabla-detalles"><?= $productoDetalle['producto_id']; ?></td>
                    <td class="filas filas-tabla-detalles"><?= $productoDetalle['nombre_producto']; ?></td>
                    <td class="filas filas-tabla-detalles"><?= $productoDetalle['talle']; ?></td>
                    <td class="filas filas-tabla-detalles"><?= $productoDetalle['nombre']; ?></td>
                    <td class="filas filas-tabla-detalles"><?= $productoDetalle['stock']; ?></td>  
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>
