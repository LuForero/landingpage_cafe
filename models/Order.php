<?php
class Order
{
    private $db;

    // Constructor: recibe una conexión a la base de datos y la almacena
    // Constructor: receives a database connection and stores it
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    /**
     * Crea una orden vacía para usuario registrado (o anónimo)
     * Creates an empty order for a registered (or anonymous) user
     */
    public function create()
    {
        $userId = null; // Puedes usar $_SESSION['user_id'] si hay login / You can use $_SESSION['user_id'] if login exists
        $status = 'pendiente'; // Estado inicial de la orden / Initial order status
        $total  = 0; // Se puede actualizar más tarde / Can be updated later

        $stmt = $this->db->prepare("INSERT INTO orders (user_id, order_date, total_amount, status) 
                                    VALUES (:user_id, NOW(), :total, :status)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        return $this->db->lastInsertId(); // Retorna ID de la nueva orden / Returns new order ID
    }

    /**
     * Crea una orden como invitado (sin login)
     * Creates an order as guest (no login)
     */
    public function createGuest($name, $email, $phone, $comments = '')
    {
        $status = 'pendiente';
        $total = 0;

        $stmt = $this->db->prepare("
            INSERT INTO orders (user_id, order_date, total_amount, status, name, email, phone, comments)
            VALUES (NULL, NOW(), :total, :status, :name, :email, :phone, :comments)
        ");
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':comments', $comments);
        $stmt->execute();

        return $this->db->lastInsertId(); // ID de la orden creada / Created order ID
    }

    /**
     * Crea una orden con datos del comprador
     * Creates an order with buyer information
     */
    public function createWithDetails($name, $email, $phone, $comments)
    {
        $stmt = $this->db->prepare("INSERT INTO orders (name, email, phone, comments, status, order_date) 
                                    VALUES (:name, :email, :phone, :comments, 'pendiente', NOW())");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':comments', $comments);
        $stmt->execute();

        return $this->db->lastInsertId(); // Retorna ID de la orden creada / Returns the created order ID
    }

    /**
     * Crea una orden marcada como pagada e inserta las ventas
     * Creates an order as 'paid' and inserts the related sales
     */
    public function createPaidOrder($name, $email, $phone, $comments)
    {
        if (empty($_SESSION['cart'])) {
            return false; // Si el carrito está vacío / If cart is empty
        }

        $total = 0;

        // Calcular el total del pedido / Calculate order total
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        }

        // Insertar orden como pagada / Insert order as paid
        $stmt = $this->db->prepare("INSERT INTO orders (
            name, email, phone, comments, total_amount, status, order_date, created_at
        ) VALUES (
            :name, :email, :phone, :comments, :total, 'pagado', NOW(), NOW()
        )");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':total', $total);
        $stmt->execute();

        $orderId = $this->db->lastInsertId(); // ID de la orden recién creada / New order ID

        // Insertar productos en la tabla de ventas / Insert products into sales table
        require_once __DIR__ . '/Sale.php';
        $saleModel = new Sale($this->db);

        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $saleModel->create($orderId, $item['id'], $item['quantity'], $subtotal);
        }

        // Descontar del stock cada producto / Reduce stock for each product
        foreach ($_SESSION['cart'] as $item) {
            $stmt = $this->db->prepare("UPDATE products SET stock = stock - :qty WHERE id = :id");
            $stmt->bindParam(':qty', $item['quantity']);
            $stmt->bindParam(':id', $item['id']);
            $stmt->execute();
        }

        return $orderId;
    }
}
