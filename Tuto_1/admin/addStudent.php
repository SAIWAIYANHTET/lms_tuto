<?php
require_once '../config/db.php';
require_once '../controllers/StudentController.php';

$pdo = getPDOConnection();
$controller = new StudentController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST['name'], $_POST['email'], $_POST['class_id']);
    header("Location: student.php");
    exit;
}


include("../layouts/header.php");

// Fetch class list for dropdown
$stmt = $pdo->query("SELECT * FROM class");
$classes = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2>Add New Student</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="class_id" class="form-select" required>
                <option value="">Select Class</option>
                <?php foreach ($classes as $class): ?>
                    <option value="<?= $class['id'] ?>">
                        <?= htmlspecialchars($class['name']) ?> <?= htmlspecialchars($class['letter']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="student.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include("../layouts/footer.php"); ?>
