<?php
require_once __DIR__ . '/../models/Product.php';

class CartController
{
    private $productModel;
    private $db;

    // Constructor: receives a database connection and creates an instance of the Product model
    // Constructor: recibe la conexión a la base de datos y crea una instancia del modelo Product
    public function __construct($conexion)
    {
        $this->db = $conexion;
        $this->productModel = new Product($conexion);
    }

    // Add a product to the cart using its ID
    // Agregar un producto al carrito usando su ID
    public function add()
    {
        $productId = $_GET['id'] ?? null;

        // If no ID is received, redirect to home
        // Si no se recibe ID, redirigir al inicio
        if (!$productId) {
            header('Location: index.php?controller=home&action=index');
            exit();
        }

        // If cart doesn't exist in session, initialize it
        // Si el carrito no existe en la sesión, inicializarlo
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // If product already exists in the cart, increase quantity
        // Si el producto ya existe en el carrito, aumentar la cantidad
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += 1;
        } else {
            // Otherwise, get product data from DB and add to cart
            // Si no, obtener los datos del producto desde la BD y agregarlo al carrito
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

        // Redirect to home after adding product
        // Redirigir al inicio después de agregar el producto
        header('Location: index.php?controller=home&action=index');
        exit();
    }

    // Remove a specific product from the cart
    // Eliminar un producto específico del carrito
    public function remove()
    {
        $productId = $_GET['id'] ?? null;

        if ($productId && isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        header('Location: index.php?controller=cart&action=checkout');
        exit();
    }

    // Empty the entire cart
    // Vaciar todo el carrito
    public function clear()
    {
        unset($_SESSION['cart']);
        header('Location: index.php?controller=cart&action=checkout');
        exit();
    }

    // 🛒 Display the checkout view (cart summary)
    // 🛒 Mostrar la vista de checkout (resumen del carrito)
    public function checkout()
    {
        require_once __DIR__ . '/../views/cart/checkout.php';
    }

    // Process buyer info and register order and sales
    // Procesar la información del comprador y registrar la orden y ventas
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
        $status   = 'pending'; // estado de la orden
        $total    = 0;

        require_once __DIR__ . '/../models/Order.php';
        require_once __DIR__ . '/../models/Sale.php';

        $orderModel = new Order($this->db);
        $saleModel  = new Sale($this->db);

        // Calculate total / Calcular total
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        }

        // Insert order in the database / Insertar la orden en la base de datos
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

        // Register each item in the sales table / Registrar cada producto en la tabla sales
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $saleModel->create($orderId, $item['id'], $item['quantity'], $subtotal);
        }

        // Clear the cart / Limpiar el carrito
        unset($_SESSION['cart']);

        // Redirect to thank you page / Redirigir a la página de agradecimiento
        header('Location: index.php?controller=cart&action=thankyou');
        exit();
    }

    // Thank you page after order
    // Página de agradecimiento tras la orden
    public function thankyou()
    {
        require_once __DIR__ . '/../views/cart/thankyou.php';
    }

    // Confirm the order from the cart summary (checkout)
    // Confirmar la orden desde el resumen del carrito (checkout)
    public function confirm()
    {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            header('Location: index.php?controller=cart&action=index');
            exit();
        }

        $name     = $_POST['name'] ?? '';
        $email    = $_POST['email'] ?? '';
        $phone    = $_POST['phone'] ?? '';
        $comments = $_POST['comments'] ?? '';
        $total    = 0;

        // Calculate total / Calcular total
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Insert order / Insertar orden
        $stmt = $this->db->prepare("INSERT INTO orders (name, email, phone, comments, total_amount, status, order_date) 
                                VALUES (:name, :email, :phone, :comments, :total, 'pending', NOW())");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':total', $total);
        $stmt->execute();

        $orderId = $this->db->lastInsertId();

        // Insert each product into sales / Insertar cada producto en la tabla sales
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

        unset($_SESSION['cart']);
        header('Location: index.php?controller=cart&action=success');
        exit();
    }

    // Confirm checkout without total, and register order and sales
    // Confirmar checkout sin total, registrar orden y ventas
    public function checkoutConfirm()
    {
        if (!empty($_SESSION['cart'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $comments = $_POST['comments'] ?? '';

            // Insertar orden sin total
            $stmt = $this->db->prepare("INSERT INTO orders (name, email, phone, comments, created_at) 
                                    VALUES (:name, :email, :phone, :comments, NOW())");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':comments', $comments);
            $stmt->execute();

            $orderId = $this->db->lastInsertId();

            // Insertar ventas
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

            unset($_SESSION['cart']);
            header("Location: index.php?controller=cart&action=thankyou");
            exit;
        } else {
            header("Location: index.php?controller=cart&action=checkout");
            exit;
        }
    }

    // Confirm payment and update product stock
    // Confirmar el pago y actualizar el stock de productos
    public function confirmPayment()
    {
        $orderId = $_POST['order_id'] ?? null;

        if ($orderId) {
            // Set order as paid / Marcar orden como pagada
            $stmt = $this->db->prepare("UPDATE orders SET status = 'paid' WHERE id = :id");
            $stmt->bindParam(':id', $orderId);
            $stmt->execute();

            // Get sold items / Obtener los productos vendidos
            $stmt = $this->db->prepare("SELECT product_id, quantity FROM sales WHERE order_id = :id");
            $stmt->bindParam(':id', $orderId);
            $stmt->execute();
            $ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Reduce stock for each item / Reducir el stock por cada producto vendido
            foreach ($ventas as $venta) {
                $stmt = $this->db->prepare("UPDATE products SET stock = stock - :qty WHERE id = :pid");
                $stmt->bindParam(':qty', $venta['quantity']);
                $stmt->bindParam(':pid', $venta['product_id']);
                $stmt->execute();
            }
        }

        header("Location: index.php?controller=cart&action=thankyou");
    }

    // Load the payment simulation view
    // Cargar la vista de simulación de pago
    public function simulatePayment()
    {
        require_once __DIR__ . '/../views/cart/simulate_payment.php';
    }
}
