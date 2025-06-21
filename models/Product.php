<?php

class Product
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    // Obtener todos los productos
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener producto por ID
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear producto
    public function create($name, $category, $price, $stock, $description, $image)
    {
        $stmt = $this->db->prepare("INSERT INTO products (name, category, price, stock, description, image) 
                                    VALUES (:name, :category, :price, :stock, :description, :image)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    // Actualizar producto
    public function update($id, $name, $category, $price, $stock, $description, $image)
    {
        $stmt = $this->db->prepare("UPDATE products SET                                    
                                        name = :name,
                                        category = :category,
                                        price = :price,
                                        stock = :stock,
                                        description = :description,
                                        image = :image
                                    WHERE id = :id");
        $stmt->bindParam(':id', $id);      
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }

    // Eliminar producto
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
