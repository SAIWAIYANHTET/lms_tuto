<?php
require_once '../models/Teacher.php';

class TeacherController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Teacher($pdo);
    }

    public function paginate($page, $limit = 10) {
        $offset = ($page - 1) * $limit;
        $teachers = $this->model->getPaginated($limit, $offset);
        $total = $this->model->getCount();

        return [
            'teachers' => $teachers,
            'total' => $total,
            'limit' => $limit,
        ];
    }

    public function store($name, $email, $department_id) {
        return $this->model->create($name, $email, $department_id);
    }

    public function edit($id) {
        return $this->model->find($id);
    }

    public function update($id, $name, $email, $department_id) {
        return $this->model->update($id, $name, $email, $department_id);
    }

    public function destroy($id) {
        return $this->model->delete($id);
    }
}
