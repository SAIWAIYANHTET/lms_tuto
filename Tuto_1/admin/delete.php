<?php
include_once '../config/db.php';

$pdo = getPDOConnection();

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM subjects WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: subject.php");
exit;
