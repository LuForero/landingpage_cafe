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

    // Agregar producto al carrito
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

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += 1;
        } else {
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

        // REDIRIGE al home o a productos, no a checkout
        header('Location: index.php?controller=home&action=index');
        exit();
    }


    // Eliminar producto del carrito
    public function remove()
    {
        $productId = $_GET['id'] ?? null;

        if ($productId && isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        header('Location: index.php?controller=cart&action=checkout');
        exit();
    }

    // Vaciar carrito
    public function clear()
    {
        unset($_SESSION['cart']);
        header('Location: index.php?controller=cart&action=checkout');
        exit();
    }

    // Mostrar formulario de checkout
    public function checkout()
    {
        // Siempre carga la vista, aunque el carrito esté vacío
        require_once __DIR__ . '/../views/cart/checkout.php';
    }

    // Procesar datos del comprador y registrar orden
    public function checkoutPost()
    {
        if (empty($_SESSION['cart'])) {
            header('Location: index.php?controller=home&action=index');
            exit();
        }

        $name     = $_POST['name'] ?? '';
        $email    = $_POST['email'] ?? '';
        $phone    = $_POST['phone'] ?? '';
        $comments = $_POST['comments'] ?? '';
        $status   = 'pendiente';
        $total    = 0;

        require_once __DIR__ . '/../models/Order.php';
        require_once __DIR__ . '/../models/Sale.php';

        $orderModel = new Order($this->db);
        $saleModel  = new Sale($this->db);

        // ✅ PRIMERO calcula el total
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        }

        // ✅ AHORA sí crea la orden con el total calculado
        $stmt = $this->db->prepare("INSERT INTO orders (name, email, phone, comments, total_amount, status, order_date)
        VALUES (:name, :email, :phone, :comments, :total, :status, NOW())");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        $orderId = $this->db->lastInsertId();

        // ✅ Registrar cada producto en la tabla sales
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $saleModel->create($orderId, $item['id'], $item['quantity'], $subtotal);
        }

        // ✅ Limpiar carrito
        unset($_SESSION['cart']);

        // ✅ Redirigir
        header('Location: index.php?controller=cart&action=thankyou');
        exit();
    }

    // Página de agradecimiento
    public function thankyou()
    {
        require_once __DIR__ . '/../views/cart/thankyou.php';
    }

    public function confirm()
    {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            header('Location: index.php?controller=cart&action=index');
            exit();
        }

        // Datos del formulario de checkout
        $name     = $_POST['name'] ?? '';
        $email    = $_POST['email'] ?? '';
        $phone    = $_POST['phone'] ?? '';
        $comments = $_POST['comments'] ?? '';
        $total    = 0;

        // Calcular total
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Insertar en tabla orders
        $stmt = $this->db->prepare("INSERT INTO orders (name, email, phone, comments, total_amount, status, order_date) 
                                VALUES (:name, :email, :phone, :comments, :total, 'pendiente', NOW())");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':total', $total);
        $stmt->execute();

        $orderId = $this->db->lastInsertId();

        // Insertar en tabla sales
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];

            $stmt = $this->db->prepare("INSERT INTO sales (order_id, product_id, quantity, subtotal) 
                                    VALUES (:order_id, :product_id, :quantity, :subtotal)");
            $stmt->bindParam(':order_id', $orderId);
            $stmt->bindParam(':product_id', $item['id']);
            $stmt->bindParam(':quantity', $item['quantity']);
            $stmt->bindParam(':subtotal', $subtotal);
            $stmt->execute();
        }

        // Limpiar carrito
        unset($_SESSION['cart']);

        // Redirigir a mensaje de éxito
        header('Location: index.php?controller=cart&action=success');
        exit();
    }

    public function checkoutConfirm()
    {
        if (!empty($_SESSION['cart'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $comments = $_POST['comments'] ?? '';

            // Insertar orden
            $stmt = $this->db->prepare("INSERT INTO orders (name, email, phone, comments, created_at) 
                                    VALUES (:name, :email, :phone, :comments, NOW())");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':comments', $comments);
            $stmt->execute();

            $orderId = $this->db->lastInsertId();

            // Insertar detalles de venta
            foreach ($_SESSION['cart'] as $item) {
                $productId = $item['id'];
                $quantity = $item['quantity'];
                $subtotal = $item['price'] * $item['quantity'];

                $stmtSale = $this->db->prepare("INSERT INTO sales (order_id, product_id, quantity, subtotal)
                                            VALUES (:order_id, :product_id, :quantity, :subtotal)");
                $stmtSale->bindParam(':order_id', $orderId);
                $stmtSale->bindParam(':product_id', $productId);
                $stmtSale->bindParam(':quantity', $quantity);
                $stmtSale->bindParam(':subtotal', $subtotal);
                $stmtSale->execute();
            }

            // Limpiar carrito
            unset($_SESSION['cart']);

            // Redirigir a página de agradecimiento
            header("Location: index.php?controller=cart&action=thankyou");
            exit;
        } else {
            // Si no hay productos, regresar al checkout
            header("Location: index.php?controller=cart&action=checkout");
            exit;
        }
    }

    public function confirmPayment()
    {
        $orderId = $_POST['order_id'] ?? null;

        if ($orderId) {
            // Marcar como pagado
            $stmt = $this->db->prepare("UPDATE orders SET status = 'pagado' WHERE id = :id");
            $stmt->bindParam(':id', $orderId);
            $stmt->execute();

            // Descontar stock
            $stmt = $this->db->prepare("SELECT product_id, quantity FROM sales WHERE order_id = :id");
            $stmt->bindParam(':id', $orderId);
            $stmt->execute();
            $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($ventas as $venta) {
                $stmt = $this->db->prepare("UPDATE products SET stock = stock - :qty WHERE id = :pid");
                $stmt->bindParam(':qty', $venta['quantity']);
                $stmt->bindParam(':pid', $venta['product_id']);
                $stmt->execute();
            }
        }

        header("Location: index.php?controller=cart&action=thankyou");
    }

    public function simulatePayment()
    {
        require_once __DIR__ . '/../views/cart/simulate_payment.php';
    }
}
