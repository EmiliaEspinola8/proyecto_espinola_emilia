<?php
namespace App\Models;
use CodeIgniter\Model;
class producto_Model extends Model
{
    protected $table = 'productos'; //nombre de la tabla
    protected $primaryKey = 'id_producto'; //identificador de la tabla
    protected $allowedFields = ['nombre_producto', 'imagen', 'categoria_id', 'precio', 'stock', 'estado', 'descripcion']; //todos los campos de la tabla

public function productosCategoria(){

	return $this->select('productos.*, categoria.descripcion AS categoria')
                    ->join('categoria', 'productos.categoria_id = categoria.id_categoria')
                    ->findAll();

}

    public function filtarProductos($buscar, $estado)
    {
                    $sql = "SELECT * , categoria.descripcion AS categoria
                        FROM productos
                        INNER JOIN categoria
                        ON productos.categoria_id = categoria.id_categoria
                        where (productos.nombre_producto like ? OR categoria.descripcion like ?)
                        AND productos.estado = ?";
                $query = $this->db->query($sql, ['%'. $buscar . '%','%'. $buscar . '%', $estado ]);

        return $query->getResultArray();
    }
    public function filtarProductosBusqueda($buscar)
    {
                  $sql = "SELECT * , categoria.descripcion AS categoria
                        FROM productos
                        INNER JOIN categoria
                        ON productos.categoria_id = categoria.id_categoria
                        where productos.nombre_producto like ? OR categoria.descripcion like ?";
                $query = $this->db->query($sql, ['%'. $buscar . '%' , '%'. $buscar . '%']);

        return $query->getResultArray();
    }

    public function filtrarProductosEstado($q)
    {
        return $this->select('productos.*, categoria.descripcion AS categoria')
        ->join('categoria', 'productos.categoria_id = categoria.id_categoria')
        ->where('estado', $q)
        ->findAll();
    }

    public function topProductosVendidos()
    {
        return $this->select('productos.*, SUM(ventas_detalle.cantidad) as total_vendido')
                    ->join('ventas_detalle', 'productos.id_producto = ventas_detalle.producto_id')
                    ->groupBy('productos.id_producto')
                    ->orderBy('total_vendido', 'DESC')
                    ->where('productos.estado', 1)
                    ->where('productos.stock >', 0)
                    ->limit(10)
                    ->findAll();
    }

    public function topProductosVendidosPorCategoria($categoriaID, $IDproducto)
    {
        return $this->select('productos.*, SUM(ventas_detalle.cantidad) as total_vendido')
                    ->join('ventas_detalle', 'productos.id_producto = ventas_detalle.producto_id')
                    ->groupBy('productos.id_producto')
                    ->orderBy('total_vendido', 'DESC')
                    ->where('productos.categoria_id', $categoriaID)
                    ->where('productos.estado', 1)
                    ->where('productos.id_producto !=', $IDproducto)
                    ->limit(4)
                    ->findAll();
    }

}