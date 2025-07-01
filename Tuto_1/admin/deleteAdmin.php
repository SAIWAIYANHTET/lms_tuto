<?php
include_once '../config/db.php';
include_once '../controllers/AdminController.php';

$pdo = getPDOConnection();
$controller = new AdminController($pdo);

$id = $_GET['id'] ?? null;
if ($id) {
    $controller->destroy($id);
}

header("Location: admin.php");
exit;
