<?php

include_once("db.php"); // Include the Database class file

class Province {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM province";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log and re-throw the exception for higher-level handling
            error_log("Error fetching province data: " . $e->getMessage());
            throw $e;
        }
    }

    public function update($id, $data) {
        try {
            $sql = "UPDATE province SET name = :name WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

            // Execute the query
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Log and re-throw the exception for higher-level handling
            error_log("Error updating province data: " . $e->getMessage());
            throw $e;
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM province WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            // Check if any rows were affected (record deleted)
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Log and re-throw the exception for higher-level handling
            error_log("Error deleting province data: " . $e->getMessage());
            throw $e;
        }
    }

    public function read($id) {
        try {
            $sql = "SELECT * FROM province WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            // Fetch the data as an associative array
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log and re-throw the exception for higher-level handling
            error_log("Error reading province data: " . $e->getMessage());
            throw $e;
        }
    }

    public function create($data) {
        try {
            // Prepare the SQL INSERT statement
            $sql = "INSERT INTO province(name) VALUES(:name)";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind values to placeholders
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);

            // Execute the INSERT query
            $stmt->execute();

            // Check if the insert was successful
            return $stmt->rowCount() > 0 ? $this->db->getConnection()->lastInsertId() : false;

        } catch (PDOException $e) {
            // Log and re-throw the exception for higher-level handling
            error_log("Error creating province data: " . $e->getMessage());
            throw $e;
        }
    }
}

?>
