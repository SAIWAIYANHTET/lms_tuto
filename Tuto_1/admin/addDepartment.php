<?php
ob_start(); // Start output buffering

include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/DepartmentController.php';

$pdo = getPDOConnection();
$controller = new DepartmentController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST['name']);
    header("Location: department.php");
    exit;
}
?>

<div class="container mt-5">
    <h2>Add New Department</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Department</button>
        <a href="department.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include("../layouts/footer.php"); ?>
<?php ob_end_flush(); // Flush the output buffer ?>
