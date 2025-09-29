    <div class="cards flex-tabla">
        <h1 class="h1-productos">Colores</h1>
    <div class="flex-filtros-tabla">
        <div style="align-self: start;  padding: 2px 2px ; font-size: 1em" class="wapper-input input-login input-buscar filtros-flex">
            <span title="Buscar por talle" onclick="filtrarColores();" class="material-symbols-outlined">search</span>        
            <input id="input-filtro-buscar" class="input input-telefono" type="text" placeholder="Buscar...">
        </div>
        <div style="display: flex; flex-direction: center; gap: 10px; align-items: center;">
            <div style="align-self: center;align-items: center;  padding: 2px 6px 2px 0; font-size: 1em" class="wapper-input input-login select-filtrar filtros-flex" style="flex: 1;">
                <span title="Filtrar por estado" onclick="filtrarColores();" class="material-symbols-outlined">filter_alt</span>
                <select id="select-estado" required class="input input-telefono" name="" id="">
                    <option value="" disabled selected style="color: #38332f;">Estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
        </div>
        <div style="align-items: center;  padding: 2px 2px; font-size: 1em" class="filtros-flex input-login input-buscar button-admin">
            <span class="material-symbols-outlined">add</span>
            <button class="input input-telefono" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Color</button>
        </div>
        </div>
    </div>
        <table id="tabla">
            <thead>
                <tr>
                <th class="filas">Id</th>
                <th class="filas">Nombre</th>
                <th class="filas">Cod. Hexadecimal</th>
                <th class="filas">Color</th>
                <th class="filas">Estado</th>
                <th class="filas">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($colores as $color): ?>
                <tr>
                    <td class="filas"><?= $color['id_colores']; ?></td>
                    <td class="filas"><?= $color['nombre']; ?></td>  
                    <td class="filas"><?= $color['codigo_hex']; ?></td> 
                    <td class="filas">
                        <button style="background: <?= $color['codigo_hex'] ?>;" class="btn-colores btn-tabla-color"></button>
                    </td> 
                    <?php if( $color['estado'] == 1) {?>  
                    <td class="filas"> <div class="estado estado-talle estado-activo">activo</div> </td>
                    <?php } else {?>
                        <td class="filas"> <div class="estado estado-talle estado-inactivo">inactivo</div> </td>
                    <?php }?>
                    <td class="filas">
                        <div>
                            <button id="<?= $color['codigo_hex']; ?>" value="<?= $color['nombre']; ?>" class="btn-edit-color material-symbols-outlined icon">edit</button>
                            <?php if( $color['estado'] == 1) {?>  
                            <a class="material-symbols-outlined icon estado-producto" class="btn btn-secondary"
                            href="<?= base_url('color/delete/').$color['id_colores']; ?>" title="Eliminar">delete</a>
                            <?php } else {?>
                                <a class="material-symbols-outlined icon estado-producto" class="btn btn-secondary"
                            href="<?= base_url('color/delete/').$color['id_colores']; ?>" title="Activar">arrow_upward</a>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar color</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-talle">
            <div style="display: flex; justify-content: center; gap: 40px">
            <label class="label-login" style="flex: 1;">Nombre
                    <input id="input-nom-color" autocomplete="off" class="input input-login" type="text" placeholder="Ej. Blanco" required>
                    <div class="validacion validacion-nombre"></div>
            </label>
            <label class="label-login" style="flex: 1">Color
                    <input id="input-hex-color" autocomplete="off" class="input input-login input-color" type="color" required>
                    <div class="validacion validacion-codigo"></div>
            </label>
            </div>

        </div>
        <div class="modal-footer">
            <button onclick="agregarColor();" class="button-admin input-login input-submit-login" value="Agregar talle" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Agregar color</button>
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="editModalColor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar color</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-talle">
            <div style="display: flex; justify-content: center; gap: 40px">
            <label class="label-login" style="flex: 1;">Nombre
                    <input id="input-nom-color-ant" hidden type="text">
                    <input id="input-nom-color-edit" autocomplete="off" class="input input-login" type="text" placeholder="Ej. Blanco" required>
                    <div class="validacion validacion-nombre-edit"></div>
            </label>
            <label class="label-login" style="flex: 1">Color
                    <input id="input-hex-color-edit" autocomplete="off" class="input input-login input-color" type="color" required>
                    <div class="validacion validacion-codigo-edit"></div>
            </label>
            </div>

        </div>
        <div class="modal-footer">
            <button id="btn-editar-color" class="button-admin input-login input-submit-login" value="Agregar talle" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Editar color</button>
        </div>
    </div>
    </div>
</div>
