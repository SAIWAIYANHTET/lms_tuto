<?php
ob_start(); // Start output buffering

include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/DepartmentController.php';

$pdo = getPDOConnection();
$controller = new DepartmentController($pdo);

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid department ID");
}

$department = $controller->edit($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id, $_POST['name']);
    header("Location: department.php");
    exit;
}
?>

<div class="container mt-5">
    <h2>Edit Department</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Department Name</label>
            <input type="text" name="name" class="form-control"
                   value="<?= htmlspecialchars($department['name']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="department.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include("../layouts/footer.php"); ?>
<?php ob_end_flush(); ?>
