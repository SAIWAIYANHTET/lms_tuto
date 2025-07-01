<?php
ob_start();
include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/TeacherController.php';

$pdo = getPDOConnection();
$controller = new TeacherController($pdo);

$id = $_GET['id'] ?? null;
if (!$id) die("Invalid ID");

$teacher = $controller->edit($id);
if (!$teacher) die("Teacher not found");

$departments = $pdo->query("SELECT * FROM departments")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id, $_POST['name'], $_POST['email'], $_POST['department_id']);
    header("Location: teacher.php");
    exit;
}
?>

<div class="container mt-5">
    <h2>Edit Teacher</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($teacher['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($teacher['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Department</label>
            <select name="department_id" class="form-select" required>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?= $dept['id'] ?>" <?= ($teacher['department_id'] == $dept['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dept['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="teacher.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include("../layouts/footer.php"); ob_end_flush(); ?>
