<?php
namespace App\Repository\Exam;

interface ExamRepositoryInterface{

    public function index();

    public function create();

    public function edit($id);

    public function update($request);

    public function store($request);

    public function delete($id);


}