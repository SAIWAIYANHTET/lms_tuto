<?php
require_once '../config/db.php';
require_once '../controllers/StudentController.php';

$pdo = getPDOConnection();
$controller = new StudentController($pdo);

$id = $_GET['id'] ?? null;
if ($id) {
    $controller->destroy($id);
}
header("Location: student.php");
exit;
