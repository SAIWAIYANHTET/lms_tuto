<?php
require_once '../models/Admin.php';

class AdminController {
    private $adminModel;

    public function __construct($pdo) {
        $this->adminModel = new Admin($pdo);
    }

    public function index() {
        return $this->adminModel->getAll();
    }

    public function store($name, $email) {
        return $this->adminModel->create($name, $email);
    }

    public function destroy($id) {
        return $this->adminModel->delete($id);
    }


    public function edit($id) {
        return $this->adminModel->find($id);
    }

    public function update($id, $name, $email) {
        return $this->adminModel->update($id, $name, $email);
    }

}
