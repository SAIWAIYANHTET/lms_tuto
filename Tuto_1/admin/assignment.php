<?php
include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/AssignmentController.php';

$pdo = getPDOConnection();
$controller = new AssignmentController($pdo);
$assignments = $controller->index();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$data = $controller->paginate($page, 10);
$assignments = $data['assignments'];
$totalPages = ceil($data['total'] / $data['limit']);

?>

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h2>Assignments</h2>
        <a href="addAssignment.php" class="btn btn-success">+ Add Assignment</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $a): ?>
            <tr class="text-center">
                <td><?= $a['id'] ?></td>
                <td><?= htmlspecialchars($a['title']) ?></td>
                <td><?= htmlspecialchars($a['class_name']) ?> <?= $a['letter'] ?></td>
                <td><?= htmlspecialchars($a['subject_name']) ?></td>
                <td>
                    <a href="editAssignment.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="deleteAssignment.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this assignment?')">Delete</a>
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
