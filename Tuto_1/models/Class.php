<?php
class ClassModel {
    private $conn;
    private $table = 'class';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllClasses() {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addClass($name, $letter) {
        $sql = "INSERT INTO $this->table (name, letter) VALUES (:name, :letter)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':letter', $letter);
        return $stmt->execute();
    }

    public function getClassById($id) {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateClass($id, $name, $letter) {
        $sql = "UPDATE $this->table SET name = :name, letter = :letter WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':letter', $letter);
        return $stmt->execute();
    }


    public function deleteClass($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
