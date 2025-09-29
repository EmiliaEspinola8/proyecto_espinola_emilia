
    <div class="cards flex-tabla">
        <h1 class="h1-productos">Detalle de la Venta</h1>
    <div class="flex-filtros-tabla">
    </div>
        <table>
            <thead>
                <tr>
                <th class="filas filas-tabla-detalles">Id</th> 
                <th class="filas filas-tabla-detalles">Venta_id</th>
                <th class="filas filas-tabla-detalles">Nombre del producto</th>
                <th class="filas filas-tabla-detalles">precio</th>
                <th class="filas filas-tabla-detalles">cantidad</th>
                <th class="filas filas-tabla-detalles">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventasDetalle as $venta): ?>
                <tr>
                    <td class="filas filas-tabla-detalles"><?= $venta['id']; ?></td>
                    <td class="filas filas-tabla-detalles"><?= $venta['venta_id']; ?></td>
                    <td class="filas filas-tabla-detalles"><?= $venta['nombre_producto']; ?></td>
                    <td class="filas filas-tabla-detalles">$ <?= number_format($venta['precio'], 2);  ?></td>
                    <td class="filas filas-tabla-detalles"><?= $venta['cantidad'];  ?></td>
                    <td class="filas filas-tabla-detalles">$ <?=number_format($venta['subtotal'], 2); ?></td>  
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>
</div>