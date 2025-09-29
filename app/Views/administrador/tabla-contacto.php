<div class="cards flex-tabla">
        <h1 class="h1-productos">Contactos</h1>
    <div class="flex-filtros-tabla">
        <div style="align-self: start;  padding: 2px 2px ; font-size: 1em" class="wapper-input input-login input-buscar filtros-flex">
            <a class="material-symbols-outlined a-buscar" onclick="buscarContactos();">search</a>        
            <input id="input-buscar" class="input input-telefono" id="input-filtro-buscar" type="text" placeholder="Buscar...">
        </div>
    </div>
        <table>
            <thead>
                <tr>
                <th class="filas">Id</th>
                <th class="filas">Nombre</th>
                <th class="filas">Email</th>
                <th class="filas">Motivo</th>
                <th class="filas">Mensaje</th>
                <th class="filas">Resuelto</th>
                <th class="filas">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactos as $contacto): ?>
                <tr>
                    <td class="filas"><?= $contacto['id_contacto']; ?></td>
                    <td class="filas"><?= $contacto['nombre_apellido']; ?></td>
                    <td class="filas"><?=$contacto['email']; ?></td>
                    <td class="filas"><?= $contacto['motivo']; ?></td>  
                    <td class="filas">
                    <button type="button" class="material-symbols-outlined icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $contacto['mensaje']; ?>">
                    email
                    </button>
                    </td>
                    <td class="filas">
                        <?php if( $contacto['resuelto'] == 1) {?>
                                <div class="estado estado-activo">si</div> 
                        <?php } else {?>
                                <div class="estado estado-inactivo">no</div> 
                        <?php }?>
                    </td>
                    <td class="filas">
                        <div style="display: flex; gap: 4px;">
                            <a class="material-symbols-outlined icon estado-producto" class="btn btn-secondary"
                            href="<?= base_url('contactos_resolver_').$contacto['id_contacto']; ?>" title="Resolver">check</a>
                            <a class="material-symbols-outlined icon estado-producto" class="btn btn-secondary"
                            href="<?= base_url('contactos_delete_').$contacto['id_contacto']; ?>" title="Eliminar">delete</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>


    </div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el))
})
</script>
