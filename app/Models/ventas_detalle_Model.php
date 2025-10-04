<?php
namespace App\Models;
use CodeIgniter\Model;
class ventas_detalle_Model extends Model
{
 protected $table = 'ventas_detalle'; //nombre de la tabla
 protected $primaryKey = 'id'; //identificador de la tabla
 protected $allowedFields = ['venta_id', 'producto_id', 'cantidad', 'precio', 'subtotal']; //todos los campos de la tabla

public function listarVentasDetalle($idVenta){
        return $this->select('ventas_detalle.*, productos.nombre_producto')
                ->join('productos', 'productos.id_producto = ventas_detalle.producto_id', 'left')
                ->where('ventas_detalle.venta_id', $idVenta)
                ->findAll();
}

public function topCategoriasMasVendidas(){
$sql = 'SELECT  c.descripcion, SUM(vd.cantidad) AS total_vendidos, p.imagen
                FROM ventas_detalle vd
                JOIN productos p ON p.id_producto = vd.producto_id
                JOIN categoria c ON c.id_categoria = p.categoria_id
                WHERE c.activo = 1
                GROUP BY c.id_categoria
                ORDER BY total_vendidos DESC
                LIMIT 3';

        $query = $this->db->query($sql);
        return $query->getResultArray();

}

}