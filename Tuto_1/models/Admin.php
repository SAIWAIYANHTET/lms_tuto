<?php
class Admin {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM admins");
        return $stmt->fetchAll();
    }

    public function create($name, $email) {
        $stmt = $this->pdo->prepare("INSERT INTO admins (name, email) VALUES (?, ?)");
        return $stmt->execute([$name, $email]);
    }


    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM admins WHERE id = ?");
        return $stmt->execute([$id]);
    }


    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $name, $email) {
        $stmt = $this->pdo->prepare("UPDATE admins SET name = ?, email = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $id]);
    }

}
