<?php
include("../layouts/header.php");
include_once '../config/db.php';
include_once '../controllers/AdminController.php';

$pdo = getPDOConnection(); 

$controller = new AdminController($pdo);
$message = '';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID is required.");
}

$admin = $controller->edit($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $controller->update($id, $name, $email);
    echo "<script>window.location.href='admin.php';</script>";
    exit;

}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Admin</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Admin Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($admin['name']) ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Admin Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-warning">Update Admin</button>
                <a href="admin.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php include("../layouts/footer.php"); ?>
