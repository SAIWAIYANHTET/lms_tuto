<?php
class Department {
    private $pdo;
    private $table = 'departments';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Get paginated departments
    public function getPaginated($limit, $offset) {
        $sql = "SELECT * FROM $this->table ORDER BY id ASC LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total count of departments
    public function getCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM $this->table");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Create new department
    public function create($name) {
        $stmt = $this->pdo->prepare("INSERT INTO $this->table (name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    // Find by id
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $name) {
        $stmt = $this->pdo->prepare("UPDATE $this->table SET name = ? WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }

    // Delete
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
