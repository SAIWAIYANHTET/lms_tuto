<?php
require_once '../config/db.php';
require_once '../controllers/AssignmentController.php';

$pdo = getPDOConnection();
$controller = new AssignmentController($pdo);

$id = $_GET['id'] ?? null;
if ($id) {
    $controller->destroy($id);
}
header("Location: assignment.php");
exit;
