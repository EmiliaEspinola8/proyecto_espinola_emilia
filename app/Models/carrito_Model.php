<?php
namespace App\Models;
use CodeIgniter\Model;
class carrito_Model extends Model
{
    protected $table = 'carritos'; //nombre de la tabla
    protected $primaryKey = 'id_carrito'; //identificador de la tabla
    protected $allowedFields = ['usuario_id', 'total']; //todos los campos de la tabla
}