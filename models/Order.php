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
}
