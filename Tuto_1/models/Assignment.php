<?php
class Assignment {
    private $pdo;
    private $table = 'assignments';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $sql = "SELECT a.*, c.name AS class_name, c.letter, s.name AS subject_name
                FROM assignments a
                LEFT JOIN class c ON a.class_id = c.id
                LEFT JOIN subjects s ON a.subject_id = s.id
                ORDER BY a.id ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create($title, $description, $class_id, $subject_id) {
        $stmt = $this->pdo->prepare("INSERT INTO $this->table (title, description, class_id, subject_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $class_id, $subject_id]);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $description, $class_id, $subject_id) {
        $stmt = $this->pdo->prepare("UPDATE $this->table SET title = ?, description = ?, class_id = ?, subject_id = ? WHERE id = ?");
        return $stmt->execute([$title, $description, $class_id, $subject_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getPaginated($limit, $offset) {
        $sql = "SELECT a.*, c.name AS class_name, c.letter, s.name AS subject_name
                FROM assignments a
                LEFT JOIN class c ON a.class_id = c.id
                LEFT JOIN subjects s ON a.subject_id = s.id
                ORDER BY a.id ASC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM {$this->table}");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
