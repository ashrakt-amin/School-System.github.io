<?php
namespace App\Repository\Teacher;

interface TeacherRepositoryInterface{

    public function getAllTeachers();

    public function GetGender();

    public function Getspecialization();

    public function edit($id);

    public function update($request);

    public function store($request);

    public function delete($id);


}