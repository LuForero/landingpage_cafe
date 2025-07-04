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

    // Mostrar listado de productos (con stock actualizado por ventas)
    // Display list of products (stock adjusted based on sales)
    public function index()
    {
        $products = $this->productModel->getAll();
        require_once __DIR__ . '/../views/products/index.php';
    }

    // Historial de ventas
    // Sales history
    public function salesHistory()
    {
        $sales = $this->saleModel->getAllSalesWithDetails();
        require_once __DIR__ . '/../views/products/sales.php';
    }

    // Mostrar formulario para crear nuevo producto
    // Show form to create a new product
    public function create()
    {
        require_once __DIR__ . '/../views/products/create.php';
    }

    // Guardar nuevo producto en base de datos
    // Save new product to the database
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

    // Mostrar formulario de edición de producto
    // Show form to edit product
    public function edit()
    {
        $id = $_GET['id'];
        $product = $this->productModel->getById($id);
        require_once __DIR__ . '/../views/products/edit.php';
    }

    // Guardar cambios en producto
    // Save product updates
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
    // Delete product
    public function delete()
    {
        $id = $_GET['id'];
        $this->productModel->delete($id);
        header('Location: index.php?controller=product&action=index');
    }

    // Exportar historial de ventas a CSV
    // Export sales history to CSV
    public function exportSalesCSV()
    {
        $sales = $this->saleModel->getAllSalesWithDetails();

        if (ob_get_length()) {
            ob_clean(); // Clean any previous output
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="historial_ventas.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Orden ID', 'Producto', 'Cantidad', 'Subtotal', 'Fecha']);

        foreach ($sales as $sale) {
            fputcsv($output, [
                $sale['order_id'] ?? '',
                $sale['product_name'] ?? '',
                $sale['quantity'] ?? '',
                $sale['subtotal'] ?? '',
                $sale['order_date'] ?? '',
            ]);
        }

        fclose($output);
        exit;
    }

    // Marcar una orden como pagada y descontar stock
    // Mark an order as paid and deduct stock
    public function markAsPaid()
    {
        $orderId = $_GET['id'] ?? null;

        if ($orderId) {
            $stmt = $this->db->prepare("UPDATE orders SET status = 'pagado' WHERE id = :id");
            $stmt->bindParam(':id', $orderId);
            $stmt->execute();

            $stmtSales = $this->db->prepare("SELECT product_id, quantity FROM sales WHERE order_id = :order_id");
            $stmtSales->bindParam(':order_id', $orderId);
            $stmtSales->execute();
            $ventas = $stmtSales->fetchAll(PDO::FETCH_ASSOC);

            foreach ($ventas as $venta) {
                $stmtUpdate = $this->db->prepare("UPDATE products SET stock = stock - :qty WHERE id = :pid");
                $stmtUpdate->bindParam(':qty', $venta['quantity']);
                $stmtUpdate->bindParam(':pid', $venta['product_id']);
                $stmtUpdate->execute();
            }
        }

        header("Location: index.php?controller=product&action=salesHistory");
        exit();
    }

    // Actualizar el estado de una orden (y el stock si aplica)
    // Update an order's status (and stock if applicable)
    public function updateOrderStatus()
    {
        if (!isset($_POST['order_id']) || !isset($_POST['status'])) {
            echo "Faltan datos necesarios.";
            return;
        }

        $orderId = $_POST['order_id'];
        $newStatus = $_POST['status'];
        $allowedStatuses = ['pendiente', 'pagado', 'cancelado'];

        if (!in_array($newStatus, $allowedStatuses)) {
            echo "Estado inválido.";
            return;
        }

        $stmt = $this->db->prepare("SELECT status FROM orders WHERE id = :id");
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        $currentStatus = $stmt->fetchColumn();

        if (!$currentStatus) {
            echo "Orden no encontrada.";
            return;
        }

        if ($currentStatus !== $newStatus) {
            $update = $this->db->prepare("UPDATE orders SET status = :status WHERE id = :id");
            $update->bindParam(':status', $newStatus);
            $update->bindParam(':id', $orderId);
            $update->execute();

            // Descontar stock si se marca como pagado / Deduct stock if status is set to paid
            if ($newStatus === 'pagado') {
                $stmt = $this->db->prepare("SELECT product_id, quantity FROM sales WHERE order_id = :id");
                $stmt->bindParam(':id', $orderId);
                $stmt->execute();
                $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($ventas as $venta) {
                    $updateStock = $this->db->prepare("UPDATE products SET stock = stock - :qty WHERE id = :pid");
                    $updateStock->bindParam(':qty', $venta['quantity']);
                    $updateStock->bindParam(':pid', $venta['product_id']);
                    $updateStock->execute();
                }
            }

            // Revertir stock si pasa de pagado a cancelado / Restore stock if changed from paid to canceled
            if ($currentStatus === 'pagado' && $newStatus === 'cancelado') {
                $stmt = $this->db->prepare("SELECT product_id, quantity FROM sales WHERE order_id = :id");
                $stmt->bindParam(':id', $orderId);
                $stmt->execute();
                $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($ventas as $venta) {
                    $restoreStock = $this->db->prepare("UPDATE products SET stock = stock + :qty WHERE id = :pid");
                    $restoreStock->bindParam(':qty', $venta['quantity']);
                    $restoreStock->bindParam(':pid', $venta['product_id']);
                    $restoreStock->execute();
                }
            }
        }

        header('Location: index.php?controller=product&action=salesHistory');
        exit;
    }
}
