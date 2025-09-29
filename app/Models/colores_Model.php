<?php
namespace App\Models;
use CodeIgniter\Model;
class colores_Model extends Model
{
    protected $table = 'colores'; //nombre de la tabla
    protected $primaryKey = 'id_colores'; //identificador de la tabla
    protected $allowedFields = ['nombre', 'codigo_hex', 'estado']; //todos los campos de la tabla

        public function filtrarColores($buscar, $estado)
        {
                return $this->select('colores.*')
                        ->like('colores.nombre', $buscar)
                        ->where('colores.estado', $estado)
                        ->findAll();
        }
        public function filtrarColoresBusqueda($buscar)
        {
                return $this->select('colores.*')
                        ->like('colores.nombre', $buscar)
                        ->findAll();
        }

        public function filtrarColoresEstado($estado)
        {
                return $this->select('colores.*')
                        ->where('colores.estado', $estado)
                        ->findAll();
        }
}