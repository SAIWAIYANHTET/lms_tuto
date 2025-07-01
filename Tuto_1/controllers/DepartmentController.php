<?php
require_once '../models/Department.php';

class DepartmentController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Department($pdo);
    }

    public function paginate($page, $limit) {
        $offset = ($page - 1) * $limit;
        $departments = $this->model->getPaginated($limit, $offset);
        $total = $this->model->getCount();
        return ['departments' => $departments, 'total' => $total, 'limit' => $limit];
    }

    public function store($name) {
        return $this->model->create($name);
    }

    public function edit($id) {
        return $this->model->find($id);
    }

    public function update($id, $name) {
        return $this->model->update($id, $name);
    }

    public function destroy($id) {
        return $this->model->delete($id);
    }
}
?>
