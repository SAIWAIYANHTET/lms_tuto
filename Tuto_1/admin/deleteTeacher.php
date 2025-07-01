<?php
require_once '../config/db.php';
require_once '../controllers/TeacherController.php';

$pdo = getPDOConnection();
$controller = new TeacherController($pdo);

$id = $_GET['id'] ?? null;
if ($id) {
    $controller->destroy($id);
}

header("Location: teacher.php");
exit;
