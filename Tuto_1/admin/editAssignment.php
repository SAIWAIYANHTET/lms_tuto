<?php
ob_start();
include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/AssignmentController.php';

$pdo = getPDOConnection();
$controller = new AssignmentController($pdo);

$id = $_GET['id'] ?? null;
$assignment = $controller->edit($id);

$classes = $pdo->query("SELECT * FROM class")->fetchAll();
$subjects = $pdo->query("SELECT * FROM subjects")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id, $_POST['title'], $_POST['description'], $_POST['class_id'], $_POST['subject_id']);
    header("Location: assignment.php");
    exit;
}
?>

<div class="container mt-4">
    <h2>Edit Assignment</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($assignment['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?= htmlspecialchars($assignment['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="class_id" class="form-select">
                <?php foreach ($classes as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $c['id'] == $assignment['class_id'] ? 'selected' : '' ?>>
                        <?= $c['name'] ?> <?= $c['letter'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Subject</label>
            <select name="subject_id" class="form-select">
                <?php foreach ($subjects as $s): ?>
                    <option value="<?= $s['id'] ?>" <?= $s['id'] == $assignment['subject_id'] ? 'selected' : '' ?>>
                        <?= $s['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="assignment.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php
include("../layouts/footer.php");
ob_end_flush();
?>
