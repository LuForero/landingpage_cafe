<?php
// A class named Database is declared. It will be used to manage the database connection.
class Database
{
    // Private static properties are defined to store connection details.
    private static $host = 'localhost:8889';        // Hostname for the database server (including port for MAMP).
    private static $dbName = 'Landingpage';         // Name of the database to connect to.
    private static $username = 'root';              // Username to access the database.
    private static $password = 'root';              // Password associated with the user.

    // Static method to establish and return a PDO connection
    public static function connect()
    {
        try {
            // A new PDO object is created using the previously defined connection information.
            $conn = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbName,
                self::$username,
                self::$password
            );

            // Configure PDO to throw exceptions when errors occur.
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Return the established connection.
            return $conn;
        } catch (PDOException $e) {
            // If a connection error occurs, display the message and stop execution.
            die("Connection error: " . $e->getMessage());
        }

        // ⚠️ This block will never be executed due to the return above.
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        return new PDO($dsn, $user, $pass, $options); // ← This code is currently unnecessary.
    }
}
