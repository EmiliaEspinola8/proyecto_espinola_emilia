<?php
namespace App\Controllers;
Use App\Models\talles_Model;
use CodeIgniter\Controller;

class talle_controller extends Controller{
    
    public function index(){
        
        $talle_model = new talles_Model();
        $talles['talles'] = $talle_model->findAll();

        echo view('cliente/head');
        echo view('administrador/sidebar');
        echo view('administrador/tabla_talles', $talles);
        echo view('administrador/footer');
    } 

public function create() {
    $talle_model = new talles_Model();
    $reglas = $this->obtenerReglas();

    if (!$this->validate($reglas)) {
        return $this->response->setJSON([
            'status' => 'error',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $talle = $this->request->getPost('talle');
    $talle_model->insert(['talle' => $talle]);

    // Devuelvo la tabla renderizada como HTML para refrescar
    $talles = $talle_model->findAll();
    $html = view('administrador/tabla_talles', ['talles' => $talles]);

    return $this->response->setJSON([
        'status' => 'success',
        'html' => $html
    ]);
}

    public function buscarTalles(){
        $nombre = $this->request->getPost('buscar') ?? null;
        $estado = $this->request->getPost('estado') ?? null;

        $model = new talles_Model();

        if($nombre != null && $estado == null){
                $talles = $model->filtarTallesBusqueda($nombre);
        }else if($nombre == null && $estado != null){
                $talles = $model->filtrarTallesEstado($estado);
        }else if($nombre != null && $estado != null){
                $talles = $model->filtarTalles($nombre, $estado);
        }else{
            $talles = $model->findAll();
        }

        return view('administrador/tabla_talles', ['talles' => $talles]);
    }

    public function edit(){
    $talle_model = new talles_Model();
    $descripcionAnt = $this->request->getPost('talleAnt');
    $talle = $talle_model->where('talle', $descripcionAnt)->first();

    $reglas = $this->obtenerReglas($talle['id_talle']);

    if (!$this->validate($reglas)) {
        return $this->response->setJSON([
            'status' => 'error',
            'errors' => $this->validator->getErrors()
        ]);
    }
    
    $descripcion = $this->request->getPost('talle');

    $talle_model->update($talle['id_talle'], ['talle' => $descripcion]);

    // Devuelvo la tabla renderizada como HTML para refrescar
    $data['talles'] = $talle_model->findAll();
    $html = view('administrador/tabla_talles', $data);

    return $this->response->setJSON([
        'status' => 'success',
        'html' => $html
    ]);
    }

    public function delete($id){
        $talle_model = new talles_Model();
        $talle = $talle_model->where('id_talle', $id)->first();
        
        $talle_model->update($id, ['estado' => !$talle['estado']]);

        return redirect()->to('/crudtalles');
    }

    public function obtenerReglas($id = null){
            return [
            'talle'   =>  [
                'rules' =>  $id 
                ? "required|is_unique[talles.talle,id_talle,{$id}]"
                : "required|is_unique[talles.talle]",
                'errors' => [
                    'required' => 'El campo nombre es requerido',
                    'is_unique' => 'Este {field} ya está en uso'  
                ],
                
            ]];     
    }          
}