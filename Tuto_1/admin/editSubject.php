<?php
include("../layouts/header.php");

?>
<?php
require_once '../config/db.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Invalid ID");

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';

    $stmt = $pdo->prepare("UPDATE subjects SET name = :name, description = :description WHERE id = :id");
    $stmt->execute([
        ':name' => $name,
        ':description' => $description,
        ':id' => $id
    ]);

    $message = "Subject updated successfully!";
}

// Fetch current subject data
$stmt = $pdo->prepare("SELECT * FROM subjects WHERE id = ?");
$stmt->execute([$id]);
$subject = $stmt->fetch();
if (!$subject) die("Subject not found.");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Subject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h4>Edit Subject</h4>
        </div>
        <div class="card-body">
            <?php if ($message): ?>
                <div class="alert alert-success"><?= $message ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Subject Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($subject['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"><?= htmlspecialchars($subject['description']) ?></textarea>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="subject.php" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<?php include("../layouts/footer.php"); ?>