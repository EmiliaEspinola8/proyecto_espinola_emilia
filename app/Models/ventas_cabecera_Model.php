<?php
namespace App\Models;
use CodeIgniter\Model;

class ventas_cabecera_Model extends Model
{
 protected $table = 'ventas_cabecera'; //nombre de la tabla
 protected $primaryKey = 'id_ventas'; //identificador de la tabla
 protected $allowedFields = ['fecha', 'hora' ,'usuario_id', 'total_venta']; //todos los campos de la tabla

public function listarVentas(){    
        return $this->select('ventas_cabecera.*, usuarios.nombre')
                ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
                ->findAll();
}

public function filtrarVentas($fechaDesde, $fechaHasta, $buscar){
        if(empty($buscar)){
                $sql = "SELECT * , usuarios.nombre
                        FROM ventas_cabecera
                        INNER JOIN usuarios
                        ON usuarios.id_usuario = ventas_cabecera.usuario_id
                        WHERE ventas_cabecera.fecha BETWEEN COALESCE(?, (SELECT MIN(fecha) FROM ventas_cabecera))
                        AND COALESCE(?, (SELECT MAX(fecha) FROM ventas_cabecera))";
                $query = $this->db->query($sql, [$fechaDesde, $fechaHasta]);
        }else{
                $sql = "SELECT *
                        FROM ventas_cabecera
                        INNER JOIN usuarios
                        ON usuarios.id_usuario = ventas_cabecera.usuario_id
                        WHERE ventas_cabecera.fecha BETWEEN COALESCE(?, (SELECT MIN(fecha) FROM ventas_cabecera))
                        AND COALESCE(?, (SELECT MAX(fecha) FROM ventas_cabecera))
                        AND usuarios.nombre LIKE ?";

                $query = $this->db->query($sql, [$fechaDesde, $fechaHasta, '%' . $buscar . '%']);
        }
                return $query->getResultArray();
        }
}

