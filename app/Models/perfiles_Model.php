<?php
namespace App\Models;
use CodeIgniter\Model;
class perfiles_Model extends Model
{
    protected $table = 'perfiles'; //nombre de la tabla
    protected $primaryKey = 'id_perfiles'; //identificador de la tabla
    protected $allowedFields = ['descripcion']; //todos los campos de la tabla
}