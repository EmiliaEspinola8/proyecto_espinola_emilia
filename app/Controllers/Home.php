<?php

namespace App\Controllers;
Use App\Models\producto_Model;
Use App\Models\usuario_Model;
use App\Models\ventas_detalle_Model;
use App\Models\productos_detalle_Model;
use App\Models\talles_Model;
use App\Models\colores_Model;
Use App\Models\carrito_Model;
Use App\Models\carrito_item_Model;

class Home extends BaseController
{
    public function inicio()
    {   
        $productoModel = new producto_Model(); 
        $ventaModel = new ventas_detalle_Model();

        $categorias = $ventaModel->topCategoriasMasVendidas();
        $data = $productoModel->topProductosVendidos();

        $carrito['carrito'] = $this->obtenerCarrito();

        echo view('cliente/head');
        echo view('cliente/header');
        echo view('cliente/navbar');
        echo view('cliente/carrito.php', $carrito);
        echo view('cliente/principal', ['productos' => $data, 'categorias' => $categorias]);
        echo view('cliente/footer');
    }

    public function login()
    {   
        echo view('cliente/head');
        echo view('cliente/header');
        echo view('cliente/navbar');
        echo view('cliente/carrito.php');
        echo view('cliente/login');
        echo view('cliente/footer');
    }

    public function registro()
    {   
        echo view('cliente/head');
        echo view('cliente/header');
        echo view('cliente/navbar');
        echo view('cliente/carrito.php');
        echo view('cliente/registro');
        echo view('cliente/footer');
    }

    public function quienesSomos()
    {   
        $carrito['carrito'] = $this->obtenerCarrito();

        echo view('cliente/head');
        echo view('cliente/header');
        echo view('cliente/navbar');
        echo view('cliente/carrito.php', $carrito);
        echo view('cliente/quienes-somos');
        echo view('cliente/footer');
    }

    public function obtenerCarrito(){
        $usuarios = new usuario_Model();
        $carritoModel = new carrito_Model();
        $carritoItemsModel = new carrito_item_Model();

        $usuarioID = session()->get('id_usuario');
        
        $carrito = $carritoModel
        ->where('usuario_id', $usuarioID)
        ->first();

        if($usuarioID){
            $carritoActualizado = $carritoItemsModel->verCarrito($carrito['id_carrito']);
        }else{
            $carritoActualizado = [];
        }

        return $carritoActualizado;
    }
}
