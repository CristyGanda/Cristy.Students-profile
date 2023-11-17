<?php

include_once("db.php"); // Include the Database class file

class TownCity {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Retrieve all town cities
    public function getAll() {
        try {
            $sql = "SELECT * FROM town_city";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log and re-throw the exception for higher-level handling
            error_log("Error retrieving town cities: " . $e->getMessage());
            throw $e;
        }
    }

    // Update town city based on ID
    public function update($id, $data) {
        try {
            $sql = "UPDATE town_city SET name = :name WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

            // Execute the query
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Log and re-throw the exception for higher-level handling
            error_log("Error updating town city: " . $e->getMessage());
            throw $e;
        }
    }

    // Delete town city based on ID
    public function delete($id) {
        try {
            $sql = "DELETE FROM town_city WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Log and re-throw the exception for higher-level handling
            error_log("Error deleting town city: " . $e->getMessage());
            throw $e;
        }
    }

    // Read town city based on ID
    public function read($id) {
        try {
            $sql = "SELECT * FROM town_city WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            // Fetch the town data as an associative array
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log and re-throw the exception for higher-level handling
            error_log("Error reading town city: " . $e->getMessage());
            throw $e;
        }
    }

    // Create a new town city
    public function create($data) {
        try {
            // Prepare the SQL INSERT statement
            $sql = "INSERT INTO town_city(name) VALUES(:name)";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind values to placeholders
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

            // Execute the INSERT query
            $stmt->execute();

            // Check if the insert was successful
            return $this->db->getConnection()->lastInsertId();
        } catch (PDOException $e) {
            // Log and re-throw the exception for higher-level handling
            error_log("Error creating town city: " . $e->getMessage());
            throw $e;
        }
    }
}

?>
