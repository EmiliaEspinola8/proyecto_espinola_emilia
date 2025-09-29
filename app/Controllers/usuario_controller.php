<?php
namespace App\Controllers;
Use App\Models\usuario_Model;
Use App\Models\perfiles_Model;
use CodeIgniter\Controller;

class usuario_controller extends Controller{

    public function __construct(){
            helper(['form', 'url']);

    }
    public function create() {
        
        $dato['titulo']='Registro'; 
        echo view('cliente/head', $dato);
        echo view('cliente/header');
        echo view('cliente/navbar');
        echo view('cliente/header_carrito');
        echo view('cliente/carrito.php');
        echo view('cliente/registro');
        echo view('cliente/footer');
    }    

    public function formValidation() {

        $input = $this->validate([
            'nombre'   => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'min_length' => 'El {field} debe ser de al menos 3 caracteres' 
                ],
            ],
            'apellido'   => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'min_length' => 'El {field} debe ser de al menos 3 caracteres' 
                ],
            ],
            'email'   => [
                'rules' => 'required|min_length[4]|valid_email[email]|is_unique[usuarios.email]',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'min_length' => 'El {field} debe ser de al menos 4 caracteres',
                    'valid_email' => 'El {field} no es válido',
                    'is_unique' => 'Este {field} ya está en uso'  
                ],
            ],
            'pass'   => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'El campo contraseña es requerido',
                    'min_length' => 'La contraseña debe ser de al menos 5 caracteres' 
                ],
            ],
        ],
        
    );
        $formModel = new usuario_Model();
    
        if (!$input) {
                $dato['titulo']='Registro'; 
                echo view('cliente/head', $dato);
                echo view('cliente/header');
                echo view('cliente/navbar');
                echo view('cliente/header_carrito');
                echo view('cliente/carrito.php');
                echo view('cliente/registro', ['validation' => $this->validator]);
                echo view('cliente/footer');

        } else {
            $formModel->save([
                'nombre' => $this->request->getVar('apellido') . " " . $this->request->getVar('nombre'),
                'email'=> $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT)
              //password_hash() crea un nuevo hash de contraseña usando un algoritmo de hash de único sentido.
            ]);  
        
            // Flashdata funciona solo en redirigir la función en el controlador en la vista de carga.
                return redirect()->to('/login');
              // return $this->response->redirect('/registro');

        }
    }

    public function listarUsuarios() {
        $usuarioModel = new usuario_Model(); 
        $perfilModel = new perfiles_Model();
        $usuarios = $usuarioModel->usuarioPerfiles(); 
        $perfiles = $perfilModel->findAll();
        
        echo view('cliente/head');
        echo view('administrador/sidebar');
        echo view('administrador/tabla-usuarios', ["usuarios" => $usuarios, "perfiles" => $perfiles]);
        echo view('administrador/footer');
    }

    public function delete($id){
        $usuarioModel = new usuario_Model(); 
        $usuario = $usuarioModel->where('id_usuario', $id)->first();
        
        $usuarioModel->update($id, ['estado' => !$usuario['estado']]);

        return redirect()->to('/crudusuarios');
    }

    public function edit($id){
        $usuarioModel = new usuario_Model(); 
        $usuario = $usuarioModel->where('id_usuario', $id)->first();

        if($usuario['perfil_id'] == 1){
            $usuarioModel->update($id, ['perfil_id' => 2]);
        }else{
            $usuarioModel->update($id, ['perfil_id' => 1]);
        }


        return redirect()->to('/crudusuarios');
    }

    public function filtrarUsuarios(){
        $usuarioModel = new usuario_Model(); 
        $perfilModel = new perfiles_Model();
        $perfiles = $perfilModel->findAll();

        $perfilSeleccionado = $this->request->getPost('perfil');
        $estadoSeleccionado = $this->request->getPost('estado');

        if($estadoSeleccionado != 0){
            $estado = !empty($estadoSeleccionado) ? $estadoSeleccionado : null;
        }else{
            $estado = $estadoSeleccionado;
        }

        $perfil = !empty($perfilSeleccionado) ? $perfilSeleccionado : null;
        $buscar = $this->request->getPost('buscar') ?? '';

        $usuarios = $usuarioModel->filtrarUsuarios($estado, $perfil, $buscar); 

        return view('administrador/tabla-usuarios',  ['usuarios' => $usuarios, 'perfiles' => $perfiles]);
    }
}
