<?php
require_once '../config/db.php';
require_once '../models/Class.php';

class ClassController {
    public $model;

    public function __construct() {
        $db = getPDOConnection();
        $this->model = new ClassModel($db);
    }

    public function store($name, $letter) {
        $this->model->addClass($name, $letter);
        header('Location: classController.php');
        exit;
    }

    public function delete($id) {
        $this->model->deleteClass($id);
        header('Location: ../admin/class.php'); 
        exit;
    }
}

// Handle requests
$controller = new ClassController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $controller->store($_POST['name'], $_POST['letter']);
} elseif (isset($_GET['delete'])) {
    $controller->delete($_GET['delete']);
} else {
    header("Location: ../admin/class.php"); // fallback
    exit;
}
