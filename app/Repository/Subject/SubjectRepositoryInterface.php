<?php
namespace App\Repository\Subject;

interface SubjectRepositoryInterface{

    public function index();

    public function create();

    public function edit($id);

    public function update($request);

    public function store($request);

    public function delete($id);


}