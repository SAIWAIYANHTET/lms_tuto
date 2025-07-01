<?php
require_once '../models/Assignment.php';

class AssignmentController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Assignment($pdo);
    }

    public function index() {
        return $this->model->getAll();
    }

    public function store($title, $description, $class_id, $subject_id) {
        return $this->model->create($title, $description, $class_id, $subject_id);
    }

    public function edit($id) {
        return $this->model->find($id);
    }

    public function update($id, $title, $description, $class_id, $subject_id) {
        return $this->model->update($id, $title, $description, $class_id, $subject_id);
    }

    public function destroy($id) {
        return $this->model->delete($id);
    }

    public function paginate($page = 1, $limit = 10) {
        $offset = ($page - 1) * $limit;
        $assignments = $this->model->getPaginated($limit, $offset);
        $total = $this->model->getCount();
        return [
            'assignments' => $assignments,
            'total' => $total,
            'limit' => $limit
        ];
    }

}
