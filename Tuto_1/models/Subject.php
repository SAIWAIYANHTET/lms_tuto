<?php
class Subject {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($name, $description) {
        $stmt = $this->pdo->prepare("INSERT INTO subjects (name, description) VALUES (?, ?)");
        return $stmt->execute([$name, $description]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM subjects");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM subjects WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $name, $description) {
        $stmt = $this->pdo->prepare("UPDATE subjects SET name = ?, description = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM subjects WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
