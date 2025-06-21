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
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $description = $_POST['description'];

        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = basename($_FILES['image']['name']);
            $uniqueName = time() . "_" . $fileName;
            $targetFile = $uploadDir . $uniqueName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $imagePath = 'public/uploads/' . $uniqueName;
            }
        }

        $this->productModel->create($name, $category, $price, $stock, $description, $imagePath);
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
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $description = $_POST['description'];

        // Obtener imagen actual del producto
        $product = $this->productModel->getById($id);
        $currentImage = $product['image'];

        // Procesar la nueva imagen solo si se cargó una nueva
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = basename($_FILES['image']['name']);
            $uniqueName = time() . "_" . $fileName;
            $targetFile = $uploadDir . $uniqueName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $image = 'public/uploads/' . $uniqueName;
            }
        } else {
            $image = $currentImage;
        }


        $this->productModel->update($id, $name, $category, $price, $stock, $description, $image);

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
