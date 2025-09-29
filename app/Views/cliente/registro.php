    </div>
<section>
    <div class="wapper-login">
        <div class="container-form container-login">
            <div class="container-img">
            <img src="assets/img/img-secundaria.jpg" alt="">
        </div>
        <?php $validation = \Config\Services::validation(); ?>
        <form  class="relleno" method="post" action="<?php echo base_url('/enviar-form') ?>">
            <h1>Crea tu cuenta</h1>
            <div class="wapper-link-register">
                <p>¿Ya has estado por aquí?</p>
                <a href="<?= base_url('/login')?>">Inicia sesión</a>
            </div>
            <div class="flex-nombre-apellido">
            <div>
                <label class="label-login">Nombre
                    <input name="nombre" autocomplete="off" class="input-login" type="text" placeholder="Ej. Emilia">
            </label>
            <!-- Error -->
            <?php if($validation->getError('nombre')) {?>
                <div class="validacion-form">
                    <?= $error = $validation->getError('nombre'); ?>
                </div>
            <?php }?>
            </div>
            <div>
                <label class="label-login">Apellido
                    <input name="apellido" autocomplete="off" class="input-login input-nombre-apellido" type="text" placeholder="Ej. Espinola">
            </label>
                                <!-- Error -->
                    <?php if($validation->getError('apellido')) {?>
                    <div class="validacion-form">
                    <?= $error = $validation->getError('apellido'); ?>
                    </div>
                    <?php }?>
            </div>
            </div>
            <div>
                <label class="label-login">Email
                    <input name="email" autocomplete="off" class="input-login" type="email" placeholder="Ej. usuario8@gmail.com">
            </label>
            <!-- Error -->
                    <?php if($validation->getError('email')) {?>
                    <div class="validacion-form">
                    <?= $error = $validation->getError('email'); ?>
                    </div>
                    <?php }?>
            </div>
            <div>
            <label class="label-login">Contraseña
                    <input name="pass" class="input-login" type="password" name="clave" autocomplete="new-password" placeholder="Ej. usuario1234">
            </label>
            <!-- Error -->
                    <?php if($validation->getError('pass')) {?>
                    <div class="validacion-form">
                    <?= $error = $validation->getError('pass'); ?>
                    </div>
                    <?php }?>
            </div>
            <input autocomplete="off" class="input-login input-submit-login" type="submit" value="Regístrate">
        </form>
    </div>
    </div>
</section>