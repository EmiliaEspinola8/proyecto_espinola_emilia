<?php
namespace App\Models;
use CodeIgniter\Model;
class usuario_Model extends Model
{
    protected $table = 'usuarios'; //nombre de la tabla
    protected $primaryKey = 'id_usuario'; //identificador de la tabla
    protected $allowedFields = ['nombre', 'email','pass','perfil_id','estado','carrito']; //todos los campos de la tabla

public function usuarioPerfiles(){
	return $this->select('usuarios.*, perfiles.descripcion AS perfil')
                ->join('perfiles', 'usuarios.perfil_id = perfiles.id_perfiles')
                ->findAll();
}

public function actualizarCarrito($idUsuario, $carrito)
    {
        $this->update($idUsuario, ['carrito' => json_encode($carrito)]);
    }

public function obtenerCarrito($idUsuario)
    {
        $usuario = $this->find($idUsuario);

        return $usuario['carrito'] ? json_decode($usuario['carrito'], true) : [];
    }

    public function obtenerPerfiles($idUsuario)
    {
        $usuario = $this->find($idUsuario);

        return $usuario['carrito'] ? json_decode($usuario['carrito'], true) : [];
    }

    public function filtrarUsuarios($estado, $perfil, $buscar){
        if(empty($buscar)){
        $sql = "SELECT usuarios.*, perfiles.descripcion AS perfil
                FROM usuarios
                INNER JOIN perfiles
                ON perfiles.id_perfiles = usuarios.perfil_id
                WHERE usuarios.perfil_id = IFNULL(?, usuarios.perfil_id)
                AND usuarios.estado = IFNULL(?, usuarios.estado)";

            $query = $this->db->query($sql, [$perfil, $estado]);
        }else{
                $sql = "SELECT usuarios.*, perfiles.descripcion AS perfil
                        FROM usuarios
                        INNER JOIN perfiles
                        ON perfiles.id_perfiles = usuarios.perfil_id
                        WHERE usuarios.perfil_id = IFNULL(?, usuarios.perfil_id)
                        AND usuarios.estado = IFNULL(?, usuarios.estado)
                        AND usuarios.nombre LIKE ?";

                $query = $this->db->query($sql, [$perfil, $estado, '%' . $buscar . '%']);
        }
                return $query->getResultArray();
        }
}