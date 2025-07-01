<?php
include("../layouts/header.php");
include_once '../config/db.php';
include_once '../controllers/AdminController.php';

$pdo = getPDOConnection();
$controller = new AdminController($pdo);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $result = $controller->store($name, $email);
    // $message = $result['message'];
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Add New Admin</h4>
                </div>
                <div class="card-body">
                    <?php if ($message): ?>
                        <div class="alert alert-info"><?= $message ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Admin Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="Enter admin name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Admin Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="Enter admin email">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="admin.php" class="btn btn-secondary">← Back</a>
                            <button type="submit" class="btn btn-success">Add Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../layouts/footer.php"); ?>
