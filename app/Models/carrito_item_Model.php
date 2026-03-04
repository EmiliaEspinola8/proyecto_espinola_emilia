<?php
namespace App\Models;
use CodeIgniter\Model;
class carrito_item_Model extends Model
{
    protected $table = 'carritos_items'; //nombre de la tabla
    protected $primaryKey = 'id_carrito_item'; //identificador de la tabla
    protected $allowedFields = ['carrito_id', 'producto_detalle_id', 'cantidad']; //todos los campos de la tabla


    public function verCarrito($carritoID)
{
    return $this->db->table('carritos_items ci')
        ->select('
            ci.id_carrito_item,
            ci.cantidad,
            pd.id_producto AS id_detalle_producto,
            p.id_producto,
            p.nombre_producto AS nombre,
            p.precio,
            p.imagen,
            t.talle,
            c.nombre AS color,
            pd.stock
        ')
        ->join('productos_detalle pd', 'pd.id_producto = ci.producto_detalle_id')
        ->join('productos p', 'p.id_producto = pd.producto_id')
        ->join('talles t', 't.id_talle = pd.talle_id')
        ->join('colores c', 'c.id_colores = pd.color_id')
        ->where('ci.carrito_id', $carritoID)
        ->get()
        ->getResultArray();
}

}