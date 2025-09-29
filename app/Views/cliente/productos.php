    </div>
<section>
    <div style="display: flex; flex-direction: column;">
    <div class="header-filtros">
        <h2 style="font-size: 1.7em">Productos</h2>
            <div style="display: flex; justify-content: end; flex: 1; gap: 10px" class="filtros">
                <div class="wapper-input wapper-input-telefono input-buscar filtros-lg">
                    <span class="material-symbols-outlined">search</span>
                    <input class="input input-telefono" type="text" placeholder="Buscar...">
                </div>
                <div  class="wapper-input wapper-input-telefono select-filtrar filtros-lg">
                <span class="material-symbols-outlined">filter_alt</span>
                <select class="input input-telefono" name="" id="">
                    <option value="S">Más nuevo al más viejo</option>
                    <option value="M">Más viejo al maás nuevo</option>
                    <option value="L">Precio: De mayor a menor</option>
                    <option value="L">Precio: De menor a mayor</option>
                </select>
                </div>
                <button class="button-filtros input-login" style="display: flex; align-items: center; padding: 4px 20px 4px 20px;"type="button"data-bs-toggle="offcanvas" data-bs-target="#static" aria-controls="static" aria-expanded="false" aria-label="Toggle navigation">
                <span style="padding-left: 0" class="material-symbols-outlined">instant_mix</span>Filtrar
            </button>
            </div>
            <div>
            </div>
    </div>

            <div style="display: flex;" class="body-filtros">
                <div>
                    <nav class="sidebar navbar-expand-lg bg-body-tertiary">
                        <div class="sidebar-offcanvas offcanvas offcanvas-start" id="static">
                        <div class="flex-filtros sidebar-filtros">

                        <div class="flex-filtros filtro"  style="gap: 6px; justify-content: center;">

                            <div style="display: none" class="filtros-mv">
                              <div style="display: flex;justify-content: space-between; align-items: center">
                                <p style="font-size: 1.3em">filtros</p>
                                <button style="padding: 0;"  type="button" class="btn-close btn-close-navbar" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                              
                <div style="display: flex; flex-direction: column; flex: 1; gap: 10px;" class="filtros filtros-mv">
                  <div style="align-self: start;" class="wapper-input wapper-input-telefono input-buscar filtros-flex">
                    <span class="material-symbols-outlined">search</span>
                    <input class="input input-telefono" type="text" placeholder="Buscar...">
                  </div>
                <div  class="wapper-input wapper-input-telefono select-filtrar filtros-flex" style="flex: 1;">
                <span class="material-symbols-outlined">filter_alt</span>
                <select class="input input-telefono" name="" id="">
                    <option value="S">Más nuevo al más viejo</option>
                    <option value="M">Más viejo al maás nuevo</option>
                    <option value="L">Precio: De mayor a menor</option>
                    <option value="L">Precio: De menor a mayor</option>
                </select>
                </div>
                <hr>
                              
                          </div> 
                            </div>


                            <div class="flex-filtros filtro"  style="gap: 6px">
                            <h3>Categorías</h3>
                            <p>Baby tees</p>
                            <p>Minis</p>
                            <p>Buzos</p>
                            <p>Vestidos</p>
                            <hr>
                            </div>

                            <div class="filtro">
                                <h3>Talles</h3>
                                <div class="flex-filtros" style="gap: 6px">
                                    <label class="flex-checkbox">
                                        <input type="checkbox" name="opcion1" value="valor1">S
                                    </label>
                                    <label class="flex-checkbox">
                                        <input type="checkbox" name="opcion1" value="valor1">M
                                    </label>
                                    <label class="flex-checkbox">
                                        <input type="checkbox" name="opcion1" value="valor1">L
                                    </label>
                                    <label class="flex-checkbox">
                                        <input type="checkbox" name="opcion1" value="valor1">XL
                                    </label>
                                    <hr>
                                </div> 
                            </div>

                            <div class="filtro">
                                <h3>Colores</h3>
                                <div class="flex-filtros" style="gap: 6px">
                                    <label class="flex-checkbox">
                                        <input type="checkbox" name="opcion1" value="valor1">Blanco
                                    </label>
                                    <label class="flex-checkbox">
                                        <input type="checkbox" name="opcion1" value="valor1">Negro
                                    </label class="flex-checkbox">
                                    <label class="flex-checkbox">
                                        <input type="checkbox" name="opcion1" value="valor1">Rosado
                                    </label class="flex-checkbox">
                                    <label class="flex-checkbox">
                                        <input type="checkbox" name="opcion1" value="valor1">Bordo
                                    </label>
                                    
                                </div> 
                            </div>
                        </div>
                        </div>
                    </nav>
                </div>
                
                <div style="flex: 1; padding-top: 0; align-items: center;" class="grid-productos galeria-productos">
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
</div>
</section>