<?php
require_once '../config/db.php';
require_once '../models/Student.php';

class StudentController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Student($pdo);
    }

    public function index() {
        return $this->model->getAll();  
    }


    public function store($name, $email, $class_id) {
        try {
            return $this->model->create($name, $email, $class_id);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public function edit($id) {
        return $this->model->find($id);
    }

    public function update($id, $name, $email, $class_id) {
        return $this->model->update($id, $name, $email, $class_id);
    }

    public function destroy($id) {
        return $this->model->delete($id);
    }

    public function paginate($page = 1, $limit = 5) {
        $offset = ($page - 1) * $limit;
        $students = $this->model->getPaginated($limit, $offset);
        $total = $this->model->getCount();
        return [
            'students' => $students,
            'total' => $total,
            'page' => $page,
            'limit' => $limit
        ];
    }

}
