
    <div class="cards flex-tabla">
        <h1 class="h1-productos">Usuarios</h1>
    <div class="flex-filtros-tabla">
        <div style="align-self: start;  padding: 2px 2px ; font-size: 1em" class="wapper-input input-login input-buscar filtros-flex">
            <a class="material-symbols-outlined a-buscar" id="btn-buscar-usuarios" title="Buscar por nombre o categoría">search</a>        
            <input class="input input-telefono" id="input-buscar" type="text" placeholder="Buscar...">
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <div style="align-self: center;align-items: center;  padding: 2px 6px 2px 0; font-size: 1em" class="wapper-input input-login select-filtrar filtros-flex" style="flex: 1;">
                <span id="btn-estado" class="material-symbols-outlined" title="Filtrar por estado">filter_alt</span>
                <select id="select-estado" required class="input input-telefono" name="">
                    <option value="" disabled selected style="color: #38332f;">Estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>
            <div style="align-self: center;align-items: center;  padding: 2px 6px 2px 0; font-size: 1em" class="wapper-input input-login select-filtrar filtros-flex" style="flex: 1;">
                <span id="btn-perfil" class="material-symbols-outlined" title="Filtrar por perfil">instant_mix</span>
                <select id="select-perfil" required class="input input-telefono" name="">
                    <option value="" disabled selected style="color: #38332f;">Perfil</option>
                    <?php foreach ($perfiles as $perfil): ?>
                        <option value="<?= $perfil['id_perfiles']; ?>"> <?= esc($perfil['descripcion']) ?></option>
                        <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
        <table>
            <thead>
                <tr>
                <th class="filas">Id</th>
                <th class="filas">Nombre</th>
                <th class="filas">Email</th>
                <th class="filas">Rol</th>
                <th class="filas">Estado</th>
                <th class="filas">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td class="filas"><?= $usuario['id_usuario']; ?></td>
                    <td class="filas"><?= $usuario['nombre']; ?></td>
                    <td class="filas"><?= $usuario['email']; ?></td>
                    <?php if( $usuario['perfil_id'] == 1) {?> 
                        <td class="filas perfil-admin"><?= $usuario['perfil']; ?></td>  
                    <?php } else {?>
                        <td class="filas perfil-cliente"><?= $usuario['perfil']; ?></td>  
                    <?php }?>
                    <?php if( $usuario['estado'] == 1) {?>  
                    <td class="filas"> <div class="estado estado-activo">activo</div> </td>
                    <?php } else {?>
                        <td class="filas"> <div class="estado estado-inactivo">Inactivo</div> </td>
                    <?php }?>
                    <td class="filas">
                        <div>
                            <a class="material-symbols-outlined icon" href="<?= base_url('usuarios/edit/').$usuario['id_usuario']; ?>" title="Editar perfil">edit</a>
                            <?php if( $usuario['estado'] == 1) {?>  
                            <a class="material-symbols-outlined icon estado-usuario" class="btn btn-secondary"
                            href="<?= base_url('usuarios/delete/').$usuario['id_usuario']; ?>" title="Eliminar">delete</a>
                            <?php } else {?>
                                <a class="material-symbols-outlined icon estado-usuario" class="btn btn-secondary"
                            href="<?= base_url('usuarios/delete/').$usuario['id_usuario']; ?>" title="Activar">arrow_upward</a>
                            <?php }?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>


    </div>