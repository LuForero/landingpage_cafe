<?php

class Sale
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
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
        $sql = "SELECT s.order_id, p.name as product_name, s.quantity, s.subtotal, s.created_at
            FROM sales s
            JOIN products p ON s.product_id = p.id
            ORDER BY s.created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
