<?php
include("../layouts/header.php");
include_once '../config/db.php';
include_once '../controllers/SubjectController.php';

$pdo = getPDOConnection();  
$controller = new SubjectController($pdo);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $success = $controller->create($name, $description);
    $message = $success ? 'Subject added successfully!' : 'Failed to add subject.';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Subject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add New Subject</h4>
        </div>
        <div class="card-body">
            <?php if ($message): ?>
                <div class="alert alert-info"><?= htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Subject Name</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Add Subject</button>
                <a href="subject.php" class="btn btn-secondary">View Subjects</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>



<?php include("../layouts/footer.php"); ?>
