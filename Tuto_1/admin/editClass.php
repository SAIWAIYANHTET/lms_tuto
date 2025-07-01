<?php
ob_start();
include("../layouts/header.php");
require_once '../config/db.php';
require_once '../models/Class.php';

$db = getPDOConnection();
$model = new ClassModel($db);

$id = $_GET['id'] ?? null;
if (!$id) die("Invalid ID");

$class = $model->getClassById($id);
if (!$class) die("Class not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $letter = $_POST['letter'] ?? '';
    $model->updateClass($id, $name, $letter);
    header("Location: class.php");
    exit;
}
?>

<div class="container mt-5">
    <div class="card shadow-sm border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Class</h5>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Class Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="<?= htmlspecialchars($class['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="letter" class="form-label">Class Letter</label>
                    <input type="text" class="form-control" id="letter" name="letter"
                           value="<?= htmlspecialchars($class['letter']) ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Update Class</button>
                <a href="class.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php
include("../layouts/footer.php");
ob_end_flush(); 
?>
