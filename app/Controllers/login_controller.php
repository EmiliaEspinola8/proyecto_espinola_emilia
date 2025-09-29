<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\usuario_Model;
  
class login_controller extends BaseController
{
    protected $usuarios;
    public function __construct(){
      helper(['form','url']);
      $this->usuarios = new usuario_Model();
    }
    public function index()
    {
      
      $session = session();
      $carrito['carrito'] = $session->get('carrito') ?? [];

        $dato['titulo']='login'; 
        echo view('cliente/head', $dato);
        echo view('cliente/header');
        echo view('cliente/navbar');
        echo view('cliente/carrito.php', $carrito);
        echo view('cliente/login');
        echo view('cliente/footer');
    } 
  
    public function auth()
    {
        $session = session(); //el objeto de sesión se asigna a la variable $session

        //traemos los datos del formulario
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pass');
        
        $userInfo = $this->usuarios->where('email', $email)->first(); //consulta sql 
        if($userInfo){
                if ($userInfo['estado'] == 0){
                      $session->setFlashdata('msg', 'Usuario dado de baja');
                      return redirect()->to('/login');
                }
                    //Se verifican los datos ingresados para iniciar, si cumple la verificaciòn inicia la sesion
                $contraseñaVerificada = password_verify($password, $userInfo['pass']);
                   //password_verify determina los requisitos de configuracion de la contraseña
                    if($contraseñaVerificada){
                      $ses_data = [
                    'id_usuario' => $userInfo['id_usuario'],
                    'nombre' =>  $userInfo['nombre'],
                    'email' =>  $userInfo['email'],
                    'perfil_id'=> $userInfo['perfil_id'],
                    'logged_in'  => TRUE
                ];
                  //Si se cumple la verificacion inicia la sesiòn  
                  $session->set($ses_data);
                  
                  if( $userInfo['perfil_id'] == 1){
                        return redirect()->to('/crudproductos');
                  }
                  return redirect()->to('/');
            }else{  
                 //no paso la validaciòn de la password
                $session->setFlashdata('msg', 'Contraseña incorrecta');
                return redirect()->to('/login');
        }   
        }else{
             //no paso la validaciòn del correo
            $session->setFlashdata('msg', 'Email incorrecto');
            return redirect()->to('/login');
      } 
    
  }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
} 
