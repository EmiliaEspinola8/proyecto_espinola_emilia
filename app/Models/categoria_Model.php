<?php
namespace App\Models;
use CodeIgniter\Model;
class categoria_Model extends Model
{
    protected $table = 'categoria'; //nombre de la tabla
    protected $primaryKey = 'id_categoria'; //identificador de la tabla
    protected $allowedFields = ['descripcion', 'activo']; //todos los campos de la tabla

        public function filtrarCatagorias($buscar, $activo)
    {
            return $this->select('categoria.*')
                        ->like('categoria.descripcion', $buscar)
                        ->where('categoria.activo', $activo)
                        ->findAll();
    }
    public function filtrarCategoriasBusqueda($buscar)
    {
                return $this->select('categoria.*')
                            ->like('categoria.descripcion', $buscar)
                            ->findAll();
    }

    public function filtrarCatagoriasEstado($activo)
    {
                return $this->select('categoria.*')
                            ->where('categoria.activo', $activo)
                            ->findAll();
    }
}