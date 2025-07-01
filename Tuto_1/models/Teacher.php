<?php
class Teacher {
    private $pdo;
    private $table = 'teachers';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getPaginated($limit, $offset) {
        $sql = "SELECT teachers.*, departments.name AS department_name 
                FROM teachers 
                LEFT JOIN departments ON teachers.department_id = departments.id 
                ORDER BY teachers.id ASC 
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM teachers");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function create($name, $email, $department_id) {
        $stmt = $this->pdo->prepare("INSERT INTO $this->table (name, email, department_id) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $department_id]);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email, $department_id) {
        $stmt = $this->pdo->prepare("UPDATE $this->table SET name = ?, email = ?, department_id = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $department_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
