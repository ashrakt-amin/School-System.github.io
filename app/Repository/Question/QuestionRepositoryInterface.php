<?php
namespace App\Repository\Question;

interface QuestionRepositoryInterface{

    public function index();

    public function create($id);

    public function show($id);

    public function edit($id);

    public function update($request);

    public function store($request);

    public function delete($id);


}