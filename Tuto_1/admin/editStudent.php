<?php
ob_start(); // Start output buffering

include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/StudentController.php';

$pdo = getPDOConnection();
$controller = new StudentController($pdo);

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID is required");
}

$student = $controller->edit($id);
if (!$student) {
    die("Student not found.");
}

// fetch class list
$stmt = $pdo->query("SELECT * FROM class");
$classes = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $class_id = $_POST['class_id'];

    $controller->update($id, $name, $email, $class_id);
    header("Location: student.php");
    exit;
}
?>



<div class="container mt-5">
    <h2>Edit Student</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="class_id" class="form-select" required>
                <?php foreach ($classes as $class): ?>
                    <option value="<?= $class['id'] ?>" <?= $class['id'] == $student['class_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($class['name']) ?> <?= htmlspecialchars($class['letter']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="student.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include("../layouts/footer.php"); ?>
<?php ob_end_flush(); ?>
