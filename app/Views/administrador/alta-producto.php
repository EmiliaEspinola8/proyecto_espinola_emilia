
        <?php $validation = \Config\Services::validation(); ?>
        <form  action="<?php echo base_url('/enviarproductos') ?>" method="post" class="flex-producto" style="padding-top: 20px;"  enctype="multipart/form-data">
            <div class="wapper-producto">
            <div class="flex-archivo">
                <div>
                    <img class="imagen_producto" id="vista_previa" src="assets/img/subir_archivo2.png" alt="">
                <?php if($validation->getError('imagen')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('imagen'); ?>
                </div>
            <?php }?>
                </div>
                <input name="imagen" type="file" id="fileInput" hidden accept=".webp">
                <label for="fileInput" type="button" class="button-admin input-login input-submit-login custom-file-label">Subir archivo</label>
            </div>
            <div style="display: flex; flex-direction: column;  min-width: 550px; gap: 30px" >
            <div class="card  form-producto">
            <h1 style="font-size: 1.9em">Agregar Producto</h1>
            <div>
                <label class="label-login">Nombre
                    <input name="nombre_producto" autocomplete="off" class="input-login" type="text" placeholder="Ingresa el nombre del producto">
            </label>
            <?php if($validation->getError('nombre_producto')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('nombre_producto'); ?>
                </div>
            <?php }?>
            </div>
            <div>
                <label class="label-login">Precio
                    <input name="precio" class="input-login" type="number" name="clave" placeholder="Ingresa el precio del producto">
            </label>
            <?php if($validation->getError('precio')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('precio'); ?>
                </div>
            <?php }?>
            </div>
            <div>
                <label class="label-login">Categoría                
                <select required class="input-login" name="categoria_id" id="">
                    <option value="" disabled selected style="color: #38332f;">Selecciona una categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id_categoria']; ?>"> <?= esc($categoria['descripcion']) ?></option>
                    <?php endforeach; ?>     
                </select>
            </label>
            <?php if($validation->getError('categoria_id')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('categoria_id'); ?>
                </div>
            <?php }?>
            </div>
            <div>
            <label class="label-login">Stock
                    <input name="stock" class="input-login input-stock input-cantidad" type="number" name="clave" placeholder="Ingresa el stock del producto">
            </label>
            <?php if($validation->getError('stock')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('stock'); ?>
                </div>
            <?php }?>
            </div>
            <div>
                <label class="label-login">Descripción
                    <textarea name="descripcion" class="input-login" id="" placeholder="Ingresa la el descripción del producto"></textarea>
            </label>
            <?php if($validation->getError('descripcion')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('descripcion'); ?>
                </div>
            <?php }?>
            </div>
            <input autocomplete="off" class="button-admin input-login input-submit-login" type="submit" value="Agregar Producto">
            </div>

            <div id="grid-colores-talles" class="grid-colores-talles">
                <div id="plantilla-color-talle" style="display: none;">
    <div class="card card-talles-colores">
        <div class="flex-color-talle">
            <label class="label-login">Colores                
                <select name="color[]" class="input-login">
                    <option value="" disabled selected style="color: #38332f;">Selecciona un color</option>
                    <?php foreach ($colores as $color): ?>
                        <option value="<?= $color['id_colores']; ?>"><?= $color['nombre']; ?></option>
                    <?php endforeach; ?>  
                </select>
            </label>
            <label class="label-login">Talles                
                <select name="talle[]" class="input-login">
                    <option value="" disabled selected style="color: #38332f;">Selecciona un talle</option>
                    <?php foreach ($talles as $talle): ?>
                        <option value="<?= $talle['id_talle']; ?>"><?= $talle['talle']; ?></option>
                    <?php endforeach; ?>  
                </select>
            </label>
        </div>
        <label class="label-login">Stock
            <input  name="cantidad[]" class="input-login inputs-stock input-cantidad" type="number" placeholder="Ingresa el stock del producto">
        </label>

        <button type="button" class="btn-eliminar material-symbols-outlined">close</button>
    </div>
</div>
            </div>

            <div class="button-add-talle-color">
            <span class="material-symbols-outlined">add</span>
            <button type="button">Agregar color y talle</button>
            </div>
            </div>
            </div>  
        </form>
