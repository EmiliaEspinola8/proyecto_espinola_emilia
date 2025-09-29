    </div>
<section>
<h2 class="titulos titulo-categoria">Categorías</h2>
<hr class="my-4 border-dark separador">
  <div class="grid-productos galeria-categoria">
    <?php foreach ($categorias as $categoria): ?>
    <div>
      <img src="<?= base_url()?>/assets/uploads/<?= $categoria['imagen'] ?>" alt="">
      <div><p><?= $categoria['descripcion'] ?></p></div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<section>
  <div class="container-titulo-productos">
      <hr class="my-4 border-dark separador">
      <h1 class="titulos">Productos populares</h1>
      <hr class="my-4 border-dark separador">
  </div>
  <div class="grid-productos galeria-productos">
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
  <div class="wapper-mas-productos">
    <a href="<?= base_url('productos')?>" class="button-secundario">Todos los productos</a>
  </div>

</section>