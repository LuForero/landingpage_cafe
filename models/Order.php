<?php
class Order
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function create()
    {
        // Puedes ajustar estos valores según tus necesidades
        $userId = null; // o $_SESSION['user_id'] si tienes login
        $status = 'pendiente';
        $total  = 0; // Puedes actualizar el total luego si lo deseas

        $stmt = $this->db->prepare("INSERT INTO orders (user_id, order_date, total_amount, status) 
                                    VALUES (:user_id, NOW(), :total, :status)");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':total', $total);
        $stmt->bindParam(':status', $status);

        $stmt->execute();
        return $this->db->lastInsertId(); // Devuelve el ID de la orden recién creada
    }

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
        return $this->db->lastInsertId();
    }

    public function createWithDetails($name, $email, $phone, $comments)
    {
        $stmt = $this->db->prepare("INSERT INTO orders (name, email, phone, comments, status, order_date) 
                                VALUES (:name, :email, :phone, :comments, 'pendiente', NOW())");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':comments', $comments);
        $stmt->execute();

        return $this->db->lastInsertId(); // <-- Esta línea es importante
    }

    public function createPaidOrder($name, $email, $phone, $comments)
    {
        if (empty($_SESSION['cart'])) {
            return false;
        }

        $total = 0;

        // Calcular el total de la orden
        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        }

        // Insertar orden
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

        $orderId = $this->db->lastInsertId();

        // Insertar productos en la tabla sales
        require_once __DIR__ . '/Sale.php';
        $saleModel = new Sale($this->db);

        foreach ($_SESSION['cart'] as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $saleModel->create($orderId, $item['id'], $item['quantity'], $subtotal);
        }

        // Actualizar stock
        foreach ($_SESSION['cart'] as $item) {
            $stmt = $this->db->prepare("UPDATE products SET stock = stock - :qty WHERE id = :id");
            $stmt->bindParam(':qty', $item['quantity']);
            $stmt->bindParam(':id', $item['id']);
            $stmt->execute();
        }

        return $orderId;
    }
}
