<?php
require_once '../config/db.php';
require_once '../controllers/DepartmentController.php';

$pdo = getPDOConnection();
$controller = new DepartmentController($pdo);

$id = $_GET['id'] ?? null;
if ($id) {
    $controller->destroy($id);
}

header("Location: department.php");
exit;
