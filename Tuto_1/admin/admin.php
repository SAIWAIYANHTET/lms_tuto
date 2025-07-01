<?php
include("../layouts/header.php");
include_once '../config/db.php';
include_once '../controllers/AdminController.php';

$pdo = getPDOConnection(); 
$controller = new AdminController($pdo);
$admins = $controller->index();

if (empty($admins)) {
    $pdo->exec("ALTER TABLE admins AUTO_INCREMENT = 1");
}
?>


<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">User Management</h4>
            <a href="addAdmin.php" class="btn btn-sm btn-success">+ Add Admin</a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Admin Name</th>
                        <th>Email</th>
                        <th style="width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?= $admin['id'] ?></td>
                            <td><?= htmlspecialchars($admin['name']) ?></td>
                            <td><?= htmlspecialchars($admin['email']) ?></td>
                            <td>
                                <a href="editAdmin.php?id=<?= $admin['id'] ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                                <a href="deleteAdmin.php?id=<?= $admin['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($admins)): ?>
                        <tr><td colspan="4" class="text-center">No admins found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../layouts/footer.php"); ?>
