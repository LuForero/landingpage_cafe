<?php
class Sale
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    // Crear una venta
    public function create($orderId, $productId, $quantity, $subtotal)
    {
        $stmt = $this->db->prepare("INSERT INTO sales (order_id, product_id, quantity, subtotal) 
                                    VALUES (:order_id, :product_id, :quantity, :subtotal)");
        $stmt->bindParam(':order_id', $orderId);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':subtotal', $subtotal);

        $stmt->execute();
    }

    // (Opcional) Obtener ventas por orden
    public function getByOrderId($orderId)
    {
        $stmt = $this->db->prepare("SELECT * FROM sales WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalSoldByProduct($productId)
    {
        $query = "SELECT SUM(quantity) AS total_sold FROM sales WHERE product_id = :productId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_sold'] ?? 0;
    }

    public function getAllSales()
    {
        $query = "SELECT s.*, p.name AS product_name 
                  FROM sales s
                  JOIN products p ON s.product_id = p.id
                  ORDER BY s.id DESC";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSalesWithDetails()
    {
        $sql = "SELECT s.order_id, p.name AS product_name, s.quantity, s.subtotal,
                   o.created_at AS order_date, o.total_amount, o.name AS customer_name, o.email, o.status
            FROM sales s
            JOIN products p ON s.product_id = p.id
            JOIN orders o ON s.order_id = o.id
            ORDER BY o.created_at DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
