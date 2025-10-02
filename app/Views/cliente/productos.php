    </div>
    <div style="display: flex; flex-direction: column; margin-top: 40px;">
    <div class="header-filtros">
        <h2 style="font-size: 1.7em">Productos</h2>
            <div style="display: flex; justify-content: end; flex: 1; gap: 10px" class="filtros">
                <div class="wapper-input wapper-input-telefono input-buscar filtros-lg">
                    <span id="btn-buscar" class="material-symbols-outlined">search</span>
                    <input id="input-buscar" class="input input-telefono" type="text" placeholder="Buscar...">
                </div>
                <div  class="wapper-input wapper-input-telefono select-filtrar filtros-lg">
                <span class="material-symbols-outlined">filter_alt</span>
                <select class="input input-telefono ordenamiento" name="ordenamiento" id="">
                    <option value="1">Más nuevo al más viejo</option>
                    <option value="2">Más viejo al más nuevo</option>
                    <option value="3">Del mayor precio al menor</option>
                    <option value="4">Del menor precio al mayor</option>
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
                    <span id="btn-buscar" class="material-symbols-outlined">search</span>
                    <input id="input-buscar" class="input input-telefono" type="text" placeholder="Buscar...">
                    </div>
                <div  class="wapper-input wapper-input-telefono select-filtrar filtros-flex" style="flex: 1;">
                <span class="material-symbols-outlined">filter_alt</span>
                <select class="input input-telefono ordenamiento" name="ordenamiento" id="ordenamiento">
                    <option value="1">Más nuevo al más viejo</option>
                    <option value="2">Más viejo al más nuevo</option>
                    <option value="3">Precio: De mayor a menor</option>
                    <option value="4">Precio: De menor a mayor</option>
                </select>
                </div>
                <hr>
                        </div> 
                            </div>
                            <div class="flex-filtros filtro"  style="gap: 6px">
                            <h3>Categorías</h3>
                            <?php foreach ($categorias as $categoria): ?>
                                <label class="label-categorias">
                                        <?= $categoria['descripcion'] ?>
                                        <input class="categorias" name="categorias" value="<?= $categoria['id_categoria'] ?>" type="radio">
                                </label>
                            <?php endforeach; ?>
                            <hr>
                            </div>

                            <div class="filtro">
                                <h3>Talles</h3>
                                <div class="flex-filtros" style="gap: 6px">
                                <?php foreach ($talles as $talle): ?>
                                    <label class="flex-checkbox">
                                        <input class="talles" name="talles" type="checkbox" value="<?= $talle['id_talle'] ?>"><?= $talle['talle'] ?>
                                    </label>
                                <?php endforeach; ?>
                                    <hr>
                                </div> 
                            </div>

                            <div class="filtro">
                                <h3>Colores</h3>
                                <?php foreach ($colores as $color): ?>
                                <div class="flex-filtros" style="gap: 6px">
                                    <label class="flex-checkbox">
                                        <input class="colores" name="colores" type="checkbox" name="opcion1" value="<?= $color['id_colores'] ?>"><?= $color['nombre'] ?>
                                    </label>
                                <?php endforeach; ?>
                                </div> 
                            </div>
                        </div>
                        </div>
                    </nav>
                </div>
                <div style="flex: 1; padding-top: 0; align-items: center;" class="grid-productos galeria-productos">