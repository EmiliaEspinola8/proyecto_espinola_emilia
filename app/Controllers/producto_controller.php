<?php
namespace App\Controllers;
Use App\Models\producto_Model;
Use App\Models\categoria_Model;
Use App\Models\usuario_Model;
Use App\Models\talles_Model;
Use App\Models\colores_Model;
Use App\Models\productos_detalle_Model;
use CodeIgniter\Controller;


class producto_controller extends Controller{
    public function index() {
        $productoModel = new producto_Model(); 
        $data['productos'] = $productoModel->productosCategoria();
        
        echo view('cliente/head');
        echo view('administrador/sidebar');
        echo view('administrador/tabla-productos', $data);
        echo view('administrador/footer');
    }
    
    public function ProductoDetalle($id){
        $productoDetalleModel = new productos_detalle_Model();
        $data =  $productoDetalleModel->DetalleProducto($id);
        
        echo view('cliente/head');
        echo view('administrador/sidebar');
        echo view('administrador/tabla_productos_detalle', ['productosDetalle' => $data]);
        echo view('administrador/footer');
    }

    public function altaProducto() {

        $categoriaModel = new categoria_Model(); 
        $categorias = $categoriaModel->where('activo', 1)->findAll();

        $talleModel = new talles_Model();
        $talles = $talleModel->where('estado', 1)->findAll();

        $colorModel = new colores_Model();
        $colores = $colorModel->where('estado', 1)->findAll();
        
        $datos =  ['categorias' => $categorias, 'talles' => $talles, 'colores' => $colores];
        echo view('cliente/head');
        echo view('administrador/sidebar');
        echo view('administrador/alta-producto', $datos);
        echo view('administrador/footer');
    }

    public function create(){

        $reglas = $this->validate($this->obtenerReglas());

        if(!$reglas){
        $categoriaModel = new categoria_Model(); 
        $categorias = $categoriaModel->where('activo', 1)->findAll();

        $talleModel = new talles_Model();
        $talles = $talleModel->where('estado', 1)->findAll();

        $colorModel = new colores_Model();
        $colores = $colorModel->where('estado', 1)->findAll();

            $datos =  ['validation' => $this->validator , 'categorias' => $categorias, 'talles' => $talles, 'colores' => $colores];
            echo view('cliente/head');
            echo view('administrador/sidebar');
            echo view('administrador/alta-producto', $datos);
            echo view('administrador/footer');

        }else{

        $img = $this->request->getFile('imagen');    
        $post = $this->request->getPost(['nombre_producto', 'categoria_id', 'precio', 'stock','descripcion']);
        $colores = $this->request->getPost('color');
        $talles = $this->request->getPost('talle');
        $cantidad = $this->request->getPost('cantidad');

        if($img->isValid() && ! $img->hasMoved()){
        $nombre_aleatorio = $img->getRandomName(); 
        $img->move(ROOTPATH . 'assets/uploads', $nombre_aleatorio);
        }

        $lista = [
            'nombre_producto' => trim($post['nombre_producto']),
            'imagen' => $nombre_aleatorio,
            'categoria_id' => $post['categoria_id'],
            'precio' => $post['precio'],
            'stock' => $post['stock'],
            'descripcion' => $post['descripcion'],
        ];

        $productoModel = new producto_Model();
        $productoModel->insert($lista);

        $idProducto = $productoModel->getInsertID();

        $productoDetalle = new productos_detalle_Model();

        for ($i = 0; $i < count($cantidad)-1; $i++) {

        if(empty($talles[$i]) || empty($colores[$i])){
            return redirect()->back()->withInput()->with('error', 'Bebes seleccionar un color y un talle');         
        }else{
            $productoDetalle->insert([
            'producto_id' => $idProducto,
            'color_id'    => $colores[$i] ?? null,
            'talle_id'    => $talles[$i] ?? null,
            'stock'       => $cantidad[$i+1],
        ]);
        }
        }        
        return $this->response->redirect(site_url('/crudproductos'));
        }  
}

public function delete($id){
        $productoModel = new producto_Model(); 
        $producto = $productoModel->where('id_producto', $id)->first();
        
        $productoModel->update($id, ['estado' => !$producto['estado']]);

        return redirect()->to('/crudproductos');
}

public function edit($id){

        $productoModel = new producto_Model(); 
        $categoriaModel = new categoria_Model(); 
        $productoDetalleModel = new productos_detalle_Model();
        
        $categorias = $categoriaModel->where('activo', 1)->findAll();
        $producto = $productoModel->find($id);

        $talleModel = new talles_Model();
        $talles = $talleModel->where('estado', 1)->findAll();

        $colorModel = new colores_Model();
        $colores = $colorModel->where('estado', 1)->findAll();
        

        $productosDetalle = $productoDetalleModel->where('producto_id' , $id)->findAll();
        
        $datos =  ['categorias' => $categorias, 'talles' => $talles, 'colores' => $colores, 'producto' => $producto, 'productosDetalle' =>  $productosDetalle];
        echo view('cliente/head');
        echo view('administrador/sidebar');
        echo view('administrador/editar_producto', $datos);
        echo view('administrador/footer');
    }


    public function deleteProductoDetalle($id){ 
        $productoDetalleModel = new productos_detalle_Model();
        $productoDetalleModel->delete($id);

        return redirect()->back()->withInput();
    }

    public function update($id){
        if(!$this->request->is('post') || $id == null){
            return redirect()->route('/crudproductos');
        }

        $reglas = $this->obtenerReglas();
        if(!$this->validate($reglas)){
        $categoriaModel = new categoria_Model(); 
        $categorias = $categoriaModel->where('activo', 1)->findAll();

        $talleModel = new talles_Model();
        $talles = $talleModel->where('estado', 1)->findAll();

        $colorModel = new colores_Model();
        $colores = $colorModel->where('estado', 1)->findAll();

            $datos =  ['validation' => $this->validator , 'categorias' => $categorias, 'talles' => $talles, 'colores' => $colores];
            echo view('cliente/head');
            echo view('administrador/sidebar');
            echo view('administrador/alta-producto', $datos);
            echo view('administrador/footer');
        }

        $img = $this->request->getFile('imagen');    
        $post = $this->request->getPost(['nombre_producto', 'categoria_id', 'precio', 'stock','descripcion']);
        $colores = $this->request->getPost('color');
        $talles = $this->request->getPost('talle');
        $cantidad = $this->request->getPost('cantidad');
        $colores_viejos = $this->request->getPost('color_viejo');
        $talles_viejos = $this->request->getPost('talle_viejo');
        $cantidad_viejos = $this->request->getPost('cantidad_viejo');
        $idProdustosDetalle = $this->request->getPost('id_detalle_producto');

        $productoModel = new producto_Model();
        $productoDetalle = new productos_detalle_Model();

        $producto = $productoModel->where('id_producto', $id)->first();
        

        if($img->isValid() && ! $img->hasMoved()){
        $nombre_aleatorio = $img->getRandomName(); 
        $img->move(ROOTPATH . 'assets/uploads', $nombre_aleatorio);
        }
        
        if(empty($nombre_aleatorio)){
            $lista = [
            'nombre_producto' => trim($post['nombre_producto']),
            'imagen' => $producto['imagen'],
            'categoria_id' => $post['categoria_id'],
            'precio' => $post['precio'],
            'stock' => $post['stock'],
            'descripcion' => $post['descripcion'],
        ];
        }else{
            $lista = [
            'nombre_producto' => trim($post['nombre_producto']),
            'imagen' => $nombre_aleatorio,
            'categoria_id' => $post['categoria_id'],
            'precio' => $post['precio'],
            'stock' => $post['stock'],
            'descripcion' => $post['descripcion'],
        ];
        }
        
        $productoModel->update($id, $lista);

        if(!empty($cantidad_viejos)){
            for ($i = 0; $i < count($cantidad_viejos); $i++){
            if(empty($talles_viejos[$i]) && empty($colores_viejos[$i])){

            return redirect()->back()->withInput()->with('error', 'Bebes seleccionar al menos un color o un talle');
        }else{
            $productoDetalle->update($idProdustosDetalle[$i],[
            'producto_id' => $id,
            'color_id'    => $colores_viejos[$i] ?? null,
            'talle_id'    => $talles_viejos[$i] ?? null,
            'stock'       => $cantidad_viejos[$i],
        ]);
        }
        }
        }

        for ($i = 0; $i < count($cantidad)-1; $i++) {

        if(empty($talles[$i]) || empty($colores[$i])){
            return redirect()->back()->withInput()->with('error', 'Bebes seleccionar un color y un talle');         
        }else{
            $productoDetalle->insert([
            'producto_id' => $id,
            'color_id'    => $colores[$i] ?? null,
            'talle_id'    => $talles[$i] ?? null,
            'stock'       => $cantidad[$i+1],
        ]);
        }
        }  

        return $this->response->redirect(site_url('/crudproductos'));
        }

    public function detalle_producto($id)
    {   
        $productoModel = new producto_Model(); 
        $productoDetalleModel = new productos_detalle_Model();
        $producto = $productoModel->find($id);
        $categorias = $productoModel->topProductosVendidosPorCategoria($producto['categoria_id'], $producto['id_producto']);
        $productoDetalle = $productoDetalleModel->primerDetalleProducto($id);

        $productoDetalleModel = new productos_detalle_Model();
        $productoDetalleColor = $productoDetalleModel->coloresPorProducto($id);
        $productoDetalleTalle = $productoDetalleModel->tallesPorProducto($id);

        $carrito['carrito'] = $this->obtenerCarrito();

        $data = ['producto' => $producto, 
                    'productoDetalleSeleccionado' => $productoDetalle, 
                    'productosDetalleColor' => $productoDetalleColor, 
                    'productosDetalleTalle' => $productoDetalleTalle, 
                    'categorias' => $categorias];

        echo view('cliente/head');
        echo view('cliente/header');
        echo view('cliente/navbar');
        echo view('cliente/carrito.php', $carrito);
        echo view('cliente/detalle-producto', $data);
        echo view('cliente/footer');
    }

        public function buscar()
    {
        $nombre = $this->request->getPost('nombre') ?? null;
        $estado = $this->request->getPost('estado') ?? null;

        $model = new producto_Model();

        if($nombre != null && $estado == null){
                $productos['productos'] = $model->filtarProductosBusqueda($nombre);
        }else if($nombre == null && $estado != null){
                $productos['productos'] = $model->filtrarProductosEstado($estado);
        }else if($nombre != null && $estado != null){
                $productos['productos'] = $model->filtarProductos($nombre, $estado);
        }else{
            $productos['productos'] = $model->productosCategoria();
        }

        echo view('administrador/tabla-productos', $productos);
    }

    public function consultar_talles(){
        $idColor = $this->request->getPost('id_color');
        $idProducto = $this->request->getPost('id_producto');

        $productoDetalleModel = new productos_detalle_Model();

        $talles = $productoDetalleModel->consultarTalles($idProducto, $idColor);

        return $this->response->setJSON($talles);
    }

        public function consultar_colores(){
        $idTalle = $this->request->getPost('id_talle');
        $idProducto = $this->request->getPost('id_producto');

        $productoDetalleModel = new productos_detalle_Model();

        $colores = $productoDetalleModel->consultarColores($idProducto, $idTalle);

        return $this->response->setJSON($colores);
    }

    
    public function productos()
    {   
        $productoModel = new producto_Model();
        $productos = $productoModel->where('estado', 1)->orderBy('id_producto', 'DESC')->findAll();

        $categoriaModel = new categoria_Model(); 
        $categorias = $categoriaModel->where('activo', 1)->findAll();

        $talleModel = new talles_Model();
        $talles = $talleModel->where('estado', 1)->findAll();

        $colorModel = new colores_Model();
        $colores = $colorModel->where('estado', 1)->findAll();

        $carrito = $this->obtenerCarrito();

        echo view('cliente/head');
        echo view('cliente/header');
        echo view('cliente/navbar');
        echo view('cliente/carrito.php', ['carrito' => $carrito]);
        echo view('cliente/productos', ['categorias' => $categorias, 'colores' => $colores, 'talles' => $talles]);
        echo view('cliente/galeria', ['productos' => $productos]);
        echo view('cliente/footer');
    }

    public function getFiltrarProductos(){
        $productoModel = new producto_Model();

        $idColores = $this->request->getPost('id_colores');
        $idTalles = $this->request->getPost('id_talles');
        $idCategoria = $this->request->getPost('id_categoria');
        $idOrdenamiento = $this->request->getPost('id_ordenamiento');
        $buscar = $this->request->getPost('buscar');

        $productos = $productoModel-> getProductosFiltrados($idColores, $idTalles, $idCategoria, $idOrdenamiento, $buscar);
        
        echo view('cliente/galeria', ['productos' => $productos]);
    }

        public function obtenerReglas(){
            return [
            'nombre_producto'   =>  [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo nombre es requerido',
                    'min_length' => 'El {field} debe ser de al menos 3 caracteres' 
                ],
            ],
            'categoria_id'    => 'is_not_unique[categoria.id_categoria]',
            'precio'  => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                ],
            ],
            'stock'  => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es requerido',
                ],
            ],
            'descripcion' =>[
                'rules' => 'max_length[100]',
                'errors' => [
                    'max_length' => 'El campo no {field} debe tener más de 100 caracteres',
                ],
            ],
            'imagen' =>[
                'rules' => 'uploaded[imagen]|is_image[imagen]',
                'errors' => [
                'uploaded' => 'Debes seleccionar una imagen',
                'is_image' => 'El archivo debe ser una imagen',
                ],
            ],
            'cantidad'  => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo stock es requerido',
                ],
            ],
            'talle'  => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo talle es requerido',
                ],
            ],
            'color'  => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo color es requerido',
                ],
            ],
        ];
        
        }
    
    public function obtenerCarrito(){
        $usuarios = new usuario_Model();
        if(session()->get('logged_in')){
            $usuarioID = session()->get('id_usuario');
            return $carrito = $usuarios->obtenerCarrito($usuarioID);
        }else{
            return $carrito = [];
        }
    }
}