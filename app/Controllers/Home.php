<?php

namespace App\Controllers;
Use App\Models\producto_Model;
Use App\Models\usuario_Model;
use App\Models\ventas_detalle_Model;

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
        if(session()->get('logged_in')){
            $usuarioID = session()->get('id_usuario');
            return $carrito = $usuarios->obtenerCarrito($usuarioID);
        }else{
            return $carrito = [];
        }
    }
}
