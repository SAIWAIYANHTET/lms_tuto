<?php
include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/DepartmentController.php';

$pdo = getPDOConnection();
$controller = new DepartmentController($pdo);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$data = $controller->paginate($page, 10);  // 10 rows per page
$departments = $data['departments'];
$totalPages = ceil($data['total'] / $data['limit']);
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Departments</h2>
        <a href="addDepartment.php" class="btn btn-success">+ Add Department</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Department Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($departments as $dept): ?>
            <tr class="text-center">
                <td><?= $dept['id'] ?></td>
                <td><?= htmlspecialchars($dept['name']) ?></td>
                <td>
                    <a href="editDepartment.php?id=<?= $dept['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="deleteDepartment.php?id=<?= $dept['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this department?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php include("../layouts/footer.php"); ?>
