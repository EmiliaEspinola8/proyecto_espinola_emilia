    </div>
<section>
    <div style="flex: 1" class="wapper-login">
        <div class="container-form container-login">
        <form method="post" action="<?php echo base_url('/enviarlogin') ?>">
            <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-login text-center">
                            <?= session()->getFlashdata('msg')?>
                    </div>
            <?php endif;?>
            <h1>Bienvenido de nuevo</h1>
            <div class="wapper-link-register">
                <p>¿Eres nuevo aquí?</p>
                <a href="<?php echo base_url('/registro'); ?>">Crea  una cuenta</a>
            </div>
            <label class="label-login">Email
                    <input name="email"  autocomplete="off" class="input-login" type="email" placeholder="Ej. Emilia Espinola" required>
            </label>
            <label class="label-login">Contraseña
                    <input  name="pass" class="input-login" type="password" name="clave" autocomplete="new-password" placeholder="Ej. usuario1234" required>
            </label>
            <input  autocomplete="off" class="input-login input-submit-login" type="submit" value="Iniciar sesión">
        </form>
        <div class="container-img">
            <img src="assets/img/img-secundaria.jpg" alt="">
        </div>
    </div>
    </div>
</section>