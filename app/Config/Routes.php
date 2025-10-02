<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --------------- Esto es lo nuevo ----------------------------

$routes->get('/', 'Home::inicio');
// -------------------------------------------------------------

$routes->get('quienes-somos', 'Home::quienesSomos');

/*rutas del Registro de Usuarios*/
/*La URI enviar-form es el action del formulario registrarse.php*/
$routes->get('/registro', 'Home::registro');
$routes->post('/enviar-form','usuario_controller::formValidation');
$routes->get('/login','login_controller::index',['filter' => 'login']);
$routes->post('/enviarlogin','login_controller::auth',['filter' => 'login']);
$routes->get('/logout', 'login_controller::logout');


/*rutas del crud de productos*/
$routes->post('filtrar_productos', 'producto_controller::getFiltrarProductos');
$routes->get('/productos', 'producto_controller::productos');
$routes->get('/detalle_producto_(:num)', 'producto_controller::detalle_producto::/$1');
$routes->post('consultar_colores', 'producto_controller::consultar_colores');
$routes->post('consultar_talles', 'producto_controller::consultar_talles');
$routes->post('filtrar_estado', 'producto_controller::filtrar_estado');
$routes->post('productos_buscar', 'producto_controller::buscar');
$routes->get('/crudproductos','producto_controller::index',['filter' => 'perfil']);
$routes->get('/alta-producto','producto_controller::altaProducto',['filter' => 'perfil']);
$routes->post('/enviarproductos','producto_controller::create');
$routes->get('productos_edit_(:num)','producto_controller::edit/$1',['filter' => 'perfil']);
$routes->post('productos_update_(:num)','producto_controller::update/$1',['filter' => 'perfil']);
$routes->get('productos/delete/(:num)','producto_controller::delete/$1');
$routes->get('productos/tablaEliminados','producto_controller::tablaEliminados',['filter' => 'perfil']);
$routes->get('productos/activar/(:num)','producto_controller::activar/$1',['filter' => 'perfil']);
$routes->get('productoDetalle_delete_(:num)','producto_controller::deleteProductoDetalle::/$1',['filter' => 'perfil']);
$routes->get('tabla_productoDetalle_(:num)','producto_controller::ProductoDetalle::/$1',['filter' => 'perfil']);
/*rutas del crud de usuarios*/
$routes->get('/crudusuarios','usuario_controller::listarUsuarios',['filter' => 'perfil']);
$routes->get('/creausuarios','usuario_crud_controller::creaUsuario');
$routes->post('/enviar-registro','usuario_crud_controller::create');
$routes->get('usuarios/edit/(:num)','usuario_controller::edit/$1',['filter' => 'perfil']);
$routes->get('usuarios/delete/(:num)','usuario_controller::delete/$1',['filter' => 'perfil']);
$routes->post('filtrar-usuarios','usuario_controller::filtrarUsuarios',['filter' => 'perfil']);
/** rutas de talles */
$routes->get('talle/delete/(:num)','talle_controller::delete/$1',['filter' => 'perfil']);
$routes->post('/editar_talle','talle_controller::edit',['filter' => 'perfil']);
$routes->post('/buscar_talles','talle_controller::buscarTalles',['filter' => 'perfil']);
$routes->get('/crudtalles','talle_controller::index',['filter' => 'perfil']);
$routes->post('/agregar_talle','talle_controller::create',['filter' => 'perfil']);

/** rutas de los colores */
$routes->get('crudcolores', 'color_controller::index',['filter' => 'perfil']);
$routes->post('/agregar_color','color_controller::create',['filter' => 'perfil']);
$routes->post('/editar_color','color_controller::edit',['filter' => 'perfil']);
$routes->get('color/delete/(:num)','color_controller::delete/$1',['filter' => 'perfil']);
$routes->post('/buscar_colores','color_controller::buscarColores',['filter' => 'perfil']);

/*rutas del crud de contacto*/
$routes->get('crudcontacto', 'contacto_controller::index',['filter' => 'perfil']);
$routes->get('/contacto', 'contacto_controller::contacto');
$routes->post('/enviar-contacto','contacto_controller::create');
$routes->get('contactos_resolver_(:num)','contacto_controller::update/$1',['filter' => 'perfil']);
$routes->get('contactos_delete_(:num)','contacto_controller::delete/$1',['filter' => 'perfil']);
$routes->post('buscar_contacto','contacto_controller::buscar',['filter' => 'perfil']);


/*rutas del carrito*/
$routes->post('/validar_stock','carrito_controller::validarStock');
$routes->post('/incrementar_cant_producto','carrito_controller::incrementarCantProducto');
$routes->post('/eliminar_del_carrito','carrito_controller::eliminarProductoDelCarrito');
$routes->post('/agregar_al_carrito','carrito_controller::agregar_al_carrito');
$routes->get('/carrito','carrito_controller::muestra');
$routes->post('/carritoAgrega','carrito_controller::añadirCarrito');
$routes->get('/limpiar-carrito','carrito_controller::limpiarCarrito');
$routes->get('/comprar-carrito','compras_controller::registrarCompra');
$routes->get('/carrito_elimina/(:any)','carrito_controller::remove/$1');
$routes->post('carrito_actualiza', 'carrito_controller::actualiza_carrito');
/*rutas de las ventas*/
$routes->post('/filtrar_ventas','ventas_controller::filtrarVentas',['filter' => 'perfil']);
$routes->post('/comprar','ventas_controller::registrarVenta');
$routes->get('/ventas','ventas_controller::listarVentas',['filter' => 'perfil']);
$routes->get('/detalles_(:num)','ventas_controller::detalleVenta/$1',['filter' => 'perfil']);
$routes->get('/ventasUsuario/(:num)','compras_controller::listarVentasUsuario/$1',['filter' => 'perfil']);
$routes->get('/detallesUsuario/(:num)','compras_controller::detalleVentaUsuario/$1',['filter' => 'perfil']);
/*rutas de las categorias*/
$routes->post('/buscar_categorias','categoria_controller::buscarCategorias',['filter' => 'perfil']);
$routes->get('crudcategorias', 'categoria_controller::index',['filter' => 'perfil']);
$routes->post('creaCategoria', 'categoria_controller::creaCategoria',['filter' => 'perfil']);
$routes->post('categoria_edit', 'categoria_controller::edit',['filter' => 'perfil']);
$routes->get('categoria/delete/(:num)','categoria_controller::delete/$1',['filter' => 'perfil']);