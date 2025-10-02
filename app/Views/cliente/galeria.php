                        <?php foreach ($productos as $producto): ?>
                            <div  onclick="window.location.href='<?= base_url('detalle_producto_').$producto['id_producto']; ?>'" style="cursor: pointer;" class="item-producto"> 
                            <?php if ($producto['stock'] == 0){ ?>
                            <p class="sin-stock">Sin stock</p>
                            <?php }else{ ?>
                                <p class="sin-stock con-stock">Sin stock</p>
                            <?php } ?>
                            <img src="<?= base_url()?>/assets/uploads/<?= $producto['imagen'] ?>"  alt="">
                            <div class="contenido-productos">
                                <p><?= $producto['nombre_producto'] ?></p>
                                <p class="precio-producto">$ <?= number_format($producto['precio'], 2); ?></p>
                            </div>
                            </div>
<?php endforeach; ?>
</div>