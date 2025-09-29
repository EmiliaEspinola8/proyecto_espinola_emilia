    <div class="cards flex-tabla">
        <h1 class="h1-productos">Categorías</h1>
    <div class="flex-filtros-tabla">
        <div style="align-self: start;  padding: 2px 2px ; font-size: 1em" class="wapper-input input-login input-buscar filtros-flex">
            <span onclick="fitrarCategorias();" class="material-symbols-outlined" title="Buscar por descripción">search</span>        
            <input id="input-filtro-buscar" class="input input-telefono" type="text" placeholder="Buscar...">
        </div>
        <div style="display: flex; flex-direction: center; gap: 10px; align-items: center;">
            <div style="align-self: center;align-items: center;  padding: 2px 6px 2px 0; font-size: 1em" class="wapper-input input-login select-filtrar filtros-flex" style="flex: 1;">
                <span onclick="fitrarCategorias();" class="material-symbols-outlined" title="Filtrar por estado">filter_alt</span>
                <select required id="select-estado" class="input input-telefono" name="" id="">
                    <option value="" disabled selected style="color: #38332f;">Estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
        </div>
        <div style="align-items: center;  padding: 2px 2px; font-size: 1em" class="filtros-flex input-login input-buscar button-admin">
            <span class="material-symbols-outlined">add</span>
            <button class="input input-telefono" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Categoría</button>
        </div>
        </div>
    </div>
        <table>
            <thead>
                <tr>
                <th class="filas">Id</th>
                <th class="filas">Descripción</th>
                <th class="filas">estado</th>
                <th class="filas">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td class="filas"><?= $categoria['id_categoria']; ?></td>
                    <td class="filas"><?= $categoria['descripcion']; ?></td>  
                    <?php if( $categoria['activo'] == 1) {?>  
                    <td class="filas"> <div class="estado estado-talle estado-activo">activo</div> </td>
                    <?php } else {?>
                        <td class="filas"> <div class="estado estado-talle estado-inactivo">Inactivo</div> </td>
                    <?php }?>
                    <td class="filas">
                        <div>
                            <button value="<?= $categoria['descripcion']; ?>" class="btn-edit material-symbols-outlined icon">edit</button>
                            <?php if( $categoria['activo'] == 1) {?>  
                            <a class="material-symbols-outlined icon estado-producto" class="btn btn-secondary"
                            href="<?= base_url('categoria/delete/').$categoria['id_categoria']; ?>" title="Eliminar">delete</a>
                            <?php } else {?>
                                <a class="material-symbols-outlined icon estado-producto" class="btn btn-secondary"
                            href="<?= base_url('categoria/delete/').$categoria['id_categoria']; ?>" title="Activar">arrow_upward</a>
                            <?php }?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>


    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Categoría</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-talle">
            <label class="label-login">Descipción
                    <input id="input-categoria" autocomplete="off" class="input input-login" type="text" placeholder="Ej. Blusas" required>
            </label>
                <div class="validacion-form">
                </div>
        </div>
        <div class="modal-footer">
            <button id="btn-agregar-categoria" class="button-admin input-login input-submit-login" value="Agregar Categoría" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Agregar Categoría</button>
        </div>
    </div>
    </div>
</div>


<!-- Modal Para Editar-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Categoría</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-talle">
            <label class="label-login">Descipción
                    <input id="input-categoria-edit-ant" hidden autocomplete="off" class="input input-login" type="text" placeholder="Ej. Blusas" required>
                    <input id="input-categoria-edit" autocomplete="off" class="input input-login" type="text" placeholder="Ej. Blusas" required>
            </label>
                <div class="validacion-form">
                </div>
        </div>
        <div class="modal-footer">
            <button id="btn-editar-categoria" class="button-admin input-login input-submit-login" value="Agregar Categoría" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Editar Categoría</button>
        </div>
    </div>
    </div>
</div>