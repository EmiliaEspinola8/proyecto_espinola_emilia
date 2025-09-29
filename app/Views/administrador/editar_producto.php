
        <?php $validation = \Config\Services::validation(); ?>
        <form action="<?php echo base_url('productos_update_').$producto['id_producto'] ?>" method="post"  style="padding-top: 20px;" class="flex-producto"  enctype="multipart/form-data">
            <div class="wapper-producto">
            <div class="flex-archivo">
                <div>
                    <img style="border: var(--color-cuarto) solid 1px"class="imagen_producto" id="vista_previa" src="<?= base_url()?>/assets/uploads/<?= $producto['imagen'] ?>" alt="imagen del producto">
                <?php if($validation->getError('imagen')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('imagen'); ?>
                </div>
            <?php }?>
                </div>
                <input name="imagen" type="file" id="fileInput" hidden accept=".jpg,.jpeg,.png,.gif,.webp">
                <label for="fileInput" type="button"  class="button-admin input-login input-submit-login custom-file-label">Subir archivo</label>
            </div>
            <div style="display: flex; flex-direction: column;  min-width: 550px; gap: 30px" >
            <div class="card  form-producto">
            <h1 style="font-size: 1.9em">Editar Producto</h1>
            <div>
                <label class="label-login">Nombre
                    <input value="<?= $producto['nombre_producto']; ?>" name="nombre_producto" autocomplete="off" class="input-login" type="text" placeholder="Ingresa el nombre del producto">
            </label>
            <?php if($validation->getError('nombre_producto')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('nombre_producto'); ?>
                </div>
            <?php }?>
            </div>
            <div>
                <label class="label-login">Precio
                    <input value="<?= $producto['precio']; ?>" name="precio" class="input-login" type="number" name="clave" placeholder="Ingresa el precio del producto">
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
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id_categoria'] ?>" <?= ($categoria['id_categoria']  == $producto['categoria_id']) ? 'selected' : '' ?>>
                        <?= $categoria['descripcion'] ?>
                        </option>          
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
                    <input value="<?= $producto['stock']; ?>" name="stock" class="input-login input-stock input-cantidad" type="number" name="clave" placeholder="Ingresa el stock del producto">
            </label>
            <?php if($validation->getError('stock')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('stock'); ?>
                </div>
            <?php }?>
            </div>
            <div>
                <label class="label-login">Descripción
                    <textarea value="<?= $producto['descripcion']; ?>"  name="descripcion" class="input-login" id="" placeholder="Ingresa la el descripción del producto"></textarea>
            </label>
            <?php if($validation->getError('descripcion')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('descripcion'); ?>
                </div>
            <?php }?>
            </div>
            <input autocomplete="off" class="button-admin input-login input-submit-login" type="submit" value="Editar Producto">
            </div>

            <div id="grid-colores-talles" class="grid-colores-talles">

        <?php foreach ($productosDetalle as $productoDetalle): ?>
    <div class="card card-talles-colores">
        <input type="hidden" name="id_detalle_producto[]"  value="<?=$productoDetalle['id_producto'] ?>">
        <div class="flex-color-talle">
            <label class="label-login">Colores                
                <select name="color_viejo[]" class="input-login">
                    <?php if(empty($productoDetalle['color_id'])){?>
                            <option value="" disabled selected style="color: #38332f;">Selecciona un color</option>
                    <?php }?>
                    <?php foreach ($colores as $color): ?>
                        <option value="<?= $color['id_colores'] ?>" <?= ($color['id_colores']  == $productoDetalle['color_id']) ? 'selected' : '' ?>>
            <?= $color['nombre'] ?>
                    <?php endforeach; ?>  
                </select>
            </label>
            <label class="label-login">Talles                
                <select name="talle_viejo[]" class="input-login">
                    <?php if(empty($productoDetalle['talle_id'])){?>
                            <option value="" disabled selected style="color: #38332f;">Selecciona un talle</option>
                    <?php }?>
                    <?php foreach ($talles as $talle): ?>
                        <option value="<?= $talle['id_talle']; ?>" <?= ($talle['id_talle']  == $productoDetalle['talle_id']) ? 'selected' : '' ?>><?= $talle['talle']; ?></option>
                    <?php endforeach; ?>  
                </select>
            </label>
        </div>
        <label class="label-login">Stock
            <input value="<?= $productoDetalle['stock']; ?>" name="cantidad_viejo[]" class="input-login inputs-stock input-cantidad" type="number" placeholder="Ingresa el stock del producto">
        </label>

        <a  href="<?= base_url('productoDetalle_delete_').$productoDetalle['id_producto']; ?>" type="button" class="btn-eliminar material-symbols-outlined">close</a>
    </div>
        <?php endforeach; ?>

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