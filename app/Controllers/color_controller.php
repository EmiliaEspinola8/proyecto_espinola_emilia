<?php
namespace App\Controllers;
Use App\Models\colores_Model;
use CodeIgniter\Controller;

class color_controller extends Controller{

    public function index(){
        $colorModel = new colores_Model(); 
        $colores['colores'] = $colorModel->findAll();

        echo view('cliente/head');
        echo view('administrador/sidebar');
        echo view('administrador/tabla-colores', $colores);
        echo view('administrador/footer');
    }

    public function create(){

    $color_model = new colores_Model();
    $reglas = $this->obtenerReglas();

    if (!$this->validate($reglas)) {
        return $this->response->setJSON([
            'status' => 'error',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $color = $this->request->getPost('color');
    $color_hex = $this->request->getPost('color_hex');
    $lista = [
        'nombre' => $color, 
        'codigo_hex' => $color_hex
    ];

    $color_model->insert($lista);

    $colores = $color_model->findAll();
    $html = view('administrador/tabla-colores', ['colores' => $colores]);

    return $this->response->setJSON([
        'status' => 'success',
        'html' => $html
    ]);
    }

    public function edit(){
    $color_model = new colores_Model();
    $nombreAnt = $this->request->getPost('color_ant');
    $colorOb = $color_model->where('nombre', $nombreAnt)->first();

    $reglas = $this->obtenerReglas($colorOb['id_colores']);

    if (!$this->validate($reglas)) {
        return $this->response->setJSON([
            'status' => 'error',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $color = $this->request->getPost('color');
    $color_hex = $this->request->getPost('color_hex');
    
    $lista = ['nombre' => $color, 'codigo_hex' => $color_hex];

    $color_model->update($colorOb['id_colores'], $lista);

    // Devuelvo la tabla renderizada como HTML para refrescar
    $data['colores'] = $color_model->findAll();
    $html = view('administrador/tabla-colores', $data);

    return $this->response->setJSON([
        'status' => 'success',
        'html' => $html
    ]);
    }

    public function delete($id){
        $color_model = new colores_Model();
        $color = $color_model->where('id_colores', $id)->first();
        
        $color_model->update($id, ['estado' => !$color['estado']]);

        return redirect()->to('/crudcolores');
    }

    public function buscarColores(){
        $nombre = $this->request->getPost('buscar') ??  null;
        $estado = $this->request->getPost('estado') ?? null;
        $model = new colores_Model();
        
        if($nombre != null && $estado == null){
                $colores = $model->filtrarColoresBusqueda($nombre);
        }else if($nombre == null && $estado != null){
                $colores = $model->filtrarColoresEstado($estado);
        }else if($nombre != null && $estado != null){
                $colores = $model->filtrarColores($nombre, $estado);
        }else{
            $colores = $model->findAll();
        }

        return view('administrador/tabla-colores', ['colores' => $colores]);
    }

public function obtenerReglas($id = null)
{
    return [
        'color' => [
            'rules' => $id 
                ? "required|is_unique[colores.nombre,id_colores,{$id}]"
                : "required|is_unique[colores.nombre]",
            'errors' => [
                'required'  => 'El campo nombre es requerido',
                'is_unique' => 'Este {field} ya está en uso'
            ],
        ],
        'color_hex' => [
            'rules' => 'required|regex_match[/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/]',
            'errors' => [
                'required'   => 'El campo color es requerido',
                'regex_match'=> 'El campo color debe ser un color hexadecimal válido'
            ],
        ]
    ];
}

}