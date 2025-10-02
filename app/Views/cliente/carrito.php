
    <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Tu Carrito</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="wapper-carrito offcanvas-body">
    <?php if (isset($carrito) && count($carrito) > 0): ?>
    <?php $total = 0; ?>
    <?php foreach ($carrito as $item): ?>
    <div class="card-carrito">
        <img style="width: 100px; height: 100px; object-fit: cover; display: block; border-radius: 2px" src="<?= base_url()?>/assets/uploads/<?= $item['imagen'] ?>" alt="">
        <div style="display: flex; flex-direction: column; gap: 8px; flex: 1">
        <div>
        <div class="wapper-titulo-card">
            <p style="font-weight: 700;"><?= esc($item['nombre']) ?></p>
            <button id="id-producto-detalle"  value="<?= esc($item['id_detalle_producto']) ?>" style="font-size: 22px !important; padding: 0" class="btn material-symbols-outlined">delete</button>
        </div>
        <p style="font-size: 0.8em;"><span style="font-weight: 700;">Talle: </span> <?= esc($item['talle']) ?> </p>
        <p style="font-size: 0.8em;"> <span style="font-weight: 700;">Color: </span> <?= esc($item['color']) ?></p>
    </div>
    <p class="validacion-form" id="error-stock-carrito"></p>
    <div class="wapper-titulo-card">
        <p style="font-size: 0.9em; font-weight: 700;" value="<?=$item['precio'] ?>">$ <?= number_format($item['precio'] * $item['cantidad'] , 2)?></p>
        <div class="wapper-input flex-cantidad" style="gap: 0;">
            <button value="<?=$item['id_detalle_producto'] ?>" id="descrementar"  style="font-size: 18px !important; padding: 0;" class="button-cantidad-carrito material-symbols-outlined">remove</button>
            <input readonly style="font-size: 14px;" class="input input-cantidad input-cantidad-carrito" type="number" value="<?= $item['cantidad']?>" min="0">
            <button value="<?=$item['id_detalle_producto'] ?>" id="incrementar" style="font-size: 18px !important; padding: 0;" class="button-cantidad-carrito material-symbols-outlined">add</button>
        </div>
    </div>
    </div>
    </div>
    <?php $total += $item['precio'] * $item['cantidad']; ?>
    <?php endforeach; ?>
    </div>
    <div  style="font-weight: 700;" class="wapper-total-carrito">
    <div style="font-size: 1.1em;" class="flex-total-carrito">
    <p>Total: </p>
    <p>$ <?= number_format($total, 2); ?></p>
    </div>
    <div  style="font-size: 0.9em;" class="flex-total-carrito">
    <p>Pagando con transferencia: </p>
    <p>$ <?= number_format($total * 0.90 , 2)?></p>
    </div>
    <button onclick="comprar();" style="margin-top: 20px" class="input-login input-submit-login" >Comprar</button>
    <?php else: ?>

        <div>
            <p style="text-align: center;  font-weight: 700;  letter-spacing: 1px;">Tu carrito de compras está vacio.</p>
        </div>

    <?php endif; ?>
    </div>