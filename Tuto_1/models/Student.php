<?php
class Student {
    private $pdo;
    private $table = 'students';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $sql = "SELECT students.*, class.name AS class_name, class.letter
                FROM students
                LEFT JOIN class ON students.class_id = class.id
                ORDER BY students.id ASC";  
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create($name, $email, $class_id = null) {
        $stmt = $this->pdo->prepare("INSERT INTO $this->table (name, email, class_id) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $class_id]);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email, $class_id = null) {
        $stmt = $this->pdo->prepare("UPDATE $this->table SET name = ?, email = ?, class_id = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $class_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function getPaginated($limit, $offset) {
        $sql = "SELECT students.*, class.name AS class_name, class.letter
                FROM students
                LEFT JOIN class ON students.class_id = class.id
                ORDER BY students.id ASC   -- 👈 change from DESC to ASC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM students");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

}
