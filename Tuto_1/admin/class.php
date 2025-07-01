<?php
include("../layouts/header.php");
require_once '../config/db.php';
require_once '../models/Class.php';

$db = getPDOConnection();
$model = new ClassModel($db);
$classes = $model->getAllClasses();
?>

<div class="container-fluid px-4 mt-4">
    <h2 class="fw-bold mb-4">Class Management</h2>

    <!-- Add Class Form -->
    <div class="card mb-4">
        <div class="card-header">Add New Class</div>
        <div class="card-body">
            <form method="POST" action="../controllers/ClassController.php" class="row g-3">
                <div class="col-md-6">
                    <label for="className" class="form-label">Class Name</label>
                    <input type="text" id="className" name="name" class="form-control" placeholder="Enter class name" required>
                </div>
                <div class="col-md-6">
                    <label for="classLetter" class="form-label">Class Letter</label>
                    <input type="text" id="classLetter" name="letter" class="form-control" placeholder="Grade-1.. etc" required>
                </div>
                <div class="col-md-12">
                    <button type="submit" name="add" class="btn btn-primary">Add Class</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Display Classes -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if (empty($classes)): ?>
            <div class="col">
                <div class="alert alert-warning text-center w-100">No classes found.</div>
            </div>
        <?php else: ?>
            <?php $i = 1; ?>
            <?php foreach ($classes as $class): ?>
                <div class="col">
                    <div class="card h-100 border-primary shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">
                                <?= htmlspecialchars($class['name'])?>
                            </h5>
                            <p class="card-text text-muted">ID: <?= $class['id'] ?></p>
                            <p class="card-text">Name: <?= htmlspecialchars($class['letter']) ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between">
                            <a href="editClass.php?id=<?= $class['id'] ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="../controllers/ClassController.php?delete=<?= $class['id'] ?>"
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Are you sure you want to delete this class?')">
                                <i class="bi bi-trash"></i> Remove
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include("../layouts/footer.php"); ?>
