<?php

require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    private $productModel;

    public function __construct($conexion)
    {
        $this->productModel = new Product($conexion);
    }

    // Mostrar listado de productos
    public function index()
    {
        $products = $this->productModel->getAll();
        require_once __DIR__ . '/../views/products/index.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        require_once __DIR__ . '/../views/products/create.php';
    }

    // Guardar nuevo producto
    public function store()
    {
        $farmer_id = $_POST['farmer_id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $description = $_POST['description'];
        $image = $_POST['image'];  // Más adelante podemos agregar subida de imágenes

        $this->productModel->create($farmer_id, $name, $category, $price, $stock, $description, $image);
        header('Location: index.php?controller=product&action=index');
    }

    // Mostrar formulario de edición
    public function edit()
    {
        $id = $_GET['id'];
        $product = $this->productModel->getById($id);
        require_once __DIR__ . '/../views/products/edit.php';
    }

    // Guardar cambios en el producto
    public function update()
    {
        $id = $_POST['id'];
        $farmer_id = $_POST['farmer_id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $description = $_POST['description'];
        $image = $_POST['image'];

        $this->productModel->update($id, $farmer_id, $name, $category, $price, $stock, $description, $image);
        header('Location: index.php?controller=product&action=index');
    }

    // Eliminar producto
    public function delete()
    {
        $id = $_GET['id'];
        $this->productModel->delete($id);
        header('Location: index.php?controller=product&action=index');
    }
}
