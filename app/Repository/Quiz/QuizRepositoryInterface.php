<?php
namespace App\Repository\Quiz;

interface QuizRepositoryInterface{

    public function index();

    public function create();

    public function edit($id);
    
    public function  show($id);

    public function update($request);

    public function store($request);

    public function delete($id);


}