</div>
<footer>
  <div class="grid-footer">
        <div class="flex-footer-navegacion">
      <p>Navegación</p>
      <a href="<?= base_url('/')?>">Inicio</a>
      <a href="">¿Quiénes somos?</a>
      <a href="<?= base_url('/contacto')?>">Contactanos</a>
    </div>
    <div>
      <p>Medios de pago</p>
      <img src="assets/img/deposito.png" alt="">
      <img src="assets/img/acordar.png" alt="">
    </div>
    <div class="">
      <p>Medios de envío</p>
      <img src="assets/img/correo-argentino.png" alt="">
      <img src="assets/img/envio.png" alt="">
      <img src="assets/img/retiro-local.png" alt="">
      <img src="assets/img/acordar.png" alt="">
    </div>
  </div>
  <div class="pie-footer">
    creado por la empresa futura - 2025
  </div>
</footer>
    <script>
      function agregarAlCarrito() {
        const idProducto = document.getElementById('id-producto');
        const inputCantidad = document.getElementById('input-cantidad');
        const idColorElem = document.querySelector('.color-activo');
        const idTalleElem = document.querySelector('.talle-activo');
        
        const idColor = idColorElem ? idColorElem.id : null;
        const idTalle = idTalleElem ? idTalleElem.id : null;


        const modal = new bootstrap.Offcanvas(document.getElementById("offcanvasRight"));

        var parametros = {
        "id_producto" : idProducto.value,
        "cantidad" : inputCantidad.value,
        "talle" : idTalle,
        "color" : idColor,
        };

    $.ajax({
        data: parametros,
        url:  'agregar_al_carrito',
        type: 'POST',

        success: function(mensaje_mostrar) {
            console.log("Respuesta del servidor:", mensaje_mostrar);
            modal.show();
            $('.carrito').html(mensaje_mostrar);
        },

        error: function(xhr, status, error) {
        console.error("Error AJAX: ", xhr.responseText);
        $('#error-stock').html(xhr.responseText);
        $('#error-stock').removeClass("fade-out"); 
        $('#error-stock').addClass("fade-in");

        setTimeout(() => {
                    $('#error-stock').html("");
                    $('#error-stock').removeClass("fade-in");
                    $('#error-stock').addClass("fade-out");
                }, 2000);
        }
    });
}

$(document).on('click', '#id-producto-detalle', function (){
      
        var parametros = {
        "id_producto" : $(this).val(),
        };

    $.ajax({
        data: parametros,
        url:  'eliminar_del_carrito',
        type: 'POST',

        success: function(mensaje_mostrar) {
            console.log("Respuesta del servidor:", mensaje_mostrar);
            $('.carrito').html(mensaje_mostrar);
        },

        error: function(xhr, status, error) {
        console.error("Error AJAX: ", xhr.responseText);
        }
    });
});

$(document).on('click', '.button-cantidad-carrito', function () {

    let contenedor = $(this).parent();
    let inputCantidad = contenedor.find('.input-cantidad-carrito').val();
    let idProducto = $(this).val();


      var parametros = {
        "id_producto" : idProducto,
        "cantidad" : inputCantidad,
        "operacion": $(this).attr("id"),
        };

        $.ajax({
            data: parametros,
            url: 'incrementar_cant_producto',
            type: 'POST',

            success: function(mensaje_mostrar) {
                console.log("Respuesta del servidor:", mensaje_mostrar);
                $('.carrito').html(mensaje_mostrar);
            },

            error: function(xhr, status, error) {
                console.error("Error AJAX: ", xhr.responseText);
                $('#error-stock-carrito').html(xhr.responseText);
                $('#error-stock-carrito').removeClass("fade-out");
                $('#error-stock-carrito').addClass("fade-in");

                setTimeout(() => {
                    $('#error-stock-carrito').html("");
                    $('#error-stock-carrito').removeClass("fade-in");
                    $('#error-stock-carrito').addClass("fade-out");
                }, 2000);
            }
        });
    });

$(document).on('input', '.input-cantidad-carrito', function () {

    let contenedor = $(this).parent();
    let idProducto = contenedor.find('#descrementar').val();

      var parametros = {
        "id_producto" : idProducto,
        "cantidad" : $(this).val(),
        };

        $.ajax({
            data: parametros,
            url: 'validar_stock',
            type: 'POST',

            success: function(mensaje_mostrar) {
                console.log("Respuesta del servidor:", mensaje_mostrar);
                $('.carrito').html(mensaje_mostrar);
            },

            error: function(xhr, status, error) {
                console.error("Error AJAX: ", xhr.responseText);
                $('#error-stock-carrito').html(xhr.responseText);
                $('#error-stock-carrito').removeClass("fade-out");
                $('#error-stock-carrito').addClass("fade-in");

                setTimeout(() => {
                    $('#error-stock-carrito').html("");
                    $('#error-stock-carrito').removeClass("fade-in");
                    $('#error-stock-carrito').addClass("fade-out");
                }, 2000);
            }
        });
    });

    function comprar(){
    $.ajax({
        data: '',
        url:  'comprar',
        type: 'POST',

        success: function(mensaje_mostrar) {
            console.log("Respuesta del servidor:", mensaje_mostrar);
            $('.carrito').html(mensaje_mostrar);
        },

        error: function(xhr, status, error) {
        console.error("Error AJAX: ", xhr.responseText);
        $('.carrito').html(error);
        }
    });
}


// CLICK EN COLOR → filtra talles
$(document).on('click', '.btn-colores', function () {
  const idProducto = document.getElementById('id-producto');
  const tallesBtns = document.querySelectorAll('.button-secundario');
  const talleSeleccionado = document.querySelector('.talle-seleccionado');

  $.ajax({
    url: 'consultar_talles',
    type: 'POST',
    dataType: 'json',
    data: {
      id_producto: idProducto.value,
      id_color: this.id
    },
    success: function (talles) {
      const idsDisponibles = talles.map(t => String(t.talle_id));

      let primeroDisponible = null;
      tallesBtns.forEach(btn => {
        const disponible = idsDisponibles.includes(btn.id);
        btn.disabled = !disponible;
        btn.classList.toggle('desactivado', !disponible);
        btn.classList.toggle('talle-activo', false); // limpiamos selección visual
        if (disponible && !primeroDisponible) primeroDisponible = btn;
      });

      // si no hay talle activo válido, auto-seleccionamos uno
      const activo = document.querySelector('.talle-activo');
      if (!activo || activo.disabled) {
        if (primeroDisponible) {
          primeroDisponible.classList.add('talle-activo');
          talleSeleccionado.innerHTML = primeroDisponible.value;
          talleSeleccionado.value = primeroDisponible.id;
        } else {
          // no hay talles para ese color
          talleSeleccionado.innerHTML = '';
          talleSeleccionado.value = '';
        }
      }
    },
    error: function (xhr) {
      console.error('Error AJAX (talles):', xhr.responseText);
    }
  });
});


// CLICK EN TALLE → filtra colores
$(document).on('click', '.button-secundario', function () {
  const idProducto = document.getElementById('id-producto');
  const colorBtns = document.querySelectorAll('.btn-colores');
  const colorSeleccionado = document.querySelector('.color-seleccionado');

  $.ajax({
    url: 'consultar_colores',
    type: 'POST',
    dataType: 'json',
    data: {
      id_producto: idProducto.value,
      id_talle: this.id
    },
    success: function (colores) {
      const idsDisponibles = colores.map(c => String(c.color_id));

      let primeroDisponible = null;
      colorBtns.forEach(btn => {
        const wapper = btn.closest('.wapper-color');
        const disponible = idsDisponibles.includes(btn.id);

        btn.disabled = !disponible;
        btn.classList.toggle('desactivado', !disponible);
        if (wapper) wapper.classList.remove('color-activo'); // limpiamos selección visual

        if (disponible && !primeroDisponible) primeroDisponible = btn;
      });

      // si no hay color activo válido, auto-seleccionamos uno
      let activo = document.querySelector('.color-activo .btn-colores');
      if (!activo || activo.disabled) {
        if (primeroDisponible) {
          const wrap = primeroDisponible.closest('.wapper-color');
          if (wrap) wrap.classList.add('color-activo');
          colorSeleccionado.innerHTML = primeroDisponible.value;
          colorSeleccionado.value = primeroDisponible.id;
        } else {
          // no hay colores para ese talle
          colorSeleccionado.innerHTML = '';
          colorSeleccionado.value = '';
        }
      }
    },
    error: function (xhr) {
      console.error('Error AJAX (colores):', xhr.responseText);
    }
  });
});

$(document).on('change', '.categorias, .talles , .colores, .ordenamiento', function () {
  const categoriaSeleccionada = document.querySelector('input[name="categorias"]:checked');
  const categoria = categoriaSeleccionada ? categoriaSeleccionada.value : null;
  const ordenamiento = document.querySelector('.ordenamiento');
  let colores = obtenerColores();
  let talles = obtenerTalles();
  
    consulta(categoria, colores, talles, ordenamiento.value);
});

$(document).on('click', '#btn-buscar', function () {
  const categoriaSeleccionada = document.querySelector('input[name="categorias"]:checked');
  const categoria = categoriaSeleccionada ? categoriaSeleccionada.value : null;
  const ordenamiento = document.querySelector('.ordenamiento');
  const buscar = document.querySelector('#input-buscar');
  let colores = obtenerColores();
  let talles = obtenerTalles();

    consulta(categoria, colores, talles, ordenamiento.value, buscar.value);
});

$(document).on('click', '#btn-buscar1', function () {
  const categoriaSeleccionada = document.querySelector('input[name="categorias"]:checked');
  const categoria = categoriaSeleccionada ? categoriaSeleccionada.value : null;
  const ordenamiento = document.querySelector('.ordenamiento1');
  const buscar = document.querySelector('#input-buscar1');
  let colores = obtenerColores();
  let talles = obtenerTalles();

    consulta(categoria, colores, talles, ordenamiento.value, buscar.value);
});

$(document).on('change', '.ordenamiento1', function () {
  const categoriaSeleccionada = document.querySelector('input[name="categorias"]:checked');
  const categoria = categoriaSeleccionada ? categoriaSeleccionada.value : null;
  const ordenamiento = document.querySelector('.ordenamiento1');
  let colores = obtenerColores();
  let talles = obtenerTalles();

  consulta(categoria, colores, talles, ordenamiento.value);
});

function consulta(categoria, colores, talles, ordenamiento, buscar = null){
  var parametros = {
        "id_categoria" : categoria,
        "id_colores" : colores,
        "id_talles" : talles,
        "id_ordenamiento": ordenamiento,
        "buscar": buscar,
        };

    $.ajax({
        data: parametros,
        url: 'filtrar_productos',
        type: 'POST',

        success: function(mensaje_mostrar) {
            console.log("Respuesta del servidor:", mensaje_mostrar);
            $('.galeria-productos').html(mensaje_mostrar);
        },

        error: function(xhr, status, error) {
        console.error("Error AJAX: ", xhr.responseText);
        }
    });

}

function obtenerColores(){
  let seleccionados = [];
  // selecciona todos los checkbox con name="colores" que estén chequeados
  document.querySelectorAll('input[name="colores"]:checked').forEach((el) => {
    seleccionados.push(el.value);
  });
  return seleccionados;
}

function obtenerTalles(){
  let seleccionados = [];
  // selecciona todos los checkbox con name="colores" que estén chequeados
  document.querySelectorAll('input[name="talles"]:checked').forEach((el) => {
    seleccionados.push(el.value);
  });
  return seleccionados;
}
    </script>
    <script src="assets/js/script.js"></script>
</body>
</html>