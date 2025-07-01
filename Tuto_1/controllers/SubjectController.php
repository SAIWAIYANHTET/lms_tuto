<?php
require_once '../models/Subject.php';

class SubjectController {
    private $subjectModel;

    public function __construct($pdo) {
        $this->subjectModel = new Subject($pdo);
    }

    public function index() {
        return $this->subjectModel->getAll();
    }

    public function create($name, $description) {
        return $this->subjectModel->create($name, $description);
    }

    public function edit($id) {
        return $this->subjectModel->find($id);
    }

    public function update($id, $name, $description) {
        return $this->subjectModel->update($id, $name, $description);
    }

    public function destroy($id) {
        return $this->subjectModel->delete($id);
    }
}
