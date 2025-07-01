<?php
include("../layouts/header.php");
require_once '../config/db.php';
require_once '../controllers/StudentController.php';

$pdo = getPDOConnection();
$controller = new StudentController($pdo);
// $students = $controller->index(); 


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$data = $controller->paginate($page, 5); 
$students = $data['students'];
$totalPages = ceil($data['total'] / $data['limit']);

// echo "<pre>";
// print_r($students);
// echo "</pre>";


?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Students</h2>
        <a href="addStudent.php" class="btn btn-success">+ Add Student</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Class</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($students as $student): ?>
            <tr class="text-center">
                <td><?= $student['id'] ?></td>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= htmlspecialchars($student['email']) ?></td>
                <td><?= htmlspecialchars($student['class_name']) ?> <?= htmlspecialchars($student['letter']) ?></td>
                <td>
                    <a href="editStudent.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="deleteStudent.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">Delete</a>
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
