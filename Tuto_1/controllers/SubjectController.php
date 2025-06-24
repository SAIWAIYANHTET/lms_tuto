<?php
require_once __DIR__ . '/../models/Subject.php';

class SubjectController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Subject($pdo);
    }

    public function create($name, $description) {
        return $this->model->create($name, $description);
    }
}
