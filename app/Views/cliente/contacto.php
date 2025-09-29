    </div>
<section>
        <div class="encabezado-contacto">
        <h1 class="h1-contacto">Contactanos</h1>
        <p>Si tienes una duda o un reclamo por favor deja tu mensaje para poder contactarnos con usted</p>
        </div>
        <div class="flex-contacto">
        <div class="wapper-form-contacto">
        <div class="container-form container-contacto">
            <form class="" method="post" action="<?php echo base_url('/enviar-contacto') ?>">
            <div><h2 class="h2-contacto">Dejanos tu mensaje</h2>
            <hr class="my-4 border-dark separador separador-contacto"></div>
            <label class="label-login">Nombre
                    <input name="nombre_apellido" class="input-login" type="text" placeholder="Ej. Emilia Espinola" required>
            </label>
            <label class="label-login">Email
            <input name="email" autocomplete="off" class="input-login" type="email" placeholder="Ej. usuario8@gmail.com" required>
            </label>
            <label class="label-login">Teléfono(opcional)
                    <div class="wapper-input wapper-input-telefono">
                        <span>+54</span>
                        <input name="telefono" class="input input-telefono" type="text" placeholder="Ej. 3794667033" required>
                    </div>
            </label>
            <label class="label-login" for="mi-lista">Motivo
                    <input name="motivo" class="input-login" list="opciones" id="mi-lista" name="mi-lista" placeholder="Escribe tu motivo">

                    <datalist id="opciones">
                    <option value="Reclamo">Por un reclamo</option>
                    <option value="Devolución">Para una devolución</option>
                    <option value="Más info">Para optener mas información</option>
                    </datalist>
            </label>        
            <label class="label-login">Mensaje
                    <textarea name="mensaje" class="input-login"  name="" id="" placeholder="Deja tu mensaje aquí"></textarea>
            </label>
            <input autocomplete="off" class="input-login input-submit-login" type="submit" value="Enviar">
        </form>
        </div>
        </div>

        <div class="container-info-contacto">
        <div class="wapper-info-contacto card-contacto">
        <h2 class="h2-contacto">Información de contacto</h2>
        <hr class="my-4 border-dark separador-contacto">
    <div class="grid-info-contacto">
        <div class="">
            <div class="flex-sub-contacto">
            <span class="material-symbols-outlined">mail</span>
            <p class="p-contacto">Email</p>
            </div>
            <p class="info-contacto">espinolaemilia@gmail.com</p>
        </div>
        <div class="wapper-info">
            <div class="flex-sub-contacto">
            <span class="material-symbols-outlined">call</span>
            <p class="p-contacto">Teléfono</p>
            </div>
            <p class="info-contacto">3794 779935</p>
        </div>
        <div class="">
            <div class="flex-sub-contacto">
            <span class="material-symbols-outlined">location_on</span>
            <p class="p-contacto">Dirección</p>
            </div>
            <p class="info-contacto">Corrientes Capital, San Cayetano 4356</p>
        </div>
        <div class="wapper-info">
            <div class="flex-sub-contacto">
            <span class="material-symbols-outlined bi bi-instagram"></span>
            <p class="p-contacto">Instagram</p>
            </div>
            <p class="info-contacto" href="">emilia espinola</p>
        </div>   
    </div>
        </div>
    
    <div class="card-contacto">
        <h2 class="h2-contacto">Horarios de atención</h2>
        <hr class="my-4 border-dark separador separador-contacto">
        <div class="grid-info-contacto grid-horarios-contacto">
        <div class="wapper-info-horarios">
            <p class="p-contacto">Lunes - Viernes</p>
            <p class="info-contacto">08hs a 12hs</p>
            <p class="info-contacto">17hs a 21hs</p>
        </div>
        <div class="wapper-info-horarios">
            <p class="p-contacto">Sábados</p>
            <p class="info-contacto">08hs a 13hs</p>
        </div>
        <div class="wapper-info-horarios">
            <p class="p-contacto">Domingos</p>
            <p class="info-contacto">Cerrado</p>
        </div>
        </div>
    </div>
        </div>
        </div>
</section>