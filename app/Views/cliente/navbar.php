    <?php $session = session();?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary flex-nav">
    <div>
      <img class="img-logo" src="assets/img/ensigna.png" alt="">
    </div>
    <div class="offcanvas offcanvas-start offcanvas-nav" id="staticBackdrop">
      <button type="button" class="btn-close btn-close-navbar" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= base_url('/')?>">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?= base_url('/quienes-somos')?>">¿Quiénes Somos?</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?= base_url('/contacto')?>">Contactanos</a>
        </li>
      </ul>
    </div>
    <div class="nav-icon">
      <?php if(!session()->get('logged_in')) {?>  
        <div class="dropdown" style="align-self: center; !important">
          <button 
          class="btn material-symbols-outlined dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            account_circle
          </button>
          <ul class="dropdown-menu menu">
            <li><a class="dropdown-item" href="<?= base_url('/login')?>">Iniciar sesión</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= base_url('/registro')?>">Registrarse</a></li>
          </ul>
        </div>
      <?php } else {?>
        <div class="dropdown" style="align-self: center;">
          <button 
          class="btn material-symbols-outlined dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            account_circle
          </button>
          <ul class="dropdown-menu menu">
            <li>
              <a class="dropdown-item" href="<?= base_url('/logout')?>">Cerrar sesión</a>
            </li>
          </ul>
        </div>   
      <?php }?>

    <button class="btn material-symbols-outlined" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">shopping_bag</button>
    <button class="navbar-toggler material-symbols-outlined" type="button"data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop" aria-expanded="false" aria-label="Toggle navigation">
    menu
    </button>
    </div>
</nav>

<!-- <section>
  <div id="carouselExampleFade" class="carousel slide carousel-fade">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="img_carrusel" src="assets/img/img1.jpg" class="d-block w-100" alt="hjilhiuh">
      </div>
      <div class="carousel-item">
        <img class="img_carrusel"  src="<?php echo base_url('assets/img/img2.jpg');?>" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img class="img_carrusel"  src="<?php echo base_url('assets/img/img3.jpg');?>" class="d-block w-100" alt="...">
    </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
    <div class="texto-superpuesto">
      <h2>Descubrí tu estilo</h2>
      <p>En nuestra tienda vas a encontrar ropa femenina pensada para cada momento de tu día. Explora todos nuestros productos.</p>
      <button>Aquí</button>
    </div>
</div>
</section> -->

<div class="seccion-carrito offcanvas offcanvas-end  carrito" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">