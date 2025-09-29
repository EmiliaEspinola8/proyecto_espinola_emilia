<?php
namespace App\Controllers;
Use App\Models\producto_Model;
Use App\Models\categoria_Model;
Use App\Models\usuario_Model;
use CodeIgniter\Controller;


class categoria_controller extends Controller{

    public function productosCategoria($id) {
        $productoModel = new producto_Model();
        $data['productos'] = $productoModel
        ->where('eliminado', 1)
        ->where('categoria_id', $id)
        ->productosCategoria();
        $data['categoria'] = $id;
        $dato['titulo']='productos_collares'; 
        echo view('front/header_view',$dato);
        echo view('front/nav_view');
        echo view('back/productos_collares' , $data);
        echo view('front/footer');
    }

    public function index() {

        $categoriaModel = new categoria_Model(); 
        $data['categorias'] = $categoriaModel->findAll();

        echo view('cliente/head');
        echo view('administrador/sidebar');
        echo view('administrador/tabla-categorias', $data);
        echo view('administrador/footer');
    }

    public function creaCategoria() {
    $categoriaModel = new categoria_Model(); 
        
    $reglas = $this->obtenerReglas();

    if (!$this->validate($reglas)) {
        return $this->response->setJSON([
            'status' => 'error',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $descripcion = $this->request->getPost('descripcion');
    $categoriaModel->insert(['descripcion' => $descripcion]);

    // Devuelvo la tabla renderizada como HTML para refrescar
    $data['categorias'] = $categoriaModel->findAll();
    $html = view('administrador/tabla-categorias', $data);

    return $this->response->setJSON([
        'status' => 'success',
        'html' => $html
    ]);
    }  

    public function edit(){
    $categoriaModel = new categoria_Model(); 

    $reglas = $this->obtenerReglas();

    if (!$this->validate($reglas)) {
        return $this->response->setJSON([
            'status' => 'error',
            'errors' => $this->validator->getErrors()
        ]);
    }
    
    $descripcionAnt = $this->request->getPost('descripcionAnt');
    $descripcion = $this->request->getPost('descripcion');

    $categoria = $categoriaModel->where('descripcion', $descripcionAnt)->first();
    $categoriaModel->update($categoria['id_categoria'], ['descripcion' => $descripcion]);

    // Devuelvo la tabla renderizada como HTML para refrescar
    $data['categorias'] = $categoriaModel->findAll();
    $html = view('administrador/tabla-categorias', $data);

    return $this->response->setJSON([
        'status' => 'success',
        'html' => $html
    ]);
    }
        
    public function delete($id){
        $categoriaModel = new categoria_Model();
        $categoria = $categoriaModel->where('id_categoria', $id)->first();
        
        $categoriaModel->update($id, ['activo' => !$categoria['activo']]);

        return redirect()->to('/crudcategorias');
    }

        public function buscarCategorias(){
        $nombre = $this->request->getPost('buscar') ?? null;
        $estado = $this->request->getPost('estado') ?? null;

        $model = new categoria_Model();

        if($nombre != null && $estado == null){
                $categorias = $model->filtrarCatagoriasBusqueda($nombre);
        }else if($nombre == null && $estado != null){
                $categorias = $model->filtrarCatagoriasEstado($estado);
        }else if($nombre != null && $estado != null){
                $categorias = $model->filtrarCatagorias($nombre, $estado);
        }else{
            $categorias = $model->findAll();
        }

        return view('administrador/tabla-categorias', ['categorias' => $categorias]);
    }

        public function obtenerReglas(){
        return  [
            'descripcion'   =>  [
                'rules' => 'required|min_length[3]|is_unique[categoria.descripcion]',
                'errors' => [
                    'required' => 'El campo descripción es requerido',
                    'min_length' => 'La descripción debe ser de al menos 3 caracteres',
                    'is_unique' => 'Esta descripción ya está en uso'  
                ],
            ],
        ];
    }
}
