<?php

class Product
{
    private $db;

    // Constructor: almacena la conexión de base de datos
    // Constructor: stores the database connection
    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    /**
     * Obtener todos los productos ordenados por ID descendente
     * Get all products ordered by ID descending
     */
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los productos como arreglo asociativo / Returns all products as associative array
    }

    /**
     * Obtener producto por su ID
     * Get a single product by its ID
     */
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el producto o false si no existe / Returns the product or false if not found
    }

    /**
     * Crear un nuevo producto
     * Create a new product
     */
    public function create($name, $category, $price, $stock, $description, $image)
    {
        $stmt = $this->db->prepare("INSERT INTO products (name, category, price, stock, description, image) 
                                    VALUES (:name, :category, :price, :stock, :description, :image)");
        $stmt->bindParam(':name', $name);             // Nombre del producto / Product name
        $stmt->bindParam(':category', $category);     // Categoría / Category
        $stmt->bindParam(':price', $price);           // Precio / Price
        $stmt->bindParam(':stock', $stock);           // Stock disponible / Available stock
        $stmt->bindParam(':description', $description); // Descripción del producto / Product description
        $stmt->bindParam(':image', $image);           // Ruta de la imagen / Image path
        return $stmt->execute(); // Retorna true si se insertó correctamente / Returns true if inserted successfully
    }

    /**
     * Actualizar un producto existente
     * Update an existing product
     */
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
        return $stmt->execute(); // Retorna true si se actualizó correctamente / Returns true if update was successful
    }

    /**
     * Eliminar producto por ID
     * Delete a product by its ID
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute(); // Retorna true si se eliminó / Returns true if deleted
    }
}
