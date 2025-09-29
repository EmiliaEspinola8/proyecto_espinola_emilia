</div>
<script>    
    
$(document).on('click', '.btn-edit', function () {
    const descripcion = document.getElementById('input-categoria-edit');
    const descripcionAnt = document.getElementById('input-categoria-edit-ant');
    const element = document.getElementById("editModal");

    if (element) {
        const modal = new bootstrap.Modal(element);
        modal.show();
    }

    descripcion.value = this.value;
    descripcionAnt.value = this.value;
});

$(document).on('click', '.btn-edit-color', function () {
    const nombreColor = document.getElementById('input-nom-color-edit');
    const nombreColorAnt = document.getElementById('input-nom-color-ant');
    const codigoColor = document.getElementById('input-hex-color-edit');
    const element = document.getElementById("editModalColor");

    if (element) {
        const modal = new bootstrap.Modal(element);
        modal.show();
    }

    nombreColor.value = this.value;
    nombreColorAnt.value = this.value;
    codigoColor.value = this.id;

});

    function buscar() {
    const inputBuscar = document.getElementById('input-filtro-buscar');
    const estado = document.getElementById('select-estado');

    var parametros = {
        "nombre" : inputBuscar.value,
        "estado" : estado.value
    };

    $.ajax({
        data: parametros,
        url:  'productos_buscar',
        type: 'POST',

        beforeSend: function() {
            $('#tabla-productos').html("Mensaje antes de Enviar");
        },

        success: function(mensaje_mostrar) {
            console.log(estado.value);
            console.log("Respuesta del servidor:", mensaje_mostrar);
            $('#tabla-productos').html(mensaje_mostrar);
        },

        error: function(xhr, status, error) {
        $('#tabla-productos').html("Error del servidor: " + xhr.responseText);
        console.error("Error AJAX: ", xhr.responseText);
        }
    });
}

$(document).on('click', '#btn-buscar', function () {
    const fechaDesde = document.getElementById('fecha-desde');
    const fechaHasta = document.getElementById('fecha-hasta');
    const buscar = document.getElementById('buscar');

    if(fechaDesde.value <= fechaHasta.value){

    var parametros = {
        "fecha-desde" : fechaDesde.value,
        "fecha-hasta" : fechaHasta.value,
        "buscar" : buscar.value
    };

        $.ajax({
            data: parametros,
            url: 'filtrar_ventas',
            type: 'POST',

            beforeSend: function() {
                $('#tabla-productos').html("Mensaje antes de Enviar");
            },

            success: function(mensaje_mostrar) {
                console.log("Respuesta del servidor:", mensaje_mostrar);
                $('#tabla-productos').html(mensaje_mostrar);
            },

            error: function(xhr, status, error) {
                $('#tabla-productos').html("Error del servidor: " + xhr.responseText);
                console.error("Error AJAX: ", xhr.responseText);
            }
        });

    }else{
            alert("La fecha desde es más grande que la fecha hasta.");
    }
});

$(document).on('click', '#btn-editar-talle', function (){
    const talle = document.getElementById('input-categoria-edit');
    const talleAnt = document.getElementById('input-categoria-edit-ant');
    const Element = document.getElementById("editModal");

    $.ajax({
        data: { talle : talle.value, talleAnt : talleAnt.value},
        url: 'editar_talle',
        type: 'POST',
        dataType: 'json', 

        success: function(respuesta) {
            console.log("Respuesta del servidor:", respuesta);

            if (respuesta.status === 'success') {
                $('#tabla-productos').html(respuesta.html);
            } else if (respuesta.status === 'error') {
                // Mostramos los errores de validación
                let errores = Object.values(respuesta.errors);
                $('.validacion-form-edit').html(errores);
                if(Element){
                const modal = new bootstrap.Modal(Element);   
                modal.show();
                }
            }
        },

        error: function(xhr, status, error) {
            console.error("Error AJAX: ", xhr.responseText);
            $('#tabla-productos').html(xhr.responseText);
            if(Element){
                const modal = new bootstrap.Modal(Element);   
                modal.show();
                }
        }
    });
});

$(document).on('click', '#btn-editar-color', function (){
    const nombreColor = document.getElementById('input-nom-color-edit');
    const nombreColorAnt = document.getElementById('input-nom-color-ant');
    const codigoHex = document.getElementById('input-hex-color-edit');
    const Element = document.getElementById("editModalColor");

    $.ajax({
        data: { color : nombreColor.value, 
                color_ant : nombreColorAnt.value,
                color_hex : codigoHex.value
            },
        url: 'editar_color',
        type: 'POST',
        dataType: 'json', 

        success: function(respuesta) {
            console.log("Respuesta del servidor:", respuesta);
            if (respuesta.status === 'success') {
                $('#tabla-productos').html(respuesta.html);
            } else if (respuesta.status === 'error') {
                // Mostramos los errores de validación
                let errorColor = Object.values(respuesta.errors.color || '');
                let errorCod = Object.values(respuesta.errors.color_hex || '');
                $('.validacion-nombre-edit').html(errorColor);
                $('.validacion-codigo-edit').html(errorCod);
                if(Element){
                const modal = new bootstrap.Modal(Element);   
                modal.show();
                }
            }
        },

        error: function(xhr, status, error) {
            console.error("Error AJAX: ", xhr.responseText);
            $('#tabla-productos').html(xhr.responseText);
            if(Element){
                const modal = new bootstrap.Modal(Element);   
                modal.show();
                }
        }
    });
});

function agregarTalle() {
    const talle = document.getElementById('input-talle');
    const modal = new bootstrap.Modal(document.getElementById("exampleModal"));

    $.ajax({
        data: { talle: talle.value },
        url: 'agregar_talle',
        type: 'POST',
        dataType: 'json', 

        success: function(respuesta) {
            console.log("Respuesta del servidor:", respuesta);

            if (respuesta.status === 'success') {
                $('#tabla-productos').html(respuesta.html);
            } else if (respuesta.status === 'error') {
                // Mostramos los errores de validación
                let errores = Object.values(respuesta.errors);
                $('.validacion-form').html(errores);
                modal.show();
            }
        },

        error: function(xhr, status, error) {
            console.error("Error AJAX: ", xhr.responseText);
            $('#tabla-productos').html(xhr.responseText);
            modal.show();
        }
    });
}
function agregarColor() {
    const color = document.getElementById('input-nom-color');
    const colorHex = document.getElementById('input-hex-color');
    const modal = new bootstrap.Modal(document.getElementById("exampleModal"));

    var parametros = {
        "color" : color.value,
        "color_hex" : colorHex.value
    }

    $.ajax({
        data: parametros,
        url: 'agregar_color',
        type: 'POST',
        dataType: 'json', 

        success: function(respuesta) {
            console.log("Respuesta del servidor:", respuesta);

            if (respuesta.status === 'success') {
                $('#tabla-productos').html(respuesta.html);
            } else if (respuesta.status === 'error') {
                // Mostramos los errores de validación
                let errorColor = Object.values(respuesta.errors.color || '');
                let errorCod = Object.values(respuesta.errors.color_hex || '');
                $('.validacion-nombre').html(errorColor);
                $('.validacion-codigo').html(errorCod);
                modal.show();
            }
        },

        error: function(xhr, status, error) {
            console.error("Error AJAX: ", xhr.responseText);
            $('#tabla-productos').html(xhr.responseText);
            modal.show();
        }
    });
}

$(document).on('click', '#btn-agregar-categoria', function (){
    const descripcion = document.getElementById('input-categoria');
    const Element = document.getElementById("exampleModal");

    $.ajax({
        data: { descripcion : descripcion.value },
        url: 'creaCategoria',
        type: 'POST',
        dataType: 'json', 

        success: function(respuesta) {
            console.log("Respuesta del servidor:", respuesta);

            if (respuesta.status === 'success') {
                $('#tabla-productos').html(respuesta.html);
            } else if (respuesta.status === 'error') {
                // Mostramos los errores de validación
                let errores = Object.values(respuesta.errors);
                $('.validacion-form').html(errores);
                if(Element){
                const modal = new bootstrap.Modal(Element);  
                modal.show();
                }
            }
        },

        error: function(xhr, status, error) {
            console.error("Error AJAX: ", xhr.responseText);
            $('#tabla-productos').html(xhr.responseText);
            if(Element){
                const modal = new bootstrap.Modal(Element);   
                modal.show();
                }
        }
    });
});

$(document).on('click', '#btn-editar-categoria', function (){
    const descripcion = document.getElementById('input-categoria-edit');
    const descripcionAnt = document.getElementById('input-categoria-edit-ant');
    const Element = document.getElementById("editModal");
    

    $.ajax({
        data: { descripcion : descripcion.value, descripcionAnt : descripcionAnt.value},
        url: 'categoria_edit',
        type: 'POST',
        dataType: 'json', 

        success: function(respuesta) {
            if (respuesta.status === 'success') {
                $('#tabla-productos').html(respuesta.html);
            } else if (respuesta.status === 'error') {
                // Mostramos los errores de validación
                let errores = Object.values(respuesta.errors);
                $('.validacion-form').html(errores);
                if(Element){
                const modal = new bootstrap.Modal(Element);   
                modal.show();
                }
            }
        },

        error: function(xhr, status, error) {
            $('#tabla-productos').html(xhr.responseText);
            if(Element){
                const modal = new bootstrap.Modal(Element);   
                modal.show();
                }
        }
    });
});

function buscarContactos(){

    const buscar = document.getElementById('input-buscar');

        $.ajax({
            data: { buscar: buscar.value },
            url: 'buscar_contacto',
            type: 'POST',

            beforeSend: function() {
                $('#tabla-productos').html("Mensaje antes de Enviar");
            },

            success: function(mensaje_mostrar) {
                console.log("Respuesta del servidor:", mensaje_mostrar);
                $('#tabla-productos').html(mensaje_mostrar);
            },

            error: function(xhr, status, error) {
                $('#tabla-productos').html("Error del servidor: " + xhr.responseText);
                console.error("Error AJAX: ", xhr.responseText);
            }
        });
}

    function filtrarTalles() {
    const inputBuscar = document.getElementById('input-filtro-buscar');
    const estado = document.getElementById('select-estado');

    var parametros = {
        "buscar" : inputBuscar.value,
        "estado" : estado.value
    };

    $.ajax({
        data: parametros,
        url:  'buscar_talles',
        type: 'POST',

        beforeSend: function() {
            $('#tabla-productos').html("Mensaje antes de Enviar");
        },

        success: function(mensaje_mostrar) {
            console.log(estado.value);
            console.log(inputBuscar.value);
            console.log("Respuesta del servidor:", mensaje_mostrar);
            $('#tabla-productos').html(mensaje_mostrar);
        },

        error: function(xhr, status, error) {
        console.error("Error AJAX: ", xhr.responseText);
        }
    });
}

function filtrarColores() {
    const inputBuscar = document.getElementById('input-filtro-buscar');
    const estado = document.getElementById('select-estado');

    var parametros = {
        "buscar" : inputBuscar.value,
        "estado" : estado.value
    };

    $.ajax({
        data: parametros,
        url:  'buscar_colores',
        type: 'POST',

        beforeSend: function() {
            $('#tabla-productos').html("Mensaje antes de Enviar");
        },

        success: function(mensaje_mostrar) {
            console.log(estado.value);
            console.log(inputBuscar.value);
            console.log("Respuesta del servidor:", mensaje_mostrar);
            $('#tabla-productos').html(mensaje_mostrar);
        },

        error: function(xhr, status, error) {
        console.error("Error AJAX: ", xhr.responseText);
        }
    });
}

    function fitrarCategorias() {
    const inputBuscar = document.getElementById('input-filtro-buscar');
    const estado = document.getElementById('select-estado');

    var parametros = {
        "buscar" : inputBuscar.value,
        "estado" : estado.value
    };

    $.ajax({
        data: parametros,
        url:  'buscar_categorias',
        type: 'POST',

        beforeSend: function() {
            $('#tabla-productos').html("Mensaje antes de Enviar");
        },

        success: function(mensaje_mostrar) {
            console.log(estado.value);
            console.log(inputBuscar.value);
            console.log("Respuesta del servidor:", mensaje_mostrar);
            $('#tabla-productos').html(mensaje_mostrar);
        },

        error: function(xhr, status, error) {
        console.error("Error AJAX: ", xhr.responseText);
        }
    });
}

$(document).on('click', '#btn-buscar-usuarios, #btn-estado , #btn-perfil', function () {
    const estado = document.getElementById('select-estado');
    const perfil = document.getElementById('select-perfil');
    const buscar = document.getElementById('input-buscar');

    var parametros = {
        "estado" : estado.value,
        "perfil" : perfil.value,
        "buscar" : buscar.value
    };

        $.ajax({
            data: parametros,
            url: 'filtrar-usuarios',
            type: 'POST',

            beforeSend: function() {
                $('#tabla-productos').html("Mensaje antes de Enviar");
            },

            success: function(mensaje_mostrar) {
                console.log("Respuesta del servidor:", mensaje_mostrar);
                $('#tabla-productos').html(mensaje_mostrar);
            },

            error: function(xhr, status, error) {
                $('#tabla-productos').html("Error del servidor: " + xhr.responseText);
                console.error("Error AJAX: ", xhr.responseText);
            }
        });
});
</script>

<script src="assets/js/script.js"></script>
</body>
</html>