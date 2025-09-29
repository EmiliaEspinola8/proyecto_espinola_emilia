const input = document.querySelectorAll('.input');
const btnDecremento = document.querySelectorAll('.button-decremento');
const btnIncremento = document.querySelectorAll('.button-incremento');
const btnColores = document.querySelectorAll('.btn-colores'); 
const colorSeleccionado = document.querySelector('.color-seleccionado');
const btnTalles = document.querySelectorAll('.button-secundario');
const talleSeleccionado = document.querySelector('.talle-seleccionado');
const inputCantidad = document.querySelectorAll('.input-cantidad');
const sidebar = document.querySelector('.sidebar-admin');
const linkSidebar = document.querySelectorAll('.visible');
const btnColorTalle = document.querySelector('.button-add-talle-color');
const gridColorTalle = document.getElementById('grid-colores-talles');
const inputStock = document.querySelector('.input-stock');
const inputImagen = document.getElementById('fileInput');
const vistaPrevia = document.getElementById('vista_previa'); 
const inputsStock = document.querySelectorAll('.inputs-stock');
const estadoProducto = document.querySelectorAll('.estado-producto');
const imagen = document.querySelector('.img-quienes-somos');
const pImagen = document.querySelector('.p-quienes-somos');

// funciones para que al hacer focus en el input tenga un ouline el div padre
if(input){ 
input.forEach(inputSeleccionado => {
    inputSeleccionado.addEventListener('focus', () => {
    // agarra a div padre del botóon seleccionado para añadir la clase
    const wrapper = inputSeleccionado.closest('.wapper-input');
    wrapper.classList.add('focused');
});
});    

input.forEach(inputSeleccionado => {
    inputSeleccionado.addEventListener('blur', () => {
    // agarra a div padre del botóon seleccionado para eliminar la clase
    const wrapper = inputSeleccionado.closest('.wapper-input');
    wrapper.classList.remove('focused');
});
});  
}

if( btnDecremento && btnIncremento && btnTalles && btnColores && inputCantidad){
    // funciones para los botones de incremento de decremento de la cantidad de un producto

btnColores.forEach(boton => {
    boton.addEventListener('click', () => {
    // Remueve la clase "color-activo" de todos los botones 
    btnColores.forEach(b => {
            const wapper = b.closest('.wapper-color');
            wapper.classList.remove('color-activo')
        });

    // Agrega la clase "color-activo" al botón que fue clickeado
    const wapper = boton.closest('.wapper-color');
    wapper.classList.add('color-activo');
    colorSeleccionado.innerHTML = boton.value;
    const idBoton = boton.id;
    colorSeleccionado.value = idBoton;
    });
});

btnTalles.forEach(boton => {
    boton.addEventListener('click', () => {
    // Remueve la clase "talle-activo" de todos los botones
    btnTalles.forEach(b => b.classList.remove('talle-activo'));

    // Agrega la clase "talle-activo" al botón que fue clickeado
    boton.classList.add('talle-activo');
    talleSeleccionado.innerHTML = boton.value;
    talleSeleccionado.value = boton.id;
    });
});

inputCantidad.forEach(input => {
    input.addEventListener('input', () => {
    if (input.value < 1  ) {
        input.value = 1; 
    }
});
});

// funciones para los botones de incremento de decremento de la cantidad de un producto

btnDecremento.forEach(btnSeleccionado => {
    btnSeleccionado.addEventListener('click', () => {
    // agarro a elemento padre del bot{on que se hizo click
    const padre = btnSeleccionado.closest('.flex-cantidad');
    // agarro el elemento hermano que busco para que pueda decrementa solo en ese input
    const inputCantidad = padre.querySelector('.input-cantidad');
    let valor = parseInt(inputCantidad.value);
    if (valor > 1) {
        inputCantidad.value = valor - 1;
    }
});
})

btnIncremento.forEach(btnSeleccionado => {
    btnSeleccionado.addEventListener('click', () => {
    // agarro a elemento padre del bot{on que se hizo click
    const padre = btnSeleccionado.closest('.flex-cantidad');
    // agarro el elemento hermano que busco para que pueda incrementar solo en ese input
    const inputCantidad = padre.querySelector('.input-cantidad');
    let valor = parseInt(inputCantidad.value);
        inputCantidad.value = valor + 1;
});
});


btnColores.forEach(boton => {
    boton.addEventListener('click', () => {
    // Remueve la clase "color-activo" de todos los botones
    btnColores.forEach(b => {
            const wapper = b.closest('.wapper-color');
            wapper.classList.remove('.color-activo')
        });

    // Agrega la clase "color-activo" al botón que fue clickeado
    const wapper = boton.closest('.wapper-color');
    wapper.classList.add('.color-activo');
    colorSeleccionado.innerHTML = boton.value;
    });
});

btnTalles.forEach(boton => {
    boton.addEventListener('click', () => {
    // Remueve la clase "talle-activo" de todos los botones
    btnTalles.forEach(b => b.classList.remove('talle-activo'));

    // Agrega la clase "talle-activo" al botón que fue clickeado
    boton.classList.add('talle-activo');
    talleSeleccionado.innerHTML = boton.value;
    });
});

inputCantidad.forEach(input => {
    input.addEventListener('input', () => {
    if (input.value < 1  ) {
        input.value = 1; 
    }
});
});

// Evita escribir el signo "-" directamente
/* inputCantidad.addEventListener('keydown', (e) => {
    if (e.key === '-' || e.code === 'Minus') {
    e.preventDefault();
    }
}); */

}
/* 
if(sidebar){
    sidebar.addEventListener('click', ()=>{
        linkSidebar.forEach(
            link => {
                if(link.closest('.ocultar')){
                    link.classList.remove('ocultar');
                }else{
                    link.classList.add('ocultar');
                }
            });
    });
} */

if (btnColorTalle) {
    btnColorTalle.addEventListener('click', () => {
        inputStock.readOnly = true;
        // Clonar el contenido desde el DOM generado por PHP
        const plantilla = document.getElementById('plantilla-color-talle').firstElementChild.cloneNode(true);
        plantilla.classList.add('fade-in');

        // Eliminar con animación
        const btnEliminar = plantilla.querySelector('.btn-eliminar');
        btnEliminar.addEventListener('click', () => {
            plantilla.classList.remove('fade-in');
            plantilla.classList.add('fade-out');
            plantilla.addEventListener('animationend', () => {
                plantilla.remove();
                if (gridColorTalle.children.length === 1) {
                inputStock.readOnly = false;
                }
            }, { once: true });
        });

        gridColorTalle.appendChild(plantilla);
    });


function actualizarStockTotal() {
    let total = 0;
    document.querySelectorAll('.inputs-stock').forEach(input => {
        const valor = parseInt(input.value);
        if (!isNaN(valor)) {
            total += valor;
        }
    });

    // Establecer el total en el input de stock principal
    const inputStockPrincipal = document.querySelector('.input-stock');
    if (inputStockPrincipal) {
        inputStockPrincipal.value = total;
    }
}

// Detectar cambios en los inputs de stock secundarios
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('inputs-stock')) {
        actualizarStockTotal();
    }
});


inputImagen.addEventListener('change', function() {
    const archivo = this.files[0]; // Selecciona el primer archivo

    if (archivo) {
        const lector = new FileReader();
        lector.onload = function(e) {
            vistaPrevia.src = e.target.result; // Muestra la imagen
        };
        lector.readAsDataURL(archivo); // Convierte el archivo en una URL base64
    } else {
        vistaPrevia.src = ""; // Borra la imagen si se deselecciona
    }
});
}

const eliminaModal = document.getElementById('eliminaModal')
        if (eliminaModal) {
            eliminaModal.addEventListener('show.bs.modal', event => {
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const url = button.getAttribute('data-bs-url')
                // Update the modal's content.
                const form = eliminaModal.querySelector('#form-elimina')
                form.setAttribute('action', url)
})}