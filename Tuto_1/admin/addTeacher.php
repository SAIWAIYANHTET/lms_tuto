<?php
ob_start();
include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/TeacherController.php';

$pdo = getPDOConnection();
$controller = new TeacherController($pdo);

// Fetch departments for dropdown
$departments = $pdo->query("SELECT * FROM departments")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST['name'], $_POST['email'], $_POST['department_id']);
    header("Location: teacher.php");
    exit;
}
?>

<div class="container mt-5">
    <h2>Add New Teacher</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-select" required>
                <option value="">Select Department</option>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="teacher.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include("../layouts/footer.php"); ob_end_flush(); ?>
