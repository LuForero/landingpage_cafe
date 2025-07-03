<?php
class Sale
{
    private $db;

    // Constructor: recibe la conexión a la base de datos
    // Constructor: receives the database connection
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    /**
     * Crear una venta
     * Create a sale
     */
    public function create($orderId, $productId, $quantity, $subtotal)
    {
        $stmt = $this->db->prepare("INSERT INTO sales (order_id, product_id, quantity, subtotal) 
                                    VALUES (:order_id, :product_id, :quantity, :subtotal)");
        $stmt->bindParam(':order_id', $orderId);     // ID de la orden / Order ID
        $stmt->bindParam(':product_id', $productId); // ID del producto / Product ID
        $stmt->bindParam(':quantity', $quantity);    // Cantidad vendida / Quantity sold
        $stmt->bindParam(':subtotal', $subtotal);    // Subtotal de esta venta / Subtotal for this item

        $stmt->execute();
    }

    /**
     * Obtener todas las ventas asociadas a una orden
     * Get all sales associated with a specific order
     */
    public function getByOrderId($orderId)
    {
        $stmt = $this->db->prepare("SELECT * FROM sales WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $orderId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todas las ventas de esa orden / Returns all sales for the order
    }

    /**
     * Obtener el total vendido de un producto específico
     * Get total quantity sold for a specific product
     */
    public function getTotalSoldByProduct($productId)
    {
        $query = "SELECT SUM(quantity) AS total_sold FROM sales WHERE product_id = :productId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total_sold'] ?? 0; // Devuelve la cantidad o 0 si no hay ventas / Returns quantity or 0 if no sales
    }

    /**
     * Obtener todas las ventas con nombre del producto
     * Get all sales with product name
     */
    public function getAllSales()
    {
        $query = "SELECT s.*, p.name AS product_name 
                  FROM sales s
                  JOIN products p ON s.product_id = p.id
                  ORDER BY s.id DESC";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC); // Devuelve ventas recientes con nombre de producto / Returns recent sales with product names
    }

    /**
     * Obtener todas las ventas con detalles completos de la orden
     * Get all sales with full order details
     */
    public function getAllSalesWithDetails()
    {
        $sql = "SELECT 
                    s.order_id, 
                    p.name AS product_name, 
                    s.quantity, 
                    s.subtotal,
                    o.created_at AS order_date, 
                    o.total_amount, 
                    o.name AS customer_name, 
                    o.email, 
                    o.status
                FROM sales s
                JOIN products p ON s.product_id = p.id
                JOIN orders o ON s.order_id = o.id
                ORDER BY o.created_at DESC";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC); // Devuelve historial de ventas con detalles / Returns sales history with details
    }
}
