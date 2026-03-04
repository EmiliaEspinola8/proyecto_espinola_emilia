<?php
namespace App\Models;
use CodeIgniter\Model;
class producto_Model extends Model
{
    protected $table = 'productos'; //nombre de la tabla
    protected $primaryKey = 'id_producto'; //identificador de la tabla
    protected $allowedFields = ['nombre_producto', 'imagen', 'categoria_id', 'precio', 'estado', 'descripcion']; //todos los campos de la tabla


    public function allProductos(){
        return $this->select('productos.*, SUM(productos_detalle.stock) AS stock_total')
                    ->join('productos_detalle', 'productos.id_producto = productos_detalle.producto_id')
                    ->where('estado', 1)
                    ->orderBy('id_producto', 'ASC')
                    ->groupBy('productos.id_producto')
                    ->findAll();
    }

        public function allProductosCategoria($idCategoria){
        return $this->select('productos.*, SUM(productos_detalle.stock) AS stock_total')
                    ->join('productos_detalle', 'productos.id_producto = productos_detalle.producto_id')
                    ->where('estado', 1)
                    ->where('categoria_id', $idCategoria)
                    ->orderBy('id_producto', 'DESC')
                    ->groupBy('productos.id_producto')
                    ->findAll();
    }

public function productosCategoria(){

	return $this->select('productos.*, categorias.descripcion AS categoria')
                    ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
                    ->orderBy('id_producto', 'ASC')
                    ->findAll();

}

    public function filtarProductos($buscar, $estado)
    {
                    $sql = "SELECT * , categorias.descripcion AS categoria
                        FROM productos
                        INNER JOIN categorias
                        ON productos.categoria_id = categorias.id_categoria
                        where (productos.nombre_producto like ? OR categorias.descripcion like ?)
                        AND productos.estado = ?";
                $query = $this->db->query($sql, ['%'. $buscar . '%','%'. $buscar . '%', $estado ]);

        return $query->getResultArray();
    }
    public function filtarProductosBusqueda($buscar)
    {
                  $sql = "SELECT * , categorias.descripcion AS categoria
                        FROM productos
                        INNER JOIN categorias
                        ON productos.categoria_id = categorias.id_categoria
                        where productos.nombre_producto like ? OR categorias.descripcion like ?";
                $query = $this->db->query($sql, ['%'. $buscar . '%' , '%'. $buscar . '%']);

        return $query->getResultArray();
    }

    public function filtrarProductosEstado($q)
    {
        return $this->select('productos.*, categorias.descripcion AS categoria')
        ->join('categorias', 'productos.categoria_id = categorias.id_categoria')
        ->where('estado', $q)
        ->findAll();
    }

    public function topProductosVendidos()
    {
        return $this->select('productos.*, SUM(ventas_detalle.cantidad) as total_vendido, SUM(productos_detalle.stock) AS stock_total')
                    ->join('productos_detalle', 'productos.id_producto = productos_detalle.producto_id')
                    ->join('ventas_detalle', 'productos_detalle.id_producto = ventas_detalle.producto_detalle_id')
                    ->orderBy('total_vendido', 'DESC')
                    ->where('productos.estado', 1)
                    ->groupBy('productos.id_producto')
                    ->having('stock_total >', 0)
                    ->findAll(12);
    }

    public function topProductosVendidosPorCategoria($categoriaID, $IDproducto)
    {
        return $this->select('productos.*, SUM(ventas_detalle.cantidad) as total_vendido, SUM(productos_detalle.stock) AS stock_total')
                    ->join('productos_detalle', 'productos.id_producto = productos_detalle.producto_id')
                    ->join('ventas_detalle', 'productos_detalle.id_producto = ventas_detalle.producto_detalle_id')
                    ->orderBy('total_vendido', 'DESC')
                    ->where('productos.categoria_id', $categoriaID)
                    ->where('productos.estado', 1)
                    ->where('productos.id_producto !=', $IDproducto)
                    ->groupBy('productos.id_producto')
                    ->findAll(4);
    }

    public function getProductosFiltrados($colores = null, $talles = null, $categoria_id = null, $ordenamiento, $buscar)
{
    $builder = $this->db->table('productos p')
        ->select('p.*, SUM(d.stock) AS stock_total')
        ->join('productos_detalle d', 'd.producto_id = p.id_producto', 'left');

    // filtro por categoría
    if (!empty($categoria_id)) {
        $builder->where('p.categoria_id', $categoria_id);
    }

    // filtro por talles (lista de valores)
    if (!empty($talles) && is_array($talles)) {
        $builder->whereIn('d.talle_id', $talles);
    }

    // filtro por colores (lista de valores)
    if (!empty($colores) && is_array($colores)) {
        $builder->whereIn('d.color_id', $colores);
    }

    if(!empty($buscar)){
        $builder->like('p.nombre_producto', $buscar);
    }

    if($ordenamiento == 2){
        $builder->orderBy('p.id_producto', 'ASC');
    }else if($ordenamiento == 3){
            $builder->orderBy('p.precio', 'DESC');
    }else if($ordenamiento == 4){
            $builder->orderBy('p.precio', 'ASC');
    }else{
            $builder->orderBy('p.id_producto', 'DESC');
    }

    $builder->groupBy('p.id_producto');

    return $builder->get()->getResultArray();
}

}