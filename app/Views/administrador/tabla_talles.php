    <div class="cards flex-tabla">
        <h1 class="h1-productos">Talles</h1>
    <div class="flex-filtros-tabla">
        <div style="align-self: start;  padding: 2px 2px ; font-size: 1em" class="wapper-input input-login input-buscar filtros-flex">
            <span title="Buscar por talle" onclick="filtrarTalles();" class="material-symbols-outlined">search</span>        
            <input id="input-filtro-buscar" class="input input-telefono" type="text" placeholder="Buscar...">
        </div>
        <div style="display: flex; flex-direction: center; gap: 10px; align-items: center;">
            <div style="align-self: center;align-items: center;  padding: 2px 6px 2px 0; font-size: 1em" class="wapper-input input-login select-filtrar filtros-flex" style="flex: 1;">
                <span title="Filtrar por estado" onclick="filtrarTalles();" class="material-symbols-outlined">filter_alt</span>
                <select id="select-estado" required class="input input-telefono" name="" id="">
                    <option value="" disabled selected style="color: #38332f;">Estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
        </div>
        <div style="align-items: center;  padding: 2px 2px; font-size: 1em" class="filtros-flex input-login input-buscar button-admin">
            <span class="material-symbols-outlined">add</span>
            <button class="input input-telefono" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar talle</button>
        </div>
        </div>
    </div>
        <table>
            <thead>
                <tr>
                <th class="filas">Id</th>
                <th class="filas">Nombre</th>
                <th class="filas">estado</th>
                <th class="filas">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($talles as $talle): ?>
                <tr>
                    <td class="filas"><?= $talle['id_talle']; ?></td>
                    <td class="filas"><?= $talle['talle']; ?></td>  
                    <?php if( $talle['estado'] == 1) {?>  
                    <td class="filas"> <div class="estado estado-talle estado-activo">activo</div> </td>
                    <?php } else {?>
                        <td class="filas"> <div class="estado estado-talle estado-inactivo">Inactivo</div> </td>
                    <?php }?>
                    <td class="filas">
                        <div>
                            <button value="<?= $talle['talle']; ?>" class="btn-edit material-symbols-outlined icon">edit</button>
                            <?php if( $talle['estado'] == 1) {?>  
                            <a class="material-symbols-outlined icon estado-producto" class="btn btn-secondary"
                            href="<?= base_url('talle/delete/').$talle['id_talle']; ?>" title="Eliminar">delete</a>
                            <?php } else {?>
                                <a class="material-symbols-outlined icon estado-producto" class="btn btn-secondary"
                            href="<?= base_url('talle/delete/').$talle['id_talle']; ?>" title="Activar">arrow_upward</a>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Talle</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-talle">
            <label class="label-login">Nombre
                    <input id="input-talle" autocomplete="off" class="input input-login" type="text" placeholder="Ej. L" required>
            </label>
                <div class="validacion-form">
                </div>
        </div>
        <div class="modal-footer">
            <button onclick="agregarTalle();" class="button-admin input-login input-submit-login" value="Agregar talle" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Agregar Talle</button>
        </div>
    </div>
    </div>
</div>


<!-- Modal Para Editar-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Talle</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-talle">
            <label class="label-login">Nombre
                    <input id="input-categoria-edit-ant" hidden type="text">
                    <input id="input-categoria-edit" autocomplete="off" class="input input-login" type="text" placeholder="Ej. L" required>
            </label>
                <div class="validacion-form-edit">
                </div>
        </div>
        <div class="modal-footer">
            <button id="btn-editar-talle" class="button-admin input-login input-submit-login" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Editar Talle</button>
        </div>
    </div>
    </div>
</div>