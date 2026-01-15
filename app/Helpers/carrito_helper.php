<?php
use App\Models\productos_detalle_Model;
use App\Models\usuario_Model;

    function verCarrito($carrito){

        $idsDetalle = array_keys($carrito);
        
        $detalleModel = new productos_detalle_Model();
        $detalles = $detalleModel->obtenerDetallesCarrito($idsDetalle);
        
        $carritoVista = [];
        
        foreach ($detalles as $detalle) {
        
            $cantidad = $carrito[$detalle['id_producto']]['cantidad'];
        
            $carritoVista[] = [
                'id_detalle_producto' => $detalle['id_producto'],
                'producto_id'=> $detalle['producto_id'],
                'nombre'     => $detalle['nombre_producto'],
                'precio'     => $detalle['precio'],
                'imagen'     => $detalle['imagen'],
                'talle'      => $detalle['talle'],
                'color'      => $detalle['color'],
                'cantidad'   => $cantidad,
            ];
        }
        return $carritoVista;
    }