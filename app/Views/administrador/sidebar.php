<?php $session = session(); ?>
<div style="display: flex;">
    <div class="sidebar-admin">

    <h1 style="color: #878e9e">Futura</h1> 
        
    <div>
        <ul>
            <li class="li-sidebar">
                <span class="material-symbols-outlined">dashboard</span>
                <a class="visible a-sidebar" href="#">DashBoard</a>
            </li>
            <li data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="li-sidebar">
                <span class="material-symbols-outlined">apparel</span>
                <a class="visible a-sidebar">Productos</a>
            </li>
            
            <ul class="collapse ul-productos" id="collapseExample"  class="collapse">
                <li><a href="<?= base_url('crudproductos')?>">Todos los productos</a></li>
                <li><a href="<?= base_url('crudcategorias')?>">Categorías</a></li>
                <li><a href="<?= base_url('crudtalles')?>">Talles</a></li>
                <li><a href="<?= base_url('crudcolores')?>">Colores</a></li>          
            </ul>
            <li class="li-sidebar">
                <span class="material-symbols-outlined">finance</span>
                <a class="visible a-sidebar" href="<?= base_url('/ventas')?>">Ventas</a>
            </li>
            <li class="li-sidebar">
                <span class="material-symbols-outlined">deployed_code_account</span>
                <a class="visible a-sidebar" href="<?= base_url('crudusuarios')?>">Usuarios</a>
            </li>
            <li class="li-sidebar">
                <span class="material-symbols-outlined">mark_email_unread</span>
                <a class="visible a-sidebar" href="crudcontacto">Consultas</a>
            </li>
        </ul>
    </div>
    
    <div style="background: transparent;" class="flex-perfil">
        <img src="assets/img/foto_cv.jpg" alt="">
        <div class="visible">
            <p class="nombre-usuario"><?= $session->get('nombre')?></p>
            <p style="font-size: 0.8em; color: #878e9e">Administrador</p>
        </div>
        <a href="<?= base_url('/logout')?>" class="material-symbols-outlined button-cerrar-sesion" title="Cerrar sesión">output</a>
    </div>

</div>

<div class="seccion-lateral" id="tabla-productos">