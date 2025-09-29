
    <div class="cards flex-tabla">
        <h1 class="h1-productos">Ventas</h1>
    <div class="flex-filtros-tabla">
        <div style="align-self: end;  padding: 2px 2px ; font-size: 1em" class="wapper-input input-login input-buscar filtros-flex">
            <a id="btn-buscar" class="material-symbols-outlined a-buscar" title="Has click para filtrar">search</a>        
            <input id="buscar" class="input input-telefono" id="input-filtro-buscar" type="text" placeholder="Buscar por usuario...">
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <div style="display: flex; flex-direction: column;">
                <label class="label-login" for="">Desde:</label>
                <input id="fecha-desde" class="input-login input-fecha" type="date">
            </div>
            <div  style="display: flex; flex-direction: column;">
                <label class="label-login" for="">Hasta:</label>
                <input id="fecha-hasta" class="input-login input-fecha" type="date">
            </div>
        </div>
    </div>
        <table>
            <thead>
                <tr>
                <th class="filas filas-tabla-detalles">Id</th> 
                <th class="filas filas-tabla-detalle">Usuario</th>
                <th class="filas filas-tabla-detalle">Fecha</th>
                <th class="filas filas-tabla-detalle">Hora</th>
                <th class="filas filas-tabla-detalle">Total</th>
                <th class="filas filas-tabla-detalle">Detalle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td class="filas filas-tabla-detalle"><?= $venta['id_ventas']; ?></td>
                    <td class="filas filas-tabla-detalle"><?= $venta['nombre']; ?></td>
                    <td class="filas filas-tabla-detalle"><?=  $venta['fecha']; ?></td>
                    <td class="filas filas-tabla-detalle"><?=  $venta['hora'];  ?></td>
                    <td class="filas filas-tabla-detalle">$ <?=number_format($venta['total_venta'], 2); ?></td>  
                    <td class="filas filas-tabla-detalle"><a href="<?= base_url('detalles_').$venta['id_ventas']; ?>" class="material-symbols-outlined icon" title="Ver detalle">visibility</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>
</div>