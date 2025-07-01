<?php
ob_start();
include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/AssignmentController.php';

$pdo = getPDOConnection();
$controller = new AssignmentController($pdo);

$classes = $pdo->query("SELECT * FROM class")->fetchAll();
$subjects = $pdo->query("SELECT * FROM subjects")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store($_POST['title'], $_POST['description'], $_POST['class_id'], $_POST['subject_id']);
    header("Location: assignment.php");
    exit;
}
?>

<div class="container mt-4">
    <h2>Add Assignment</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="class_id" class="form-select" required>
                <?php foreach ($classes as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?> <?= $c['letter'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" class="form-select" required>
                <?php foreach ($subjects as $s): ?>
                    <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
        <a href="assignment.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
include("../layouts/footer.php");
ob_end_flush();
?>
