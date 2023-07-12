<?php
namespace App\Repository\Student;

interface StudentRepositoryInterface{

    public function index();

    public function create();

    public function classrooms($id);
    
    public function sections($id);

    public function GetGender();

    public function Getspecialization();

    public function edit($id);

    public function show($id);

    public function update($request ,$id);

    public function store($data);

    public function delete($id);

    public function Upload_attachment($request);

    public function Download_attachment($student_name , $file);

    public function Delete_attachment($request);



}