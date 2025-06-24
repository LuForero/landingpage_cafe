<?php
require_once __DIR__ . '/../models/Product.php';

class CartController
{
    private $productModel;
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
        $this->productModel = new Product($conexion);
    }

    // Agregar al carrito
    public function add()
    {
        $productId = $_GET['id'] ?? null;

        if (!$productId) {
            header('Location: index.php?controller=home&action=index');
            exit();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Si el producto ya está en el carrito, aumenta la cantidad
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += 1;
        } else {
            // Obtener datos del producto desde la base de datos
            $product = $this->productModel->getById($productId);

            if ($product) {
                $_SESSION['cart'][$productId] = [
                    'id'       => $product['id'],
                    'name'     => $product['name'],
                    'price'    => $product['price'],
                    'quantity' => 1
                ];
            }
        }

        header('Location: index.php?controller=home&action=index');
        exit();
    }

    // Ver carrito
    public function index()
    {
        require_once __DIR__ . '/../views/cart/index.php';
    }

    // Eliminar producto del carrito
    public function remove()
    {
        $productId = $_GET['id'] ?? null;

        if ($productId && isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        header('Location: index.php?controller=cart&action=index');
        exit();
    }

    // Vaciar carrito
    public function clear()
    {
        unset($_SESSION['cart']);
        header('Location: index.php?controller=cart&action=index');
        exit();
    }

    // Confirmar y registrar la compra
    public function checkout()
    {
        if (empty($_SESSION['cart'])) {
            header('Location: index.php?controller=cart&action=index');
            exit();
        }

        require_once __DIR__ . '/../models/Order.php';
        require_once __DIR__ . '/../models/Sale.php';

        $orderModel = new Order($this->db);
        $saleModel  = new Sale($this->db);

        // Crear la orden
        $orderId = $orderModel->create();

        $total = 0;

        // Insertar cada venta y calcular total
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;

            $saleModel->create($orderId, $item['id'], $item['quantity'], $subtotal);
        }

        // Actualizar el total en la orden
        $stmt = $this->db->prepare("UPDATE orders SET total_amount = :total WHERE id = :id");
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':id', $orderId);
        $stmt->execute();

        // Vaciar el carrito
        $_SESSION['cart'] = [];

        // Redirigir a agradecimiento
        header('Location: index.php?controller=cart&action=thankyou');
        exit();
    }

    // Vista de agradecimiento
    public function thankyou()
    {
        require_once __DIR__ . '/../views/cart/thankyou.php';
    }
}
