<?php
namespace App\Models;
use CodeIgniter\Model;
class contacto_Model extends Model
{
 protected $table = 'contacto'; //nombre de la tabla
 protected $primaryKey = 'id_contacto'; //identificador de la tabla
 protected $allowedFields = ['nombre_apellido', 'email', 'motivo', 'mensaje', 'resuelto','telefono']; //todos los campos de la tabla

//public function updateContacto($id){
//	$this->set('resuelto' , 'SI')->where('id_contacto', $id)->update();
  // }

}