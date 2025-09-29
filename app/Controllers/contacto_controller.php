<?php
namespace App\Controllers;
Use App\Models\contacto_Model;
Use App\Models\usuario_Model;
use CodeIgniter\Controller;


class contacto_controller extends Controller{

    public function index(){    
        $contactoModel = new contacto_Model(); 
        $data['contactos'] = $contactoModel->findAll();

            echo view('cliente/head');
            echo view('administrador/sidebar');
            echo view('administrador/tabla-contacto', $data);
            echo view('administrador/footer');
    }

    public function contacto()
    {   
        $carrito = $this->obtenerCarrito();

        echo view('cliente/head');
        echo view('cliente/header');
        echo view('cliente/navbar');
        echo view('cliente/carrito.php', $carrito);
        echo view('cliente/contacto');
        echo view('cliente/footer');
    }

    public function create(){
        
        $reglas = $this->validate($this->obtenerReglas());

        if(!$reglas){
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
        
        $post = $this->request->getPost(['nombre_apellido', 'email', 'motivo', 'mensaje', 'telefono']);

        $lista = [
            'nombre_apellido' => $post['nombre_apellido'],
            'email'=> trim($post['email']),
            'motivo' => trim($post['motivo']),
            'mensaje' => trim($post['mensaje']),
            'telefono' => trim($post['telefono']),
        ];

        $contactoModel = new contacto_Model();
        $contactoModel->insert($lista);

        return $this->response->redirect(site_url('contacto'));
    }

    public function update($id){

        $contactoModel = new contacto_Model();
        $contacto =  $contactoModel->find($id);
        $contactoModel->update($id, ['resuelto' => !$contacto['resuelto']]);
        return redirect()->to(base_url('/crudcontacto'));
    }

    public function buscar(){
        $buscar = $this->request->getPost('buscar');
        $contactoModel = new contacto_Model();

        $contactos['contactos'] = $contactoModel->like('nombre_apellido', $buscar)
                                    ->orlike('email', $buscar)
                                    ->orliKe('motivo', $buscar)
                                    ->findAll();

        return view('administrador/tabla-contacto', $contactos);

    }
    
        public function delete($id){
        $contactoModel = new contacto_Model(); 
        $contactoModel->delete($id);

        return redirect()->to('/crudcontacto');
        }

        public function obtenerReglas(){
            return [
            'nombre_apellido'   =>  [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo nombre es requerido',
                    'min_length' => 'El {field} debe ser de al menos 3 caracteres' 
                ],
            ],
            'email'   => [
                'rules' => 'required|min_length[12]|valid_email[email]|',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                    'min_length' => 'El {field} debe ser de al menos 12 caracteres',
                    'valid_email' => 'El {field} no es válido',
                ],
            ],    
            'motivo'  => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => 'El campo nombre es requerido',
                    'min_length' => 'El {field} debe ser de al menos 4 caracteres' 
                ],
            ],
            'mensaje'  => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'El campo nombre es requerido',
                    'min_length' => 'El {field} debe ser de al menos 8 caracteres' 
                ],
            ],
        ];
        } 

        public function obtenerCarrito(){
        
        $session = session();
        $usuarios = new usuario_Model();
        if($session->get('logged_in')){
            $usuarioID = $session->get('id_usuario');
            return  $carrito['carrito'] = $usuarios->obtenerCarrito($usuarioID);
        }
        
        return  $carrito = [];
    }

}