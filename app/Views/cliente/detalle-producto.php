</div>
<?php $session = session();?>
<section id="producto-detalle">
    <div class="wapper-detalle-producto">
    <div>
        <img  src="<?= base_url()?>/assets/uploads/<?= $producto['imagen'] ?>" alt="">
    </div>
    <input id="id-producto" type="hidden" value="<?= $producto['id_producto'] ?>">
    
    <div class="flex-detalle-producto">
    <h1 class="nombre-producto"><?= $producto['nombre_producto'] ?></h1>
        <p class="precio-producto-detalle">$ <?= number_format($producto['precio'], 2); ?></p>
        <div  class="flex-descuento">
            <span style="padding-left: 0;" class="material-symbols-outlined">local_atm</span>
            <p><span style="font-weight: 700; color: var(--color-principal);" class="descuento">$ <?= number_format($producto['precio'] * 0.90, 2); ?></span> pagando con Transferencia</p>
        </div>
        <?php if( $producto['descripcion'] != null) {?>  
        <p class="descripcion-producto"><?= $producto['descripcion'] ?></p>
        <?php }?>
        <?php if( !empty($productosDetalleTalle) ) {?>  
        <div class="wapper-talles">
            <p style="font-weight: 700;">Talle: <span id="id-talle" class="talle-seleccionado" style="color: var(--color-principal);"><?= $productoDetalleSeleccionado['talle'] ?></span></p>
            <div class="flex-talles">
              <?php foreach ($productosDetalleTalle as $productoDetalle): ?>
                    <?php if($productoDetalle['id_talle'] == $productoDetalleSeleccionado['talle_id']) {?>  
                      <button id="<?= $productoDetalleSeleccionado['talle_id'] ?>" class="button-secundario talle-activo" value="<?= $productoDetalleSeleccionado['talle'] ?>"><?= $productoDetalle['talle'] ?></button>
                      <?php }else{?>
                              <button id="<?= $productoDetalle['id_talle'] ?>" class="button-secundario" value="<?= $productoDetalle['talle'] ?>"><?= $productoDetalle['talle'] ?></button>
                      <?php }?>
              <?php endforeach; ?>
            </div>
        </div>
        <?php }?>
        <div class="flex-colores-cantidad">
        <?php if( !empty($productosDetalleColor)) {?>  
        <div class="wapper-colores">
            <p style="font-weight: 700;">Color: <span id="id-color" class="color-seleccionado" style="color: var(--color-principal);"><?= $productoDetalleSeleccionado['nombre'] ?></span></p>
            <div class="flex-colores">
              <?php foreach ($productosDetalleColor as $productoDetalle): ?>
                <?php if($productoDetalle['id_colores'] == $productoDetalleSeleccionado['color_id']) {?> 
                    <div id="<?= $productoDetalle['id_colores'] ?>"  class="wapper-color color-activo" style="padding: 2px">
                      <button id="<?= $productoDetalleSeleccionado['color_id'] ?>" style="background: <?= $productoDetalleSeleccionado['codigo_hex'] ?>;" class="btn-colores" value="<?= $productoDetalle['nombre'] ?>"></button>
                    </div>
                <?php }else{?>
                    <div id="<?= $productoDetalle['id_colores'] ?>"  class="wapper-color" style="padding: 2px">
                      <button id="<?= $productoDetalle['id_colores'] ?>" style="background: <?= $productoDetalle['codigo_hex'] ?>;" class="btn-colores" value="<?= $productoDetalle['nombre'] ?>"></button>
                    </div>
                <?php }?>
              <?php endforeach; ?> 
            </div>
        </div>
        <?php }?>
            <div class="wapper-cantidad">
            <p style="font-weight: 700;">Cantidad:</p>
            <div class="wapper-input flex-cantidad">
            <button style="font-size: 22px !important" class="button-decremento material-symbols-outlined">remove</button>
            <input id="input-cantidad" class="input input-cantidad" type="number" value="1" min="0">
            <button style="font-size: 22px !important" class="button-incremento material-symbols-outlined">add</button>
            </div>
            </div>
        </div>
        <?php if($session->get('logged_in')) {?>  
        <button onclick="agregarAlCarrito();" style="margin-top: 20px" class="input-login input-submit-login">Agregar al carrito</button>
        <?php } else {?>
            <button  onclick="window.location.href='http://localhost/proyecto_espinola_emilia/login'" style="margin-top: 20px" class="input-login input-submit-login">Agregar al carrito</button>
        <?php }?>
    <p class="validacion-form" id="error-stock"></p>
    </div>
    </div>
</section>

<section>
  <div class="container-titulo-productos">
      <hr class="my-4 border-dark separador">
      <h1 class="titulos">Te puede interesar también</h1>
      <hr class="my-4 border-dark separador">
  </div>
  <div class="grid-productos galeria-productos grid-productos-segun-categoria">
      <?php foreach ($categorias as $categoria): ?>
        <div  onclick="window.location.href='<?= base_url('detalle_producto_').$categoria['id_producto']; ?>'" style="cursor: pointer;" class="item-producto"> 
            <p class="sin-stock con-stock">Sin stock</p>
          <img src="<?= base_url()?>/assets/uploads/<?= $categoria['imagen'] ?>"  alt="">
          <div class="contenido-productos">
            <p><?= $producto['nombre_producto'] ?></p>
            <p class="precio-producto">$ <?= number_format($categoria['precio'], 2); ?></p>
          </div>
        </div>
  <?php endforeach; ?>
  </div>
</section>