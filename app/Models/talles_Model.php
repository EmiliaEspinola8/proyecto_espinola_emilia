<?php
namespace App\Models;
use CodeIgniter\Model;
class talles_Model extends Model
{
    protected $table = 'talles'; //nombre de la tabla
    protected $primaryKey = 'id_talle'; //identificador de la tabla
    protected $allowedFields = ['talle', 'estado']; //todos los campos de la tabla

        public function filtarTalles($buscar, $estado)
    {
            return $this->select('talles.*')
                        ->like('talles.talle', $buscar)
                        ->where('talles.estado', $estado)
                        ->findAll();
    }
    public function filtarTallesBusqueda($buscar)
    {
                return $this->select('talles.*')
                            ->like('talles.talle', $buscar)
                            ->findAll();
    }

    public function filtrarTallesEstado($estado)
    {
                return $this->select('talles.*')
                            ->where('talles.estado', $estado)
                            ->findAll();
    }
}