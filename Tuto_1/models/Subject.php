<?php
class Subject {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($name, $description) {
        if (empty($name)) {
            return ['success' => false, 'message' => 'Subject name is required.'];
        }

        try {
            $stmt = $this->pdo->prepare("INSERT INTO subjects (name, description) VALUES (:name, :description)");
            $stmt->execute([
                ':name' => $name,
                ':description' => $description
            ]);
            return ['success' => true, 'message' => 'Subject added successfully!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}
