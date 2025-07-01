<?php
include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/TeacherController.php';

$pdo = getPDOConnection();
$controller = new TeacherController($pdo);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$data = $controller->paginate($page);
$teachers = $data['teachers'];
$totalPages = ceil($data['total'] / $data['limit']);
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Teachers</h2>
        <a href="addTeacher.php" class="btn btn-success">+ Add Teacher</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($teachers as $teacher): ?>
            <tr class="text-center">
                <td><?= $teacher['id'] ?></td>
                <td><?= htmlspecialchars($teacher['name']) ?></td>
                <td><?= htmlspecialchars($teacher['email']) ?></td>
                <td><?= htmlspecialchars($teacher['department_name']) ?></td>
                <td>
                    <a href="editTeacher.php?id=<?= $teacher['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="deleteTeacher.php?id=<?= $teacher['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Delete this teacher?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination -->
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
