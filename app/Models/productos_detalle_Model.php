<?php
namespace App\Models;
use CodeIgniter\Model;
class productos_detalle_Model extends Model
{
    protected $table = 'productos_detalle'; //nombre de la tabla
    protected $primaryKey = 'id_producto'; //identificador de la tabla
    protected $allowedFields = ['talle_id', 'color_id', 'producto_id', 'stock', 'estado']; //todos los campos de la tabla

    public function DetalleProducto($id){

    return $this->select('productos_detalle.*, talles.talle, colores.nombre, productos.nombre_producto')
                ->join('talles', 'talles.id_talle = productos_detalle.talle_id', 'left')
                ->join('colores', 'colores.id_colores = productos_detalle.color_id','left')
                ->join('productos', 'productos.id_producto = productos_detalle.producto_id')
                ->where('productos_detalle.producto_id', $id)
                ->findAll();
}
public function tallesPorProducto($productoId)
{
    $sql = "SELECT DISTINCT t.talle, t.id_talle
            FROM productos_detalle pd
            JOIN talles t ON t.id_talle = pd.talle_id
            WHERE pd.producto_id = ?";

    $query = $this->db->query($sql, [$productoId]);
    return $query->getResultArray();
}

public function coloresPorProducto($productoId)
{
    $sql = "SELECT DISTINCT c.nombre, c.codigo_hex, c.id_colores
            FROM productos_detalle pd
            JOIN colores c ON c.id_colores = pd.color_id
            WHERE pd.producto_id = ?";

    $query = $this->db->query($sql, [$productoId]);
    return $query->getResultArray();
}

public function buscarDetalleProducto($idProducto, $id_talle, $idColor){
    $sql = "SELECT *
                FROM productos_detalle pd
                WHERE pd.producto_id = ?   -- el id del producto que buscas
                AND pd.talle_id    = ?     -- el id del talle
                AND pd.color_id    = ?";

    $query = $this->db->query($sql, [$idProducto, $id_talle, $idColor]);
    return $resultado = $query->getRowArray();
}

public function consultarTalles($productoId, $colorId)
{
    $sql = "SELECT DISTINCT pd.talle_id
            FROM productos_detalle pd
            WHERE pd.producto_id = ? 
            AND pd.color_id = ?";

    $query = $this->db->query($sql, [$productoId, $colorId]);
    return $query->getResultArray();
}

public function consultarColores($productoId, $talleId){
    $sql = "SELECT DISTINCT pd.color_id
            FROM productos_detalle pd
            WHERE pd.producto_id = ? 
            AND pd.talle_id = ?";

    $query = $this->db->query($sql, [$productoId, $talleId]);
    return $query->getResultArray();
}

public function primerDetalleProducto($idProducto){
        return $this->select('productos_detalle.talle_id, productos_detalle.color_id , talles.talle, colores.nombre, colores.codigo_hex')
                ->join('talles', 'talles.id_talle = productos_detalle.talle_id')
                ->join('colores', 'colores.id_colores = productos_detalle.color_id')
                ->where('productos_detalle.producto_id', $idProducto)
                ->first();
}

}