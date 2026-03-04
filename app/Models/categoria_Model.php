<?php
namespace App\Models;
use CodeIgniter\Model;
class categoria_Model extends Model
{
    protected $table = 'categorias'; //nombre de la tabla
    protected $primaryKey = 'id_categoria'; //identificador de la tabla
    protected $allowedFields = ['descripcion', 'activo']; //todos los campos de la tabla

        public function filtrarCatagorias($buscar, $activo)
    {
            return $this->select('categorias.*')
                        ->like('categorias.descripcion', $buscar)
                        ->where('categorias.activo', $activo)
                        ->findAll();
    }
    public function filtrarCategoriasBusqueda($buscar)
    {
                return $this->select('categorias.*')
                            ->like('categorias.descripcion', $buscar)
                            ->findAll();
    }

    public function filtrarCatagoriasEstado($activo)
    {
                return $this->select('categorias.*')
                            ->where('categorias.activo', $activo)
                            ->findAll();
    }
}