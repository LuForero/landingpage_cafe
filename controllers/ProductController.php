<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Sale.php';

class ProductController
{
    private $db;
    private $productModel;
    private $saleModel;

    public function __construct($conexion)
    {
        $this->db = $conexion;
        $this->productModel = new Product($this->db);
        $this->saleModel = new Sale($this->db);
    }

    // Mostrar listado de productos (con stock descontado por ventas)
    public function index()
    {
        $products = $this->productModel->getAll();

        foreach ($products as &$product) {
            $soldQuantity = $this->saleModel->getTotalSoldByProduct($product['id']);
            $product['stock'] -= $soldQuantity;
        }

        require_once __DIR__ . '/../views/products/index.php';
    }

    // Historial de ventas
    public function salesHistory()
    {
        $sales = $this->saleModel->getAllSales();
        require_once __DIR__ . '/../views/products/sales.php';
    }

    // Mostrar formulario de creación
    public function create()
    {
        require_once __DIR__ . '/../views/product/create.php';
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
        require_once __DIR__ . '/../views/product/edit.php';
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

        $product = $this->productModel->getById($id);
        $currentImage = $product['image'];

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

    public function exportSalesCSV()
    {
        require_once __DIR__ . '/../models/Sale.php';
        $saleModel = new Sale($this->db);
        $sales = $saleModel->getAllSalesWithDetails(); // Debes tener esta función en Sale.php

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="historial_ventas.csv"');

        $output = fopen('php://output', 'w');

        // Encabezados
        fputcsv($output, ['Orden ID', 'Producto', 'Cantidad', 'Subtotal', 'Fecha']);

        // Filas
        foreach ($sales as $sale) {
            fputcsv($output, [
                $sale['order_id'],
                $sale['product_name'],
                $sale['quantity'],
                $sale['subtotal'],
                $sale['created_at'],
            ]);
        }

        fclose($output);
        exit;
    }
}
